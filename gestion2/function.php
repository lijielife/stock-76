<?php

function createmplate($page){
	$papage = './vue/template/'.$page.'.tpl';
	$buffer = file_get_contents($papage);
	return $buffer;
}

function template($tpl, $contenu, $lecore){
	$concontenu = '{--'.$contenu.'--}';
	$buffer = str_replace($concontenu, $lecore, $tpl);
	return $buffer;
}
function finishtemplate($str){
	 $str = preg_replace('/{[^ \t\r\n}]+}/', "", $str);
	return $str;
}

function protect($str){
	 return $str;
}
function autosave($table, $champs, $id, $value) {
	if($value=="1" or $value=="true"){ $return="<img class=\"validcheck\" id=\"".$table."_".$champs."_".$id."\" name=\"".$table."_".$champs."_".$id."\" border='0' src='./img/check.gif' alt='checked'>"; }
	if($value=="0" or $value=="" or $value=="false"){ $return="<img  class=\"validcheck\" id=\"".$table."_".$champs."_".$id."\" name=\"".$table."_".$champs."_".$id."\" border='0' src='./img/uncheck.gif' alt='unchecked'>"; }
	return $return;
}



function checkifier($value) {
	if($value=="1" or $value=="true"){ $return="<img border='0' src='./img/check.gif' alt='checked'>"; }
	if($value=="0" or $value=="" or $value=="false"){ $return="<img  border='0' src='./img/uncheck.gif' alt='unchecked'>"; }
	return $return;
}
function voir($what){
	$voirwhat = "voir_" . $what;
	return (($_SESSION[$voirwhat]==true)?"1":"");
}

function seximg($sex){
	$image="";
	if($sex=="f"){ $image="<img border='0' src='./img/femme-small.png' alt='femme'>"; }
	if($sex=="h"){ $image="<img border='0' src='./img/homme-small.png' alt='homme'>"; }
	return $image;
}

function inp($val,$nom,$size,$typ,$class) {
switch($typ){
 case "text";
$boite = "<input class=\"$class\" id=\"" . $nom . "\" name=\"" . $nom . "\" size=\"".$size."\" type=\"text\" value=\"$val\">";
 break;
 case "hidden";
$boite = "<input id=\"" . $nom . "\" name=\"" . $nom . "\" type=\"hidden\" value=\"$val\">";
 break;
 
 case "checkbox";
if($size=="1") {$check="checked";};
$boite = "<input class=\"$class\" id=\"" . $nom . "\" name=\"" . $nom . "\" value=\"" . $val . "\"  type=\"checkbox\"" . $check . " >";
 break;

case "textarea";
$boite = "<textarea class=\"$class\" id=\"" . $nom . "\" name=\"" . $nom . "\" rows=\"".$size."\">$val</textarea>";
 break;
 
  case "select";
$boite = "<select class=\"$class\" name=\"$nom\">\n";
reset($val);
$select = $val["selected"];
next($val);
while (list($key, $value) = each($val)) {
	$boite .= "<option";
	if($select=="$key"){$boite .= " SELECTED";}
	$boite .= " value=\"$key\">$value</option>\n";
	}
 $boite .= "</select>";
 break;
	}
	return $boite;
}

?>