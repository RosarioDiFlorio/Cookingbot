<?php

	/* NO CACHING */
	header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
	header("Pragma: no-cache"); // HTTP 1.0.
	header("Expires: 0"); // Proxies.
	
	//Controller di view
	require_once dirname(__FILE__). '/classes/Sessione.php';
   
    //Check se collegato
    $loggedin = Sessione::isLoggedIn(true);
    //Variabile per attivare contesto della topbar
    $is_index = true;
	

?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="CookingBot">
    <meta name="author" content="CBteam">
	<!-- NO CACHING -->
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Expires" content="0" />
    
	<title>CookingBot</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Tema material design
    <link href="css/material.min.css" rel="stylesheet">
    <link href="css/material-fullpalette.min.css" rel="stylesheet">
    <link href="css/ripples.min.css" rel="stylesheet">
    <link href="css/roboto.min.css" rel="stylesheet">
    <link href="css/star-rating.min.css" rel="stylesheet">  -->
    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/index.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php require_once("components/topbar.php"); //Inclusione topbar?>
    <div class="container-fluid text-center">
	
   <?php 
   $strMessage = "";

	if(isset($_GET['message']))
	{
		$message = $_GET['message'];
		if($message == "noLogin")
		{
			$strMessage = "you need to be logged in for access to this page";
			//echo $strMessage;	
		
		}

		 if($message != "")
		{
			echo '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning!</strong> '.$strMessage .'
			</div>';
		}
	}
  

  ?>
        <div id="homeslider" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#homeslider" data-slide-to="0" class="active"></li>
        <li data-target="#homeslider" data-slide-to="1"></li>
        <li data-target="#homeslider" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide img-responsive" src="img/slider1.jpg" alt="Prima slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>The recipe made for you.</h1>
              <p></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="first-slide img-responsive" src="img/slider2.jpg" alt="Seconda slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Tell us what you have, we will help you.</h1>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="first-slide img-responsive" src="img/slider3.jpg" alt="Seconda slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Do you miss something? Don't worry .</h1>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#homeslider" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#homeslider" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Successive</span>
      </a>
    </div>
    </div><!-- /.container -->
	
 <!--   <div class="container">
        <div class="heading"><h1>heading</h1></div>
        <div id="risultati" class="row"></div>
    </div>
	-->
    <?php require_once("components/modalegrafico.php"); //Modale per mostrare il grafico a ragno ?>
    <?php require_once("components/javascript-comune.php"); //Inclusione Javascript Comune?>
    <script type="text/javascript" src="js/index.js"></script>
    <script src="js/lib/highcharts.js"></script>
    <script src="js/lib/highcharts-more.js"></script>
    <script src="http://code.highcharts.com/themes/dark-unica.js"></script>
  </body>
</html>