<?php
include('Wrapper.php');
include('/../../API/query_sparql.php');
$scraping = new Wrapper();
set_time_limit(0);


$url = "http://www.caloriealimenti.org/";
$pathRules = 'rules_link_ingredienti.xsl';
$str = $scraping->getData($url,$pathRules);


//echo $str;


$dom = new DOMDocument;
$dom->loadXML($str);
$td = $dom->getElementsByTagName('td');


$i = 0;

while($i < $td->length)
{
	$shopping = $td->item($i)->nodeValue;
	$link =  $td->item($i+1)->nodeValue;
	
	
	echo $shopping . " <br>";
	//echo $link . " <br>";
	
	$shopping =  utf8_decode($shopping);
	
	//funzione per inserire shopping category
	insertShoppingCategory($shopping);
	
	$url = $link;
	$pathRules = 'rules_link_ingredienti_sezione.xsl';
	$str = $scraping->getData($url,$pathRules);
	$str =  utf8_decode($str);
	
	$dom = new DOMDocument;
	$dom->loadXML($str);
	$sub_td = $dom->getElementsByTagName('td');
	$k = 0;
	while($k < $sub_td->length)
	{
		$food = $sub_td->item($k)->nodeValue;
		$kilocal = $sub_td->item($k+2)->nodeValue;
		$kilojaul = $sub_td->item($k+3)->nodeValue;
		echo $food . "<br>";
		//echo $kilocal . "<br>";
		//echo $kilojaul . "<br>";
		
		$food =  utf8_decode($food);
		$kilocal =  utf8_decode($kilocal);
		$kilojaul =  utf8_decode($kilojaul);
		
		//funzione per inserire food
		insertFoodCtrlLang($food,$kilocal,$kilojaul,$shopping);
		
		
		$k = $k + 4;
		
	}
	
	$i = $i + 2;
	
	
}

echo "DONE";


/*
$i = 0;



$pattern = array();
$pattern[0] = ",";
$pattern[1] = "with";
$pattern[2] = "and";

foreach ($tr as $el) 
{
	//echo $el->nodeValue, PHP_EOL;
	
	if($i > 0)
	{
		$a = $el->getElementsByTagName('td');
		$ingrediente = $a->item(0)->nodeValue;//ingrediente da sostituire
		$quantità = $a->item(1)->nodeValue;//quantità che ne verrà fuori
		$listaSostituti = trim($a->item(2)->nodeValue);//ingredienti che possono sostituire l'ingrediente
		//echo $listaSostituti . "<br>";
		
		$arr = split("OR",$listaSostituti);
		//print_r($arr);
		
		$rep = array();
		$rep[0] = ",";
		$rep[1] = "plus";
		$rep[2] = "enough";
		foreach($a as $arr)
		{
			$stIng = split(" ",$a); 
			print_r($stIng);
		}
		//se la prima lettera è un numero allora è una quantità, altrimenti vado avanti perchè saranno parole tipo "mix" o "combine"
		
		
		//print_r($arr);
		echo "<br>";
		$arr = null;
	}
	
	$i++;
}


*/



?>