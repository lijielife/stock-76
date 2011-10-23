<?php
require_once("./db.class.php");
$ret = new db();
$enfant = $_POST['enfant'];
if(!get_magic_quotes_gpc()){
	foreach($_POST as $k => $v) { $_POST[$k] = addslashes($v);}
}
switch($_POST['action']){
	case "newinvite";
	$ret->save($table_invite, "''", '"' . $_POST['nom'] . '"', '"' . $_POST['prenom'] . '"', '"' . $_POST['adresse'] . '"', '"' . $_POST['ville'] . '"', '"' . $_POST['codepost'] . '"', '"' . $_POST['pays'] . '"', '"' . $_POST['tel'] . '"', '"' . $_POST['categ'] . '"', '"' . $_POST['sexe'] . '"', '"' . $_POST['latable'] . '"', '"' . $_POST['present'] . '"', '"' . $_POST['obligatoire'] . '"', '"' . $_POST['age'] . '"', '"' . $_POST['cadeau'] . '"', '"' . $_POST['merci'] . '"', '"' . $_POST['feuj'] . '"', '"' . $_POST['link'] . '"', '"' . $_POST['parent'] . '"', '"' . $_POST['remarque'] . '"');
	$invite_principal_id = mysql_insert_id();
	if ($_POST['linknewconjoint']=="") {
		$ret->update($table_invite, '"' . $invite_principal_id. '"', 'link="' . $invite_principal_id . '"');
	}
	if ($_POST['linknewconjoint']=="newconjoint") {
		$ret->update($table_invite, '"' . $invite_principal_id. '"', 'link="' . $invite_principal_id . '"');
		$ret->save($table_invite, "''", '"' . $_POST['linknom'] . '"', '"' . $_POST['linkprenom'] . '"', '"' . $_POST['adresse'] . '"', '"' . $_POST['ville'] . '"', '"' . $_POST['codepost'] . '"', '"' . $_POST['pays'] . '"', '"' . $_POST['tel'] . '"', '"' . $_POST['categ'] . '"', '"' . $_POST['linksexe'] . '"', '"' . $_POST['latable'] . '"', '"' . $_POST['present'] . '"', '"' . $_POST['obligatoire'] . '"', '"' . $_POST['age'] . '"', '"' . $_POST['cadeau'] . '"', '"' . $_POST['merci'] . '"', '"' . $_POST['feuj'] . '"', '"' . $invite_principal_id . '"', '"' . $_POST['parent'] . '"', '"' . $_POST['remarque'] . '"');
	}
	$nbenf = count($enfant);
	if ($nbenf!=0) {
		foreach ($enfant as $value) {
			$value = mysql_real_escape_string($value);
			$ret->save($table_invite, "''", '"' . $_POST['nom'] . '"', '"' . $value . '"', '"' . $_POST['adresse'] . '"', '"' . $_POST['ville'] . '"', '"' . $_POST['codepost'] . '"', '"' . $_POST['pays'] . '"', '"' . $_POST['tel'] . '"', '"' . $_POST['categ'] . '"', '""', '"' . $_POST['latable'] . '"', '"' . $_POST['present'] . '"', '"' . $_POST['obligatoire'] . '"', '"' . $_POST['age'] . '"', '"' . $_POST['cadeau'] . '"', '"' . $_POST['merci'] . '"', '"' . $_POST['feuj'] . '"', '""', '"' . $invite_principal_id . '"', '""');
			$invite_enfant_id = mysql_insert_id();
			$ret->update($table_invite, '"' . $invite_enfant_id. '"', 'link="' . $invite_enfant_id . '"');
		}
	}
	$mess ="newinvite";
	break;
	case "editinvite";
	if ($_POST['link']=="") {
		$_POST['link']=$_POST['id_invite'];
	}
	$ret->update($table_invite, '"' . $_POST['id_invite'] . '"', 'nom="' . $_POST['nom'] . '"',  'prenom="' . $_POST['prenom'] . '"',  'adresse="' . $_POST['adresse'] . '"',  'ville="' . $_POST['ville'] . '"',  'codepost="' . $_POST['codepost'] . '"',  'pays="' . $_POST['pays'] . '"',  'tel="' . $_POST['tel'] . '"',  'categ="' . $_POST['categ'] . '"',  'sexe="' . $_POST['sexe'] . '"',  'latable="' . $_POST['latable'] . '"',  'present="' . $_POST['present'] . '"',  'obligatoire="' . $_POST['obligatoire'] . '"',  'age="' . $_POST['age'] . '"',  'cadeau="' . $_POST['cadeau'] . '"',  'merci="' . $_POST['merci'] . '"',  'feuj="' . $_POST['feuj'] . '"',  'link="' . $_POST['link'] . '"',  'parent="' . $_POST['parent'] . '"',  'remarque="' . $_POST['remarque'] . '"');
	$invite_principal_id = $_POST['id_invite'];
	
	//si rajout d un conjoint
	if ($_POST['linknewconjoint']=="newconjoint") {
		$ret->save($table_invite, "''", '"' . $_POST['linknom'] . '"', '"' . $_POST['linkprenom'] . '"', '"' . $_POST['adresse'] . '"', '"' . $_POST['ville'] . '"', '"' . $_POST['codepost'] . '"', '"' . $_POST['pays'] . '"', '"' . $_POST['tel'] . '"', '"' . $_POST['categ'] . '"', '"' . $_POST['linksexe'] . '"', '"' . $_POST['latable'] . '"', '"' . $_POST['present'] . '"', '"' . $_POST['obligatoire'] . '"', '"' . $_POST['age'] . '"', '"' . $_POST['cadeau'] . '"', '"' . $_POST['merci'] . '"', '"' . $_POST['feuj'] . '"', '"' . $invite_principal_id . '"', '""', '"' . $_POST['remarque'] . '"');
		//enleve le statut d'enfant
		$ret->update($table_invite, '"' . $invite_principal_id . '"',  'parent="0"');
	}
	
	$nbenf = count($enfant);
	if($nbenf!=0){
		foreach ($enfant as $value) {
			$value = mysql_real_escape_string($value);
			$ret->save($table_invite, "''", '"' . $_POST['nom'] . '"', '"' . $value . '"', '"' . $_POST['adresse'] . '"', '"' . $_POST['ville'] . '"', '"' . $_POST['codepost'] . '"', '"' . $_POST['pays'] . '"', '"' . $_POST['tel'] . '"', '"' . $_POST['categ'] . '"', '"' . $_POST['linksexe'] . '"', '"' . $_POST['latable'] . '"', '"' . $_POST['present'] . '"', '"' . $_POST['obligatoire'] . '"', '"' . $_POST['age'] . '"', '"' . $_POST['cadeau'] . '"', '"' . $_POST['merci'] . '"', '"' . $_POST['feuj'] . '"', '""', '"' . $invite_principal_id . '"', '""');
			$invite_enfant_id = mysql_insert_id();
			$ret->update($table_invite, '"' . $invite_enfant_id. '"', 'link="' . $invite_enfant_id . '"');
		}
	}
	$mess ="editinvite";
	break;
	case "modifinvite";
	//fiche ajax
	$ret->update($table_invite, '"' . $_POST['id_invite'] . '"', 'nom="' . $_POST['nom'] . '"',  'prenom="' . $_POST['prenom'] . '"',  'adresse="' . $_POST['adresse'] . '"',  'ville="' . $_POST['ville'] . '"',  'codepost="' . $_POST['codepost'] . '"',  'pays="' . $_POST['pays'] . '"',  'tel="' . $_POST['tel'] . '"',  'categ="' . $_POST['categ'] . '"',  'sexe="' . $_POST['sexe'] . '"',  'latable="' . $_POST['latable'] . '"',  'present="' . $_POST['present'] . '"',  'obligatoire="' . $_POST['obligatoire'] . '"',  'age="' . $_POST['age'] . '"',  'cadeau="' . $_POST['cadeau'] . '"',  'merci="' . $_POST['merci'] . '"',  'feuj="' . $_POST['feuj'] . '"',  'remarque="' . $_POST['remarque'] . '"');
	exit;
	break;
	case "effinvite";
	$test = $ret->delete($table_invite, $_POST['lid']);
	$mess ="effinvite";
	break;
	default;
	$mess ="";
	break;	
}
header('Location:./invite?mess=' . $mess);
exit;

?>