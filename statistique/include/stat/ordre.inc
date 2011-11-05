<?php
	$_GET['sens'] = (isset($_GET['sens']))?$_GET['sens']:"";
	$_GET['ordre'] = (isset($_GET['ordre']))?$_GET['ordre']:"";

switch ( $_GET['sens'] )
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


switch ($_GET['ordre']) {
	case 'categ':
		$ordreby =", categ.".$_GET['ordre'].$sens;
		break;
	case 'id_titre':
		$ordreby =", categ.".$_GET['ordre'].$sens;
	break;
	case 'id_fourn':
		$ordreby =", produit."."id_fournisseur".$sens;
	break;
	case 'produit':
		$ordreby =", produit.".$_GET['ordre'].$sens;
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