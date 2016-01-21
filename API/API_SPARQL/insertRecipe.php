<?php
include_once dirname(__FILE__).'/../query_sparql.php';



function insertRecipe($name,$food,$numberp,$cuisine,$diet,$occasion,$course,$language)
{	
	echo ' la lingua è '.$language;

	if($language == 'en'){
	
	$nameEN = $name;
	$cuisineEN = $cuisine;
	$dietEN = $diet;
	$occasionEN = $occasion;
	$courseEN = $course;

	$nameIT = translate($name,'en','it');
	if($cuisine != ""){
	$cuisineIT = translate($cuisine,'en','it');
						}
	if($diet != ""){
	$dietIT =  translate($diet,'en','it');
					}
	if($occasion != ""){
	$occasionIT = translate($occasion,'en','it');
						}
	if($course != ""){				
	$courseIT = translate($course,'en','it');
					}

	$name = str_ireplace(" ","_",$name);
	$cuisine = str_ireplace(" ","_",$cuisine);
	$diet = str_ireplace(" ","_",$diet);
	$occasion = str_ireplace(" ","_",$occasion);
	$course = str_ireplace(" ","_",$course);

	}
	else
		if($language == 'it'){

	$nameIT = $name;
	$cuisineIT = $cuisine;
	$dietIT = $diet;
	$occasionIT = $occasion;
	$courseIT = $course;

	$nameEN = translate($name,'it','en');
	if($cuisine != ""){
	$cuisineEN = translate($cuisine,'it','en');
					}
	if($diet != ""){
	$dietEN=  translate($diet,'it','en');
					}
	if($occasion != ""){				
	$occasionEN = translate($occasion,'it','en');
						}
	if($course != ""){					
	$courseEN = translate($course,'it','en');
				 	}

	$name = str_ireplace(" ","_",$name);
	$cuisine = str_ireplace(" ","_",$cuisine);
	$diet = str_ireplace(" ","_",$diet);
	$occasion = str_ireplace(" ","_",$occasion);
	$course = str_ireplace(" ","_",$course);
	}



	$base = getPrefix();
	
	$query = $base . "	
	INSERT DATA { comp:Recipe_".$name." a fo:Recipe ;
    fo:produces comp:".$food." ;
	fo:serves \"".$numberp."\"";
	
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

	$query = $query.".}";
				
	$risultati = sparqlUpdate($query);
	echo $query;
	
	
}



?>