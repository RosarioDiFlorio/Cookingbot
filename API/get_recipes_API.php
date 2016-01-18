<?php
require dirname(__FILE__) . "/query_sparql.php";
/*
require dirname(__FILE__) . "/../../classes/Sessione.php";
require dirname(__FILE__) . "/../../classes/Utility.php";

if(!Sessione::isLoggedIn()) {
sendError("Utente non collegato");
}
*/

$lang = strtolower((trim($_POST['lang'])));
$input = strtolower((trim($_POST['input'])));
echo $lang." ".$input;
echo getRecipesByWords($lang,$input);


?>