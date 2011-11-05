<?php

$lignentete = new Entete("listingprod", $laction, $_GET['ordre'], $lesens, "");
$thete[1] =array("");
$thete[2] =array("titre", "id_titre");
$thete[3] =array("Categ", "categ");
$thete[4] =array("Produit", "produit");
$thete[5] =array("Fourn", "id_fourn");
$thete[6] =array("ref.");
$thete[7] =array("condit.");
$thete[8] =array("prix", "prix");
$thete[9] =array("stock", "stock");
$thete[10] =array("mini");
$thete[11] =array("QT_CMD");
$thete[12] =array("<img border='0' src='../img/chart_bar.png' alt='graph'>");
$thete[13] =array("&#8364;", "totalprix");
$thete[14] =array("flux_N");
$thete[15] =array("N-1");

$Pligne = $lignentete->make_ligne($thete);
$texto .=  "<tr>";
$texto .= $lignentete->whatwhat;
$texto .=  "</tr>";


?>