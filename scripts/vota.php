<?php
/*
    @author: CIRO RAGONE - Mario Villani
    Questo script verifica la sessione e permette ad un utente di aggiungere un'istanza di tipo Hosting
    PARAMETRI DA RICEVERE E VALIDARE
    @param name: nome dedicato da aggiungere

*/
require dirname(__FILE__) . "/../classes/Sessione.php";
require dirname(__FILE__) . "/../classes/Utility.php";
if(!Sessione::isLoggedIn()) {
	sendError("Utente non collegato");
}
if(!isset($_POST['nomeIstanza']) || empty($_POST['nomeIstanza']))
    sendError("Nome non inviato");
if(!isset($_POST['Voto']) || !is_float(floatval($_POST['Voto'])))
    sendError("Voto non valido");
if(!isset($_POST['Commento']) || empty($_POST['Commento']))
    sendError("Commento non valido");
require dirname(__FILE__) . "/../classes/Utente.php";
//Fetch della classe utente
try {
    $usr = new Utente();
}
catch(Exception $e) {
    die("Errore nel fetch");
}
//Pulizia caratteri anti XSS
$_POST['Commento'] = stripslashes(addslashes($_POST['Commento']));
//TODO : check email
print_r(curlRequest("voteOffer",array("nomeIstanza" => $_POST['nomeIstanza'],"voto" => $_POST['Voto'],"commento" => $_POST['Commento'],"idUser" => $_SESSION['email'],"emailUser" => $_SESSION['email'])));


//commento spam

?>