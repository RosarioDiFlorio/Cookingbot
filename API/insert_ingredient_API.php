<?php
require_once dirname(__FILE__) . "/query_sparql.php";
/*
require dirname(__FILE__) . "/../../classes/Sessione.php";
require dirname(__FILE__) . "/../../classes/Utility.php";

if(!Sessione::isLoggedIn()) {
sendError("Utente non collegato");
}
*/

$ingredient = strtolower((trim($_POST['ingredient'])));
$detail = strtolower((trim($_POST['detail'])));
$quantity = strtolower((trim($_POST['quantity'])));
$unit = strtolower((trim($_POST['unit'])));
$mis = strtolower((trim($_POST['mis'])));
$name = strtolower((trim($_POST['name'])));
$i = strtolower((trim($_POST['i'])));
$lang = strtolower((trim($_POST['lang'])));
insertIngredient($ingredient,$detail,$quantity,$unit,$mis,$name,$i,$lang);



?>