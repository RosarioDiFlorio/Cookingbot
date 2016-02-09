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
		echo '<div class="col-ms-6 allBlack  text-center smallPadding"><img src="'. $file. '" alt="'. $name. '" class="img-responsive " /></div></div>';
    //}
}

//stampa le info
function printInfos($originalserves,$serves,$cuisine="",$course="",$occasion="",$diet="",$lang){
		echo "<div class=\"col-xs-12 smallPadding col-md-12 smallSpaceTop smallSpaceBottom allRed\"  >"; //inizio div contenitore rosso;
	echo "<div class=\"smallPadding smallSpaceBottom smallSpaceTop col-md-6 allRed\"><div><i class=\"glyphicon glyphicon-glass\"  style = \"font-size:36px; color:#fff;\"></i></div>";
	if($lang == "en")
	{		
		if($serves!=""){
			if($originalserves!=$serves){
				echo "Recipe for <b>".$serves."</b> ";
				if($serves>1)
					echo "people ";
				else
					echo "person ";
				echo " (originally for ".$originalserves.")";
			}
			else{
				echo "Recipe for <b>".$originalserves."</b> ";
				if($originalserves>1)
					echo "people ";
				else
					echo "person ";
			}
		}
		else{
			echo "Recipe for <b>".$originalserves."</b> ";
			if($originalserves>1)
					echo "people ";
				else
					echo "person ";
		}
			
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
		if($serves!=""){
			if($originalserves!=$serves){
				echo "Ricetta per <b>".$serves."</b> person";
				if($serves>1)
					echo "e ";
				else
					echo "a ";
				echo " (originalmente per ".$originalserves.")";
			}
			else{
				echo "Ricetta per <b>".$originalserves."</b> person";
				if($originalserves>1)
					echo "e ";
				else
					echo "a ";
			}
		}
		else{
			echo "Ricetta per <b>".$originalserves."</b> person";
			if($originalserves>1)
					echo "e ";
				else
					echo "a ";
		}
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
function printIngredients($recipeURI, $liquidMeasure, $solidMeasure, $lang, $originalserves){
	$ingredients = getRecipeIngredients($recipeURI, $lang);
	$tooltip;
	$substitution;
	if(!empty($ingredients))
	{	
		echo "<div class=\"col-xs-12  text-left  smallSpaceBottom \">";
		$ingredients = removeDuplicate($ingredients);
		if($lang == "en")
		{	
			$substitution = "show substitutions";
			$tooltip = "click here to see the possible substitution for this ingredient";
			if($originalserves<2){
				echo '<h3><strong>INGREDIENTS</strong> ( for '.$originalserves.' person)</h3>';
			}
			else{
				echo '<h3><strong>INGREDIENTS</strong> ( for '.$originalserves.' people)</h3>';
			}
		}
		else
		{	
			$substitution = "mostra le sostituzioni";
			$tooltip = "clicca quì per visualizzare le possibili sostituzioni di questo ingrediente";
			if($originalserves<2){
				echo '<h3><strong>INGREDIENTI </strong>( per '.$originalserves.' persona)</h3>';
			}
			else{
				echo '<h3><strong>INGREDIENTI</strong> ( per '.$originalserves.' persone)</h3>';
				
			}
		}
		
		
		echo "<table class=\"table table-bordered\">";
		foreach ($ingredients as $key => $value){
			echo "<tr>";
			echo "<td>";
			echo "<div class=\"col-xs-12 smallSpaceBottom \"><strong>";
			echo $key." ";
			if(array_key_exists("details",$value)){
				echo $value["details"]." ";
			}
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
			echo "</td>";
			echo "<td class=\"text-center\">";
			
			echo "</strong><input type=\"button\" class=\"btn btn-info\" value=\"".$substitution."\" onclick=\"showSubstitutions('".$key."');\" data-toggle=\"tooltip\" title=\"".$tooltip."\"> </div>";
			echo "</td>";
			echo "<tr>";
		}
		
		echo "</table>";
		echo "</div>";
	}
}

//stampa gli ingredienti, nel caso si visualizza per un numero di persone diverso da quello della ricetta
function printScaledIngredients($recipeURI, $liquidMeasure, $solidMeasure, $lang, $serves, $originalserves){
	
	$ingredients = getRecipeIngredientsScaled($recipeURI, $lang, $serves, $originalserves);
	$tooltip;
	$substitution;
	if(!empty($ingredients))
	{	
		echo "<div class=\"col-xs-12  text-left  smallSpaceBottom \">";
		$ingredients = removeDuplicate($ingredients);
		if($lang == "en")
		{	
			$substitution = "show substitutions";
			$tooltip = "click here to see the possible substitution for this ingredient";
			if($serves<2){
				
				echo '<h3><strong>INGREDIENTS</strong> ( for '.$serves.' person)</h3>';
			}
			else{
				echo '<h3><strong>INGREDIENTS</strong> ( for '.$serves.' people)</h3>';
			}
		}
		else
		{	
			$substitution = "mostra le sostituzioni";
			$tooltip = "clicca quì per visualizzare le possibili sostituzioni di questo ingrediente";
			if($serves<2){
				
				echo '<h3><strong>INGREDIENTI </strong>( per '.$serves.' persona)</h3>';
			}
			else{
				
				echo '<h3><strong>INGREDIENTI</strong> ( per '.$serves.' persone)</h3>';
				
			}
		}
		
		
		echo "<table class=\"table table-bordered\">";
		foreach ($ingredients as $key => $value){
			echo "<tr>";
			echo "<td>";
			echo "<div class=\"col-xs-12 smallSpaceBottom \"><strong>";
			echo $key." ";
			if(array_key_exists("details",$value)){
				echo $value["details"]." ";
			}
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
			echo "</td>";
			echo "<td class=\"text-center\">";
			
			echo "</strong><input type=\"button\" class=\"btn btn-info\" value=\"".$substitution."\" onclick=\"showSubstitutions('".$key."','".$lang."');\" data-toggle=\"tooltip\" title=\"".$tooltip."\"> </div>";
			echo "</td>";
			echo "<tr>";
		}
		
		echo "</table>";
		echo "</div>";
	}
}

//stampa gli step
function printSteps($recipeURI, $lang){
	$steps = getRecipeSteps($recipeURI, $lang);
	echo "<div class=\"text-left\">";
	if($lang == "en")
		echo '<h3><strong>STEPS</strong></h3>';
	else
		echo '<h3><strong>SVOLGIMENTO</strong></h3>';
	echo "</div>";
	echo "<div class=\"col-xs-12 text-left smallSpaceBottom \">";
	$j=1;
	for($i = 1 ; $i<count($steps); $i++){
		if(!array_key_exists($i,$steps))
			continue;
		echo "<div class=\"smallSpaceBottom smallSpaceTop\"><strong>".$j.". </strong>".utf8_decode($steps[$i])."</div>";
		$j++;
	}
	echo "</div>";
}

//formatta e invoca i metodi
function getRecipeDetails($name, $originalserves, $serves, $cuisine, $course, $occasion, $diet, $recipeURI, $liquidMeasure, $solidMeasure, $lang,$cooktime,$preptime){
	$title = substr($name,1,strlen($name));
	$title = strtoupper($name[0]) . $title;
	
	
	//echo $recipeURI;
	$imgPath = str_ireplace("Recipe_","",$recipeURI);
	$imgPath = str_ireplace("_"," ",$imgPath);
	
	
	echo '<div class="col-ms-12 "><div class="col-ms-6 text-left allRed smallPadding "><h2><strong>'.$title.'</strong></h2></div>';
	showImage($imgPath);
	
	printInfos($originalserves,$serves,$cuisine,$course,$occasion,$diet,$lang);
	printTime($cooktime,$preptime,$lang);
	if(($originalserves==$serves)||($serves=="")){
		
		printIngredients($recipeURI, $liquidMeasure, $solidMeasure, $lang, $originalserves);
	}
	else{
		printScaledIngredients($recipeURI, $liquidMeasure, $solidMeasure, $lang, $serves, $originalserves);
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
		
		$strCook = "Tempo di cottura";
		$strPrep = "Tempo di preparazione";
		
	}
	echo "<div class=\"col-xs-12 smallPadding col-md-6 smallSpaceTop smallSpaceBottom allRed\"  >";
	echo "<i class=\"glyphicon glyphicon-time\"  style = \"font-size:36px; color:#fff;\"></i>";
	echo "<div><strong>".$strPrep.":</strong>".$preptime."</div>";
	echo "<div><strong>".$strCook.":</strong>".$cooktime."</div>";
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