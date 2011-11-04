<?php

$texto .="<h3>Modification d'un fournisseur</h3>";
	$texto .=  "<div><span class=\"box warning corners\">Attention vous allez modifier un fournisseur, les produits y appartenant changeront de fournisseur</span</div>";
	$req = new db();
	if($_GET['id']!=0){
	$req->findone('fournisseur', $_GET['id']);
	$lefourn = $req->row();
	$texto .="<table><form method=\"POST\" action=\"./fournisseur?action=save\"><input type=\"hidden\" name=\"lid\" value=\"".$_GET['id']."\"><input type=\"hidden\" name=\"action\" value=\"modfourn\">
	<tr><td><label for=\"fournisseur\">Fournisseur : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"fournisseur\" value=\"$lefourn->fournisseur\" id=\"fournisseur\"></td></tr>
	<tr><td><label for=\"nom\">Nom : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"nom\" value=\"$lefourn->nom\" id=\"nom\"></td></tr>
	<tr><td><label for=\"prenom\">Pr&eacute;nom : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"prenom\" value=\"$lefourn->prenom\" id=\"prenom\"></td></tr>
	<tr><td><label for=\"adresse\">Adresse : </label></td><td><textarea rows=4 class=\"actif corners\"  name=\"adresse\"  id=\"adresse\">$lefourn->adresse</textarea></td></tr>
	<tr><td><label for=\"client\">N&deg; Client : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"client\" value=\"$lefourn->client\" id=\"client\"></td></tr>
	<tr><td><label for=\"tel\">Tel : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"tel\" value=\"$lefourn->tel\" id=\"tel\"></td></tr>
	<tr><td><label for=\"portable\">Portable : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"portable\" value=\"$lefourn->portable\" id=\"tel\"></td></tr>
	<tr><td><label for=\"fax\">Fax : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"fax\" value=\"$lefourn->fax\" id=\"fax\"></td></tr>
	<tr><td><label for=\"email\">Email : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"email\" value=\"$lefourn->email\" id=\"email\"></td></tr>	
	<tr><td><label for=\"email_cmd\">Email de commande : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"email_cmd\" value=\"$lefourn->email_cmd\" id=\"email_cmd\"></td></tr>	
	<tr><td><input type=\"button\" name=\"cancel\" value=\"annuler\" onClick=\"history.back()\"></td><td><input type=\"submit\" name=\"submitbutton\" value=\"valider\" id=\"submitbutton\"></form></td></tr></table>";
	}
	else{
		$texto .=  "<span class=\"affichage\">Ce fournisseur ne peut etre modifi&eacute;</span></td></tr></td></tr>";
	}

?>