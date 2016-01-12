<?php
	/* Database configuration */
	$db_host = "localhost";
	$db_username = "root";
	$db_password = '';
	$db_nome = 'griweb';
	/* Non modificare oltre questo punto!*/

	//Risorsa DB comune
	$conn = null;
    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_nome", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Errore nello stabilire una connessione al database: " . $e->getMessage());
    }
?>