<?php

$lignentete = new Entete("listingprod", $laction, $_GET['ordre'], $lesens, $rajout_class);
$thete[1] = array("titre", "id_titre");
$thete[2] =array("Categ", "categ");
$thete[3] =array("Produit", "produit");
$thete[4] =array("Fourn", "id_fourn");
$thete[5] =array("reference");
$thete[6] =array("condit.");
$thete[7] =array("prix", "prix");
$thete[8] =array("stock", "stock");
$thete[9] =array("stk_mini");
$thete[10] =array("QT_CMD");
$thete[11] =array("<input type=\"submit\" value=\"CMD\">");
$thete[12] =array("date");
//$thete[13] =array("<img border='0' src='../img/pencil.gif' alt='modif'>");
$thete[13] =array("&#8364;", "totalprix");
$Pligne = $lignentete->make_ligne($thete);
$texto .=  "<tr>";
$texto .= $lignentete->whatwhat;
$texto .=  "</tr>";


?>