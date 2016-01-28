<?php
include_once dirname(__FILE__).'/../query_sparql.php';


function getAllDieteJson($lang)
{
	
	$base = getPrefix();
	
	$query = $base . "
select ?diet ?label where { ?diet rdf:type fo:Diet ;
    				rdfs:label ?label ;
					filter(lang(?label)='".$lang."')

				}"	;
	
	$res = sparqlQuery($query,"json");
	return $res;
	
	
}



?>