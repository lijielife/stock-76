<?php

	$texto .="<h3>Modifier commande</h3>";
	$texto .="<form method=\"post\" action=\"./commande?action=save\">";
	$texto .= "<table cellspacing=\"0\" >
	<tr>
	<th class=\"listingprod\">Titre</th>
	<th class=\"listingprod\">Categ</th>
	<th class=\"listingprod\">Produit</th>
	<th class=\"listingprod\">Fourn</th>
	<th class=\"listingprod\">reference</th>
	<th class=\"listingprod\">condit.</th>
	<th class=\"listingprod\">prix</th>
	<th class=\"listingprod\">stock</th>
	<th class=\"listingprod\">stk_mini</th>
	<th class=\"listingprod\">QT_CMD</th>
		<th class=\"listingprod\">QT_mini</th>
	</tr>\n";
	$idacommander ="";
	
$lacom = $_GET['lacom'];
$reqpre = new db();
$reqlacom = new db();
$reqlacom->findquery("SELECT * FROM  `commande`, `fournisseur` WHERE commande.id_commande=$lacom AND commande.id_fournisseur=fournisseur.id_fournisseur ORDER BY date DESC");
$detailcommande = $reqlacom->row();
list ($cyear, $cmonth, $cday) = explode ("-", $detailcommande->date);
$texto.="<p>Commande $detailcommande->fournisseur du $cday/$cmonth/$cyear, n&deg; $detailcommande->num_facture &nbsp;&nbsp;&nbsp; $detailcommande->note </p><br>";
$say = $reqpre->findquery("SELECT * FROM  `fournisseur` as fourn, `categ` as categ, `commande_list` as CMD_list, `produit`, `titre`  WHERE CMD_list.id_commande=$lacom AND CMD_list.id_produit=produit.id_produit AND categ.id_categ=produit.id_categ AND fourn.id_fournisseur=produit.id_fournisseur AND categ.id_titre = titre.id_titre ORDER BY produit.id_produit");
$nbdeprod = $reqpre->__get('numrows');
	$total ="";
	$nblignemax = 1;
		while($produit = $reqpre->row()){
		$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
		if(($produit->used=="1") && ($produit->stock<$produit->stock_mini)){
			$cololign = "class=\"stock\"";
		}
		if(($produit->used=="1") && ($produit->commande=="1")){
				$cololign = "class=\"bientotstock\"";
			}
    	$qtprevu = $produit->quantite_CMD;
		if($produit->stock_mini > $produit->stock){$necessaire=$produit->stock_mini-$produit->stock;}
		else{$necessaire="0";}
		$texto .= "<tr $cololign align='center'>
		<td> $produit->titre</td>
		<td> $produit->categ</td>
		<td> $produit->produit</td>
		<td> $produit->fournisseur</td>
		<td> $produit->reference</td>
		<td> $produit->conditionnement</td>
		<td> ".number_format($produit->prix, 2, ',', '')."</td>
		<td> <b>$produit->stock</b></td>
		<td> $produit->stock_mini</td>
		<td><input type='hidden' name='idcmdlist[]' value='$produit->id_cmd_list' />
		 <input style=\"width:50px\" class=\"actif\" name=\"qtcommande_$produit->id_cmd_list\" size=\"4\" value=\"$qtprevu\" /></td>
		<td>$necessaire</td>";
		$texto .= "
		</tr>\n";
			$total = $total + (floatval($produit->stock) * floatval($produit->prix));
		$nblignemax++;
	}
    $texto .="</table>";
	$texto .="<input type=\"hidden\" name=\"action\" value=\"modifcommande\">
	<input class=\"large button orange\" 
 type=\"submit\" name=\"submitbutton\"  value=\"Modifier la commande\" id=\"submitbutton\">
	<br />
	<input class=\"small button red\"  type=\"button\" name=\"cancel\" value=\"annuler\" onclick=\"history.back()\"></form>";
	
?>