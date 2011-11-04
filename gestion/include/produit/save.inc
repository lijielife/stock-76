<?php
$ret = new db();
if(!get_magic_quotes_gpc()){
	foreach($_POST as $k => $v) $_POST[$k] = addslashes($v);
}

	unset($_GET['action']);
switch($_POST['action']){
	case "newprod";
//	$complete = array('table' => $table_complement, 'id_invite' => '"' . $invite_principal_id . '"');
//	$complete['immatriculation']= '"' .$_POST['immatriculation'] . '"';
//	$ret->newsave($complete);
	
	
	$_POST['stock'] = (($_POST['stock']<0)?"0":$_POST['stock']); // verifie qu'il ne peut pas y avoir une valeur stock negative
// met le prix au format d'enregistrement bdd avec . au lieu de , et 2 decimales
	$montant1 = split('[.,]', $_POST['prix']);
	$montant2 = implode (".", $montant1);
	$_POST['prix'] = number_format($montant2, 2, '.', '');
//si commande en cours checker affecte la date du jour sinon 0000-00-00
	if ($_POST['commande']=="1") {
		$ladate = date("Y-m-d");
 	}
	else {
		$ladate = date("0000-00-00");
	}
//insert
	$INSERT['id_categ']= '"' .$_POST['categorie'] . '"';
	$INSERT['produit']= '"' .$_POST['produit'] . '"';
	$INSERT['id_fournisseur']= '"' .$_POST['fournisseur'] . '"';
	$INSERT['reference']= '"' .$_POST['reference'] . '"';
	$INSERT['conditionnement']= '"' .$_POST['conditionnement'] . '"';
	$INSERT['prix']= '"' .$_POST['prix'] . '"';
	$INSERT['stock']= '"' .$_POST['stock'] . '"';
	$INSERT['stock_mini']= '"' .$_POST['stock_mini'] . '"';
	$INSERT['used']= '"' .$_POST['used'] . '"';
	$INSERT['commande']= '"' .$_POST['commande'] . '"';
	$INSERT['quantite_commande']= '"' .$_POST['quantite_commande'] . '"';
	$INSERT['date_commande']= '"' .$ladate . '"';

	$ret->newsave($table_produit, $INSERT);
	
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
	$ret->update('produit', '"' . $_GET['id'] . '"', 'id_categ="' . $_POST['categorie'] . '"',  'produit="' . $_POST['produit'] . '"',  'id_fournisseur="' . $_POST['fournisseur'] . '"',  'reference="' . $_POST['reference'] . '"',  'conditionnement="' . $_POST['conditionnement'] . '"',  'prix="' . $_POST['prix'] . '"',  'stock="' . $_POST['stock'] . '"',  'stock_mini="' . $_POST['stock_mini'] . '"',  'quantite_commande="' . $_POST['quantite_commande'] . '"', 'date_commande="' . $_POST['date_commande'] . '"',  'used="' . $_POST['used'] . '"',  'commande="' . $_POST['commande'] . '"');	
	$mess ="changeprod";
	$page = "produit";
	break;
	case "effprod";
	$test = $ret->delete('produit', $_POST['id']);
	$mess ="effaceprod";
	$page = "produit";
	break;
}

?>