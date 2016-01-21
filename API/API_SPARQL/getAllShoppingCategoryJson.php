<?php
include_once dirname(__FILE__).'/../query_sparql.php';

/*
* get all shopping category with label in english
*/
function getAllShoppingCaterogyJson()
{
	
	$base = getPrefix();
	
	$query = $base . "
select ?shopping ?label where { ?shopping rdf:type fo:ShoppingCategory ;
    				rdfs:label ?label ;
    filter(lang(?label)='en')

}"	;
	
	$res = sparqlQuery($query,"json");
	return $res;
	
	
}



?>