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
	//gestion des erreurs
	if(validcateg($_POST['categ'])){
		// sauv en var de session les infos postees pour pouvoir les eviter des les re rentrer apres erreur
		$_SESSION['send'] = $_POST;
		$_SESSION['error_categ'] = "<img style=\"vertical-align:top\" border=\"0\" src=\"../img/warning.png\"> Categorie uniquement en lettres majuscules, ex: LOW , STD ...";
	header('Location:./'.'option?action=add');
	exit;
	}
	else{
		 $newprescr = $_POST['categ'];
		unset($_SESSION['send']);
	}

	//sav les infos
	$req = new db();
	$saving= "INSERT INTO torq_categ VALUES('', '" .$_POST["categ"] ."', '".$_POST["backcolor"] ."', '".$_POST["textcolor"] ."', '".$_POST["nature"] ."')";
	$req->findupdate($saving);
	$torque_categ_id = mysql_insert_id();
	$newprescr = $torque_categ_id;
	
	for ($i=17; $i > 10 ; $i--) {
	$saving = "INSERT INTO torque VALUES ('', '" .$_POST["id_produit_dent_" .$i] ."', '" .$_POST["dent_".$i] ."', '$i', '".$_POST["torque_".$i]."', '$newprescr');\n";
	$req->findupdate($saving);
}
for ($i=21; $i < 28 ; $i++) {
	$saving = "INSERT INTO torque VALUES ('', '" .$_POST["id_produit_dent_" .$i] ."', '" .$_POST["dent_".$i] ."', '$i', '".$_POST["torque_".$i]."', '$newprescr');\n";
	$req->findupdate($saving);
}
for ($i=47; $i > 40 ; $i--) { 
	$saving = "INSERT INTO torque VALUES ('', '" .$_POST["id_produit_dent_" .$i] ."', '" .$_POST["dent_".$i] ."', '$i', '".$_POST["torque_".$i]."', '$newprescr');\n";
	$req->findupdate($saving);
}
for ($i=31; $i < 38 ; $i++) {
	$saving = "INSERT INTO torque VALUES ('', '" .$_POST["id_produit_dent_" .$i] ."', '" .$_POST["dent_".$i] ."', '$i', '".$_POST["torque_".$i]."', '$newprescr');\n";
	$req->findupdate($saving);
}
	$mess ="new";
	$page = "option";
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
		unset($_SESSION['send']);
	}
	
$req = new db();
$saving = "UPDATE torq_categ SET categ='" .$_POST["categ"] ."', backgroundcolor='".$_POST["backcolor"] ."', textcolor='".$_POST["textcolor"] ."', nature='".$_POST["nature"] ."' WHERE id_torq_categ='".$_POST["id_torq_categ"] ."'";
$req->findupdate($saving);
$newprescr = $_POST['id_torq_categ'];

	for ($i=17; $i > 10 ; $i--) {
	$saving = "UPDATE torque SET produit_id='" .$_POST["id_produit_dent_" .$i] ."', valeur='".$_POST["torque_".$i]."', categ='$newprescr'  WHERE id_torque='".$_POST["id_torque_" .$i] ."'";
	$req->findupdate($saving);
}
for ($i=21; $i < 28 ; $i++) {
	$saving = "UPDATE torque SET produit_id='" .$_POST["id_produit_dent_" .$i] ."', valeur='".$_POST["torque_".$i]."', categ='$newprescr'  WHERE id_torque='".$_POST["id_torque_" .$i] ."'";
	$req->findupdate($saving);
}
for ($i=47; $i > 40 ; $i--) { 
	$saving = "UPDATE torque SET produit_id='" .$_POST["id_produit_dent_" .$i] ."', valeur='".$_POST["torque_".$i]."', categ='$newprescr'  WHERE id_torque='".$_POST["id_torque_" .$i] ."'";
	$req->findupdate($saving);
}
for ($i=31; $i < 38 ; $i++) {
	$saving = "UPDATE torque SET produit_id='" .$_POST["id_produit_dent_" .$i] ."', valeur='".$_POST["torque_".$i]."', categ='$newprescr'  WHERE id_torque='".$_POST["id_torque_" .$i] ."'";
	$req->findupdate($saving);
}
	
	$mess ="edit";
	$page = "option";
	break;
	case "effcateg";
	$test = $ret->delete('categ', $_POST['lid']);
	$mess ="effacecateg";
	$page = "categorie";
	break;
	default;
	$mess ="";
	$page = "index";
	break;	
}

header('Location:./'.$page.'?mess=' . $mess);
exit;

?>