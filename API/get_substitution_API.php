<?php
require dirname(__FILE__) . "/query_sparql.php";

require dirname(__FILE__) . "/../classes/Sessione.php";
require dirname(__FILE__) . "/../classes/Utility.php";

if(!Sessione::isLoggedIn()) {
sendError("Utente non collegato");
}


$food = $_POST['nameFood'];

$str = getAllSubstitutionsFood($food,"en");

$data = json_decode($str);
//print_r($data->results->bindings);
$toCicle = $data->results->bindings;
if(count($toCicle)>0)
{
			$ar = [];
			$measure = [];
			for($i = 0 ; $i<sizeof($toCicle); $i++){
				$sub = $toCicle[$i]->o->value;
				$ingredient = $toCicle[$i]->labelSub->value;
				$quantity = $toCicle[$i]->quantity->value;
				$quantityResult = $toCicle[$i]->quantityResult->value;
			
					//$ar[$sub][] = $ingredient;
				$ar[$sub][$ingredient][] = $quantity;
				$ar[$sub]['quantityResult'][] = $quantityResult;
				
				$ar[$sub][$ingredient] = array_unique($ar[$sub][$ingredient]);
				$ar[$sub]['quantityResult'] = array_unique($ar[$sub]['quantityResult']);
			}
		//$ar = array_unique($ar);
		//print_r($ar);
		$str = "";
		$rigaResult = "";
		//costruzione delle table
		$i = 1;
		foreach($ar as $value)
		{	$str .= "<div class=\"col-sm-4\">	
								<h4 class=\"heading \">substitution ".$i."</h4>";
			$str .= "<table class=\"table table-bordered\"><tr>
								<td><i class=\"fa fa-cutlery minIcon\"></i> </td>
									<td><i class=\"glyphicon glyphicon-scale minIcon\" ></i> </td>
								</tr>";
				foreach($value as $nome => $quantity)
				{		
						
						if($nome == "quantityResult")
						{
							//salvo i parametri
							$rigaResult = "<tr>";
							$rigaResult .= "<td><h4>".$nome."</h4>";
							
							$rigaResult .= "</td>";
							
							
							$rigaResult .= "<td>";
								
								
							foreach($quantity as $measure)
							{
								$rigaResult .= "".$measure."</br>";
							}
							
							$rigaResult .= "</td>";
							$rigaResult .= "</tr>";
						}else
						{	
							$str .= "<tr>";
							$str .= "<td>".$nome."";
							
							$str .= "</td>";
							
							
							$str .= "<td>";
								
								
							foreach($quantity as $measure)
							{
								$str .= "".$measure."</br>";
							}
							
							$str .= "</td>";
							$str .= "</tr>";
						}
						
						
						
				}
			$str .= $rigaResult;
			/* codice per il get del rating della sostituzione */
			
			
			
			$str .= "</table></div>";
			$i++;
		}


		echo $str;
}
else
{
	echo "<h2>this food haven't substitutions</h2><br/><button id=\"btn-add-subs\" type=\"button\" class=\"btn btn-default\"  >add one</button>";
	
}
?>