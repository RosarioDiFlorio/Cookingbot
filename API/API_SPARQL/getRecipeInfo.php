<?php
include_once dirname(__FILE__).'/../query_sparql.php';



function getRecipeInfo($recipe,$lang){


$base = getPrefix();

$query= $base."
SELECT ?textfood ?serves ?textcuisine ?textdiet ?textoccasion ?textcourse WHERE{
comp:".$recipe." a fo:Recipe;
			fo:produces ?food;
			fo:serves ?serves.
	OPTIONAL{comp:".$recipe." fo:cuisine ?cuisine;
			fo:diet ?diet;
			fo:occasion ?occasion;
			fo:course ?course.
			?cuisine rdfs:label ?textcuisine.
FILTER langmatches(lang(?textcuisine),\"".$lang."\").
?diet rdfs:label ?textdiet.
FILTER langmatches(lang(?textdiet),\"".$lang."\").
?occasion rdfs:label ?textoccasion.
FILTER langmatches(lang(?textoccasion),\"".$lang."\").
?course rdfs:label ?textcourse.
FILTER langmatches(lang(?textcourse),\"".$lang."\").
}
?food rdfs:label ?textfood.
FILTER langmatches(lang(?textfood),\"".$lang."\").
}";

echo $query;


$results = sparqlQuery($query,'JSON');
echo $results;

}




?>