<?php
// Verifica connessione utente
require dirname(__FILE__) . "/../classes/Sessione.php";
if(!Sessione::isLoggedIn()) {
	sendError("Utente non collegato");
}
if (!isset($_POST['nuova_email']) || empty($_POST['nuova_email']))
    sendError("Nuova email non inviata.");
//Prepara la row nel database per fare l'attivazione
require dirname(__FILE__) . "/../classes/Database.php";
require dirname(__FILE__) . "/../classes/Attivazione.php";
$attivazione = new Attivazione();
try { //validazione dell'email è fatto da impostaEmail
    $attivazione->impostaEmail($_POST['nuova_email']);
} catch (Exception $e) {
    sendError($e->getMessage());
}
//Prendiamo l'utente attuale
require dirname(__FILE__) . "/../classes/Utente.php";
$utente = new Utente();
try {
    $utente->prelevaDaID($_SESSION['idUtente']);
} catch (Exception $e) {
    sendError($e->getMessage());
}
//Verifichiamo se la mail immessa è identica a quella attuale.
$vecchia_email = $utente->getEmail();
if ($vecchia_email == $_POST['nuova_email']) {
    sendError("La nuova email &egrave; uguale a quella impostata attualmente.");
}
//Prepariamo l'inserimento delle informazioni per la nuova attivazione
$attivazione->impostaID($utente->getID());
$codice = stringa_casuale(15);
$attivazione->impostaCodice($codice);
try {
    $attivazione->memorizza();
} catch (Exception $e) {
    sendError($e->getMessage());
}
/* TODO : invio di email */
?>