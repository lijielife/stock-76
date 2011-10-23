<?php

	$reqpre = new db();
	$reqpre->findquery("SELECT * 
	FROM produit, titre, categ, fournisseur
	WHERE categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur
	AND produit.used=1
	ORDER BY categ.categ ASC");
	$total = 0;
	$texto.= "<form name=\"cherch\" action=\"./produit?action=search\" method=\"post\" accept-charset=\"utf-8\">
	<p>	<input  autocomplete=\"off\" class=\"actif\" type=\"text\" id=\"txt_search\" name=\"search\" value=\"\"><input type=\"submit\" value=\"rechercher\"></p>
	</form>
	<form action=\"./produit?action=commander\" method=\"post\">
	<span id=\"suggest\"><table cellspacing=\"0\" >
	<tr>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_titre'>Titre</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_categ'>Categ</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=produit'>Produit</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_fournisseur'>Fourn</a></th>
	<th class=\"listingprod\">reference</th>
	<th class=\"listingprod\">condit.</th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=prix'>prix</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=stock'>stock</a></th>
	<th class=\"listingprod\">stk_mini</th>
	<th class=\"listingprod\">QT_CMD</th>
	<th class=\"listingprod\"><input type=\"submit\" value=\"CMD\"></th>
	<th class=\"listingprod\">date</th>
	<th class=\"listingprod\"><img border='0' src='../img/pencil.gif' alt='modif'></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=totalprix'>&#8364;</a></th>
	</tr>\n";
	$nblignemax = 1;
	while($produit = $reqpre->row()){
		$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
		
		if($produit->used=="0"){$cololign = "class=\"unused\"";}
		if(($produit->used=="1") && ($produit->stock<$produit->stock_mini)){$cololign = "class=\"stock\"";}
		if(($produit->used=="1") && ($produit->commande=="1")){
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
		<td> $produit->titre</td>
		<td> $produit->categ</td>
		<td> $produit->produit</td>
		<td> $produit->fournisseur</td>
		<td> $produit->reference</td>
		<td> $produit->conditionnement</td>
		<td> ".number_format($produit->prix, 2, ',', '')."</td>
		<td> <b>$produit->stock</b></td>
		<td> $produit->stock_mini</td>
		<td> $produit->quantite_commande</td>
		<td><input type=\"checkbox\" name=\"cmd[]\" value=\"$produit->id_produit\"/></td>
		<td> $datecom</td>";
		$texto .= "</td>
		<td><a href='produit?action=modif&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td>".$totaligne."</td>
		</tr>\n";
			$total = $total + (floatval($produit->stock) * floatval($produit->prix));
		$nblignemax++;
	}
	
	
	//---- produit non utilise
		
	$bla = $reqpre->findquery("SELECT * 
	FROM produit, titre, categ, fournisseur
	WHERE categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur
	AND produit.used=0
	ORDER BY categ.categ ASC");
	$dejafait=0;
	while($produit = $reqpre->row()){
		if($produit!="" && $dejafait==0){$texto .= "<tr class=\"stock\" align='center'>
		<td  colspan=\"14\"> --------- produit non utilise ---------	</td></tr>";
	}
		$checkage="";
		if($produit->used=="0"){$cololign = "class=\"unused\""; $checkage="disabled";}
		$tot = floatval($produit->stock) * floatval($produit->prix);
		$totaligne = number_format($tot, 2, ',', '');
		list ($year, $month, $day) = explode ("-", $produit->date_commande);
		$datecom = (($produit->date_commande=="0000-00-00")?"":"$day/$month/$year");
		$texto .= "<tr  $cololign align='center'>
		<td> $produit->titre </td>
		<td> $produit->categ</td>
		<td> $produit->produit</td>
		<td> $produit->fournisseur</td>
		<td> $produit->reference</td>
		<td> $produit->conditionnement</td>
		<td> ".number_format($produit->prix, 2, ',', '')."</td>
		<td> <b>$produit->stock</b></td>
		<td> $produit->stock_mini</td>
		<td> $produit->quantite_commande</td>
		<td><input type=\"checkbox\" $checkage name=\"cmd[]\" value=\"$produit->id_produit\"/></td>
		<td> $datecom</td>
		<td><a href='produit?action=modif&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td>".$totaligne."</td>
		</tr>\n";
		$dejafait++;
		$total = $total + (floatval($produit->stock) * floatval($produit->prix));
	}
	
	
	//---- produit sans categ ou sans fournisseur sans titre correspondant ayant un pb de relation d'une table à l'autre
	$bla = $reqpre->findquery("SELECT * FROM produit
		WHERE NOT EXISTS (SELECT * FROM categ WHERE produit.id_categ = categ.id_categ)");
	
	while($produit = $reqpre->row()){
		if($produit!=""){
			$texto .= "<tr class=\"stock\" align='center'>
			<td  colspan=\"14\"> ------- produit ayant un pb de categorie ---------	</td></tr>";
		};
		$tot = floatval($produit->stock) * floatval($produit->prix);
		$totaligne = number_format($tot, 2, ',', '');
		$texto .= "<tr align='center'>
		<td> &nbsp; </td>
		<td> $produit->id_categ</td>
		<td> $produit->produit</td>
		<td> $produit->fournisseur</td>
		<td> $produit->reference</td>
		<td> $produit->conditionnement</td>
		<td> ".number_format($produit->prix, 2, ',', '')."</td>
		<td> <b>$produit->stock</b></td>
		<td> $produit->stock_mini</td>
		<td> $produit->quantite_commande</td>
		<td><input type=\"checkbox\" name=\"cmd[]\" value=\"$produit->id_produit\"/></td>
		<td><a href='produit?action=modif&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td>".$totaligne."</td>
		</tr>\n";
		$total = $total + (floatval($produit->stock) * floatval($produit->prix));
	}
	$bla = $reqpre->findquery("SELECT * FROM produit
		WHERE NOT EXISTS (SELECT * FROM fournisseur WHERE produit.id_fournisseur = fournisseur.id_fournisseur)");
	while($produit = $reqpre->row()){
		if($produit!=""){
			$texto .= "<tr class=\"stock\" align='center'>
				<td  colspan=\"14\"> ------- produit ayant un pb de fournisseur ---------	</td></tr>";
		};
		$tot = floatval($produit->stock) * floatval($produit->prix);
		$totaligne = number_format($tot, 2, ',', '');
		$texto .= "<tr align='center'>
		<td> &nbsp; </td>
		<td> $produit->id_categ</td>
		<td> $produit->produit</td>
		<td> $produit->id_fournisseur</td>
		<td> $produit->reference</td>
		<td> $produit->conditionnement</td>
		<td> ".number_format($produit->prix, 2, ',', '')."</td>
		<td> <b>$produit->stock</b></td>
		<td> $produit->stock_mini</td>
		<td> $produit->quantite_commande</td>
		<td><input type=\"checkbox\" name=\"cmd[]\" value=\"$produit->id_produit\"/></td>
		<td><a href='produit?action=modif&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td>".$totaligne."</td>
		</tr>\n";
		$total = $total + (floatval($produit->stock) * floatval($produit->prix));
	}
	
	$texto .= "<tr><td colspan=14><center>Total en stock:  <b>".number_format($total, 2, ',', '')." &#8364;</b></center></td></tr>";
	//------fin pb
	
	
	$texto .= "</form></span></table>";

?>