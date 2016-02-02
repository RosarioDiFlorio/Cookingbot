<?php
include_once dirname(__FILE__).'/../query_sparql.php';

function getRecipeIngredientsScaled($recipeURI, $lang, $newServed){
	
	$base = getPrefix();
	$query = $base . "
	
	SELECT DISTINCT ?ing ?name ?detail ?quantity WHERE{
		{
			comp:".$recipeURI." a fo:Recipe;
			fo:serves ?served.
			?list a fo:IngredientList.
			comp:".$recipeURI." fo:ingredients ?list.
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
			OPTIONAL{
				?ing comp:details ?detail.
				FILTER langmatches(lang(?detail),\"".$lang."\").
			}
		}
		UNION
		{
			comp:".$recipeURI." a fo:Recipe;
			fo:serves ?served.
			?list a fo:IngredientList.
			comp:".$recipeURI." fo:ingredients ?list.
			?ing a fo:Ingredient.
			?list ?x ?ing.
			?ing fo:metric_quantity ?peso.
			?ing fo:food ?food.
			?food rdfs:label ?name.
			BIND(xsd:double(REPLACE(?peso, \" .*\", \"\", \"i\")) AS ?pesooriginale).
			BIND(xsd:integer(?served) AS ?serviti).
			BIND(ROUND(((?pesooriginale*".$newServed.")/?serviti)) AS ?pesonuovo).
			BIND( REPLACE(CONCAT(xsd:string(?pesonuovo), REPLACE(?peso, \".* \", \"\", \"i\")), \"e0\",\" \", \"i\")AS ?quantity).
			FILTER langMatches(lang(?name), \"".$lang."\").
			OPTIONAL{
				?ing comp:details ?detail.
				FILTER langmatches(lang(?detail),\"".$lang."\").
			}
		}
		UNION
		{
			comp:".$recipeURI." a fo:Recipe;
			fo:serves ?served.
			?list a fo:IngredientList.
			comp:".$recipeURI." fo:ingredients ?list.
			?ing a fo:Ingredient.
			?list ?x ?ing.
			?ing fo:imperial_quantity ?peso.
			?ing fo:food ?food.
			?food rdfs:label ?name.
			BIND(xsd:double(REPLACE(?peso, \" .*\", \"\", \"i\")) AS ?pesooriginale).
			BIND(xsd:integer(?served) AS ?serviti).
			BIND(ROUND(((?pesooriginale*".$newServed.")/?serviti)) AS ?pesonuovo).
			BIND( REPLACE(CONCAT(xsd:string(?pesonuovo), REPLACE(?peso, \".* \", \"\", \"i\")), \"e0\",\" \", \"i\")AS ?quantity).
			FILTER langMatches(lang(?name), \"".$lang."\").
			OPTIONAL{
				?ing comp:details ?detail.
				FILTER langmatches(lang(?detail),\"".$lang."\").
			}
		}
	}
	";

	$results = sparqlQuery($query,"json");
	$dataIng = json_decode($results);
	
	if(!empty($dataIng))
	{	
		$toCicleIng = $dataIng->results->bindings;
		$ingredients = [];
		for($i = 0 ; $i<sizeof($toCicleIng); $i++){
			$nameIng = $toCicleIng[$i]->name->value;
			//echo $nameIng." ";
			if(property_exists($toCicleIng[$i],"quantity")){
				$weight = $toCicleIng[$i]->quantity->value;
				//echo $weight."<br>";
				$matches = [];
				preg_match("/[a-z]+/i",$weight, $matches);
				$unit = $matches[0];
			}
			else{
				$unit = "NA";
				if($lang=="it")
					$weight = "quanto basta";
				else
					$weight = "as needed";
			}
			if(!array_key_exists($nameIng,$ingredients)){
					$ingredients[$nameIng]=[];
				}
			$ingredients[$nameIng][$unit]=$weight;
			$detail="";
			if(property_exists($toCicleIng[$i],"detail")){
				$detail = $toCicleIng[$i]->detail->value;
			}
			$ingredients[$nameIng]["details"]=$detail;
		}
		return $ingredients;
	}
}
?>