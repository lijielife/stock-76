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

<title>
Gestion brackets en ligne: Options: $rajout
</title>
</head>
<body>
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
	function foc(){
	  document.urg.num_dossier.focus();
	
}

function choostorq(ladent,valeur,STD,lefond,letext,lanature){
	var theform = document.forms[\"prescription\"];
	var champs = \"torque_\" + ladent;
var bag = \"bgcolor_\" + ladent;
var taxt = \"txtcolor_\" + ladent;
var nat = \"nature_\" + ladent;
var lacase= \"ladentacoller_\" + ladent;
	
theform.elements[champs].value=valeur;
theform.elements[bag].value=lefond;
theform.elements[taxt].value=letext;
theform.elements[nat].value=lanature;


	document.getElementById(lacase).className='tdlacase'+ STD;
}

function Addent(ladent) {

  var theform = document.forms[\"urg\"];
  var champs = \"dent\" + ladent;
  var calq= \"schemdent\" + ladent;
 if(theform.elements[champs].value==\"\")
 {theform.elements[champs].value=ladent;
document.getElementById(calq).className='denton';
foc();
  }
 else
 {theform.elements[champs].value=\"\";
document.getElementById(calq).className='dentoff';
foc();
 }
}

function formu() {

	var theform = document.forms[\"urg\"];
	var chant = \"leprob\";
	
	var fracture = \"fracture\";
	var bk = \"lesbk\";
	var cause = \"cause\";
	var acte = \"acte\";
	
 if(theform.elements[chant].value==\"1\" || theform.elements[chant].value==\"2\"){
	document.getElementById('formuledent').style.display = \"block\";
		
	theform.elements[fracture].disabled=false;
	theform.elements[bk].disabled=false;
	theform.elements[cause].disabled=false;
	document.getElementById('cause').className='actif';
	foc();
 }
 else
 {
	document.getElementById('formuledent').style.display = \"none\";
	
	theform.elements[fracture].disabled=true;
	theform.elements[bk].disabled=true;
	theform.elements[cause].disabled=true;
	document.getElementById('cause').className='inactif';
	foc();
 }
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
	$tousselect = "td.tdselect0, ";
		$texto .= "td.tdlacase0 {background-color:#FFFFFF;color:#000000;text-align:center;font-weight:bold;font-size:18px}\n";
		$texto .= "a.tdlacase0 {display:block;text-decoration:none;color:#eee;background-color:#FFF}\n";

	while ($torq_cat = $reqpre->row()) {
			$tousselect .= "td.tdselect".$torq_cat->id_torq_categ.", ";
			$texto .= "td.tdlacase".$torq_cat->id_torq_categ." {background-color:#".$torq_cat->backgroundcolor.";color:#".$torq_cat->textcolor.";text-align:center;font-weight:bold;font-size:18px}\n";
			$texto .= "a.tdlacase".$torq_cat->id_torq_categ." {text-decoration:none;background-color:#".$torq_cat->backgroundcolor.";color:#".$torq_cat->textcolor.";text-align:center;font-weight:bold;font-size:18px}\n";
			$texto .= "a.tdselect".$torq_cat->id_torq_categ." {padding:1px;display:block;text-decoration:none;background-color:#".$torq_cat->backgroundcolor.";color:#".$torq_cat->textcolor.";}\n";
			$texto .= "a.tdselect".$torq_cat->id_torq_categ.":hover {padding:1px;display:block;text-decoration:none;color:#".$torq_cat->backgroundcolor."; background-color:#".$torq_cat->textcolor.";}\n";
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
			<li class=\"menu\" ><a href=\"./index\" ><img style=\"vertical-align:top\" border=\"0\" src=\"../img/add.png\"> Prescription NEW</a> | </li>
			<li class=\"sousmenu\" ><a href=\"./option\" >Option</a></li>
			</ul>
			<br />
			</div>";
			
switch($_GET['action']){
	case "add";
if($_POST['dossier']==""){
header('location:./index'); 
exit;
};
$req = new db();
	$requi = new db();
	$texto .='<form name="prescription" method="POST" action="./save"><table style="border-collapse:collapse" border="3" cellspacing="0" cellpadding="0">
		N&deg; dossier <input type="text" class="actif" name="dossier" id="dossier" value="'.$_POST['dossier'].'" >
		<input type="hidden" name="action" value="newprescription" />
		<br />';
		
	$req->findquery("SELECT * FROM torq_categ ORDER BY 'nature'");
	$texto .= "<br />";
	while($torq_cat = $req->row()) {
	$texto.='<tr class="selecttorque">';
	$lacateg= $torq_cat->categ;
	$lacolortext= $torq_cat->textcolor;
	$lacolorfond= $torq_cat->backgroundcolor;
	$lidcateg=$torq_cat->id_torq_categ;
	$lanature=$torq_cat->nature;
		$query = "SELECT * FROM torque WHERE ordre>=2 AND ordre<=15 AND categ='$lacateg' ORDER BY categ, ordre";
		$textito = "";
		$all2 = "onclick='";
		$requi->findquery($query);
		while($torq = $requi->row()){
			if ($torq->valeur==""){
				$torq->valeur="";
				$laclasse="videselect";
			}
			else{$laclasse= "tdselect".$lidcateg;}
			if($torq->dent=="11"){$rajdedent="style=\"border-right: 3px solid #000;\"";}else{$rajdedent="";}
			$textito .="<td class=\"$laclasse\" $rajdedent><a class='$laclasse' href=\"#\" onclick='choostorq($torq->dent,\"".$torq->valeur."\",$lidcateg,\"$lacolorfond\",\"$lacolortext\",\"$lanature\");'>$torq->valeur</a></td>\n";
			if($torq->valeur==""){
      $lidlidcat = 0;}
      else{$lidlidcat=$lidcateg;}
      $all2 .="choostorq($torq->dent,\"".$torq->valeur."\",$lidlidcat,\"$lacolorfond\",\"$lacolortext\",\"$lanature\");";
			
			};
			$textito .="<th class=\"selecttorque\">$torq_cat->nature</th>";
			$textito .="</tr>\n";
			
			$all2 .= "'";
			$texto .="<th class=\"selecttorque\" style=\"background-color:#$lacolorfond\">
			<a style=\"text-decoration:none;color:#$lacolortext;background-color:#$lacolorfond;display:block;\" href=\"#\" $all2 >$lacateg</a>
			</th>\n" . $textito;
			};
			
	
	$texto .="<tr><td colspan='16' >&nbsp;</td></tr>";
	$texto .='<tr class="selecttorque">';
	$texto .="<th class=\"selecttorque\">max<br />torq</th>";
for ($i=17; $i > 10 ; $i--) {
	
	$req->findquery("SELECT * FROM torque WHERE dent=$i AND categ='".$_GET['categ']."'");
	$torq = $req->row();
	
	if($i==11){$texto .="<td  class=\"dentcadran1\" >";}
	else{$texto .="<td class=\"dentcadransup\" >";}
	$lordre=dent_ordre($i);
	
	$texto .="<a href=\"#\" id='ladentacoller_$i' class=\"lesdents\" style=\"display:block;\" onclick='choostorq($i,\"\",\"0\",\"\",\"\",\"\");'>$i</a>
	<input class=TQbk style=\"text-align:center\" type=\"text\" size=4 name=\"torque_$i\" id=\"torque_$i\" value=\"".$torq->valeur."\" >
	<input type=\"hidden\" name=\"id_torque_$i\" id=\"id_torque_$i\" value=\"$torq->id_torque\" >
	<input type=\"hidden\" name=\"nature_$i\" id=\"nature_$i\" value=\"\" >
	<input type=\"hidden\" name=\"bgcolor_$i\" id=\"bgcolor_$i\" value=\"\" >
	<input type=\"hidden\" name=\"txtcolor_$i\" id=\"txtcolor_$i\" value=\"\" >
	<input type=\"hidden\" name=\"produit_$i\" id=\"produit_$i\" value=\"$torq->produit_id\" >";
	$texto .="</td>";
}

for ($i=21; $i < 28 ; $i++) {
	$lordre=dent_ordre($i);
	$texto .="<td  class=\"dentcadransup\">";
	$req->findquery("SELECT * FROM torque WHERE dent=$i AND categ='".$_GET[categ]."'");
	$torq = $req->row();
	$texto .="<a href=\"#\" class=\"lesdents\" id='ladentacoller_$i' style=\"display:block;\" onclick='choostorq($i,\"\",\"0\",\"\",\"\",\"\");'>$i</a>
	<input class=TQbk style=\"text-align:center\" type=\"text\" size=4 name=\"torque_$i\" id=\"torque_$i\" value=\"".$torq->valeur."\" >
	<input type=\"hidden\" name=\"id_torque_$i\" id=\"id_torque_$i\" value=\"$torq->id_torque\" >
	<input type=\"hidden\" name=\"nature_$i\" id=\"nature_$i\" value=\"\" >
	<input type=\"hidden\" name=\"bgcolor_$i\" id=\"bgcolor_$i\" value=\"\" >
	<input type=\"hidden\" name=\"txtcolor_$i\" id=\"txtcolor_$i\" value=\"\" >
	<input type=\"hidden\" name=\"produit_$i\" id=\"produit_$i\" value=\"$torq->produit_id\" >";
	$texto .="</td>";
}
$texto .="<th class=\"selecttorque\">&nbsp;</th>";
	$texto .="</tr>";
	$texto .='<tr class="selecttorque">';
	$texto .="<th class=\"selecttorque\">mand<br />torq</th>";	
for ($i=47; $i > 40 ; $i--) {
	
	$req->findquery("SELECT * FROM torque WHERE dent=$i AND categ='".$_GET['categ']."'");
	$torq = $req->row();
	
	if($i==41){$texto .="<td  class=\"dentcadran3\" >";}
	else{$texto .="<td  class=\"dentcadraninf\" >";}
	$lordre=dent_ordre($i);
	
	$texto .="<a href=\"#\" class=\"lesdents\" id='ladentacoller_$i' style=\"display:block;\" onclick='choostorq($i,\"\",\"0\",\"\",\"\",\"\");'>$i</a>
	<input type=\"text\"   name=\"torque_$i\" id=\"torque_$i\" class=TQbk style=\"text-align:center\"  size=4  value=\"".$torq->valeur."\" >
	<input type=\"hidden\" name=\"nature_$i\" id=\"nature_$i\" value=\"\" >
	<input type=\"hidden\" name=\"bgcolor_$i\" id=\"bgcolor_$i\" value=\"\" >
	<input type=\"hidden\" name=\"txtcolor_$i\" id=\"txtcolor_$i\" value=\"\" >
	<input type=\"hidden\" name=\"produit_$i\" id=\"produit_$i\" value=\"$torq->produit_id\" >
	";
//<input type=\"hidden\" name=\"id_torque_$i\" id=\"id_torque_$i\" value=\"$torq->id_torque\" >
	$texto .="</td>";
}

for ($i=31; $i < 38 ; $i++) {
	$lordre=dent_ordre($i);
	$texto .="<td  class=\"dentcadraninf\">";
	$req->findquery("SELECT * FROM torque WHERE dent=$i AND categ='".$_GET[categ]."'");
	$torq = $req->row();
	$texto .="<a href=\"#\" class=\"lesdents\" id='ladentacoller_$i' style=\"display:block;\" onclick='choostorq($i,\"\",\"0\",\"\",\"\",\"\");'>$i</a>
	<input class=TQbk style=\"text-align:center\" type=\"text\" size=4 name=\"torque_$i\" id=\"torque_$i\" value=\"".$torq->valeur."\" >
	<input type=\"hidden\" name=\"id_torque_$i\" id=\"id_torque_$i\" value=\"$torq->id_torque\" >
	<input type=\"hidden\" name=\"nature_$i\" id=\"nature_$i\" value=\"\" >
	<input type=\"hidden\" name=\"bgcolor_$i\" id=\"bgcolor_$i\" value=\"\" >
	<input type=\"hidden\" name=\"txtcolor_$i\" id=\"txtcolor_$i\" value=\"\" >
	<input type=\"hidden\" name=\"produit_$i\" id=\"produit_$i\" value=\"$torq->produit_id\" >";
	$texto .="</td>";
}
$texto .="<th class=\"selecttorque\">&nbsp;</th>";
	$texto .="</tr>";
	$texto .="<tr><td colspan='16' >&nbsp;</td></tr>";

//torq mand
$req = new db();
$requi = new db();

	$req->findquery("SELECT * FROM torq_categ ORDER BY 'nature'");

while($torq_cat = $req->row()) {
	$texto.='<tr class="selecttorque">';
	$lacateg= $torq_cat->categ;
	$lacolortext= $torq_cat->textcolor;
	$lacolorfond= $torq_cat->backgroundcolor;
	$lidcateg=$torq_cat->id_torq_categ;
	$lanature=$torq_cat->nature;
		$query = "SELECT * FROM torque WHERE ordre>=18 AND ordre<=31 AND categ='$lacateg' ORDER BY categ, ordre";
		$textito = "";
		$all2 = "onclick='";
		$requi->findquery($query);
		while($torq = $requi->row()){
			if ($torq->valeur==""){
				$torq->valeur="";
				$laclasse="videselect";
			}
			else{$laclasse= "tdselect".$lidcateg;}
			if($torq->dent=="11"){$rajdedent="style=\"border-right: 3px solid #000;\"";}else{$rajdedent="";}
			$textito .="<td class=\"$laclasse\" $rajdedent><a class='$laclasse' href=\"#\" onclick='choostorq($torq->dent,\"".$torq->valeur."\",$lidcateg,\"$lacolorfond\",\"$lacolortext\",\"$lanature\");'>$torq->valeur</a></td>\n";
			if($torq->valeur==""){
      $lidlidcat = 0;}
      else{$lidlidcat=$lidcateg;}
      $all2 .="choostorq($torq->dent,\"".$torq->valeur."\",$lidlidcat,\"$lacolorfond\",\"$lacolortext\",\"$lanature\");";
			
			};
			$textito .="<th class=\"selecttorque\">$torq_cat->nature</th>";
			$textito .="</tr>\n";
			
			$all2 .= "'";
			$texto .="<th class=\"selecttorque\" style=\"background-color:#$lacolorfond\">
			<a style=\"text-decoration:none;color:#$lacolortext;background-color:#$lacolorfond;display:block;\" href=\"#\" $all2 >$lacateg</a>
			</th>" . $textito;
			};
//fin torq mand	

		$texto .='</table><br /><br />
     <input style="width:150px;position:relative;left:360px" type="submit" value="Valider">
    </form>';
	break;
	case "voir";
	$texto .="coucou";
	break;
	case "edit";

	break;
	case "eff";
	break;
	
	case "search";

	break;
	default;
	$texto .= "<br /><form id=\"envoidossier\" action=\"./index?action=add\" method=\"POST\">
  N&deg; de dossier <input type=\"text\" name=\"dossier\" id=\"dossier\" class=\"actif\" />
  <input type=\"submit\" value=\"creer prescription\">
<input type=\"button\" value=\"voir le dossier\" onclick=\"this.form.action='./index?action=voir';this.form.submit()\"></form>";
	break;
}

$texto .= "</div>
</body>
</html>";
echo $texto;
?>