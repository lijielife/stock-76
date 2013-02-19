<?php

	$texto .="<h3 class=\"discret\">Commande de produit</h3>";
	$req = new db();
	$req_com = new db();
	$req_com_list = new db();
	$ret = new db();
	$texto .="&nbsp;&nbsp;<A class=\"discret\" href=\"javascript:window.print()\">Imprimer la liste</A><br /><br />\n";
	//creer un liste dans la table commande en fonction des fournisseurs
	$idacommander="";
	
	//lecteure entete nom_adresse cab
	$selectentete ="<form id=\"formentete\"><select id=\"entetecab\" style=\"width:300px\">\n";
	$jsentetecab="<input id=\"option0\" type=\"hidden\" value=\"\" />\n";
	$req_nom_adresse = new db();
	$req_nom_adresse->findquery("SELECT * FROM nom_adresse ORDER BY classement ASC");
	while($lesnomadresse = $req_nom_adresse->row()){
		if($lesnomadresse->classement=="1"){
			$selectclassement="selected";
		}
		else{
				$selectclassement="";
		}
		$selectentete .="<option $selectclassement value=\"$lesnomadresse->id_nom_adresse\">$lesnomadresse->nom</option>\n";
		$nomadd = nl2br($lesnomadresse->adresse);
		$nomadd = preg_replace('/\n(\r)?/', ' <br /> ', $lesnomadresse->adresse);
		$jsentetecab .= "<input id=\"option$lesnomadresse->id_nom_adresse\" type=\"hidden\" value=\"$lesnomadresse->nom <br /> $lesnomadresse->adresse\" />\n";
	}
	
	$selectentete .="<option  value=\"0\">laisser vide</option></select>
	$jsentetecab</form>";
	
	$texto .="$selectentete<br />\n";
	$texto .="<script type=\"text/javascript\">
$(document).ready(function(){
	var theform = document.forms[\"formentete\"];
theform.elements[\"entetecab\"].onchange=function(){ 
var letruc = \"option\" + $(\"#entetecab\").find(':selected').val();

	var lachose = theform.elements[letruc].value;

$('.entetecabinet').html(lachose);
}

var lentetecab = theform.elements[\"option1\"].value;
$('.entetecabinet').html(lentetecab);

});
</script>\n";

	$entetecab = "Nom adresse";
//insert
$lacom = $_GET['lacom'];
$reqpre = new db();
$reqlacom = new db();
$reqlacom->findquery("SELECT * FROM  `commande`, `fournisseur` WHERE commande.id_commande=$lacom AND commande.id_fournisseur=fournisseur.id_fournisseur ORDER BY date DESC");
$detailcommande = $reqlacom->row();
list ($cyear, $cmonth, $cday) = explode ("-", $detailcommande->date);
$texto .= "<h3 style=\"page-break-before:always\" >&nbsp;&nbsp;$cday/$cmonth/$cyear </h3>\n";
$texto.="<p>Commande $detailcommande->fournisseur du $cday/$cmonth/$cyear, n&deg; $detailcommande->num_facture &nbsp;&nbsp;&nbsp; $detailcommande->note </p><br>";
$say = $reqpre->findquery("SELECT * FROM  `fournisseur` as fourn, `categ` as categ, `commande_list` as CMD_list, `produit`, `titre` WHERE CMD_list.id_commande=$lacom AND CMD_list.id_produit=produit.id_produit AND categ.id_categ=produit.id_categ AND fourn.id_fournisseur=produit.id_fournisseur AND categ.id_titre = titre.id_titre ORDER BY produit.id_produit");


				$texto .= "<table cellspacing=\"0\" >\n";
				$texto .="<tr style=\"height:40px\" class=\"clean\" align=\"center\"><td colspan=\"9\">&nbsp;</td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"2\" rowspan=\"9\"><div class=\"entetecabinet\"> $entetecab</div> <br /><br /><i>Ref Client: <b>$detailcommande->client<b></i></td><td rowspan=\"9\">&nbsp; </td><td colspan=\"7\"><h3>$detailcommande->fournisseur, $detailcommande->nom $detailcommande->prenom</h3></td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\"><i>Ref Client: <b>$detailcommande->client<b></i></td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\">$detailcommande->adresse</td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\"><i>tel: <b>$detailcommande->tel<b></i></td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\"><i>portable: <b>$detailcommande->portable<b></i></td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\"><i>fax :<b>$detailcommande->fax<b></i></td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\"><i>email de contact:</i><a href=\"mailto:$detailcommande->nom $detailcommande->prenom<$detailcommande->email>\">$detailcommande->email</td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\"><i>email de commande:</i><a href=\"mailto:$detailcommande->nom $detailcommande->prenom<$detailcommande->email_cmd>\">$detailcommande->email_cmd</td></tr>\n";
				
				$texto .="<tr  align=\"center\"><td colspan=\"9\">&nbsp;</td></tr>\n";
				$texto.= "<tr>
				<th class=\"listingprod\">Famille</th>
				<th class=\"listingprod\">Categ</th>
				<th class=\"listingprod\">Produit</th>
				<th class=\"listingprod\">reference</th>
				<th class=\"listingprod\">condit</th>
				<th class=\"listingproddiscret\">prix</th>
				<th class=\"listingproddiscret\">stock</th>
				<th class=\"listingproddiscret\">stock_mini</th>
				<th class=\"listingprod\">QT_a_com</th>
				<th class=\"listingprod\">commander</th>
				</tr>\n";


$nblignemax = 1;
$total="";
while($lacommande = $reqpre->row()){
$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
		if(($lacommande->used=="1") && ($lacommande->stock<$lacommande->stock_mini)){
			$cololign = "class=\"stock\"";
		}
		if($lacommande->commande=="1"){
			$cololign = "class=\"bientotstock\"";
		}

$tot = floatval($lacommande->quantite_CMD) * floatval($lacommande->prix);
$totaligne = number_format($tot, 2, ',', '');

	if($lacommande->stock_mini>$lacommande->stock){$necessaire=$lacommande->stock_mini-$lacommande->stock;}
		else{$necessaire="";}
		

$texto .= "<tr $cololign>
		<td class=\"case\"> $lacommande->titre</td>
		<td class=\"case\"> $lacommande->categ</td>
		<td class=\"case\"> $lacommande->produit</td>
		<td class=\"case\"> $lacommande->reference</td>
		<td class=\"case\"> $lacommande->conditionnement</td>
		<td class=\"casediscret\"> ".number_format($lacommande->prix, 2, ',', '')."</td>
		<td class=\"casediscret\"> <b>$lacommande->stock</b></td>
		<td class=\"casediscret\"> $lacommande->stock_mini</td>
		<td class=\"case\"> $necessaire</td>
		<td class=\"case\" > $lacommande->quantite_CMD</td>
		</tr>\n";
			$total = $total + (floatval($lacommande->stock) * floatval($lacommande->prix));


$nblignemax++;}

$texto .= "</table>";


//fininsert





?>