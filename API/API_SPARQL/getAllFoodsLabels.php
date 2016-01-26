<?php
include_once dirname(__FILE__).'/../query_sparql.php';

function getAllFoodsLabels(){
		
	$base = getPrefix();
	$query = $base . "
	SELECT ?label WHERE { ?food rdf:type comp:Food;
      rdfs:label ?label
		
		}
		


	";
	
	$results = sparqlQuery($query,"json");
	
	return $results;
}
?>