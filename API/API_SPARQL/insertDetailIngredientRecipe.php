<?php
require_once dirname(__FILE__).'/../query_sparql.php';




function insertDetailIngredientRecipe($detail,$nomeingrediente,$nomericetta,$lang)
{	

	
	$detailIT ='';
	$detailEN ='';
	if($lang == 'it'){
		$detailEN = strtolower(translate($detail,'it','en'));
		$detailIT = strtolower($detail);
		$nomeingrediente = strtolower(translate($nomeingrediente, "it", "en"));
		//echo $nomeingrediente;
	}
	else
		if($lang == 'en'){
			$detailEN = strtolower($detail);
			$detailIT = strtolower(translate($detail,'en','it'));
		}


	$nomericetta = str_ireplace(" ","_",$nomericetta);
	$nomeingrediente = str_ireplace(" ","_",$nomeingrediente);
	$nomecomposto = "Ing_".$nomericetta."_".$nomeingrediente;
	//echo "ho ricevuto".$timePrep."    ".$nomericetta."<br>";
	
	$base = getPrefix();
	if($detailIT != "" && $detailEN != ""){
		$query = $base . "	INSERT DATA { comp:".$nomecomposto." comp:details \"".$detailIT."\"@it , \"".$detailEN."\"@en  ;";
	}
    		
	$query = $query." }";
	//echo $query;
	
	$risultato = sparqlUpdate($query);
	//echo $risultato;
	
}

//Ing_Panna_cotta_al_cocco_con_coulis_di_lamponi_coconut
//test
insertDetailIngredientRecipe("del brasile","cocco","Panna cotta al cocco con coulis di lamponi","it");


?>