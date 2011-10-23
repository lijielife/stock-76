<?php
//--les indispensables, class DB, les fonctions
require_once("../db.class.php");
require("./function.php");
session_start();
$lapaga = "produit";
//-- fin des insdispensables

//mis en place du model
include("./model/$lapaga.inc");

$laction=(isset($_GET['action']))?$_GET['action']:"";
switch ($laction) {
	case 'add';
	include("./include/$lapaga/add.inc");
	include("./include/$lapaga/addon.inc");
	$tpl = template($tpl, 'addon', $plugin);
	$load = "foc()";
	$tpl = template($tpl, 'onload', $load);
		break;
	case 'rechercher';
		include("./include/$lapaga/addon.inc");
		include("./include/$lapaga/rechercher.inc");
		$tpl = template($tpl, 'addon', $plugin);
	break;
	case 'view';
		include("./include/$lapaga/view.inc");
		include("./include/$lapaga/viewon.inc");
	$tpl = template($tpl, 'addon', $plugin);
	break;
	case 'compare';
		include("./include/$lapaga/compare.inc");
		include("./include/$lapaga/viewon.inc");
	$tpl = template($tpl, 'addon', $plugin);
	break;
	case 'member';
		include("./include/$lapaga/member.inc");
		include("./include/$lapaga/viewon.inc");
	$tpl = template($tpl, 'addon', $plugin);
	break;
	default;
	//	include("./include/$lapaga/addon.inc");
		include("./vue/$lapaga.inc");
//		$tpl = template($tpl, 'addon', $plugin);
		
		
$reqpre = new db();
$reqpre->findquery("SELECT * 
FROM produit, titre, categ, fournisseur
WHERE categ.id_categ = produit.id_categ
AND categ.id_titre = titre.id_titre
AND produit.id_fournisseur = fournisseur.id_fournisseur
AND produit.used=1
ORDER BY categ.categ ASC");
$total = 0;
//make form cherche
$output.= "<form name=\"cherch\" action=\"./produit?action=search\" method=\"post\" accept-charset=\"utf-8\">
<p>	<input  autocomplete=\"off\" class=\"actif\" type=\"text\" id=\"txt_search\" name=\"search\" value=\"\"><input type=\"submit\" value=\"rechercher\"></p>
</form>
<form action=\"./produit?action=commander\" method=\"post\">
<span id=\"suggest\">";
//make tableau
$output .="<table cellspacing=\"0\" ><tr>";
$nbcoll= "14";
	//make 1ere ligne
$output .= "";
$lignentete = new Entete("titre", "categ", "produit", "fourn", "reference", "condit.", "prix", "stock", "stk_mini", "QT_CMD", "CMD_button", "date", "@modif", "&#8364;");
$output .= $lignentete->whatwhat;
$output .= "</tr>";
	//make replissage ligne selon requete


$nblignemax = 1;
// while($produit = $reqpre->row()){
// 	
// 	
// }
		
		
		
	break;
}
//mis en place template
$tpl = createmplate($lapaga);
$letitre= "stock";
$hightitre = ucfirst("gestion");
$tpl = template($tpl, 'letitre', $letitre);
$tpl = template($tpl, 'hightitre', $hightitre);
include("../menu.php");
$tpl = template($tpl, 'lemenu', $texto);
$tpl = template($tpl, 'lecorps', $output);
//include("./include/all/lepied.inc");
$tpl = template($tpl, 'lepied', $foot);
$tpl= finishtemplate($tpl);
echo $tpl;

?>
