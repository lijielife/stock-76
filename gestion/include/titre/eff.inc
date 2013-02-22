<?php

$texto .="<h3>Suppression d'une Famille</h3>";
$req = new db();
$req->findone('titre', $_GET['id']);
$letitre = $req->row();
$req->findquery("SELECT * FROM categ WHERE id_titre='".$_GET['id']."'");
if($req->__get('numrows')==0){
$texto .="<form method=\"POST\" action=\"./titre?action=save\"><input type=\"hidden\" name=\"lid\" value=\"".$_GET['id']."\"><input type=\"hidden\" name=\"action\" value=\"efftitre\"><span class=\"affichage\">Etes-vous sur de vouloir supprimer cette Famille : <b>$letitre->titre</b></span >
<input type=\"submit\" name=\"submitbutton\" value=\"Supprimer\" id=\"submitbutton\">	<input type=\"button\" name=\"cancel\" value=\"annuler\" onClick=\"history.back()\"></form>";
}
else{
	$texto .=  "<span class=\"affichage\">Attention vous ne pouvez pas effacer la cat&eacute;gorie:<b> $letitre->titre</b></span><br /><br />
	<span class=\"affichage\">vous devez modifier la famille des categories y appartenant.</span><br /><br />";
	$tit=$_GET['id'];
	$req->findquery("SELECT *
		FROM titre, categ
		WHERE categ.id_titre = titre.id_titre
	 	AND categ.id_titre=$tit ORDER BY categ.id_categ");
	$texto.= "<table cellspacing=\"0\" >
	<tr>
	<th class=\"listingcateg\">id</th>
	<th class=\"listingcateg\">Categories</th>
	<th class=\"listingcateg\">Famille</th>
	<th class=\"listingcateg\">modifier</th>
	<th class=\"listingcateg\">effacer</th>
	</tr>\n";

	$nblignemax = 1;
	while($categ = $req->row()){
		$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
		$texto .= "<tr $cololign><td>$categ->id_categ</td><td><a href='produit?action=only&id=" .  $categ->id_categ . "'> $categ->categ</a></td><td> $categ->titre</td><td align='center'><a href='categorie?action=modif&id=" .  $categ->id_categ . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td><td align='center'><a href='categorie?action=eff&id=" .  $categ->id_categ . "'><img border='0' src='../img/erase.png' alt='efface'></a></td></tr>\n";
		$nblignemax++;
	}
		$texto .= "</table>";
	}

?>