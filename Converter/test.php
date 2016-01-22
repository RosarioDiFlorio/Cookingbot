<?php
include_once dirname(__FILE__).'/Converter.php';

$converter = new Converter();

$arr = $converter->getAllMeasures("ml",1000);

print_r($arr);

echo "<br/>";
$arr = $converter->getAllMeasures("g",1000);

print_r($arr);


echo "<br/>";
$str = "100 ml";

$arr = split(" ",$str);

print_r($arr);

?>