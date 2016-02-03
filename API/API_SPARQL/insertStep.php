<?php
include_once dirname(__FILE__).'/../query_sparql.php';



function insertStep($i,$step,$name)
{	
	
	$i = str_ireplace(" ","_",$i);
	//$step = str_ireplace(" ","_",$step);
	$name = str_ireplace(" ","_",$name);
	$base = getPrefix();
	
	//inserisco step
	$query = $base . "	INSERT DATA { comp:Step_".$name."_".$i." a fo:Step ;
		fo:instruction \"".$step."\"@".detectLang($step).".
	}";
	
	sparqlUpdate($query);

	//inserisco lo step nel method
	$query = $base . "	INSERT DATA { comp:Method_".$name." a fo:Method ;
	rdf:_".$i." comp:Step_".$name."_".$i.".
					}";

	sparqlUpdate($query);

	// inserisco il metod nella ricetta

	$query = $base . "	INSERT DATA { comp:Recipe_".$name." fo:method comp:Method_".$name.".
					}";
	$risultato= sparqlUpdate($query);
	//echo $risultato;
}



?>