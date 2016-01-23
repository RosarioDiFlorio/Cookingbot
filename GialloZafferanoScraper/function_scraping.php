<?php
class WebScraper
{

	var $toReplace = null;

function setReplacer($arr){
	$this->toReplace = $arr;
}

function scraping($url,$surceRules,$showWarnings){
// Specifico la configurazione 
$config = array('output-xhtml' => true, 'clean' => true, 'wrap-php' => true , 'indent' => true);
// Istanzio un oggetto tidy e richiedo il documento html da trasformare
$tidy = new tidy;
$tidy = tidy_parse_file($url, $config);
//echo $tidy;
// Pulizia dell'ouput
$strClean = $tidy;
if($this->toReplace != null){
foreach($this->toReplace as $str){
$strClean = str_replace($str,"",$strClean);	
}
}
//applicazione delle regole xsl al documento xhtml
$xsl = new DOMDocument;
$xsl->load($surceRules);

// Configurazione del trasformer
$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl); // attach the xsl rules

// enable user error handling
if(!$showWarnings)libxml_use_internal_errors(true);

// Carico il documento
$toReturn = new DOMDocument;

$toReturn->loadHTML($strClean);
$toReturn->saveHTML();

$str =  $proc->transformToXML($toReturn);

//ritorno il risultato
return $str;
}





function scrapingGetContent($url,$surceRules,$showWarnings){
// Specify configuration

$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
$context = stream_context_create($opts);
$header = file_get_contents($url,false,$context);


$config = array('output-xhtml' => true, 'clean' => true, 'wrap-php' => true , 'indent' => true);
// Tidy
$tidy = new tidy;

//$tidy = tidy_parse_file($url, $config);
$tidy->parseString($header, $config, 'utf8');
$tidy->cleanRepair();
// Output
//echo $tidy;

$strClean = $tidy;
if($this->toReplace != null){
foreach($this->toReplace as $str){
$strClean = str_replace($str,"",$strClean);	
}
}

$xsl = new DOMDocument;
$xsl->load($surceRules);

// Configure the transformer
$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl); // attach the xsl rules


// enable user error handling
if(!$showWarnings)libxml_use_internal_errors(true);

$toReturn = new DOMDocument;
$toReturn->loadHTML($strClean);
$toReturn->saveHTML();

$str =  $proc->transformToXML($toReturn);

//echo $str;
return $str;
}

    
}


?>