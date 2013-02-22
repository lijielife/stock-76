<?php
$lestitres = "";
$texto .="<h3>Cr&eacute;ation de categorie</h3>";
	$req = new db();
	$req->findquery("SELECT * FROM `titre` WHERE 1 ORDER BY classement");
	while($titre = $req->row()){
	$lestitres .= "<option value=\"$titre->id_titre\"> $titre->titre</option>\n";
	}
	$texto .="<form name=\"formu\" method=\"POST\" action=\"./categorie?action=save\">
	<input type=\"hidden\" name=\"action\" value=\"newcateg\">
	<input class=\"actif corners\" type=\"text\" name=\"categorie\" value=\"\" id=\"categorie\">
	<select name=\"lidtitre\">$lestitres</select>
	<input class=\"small button blue\" type=\"submit\" name=\"submitbutton\" value=\"creer\">	<input class=\"small button red\" type=\"button\" name=\"cancel\" value=\"annuler\" onClick=\"history.back()\">
	</form>";
	

?>