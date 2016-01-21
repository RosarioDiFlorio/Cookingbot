<?php
include_once dirname(__FILE__).'/../query_sparql.php';



function getRecipeInfo($recipe,$lang){


$base = "PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX owl: <http://www.w3.org/2002/07/owl#>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
PREFIX comp: <http://www.foodontology.it/ontology#>
PREFIX fo: <http://purl.org/ontology/fo/>
PREFIX food: <http://data.lirmm.fr/ontologies/food#>";

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
FILTER langmatches(lang(?textdiet),\"".$lang."\").
?occasion rdfs:label ?textfoccasion.
FILTER langmatches(lang(?textoccasion),\"".$lang."\").
?course rdfs:label ?textcourse.
FILTER langmatches(lang(?textcourse),\"".$lang."\").
}
?food rdfs:label ?textfood.
FILTER langmatches(lang(?textfood),\"".$lang."\").
}";

echo $query;



}




?>