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
$numberp = strtolower((trim($_POST['numberp'])));
$cuisin = strtolower((trim($_POST['cuisin'])));
$diet = strtolower((trim($_POST['diet'])));
$occasion = strtolower((trim($_POST['occasion'])));
$course = strtolower((trim($_POST['course'])));
$lang = strtolower((trim($_POST['lang'])));
insertRecipe($name,$numberp,$cuisin,$diet,$occasion,$course,$lang);


?>