<?php
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
<li class=\"menu\"><a ".activmenu("titre",$lapage)." href=\"$hosting/stock/gestion/titre\" >Titre</a> </li>
<li class=\"menu\"><a ".activmenu("categorie",$lapage)." href=\"$hosting/stock/gestion/categorie\" >Cat&eacute;gories</a> </li>
<li class=\"menu\"><a ".activmenu("fournisseur",$lapage)." href=\"$hosting/stock/gestion/fournisseur\" >Fournisseurs</a> </li>
<li class=\"menu\"><a ".activmenu("produit",$lapage)." href=\"$hosting/stock/gestion/produit\" >Produits</a> </li>
<li class=\"menu\"><a ".activmenu("commande",$lapage)." href=\"$hosting/stock/gestion/commande\" >Commandes</a> </li>
<li class=\"menu\"><a ".activmenu("option",$lapage)." href=\"$hosting/stock/torque/option\" >Option torque</a></li>
</ul>";
?>