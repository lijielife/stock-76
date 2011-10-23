<?php

$texto .="<h3>Cr&eacute;ation d'un fournisseur</h3>";
	$texto .="<form name=\"formu\" method=\"POST\" action=\"./fournisseur?action=save\"><input type=\"hidden\" name=\"action\" value=\"newfourn\">
	<label for=\"fournisseur\">Fournisseur : </label><input class=\"actif corners\" type=\"text\" name=\"fournisseur\" value=\"\" id=\"fournisseur\"><br />
	<label for=\"nom\">Nom : </label><input class=\"actif corners\" type=\"text\" name=\"nom\" value=\"\" id=\"nom\"><br />
	<label for=\"prenom\">Pr&eacute;nom : </label><input class=\"actif corners\" type=\"text\" name=\"prenom\" value=\"\" id=\"prenom\"><br />
	<label for=\"adresse\">Adresse : </label><textarea rows=4 class=\"actif corners\"  name=\"adresse\" value=\"\" id=\"adresse\"></textarea><br />
	<label for=\"client\">N&deg; Client : </label><input class=\"actif corners\" type=\"text\" name=\"client\" value=\"\" id=\"client\"><br />
	<label for=\"tel\">Tel : </label><input class=\"actif corners\" type=\"text\" name=\"tel\" value=\"\" id=\"tel\"><br />
	<label for=\"portable\">Portable : </label><input class=\"actif corners\" type=\"text\" name=\"portable\" value=\"\" id=\"portable\"><br />
	<label for=\"fax\">Fax : </label><input class=\"actif corners\" type=\"text\" name=\"fax\" value=\"\" id=\"fax\"><br />
	<label for=\"email\">Email : </label><input class=\"actif corners\" type=\"text\" name=\"email\" value=\"\" id=\"email\"><br />
	<label for=\"email_cmd\">Email de commande : </label><input class=\"actif corners\" type=\"text\" name=\"email_cmd\" value=\"\" id=\"email_cmd\"><br />
	<input type=\"submit\" name=\"submitbutton\" value=\"valider\">	<input type=\"button\" name=\"cancel\" value=\"annuler\" onClick=\"history.back()\"></form>";


?>