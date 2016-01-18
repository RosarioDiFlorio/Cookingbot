<?php
require dirname(__FILE__) . "/query_sparql.php";
/*
require dirname(__FILE__) . "/../../classes/Sessione.php";
require dirname(__FILE__) . "/../../classes/Utility.php";

if(!Sessione::isLoggedIn()) {
sendError("Utente non collegato");
}
*/

$lang = strtolower((trim($_POST['lang'])));
$input = strtolower((trim($_POST['input'])));

$results=  getRecipesByWords($lang,$input);
$data = json_decode($results);
	//print_r($data->results->bindings);
	$toCicle = $data->results->bindings;
	$recipe = [];
	$count = [];


	for($i = 0 ; $i<sizeof($toCicle); $i++){
		//print_r($toCicle[$i]->label->value);
		$recipe[$i] = $toCicle[$i]->recipe->value;
		$count[$i] = $toCicle[$i]->count->value;
		echo $recipe[$i]." ".$count[$i]." \n";
	}

?>