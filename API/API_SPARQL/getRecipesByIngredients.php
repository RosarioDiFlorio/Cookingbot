<?php
include_once dirname(__FILE__).'/../query_sparql.php';



function getRecipesByIngredients($npeople,$input,$language,$cuisine,$diet,$occasion,$course,$offset=0){

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
		$quantity = $info[1];
		$unit = $info[2];
		$mis = $info[3];

		/*echo "Ing: ".$ingredient." Quantity: ".$quantity." Unit: ".$unit." Mis: ".$mis."<br>";*/

		$query= $query."{
			SELECT DISTINCT ?recipe ?food ?pesonuovo WHERE{
			?recipe a fo:Recipe;
				fo:serves ?served.
			?list a fo:IngredientList.
			?recipe fo:ingredients ?list.
			?ing a fo:Ingredient.
			?list ?x ?ing.
			?ing fo:";
			if($mis =='metric')
			{
				$query=$query."metric_";
			}else
			if($mis =='imperial')
			{
				$query=$query."imperial_";	
			}

			$query=$query."quantity ?peso.
			?ing fo:food ?food.
			?food rdfs:label ?name.
  			FILTER (LCASE(STR(?name))='".$ingredient."').
  			BIND(xsd:double(REPLACE(?peso, \" .*\", \"\", \"i\")) AS ?pesooriginale).
  			BIND(xsd:integer(?served) AS ?serviti).
  			BIND(((?pesooriginale*".$npeople.")/?serviti) AS ?pesonuovo).
      			FILTER CONTAINS (?peso, \"".$unit."\").
  			FILTER (?pesonuovo<=".$quantity.")
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



		$query = $query."}
  
GROUP BY ?recipe
ORDER BY DESC (?count)
LIMIT 10
OFFSET ".$offset;

$results =  sparqlQuery($query,'JSON');
echo $query;

return $results;
	
}


?>