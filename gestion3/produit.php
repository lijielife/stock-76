<?php
require("../config.php");
require_once("../db.class.php");
$date = date("d/m/Y");
$laction=(isset($_GET['action']))?$_GET['action']:"";
$dadate = strftime("%A %d %B %Y");
$texto = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
	\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
$texto .= "<html xmlns=\"http://www.w3.org/1999/xhtml\"
	    xml:lang=\"fr\"
	    lang=\"fr\"
	    dir=\"ltr\">
<head>
<script type=\"text/javascript\" language=\"javascript\" src=\"../jquery.3.js\" charset=\"utf-8\"></script>

<meta content=\"text/html; Charset=UTF-8\" http-equiv=\"Content-Type\" />
<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\" media=\"screen\" />
<title>
Gestion Stock en ligne: Produit: {--rajout--}
</title>
</head>
<body>
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
$texto .="<div style=\"padding:8px\">";
$texto .="<h1>Gestion Produit: {--rajout--}</h1>\n";
if(isset($_GET['mess'])){
$mess = $_GET['mess'];
}
else{
$mess="";
}

switch($mess){
	case "newprod";
	$texto .= "<span class=\"affichage\">Nouveau Produit enregistr&eacute;e</span><br /><br />";
	break;
	case "changeprod";
	$texto .= "<span class=\"affichage\">Produit modifi&eacute;e</span><br /><br />";
	break;
	case "effaceprod";
	$texto .= "<span class=\"affichage\">Produit supprim&eacute;</span><br /><br />";
	break;
	case "commandeprod";
	$texto .= "<span class=\"affichage\">Produit command&eacute;</span><br /><br />";
	break;
	case "recuprod";
	$texto .= "<span class=\"affichage\">Produit re&ccedil;u</span><br /><br />";
	break;
	default;
	break;
}


$texto.= "<div><ul class=\"menu\">";
include('./minimenu.php');
$texto .="<ul class=\"sousmenu\">
			<li class=\"menu\" ><a href=\"./produit?action=add\" >Nouveau Produit</a> | </li>
			<li class=\"sousmenu\" ><a href=\"./produit?action=manquantcommande\" >Commande de Produit</a></li>
			</ul>
			<br />
			</div>";
			
switch($laction){
	case "add";
		$rajout = "nouveau";
		include("./include/add.inc");
	break;
	case "modif";
		$rajout = "modification";
		include("./include/modif.inc");
	break;
	case "eff";
		$rajout = "suppression";
		include("./include/eff.inc");
	break;
	case "manquant";
		$rajout = "manquant";
		include("./include/manquant.inc");
	break;
	case "only";
		$rajout = "catégorie";
		include("./include/only.inc");
	break;
	case "classer";
		$rajout = "classement";
		include("./include/classer.inc");
	break;
	case "search";
		$rajout = "recherche";
		include("./include/search.inc");
	case "commander";
		$rajout = "classement";
		include("./include/commander.inc");
	break;
	case "manquantcommande";
	$rajout = "commande de manquant";
		include("./include/manquantcommande.inc");
	break;
	default;
		$rajout = "tous";
		include("./include/default.inc");
	break;
}
$texto  = str_replace("{--rajout--}", $rajout, $texto);

$texto .= "</div>
</body>
</html>";
echo $texto;
?>

