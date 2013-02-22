<?php
if($user != "orthodontie"){
	$hosting = $hosting . "/stock";
}
function activmenu($value,$lapage)
{

	if($value==$lapage){
		return "class=\"menu activ\"";
	}
	else{
		return "class=\"menu\"";
	}
}
$hosting = "http://" . $_SERVER['HTTP_HOST'];
$minimenu .= "<ul class=\"menu\">
<li class=\"menu\"><a ".activmenu("titre",$lapage)." href=\"$hosting/gestion/titre\" >Famille</a> </li>
<li class=\"menu\"><a ".activmenu("categorie",$lapage)." href=\"$hosting/gestion/categorie\" >Cat&eacute;gories</a> </li>
<li class=\"menu\"><a ".activmenu("fournisseur",$lapage)." href=\"$hosting/gestion/fournisseur\" >Fournisseurs</a> </li>
<li class=\"menu\"><a ".activmenu("produit",$lapage)." href=\"$hosting/gestion/produit\" >Produits</a> </li>
<li class=\"menu\"><a ".activmenu("commande",$lapage)." href=\"$hosting/gestion/commande\" >Commandes</a> </li>
<li class=\"menu\"><a ".activmenu("option",$lapage)." href=\"$hosting/torque/option\" >Option torque</a></li>
</ul>";
?>