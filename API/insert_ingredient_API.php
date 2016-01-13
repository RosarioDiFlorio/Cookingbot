<?php
require dirname(__FILE__) . "/query_sparql.php";
/*
require dirname(__FILE__) . "/../../classes/Sessione.php";
require dirname(__FILE__) . "/../../classes/Utility.php";

if(!Sessione::isLoggedIn()) {
sendError("Utente non collegato");
}
*/

$ingredient = strtolower((trim($_POST['ingredient'])));
$quantity = strtolower((trim($_POST['quantity'])));
$unit = strtolower((trim($_POST['unit'])));
$mis = strtolower((trim($_POST['mis'])));
$name = strtolower((trim($_POST['name'])));
$i = strtolower((trim($_POST['i'])));
echo "ho ricevuto".$ingredient." - ".$quantity." - ".$unit." - ".$mis." - ".$name." - ".$i."\n";
insertIngredient($ingredient,$quantity,$unit,$mis,$name,$i);



?>