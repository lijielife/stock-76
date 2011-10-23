<?php
require("../config.php");
require_once("../db.class.php");
session_start();
$send = $_SESSION['send'];
require("../fonction.php");
$date = date("d/m/Y");
setlocale(LC_TIME, "fr_FR");
switch ($_GET['action']) {
	case 'add';
	$rajout = "nouveau";
	break;
	case 'eff';
	$rajout = "suppression";
	break;
	case 'manquant';
	$rajout = "manquant";
	break;
	case 'only';
	$rajout = "cat&eacute;gorie";
	break;
	case 'search';
	$rajout = "recherche";
	break;
	case 'modif';
	$rajout = "modification";
	break;
	case 'classer';
	$rajout = "classement";
	break;
	default;
	$rajout = "Tous";
	break;
}
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

<link rel=\"stylesheet\" media=\"screen\" type=\"text/css\" href=\"./css/colorpicker.css\" />
<script type=\"text/javascript\" src=\"./js/colorpicker.js\"></script>
<title>
Gestion brackets en ligne: Options de torque: $rajout
</title>
</head>
<body>
<style type=\"text/css\" media=\"all\">
td, td:hover, tr, tr:hover{
	background-color: transparent;
	color: inherit;
}	
</style>
<script type=\"text/javascript\" charset=\"utf-8\">
$(document).ready(function(){
	
	$('#colorpickerHolder').ColorPicker({flat: true,
				color: '#ffff00',
				onSubmit: function(hsb, hex, rgb, el) {
				$('#colorpickerHolder').toggle('fast');},
				onChange: function (hsb, hex, rgb) {
				$('#backcolorpick').val(hex);
				$('#backcolorpick').css('backgroundColor', '#' + hex);
				$('#textcolorpick').css('backgroundColor', '#' + hex);
	}
			});
	$('#colorpickerHolder').hide();
	
	$('#colorpickerHolder2').ColorPicker({flat: true,
				color: '#000000',
				onSubmit: function(hsb, hex, rgb, el) {
				$('#colorpickerHolder2').toggle('fast');},
				onChange: function (hsb, hex, rgb) {
				$('#textcolorpick').val(hex);
				$('#textcolorpick').css('color', '#' + hex);
				$('#backcolorpick').css('color', '#' + hex);
	}
			});
	$('#colorpickerHolder2').hide();
	
	$('#backcolorpick').click(function(){
			$('#colorpickerHolder').ColorPickerSetColor(this.value);
			$('#colorpickerHolder').toggle('normal');
	})
	
		$('#textcolorpick').click(function(){
			$('#colorpickerHolder2').ColorPickerSetColor(this.value);
			$('#colorpickerHolder2').toggle('normal');
	})
	
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
$texto .="<h1>Gestion bracket: $rajout</h1>\n";
$mess = $_GET['mess'];
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
$texto .="<ul class=\"sousmenu\">
			<li class=\"menu\" ><a href=\"./option?action=add\" ><img style=\"vertical-align:top\" border=\"0\" src=\"../img/add.png\"> Nouvelle Option de torque</a> | </li>
			<li class=\"sousmenu\" ><a href=\"./option\" >Modifier Option</a></li>
			</ul>
			<br />
			</div>";
			
switch($_GET['action']){
	case "add";
	$texto .="<h3>Cr&eacute;ation d'Option de torque</h3>";
	if($_SESSION['error_categ']!=""){
		$texto .="<p class=\"affichage\">".$_SESSION['error_categ']."</p>";
	}
	
	//
	
	$texto .= "<form name=\"urg\" method=\"POST\" action=\"./save_option\">\n";
$texto .= "<div name=\"formuledent\" id=\"formuledent\"><center>
New categ: <input class=actif style=\"font-size:18px\" type=\"text\" name=\"categ\" value=\"\" >
backcolor: <input class=actif style=\"width:50px;border-color:black\" readonly  type=\"text\" name=\"backcolor\" value=\"FFFFFF\" id=\"backcolorpick\">
textcolor: <input class=actif style=\"width:50px;border-color:black\"  readonly type=\"text\" name=\"textcolor\" value=\"000000\" id=\"textcolorpick\">
nature: <select name=\"nature\" class=actif><option value=\"metal\">metal</option><option value=\"ceram\">ceram</option></select><br/><br/>";
$texto .="<p id=\"colorpickerHolder\">Couleur de fond</p>";
$texto .="<p id=\"colorpickerHolder2\">Couleur du texte</p>";

$texto .= "<table cellpadding='5' >
<tr height=\"40\"><th>dent<br />torque<br />id_produit</th>";
for ($i=17; $i > 10 ; $i--) {
	if($i==11){$texto .="<td class=\"cadran1\">";}
	else{$texto .="<td class=\"cadransup\">";}
	$lordre=dent_ordre($i);
	$texto .="$i<br /><input class=actif type=\"text\" size=4 name=\"torque_$i\" id=\"torque_$i\" value=\"".$send["torque_".$i]."\" ><br /><select style=\"width:45px;font-size:10px\" name=\"id_produit_dent_$i\" id=\"id_produit_dent_$i\" >".selprod($send["id_produit_dent_".$i])."<input type=\"hidden\" name=\"dent_$i\" id=\"dent_$i\" value=\"$lordre\" >";
	$texto .="</td>";
}
for ($i=21; $i < 28 ; $i++) {
	$lordre=dent_ordre($i);
	$texto .="<td class=\"cadransup\">";
	$texto .="$i<br /><input class=actif type=\"text\" size=4 name=\"torque_$i\" id=\"torque_$i\" value=\"".$send["torque_".$i]."\" ><br /><select style=\"width:45px;font-size:10px\" name=\"id_produit_dent_$i\" id=\"id_produit_dent_$i\" >".selprod($send["id_produit_dent_".$i])."<input type=\"hidden\" name=\"dent_$i\" id=\"dent_$i\" value=\"$lordre\" >";
	$texto .="</td>";
}
$texto .="</tr><tr><th>dent<br />torque<br />id_produit</th>";
for ($i=47; $i > 40 ; $i--) { 
	if($i==41){$texto .="<td valign=top class=\"cadranmilieu\">";}
	else{$texto .="<td valign=top >";}
	$lordre=dent_ordre($i);
	$texto .="$i<br /><input class=actif type=\"text\" size=4 name=\"torque_$i\" id=\"torque_$i\" value=\"".$send["torque_".$i]."\" ><br /><select style=\"width:45px;font-size:10px\" name=\"id_produit_dent_$i\" id=\"id_produit_dent_$i\" >".selprod($send["id_produit_dent_".$i])."<input type=\"hidden\" name=\"dent_$i\" id=\"dent_$i\" value=\"$lordre\" >";
	$texto .="</td>";
}
for ($i=31; $i < 38 ; $i++) {
	$lordre=dent_ordre($i);
	$texto .="<td valign=top >";
	$texto .="$i<br /><input class=actif type=\"text\" size=4 name=\"torque_$i\" id=\"torque_$i\" value=\"".$send["torque_".$i]."\" ><br /><select style=\"width:45px;font-size:10px\" name=\"id_produit_dent_$i\" id=\"id_produit_dent_$i\" >".selprod($send["id_produit_dent_".$i])."<input type=\"hidden\" name=\"dent_$i\" id=\"dent_$i\" value=\"$lordre\" >";
	$texto .="</td>";
}
$texto .="</tr></table><br />";
	//
	
	$texto .="<input type=\"hidden\" name=\"action\" value=\"newprescription\" >";
	$texto .="<input title=\"creer la nouvelle Option de torque\" type=\"submit\" name=\"submitbutton\" value=\"valider\" /><input title=\"revient a la page precedente\"  type=\"button\" name=\"cancel\" value=\"annuler\" onclick=\"history.back()\" />
	</form></center></div>";
	break;
	case "edit";
	$texto .="<h3>Modification d'option de torque</h3>";
	$req = new db();	
	if($_SESSION['error_categ']!=""){
		$texto .="<p class=\"affichage\">".$_SESSION['error_categ']."</p>";
	}
	
	//
	
	$req->findquery("SELECT * FROM torq_categ WHERE id_torq_categ='".$_GET['categ']."'");
	$torq_cat = $req->row();
	$texto .= "<form name=\"urg\" method=\"POST\" action=\"./save_option\">\n";
$texto .= "<div name=\"formuledent\" id=\"formuledent\"><center>
Categ: <input class=actif style=\"font-size:18px\" type=\"text\" name=\"categ\" value=\"$torq_cat->categ\" >
<input type=\"hidden\" name=\"id_torq_categ\"  value=\"".$torq_cat->id_torq_categ."\">
backcolor: <input class=actif style=\"width:50px;border-color:black;background-color:#$torq_cat->backgroundcolor;color:#$torq_cat->textcolor\" readonly  type=\"text\" name=\"backcolor\" value=\"$torq_cat->backgroundcolor\" id=\"backcolorpick\">
textcolor: <input class=actif style=\"width:50px;border-color:black;background-color:#$torq_cat->backgroundcolor;color:#$torq_cat->textcolor\"  readonly type=\"text\" name=\"textcolor\" value=\"$torq_cat->textcolor\" id=\"textcolorpick\">
nature: <select name=\"nature\" class=actif><option ".(($torq_cat->nature=="metal")?"SELECTED":"")." value=\"metal\">metal</option><option  ".(($torq_cat->nature=="ceram")?"SELECTED":"")." value=\"ceram\">ceram</option></select><br/><br/>
";
$texto .="<p id=\"colorpickerHolder\">Couleur de fond</p>";
$texto .="<p id=\"colorpickerHolder2\">Couleur du texte</p>";

$texto .="<table cellpadding=5 >
<tr height=\"40\"><th>dent<br />torque<br />id_produit</th>";
for ($i=17; $i > 10 ; $i--) {
	if($i==11){$texto .="<td class=\"cadran1\">";}
	else{$texto .="<td class=\"cadransup\">";}
	$lordre=dent_ordre($i);
	$req->findquery("SELECT * FROM torque WHERE dent=$i AND categ='".$_GET['categ']."'");
	$torq = $req->row();
	$texto .="$i<br /><input class=actif type=\"text\" size=4 name=\"torque_$i\" id=\"torque_$i\" value=\"".$torq->valeur."\" ><br /><select style=\"width:45px;font-size:10px\" name=\"id_produit_dent_$i\" id=\"id_produit_dent_$i\" >".selprod($torq->produit_id)."
	<input type=\"hidden\" name=\"id_torque_$i\" id=\"id_torque_$i\" value=\"$torq->id_torque\" >";
	$texto .="</td>";
}
for ($i=21; $i < 28 ; $i++) {
	$lordre=dent_ordre($i);
	$texto .="<td class=\"cadransup\">";
	$req->findquery("SELECT * FROM torque WHERE dent=$i AND categ='".$_GET['categ']."'");
	$torq = $req->row();
	$texto .="$i<br /><input class=actif type=\"text\" size=4 name=\"torque_$i\" id=\"torque_$i\" value=\"".$torq->valeur."\" ><br /><select style=\"width:45px;font-size:10px\" name=\"id_produit_dent_$i\" id=\"id_produit_dent_$i\" >".selprod($torq->produit_id)."
	<input type=\"hidden\" name=\"id_torque_$i\" id=\"id_torque_$i\" value=\"$torq->id_torque\" >";
	$texto .="</td>";
}
$texto .="</tr><tr><th>dent<br />torque<br />id_produit</th>";
for ($i=47; $i > 40 ; $i--) { 
	if($i==41){$texto .="<td valign=top class=\"cadranmilieu\">";}
	else{$texto .="<td valign=top >";}
	$lordre=dent_ordre($i);
	$req->findquery("SELECT * FROM torque WHERE dent=$i AND categ='".$_GET['categ']."'");
	$torq = $req->row();
	$texto .="$i<br /><input class=actif type=\"text\" size=4 name=\"torque_$i\" id=\"torque_$i\" value=\"".$torq->valeur."\" ><br /><select style=\"width:45px;font-size:10px\" name=\"id_produit_dent_$i\" id=\"id_produit_dent_$i\" >".selprod($torq->produit_id)."
	<input type=\"hidden\" name=\"id_torque_$i\" id=\"id_torque_$i\" value=\"$torq->id_torque\" >";
	$texto .="</td>";
}
for ($i=31; $i < 38 ; $i++) {
	$lordre=dent_ordre($i);
	$texto .="<td valign=top >";
$req->findquery("SELECT * FROM torque WHERE dent=$i AND categ='".$_GET['categ']."'");
	$torq = $req->row();
	$texto .="$i<br /><input class=actif type=\"text\" size=4 name=\"torque_$i\" id=\"torque_$i\" value=\"".$torq->valeur."\" ><br /><select style=\"width:45px;font-size:10px\" name=\"id_produit_dent_$i\" id=\"id_produit_dent_$i\" >".selprod($torq->produit_id)."
	<input type=\"hidden\" name=\"id_torque_$i\" id=\"id_torque_$i\" value=\"$torq->id_torque\" >";
	$texto .="</td>";
}
$texto .="</tr></table><br />";
	//
	
	$texto .="<input type=\"hidden\" name=\"action\" value=\"editprescription\" >";
	$texto .="<input title=\"creer la nouvelle option de torque\" type=\"submit\" name=\"submitbutton\" value=\"valider\" /><input title=\"revient a la page precedente\"  type=\"button\" name=\"cancel\" value=\"annuler\" onclick=\"history.back()\" />
	</form></center></div>";
	break;
	case "eff";
	$texto .="<h3>Suppression de produit</h3>";
	$texto .=  "<span class=\"affichage\">Attention vous allez effacer un produit, son stock ne pourra plus etre suivi </span><br /><br />";
	$req = new db();
	$req->findone('produit', $_GET['id']);
	$leprod = $req->row();
	$texto .="<form method=\"post\" action=\"./save_option\"><input type=\"hidden\" name=\"lid\" value=\"".$_GET['id']."\"><input type=\"hidden\" name=\"action\" value=\"effprod\"><span class=\"affichage\">Etes-vous sur de vouloir supprimer ce produit :</span > <b>$leprod->produit</b>
	<input type=\"submit\" name=\"submitbutton\" value=\"Supprimer\" id=\"submitbutton\">	<input type=\"button\" name=\"cancel\" value=\"annuler\" onclick=\"history.back()\"></form>";
	break;
	default;
	$reqpre = new db();
	$reqpre->findquery("SELECT * FROM torq_categ");
	$texto .= "editer:<ul>";
	while ($torq_cat = $reqpre->row()) {
			$texto .= "<li><a  style=\"color:#$torq_cat->textcolor;background-color:#$torq_cat->backgroundcolor;\" href=\"option?action=edit&categ=$torq_cat->id_torq_categ\">$torq_cat->categ $torq_cat->nature</a></li>\n";
		};

		$texto .= "</ul>";
	
	$texto .= "";
	break;
}

$texto .= "</div>
</body>
</html>";
echo $texto;
?>

