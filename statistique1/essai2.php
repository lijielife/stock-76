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
			$data2y[].= $totalmoismoins;
			$supertotalmoisplus += $totalmoisplus;
			$supertotalmoismoins += $totalmoismoins;
			echo $supertotalmoisplus."<br/>";
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
	$data2y[].= $totalmoismoins;
	$datax[].=$lemois;
	
	$supertotalmoisplus += $totalmoisplus;
	$supertotalmoismoins += $totalmoismoins;
	echo $supertotalmoisplus."<br/>";
	echo $supertotalmoismoins."<br/>";
	$data1y[].= $supertotalmoisplus;
	$data2y[].= $supertotalmoismoins;
	$datax[].="total $annee";

?>