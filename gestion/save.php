<?php
require("../config.php");
require_once("../db.class.php");
$ret = new db();
if(!get_magic_quotes_gpc()){
	foreach($_POST as $k => $v) $_POST[$k] = addslashes($v);
}
switch($_POST['action']){
	case "newcateg";
	$ret->save('categ', "''", '"' . $_POST['lidtitre'] . '"', '"' . $_POST['categorie'] . '"');
	$mess ="newcateg";
	$page = "categorie";
	break;
	case "modcateg";
	$ret->update('categ', '"' . $_POST['lid'] . '"', 'id_titre="' . $_POST['lidtitre'] . '"',  'categ="' . $_POST['categorie'] . '"');
	$mess ="changecateg";
	$page = "categorie";
	break;
	case "effcateg";
	$test = $ret->delete('categ', $_POST['lid']);
	$mess ="effacecateg";
	$page = "categorie";
	break;
	case "newfourn";
	$ret->save('fournisseur', "''", '"' . $_POST['fournisseur'] . '"', '"' . $_POST['nom'] . '"', '"' . $_POST['prenom'] . '"', '"' . $_POST['adresse'] . '"', '"' . $_POST['client'] . '"', '"' . $_POST['tel'] . '"', '"' . $_POST['portable'] . '"', '"' . $_POST['fax'] . '"', '"' . $_POST['email'] . '"', '"' . $_POST['email_cmd'] . '"');
	$mess ="newfourn";
	$page = "fournisseur";
	break;
	case "modfourn";
	$ret->update('fournisseur', '"' . $_POST['lid'] . '"', 'fournisseur="' . $_POST['fournisseur'] . '"', 'nom="' . $_POST['nom'] . '"', 'prenom="' . $_POST['prenom'] . '"', 'adresse="' . $_POST['adresse'] . '"', 'client="' . $_POST['client'] . '"', 'tel="' . $_POST['tel'] . '"', 'portable="' . $_POST['portable'] . '"', 'fax="' . $_POST['fax'] . '"', 'email="' . $_POST['email'] . '"', 'email_cmd="' . $_POST['email_cmd'] . '"');
	$mess ="changefourn";
	$page = "fournisseur";
	break;
	case "efffourn";
	$test = $ret->delete('fournisseur', $_POST['lid']);
	$mess ="effacefourn";
	$page = "fournisseur";
	break;
	case "newprod";
	$_POST['stock'] = (($_POST['stock']<0)?"0":$_POST['stock']);
	$montant1 = split('[.,]', $_POST['prix']);
	$montant2 = implode (".", $montant1);
	$_POST['prix'] = number_format($montant2, 2, '.', '');
	if ($_POST['commande']=="1") {
		$ladate = date("Y-m-d");
 	}
	else {
		$ladate = date("0000-00-00");
	}
	$ret->save('produit', "''", '"' . $_POST['categorie'] . '"', '"' . $_POST['produit'] . '"',  '"' . $_POST['fournisseur'] . '"',  '"' . $_POST['reference'] . '"',  '"' . $_POST['conditionnement'] . '"',  '"' . $_POST['prix'] . '"',  '"' . $_POST['stock'] . '"',  '"' . $_POST['stock_mini'] . '"', '"' . $_POST['used'] . '"',  '"' . $_POST['commande']  . '"',  '"' . $_POST['quantite_commande'] . '"', '"' . $ladate . '"', '"' . $_POST['codabar'] . '"');
	$mess ="newprod";
	$page = "produit";
	break;
	case "modprod";
	$_POST['stock'] = (($_POST['stock']<0)?"0":$_POST['stock']);
	$montant1 = split('[.,]', $_POST['prix']);
	$montant2 = implode (".", $montant1);
	$_POST['prix'] = number_format($montant2, 2, '.', '');
	list ($day, $month, $year) = split ("/", $_POST['date_commande']);
	$_POST['date_commande'] = $year ."-". $month ."-". $day;
	$ret->update('produit', '"' . $_POST['lid'] . '"', 'id_categ="' . $_POST['categorie'] . '"',  'produit="' . $_POST['produit'] . '"',  'id_fournisseur="' . $_POST['fournisseur'] . '"',  'reference="' . $_POST['reference'] . '"',  'conditionnement="' . $_POST['conditionnement'] . '"',  'prix="' . $_POST['prix'] . '"',  'stock="' . $_POST['stock'] . '"',  'stock_mini="' . $_POST['stock_mini'] . '"',  'quantite_commande="' . $_POST['quantite_commande'] . '"', 'date_commande="' . $_POST['date_commande'] . '"',  'used="' . $_POST['used'] . '"',  'commande="' . $_POST['commande'] . '"');	
	$mess ="changeprod";
	
		if($_POST['oldaction']=="manquant"){
		$mess .="&action=manquant";
	}
  if($_POST['oldaction']=="only"){
    $oldid=(($_POST['oldid']!="")?"&id=".$_POST['oldid']:"");
    $oldfourni=(($_POST['oldfourni']!="")?"&fournini=".$_POST['oldfourni']:"");
		$mess .="&action=only" .$oldid . $oldfourni;
	}
	if($_POST['oldaction']=="classer"){
    $oldid = $_POST['oldid'];
		$mess .="&action=classer&id=" .$oldid;
	}
	
	if($_POST['queque']!=""){
		$qu = $_POST['queque'];
		$mess .="&action=classer&search=$qu";
	}

	$mess .="&oldprodid=" .$_POST['lid'];
	$page = "produit";
	break;
	case "effprod";
	$test = $ret->delete('produit', $_POST['lid']);
	$mess ="effaceprod";
	$page = "produit";
	break;
	case "newtitre";
	$ret->save('titre', "''", '"' . $_POST['titre'] . '"', '""');
	$mess ="newtit";
	$page = "titre";
	break;
	case "modtitre";
	$ret->update('titre', '"' . $_POST['lid'] . '"', 'titre="' . $_POST['titre'] . '"');
	$mess ="changetit";
	$page = "titre";
	break;
	case "efftitre";
	$test = $ret->delete('titre', $_POST['lid']);
	$mess ="effacetit";
	$page = "titre";
	break;
	default;
	$mess ="";
	$page = "index";
	break;	
}

header('Location:./'.$page.'?mess=' . $mess);
exit;

?>