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
<body  OnLoad='foc()'>
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
	function foc(){
	  document.formu.categorie.focus();
	
}
-->
</SCRIPT>
";
include('../menu.php');
$texto .="<div style=\"padding:8px\">";
$texto .="<h1>Gestion Cat&eacute;gorie</h1>\n";
$mess = $_GET['mess'];
switch($mess){
	case "newcateg";
	$texto .= "<span class=\"affichage\">Nouvelle cat&eacute;gorie enregistr&eacute;e</span><br />";
	break;
	case "changecateg";
	$texto .= "<span class=\"affichage\">Cat&eacute;gorie modifi&eacute;e</span><br />";
	break;
	case "effacecateg";
	$texto .= "<span class=\"affichage\">Cat&eacute;gorie supprim&eacute;e</span><br />";
	break;
	case "securitecateg";
	$texto .= "<span class=\"affichage\">Cette Cat&eacute;gorie ne peut etre supprim&eacute;e</span><br />";
	break;
	default;
	break;
}


$texto.= "<div><ul class=\"menu\">";
include('./minimenu.php');
$texto.= "<ul class=\"menu\"><li class=\"menu\" ><a href=\"./categorie?action=add\" >Nouvelle categorie</a></li></ul>
			</div><br />";
switch($_GET['action']){
	case "add";
	$texto .="<h3>Cr&eacute;ation de categorie</h3>";
	$req = new db();
	$req->findquery("SELECT * FROM `titre` WHERE 1 ORDER BY classement");
	while($titre = $req->row()){
	$lestitres .= "<option value=\"$titre->id_titre\"> $titre->titre</option>\n";
	}
	$texto .="<form name=\"formu\" method=\"POST\" action=\"./save\"><input type=\"hidden\" name=\"action\" value=\"newcateg\"><input class=\"actif\" type=\"text\" name=\"categorie\" value=\"\" id=\"categorie\">
	<select name=\"lidtitre\">$lestitres</select><input type=\"submit\" name=\"submitbutton\" value=\"creer\">	<input type=\"button\" name=\"cancel\" value=\"annuler\" onClick=\"history.back()\"></form>";
	break;
	case "modif";
	$texto .="<h3>Modification de categorie</h3>";
	
	$texto .=  "<span class=\"affichage\">Attention vous allez modifier une categorie, les produits y appartenant changeront de chapitre</span><br /><br />";
	$req = new db();
	$req->findone('categ', $_GET['id']);
	$lacateg = $req->row();
	$req->findquery("SELECT * FROM `titre` WHERE 1 ORDER BY classement");
	while($titre = $req->row()){
	$lestitres .= "<option ";
	if($titre->id_titre==$lacateg->id_titre){$lestitres .="selected ";}
	$lestitres .="value=\"$titre->id_titre\"> $titre->titre</option>\n";
	}
	$texto .="<form method=\"POST\" action=\"./save\"><input type=\"hidden\" name=\"lid\" value=\"".$_GET['id']."\"><input type=\"hidden\" name=\"action\" value=\"modcateg\"><input class=\"actif\" type=\"text\" name=\"categorie\" value=\"$lacateg->categ\" id=\"categorie\">
	<select name=\"lidtitre\">$lestitres</select><input type=\"submit\" name=\"submitbutton\" value=\"modifier\" id=\"submitbutton\"><input type=\"button\" name=\"cancel\" value=\"annuler\" onClick=\"history.back()\"></form>";
	break;
	case "eff";
	$texto .="<h3>Suppression de categorie</h3>";
	$req = new db();
	$req->findone('categ', $_GET['id']);
	$lacateg = $req->row();
	$req->findquery("SELECT * FROM produit WHERE id_categ='".$_GET['id']."'");
	if($req->__get('numrows')==0){
	$texto .="<form method=\"POST\" action=\"./save\"><input type=\"hidden\" name=\"lid\" value=\"".$_GET['id']."\"><input type=\"hidden\" name=\"action\" value=\"effcateg\"><span class=\"affichage\">Etes-vous sur de vouloir supprimer cette categorie :</span > <b>$lacateg->categ</b>
	<input type=\"submit\" name=\"submitbutton\" value=\"Supprimer\" id=\"submitbutton\">	<input type=\"button\" name=\"cancel\" value=\"annuler\" onClick=\"history.back()\"></form>";
	}
	else{
		$texto .=  "<span class=\"affichage\">Attention vous ne pouvez pas effacer la cat&eacute;gorie:<b> $lacateg->categ</b></span><br /><br />
		<span class=\"affichage\">vous devez modifier la categorie des produits y appartenant.</span><br /><br />";
		$cat=$_GET['id'];
		$req->findquery("SELECT *
			FROM produit, titre, categ, fournisseur
			WHERE categ.id_categ = produit.id_categ
			AND categ.id_titre = titre.id_titre
			AND produit.id_fournisseur = fournisseur.id_fournisseur AND categ.id_categ=$cat ORDER BY categ.categ");
		$texto .= "<table cellspacing=\"0\" >
		<tr>
		<th class=\"listingprod\">titre</th>
		<th class=\"listingprod\">Categ</th>
		<th class=\"listingprod\">Produit</th>
		<th class=\"listingprod\">fournisseur</th>
		<th class=\"listingprod\">reference</th>
		<th class=\"listingprod\">condit.</th>
		<th class=\"listingprod\">prix</th>
		<th class=\"listingprod\">stock</th>
		<th class=\"listingprod\">stock mini</th>
		<th class=\"listingprod\">used</th>
		<th class=\"listingprod\">modif.</th>
		<th class=\"listingprod\">eff.</th>
		</tr>\n";
		$nblignemax = 1;
		while($produit = $req->row()){
				$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
				if(($produit->used=="1") && ($produit->stock<$produit->stock_mini)){
					$cololign = "class=\"stock\"";
				}
				if($produit->commande=="1"){
					$cololign = "class=\"bientotstock\"";
				}
				$texto .= "<tr $cololign align='center'>
				<td> $produit->titre</td>
				<td class=\"stock\"> $produit->categ</td>
				<td> $produit->produit</td>
				<td> $produit->fournisseur</td>
				<td> $produit->reference</td>
				<td> $produit->conditionnement</td>
				<td> $produit->prix</td>
				<td> <b>$produit->stock</b></td>
				<td> $produit->stock_mini</td>
				<td>";
				$texto .= (($produit->used=="1")?"<img border='0' src='../img/check.gif' alt='used'>":"<img border='0' src='../img/uncheck.gif' alt='unused'>");
				$texto .= " </td>
				<td><a href='produit?action=modif&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
				<td><a href='produit?action=eff&id=" .  $produit->id_produit . "'><img border='0' src='../img/erase.gif' alt='efface'></a></td>
				</tr>\n";
				$nblignemax++;
			}
		}
	break;
	case "only";
	$tit = $_GET['id'];
	$reqpre = new db();
	$reqpre->findquery("SELECT * FROM categ LEFT JOIN titre ON categ.id_titre=titre.id_titre  WHERE categ.id_titre=$tit ORDER BY categ.categ");
	$texto.= "<table cellspacing=\"0\" ><tr><th class=\"listingcateg\">id</th><th class=\"listingcateg\">Categories</th><th class=\"listingcateg\">Titre</th><th class=\"listingcateg\">modifier</th><th class=\"listingcateg\">effacer</th></tr>\n";
	$nblignemax = 1;
	while($categ = $reqpre->row()){
		$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
		$texto .= "<tr $cololign><td> $categ->id_categ</td><td><a href='produit?action=only&id=" .  $categ->id_categ . "'> $categ->categ</a></td><td> $categ->titre</td><td align='center'><a href='categorie?action=modif&id=" .  $categ->id_categ . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td><td align='center'><a href='categorie?action=eff&id=" .  $categ->id_categ . "'><img border='0' src='../img/erase.png' alt='efface'></a></td></tr>\n";
		$nblignemax++;
	}
		$texto .= "</table>";
	break;
	default;
	$reqpre = new db();
	$reqpre->findquery("SELECT * FROM categ LEFT JOIN titre ON categ.id_titre=titre.id_titre  WHERE 1 ORDER BY titre.titre");
	$texto.= "<table cellspacing=\"0\" ><tr><th class=\"listingcateg\">id</th><th class=\"listingcateg\">Categories</th><th class=\"listingcateg\">Titre</th><th class=\"listingcateg\">modifier</th><th class=\"listingcateg\">effacer</th></tr>\n";
	$nblignemax = 1;
	while($categ = $reqpre->row()){
		$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
		$texto .= "<tr $cololign><td>$categ->id_categ</td><td><a href='produit?action=only&id=" .  $categ->id_categ . "'> $categ->categ</a></td><td> $categ->titre</td><td align='center'><a href='categorie?action=modif&id=" .  $categ->id_categ . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td><td align='center'><a href='categorie?action=eff&id=" .  $categ->id_categ . "'><img border='0' src='../img/erase.png' alt='efface'></a></td></tr>\n";
		$nblignemax++;
	}
		$texto .= "</table>";
	break;
}

$texto .= "</div></body></html>";
echo $texto;
?>

