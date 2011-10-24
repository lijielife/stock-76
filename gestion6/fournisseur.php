<?php
require("../config.php");
require_once("../db.class.php");
include("./include/produit/function.inc");
$date = date("d/m/Y");
$laction=(isset($_GET['action']))?$_GET['action']:"";
$dadate = strftime("%A %d %B %Y");
$head_script ="<script type=\"text/javascript\" language=\"javascript\" src=\"../jquery.3.js\" charset=\"utf-8\"></script>";
$head_css ="<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\" media=\"screen\" />\n";
$body_script = "";

include('../menu.php');
$menu = $texto;
unset($texto);



$minimenu = "<div><ul class=\"menu\">";
include('./minimenu.php');
$minimenu .="<ul class=\"sousmenu\">
			<li class=\"menu\" ><a class=\"menu\" href=\"./fournisseur?action=add\" >Nouveau Fournisseur</a></li>
			</ul>
			</div><br />";

			
switch($laction){
	case "add";
		$rajout = "nouveau";
		include("./include/fournisseur/add.inc");
	break;
	case "modif";
		$rajout = "modification";
		include("./include/fournisseur/modif.inc");
	break;
	case "eff";
		$rajout = "suppression";
		include("./include/fournisseur/eff.inc");
	break;
	case "save";
		include("./include/fournisseur/save.inc");
		include("./include/fournisseur/default.inc");
	break;
	default;
		$rajout = "tous";
		include("./include/fournisseur/default.inc");
	break;
}


switch($mess){
	case "newfourn";
	$body_mess = "<span class=\"affichage\">Nouveau Fournisseur enregistr&eacute;</span><br /><br />";
	break;
	case "changefourn";
	$body_mess = "<span class=\"affichage\">Fournisseur modifi&eacute;</span<br /><br />";
	break;
	case "effacefourn";
	$body_mess = "<span class=\"affichage\">Fournisseur supprim&eacute;</span><br /><br />";
	break;
	default;
	$body_mess = "";
	break;
}



$yield = $texto;
include('./vue/template/fournisseur.tpl');

?>

