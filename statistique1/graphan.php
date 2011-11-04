<?php

//http://localhost/stock3/statistique/graphan.php?idprod=47

require("../config.php");
require_once("../db.class.php");
$laction=(isset($_GET['action']))?$_GET['action']:"";


$finfin = date("Y-m-d");

list($year, $month, $day) = split('[/.-]', $finfin);
$debdeb = $year-1 ."-".$month."-".$day;

if($_GET['debut']!=""){
	$datedebut =  $_GET['debut'];
	}
else{
	$datedebut =  $debdeb;
}

if($_GET['fin']!=""){
	$datefin = $_GET['fin'];
	}
else{
	$datefin = $finfin;
}




$lafinfin = date("Y");

$data1y="[";
$data2y="[";
$datax="[";

$id_prod = $_GET['idprod'];

for ( $i=$lafinfin; $i >= 2007 ; $i-- )
{ 
	$datax.= "'".$i."', ";
	$statdebut = $i."-01-01";
	$statfin = $i."-12-31";
	
	$reqstat = new db();
	$reqstat->findquery("SELECT *, sum(quantite) as N FROM flux, produit, categ, titre 
		WHERE flux.id_produit=$id_prod AND quantite > 0 AND  flux.date >= '$statdebut' AND flux.date <= '$statfin'
		AND flux.id_produit=produit.id_produit AND produit.id_categ=categ.id_categ AND titre.id_titre=categ.id_titre ORDER BY flux.date");
	$statN = $reqstat->row();
	if($statN->N==""){$statN->N="0";}
	$data1y.="".$statN->N.", ";
	
	$reqstat->findquery("SELECT *, sum(quantite) as N FROM flux, produit, categ, titre 
		WHERE flux.id_produit=$id_prod AND quantite < 0 AND  flux.date >= '$statdebut' AND flux.date <= '$statfin'
		AND flux.id_produit=produit.id_produit AND produit.id_categ=categ.id_categ AND titre.id_titre=categ.id_titre ORDER BY flux.date");
	$statN = $reqstat->row();
	if($statN->N==""){$statN->N="0";}
	$data2y.="".abs($statN->N).", ";
	
	$nomprod = $statN->produit;
	$categprod = $statN->categ;
	$titreprod = $statN->titre;
	$titregraph = "$titreprod : $categprod : $nomprod de 2007 à $lafinfin";
}

	$data1y.= "]";
	$data2y.= "]";
	$datax.="]";


$dadate = strftime("%A %d %B %Y");
$texto = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
	\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
$texto .= "<html xmlns=\"http://www.w3.org/1999/xhtml\"
	    xml:lang=\"fr\"
	    lang=\"fr\"
	    dir=\"ltr\">
<head>
<title>Gestion Stock en ligne: Produit: $rajout</title>
<meta content=\"text/html; Charset=UTF-8\" http-equiv=\"Content-Type\" />
<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\" media=\"screen\" />

<script type=\"text/javascript\" language=\"javascript\" src=\"../jquery-1.4.2.min.js\" charset=\"utf-8\"></script>
<script type=\"text/javascript\" language=\"javascript\" src=\"./Highcharts/js/highcharts.js\" charset=\"utf-8\"></script>
<script type=\"text/javascript\" src=\"./Highcharts/js/themes/gray.js\"><script>	

</head>
<body>
<script type=\"text/javascript\" charset=\"utf-8\"></script>\n
<form action=\"../statistique/graph3.php\" method=\"get\" accept-charset=\"utf-8\">
par mois :début<input class=\"actif\"  type=\"text\" name=\"debut\" value=\"$datedebut\" id=\"debut\" />
&nbsp;fin<input class=\"actif\"  type=\"text\" name=\"fin\" value=\"$datefin\" id=\"fin\" />
<input type=\"hidden\" name=\"idprod\" value=\"$id_prod\" id=\"idprod\" />
<input type=\"submit\" value=\"Go\" />
</form>";
	

$texto .= "
<script type=\"text/javascript\" charset=\"utf-8\">

Highcharts.setOptions({
    colors: ['#FFAB2B', '#752B7D', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
});

var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'chart-container-1',
            defaultSeriesType: 'column'
         },
         title: {
            text: '$titregraph'
         },
         xAxis: {
            categories: $datax
         },
         yAxis: {
            title: {
               text: 'Quantité'
            }
         },
         series: [{
            name: 'ajout',
            data: $data1y
                 
         }, {
            name: 'retrait',
            data: $data2y
                
         }]
      });
   });
</script>\n";

$texto .="<div id=\"chart-container-1\" style=\"width: 100%; height: 500px\"></div>";
$texto .= "</div>
</body>
</html>";
echo $texto;
?>

