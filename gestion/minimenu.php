<?php 
$hosting = "http://" . $_SERVER['HTTP_HOST'];
$texto .= "
<li class=\"menu jfk-button\"><a href=\"$hosting/stock/gestion/titre\" >Titre</a> | </li>
<li class=\"menu\"><a href=\"$hosting/stock/gestion/categorie\" >Cat&eacute;gories</a> | </li>
<li class=\"menu\"><a href=\"$hosting/stock/gestion/fournisseur\" >Fournisseur</a> | </li>
<li class=\"menu\"><a href=\"$hosting/stock/gestion/produit\" >Produits</a> | </li>
<li class=\"menu\"><a href=\"$hosting/stock/torque/option\" >Option torque</a></li>
</ul><br /><br />";
?>