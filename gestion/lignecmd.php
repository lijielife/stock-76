<?php

require_once("../db.class.php");
require("../fonction.php");



$idcmd = $_POST['idcmd'];
$reqpre = new db();
$say = $reqpre->findquery("SELECT * FROM  `commande`, `fournisseur` WHERE commande.id_commande=$idcmd AND commande.id_fournisseur=fournisseur.id_fournisseur ");

$commande = $reqpre->row();
list ($year, $month, $day) = explode ("-", $commande->date);
$datecom = (($commande->date=="0000-00-00")?"":"$day/$month/$year");

$note_abrege = substr($commande->note, 0, 30);

$modifmodal = '<a class="thickbox" href="./modifcommande?lid='.$commande->id_commande.'&height=350&width=550&kase=commande" title="Commande du '.$datecom.' chez '. $commande->fournisseur.'">';

$texto .= "
<td><a class=\"commando\" id=\"$commande->id_commande\" href='#'> $datecom</a></td>
<td align='center'><a class=\"commando\" id=\"$commande->id_commande\" href='#'> $commande->fournisseur</a></td>
<td align='center'><a class=\"commando\" id=\"$commande->id_commande\" href='#'> $commande->num_facture</a></td>
<td align='center'><a class=\"thickbox\" href=\"./include/commande/popnote?id=$commande->id_commande&height=200&width=300\">$note_abrege...</a></td>
<td align='center'>$modifmodal<img border='0' src='../img/pencil.gif' alt='modif'></a></td>
<td align='center'><a href='commande?action=eff&id=" .  $commande->id_commande . "'><img border='0' src='../img/erase.png' alt='efface'></a></td>
\n";


$texto  .=<<<EOD
<link rel="stylesheet" href="../js/thickbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="../js/thickbox.js"></script>
EOD;

$texto .="
<script type=\"text/javascript\">
	$(document).ready(
		
		function(){
		$(\"a.commando\").click(function(){
			$('#resultat').empty();
			var lien = $(this).attr('id');
			$('#resultat').load('./include/commande/commande_list', {lacom: lien});
			});

	});

</script>\n";
echo $texto;
?>