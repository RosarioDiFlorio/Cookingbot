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
 <meta name="description" content="CookingBot">
    <meta name="author" content="CookingTeam">
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
    <link href="css/addSubstitution.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	
				<?php require_once("components/topbar.php"); //Inclusione topbar?>
			
	<div class="container text-center">
			
						<div class="heading"><h2>Select an ingredient that you want to replace</h2></div>
					
					<div class="bs-component well">	
					<form id="formSubstitute">
					
						<div class="form-group ">
							<label for="sel1">Select list:</label>
								<select class="form-control" id="sel1">
								<option value="tomatoes">tomatoes</option>
								<option value="water">water</option>
								<option value="tomato_concentrate">tomato concentrate</option>
							
							</select>
						</div>
						<br />
						
						<i class="glyphicon glyphicon-transfer "></i>
						<div class="heading"><h2>Enter the substitutes ingredients</h2></div>
						
						<div class="input_fields_wrap ">
							
							<div >
							<h3 class="heading">food</h3>
							<input class="form-control " type="text" name="mytext[]" onfocus="$(this).css('background','');" />
							<h3 class="heading">quantity</h3>
							<input type="text"  class="form-control" name="quantity[]" /></div>
						</div>
						<button type="button" class="btn btn-primary add_field_button">Add More Ingredients</button>
						<button href="#" type="button" class=" btn btn-primary  remove_field" >Remove last</button>
						<br />
						<i class="glyphicon glyphicon-scale" ></i>
						<h3 class="heading">resulting quantity</h3>
						<input type="text" name="qantityResult" class="form-control"/>

						</form>
						<div class="ins-alert"><div class="alert alert-danger"><strong>Warning!</strong> One or more ingredient missed</div></div>
						<button id="btn" type="button" class="btn btn-primary" >enter</button>
				
						
				
					</div>		
	</div><!-- /.container -->
 <?php require_once("components/modalegrafico.php"); //Modale per mostrare il grafico a ragno ?>
    <?php require_once("components/javascript-comune.php"); //Inclusione Javascript Comune ?>
    <!-- Script specifici di view -->
    <script src="js/addSubstitution.js"></script>
    <script src="js/lib/highcharts.js"></script>
    <script src="js/lib/highcharts-more.js"></script>
    <script src="http://code.highcharts.com/themes/dark-unica.js"></script>
</body>
</html>
