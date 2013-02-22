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
	case "modcommande";
	echo "coucou";
	$INSERT['id_commande']= '"' .$_POST['id_commande'] . '"';
	$INSERT['date']= '"' .$_POST['date'] . '"';
	$INSERT['note']= '"' .$_POST['note'] . '"';
	$INSERT['num_facture']= '"' .$_POST['facture'] . '"';
	$INSERT['id_fournisseur']= '"' .$_POST['id_fournisseur'] . '"';

	$ret->update($table_commande, '"' . $INSERT['id_commande'] . '"', 'date="' . $_POST['date'] . '"',  'note="' . $_POST['note'] . '"', 'num_facture="' . $_POST['facture'] . '"',  'id_fournisseur="' . $_POST['fournisseur'] . '"');	

	
	$mess ="newprod";
	$page = "produit";
	break;
	case "modifcommande";
	foreach ($_POST['idcmdlist'] as $value) {
	if($_POST["qtcommande_".$value] > 0){
		$ret->findupdate("UPDATE commande_list SET quantite_CMD=\"" . $_POST["qtcommande_".$value] . "\" WHERE id_cmd_list=\"". $value ."\"");
	}
			}

	$mess ="modifqtcommande";
	$page = "produit";
	break;
	case "effcommande";
	$ret->findupdate("DELETE FROM commande_list WHERE id_commande='". $_POST['lid'] ."'");
	$test = $ret->delete('commande', $_POST['lid']);
	$mess ="effacecommande";
	$page = "commande";
	break;
}

?>