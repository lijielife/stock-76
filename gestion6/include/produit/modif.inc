<?php
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
		
// $getid=(isset($_GET['id']))?$_GET['id']:"";
// $getsearch=(isset($_GET['search']))?$_GET['search']:"";
// $getoldid=(isset($_GET['oldid']))?$_GET['oldid']:"";
// $getoldfourni=(isset($_GET['oldfourni']))?$_GET['oldfourni']:"";
// $getoldact=(isset($_GET['oldact']))?$_GET['oldact']:"";
// $getoldordre=(isset($_GET['oldordre']))?$_GET['oldordre']:"";

	$allGET = "";
	foreach ($_GET as $key => $value) {
		if($key!="action"){
		$allGET .= "&$key=$value";
		}
		
		
	}

	$texto .="<form method=\"post\" name='modification' action=\"./produit?action=save".$allGET."\" accept-charset=\"utf-8\">
		<FIELDSET align=\"left\"> 
		    <LEGEND>Infos produits</LEGEND>
	<input type=\"hidden\" name=\"action\" value=\"modprod\">
	<label for=\"categorie\">Categorie :</label><select name=\"categorie\" style=\"width:160px;\">\n$catcat\n</select><br />
	<label for=\"produit\">Produit : </label><input class=\"actif corners\" type=\"text\" name=\"produit\" value=\"$leproduit->produit\" id=\"produit\" /><br />
	<label for=\"fournisseur\">Fournisseur : </label><select class=\"actif corners\" name=\"fournisseur\" id=\"fournisseur\">$lesfourn</select><br />
		<label for=\"reference\">Reference : </label><input class=\"actif corners\" type=\"text\" name=\"reference\" value=\"$leproduit->reference\" id=\"reference\" /><br />
	<label for=\"conditionnement\">Conditionnement : </label><input class=\"actif corners\" type=\"text\" name=\"conditionnement\" value=\"$leproduit->conditionnement\" id=\"conditionnement\" /><br />
	<label for=\"used\">produit utilis&eacute; : </label><input class=\"actif corners\" $utilise type=\"checkbox\" name=\"used\" value=\"1\" id=\"used\" />
	</FIELDSET>
	<br />
	<FIELDSET align=\"left\"> 
	    <LEGEND>prix et stock</LEGEND>
	<label for=\"prix\">Prix : </label><input class=\"actif corners\" type=\"text\" name=\"prix\" value=\"".number_format($leproduit->prix, 2, ',', '')."\" id=\"prix\" />Euros TTC<br />
	<label for=\"stock\">stock : </label><input class=\"actif corners\" type=\"text\" name=\"stock\" value=\"$leproduit->stock\" id=\"stock\" /><br />
	<label for=\"stock_mini\">stock_mini : </label><input class=\"actif corners\" type=\"text\" name=\"stock_mini\" value=\"$leproduit->stock_mini\" id=\"stock_mini\" />
	</FIELDSET>
	<br />
	<FIELDSET align=\"left\"> 
	    <LEGEND>Commande</LEGEND>
	<label for=\"commande\">commande en cours : </label><input class=\"actif corners\" $commande type=\"checkbox\" OnClick=\"comdate();\" name=\"commande\" value=\"1\" id=\"commande\" /><br />
	<label for=\"quantite_commande\">quantite command&eacute;e : </label><input class=\"actif corners\" type=\"text\" name=\"quantite_commande\" value=\"$leproduit->quantite_commande\" id=\"stock_mini\" /><br />	
	<label for=\"date_commande\">Date de commande : </label><input class=\"actif corners\" type=\"text\" name=\"date_commande\" value=\"$laladate\" id=\"date_commande\" /> <code>jj/mm/aaaa </code>
	</FIELDSET>
	<br />
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"submitbutton\" value=\"valider\" /><input type=\"button\" name=\"cancel\" value=\"annuler\" onclick=\"history.back()\" /></form>
	<br /><hr /><form method=\"post\" action=\"produit?action=eff&id=" .  $leproduit->id_produit . "\"> <input type=\"submit\" value=\"supprimer\"> </form>";
	
?>