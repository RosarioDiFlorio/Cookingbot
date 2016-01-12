<?php
// Verifica connessione utente
require dirname(__FILE__) . "/../classes/Sessione.php";
if(!Sessione::isLoggedIn()) {
	sendError("Utente non collegato");
}
if (!isset($_POST['vecchia_pwd']) || empty($_POST['vecchia_pwd']))
    sendError("Vecchia password non inviata.");
if (!isset($_POST['nuova_pwd']) || empty($_POST['nuova_pwd']))
    sendError("Nuova password non inviata.");
if ($_POST['vecchia_pwd'] == $_POST['nuova_pwd']) {
    sendError("La nuova password non può coincidere con la vecchia.");
}
if (strlen($_POST['nuova_pwd']) < 6) {
    sendError("La password deve essere almeno di 6 caratteri.");
}
require dirname(__FILE__) . "/../classes/Database.php";
require dirname(__FILE__) . "/../classes/Utente.php";
$utente = new Utente();
try {
    $utente->prelevaDaID($_SESSION['idUtente']);
} catch (Exception $e) {
    sendError("Errore nel prelevare l'utente.");
}
//Prendo vecchio hash
$vecchia_password = $utente->getPassword();
//Verifichiamo se la password vecchia è corretta.
require dirname(__FILE__) . "/PasswordHash.php";
$t_hasher = new PasswordHash(8, FALSE);
if (!$t_hasher->CheckPassword($_POST['vecchia_pwd'], $vecchia_password)) {
    sendError("La vecchia password non è corretta.");
}
//Settiamola nell'utente se tutto ok.
$utente->impostaPassword($_POST['nuova_pwd']);
//Salviamo l'utente aggiornato nel db.
try {
    $utente->memorizza();
} catch (Exception $e) {
    sendError("Errore nel salvataggio della password.");
}
/* TODO : invio di email */
?>