<?php
$texto .="<h3>Suppression de produit</h3>";
	$texto .=  "<span class=\"affichage\">Attention vous allez effacer un produit, son stock ne pourra plus etre suivi </span><br /><br />";
	$req = new db();
	$req->findone('produit', $_GET['id']);
	$leprod = $req->row();
	$texto .="<form method=\"post\" action=\"./save\"><input type=\"hidden\" name=\"lid\" value=\"".$_GET['id']."\"><input type=\"hidden\" name=\"action\" value=\"effprod\"><span class=\"affichage\">Etes-vous sur de vouloir supprimer ce produit :</span > <b>$leprod->produit</b>
	<input type=\"submit\" name=\"submitbutton\" value=\"Supprimer\" id=\"submitbutton\">	<input type=\"button\" name=\"cancel\" value=\"annuler\" onclick=\"history.back()\"></form>";
?>