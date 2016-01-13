<?php

class Connection {

	
private $HOST = "localhost";
private $USER = "root";
private $PWD = "";
private $DATABASE = "griweb";


	public function query($query,$get){
		//echo $query;
		$connect = mysql_connect($this->HOST,$this->USER,$this->PWD) or die("connessione non riuscita");
		mysql_select_db($this->DATABASE) or die ("database non trovato");
		//echo $query;
		$result=mysql_query($query) or die("query fallita: " . mysql_error());
		mysql_close($connect);	//chiudo la connessione

		
		if($get==1 && mysql_num_rows($result)>0){//devo restituire qualcosa
		while($riga=mysql_fetch_assoc($result)){
				$return[]=$riga;
				
		}
		//$result=mysql_fetch_assoc($result);//trasformo il risultato in un array associativo
		return $return;	
		}else{
		return NULL;	
		}
		
	}
	
	
}




?>