<?php

$reqpre = new db();
	$say = $reqpre->findquery("SELECT * FROM  `fournisseur` WHERE 1 ORDER BY fournisseur");
	$texto.= "<table cellspacing=\"0\" class=\"listing\"><tr><th class=\"listingtitre\">id</th><th class=\"listingtitre\">Fournisseur</th>
	<th class=\"listingtitre\">Nom</th>
	<th class=\"listingtitre\">Pr&eacute;nom</th>
	<th class=\"listingtitre\">Adresse</th>
	<th class=\"listingtitre\">N&deg; client</th>
	<th class=\"listingtitre\">T&eacute;l&eacute;phone</th>
	<th class=\"listingtitre\">Portable</th>
	<th class=\"listingtitre\">Fax</th>
	<th class=\"listingtitre\">modif.</th><th class=\"listingtitre\">eff.</th></tr>\n";
	$nblignemax = 1;
	while($fourn = $reqpre->row()){
	$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
	$texto .= "<tr $cololign><td> $fourn->id_fournisseur</td><td><a href='produit?action=only&fournini=" .  $fourn->id_fournisseur . "'> $fourn->fournisseur</a></td><td align='center'> $fourn->nom</td><td align='center'> $fourn->prenom</td><td align='center'> $fourn->adresse</td><td align='center'> $fourn->client</td><td align='center'> $fourn->tel</td><td align='center'> $fourn->portable</td><td align='center'> $fourn->fax</td><td align='center'><a href='fournisseur?action=modif&id=" .  $fourn->id_fournisseur . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td><td align='center'><a href='fournisseur?action=eff&id=" .  $fourn->id_fournisseur . "'><img border='0' src='../img/erase.png' alt='efface'></a></td></tr>\n";
	$nblignemax++;}
	$texto .= "</table>";

?>