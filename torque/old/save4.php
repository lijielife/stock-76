<?php
require("../config.php");
require_once("../db.class.php");
require("../fonction.php");
session_start();
unset($_SESSION['error_categ']);
$ret = new db();
if(!get_magic_quotes_gpc()){
	foreach($_POST as $k => $v) $_POST[$k] = addslashes($v);
}
switch($_POST['action']){
	case "newprescription";
	//sav les infos
	$req = new db();
		$newprescr = $_POST["categ"];
	function requetveleda($adequate){
		// global $_POST;
		$ladate = date("Y-m-d h:i:s");
		$lordre=dent_ordre($adequate);
		$saving2 = "INSERT INTO prescription VALUES ('', '" .$ladate ."', '" .$_POST["dossier"] ."', '" .$_POST["torque_".$adequate] ."', '$adequate', '$lordre', '".$_POST["nature_".$adequate]."', '".$_POST["bgcolor_".$adequate]."', '".$_POST["txtcolor_".$adequate]."');\n";
	return $saving2;
	}
	
	for ($i=17; $i > 10 ; $i--) {
	$saving = requetveleda($i);
	$req->findupdate($saving);
	}
	for ($i=21; $i < 28 ; $i++) {
	$saving = requetveleda($i);
	$req->findupdate($saving);
	}
	for ($i=47; $i > 40 ; $i--) { 
	$saving = requetveleda($i);
	$req->findupdate($saving);
	}
	for ($i=31; $i < 38 ; $i++) {
	$saving = requetveleda($i);
	$req->findupdate($saving);
}
  header('Location:./'.index.'?dossier=' . $_POST['dossier']. '&action=voir');
  exit;
	break;
	case "editprescription";
//gestion des erreurs
	if(validcateg($_POST['categ'])){
		// sauv en var de session les infos postees pour pouvoir les eviter des les re rentrer apres erreur
		$_SESSION['error_categ'] = "<img style=\"vertical-align:top\" border=\"0\" src=\"../img/warning.png\"> Categorie uniquement en lettres majuscules, ex: LOW , STD ...";
	header('Location:./option?action=edit&categ='.$_POST['oldcateg']);
	exit;
	}
	else{
		 $newprescr = $_POST['categ'];
		unset($_SESSION['send']);
	}
	
$req = new db();
$saving = "UPDATE torq_categ SET categ='" .$_POST["categ"] ."', backgroundcolor='".$_POST["backcolor"] ."', textcolor='".$_POST["textcolor"] ."', nature='".$_POST["nature"] ."' WHERE id_torq_categ='".$_POST["id_torq_categ"] ."'";
$req->findupdate($saving);
$newprescr = $_POST["categ"];

	for ($i=17; $i > 10 ; $i--) {
	$lordre=dent_ordre($i);
	$saving = "UPDATE torque SET produit_id='" .$_POST["id_produit_dent_" .$i] ."', valeur='".$_POST["torque_".$i]."', categ='$newprescr'  WHERE id_torque='".$_POST["id_torque_" .$i] ."'";
	$req->findupdate($saving);
}
for ($i=21; $i < 28 ; $i++) {
	$lordre=dent_ordre($i);
	$saving = "UPDATE torque SET produit_id='" .$_POST["id_produit_dent_" .$i] ."', valeur='".$_POST["torque_".$i]."', categ='$newprescr'  WHERE id_torque='".$_POST["id_torque_" .$i] ."'";
	$req->findupdate($saving);
}
for ($i=47; $i > 40 ; $i--) { 
	$lordre=dent_ordre($i);
	$saving = "UPDATE torque SET produit_id='" .$_POST["id_produit_dent_" .$i] ."', valeur='".$_POST["torque_".$i]."', categ='$newprescr'  WHERE id_torque='".$_POST["id_torque_" .$i] ."'";
	$req->findupdate($saving);
}
for ($i=31; $i < 38 ; $i++) {
	$lordre=dent_ordre($i);
	$saving = "UPDATE torque SET produit_id='" .$_POST["id_produit_dent_" .$i] ."', valeur='".$_POST["torque_".$i]."', categ='$newprescr'  WHERE id_torque='".$_POST["id_torque_" .$i] ."'";
	$req->findupdate($saving);
}
	
	
	$mess ="changecateg";
	$page = "option";
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
	if($_POST['queque']!=""){
		$qu = $_POST['queque'];
		$mess ="changeprod&action=classer&search=$qu";
	}
	if($_POST['orig']!=""){
		$mess ="changeprod&action=manquant";
	}
	$page = "produit";
	break;
	
	default;
	$mess ="";
	$page = "index";
	break;	
}

header('Location:./'.$page.'?mess=' . $mess);
exit;

?>