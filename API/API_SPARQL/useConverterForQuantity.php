<?php
include_once dirname(__FILE__).'/../query_sparql.php';
include_once dirname(__FILE__) . '/../../Converter/Converter.php';

/*
* set the "$inserPoint" = true if you want a "." final otherwise the query end with a ;"
*/
function useConverterForQuantity($quantity, $quantityType,$insertPoint)
{
	$converter = new Converter();
	
	$arr = $converter->getAllMeasures(trim($quantityType),$quantity);
	
	if(count($arr) == 4)
	{	
		// g kg pound ounce
		$query .= "fo:metric_quantity \"".$arr['g']." g\";";
		$query .= "fo:metric_quantity \"".$arr['kg']." kg ;";
		
		$query .= "fo:imperial_quantity \"".$arr['pound']." pound\" ;";
		$query .= "fo:imperial_quantity \"".$arr['ounce']." ounce\" ";
	}
	else
	{	//ml cl l teaspoon tablespoon cup pint
		$query .= "fo:metric_quantity \"".$arr['ml']." ml\" ;";
		$query .= "fo:metric_quantity \"".$arr['cl']." cl\" ;";
		$query .= "fo:metric_quantity \"".$arr['l']." l\" ;";
		$query .= "fo:imperial_quantity \"".$arr['teaspoon']." teaspoon\" ;";
		$query .= "fo:imperial_quantity \"".$arr['tablespoon']." tablespoon\" ;";
		$query .= "fo:imperial_quantity \"".$arr['cup']." cup\";";
		$query .= "fo:imperial_quantity \"".$arr['pint']." pint\"";
	}	
	if($insertPoint)
		$query .= " .";
	else
		$query .= " ;";
	

	return $query;
}

?>