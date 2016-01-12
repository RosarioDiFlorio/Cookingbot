<?php
/*
    @author: Mario Villani
    Questo script verifica la sessione e permette ad un utente di aggiungere un'istanza di tipo Hosting
    PARAMETRI DA RICEVERE E VALIDARE
    @param name: nome hosting da aggiungere
    @param so: sistema operativo dell'hosting
    @param typedisk: "SSD" oppure "HD"
    @param capacitydisk: numero intero, numero di GB dello spazio
    @param numdomini: numero intero, numero di domini dell'offerta
    @param numemail: numero intero, numero di email dell'offerta
    @param transferrate: numero intero, velocità dell'hosting
    @param backup: "Si" o "No"
    @param price: numerico, prezzo hosting
*/
require dirname(__FILE__) . "/../classes/Sessione.php";
require dirname(__FILE__) . "/../classes/Utility.php";
if(!Sessione::isLoggedIn()) {
	sendError("Utente non collegato");
}
if(!isset($_POST['name']) || empty($_POST['name']))
    sendError("Nome non inviato");
if(!isset($_POST['so']) ||  empty($_POST['so']) )
    sendError("Sistema operativo non valido");
if(!isset($_POST['antivirus']) ||  empty($_POST['antivirus']) )
    sendError("Nome antivirus non valido");
if(!isset($_POST['numdomini']) || !ctype_digit($_POST['numdomini']))
    sendError("Numero domini non valido");
if(!isset($_POST['numemail']) || !ctype_digit($_POST['numemail']))
    sendError("Numero email non valido");
if(!isset($_POST['typedisk']) || (($_POST['typedisk'] != "HD") && ($_POST['typedisk'] != "SSD")) )
    sendError("Tipo disco non valido");
if(!isset($_POST['capacitydisk']) || !ctype_digit($_POST['capacitydisk']))
    sendError("Capacita disco non valida");
if(!isset($_POST['transferrate']) || !ctype_digit($_POST['transferrate']))
    sendError("Trasferimento non valido");
if(!isset($_POST['backup']) || (($_POST['backup'] != "true") && ($_POST['backup'] != "false")))
    sendError("Proprietà backup non valida");
if(!isset($_POST['price']) || !is_numeric($_POST['price']))
    sendError("Prezzo non valido");
print_r(curlRequest("addOffer",array("nomeIstanza"=>$_POST['name'],"tipoOfferta"=>"Hosting",
"stringa"=>"SO=".$_POST['so']."&antivirus=".$_POST['antivirus']."&numbdomains=".$_POST['numdomini']
."&numbemails=".$_POST['numemail']."&backup=".$_POST['backup']."&capacityDisk=".$_POST['capacitydisk']
."&transferRate=".$_POST['transferrate']."&typeDisk=".$_POST['typedisk']
."&Name=".$_POST['name']."&price=".$_POST['price'])));
?>