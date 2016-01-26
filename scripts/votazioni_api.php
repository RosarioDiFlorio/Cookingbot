<?php
require_once dirname(__FILE__) . "/dbconn.php";
require_once dirname(__FILE__) . "/../classes/Sessione.php";
require_once dirname(__FILE__) . "/../classes/Utility.php";


class VotazioniAPI{
	
	private $db;
	private $sessione;
	
	function __construct(){
		$this->db = new Connection();
		$this->sessione = new Sessione();
		
	}  
	/*--------------------------------------------------------------------------------------------------------------------------------------------------------
	RICETTE
	---------------------------------------------------------------------------------------------------------------------------------------------------
	*/
	
	/*  */
	public function addRecipe($nomeRicetta,$idUtente){
			
		if(sizeof ($this->getRecipe($nomeRicetta))== 0){
			$query ="INSERT INTO ricette (id_ricetta, nome_ricetta, id_utente) VALUES (NULL, '".$nomeRicetta."','".$idUtente."') ";
			$this->db->query($query,0);
		}
	}

	public function getAllRecipe(){
		
		$query ="SELECT * FROM ricette ";
		$result = $this->db->query($query,1);
		return $result;
	}

	public function getRecipe($nomeRicetta){
			
			$query = "SELECT * FROM ricette WHERE nome_ricetta = '".$nomeRicetta."' ";
			$result  = $this->db->query($query,1);
			return $result[0];

		}

	public function addRecipeVote($idUtente, $idRicetta, $voto){
		//$idUtente = $this->sessione->getUid();
		if(!($this->hasVotingRecipe($idUtente,$idRicetta))){
			$query ="INSERT INTO votazioni_ricette (id_votazione_ric, id_utente, id_ricetta, voto) VALUES (NULL, '".$idUtente."', '".$idRicetta."', '".$voto."') ";
			$this->db->query($query,0);
		}
		
	}

	public function  getRecipeVote($idRicetta){
		$query = "SELECT * FROM votazioni_ricette WHERE id_ricetta = '".$idRicetta."'";
		$result = $this->db->query($query,1);
		$count = 0;
		$vote = 0;
		foreach ($result as $value){
			$vote = $vote + $value['voto'];
			$count++;
		}
		
		$vote = $vote / $count;
		return ceil($vote);
	}

	public function hasVotingRecipe($idUtente, $idRicetta){
		//$ricetta = $this->getRecipe($nomeRicetta);
		//$idRecipe = $ricetta['id_ricetta'];
		$query = "SELECT * FROM votazioni_ricette WHERE id_ricetta = '".$idRicetta."' AND id_utente = '".$idUtente."'";
		$result = $this->db->query($query,1);
		//print_r($result);
		if(sizeof($result)!= 0)return true;
		else return false;
	}

	/*-----------------------------------------------------------------------------------------------------------------------------------------------------
	SOSTITUZIONI
	-------------------------------------------------------------------------------------------------------------------------------------------------------
	*/

	public function addSubstitution($nomeSub,$idUtente){
		if(  sizeof( $this->getSubstitution( $nomeSub)) == 0    ){
		
			$query="INSERT INTO sostituzioni (id_sub, nome_sub, id_utente)
			VALUES(NULL,'".$nomeSub."', '".$idUtente."')";
			$this->db->query($query,0);
							
		}
	}



	public function getAllSubstitution(){
		
		$query ="SELECT * FROM sostituzioni";
		$result = $this->db->query($query,1);
		return $result;
		
	}

	public function getSubstitution($nome){
		
		$query ="SELECT * FROM sostituzioni WHERE nome_sub = '".$nome."'";
		$result = $this->db->query($query,1);
		return $result[0];
		
	}

	public function addSubstitutionVote($idUtente, $idSub,$voto){
		if( ! ($this->hasVotingSub($idUtente,$idSub) )){
			//$idUtente = $this->sessione->getUid();
			$query = "INSERT INTO votazioni_sostituzioni (id_votazione_sub, id_utente, id_sub, voto) VALUES (NULL, '".$idUtente."', '".$idSub."', '".$voto."')";
			$this->db->query($query,0);
		}
	}

	public function getSubstitutionVote($idSub){
		$vote = 0;
		$query = "SELECT * FROM votazioni_sostituzioni WHERE id_sub = '".$idSub."'";
		$result = $this->db->query($query,1);
		$count = 0;
		if(count($result) == 0) return 0;
		foreach ($result as $value){
			$vote = $vote + $value['voto'];
			$count++;
		}
		if($vote == 0) return 0;
		$vote = $vote / $count;
		return $vote;
		
		
	}


	/*
	controlla se un utente ha già votato 
	ritorna true se ha già votato
	no altrimenti.
	*/
	public function hasVotingSub($idUtente, $idSub){
		//$idUtente = $this->sessione->getUid();
		//$substitution = getSubstitution($nomeSub);
		//$idSub = $substitution['id_sub'];
		$query = "SELECT * FROM votazioni_sostituzioni WHERE id_sub = '".$idSub."' AND id_utente = '".$idUtente."'";
		$result = $this->db->query($query,1);
		if(sizeof($result)!= 0)return true;
		else return false;
		
		
		
	}
}















?>