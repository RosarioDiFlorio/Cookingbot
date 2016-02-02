<?php
require dirname(__FILE__) . "/query_sparql.php";
include_all_php("/API_SPARQL");

function showImage($name){
	
	
	$file= 'http://localhost/git/CookingBot/img/recipes/'.$name.'.jpg';
	//echo $file;
    /*if (file_exists($file) == false) {
		//non esiste foto, non mostro nulla
		echo $file.'<br>Nessuna Immagine<br>';
    }
	else {  */
		echo '<div class="allBlack"><img src="'. $file. '" alt="'. $name. '" style="max-height: 500px; max-width: 500px;"/></div>';
    //}
}

//stampa le info
function printInfos($originalserves,$serves,$cuisine="",$course="",$occasion="",$diet="",$lang){
		echo "<div class=\"col-xs-12 smallPadding col-md-12 smallSpaceTop smallSpaceBottom allRed\"  >"; //inizio div contenitore rosso;
	echo "<div class=\"smallPadding smallSpaceBottom smallSpaceTop col-md-6 allRed\"><div><i class=\"glyphicon glyphicon-glass\"  style = \"font-size:36px; color:#fff;\"></i></div>";
	if($lang == "en")
	{		
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
	}
	else
	{
		echo "Ricetta per <b>".$serves."</b> persone";
		if($originalserves!=$serves)
			echo " (originariamente per ".$originalserves.")";
		echo "<br>";
		if($cuisine!=""){
			echo "Tipo di cucina: <b>".$cuisine."</b><br>";
		}
		if($course!=""){
			echo "Portata: <b>".$course."</b><br>";
		}
		if($occasion!=""){
			echo "Occasione: <b>".$occasion."</b><br>";
		}
		if($diet!=""){
			echo "Dieta: <b>".$diet."</b><br>";
		}
		
	}
	echo "</div>";
}

//stampa gli ingredienti, nel caso si visualizza per il numero di persone della ricetta
function printIngredients($recipeURI, $liquidMeasure, $solidMeasure, $lang){
	$ingredients = getRecipeIngredients($recipeURI, $lang);
	if(!empty($ingredients))
	{
		$ingredients = removeDuplicate($ingredients);
		if($lang == "en")
			echo '<h3>INGREDIENTS</h3>';
		else
			echo '<h3>INGREDIENTI</h3>';
		
		echo "<div class=\"col-xs-12 smallSpaceBottom  \">";

		foreach ($ingredients as $key => $value){
			echo "<div class=\"col-xs-12\"><strong>";
			echo $key." ";
			if(array_key_exists($liquidMeasure,$value)){
				echo $value[$liquidMeasure];
			}
			else{
				if(array_key_exists($solidMeasure,$value)){
					echo $value[$solidMeasure];
				}
				else{
					if(array_key_exists("unit",$value)){
						echo $value["unit"];
					}
				}
			}
			echo "</strong></div>";
		}
		echo "</div>";
	}
}

//stampa gli ingredienti, nel caso si visualizza per un numero di persone diverso da quello della ricetta
function printScaledIngredients($recipeURI, $liquidMeasure, $solidMeasure, $lang, $serves){
	
	$ingredients = getRecipeIngredientsScaled($recipeURI, $lang, $serves);
	
	if(!empty($ingredients))
	{
		$ingredients = removeDuplicate($ingredients);
		if($lang == "en")
		{
			if($serves<2){
				
				echo '<h3>INGREDIENTS ( for '.$serves.' person)</h3>';
			}
			else{
				echo '<h3>INGREDIENTS ( for '.$serves.' people)</h3>';
			}
		}
		else
		{
			
			if($serves<2){
				
				echo '<h3>INGREDIENTI ( per '.$serves.' persona)</h3>';
			}
			else{
				echo '<h3>INGREDIENTI ( per '.$serves.' persone)</h3>';
			}
		}
		echo "<div class=\"col-xs-12 smallSpaceBottom \">";

		foreach ($ingredients as $key => $value){
			echo "<div class=\"col-xs-12 smallSpaceBottom \"><strong>";
			echo $key." ";
			if(array_key_exists($liquidMeasure,$value)){
				echo $value[$liquidMeasure];
			}
			else{
				if(array_key_exists($solidMeasure,$value)){
					echo $value[$solidMeasure];
				}
				else{
					if(array_key_exists("unit",$value)){
						echo $value["unit"];
					}
				}
			}
			echo "</strong></div>";
		}
		echo "</div>";
	}
}

//stampa gli step
function printSteps($recipeURI, $lang){
	$steps = getRecipeSteps($recipeURI, $lang);
	if($lang == "en")
		echo '<h3>STEPS</h3>';
	else
		echo '<h3>SVOLGIMENTO</h3>';
	echo "<div class=\"col-xs-12 text-left smallSpaceBottom \">";
	for($i = 0 ; $i<count($steps); $i++){
		$j=$i+1;
		echo "<div class=\"smallSpaceBottom smallSpaceTop\"><strong>".$j.". </strong>".$steps[$i]."</div>";
	}
	echo "</div>";
}

//formatta e invoca i metodi
function getRecipeDetails($name, $originalserves, $serves, $cuisine, $course, $occasion, $diet, $recipeURI, $liquidMeasure, $solidMeasure, $lang,$cooktime,$preptime){
	$title = substr($name,1,strlen($name));
	$title = strtoupper($name[0]) . $title;
	echo '<div class="allRed text-left smallPadding smallSpaceBottom"><h2><strong>'.$title.'</strong></h2></div>';
	
	//echo $recipeURI;
	$imgPath = str_ireplace("Recipe_","",$recipeURI);
	$imgPath = str_ireplace("_"," ",$imgPath);
	showImage($imgPath);
	
	printInfos($originalserves,$serves,$cuisine,$course,$occasion,$diet,$lang);
	printTime($cooktime,$preptime,$lang);
	if($originalserves==$serves){
		
		printIngredients($recipeURI, $liquidMeasure, $solidMeasure, $lang);
	}
	else{
		printScaledIngredients($recipeURI, $liquidMeasure, $solidMeasure, $lang, $serves);
	}
	
	printSteps($recipeURI, $lang);
	
}

function printTime($cooktime,$preptime,$lang)
{
	if($lang == "en")
	{
		$strCook = "Cooking time";
		$strPrep = "Preparation time";
		
	}
	else
	{
		
		$strCook = "Tempo di cotture";
		$strPrep = "Tempo di preparazione";
		
	}
	echo "<div class=\"col-xs-12 smallPadding col-md-6 smallSpaceTop smallSpaceBottom allRed\"  >";
	echo "<i class=\"glyphicon glyphicon-time\"  style = \"font-size:36px; color:#fff;\"></i>";
	echo "<div><strong>".$strCook.":</strong>".$cooktime."</div>";
	echo "<div><strong>".$strPrep.":</strong>".$preptime."</div>";
	echo "</div>";
	echo "</div>"; //fine div contenitore rosso
}

function removeDuplicate($ingredients)
{
	$matcher = [" di ",
				" d'",
				" alla ",
				"  all'"];
	foreach ($ingredients as $key => $value){
			
				foreach ($ingredients as $key2 => $value2){
					
					//variabili utilizzate nell' "else if" per controllare parole uguali a meno di alcune preposizioni o altro tipo: "di" e "d'" (Esempio:  olio d'oliva - olio di oliva)
					$keyMod = str_ireplace($matcher," ",$key);
					$keyMod2 = str_ireplace($matcher," ",$key2);
					
					if($keyMod != $keyMod2) //non sono uguali
					{
						if(substr($keyMod,0,strlen($keyMod)-1) == substr($keyMod2,0,strlen($keyMod2)-1) ) //ma sono uguali a meno dell'ultima lettera (Esempio: zucchine - zucchina)
						{
							//echo $keyMod. " - " .$keyMod2 . "<br>";
							unset($ingredients[$key]);
							
						}
						
					}
					else if($key != $key2 && $keyMod == $keyMod2)
					{	
						//echo $keyMod. " - " .$keyMod2 . "<br>";
						unset($ingredients[$key]);
					}
			
				}
			
			
	}
	return $ingredients;
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
	$liquidMeasure = $_POST['liquidMeasure'];
	$solidMeasure = $_POST['solidMeasure'];
	$cooktime = $_POST['cooktime'];					//cooktime
	$preptime = $_POST['preptime'];					//preptime
	getRecipeDetails($name, $originalserves, $serves, $cuisine, $course, $occasion, $diet, $recipeURI, $liquidMeasure, $solidMeasure, $lang,$cooktime,$preptime);
?>