<?php
include_once dirname(__FILE__).'/../query_sparql.php';

function getRecipeIngredientsScaled($recipeURI, $measure, $lang, $newServed){
	
	$base = getPrefix();
	$query = $base . "
	
	SELECT DISTINCT ?name ?quantity WHERE{
		{
			".$recipeURI." a fo:Recipe;
			fo:serves ?served.
			?list a fo:IngredientList.
			".$recipeURI." fo:ingredients ?list.
			?ing a fo:Ingredient.
			?list ?x ?ing.
			?ing fo:quantity ?peso.
			?ing fo:food ?food.
			?food rdfs:label ?name.
			BIND(xsd:double(REPLACE(?peso, \" .*\", \"\", \"i\")) AS ?pesooriginale).
			BIND(xsd:integer(?served) AS ?serviti).
			BIND(ROUND(((?pesooriginale*".$newServed.")/?serviti)) AS ?pesonuovo).
			BIND( REPLACE(CONCAT(xsd:string(?pesonuovo), REPLACE(?peso, \".* \", \"\", \"i\")), \"e0\",\" \", \"i\")AS ?quantity).
			FILTER langMatches(lang(?name), \"".$lang."\").
		}
		UNION
		{
			".$recipeURI." a fo:Recipe;
			fo:serves ?served.
			?list a fo:IngredientList.
			".$recipeURI." fo:ingredients ?list.
			?ing a fo:Ingredient.
			?list ?x ?ing.
			?ing fo:".$measure." ?peso.
			?ing fo:food ?food.
			?food rdfs:label ?name.
			BIND(xsd:double(REPLACE(?peso, \" .*\", \"\", \"i\")) AS ?pesooriginale).
			BIND(xsd:integer(?served) AS ?serviti).
			BIND(ROUND(((?pesooriginale*".$newServed.")/?serviti)) AS ?pesonuovo).
			BIND( REPLACE(CONCAT(xsd:string(?pesonuovo), REPLACE(?peso, \".* \", \"\", \"i\")), \"e0\",\" \", \"i\")AS ?quantity).
			FILTER langMatches(lang(?name), \"".$lang."\").
		}
	}
	";

	$results = sparqlQuery($query,"json");
	return $results;
}
?>