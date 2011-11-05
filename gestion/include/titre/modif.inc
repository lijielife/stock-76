<?php

$texto .="<h3>Modification d'un titre</h3>";
$texto .=  "<span class=\"affichage\">Attention vous allez modifier un titre, les produits et categorie y appartenant changeront de chapitre</span><br /><br />";
$req = new db();
$req->findone('titre', $_GET['id']);
$letitre = $req->row();
$texto .="<form method=\"POST\" action=\"./titre?action=save\"><input type=\"hidden\" name=\"lid\" value=\"".$_GET['id']."\"><input type=\"hidden\" name=\"action\" value=\"modtitre\"><input class=\"actif\" type=\"text\" name=\"titre\" value=\"$letitre->titre\" id=\"titre\">
<input type=\"submit\" name=\"submitbutton\" value=\"modifier\" id=\"submitbutton\"><input type=\"button\" name=\"cancel\" value=\"annuler\" onClick=\"history.back()\"></form>";

?>