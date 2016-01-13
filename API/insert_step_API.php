<?php
require dirname(__FILE__) . "/query_sparql.php";
/*
require dirname(__FILE__) . "/../../classes/Sessione.php";
require dirname(__FILE__) . "/../../classes/Utility.php";

if(!Sessione::isLoggedIn()) {
sendError("Utente non collegato");
}
*/
$step = strtolower((trim($_POST['step'])));
$i = strtolower((trim($_POST['i'])));
$name = strtolower((trim($_POST['name'])));

echo "ho ricevuto".$i." - ".$step." ".$name."\n";
insertStep($i,$step,$name);



?>