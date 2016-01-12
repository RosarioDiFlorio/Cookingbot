<?php
//Includo funzioni utility
require_once dirname(__FILE__) . '/../classes/Utility.php';
//Avvio sessione
session_start();
if (isset($_SESSION['idUtente'])) {
	require_once dirname(__FILE__) . '/../classes/Database.php';
    require_once dirname(__FILE__) . '/../classes/Sessione.php';
    $old_sess = new Sessione(); //Prendiamo la vecchia sessione
    try {
        $old_sess->getBySID($_SESSION['sid']);
		//Invalidiamo la vecchia sessione se tutto ok
		$old_sess->setHash(sha1(microtime(true) . mt_rand(10000, 90000)));
		$old_sess->save();
    } catch (Exception $e) {} //Se non esiste la sessione, fa nulla!
    session_unset();
    session_destroy();
    //Invalida cookie di autenticazione
    if (isset($_COOKIE['auth'])) {
        setcookie('auth', false, time() - 60 * 100000, '/');
    }
    header("Location: ../index.php");
    die();
    //sendOk("Logout ok");
}
else
    sendError("Non sei collegato");
?>