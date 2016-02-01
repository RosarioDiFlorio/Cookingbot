<?php
include_once dirname(__FILE__).'/../query_sparql.php';




function getSubstitutionIngredients($input,$lang,$solid,$liquid)
{
	$base = getPrefix();
	
	$query = $base . "
	SELECT distinct ?ingredient ?quantity WHERE 
			{
					
				{
					<".$input."> ?x ?ing .
					?ing fo:quantity ?quantity .
					?ing fo:food ?f . 
					?f rdfs:label ?ingredient .
					FILTER(lang(?ingredient)='".$lang."').
				}
				UNION
				 { <".$input."> ?x ?ing .
					?ing fo:imperial_quantity ?quantity .
					?ing fo:food ?f . 
					?f rdfs:label ?ingredient .
					 FILTER(lang(?ingredient)='".$lang."') 
					 FILTER contains(?quantity, \" ".$solid."\") .
				}
				UNION
				 { <".$input."> ?x ?ing .
					?ing fo:metric_quantity ?quantity .
					?ing fo:food ?f . 
					?f rdfs:label ?ingredient .
					 FILTER(lang(?ingredient)='".$lang."') 
					 FILTER contains(?quantity, \" ".$solid."\") .
				 }
				UNION
				 { <".$input."> ?x ?ing .
					?ing fo:imperial_quantity ?quantity .
					?ing fo:food ?f . 
					?f rdfs:label ?ingredient .
					 FILTER(lang(?ingredient)='".$lang."') 
					 FILTER contains(?quantity, \" ".$liquid."\") .
				}
				UNION
				 { <".$input."> ?x ?ing .
					?ing fo:metric_quantity ?quantity .
					?ing fo:food ?f . 
					?f rdfs:label ?ingredient .
					 FILTER(lang(?ingredient)='".$lang."') 
					 FILTER contains(?quantity, \" ".$liquid."\") .
				}
			}
	"; 
	
	$res = sparqlQuery($query,"json");
	return $res;
}

?>