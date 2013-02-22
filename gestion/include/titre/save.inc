<?php
$ret = new db();
if(!get_magic_quotes_gpc()){
	foreach($_POST as $k => $v) $_POST[$k] = addslashes($v);
}
switch($_POST['action']){
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
}

?>