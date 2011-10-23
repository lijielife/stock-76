<?php
require("../config.php");
require_once("../db.class.php");
$date = date("d/m/Y");
setlocale(LC_TIME, "fr_FR");
$dadate = strftime("%A %d %B %Y");
$texto = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
	\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
$texto .= "<html xmlns=\"http://www.w3.org/1777/xhtml\"
	    xml:lang=\"fr\"
	    lang=\"fr\"
	    dir=\"ltr\">
<head>
<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\" media=\"screen\" />
<meta content=\"text/html; Charset=UTF-8\" http-equiv=\"Content-Type\" />
<title>
Gestion Stock en ligne: titre
</title>
</head>
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
	function foc(){
	  document.formu.titre.focus();
	
}
-->
</SCRIPT>

<body  OnLoad='foc()'>";
include('../menu.php');
$texto .="<div style=\"padding:8px\">";
$texto .="<h1>Gestion titre</h1>\n";
$mess = $_GET['mess'];
switch($mess){
	case "newtit";
	$texto .= "<span class=\"affichage\">Nouveau titre enregistr&eacute;</span><br />";
	break;
	case "changetit";
	$texto .= "<span class=\"affichage\">Titre modifi&eacute;</span><br />";
	break;
	case "effacetit";
	$texto .= "<span class=\"affichage\">Titre supprim&eacute;</span><br />";
	break;
	default;
	break;
}


$texto.= "<div><ul class=\"menu\">";
include('./minimenu.php');
$texto.= "<ul class=\"menu\"><li class=\"menu\" ><a href=\"./titre?action=add\" >Nouveau Titre</a></li></ul>
			</div><br />";
switch($_GET['action']){
	case "add";
	$texto .="<h3>Cr&eacute;ation d'un titre</h3>";
	$texto .="<form name=\"formu\" method=\"POST\" action=\"./save\"><input type=\"hidden\" name=\"action\" value=\"newtitre\"><input class=\"actif\" type=\"text\" name=\"titre\" value=\"\" id=\"titre\">
	<input type=\"submit\" name=\"submitbutton\" value=\"creer\">	<input type=\"button\" name=\"cancel\" value=\"annuler\" onClick=\"history.back()\"></form>";
	break;
	case "modif";
	$texto .="<h3>Modification d'un titre</h3>";
	$texto .=  "<span class=\"affichage\">Attention vous allez modifier un titre, les produits et categorie y appartenant changeront de chapitre</span><br /><br />";
	$req = new db();
	$req->findone('titre', $_GET['id']);
	$letitre = $req->row();
	$texto .="<form method=\"POST\" action=\"./save\"><input type=\"hidden\" name=\"lid\" value=\"".$_GET['id']."\"><input type=\"hidden\" name=\"action\" value=\"modtitre\"><input class=\"actif\" type=\"text\" name=\"titre\" value=\"$letitre->titre\" id=\"titre\">
	<input type=\"submit\" name=\"submitbutton\" value=\"modifier\" id=\"submitbutton\"><input type=\"button\" name=\"cancel\" value=\"annuler\" onClick=\"history.back()\"></form>";
	break;
	case "eff";
	$texto .="<h3>Suppression d'un titre</h3>";
	$req = new db();
	$req->findone('titre', $_GET['id']);
	$letitre = $req->row();
	$req->findquery("SELECT * FROM categ WHERE id_titre='".$_GET['id']."'");
	if($req->__get('numrows')==0){
	$texto .="<form method=\"POST\" action=\"./save\"><input type=\"hidden\" name=\"lid\" value=\"".$_GET['id']."\"><input type=\"hidden\" name=\"action\" value=\"efftitre\"><span class=\"affichage\">Etes-vous sur de vouloir supprimer ce titre :</span > <b>$letitre->titre</b>
	<input type=\"submit\" name=\"submitbutton\" value=\"Supprimer\" id=\"submitbutton\">	<input type=\"button\" name=\"cancel\" value=\"annuler\" onClick=\"history.back()\"></form>";
	}
	else{
		$texto .=  "<span class=\"affichage\">Attention vous ne pouvez pas effacer la cat&eacute;gorie:<b> $letitre->titre</b></span><br /><br />
		<span class=\"affichage\">vous devez modifier le titre des categories y appartenant.</span><br /><br />";
		$tit=$_GET['id'];
		$req->findquery("SELECT *
			FROM titre, categ
			WHERE categ.id_titre = titre.id_titre
		 	AND categ.id_titre=$tit ORDER BY categ.id_categ");
		$texto.= "<table cellspacing=\"0\" >
		<tr>
		<th class=\"listingcateg\">id</th>
		<th class=\"listingcateg\">Categories</th>
		<th class=\"listingcateg\">Titre</th>
		<th class=\"listingcateg\">modifier</th>
		<th class=\"listingcateg\">effacer</th>
		</tr>\n";
	
		$nblignemax = 1;
		while($categ = $req->row()){
			$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
			$texto .= "<tr $cololign><td>$categ->id_categ</td><td><a href='produit?action=only&id=" .  $categ->id_categ . "'> $categ->categ</a></td><td> $categ->titre</td><td align='center'><a href='categorie?action=modif&id=" .  $categ->id_categ . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td><td align='center'><a href='categorie?action=eff&id=" .  $categ->id_categ . "'><img border='0' src='../img/erase.png' alt='efface'></a></td></tr>\n";
			$nblignemax++;
		}
			$texto .= "</table>";
		}
	break;
	default;
	$reqpre = new db();
	$say = $reqpre->findquery("SELECT * FROM  `titre` WHERE 1 ORDER BY classement");
	$texto.= "<table cellspacing=\"0\" class=\"listing\"><tr><th class=\"listingtitre\">id</th><th class=\"listingtitre\">Titre</th><th class=\"listingtitre\">classement</th><th class=\"listingtitre\">modifier</th><th class=\"listingtitre\">effacer</th></tr>\n";
	$nblignemax = 1;
	while($titre = $reqpre->row()){
	$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
	$texto .= "<tr $cololign><td> $titre->id_titre</td><td><a href='categorie?action=only&id=" .  $titre->id_titre . "'> $titre->titre</a></td><td align='center'> $titre->classement</td><td align='center'><a href='titre?action=modif&id=" .  $titre->id_titre . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td><td align='center'><a href='titre?action=eff&id=" .  $titre->id_titre . "'><img border='0' src='../img/erase.png' alt='efface'></a></td></tr>\n";
	$nblignemax++;}
	$texto .= "</table>";
	break;
}


$texto .= "</div></body></html>";
echo $texto;
?>

