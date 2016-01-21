<?php
include_once dirname(__FILE__).'/../query_sparql.php';



function getAllofFood($food)
{
	
	$base = getPrefix();
	
	$query = $base . "
	SELECT distinct ?food ?energy WHERE {
		?food rdf:type comp:Food ;
		rdfs:label ?label ;
  		  food:energyPer100g ?energy .
    	FILTER (lcase(str(?label)) = \"".$food."\") .
		
    }
	";
	
	$res = sparqlQuery($query,"json");
	return $res;

}



?>