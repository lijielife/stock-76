<?php

$texto .="<h3>Modification d'un fournisseur</h3>";
	$texto .=  "<div><span class=\"box warning corners\">Attention vous allez modifier un fournisseur, les produits y appartenant changeront de fournisseur</span</div>";
	$req = new db();
	if($_GET['id']!=0){
	$req->findone('fournisseur', $_GET['id']);
	$lefourn = $req->row();
	$texto .="<form method=\"POST\" action=\"./fournisseur?action=save\"><input type=\"hidden\" name=\"lid\" value=\"".$_GET['id']."\"><input type=\"hidden\" name=\"action\" value=\"modfourn\">
	<label for=\"fournisseur\">Fournisseur : </label><input class=\"actif corners\" type=\"text\" name=\"fournisseur\" value=\"$lefourn->fournisseur\" id=\"fournisseur\"><br />
	<label for=\"nom\">Nom : </label><input class=\"actif corners\" type=\"text\" name=\"nom\" value=\"$lefourn->nom\" id=\"nom\"><br />
	<label for=\"prenom\">Pr&eacute;nom : </label><input class=\"actif corners\" type=\"text\" name=\"prenom\" value=\"$lefourn->prenom\" id=\"prenom\"><br />
	<label for=\"adresse\">Adresse : </label><textarea rows=4 class=\"actif corners\"  name=\"adresse\"  id=\"adresse\">$lefourn->adresse</textarea><br />
	<label for=\"client\">N&deg; Client : </label><input class=\"actif corners\" type=\"text\" name=\"client\" value=\"$lefourn->client\" id=\"client\"><br />
	<label for=\"tel\">Tel : </label><input class=\"actif corners\" type=\"text\" name=\"tel\" value=\"$lefourn->tel\" id=\"tel\"><br />
	<label for=\"portable\">Portable : </label><input class=\"actif corners\" type=\"text\" name=\"portable\" value=\"$lefourn->portable\" id=\"tel\"><br />
	<label for=\"fax\">Fax : </label><input class=\"actif corners\" type=\"text\" name=\"fax\" value=\"$lefourn->fax\" id=\"fax\"><br />
	<label for=\"email\">Email : </label><input class=\"actif corners\" type=\"text\" name=\"email\" value=\"$lefourn->email\" id=\"email\"><br />	
	<label for=\"email_cmd\">Email de commande : </label><input class=\"actif corners\" type=\"text\" name=\"email_cmd\" value=\"$lefourn->email_cmd\" id=\"email_cmd\"><br />	
	<input type=\"submit\" name=\"submitbutton\" value=\"valider\" id=\"submitbutton\"><input type=\"button\" name=\"cancel\" value=\"annuler\" onClick=\"history.back()\"></form>";
	}
	else{
		$texto .=  "<span class=\"affichage\">Ce fournisseur ne peut etre modifi&eacute;</span><br /><br />";
	}

?>