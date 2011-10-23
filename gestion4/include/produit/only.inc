<?php

	$reqpre = new db();
	$cat = $_GET['id'];
	$rarajout= "&oldid=".$cat;
	$fournini = $_GET['fournini'];
	$total = 0;
	$laquery = "SELECT *
	FROM produit, titre, categ, fournisseur
	WHERE categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur AND categ.id_categ=$cat ORDER BY produit.produit";
	
	if ($_GET['fournini']!=""){
	$rarajout= "&oldfourni=".$fournini;
		$laquery = "SELECT *
			FROM produit, titre, categ, fournisseur
			WHERE categ.id_categ = produit.id_categ
			AND categ.id_titre = titre.id_titre
			AND produit.id_fournisseur = fournisseur.id_fournisseur AND fournisseur.id_fournisseur=$fournini ORDER BY produit.produit";
	}
	$reqpre->findquery($laquery);
	$texto.= "<form name=\"cherch\" action=\"./produit?action=search\" method=\"post\" accept-charset=\"utf-8\">
	<p>	<input autocomplete=\"off\"  class=\"actif\" type=\"text\" id=\"txt_search\" name=\"search\" value=\"\"><input type=\"submit\" value=\"rechercher\"></p>
	</form>
	<form action=\"./produit?action=commander\" method=\"post\"
	<span id=\"suggest\"><table cellspacing=\"0\" >
	<tr>
	<th class=\"listingprod\">titre</th>
	<th class=\"listingprod\">Categ</th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=produit&id=$cat'>Produit</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_fournisseur&id=$cat'>fourn.</a></th>
	<th class=\"listingprod\">reference</th>
	<th class=\"listingprod\">condit.</th>
	<th class=\"listingprod\">prix</th>
	<th class=\"listingprod\">stock</th>
	<th class=\"listingprod\">stk_mini</th>
	<th class=\"listingprod\">QT_CMD</th>
	<th class=\"listingprod\"><input  type=\"submit\" value=\"CMD\"></th>
	<th class=\"listingprod\">date</th>
	<th class=\"listingprod\">modif</th>
	<th class=\"listingprod\">&#8364;</th>
	</tr>\n";
	$nblignemax = 1;
	while($produit = $reqpre->row()){
		$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
		
		$checkage ="";
		if($produit->used=="0"){$cololign = "class=\"unused\""; $checkage="disabled";}

		if(($produit->used=="1") && ($produit->stock<$produit->stock_mini)){
			$cololign = "class=\"stock\"";
		}
		if($produit->commande=="1"){
			$cololign = "class=\"bientotstock\"";
		}
		if (isset($_GET['oldprodid'])){
		  if($produit->id_produit==$_GET['oldprodid']){
			$cololign = "class=\"justchange\"";
	   	}
    }
		$tot = floatval($produit->stock) * floatval($produit->prix);
		$totaligne = number_format($tot, 2, ',', '');
		list ($year, $month, $day) = explode ("-", $produit->date_commande);
		$datecom = (($produit->date_commande=="0000-00-00")?"":"$day/$month/$year");
		$texto .= "<tr $cololign align='center'>
		<td> $produit->id_titre</td>
		<td> $produit->categ</td>
		<td> $produit->produit</td>
		<td> $produit->fournisseur</td>
		<td> $produit->reference</td>
		<td> $produit->conditionnement</td>
		<td>".number_format($produit->prix, 2, ',', '')."</td>
		<td> <b>$produit->stock</b></td>
		<td> $produit->stock_mini</td>
		<td> $produit->quantite_commande</td>
		<td><input type=\"checkbox\" $checkage name=\"cmd[]\" value=\"$produit->id_produit\"/></td>
		<td> $datecom</td>
		<td><a href='produit?action=modif&id=" .  $produit->id_produit . "&oldact=only".$rarajout."'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td>".$totaligne."</td>
		</tr>\n";
		$total = $total + (floatval($produit->stock) * floatval($produit->prix));
		$nblignemax++;
	}
		$texto .= "<tr><td colspan=14><center>Total en stock:  <b>".number_format($total, 2, ',', '')." &#8364;</b></center></td></tr>";
		$texto .= "</table>";

?>