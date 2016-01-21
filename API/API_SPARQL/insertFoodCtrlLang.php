<?php
include_once dirname(__FILE__).'/../query_sparql.php';


/*
*this function return true if the function insert the food in the ontology with success using label or comp:Food 
* otherwise, if the food exists like comp:Food or like label in another languages the function return false
*/
function insertFoodCtrlLang($food,$kilocal,$kilojaul,$shopping)
{	$food = trim($food);
	$food = strtolower($food);
	
	
	$kilocal = trim($kilocal);
	if($kilocal != "")
		$kilocal = strtolower($kilocal);
	
	
	$kilojaul = trim($kilojaul);
	if($kilojaul != "")
		$kilojaul = strtolower($kilojaul);
	
	
	
	$shopping = trim($shopping);
	if($shopping != "")
	$shopping = strtolower(translate($shopping,"it","en"));  //translate shopping category to english
	$shopping = str_ireplace(" ","_",$shopping);
	
	
	
	$from = detectLang($food);
	if($from != "en")
	{
		if($from != "it")
		{
			$from = "it";
		}
	}
	
	
	if(! existsFoodLabel($food,$from))
	{
		//i'm sure, the food don't exists!
		//then i enter the food in the ontology
			
		insertFood($food,$from,$kilocal,$kilojaul,$shopping);
		return true;
			
	}
	else
	{
		// the label exists, we have this food codified in the ontology!!!
		return false;
			
	}
		
	

	
}


?>