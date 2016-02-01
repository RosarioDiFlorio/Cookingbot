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
if(isset($_POST['offset'])){
	$offset = strtolower((trim($_POST['offset'])));
}

$subIDResult = getPossibleSubstitutions($input);
$subIDdata = json_decode($subIDResult);
	//print_r($data->results->bindings);
	$toCicle = $subIDdata->results->bindings;
	$subID = [];
	$matches = [];
	
	echo "<div class=\"bs-component well\">";
	echo "<form action=\"\"> <fieldset>";
	echo "<table style=\"width:100%\">";
	for($i = 0 ; $i<sizeof($toCicle); $i++){
		//print_r($toCicle[$i]->label->value);
		echo "<tr>";
		
		$matches[$i] = $toCicle[$i]->matches->value;
		if($matches[$i]== 0) {echo 'Sorry no matching found! :(';
		return ;
							}
		$subID[$i] = $toCicle[$i]->substitute->value;
		
		$subFoodResult = getSubstitutionResult($subID[$i],$lang,$solid,$liquid);
		$subFoodData = json_decode($subFoodResult);
		$info = $subFoodData->results->bindings;
		if(!array_key_exists("0",$info)){
			continue;
		}
		$result = $info[0]->result->value;
		$quantity = $info[0]->quantity->value;
		
		//RECIPE DETAILS
		echo "<td>";
		$j=$i+1;
		echo '<b>Substitution '.$j."</b><br><b>Matches:</b> ".$matches[$i]." <br>";
		echo '<b>Produces:</b> '.$result.', '.$quantity;
		echo '<br><b>Requires:</b><br>';
		
		$subIngResult = getSubstitutionIngredients($subID[$i],$lang,$solid,$liquid);
		$subIngdata = json_decode($subIngResult);
		//print_r($data->results->bindings);
		$toCicle2 = $subIngdata->results->bindings;
		$subIng = [];
		$subIngqua = [];
		if(!array_key_exists("0",$toCicle2)){
			echo "SOMETHING WENT WRONG";
			continue;
		}
		for($y = 0 ; $y<sizeof($toCicle2); $y++){
			$subIng[$y] = $toCicle2[$y]->ingredient->value;
			$subIngqua[$y] = $toCicle2[$y]->quantity->value;
			echo $subIng[$y].", ".$subIngqua[$y]."<br>";
		}
		echo "</td>";
		echo "<td>";
		echo '<input type="checkbox" name="'.$subID[$i].'" value="'.$subID[$i].'"/>';
		echo "</td>";

	}
	echo "</fieldset></form>";
	echo "</table>";
	echo '</div>';
?>