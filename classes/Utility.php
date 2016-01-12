<?php

//Invia un messaggio di errore al client
function sendError($messaggio) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    echo json_encode(array("error" => $messaggio));
    die('');
}

//Invia un messaggio OK al client
function sendOk($message) {
    if (is_string($message))
     //Se il messaggio è una stringa
    echo json_encode(array("success" => $message));
    else
    //altrimenti se sono risultati generici
    echo json_encode($message);
    die('');
}

//Genera una stringa casuale
function stringa_casuale($length) {
    $caratterivalidi = "abcdefghijklmnopqrstuxyvwzABCDEFGHIJKLMNOPQRSTUXYVWZ0123456789";
    $num_car_validi = strlen($caratterivalidi);
    $risultato = "";
    for ($i = 0; $i < $length; $i++) {
        $index = mt_rand(0, $num_car_validi - 1);
        $risultato.= $caratterivalidi[$index];
    }
    return $risultato;
}

//Effettua una richiesta POST a Jena
function curlRequest($command, $parameters) {
    $url = "http://localhost:8080/com.unisa.jersey.gricore/" . $command;
    //Costruisce la stringa post da passare alla cURL
    $stringapost = "";
    foreach ($parameters as $parametro => $valore) {
        if($parametro != "stringa")
			$stringapost .= "&" . $parametro . "=" . $valore;
        else
			$stringapost .= "&" . $parametro . "=" . urlencode($valore);
    }
    //Toglie il primo & dalla stringa
    $stringapost = ltrim($stringapost,"&");
    //Aggiunge l'hash segreto ai parametri ricevuti
    $stringapost .= "&hashSegreto=c296479880f651ef27ce0c9845404514";
    // Risorsa cURL
    $curl = curl_init();
    // Opzioni della richiesta
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded'),
        CURLOPT_URL => $url,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $stringapost)
    );
    // Send the request & save response to $resp
    $resp = curl_exec($curl);
    // Close request to clear up some resources
    curl_close($curl);
    return $resp;
}
//print_r(curlRequest("deleteInstance",array("nome" => "KS-4")));
/* Funzioncina per testare, decommentami
print_r(curlRequest("suggestBasic",array("tipo" => "processing"))); */
//print_r(curlRequest("addOffer",array("nomeIstanza"=>"A","tipoOfferta"=>"Hosting","stringa"=>"name=prova&so=cacca")));
?>