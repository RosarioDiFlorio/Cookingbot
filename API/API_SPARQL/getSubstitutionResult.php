<?php
include_once dirname(__FILE__).'/../query_sparql.php';



function getSubstitutionResult($input,$lang,$solid,$liquid){

	$base = getPrefix();
	$query =$base."SELECT DISTINCT ?result ?quantity WHERE{
		{
					?food comp:hasSubstitution <".$input."> .
					?food rdfs:label ?result .
					<".$input."> fo:quantity ?quantityResult .
					 FILTER(lang(?result)='".$lang."') .
				}
				UNION
				 { ?food comp:hasSubstitution <".$input."> .
					?food rdfs:label ?result .
					<".$input."> fo:metric_quantity ?quantity .
					 FILTER(lang(?result)='".$lang."') .
				}
				UNION
				 { ?food comp:hasSubstitution <".$input."> .
					?food rdfs:label ?result .
					<".$input."> fo:imperial_quantity ?quantity .
					 FILTER(lang(?result)='".$lang."') .
				}
			}
		
	";

	$results =  sparqlQuery($query,'JSON');
	return $results;
	}

?>