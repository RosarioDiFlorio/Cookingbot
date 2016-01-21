<?php
include_once dirname(__FILE__).'/../query_sparql.php';




function insertIngredient($ingredient,$quantity,$unit,$mis,$name,$i,$lang)
{	

	if($lang == 'it'){
		$ingredient =	translate($ingredient,"it","en");
	}

	insertFoodCtrlLang($ingredient,"","","");

	$name = str_ireplace(" ","_",$name);
	$ingredient = str_ireplace(" ","_",$ingredient);
	$ingredient = strtolower(translate($ingredient, "it", "en"));
	$quantity = str_ireplace(" ","_",$quantity);
	$unit = str_ireplace(" ","_",$unit);
	$mis = str_ireplace(" ","_",$mis);
	$i = str_ireplace(" ","_",$i);
	echo "3 ho ricevuto".$ingredient." - ".$quantity." - ".$unit." - ".$mis." - ".$name."\n";
	$base = getPrefix();
	
	$query = $base . "	INSERT DATA { comp:Ing_".$name."_".$ingredient." a fo:Ingredient ;
    fo:food comp:".$ingredient.";";
    if($mis == 'unit') {
    	$query = $query."fo:quantity \"".$quantity." ".$unit."\"";
    }

    if($mis == 'metric') {
    	$query = $query."fo:metric_quantity \"".$quantity." ".$unit."\"";
    }

    if($mis == 'imperial') {
    	$query = $query."fo:imperial_quantity \"".$quantity." ".$unit."\"";
    }
	
				
	$query = $query.". }";
	
	$risultato = sparqlUpdate($query);
	
	$query = $base . "	INSERT DATA { comp:IngList_".$name." a fo:IngredientList;
	rdf:_".$i." comp:Ing_".$name."_".$ingredient.".
	comp:Recipe_".$name." fo:ingredients comp:IngList_".$name.". }";

	$risultato2 = sparqlUpdate($query);

	echo $risultato." ".$risultato2;
	
}


?>