<?php
require("../config.php");
require_once("../db.class.php");
$ret = new db();
if(!get_magic_quotes_gpc()){
	foreach($_POST as $k => $v) $_POST[$k] = addslashes($v);
}
switch($_POST['action']){
	case "commander";
	$ret->update('produit', '"' . $_POST['lid'] . '"', 'commande="1"', 'quantite_commande="'. $_POST['qtcommande'] .'"');	
	$mess ="commandeprod";
	$page = "produit?action=manquant";
	break;
	case "recu";
	$ret->update('produit', '"' . $_POST['lid'] . '"', 'commande="0"');	
	$mess ="recuprod";
	$page = "produit?action=manquant";
	break;
	default;
	$mess ="";
	$page = "index";
	break;	
}

header('Location:./'.$page.'&mess=' . $mess);
exit;

?>