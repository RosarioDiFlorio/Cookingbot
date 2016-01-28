<?php
include_once dirname(__FILE__).'/../query_sparql.php';


function getAllOccasionJson($lang)
{
	
	$base = getPrefix();
	
	$query = $base . "
select ?occasion ?label where { ?occasion rdf:type fo:Occasion ;
    				rdfs:label ?label ;
					filter(lang(?label)='".$lang."')

				}"	;
	
	$res = sparqlQuery($query,"json");
	return $res;
	
	
}



?>