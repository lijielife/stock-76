<?php
require("../config.php");
require_once("../db.class.php");
$date = date("d/m/Y");
setlocale(LC_TIME, 'fr_FR.utf8','fra');
$laction=(isset($_GET['action']))?$_GET['action']:"";

$finfin = date("Y-m-d");

list($year, $month, $day) = split('[/.-]', $finfin);
$debdeb = $year-1 ."-".$month."-".$day;

$id_prod = $_GET['idprod'];

$lien= "";
if($_GET['debut']!=""){
	$datedebut =  $_GET['debut'];
	$lien .= "&debut=" . $_GET['debut'];
	}
else{
	$datedebut =  $debdeb;
}

if($_GET['fin']!=""){
	$datefin = $_GET['fin'];
	$lien .= "&fin=" . $_GET['fin'];
	}
else{
	$datefin = $finfin;
}


$dadate = strftime("%A %d %B %Y");
$texto = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
	\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
$texto .= "<html xmlns=\"http://www.w3.org/1999/xhtml\"
	    xml:lang=\"fr\"
	    lang=\"fr\"
	    dir=\"ltr\">
<head>
<script type=\"text/javascript\" language=\"javascript\" src=\"../jquery-1.4.2.min.js\" charset=\"utf-8\"></script>
<script type=\"text/javascript\" language=\"javascript\" src=\"../statistique/Highcharts/js/highcharts.js\" charset=\"utf-8\"></script>


<meta content=\"text/html; Charset=UTF-8\" http-equiv=\"Content-Type\" />
<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\" media=\"screen\" />
<title>
Gestion Stock en ligne: Statistiques
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
$texto .="<h1>Gestion Produit: Statistiques</h1>\n";
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

$texto .="
<form action=\"../statistique/index.php\" method=\"get\" accept-charset=\"utf-8\">
début<input class=\"actif\"  type=\"text\" name=\"debut\" value=\"$datedebut\" id=\"debut\" />
&nbsp;fin<input class=\"actif\"  type=\"text\" name=\"fin\" value=\"$datefin\" id=\"fin\" />
<input type=\"submit\" value=\"Go\" />
</form>
			<br />
			</div>";
			
switch($laction){
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
	<th class=\"listingprod\">ref.</th>
	<th class=\"listingprod\">condit.</th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=prix&search=$que'>prix</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=stock&search=$que'>stock</a></th>
	<th class=\"listingprod\">mini</th>
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
		$texto .= "<td><a href='produit?action=modif&search=$que&id=" .  $produit->id_produit . "'><img border='0' src='../img/chart_bar.png' alt='modif'></a></td>
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
	<th class=\"listingprod\">ref.</th>
	<th class=\"listingprod\">condit.</th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=prix'>prix</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=stock'>stock</a></th>
	<th class=\"listingprod\">mini</th>
	<th class=\"listingprod\">QT_CMD</th>
	<th class=\"listingprod\"><img border='0' src='../img/chart_bar.png' alt='modif'></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=totalprix'>&#8364;</a></th>
	<th class=\"listingprod\">Retrait_N</th>
	<th class=\"listingprod\">N_1</th>
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
		$req_statN = new db();
		$req_statN->findquery("SELECT sum(quantite) as N FROM flux WHERE flux.id_produit = $produit->id_produit AND quantite < 0 AND flux.date >=  '$datedebut' AND flux.date <=  '$datefin'");
		$statN = $req_statN->row();
		
		$valN= number_format($statN->N * $produit->prix, 2, ',', '');
		
		list($Nyear, $Nmonth, $Nday) = split('[/.-]', $datedebut);
		$debutn1 = $Nyear-1 ."-".$Nmonth."-".$Nday;
		$req_statN1 = new db();
		$req_statN1->findquery("SELECT sum(quantite) as N1 FROM flux WHERE flux.id_produit = $produit->id_produit AND quantite < 0 AND flux.date >=  '$debutn1' AND flux.date <=  '$datedebut'");
		$statN1 = $req_statN1->row();
		$valN1= number_format($statN1->N1 * $produit->prix, 2, ',', '');
		
		
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
		<td> $produit->quantite_commande</td>";
		$texto .= "</td>
		<td><a target='_blank' href='graphan.php?idprod=" .  $produit->id_produit . "$lien'><img border='0' src='../img/chart_bar.png' alt='modif'></a></td>
		<td>".$totaligne."</td>
		<td title=\"$valN &#8364;\">$statN->N</td>
		<td title=\"$valN1 &#8364;\">$statN1->N1</td>
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
	$total2 =0;
	while($produit = $reqpre->row()){
		$tot = floatval($produit->stock) * floatval($produit->prix);
		$totaligne = number_format($tot, 2, ',', '');
		$dejafait++;
		$total2 = $total2 + (floatval($produit->stock) * floatval($produit->prix));
	}
	
	
	
	$texto .= "<tr><td colspan=14><center>Total en stock:  <b>".number_format($total, 2, ',', '')." &#8364; + ".number_format($total2, 2, ',', '')." &#8364; de produits non utilis&eacute;s</b></center></td></tr>";
	//------fin pb
	
	
	$texto .= "</form></span></table>";
	break;
}

$texto .= "</div>
</body>
</html>";
echo $texto;
?>

