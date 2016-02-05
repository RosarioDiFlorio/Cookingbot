<?php
//Login al sistema - Funzione helper, richiamata sotto
function login($email, $password, $remember) {
   /*
    * Valori restituiti
    * failed : login fallito
    * inactive : account non attivo
    * ok : login ok 
    */
   require_once dirname(__FILE__). '/classes/Utente.php';
   $utente = new Utente();
   //Verifichiamo se esiste l'utente
   try {
       $utente -> prelevaDaEmail($email);
   } catch (Exception $e) {
       return "failed";
   }
   //Login fallito se password non corretta
   require dirname(__FILE__). "/classes/PasswordHash.php";
   $t_hasher = new PasswordHash(8, FALSE);
   if (!$t_hasher -> CheckPassword($password, $utente -> getPassword())) {
       return "failed";
   }
   if ($utente -> isAttivo() == 0)
       return "inactive";
   // Status amministratore
   $is_admin = $utente->isAdmin();
   //Se tutto ok, avvia sessione
   Sessione::startSession($utente->getID(),$utente->getEmail(),$remember,$is_admin);
   return "ok";
}

//** --------- Controller della view --------- **/

require_once dirname(__FILE__). '/classes/Sessione.php';
//Check se collegato
$loggedin = Sessione::isLoggedIn(true);
//Se collegato, porta alla home
if($loggedin) {
   header("Location: index.php");
   die();
}
$remember = false;
//Utente vuole loggarsi, necessario passare i parametri e non essere collegati.
if(isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password']) && !$loggedin) {
   //Se ha richiesto login con ricordami
   if(isset($_POST['remember']) && $_POST['remember'] == "si") {
     $remember = true;
   }
   require_once dirname(__FILE__). '/classes/Database.php';
   //Tenta il login
   $response = login($_POST['email'],$_POST['password'],$remember);
   //Se fallisce il login(password errata o utente non trovato)
   if($response == "failed") 
     $message = '<div class="bs-component">'.
         '<div class="alert alert-dismissable alert-danger">'.
         '<button type="button" class="close" data-dismiss="alert">×</button>Login fallito</div></div>';
   else if($response == "inactive") { //Se l'utente non è attivo
       $message = '<div class="bs-component">'.
       '<div class="alert alert-dismissable alert-danger">'.
       '<button type="button" class="close" data-dismiss="alert">×</button>Utente non attivato.</div></div>';
   }
   else if($response == "ok") { //Se tutto ok, reindirizza
     header("Location: index.php");
     die();
   }
}
?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="GRI Login">
    <meta name="author" content="GRITeam">
    <title>CookingBot</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS di view -->
    <link href="css/login.css" rel="stylesheet">
    <!-- Tema material design 
    <link href="css/material.min.css" rel="stylesheet">
    <link href="css/material-fullpalette.min.css" rel="stylesheet">
    <link href="css/ripples.min.css" rel="stylesheet">
    <link href="css/roboto.min.css" rel="stylesheet">-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <div class="container">
    <div class="row text-center"><img class="img-responsive" src="img/logo.png" /></div>
  <?php if(!$loggedin) { //Mostra la form se non è loggato?>
  <form class="form-signin" method="post" action="">
        <h2 class="form-signin-heading">SIGN IN</h2>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Indirizzo Email" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="">
        <div class="checkbox">
          <label>
            <input type="checkbox" name="remember" value="si"> Remember me
          </label>
        </div>
        <input type="hidden" name="login" value="" /> 
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        <a href="register.php">Register to CookingBot</a>
        <?php if(isset($message)) echo $message; //eventuale messaggio di errore ?>
      </form>
  <?php } else { //Se loggato, mostra testo utente già collegato?>
  	  <div class="row text-center"><h2>Already logged in</h2></div>
  <?php } ?>
    <!-- Librerie necessarie -->
    </div>
    <script src="js/lib/jquery-1.11.3.min.js"></script>
    <script src="js/lib/bootstrap.min.js"></script>
    <script src="js/lib/material.min.js"></script>
    <script src="js/lib/ripples.min.js"></script>
    <script type="text/javascript">
      //Istanziazioni DOM
      $(document).ready(function() {
          $.material.init();
      });
    </script>
  </body>
</html>