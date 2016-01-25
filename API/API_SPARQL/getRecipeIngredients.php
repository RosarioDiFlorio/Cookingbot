<?php
include_once dirname(__FILE__).'/../query_sparql.php';

function getRecipeIngredients($recipeURI, $lang){
	
	$base = getPrefix();
	$query = $base . "
	SELECT ?ing ?name ?quantity WHERE{
		{
			".$recipeURI." a fo:Recipe;
				fo:ingredients ?ingList.
			?ing a fo:Ingredient.
			?ingList ?x ?ing.
			?ing fo:food ?food.
			?food rdfs:label ?name.
			?ing fo:metric_quantity ?quantity.
			FILTER langmatches(lang(?name),\"".$lang."\").
		}
		UNION
		{
			".$recipeURI." a fo:Recipe;
				fo:ingredients ?ingList.
			?ing a fo:Ingredient.
			?ingList ?x ?ing.
			?ing fo:food ?food.
			?food rdfs:label ?name.
			?ing fo:imperial_quantity ?quantity.
			FILTER langmatches(lang(?name),\"".$lang."\").
		}
		UNION
		{
			".$recipeURI." a fo:Recipe;
				fo:ingredients ?ingList.
			?ing a fo:Ingredient.
			?ingList ?x ?ing.
			?ing fo:food ?food.
			?food rdfs:label ?name.
			?ing fo:quantity ?quantity.
			FILTER langmatches(lang(?name),\"".$lang."\").
		}
	}ORDER BY (?x)";

	$results = sparqlQuery($query,"json");
	$dataIng = json_decode($results);
	$toCicleIng = $dataIng->results->bindings;
	$ingredients = [];
	for($i = 0 ; $i<sizeof($toCicleIng); $i++){
		$nameIng = $toCicleIng[$i]->name->value;
		$quantity = $toCicleIng[$i]->quantity->value;
		$matches = [];
		preg_match("/[a-z]+/i",$quantity, $matches);
		$unit = $matches[0];
		if(!array_key_exists($nameIng,$ingredients)){
			$ingredients[$nameIng]=[];
		}
		$ingredients[$nameIng][$unit]=$quantity;
	}
	return $ingredients;
}
?>