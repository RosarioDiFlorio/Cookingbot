<?php
include_once dirname(__FILE__).'/../query_sparql.php';


function getAllCuisineJson($lang)
{
	
	$base = getPrefix();
	
	$query = $base . "
select ?cuisine ?label where { ?cuisine rdf:type fo:Cuisine ;
    				rdfs:label ?label ;
					filter(lang(?label)='".$lang."')

				}"	;
	
	$res = sparqlQuery($query,"json");
	return $res;
	
	
}



?>