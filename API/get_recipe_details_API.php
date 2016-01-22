<?php
require dirname(__FILE__) . "/query_sparql.php";
include_all_php("/API_SPARQL");

function showImage($name){
    $file='http://localhost/CookingBot/img/recipes/'.(strtolower($name)).'.jpg';
	
    if (file_exists($file) == false) {
		//non esiste foto, non mostro nulla
    }
	else {  
		echo '<img src="'. $file. '" alt="'. $name. '" style="max-height: 500px; max-width: 500px;"/><br>';
    }
}

//stampa le info
function printInfos($originalserves,$serves,$cuisine="",$course="",$occasion="",$diet=""){
	echo "<h4>";
	echo "Recipe for <b>".$serves."</b> people";
	if($originalserves!=$serves)
		echo " (originally for ".$originalserves.")";
	echo "<br>";
	if($cuisine!=""){
		echo "Cuisine: <b>".$cuisine."</b><br>";
	}
	if($course!=""){
		echo "Course: <b>".$course."</b><br>";
	}
	if($occasion!=""){
		echo "Occasion: <b>".$occasion."</b><br>";
	}
	if($diet!=""){
		echo "Diet: <b>".$diet."</b><br>";
	}
	echo "</h4>";
}

//stampa gli ingredienti, nel caso si visualizza per il numero di persone della ricetta
function printIngredients($recipeURI, $measure, $lang){
	$resIng = getRecipeIngredients($recipeURI, $measure, $lang);
	$dataIng = json_decode($resIng);
	$toCicleIng = $dataIng->results->bindings;
	$ingredients = [];
	$quantities = [];
	echo '<h3>INGREDIENTS</h3>';
	echo "<h4>";
	for($i = 0 ; $i<sizeof($toCicleIng); $i++){
		$ingredients[$i] = $toCicleIng[$i]->name->value;
		$quantities[$i] = $toCicleIng[$i]->quantity->value;
		echo $ingredients[$i]." ".$quantities[$i]."<br>";
	}
	echo "</h4>";
}

//stampa gli ingredienti, nel caso si visualizza per un numero di persone diverso da quello della ricetta
function printScaledIngredients($recipeURI, $measure, $lang, $serves){
	$resIng = getRecipeIngredientsScaled($recipeURI, $measure, $lang, $serves);
	$dataIng = json_decode($resIng);
	$toCicleIng = $dataIng->results->bindings;
	$ingredients = [];
	$quantities = [];
	if($serves<2){
		echo '<h3>INGREDIENTS (FOR '.$serves.' PERSON)</h3>';
	}
	else{
		echo '<h3>INGREDIENTS (FOR '.$serves.' PEOPLE)</h3>';
	}
	
	echo "<h4>";
	for($i = 0 ; $i<sizeof($toCicleIng); $i++){
		$ingredients[$i] = $toCicleIng[$i]->name->value;
		$quantities[$i] = $toCicleIng[$i]->quantity->value;
		echo $ingredients[$i]." ".$quantities[$i]."<br>";
	}
	echo "</h4>";
}

//stampa gli step
function printSteps($recipeURI, $lang){
	$resStep = getRecipeSteps($recipeURI, $lang);
	$dataStep = json_decode($resStep);
	$toCicleStep = $dataStep->results->bindings;
	$steps = [];
	echo '<h3>STEPS</h3>';
	echo "<h4>";
	for($i = 0 ; $i<sizeof($toCicleStep); $i++){
		$steps[$i] = $toCicleStep[$i]->text->value;
		$j=$i+1;
		echo $j.") ".$steps[$i]."<br>";
	}
	echo "</h4>";
}

//formatta e invoca i metodi
function getRecipeDetails($name, $originalserves, $serves, $cuisine, $course, $occasion, $diet, $recipeURI, $measure, $lang){
	echo '<h2>'.$name.'</h2>';
	showImage($name);
	printInfos($originalserves,$serves,$cuisine,$course,$occasion,$diet);
	if($originalserves==$serves){
		printIngredients($recipeURI, $measure, $lang);
	}
	else{
		printScaledIngredients($recipeURI, $measure, $lang, $serves);
	}
	printSteps($recipeURI, $lang);
	
}

//esecuzione vera e propria del codice
	$name = $_POST['name'];
	$lang = $_POST['lang'];
	$originalserves = $_POST['originalserves'];
	$serves = $_POST['serves'];
	$cuisine = $_POST['cuisine'];
	$course = $_POST['course'];
	$occasion = $_POST['occasion'];
	$diet = $_POST['diet'];
	$recipeURI = $_POST['recipeURI'];
	$measure = $_POST['measure'];
	getRecipeDetails($name, $originalserves, $serves, $cuisine, $course, $occasion, $diet, $recipeURI, $measure, $lang);
?>