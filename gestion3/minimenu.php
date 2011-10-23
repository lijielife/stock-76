<?php 
$hosting = "http://" . $_SERVER['HTTP_HOST'];
$texto .= "
<li class=\"menu\"><a href=\"$hosting/stock3/gestion3/titre\" >Titre</a> | </li>
<li class=\"menu\"><a href=\"$hosting/stock3/gestion3/categorie\" >Cat&eacute;gories</a> | </li>
<li class=\"menu\"><a href=\"$hosting/stock3/gestion3/fournisseur\" >Fournisseur</a> | </li>
<li class=\"menu\"><a href=\"$hosting/stock3/gestion3/produit\" >Produits</a> | </li>
<li class=\"menu\"><a href=\"$hosting/stock/torque/option\" >Option torque</a></li>
</ul><br /><br />";
?>