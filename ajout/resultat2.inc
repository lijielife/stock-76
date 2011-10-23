<?php
require("../config.php");
require_once("../db.class.php");
$cat = strtolower($_POST['cat']);
$que = strtolower(stripslashes($_POST['search']));
$reqpre = new db();
if($cat!=""){
	$reqpre->findquery("SELECT *
		FROM produit, titre, categ, fournisseur
		WHERE categ.id_categ = produit.id_categ
		AND categ.id_titre = titre.id_titre
		AND produit.id_fournisseur = fournisseur.id_fournisseur
		AND categ.id_categ = $cat
		AND produit.used=1
	 ORDER BY categ.categ ASC");
}
if($que!=""){
	$whair = "(produit.produit LIKE '%$que%' OR fournisseur.fournisseur LIKE '%$que%' OR produit.reference LIKE '%$que%' OR categ.categ LIKE '%$que%')";
	$reqpre->findquery("SELECT *
		FROM produit, titre, categ, fournisseur
		WHERE categ.id_categ = produit.id_categ
		AND categ.id_titre = titre.id_titre
		AND produit.used=1
		AND produit.id_fournisseur = fournisseur.id_fournisseur  AND $whair
	 ORDER BY categ.categ ASC");
}
$texto .= "<meta content=\"text/html; Charset=UTF-8\" http-equiv=\"Content-Type\" />";
$texto .="<script type=\"text/javascript\">
	$(document).ready(
		
		function(){
		$(\".selection\").click(function(){
			var lien = $(this).attr('id');
			$('#resultat').empty();
			$('#resultat').load('ajout2', {lid: lien});
			$(\"#txt_search\").val('');
			});

	});
	
	
	$(document).ready(
		
		function(){
		$(\".selectionalt\").click(function(){
			var lien = $(this).attr('id');
			$('#resultat').empty();
			$('#resultat').load('ajout2', {lid: lien});
			$(\"#txt_search\").val('');
			});
			
	});

</script>";
$texto.= "<table cellspacing=\"0\" >
<tr>
<th class=\"listingprod\">Categorie</th>
<th class=\"listingprod\">Produit</th>
<th class=\"listingprod\">fournisseur</th>
<th class=\"listingprod\">reference</th>
<th class=\"listingprod\">condit.</th>
<th class=\"listingprod\">stock</th>
<th class=\"listingprod\">stock mini</th>

</tr>\n";
if(($reqpre->__get('numrows'))!=0){
$nblignemax = 1;
while($produit = $reqpre->row()){
	$cololign = (($nblignemax%2 == 0)?"class=\"selection\"":"class=\"selectionalt\"");
	$texto .= "<tr  $cololign align='center' id=\"$produit->id_produit\">
	<td> $produit->categ</td>
	<td> $produit->produit</td>
	<td> $produit->fournisseur</td>
	<td> $produit->reference</td>
	<td> $produit->conditionnement</td>
	<td> <b>$produit->stock</b></td>
	<td> $produit->stock_mini</td></tr>\n";
	$nblignemax++;
}
	$texto .= "</table>";
}
else{ 
		$texto .= "</table><br /><span class=\"affichage\">Il n'y a aucun produit correspondant &agrave; &quot;<b>$que</b>&quot; dans la base produit</span>";
	}
?>