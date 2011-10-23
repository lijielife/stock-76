<?php
require("../config.php");
require_once("../db.class.php");
$lid = $_POST['idprod'];
$reqpre = new db();
$reqpre->findupdate("SELECT *
	FROM produit, titre, categ, fournisseur
	WHERE categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur
	AND produit.id_produit = $lid
 ORDER BY categ.categ ASC");


echo '<div id="retrait_produit">
    <div class="toolbar">
        <h1>Retrait Produit</h1>
    </div>
	<ul class="rounded">
                <li class="a">OKKK</li>
            </ul>
 <ul class="rounded">
                <li><a href="./">Home</a></li>
            </ul>     
</div>';


?>