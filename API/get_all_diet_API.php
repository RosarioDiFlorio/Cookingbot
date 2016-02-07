<?php
require_once dirname(__FILE__) . "/query_sparql.php";

/*
if(!Sessione::isLoggedIn()) {
sendError("Utente non collegato");
}
*/

/*

*/
function getAllDiet($lang)
{
	
	$res = getAllDietJson(strtolower($lang));
	
	//print_r($res);
	$data = json_decode($res);
	//print_r($data->results->bindings);
	$toCicle = $data->results->bindings;
	$ar = [];
	$value = [];
	//print_r($toCicle);
	for($i = 0 ; $i<sizeof($toCicle); $i++)
	{
		//echo $toCicle[$i]->shopping->value;
		$value[$i] = $toCicle[$i]->diet->value;
		$ar[$i] = $toCicle[$i]->label->value;
		echo $ar[$i];
	}
	
$value = array_unique($value);
$ar = array_unique($ar);

$result = [];

$result[0] = $value;
$result[1] = $ar;

return $result;	
	
}


?>