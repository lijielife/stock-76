<?php

$texto .="<h3>Suppression d'une commande</h3>";
$req = new db();
$lacom= $_GET['id'];
$req->findone($table_commande, $lacom);
$letitre = $req->row();
$req->findquery("SELECT * FROM $table_commande WHERE id_commande='".$_GET['id']."'");
$lacomma = $req->row();
list ($year, $month, $day) = explode ("-", $lacomma->date);
$datecom = (($lacomma->date=="0000-00-00")?"sans date":"$day/$month/$year");
$texto .="<form method=\"POST\" action=\"./commande?action=save\"><input type=\"hidden\" name=\"lid\" value=\"".$_GET['id']."\"><input type=\"hidden\" name=\"action\" value=\"effcommande\"><span class=\"affichage\">Etes-vous sur de vouloir supprimer la commande en date du <b>$datecom</b> qui contient les &eacute;l&eacute;ments suivant :</span >
<input class=\"medium button red\" type=\"submit\" name=\"submitbutton\" value=\"Supprimer\" id=\"submitbutton\">	<input class=\"medium button orange\" type=\"button\" name=\"cancel\" value=\"annuler\" onClick=\"history.back()\"></form>";

	$say = $req->findquery("SELECT * FROM  `fournisseur` as fourn, `categ` as categ, `commande_list` as CMD_list, `produit`  WHERE CMD_list.id_commande=$lacom AND CMD_list.id_produit=produit.id_produit AND categ.id_categ=produit.id_categ AND fourn.id_fournisseur=produit.id_fournisseur ORDER BY produit.id_produit");
$texto.= "<br /><table style=\"float:left;\" cellspacing=\"0\" class=\"listing\"><tr><th class=\"listingprod\">categ</th><th class=\"listingprod\">produit</th><th class=\"listingprod\">fourn</th><th class=\"listingprod\">reference</th><th class=\"listingprod\">condit.</th><th class=\"listingprod\">prix</th><th class=\"listingprod\">Quantite</th><th class=\"listingprod\">Prix</th></tr>\n";
$nblignemax = 1;

while($lacommande = $req->row()){
$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
$tot = floatval($lacommande->quantite_CMD) * floatval($lacommande->prix);
$totaligne = number_format($tot, 2, ',', '');
		
$texto .= "<tr $cololign>
		<td> $lacommande->categ</td>
		<td id=\"prod_".$lacommande->id_produit."\"> $lacommande->produit</td>
		<td> $lacommande->fournisseur</td>
		<td> $lacommande->reference</td>
		<td> $lacommande->conditionnement</td>
		<td> ".number_format($lacommande->prix, 2, ',', '')."</td>
		<td> $lacommande->quantite_CMD</td>
		<td>".$totaligne."</td>
		</tr>\n";


$nblignemax++;}

$texto .= "</table>";

?>