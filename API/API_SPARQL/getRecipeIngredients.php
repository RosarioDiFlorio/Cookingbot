<?php
include_once dirname(__FILE__).'/../query_sparql.php';

function getRecipeIngredients($recipeURI, $lang){
	
	$base = getPrefix();
	$query = $base . "
	SELECT ?ing ?name ?detail ?quantity WHERE{
		{
			comp:".$recipeURI." a fo:Recipe;
				fo:ingredients ?ingList.
			?ing a fo:Ingredient.
			?ingList ?x ?ing.
			?ing fo:food ?food.
			?food rdfs:label ?name.
			?ing fo:metric_quantity ?quantity.
			FILTER langmatches(lang(?name),\"".$lang."\").
			OPTIONAL{
				?ing comp:details ?detail.
				FILTER langmatches(lang(?detail),\"".$lang."\").
			}
		}
		UNION
		{
			comp:".$recipeURI." a fo:Recipe;
				fo:ingredients ?ingList.
			?ing a fo:Ingredient.
			?ingList ?x ?ing.
			?ing fo:food ?food.
			?food rdfs:label ?name.
			?ing fo:imperial_quantity ?quantity.
			FILTER langmatches(lang(?name),\"".$lang."\").
			OPTIONAL{
				?ing comp:details ?detail.
				FILTER langmatches(lang(?detail),\"".$lang."\").
			}
		}
		UNION
		{
			comp:".$recipeURI." a fo:Recipe;
				fo:ingredients ?ingList.
			?ing a fo:Ingredient.
			?ingList ?x ?ing.
			?ing fo:food ?food.
			?food rdfs:label ?name.
			?ing fo:quantity ?quantity.
			FILTER langmatches(lang(?name),\"".$lang."\").
			OPTIONAL{
				?ing comp:details ?detail.
				FILTER langmatches(lang(?detail),\"".$lang."\").
			}
		}
	}ORDER BY (?x)";

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