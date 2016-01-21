<?php
include_once dirname(__FILE__).'/../query_sparql.php';




function insertShoppingCategory($shopping)
{	
	$shopping = trim($shopping);
	
	$base = getPrefix();
	
	$italian = strtolower(translate($shopping,"en","it"));
	
	$english = strtolower(translate($shopping,"it","en"));
	
	$shopping = str_ireplace(" ","_",$english);
	
	//inserisco 
	$query = $base . "INSERT DATA { comp:".$shopping." rdf:type fo:ShoppingCategory ;
						rdfs:label \"".$english."\"@en ;
						rdfs:label \"".$italian."\"@it 						
						}";
	//echo $query;
	sparqlUpdate($query);
	

	
}


?>