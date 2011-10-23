<?php

require("../config.php");
require_once("../db.class.php");
$que = strtolower($_POST['search']);
$reqpre = new db();
$$total=0;
$whair = "(produit.produit LIKE '%$que%' OR fournisseur.fournisseur LIKE '%$que%' OR produit.reference LIKE '%$que%' OR categ.categ LIKE '%$que%')";
$reqpre->findquery("SELECT *
	FROM produit, titre, categ, fournisseur
	WHERE categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur  AND $whair
 ORDER BY categ.categ ASC");
$texto .= "<meta content=\"text/html; Charset=UTF-8\" http-equiv=\"Content-Type\" />\n";
$texto.= "<table cellspacing=\"0\" >
<tr>
<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_titre&search=$que'>Titre</a></th>
<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_categ&search=$que'>Categ</a></th>
<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=produit&search=$que'>Produit</a></th>
<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_fournisseur&search=$que'>fournisseur</a></th>
<th class=\"listingprod\">reference</th>
<th class=\"listingprod\">condit.</th>
<th class=\"listingprod\">prix</th>
<th class=\"listingprod\">stock</th>
<th class=\"listingprod\">stock mini</th>
<th class=\"listingprod\">commande</th>
<th class=\"listingprod\">used</th>
<th class=\"listingprod\">modif.</th>
<th class=\"listingprod\">&#8364;</th>
</tr>\n";
if(($reqpre->__get('numrows'))!=0){
$nblignemax = 1;
while($produit = $reqpre->row()){
	$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
	if(($produit->used=="1") && ($produit->stock<$produit->stock_mini)){
		$cololign = "class=\"stock\"";
	}
	if(($produit->stock)==($produit->stock_mini)){
		$cololign = "class=\"bientotstock\"";
	}
	$tot = floatval($produit->stock) * floatval($produit->prix);
	$totaligne = number_format($tot, 2, ',', '');
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
	<td>";
	$texto .= (($produit->used=="1")?"<img border='0' src='../img/check.gif' alt='used'>":"<img border='0' src='../img/uncheck.gif' alt='unused'>");
	$texto .= " </td>
	<td><a href='produit?action=modif&search=$que&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
	<td>".$totaligne."</td>
	</tr>\n";
	$total = $total + (floatval($produit->stock) * floatval($produit->prix));
	$nblignemax++;
}
	$texto .= "<tr><td colspan=13><center>Total en stock:  <b>".number_format($total, 2, ',', '')." &#8364;</b></center></td></tr>";
	$texto .= "</table>";
}
else{ 
		$texto .= "</table><br /><span class=\"affichage\">Il n'y a aucun produit correspondant &agrave; &quot;<b>$que</b>&quot; dans la base produit</span>";
	}
	echo $texto;
?>