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
$lang = $_POST['lang'];
$str = getAllSubstitutionsFood($food,strtolower($lang));

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
		{	$str .= "<div class=\"col-sm-12 well\">	
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
			$str .= "<h3>Rating</h3>";
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
					$strlang;
					if($lang == "IT")$strlang = "Hai già votato questa sostituzione";
					else $strlang = "You have already rated this substitution";
					$str .= ' <input type="number" id="'.$sostituzione.'" value = '.$voto.'  class="rating" min=0 max=5 step=1 data-size="xs" data-rtl="false" readonly><label for="comment">'.$strlang.'</label>';

				}
				else
				{
					$str .= '<input type="number"  id="'.$sostituzione.'"  value = '.$voto.' class="rating" min=0 max=5 step=1 data-size="xs" data-rtl="false" >';

				}
			}else{
				$strlang;
				if($lang == "IT")$strlang = "Devi essere autenticato per poter votare  (clicca <a href=\"login.php\">qui</a> per effetuare il login)";
				else $strlang = "you must be logged in to send your vote (click <a href=\"login.php\">here</a> for login)";
				$str .= ' <input type="number" id="'.$sostituzione.'" value = '.$voto.'  class="rating" min=0 max=5 step=1 data-size="xs" data-rtl="false" readonly><label for="comment">'.$strlang.'</label>';
				
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
	$strlang = "";
	if($lang == "IT")$strlang = "Questo alimento non ha sostituzioni";
	else $strlang = "this food has no substitutions";
	$str = "<h3>".$strlang."</h3><br/>";
	
	if($isLoggin)
	{
		$strlang = "";
		if($lang == "IT")$strlang = "aggiungine una";
		else $strlang = "add one";
	
		$str .= "<button id=\"btn-add-subs\" onClick=\"addSubstitution('".$food."');\"  type=\button\" class=\"btn btn-info\">".$strlang."</button>";
	}
	else
	{
		$strlang = "";
		if($lang == "IT")$strlang = "devi essere autenticato per poter aggiungere sostituzioni (clicca <a href=\"login.php\">qui</a> per effetuare il login)";
		else $strlang = "you must be logged in to add a substutition(click <a href=\"login.php\">here</a> for login)";
		$str .= '<label for="comment">'.$strlang.'</label>';
	}
	
	echo $str;
}
?>