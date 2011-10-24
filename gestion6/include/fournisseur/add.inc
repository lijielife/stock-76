<?php

$texto .="<h3>Cr&eacute;ation d'un fournisseur</h3>";
	$texto .="<table><form name=\"formu\" method=\"POST\" action=\"./fournisseur?action=save\"><input type=\"hidden\" name=\"action\" value=\"newfourn\"></td></tr>
	<tr><td><label for=\"fournisseur\">Fournisseur : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"fournisseur\" value=\"\" id=\"fournisseur\"></td></tr>
	<tr><td><label for=\"nom\">Nom : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"nom\" value=\"\" id=\"nom\"></td></tr>
	<tr><td><label for=\"prenom\">Pr&eacute;nom : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"prenom\" value=\"\" id=\"prenom\"></td></tr>
	<tr><td><label for=\"adresse\">Adresse : </label></td><td><textarea rows=4 class=\"actif corners\"  name=\"adresse\" value=\"\" id=\"adresse\"></textarea></td></tr>
	<tr><td><label for=\"client\">N&deg; Client : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"client\" value=\"\" id=\"client\"></td></tr>
	<tr><td><label for=\"tel\">Tel : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"tel\" value=\"\" id=\"tel\"></td></tr>
	<tr><td><label for=\"portable\">Portable : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"portable\" value=\"\" id=\"portable\"></td></tr>
	<tr><td><label for=\"fax\">Fax : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"fax\" value=\"\" id=\"fax\"></td></tr>
	<tr><td><label for=\"email\">Email : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"email\" value=\"\" id=\"email\"></td></tr>
	<tr><td><label for=\"email_cmd\">Email de commande : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"email_cmd\" value=\"\" id=\"email_cmd\"></td></tr>
	<tr><td><input type=\"button\" name=\"cancel\" value=\"annuler\" onClick=\"history.back()\"></td><td><input type=\"submit\" name=\"submitbutton\" value=\"valider\"></form></td></tr></table>";


?>