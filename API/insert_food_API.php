<?php
require dirname(__FILE__) . "/query_sparql.php";
/*
require dirname(__FILE__) . "/../../classes/Sessione.php";
require dirname(__FILE__) . "/../../classes/Utility.php";

if(!Sessione::isLoggedIn()) {
sendError("Utente non collegato");
}
*/

$food = $_POST['nameFood'];
$shopping = $_POST['shop'];
$kilocal = $_POST['kc'];
$kilojaul = $_POST['kj'];

$food = strtolower($food);
$shopping = strtolower($shopping);
$kilocal = strtolower($kilocal);
$kilojaul = strtolower($kilojaul);

if($kilocal == "" || $kilocal == "0")
$kilocal = "";
	
if($kilocal != "")
$kilocal = $kilocal . " kcal";


if($kilojaul == "" || $kilojaul == "0")
$kilojaul = "";

if($kilojaul != "")
$kilojaul = $kilojaul . " KJ";

$shopping = substr($shopping, strpos($shopping,"#") + 1,strlen($shopping)-1);


insertFoodCtrlLang($food,"","",$shopping);


?>