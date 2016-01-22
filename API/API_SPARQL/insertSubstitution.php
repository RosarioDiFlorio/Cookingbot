<?php
include_once dirname(__FILE__).'/../query_sparql.php';



function insertSubstitution($food,$quantityResult,$arrFoodSub,$arrQuantity,$fakeIngredient,$ingList,$typeResult,$arrTypeResult)
{	
	//controllo food
	insertFoodCtrlLang($food,"","","");
	for($i=0;$i<count($arrFoodSub)-1;$i++)
	{
		insertFoodCtrlLang($arrFoodSub[$i],"","","");
	}
	echo "query fake ingredient";
	//creazione ingrediente fake
		$base = getPrefix();
	
		$query = $base . "insert data {";
				
		for($i=0;$i<count($fakeIngredient) - 1;$i++)
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
		echo $query;
		sparqlUpdate($query);
		
		
	echo "query IngredientList";
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
			
		
		
			for($i=0;$i<count($fakeIngredient) - 1;$i++)
			{
				
				if($i > 0)
					$query .= ";";
				
				$query .= " rdf:_".($i+1)." comp:".str_ireplace(" ","_",$fakeIngredient[$i])." ";
					
						
					
				
							
			}
			
			
			
			$query .= ". }";
			//echo "<br/>";
			echo $query;
			sparqlUpdate($query);
			
	//fine creazione ingredientList
		
		//collego al food
			echo "query collegamento al food";
		$query = $base . "insert data {comp:".str_ireplace(" ","_",strtolower(translate($food,"it","en")))." comp:hasSubstitution comp:".$ingList." }";
		echo "<br/>";
		echo $query;
		sparqlUpdate($query);
	
}


?>