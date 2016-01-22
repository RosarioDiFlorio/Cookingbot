<?php
include_once dirname(__FILE__).'/../query_sparql.php';




function getAllSubstitutionsFood($food)
{
	$food = strtolower($food);
	$base = getPrefix();
	
	$query = $base . "
	SELECT ?o ?labelSub ?quantity WHERE { ?food comp:hasSubstitution ?o .
  		?food rdfs:label ?label .
  		?o ?x ?ing .
  		?ing fo:food ?f . 
    	?f rdfs:label ?labelSub .
  		?o fo:quantity ?quantity .
 	   	FILTER(lcase(str(?label)) = \"pomodoro\") .
 		 FILTER(lang(?labelSub)='en') .
    }
	";  //da aggiungere tutti i tipi di quantity
	
	$res = sparqlQuery($query,"json");
	return $res;
	
	
	
}




?>