<?php

//http://localhost/stock3/statistique/graph3.php?idprod=47&debut=2008-01-01&fin=2010-01-01


require("../config.php");
require_once("../db.class.php");
$laction=(isset($_GET['action']))?$_GET['action']:"";

$finfin = date("Y-m-d");

list($year, $month, $day) = split('[/.-]', $finfin);
$debdeb = $year-1 ."-".$month."-".$day;

$mois = $_GET['mois'];
$annee = $_GET['annee'];
$id_prod = $_GET['idprod'];
$anneeplus = $annee + 1;
//$datedebut = $annee ."-". $mois . "-01";
//$datefin = $anneeplus."-". $mois . "-01";

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


$date = date("d/m/Y");
setlocale(LC_TIME, "fr_FR");
$dadate = strftime("%A %d %B %Y");
	$reqpre = new db();
	$reqpre->findquery("SELECT * FROM flux, produit, categ, titre 
		WHERE flux.id_produit=$id_prod AND  flux.date >= '$datedebut' AND flux.date <= '$datefin'
		AND flux.id_produit=produit.id_produit AND produit.id_categ=categ.id_categ AND titre.id_titre=categ.id_titre ORDER BY flux.date");

	$nblignemax = 1;
	$data1y="[";
	$data2y="[";
	$datax="[";
	$monthprec ="ababa";
	$month="";
	$totalmoisplus= 0;
	$totalmoismoins= 0;
	$supertotalmoisplus= 0;
	$supertotalmoismoins= 0;


	while($flux = $reqpre->row()){
		
		list($year, $month, $day) = split('[/.-]', $flux->date);	
		if($month==$monthprec or $monthprec=="ababa"){
			if ($flux->quantite > 0){$totalmoisplus += floatval($flux->quantite);}
			else{$totalmoismoins += floatval($flux->quantite);}
			$lemois = date("M", mktime(0, 0, 0, $month,  $day, $year));
			$lannee = date("Y", mktime(0, 0, 0, $month,  $day, $year));
		}
		else{
			$datax.= "'".$lemois." ".$lannee."', ";
			$data1y.= "".$totalmoisplus.", ";
			$data2y.= "".abs($totalmoismoins).", ";
			$supertotalmoisplus += $totalmoisplus;
			$supertotalmoismoins += $totalmoismoins;
			$totalmoisplus= 0;
			$totalmoismoins= 0;
			if ($flux->quantite > 0){$totalmoisplus += floatval($flux->quantite);}
			else{$totalmoismoins += floatval($flux->quantite);}
			$lemois = date("M", mktime(0, 0, 0, $month,  $day, $year));
		
		}
		
		$nomprod = $flux->produit;
		$categprod = $flux->categ;
		$titreprod = $flux->titre;
		$titregraph = "$titreprod : $categprod : $nomprod du $datedebut au $datefin";
		$monthprec=$month;
		$nblignemax++;
		
	}
	
	$data1y.= "".$totalmoisplus.", ";
	$data2y.= "".abs($totalmoismoins).", ";
	$datax.= "'".$lemois." ".$lannee."', ";
	
	
	$supertotalmoisplus += $totalmoisplus;
	$supertotalmoismoins += $totalmoismoins;
	$data1y.= "".$supertotalmoisplus."]";
	$data2y.= "".abs($supertotalmoismoins)."]";
	$datax.="'total $annee']";




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
par mois :  début<input class=\"actif\"  type=\"text\" name=\"debut\" value=\"$datedebut\" id=\"debut\" />
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

