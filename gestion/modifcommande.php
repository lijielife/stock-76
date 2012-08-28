<?php

require_once("../db.class.php");
require("../fonction.php");


$lecore ="";
$idcommande = $_GET['lid'];
$kase= $_GET['kase'];
if ($kase=="conjoint") {
	$linom = '	$("input[name=linkname]").val(field4 + " " + field3);';
}else{
	$linom = '	$("input[name='.$kase.']").val(field4);';
}

$lecore .='
<script type="text/javascript">
	$(document).ready(function(){

	$("#formmodifcommande").submit(function(){ 
	var field1 = $("input[name=mid_commande]").val();
	var field2 = $("input[name=mdate]").val();
	var field3 = $("textarea[name=mnote]").val();
	var field4 = $("input[name=mfacture]").val();
	var field5 = $("select[name=mfourn]").val();

 //	$("#tr_"+field1).html("<td>"+field2+"</td>");

	// ajax call to itself 
	$.post("commande_save", {action: "modcommande", id_commande: field1, date: field2, note: field3, facture: field4, fournisseur: field5}, function(data){
	 '.$linom.'
	$("#tr_"+field1).load("lignecmd.php", { idcmd: field1} );
		tb_remove();});
 	
	return false;
	});

	});
</script>';

$reqpre = new db();
$req = new db();
$reqpre->findquery("SELECT * FROM  `commande`, `fournisseur` WHERE id_commande=$idcommande AND commande.id_fournisseur=fournisseur.id_fournisseur");

$commande = $reqpre->row();

	$lesfourn = array("selected"=>"$commande->id_fournisseur", "0"=>"--choisir un fournisseur--");
	$req->findquery("SELECT * FROM  `fournisseur` WHERE id_fournisseur!=0 ORDER BY fournisseur");
	while($fourn = $req->row()){
	$lesfourn[$fourn->id_fournisseur] .= $fourn->fournisseur;
	}

list ($year, $month, $day) = explode ("-", $commande->date);
$datecom = (($commande->date=="0000-00-00")?"":"$day/$month/$year");


$forminput = 'inp';
$lecore .= <<<EOD
	<form name="formmodifcommande" id="formmodifcommande" method="POST" accept-charset="utf-8" style="width: 450px">
	<fieldset style="width: 500px;margin-left:5px;">
<legend >Commande</legend>
{$forminput("$commande->id_commande","mid_commande",20,"hidden","actif")}
{$forminput("modifcommande","maction",20,"hidden","actif")}
<label for="mdate" >Date de commande </label>{$forminput("$datecom","mdate",20,"text","actif")}<br />
<label for="mfourn" > Fournisseur </label>{$forminput($lesfourn,"mfourn",12,"select","actif")}<br />
<label for="mfacture" > N&deg; facture </label>{$forminput($commande->num_facture,"mfacture",15,"text","actif")}<br />
<label for="mnote" > Note </label>{$forminput("$commande->note","mnote",5,"textarea","actif")}<br />
</fieldset>
<p><label for="save" >&nbsp;</label><input style="width: 150px" name="msave" id="save" type="submit" value="enregistrer"></p>
<br />
<input style="float:right" type="button" value="annuler" onclick="tb_remove();">
	</form><br />
EOD;

echo $lecore;
?>