<?php
include_once dirname(__FILE__).'/../query_sparql.php';


function existsFoodLabel($label,$lang)
{
	
	$base = getPrefix();
	
	$query = $base . "	SELECT ?uri ?label
						WHERE {
						?uri rdfs:label \"".$label."\"@".$lang." .
						
						}";
	
	//echo 	$query;
	$res = sparqlQuery($query);
	
	$dom = new DOMDocument;
	$dom->loadXML($res);
	$tr = $dom->getElementsByTagName('results');
	if($tr->length == 0) return false;
	
	$str = $tr->item(0)->nodeValue;
	
	if(trim($str) == "")
		return false;
	
	
	return true;
	

	
	
}

//TEST
/*
//In the ontology we have the food "apples" with label "apples"@en
echo existsFoodLabel("apples","en");
*/


?>