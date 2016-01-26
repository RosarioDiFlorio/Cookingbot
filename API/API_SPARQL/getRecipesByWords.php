<?php
include_once dirname(__FILE__).'/../query_sparql.php';



function getRecipesByWords($language,$input,$cuisine,$diet,$occasion,$course,$offset=0){

	echo ' ho ricevuto'.$language.' '.$input.' Cuisine: '.$cuisine.' Diet: '.$diet.' Occasion: '.$occasion.' Course: '.$course;


	$ingredienti = split(",",$input);
	$base = getPrefix();
	$query=$base."
SELECT ?recipe (COUNT(?recipe) AS ?count) WHERE{";
				
for ($i = 0;$i< count($ingredienti);$i++){

		if($i>0)
		{
			$query = $query."UNION";
		}

		$ingrediente = $ingredienti[$i];

$query = $query."


  	{
		SELECT DISTINCT ?recipe WHERE{
		  {
			?recipe a fo:Recipe.
			?recipe fo:method ?method.
			?method ?x ?step.
			?step fo:instruction ?instr.
			FILTER CONTAINS(STR(?instr),\"".$ingrediente."\")
		  }
		  UNION
		  {
			?recipe a fo:Recipe;
			  rdfs:label ?text.
			FILTER CONTAINS(STR(?text),\"".$ingrediente."\")
		  }
		} 
	}";



	

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
	$query=$query."{
    ?cuisine a fo:Cuisine;
          rdfs:label ?cuisinetext.
          FILTER contains(?cuisinetext,\"".$cuisine."\")
           FILTER langMatches(lang(?cuisinetext), \"".$language."\").}";
				}

if($diet!= ''){
	$query=$query."{
    ?diet a fo:Diet;
          rdfs:label ?diettext.
          FILTER contains(?diettext,\"".$diet."\")
           FILTER langMatches(lang(?diettext), \"".$language."\").}";
				}

if($occasion!= ''){
	$query=$query."{
    ?occasion a fo:Occasion;
          rdfs:label ?occasiontext.
          FILTER contains(?occasiontext,\"".$occasion."\")
           FILTER langMatches(lang(?occasiontext), \"".$language."\").}";
				}


if($course!= ''){
	$query=$query."{
    ?course a fo:Course;
          rdfs:label ?coursetext.
          FILTER contains(?coursetext,\"".$occasion."\")
           FILTER langMatches(lang(?coursetext), \"".$language."\").}";
				}


$query =$query."} GROUP BY ?recipe
ORDER BY DESC (?count)
LIMIT 10
OFFSET ".$offset;

$results =  sparqlQuery($query,'JSON');
return $results;
}


?>