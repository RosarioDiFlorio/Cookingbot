<?php
   //Controller di view
   require_once dirname(__FILE__). '/classes/Sessione.php';
    //Check se collegato
    $loggedin = Sessione::isLoggedIn(true);
    //Variabile per attivare contesto della topbar
    $is_search = true;
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
    <link href="css/getrecipes.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php require_once("components/topbar.php"); //Inclusione topbar?>

     <div class="container text-center" >
        <div class="heading"><h2>Search Recipe</h2></div>
        <input type="button" value="Words" onclick="visible('wordss','ingredients');">
         <input type="button" value="Ingredients" onclick="visible('ingredients','wordss');">
         <br>
	       Cuisine Filter<input type="text" id="cuisine">
         Diet Filter<input type="text" id="diet">
         Occasion Filter<input type="text" id="occasion">
         Course Filter<input type="text" id="course">
	<br>
  <input type="radio" name="lang" value="en" > En
               <input type="radio" name="lang" value="it" > It
<div class="container text-center"  id="wordss">
        <div class="bs-component well"   >
		 <h3>Insert Number Peoples</h3>
          <input type="text" id="npeopleWords">
          
          <h3>Insert words!</h3>
          <div  id="words1">
          <div class="form-group">
            <i class="fa fa-shopping-cart fa-3x"></i>
            <div class="col-lg-12">
              
               
              <input type="text" id="words">
            </div>
          </div>
        </div>
            <button type="button" class="btn btn-primary " onclick="getRecipesByWords(0);"><span>Search Recipes</span></button>
       
        </div>

  </div>  

  



	
	<div class="container text-center"  id="ingredients">
        <div class="bs-component well"   >
		
          <input type="hidden" value="1" id="ningredient">
          <h3>Insert Number Peoples</h3>
          <input type="text" id="npeople">
          <h3>Insert Ingredients</h3>
          <div  id="ingredients1">
          <div class="form-group">
            <i class="fa fa-shopping-cart fa-3x"></i>
              <h4>Ingredient 1</h4>
            <div class="col-lg-12">
              Name
              <input type="text" id="ingredient1" class="" />
             
            </div>
          </div>
        </div>
            <button type="button" class="btn btn-primary " onclick="add('ingredient');"><span>Add Ingredient</span></button>
            <button type="button" class="btn btn-primary " onclick="remov('ingredient');"><span>Remove Ingredient</span></button>
           <button type="button" class="btn btn-primary " onclick="getRecipesByIngredients(0);"><span>Search</span></button>
		   
        </div>

        

  </div>  

<div class="container text-center ">
       <!-- <h3>Results:</h3>-->
        <div class="form-group" id="results">
          
        </div>
		<button type="button" class="btn btn-primary btn-ingredients" onclick="getRecipesByIngredients(-10);" ><span>previous page</span></button>
		<button type="button" class="btn btn-primary btn-ingredients" onclick="getRecipesByIngredients(10);" ><span>next page</span></button>
		
		<button type="button" class="btn btn-primary btn-words" onclick="getRecipesByWords(-10);" ><span>previous page</span></button>
		<button type="button" class="btn btn-primary btn-words" onclick="getRecipesByWords(10);" ><span>next page</span></button>
	</div>	
	
	
   </div>
     <?php require_once("components/javascript-comune.php"); //Inclusione Javascript Comune ?>
    <!-- Script specifici di view -->
    <script src="js/getrecipes.js"></script>
    <script src="js/lib/highcharts.js"></script>
    <script src="js/lib/highcharts-more.js"></script>
    <script src="http://code.highcharts.com/themes/dark-unica.js"></script>
  </body>
</html>