<?php
$texto .="<h3>Suppression de produit</h3>";
	$texto .=  "<div><span class=\"box error corners\">Attention vous allez effacer un produit, son stock ne pourra plus etre suivi .</span</div>";
	$req = new db();
	$req->findone('produit', $_GET['id']);
	$leprod = $req->row();
	$texto .="<form method=\"post\" action=\"./produit?action=save\"><input type=\"hidden\" name=\"id\" value=\"".$_GET['id']."\"><input type=\"hidden\" name=\"action\" value=\"effprod\">
	<div><span class=\"box warning corners\">Etes-vous sur de vouloir supprimer ce produit : <b>$leprod->produit</b></span</div>
	<input type=\"submit\" name=\"submitbutton\" value=\"Supprimer\" id=\"submitbutton\">	<input type=\"button\" name=\"cancel\" value=\"annuler\" onclick=\"history.back()\"></form>";
?>