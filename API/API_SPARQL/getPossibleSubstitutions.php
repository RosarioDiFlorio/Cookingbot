<?php
include_once dirname(__FILE__).'/../query_sparql.php';



function getPossibleSubstitutions($input){

	$base = getPrefix();
	$query =$base."SELECT ?substitute (COUNT(?label) AS ?matches) WHERE{";
	$query = $query."SELECT DISTINCT ?substitute ?label WHERE{";
	$ingredients = split(";",$input);
	for ($i = 0;$i< count($ingredients)-1;$i++){
		if($i>0)
		{
			$query = $query."UNION";
		}

		$info = split(",",$ingredients[$i]);
		$ingredient = $info[0];

		$query= $query."{
			?originalFood a comp:Food;
				comp:hasSubstitution ?substitute.
					?ing a fo:Ingredient.
					?substitute ?x ?ing.
					?ing fo:food ?food.
					?food rdfs:label ?label.
					FILTER (LCASE(STR(?label))='".$ingredient."').}";
		}

	$query =$query."}}GROUP BY ?substitute ORDER BY DESC(?matches) ";

	$results =  sparqlQuery($query,'JSON');
	return $results;
	}

?>