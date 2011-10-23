<?php
require("../config.php");
require_once("../db.class.php");
$date = date("d/m/Y");
setlocale(LC_TIME, "fr_FR");
$dadate = strftime("%A %d %B %Y");
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>OrthoStock &beta;</title>
        <style type="text/css" media="screen">@import "./jqtouch/jqtouch.min.css";</style>
        <style type="text/css" media="screen">@import "./themes/jqt/theme.css";</style>
        <script src="./jqtouch/jquery.1.3.2.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="./jqtouch/jqtouch.min.js" type="application/x-javascript" charset="utf-8"></script>
		<link rel="apple-touch-icon" href="../img/stock2.png" />
		<link rel="apple-touch-startup-image" href="./startup.png">
        <script type="text/javascript" charset="utf-8">
            var jQT = new $.jQTouch({
                icon: '../img/stock2.png',
                addGlossToIcon: true,
                startupScreen: 'startup.png',
                statusBar: 'black',
                preloadImages: [
                    './themes/jqt/img/back_button.png',
                    './themes/jqt/img/back_button_clicked.png',
                    './themes/jqt/img/button_clicked.png',
                    './themes/jqt/img/grayButton.png',
                    './themes/jqt/img/whiteButton.png',
					'./themes/jqt/img/redButton.png',
                    './themes/jqt/img/loading.gif'
                    ]
            });
            // Some sample Javascript functions:
            $(function(){
                // Show a swipe event on swipe test
                $('#swipeme').swipe(function(evt, data) {                
                    $(this).html('You swiped <strong>' + data.direction + '</strong>!');
                });
                $('a[target="_blank"]').click(function() {
                    if (confirm('This link opens in a new window.')) {
                        return true;
                    } else {
                        $(this).removeClass('active');
                        return false;
                    }
                });
                // Page animation callback events
                $('#pageevents').
                    bind('pageAnimationStart', function(e, info){ 
                        $(this).find('.info').append('Started animating ' + info.direction + '&hellip; ');
                    }).
                    bind('pageAnimationEnd', function(e, info){
                        $(this).find('.info').append(' finished animating ' + info.direction + '.<br /><br />');
                    });
                // Page animations end with AJAX callback event, example 1 (load remote HTML only first time)
                $('#callback').bind('pageAnimationEnd', function(e, info){
                    if (!$(this).data('loaded')) {                      // Make sure the data hasn't already been loaded (we'll set 'loaded' to true a couple lines further down)
                        $(this).append($('<div>Loading</div>').         // Append a placeholder in case the remote HTML takes its sweet time making it back
                            load('ajax.html .info', function() {        // Overwrite the "Loading" placeholder text with the remote HTML
                                $(this).parent().data('loaded', true);  // Set the 'loaded' var to true so we know not to re-load the HTML next time the #callback div animation ends
                            }));
                    }
                });
                // Orientation callback event
                $('body').bind('turn', function(e, data){
                    $('#orient').html('Orientation: ' + data.orientation);
                });
            });
        </script>
<?php
echo	"<script type=\"text/javascript\" charset=\"utf-8\">
$(document).ready(function(){			
	$(\"#search_case\").keyup(function()
	{
		var search;
		
		search = $(\"#search_case\").val();
		if (search.length > 1)
		{
			$.ajax(
			{
				type: \"POST\",
				url: \"search.php\",
				data: \"search=\" + search,
				success: function(message)
				{	
					$(\"#search_results\").empty();
			  		if (message.length > 0)
					{							
						$(\"#search_results\").append(message);
					}
				}
			});
		}
		else
		{
			$(\"#search_results\").empty();
		}
	});
});	
</script>";
?>
        <style type="text/css" media="screen">
            body.fullscreen #home .info {
                display: none;
            }
            #about {
                padding: 100px 10px 40px;
                text-shadow: rgba(255, 255, 255, 0.3) 0px -1px 0;
                font-size: 13px;
                text-align: center;
                background: #161618;
            }
            #about p {
                margin-bottom: 8px;
            }
            #about a {
                color: #fff;
                font-weight: bold;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div id="search" class="selectable">
		<div class="toolbar">
                <h1>OrthoStock</h1>
            <a class="back" href="#">Home</a>
		</div>
		 <ul class="edit rounded">
                    <li><input type="text" name="Search" placeholder="Rechercher" id="search_case" /></li>
			</ul>
		<ul class="edgetoedge" id="search_results">
        <li class="sep">Results</li>                
    </ul>
        </div>
        <div id="home" class="current">
            <div class="toolbar">
                <h1>OrthoStock</h1>
                <a class="button slideup" id="infoButton" href="#search">Chercher</a>
            </div>
            <ul class="rounded">

<?php
$reqpre = new db();
$say = $reqpre->findquery("SELECT * FROM titre, categ WHERE categ.id_titre=titre.id_titre ORDER BY titre.titre, categ.categ");
$titi = "abc";

while($titcat = $reqpre->row()){
	if($titi!=$titcat->id_titre && $titi!="abc"){
$itext .= "         <li class=\"arrow\"><a href=\"#$titcat->id_titre\">$titcat->titre</a></li>\n";
}

		if($titi!=$titcat->id_titre && $titi!="abc"){
			$icat .= "</ul>\n</div>\n";
		}

		if($titi!=$titcat->id_titre){
		$icat .= "<div id=\"$titcat->id_titre\">
            <div class=\"toolbar\">
                <h1>$titcat->titre</h1>
                <a class=\"back\" href=\"#\">Home</a>
            </div>
            <ul class=\"rounded\">\n";
		}
		
    $icat .="       <li><a class=\"slideup\" href=\"#categ_$titcat->id_categ\">$titcat->categ</a></li>\n";

		
		$titi = $titcat->id_titre;
}
echo $itext;
?>
            </ul>
            <div class="info">
                <p>cliquer pour naviguer dans les produits.</p>
            </div>
        </div>
        <?php
$icat .="</ul></div>";
        echo $icat;
        ?>

<?php
$reqstock = new db();
$say = $reqstock->findquery("SELECT * FROM produit, categ WHERE categ.id_categ=produit.id_categ ORDER BY categ.categ, produit.produit");
$cati = "abc";

while($catprod = $reqstock->row()){

		if($cati!=$catprod->id_categ && $cati!="abc"){
			$iprod .= "</ul>\n</div>\n";
		}

		if($cati!=$catprod->id_categ){
		$iprod .= "<div id=\"categ_$catprod->id_categ\">
            <div class=\"toolbar\">
                <h1>$catprod->categ</h1>
                <a class=\"back\" href=\"#\">Home</a>
            </div>
            <ul class=\"edgetoedge\">\n";
		}
		
    $iprod .="       <li><a class=\"flip\" href=\"./retrait.php?idprod=$catprod->id_produit\">$catprod->produit</a> <small class=\"counter\">$catprod->stock</small></li>\n";

		
		$cati = $catprod->id_categ;
}
		$iprod .="</ul>";
        echo $iprod;
?>

        </div>
    </body>
</html>

