<?php

$texto .="<h3>Cr&eacute;ation d'un titre</h3>";
$texto .="<form name=\"formu\" method=\"POST\" action=\"./titre?action=save\"><input type=\"hidden\" name=\"action\" value=\"newtitre\"><input class=\"actif\" type=\"text\" name=\"titre\" value=\"\" id=\"titre\">
<input type=\"submit\" name=\"submitbutton\" value=\"creer\">	<input type=\"button\" name=\"cancel\" value=\"annuler\" onClick=\"history.back()\"></form>";

?>