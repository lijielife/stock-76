<?php
require("../config.php");
require_once("../db.class.php");
$date = date("d/m/Y");
$laction=(isset($_GET['action']))?$_GET['action']:"";
$dadate = strftime("%A %d %B %Y");
$head_script ="<script type=\"text/javascript\" language=\"javascript\" src=\"../$Jquery\" charset=\"utf-8\"></script>";
$head_css ="<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\" media=\"screen\" />
<link rel=\"stylesheet\" href=\"../styleprint.css\" type=\"text/css\" media=\"print\" />
\n";
$texto = "";
$body_script .= '<style>
	#listingcommande tr.selected {background: #66B014; color: white;}
		</style>
	<script>
	$(document).ready(function() {


  $("a.commando").click(function(event) {
	$("#listingcommande tr").removeClass("selected");
	$(this).parents("#listingcommande tr").toggleClass("selected");
	

});
});

	</script>';
$body_mess = "";

include('../menu.php');
$menu = $texto;
unset($texto);
$texto="";


$minimenu = "<div>";
$lapage = "commande";
include('./minimenu.php');
$minimenu .="<ul class=\"sousmenu\">
			<li class=\"menu\" ><a class=\"medium button green\" href=\"./commande?action=add\" >Nouvelle Commande</a></li>
			</ul>
			</div><br />";

			
switch($laction){
	case "add";
		$rajout = "nouveau";
		include("./include/commande/add.inc");
	break;
	case "modif";
		$rajout = "modification";
		include("./include/commande/modif.inc");
	break;
	case "eff";
		$rajout = "suppression";
		include("./include/commande/eff.inc");
	break;
	case "save";
		include("./include/commande/save.inc");
		include("./include/commande/default.inc");
	break;
	case "cmdprint";
		include("./include/commande/cmdprint.inc");
	break;
	case "print";
		include("./include/commande/print.inc");
	break;
	default;
		$rajout = "tous";
		include("./include/commande/default.inc");
	break;
}



$yield = $texto;
include('./vue/template/commande.tpl');

?>

