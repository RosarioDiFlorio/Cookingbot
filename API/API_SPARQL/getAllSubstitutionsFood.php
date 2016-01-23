<?php
include_once dirname(__FILE__).'/../query_sparql.php';




function getAllSubstitutionsFood($food,$lang)
{
	$food = strtolower($food);
	$base = getPrefix();
	
	$query = $base . "
	SELECT distinct ?o ?labelSub ?quantityResult ?quantity WHERE 
			{
					
				{
					?food comp:hasSubstitution ?o .
					?food rdfs:label ?label .
					?o ?x ?ing .
					?ing fo:quantity ?quantity .
					?ing fo:food ?f . 
					?f rdfs:label ?labelSub .
					?o fo:quantity ?quantityResult .
					FILTER(lcase(str(?label)) = \"".$food."\") .
					 FILTER(lang(?labelSub)='".$lang."') .
				}
				UNION
				 { ?food comp:hasSubstitution ?o .
					?food rdfs:label ?label .
					?o ?x ?ing .
					?ing fo:imperial_quantity ?quantity .
					?ing fo:food ?f . 
					?f rdfs:label ?labelSub .
					?o fo:imperial_quantity ?quantityResult .
					FILTER(lcase(str(?label)) = \"".$food."\") .
					 FILTER(lang(?labelSub)='".$lang."') .
				}
				UNION
				 { ?food comp:hasSubstitution ?o .
					?food rdfs:label ?label .
					?o ?x ?ing .
					?ing fo:metric_quantity ?quantity .
					?ing fo:food ?f . 
					?f rdfs:label ?labelSub .
					?o fo:metric_quantity ?quantityResult .
					FILTER(lcase(str(?label)) = \"".$food."\") .
					 FILTER(lang(?labelSub)='".$lang."') .
				}
			}
	";  //da aggiungere tutti i tipi di quantity
	
	$res = sparqlQuery($query,"json");
	return $res;
	
	
	
}




?>