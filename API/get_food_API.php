<?php
require_once dirname(__FILE__) . "/query_sparql.php";

/*
if(!Sessione::isLoggedIn()) {
sendError("Utente non collegato");
}
*/
function getAllFoodsAPI()
{
	$res = getAllFoodsLabels();
	$data = json_decode($res);
	//print_r($data->results->bindings);
	$toCicle = $data->results->bindings;
	$ar = [];
	for($i = 0 ; $i<sizeof($toCicle); $i++){
		//print_r($toCicle[$i]->label->value);
		$ar[$i] = $toCicle[$i]->label->value;
	}
	
$ar = array_unique($ar);
return json_encode($ar);

}

?>