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
Gestion Stock en ligne: Fournisseur
</title>
</head>
<body  OnLoad='foc()'>
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
	function foc(){
	  document.formu.fournisseur.focus();
	
}
-->
</SCRIPT>";
include('../menu.php');
$texto .="<div style=\"padding:8px\">";
$texto .="<h1>Gestion Fournisseur</h1>\n";
$mess = $_GET['mess'];
switch($mess){
	case "newfourn";
	$texto .= "<span class=\"affichage\">Nouveau Fournisseur enregistr&eacute;</span><br />";
	break;
	case "changefourn";
	$texto .= "<span class=\"affichage\">Fournisseur modifi&eacute;</span><br />";
	break;
	case "effacefourn";
	$texto .= "<span class=\"affichage\">Fournisseur supprim&eacute;</span><br />";
	break;
	default;
	break;
}


$texto.= "<div><ul class=\"menu\">";
include('./minimenu.php');
$texto.= "<ul class=\"menu\"><li class=\"menu\" ><a href=\"./fournisseur?action=add\" >Nouveau Fournisseur</a></li></ul>
			</div><br />";
switch($_GET['action']){
	case "add";
	$texto .="<h3>Cr&eacute;ation d'un fournisseur</h3>";
	$texto .="<form name=\"formu\" method=\"POST\" action=\"./save\"><input type=\"hidden\" name=\"action\" value=\"newfourn\">
	<label for=\"fournisseur\">Fournisseur : </label><input class=\"actif\" type=\"text\" name=\"fournisseur\" value=\"\" id=\"fournisseur\"><br />
	<label for=\"nom\">Nom : </label><input class=\"actif\" type=\"text\" name=\"nom\" value=\"\" id=\"nom\"><br />
	<label for=\"prenom\">Pr&eacute;nom : </label><input class=\"actif\" type=\"text\" name=\"prenom\" value=\"\" id=\"prenom\"><br />
	<label for=\"adresse\">Adresse : </label><textarea rows=4 class=\"actif\"  name=\"adresse\" value=\"\" id=\"adresse\"></textarea><br />
	<label for=\"client\">N&deg; Client : </label><input class=\"actif\" type=\"text\" name=\"client\" value=\"\" id=\"client\"><br />
	<label for=\"tel\">Tel : </label><input class=\"actif\" type=\"text\" name=\"tel\" value=\"\" id=\"tel\"><br />
	<label for=\"portable\">Portable : </label><input class=\"actif\" type=\"text\" name=\"portable\" value=\"\" id=\"portable\"><br />
	<label for=\"fax\">Fax : </label><input class=\"actif\" type=\"text\" name=\"fax\" value=\"\" id=\"fax\"><br />
	<label for=\"email\">Email : </label><input class=\"actif\" type=\"text\" name=\"email\" value=\"\" id=\"email\"><br />
	<input type=\"submit\" name=\"submitbutton\" value=\"valider\">	<input type=\"button\" name=\"cancel\" value=\"annuler\" onClick=\"history.back()\"></form>";
	break;
	case "modif";
	$texto .="<h3>Modification d'un fournisseur</h3>";
	$texto .=  "<span class=\"affichage\">Attention vous allez modifier un fournisseur, les produits y appartenant changeront de fournisseur</span><br /><br />";
	$req = new db();
	if($_GET['id']!=0){
	$req->findone('fournisseur', $_GET['id']);
	$lefourn = $req->row();
	$texto .="<form method=\"POST\" action=\"./save\"><input type=\"hidden\" name=\"lid\" value=\"".$_GET['id']."\"><input type=\"hidden\" name=\"action\" value=\"modfourn\">
	<label for=\"fournisseur\">Fournisseur : </label><input class=\"actif\" type=\"text\" name=\"fournisseur\" value=\"$lefourn->fournisseur\" id=\"fournisseur\"><br />
	<label for=\"nom\">Nom : </label><input class=\"actif\" type=\"text\" name=\"nom\" value=\"$lefourn->nom\" id=\"nom\"><br />
	<label for=\"prenom\">Pr&eacute;nom : </label><input class=\"actif\" type=\"text\" name=\"prenom\" value=\"$lefourn->prenom\" id=\"prenom\"><br />
	<label for=\"adresse\">Adresse : </label><textarea rows=4 class=\"actif\"  name=\"adresse\"  id=\"adresse\">$lefourn->adresse</textarea><br />
	<label for=\"client\">N&deg; Client : </label><input class=\"actif\" type=\"text\" name=\"client\" value=\"$lefourn->client\" id=\"client\"><br />
	<label for=\"tel\">Tel : </label><input class=\"actif\" type=\"text\" name=\"tel\" value=\"$lefourn->tel\" id=\"tel\"><br />
	<label for=\"portable\">Portable : </label><input class=\"actif\" type=\"text\" name=\"portable\" value=\"$lefourn->portable\" id=\"tel\"><br />
	<label for=\"fax\">Fax : </label><input class=\"actif\" type=\"text\" name=\"fax\" value=\"$lefourn->fax\" id=\"fax\"><br />
	<label for=\"email\">Email : </label><input class=\"actif\" type=\"text\" name=\"email\" value=\"$lefourn->email\" id=\"email\"><br />	
	<input type=\"submit\" name=\"submitbutton\" value=\"valider\" id=\"submitbutton\"><input type=\"button\" name=\"cancel\" value=\"annuler\" onClick=\"history.back()\"></form>";
	}
	else{
		$texto .=  "<span class=\"affichage\">Ce fournisseur ne peut etre modifi&eacute;</span><br /><br />";
	}
	break;
	case "eff";
	$texto .="<h3>Suppression d'un fournisseur</h3>";
	$req = new db();
	$req->findone('fournisseur', $_GET['id']);
	$lefourn = $req->row();
	$req->findquery("SELECT * FROM produit WHERE id_fournisseur='".$_GET['id']."'");
	if($req->__get('numrows')==0 AND $_GET['id']!="0"){
	$texto .="<form method=\"POST\" action=\"./save\"><input type=\"hidden\" name=\"lid\" value=\"".$_GET['id']."\"><input type=\"hidden\" name=\"action\" value=\"efffourn\"><span class=\"affichage\">Etes-vous sur de vouloir supprimer ce fournisseur :</span > <b>$lefourn->fournisseur</b>
	<input type=\"submit\" name=\"submitbutton\" value=\"Supprimer\" id=\"submitbutton\">	<input type=\"button\" name=\"cancel\" value=\"annuler\" onClick=\"history.back()\"></form>";
	}
	else{
		$texto .=  "<span class=\"affichage\">Attention vous ne pouvez pas effacer le fournisseur:<b> $lefourn->fournisseur</b></span><br /><br />
		<span class=\"affichage\">vous devez modifier le fournisseur des produits y appartenant.</span><br /><br />";
		$cat=$_GET['id'];
		$req->findquery("SELECT *
			FROM produit, titre, categ, fournisseur
			WHERE categ.id_categ = produit.id_categ
			AND categ.id_titre = titre.id_titre
			AND produit.id_fournisseur = fournisseur.id_fournisseur AND fournisseur.id_fournisseur=$cat ORDER BY categ.categ");
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
				<td > $produit->categ</td>
				<td> $produit->produit</td>
				<td class=\"stock\"> $produit->fournisseur</td>
				<td> $produit->reference</td>
				<td> $produit->conditionnement</td>
				<td> $produit->prix</td>
				<td> <b>$produit->stock</b></td>
				<td> $produit->stock_mini</td>
				<td>";
				$texto .= (($produit->used=="1")?"<img border='0' src='../img/check.gif' alt='used'>":"<img border='0' src='../img/uncheck.gif' alt='unused'>");
				$texto .= " </td>
				<td><a href='produit?action=modif&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
				<td><a href='produit?action=eff&id=" .  $produit->id_produit . "'><img border='0' src='../img/erase.png' alt='efface'></a></td>
				</tr>\n";
				$nblignemax++;
			}
		}
	break;
	default;
	$reqpre = new db();
	$say = $reqpre->findquery("SELECT * FROM  `fournisseur` WHERE 1 ORDER BY fournisseur");
	$texto.= "<table cellspacing=\"0\" class=\"listing\"><tr><th class=\"listingtitre\">id</th><th class=\"listingtitre\">Fournisseur</th>
	<th class=\"listingtitre\">Nom</th>
	<th class=\"listingtitre\">Pr&eacute;nom</th>
	<th class=\"listingtitre\">Adresse</th>
	<th class=\"listingtitre\">N&deg; client</th>
	<th class=\"listingtitre\">T&eacute;l&eacute;phone</th>
	<th class=\"listingtitre\">Portable</th>
	<th class=\"listingtitre\">Fax</th>
	<th class=\"listingtitre\">modif.</th><th class=\"listingtitre\">eff.</th></tr>\n";
	$nblignemax = 1;
	while($fourn = $reqpre->row()){
	$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
	$texto .= "<tr $cololign><td> $fourn->id_fournisseur</td><td><a href='produit?action=only&fournini=" .  $fourn->id_fournisseur . "'> $fourn->fournisseur</a></td><td align='center'> $fourn->nom</td><td align='center'> $fourn->prenom</td><td align='center'> $fourn->adresse</td><td align='center'> $fourn->client</td><td align='center'> $fourn->tel</td><td align='center'> $fourn->portable</td><td align='center'> $fourn->fax</td><td align='center'><a href='fournisseur?action=modif&id=" .  $fourn->id_fournisseur . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td><td align='center'><a href='fournisseur?action=eff&id=" .  $fourn->id_fournisseur . "'><img border='0' src='../img/erase.png' alt='efface'></a></td></tr>\n";
	$nblignemax++;}
	$texto .= "</table>";
	break;
}


$texto .= "</div></body></html>";
echo $texto;
?>

