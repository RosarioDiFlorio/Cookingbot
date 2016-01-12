<?php
	require_once dirname(__FILE__). '/../classes/Utility.php';
	require_once dirname(__FILE__). '/../classes/Database.php';
	require_once dirname(__FILE__). '/../classes/Utente.php';
	if(!isset($_POST['email']) || empty($_POST['email']))
    	sendError("Email non inviata");
	if(!isset($_POST['password']) ||  empty($_POST['password']) )
    	sendError("Password non valida");
	//Creazione nuovo utente
	try {
		$user = new Utente();
		$user->impostaEmail($_POST['email']);
		$user->impostaPassword($_POST['password']);
		$user->impostaAttivo(1);
		$user->setAdmin(0);
		$user->memorizza();
	}
	catch(Exception $e) {
		sendError($e->getMessage());
	}
	sendOk("Il tuo account è stato creato");
?>