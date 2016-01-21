<?php
include_once dirname(__FILE__).'/../query_sparql.php';



/*
* the function insertFood return true if the operation has been succes,
* otherwise, if the Food are alredy in the ontology, the function return false
*/
function insertFood($food,$from,$kilocal,$kilojaul,$shopping)
{	


	$food;
	$labelIT;
	$label;
	$lang = "en";
	$langIT = "it";
	$to;
	
	if($from == "en")
	{
		$to = "it";
		
	}else
	{
		$to = "en";
	}

	
	$foodTranslate = translate($food,$from,$to);
	$foodTranslate = strtolower($foodTranslate);
	
	
	if($from != "en")
	{
		//the food is not in english
			
		$labelIT = $food; // <--- italian translation of food 
		$food = $foodTranslate; // <--- take the food in english
		$label = $foodTranslate;
		
		
		
	}else
	{
		$labelIT = $foodTranslate;
		$label = $food;
	}

	
	
	$food = str_ireplace(" ","_",$food);
	
	$base = getPrefix();
	
	$query = $base . "	INSERT DATA { comp:".$food." rdf:type comp:Food ;
    rdfs:label \"". $label ."\"@".$lang." ;
	 rdfs:label \"".$labelIT."\"@".$langIT ;
	 
	if($kilocal != "")
		 $query .= " ; 
			food:energyPer100g	\"".$kilocal."\"   	

			";
	
	if($kilojaul != "")
		 $query .= " ; 
			food:energyPer100g	\"".$kilojaul."\"   	

			";
	
	
	if($shopping != "")
		 $query .= " ; 
			fo:shopping_category comp:".$shopping." .	

			";
	
	
	$query .=				"}";
	//echo $query;
	sparqlUpdate($query);
	
	
	
	
}

?>