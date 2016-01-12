<?php
/*
	@author: Mario Villani
	Questo script verifica la sessione e permette ad un utente di commentare una istanza.
	PARAMETRI DA RICEVERE E VALIDARE
	@param Email: email dell'utente votante
	@param ID: id dell'utente votante
	@param Voto: numerico da 1 a 5
	@param Commento: stringa, il commento
*/
// Verifica connessione utente
require dirname(__FILE__) . "/../classes/Sessione.php";
require dirname(__FILE__) . "/../classes/Utility.php";
if(!Sessione::isLoggedIn()) {
	sendError("Utente non collegato");
}
/*
    TODO - validare i parametri
    Dopodiché, fare la richiesta a Jena tramite la funzione utility curlRequestJena passando i parametri
    ricevuti e validati.
*/
?>