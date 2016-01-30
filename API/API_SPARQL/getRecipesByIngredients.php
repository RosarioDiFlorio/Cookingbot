<?php
include_once dirname(__FILE__).'/../query_sparql.php';



function getRecipesByIngredients($input,$language,$cuisine,$diet,$occasion,$course,$offset=0){

	$base = getPrefix();
	$query =$base."SELECT ?recipe (COUNT(?recipe) AS ?count) WHERE{";
	$ingredients = split(";",$input);
	for ($i = 0;$i< count($ingredients)-1;$i++){
		if($i>0)
		{
			$query = $query."UNION";
		}

		$info = split(",",$ingredients[$i]);
		$ingredient = $info[0];

		/*echo "Ing: ".$ingredient." Quantity: ".$quantity." Unit: ".$unit." Mis: ".$mis."<br>";*/

		$query= $query."{
			SELECT DISTINCT ?recipe WHERE{
			?recipe a fo:Recipe.
			?recipe fo:ingredients ?list.
			?list ?x ?ing.
			?ing fo:food ?food.
			?food rdfs:label ?name.
  			FILTER (LCASE(STR(?name))='".$ingredient."').
    }}";


		

		}

if($cuisine != ''){
		$query=$query."?recipe fo:cuisine ?cuisine.";
	}
	if($diet != ''){
		$query=$query."?recipe fo:diet ?diet.";
	}
	if($occasion != ''){
		$query=$query."?recipe fo:occasion ?occasion.";
	}
	if($course != ''){
		$query=$query."?recipe fo:course ?course.";
	}


	if($cuisine != ''){
		$query=$query."
		?cuisine a fo:Cuisine;
			  rdfs:label ?cuisinetext.
			  FILTER regex(?cuisinetext, \"".$cuisine."\", \"i\" ).";
	}

	if($diet!= ''){
		$query=$query."
		?diet a fo:Diet;
			  rdfs:label ?diettext.
			  FILTER regex(?diettext, \"".$diet."\", \"i\" ).";
					}

	if($occasion!= ''){
		$query=$query."
		?occasion a fo:Occasion;
			  rdfs:label ?occasiontext.
			  FILTER regex(?occasiontext, \"".$occasion."\", \"i\" ).";
	}


	if($course!= ''){
		$query=$query."
		?course a fo:Course;
			  rdfs:label ?coursetext.
			  FILTER regex(?coursetext, \"".$course."\", \"i\" ).";
	}


	$query =$query."} GROUP BY ?recipe
	ORDER BY DESC (?count)
	LIMIT 10
	OFFSET ".$offset;

	$results =  sparqlQuery($query,'JSON');
	return $results;
	}

?>