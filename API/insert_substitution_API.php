<?php
require dirname(__FILE__) . "/query_sparql.php";

require_once dirname(__FILE__) . "/../classes/Sessione.php";
require_once dirname(__FILE__) . "/../classes/Utility.php";
require_once dirname(__FILE__) . "/../scripts/votazioni_api.php";

if(!Sessione::isLoggedIn()) {
sendError("Utente non collegato");
}
set_time_limit(30); //limite 30 secondi per chiamata


$food = $_POST['nameFood'];
$quantityResult = $_POST['quantityResult'];
$arrFoodSub = $_POST['ing'];
$arrQuantity = $_POST['quantity'];
$fakeIngredient = $_POST['fakeIng'];
$ingList = $_POST['ingList'];
$typeMisResult = $_POST['misResult'];
$typeMisIng = $_POST['typeMis'];

//echo $food . " - " . $quantityResult . " - " . $arrFoodSub . " - " . $arrQuantity . " - " . $fakeIngredient;

$arrFoodSub = split("#",$arrFoodSub );

$arrQuantity = split("#",$arrQuantity );

$fakeIngredient = split("#",$fakeIngredient );

$typeMisIng = split("#",$typeMisIng);


/*
print_r($typeMisIng);
print_r($arrFoodSub);
print_r($arrQuantity);
print_r($fakeIngredient);
*/

insertSubstitution($food,$quantityResult,$arrFoodSub,$arrQuantity,$fakeIngredient,$ingList,$typeMisResult,$typeMisIng);

/* inserisco la sostituzione nel DB */

$idUtente = $_SESSION['idUtente'];
 $dbConn = new VotazioniAPI();
 
 $dbConn->addSubstitution($ingList,$idUtente);
 
?>