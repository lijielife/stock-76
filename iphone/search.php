<?php
require("../config.php");
require_once("../db.class.php");
$keywords = preg_split("/[\s,]+/", $_POST['search']);
$que = $keywords[0];
$reqpre = new db();
$whair = "(produit.produit LIKE '%$que%' OR fournisseur.fournisseur LIKE '%$que%' OR produit.reference LIKE '%$que%' OR categ.categ LIKE '%$que%')";
$reqpre->findquery("SELECT *
	FROM produit, titre, categ, fournisseur
	WHERE categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur  AND $whair
 ORDER BY produit.produit ASC");
echo '<li class="sep">Results</li>';

if(($reqpre->__get('numrows'))!=0){
$nblignemax = 1;
while($produit = $reqpre->row()){
	$texto .="       <li><a class=\"flip\" href=\"./retrait.php?idprod=$produit->id_produit\"><em>$produit->categ</em><br/> $produit->produit</a> <small class=\"counter\">$produit->stock</small><small>$produit->prix &euro;</small></li>\n";
	$nblignemax++;
}
}
else{ 
		$texto .= "<li>Il n'y a aucun produit correspondant &agrave; &quot;<b>$que</b>&quot; dans la base produit</li>";
	}
	echo $texto;
?>