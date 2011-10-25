<?php
require("./config.php");
require_once("./db.class.php");
$date = date("d/m/Y");
setlocale(LC_TIME, 'fr_FR.utf8','fra');
$dadate = strftime("%A %d %B %Y");
$texto = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
	\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
$texto .= "<html xmlns=\"http://www.w3.org/1777/xhtml\"
	    xml:lang=\"fr\"
	    lang=\"fr\"
	    dir=\"ltr\">
<head>
<script language=\"javascript\" src=\"./chainedselects.js\"></script>
<meta content=\"text/html; Charset=UTF-8\" http-equiv=\"Content-Type\" />
<link rel=\"stylesheet\" href=\"./style.css\" type=\"text/css\" media=\"screen\" />
<title>
Gestion Stock en ligne: Produit
</title>
</head>

<body>";
include('./menu.php');
$texto .="<div style=\"padding:8px\">";
$texto .="<h1>Gestion des Stocks</h1>\n";
if(isset($_GET['mess'])){
$mess = $_GET['mess'];
}
else{
$mess="";
}

switch($mess){
	case "newprod";
	$texto .= "<span class=\"affichage\">Nouveau Produit enregistr&eacute;e</span><br /><br />";
	break;
	case "changeprod";
	$texto .= "<span class=\"affichage\">Produit modifi&eacute;e</span><br /><br />";
	break;
	case "effaceprod";
	$texto .= "<span class=\"affichage\">Produit supprim&eacute;</span><br /><br />";
	break;
	default;
	break;
}


$texto.= "<div><ul class=\"menu\">
			<li class=\"menu\"><a href=\"./gestion/titre\" >Titre</a> | </li>
			<li class=\"menu\"><a href=\"./gestion/categorie\" >Cat&eacute;gories</a> | </li>
			<li class=\"menu\"><a href=\"./gestion/fournisseur\" >Fournisseur</a> | </li>
			<li class=\"menu\"><a href=\"./gestion/produit\" >Produits</a></li>
			
			</ul><br /><br />
			<ul><li class=\"menu\" ><a onclick=\"window.open(this.href, '_blank'); return false;\" href=\"./gestion/commande\" >Imprimer Produit manquant</a></li></ul><br />
			</div>";
if(isset($_GET['action'])){
$laction = $_GET['action'];
}
else{
$laction="";
}

switch($laction){
	
	case "complet";
	$reqpre = new db();
	$reqpre->findquery("SELECT * FROM produit LEFT JOIN categ ON categ.id_categ=produit.id_categ  WHERE produit.stock<=produit.stock_mini AND produit.used=1 ORDER BY categ.categ");
	$texto.= "<table cellspacing=\"0\" >
	<tr>
	<th class=\"listingprod\">id</th>
	<th class=\"listingprod\">Categ</th>
	<th class=\"listingprod\">Produit</th>
	<th class=\"listingprod\">fournisseur</th>
	<th class=\"listingprod\">reference</th>
	<th class=\"listingprod\">condit.</th>
	<th class=\"listingprod\">prix</th>
	<th class=\"listingprod\">stock</th>
	<th class=\"listingprod\">stock mini</th>
	<th class=\"listingprod\">used</th>
	<th class=\"listingprod\">modifier</th>
	<th class=\"listingprod\">effacer</th>
	</tr>\n";
	$nblignemax = 1;
	while($produit = $reqpre->row()){
		$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
		if($produit->stock<$produit->stock_mini){
			$cololign = "class=\"stock\"";
		}
		if(($produit->stock)==($produit->stock_mini)){
			$cololign = "class=\"bientotstock\"";
		}
		$texto .= "<tr $cololign align='center'>
		<td> $produit->id_produit</td>
		<td> $produit->categ</td>
		<td> $produit->produit</td>
		<td> $produit->fournisseur</td>
		<td> $produit->reference</td>
		<td> $produit->conditionnement</td>
		<td> ".number_format($produit->prix, 2, ',', '')."</td>
		<td> $produit->stock</td>
		<td> $produit->stock_mini</td>
		<td>";
		$texto .= (($produit->used=="1")?"<img border='0' src='./img/check.gif' alt='used'>":"<img border='0' src='./img/uncheck.gif' alt='unused'>");
		$texto .= " </td>
		<td><a href='./gestion/categorie?action=modif&id=" .  $categ->id_categ . "'><img border='0' src='./img/pencil.gif' alt='modif'></a></td>
		<td><a href='./gestion/categorie?action=eff&id=" .  $categ->id_categ . "'><img border='0' src='./img/erase.png' alt='efface'></a></td>
		</tr>\n";
		$nblignemax++;
	}
	break;
	default;
	$reqpre = new db();
	$reqpre->findquery("SELECT *
		FROM produit, titre, categ, fournisseur
		WHERE categ.id_categ = produit.id_categ
		AND categ.id_titre = titre.id_titre
		AND produit.id_fournisseur = fournisseur.id_fournisseur AND  produit.stock<produit.stock_mini AND produit.used=1 ORDER BY produit.commande, produit.id_fournisseur");
	$texto.= "<span id=\"suggest\"><table cellspacing=\"0\" >
	<tr>
	<th class=\"listingprod\">Titre</th>
	<th class=\"listingprod\">Categ</th>
	<th class=\"listingprod\">Produit</th>
	<th class=\"listingprod\">fournisseur</th>
	<th class=\"listingprod\">reference</th>
	<th class=\"listingprod\">condit.</th>
	<th class=\"listingprod\">prix</th>
	<th class=\"listingprod\">stock</th>
	<th class=\"listingprod\">stk_mini</th>
	<th class=\"listingprod\">commande</th>
	<th class=\"listingprod\">commander</th>
	<th class=\"listingprod\">modif.</th>
	</tr>\n";
	$nblignemax = 1;
	while($produit = $reqpre->row()){
		$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
		if(($produit->used=="1") && ($produit->stock<$produit->stock_mini)){
			$cololign = "class=\"stock\"";
		}
		if($produit->commande=="1"){
			$cololign = "class=\"bientotstock\"";
		}
		$texto .= "<tr $cololign align='center'><form action=\"./gestion/passercommande\" method=\"post\">\n
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
		$texto .= "<input class=\"actif\" name=\"qtcommande\" style=\"width:30px\" value=\"".(($produit->quantite_commande=="0")?"":"$produit->quantite_commande")."\" /></td>
		<td><input name=\"action\" type=\"hidden\" value=\"commander\"><input name=\"lid\" type=\"hidden\" value=\"$produit->id_produit\">
		 <input type=\"submit\" name=\"submitbutton\" value=\"A commander\" id=\"submitbutton\"></td>";
		}
		else{
			$texto .= " $produit->quantite_commande </td>
			<td> En cours </td>";
		}
		$texto .= "<td><a href='./gestion/produit?action=modif&id=" .  $produit->id_produit . "'><img border='0' src='./img/pencil.gif' alt='modif'></a></td>
		</form></tr>\n";
		$nblignemax++;
	}
		$texto .= "</table>";
	break;
}

$texto .= "</div></body></html>";
echo $texto;
?>

