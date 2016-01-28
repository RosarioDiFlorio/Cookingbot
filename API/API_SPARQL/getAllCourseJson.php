<?php
include_once dirname(__FILE__).'/../query_sparql.php';


function getAllCourseJson($lang)
{
	
	$base = getPrefix();
	
	$query = $base . "
select ?course ?label where { ?course rdf:type fo:Course ;
    				rdfs:label ?label ;
					filter(lang(?label)='".$lang."')

				}"	;
	
	$res = sparqlQuery($query,"json");
	return $res;
	
	
}



?>