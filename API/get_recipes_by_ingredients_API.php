<?php
require dirname(__FILE__) . "/query_sparql.php";
/*
require dirname(__FILE__) . "/../../classes/Sessione.php";
require dirname(__FILE__) . "/../../classes/Utility.php";

if(!Sessione::isLoggedIn()) {
sendError("Utente non collegato");
}
*/

$npeople = strtolower((trim($_POST['npeople'])));
$input = strtolower((trim($_POST['input'])));
$results = getRecipesByIngredients($npeople,$input);
$data = json_decode($results);
	//print_r($data->results->bindings);
	$toCicle = $data->results->bindings;
	$recipe = [];
	$count = [];


	for($i = 0 ; $i<sizeof($toCicle); $i++){
		//print_r($toCicle[$i]->label->value);
		
		$count[$i] = $toCicle[$i]->count->value;
		if($count[$i]== 0) {echo 'Sorry no matching found! :(';
		return ;
							}
		$recipe[$i] = $toCicle[$i]->recipe->value;
		$recipename = split("#",$recipe[$i]);
		$name = $recipename[1];
		$recipename[1] = str_ireplace("Recipe_","",$recipename[1]);
		$recipename[1] = str_ireplace("_"," ",$recipename[1]);
		echo '<b>Recipe Name:</b> '.$recipename[1]." <b>- Ingredients matching:</b> ".$count[$i]." <br>";
	}
?>