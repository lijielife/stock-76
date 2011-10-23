<?php
require("../config.php");
require_once("../db.class.php");
$date = date("d/m/Y");
setlocale(LC_TIME, "fr_FR");
$dadate = strftime("%A %d %B %Y");
$texto = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
	\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
$texto .= "<html xmlns=\"http://www.w3.org/1999/xhtml\"
	    xml:lang=\"fr\"
	    lang=\"fr\"
	    dir=\"ltr\">
<head>
<script type=\"text/javascript\" language=\"javascript\" src=\"../jquery.3.js\" charset=\"utf-8\"></script>

<meta content=\"text/html; Charset=UTF-8\" http-equiv=\"Content-Type\" />
<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\" media=\"screen\" />
<title>
Gestion Stock en ligne: Produit
</title>
</head>
<body>
<script type=\"text/javascript\" charset=\"utf-8\">
$(document).ready(function(){			
	$(\"#txt_search\").keyup(function()
	{
		var search;
		
		search = $(\"#txt_search\").val();
		if (search.length > 1)
		{
			$.ajax(
			{
				type: \"POST\",
				url: \"dictionary\",
				data: \"search=\" + search,
				success: function(message)
				{	
					$(\"#suggest\").empty();
			  		if (message.length > 0)
					{							
						$(\"#suggest\").append(message);
					}
				}
			});
		}
		else
		{
			$(\"#suggest\").empty();
		}
	});
});	
</script>";
include('../menu.php');
$texto .="<div style=\"padding:8px\">";
$texto .="<h1>Gestion Produit</h1>\n";
$mess = $_GET['mess'];
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
	case "commandeprod";
	$texto .= "<span class=\"affichage\">Produit command&eacute;</span><br /><br />";
	break;
	case "recuprod";
	$texto .= "<span class=\"affichage\">Produit re&ccedil;u</span><br /><br />";
	break;
	default;
	break;
}


$texto.= "<div><ul class=\"menu\">";
include('./minimenu.php');
$texto .="<ul class=\"sousmenu\">
			<li class=\"menu\" ><a href=\"./produit?action=add\" >Nouveau Produit</a> | </li>
			<li class=\"sousmenu\" ><a href=\"./produit?action=manquant\" >Produit manquant</a></li>
			</ul>
			<br />
			</div>";
			
switch($_GET['action']){
	case "add";
	$texto .="<h3>Cr&eacute;ation de Produit</h3>";
	$req = new db();
	$say = $req->findquery("SELECT * FROM  `fournisseur` WHERE id_fournisseur!=0 ORDER BY id_fournisseur");
	$lesfourn ="<option value=\"0\">choisir un fournisseur</option>\n";
	while($fourn = $req->row()){
	$lesfourn .= "<option value=\"$fourn->id_fournisseur\">".htmlentities($fourn->fournisseur)."</option>\n";
	}
	
	
	$catcat="";
	$req->findquery("SELECT categ.*, titre.titre FROM categ, titre WHERE categ.id_titre=titre.id_titre ORDER BY titre.id_titre, categ.categ");
	$titid = 0;
	while($categ = $req->row()){
		if($titid!=$categ->id_titre && $titid!=0){
			$catcat .="</optgroup>\n";
		}
		if($titid!=$categ->id_titre){
		
			$catcat .="<optgroup label=\"".$categ->titre."\">\n";
		}
	$catcat .="<option value=\"".$categ->id_categ."\" >".$categ->categ."</option>\n";
	
	$titid = $categ->id_titre;
	}
		$catcat .="</optgroup>\n";
		
	$texto .="<form method=\"post\" action=\"./save\" accept-charset=\"utf-8\">
	<input type=\"hidden\" name=\"action\" value=\"newprod\" />
	<label for=\"categorie\">Categorie :</label><select name=\"categorie\" id=\"categorie\" style=\"width:160px;\">\n$catcat\n</select><br /><label for=\"produit\">Produit : </label><input class=\"actif\" type=\"text\" name=\"produit\" value=\"\" id=\"produit\" /><br />
	<label for=\"fournisseur\">Fournisseur : </label><select class=\"actif\" name=\"fournisseur\" id=\"fournisseur\" >$lesfourn</select><br />
	<label for=\"reference\">Reference : </label><input class=\"actif\" type=\"text\" name=\"reference\" value=\"\" id=\"reference\" /><br />
	<label for=\"conditionnement\">Conditionnement : </label><input class=\"actif\" type=\"text\" name=\"conditionnement\" value=\"\" id=\"conditionnement\" /><br />
	<label for=\"prix\">Prix : </label><input class=\"actif\" type=\"text\" name=\"prix\" value=\"\" id=\"prix\" />Euros TTC<br />
	<label for=\"stock\">stock : </label><input class=\"actif\" type=\"text\" name=\"stock\" value=\"\" id=\"stock\" /><br />
	<label for=\"stock_mini\">stock_mini : </label><input class=\"actif\" type=\"text\" name=\"stock_mini\" value=\"\" id=\"stock_mini\" /><br />	
	<label for=\"quantite_commande\">quantite command&eacute;e : </label><input class=\"actif\" type=\"text\" name=\"quantite_commande\" value=\"\" id=\"quantite_commande\" /><br />	
	<label for=\"used\">produit utilis&eacute; : </label><input class=\"actif\" type=\"checkbox\" name=\"used\" value=\"1\" id=\"used\" /><br />
	<label for=\"commande\">commande en cours : </label><input class=\"actif\"  type=\"checkbox\" name=\"commande\" value=\"1\" id=\"commande\" /><br />
	<br />
	<input type=\"submit\" name=\"submitbutton\" value=\"valider\" /><input type=\"button\" name=\"cancel\" value=\"annuler\" onclick=\"history.back()\" />
	</form>";
	break;
	case "modif";
	$texto .="<h3>Modification de Produit</h3>";
	$req = new db();
	$req->findone('produit', $_GET['id']);
	$leproduit = $req->row();
	
	$say = $req->findquery("SELECT * FROM  `fournisseur` WHERE id_fournisseur!=0 ORDER BY id_fournisseur");
	$lesfourn ="<option value=\"0\">choisir un fournisseur</option>\n";
	while($fourn = $req->row()){
			$selec = (($leproduit->id_fournisseur==$fourn->id_fournisseur)?"SELECTED":"");
	$lesfourn .= "<option $selec value=\"$fourn->id_fournisseur\">$fourn->fournisseur</option>\n";
	}

	$catcat="";
	$req->findquery("SELECT categ.*, titre.titre FROM categ, titre WHERE categ.id_titre=titre.id_titre ORDER BY titre.id_titre, categ.categ");
	$titid = 0;
	while($categ = $req->row()){
		if($titid!=$categ->id_titre && $titid!=0){
			$catcat .="</optgroup>\n";
		}
		if($titid!=$categ->id_titre){
		
			$catcat .="<optgroup label=\"".$categ->titre."\">\n";
		}
		if($leproduit->id_categ==$categ->id_categ){}
		$selec = (($leproduit->id_categ==$categ->id_categ)?"SELECTED":"");
	$catcat .="<option $selec value=\"".$categ->id_categ."\" >".$categ->categ."</option>\n";
	
	$titid = $categ->id_titre;
	}
		$utilise = (($leproduit->used==1)?"CHECKED":"");
		$commande = (($leproduit->commande==1)?"CHECKED":"");
	$texto .="<form method=\"post\" action=\"./save\" accept-charset=\"utf-8\">
	<input type=\"hidden\" name=\"lid\" value=\"".$_GET['id']."\">
	<input type=\"hidden\" name=\"queque\" value=\"".$_GET['search']."\">
	<input type=\"hidden\" name=\"action\" value=\"modprod\">
	<label for=\"categorie\">Categorie :</label><select name=\"categorie\" style=\"width:160px;\">\n$catcat\n</select><br />
	<label for=\"produit\">Produit : </label><input class=\"actif\" type=\"text\" name=\"produit\" value=\"$leproduit->produit\" id=\"produit\" /><br />
	<label for=\"fournisseur\">Fournisseur : </label><select class=\"actif\" name=\"fournisseur\" id=\"fournisseur\">$lesfourn</select><br />
		<label for=\"reference\">Reference : </label><input class=\"actif\" type=\"text\" name=\"reference\" value=\"$leproduit->reference\" id=\"reference\" /><br />
	<label for=\"conditionnement\">Conditionnement : </label><input class=\"actif\" type=\"text\" name=\"conditionnement\" value=\"$leproduit->conditionnement\" id=\"conditionnement\" /><br />
	<label for=\"prix\">Prix : </label><input class=\"actif\" type=\"text\" name=\"prix\" value=\"".number_format($leproduit->prix, 2, ',', '')."\" id=\"prix\" />Euros TTC<br />
	<label for=\"stock\">stock : </label><input class=\"actif\" type=\"text\" name=\"stock\" value=\"$leproduit->stock\" id=\"stock\" /><br />
	<label for=\"stock_mini\">stock_mini : </label><input class=\"actif\" type=\"text\" name=\"stock_mini\" value=\"$leproduit->stock_mini\" id=\"stock_mini\" /><br />
	<label for=\"quantite_commande\">quantite command&eacute;e : </label><input class=\"actif\" type=\"text\" name=\"quantite_commande\" value=\"$leproduit->quantite_commande\" id=\"stock_mini\" /><br />	
	<label for=\"used\">produit utilis&eacute; : </label><input class=\"actif\" $utilise type=\"checkbox\" name=\"used\" value=\"1\" id=\"used\" /><br />
	<label for=\"commande\">commande en cours : </label><input class=\"actif\" $commande type=\"checkbox\" name=\"commande\" value=\"1\" id=\"commande\" /><br />
	<br /><input type=\"submit\" name=\"submitbutton\" value=\"valider\" /><input type=\"button\" name=\"cancel\" value=\"annuler\" onclick=\"history.back()\" /></form>
	<br /><hr /><form method=\"post\" action=\"produit?action=eff&id=" .  $leproduit->id_produit . "\"> <input type=\"submit\" value=\"supprimer\"> </form>";
	break;
	case "eff";
	$texto .="<h3>Suppression de produit</h3>";
	$texto .=  "<span class=\"affichage\">Attention vous allez effacer un produit, son stock ne pourra plus etre suivi </span><br /><br />";
	$req = new db();
	$req->findone('produit', $_GET['id']);
	$leprod = $req->row();
	$texto .="<form method=\"post\" action=\"./save\"><input type=\"hidden\" name=\"lid\" value=\"".$_GET['id']."\"><input type=\"hidden\" name=\"action\" value=\"effprod\"><span class=\"affichage\">Etes-vous sur de vouloir supprimer ce produit :</span > <b>$leprod->produit</b>
	<input type=\"submit\" name=\"submitbutton\" value=\"Supprimer\" id=\"submitbutton\">	<input type=\"button\" name=\"cancel\" value=\"annuler\" onclick=\"history.back()\"></form>";
	break;
	case "manquant";
	$texto .="<br /><A href=\"./commande\">Liste Imprimable</A><br />";
	$reqpre = new db();
	$reqpre->findquery("SELECT *
		FROM produit, titre, categ, fournisseur
		WHERE categ.id_categ = produit.id_categ
		AND categ.id_titre = titre.id_titre
		AND produit.id_fournisseur = fournisseur.id_fournisseur AND  (produit.stock<produit.stock_mini OR produit.commande=1) AND produit.used=1 ORDER BY produit.commande, produit.id_fournisseur");
	$total = 0;
	$texto.= "<form name=\"cherch\" action=\"./produit?action=search\" method=\"post\" accept-charset=\"utf-8\">
	<p>	<input autocomplete=\"off\"  class=\"actif\" type=\"text\" id=\"txt_search\" name=\"search\" value=\"\"><input type=\"submit\" value=\"rechercher\"></p>
	</form><span id=\"suggest\"><table cellspacing=\"0\" >
	<tr>
	<th class=\"listingprod\">Titre</th>
	<th class=\"listingprod\">Categ</th>
	<th class=\"listingprod\">Produit</th>
	<th class=\"listingprod\">fourn.</th>
	<th class=\"listingprod\">reference</th>
	<th class=\"listingprod\">condit.</th>
	<th class=\"listingprod\">prix</th>
	<th class=\"listingprod\">stock</th>
	<th class=\"listingprod\">stk_mini</th>
	<th class=\"listingprod\">commande</th>
	<th class=\"listingprod\">commander</th>
	<th class=\"listingprod\">modif.</th>
	<th class=\"listingprod\">&#8364;</th>
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
		$tot = floatval($produit->stock) * floatval($produit->prix);
		$totaligne = number_format($tot, 2, ',', '');
		$texto .= "<tr $cololign align='center'><form action=\"./passercommande\" method=\"post\">\n
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
		$texto .= "<input class=\"actif\" name=\"qtcommande\" size=\"4\" value=\"".(($produit->quantite_commande=="0")?"":"$produit->quantite_commande")."\" /></td>
		<td><input name=\"action\" type=\"hidden\" value=\"commander\"><input name=\"lid\" type=\"hidden\" value=\"$produit->id_produit\">
		 <input type=\"submit\" name=\"submitbutton\" value=\"A commander\" id=\"submitbutton\"></td>";
		}
		else{
			$texto .= " $produit->quantite_commande </td>
			<td> En cours </td>";
		}
		$texto .= "<td><a href='produit?action=modif&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		</form>
		<td>".$totaligne."</td>
		</tr>\n";
		$total = $total + (floatval($produit->stock) * floatval($produit->prix));
		$nblignemax++;
	}
		$texto .= "<tr><td colspan=13><center>Total en stock:  <b>".number_format($total, 2, ',', '')." &#8364;</b></center></td></tr>";
		$texto .= "</table>";
	break;
	case "only";
	$reqpre = new db();
	$cat = $_GET['id'];
	$total = 0;
	$laquery = "SELECT *
	FROM produit, titre, categ, fournisseur
	WHERE categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur AND categ.id_categ=$cat ORDER BY categ.categ";
	$fournini = $_GET['fournini'];
	if ($_GET['fournini']!=""){
	
		$laquery = "SELECT *
			FROM produit, titre, categ, fournisseur
			WHERE categ.id_categ = produit.id_categ
			AND categ.id_titre = titre.id_titre
			AND produit.id_fournisseur = fournisseur.id_fournisseur AND fournisseur.id_fournisseur=$fournini ORDER BY produit.produit";
	}
	$reqpre->findquery($laquery);
	$texto.= "<form name=\"cherch\" action=\"./produit?action=search\" method=\"post\" accept-charset=\"utf-8\">
	<p>	<input autocomplete=\"off\"  class=\"actif\" type=\"text\" id=\"txt_search\" name=\"search\" value=\"\"><input type=\"submit\" value=\"rechercher\"></p>
	</form><span id=\"suggest\"><table cellspacing=\"0\" >
	<tr>
	<th class=\"listingprod\">titre</th>
	<th class=\"listingprod\">Categ</th>
	<th class=\"listingprod\">Produit</th>
	<th class=\"listingprod\">fourn.</th>
	<th class=\"listingprod\">reference</th>
	<th class=\"listingprod\">condit.</th>
	<th class=\"listingprod\">prix</th>
	<th class=\"listingprod\">stock</th>
	<th class=\"listingprod\">stk_mini</th>
	<th class=\"listingprod\">commande</th>
	<th class=\"listingprod\">used</th>
	<th class=\"listingprod\">modif.</th>
	<th class=\"listingprod\">&#8364;</th>
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
		$tot = floatval($produit->stock) * floatval($produit->prix);
		$totaligne = number_format($tot, 2, ',', '');
		$texto .= "<tr $cololign align='center'>
		<td> $produit->id_titre</td>
		<td> $produit->categ</td>
		<td> $produit->produit</td>
		<td> $produit->fournisseur</td>
		<td> $produit->reference</td>
		<td> $produit->conditionnement</td>
		<td>".number_format($produit->prix, 2, ',', '')."</td>
		<td> <b>$produit->stock</b></td>
		<td> $produit->stock_mini</td>
		<td> $produit->quantite_commande</td>
		<td>";
		$texto .= (($produit->used=="1")?"<img border='0' src='../img/check.gif' alt='used'>":"<img border='0' src='../img/uncheck.gif' alt='unused'>");
		$texto .= " </td>
		<td><a href='produit?action=modif&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td>".$totaligne."</td>
		</tr>\n";
		$total = $total + (floatval($produit->stock) * floatval($produit->prix));
		$nblignemax++;
	}
		$texto .= "<tr><td colspan=13><center>Total en stock:  <b>".number_format($total, 2, ',', '')." &#8364;</b></center></td></tr>";
		$texto .= "</table>";
	break;
	case "classer";
	$total = 0;
	$reqpre = new db();
	$ordre = $_GET['ordre'];
	switch ($_GET['ordre']) {
		case 'id_categ':
			$ordre ="produit.".$_GET['ordre'];
			break;
		case 'id_titre':
			$ordre ="categ.".$_GET['ordre'];
		break;
		case 'id_fournisseur':
			$ordre ="produit.".$_GET['ordre'];
		break;
		case 'produit':
			$ordre ="produit.".$_GET['ordre'];
		break;
		case 'stock':
			$ordre ="produit.stock DESC";
			break;
		case 'prix':
			$ordre ="produit.prix DESC";
			break;
		default:
			$ordre ="produit.produit";
		break;
	}	
		if($_GET['search']){
		$que=$_GET['search'];
		$quoi ="&search=" . $que;
		$whair = "(produit.produit LIKE '%$que%' OR fournisseur.fournisseur LIKE '%$que%' OR produit.reference LIKE '%$que%' OR categ.categ LIKE '%$que%')";
	}
	else {
		$whair=1;
		$quoi="";
		}
		
	$reqpre->findquery("SELECT *
		FROM produit, titre, categ, fournisseur
		WHERE categ.id_categ = produit.id_categ
		AND categ.id_titre = titre.id_titre
		AND produit.id_fournisseur = fournisseur.id_fournisseur AND $whair
	 ORDER BY $ordre");
	$texto.= "<form name=\"cherch\" action=\"./produit?action=search\" method=\"post\" accept-charset=\"utf-8\">
	<p>	<input autocomplete=\"off\"  class=\"actif\" type=\"text\" id=\"txt_search\" name=\"search\" value=\"\"><input type=\"submit\" value=\"rechercher\"></p>
	</form><span id=\"suggest\"><table cellspacing=\"0\" >
	<tr>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_titre$quoi'>".(($ordre=="id_titre")?"&#9679;":"")."Titre</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_categ$quoi'>".(($ordre=="id_categ")?"&#9679;":"")."Categ</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=produit$quoi'>".(($ordre=="produit")?"&#9679;":"")."Produit</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_fournisseur$quoi'>".(($ordre=="fournisseur")?"&#9679;":"")."fourn.</a></th>
	<th class=\"listingprod\">reference</th>
	<th class=\"listingprod\">condit.</th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=prix$quoi'>".(($ordre=="prix")?"&#9679;":"")."prix</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=stock$quoi'>".(($ordre=="stock")?"&#9679;":"")."stock</a></th>
	<th class=\"listingprod\">stk_mini</th>
	<th class=\"listingprod\">commande</th>
	<th class=\"listingprod\">used</th>
	<th class=\"listingprod\">modif.</th>
	<th class=\"listingprod\">&#8364;</th>
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
		$tot = floatval($produit->stock) * floatval($produit->prix);
		$totaligne = number_format($tot, 2, ',', '');
		$texto .= "<tr $cololign align='center'>
		<td> $produit->titre</td>
		<td> $produit->categ</td>
		<td> $produit->produit</td>
		<td> $produit->fournisseur</td>
		<td> $produit->reference</td>
		<td> $produit->conditionnement</td>
		<td>".number_format($produit->prix, 2, ',', '')."</td>
		<td> <b>$produit->stock</b></td>
		<td> $produit->stock_mini</td>
		<td> $produit->quantite_commande</td>
		<td>";
		$texto .= (($produit->used=="1")?"<img border='0' src='../img/check.gif' alt='used'>":"<img border='0' src='../img/uncheck.gif' alt='unused'>");
		$texto .= " </td>
		<td><a href='produit?action=modif&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td>".$totaligne."</td>
		</tr>\n";
		$total = $total + (floatval($produit->stock) * floatval($produit->prix));
		$nblignemax++;
	}
		$texto .= "<tr><td colspan=13><center>Total en stock:  <b>".number_format($total, 2, ',', '')." &#8364;</b></center></td></tr>";
		$texto .= "</table>";
	break;
	case "search";
	$total = 0;
	$que = $_POST['search'];
	$reqpre = new db();
	$whair = "(produit.produit LIKE '%$que%' OR fournisseur.fournisseur LIKE '%$que%' OR produit.reference LIKE '%$que%' OR categ.categ LIKE '%$que%')";
	$reqpre->findquery("SELECT *
		FROM produit, titre, categ, fournisseur
		WHERE categ.id_categ = produit.id_categ
		AND categ.id_titre = titre.id_titre
		AND produit.id_fournisseur = fournisseur.id_fournisseur AND $whair
	 ORDER BY categ.categ ASC");
	$texto.= "<form name=\"cherch\" action=\"./produit?action=search\" method=\"post\" accept-charset=\"utf-8\">
	<p>	<input autocomplete=\"off\"  class=\"actif\" type=\"text\" id=\"txt_search\" name=\"search\" value=\"\"><input type=\"submit\" value=\"rechercher\"></p>
	</form>
	<i>recherche pour : <b>$que</b></i><span id=\"suggest\"><table cellspacing=\"0\" >
	<tr>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_titre&search=$que'>Titre</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_categ&search=$que'>Categ</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=produit&search=$que'>Produit</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_fournisseur&search=$que'>fourn.</a></th>
	<th class=\"listingprod\">reference</th>
	<th class=\"listingprod\">condit.</th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=prix&search=$que'>prix</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=stock&search=$que'>stock</a></th>
	<th class=\"listingprod\">stk_mini</th>
	<th class=\"listingprod\">commande</th>
	<th class=\"listingprod\">used</th>
	<th class=\"listingprod\">modif</th>
	<th class=\"listingprod\">&#8364;</th>
	</tr>\n";
	if(($reqpre->__get('numrows'))!=0){
	$nblignemax = 1;
	while($produit = $reqpre->row()){
		$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
		if(($produit->used=="1") && ($produit->stock<$produit->stock_mini)){
			$cololign = "class=\"stock\"";
		}
		if($produit->commande=="1"){
			$cololign = "class=\"bientotstock\"";
		}
			$tot = floatval($produit->stock) * floatval($produit->prix);
			$totaligne = number_format($tot, 2, ',', '');
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
		<td>";
		$texto .= (($produit->used=="1")?"<img border='0' src='../img/check.gif' alt='used'>":"<img border='0' src='../img/uncheck.gif' alt='unused'>");
		$texto .= " </td>
		<td><a href='produit?action=modif&search=$que&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td>".$totaligne."</td>
		</tr>\n";
		$total = $total + (floatval($produit->stock) * floatval($produit->prix));
		$nblignemax++;
	}		
		$texto .= "<tr><td colspan=13><center>Total en stock:  <b>".number_format($total, 2, ',', '')." &#8364;</b></center></td></tr>";
		$texto .= "</span></table>";
	}
	else{ 
			$texto .= "</table><br /><span class=\"affichage\">Il n'y a aucun produit correspondant &agrave; &quot;<b>$que</b>&quot; dans la base produit</span>";
		}

	break;
	default;
	$reqpre = new db();
	$reqpre->findquery("SELECT * 
	FROM produit, titre, categ, fournisseur
	WHERE categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur
	ORDER BY categ.categ ASC");
	$total = 0;
	$texto.= "<form name=\"cherch\" action=\"./produit?action=search\" method=\"post\" accept-charset=\"utf-8\">
	<p>	<input  autocomplete=\"off\" class=\"actif\" type=\"text\" id=\"txt_search\" name=\"search\" value=\"\"><input type=\"submit\" value=\"rechercher\"></p>
	</form><span id=\"suggest\"><table cellspacing=\"0\" >
	<tr>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_titre'>Titre</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_categ'>Categ</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=produit'>Produit</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_fournisseur'>Fourn</a></th>
	<th class=\"listingprod\">reference</th>
	<th class=\"listingprod\">condit.</th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=prix'>prix</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=stock'>stock</a></th>
	<th class=\"listingprod\">stk_mini</th>
	<th class=\"listingprod\">commande</th>
	<th class=\"listingprod\">used</th>
	<th class=\"listingprod\"><img border='0' src='../img/pencil.gif' alt='modif'></th>
	<th class=\"listingprod\">&#8364;</th>
	</tr>\n";
	$nblignemax = 1;
	while($produit = $reqpre->row()){
		$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
		if(($produit->used=="1") && ($produit->stock<$produit->stock_mini)){
			$cololign = "class=\"stock\"";
		}
		if(($produit->used=="1") && ($produit->commande=="1")){
				$cololign = "class=\"bientotstock\"";
			}
		$tot = floatval($produit->stock) * floatval($produit->prix);
		$totaligne = number_format($tot, 2, ',', '');
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
		<td>";
		$texto .= (($produit->used=="1")?"<img border='0' src='../img/check.gif' alt='used'>":"<img border='0' src='../img/uncheck.gif' alt='unused'>");
		$texto .= " </td>
		<td><a href='produit?action=modif&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td>".$totaligne."</td>
		</tr>\n";
			$total = $total + (floatval($produit->stock) * floatval($produit->prix));
		$nblignemax++;
	}
	
	
	//---- produit sans categ ou sans fournisseur sans titre correspondant ayant un pb de relation d'une table à l'autre
		$texto .= "<tr class=\"stock\" align='center'>
		<td  colspan=\"13\"> ------- produit ayant un pb de categorie ---------	</td></tr>";
	$bla = $reqpre->findquery("SELECT * FROM produit
		WHERE NOT EXISTS (SELECT * FROM categ WHERE produit.id_categ = categ.id_categ)");
	
	while($produit = $reqpre->row()){
		$tot = floatval($produit->stock) * floatval($produit->prix);
		$totaligne = number_format($tot, 2, ',', '');
		$texto .= "<tr align='center'>
		<td> &nbsp; </td>
		<td> $produit->id_categ</td>
		<td> $produit->produit</td>
		<td> $produit->fournisseur</td>
		<td> $produit->reference</td>
		<td> $produit->conditionnement</td>
		<td> ".number_format($produit->prix, 2, ',', '')."</td>
		<td> <b>$produit->stock</b></td>
		<td> $produit->stock_mini</td>
		<td> $produit->quantite_commande</td>
		<td> $produit->used</td>
		<td><a href='produit?action=modif&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td>".$totaligne."</td>
		</tr>\n";
		$total = $total + (floatval($produit->stock) * floatval($produit->prix));
	}
		$texto .= "<tr class=\"stock\" align='center'>
		<td  colspan=\"13\"> ------- produit ayant un pb de fournisseur ---------	</td></tr>";
	$bla = $reqpre->findquery("SELECT * FROM produit
		WHERE NOT EXISTS (SELECT * FROM fournisseur WHERE produit.id_fournisseur = fournisseur.id_fournisseur)");
	while($produit = $reqpre->row()){
		$tot = floatval($produit->stock) * floatval($produit->prix);
		$totaligne = number_format($tot, 2, ',', '');
		$texto .= "<tr align='center'>
		<td> &nbsp; </td>
		<td> $produit->id_categ</td>
		<td> $produit->produit</td>
		<td> $produit->id_fournisseur</td>
		<td> $produit->reference</td>
		<td> $produit->conditionnement</td>
		<td> ".number_format($produit->prix, 2, ',', '')."</td>
		<td> <b>$produit->stock</b></td>
		<td> $produit->stock_mini</td>
		<td> $produit->quantite_commande</td>
		<td> $produit->used</td>
		<td><a href='produit?action=modif&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td>".$totaligne."</td>
		</tr>\n";
		$total = $total + (floatval($produit->stock) * floatval($produit->prix));
	}
	
	$texto .= "<tr><td colspan=13><center>Total en stock:  <b>".number_format($total, 2, ',', '')." &#8364;</b></center></td></tr>";
	//------fin pb
	
	
	$texto .= "</span></table>";
	break;
}

$texto .= "</div>
</body>
</html>";
echo $texto;
?>

