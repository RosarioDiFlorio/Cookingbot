<?php
include_once dirname(__FILE__).'/../query_sparql.php';


function insertRecipe($name,$food,$numberp,$cuisine,$diet,$occasion,$course,$language){	

	insertFoodCtrlLang($food,"","","");
	
	$label=$name;
	$name = str_ireplace(" ","_",$name);
	
	if($language == 'en'){
		
		$cuisineEN = strtolower($cuisine);
		$dietEN = strtolower($diet);
		$occasionEN = strtolower($occasion);
		$courseEN = strtolower($course);

		if($cuisine != ""){
			$cuisineIT = strtolower(translate($cuisine,'en','it'));
		}
		if($diet != ""){
			$dietIT =  strtolower(translate($diet,'en','it'));
		}
		if($occasion != ""){
			$occasionIT = strtolower(translate($occasion,'en','it'));
		}
		if($course != ""){				
			$courseIT = strtolower(translate($course,'en','it'));
		}
	}
	else
		if($language == 'it'){

			$food = translate($food,"it","en");
			$cuisineIT = strtolower($cuisine);
			$dietIT = strtolower($diet);
			$occasionIT = strtolower($occasion);
			$courseIT = strtolower($course);

			if($cuisine != ""){
				$cuisineEN = strtolower(translate($cuisine,'it','en'));
			}
			if($diet != ""){
				$dietEN=  strtolower(translate($diet,'it','en'));
			}
			if($occasion != ""){				
				$occasionEN = strtolower(translate($occasion,'it','en'));
			}
			if($course != ""){					
				$courseEN = strtolower(translate($course,'it','en'));
			}
		}

	$cuisine = str_ireplace(" ","_",$cuisineEN);
	$diet = str_ireplace(" ","_",$dietEN);
	$occasion = str_ireplace(" ","_",$occasionEN);
	$course = str_ireplace(" ","_",$courseEN);	
		
	$food = str_ireplace(" ","_",$food);
	$food =strtolower($food);

	if(existsRecipe($name)){
		echo 'error';
		return;
	}
	
	$base = getPrefix();
	
	$query = $base . "	
	INSERT DATA { comp:Recipe_".$name." a fo:Recipe ;
    fo:produces comp:".$food." ;
	fo:serves \"".$numberp."\" ;
	rdfs:label \"".$label."\"";
	
	
	if($cuisine != ""){
		$query= $query.". comp:Cuisine_".$cuisine." a fo:Cuisine; rdfs:label\"".$cuisineIT."\"@it , \"".$cuisineEN."\"@en.  
		comp:Recipe_".$name." fo:cuisine comp:Cuisine_".$cuisine;
	}

	if($diet != ""){
		$query = $query.". comp:Diet_".$diet." a fo:Diet; rdfs:label\"".$dietIT."\"@it , \"".$dietEN."\"@en.  
		comp:Recipe_".$name." fo:diet comp:Diet_".$diet;
	}
	
	if($occasion != ""){
		$query = $query.". comp:Occasion_".$occasion." a fo:Occasion; rdfs:label\"".$occasionIT."\"@it , \"".$occasionEN."\"@en.  
		comp:Recipe_".$name." fo:occasion comp:Occasion_".$occasion;
	}
	
	if($course != ""){
		$query = $query.". comp:Course_".$course." a fo:Course; rdfs:label\"".$courseIT."\"@it , \"".$courseEN."\"@en.  
		comp:Recipe_".$name." fo:course comp:Course_".$course;
	}

	//DA INSERIRE prepTime e cookTime
	
	$query = $query.".}";
				
	$risultati = sparqlUpdate($query);
	echo $query;
	
	
}



?>