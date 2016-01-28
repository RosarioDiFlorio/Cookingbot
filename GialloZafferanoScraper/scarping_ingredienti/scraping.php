<?php
require dirname(__FILE__) . "/../../API/query_sparql.php";
include_all_php("../../API/API_SPARQL");
include('Wrapper.php');





$fd = fopen("ricette_giallozafferano.txt","r");
///*
$k =1;
while (!feof($fd)) {
	$ricetta = trim(fgets($fd));
	if($ricetta != ""){
		$res = getDataRecipe($ricetta);
		if($res == 1) {
			echo $k."<br>";
			$k++;
		}
	}
	}
//*/
/*
$ricetta = trim(fgets($fd));
$res = getDataRecipe($ricetta);
//*/

function getTimesRecipe($url){
	
}

function getDetailsRecipe($url){
	$scraping = new Wrapper();
	set_time_limit(0);
	$pathRules = 'rules_data_recipes.xsl';
	$str = $scraping->getData($url,$pathRules);
	$dom = new DOMDocument;
	$dom->loadXML($str);
	echo $str;
	
	$nomericetta = $dom->getElementsByTagName("h1")->item(0)->nodeValue;
	$nomericetta = formatString($nomericetta);
	//echo $nomericetta;
	if(sizeof($nomericetta) == 0)
		return -1;
	$course = $dom->getElementsByTagName("h2")->item(0)->nodeValue;
	$course = formatString($course);
	//echo $course;
	
	$persone = $dom->getElementsByTagName("h3")->item(0)->nodeValue + 0;
	$persone = formatString($persone);
	//echo $persone;
	if(sizeof($persone) == 0)
		return -1;
	
	
	$ing_list = [];
	$log = fopen("log.txt","a+");
	$tocycle = $dom->getElementsByTagName("h4");
	$j = 0;
	
	for($i = 0;$i<$tocycle->length;$i = $i+2){
		$nomeIng = $tocycle->item($i)->nodeValue;
		$nomeIng = formatString($nomeIng);
		//echo $nomeIng;
		$ing_list[$j]['nome'] = $nomeIng;
		
		
		$quantitaIng = $tocycle->item($i+1)->nodeValue;
		$quantitaIng = formatString($quantitaIng);
		$quantitaIng = str_replace($nomeIng," ",$quantitaIng);
		$quantitaIng = str_replace("gr","g",$quantitaIng);
		$quantitaIng = str_replace(",","",$quantitaIng);
		$quantitaIng = str_replace("cucchiaino","teaspoon",$quantitaIng);
		$quantitaIng = str_replace("cucchiaini","teaspoon",$quantitaIng);
		$quantitaIng = str_replace("cucchiaio","tablespoon",$quantitaIng);
		$quantitaIng = str_replace("cucchiai","tablespoon",$quantitaIng);
		$quantitaIng = str_replace("tazza","cup",$quantitaIng);
		$quantitaIng = str_replace("tazze","cup",$quantitaIng);
		$quantitaIng = trim($quantitaIng);
		$quantitaIng = str_replace('"',"",$quantitaIng);
		//echo $quantitaIng;
		$patternForma ='/^[a-zA-Z].*[a-zA-Z] (00\'\')|^[a-zA-Z].*[a-zA-Z] (00\")|^[a-zA-Z].*[a-zA-Z] (00)|^[a-zA-Z].*[a-zA-Z] /';

		preg_match($patternForma,$quantitaIng,$matches);
		
		if(sizeof($matches)!=0){
			$forma  = $matches[0];
			
			//print_r($matches);
			//echo $forma;
			//fwrite($log,$forma."\n");
		}else{
			$forma = "";
		}
		$ing_list[$j]['forma'] = $forma;
		//print_r($ing_list);
		
		$j++;
	}
	if(sizeof($ing_list) == 0)
		return -1;
	
	
	$tocycle = $dom->getElementsByTagName("h5");
	$step_list = [];
	$str = "";
	for($i = 0;$i<$tocycle->length-3;$i++){
		$step = $tocycle->item($i)->nodeValue;
		$str = $str."".$step;
		
	}
	$step_list = array_filter(explode(".",$str));
	if(sizeof($step_list) == 0)
		return -1;
	
	
	foreach($ing_list as $value){
		//insertDetailIngredientRecipe($value['forma'],$value['nome'],$nomericetta,"it");	
		echo $value['forma']."<br>";
	}
	
	return 1;
	
	
	
}


function getDataRecipe($url){
	$scraping = new Wrapper();
	set_time_limit(0);
	
	$pathRules = 'rules_data_recipes.xsl';
	$str = $scraping->getData($url,$pathRules);
	$dom = new DOMDocument;
	$dom->loadXML($str);
	
	
	
	//echo $str;
	
	$nomericetta = $dom->getElementsByTagName("h1")->item(0)->nodeValue;
	$nomericetta = formatString($nomericetta);
	//echo $nomericetta;
	if(sizeof($nomericetta) == 0)
		return -1;
	$course = $dom->getElementsByTagName("h2")->item(0)->nodeValue;
	$course = formatString($course);
	//echo $course;
	
	$persone = $dom->getElementsByTagName("h3")->item(0)->nodeValue + 0;
	$persone = formatString($persone);
	//echo $persone;
	if(sizeof($persone) == 0)
		return -1;
	
	$prepTime = $dom->getElementsByTagName("h6")->item(0)->nodeValue;
	$prepTime = formatString($prepTime);
	
	$cookTime = $dom->getElementsByTagName("h7")->item(0)->nodeValue;
	$cookTime = formatString($cookTime);
	
	$ing_list = [];
	$log = fopen("log.txt","a+");
	$tocycle = $dom->getElementsByTagName("h4");
	$j = 0;
	
	for($i = 0;$i<$tocycle->length;$i = $i+2){
		$nomeIng = $tocycle->item($i)->nodeValue;
		$nomeIng = formatString($nomeIng);
		//echo $nomeIng;
		$ing_list[$j]['nome'] = $nomeIng;
		
		
		$quantitaIng = $tocycle->item($i+1)->nodeValue;
		$quantitaIng = formatString($quantitaIng);
		$quantitaIng = str_replace($nomeIng," ",$quantitaIng);
		$quantitaIng = str_replace("gr","g",$quantitaIng);
		$quantitaIng = str_replace(",","",$quantitaIng);
		$quantitaIng = str_replace("cucchiaino","teaspoon",$quantitaIng);
		$quantitaIng = str_replace("cucchiaini","teaspoon",$quantitaIng);
		$quantitaIng = str_replace("cucchiaio","tablespoon",$quantitaIng);
		$quantitaIng = str_replace("cucchiai","tablespoon",$quantitaIng);
		$quantitaIng = str_replace("tazza","cup",$quantitaIng);
		$quantitaIng = str_replace("tazze","cup",$quantitaIng);
		$quantitaIng = trim($quantitaIng);
		$quantitaIng = str_replace('"',"",$quantitaIng);
		//echo $quantitaIng;
		$patternForma ='/^[a-zA-Z].*[a-zA-Z] (00\'\')|^[a-zA-Z].*[a-zA-Z] (00\")|^[a-zA-Z].*[a-zA-Z] (00)|^[a-zA-Z].*[a-zA-Z] /';

		preg_match($patternForma,$quantitaIng,$matches);
		
		if(sizeof($matches)!=0){
			$forma  = $matches[0];
			
			//print_r($matches);
			//echo $forma;
			//fwrite($log,$forma."\n");
		}else{
			$forma = "";
		}
		$ing_list[$j]['forma'] = $forma;
		//print_r($ing_list);
		
		
		$pattern = '/ 00 |^00 | 00\' \'| 00\'\'| 00\"|^00\' \'|^00\'\'|^00\"/';
		preg_match($pattern,$quantitaIng,$matches);
		if(sizeof($matches) != 0){
			$quantitaIng = str_replace($matches[0]," ",$quantitaIng);
		}
		
		
		if($forma != ""){
			$quantitaIng = str_replace($forma,"",$quantitaIng);
		}
		//fwrite($log,$forma ." -- ".$quantitaIng."\n");
		$patternQuantita= '/[0-9].*/';
		preg_match($patternQuantita,$quantitaIng,$matches);
		//print_r($matches);
		
		$tipo = "";
		$quantita="";
		if(sizeof($matches)!=0){
			//print_r($matches);
			$quantita = $matches[0];
			$quantita = formatString($quantita);
			
			$a = explode(" ",$quantita);
			$quantita = trim($a[0]);
			$quantita = str_replace(")","",$quantita);
			$quantita = str_replace("00\"","",$quantita);
			$quantita = str_replace("00''","",$quantita);
			$t = explode("-",$quantita);
			if(sizeof($t) != 0){
				$quantita = $t[0];
			}
			
			
			if(sizeof($a)>1){
				$tipo = trim($a[1]);
				$tipo = str_replace(")","",$tipo);
				if($tipo != "g" && $tipo != "kg" &&
				$tipo != "ounce" && $tipo != "pound" &&
				$tipo != "ml" && $tipo != "cl" &&
				$tipo != "l" && $tipo != "teaspoon" &&
				$tipo != "tablespoon" ||$tipo == "cup" &&
				$tipo != "pint"){
					
					$tipo = "unit";
				}
			}else{
							
				$tipo = "unit";
			}
			
		}
		//fwrite($log,$forma." ----- ".$quantita."---".$tipo."\n");
		
		$ing_list[$j]['quantita'] = trim($quantita);
		$ing_list[$j]['tipo'] = trim($tipo);
		
		
		
		$j++;
	}
	//print_r($ing_list);
	if(sizeof($ing_list) == 0)
		return -1;
	
	$tocycle = $dom->getElementsByTagName("h5");
	$step_list = [];
	$str = "";
	for($i = 0;$i<$tocycle->length-3;$i++){
		$step = $tocycle->item($i)->nodeValue;
		$step = formatString($step);
		$pattern = '/\(.[0-9]?\)/';
		preg_match_all($pattern,$step,$matches);
		//print_r($matches);
		foreach($matches as $value){
			$step = str_replace($value,"",$step);
		}
		$pattern = '/\((per .* cliccate qui)\)/';
		preg_match_all($pattern,$step,$matches);
		foreach($matches as $value){
			$step = str_replace($value,"",$step);
			
		}
		$str = $str."".$step;
		
	}
	//echo $str;
	$step_list = array_filter(explode(".",$str));
	//print_r($step_list);
	if(sizeof($step_list) == 0)
		return -1;
	//print_r($ing_list);
/*
	$del = "-----------------------------------------";
	$fd = fopen("newdatiricette.txt","a+");
	fwrite($fd,$del."\n");
	fwrite($fd,"NOME RICETTA: ".$nomericetta."\n");
	fwrite($fd,"TIPOLOGIA: ".$course."\n");
	fwrite($fd,"PERSONE CONSIGLIATE: ".$persone."\n");
	fwrite($fd,"INGREDIENTI: ".sizeof($ing_list)."\n");
	$i=1;
	foreach($ing_list as $value){
		fwrite($fd,$i."  NOME: ".$value['nome']);
		fwrite($fd,"  FORMA: ".$value['forma']);
		fwrite($fd,"  QUANTITA: ".$value['quantita']);
		fwrite($fd,"  TIPO: ".$value['tipo']."\n");
		$i++;
	}
	$i=1;
	foreach($step_list as $value){
		fwrite($fd,"STEP".$i.": ".$value."\n");
		$i++;
	}
	
*/

//insertRecipe($nomericetta,$nomericetta,$persone,"","","",$course,"it");
insertPrepTimeRecipe($prepTime,$nomericetta);
insertCookTimeRecipe($cookTime,$nomericetta);
$i=1;
$mis="";
$unit="";
	foreach($ing_list as $value){
	if(trim($value['tipo']) == "unit"){
		$mis = "unit";
		$unit = "unit";
	}else if(trim($value['tipo']) == "teaspoon" || trim($value['tipo']) =="tablespoon" ||trim($value['tipo'])== "cup"){
		$mis = "imperial";
		$unit = trim($value['tipo']);
		
	}else{
		
		$mis = "metric";
		$unit = trim($value['tipo']);
	}

	insertIngredient($value['nome'],$value['forma'],$value['quantita'],$unit,$mis,$nomericetta,$i,"it");	
	//echo $value['nome']."<br>";
	//echo $value['quantita']."<br>";
	//echo $unit."<br>";
}

$i =1;
foreach($step_list as $value){
	//insertStep($i,utf8_decode($value),$nomericetta);	
	$i++;
}


return 1;
	

	
}




function formatString($str){
	
	
	$str = str_replace("\n","",$str);
	$str = str_replace("<br>","",$str);
	$a = array_filter(explode(" ",$str));
	$str = implode(" ",$a);
	return $str;
}








?>