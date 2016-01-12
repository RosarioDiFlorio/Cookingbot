<?php
   
    $endpoint =  "http://localhost:3030/Food/update?";
    $endpointQuery = "http://localhost:3030/Food/query?";
    
    
    function sparqlQuery($query,$format = 'xml' ){     
        global $endpointQuery;
        //$format = 'xml';
        
         if (!function_exists('curl_init')){ 
           die('CURL is not installed!');
        }
        
        // get curl handle
        $ch= curl_init();
        $url = $endpointQuery . "query=".urlencode($query)."&format=".$format;
        curl_setopt($ch, CURLOPT_URL, $url);        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);        
     
        $response = curl_exec($ch);
        //print_r($response);
        curl_close($ch);
        
        return $response;
    }
	
	function getUrl($query){        
        global $endpoint;
        $format = 'json';
     
                
		/*$query ="
         prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> 
         prefix :<http://www.competenze.com/ontologia#> 
         INSERT DATA{<http://www.competenze.com/ontologia#Prova7>
		 <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>
		 <http://www.w3.org/2002/07/owl#Class> }
		 ";*/
		  
	 
        $searchUrl = $endpoint
           .'update='.urlencode($query)
           .'&format='.$format;
     
        return $searchUrl;
    }
    
	
	function sparqlUpdate($query)
	{
	 if (!function_exists('curl_init')) 
           die('CURL is not installed!');
        // get curl handle
        $ch= curl_init();
        $url = getUrl($query);
        // set request url
        curl_setopt($ch, CURLOPT_URL, $url);     
        // return response, don't print/echo
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);      
                
        $response = curl_exec($ch);
        curl_close($ch); 
		//print_r($response);
	}	
	
	/*
	//test
	$return = sparqlQuery("PREFIX comp: <http://www.foodontology.it/ontology#> SELECT ?ob  WHERE { comp:tomatoes ?p ?ob } ");
	echo $return;
	*/
	
	
	
?>
