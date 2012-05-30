<?php
setlocale(LC_ALL, 'fr-FR');
$texto .="
<script type=\"text/javascript\">
	$(document).ready(
		
		function(){
		$(\"a.commando\").click(function(){
			$('#resultat').empty();
			var lien = $(this).attr('id');
			$('#resultat').load('./include/commande/commande_list', {lacom: lien});
			});

	});

</script>

<div style=\"float:right;width:69%\" id=\"resultat\">";
//$mess=(isset($_GET['mess']))?$_GET['mess']:"";
//$lid=(isset($_GET['id']))?$_GET['id']:"";
//$action=(isset($_POST['action']))?$_POST['action']:"";
switch ($action) {
	case 'search':
		include('resultat2.inc');
		break;
	case 'retraitcodabar':
		include('codabar.inc');
		break;
	default:
		if($mess!=""){
			switch ($mess) {
				case 'retrait':
				//-----------------
				
				$texto .= "
				<div style=\"background-color:#EFD9F1;border:1px solid grey;clear:both;width:60%\">";
				$requi = new db();
				$requi->findquery("SELECT * FROM produit, categ, fournisseur WHERE produit.id_categ=categ.id_categ AND produit.id_fournisseur=fournisseur.id_fournisseur AND id_produit=". $lid);
				$produit = $requi->row();
				if ($produit!="") {
				$texto .= "
				<br /><span class=\"affichage\">le produit suivant &agrave; &eacute;t&eacute; retir&eacute; du STOCK</span>
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
			$texto .= "<span class=\"affichage\">en attente de recherche...</span>";
		}
		break;
}


$texto .= "</div>
<div style=\"float:left;width:30%\">

<div id=\"accordion\">";

$reqpre = new db();
$say = $reqpre->findquery("SELECT * FROM  `commande` WHERE 1 ORDER BY date DESC");
$texto.= "<table style=\"float:left;\" cellspacing=\"0\" class=\"listing\"><tr><th class=\"listingtitre\">date</th><th class=\"listingtitre\">note</th><th class=\"listingtitre\">recu</th><th class=\"listingtitre\">modifier</th><th class=\"listingtitre\">effacer</th></tr>\n";
$nblignemax = 1;
$monthaff="00";
$yearaff="00";
while($commande = $reqpre->row()){
$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
list ($year, $month, $day) = explode ("-", $commande->date);
$datecom = (($commande->date=="0000-00-00")?"":"$day/$month/$year");
if($year!=$yearaff){$texto .= "<tr class=\"stock\" align='center' id='nodbclick'>
<td colspan=\"5\"> --------- $year ---------	</td></tr>";}
if($year!=$yearaff && $month!=$monthaff){ $lemonth = strtoUpper(strftime("%B", mktime(0, 0, 0, $month, 1, $year)));
	$texto .= "<tr class=\"stock\" align='center' id='nodbclick'>
<td colspan=\"5\"> --------- $lemonth ---------	</td></tr>";}
		
$texto .= "<tr $cololign>
<td><a class=\"commando\" id=\"$commande->id_commande\" href='#'> $datecom</a></td>
<td align='center'> $commande->note</td>
<td align='center'> $commande->recu</td>
<td align='center'><a href='commande?action=modif&id=" .  $commande->id_commande . "'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
<td align='center'><a href='commande?action=eff&id=" .  $commande->id_commande . "'><img border='0' src='../img/erase.png' alt='efface'></a></td>
</tr>\n";
$nblignemax++;
$monthaff=$month;
$yearaff=$year;
}
$texto .= "</table></div></div>";


?>