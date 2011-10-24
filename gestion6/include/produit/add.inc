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
	$texto .="<form method=\"post\" name='creation' action=\"./produit?action=save\" accept-charset=\"utf-8\">
			<FIELDSET align=\"left\"> 
			    <LEGEND>Infos produits</LEGEND>
			<table>
	<input type=\"hidden\" name=\"action\" value=\"newprod\" />
	<tr><td><label for=\"categorie\">Categorie :</label></td><td><select name=\"categorie\" class=\"actif corners\" id=\"categorie\" style=\"width:160px;\">\n$catcat\n</select></td></tr>
	<tr><td><label for=\"produit\">Produit : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"produit\" value=\"\" id=\"produit\" /></td></tr>
	<tr><td><label for=\"fournisseur\">Fournisseur : </label></td><td><select class=\"actif corners\" name=\"fournisseur\" id=\"fournisseur\" >$lesfourn</select></td></tr>
	<tr><td><label for=\"reference\">Reference : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"reference\" value=\"\" id=\"reference\" /></td></tr>
	<tr><td><label for=\"conditionnement\">Conditionnement : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"conditionnement\" value=\"\" id=\"conditionnement\" /></td></tr>
	<tr><td><label for=\"used\">produit utilis&eacute; : </label></td><td><input class=\"actif corners\" CHECKED type=\"checkbox\" name=\"used\" value=\"1\" id=\"used\" /></td></tr>
	</table>
	</FIELDSET>
	<br />
	<FIELDSET align=\"left\"> 
	    <LEGEND>prix et stock</LEGEND>
	<table>
	<tr><td><label for=\"prix\">Prix : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"prix\" value=\"\" id=\"prix\" />Euros TTC</td></tr>
	<tr><td><label for=\"stock\">stock : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"stock\" value=\"\" id=\"stock\" /></td></tr>
	<tr><td><label for=\"stock_mini\">stock_mini : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"stock_mini\" value=\"\" id=\"stock_mini\" /></td></tr>	
	</table>
	</FIELDSET>
	<br />
	<FIELDSET align=\"left\"> 
	    <LEGEND>Commande</LEGEND>
	<table>
	<tr><td><label for=\"commande\">commande en cours : </label></td><td><input class=\"actif corners\"  type=\"checkbox\" name=\"commande\" value=\"1\" id=\"commande\" /></td></tr>
	<tr><td><label for=\"quantite_commande\">quantite command&eacute;e : </label></td><td><input class=\"actif corners\" type=\"text\" name=\"quantite_commande\" value=\"\" id=\"quantite_commande\" /></td></tr>	
	</table>
		</FIELDSET> 
		<br />
	<input type=\"submit\" name=\"submitbutton\" value=\"valider\" /><input type=\"button\" name=\"cancel\" value=\"annuler\" onclick=\"history.back()\" />
	</form>";
	
?>