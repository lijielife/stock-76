<?php

$reqpre = new db();
$say = $reqpre->findquery("SELECT * FROM  `commande` WHERE 1 ORDER BY id_commande");
$texto.= "<table cellspacing=\"0\" class=\"listing\"><tr><th class=\"listingtitre\">id</th><th class=\"listingtitre\">date</th><th class=\"listingtitre\">note</th><th class=\"listingtitre\">modifier</th><th class=\"listingtitre\">effacer</th></tr>\n";
$nblignemax = 1;
while($commande = $reqpre->row()){
$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
$texto .= "<tr $cololign><td> $commande->id_commande</td><td><a href='categorie?action=only&id=" .  $commande->id_titre . "'> $commande->date</a></td><td align='center'> $commande->note</td><td align='center'><a href='commande?action=modif&id=" .  $commande->id_commande . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td><td align='center'><a href='commande?action=eff&id=" .  $commande->id_commande . "'><img border='0' src='../img/erase.png' alt='efface'></a></td></tr>\n";
$nblignemax++;}
$texto .= "</table>";

?>