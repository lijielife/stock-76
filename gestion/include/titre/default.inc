<?php

$reqpre = new db();
$say = $reqpre->findquery("SELECT * FROM  `titre` WHERE 1 ORDER BY classement");
$texto.= "<table cellspacing=\"0\" class=\"listing\"><tr><th class=\"listingtitre\">id</th><th class=\"listingtitre\">Titre</th><th class=\"listingtitre\">classement</th><th class=\"listingtitre\">modifier</th><th class=\"listingtitre\">effacer</th></tr>\n";
$nblignemax = 1;
while($titre = $reqpre->row()){
$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
$texto .= "<tr $cololign><td> $titre->id_titre</td><td><a href='categorie?action=only&id=" .  $titre->id_titre . "'> $titre->titre</a></td><td align='center'> $titre->classement</td><td align='center'><a href='titre?action=modif&id=" .  $titre->id_titre . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td><td align='center'><a href='titre?action=eff&id=" .  $titre->id_titre . "'><img border='0' src='../img/erase.png' alt='efface'></a></td></tr>\n";
$nblignemax++;}
$texto .= "</table>";

?>