<?php

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
	
?>