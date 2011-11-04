<?php

require_once("../db.class.php");
include("./include/stat/function.inc");
include("../fonction.php");
$date = date("d/m/Y");
$laction=(isset($_GET['action']))?$_GET['action']:"";
$dadate = strftime("%A %d %B %Y");
$head_script ="<script type=\"text/javascript\" language=\"javascript\" src=\"../$Jquery\" charset=\"utf-8\"></script>";
$head_script .="<script type=\"text/javascript\" language=\"javascript\" src=\"../js/jquery-ui-1.7.1.custom.min.js\" charset=\"utf-8\"></script>";
$head_css ="<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\" media=\"screen\" />\n";
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
				type: \"GET\",
				url: \"./include/stat/dictionary\",
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
</script>
";

$body_script .= '<style>
	#selectableau tr.selected {background: #66B014; color: white;}
		</style>
	<script>
	$(document).ready(function() {
		


  $("#selectableau tr").click(function(event) {
    if (event.target.type !== "checkbox") {
		$(this).toggleClass("selected");
      	$(":checkbox", this).trigger("click");
		var datedebut = $("input[name=debut]").val();
		var datefin = $("input[name=fin]").val();
		var leslignes = $("input[name=\'cmd[]\']:checked")
						.map(function() { return $(this).val() })
                       .get()
                       .join(",");
  	$(\'#comparebox\').load("compare.php", { cmd: leslignes, debut: datedebut, fin: datefin});  }
  });

	$("#effacercompare").click(function(event) {
		$("#comparebox").empty();
		$("#stat input[name=\'cmd[]\']").attr(\'checked\', false);
		$("#selectableau tr").removeClass("selected");
	});

});
	</script>';


include('../menu.php');
$menu = $texto;
unset($texto);

//verifie si date debut-fin particuliere sinon 1 an a partir aujourd'hui
	$finfin = date("Y-m-d");

	list($year, $month, $day) = split('[/.-]', $finfin);
	$debdeb = $year-1 ."-".$month."-".$day;
	
	$lien= "";
if($_GET['debut']!=""){
	$datedebut =  $_GET['debut'];
	$lien .= "&debut=" . $_GET['debut'];
	}
else{
	$datedebut =  $debdeb;
}

if($_GET['fin']!=""){
	$datefin = $_GET['fin'];
	$lien .= "&fin=" . $_GET['fin'];
	}
else{
	$datefin = $finfin;
}



$minimenu = "<div>";
include('./minimenu.php');

$texto .="<ul class=\"sousmenu\">
<form action=\"../statistique/index.php\" method=\"get\" accept-charset=\"utf-8\">
<li class=\"menu\" >début<input class=\"actif corners\"  type=\"text\" name=\"debut\" value=\"$datedebut\" id=\"debut\" /></li>
<li class=\"menu\" >&nbsp;fin<input class=\"actif corners\"  type=\"text\" name=\"fin\" value=\"$datefin\" id=\"fin\" /></li>
<input type=\"submit\" value=\"Go\" />
</form>
			<ul/><br />
			</div>";

$texto .= '<div class="demo">
<a class="medium button red" id="effacercompare">effacer comparasion</a>
<p id="comparebox">
</p>
</div>
';
			
switch($laction){
	case "add";
		$rajout = "nouveau";
		include("./include/stat/add.inc");
	break;
	case "modif";
		$rajout = "modification";
		include("./include/stat/modif.inc");
	break;
	case "eff";
		$rajout = "suppression";
		include("./include/stat/eff.inc");
	break;
	case "manquant";
		$rajout = "manquant";
		include("./include/stat/manquant.inc");
	break;
	case "save";
		include("./include/stat/save.inc");
		include("./include/stat/default.inc");
	break;
	case "commander";
		$rajout = "classement";
		include("./include/stat/commander.inc");
	break;
	case "manquantcommande";
	$rajout = "commande de manquant";
		include("./include/stat/manquantcommande.inc");
	break;
	default;
		$rajout = "tous";
		include("./include/stat/default.inc");
	break;
}


switch($mess){
	case "newprod";
	$body_mess = message("warning", "Nouveau stat enregistr&eacute;");
	break;
	case "changeprod";
	$body_mess = message("warning", "stat modifi&eacute;");
	break;
	case "effaceprod";
	$body_mess = "<div><span class=\"box warning corners\">stat supprim&eacute;</span</div>";
	break;
	case "commandeprod";
	$body_mess = "<div><span class=\"box warning corners\">stat command&eacute;</span</div>";
	break;
	case "recuprod";
	$body_mess = "<div><span class=\"box warning corners\">stat re&ccedil;u</span</div>";
	break;
	default;
	$body_mess = "";
	break;
}



$yield = $texto;
include('./vue/template/stat.tpl');

?>

