<?php
include_once dirname(__FILE__).'/../query_sparql.php';



function insertSubstitution($food,$quantityResult,$arrFoodSub,$arrQuantity,$typeResult,$arrTypeResult)
{	

	$algo = "md5";
	$ingList;
	$fakeIngredient = [];
	
	
	$hvalue = abs(crc32($food));
	
	for($i=0;$i<count($arrFoodSub)-1;$i++)
	{
		if($arrFoodSub[$i] != "" && $arrFoodSub[$i] != " ")
		$hvalue += abs(crc32($arrFoodSub[$i]));
		
	}
	
	$ingList = str_ireplace(" ","_",$food) . "_" . $hvalue;

	for($i=0;$i<count($arrFoodSub)-1;$i++)
	{
		if($arrFoodSub[$i] != "" && $arrFoodSub[$i] != " ")
		$fakeIngredient[$i] = $ingList ."_".str_ireplace(" ","_",$arrFoodSub[$i]);
	}
	
	//controllo food
	insertFoodCtrlLang($food,"","","");
	for($i=0;$i<count($arrFoodSub) - 1;$i++)
	{
		insertFoodCtrlLang($arrFoodSub[$i],"","","");
	}
	//echo "query fake ingredient";
	//creazione ingrediente fake
		$base = getPrefix();
	
		$query = $base . "insert data {";
				
		for($i=0;$i<count($fakeIngredient);$i++)
		{
			
			
			$query .= "comp:".str_ireplace(" ","_",$fakeIngredient[$i])." rdf:type fo:Ingredient;
				fo:food comp:".str_ireplace(" ","_",strtolower(translate($arrFoodSub[$i],"it","en")))." ;";
				
			//aggiungo la quantità	
			if($arrTypeResult[$i] == 'unit') 
			{
				$query = $query."fo:quantity \"".$arrQuantity[$i]."\" .";
			}
			else
			{
				$arr = split(" ",$arrQuantity[$i]);
				$str = useConverterForQuantity($arr[0], $arr[1],true);
				$query .= $str;
			}
			
			/*if($arrTypeResult[$i] == 'metric') {
				$query = $query."fo:metric_quantity \"".$arrQuantity[$i]."\" .";
			}

			if($arrTypeResult[$i] == 'imperial') {
				$query = $query."fo:imperial_quantity \"".$arrQuantity[$i]."\" .";
			}*/

						
		}			
			
		$query .= "}";
		//echo $query;
		sparqlUpdate($query);
		
		
	//echo "query IngredientList";
	//creazione ingredientList
			$query = $base . "insert data { comp:".str_ireplace(" ","_",$ingList)." rdf:type fo:IngredientList ;";
			
			if($typeResult == 'unit')
			{
				$query = $query."fo:quantity \"".$quantityResult."\" ;";
			}
			else
			{
				$arr = split(" ",$quantityResult);
				$str = useConverterForQuantity($arr[0], $arr[1],false);
				$query .= $str;
			}
			
			/*if($typeResult == 'metric') {
				$query = $query."fo:metric_quantity \"".$quantityResult."\" ;";
			}

			if($typeResult == 'imperial') {
				$query = $query."fo:imperial_quantity \"".$quantityResult."\" ;";
				
			}*/
			
		
		
			for($i=0;$i<count($fakeIngredient);$i++)
			{
				
				if($i > 0)
					$query .= ";";
				
				$query .= " rdf:_".($i+1)." comp:".str_ireplace(" ","_",$fakeIngredient[$i])." ";
					
						
					
				
							
			}
			
			
			
			$query .= ". }";
			//echo "<br/>";
			// echo $query;
			sparqlUpdate($query);
			
	//fine creazione ingredientList
		
		//collego al food
			//echo "query collegamento al food";
		$query = $base . "insert data {comp:".str_ireplace(" ","_",strtolower(translate($food,"it","en")))." comp:hasSubstitution comp:".$ingList." }";
		//echo "<br/>";
		//echo $query;
		sparqlUpdate($query);
		
		
		
		//inserisco nel DB
		require_once dirname(__FILE__) . "/../../scripts/votazioni_api.php";
		$idUtente = $_SESSION['idUtente'];
		$dbConn = new VotazioniAPI();
 
		$dbConn->addSubstitution($ingList,$idUtente);
	
}


?>