<?php
require("../config.php");
require_once("../db.class.php");
$date = date("d/m/Y");
$laction=(isset($_GET['action']))?$_GET['action']:"";
$dadate = strftime("%A %d %B %Y");
$head_script ="<script type=\"text/javascript\" language=\"javascript\" src=\"../$Jquery\" charset=\"utf-8\"></script>";
$head_css ="<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\" media=\"screen\" />\n";
$body_script = "";

include('../menu.php');
$menu = $texto;
unset($texto);



$minimenu = "<div>";
$lapage = "titre";
include('./minimenu.php');
$minimenu .="<ul class=\"sousmenu\">
			<li class=\"menu\" ><a class=\"medium button green\" href=\"./titre?action=add\" >Nouveau titre</a></li>
			</ul>
			</div><br />";

			
switch($laction){
	case "add";
		$rajout = "nouveau";
		include("./include/titre/add.inc");
	break;
	case "modif";
		$rajout = "modification";
		include("./include/titre/modif.inc");
	break;
	case "eff";
		$rajout = "suppression";
		include("./include/titre/eff.inc");
	break;
	case "save";
		include("./include/titre/save.inc");
		include("./include/titre/default.inc");
	break;
	default;
		$rajout = "tous";
		include("./include/titre/default.inc");
	break;
}


switch($mess){
	case "newfourn";
	$body_mess = "<span class=\"affichage\">Nouveau titre enregistr&eacute;</span><br /><br />";
	break;
	case "changefourn";
	$body_mess = "<span class=\"affichage\">Titre modifi&eacute;</span<br /><br />";
	break;
	case "effacefourn";
	$body_mess = "<span class=\"affichage\">Titre supprim&eacute;</span><br /><br />";
	break;
	default;
	$body_mess = "";
	break;
}



$yield = $texto;
include('./vue/template/titre.tpl');

?>

