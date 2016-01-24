<?php

/*Directories that contain classes*/
$folder = "API_SPARQL";
    
function include_all_php($folder)
{
	//echo count(glob($folder."/*.php"));
    foreach (glob($folder."/*.php") as $filename)
    {
        //echo $filename;
		 include_once ''.$filename;
		 //echo '/'.$filename;	
    }
}


function getPrefix(){
	
	return "
	PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
	PREFIX owl: <http://www.w3.org/2002/07/owl#>
	PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
	PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
	PREFIX comp: <http://www.foodontology.it/ontology#>
	PREFIX fo: <http://purl.org/ontology/fo/>
	PREFIX co: <http://rhizomik.net/ontologies/copyrightonto.owl#>
	PREFIX com: <http://purl.org/commerce#>
	PREFIX food: <http://data.lirmm.fr/ontologies/food#>
	 ";
	
}

include_all_php($folder);
include_once dirname(__FILE__).'/http_API.php';
include_once dirname(__FILE__).'/microsoft_translate_API.php';
?>