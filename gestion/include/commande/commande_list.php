<?php
require("../../../config.php");
require_once("../../../db.class.php");
$lacom = strtolower($_POST['lacom']);
$reqpre = new db();
$say = $reqpre->findquery("SELECT * FROM  `fournisseur` as fourn, `categ` as categ, `commande_list` as CMD_list, `produit`  WHERE CMD_list.id_commande=$lacom AND CMD_list.id_produit=produit.id_produit AND categ.id_categ=produit.id_categ AND fourn.id_fournisseur=produit.id_fournisseur ORDER BY produit.id_produit");
$texto.= "<table style=\"float:left;\" cellspacing=\"0\" class=\"listing\"><tr><th class=\"listingprod\">categ</th><th class=\"listingprod\">produit</th><th class=\"listingprod\">fourn</th><th class=\"listingprod\">reference</th><th class=\"listingprod\">condit.</th><th class=\"listingprod\">prix</th><th class=\"listingprod\">Quantite</th><th class=\"listingprod\">Prix</th><th class=\"listingtitre\"><img border='0' src='../img/pencil.gif' alt='modif'></th><th class=\"listingtitre\"><img border='0' src='../img/erase.png' alt='efface'></th></tr>\n";
$nblignemax = 1;

while($lacommande = $reqpre->row()){
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

echo $texto;
?>