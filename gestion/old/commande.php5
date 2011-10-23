<?php
require("../config.php");
require_once("../db.class.php");
$date = date("d/m/Y");
setlocale(LC_TIME, "fr_FR");
$dadate = strftime("%A %d %B %Y");
$texto = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
	\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
$texto .= "<html xmlns=\"http://www.w3.org/1777/xhtml\"
	    xml:lang=\"fr\"
	    lang=\"fr\"
	    dir=\"ltr\">
<head>


<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\" media=\"screen\" />
<link rel=\"stylesheet\" href=\"../styleprint.css\" type=\"text/css\" media=\"print\" />
<meta content=\"text/html; Charset=UTF-8\" http-equiv=\"Content-Type\" />


<title>
Gestion Stock en ligne: Commande &agrave; faire
</title>
</head>
<body OnLoad=\"javascript:xwindow.print()\">";
$texto .= "<span class=\"discret\">";
include('../menu.php');
$texto .= "</span>";
$texto .="<h1>Gestion Produit: Commande &agrave; faire</h1>
<h3>$dadate </h3>\n";



	$texto .="<A class=\"discret\" href=\"javascript:window.print()\">Imprimer la liste</A><br /><br />";
	$reqpre = new db();
	$reqpre->findquery("SELECT *
		FROM produit, titre, categ, fournisseur
		WHERE categ.id_categ = produit.id_categ
		AND categ.id_titre = titre.id_titre
		AND produit.id_fournisseur = fournisseur.id_fournisseur AND  produit.stock<produit.stock_mini AND produit.used=1 AND produit.commande=0 ORDER BY produit.id_fournisseur");
	$texto.= "<span id=\"suggest\"><table cellspacing=\"0\" >\n";
	$nblignemax = 1;
	$fournid="abc";

	while($produit = $reqpre->row()){
		$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
		if(($produit->used=="1") && ($produit->stock<$produit->stock_mini)){
			$cololign = "class=\"stock\"";
		}
		if($produit->commande=="1"){
			$cololign = "class=\"bientotstock\"";
		}
		
			if($fournid!=$produit->id_fournisseur){
				
				$texto .="<tr style=\"height:40px\" class=\"clean\" align=\"center\"><td colspan=\"9\">&nbsp;</td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\"><h3>$produit->fournisseur, $produit->nom $produit->prenom</h3></td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\">$produit->adresse</td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\"><i>tel: <b>$produit->tel<b></i></td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\"><i>fax :<b>$produit->Fax<b></i></td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\"><a href=\"mailto:$produit->nom $produit->prenom<$produit->email>\">$produit->email</td></tr>\n";
				
				$texto .="<tr  align=\"center\"><td colspan=\"9\">&nbsp;</td></tr>\n";
				$texto.= "<tr>
				<th class=\"listingprod\">Titre</th>
				<th class=\"listingprod\">Categ</th>
				<th class=\"listingprod\">Produit</th>
				<th class=\"listingprod\">reference</th>
				<th class=\"listingprod\">condit.</th>
				<th class=\"listingprod\">prix</th>
				<th class=\"listingprod\">stock</th>
				<th class=\"listingprod\">stock mini</th>
				<th class=\"listingprod\">commander</th>
				</tr>\n";
			}
		
		$texto .= "<tr style=\"height:30px\" $cololign align='center'>
		<td class=\"case\"> $produit->titre</td>
		<td class=\"case\"> $produit->categ</td>
		<td class=\"case\"> $produit->produit</td>
		<td class=\"case\"> $produit->reference</td>
		<td class=\"case\"> $produit->conditionnement</td>
		<td class=\"case\"> ".number_format($produit->prix, 2, ',', '')."</td>
		<td class=\"case\"> <b>$produit->stock</b></td>
		<td class=\"case\"> $produit->stock_mini</td>
		<td>&nbsp;</td>";
		$texto .= "</tr>\n";
		$nblignemax++;
		$fournid=$produit->id_fournisseur;
	}
		$texto .= "</table>";

$texto .= "<br /><br /><br /></body></html>";
echo $texto;
?>

