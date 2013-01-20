<?php
require_once("../db.class.php");
include("./include/produit/function.inc");
include("../fonction.php");
$date = date("d/m/Y");
$laction=(isset($_GET['action']))?$_GET['action']:"";
$dadate = strftime("%A %d %B %Y");
$head_script ="<script type=\"text/javascript\" language=\"javascript\" src=\"../$Jquery\" charset=\"utf-8\"></script>";
$head_css ="<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\" media=\"screen\" />\n";
$body_script = "
<script type=\"text/javascript\" charset=\"utf-8\">
$(document).ready(function(){
	
	$('#selectableau tr').dblclick(function() {
		if(this.id != 'nodbclick'){
		goTO = 'produit?action=modif&id=' + this.id;
	window.location = goTO;
		}
	});
				
	$(\"#txt_search\").keyup(function()
	{
		var search;
		
		search = $(\"#txt_search\").val();
		if (search.length > 1)
		{
			$.ajax(
			{
				type: \"GET\",
				url: \"./include/produit/dictionary\",
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
$body_script .= '<style>
	#selectableau tr.selected {background: #66B014; color: white;}
		</style>
	<script>
	$(document).ready(function() {
	$("input[name=\'cmd[]\']").click(function(event) {
		$(this).parents("#selectableau tr").toggleClass("selected");

		var leslignes = $("input[name=\'cmd[]\']:checked")
						.map(function() { return $(this).val() })
                       .get()
                       .join(",");
 
	});

  $("#selectableau tr").click(function(event) {
    if (event.target.type !== "checkbox") {
		$(this).toggleClass("selected");
		
		if($(":checkbox", this).is(":checked")){
			$(":checkbox", this).attr("checked", false);
		}
		else{
			$(":checkbox", this).attr("checked", true);
		}

		var leslignes = $("input[name=\'cmd[]\']:checked")
						.map(function() { return $(this).val() })
                       .get()
                       .join(",");
    }
  });

});
	</script>';

include('../menu.php');
$menu = $texto;
unset($texto);
$texto="";



$minimenu = "<div>";
$lapage = "produit";
include('./minimenu.php');
$minimenu .="<ul class=\"sousmenu\">
			<li class=\"menu\" ><a class=\"medium button green\"  href=\"./produit?action=add\" >Nouveau Produit</a> </li>
			<li class=\"menu\" ><a class=\"medium button yellow\" href=\"./produit?action=manquantcommande\" >Commande de Produit</a></li>
			</ul>
			</div>\n";

			
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
	case "save";
		include("./include/produit/save.inc");
		include("./include/produit/default.inc");
	break;
	case "commander";
		$rajout = "commande";
		include("./include/produit/commander.inc");
	break;
	case "cmdprint";
		$rajout = "cmdprint";
		include("./include/produit/cmdprint.inc");
	break;
	case "manquantcommande";
	$rajout = "commande de manquant";
		include("./include/produit/manquantcommande.inc");
	break;
	default;
		$rajout = "";
		include("./include/produit/default.inc");
	break;
}


switch($mess){
	case "newprod";
	$body_mess = message("warning", "Nouveau Produit enregistr&eacute;");
	break;
	case "changeprod";
	$body_mess = message("warning", "Produit modifi&eacute;");
	break;
	case "effaceprod";
	$body_mess = "<div><span class=\"box warning corners\">Produit supprim&eacute;</span</div>";
	break;
	case "commandeprod";
	$body_mess = "<div><span class=\"box warning corners\">Produit command&eacute;</span</div>";
	break;
	case "recuprod";
	$body_mess = "<div><span class=\"box warning corners\">Produit re&ccedil;u</span</div>";
	break;
	default;
	$body_mess = "";
	break;
}



$yield = $texto;
include('./vue/template/produit.tpl');

?>

