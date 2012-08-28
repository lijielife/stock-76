<?php 
$hosting = "http://" . $_SERVER['HTTP_HOST'];


// <li><a href=\"$hosting/stock/statistique/\">statistique</a></li>
$texto .="<div id=\"subnavigationwrap\" class=\"backgroundpaper\">
	<div id=\"subnavigation\">
	<span style=\"padding:5px;float:right;position:absolute;right:0px; width:250px\">".$dadate." </span>\n

		<ul>
			<li class=\"first\"><a href=\"$hosting/stock/gestion/\">gestion</a></li>
			<li><a href=\"$hosting/stock/retrait/\">retrait</a></li>
			<li><a href=\"$hosting/stock/ajout/\">ajout</a></li>
			
			<li><a href=\"$hosting/stock/torque/\">torque</a></li>
			<li><a href=\"$hosting/stock/statistique/\">statistique</a></li>

		</ul>
		
		<br class=\"clear\" />
	</div><!--end #subnavigation-->
</div><!--end #subnavigationwrap-->";

// $texto .= "<div id=\"supermenu\" >
// <span style=\"position:absolute;right:0px; width:300px\">$dadate </span>\n
// <a class=\"supermenu\" href=\"$hosting/stock/gestion/\">gestion</a> | <a class=\"supermenu\" href=\"$hosting/stock/retrait/\">retrait</a> | <a class=\"supermenu\" href=\"$hosting/stock/ajout/\">ajout</a> | <a class=\"supermenu\" href=\"$hosting/stock/statistique/\">statistique</a>
// </div><br />";
?>