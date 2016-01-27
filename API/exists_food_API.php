<?php
require dirname(__FILE__) . "/query_sparql.php";

require dirname(__FILE__) . "/../classes/Sessione.php";
require dirname(__FILE__) . "/../classes/Utility.php";
/*
if(!Sessione::isLoggedIn()) {
sendError("Utente non collegato");
}*/


$label = $_POST['nameFood'];
/*$label = "apples";
echo existsFoodLabel($label,"en");
echo existsFoodLabel($label,"it");
*/
$str = existsFoodLabel($label,"en");

if(!$str)
{
	echo existsFoodLabel($label,"it");
	
}else{
	
 echo true;	
}


?>