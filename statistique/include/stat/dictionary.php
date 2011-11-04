<?php
$texto = "";
	//$texto .= '<link rel="stylesheet" href="../js/thickbox.css" type="text/css" media="screen" />
	//<script type="text/javascript" src="../js/thickbox.js"></script>';
require("../../../config.php");
require_once("../../../db.class.php");
include("./function.inc");


	include("./ordre.inc");

	$reqpre = new db();
	$rajout_requete= "";
	//si demande d'une categ specifique
	if($_GET['categ']){
		$cat = mysql_real_escape_string($_GET['categ']);
		$rajout_requete = "AND categ.id_categ=$cat ";
		$rajout_class = "&categ=$cat";
	}
	
	if($_GET['fournini']){
		$fournis = mysql_real_escape_string($_GET['fournini']);
		$rajout_requete = "AND fournisseur.id_fournisseur=$fournis ";
		$rajout_class = "&fournini=$fournis";
	}
	
	if(isset($_GET['search'])){
		$que = mysql_real_escape_string($_GET['search']);
		$rajout_requete = "AND (produit.produit LIKE '%$que%' OR fournisseur.fournisseur LIKE '%$que%' OR produit.reference LIKE '%$que%' OR categ.categ LIKE '%$que%')";
		$rajout_class = "&search=$que";
		}
		
	$allGET = "";
	foreach ($_GET as $key => $value) {
		$allGET .= "&$key=$value";
	}
	
	$requete_modifiable ="SELECT * 
	FROM produit, titre, categ, fournisseur
	WHERE categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur
	$rajout_requete
	ORDER BY produit.used DESC $ordreby";
	$reqpre->findquery($requete_modifiable);
	
	$total = 0;
if(($reqpre->__get('numrows'))!=0){
	$texto.= "\n<table cellspacing=\"0\" >\n";

	include("./entete.inc");


	$nblignemax = 1;
	$usedaff=0;
	while($produit = $reqpre->row()){
		$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
		
		if($produit->used=="0"){$cololign = "class=\"unused\"";}
		if(($produit->used=="1") && ($produit->stock<$produit->stock_mini)){$cololign = "class=\"stock\"";}
		if(($produit->used=="1") && ($produit->commande=="1")){
				$cololign = "class=\"bientotstock\"";
			}
		if (isset($_GET['oldprodid'])){
		  if($produit->id_produit==$_GET['oldprodid']){
			$cololign = "class=\"justchange\"";
	   	}
    }
		if($produit->used=="0" && $usedaff==0){$texto .= "<tr class=\"stock\" align='center'>
		<td  colspan=\"14\"> --------- produit non utilise ---------	</td></tr>"; $usedaff = 1;}
		
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
		<td><a href='produit?action=modif&id=" .  $produit->id_produit . "$allGET'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td>".$totaligne."</td>
		</tr>\n";
			$total = $total + (floatval($produit->stock) * floatval($produit->prix));
		$nblignemax++;
	}
	

	$texto .= "<tr><td colspan=14><center>Total en stock:  <b>".number_format($total, 2, ',', '')." &#8364;</b></center></td></tr>";
	
	
	
	$texto .= "</form></span></table>";

}
else{ 
		$texto .= "</table><br /><div><span class=\"box error corners\">Il n'y a aucun produit correspondant &agrave; &quot;<b>$que</b>&quot; dans la base produit</div>";
	}

	echo $texto;

?>