<?php

	$total = 0;
	$reqpre = new db();
	$ordre = $_GET['ordre'];
	switch ($_GET['ordre']) {
		case 'id_categ':
			$ordre ="produit.".$_GET['ordre'];
			break;
		case 'id_titre':
			$ordre ="categ.".$_GET['ordre'];
		break;
		case 'id_fournisseur':
			$ordre ="produit.".$_GET['ordre'];
		break;
		case 'produit':
			$ordre ="produit.".$_GET['ordre'];
		break;
		case 'stock':
			$ordre ="produit.stock DESC";
			break;
		case 'prix':
			$ordre ="produit.prix DESC";
		break;
		case 'totalprix':
			$ordre =" (produit.prix*produit.stock) DESC";
		break;
		default:
			$ordre ="produit.produit";
		break;
	}	
		if($_GET['search']){
		$que=$_GET['search'];
		$quoi ="&search=" . $que;
		$queque2=$que;
		$whair = "(produit.produit LIKE '%$que%' OR fournisseur.fournisseur LIKE '%$que%' OR produit.reference LIKE '%$que%' OR categ.categ LIKE '%$que%')";
	}
	else {
		$whair=1;
		$quoi="";
		}
		if($_GET['id']!=""){
		$cat = $_GET['id'];
    $whair .= " AND categ.id_categ=$cat";
    $quoi .= "&id=$cat";
    }
		
	$reqpre->findquery("SELECT *
		FROM produit, titre, categ, fournisseur
		WHERE categ.id_categ = produit.id_categ
		AND categ.id_titre = titre.id_titre
		AND produit.id_fournisseur = fournisseur.id_fournisseur AND $whair
	 ORDER BY $ordre");
	$texto.= "<form name=\"cherch\" action=\"./produit?action=search\" method=\"post\" accept-charset=\"utf-8\">
	<p>	<input autocomplete=\"off\"  class=\"actif\" type=\"text\" id=\"txt_search\" name=\"search\" value=\"\"><input type=\"submit\" value=\"rechercher\"></p>
	</form>
	<form action=\"./produit?action=commander\" method=\"post\">
	<span id=\"suggest\"><table cellspacing=\"0\" >";
		if($_GET['search']){
		$texto.= "	<i>recherche pour : <b>$que</b>&nbsp;&nbsp; classer par : <b>".$_GET['ordre']."</b> </i>";}
	$texto.= "
	<span id=\"suggest\"><table cellspacing=\"0\" >
	<tr>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_titre$quoi'>".(($_GET['ordre']=="id_titre")?"&#9679;":"")."Titre</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_categ$quoi'>".(($_GET['ordre']=="id_categ")?"&#9679;":"")."Categ</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=produit$quoi'>".(($_GET['ordre']=="produit")?"&#9679;":"")."Produit</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=id_fournisseur$quoi'>".(($_GET['ordre']=="id_fournisseur")?"&#9679;":"")."fourn.</a></th>
	<th class=\"listingprod\">reference</th>
	<th class=\"listingprod\">condit.</th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=prix$quoi'>".(($_GET['ordre']=="prix")?"&#9679;":"")."prix</a></th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=stock$quoi'>".(($_GET['ordre']=="stock")?"&#9679;":"")."stock</a></th>
	<th class=\"listingprod\">stk_mini</th>
	<th class=\"listingprod\">QT_CMD</th>
	<th class=\"listingprod\"><input type=\"submit\" value=\"CMD\"></th>
	<th class=\"listingprod\">date</th>
	<th class=\"listingprod\">modif</th>
	<th class=\"listingprod\"><a class=\"listingprod\" href='produit?action=classer&ordre=totalprix$quoi'>".(($_GET['ordre']=="totalprix")?"&#9679;":"")."&#8364;</a></th>
	</tr>\n";
	$nblignemax = 1;
	while($produit = $reqpre->row()){
		$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
		
		$checkage="";
		if($produit->used=="0"){$cololign = "class=\"unused\""; $checkage="disabled";}
		if(($produit->used=="1") && ($produit->stock<$produit->stock_mini)){	$cololign = "class=\"stock\"";}
		if($produit->commande=="1"){$cololign = "class=\"bientotstock\"";}
		if (isset($_GET['oldprodid'])){ if($produit->id_produit==$_GET['oldprodid']){ $cololign = "class=\"justchange\"";}}
		
		$tot = floatval($produit->stock) * floatval($produit->prix);
		$totaligne = number_format($tot, 2, ',', '');
		list ($year, $month, $day) = explode ("-", $produit->date_commande);
		$datecom = (($produit->date_commande=="0000-00-00")?"":"$day/$month/$year");
		$texto .= "<tr $cololign align='center'>
		<td> $produit->titre</td>
		<td> $produit->categ</td>
		<td> $produit->produit</td>
		<td> $produit->fournisseur</td>
		<td> $produit->reference</td>
		<td> $produit->conditionnement</td>
		<td>".number_format($produit->prix, 2, ',', '')."</td>
		<td> <b>$produit->stock</b></td>
		<td> $produit->stock_mini</td>
		<td> $produit->quantite_commande</td>
		<td><input type=\"checkbox\" $checkage name=\"cmd[]\" value=\"$produit->id_produit\"/></td>
		<td>$datecom</td>
		<td><a href='produit?action=modif&id=" .  $produit->id_produit . "&oldact=classer&search=$queque2&oldordre=".$ordre."'><img border='0' src='../img/pencil.gif' alt='modif'></a></td>
		<td>".$totaligne."</td>
		</tr>\n";
		$total = $total + (floatval($produit->stock) * floatval($produit->prix));
		$nblignemax++;
	}
		$texto .= "<tr><td colspan=14><center>Total en stock:  <b>".number_format($total, 2, ',', '')." &#8364;</b></center></td></tr>";
		$texto .= "</table>";

?>