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
//In the ontology we have the food "apples" with label "apples"@en
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
	
	
	if(! existsFoodLabel($food,$from))
	{
		//i'm sure, the food don't exists!
		//then i enter the food in the ontology
			
		insertFood($food,$from);
		return true;
			
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
function insertFood($food,$from)
{	
	$food;
	$labelIT;
	$label;
	$lang = "en";
	$langIT = "it";
	$to;
	
	if($from == "en")
	{
		$to = "it";
		
	}else
	{
		$to = "en";
	}

	
	$foodTranslate = translate($food,$from,$to);
	$foodTranslate = strtolower($foodTranslate);
	
	
	if($from != "en")
	{
		//the food is not in english
			
		$labelIT = $food; // <--- italian translation of food 
		$food = $foodTranslate; // <--- take the food in english
		$label = $foodTranslate;
		
		
		
	}else
	{
		$labelIT = $foodTranslate;
		$label = $food;
	}

	
	$food = str_ireplace(" ","_",$food);
	
	$base = getPrefix();
	
	$query = $base . "	INSERT DATA { comp:".$food." rdf:type comp:Food ;
    rdfs:label \"". $label ."\"@".$lang." ;
	 rdfs:label \"".$labelIT."\"@".$langIT." 
	
					}";
	
	sparqlUpdate($query);
	
	
	
	
}

function insertRecipe($name,$numberp,$cousin,$diet,$occasion,$course)
{	
	
	$name = str_ireplace(" ","_",$name);
	$numberp = str_ireplace(" ","_",$numberp);
	$cousin = str_ireplace(" ","_",$cousin);
	$diet = str_ireplace(" ","_",$diet);
	$occasion = str_ireplace(" ","_",$occasion);
	$course = str_ireplace(" ","_",$course);
	
	$base = getPrefix();
	
	$query = $base . "	INSERT DATA { comp:Recipe_".$name." a fo:recipe ;
    fo:produces comp:".$name." ;
	fo:serves \"".$numberp."\";
	fo:cousine comp:".$cousin;
	echo 'diet:'.$diet.":";
	if($diet != ""){
	$query = $query."; fo:diet comp:".$diet;
					}
	if($occasion != ""){
	$query = $query."; fo:occasion comp:".$occasion;
						}
	if($course != ""){
	$query = $query."; fo:course comp:".$course;
						}

	$query = $query.".}";
				
	sparqlUpdate($query);
	
	
	
}

function insertIngredient($ingredient,$quantity,$unit,$mis,$name,$i)
{	
	echo "2 ho ricevuto".$ingredient." - ".$quantity." - ".$unit." - ".$mis." - ".$name."\n";

	$name = str_ireplace(" ","_",$name);
	$ingredient = str_ireplace(" ","_",$ingredient);
	$quantity = str_ireplace(" ","_",$quantity);
	$unit = str_ireplace(" ","_",$unit);
	$mis = str_ireplace(" ","_",$mis);
	$i = str_ireplace(" ","_",$i);
	echo "3 ho ricevuto".$ingredient." - ".$quantity." - ".$unit." - ".$mis." - ".$name."\n";
	$base = getPrefix();
	
	$query = $base . "	INSERT DATA { comp:Ing_".$name."_".$ingredient." a fo:Ingredient ;
    fo:food comp:Food_".$ingredient.";";
    if($mis == 'unit') {
    	$query = $query."fo:quantity \"".$quantity." ".$unit."\"";
    }

    if($mis == 'metric') {
    	$query = $query."fo:metric_quantity \"".$quantity." ".$unit."\"";
    }

    if($mis == 'imperial') {
    	$query = $query."fo:imperial_quantity \"".$quantity." ".$unit."\"";
    }
	
				
	$query = $query.". }";
	
	sparqlUpdate($query);
	
	$query = $base . "	INSERT DATA { comp:IngList_".$name." a fo:IngredientList;
	rdf:_".$i." comp:".$ingredient.".
	comp:Recipe_".$name." fo:ingredients comp:IngList_".$name.". }";

	sparqlUpdate($query);

	echo $query;
	
}

function insertStep($i,$step,$name)
{	
	
	$i = str_ireplace(" ","_",$i);
	$step = str_ireplace(" ","_",$step);
	$name = str_ireplace(" ","_",$name);
	$base = getPrefix();
	
	//inserisco step
	$query = $base . "	INSERT DATA { comp:Step_".$i." a fo:Step ;
	
					}";
	
	sparqlUpdate($query);

	//inserisco lo step nel method
	$query = $base . "	INSERT DATA { comp:Method_".$name." a fo:Method ;
	rdf:_".$i." comp:Step_".$step.".
					}";

	sparqlUpdate($query);

	// inserisco il metod nella ricetta

	$query = $base . "	INSERT DATA { comp:Recipe_".$name." fo:method comp:Method_".$name.".
					}";
	sparqlUpdate($query);
	
}


 
?>