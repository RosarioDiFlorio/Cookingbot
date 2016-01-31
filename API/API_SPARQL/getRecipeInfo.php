<?php
include_once dirname(__FILE__).'/../query_sparql.php';



function getRecipeInfo($recipe,$lang){


$base = getPrefix();

$query= $base."
SELECT ?textfood ?serves ?textcuisine ?textdiet ?textoccasion ?textcourse ?cooktime ?preptime WHERE{
comp:".$recipe." a fo:Recipe;
			fo:produces ?food;
			fo:serves ?serves.
	OPTIONAL{comp:".$recipe." fo:cuisine ?cuisine.
			FILTER langmatches(lang(?textcuisine),\"".$lang."\").
			?cuisine rdfs:label ?textcuisine.

}
OPTIONAL{comp:".$recipe." fo:diet ?diet.
			?diet rdfs:label ?textdiet.
			FILTER langmatches(lang(?textdiet),\"".$lang."\"). }


OPTIONAL{comp:".$recipe." fo:occasion ?occasion.
			?occasion rdfs:label ?textoccasion.
FILTER langmatches(lang(?textoccasion),\"".$lang."\").}



OPTIONAL{comp:".$recipe." fo:course ?course.
	?course rdfs:label ?textcourse.
FILTER langmatches(lang(?textcourse),\"".$lang."\").
}

OPTIONAL{comp:".$recipe." comp:cookTime ?cooktime;
				comp:prepTime ?preptime.
	
}


	?food rdfs:label ?textfood.
FILTER langmatches(lang(?textfood),\"".$lang."\").
}";


$results = sparqlQuery($query,'JSON');
return $results;
}




?>