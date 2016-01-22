<?php
include_once dirname(__FILE__).'/../query_sparql.php';

function getRecipeIngredients($recipeURI, $measure, $lang){
	
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
			?ing fo:".$measure." ?quantity.
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
	return $results;
}
?>