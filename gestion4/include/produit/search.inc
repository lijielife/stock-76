<?php

	$total = 0;
	$que = $_POST['search'];
	$reqpre = new db();
	$whair = "(produit.produit LIKE '%$que%' OR fournisseur.fournisseur LIKE '%$que%' OR produit.reference LIKE '%$que%' OR categ.categ LIKE '%$que%')";
	$reqpre->findquery("SELECT *
		FROM produit, titre, categ, fournisseur
		WHERE categ.id_categ = produit.id_categ
		AND categ.id_titre = titre.id_titre
		AND produit.id_fournisseur = fournisseur.id_fournisseur AND $whair
	 ORDER BY categ.categ ASC");
	$texto.= "<form name=\"cherch\" action=\"./produit?action=search\" method=\"post\" accept-charset=\"utf-8\">
	<p>	<input autocomplete=\"off\"  class=\"actif\" type=\"text\" id=\"txt_search\" name=\"search\" value=\"\"><input type=\"submit\" value=\"rechercher\"></p>
	</form>
	<form action=\"./produit?action=commander\" method=\"post\">
	<i>recherche pour : <b>$que</b></i><span id=\"suggest\"><table cellspacing=\"0\" >
	<tr>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_titre&search=$que'>Titre</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_categ&search=$que'>Categ</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=produit&search=$que'>Produit</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_fournisseur&search=$que'>fourn.</a></th>
	<th class=\"listingprod\">reference</th>
	<th class=\"listingprod\">condit.</th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=prix&search=$que'>prix</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=stock&search=$que'>stock</a></th>
	<th class=\"listingprod\">stk_mini</th>
	<th class=\"listingprod\">QT_CMD</th>
	<th class=\"listingprod\"><input type=\"submit\" value=\"CMD\"></th>
	<th class=\"listingprod\">date</th>
	<th class=\"listingprod\">modif</th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=totalprix&search=$que'>&#8364;</a></th>
	</tr>\n";
	if(($reqpre->__get('numrows'))!=0){
	$nblignemax = 1;
	while($produit = $reqpre->row()){
		$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
		if(($produit->used=="1") && ($produit->stock<$produit->stock_mini)){
			$cololign = "class=\"stock\"";
		}
		if($produit->commande=="1"){
			$cololign = "class=\"bientotstock\"";
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
		<td>$datecom</td>";
		$texto .= "<td><a href='produit?action=modif&search=$que&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td>".$totaligne."</td>
		</tr>\n";
		$total = $total + (floatval($produit->stock) * floatval($produit->prix));
		$nblignemax++;
	}		
		$texto .= "<tr><td colspan=14><center>Total en stock:  <b>".number_format($total, 2, ',', '')." &#8364;</b></center></td></tr>";
		$texto .= "</span></table>";
	}
	else{ 
			$texto .= "</table><br /><span class=\"affichage\">Il n'y a aucun produit correspondant &agrave; &quot;<b>$que</b>&quot; dans la base produit</span>";
		}



?>