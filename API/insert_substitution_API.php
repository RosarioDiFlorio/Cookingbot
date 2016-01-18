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


?>