<?php
require dirname(__FILE__) . "/query_sparql.php";
/*
require dirname(__FILE__) . "/../../classes/Sessione.php";
require dirname(__FILE__) . "/../../classes/Utility.php";

if(!Sessione::isLoggedIn()) {
sendError("Utente non collegato");
}
*/


$lang = "en";
if(isset($_POST['lang']))
	$lang = strtolower((trim($_POST['lang'])));
$type = strtolower((trim($_POST['type'])));
$input = strtolower((trim($_POST['input'])));
$cuisine = strtolower((trim($_POST['cuisine'])));
$diet = strtolower((trim($_POST['diet'])));
$occasion = strtolower((trim($_POST['occasion'])));
$course = strtolower((trim($_POST['course'])));
$npeople = strtolower((trim($_POST['npeople'])));
$liquid = strtolower((trim($_POST['liquidMeasure'])));
$solid = strtolower((trim($_POST['solidMeasure'])));
$offset=0;
$cooktime;
$preptime;
if(isset($_POST['offset'])){
	$offset = strtolower((trim($_POST['offset'])));
}

if($type=="words"){
	$results=getRecipesByWords($input,$cuisine,$diet,$occasion,$course,$offset);
}
else{
	if($type=="ingredients"){
		$results = getRecipesByIngredients($input,$lang,$cuisine,$diet,$occasion,$course,$offset);
	}
	else{
		//else is with substitutions
	}
}

$data = json_decode($results);
	//print_r($data->results->bindings);
	$toCicle = $data->results->bindings;
	$recipe = [];
	$count = [];
	
	echo "<div class=\"well\">";
	echo "<table class=\"table table-hover\" >";
	for($i = 0 ; $i<sizeof($toCicle); $i++){
		//print_r($toCicle[$i]->label->value);
		echo "<tr class=\"text-left\">";
		
		$count[$i] = $toCicle[$i]->count->value;
		if($count[$i]== 0) {echo 'Sorry no matching found! :(';
		return ;
							}
		$recipe[$i] = $toCicle[$i]->recipe->value;
		$recipename = split("#",$recipe[$i]);
		$name = $recipename[1];
		$recipename[1] = str_ireplace("Recipe_","",$recipename[1]);
		$recipename[1] = str_ireplace("_"," ",$recipename[1]);
		
		$results2 = getRecipeInfo($name,$lang);
		$data2 = json_decode($results2);
		$info = $data2->results->bindings;
		if(!array_key_exists("0",$info)){
			continue;
		}
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
		/*prelevo cooktime se è settato lo prendo altrimenti lo metto pari a "None"*/
		if(isset($info[0]->cooktime->value))
		{
			$cooktime = $info[0]->cooktime->value;
		}
		else 
		{
			$cooktime ="None";
		}
		/*prelevo preptime se è settato lo prendo altrimenti lo metto pari a "None"*/
		if(isset($info[0]->preptime->value))
		{
			$preptime = $info[0]->preptime->value;
		}
		else 
		{
			$preptime ="None";
		}
		
		//IMMAGINE
		echo "<td>";
		$file= 'http://localhost/git/CookingBot/img/recipes/'.$recipename[1].'.jpg'; 
		echo '<div class="col-xs-12 col-ms-6"><img src="'. $file. '" alt="no image" class="img-responsive" style=" width: 250px;"/></div>';
		echo "</td>";
		//RECIPE DETAILS
		echo "<td>";
		//echo '<b>Recipe Name:</b> '.$recipename[1]."<br><b>Matches:</b> ".$count[$i]." <br>";
		echo '<div class="col-xs-12 col-ms-6"><h4> <strong>Recipe Name:</strong> '.$recipename[1] ."</h4></div>";
		//echo '<b>Produces:</b> '.$food."<br><b>Serves:</b> ".$serves;
		/*if($serves==0){
			if($lang=="it")
				echo '4 persone';
			else
				echo '4 people';
		}else{
			if($serves==1){
				if($lang=="it")
				echo ' persona';
			else
				echo ' person';
			}
			else{
				if($lang=="it")
					echo ' persone';
				else
					echo ' people';
			}
		}*/
		
		//echo '<br><b>Cuisine:</b> '.$cuisine.'<br><b>Diet:</b> '.$diet.'<br><b>Occasion:</b> '.$occasion.'<br><b>Course:</b> '.$course.'<br>';
		//echo "</td>";
		//BUTTON
		$value=$name.'#'.$lang.'#'.$solid.'#'.$liquid.'#'.$food.'#'.$npeople.'#'.$serves.'#'.$cuisine.'#'.$diet.'#'.$occasion.'#'.$course.'#'.$cooktime.'#'.$preptime;
		//$value='showRecipe.php?recipeURI='.$name.'&lang='.$lang.'&solidMeasure='.$solid.'&liquidMeasure='.$liquid.'&name='.urlencode($food).'&serves='.$npeople.'&originalserves='.$serves.'&cuisine='.urlencode($cuisine).'&diet='.urlencode($diet).'&occasion='.urlencode($occasion).'&course='.urlencode($course).'&cooktime='.urlencode($cooktime).'&preptime='.urlencode($preptime);
		//echo "<td>";
		//$value = urlencode($value);
		echo '<form target="_blank" action="showRecipe.php" method="POST"><input type="hidden" name="val" value="'.$value.'" ><button type="submit" class="btn btn-info btn-lg" value="'.$value.'"  ><span>SHOW RECIPE</span></button></form>';
		echo "</td>";

	}
	echo '</div>';
?>