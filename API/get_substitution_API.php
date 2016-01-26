<?php
require dirname(__FILE__) . "/query_sparql.php";

require dirname(__FILE__) . "/../classes/Sessione.php";
require dirname(__FILE__) . "/../classes/Utility.php";

require_once dirname(__FILE__) . "/../scripts/votazioni_api.php";

//inizializzo la classe per connettermi alle tabelle delle votazioni_api
$dbConn = new VotazioniAPI();
/*
if(!Sessione::isLoggedIn()) {
sendError("Utente non collegato");
}*/
$isLoggin = false;
if(Sessione::isLoggedIn())
{
	$isLoggin = true;
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
		{	$str .= "<div class=\"col-sm-12\">	
								<h4 class=\"heading \">substitution ".$i ."</h4>";
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
							$rigaResult .= "<td><h3>".$nome."</h3>";
							
							$rigaResult .= "</td>";
							
							
							$rigaResult .= "<td>";
								
								
							foreach($quantity as $measure)
							{
								$rigaResult .= " <div class=\"col-sm-2\"> ".$measure." </div> ";
							}
							
							$rigaResult .= "</td>";
							$rigaResult .= "</tr>";
						}else
						{	
							$str .= "<tr>";
							$str .= "<td><h3>".$nome."</h3>";
							
							$str .= "</td>";
							
							
							$str .= "<td>";
								
								
							foreach($quantity as $measure)
							{
								$str .= " <div class=\"col-sm-2\"> ".$measure." </div> ";
							}
							
							$str .= "</td>";
							$str .= "</tr>";
						}
						
						
						
				}
			$str .= $rigaResult;
			/* codice per il get del rating della sostituzione */
			
			$str .= "<tr>";
			$str .= "<td>";
			$str .= "<h3>Voto</h3>";
			$str .= "</td>";
			$str .= "<td>";
			
			
			/* prendo la sostituzione dal db per conoscerne la votazione */
			
			$sostituzione = substr($toCicle[$i-1]->o->value,strpos($toCicle[$i-1]->o->value,"#")+1,strlen($toCicle[$i-1]->o->value));
			//echo $sostituzione;
			
			

			$arrSub = $dbConn->getSubstitution($sostituzione);
			//print_r($arrSub);
			$voto = $dbConn->getSubstitutionVote($arrSub['id_sub']);
			//echo $voto;
			if($isLoggin) 
			{
				/* controllo se l'utente ha già votato */
				if( $dbConn->hasVotingSub($_SESSION['idUtente'],$arrSub['id_sub']))
				{
					$str .= ' <input type="number" id="'.$sostituzione.'" value = '.$voto.'  class="rating" min=0 max=5 step=1 data-size="xs" data-rtl="false" readonly><label for="comment">You have already rated this substitution</label>';

				}
				else
				{
					$str .= '<input type="number"  id="'.$sostituzione.'"  value = '.$voto.' class="rating" min=0 max=5 step=1 data-size="xs" data-rtl="false" >';

				}
			}else{
				$str .= ' <input type="number" id="'.$sostituzione.'" value = '.$voto.'  class="rating" min=0 max=5 step=1 data-size="xs" data-rtl="false" readonly><label for="comment">you must be logged in to send your vote (click <a href="login.php">here</a> for login)</label>';
				
			}
			
			$str .= "</td>";
			$str .= "</tr>";
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