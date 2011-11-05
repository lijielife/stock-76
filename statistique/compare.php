<?php
$cmd = $_POST['cmd'];
require_once("../db.class.php");
include("./include/stat/function.inc");
include("../fonction.php");
$texto ="";
$reqcompare = new db();
	$finfin = date("Y-m-d");

	list($year, $month, $day) = explode('-', $finfin);
	$debdeb = $year-1 ."-".$month."-".$day;
	
	$lien= "";
if($_POST['debut']!=""){
	$datedebut =  $_POST['debut'];
	$lien .= "&debut=" . $_POST['debut'];
	}
else{
	$datedebut =  $debdeb;
}

if($_POST['fin']!=""){
	$datefin = $_POST['fin'];
	$lien .= "&fin=" . $_POST['fin'];
	}
else{
	$datefin = $finfin;
}
$reqproduit ="SELECT * 
	FROM produit, titre, categ, fournisseur
	WHERE categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur
	AND produit.id_produit IN ($cmd)
	ORDER BY produit.used DESC, produit.id_produit ASC";
	$reqcompare->findquery($reqproduit);

$nblignemax = 1;
	$texto .= "<table cellspacing=\"0\">";

$lignentete = new Entete("listingprod", "", "", "", "");
$thete[1] =array("titre");
$thete[2] =array("Categ");
$thete[3] =array("Produit");
$thete[4] =array("Fourn");
$thete[5] =array("ref.");
$thete[6] =array("condit.");
$thete[7] =array("prix Un.", "prix");
$thete[8] =array("stock");
$thete[9] =array("St_mini");
$thete[10] =array("&#8364;");
$thete[11] =array("flux_N");
$thete[12] =array("N-1");

$Pligne = $lignentete->make_ligne($thete);
$texto .=  "<tr>";
$texto .= $lignentete->whatwhat;
$texto .=  "</tr>";

$total_prix_stock = 0;
$total_stock = 0;
$total_flux_n = 0;
$total_flux_n1 = 0;
$somme_prix_unit = 0;
			
while($produit = $reqcompare->row()){
		$cololign = (($nblignemax%2 == 0)?"":"alt");
		$req_statN = new db();
		$req_statN->findquery("SELECT sum(quantite) as N FROM flux WHERE flux.id_produit = $produit->id_produit AND quantite < 0 AND flux.date >=  '$datedebut' AND flux.date <=  '$datefin'");
		$statN = $req_statN->row();
		
		$valN= number_format($statN->N * $produit->prix, 2, ',', '');
		
		list($Nyear, $Nmonth, $Nday) = explode('-', $datedebut);
		$debutn1 = $Nyear-1 ."-".$Nmonth."-".$Nday;
		$req_statN1 = new db();
		$req_statN1->findquery("SELECT sum(quantite) as N1 FROM flux WHERE flux.id_produit = $produit->id_produit AND quantite < 0 AND flux.date >=  '$debutn1' AND flux.date <=  '$datedebut'");
		$statN1 = $req_statN1->row();
		$valN1= number_format($statN1->N1 * $produit->prix, 2, ',', '');
		
		$tot = floatval($produit->stock) * floatval($produit->prix);
		$totaligne = number_format($tot, 2, ',', '');
		
	$texto .= "<tr name=\"$produit->id_produit\" class=\"$cololign\" align='center'>
		<td> $produit->titre</td>
		<td> $produit->categ</td>
		<td> $produit->produit</td>
		<td> $produit->fournisseur</td>
		<td> $produit->reference</td>
		<td> $produit->conditionnement</td>
		<td> ".number_format($produit->prix, 2, ',', '')."</td>
		<td> <b>$produit->stock</b></td>
		<td> $produit->stock_mini</td>";
		$texto .= "	<td>".$totaligne."</td>
		<td title=\"$valN &#8364;\">$statN->N</td>
		<td title=\"$valN1 &#8364;\">$statN1->N1</td>
		</tr>\n";
			$total_prix_stock = $total_prix_stock + (floatval($produit->stock) * floatval($produit->prix));
			$total_stock = $total_stock + $produit->stock;
			$total_flux_n = $total_flux_n - $statN->N;
			$total_flux_n1 = $total_flux_n1 - $statN1->N1;
			$somme_prix_unit = $somme_prix_unit + $produit->prix;
			
				$nblignemax++;
}
	$nblignemax = $nblignemax-1;
	$prixmoyen = number_format(floatval($somme_prix_unit/$nblignemax), 2, ',', '');
	$n_prixmoyen = $prixmoyen*$total_flux_n;
	$n1_prixmoyen = $prixmoyen*$total_flux_n1;
	$texto .= "<tr style=\"background-color:darkblue; color:white;\"><td colspan=6><center><b>Total</b></center></td><td>$prixmoyen</td><td>$total_stock</td><td></td><td>".number_format($total_prix_stock, 2, ',', '')."</td><td title=\"$n_prixmoyen &#8364;\">$total_flux_n</td><td title=\"$n1_prixmoyen &#8364;\">$total_flux_n1</td></tr>";
	$texto .= "</form></span></table>";
	
	echo $texto;
?>