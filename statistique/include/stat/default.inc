<?php
	include("./include/stat/ordre.inc");

	$reqpre = new db();
	$rajout_requete= "";

	
	//si demande d'une categ specifique, fournisseur ou recherche
	if(isset($_GET['categ'])){
		$cat = mysql_real_escape_string($_GET['categ']);
		$rajout_requete = "AND categ.id_categ=$cat ";
		$rajout_class = "&categ=$cat";
	}
	
	if(isset($_GET['fournini'])){
		$fournis = mysql_real_escape_string($_GET['fournini']);
		$rajout_requete = "AND fournisseur.id_fournisseur=$fournis ";
		$rajout_class = "&fournini=$fournis";
	}
	
	if(isset($_GET['search'])){
		$que = mysql_real_escape_string($_GET['search']);
		$rajout_requete = "AND (produit.produit LIKE '%$que%' OR fournisseur.fournisseur LIKE '%$que%' OR produit.reference LIKE '%$que%' OR categ.categ LIKE '%$que%')";
		$rajout_class = "&search=$que";
		$elemrech = $que;
		}
		
	$allGET = "";
	foreach ($_GET as $key => $value) {
		$allGET .= "&$key=$value";
	}
	$requete_modifiable ="SELECT * 
	FROM produit, titre, categ, fournisseur
	WHERE categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur
	$rajout_requete
	ORDER BY produit.used DESC $ordreby";
	$reqpre->findquery($requete_modifiable);
	
	
	$total = 0;
	$texto.= "<form name=\"cherch\" action=\"./produit\" method=\"get\" accept-charset=\"utf-8\">
	<p>	<input  autocomplete=\"off\" class=\"actif corners\" type=\"text\" id=\"txt_search\" name=\"search\" value=\"\"><input class=\"medium button blue\" type=\"submit\" value=\"rechercher\"></p>
	</form><form action=\"./produit?action=commander\" method=\"post\" id=\"stat\"><span id=\"suggest\">
	";
	if(isset($_GET['search'])){
		$texto.= "<div><span class=\"box info corners\">recherche pour : <b>$que</b>&nbsp;&nbsp;</b></span</div>";
		}
		$texto.="<table id=\"selectableau\" cellspacing=\"0\" >
	\n";
	
	include("./include/stat/entete.inc");

	$nblignemax = 1;
	$usedaff=0;
	while($produit = $reqpre->row()){
		$cololign = (($nblignemax%2 == 0)?"":"alt");
		
		if($produit->used=="0"){$cololign = "unused";}
		if(($produit->used=="1") && ($produit->stock<$produit->stock_mini)){$cololign = "stock";}
		if(($produit->used=="1") && ($produit->commande=="1")){
				$cololign = "bientotstock";
			}
		if (isset($_GET['id'])){
		  if($produit->id_produit==$_GET['id']){
			$cololign = "justchange";
	   	}
    }
		if($produit->used=="0" && $usedaff==0){$texto .= "<tr class=\"stock\" align='center'>
		<td  colspan=\"15\"> --------- produit non utilise ---------	</td></tr>"; $usedaff = 1;}
		
		
		//recupere flux sortant selon date choisi N et N-1
		
		$req_statN = new db();
		$req_statN->findquery("SELECT sum(quantite) as N FROM flux WHERE flux.id_produit = $produit->id_produit AND quantite < 0 AND flux.date >=  '$datedebut' AND flux.date <=  '$datefin'");
		$statN = $req_statN->row();
		
		$valN= number_format($statN->N * $produit->prix, 2, ',', '');
		
		list($Nyear, $Nmonth, $Nday) = explode('-', $datedebut);
		$debutn1 = $Nyear-1 ."-".$Nmonth."-".$Nday;
		$req_statN1 = new db();
		$req_statN1->findquery("SELECT sum(quantite) as N1 FROM flux WHERE flux.id_produit = $produit->id_produit AND quantite < 0 AND flux.date >=  '$debutn1' AND flux.date <=  '$datedebut'");
		$statN1 = $req_statN1->row();
		$valN1= number_format($statN1->N1 * $produit->prix, 2, ',', '');
		
		//--
		
		$tot = floatval($produit->stock) * floatval($produit->prix);
		$totaligne = number_format($tot, 2, ',', '');
		list ($year, $month, $day) = explode ("-", $produit->date_commande);
		$datecom = (($produit->date_commande=="0000-00-00")?"":"$day/$month/$year");
		$texto .= "<tr name=\"$produit->id_produit\" class=\"$cololign\" align='center'>
		<td><input type=\"checkbox\" name=\"cmd[]\" value=\"$produit->id_produit\"/></td>
		<td> $produit->titre</td>
		<td> $produit->categ</td>
		<td> $produit->produit</td>
		<td> $produit->fournisseur</td>
		<td> $produit->reference</td>
		<td> $produit->conditionnement</td>
		<td> ".number_format($produit->prix, 2, ',', '')."</td>
		<td> <b>$produit->stock</b></td>
		<td> $produit->stock_mini</td>
		<td> $produit->quantite_commande</td>";
		$texto .= "<td><a target='_blank' href='graphan.php?idprod=" .  $produit->id_produit . "$lien'><img border='0' src='../img/chart_bar.png' alt='modif'></a></td>
		<td>".$totaligne."</td>
		<td title=\"$valN &#8364;\">$statN->N</td>
		<td title=\"$valN1 &#8364;\">$statN1->N1</td>
		</tr>\n";
			$total = $total + (floatval($produit->stock) * floatval($produit->prix));
		$nblignemax++;
	}
	

	$texto .= "<tr><td colspan=15><center>Total en stock:  <b>".number_format($total, 2, ',', '')." &#8364;</b></center></td></tr>";
	
	
	
	$texto .= "</form></span></table>";

?>