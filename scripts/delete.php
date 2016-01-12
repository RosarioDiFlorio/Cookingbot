<?php
/*
    @author: CIRO
    Questo script verifica la sessione e permette ad un utente di eliminare un'istanza 
    PARAMETRI DA RICEVERE E VALIDARE
    @param name: nome dedicato da aggiungere

*/
require dirname(__FILE__) . "/../classes/Sessione.php";
require dirname(__FILE__) . "/../classes/Utility.php";
if(!Sessione::isLoggedIn()) {
	sendError("Utente non collegato");
}
if(!Sessione::isAdmin())
	sendError("Utente non autorizzato");
if(!isset($_POST['nomeIstanza']) || empty($_POST['nomeIstanza']))
    sendError("Nome non inviato");
print_r(curlRequest("deleteInstance",array("nome" => $_POST['nomeIstanza'])));
?>