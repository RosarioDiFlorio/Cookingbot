<?php
	require_once dirname(__FILE__). '/../../classes/Sessione.php';
	if(Sessione::isLoggedIn(true)) {
		echo "Utente loggato. Stampo status della sessione: <br />";
		print_r($_SESSION);
	}
	else
		echo "Utente non collegato";
?>