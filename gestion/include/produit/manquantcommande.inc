<?php

	include("./include/produit/ordre.inc");
	if($_GET['ordre']==""){$ordreby ="produit.commande, produit.id_fournisseur";}
	$reqpre = new db();
	$reqpre->findquery("SELECT *
		FROM produit, titre, categ, fournisseur
		WHERE categ.id_categ = produit.id_categ
		AND categ.id_titre = titre.id_titre
		AND produit.id_fournisseur = fournisseur.id_fournisseur AND  (produit.stock<produit.stock_mini OR produit.commande=1) AND produit.used=1 ORDER BY produit.commande, $ordreby");
	$total = 0;
	$previouscommande=false;
	$texto.= "<form name=\"cherch\" action=\"./produit?action=search\" method=\"post\" accept-charset=\"utf-8\">
	<p>	<input  autocomplete=\"off\" class=\"actif\" type=\"text\" id=\"txt_search\" name=\"search\" value=\"\"><input type=\"submit\" value=\"rechercher\"></p>
	</form>
	<form action=\"./produit?action=commander\" method=\"post\">
	<span id=\"suggest\"><table cellspacing=\"0\" >
	\n";
	include("./include/produit/entete.inc");
	$texto .= "<tr>" . $Titre->lacase . $Categ->lacase . $Produit->lacase . $Fourn->lacase .$ref->lacase .$condit->lacase .$prix->lacase .$stock->lacase .$stk_mini->lacase .$QT_CMD->lacase .$CMD->lacase .$date->lacase .$modif->lacase .$Totalprix->lacase . "</tr>";
	
		$texto .= "<tr style=\"background-color: #99FF99;color:#228822\" align='center'><td  colspan=\"14\"> --------- produit manquant ---------	</td></tr>";
	$nblignemax = 1;
	while($produit = $reqpre->row()){
		if($previouscommande!=$produit->commande){
			$texto .= "<tr style=\"background-color: #99FF99;color:#228822\" align='center'><td  colspan=\"14\"> --------- produit en cours de commande ---------	</td></tr>";
		}
		$previouscommande=$produit->commande;
		$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
		if(($produit->used=="1") && ($produit->stock<$produit->stock_mini)){
			$cololign = "class=\"stock\"";
		}
		if($produit->commande=="1"){
			$cololign = "class=\"bientotstock\"";
		}
		if (isset($_GET['oldprodid'])){
		  if($produit->id_produit==$_GET['oldprodid']){
			$cololign = "class=\"justchange\"";
	   	}
    }
		$tot = floatval($produit->stock) * floatval($produit->prix);
		$totaligne = number_format($tot, 2, ',', '');
		list ($year, $month, $day) = explode ("-", $produit->date_commande);
		$datecom = (($produit->date_commande=="0000-00-00")?"":"$day/$month/$year");
		$texto .= "<tr $cololign align='center'>\n
		<td> $produit->titre</td>
		<td> $produit->categ</td>
		<td> $produit->produit</td>
		<td> $produit->fournisseur</td>
		<td> $produit->reference</td>
		<td> $produit->conditionnement</td>
		<td> ".number_format($produit->prix, 2, ',', '')."</td>
		<td> <b>$produit->stock</b></td>
		<td> $produit->stock_mini</td>
		<td> $produit->quantite_commande</td>
		<td><input type=\"checkbox\" name=\"cmd[]\" value=\"$produit->id_produit\"/></td>
		<td> $datecom</td>";
		$texto .= "<td><a href='produit?oldact=manquant&action=modif&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		</form>
		<td>".$totaligne."</td>
		</tr>\n";
		$total = $total + (floatval($produit->stock) * floatval($produit->prix));
		$nblignemax++;
	}
	$texto .= "<tr style=\"background-color: #99FF99;color:#228822\" align='center'><td  colspan=\"14\"> --------- produit non manquant ---------	</td></tr>";
	$reqpre->findquery("SELECT * 
	FROM produit, titre, categ, fournisseur
	WHERE categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur
	AND produit.used=1
	AND (produit.stock>=produit.stock_mini AND produit.commande=0)
	ORDER BY categ.categ ASC");
	$total = 0;

	$nblignemax = 1;
	while($produit = $reqpre->row()){
		$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
		if(($produit->used=="1") && ($produit->stock<$produit->stock_mini)){
			$cololign = "class=\"stock\"";
		}
		if(($produit->used=="1") && ($produit->commande=="1")){
				$cololign = "class=\"bientotstock\"";
			}
		if (isset($_GET['oldprodid'])){
		  if($produit->id_produit==$_GET['oldprodid']){
			$cololign = "class=\"justchange\"";
	   	}
    }
		$tot = floatval($produit->stock) * floatval($produit->prix);
		$totaligne = number_format($tot, 2, ',', '');
		list ($year, $month, $day) = explode ("-", $produit->date_commande);
		$datecom = (($produit->date_commande=="0000-00-00")?"":"$day/$month/$year");
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
		<td> $produit->quantite_commande</td>
		<td><input type=\"checkbox\" name=\"cmd[]\" value=\"$produit->id_produit\"/></td>
		<td> $datecom</td>";
		$texto .= "</td>
		<td><a href='produit?action=modif&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td>".$totaligne."</td>
		</tr>\n";
			$total = $total + (floatval($produit->stock) * floatval($produit->prix));
		$nblignemax++;
	}
	
		
	$texto .= "<tr><td colspan=14><center>Total en stock:  <b>".number_format($total, 2, ',', '')." &#8364;</b></center></td></tr>";
	//------fin pb
	
	
	$texto .= "</form></span></table>";
	

?>