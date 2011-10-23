<?php
require("../config.php");
require_once("../db.class.php");
$ret = new db();
if(!get_magic_quotes_gpc()){
	foreach($_POST as $k => $v) $_POST[$k] = addslashes($v);
}
print_r($_POST);


?>