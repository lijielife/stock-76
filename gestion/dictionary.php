<?php
$texto ="";
$texto .= '<link rel="stylesheet" href="../js/thickbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="../js/thickbox.js"></script>';
require("../config.php");
require_once("../db.class.php");
$theyear=date("Y");
$que = strtolower($_POST['search']);
$reqpre = new db();
$total=0;
$whair = "(produit.produit LIKE '%$que%' OR fournisseur.fournisseur LIKE '%$que%' OR produit.reference LIKE '%$que%' OR categ.categ LIKE '%$que%')";
$reqpre->findquery("SELECT *
	FROM produit, titre, categ, fournisseur
	WHERE categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur  AND $whair
 ORDER BY produit.produit ASC");
$texto .= "<meta content=\"text/html; Charset=UTF-8\" http-equiv=\"Content-Type\" />\n";
$texto.= "<table cellspacing=\"0\" >";

	$texto .= "</table>";
}
else{ 
		$texto .= "</table><br /><span class=\"affichage\">Il n'y a aucun produit correspondant &agrave; &quot;<b>$que</b>&quot; dans la base produit</span>";
	}
	echo $texto;
?>