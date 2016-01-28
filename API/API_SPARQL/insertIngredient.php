<?php
require_once dirname(__FILE__).'/../query_sparql.php';




function insertIngredient($ingredient,$detail,$quantity,$unit,$mis,$name,$i,$lang)
{	

	$detailIT ='';
	$detailEN ='';
	if($lang == 'it'){
		$detailEN = translate($detail,'it','en');
		$detailIT = $detail;
		$ingredient = strtolower(translate($ingredient, "it", "en"));
	}
	else
		if($lang == 'en'){
			$detailEN = $detail;
			$detailIT = translate($detail,'en','it');
		}

	insertFoodCtrlLang($ingredient,"","","");

	$name = str_ireplace(" ","_",$name);
	$ingredient = str_ireplace(" ","_",$ingredient);
	$quantity = str_ireplace(" ","_",$quantity);
	$unit = str_ireplace(" ","_",$unit);
	$mis = str_ireplace(" ","_",$mis);
	$i = str_ireplace(" ","_",$i);
	//echo "3 ho ricevuto".$ingredient." ".$detail."/".$detailIT."/".$detailEN." - ".$quantity." - ".$unit." - ".$mis." - ".$name."\n";
	//echo $quantity . " ---- " .$unit."<br>";
	
	
	$base = getPrefix();
	
	$query = $base . "	INSERT DATA { comp:Ing_".$name."_".$ingredient." a fo:Ingredient ;
    fo:food comp:".$ingredient.";";

    if($detail !=''){
    	$query = $query."comp:details \"".$detailIT."\"@it, \"".$detailEN."\"@en; ";
    }


    if($mis == 'unit') {
    	$query = $query."fo:quantity \"".$quantity." ".$unit."\"";
    }
	else
	{
		$query .=  useConverterForQuantity($quantity, $unit,true); //con il parametro "true" aggiunge il carattere "." alla fine
		
	}	
	/*
    if($mis == 'metric') {
    	$query = $query."fo:metric_quantity \"".$quantity." ".$unit."\"";
    }

    if($mis == 'imperial') {
    	$query = $query."fo:imperial_quantity \"".$quantity." ".$unit."\"";
    }*/
	
				
	$query = $query." }";
	//echo $query;
	$risultato = sparqlUpdate($query);
	
	$query = $base . "	INSERT DATA { comp:IngList_".$name." a fo:IngredientList;
	rdf:_".$i." comp:Ing_".$name."_".$ingredient.".
	comp:Recipe_".$name." fo:ingredients comp:IngList_".$name.". }";

	$risultato2 = sparqlUpdate($query);
	

	//echo $risultato." ".$risultato2;
	
}


?>