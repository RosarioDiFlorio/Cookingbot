<?php
include_once dirname(__FILE__).'/../query_sparql.php';



function getRecipesByWords($language,$input){

	$ingredienti = split(",",$input);


$query ="PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX owl: <http://www.w3.org/2002/07/owl#>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
PREFIX comp: <http://www.foodontology.it/ontology#>
PREFIX fo: <http://purl.org/ontology/fo/>
PREFIX food: <http://data.lirmm.fr/ontologies/food#>
SELECT ?recipe (COUNT(?recipe) AS ?count) WHERE{";
				
for ($i = 0;$i< count($ingredienti);$i++){

		if($i>0)
		{
			$query = $query."UNION";
		}

		$ingrediente = $ingredienti[$i];

$query = $query."


  	{
		SELECT DISTINCT ?recipe WHERE{
			{
				?recipe a fo:Recipe.
				?m a fo:Method.
				?recipe fo:method ?m.
				?s a fo:Step.
				?m ?x ?s.
				?s fo:instruction ?text.
				FILTER contains(?text,\"".$ingrediente."\")"."
				FILTER langMatches(lang(?text), \"".$language."\").
			}
			UNION
			{
				?recipe a fo:Recipe;
					rdfs:label ?text.
				FILTER contains(?text,\"".$ingrediente."\").
				FILTER langMatches(lang(?text),\"".$language."\").
				}
			UNION
			{
				?recipe a fo:Recipe;
				fo:produces ?food.
				?food rdfs:label ?label.
				FILTER contains(?label,\"".$ingrediente."\").
				FILTER langMatches(lang(?label),\"".$language."\").
				}
			UNION
			{
				?recipe a fo:Recipe.
				?list a fo:IngredientList.
				?recipe fo:ingredients ?list.
				?ing a fo:Ingredient.
				?list ?x ?ing.
				?ing fo:food ?food.
				?food rdfs:label ?text.
				FILTER contains(?text,\"".$ingrediente."\").
				FILTER langMatches(lang(?text), \"".$language."\").
			}
		}
	}



";


}

$query =$query."} GROUP BY ?recipe
ORDER BY DESC (?count)";
echo $query;
$results =  sparqlQuery($query,'JSON');
return $results;
}


?>