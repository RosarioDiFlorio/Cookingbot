<?php
/*
    @author: Mario Villani
    Questo script verifica la sessione e permette ad un utente di aggiungere un'istanza di tipo Hosting
    PARAMETRI DA RICEVERE E VALIDARE
    @param name: nome dedicato da aggiungere
    @param typecpu: Tipo cpu , "Intel" oppure "AMD" oppure altro
    @param namecpu: nome della cpu
    @param typedisk: "SSD" oppure "HD"
    @param capacitydisk: numero intero, numero di GB dello spazio
    @param clockcpu: numero intero, frequenza del clock della CPU
    @param numbproc: numero intero, numero di processori del dedicato
    @param capram: numero interi, quantità di ram
    @param clockram: numero intero, frequenza della ram
    @param backup: "Si" oppure "No"
    @param transferrate: numero intero, velocità dell'hosting
    @param price: numerico, prezzo hosting
*/
require dirname(__FILE__) . "/../classes/Sessione.php";
require dirname(__FILE__) . "/../classes/Utility.php";
if(!Sessione::isLoggedIn()) {
	sendError("Utente non collegato");
}
if(!isset($_POST['name']) || empty($_POST['name']))
    sendError("Nome non inviato");
if(!isset($_POST['typecpu']) || (($_POST['typecpu'] != "Intel") && ($_POST['typecpu'] != "AMD")) )
    sendError("Errore CPU");
if(!isset($_POST['namecpu']) || empty($_POST['namecpu']))
    sendError("Nome cpu non settato");
if(!isset($_POST['typedisk']) || (($_POST['typedisk'] != "HD") && ($_POST['typedisk'] != "SSD")) )
    sendError("Tipo disco non valido");
if(!isset($_POST['capacitydisk']) || !ctype_digit($_POST['capacitydisk']))
    sendError("Capacita disco non valida");
if(!isset($_POST['clockcpu']) || !ctype_digit($_POST['clockcpu']))
    sendError("Clock cpu non valida");
if(!isset($_POST['numbproc']) || !ctype_digit($_POST['numbproc']))
    sendError("Numero core cpu non valido");
if(!isset($_POST['capram']) || !ctype_digit($_POST['capram']))
    sendError("Capacità ram non valida");
if(!isset($_POST['clockram']) || !ctype_digit($_POST['clockram']))
    sendError("Clock ram non valido");
if(!isset($_POST['transferrate']) || !ctype_digit($_POST['transferrate']))
    sendError("Trasferimento non valido");
if(!isset($_POST['backup']) || (($_POST['backup'] != "true") && ($_POST['backup'] != "false")))
    sendError("Proprietà backup non valida");
if(!isset($_POST['price']) || !is_numeric($_POST['price']))
    sendError("Prezzo non valido");
print_r(curlRequest("addOffer",array("nomeIstanza"=>$_POST['name'],"tipoOfferta"=>"Dedicated",
"stringa"=>"typeCpu=".$_POST['typecpu']."&numbCore=".$_POST['numbproc']."&clockRam=".$_POST['clockram']
."&clockCpu=".$_POST['clockcpu']
."&capacityRam=".$_POST['capram']
."&nomeCpu=".$_POST['namecpu']."&DedicatedFor=".$_POST['DedicatedFor']."&backup=".$_POST['backup']."&capacityDisk=".$_POST['capacitydisk']
."&transferRate=".$_POST['transferrate']."&typeDisk=".$_POST['typedisk']
."&Name=".$_POST['name']."&price=".$_POST['price'])));
?>