<?php
include_once dirname(__FILE__).'/../query_sparql.php';

/*
* get all shopping category with label in english
*/
function getAllShoppingCategoryJson($lang)
{
	
	$base = getPrefix();
	
	$query = $base . "
select ?shopping ?label where { ?shopping rdf:type fo:ShoppingCategory ;
    				rdfs:label ?label ;
					filter(lang(?label)='".$lang."')

				}"	;
	
	$res = sparqlQuery($query,"json");
	return $res;
	
	
}



?>