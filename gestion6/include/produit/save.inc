<?php
$ret = new db();
if(!get_magic_quotes_gpc()){
	foreach($_POST as $k => $v) $_POST[$k] = addslashes($v);
}

	unset($_GET['action']);
switch($_POST['action']){
	case "newprod";

	$_POST['stock'] = (($_POST['stock']<0)?"0":$_POST['stock']);
	$montant1 = split('[.,]', $_POST['prix']);
	$montant2 = implode (".", $montant1);
	$_POST['prix'] = number_format($montant2, 2, '.', '');
	if ($_POST['commande']=="1") {
		$ladate = date("Y-m-d");
 	}
	else {
		$ladate = date("0000-00-00");
	}
	$ret->save('produit', "''", '"' . $_POST['categorie'] . '"', '"' . $_POST['produit'] . '"',  '"' . $_POST['fournisseur'] . '"',  '"' . $_POST['reference'] . '"',  '"' . $_POST['conditionnement'] . '"',  '"' . $_POST['prix'] . '"',  '"' . $_POST['stock'] . '"',  '"' . $_POST['stock_mini'] . '"', '"' . $_POST['used'] . '"',  '"' . $_POST['commande']  . '"',  '"' . $_POST['quantite_commande'] . '"', '"' . $ladate . '"', '"' . $_POST['codabar'] . '"');
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