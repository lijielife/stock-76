<?php
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
}


?>