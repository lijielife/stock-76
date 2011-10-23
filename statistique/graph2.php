<?php
require("../config.php");
require_once("../db.class.php");
$mois = $_GET['mois'];
$annee = $_GET['annee'];
$id_prod = $_GET['idprod'];
$anneeplus = $annee + 1;
$datedebut = $annee ."-". $mois . "-01";
$datefin = $anneeplus."-". $mois . "-01";
$date = date("d/m/Y");
setlocale(LC_TIME, "fr_FR");
$dadate = strftime("%A %d %B %Y");
	$reqpre = new db();
	$reqpre->findquery("SELECT * FROM flux, produit, categ, titre 
		WHERE flux.id_produit=$id_prod AND  flux.date >= '$datedebut' AND flux.date <= '$datefin'
		AND flux.id_produit=produit.id_produit AND produit.id_categ=categ.id_categ AND titre.id_titre=categ.id_titre ORDER BY flux.date");

	$nblignemax = 1;
	$data1y=array();
	$data2y=array();
	$datax=array();
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
		}
		else{
			$datax[].=$lemois;
			$data1y[].= $totalmoisplus;
			$data2y[].= abs($totalmoismoins);
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
		$monthprec=$month;
		$nblignemax++;
	}
	$data1y[].= $totalmoisplus;
	$data2y[].= abs($totalmoismoins);
	$datax[].=$lemois;
	
	$supertotalmoisplus += $totalmoisplus;
	$supertotalmoismoins += $totalmoismoins;
	$data1y[].= $supertotalmoisplus;
	$data2y[].= abs($supertotalmoismoins);
	$datax[].="total $annee";


include ("./jpgraph/src/jpgraph.php");
include ("./jpgraph/src/jpgraph_bar.php");

// $data1y = unserialize($_GET['fluxplus']);
// $data2y = unserialize($_GET['fluxmoins']);
// $data1y=array(-8,8,9,3,5,6);
// $data2y=array(18,2,1,7,5,4);
// $datax=array("Jan","Fev","Mar","Avr","Mai","Juin");

// Create the graph. These two calls are always required
$graph = new Graph(550,400,"auto"); 
$graph->SetScale("textlin");

$graph->SetShadow();
$graph->img->SetMargin(40,120,50,40);
$graph->legend->Pos(0.03,0.5,"right","center");

// Create the bar plots
$b1plot = new BarPlot($data1y);
// $b1plot->SetWidth(12);
$b1plot->SetFillColor("#FFAB2B");
$b1plot->value->Show();
$b1plot->SetLegend("ajout");


$b2plot = new BarPlot($data2y);
// $b2plot->SetWidth(12);
$b2plot->SetFillColor("#752B7D");
$b2plot->value->Show();
$b2plot->SetLegend("retrait");

// Create the grouped bar plot
$gbarplot = new GroupBarPlot(array($b1plot,$b2plot));
$gbarplot->SetWidth(0.6);
$graph->Add($gbarplot);

// ...and add it to the graPH

$graph->title->Set("$titreprod:$categprod:$nomprod \nflux par mois pour l'annee $annee");
$graph->xaxis->title->Set("mois");
$graph->yaxis->title->Set("quantite");
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,10);
$graph->xaxis->SetTickLabels($datax);

$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Display the graph
$graph->Stroke();
?>