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
$cuisine = strtolower((trim($_POST['cuisine'])));
$diet = strtolower((trim($_POST['diet'])));
$occasion = strtolower((trim($_POST['occasion'])));
$course = strtolower((trim($_POST['course'])));
$results=  getRecipesByWords($lang,$input,$cuisine,$diet,$occasion,$course);
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
		$results2 = getRecipeInfo($name,$lang);
		$data2 = json_decode($results2);
		$info = $data2->results->bindings;
		$food = $info[0]->textfood->value;
		$serves = $info[0]->serves->value;
		/*prelevo cuisine se è settato lo prendo altrimenti lo metto pari a "None"*/
		if(isset($info[0]->textcuisine->value))
		{
			$cuisine = $info[0]->textcuisine->value;
		}
		else 
		{
			$cuisine ="None";
		}
		/*prelevo diet se è settato lo prendo altrimenti lo metto pari a "None"*/
		if(isset($info[0]->textdiet->value))
		{
			$diet = $info[0]->textdiet->value;
		}
		else 
		{
			$diet ="None";
		}


		/*prelevo occasion se è settato lo prendo altrimenti lo metto pari a "None"*/
		if(isset($info[0]->textoccasion->value))
		{
			$occasion = $info[0]->textoccasion->value;
		}
		else 
		{
			$occasion ="None";
		}

		/*prelevo occasion se è settato lo prendo altrimenti lo metto pari a "None"*/
		if(isset($info[0]->textcourse->value))
		{
			$course = $info[0]->textcourse->value;
		}
		else 
		{
			$course ="None";
		}

		echo '<b>Food:</b> '.$food." <b>Serves:</b> ".$serves.' <b>Cuisine:</b> '.$cuisine.' <b>Diet:</b> '.$diet.' <b>Occasion:</b> '.$occasion.' <b>Course:</b> '.$course.'<br>-------------<br>';


	}

?>