<?php
include_once dirname(__FILE__).'/../function_scraping.php';
ini_set('default_charset', 'utf-8');

class Wrapper
{

	function getData($url,$pathRules)
	{
		
		$webS = new WebScraper();
		
		$result = $webS->scraping($url,$pathRules,false);
		return $result;
	}
}
?>