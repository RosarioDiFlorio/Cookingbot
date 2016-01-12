<?php
//** --------- Controller della view --------- **/
require_once dirname(__FILE__). '/classes/Sessione.php';
//Check se collegato
$loggedin = Sessione::isLoggedIn(true);
//Se collegato, porta alla home
if($loggedin) {
   header("Location: index.php");
   die();
}
?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="GRI Registration">
    <meta name="author" content="GRITeam">
    <title>CookingBot</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS di view -->
    <link href="css/login.css" rel="stylesheet">
    <!-- Tema material design -->
    <link href="css/material.min.css" rel="stylesheet">
    <link href="css/material-fullpalette.min.css" rel="stylesheet">
    <link href="css/ripples.min.css" rel="stylesheet">
    <link href="css/roboto.min.css" rel="stylesheet">
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
  <div class="form-signin">
        <h2 class="form-signin-heading">SIGN UP</h2>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Indirizzo Email" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="">
        <input type="password" name="confirmpassword" id="confirmPassword" class="form-control" placeholder="Conferma Password" required="">
        <button class="btn btn-lg btn-primary btn-block" id="registerme">REGISTER</button>
        <div id="registerresponse"></div>
  </div>
  <?php } ?>
  <!-- Librerie necessarie -->
  </div>
  <script src="js/lib/jquery-1.11.3.min.js"></script>
  <script src="js/lib/bootstrap.min.js"></script>
  <script src="js/lib/material.min.js"></script>
  <script src="js/lib/ripples.min.js"></script>
  <script src="js/register.js"></script>
  </body>
</html>