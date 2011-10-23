<?php
require("../config.php");
require_once("../db.class.php");
$lid = strtolower($_POST['lid']);
$que = strtolower($_POST['search']);
$reqpre = new db();
$reqpre->findquery("SELECT *
	FROM produit, titre, categ, fournisseur
	WHERE categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur
	AND produit.id_produit = $lid
 ORDER BY categ.categ ASC");

$produit = $reqpre->row();
$texto .= "
<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\" media=\"screen\" />

<script type=\"text/javascript\">
<!--
function enplus(){
	var theform = document.forms[\"ajout\"];
	var ajoutstock = \"ajoutstock\";
	theform.elements[ajoutstock].value = eval(theform.elements['ajoutstock'].value) + 1;
	
}

function enmoins(){
	var theform = document.forms[\"ajout\"];
	var ajoutstock = \"ajoutstock\";
	theform.elements[ajoutstock].value = eval(theform.elements['ajoutstock'].value) - 1;
		if(eval(theform.elements[ajoutstock].value)<1 ){
			theform.elements[ajoutstock].value = 1;
		}
}


function aumoins(){
	var theform = document.forms[\"ajout\"];
	var ajoutstock = \"ajoutstock\";
	
	if(isNaN(theform.elements[ajoutstock].value)){
		theform.elements[ajoutstock].value = 1;
	}
		if(eval(theform.elements[ajoutstock].value)<1 || theform.elements[ajoutstock].value==\"\"){
			theform.elements[ajoutstock].value = 1;
		}
}

-->
</SCRIPT>
";
if ($produit->quantite_commande > 0)
	{
		$qt=$produit->quantite_commande;
	}
else
	{
		$qt="1";
	}

$texto .= "
<div style=\"background-color:#EFD9F1;border:1px solid grey;clear:both;width:90%;\">
<div style=\"background-color:#EFD9F1;float:right;width:50%\">
<br /><br /><br />
<form name=\"ajout\" action=\"ajout_stock\" method=\"POST\" accept-charset=\"utf-8\">
<input type=\"hidden\" name=\"action\" value=\"ajout\">
<input type=\"hidden\" name=\"qtcommande\" value=\"$produit->quantite_commande\">
<input type=\"hidden\" name=\"lid\" value=\"$produit->id_produit\">
<input type=\"hidden\" name=\"lestockinitial\" value=\"$produit->stock\">
Commande de : $produit->quantite_commande<br />
<p style=\"text-indent: 25px;\">
<input style=\"font-size:25px\" type=\"button\" name=\"plus\" onClick=\"enplus();\" value=\"+\" id=\"leplus\">
<input class=\"actif\" style=\"font-size:25px;width:50px;text-indent:10px;\" type=\"text\" onblur=\"aumoins();\" name=\"ajoutstock\" value=\"$qt\" id=\"ajoutstock\">
<input style=\"font-size:25px\" type=\"button\" name=\"moins\" onClick=\"enmoins();\" value=\"-\" id=\"lemoins\">
</p>
<p><input type=\"submit\" name=\"submitretrait\" value=\"ajouter au stock\" id=\"submitretrait\"></p>
</form>
</div>\n";
$texto .= "
<div style=\"background-color:#EFD9F1;float:left;width:50%;\">
<ul class=\"retrait\">
<li class=\"retrait\"><span class=\"retraitext\"><b><i>$produit->categ</i></b></span></li>
<li class=\"retrait\"><span class=\"retraitprod\"><b>$produit->produit</b></span></li>
<li class=\"retrait\"><hr /></li>
<li class=\"retrait\">Fourn.: <b>$produit->fournisseur</b></li>
<li class=\"retrait\">Ref: <b>$produit->reference</b> </li>
<li class=\"retrait\">Cond. : <b>$produit->conditionnement</b></li>
<li class=\"retrait\">&nbsp;</li>
<li class=\"retrait\"><span class=\"retraitext\">En stock : <b>$produit->stock</b></span></li>

</ul>
</div>
<div style=\"clear:both;\"><!-- --></div>
</div>\n";

$texto .= "<div style=\"clear:both;\"><!-- --></div>\n";
echo $texto;
?>