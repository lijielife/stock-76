<?php
require("../config.php");
require_once("../db.class.php");
include("./include/produit/function.inc");
$date = date("d/m/Y");
$laction=(isset($_GET['action']))?$_GET['action']:"";
$dadate = strftime("%A %d %B %Y");
$head_script ="<script type=\"text/javascript\" language=\"javascript\" src=\"../jquery.3.js\" charset=\"utf-8\"></script>";
$head_css ="<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\" media=\"screen\" />";
$body_script = "
<script type=\"text/javascript\" charset=\"utf-8\">
$(document).ready(function(){			
	$(\"#txt_search\").keyup(function()
	{
		var search;
		
		search = $(\"#txt_search\").val();
		if (search.length > 1)
		{
			$.ajax(
			{
				type: \"POST\",
				url: \"dictionary\",
				data: \"search=\" + search,
				success: function(message)
				{	
					$(\"#suggest\").empty();
			  		if (message.length > 0)
					{							
						$(\"#suggest\").append(message);
					}
				}
			});
		}
		else
		{
			$(\"#suggest\").empty();
		}
	});
});	
</script>";

include('../menu.php');
$menu = $texto;
unset($texto);

if(isset($_GET['mess'])){
$mess = $_GET['mess'];
}
else{
$mess="";
}

switch($mess){
	case "newprod";
	$body_mess = "<span class=\"affichage\">Nouveau Produit enregistr&eacute;e</span><br /><br />";
	break;
	case "changeprod";
	$body_mess = "<span class=\"affichage\">Produit modifi&eacute;e</span><br /><br />";
	break;
	case "effaceprod";
	$body_mess = "<span class=\"affichage\">Produit supprim&eacute;</span><br /><br />";
	break;
	case "commandeprod";
	$body_mess = "<span class=\"affichage\">Produit command&eacute;</span><br /><br />";
	break;
	case "recuprod";
	$body_mess = "<span class=\"affichage\">Produit re&ccedil;u</span><br /><br />";
	break;
	default;
	$body_mess = "";
	break;
}


$minimenu = "<div><ul class=\"menu\">";
include('./minimenu.php');
$minimenu .="<ul class=\"sousmenu\">
			<li class=\"menu\" ><a href=\"./produit?action=add\" >Nouveau Produit</a> | </li>
			<li class=\"sousmenu\" ><a href=\"./produit?action=manquantcommande\" >Commande de Produit</a></li>
			</ul>
			<br />
			</div>";

			
switch($laction){
	case "add";
		$rajout = "nouveau";
		include("./include/produit/add.inc");
	break;
	case "modif";
		$rajout = "modification";
		include("./include/produit/modif.inc");
	break;
	case "eff";
		$rajout = "suppression";
		include("./include/produit/eff.inc");
	break;
	case "manquant";
		$rajout = "manquant";
		include("./include/produit/manquant.inc");
	break;
	case "only";
		$rajout = "catégorie";
		include("./include/produit/only.inc");
	break;
	case "classer";
		$rajout = "classement";
		include("./include/produit/classer.inc");
	break;
	case "search";
		$rajout = "recherche";
		include("./include/produit/search.inc");
	case "commander";
		$rajout = "classement";
		include("./include/produit/commander.inc");
	break;
	case "manquantcommande";
	$rajout = "commande de manquant";
		include("./include/produit/manquantcommande.inc");
	break;
	default;
		$rajout = "tous";
		include("./include/produit/default.inc");
	break;
}

$yield = $texto;
include('./vue/template/produit.tpl');

?>

