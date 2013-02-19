<?php

$reqpre = new db();
	$reqpre->findquery("SELECT * FROM categ LEFT JOIN titre ON categ.id_titre=titre.id_titre  WHERE 1 ORDER BY titre.titre");
	$texto.= "<table cellspacing=\"0\" >
	<tr>
		<th class=\"listingcateg\">id</th>
		<th class=\"listingcateg\">Categories</th>
		<th class=\"listingcateg\">Famille</th>
		<th class=\"listingcateg\">modifier</th>
		<th class=\"listingcateg\">effacer</th>
		</tr>\n";
	$nblignemax = 1;
	while($categ = $reqpre->row()){
		$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
		$texto .= "<tr $cololign>
			<td>$categ->id_categ</td>
			<td><a href='produit?categ=" .  $categ->id_categ . "'> $categ->categ</a></td>
			<td> $categ->titre</td>
			<td align='center'><a href='categorie?action=modif&id=" .  $categ->id_categ . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
			<td align='center'><a href='categorie?action=eff&id=" .  $categ->id_categ . "'><img border='0' src='../img/erase.png' alt='efface'></a></td>
			</tr>\n";
		$nblignemax++;
	}
		$texto .= "</table>";

?>