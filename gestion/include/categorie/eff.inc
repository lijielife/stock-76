<?php

$texto .="<h3>Suppression de categorie</h3>";
	$req = new db();
	$req->findone('categ', $_GET['id']);
	$lacateg = $req->row();
	$req->findquery("SELECT * FROM produit WHERE id_categ='".$_GET['id']."'");
	if($req->__get('numrows')==0){
	$texto .="<form method=\"POST\" action=\"./categorie?action=save\"><input type=\"hidden\" name=\"lid\" value=\"".$_GET['id']."\"><input type=\"hidden\" name=\"action\" value=\"effcateg\"><span class=\"affichage\">Etes-vous sur de vouloir supprimer cette categorie : <b>$lacateg->categ</b></span >
	<input type=\"submit\" name=\"submitbutton\" class=\"small button blue\" value=\"Supprimer\" id=\"submitbutton\">	<input class=\"small button red\" type=\"button\" name=\"cancel\" value=\"annuler\" onClick=\"history.back()\"></form>";
	}
	else{
		$texto .=  "<span class=\"affichage\">Attention vous ne pouvez pas effacer la cat&eacute;gorie:<b> $lacateg->categ</b></span>
		<span class=\"affichage\">vous devez modifier la categorie des produits y appartenant.</span><br /><br />";
		$cat=$_GET['id'];
		$req->findquery("SELECT *
			FROM produit, titre, categ, fournisseur
			WHERE categ.id_categ = produit.id_categ
			AND categ.id_titre = titre.id_titre
			AND produit.id_fournisseur = fournisseur.id_fournisseur AND categ.id_categ=$cat ORDER BY categ.categ");
		$texto .= "<table cellspacing=\"0\" >
		<tr>
		<th class=\"listingprod\">Famille</th>
		<th class=\"listingprod\">Categ</th>
		<th class=\"listingprod\">Produit</th>
		<th class=\"listingprod\">fournisseur</th>
		<th class=\"listingprod\">reference</th>
		<th class=\"listingprod\">condit.</th>
		<th class=\"listingprod\">prix</th>
		<th class=\"listingprod\">stock</th>
		<th class=\"listingprod\">stock mini</th>
		<th class=\"listingprod\">used</th>
		<th class=\"listingprod\">modif.</th>
		<th class=\"listingprod\">eff.</th>
		</tr>\n";
		$nblignemax = 1;
		while($produit = $req->row()){
				$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
				if(($produit->used=="1") && ($produit->stock<$produit->stock_mini)){
					$cololign = "class=\"stock\"";
				}
				if($produit->commande=="1"){
					$cololign = "class=\"bientotstock\"";
				}
				$texto .= "<tr $cololign align='center'>
				<td> $produit->titre</td>
				<td class=\"stock\"> $produit->categ</td>
				<td> $produit->produit</td>
				<td> $produit->fournisseur</td>
				<td> $produit->reference</td>
				<td> $produit->conditionnement</td>
				<td> $produit->prix</td>
				<td> <b>$produit->stock</b></td>
				<td> $produit->stock_mini</td>
				<td>";
				$texto .= (($produit->used=="1")?"<img border='0' src='../img/check.gif' alt='used'>":"<img border='0' src='../img/uncheck.gif' alt='unused'>");
				$texto .= " </td>
				<td><a href='produit?action=modif&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
				<td><a href='produit?action=eff&id=" .  $produit->id_produit . "'><img border='0' src='../img/erase.png' alt='efface'></a></td>
				</tr>\n";
				$nblignemax++;
			}
		}


?>