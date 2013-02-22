<?php

	$texto .="<h3 class=\"discret\">Commande de produit</h3>";
	$req = new db();
	$req_com = new db();
	$req_com_list = new db();
	$ret = new db();
	$texto .="&nbsp;&nbsp;<A class=\"discret\" href=\"javascript:window.print()\">Imprimer la liste</A><br /><br />\n";
	//creer un liste dans la table commande en fonction des fournisseurs
	$date = date("Y-m-d");
	setlocale(LC_TIME, "fr_FR");
	$dadate = strftime("%A %d %B %Y");
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
	
	$texto .= "<div style=\"page-break-after:always\" >&nbsp;&nbsp; </div>\n";
	$entetecab = "Nom adresse";
	
	// foreach ($_POST['cmd'] as $value) {
	// if($_POST["qtcommande_".$value] > 0){$idacommander .= "$value, ";}
	// 		}
	// $newtaille =strlen($idacommander)-2; //supprime la derniere virgule et l'espace
	// $idacommander = substr($idacommander, 0, $newtaille);
	// SELECT fournisseur.fournisseur, fournisseur.id_fournisseur FROM produit, fournisseur WHERE produit.id_produit IN ($idacommander) AND produit.id_fournisseur = fournisseur.id_fournisseur GROUP BY id_fournisseur
	// $req->findquery("SELECT fournisseur.fournisseur, fournisseur.id_fournisseur 
	// FROM produit, fournisseur 
	// WHERE produit.id_produit IN ($idacommander) 
	// AND produit.id_fournisseur = fournisseur.id_fournisseur 
	// GROUP BY id_fournisseur");
	// 	
	// 	while($produit = $req->row()){
	// 	
	// $req->save('commande', "''",  '"' . $date . '"', "''", "''", "''");
	// $id_commande = $req->lastid;
	// 	
	//insert chaque produit dans  la table commande_list avec id_commande précédent
	

	foreach ($_POST['cmd'] as $value) {
	if($_POST["qtcommande_".$value] > 0){$idacommander .= "$value, ";}
			}
	$newtaille =strlen($idacommander)-2; //supprime la derniere virgule et l'espace
	$idacommander = substr($idacommander, 0, $newtaille);
	$req->findquery("SELECT * 
	FROM produit, titre, categ, fournisseur
	WHERE produit.id_produit IN ($idacommander) AND categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur
	ORDER BY fournisseur.fournisseur, produit.id_produit  ASC");
	$texto .= "<h3 >&nbsp;&nbsp;$dadate </h3>\n";
	$texto .= "<h2 >&nbsp;&nbsp;BON de COMMANDE </h2>\n";
	$nblignemax = 1;
	$fournid="abcbibi";
	$id_commande = "";

	while($produit = $req->row()){
		
		$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
		if(($produit->used=="1") && ($produit->stock<$produit->stock_mini)){
			$cololign = "class=\"stock\"";
		}
		if($produit->commande=="1"){
			$cololign = "class=\"bientotstock\"";
		}
		
		
		
			if($fournid!=$produit->id_fournisseur){
					//creer une insert dans la table commande pour le fournisseur en cours
					
				$req_com->save($table_commande, "''",  '"' . $date . '"', "''", "''", '"' . $produit->id_fournisseur .'"');
 				$id_commande = $req_com->lastid;  //recupere l'id_commande de save pour les insertion dans commande_list
				
				$texto .= "</table>\n";
				if($fournid!="abcbibi"){
        		$texto .= "<h3 style=\"page-break-before:always;\" >&nbsp;&nbsp;$dadate </h3>\n";
				$texto .= "<h2 >&nbsp;&nbsp;BON de COMMANDE </h2>\n";
				}
				//enregistre la date de commande dans la table produit de chaque produit (si necessaire pour l'instant)
				$qtcmd="qtcommande_".$produit->id_produit;
				$ret->update($table_produit, '"' . $produit->id_produit . '"', 'date_commande="' . $date . '"', 'commande="1"', 'quantite_commande="' . $_POST["qtcommande_".$produit->id_produit] . '"');	
				
				
				$texto .= "<table cellspacing=\"0\" >\n";
				$texto .="<tr style=\"height:40px\" class=\"clean\" align=\"center\"><td colspan=\"9\">&nbsp;</td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"2\" rowspan=\"9\"><div class=\"entetecabinet\"> $entetecab</div> <br /><br /><i>Ref Client: <b>$produit->client<b></i></td><td rowspan=\"9\">&nbsp; </td><td colspan=\"7\"><h3>$produit->fournisseur, $produit->nom $produit->prenom</h3></td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\"><i>Ref Client: <b>$produit->client<b></i></td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\">$produit->adresse</td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\"><i>tel: <b>$produit->tel<b></i></td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\"><i>portable: <b>$produit->portable<b></i></td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\"><i>fax :<b>$produit->fax<b></i></td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\"><i>email de contact:</i><a href=\"mailto:$produit->nom $produit->prenom<$produit->email>\">$produit->email</td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\"><i>email de commande:</i><a href=\"mailto:$produit->nom $produit->prenom<$produit->email_cmd>\">$produit->email_cmd</td></tr>\n";
				
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
			}
		if($produit->stock_mini>$produit->stock){$necessaire=$produit->stock_mini-$produit->stock;}
		else{$necessaire="";}
		
		//creer un insert dans la table commande_list pour le produit en cours avec l'id_commande recupere
				
				$req_com_list->save($table_commande_list, "''",  '"' . $id_commande . '"', '"' . $produit->id_produit . '"', '"' . $_POST["qtcommande_".$produit->id_produit] . '"', "''");

		$texto .= "<tr style=\"height:30px\" $cololign align='center'>
		<td class=\"case\"> $produit->titre</td>
		<td class=\"case\"> $produit->categ</td>
		<td class=\"case\"> $produit->produit</td>
		<td class=\"case\"> $produit->reference</td>
		<td class=\"case\"> $produit->conditionnement</td>
		<td class=\"casediscret\"> ".number_format($produit->prix, 2, ',', '')."</td>
		<td class=\"casediscret\"> <b>$produit->stock</b></td>
		<td class=\"casediscret\"> $produit->stock_mini</td>
		<td class=\"case\"> $necessaire</td>
		<td class=\"case\">".$_POST["qtcommande_".$produit->id_produit]."</td>";
		$texto .= "</tr>\n";
		$nblignemax++;
		$fournid=$produit->id_fournisseur;
	}
$texto .= "</table>";


?>