﻿<?php
require("../config.php");
require_once("../db.class.php");
$date = date("d/m/Y");
$laction=(isset($_GET['action']))?$_GET['action']:"";
switch ($laction) {
	case 'add';
	$rajout = "nouveau";
	break;
	case 'eff';
	$rajout = "suppression";
	break;
	case 'manquant';
	$rajout = "manquant";
	break;
	case 'only';
	$rajout = "catégorie";
	break;
	case 'search';
	$rajout = "recherche";
	break;
	case 'modif';
	$rajout = "modification";
	break;
	case 'classer';
	$rajout = "classement";
	break;
	case 'commander';
	$rajout = "classement";
	break;
	default;
	$rajout = "Tous";
	break;
}
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
Gestion Stock en ligne: Produit: $rajout
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
$texto .="<h1>Gestion Produit: $rajout</h1>\n";
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
			<li class=\"sousmenu\" ><a href=\"./produit?action=manquantcommande\" >Commande de Produit</a></li>
			</ul>
			<br />
			</div>";
			
switch($laction){
	case "add";
	$texto .="<h3>Cr&eacute;ation de Produit</h3>";
	$req = new db();
	$say = $req->findquery("SELECT * FROM  `fournisseur` WHERE id_fournisseur!=0 ORDER BY fournisseur");
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
		$today = date("d/m/Y");
	$texto .="<form method=\"post\" name='creation' action=\"./save\" accept-charset=\"utf-8\">
			<FIELDSET align=\"left\"> 
			    <LEGEND>Infos produits</LEGEND>
	<input type=\"hidden\" name=\"action\" value=\"newprod\" />
	<label for=\"categorie\">Categorie :</label><select name=\"categorie\" id=\"categorie\" style=\"width:160px;\">\n$catcat\n</select><br /><label for=\"produit\">Produit : </label><input class=\"actif\" type=\"text\" name=\"produit\" value=\"\" id=\"produit\" /><br />
	<label for=\"fournisseur\">Fournisseur : </label><select class=\"actif\" name=\"fournisseur\" id=\"fournisseur\" >$lesfourn</select><br />
	<label for=\"reference\">Reference : </label><input class=\"actif\" type=\"text\" name=\"reference\" value=\"\" id=\"reference\" /><br />
	<label for=\"conditionnement\">Conditionnement : </label><input class=\"actif\" type=\"text\" name=\"conditionnement\" value=\"\" id=\"conditionnement\" /><br />
	<label for=\"used\">produit utilis&eacute; : </label><input class=\"actif\" CHECKED type=\"checkbox\" name=\"used\" value=\"1\" id=\"used\" /><br />
	</FIELDSET>
	<br />
	<FIELDSET align=\"left\"> 
	    <LEGEND>prix et stock</LEGEND>
	<label for=\"prix\">Prix : </label><input class=\"actif\" type=\"text\" name=\"prix\" value=\"\" id=\"prix\" />Euros TTC<br />
	<label for=\"stock\">stock : </label><input class=\"actif\" type=\"text\" name=\"stock\" value=\"\" id=\"stock\" /><br />
	<label for=\"stock_mini\">stock_mini : </label><input class=\"actif\" type=\"text\" name=\"stock_mini\" value=\"\" id=\"stock_mini\" /><br />	
	</FIELDSET>
	<br />
	<FIELDSET align=\"left\"> 
	    <LEGEND>Commande</LEGEND>
	<label for=\"commande\">commande en cours : </label><input class=\"actif\"  type=\"checkbox\" name=\"commande\" value=\"1\" id=\"commande\" /><br />
	<label for=\"quantite_commande\">quantite command&eacute;e : </label><input class=\"actif\" type=\"text\" name=\"quantite_commande\" value=\"\" id=\"quantite_commande\" /><br />	
	<br />
		</FIELDSET> 
	<input type=\"submit\" name=\"submitbutton\" value=\"valider\" /><input type=\"button\" name=\"cancel\" value=\"annuler\" onclick=\"history.back()\" />
	</form>";
	break;
	case "modif";
	$texto .="<h3>Modification de Produit</h3>";
	$req = new db();
	$req->findone('produit', $_GET['id']);
	$leproduit = $req->row();
	
	$say = $req->findquery("SELECT * FROM  `fournisseur` WHERE id_fournisseur!=0 ORDER BY fournisseur");
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
		list ($year, $month, $day) = explode ("-", $leproduit->date_commande);
		$laladate = $day ."/".$month ."/".$year;
		if($leproduit->date_commande=="0000-00-00"){$laladate="";}
		$today = date("d/m/Y");
	$texto .="<SCRIPT LANGUAGE=\"JavaScript\">
		<!--
			function comdate(){
				var theform = document.forms[\"modification\"];
				var champs1 = \"commande\";
				var champs2 = \"date_commande\";
				
			  if(theform.elements[champs1].checked==true){
				theform.elements[champs2].value='$today';
			}
			else{
				theform.elements[champs2].value='';
			}

			}
		-->
		</SCRIPT>";	
		
$getid=(isset($_GET['id']))?$_GET['id']:"";
$getsearch=(isset($_GET['search']))?$_GET['search']:"";
$getoldid=(isset($_GET['oldid']))?$_GET['oldid']:"";
$getoldfourni=(isset($_GET['oldfourni']))?$_GET['oldfourni']:"";
$getoldact=(isset($_GET['oldact']))?$_GET['oldact']:"";
$getoldordre=(isset($_GET['oldordre']))?$_GET['oldordre']:"";
	$texto .="<form method=\"post\" name='modification' action=\"./save\" accept-charset=\"utf-8\">
		<FIELDSET align=\"left\"> 
		    <LEGEND>Infos produits</LEGEND>
	<input type=\"hidden\" name=\"lid\" value=\"".$getid."\">
	<input type=\"hidden\" name=\"queque\" value=\"".$getsearch."\">
	<input type=\"hidden\" name=\"action\" value=\"modprod\">
	<input type=\"hidden\" name=\"oldid\" value=\"".$getoldid."\">
	<input type=\"hidden\" name=\"oldfourni\" value=\"".$getoldfourni."\">
	<input type=\"hidden\" name=\"oldaction\" value=\"".$getoldact."\">
		<input type=\"hidden\" name=\"oldordre\" value=\"".$getoldordre."\">
	
	<label for=\"categorie\">Categorie :</label><select name=\"categorie\" style=\"width:160px;\">\n$catcat\n</select><br />
	<label for=\"produit\">Produit : </label><input class=\"actif\" type=\"text\" name=\"produit\" value=\"$leproduit->produit\" id=\"produit\" /><br />
	<label for=\"fournisseur\">Fournisseur : </label><select class=\"actif\" name=\"fournisseur\" id=\"fournisseur\">$lesfourn</select><br />
		<label for=\"reference\">Reference : </label><input class=\"actif\" type=\"text\" name=\"reference\" value=\"$leproduit->reference\" id=\"reference\" /><br />
	<label for=\"conditionnement\">Conditionnement : </label><input class=\"actif\" type=\"text\" name=\"conditionnement\" value=\"$leproduit->conditionnement\" id=\"conditionnement\" /><br />
	<label for=\"used\">produit utilis&eacute; : </label><input class=\"actif\" $utilise type=\"checkbox\" name=\"used\" value=\"1\" id=\"used\" />
	</FIELDSET>
	<br />
	<FIELDSET align=\"left\"> 
	    <LEGEND>prix et stock</LEGEND>
	<label for=\"prix\">Prix : </label><input class=\"actif\" type=\"text\" name=\"prix\" value=\"".number_format($leproduit->prix, 2, ',', '')."\" id=\"prix\" />Euros TTC<br />
	<label for=\"stock\">stock : </label><input class=\"actif\" type=\"text\" name=\"stock\" value=\"$leproduit->stock\" id=\"stock\" /><br />
	<label for=\"stock_mini\">stock_mini : </label><input class=\"actif\" type=\"text\" name=\"stock_mini\" value=\"$leproduit->stock_mini\" id=\"stock_mini\" />
	</FIELDSET>
	<br />
	<FIELDSET align=\"left\"> 
	    <LEGEND>Commande</LEGEND>
	<label for=\"commande\">commande en cours : </label><input class=\"actif\" $commande type=\"checkbox\" OnClick=\"comdate();\" name=\"commande\" value=\"1\" id=\"commande\" /><br />
	<label for=\"quantite_commande\">quantite command&eacute;e : </label><input class=\"actif\" type=\"text\" name=\"quantite_commande\" value=\"$leproduit->quantite_commande\" id=\"stock_mini\" /><br />	
	<label for=\"date_commande\">Date de commande : </label><input class=\"actif\" type=\"text\" name=\"date_commande\" value=\"$laladate\" id=\"date_commande\" /> <code>jj/mm/aaaa </code>
	</FIELDSET>
	<br />
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"submitbutton\" value=\"valider\" /><input type=\"button\" name=\"cancel\" value=\"annuler\" onclick=\"history.back()\" /></form>
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
	$texto .="<br /><A onclick=\"window.open(this.href, '_blank'); return false;\" href=\"./commande\">Liste Imprimable</A><br />";
	$reqpre = new db();
	$reqpre->findquery("SELECT *
		FROM produit, titre, categ, fournisseur
		WHERE categ.id_categ = produit.id_categ
		AND categ.id_titre = titre.id_titre
		AND produit.id_fournisseur = fournisseur.id_fournisseur AND  (produit.stock<produit.stock_mini OR produit.commande=1) AND produit.used=1 ORDER BY produit.commande, produit.id_fournisseur");
	$total = 0;
	$previouscommande=false;
	$texto.= "<form name=\"cherch\" action=\"./produit?action=search\" method=\"post\" accept-charset=\"utf-8\">
	<p>	<input autocomplete=\"off\"  class=\"actif\" type=\"text\" id=\"txt_search\" name=\"search\" value=\"\"><input type=\"submit\" value=\"rechercher\"></p>
	</form><span id=\"suggest\">
	<form action=\"./produit?action=commander\" method=\"post\">
  <table cellspacing=\"0\" style=\"clear:both\" >
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
	<th class=\"listingprod\">QT_CMD</th>
	<th class=\"listingprod\">Date</th>
	<th class=\"listingprod\">modif</th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=totalprix'>&#8364;</a></th>
	</tr>\n";
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
	break;
	case "only";
	$reqpre = new db();
	$cat = $_GET['id'];
	$rarajout= "&oldid=".$cat;
	$fournini = $_GET['fournini'];
	$total = 0;
	$laquery = "SELECT *
	FROM produit, titre, categ, fournisseur
	WHERE categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur AND categ.id_categ=$cat ORDER BY produit.produit";
	
	if ($_GET['fournini']!=""){
	$rarajout= "&oldfourni=".$fournini;
		$laquery = "SELECT *
			FROM produit, titre, categ, fournisseur
			WHERE categ.id_categ = produit.id_categ
			AND categ.id_titre = titre.id_titre
			AND produit.id_fournisseur = fournisseur.id_fournisseur AND fournisseur.id_fournisseur=$fournini ORDER BY produit.produit";
	}
	$reqpre->findquery($laquery);
	$texto.= "<form name=\"cherch\" action=\"./produit?action=search\" method=\"post\" accept-charset=\"utf-8\">
	<p>	<input autocomplete=\"off\"  class=\"actif\" type=\"text\" id=\"txt_search\" name=\"search\" value=\"\"><input type=\"submit\" value=\"rechercher\"></p>
	</form>
	<form action=\"./produit?action=commander\" method=\"post\"
	<span id=\"suggest\"><table cellspacing=\"0\" >
	<tr>
	<th class=\"listingprod\">titre</th>
	<th class=\"listingprod\">Categ</th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=produit&id=$cat'>Produit</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_fournisseur&id=$cat'>fourn.</a></th>
	<th class=\"listingprod\">reference</th>
	<th class=\"listingprod\">condit.</th>
	<th class=\"listingprod\">prix</th>
	<th class=\"listingprod\">stock</th>
	<th class=\"listingprod\">stk_mini</th>
	<th class=\"listingprod\">QT_CMD</th>
	<th class=\"listingprod\"><input  type=\"submit\" value=\"CMD\"></th>
	<th class=\"listingprod\">date</th>
	<th class=\"listingprod\">modif</th>
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
		<td><input type=\"checkbox\" name=\"cmd[]\" value=\"$produit->id_produit\"/></td>
		<td> $datecom</td>
		<td><a href='produit?action=modif&id=" .  $produit->id_produit . "&oldact=only".$rarajout."'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td>".$totaligne."</td>
		</tr>\n";
		$total = $total + (floatval($produit->stock) * floatval($produit->prix));
		$nblignemax++;
	}
		$texto .= "<tr><td colspan=14><center>Total en stock:  <b>".number_format($total, 2, ',', '')." &#8364;</b></center></td></tr>";
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
		case 'totalprix':
			$ordre =" (produit.prix*produit.stock) DESC";
		break;
		default:
			$ordre ="produit.produit";
		break;
	}	
		if($_GET['search']){
		$que=$_GET['search'];
		$quoi ="&search=" . $que;
		$queque2=$que;
		$whair = "(produit.produit LIKE '%$que%' OR fournisseur.fournisseur LIKE '%$que%' OR produit.reference LIKE '%$que%' OR categ.categ LIKE '%$que%')";
	}
	else {
		$whair=1;
		$quoi="";
		}
		if($_GET['id']!=""){
		$cat = $_GET['id'];
    $whair .= " AND categ.id_categ=$cat";
    $quoi .= "&id=$cat";
    }
		
	$reqpre->findquery("SELECT *
		FROM produit, titre, categ, fournisseur
		WHERE categ.id_categ = produit.id_categ
		AND categ.id_titre = titre.id_titre
		AND produit.id_fournisseur = fournisseur.id_fournisseur AND $whair
	 ORDER BY $ordre");
	$texto.= "<form name=\"cherch\" action=\"./produit?action=search\" method=\"post\" accept-charset=\"utf-8\">
	<p>	<input autocomplete=\"off\"  class=\"actif\" type=\"text\" id=\"txt_search\" name=\"search\" value=\"\"><input type=\"submit\" value=\"rechercher\"></p>
	</form>
	<form action=\"./produit?action=commander\" method=\"post\">
	<span id=\"suggest\"><table cellspacing=\"0\" >";
		if($_GET['search']){
		$texto.= "	<i>recherche pour : <b>$que</b>&nbsp;&nbsp; classer par : <b>".$_GET['ordre']."</b> </i>";}
	$texto.= "
	<span id=\"suggest\"><table cellspacing=\"0\" >
	<tr>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_titre$quoi'>".(($_GET['ordre']=="id_titre")?"&#9679;":"")."Titre</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_categ$quoi'>".(($_GET['ordre']=="id_categ")?"&#9679;":"")."Categ</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=produit$quoi'>".(($_GET['ordre']=="produit")?"&#9679;":"")."Produit</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_fournisseur$quoi'>".(($_GET['ordre']=="id_fournisseur")?"&#9679;":"")."fourn.</a></th>
	<th class=\"listingprod\">reference</th>
	<th class=\"listingprod\">condit.</th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=prix$quoi'>".(($_GET['ordre']=="prix")?"&#9679;":"")."prix</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=stock$quoi'>".(($_GET['ordre']=="stock")?"&#9679;":"")."stock</a></th>
	<th class=\"listingprod\">stk_mini</th>
	<th class=\"listingprod\">QT_CMD</th>
	<th class=\"listingprod\"><input type=\"submit\" value=\"CMD\"></th>
	<th class=\"listingprod\">date</th>
	<th class=\"listingprod\">modif</th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=totalprix$quoi'>".(($_GET['ordre']=="totalprix")?"&#9679;":"")."&#8364;</a></th>
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
		<td>".number_format($produit->prix, 2, ',', '')."</td>
		<td> <b>$produit->stock</b></td>
		<td> $produit->stock_mini</td>
		<td> $produit->quantite_commande</td>
		<td><input type=\"checkbox\" name=\"cmd[]\" value=\"$produit->id_produit\"/></td>
		<td>$datecom</td>
		<td><a href='produit?action=modif&id=" .  $produit->id_produit . "&oldact=classer&search=$queque2&oldordre=".$ordre."'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td>".$totaligne."</td>
		</tr>\n";
		$total = $total + (floatval($produit->stock) * floatval($produit->prix));
		$nblignemax++;
	}
		$texto .= "<tr><td colspan=14><center>Total en stock:  <b>".number_format($total, 2, ',', '')." &#8364;</b></center></td></tr>";
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
	<form action=\"./produit?action=commander\" method=\"post\">
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
	<th class=\"listingprod\">QT_CMD</th>
	<th class=\"listingprod\"><input type=\"submit\" value=\"CMD\"></th>
	<th class=\"listingprod\">date</th>
	<th class=\"listingprod\">modif</th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=totalprix&search=$que'>&#8364;</a></th>
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
		<td>$datecom</td>";
		$texto .= "<td><a href='produit?action=modif&search=$que&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td>".$totaligne."</td>
		</tr>\n";
		$total = $total + (floatval($produit->stock) * floatval($produit->prix));
		$nblignemax++;
	}		
		$texto .= "<tr><td colspan=14><center>Total en stock:  <b>".number_format($total, 2, ',', '')." &#8364;</b></center></td></tr>";
		$texto .= "</span></table>";
	}
	else{ 
			$texto .= "</table><br /><span class=\"affichage\">Il n'y a aucun produit correspondant &agrave; &quot;<b>$que</b>&quot; dans la base produit</span>";
		}

	break;
	case "commander";
	$texto .="<h3>Commande de produit</h3>";
	$req = new db();
	$texto .="<form method=\"post\" action=\"./commanderimprimer\">";
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
	</tr>\n";
	$idacommander ="";
	foreach ($_POST['cmd'] as $value) {
		$idacommander .= "$value, ";
			}
	$newtaille =strlen($idacommander)-2; //supprime la derniere virgule et l'espace
	$idacommander = substr($idacommander, 0, $newtaille);
	$req->findquery("SELECT * 
	FROM produit, titre, categ, fournisseur
	WHERE produit.id_produit IN ($idacommander) AND categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur
	ORDER BY fournisseur.fournisseur ASC");
	$nbdeprod = $req->__get('numrows');
	//dfdvxc
	$nblignemax = 1;
		while($produit = $req->row()){
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
		<td><input type='hidden' name='cmd[]' value='$produit->id_produit' />
		 <input class=\"actif\" name=\"qtcommande_$produit->id_produit\" size=\"4\" value=\"$necessaire\" /></td>";
		$texto .= "</td>
		</tr>\n";
			$total = $total + (floatval($produit->stock) * floatval($produit->prix));
		$nblignemax++;
	}
	//vcxvcx
    $texto .="<table/>";
	$texto .="<input type='hidden' name='nbdeprod' value='$nbdeprod' />
	<input style='cursor:pointer;background-color:#FF2814;margin-top: 10px;border:4px outset #FF5F52;height:50px;width:90%;font-size:20px;'
 type=\"submit\" name=\"submitbutton\"  value=\"passer commande/ imprimer\" id=\"submitbutton\">
	<br />
	<input type=\"button\" name=\"cancel\" value=\"annuler\" onclick=\"history.back()\"></form>";
	
	break;
	case "manquantcommande";
	
	$reqpre = new db();
	$reqpre->findquery("SELECT *
		FROM produit, titre, categ, fournisseur
		WHERE categ.id_categ = produit.id_categ
		AND categ.id_titre = titre.id_titre
		AND produit.id_fournisseur = fournisseur.id_fournisseur AND  (produit.stock<produit.stock_mini OR produit.commande=1) AND produit.used=1 ORDER BY produit.commande, produit.id_fournisseur");
	$total = 0;
	$previouscommande=false;
	$texto.= "<form name=\"cherch\" action=\"./produit?action=search\" method=\"post\" accept-charset=\"utf-8\">
	<p>	<input  autocomplete=\"off\" class=\"actif\" type=\"text\" id=\"txt_search\" name=\"search\" value=\"\"><input type=\"submit\" value=\"rechercher\"></p>
	</form>
	<form action=\"./produit?action=commander\" method=\"post\">
	<span id=\"suggest\"><table cellspacing=\"0\" >
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
	<th class=\"listingprod\">QT_CMD</th>
	<th class=\"listingprod\"><input type=\"submit\" value=\"CMD\"></th>
	<th class=\"listingprod\">date</th>
	<th class=\"listingprod\"><img border='0' src='../img/pencil.gif' alt='modif'></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=totalprix'>&#8364;</a></th>
	</tr>\n";
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
	
	break;
	default;
	$reqpre = new db();
	$reqpre->findquery("SELECT * 
	FROM produit, titre, categ, fournisseur
	WHERE categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur
	AND produit.used=1
	ORDER BY categ.categ ASC");
	$total = 0;
	$texto.= "<form name=\"cherch\" action=\"./produit?action=search\" method=\"post\" accept-charset=\"utf-8\">
	<p>	<input  autocomplete=\"off\" class=\"actif\" type=\"text\" id=\"txt_search\" name=\"search\" value=\"\"><input type=\"submit\" value=\"rechercher\"></p>
	</form>
	<form action=\"./produit?action=commander\" method=\"post\">
	<span id=\"suggest\"><table cellspacing=\"0\" >
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
	<th class=\"listingprod\">QT_CMD</th>
	<th class=\"listingprod\"><input type=\"submit\" value=\"CMD\"></th>
	<th class=\"listingprod\">date</th>
	<th class=\"listingprod\"><img border='0' src='../img/pencil.gif' alt='modif'></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=totalprix'>&#8364;</a></th>
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
	
	
	//---- produit non utilise
		
	$bla = $reqpre->findquery("SELECT * 
	FROM produit, titre, categ, fournisseur
	WHERE categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur
	AND produit.used=0
	ORDER BY categ.categ ASC");
	$dejafait=0;
	while($produit = $reqpre->row()){
		if($produit!="" && $dejafait==0){$texto .= "<tr class=\"stock\" align='center'>
		<td  colspan=\"14\"> --------- produit non utilise ---------	</td></tr>";
	}
		$tot = floatval($produit->stock) * floatval($produit->prix);
		$totaligne = number_format($tot, 2, ',', '');
		list ($year, $month, $day) = explode ("-", $produit->date_commande);
		$datecom = (($produit->date_commande=="0000-00-00")?"":"$day/$month/$year");
		$texto .= "<tr align='center'>
		<td> $produit->titre </td>
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
		<td> $datecom</td>
		<td><a href='produit?action=modif&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td>".$totaligne."</td>
		</tr>\n";
		$dejafait++;
		$total = $total + (floatval($produit->stock) * floatval($produit->prix));
	}
	
	
	//---- produit sans categ ou sans fournisseur sans titre correspondant ayant un pb de relation d'une table à l'autre
	$bla = $reqpre->findquery("SELECT * FROM produit
		WHERE NOT EXISTS (SELECT * FROM categ WHERE produit.id_categ = categ.id_categ)");
	
	while($produit = $reqpre->row()){
		if($produit!=""){
			$texto .= "<tr class=\"stock\" align='center'>
			<td  colspan=\"14\"> ------- produit ayant un pb de categorie ---------	</td></tr>";
		};
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
		<td><input type=\"checkbox\" name=\"cmd[]\" value=\"$produit->id_produit\"/></td>
		<td><a href='produit?action=modif&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td>".$totaligne."</td>
		</tr>\n";
		$total = $total + (floatval($produit->stock) * floatval($produit->prix));
	}
	$bla = $reqpre->findquery("SELECT * FROM produit
		WHERE NOT EXISTS (SELECT * FROM fournisseur WHERE produit.id_fournisseur = fournisseur.id_fournisseur)");
	while($produit = $reqpre->row()){
		if($produit!=""){
			$texto .= "<tr class=\"stock\" align='center'>
				<td  colspan=\"14\"> ------- produit ayant un pb de fournisseur ---------	</td></tr>";
		};
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
		<td><input type=\"checkbox\" name=\"cmd[]\" value=\"$produit->id_produit\"/></td>
		<td><a href='produit?action=modif&id=" .  $produit->id_produit . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td>".$totaligne."</td>
		</tr>\n";
		$total = $total + (floatval($produit->stock) * floatval($produit->prix));
	}
	
	$texto .= "<tr><td colspan=14><center>Total en stock:  <b>".number_format($total, 2, ',', '')." &#8364;</b></center></td></tr>";
	//------fin pb
	
	
	$texto .= "</form></span></table>";
	break;
}

$texto .= "</div>
</body>
</html>";
echo $texto;
?>

