<?php

$texto .="<h3>Suppression d'une commande</h3>";
$req = new db();
$lacom= $_GET['id'];
$req->findone($table_commande, $lacom);
$letitre = $req->row();
$req->findquery("SELECT * FROM $table_commande_list WHERE id_commande='".$_GET['id']."'");
if($req->__get('numrows')==0){
$texto .="<form method=\"POST\" action=\"./save\"><input type=\"hidden\" name=\"lid\" value=\"".$_GET['id']."\"><input type=\"hidden\" name=\"action\" value=\"efftitre\"><span class=\"affichage\">Etes-vous sur de vouloir supprimer ce titre :</span > <b>$letitre->id_commande</b>
<input type=\"submit\" name=\"submitbutton\" value=\"Supprimer\" id=\"submitbutton\">	<input type=\"button\" name=\"cancel\" value=\"annuler\" onClick=\"history.back()\"></form>";
}
else{
	$texto .=  "<span class=\"affichage\">Attention vous ne pouvez pas effacer la cat&eacute;gorie:<b> $letitre->id_commande</b></span><br /><br />
	<span class=\"affichage\">vous devez modifier le titre des categories y appartenant.</span><br /><br />";
	$say = $req->findquery("SELECT * FROM  `fournisseur` as fourn, `categ` as categ, `commande_list` as CMD_list, `produit`  WHERE CMD_list.id_commande=$lacom AND CMD_list.id_produit=produit.id_produit AND categ.id_categ=produit.id_categ AND fourn.id_fournisseur=produit.id_fournisseur ORDER BY produit.id_produit");
$texto.= "<table style=\"float:left;\" cellspacing=\"0\" class=\"listing\"><tr><th class=\"listingprod\">categ</th><th class=\"listingprod\">produit</th><th class=\"listingprod\">fourn</th><th class=\"listingprod\">reference</th><th class=\"listingprod\">condit.</th><th class=\"listingprod\">prix</th><th class=\"listingprod\">Quantite</th><th class=\"listingprod\">Prix</th><th class=\"listingtitre\"><img border='0' src='../img/pencil.gif' alt='modif'></th><th class=\"listingtitre\"><img border='0' src='../img/erase.png' alt='efface'></th></tr>\n";
$nblignemax = 1;

while($lacommande = $req->row()){
$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
$tot = floatval($lacommande->quantite_CMD) * floatval($lacommande->prix);
$totaligne = number_format($tot, 2, ',', '');
		
$texto .= "<tr $cololign>
		<td> $lacommande->categ</td>
		<td id=\"prod_".$produit->id_produit."\"> $lacommande->produit</td>
		<td> $lacommande->fournisseur</td>
		<td> $lacommande->reference</td>
		<td> $lacommande->conditionnement</td>
		<td> ".number_format($lacommande->prix, 2, ',', '')."</td>
		<td> $lacommande->quantite_CMD</td>
		<td>".$totaligne."</td>
		<td align='center'><a href='commande?action=modif&id_cmd=" .  $lacommande->id_commande . "&idprod=" .  $lacommande->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td align='center'><a href='commande?action=eff&id=" .  $lacommande->id_commande . "&idprod=" .  $lacommande->id_produit . "'><img border='0' src='../img/erase.png' alt='efface'></a></td>
		</tr>\n";
			$total = $total + (floatval($produit->stock) * floatval($produit->prix));


$nblignemax++;}

$texto .= "</table>";
	}

?>