<?php
require("../config.php");
require_once("../db.class.php");
$out = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
	\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
$out .= "<html xmlns=\"http://www.w3.org/1777/xhtml\"
	    xml:lang=\"fr\"
	    lang=\"fr\"
	    dir=\"ltr\">
<head>
<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\" media=\"screen\" />
<meta content=\"text/html; Charset=UTF-8\" http-equiv=\"Content-Type\" />

<title>
Gestion Stock en ligne: titre
</title>
</head>";
$ret = new db();
$essai = $ret->findquery("SELECT produit.produit, categ.categ, produit.codabar FROM produit, categ WHERE produit.id_categ=categ.id_categ ORDER BY produit.id_produit");
while ($prod = $ret->row()) {
	$out .= $prod->categ . " " . $prod->produit . "<br /><br />";
	$out .= "<img src=../barcode/lecodbar?cod=". $prod->codabar ."><br/ ><hr /><br />";
	}
	
?>

	<body >
	<center>
		<br /><br />
	<span style="font-size:20px; font-weight: bold">
		

<?php 		echo $out; ?>
	</span>
	</center>
</form>
	</body>
</html>