<?php
require("../config.php");
require_once("../db.class.php");
$date = date("Y/m/d");
$ret = new db();
if(!get_magic_quotes_gpc()){
	foreach($_POST as $k => $v) $_POST[$k] = addslashes($v);
}
switch($_POST['action']){
	case "retrait";
	$lestockfinal = $_POST['lestockinitial'] - $_POST['retraitstock'];
	$lestockfinal = (($lestockfinal<0)?"0":"$lestockfinal");
	$ret->update('produit', '"' . $_POST['lid'] . '"',  'stock="' . $lestockfinal . '"');
	$ret->save('flux', "''", '"' . $_POST['lid'] . '"', '"-' . $_POST['retraitstock'] . '"', '"' . $date . '"');
	$mess ="retrait";
	$ancienstock = $_POST['lestockinitial'];
	$nouveaustock = $lestockfinal;
	$idproduct = $_POST['lid'];
	$page = "index";
	break;
	default;
	$mess ="";
	$page = "index";
	break;	
}

header('Location:./'.$page.'?mess=' . $mess . '&ancien='. $ancienstock . '&new='. $nouveaustock . '&id=' . $idproduct);
exit;

?>