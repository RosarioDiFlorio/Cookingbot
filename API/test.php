<?php
require dirname(__FILE__) . "/query_sparql.php";
include_all_php("/API_SPARQL");

// $results=getRecipesByWords("banana","","","","",0);
// $data = json_decode($results);
	// //print_r($data->results->bindings);
	// $toCicle = $data->results->bindings;
	// for($i = 0 ; $i<sizeof($toCicle); $i++){
		// $count[$i] = $toCicle[$i]->count->value;
		// if($count[$i]== 0) {echo 'Sorry no matching found! :(';
		// return ;
							// }
		// $recipe[$i] = $toCicle[$i]->recipe->value;
		// $recipename = split("#",$recipe[$i]);
	// echo '<strong>Recipe Name:</strong> '.$recipename[1] ."<br>";
		// $results2 = getRecipeInfo($recipename[1],"it");
		// $data2 = json_decode($results2);
		// $info = $data2->results->bindings;
		// echo $info[0]->cooktime->value;
			// echo $info[0]->preptime->value;
	// }
	
	
	$result = getPossibleSubstitutions("acqua");
	 $json_output = json_decode($result, true);        
	foreach ($json_output as $trend){         
		print_r($trend);     
	} 
?>