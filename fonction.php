<?php

function message($type, $text){
	$mess= "<div><span class=\"box $type corners\">$text</span></div>";
	return $mess;
}

function infos($id){
	$reti = new db();
	$say = $reti->findupdate("SELECT produit.produit, categ.categ FROM  `produit`, `categ` WHERE produit.id_categ=categ.id_categ AND produit.id_produit=$id");
	$info = $reti->row();
	if($info!=""){
	$lesinfos = $info->categ ." : " . $info->produit;}
	else{$lesinfos="<img src=\"../img/exclamation.png\" alt=\"no info\"/>";}
	return $lesinfos;
}

function selprod($lid){
	$reti = new db();
	$say = $reti->findquery("SELECT produit.id_produit, produit.produit, categ.categ, titre.titre FROM  `produit`, `categ`, `titre` WHERE produit.id_categ=categ.id_categ AND categ.id_titre=titre.id_titre AND titre.titre LIKE 'bracket' ORDER BY produit.id_produit");
	$selproduitbk ="<option value=\"\">bk</option>\n";
	while($produitbk = $reti->row()){
	$selproduitbk .= "<option";
	$selproduitbk .=(($lid==$produitbk->id_produit)?" SELECTED":"");
	$selproduitbk .=" value=\"$produitbk->id_produit\">$produitbk->categ : $produitbk->produit</option>\n";
	}
	$selproduitbk .= "</select>";
	
	return $selproduitbk;
	
}

function validcateg($what){
	if(ereg('^[A-Z]+$', $what)){
	return false;
	}
	else{
	return true;
	}
}


	$wR = array(
'1' => '18',
'2' => '17',
'3' => '16',
'4' => '15',
'5' => '14',
'6' => '13',
'7' => '12',
'8' => '11',
'9' => '21',
'10' => '22',
'11' => '23',
'12' => '24',
'13' => '25',
'14' => '26',
'15' => '27',
'16' => '28',
'17' => '48',
'18' => '47',
'19' => '46',
'20' => '45',
'21' => '44',
'22' => '43',
'23' => '42',
'24' => '41',
'25' => '31',
'26' => '32',
'27' => '33',
'28' => '34',
'29' => '35',
'30' => '36',
'31' => '37',
'32' => '38');

function ordre_dent($ordre){
$wR = $GLOBALS['wR'];
	$dent = str_replace(array_values($wR),array_keys($wR),$ordre);
	return $dent;
}

function dent_ordre($dent){
$wR = $GLOBALS['wR'];
	$ordre = str_replace(array_values($wR),array_keys($wR),$dent);
	return $ordre;
}

?>