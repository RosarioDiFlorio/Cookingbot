<?php
include_once dirname(__FILE__).'/../query_sparql.php';




function getAllSubstitutionsFood($food,$lang)
{
	
	$base = getPrefix();
	
	$query = $base . "
	SELECT ?food ?subs ?quantity ?subs ?quantity WHERE { ?food comp:hasSubstitution ?o.
      ?o comp:hasIngredient ?i .
  		?i comp:hasFood ?subs .
  		?i fo:quantity ?quantity .
		?food rdf:label \"".$food."\"@".$lang."
    }
		";
	
	$res = sparqlQuery($query,"json");
	return $res;
	
	
	
}




?>