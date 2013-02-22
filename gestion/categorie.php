<?php
require("../config.php");
require_once("../db.class.php");
$date = date("d/m/Y");
$laction=(isset($_GET['action']))?$_GET['action']:"";
setlocale(LC_TIME, 'fr_FR.utf8','fra');
$dadate = strftime("%A %d %B %Y");
$head_script ="<script type=\"text/javascript\" language=\"javascript\" src=\"../$Jquery\" charset=\"utf-8\"></script>";
$head_css ="<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\" media=\"screen\" />\n";
$body_script = "";

include('../menu.php');
$menu = $texto;
unset($texto);
$texto="";


$minimenu = "<div>";
$lapage = "categorie";
include('./minimenu.php');
$minimenu .="<ul class=\"sousmenu\">
			<li class=\"menu\" ><a class=\"medium button green\" href=\"./categorie?action=add\" >Nouvelle categorie</a></li>
			</ul>
			</div><br />";

			
switch($laction){
	case "add";
		$rajout = "nouveau";
		include("./include/categorie/add.inc");
	break;
	case "modif";
		$rajout = "modification";
		include("./include/categorie/modif.inc");
	break;
	case "eff";
		$rajout = "suppression";
		include("./include/categorie/eff.inc");
	break;
	case "save";
		include("./include/categorie/save.inc");
		include("./include/categorie/default.inc");
	break;
	default;
		$rajout = "tous";
		include("./include/categorie/default.inc");
	break;
}


switch($mess){
	case "newfourn";
	$body_mess = "<span class=\"affichage\">Nouvelle categorie enregistr&eacute;</span><br /><br />";
	break;
	case "changefourn";
	$body_mess = "<span class=\"affichage\">categorie modifi&eacute;e</span<br /><br />";
	break;
	case "effacefourn";
	$body_mess = "<span class=\"affichage\">categorie supprim&eacute;e</span><br /><br />";
	break;
	default;
	$body_mess = "";
	break;
}



$yield = $texto;
include('./vue/template/categorie.tpl');

?>

