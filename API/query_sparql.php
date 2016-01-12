<?php
include_once dirname(__FILE__).'/http_API.php';
include_once dirname(__FILE__).'/microsoft_translate_API.php';


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
	prefix food: <http://data.lirmm.fr/ontologies/food#>
	 ";
	
}


/*
/ this function takes a food and return true if the food exists in the ontology, false otherwise

*/
function existsFood($food)
{
	
	$base = getPrefix();
	
	$query = $base . " select ?o where {comp:".$food." rdf:type ?o .
		comp:".$food." rdf:type comp:Food
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




function insertLabel($foodTranslate,$food,$lang)
{
	
	
	$base = getPrefix();
	
	$query = $base . " INSERT DATA { comp:".$foodTranslate." rdfs:label \"".$food."\"@".$lang." }"	;
	
	sparqlUpdate($query);
	
	
}



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
	$str = $tr->item(0)->nodeValue;
	
	if(trim($str) == "")
		return false;
	
	
	return true;
	

	
	
}

//TEST
/*
In the ontology we have the food "apples" with label "apples"@en
echo existsFoodLabel("apples","en");
*/



/*
*this function return true if the function insert the food in the ontology with success using label or comp:Food 
* otherwise, if the food exists like comp:Food or like label in another languages the function return false
*/
function insertFoodCtrlLang($food)
{	
	$from = detectLang($food);
	if($from != "en")
	{
		if($from != "it")
		{
			$from = "it";
		}
	}
	$base = getPrefix();
	
	
	if(! existsFoodLabel($food,$from))
	{
		//check in other language
		if($from == "en")
			$to = "it";
		else 
			$to = "en";
		
		$foodTranslate = translate($food,$from,$to);
		$foodTranslate = strtolower($foodTranslate);
		if(!existsFoodLabel($foodTranslate,$to))
		{
			//i'm sure, the food don't exists!
			//then i enter the food in the ontology
			
			insertFood($food,$from);
			return true;
			
			
		}else
		{	
			$foodTranslate = str_ireplace(" ","_",$foodTranslate);
			insertLabel($foodTranslate,$food,$from);
			return true;
		}
		
	
		
	}
	else
	{
		// the label exists, we have this food codified in the ontology!!!
		return false;
			
	}
		
	

	
}


/*
* the function insertFood return true if the operation has been succes,
* otherwise, if the Food are alredy in the ontology, the function return false
*/
function insertFood($food,$lang)
{
	$label = $food;
	$food = str_ireplace(" ","_",$food);
	
	$base = getPrefix();
	
	$query = $base . "	INSERT DATA { comp:".$food." rdf:type comp:Food ;
    rdfs:label \"".$label."\"@".$lang."
					}";
	
	sparqlUpdate($query);
	
	
	
	
}




 
?>