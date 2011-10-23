<?php
$mois = $_GET['mois'];
$annee = $_GET['annee'];
$id_prod = $_GET['idprod'];
if ($mois=="") {$mois= "07";}
if ($annee=="") {$annee= "2008";}
if ($id_prod=="") {$id_prod= "1";}
$texto = '<meta http-equiv="expires" content="0"> 
<meta http-equiv="pragma" content="no-cache"> 
<meta http-equiv="cache-control" content="no-cache, must-revalidate"> ';

$texto = "<img src=\"../statistique/graph2?annee=$annee&mois=$mois&idprod=$id_prod\" border='0'>";

echo $texto;
?>