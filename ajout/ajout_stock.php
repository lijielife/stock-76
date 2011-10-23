<?php
require("../config.php");
require_once("../db.class.php");
$date = date("Y/m/d");
$ret = new db();
if(!get_magic_quotes_gpc()){
	foreach($_POST as $k => $v) $_POST[$k] = addslashes($v);
}
switch($_POST['action']){
	case "ajout";
	$lestockfinal = $_POST['lestockinitial'] + $_POST['ajoutstock'];
	if($_POST['ajoutstock'] >=$_POST['qtcommande'])
		{
		$ret->update('produit', '"' . $_POST['lid'] . '"',  'stock="' . $lestockfinal . '"', 'commande="0"', 'quantite_commande="0"', 'date_commande=""');
		}
	else
		{
			$reliquat = $_POST['qtcommande']-$_POST['ajoutstock'];
			$ret->update('produit', '"' . $_POST['lid'] . '"',  'stock="' . $lestockfinal . '"', 'commande="1"', 'quantite_commande="' . $reliquat . '"');
			
		}	$ret->save('flux', "''", '"' . $_POST['lid'] . '"', '"' . $_POST['ajoutstock'] . '"', '"' . $date . '"');
	$mess ="ajout";
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