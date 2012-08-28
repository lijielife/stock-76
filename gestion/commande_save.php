<?php
require_once("../db.class.php");
$ret = new db();
if(!get_magic_quotes_gpc()){
	foreach($_POST as $k => $v) $_POST[$k] = addslashes($v);
}

	unset($_GET['action']);
switch($_POST['action']){
	case "modcommande";
list($jour, $mois, $annee)= explode('/',$_POST['date']);
$ladate= $annee."-".$mois."-".$jour;
	$say = $ret->update($table_commande, '"' . $_POST['id_commande'] . '"', 'date="' . $ladate . '"',  'note="' . $_POST['note'] . '"', 'num_facture="' . $_POST['facture'] . '"',  'id_fournisseur="' . $_POST['fournisseur'] . '"');	
	break;
}

?>