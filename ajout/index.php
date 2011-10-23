<?php
require("../config.php");
require_once("../db.class.php");
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
<link type=\"text/css\" href=\"../css/smoothness/jquery-ui-1.7.1.custom.css\" rel=\"stylesheet\" />	
<script type=\"text/javascript\" src=\"../js/jquery-1.3.2.min.js\"></script>
<script type=\"text/javascript\" src=\"../js/jquery-ui-1.7.1.custom.min.js\"></script>
<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\" media=\"screen\" />
<meta content=\"text/html; Charset=UTF-8\" http-equiv=\"Content-Type\" />
<title>
Ajout produit
</title>
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
	function foc(){
	  document.cherch.search.focus();
}
-->
</SCRIPT>
</head>

<body onload=\"foc()\" style=\"background-color:#FFAB2B;margin:0px;color:#734B13\">";
include('../menu.php');
$texto .="<div style=\"padding:8px\">";
$texto .= <<<EOT
<H1 class="titreajout">Ajout produit</H1>
	
EOT;
$texto .="
<script type=\"text/javascript\">
	$(function() {
		$(\"#accordion\").accordion({
			collapsible: true,
			autoHeight: false,
			active: false
		});
		
	});
	</script>
	
<script type=\"text/javascript\">
	$(document).ready(
		
		function(){
		$(\"a.catego\").click(function(){
			$('#resultat').empty();
			var lien = $(this).attr('id');
			$('#resultat').load('resultat', {cat: lien});
			$(\"#txt_search\").val('');
			});

	});

</script>
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
					url: \"resultat\",
					data: \"search=\" + search,
					success: function(message)
					{	
						$(\"#resultat\").empty();
				  		if (message.length > 0)
						{							
							$(\"#resultat\").append(message);
						}
					}
				});
			}
			else
			{
				$(\"#resultat\").empty();
			}
		});
	});	
	
	
	
	$(document).ready(
		
		function(){
		$(\".selection\").click(function(){
			var lien = $(this).attr('id');
			$('#resultat').empty();
			$('#resultat').load('ajout2', {lid: lien});
			$(\"#txt_search\").val('');
			});

	});
	
	
	$(document).ready(
		
		function(){
		$(\".selectionalt\").click(function(){
			var lien = $(this).attr('id');
			$('#resultat').empty();
			$('#resultat').load('ajout2', {lid: lien});
			$(\"#txt_search\").val('');
			});
			
	});
	</script>

<div>
<form name=\"cherch\" action=\"./index\" method=\"POST\" accept-charset=\"utf-8\">
<p>
rechercher :<input autocomplete=\"off\"  class=\"tresactif\" type=\"text\" id=\"txt_search\" name=\"search\" value=\"\">
	<input type=hidden name=\"action\" value=\"search\"/>
	</p>
</form>
</div>
<div style=\"float:right;width:69%\" id=\"resultat\">";
$mess=(isset($_GET['mess']))?$_GET['mess']:"";
$lid=(isset($_GET['id']))?$_GET['id']:"";
$action=(isset($_POST['action']))?$_POST['action']:"";
switch ($action) {
	case 'search':
		include('resultat2.inc');
		break;
	case 'ajoutcodabar':
		include('codabar.inc');
		break;
	default:
		if($mess!=""){
			switch ($mess) {
				case 'ajout':
				//-----------------
				
				$texto .= "
				<div style=\"background-color:#EFD9F1;border:1px solid grey;clear:both;width:60%\">";
				$requi = new db();
				$requi->findquery("SELECT * FROM produit, categ, fournisseur WHERE produit.id_categ=categ.id_categ AND produit.id_fournisseur=fournisseur.id_fournisseur AND id_produit=". $lid);
				$produit = $requi->row();
				if ($produit!="") {
				$texto .= "
				<br /><span class=\"affichage\">Le produit suivant &agrave; vu son STOCK augment&eacute;</span>
				<ul class=\"retrait\">
				<li class=\"retrait\"><span class=\"retraitext\"><b><i>$produit->categ</i></b></span></li>
				<li class=\"retrait\"><span class=\"retraitprod\"><b>$produit->produit</b></span></li>
				<li class=\"retrait\"><hr style=\"margin-right:30px\"/></li>
				<li class=\"retrait\">Fourn.: <b>$produit->fournisseur</b></li>
				<li class=\"retrait\">Ref: <b>$produit->reference</b> </li>
				<li class=\"retrait\">Cond. : <b>$produit->conditionnement</b></li>
				<li class=\"retrait\">&nbsp;</li>
				<li class=\"retrait\"><span class=\"retraitext\">En stock : <b>$produit->stock</b></span></li>
				</ul>";
				}
				else{
					$texto .= "<br /><br /><br /><span class=\"affichage\">Aucun produit ne correspond &agrave; : ".$lid."</span><br /><br /><br />";
				}

				$texto .= "</div>";
				
				//------
					break;
				default:
					# code...
					break;
			}
			
		}
		else{
			$reqpre = new db();
			$reqpre->findquery("SELECT *
				FROM produit, titre, categ, fournisseur
				WHERE categ.id_categ = produit.id_categ
				AND categ.id_titre = titre.id_titre
				AND produit.id_fournisseur = fournisseur.id_fournisseur AND  produit.commande=1 AND produit.used=1 ORDER BY produit.commande, produit.id_fournisseur");
			$texto.= "<span id=\"suggest\"><table cellspacing=\"0\" >
			<tr>
			<th class=\"listingprod\">Categ</th>
			<th class=\"listingprod\">Produit</th>
			<th class=\"listingprod\">fournisseur</th>
			<th class=\"listingprod\">reference</th>
			<th class=\"listingprod\">condit.</th>
			<th class=\"listingprod\">stock</th>
			<th class=\"listingprod\">stk_mini</th>
			<th class=\"listingprod\">commande</th>
			</tr>\n";
			$nblignemax = 1;
			while($produit = $reqpre->row()){
				$cololign = (($nblignemax%2 == 0)?"class=\"selection\"":"class=\"selectionalt\"");
					$texto .= "<tr $cololign align='center' id=\"$produit->id_produit\">
				<td> $produit->categ</td>
				<td> $produit->produit</td>
				<td> $produit->fournisseur</td>
				<td> $produit->reference</td>
				<td> $produit->conditionnement</td>
				<td> <b>$produit->stock</b></td>
				<td> $produit->stock_mini</td>
				<td> <b>$produit->quantite_commande</b></td>				
				</tr>\n";
				$nblignemax++;
			}
				$texto .= "</table>";
		}
		break;
}


$texto .= "</div>
<div style=\"float:left;width:30%\">

<div id=\"accordion\">";
$reqpre = new db();
$say = $reqpre->findquery("SELECT * FROM titre, categ WHERE categ.id_titre=titre.id_titre ORDER BY titre.titre, categ.categ");
$titi = "abc";
while($titcat = $reqpre->row()){
		if($titi!=$titcat->id_titre && $titi!="abc"){
			$texto .= "</ul>\n</div>\n";
		}

		if($titi!=$titcat->id_titre){
			$texto .= "<h3 class=\"navtit\"><a class=\"navtit\" href=\"#\">$titcat->titre</a></h3>
			<div>
				<ul class=\"nav\">\n";
		}

		$texto .= "<li class=\"nav\"><a class=\"catego\" id=\"$titcat->id_categ\" href=\"#\">$titcat->categ</a></li>\n"	;
		
		$titi = $titcat->id_titre;
}

$texto .= "</div></ul>\n</div></div>\n";

$texto .= "<div style=\"clear:both;\"><!-- --></div>\n";
	


$texto .= "</div></body></html>";
echo $texto;
?>

