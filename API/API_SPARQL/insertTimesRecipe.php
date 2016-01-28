<?php
require_once dirname(__FILE__).'/../query_sparql.php';




function insertPrepTimeRecipe($timePrep,$nomericetta)
{	



	$nomericetta = str_ireplace(" ","_",$nomericetta);
	
	//echo "ho ricevuto".$timePrep."    ".$nomericetta."<br>";
	
	$base = getPrefix();
	if($timePrep != ""){
		$query = $base . "	INSERT DATA { comp:Recipe_".$nomericetta." comp:prepTime \"".$timePrep."\" ;";
	}
    		
	$query = $query." }";
	echo $query;
	
	$risultato = sparqlUpdate($query);
	//echo $risultato;
	
}

function insertCookTimeRecipe($timeCook,$nomericetta){
	$nomericetta = str_ireplace(" ","_",$nomericetta);
	$base = getPrefix();
	if($timeCook != ""){
		$query = $base . "	INSERT DATA { comp:Recipe_".$nomericetta." comp:cookTime \"".$timeCook."\" ;";
	}
    		
	$query = $query." }";
	echo $query;
	
	$risultato = sparqlUpdate($query);
	echo $risultato;
	
}
//test
//insertPrepTimeRecipe("30 min","Pollo in salsa verde");
//insertCookTimeRecipe("30 min","Pollo in salsa verde");

?>