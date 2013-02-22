<?php
	$lestitres = "";
$texto .="<h3>Modification de categorie</h3>";
	
	$texto .=  "<span class=\"affichage\">Attention vous allez modifier une categorie, les produits y appartenant changeront de chapitre</span><br /><br />";
	$req = new db();
	$req->findone('categ', $_GET['id']);
	$lacateg = $req->row();
	$req->findquery("SELECT * FROM `titre` WHERE 1 ORDER BY classement");
	while($titre = $req->row()){
	$lestitres .= "<option ";
	if($titre->id_titre==$lacateg->id_titre){$lestitres .="selected ";}
	$lestitres .="value=\"$titre->id_titre\"> $titre->titre</option>\n";
	}
	$texto .="<form method=\"POST\" action=\"./categorie?action=save\">
	<input type=\"hidden\" name=\"lid\" value=\"".$_GET['id']."\">
	<input type=\"hidden\" name=\"action\" value=\"modcateg\">
	<input class=\"actif corners\" type=\"text\" name=\"categorie\" value=\"$lacateg->categ\" id=\"categorie\">
	<select name=\"lidtitre\">$lestitres</select>
	<input class=\"small button blue\" type=\"submit\" name=\"submitbutton\" value=\"modifier\" id=\"submitbutton\">
	<input class=\"small button red\" type=\"button\" name=\"cancel\" value=\"annuler\" onClick=\"history.back()\"></form>";
	

?>