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
    <link href="css/addrecipe.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php require_once("components/topbar.php"); //Inclusione topbar?>

     <div class="container text-center" >
        <div class="heading"><h2>Help us, add a new recipe!</h2></div>

		<div class="bs-component well" id="info" >
		
          <div class="form-group simple" >
            <i class="fa fa-star fa-3x"></i>
              <h4>Name</h4>
            <div class="col-lg-12">
              <input type="text" id="name" class="form-control" />
            </div>
          </div>
          <div class="form-group simple">
            <i class="fa fa-users fa-3x"></i>
              <h4>How much people will it serves?</h4>
            <div class="col-lg-12">
              <input type="number" id="nopeople" class="form-control"/>
            </div>  
          
          <div class="form-group simple">
            <i class="fa fa-cutlery fa-3x"></i>
              <h4>What is the cusin of this recipe?</h4>
            <div class="col-lg-12">
              <input type="text" id="cusin" class="form-control" />
            </div>  
          </div>
          <div class="form-group box">
            <i class="fa fa-balance-scale fa-3x "></i>
            <div class="col-lg-12">
               <input type="checkbox" value="diet" onclick="visibile('diet');"> 
               <h4> Diet </h4>
               <input type="text" id="diet" class="form-control"  disabled />
            </div>
          </div> 
          <div class="form-group box">
            <i class="fa fa-birthday-cake fa-3x"></i>
            <div class="col-lg-12">
               <input type="checkbox" value="occasion" onclick="visibile('occasion');"> 
               <h4>Occasion to made it?</h4>
               <input type="text" id="occasion" class="form-control"  disabled />
            </div>
          </div> 
           <div class="form-group box">
            <i class="fa fa-shopping-basket fa-3x"></i>
            <div class="col-lg-12">
               <input type="checkbox" value="course" onclick="visibile('course');"> 
               <h4>What king of dish is it?</h4>
               <input type="text" id="course" class="form-control"  disabled />
            </div>
          </div>


            <div class="form-group box">
            <i class="fa fa-file-image-o fa-3x"></i>
            <div class="col-lg-12">
               <input type="radio" name="lang" value="en" > En
               <input type="radio" name="lang" value="it" > It
            </div>
          </div>

        
          <button type="button" class="btn btn-primary " onclick="scelte('info');"><span>Continue to add Steps</span></button>
        </div>
      </div>
	</div><!-- /.container -->
	
	<div class="container text-center"  id="stages" >
        <div class="bs-component well" >
		
          <input type="hidden" value="1" id="nstep">
          <i class="fa fa-file-text fa-3x"></i>
          <h3>Decribe the steps of the Stage</h3>
          <div class="row text-center" id="steps">
          <div class="form-group">
            
              <h4>Step 1</h4>
            <div >
              
              <input type="text" id="step1" class="form-control" />
            </div>
          </div>
        </div>
            <button type="button" class="btn btn-primary " onclick="add('step');"><span>Add Step</span></button>
            <button type="button" class="btn btn-primary " onclick="remov('step');"><span>Remove Step</span></button>
           <button type="button" class="btn btn-primary " onclick="scelte('stages');"><span>Finish</span></button>
		   
		   
        </div>
	</div>
	
	
	<div class="container text-center"  id="ingredients">
        <div class="bs-component well"   >
		
          <input type="hidden" value="1" id="ningredient">
          
          <h3>What are the ingredients of this recipe?</h3>
          <div  id="ingredients1">
          <div class="form-group">
            <i class="fa fa-shopping-cart fa-3x"></i>
              <h4>Ingredient 1</h4>
            <div class="col-lg-12">
              Name
              <input type="text" id="ingredient1" class="" />
              Quantity
              <input type="number" id="quantity1" class="" />
               <input type="radio" name="mis1" value="unit" onclick="show('unit','1');"> Unit
               <input type="radio" name="mis1" value="metric" onclick="show('metric','1');"> Metric
               <input type="radio" name="mis1" value="imperial" onclick="show('imperial','1');"> Imperial
               <select id="misurazione1" class="" disabled>
               </select>
            </div>
          </div>
        </div>
            <button type="button" class="btn btn-primary " onclick="add('ingredient');"><span>Add Ingredient</span></button>
            <button type="button" class="btn btn-primary " onclick="remov('ingredient');"><span>Remove Ingredient</span></button>
           <button type="button" class="btn btn-primary " onclick="scelte('ingredients');"><span>Continue To Add Steps</span></button>
		   
        </div>

	</div>	
	
	
   
     <?php require_once("components/javascript-comune.php"); //Inclusione Javascript Comune ?>
    <!-- Script specifici di view -->
    <script src="js/addrecipe.js"></script>
    <script src="js/lib/highcharts.js"></script>
    <script src="js/lib/highcharts-more.js"></script>
    <script src="http://code.highcharts.com/themes/dark-unica.js"></script>
  </body>
</html>