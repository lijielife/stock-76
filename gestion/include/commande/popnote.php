<?php

require("../../../config.php");
require_once("../../../db.class.php");
$lecore ="<p style=\"font-weight:bold\">";
$id_commande = $_GET['id'];

$reqpre = new db();
$reqpre->findquery("SELECT note FROM `commande` WHERE id_commande=$id_commande");

$lanote = $reqpre->row();
$lecore .= "$lanote->note";
$lecore .="</p>";

echo $lecore;
?>