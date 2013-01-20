<?php

if (isset($_GET['sens'])){
	$getsens= $_GET['sens'];
}
else{
	$getsens="";
}
switch ( $getsens )
{
	case 'down':
		$sens=" ASC";
		$lesens ="down";
	break;
	case 'up':
		$sens=" DESC";
		$lesens ="up";
	break;		
	default:
		$sens=" ASC";
		$lesens ="down";
	break;
}

if (isset($_GET['ordre'])){
	$getordre= $_GET['ordre'];
}
else{
	$getordre="";
}
switch ($getordre) {
	case 'categ':
		$ordreby =", categ.".$getordre.$sens;
		break;
	case 'titre':
		$ordreby =", titre.".$getordre.$sens;
	break;
	case 'fournisseur':
		$ordreby =", fournisseur."."fournisseur".$sens;
	break;
	case 'produit':
		$ordreby =", produit.".$getordre.$sens;
	break;
	case 'stock':
		$ordreby =", produit.stock".$sens;
		break;
	case 'prix':
		$ordreby =", produit.prix".$sens;
	break;
	case 'totalprix':
		$ordreby =", (produit.prix*produit.stock)".$sens;
	break;
	default:
		$ordreby =", categ.categ ASC";
		$lesens = "up";
	break;
}

?>