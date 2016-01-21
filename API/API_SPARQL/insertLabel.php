<?php
include_once dirname(__FILE__).'/../query_sparql.php';

function insertLabel($foodTranslate,$food,$lang)
{
	
	
	$base = getPrefix();
	
	$query = $base . " INSERT DATA { comp:".$foodTranslate." rdfs:label \"".$food."\"@".$lang." }"	;
	
	sparqlUpdate($query);
	
	
}

?>