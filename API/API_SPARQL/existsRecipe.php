<?php
include_once dirname(__FILE__).'/../query_sparql.php';
/*
/ this function takes a food and return true if the food exists in the ontology, false otherwise

*/
function existsRecipe($name)
{
	
	$base = getPrefix();
	
	$query = $base . " select ?o where {comp:Recipe_".$name." rdf:type ?o .
		}"	;
	
	$res = sparqlQuery($query);
	
	$dom = new DOMDocument;
	$dom->loadXML($res);
	$tr = $dom->getElementsByTagName('results');
	$str = $tr->item(0)->nodeValue;
	
	if(trim($str) == "")
		return false;
	
	
	return true;
	
}

//	TEST
/*
$res = existsFood("tomatoes");
echo $res;
*/


?>