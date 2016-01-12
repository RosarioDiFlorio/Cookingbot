<?php
   //Controller di view
   require_once dirname(__FILE__). '/classes/Sessione.php';
    //Check se collegato
    $loggedin = Sessione::isLoggedIn(true);
    //Variabile per attivare contesto della topbar
    $is_addrecipe = true;
?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="GRI">
    <meta name="author" content="GRITeam">
    <title>CookingBot</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Tema material design -->
    <link href="css/material.min.css" rel="stylesheet">
    <link href="css/material-fullpalette.min.css" rel="stylesheet">
    <link href="css/ripples.min.css" rel="stylesheet">
    <link href="css/roboto.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">
    <!-- CSS Specifico della view-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="css/insertFood.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php require_once("components/topbar.php"); //Inclusione topbar?>

     <div class="container text-center">
       

			<div class="heading"><h2>Help us, add a new food!</h2></div>
	
			
					<div class="bs-component  well"  >	
						
						<form id="foodForm" >
						<i class="fa fa-spoon"></i>
						<h3 class="heading">Insert the food name</h3>
						<label for="comment">Usually an ingredient is added to the plural. Please enter the ingredient in the plural where possible</label>
						<input type="text" id="food" class="form-control " />

						<br />
						
						
						<div class="ins-alert"><div class="alert alert-danger"><strong>Warning!</strong> missed food </div></div>
												<button id="btn-insert" type="button" class="btn btn-primary"  >enter</button>
						</form>
					</div>
  </div><!-- /.container -->
    <?php require_once("components/modalegrafico.php"); //Modale per mostrare il grafico a ragno ?>
    <?php require_once("components/javascript-comune.php"); //Inclusione Javascript Comune ?>
    <!-- Script specifici di view -->
    <script src="js/insertFood.js"></script>
    <script src="js/lib/highcharts.js"></script>
    <script src="js/lib/highcharts-more.js"></script>
    <script src="http://code.highcharts.com/themes/dark-unica.js"></script>

</body>
</html>
