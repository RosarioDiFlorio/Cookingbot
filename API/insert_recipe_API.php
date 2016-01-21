<?php
require dirname(__FILE__) . "/query_sparql.php";
/*
require dirname(__FILE__) . "/../../classes/Sessione.php";
require dirname(__FILE__) . "/../../classes/Utility.php";

if(!Sessione::isLoggedIn()) {
sendError("Utente non collegato");
}
*/

$name = strtolower((trim($_POST['name'])));
$food = strtolower((trim($_POST['food'])));
$numberp = strtolower((trim($_POST['numberp'])));
$cuisine = strtolower((trim($_POST['cuisine'])));
$diet = strtolower((trim($_POST['diet'])));
$occasion = strtolower((trim($_POST['occasion'])));
$course = strtolower((trim($_POST['course'])));
$lang = strtolower((trim($_POST['lang'])));
insertRecipe($name,$food,$numberp,$cuisine,$diet,$occasion,$course,$lang);


?>