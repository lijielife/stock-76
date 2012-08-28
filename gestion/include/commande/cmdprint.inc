<?php

	$texto .="<h3 class=\"discret\">Commande de produit</h3>";
	$req = new db();
	$req_com = new db();
	$req_com_list = new db();
	$ret = new db();
	$texto .="&nbsp;&nbsp;<A class=\"discret\" href=\"javascript:window.print()\">Imprimer la liste</A><br /><br />";
	$texto .= "<span style=\"page-break-before:always\" >&nbsp;&nbsp; </span>\n";
	//creer un liste dans la table commande en fonction des fournisseurs
	$date = date("Y-m-d");
	setlocale(LC_TIME, "fr_FR");
	$dadate = strftime("%A %d %B %Y");
	
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
	$texto .= "<h3>&nbsp;&nbsp;$dadate </h3>\n";
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
				
				$texto .= "</table>";
				if($fournid!="abcbibi"){
        		$texto .= "<h3 style=\"page-break-before:always\" >&nbsp;&nbsp;$dadate </h3>\n";
				}
				//enregistre la date de commande dans la table produit de chaque produit (si necessaire pour l'instant)
				$qtcmd="qtcommande_".$produit->id_produit;
				$ret->update($table_produit, '"' . $produit->id_produit . '"', 'date_commande="' . $date . '"', 'commande="1"', 'quantite_commande="' . $_POST[$qtcmd] . '"');	
				
				
				$texto .= "<table cellspacing=\"0\" >\n";
				$texto .="<tr style=\"height:40px\" class=\"clean\" align=\"center\"><td colspan=\"9\">&nbsp;</td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\"><h3>$produit->fournisseur, $produit->nom $produit->prenom</h3></td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\"><i>Ref Client: <b>$produit->client<b></i></td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\">$produit->adresse</td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\"><i>tel: <b>$produit->tel<b></i></td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\"><i>portable: <b>$produit->portable<b></i></td></tr>\n";
				$texto .="<tr align=\"center\"><td colspan=\"9\"><i>fax :<b>$produit->Fax<b></i></td></tr>\n";
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
				
				$req_com_list->save($table_commande_list, "''",  '"' . $id_commande . '"', '"' . $produit->id_produit . '"', '"' . $_POST[$qtcmd] . '"', "''");

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
		<td class=\"case\">".$_POST[$qtcmd]."</td>";
		$texto .= "</tr>\n";
		$nblignemax++;
		$fournid=$produit->id_fournisseur;
	}
$texto .= "</table>";


?>