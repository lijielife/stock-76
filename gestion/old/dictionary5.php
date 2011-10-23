<?php
$texto .= '<link rel="stylesheet" href="../js/thickbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="../js/thickbox.js"></script>';
require("../config.php");
require_once("../db.class.php");
$theyear=date(Y);
$que = strtolower($_POST['search']);
$reqpre = new db();
$$total=0;
$whair = "(produit.produit LIKE '%$que%' OR fournisseur.fournisseur LIKE '%$que%' OR produit.reference LIKE '%$que%' OR categ.categ LIKE '%$que%')";
$reqpre->findquery("SELECT *
	FROM produit, titre, categ, fournisseur
	WHERE categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur  AND $whair
 ORDER BY produit.produit ASC");
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
<th class=\"listingprod\">QT_CMD</th>
<th class=\"listingprod\">date_cmd</th>
<th class=\"listingprod\">modif.</th>
<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=totalprix&search=$que'>&#8364;</a></th>
<th class=\"listingprod\">stat</th>
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
  list ($year, $month, $day) = split ("-", $produit->date_commande);
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
	<td>$datecom</td>
	<td><a href='produit?action=modif&search=$que&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
	<td>".$totaligne."</td>
		<td><a  class=\"thickbox\" href='../statistique/essai.php?height=420&width=570&mois=01&annee=$theyear&idprod=" .  $produit->id_produit . "'><img border='0' src='../img/chart_bar.png' alt='stat'></a></td>
	</tr>\n";
	$total = $total + (floatval($produit->stock) * floatval($produit->prix));
	$nblignemax++;
}
	$texto .= "<tr><td colspan=14><center>Total en stock:  <b>".number_format($total, 2, ',', '')." &#8364;</b></center></td></tr>";
	$texto .= "</table>";
}
else{ 
		$texto .= "</table><br /><span class=\"affichage\">Il n'y a aucun produit correspondant &agrave; &quot;<b>$que</b>&quot; dans la base produit</span>";
	}
	echo $texto;
?>