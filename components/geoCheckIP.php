<?php

$ipaddress = $_SERVER['REMOTE_ADDR'];
function geoCheckIP($ip)
{
    $response=@file_get_contents('http://www.netip.de/search?query='.$ip);

    $patterns=array();
    $patterns["country"] = '#Country: (.*?)&nbsp;#i';

    $ipInfo=array();

    foreach ($patterns as $key => $pattern)
    {
        $ipInfo[$key] = preg_match($pattern,$response,$value) && !empty($value[1]) ? $value[1] : 'not found';
    }

        return $ipInfo;
}

//output =>   Array ( [country] => DE - Germany )  // Full Country Name

function getCountryCodeFromIP($ip = "")
{	
	if($ip == "")
	$ip = $_SERVER['REMOTE_ADDR'];
	
	$arr = geoCheckIP($ip);
	
	$str = substr($arr['country'],0,2);
	
	/*if($str != "IT") return "EN";
	return $str;*/
	
	//per debug forzo la lingua italiana
	return "IT";
}

//test ip italiano
// echo getCountryCodeFromIP("93.45.67.16");

?>