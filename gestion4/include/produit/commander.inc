<?php

	$texto .="<h3>Commande de produit</h3>";
	$req = new db();
	$texto .="<form method=\"post\" action=\"./commanderimprimer\">";
	$texto .= "<table cellspacing=\"0\" >
	<tr>
	<th class=\"listingprod\">Titre</th>
	<th class=\"listingprod\">Categ</th>
	<th class=\"listingprod\">Produit</th>
	<th class=\"listingprod\">Fourn</th>
	<th class=\"listingprod\">reference</th>
	<th class=\"listingprod\">condit.</th>
	<th class=\"listingprod\">prix</th>
	<th class=\"listingprod\">stock</th>
	<th class=\"listingprod\">stk_mini</th>
	<th class=\"listingprod\">QT_CMD</th>
	</tr>\n";
	$idacommander ="";
	foreach ($_POST['cmd'] as $value) {
		$idacommander .= "$value, ";
			}
	$newtaille =strlen($idacommander)-2; //supprime la derniere virgule et l'espace
	$idacommander = substr($idacommander, 0, $newtaille);
	$req->findquery("SELECT * 
	FROM produit, titre, categ, fournisseur
	WHERE produit.id_produit IN ($idacommander) AND categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur
	ORDER BY fournisseur.fournisseur ASC");
	$nbdeprod = $req->__get('numrows');
	//dfdvxc
	$nblignemax = 1;
		while($produit = $req->row()){
		$cololign = (($nblignemax%2 == 0)?"":"class=\"alt\"");
		if(($produit->used=="1") && ($produit->stock<$produit->stock_mini)){
			$cololign = "class=\"stock\"";
		}
		if(($produit->used=="1") && ($produit->commande=="1")){
				$cololign = "class=\"bientotstock\"";
			}
		if (isset($_GET['oldprodid'])){
		  if($produit->id_produit==$_GET['oldprodid']){
			$cololign = "class=\"justchange\"";
	   	}
    }
		if($produit->stock_mini > $produit->stock){$necessaire=$produit->stock_mini-$produit->stock;}
		else{$necessaire="0";}
		$texto .= "<tr $cololign align='center'>
		<td> $produit->titre</td>
		<td> $produit->categ</td>
		<td> $produit->produit</td>
		<td> $produit->fournisseur</td>
		<td> $produit->reference</td>
		<td> $produit->conditionnement</td>
		<td> ".number_format($produit->prix, 2, ',', '')."</td>
		<td> <b>$produit->stock</b></td>
		<td> $produit->stock_mini</td>
		<td><input type='hidden' name='cmd[]' value='$produit->id_produit' />
		 <input class=\"actif\" name=\"qtcommande_$produit->id_produit\" size=\"4\" value=\"$necessaire\" /></td>";
		$texto .= "</td>
		</tr>\n";
			$total = $total + (floatval($produit->stock) * floatval($produit->prix));
		$nblignemax++;
	}
	//vcxvcx
    $texto .="<table/>";
	$texto .="<input type='hidden' name='nbdeprod' value='$nbdeprod' />
	<input style='cursor:pointer;background-color:#FF2814;margin-top: 10px;border:4px outset #FF5F52;height:50px;width:90%;font-size:20px;'
 type=\"submit\" name=\"submitbutton\"  value=\"passer commande/ imprimer\" id=\"submitbutton\">
	<br />
	<input type=\"button\" name=\"cancel\" value=\"annuler\" onclick=\"history.back()\"></form>";
	

?>