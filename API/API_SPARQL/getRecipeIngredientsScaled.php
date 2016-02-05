<?php
include_once dirname(__FILE__).'/../query_sparql.php';

function getRecipeIngredientsScaled($recipeURI, $lang, $newServed, $oldServed){
	
	$base = getPrefix();
	$query = $base . "
	
	SELECT DISTINCT ?ing ?name ?detail ?quantity WHERE{
		{
			comp:".$recipeURI." a fo:Recipe.
			?list a fo:IngredientList.
			comp:".$recipeURI." fo:ingredients ?list.
			?ing a fo:Ingredient.
			?list ?x ?ing.
			?ing fo:quantity ?quantity.
			?ing fo:food ?food.
			?food rdfs:label ?name.
			FILTER langMatches(lang(?name), \"".$lang."\").
			OPTIONAL{
				?ing comp:details ?detail.
				FILTER langmatches(lang(?detail),\"".$lang."\").
			}
		}
		UNION
		{
			comp:".$recipeURI." a fo:Recipe.
			?list a fo:IngredientList.
			comp:".$recipeURI." fo:ingredients ?list.
			?ing a fo:Ingredient.
			?list ?x ?ing.
			?ing fo:metric_quantity ?quantity.
			?ing fo:food ?food.
			?food rdfs:label ?name.
			FILTER langMatches(lang(?name), \"".$lang."\").
			OPTIONAL{
				?ing comp:details ?detail.
				FILTER langmatches(lang(?detail),\"".$lang."\").
			}
		}
		UNION
		{
			comp:".$recipeURI." a fo:Recipe.
			?list a fo:IngredientList.
			comp:".$recipeURI." fo:ingredients ?list.
			?ing a fo:Ingredient.
			?list ?x ?ing.
			?ing fo:imperial_quantity ?quantity.
			?ing fo:food ?food.
			?food rdfs:label ?name.
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
				$number = preg_replace("/[a-z]+/i", "", $weight);
				$number = trim($number);
				$number = ($number*$newServed)/$oldServed;
				if(!is_int($number)){
					$number = number_format((float)$number, 2, ',', '');
				}
				$weight = $number." ".$unit;
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