<?php
require dirname(__FILE__) . "/query_sparql.php";

require_once dirname(__FILE__) . "/../classes/Sessione.php";
require_once dirname(__FILE__) . "/../classes/Utility.php";


if(!Sessione::isLoggedIn()) {
sendError("Utente non collegato");
}
set_time_limit(0); //limite 30 secondi per chiamata


$food = trim($_POST['nameFood']);
$quantityResult = $_POST['quantityResult'];
$arrFoodSub = $_POST['ing'];
$arrQuantity = $_POST['quantity'];
$typeMisResult = $_POST['misResult'];
$typeMisIng = $_POST['typeMis'];

//echo $food . " - " . $quantityResult . " - " . $arrFoodSub . " - " . $arrQuantity



$arrFoodSub = split("#",$arrFoodSub );
$arrQuantity = split("#",$arrQuantity );
$typeMisIng = split("#",$typeMisIng);



/*
print_r($typeMisIng);
print_r($arrFoodSub);
print_r($arrQuantity);
*/


insertSubstitution($food,$quantityResult,$arrFoodSub,$arrQuantity,$typeMisResult,$typeMisIng);



 
 /* controllo se la sostituzione è di tipo 1:1 */
 
 if((count($arrFoodSub)-1) == 1)
 {
	 $tmp  = $arrFoodSub[0];
	 $arrFoodSub[0] = $food;
	 $food = $tmp;
	 
	 $tmp  = $arrQuantity[0];
	 $arrQuantity[0] = $quantityResult;
	 $quantityResult = $tmp;
	 
	 
	 $tmp  = $typeMisIng[0];
	 $typeMisIng[0] = $typeMisResult;
	 $typeMisResult = $tmp;
	 
	insertSubstitution($food,$quantityResult,$arrFoodSub,$arrQuantity,$typeMisResult,$typeMisIng);

 
 }
 
?>