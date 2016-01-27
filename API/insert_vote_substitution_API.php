<?php

require_once dirname(__FILE__) . "/../scripts/votazioni_api.php";
require_once dirname(__FILE__) . "/../classes/Sessione.php";
require_once dirname(__FILE__) . "/../classes/Utility.php";
/*
if(!Sessione::isLoggedIn()) {
sendError("Utente non collegato");
}
*/
$loggedin = Sessione::isLoggedIn(true);
$votazioniAPI = new VotazioniAPI();	
$nomeSub;
$voto;
if(!empty($_POST)){
	
	if(isset($_POST['nomeSub']))
		$nomeSub = $_POST['nomeSub'];
	if(isset($_POST['voto']))
		$voto = $_POST['voto'];
		
	

	//$voto = "3";
	
	$idUtente = $_SESSION['idUtente'];
	$sub = $votazioniAPI->getSubstitution($nomeSub);
	$idSub = $sub['id_sub'];
	$votazioniAPI->addSubstitutionVote($idUtente, $idSub,$voto);

}
?>