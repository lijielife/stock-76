<?php
require("../config.php");
require_once("../db.class.php");
session_start();
$send=(isset($_SESSION['send']))?$_SESSION['send']:"";
$mess=(isset($_GET['mess']))?$_GET['mess']:"";
$action=(isset($_GET['action']))?$_GET['action']:"";
$lacateg=(isset($_GET['categ']))?$_GET['categ']:"";
require("../fonction.php");
$date = date("d/m/Y");
setlocale(LC_TIME, 'fr_FR.utf8','fra');
switch ($action) {
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
<script type=\"text/javascript\" language=\"javascript\" src=\"../$Jquery\" charset=\"utf-8\"></script>
<script type=\"text/javascript\" language=\"javascript\" src=\"./js/jquery.qtip.min.js\" charset=\"utf-8\"></script>

<meta content=\"text/html; Charset=UTF-8\" http-equiv=\"Content-Type\" />
<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\" media=\"screen\" />

<title>
Gestion brackets en ligne: $rajout
</title>
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
	function foc(){
	  document.envoidossier.dossier.focus();
}
-->
</SCRIPT>
</head>
<body onload='foc()'>
";
$texto .="<script type=\"text/javascript\">

$(document).ready(function(){
		
			$('span.lesdents').each(function(){
	lidee = $(this).attr('id');
	$(this).qtip({
      content: { url: 'getbracket.php',
      data: { id: lidee },
      method: 'get'
   },
   show: 'mouseover',
   hide: 'mouseout',
   style: { 
      name: 'cream' 
   }
	});
	
		})
	
});
</script>";
$texto .="<SCRIPT LANGUAGE=\"JavaScript\">
<!--
function crochetplus(ladent){
var theform = document.forms[\"prescription\"];
	var champs = \"torque_\" + ladent;
	theform.elements[champs].value=theform.elements[champs].value + \"c\" ;
}
function choostorq(ladent,valeur,STD,lefond,letext,lanature,leprodid){
	var theform = document.forms[\"prescription\"];
	var champs = \"torque_\" + ladent;
var bag = \"bgcolor_\" + ladent;
var taxt = \"txtcolor_\" + ladent;
var nat = \"nature_\" + ladent;
var lacase= \"ladentacoller_\" + ladent;
var prad = \"produit_\" + ladent;

	
theform.elements[champs].value=valeur;
theform.elements[bag].value=lefond;
theform.elements[taxt].value=letext;
theform.elements[nat].value=lanature;
theform.elements[prad].value=leprodid;

	document.getElementById(lacase).className='tdlacase'+ STD;
}

-->
</SCRIPT>

<style type=\"text/css\" media=\"all\">
 <!--
td, td:hover, tr, tr:hover{
	background-color: transparent;
	color: inherit;}

";
$reqpre = new db();
	$reqpre->findquery("SELECT * FROM torq_categ");
	$tousselect = "td.tdselect0, td.tdcrochet, ";
		$texto .= "td.tdlacase0 {background-color:#FFFFFF;color:#000000;text-align:center;font-weight:bold;font-size:18px}\n";
		$texto .= "a.tdlacase0 {border:2px solid #eee;display:block;text-decoration:none;color:#eee;background-color:#FFF}\n";

	while ($torq_cat = $reqpre->row()) {
			$tousselect .= "td.tdselect".$torq_cat->id_torq_categ.", ";
			$texto .= "td.tdlacase".$torq_cat->id_torq_categ." {background-color:#".$torq_cat->backgroundcolor.";border:2px solid #".$torq_cat->textcolor.";color:#".$torq_cat->textcolor.";text-align:center;font-weight:bold;font-size:18px}\n";
			$texto .= "a.tdlacase".$torq_cat->id_torq_categ." {text-decoration:none;background-color:#".$torq_cat->backgroundcolor.";border:2px solid #".$torq_cat->textcolor.";color:#".$torq_cat->textcolor.";text-align:center;font-weight:bold;font-size:18px}\n";
			$texto .= "a.tdselect".$torq_cat->id_torq_categ." {padding:1px;display:block;text-decoration:none;background-color:#".$torq_cat->backgroundcolor.";border:2px solid #".$torq_cat->textcolor.";color:#".$torq_cat->textcolor.";}\n";
			$texto .= "a.tdselect".$torq_cat->id_torq_categ.":hover {padding:1px;display:block;text-decoration:none;color:#".$torq_cat->backgroundcolor.";border:2px solid #".$torq_cat->textcolor.";background-color:#".$torq_cat->textcolor.";}\n";
		};
$newtaille =strlen($tousselect)-2;
$tousselect = substr($tousselect, 0, $newtaille);
$texto .="$tousselect{height:15px; border:1px solid black;padding:0; text-align:center;}\n	
-->
</style>
";
include('../menu.php');
$texto .="<div style=\"padding:8px\">";
$texto .="<h1>Gestion bracket: $rajout</h1>\n";
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
	case "recuprod";
	$texto .= "<span class=\"affichage\">Produit re&ccedil;u</span><br /><br />";
	break;
	default;
	break;
}


$texto.= "<div><ul class=\"menu\">";
$texto .="<ul class=\"sousmenu\">
			<li class=\"menu\" ><a href=\"./index\" ><img style=\"vertical-align:top\" border=\"0\" src=\"../img/add.png\"> Prescription NEW</a></li>			</ul>
			<br />
			</div>";
			
switch($action){
	case "add";
if($_POST['dossier']==""){
header('location:./index'); 
exit;
};
$req = new db();
	$requi = new db();
	$texto .='<form name="prescription" method="POST" action="./save">
	<a name="debut">	Prescription actuelle dossier n&deg;  <b>'.$_POST['dossier'].'</b></a>
    <input type="hidden" class="actif"  name="dossier" id="dossier" value="'.$_POST['dossier'].'" >
		<input type="hidden" name="action" value="newprescription" />
    <br />';

//Resume
$texto .="<a name=resume></a>";
$dossier = $_POST['dossier'];
	$texto .='<table style="border-collapse:collapse" border="3" cellspacing="0" cellpadding="0">';
$requiqui = new db();
$rekiki = new db();
$newre3="SELECT dent, MAX( id_prescription ) as recentid FROM prescription WHERE dossier=$dossier AND torque !=  '' AND nature !=  '' GROUP BY ordre order BY ordre";
$requiqui->findquery($newre3);
$lenumbdeligne = $requiqui->__get('numrows');

if($lenumbdeligne!=""){
$texto .='<tr class="selecttorque"><th class="selecttorque">max<br />torq</th>';
$prescrip = $requiqui->row();
for ($i=17; $i > 10 ; $i--) {
	$rekiki->findupdate("SELECT * from prescription WHERE id_prescription='$prescrip->recentid'");
	$presq = $rekiki->row();
	if($i==11){$texto .="<td  class=\"dentcadran1\" >";}else{$texto .="<td class=\"dentcadransup\">";}
	if($presq->dent==$i){
	$texto .="<span class=\"lesdents\" id=\"$presq->produit_id\" style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:1px;color:#".$presq->txtcolor.";border: 2px solid #".$presq->txtcolor.";background-color:#".$presq->bgcolor."\">$presq->dent</span><span style='font-size:12px'>$presq->torque</span></td>\n";
	$lenumbdeligne=$lenumbdeligne-1;
	if($lenumbdeligne>0){$prescrip = $requiqui->row();}
	}
	else{
	$texto .="<span class=\"lesdents\" id=\"0\"  style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:1px;color:#eee;background-color:#fff;border:2px solid #eee;\">$i</span><span style='font-size:12px'>&nbsp;</span></td>\n";
	}
}

for ($i=21; $i < 28 ; $i++) {
	$rekiki->findupdate("SELECT * from prescription WHERE id_prescription=$prescrip->recentid");
	$presq = $rekiki->row();
	$texto .="<td class=\"dentcadransup\" >";
	if($presq->dent==$i){
  	$texto .="<span class=\"lesdents\" id=\"$presq->produit_id\"  style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:1px;color:#".$presq->txtcolor.";border: 2px solid #".$presq->txtcolor.";background-color:#".$presq->bgcolor."\">$presq->dent</span><span style='font-size:12px'>$presq->torque</span></td>\n";
	$lenumbdeligne=$lenumbdeligne-1;
		if($lenumbdeligne>0){$prescrip = $requiqui->row();}
	}
	else{
	$texto .="<span class=\"lesdents\" id=\"0\"  style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:1px;color:#eee;background-color:#fff;border:2px solid #eee;\">$i</span><span style='font-size:12px'>&nbsp;</span></td>\n";
	}
}

$texto .="<th class=\"selecttorque\">&nbsp;</th></tr>";
$texto .='<tr class="selecttorque" ><th class="selecttorque">mand<br />torq</th>';
	
for ($i=47; $i > 40 ; $i--) {
	$rekiki->findupdate("SELECT * from prescription WHERE id_prescription=$prescrip->recentid");
	$presq = $rekiki->row();
	if($i==41){$texto .="<td  class=\"dentcadran3\">";}
	else{$texto .="<td class=\"dentcadraninf\" >";}
	if($presq->dent==$i){
  	$texto .="<span class=\"lesdents\" id=\"$presq->produit_id\"  style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:1px;color:#".$presq->txtcolor.";border: 2px solid #".$presq->txtcolor.";background-color:#".$presq->bgcolor."\">$presq->dent</span><span style='font-size:12px'>$presq->torque</span></td>\n";
	$lenumbdeligne=$lenumbdeligne-1;
		if($lenumbdeligne>0){$prescrip = $requiqui->row();}
	}
	else{
	$texto .="<span class=\"lesdents\" id=\"0\"  style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:1px;color:#eee;background-color:#fff;border:2px solid #eee;\">$i</span><span style='font-size:12px'>&nbsp;</span></td>\n";
	}
}

for ($i=31; $i < 38 ; $i++) {
	$rekiki->findupdate("SELECT * from prescription WHERE id_prescription=$prescrip->recentid");
  	$presq = $rekiki->row();
	$texto .="<td class=\"dentcadraninf\" >";
  	if($presq->dent==$i){
  	$texto .="<span class=\"lesdents\" id=\"$presq->produit_id\"  style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:1px;color:#".$presq->txtcolor.";border: 2px solid #".$presq->txtcolor.";background-color:#".$presq->bgcolor."\">$presq->dent</span><span style='font-size:12px'>$presq->torque</span></td>\n";
	$lenumbdeligne=$lenumbdeligne-1;
		if($lenumbdeligne>0){if($i!=37){$prescrip = $requiqui->row();}}
	}
	else{
	$texto .="<span class=\"lesdents\" id=\"0\"  style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:1px;color:#eee;background-color:#fff;border:2px solid #eee;\">$i</span><span style='font-size:12px'>&nbsp;</span></td>\n";
	}
}
$texto .="<th class=\"selecttorque\">&nbsp;</th></tr>";
$texto .="<tr ><td colspan='16' style='border-top:2px solid black; border-bottom: 2px solid black;' >&nbsp;</td></tr>";

}
// fin resume
		
	$req->findquery("SELECT * FROM torq_categ ORDER BY classement ASC, nature ASC");
	$texto .= '';
	while($torq_cat = $req->row()) {
	$texto.='<tr class="selecttorque">';
	$lacateg= $torq_cat->categ;
	$lacolortext= $torq_cat->textcolor;
	$lacolorfond= $torq_cat->backgroundcolor;
	$lidcateg=$torq_cat->id_torq_categ;
	$lanature=$torq_cat->nature;
		$query = "SELECT * FROM torque WHERE ordre>=2 AND ordre<=15 AND categ='$lidcateg' ORDER BY categ, ordre";
		$textito = "";
		$all2 = "href='javascript:";
		$requi->findquery($query);
		while($torq = $requi->row()){
			if ($torq->valeur==""){
				$torq->valeur="";
				$laclasse="videselect";
			}
			else{$laclasse= "tdselect".$lidcateg;}
			if($torq->dent=="11"){$rajdedent="style=\"border-right: 3px solid #000;\"";}else{$rajdedent="";}
			$textito .="<td class=\"$laclasse\" $rajdedent><a class='$laclasse' title='".infos($torq->produit_id)."' onMouseOver=\"window.status='$torq->dent:$lanature &agrave; $torq->valeur'; return true;\" href='javascript:choostorq($torq->dent,\"".$torq->valeur."\",$lidcateg,\"$lacolorfond\",\"$lacolortext\",\"$lanature\",\"".$torq->produit_id."\");'>$torq->valeur</a></td>\n";

      $all3="choostorq($torq->dent,\"".$torq->valeur."\",$lidcateg,\"$lacolorfond\",\"$lacolortext\",\"$lanature\",\"".$torq->produit_id."\");";
	  if($torq->valeur==""){ $all3="choostorq($torq->dent,\"\",\"0\",\"\",\"\",\"\",\"\");";}
			$all2 .= $all3;
			};
			$textito .="<th class=\"selecttorque\">$torq_cat->nature</th>";
			$textito .="</tr>\n";
			
			$all2 .= "'";
			$texto .="<th class=\"selecttorque\" style=\"background-color:#$lacolorfond\">
			<a style=\"text-decoration:none;color:#$lacolortext;background-color:#$lacolorfond;display:block;\"  $all2 >$lacateg</a>
			</th>\n" . $textito;
			};
			
	
	$texto .="<tr><td colspan='16' >&nbsp;</td></tr>";
	$texto .='<tr class="selecttorque">';
	$texto .="<th class=\"selecttorque\">max<br />torq</th>";
for ($i=17; $i > 10 ; $i--) {
	
	$req->findquery("SELECT * FROM torque WHERE dent=$i AND categ='".$lacateg."'");
	$torq = $req->row();
  if($torq!="")
   {$laval=$torq->valeur;}
   else
   {$laval="";}
	if($i==11){$texto .="<td  class=\"dentcadran1\" >";}
	else{$texto .="<td class=\"dentcadransup\" >";}
	$lordre=dent_ordre($i);
	
	$texto .="<a id='ladentacoller_$i' class=\"lesdents\" style=\"display:block;\" href='javascript:choostorq($i,\"\",\"0\",\"\",\"\",\"\",\"\");'>$i</a>
	<input class=TQbk style=\"text-align:center\" type=\"text\" size=4 name=\"torque_$i\" id=\"torque_$i\" value=\"".$laval."\" >
	<input type=\"hidden\" name=\"nature_$i\" id=\"nature_$i\" value=\"\" >
	<input type=\"hidden\" name=\"bgcolor_$i\" id=\"bgcolor_$i\" value=\"\" >
	<input type=\"hidden\" name=\"txtcolor_$i\" id=\"txtcolor_$i\" value=\"\" >
	<input type=\"hidden\" name=\"produit_$i\" id=\"produit_$i\" value=\"\" >";
	$texto .="</td>";
	
}

for ($i=21; $i < 28 ; $i++) {
	$lordre=dent_ordre($i);
	$texto .="<td  class=\"dentcadransup\">";
	$req->findquery("SELECT * FROM torque WHERE dent=$i AND categ='".$lacateg."'");
	$torq = $req->row();
	if($torq!="")
   {$laval=$torq->valeur;}
   else
   {$laval="";}
	$texto .="<a class=\"lesdents\" id='ladentacoller_$i' style=\"display:block;\" href='javascript:choostorq($i,\"\",\"0\",\"\",\"\",\"\",\"\");'>$i</a>
	<input class=TQbk style=\"text-align:center\" type=\"text\" size=4 name=\"torque_$i\" id=\"torque_$i\" value=\"".$laval."\" >
	<input type=\"hidden\" name=\"nature_$i\" id=\"nature_$i\" value=\"\" >
	<input type=\"hidden\" name=\"bgcolor_$i\" id=\"bgcolor_$i\" value=\"\" >
	<input type=\"hidden\" name=\"txtcolor_$i\" id=\"txtcolor_$i\" value=\"\" >
	<input type=\"hidden\" name=\"produit_$i\" id=\"produit_$i\" value=\"\" >";
	$texto .="</td>";
	
}
$texto .="<th class=\"selecttorque\">&nbsp;</th>";
	$texto .="</tr>";
	$texto .='<tr class="selecttorque">';
	$texto .="<th class=\"selecttorque\">mand<br />torq</th>";	
for ($i=47; $i > 40 ; $i--) {
	
	$req->findquery("SELECT * FROM torque WHERE dent=$i AND categ='".$lacateg."'");
	$torq = $req->row();
	if($torq!="")
   {$laval=$torq->valeur;}
   else
   {$laval="";}
	if($i==41){$texto .="<td  class=\"dentcadran3\" >";}
	else{$texto .="<td  class=\"dentcadraninf\" >";}
	$lordre=dent_ordre($i);
	
	$texto .="<a class=\"lesdents\" id='ladentacoller_$i' style=\"display:block;\" href='javascript:choostorq($i,\"\",\"0\",\"\",\"\",\"\",\"\");'>$i</a>
	<input type=\"text\"   name=\"torque_$i\" id=\"torque_$i\" class=TQbk style=\"text-align:center\"  size=4  value=\"".$laval."\" >
	<input type=\"hidden\" name=\"nature_$i\" id=\"nature_$i\" value=\"\" >
	<input type=\"hidden\" name=\"bgcolor_$i\" id=\"bgcolor_$i\" value=\"\" >
	<input type=\"hidden\" name=\"txtcolor_$i\" id=\"txtcolor_$i\" value=\"\" >
	<input type=\"hidden\" name=\"produit_$i\" id=\"produit_$i\" value=\"\" >";
	$texto .="</td>";
	
}

for ($i=31; $i < 38 ; $i++) {
	$lordre=dent_ordre($i);
	$texto .="<td  class=\"dentcadraninf\">";
	$req->findquery("SELECT * FROM torque WHERE dent=$i AND categ='".$lacateg."'");
	$torq = $req->row();
		 if($torq!="")
   {$laval=$torq->valeur;}
   else
   {$laval="";}
	$texto .="<a class=\"lesdents\" id='ladentacoller_$i' style=\"display:block;\" href='javascript:choostorq($i,\"\",\"0\",\"\",\"\",\"\",\"\");'>$i</a>
	<input class=TQbk style=\"text-align:center\" type=\"text\" size=4 name=\"torque_$i\" id=\"torque_$i\" value=\"".$laval."\" >
	<input type=\"hidden\" name=\"nature_$i\" id=\"nature_$i\" value=\"\" >
	<input type=\"hidden\" name=\"bgcolor_$i\" id=\"bgcolor_$i\" value=\"\" >
	<input type=\"hidden\" name=\"txtcolor_$i\" id=\"txtcolor_$i\" value=\"\" >
	<input type=\"hidden\" name=\"produit_$i\" id=\"produit_$i\" value=\"\" >";
	$texto .="</td>";
}
$texto .="<th class=\"selecttorque\">&nbsp;</th>";
	$texto .="</tr>";
	$texto .="<tr><td colspan='16' >&nbsp;</td></tr>";

//torq mand
$req = new db();
$requi = new db();

	$req->findquery("SELECT * FROM torq_categ ORDER BY classement ASC");

while($torq_cat = $req->row()) {
	$texto.='<tr class="selecttorque">';
	$lacateg= $torq_cat->categ;
	$lacolortext= $torq_cat->textcolor;
	$lacolorfond= $torq_cat->backgroundcolor;
	$lidcateg=$torq_cat->id_torq_categ;
	$lanature=$torq_cat->nature;
		$query = "SELECT * FROM torque WHERE ordre>=18 AND ordre<=31 AND categ='$lidcateg' ORDER BY categ, ordre";
		$textito = "";
		$all2 = "href='javascript:";
		$requi->findquery($query);
		while($torq = $requi->row()){
			if ($torq->valeur==""){
				$torq->valeur="";
				$laclasse="videselect";
			}
			else{$laclasse= "tdselect".$lidcateg;}
			if($torq->dent=="11"){$rajdedent="style=\"border-right: 3px solid #000;\"";}else{$rajdedent="";}
			$textito .="<td class=\"$laclasse\" $rajdedent><a class='$laclasse' title='".infos($torq->produit_id)."' href='javascript:choostorq($torq->dent,\"".$torq->valeur."\",$lidcateg,\"$lacolorfond\",\"$lacolortext\",\"$lanature\",\"".$torq->produit_id."\");'>$torq->valeur</a></td>\n";
	
      $all3="choostorq($torq->dent,\"".$torq->valeur."\",$lidcateg,\"$lacolorfond\",\"$lacolortext\",\"$lanature\",\"".$torq->produit_id."\");";
	  if($torq->valeur==""){ $all3="choostorq($torq->dent,\"\",\"0\",\"\",\"\",\"\",\"\");";}
			$all2 .= $all3;
			
			};
			$textito .="<th class=\"selecttorque\">$torq_cat->nature</th>";
			$textito .="</tr>\n";
			
			$all2 .= "'";
			$texto .="<th class=\"selecttorque\" style=\"background-color:#$lacolorfond\">
			<a style=\"text-decoration:none;color:#$lacolortext;background-color:#$lacolorfond;display:block;\" $all2 >$lacateg</a>
			</th>" . $textito;
			};
//fin torq mand	

		$texto .='</table><br /><br />
     <input style="width:150px;position:relative;left:360px" type="submit" value="Valider">
    </form>';

//historique
	$reqpre = new db();
	$texto .= "<br />Dossier n&deg;: $dossier<br />";
	
	 $reque = $reqpre->findupdate("SELECT * FROM prescription WHERE dossier=$dossier ORDER BY date DESC, ordre");
  
	while ($prescr = $reqpre->row()){
	list ($ladateuxe, $lheure) = explode (" ", $prescr->date);
		list ($year, $month, $day) = explode ("-", $ladateuxe);
	$texto .= "<hr/> $day/$month/$year<br />";
	$texto .='<table style="border-collapse:collapse" border="3" cellspacing="0" cellpadding="0">
	<tr class="selecttorque">
	<th class="selecttorque">max<br />torq</th>';
	
for ($i=17; $i > 10 ; $i--) {
	if($i==11){$texto .="<td  class=\"dentcadran1\" >";}
	else{$texto .="<td class=\"dentcadransup\"";}
	if($prescr->torque==""){$prescr->torque= "&nbsp;";}
  $texto .="<span class=\"lesdents\" id=\"".$prescr->produit_id."\" style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:2px;color:#".$prescr->txtcolor.";border: 2px solid #".$prescr->txtcolor.";background-color:#".$prescr->bgcolor."\">$prescr->dent</span><span style='font-size:12px'>$prescr->torque</span>";
	$texto .="</td>\n";
	$prescr = $reqpre->row();
}

for ($i=21; $i < 28 ; $i++) {
	if($prescr->torque==""){$prescr->torque= "&nbsp;";}
	$texto .="<td class=\"dentcadransup\" >
  <span class=\"lesdents\" id=\"".$prescr->produit_id."\" style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:2px;color:#".$prescr->txtcolor.";border: 2px solid #".$prescr->txtcolor.";background-color:#".$prescr->bgcolor."\">$prescr->dent</span><span style='font-size:12px'>$prescr->torque</span>";
	$texto .="</td>\n";
	$prescr = $reqpre->row();
}
$texto .='<th class="selecttorque">&nbsp;</th>
	</tr>
	<tr class="selecttorque">
	<th class="selecttorque">mand<br />torq</th>';
	
	for ($i=47; $i > 40 ; $i--) {
	if($i==41){$texto .="<td  class=\"dentcadran3\">";}
	else{$texto .="<td class=\"dentcadraninf\" >";}
	if($prescr->torque==""){$prescr->torque= "&nbsp;";}
  $texto .="<span class=\"lesdents\" id=\"".$prescr->produit_id."\" style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:2px;color:#".$prescr->txtcolor.";border: 2px solid #".$prescr->txtcolor.";background-color:#".$prescr->bgcolor."\">$prescr->dent</span><span style='font-size:12px'>$prescr->torque</span>";
	$texto .="</td>\n";
	$prescr = $reqpre->row();
}

	for ($i=31; $i < 38 ; $i++) {
	if($prescr->torque==""){$prescr->torque= "&nbsp;";}
	$texto .="<td class=\"dentcadraninf\" >
  <span class=\"lesdents\" id=\"".$prescr->produit_id."\" style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:2px;color:#".$prescr->txtcolor.";border: 2px solid #".$prescr->txtcolor.";background-color:#".$prescr->bgcolor."\">$prescr->dent</span><span style='font-size:12px'>$prescr->torque</span>";
	$texto .="</td>\n";
	if($i!=37){$prescr = $reqpre->row();}
}
$texto .="<th class=\"selecttorque\">&nbsp;</th>
	</tr></table>";
  	}
// fin historique

	break;
	case "voir";
	$dossier=(isset($_GET['dossier']))?$_GET['dossier']:$_POST['dossier'];
// resume prescription
if($dossier!=""){
$requiqui = new db();
$rekiki = new db();
$newre3="SELECT dent, MAX( id_prescription ) as recentid FROM prescription WHERE dossier=$dossier AND torque !=  '' AND nature !=  '' GROUP BY ordre ORDER BY ordre";
$requiqui->findquery($newre3);
$lenumbdeligne = $requiqui->__get('numrows');

if($lenumbdeligne!=""){
$texto .='<table style="border:1px dotted #000;border-collapse:collapse" border="3" cellspacing="0" cellpadding="0">';
$texto .='<tr class="selecttorque"><th class="selecttorque">max<br />torq</th>';
$prescrip = $requiqui->row();
for ($i=17; $i > 10 ; $i--) {
	$rekiki->findupdate("SELECT * from prescription WHERE id_prescription=$prescrip->recentid");
	$presq = $rekiki->row();
	if($i==11){$texto .="<td  class=\"dentcadran1\" >";}else{$texto .="<td class=\"dentcadransup\"";}
	if($presq->dent==$i){
	$texto .="<span class=\"lesdents\" id=\"$presq->produit_id\"  style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:2px;color:#".$presq->txtcolor.";border: 2px solid #".$presq->txtcolor.";background-color:#".$presq->bgcolor."\">$presq->dent</span><span style='font-size:12px'>$presq->torque</span></td>\n";
	$prescrip = $requiqui->row();
	}
	else{
	$texto .="<span class=\"lesdents\" id=\"$presq->produit_id\"  style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:2px;color:#eee;background-color:#fff;border:2px solid #eee;\">$i</span><span style='font-size:12px'>&nbsp;</span></td>\n";
	}
}

for ($i=21; $i < 28 ; $i++) {
	$rekiki->findupdate("SELECT * from prescription WHERE id_prescription=$prescrip->recentid");
	$presq = $rekiki->row();
	$texto .="<td class=\"dentcadransup\" >";
	if($presq->dent==$i){
  	$texto .="<span class=\"lesdents\" id=\"$presq->produit_id\"  style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:2px;color:#".$presq->txtcolor.";border: 2px solid #".$presq->txtcolor.";background-color:#".$presq->bgcolor."\">$presq->dent</span><span style='font-size:12px'>$presq->torque</span></td>\n";
	$prescrip = $requiqui->row();
	}
	else{
	$texto .="<span class=\"lesdents\" id=\"$presq->produit_id\"  style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:2px;color:#eee;background-color:#fff;border:2px solid #eee;\">$i</span><span style='font-size:12px'>&nbsp;</span></td>\n";
	}
}

$texto .="<th class=\"selecttorque\">&nbsp;</th></tr>";
$texto .='<tr class="selecttorque"><th class="selecttorque">mand<br />torq</th>';
	
for ($i=47; $i > 40 ; $i--) {
	$rekiki->findupdate("SELECT * from prescription WHERE id_prescription=$prescrip->recentid");
	$presq = $rekiki->row();
	if($i==41){$texto .="<td  class=\"dentcadran3\">";}
	else{$texto .="<td class=\"dentcadraninf\" >";}
	if($presq->dent==$i){
  	$texto .="<span class=\"lesdents\" id=\"$presq->produit_id\"  style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:2px;color:#".$presq->txtcolor.";border: 2px solid #".$presq->txtcolor.";background-color:#".$presq->bgcolor."\">$presq->dent</span><span style='font-size:12px'>$presq->torque</span></td>\n";
	$prescrip = $requiqui->row();
	}
	else{
	$texto .="<span class=\"lesdents\" id=\"$presq->produit_id\"  style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:2px;color:#eee;background-color:#fff;border:2px solid #eee;\">$i</span><span style='font-size:12px'>&nbsp;</span></td>\n";
	}
}

for ($i=31; $i < 38 ; $i++) {
	$rekiki->findupdate("SELECT * from prescription WHERE id_prescription=$prescrip->recentid");
	$presq = $rekiki->row();
	$texto .="<td class=\"dentcadraninf\" >";
  	if($presq->dent==$i){
  	$texto .="<span class=\"lesdents\" id=\"$presq->produit_id\"  style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:2px;color:#".$presq->txtcolor.";border: 2px solid #".$presq->txtcolor.";background-color:#".$presq->bgcolor."\">$presq->dent</span><span style='font-size:12px'>$presq->torque</span></td>\n";
	if($i!=37){$prescrip = $requiqui->row();}
	}
	else{
	$texto .="<span class=\"lesdents\" id=\"$presq->produit_id\"  style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:2px;color:#".$presq->txtcolor.";background-color:#".$presq->bgcolor.";border:2px solid #".$presq->txtcolor.";\">$i</span><span style='font-size:12px'>&nbsp;</span></td>\n";
	}
}
$texto .="<th class=\"selecttorque\">&nbsp;</th>";
	$texto .="</tr></table>";
//historique
	$reqpre = new db();
	$texto .= "<br />Dossier n&deg;: $dossier<br />";
	
	 $reque = $reqpre->findupdate("SELECT * FROM prescription WHERE dossier=$dossier ORDER BY date DESC, ordre");
  
	while ($prescr = $reqpre->row()){
	list ($ladateuxe, $lheure) = explode (" ", $prescr->date);
		list ($year, $month, $day) = explode ("-", $ladateuxe);
	$texto .= "<hr/> $day/$month/$year<br />";
	$texto .='<table style="border-collapse:collapse" border="3" cellspacing="0" cellpadding="0">
	<tr class="selecttorque">
	<th class="selecttorque">max<br />torq</th>';
	
for ($i=17; $i > 10 ; $i--) {
	if($i==11){$texto .="<td  class=\"dentcadran1\" >";}
	else{$texto .="<td class=\"dentcadransup\"";}
	if($prescr->torque==""){$prescr->torque= "&nbsp;";}
  $texto .="<span class=\"lesdents\" id=\"$prescr->produit_id\"  style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:2px;color:#".$prescr->txtcolor.";border: 2px solid #".$prescr->txtcolor.";background-color:#".$prescr->bgcolor."\">$prescr->dent</span><span style='font-size:12px'>$prescr->torque</span>";
	$texto .="</td>\n";
	$prescr = $reqpre->row();
}

for ($i=21; $i < 28 ; $i++) {
	if($prescr->torque==""){$prescr->torque= "&nbsp;";}
	$texto .="<td class=\"dentcadransup\" >
  <span class=\"lesdents\" id=\"$prescr->produit_id\" style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:2px;color:#".$prescr->txtcolor.";border: 2px solid #".$prescr->txtcolor.";background-color:#".$prescr->bgcolor."\">$prescr->dent</span><span style='font-size:12px'>$prescr->torque</span>";
	$texto .="</td>\n";
	$prescr = $reqpre->row();
}
$texto .='<th class="selecttorque">&nbsp;</th>
	</tr>
	<tr class="selecttorque">
	<th class="selecttorque">mand<br />torq</th>';
	
	for ($i=47; $i > 40 ; $i--) {
	if($i==41){$texto .="<td  class=\"dentcadran3\">";}
	else{$texto .="<td class=\"dentcadraninf\" >";}
	if($prescr->torque==""){$prescr->torque= "&nbsp;";}
  $texto .="<span class=\"lesdents\" id=\"$prescr->produit_id\" style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:2px;color:#".$prescr->txtcolor.";border: 2px solid #".$prescr->txtcolor.";background-color:#".$prescr->bgcolor."\">$prescr->dent</span><span style='font-size:12px'>$prescr->torque</span>";
	$texto .="</td>\n";
	$prescr = $reqpre->row();
}

	for ($i=31; $i < 38 ; $i++) {
	if($prescr->torque==""){$prescr->torque= "&nbsp;";}
	$texto .="<td class=\"dentcadraninf\" >
  <span class=\"lesdents\" id=\"$prescr->produit_id\" style=\"width:40px;display:block;padding-right:3px;padding-left:3px;margin:2px;color:#".$prescr->txtcolor.";border: 2px solid #".$prescr->txtcolor.";background-color:#".$prescr->bgcolor."\">$prescr->dent</span><span style='font-size:12px'>$prescr->torque</span>";
	$texto .="</td>\n";
	if($i!=37){$prescr = $reqpre->row();}
}
$texto .="<th class=\"selecttorque\">&nbsp;</th>
	</tr></table>";
  	}

}else{
$texto.= "<p class=\"affichage\">le dossier n&deg; $dossier n'existe pas<br /> <a href=\"./index\">retour</a></p>";
}
}
else{
header('location:./index'); 
exit;
};
	break;
	case "edit";

	break;
	case "eff";
	break;
	
	case "search";

	break;
	default;
	$texto .= "<br /><form id=\"envoidossier\" name=\"envoidossier\" action=\"./index?action=add#debut\" method=\"POST\">
  N&deg; de dossier <input type=\"text\" name=\"dossier\" id=\"dossier\" class=\"actif\" />
  <input type=\"submit\" value=\"creer prescription\"></form>";
	break;
}
$texto .= '<div class="qtip qtip-stylename">
   <div class="qtip-tip" rel="cornerValue"></div>
   <div class="qtip-wrapper">
      <div class="qtip-contentWrapper">
         <div class="qtip-title"> 
            <div class="qtip-button"></div> 
         </div>
         <div class="qtip-content"></div>
      </div>
   </div>
</div>';
$texto .= "</div>
</body>
</html>";
echo $texto;
?>