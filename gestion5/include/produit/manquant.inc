<?php
	include("./include/produit/ordre.inc");
	if($_GET['ordre']==""){$ordreby ="produit.commande, produit.id_fournisseur";}
	$texto .="<br /><A onclick=\"window.open(this.href, '_blank'); return false;\" href=\"./commande\">Liste Imprimable</A><br />";
	$reqpre = new db();
	$reqpre->findquery("SELECT *
		FROM produit, titre, categ, fournisseur
		WHERE categ.id_categ = produit.id_categ
		AND categ.id_titre = titre.id_titre
		AND produit.id_fournisseur = fournisseur.id_fournisseur AND  (produit.stock<produit.stock_mini OR produit.commande=1) AND produit.used=1 ORDER BY $ordreby");
	$total = 0;
	$previouscommande=false;
	$texto.= "<form name=\"cherch\" action=\"./produit?action=search\" method=\"post\" accept-charset=\"utf-8\">
	<p>	<input autocomplete=\"off\"  class=\"actif\" type=\"text\" id=\"txt_search\" name=\"search\" value=\"\"><input type=\"submit\" value=\"rechercher\"></p>
	</form><span id=\"suggest\">
	<form action=\"./produit?action=commander\" method=\"post\">
  <table cellspacing=\"0\" style=\"clear:both\" >\n";
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
		<td>";
		if ($produit->commande=="0"){
		$texto .= "</td>
		<td> commander</td>";
		}
		else{
			list ($year, $month, $day) = explode ("-", $produit->date_commande);
			$texto .= " $produit->quantite_commande </td>
			<td> $day/$month/$year </td>";
		}
		$texto .= "<td><a href='produit?oldact=manquant&action=modif&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		</form>
		<td>".$totaligne."</td>
		</tr>\n";
		$total = $total + (floatval($produit->stock) * floatval($produit->prix));
		$nblignemax++;
	}
		$texto .= "</table>";

?>