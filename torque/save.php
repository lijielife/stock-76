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
	function requetveleda($adequate, $ladate){
		// global $_POST;
		$lordre=dent_ordre($adequate);
		$saving2 = "INSERT INTO prescription VALUES ('', '" .$ladate ."', '" .$_POST["dossier"] ."', '" .$_POST["produit_".$adequate] ."', '" .$_POST["torque_".$adequate] ."', '$adequate', '$lordre', '".$_POST["nature_".$adequate]."', '".$_POST["bgcolor_".$adequate]."', '".$_POST["txtcolor_".$adequate]."');\n";
	return $saving2;
	}
	function retraitbk($li){
		$retraitbk = "UPDATE produit set stock=stock-1 where id_produit=$li";
		return $retraitbk;
	}

//update produit set stock=stock-1 where id_produit=1
//$ret->update('produit', '"' . $_POST['lid'] . '"',  'stock="' . $lestockfinal . '"');
//	$ret->save('flux', "''", '"' . $_POST['lid'] . '"', '"-' . $_POST['retraitstock'] . '"', '"' . $date . '"');
$date = date("Y/m/d");
$ladate = date("Y-m-d h:i:s");	
	for ($i=17; $i > 10 ; $i--) {
	$saving = requetveleda($i, $ladate);
	$req->findupdate($saving);
	if($_POST["produit_".$i]!="" && $_POST["produit_".$i]!=0){
		$req->findupdate(retraitbk($_POST["produit_".$i]));
		$req->save('flux', "''", '"' . $_POST["produit_".$i] . '"', '"-1"', '"' . $date . '"');
		}
	}
	for ($i=21; $i < 28 ; $i++) {
	$saving = requetveleda($i, $ladate);
	$req->findupdate($saving);
	if($_POST["produit_".$i]!="" && $_POST["produit_".$i]!=0){
		$req->findupdate(retraitbk($_POST["produit_".$i]));
		$req->save('flux', "''", '"' . $_POST["produit_".$i] . '"', '"-1"', '"' . $date . '"');
		}
	}
	for ($i=47; $i > 40 ; $i--) { 
	$saving = requetveleda($i, $ladate);
	$req->findupdate($saving);
	if($_POST["produit_".$i]!="" && $_POST["produit_".$i]!=0){
		$req->findupdate(retraitbk($_POST["produit_".$i]));
		$req->save('flux', "''", '"' . $_POST["produit_".$i] . '"', '"-1"', '"' . $date . '"');
		}
	}
	for ($i=31; $i < 38 ; $i++) {
	$saving = requetveleda($i, $ladate);
	$req->findupdate($saving);
	if($_POST["produit_".$i]!="" && $_POST["produit_".$i]!=0){
		$req->findupdate(retraitbk($_POST["produit_".$i]));
		$req->save('flux', "''", '"' . $_POST["produit_".$i] . '"', '"-1"', '"' . $date . '"');
		}
}
  header('Location:./'.index.'?dossier=' . $_POST['dossier']. '&action=voir');
  exit;
	break;
	case "editprescription";

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
	break;
	default;
	$mess ="";
	$page = "index";
	break;	
}

// header('Location:./'.$page.'?mess=' . $mess);
// exit;

?>