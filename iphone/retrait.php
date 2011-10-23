<?php
require("../config.php");
require_once("../db.class.php");
$lid = $_GET['idprod'];
$reqpre = new db();
$reqpre->findquery("SELECT *
	FROM produit, titre, categ, fournisseur
	WHERE categ.id_categ = produit.id_categ
	AND categ.id_titre = titre.id_titre
	AND produit.id_fournisseur = fournisseur.id_fournisseur
	AND produit.id_produit = $lid
 ORDER BY categ.categ ASC");

$produit = $reqpre->row();

echo '<div id="retrait_produit">
<form id="ajax_post" action="retrait_stock.php" method="POST" class="form">
    <div class="toolbar">
        <h1>Retrait Produit</h1>
        <a class="back" href="#'.$produit->id_categ.'">cat&eacute;gorie</a>
    </div>

	<ul class="edgetoedge">
<input type="hidden" name="action" value="retrait">
<input type="hidden" name="idprod" value="'.$produit->id_produit.'">
<input type="hidden" name="lestockinitial" value="'.$produit->stock.'">
                <li class="sep">Produit</li>
				<li><a href="#"> <small>Categorie </small>'.$produit->categ.'</a></li>
				<li><a href="#"><small>Produit </small>'.$produit->produit.'</a></li>
                <li><a href="#"><small>Stock </small>'.$produit->stock.'</a></li>
                <li class="sep">Infos</li>
				<li><a href="#"><small>Fournisseur </small>'.$produit->fournisseur.'</a></li>
				<li><a href="#"><small>Reférence </small>'.$produit->reference.'</a></li>
				<li><a href="#"><small>Conditionnement</small> '.$produit->conditionnement.'</a></li>
				<li><a href="#"><small>Prix</small> '.$produit->prix.' €</a></li>
                <li class="sep">Quantit&eacute;</li>
				<li>
                        <select id="lol">
                            <optgroup label="quantite">
                                <option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="25">25</option>
								<option value="100">100</option>
                            </optgroup>
                        </select>
                    </li>
            </ul>

  <br />
            <a style="margin:0 10px;color:rgba(0,0,0,.9)" href="retrait_stock.php" class="submit redButton">Retirer</a>
</form>
</div>';
?>