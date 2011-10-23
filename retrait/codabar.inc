<?php
$ret = new db();
$date = date("Y/m/d");
if(!get_magic_quotes_gpc()){
	foreach($_POST as $k => $v) $_POST[$k] = addslashes($v);
}
switch($_POST['action']){
	case "retraitcodabar";
	//passage du code rentre en clavier americain au clavier francais
	$phrase  = $_POST['champsbar'];
	$healthy = array("Q", "?", ")");
	$yummy   = array("A", "M", "-");
	$newphrase = str_replace($healthy, $yummy, $phrase);
	$ret->findupdate("UPDATE produit SET stock=stock-1 WHERE codabar='".$newphrase. "' OR codabar='".$phrase. "'");
	$ret->findquery("SELECT id_produit FROM produit WHERE codabar='".$newphrase. "' OR codabar='".$phrase. "'");
	$prod = $ret->row();
	$ret->save('flux', "''", '"' . $prod->id_produit . '"', '"-1"', '"' . $date . '"');
	$mess ="retraitcodabar";
	$codabarproduct = $newphrase;
	$page = "index";
	break;
	default;
	$mess ="";
	$page = "index";
	break;	
}
//-------------------
$texto .= "
<div style=\"background-color:#EFD9F1;border:1px solid grey;clear:both;width:60%\">";
$requi = new db();
$requi->findquery("SELECT * FROM produit, categ, fournisseur WHERE produit.id_categ=categ.id_categ AND produit.id_fournisseur=fournisseur.id_fournisseur AND (codabar='".$newphrase. "' OR codabar='".$phrase. "')");
$produit = $requi->row();
if ($produit!="") {
$texto .= "
<br /><span class=\"affichage\">le produit suivant &agrave; &eacute;t&eacute; retir&eacute; du STOCK </span>
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
	$texto .= "<br /><br /><br /><span class=\"affichage\">aucun produit ne correspond &agrave; ce code barre : ". $phrase."</span><br /><br /><br /><br />";
}

$texto .= "</div>";
//-----------------

// header('Location:./'.$page.'?mess=' . $mess . '&codabar='. $codabarproduct);
// exit;

?>