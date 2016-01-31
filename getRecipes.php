<?php
   //Controller di view
   require_once dirname(__FILE__). '/classes/Sessione.php';
    include_once dirname(__FILE__).'/API/get_all_cuisine_API.php';
	include_once dirname(__FILE__).'/API/get_all_occasion_API.php';
	include_once dirname(__FILE__).'/API/get_all_course_API.php';
	include_once dirname(__FILE__).'/API/get_all_diet_API.php';
	require_once  dirname(__FILE__).'/API/get_food_API.php';
    include_all_php("API/API_SPARQL");
    //Check se collegato
    $loggedin = Sessione::isLoggedIn(true);
    //Variabile per attivare contesto della topbar
    $is_search = true;
	
	$arr = getAllFoodsAPI();
	
?>
<!DOCTYPE html>
<html lang="it">
 <script src="jquery.min.js"></script>
 <link href="typeahead.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
		
		var locale = <?php echo $arr;	?>;
			//console.log(locale);
		$(document).ready(function () {
				setUpTypeahed();
		});
		
		function setUpTypeahed()
		{
				$('input.ingredients').typeahead({
                name: 'Foods',
                local: locale,
				hint: true,
				highlight: true,
				minLength: 1
				/*matcher: function(item) {
					// Here, the item variable is the item to check for matching.
					// Use this.query to get the current query.
					// return true to signify that the item was matched.
					console.log(item);
					return true;
				}*/
				
			})
			
		}
	</script>


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
    <!-- Tema material design 
    <link href="css/material.min.css" rel="stylesheet">
    <link href="css/material-fullpalette.min.css" rel="stylesheet">
    <link href="css/ripples.min.css" rel="stylesheet">
    <link href="css/roboto.min.css" rel="stylesheet"> -->
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
	<div class="container col-sm-12" >
		<div class="heading smallSpaceTop smallSpaceBottom"><h2>Search Recipe <div id="tipo">by words</div></h2></div>
		 
		<div class="heading smallSpaceTop smallSpaceBottom text-center suggest"><span for="comment">in this section you can find a recipe using keyword or by inserting the ingredients that must have looked for the recipe</span></div> 
	
	<div id="filter"> <!-- INIZIO DIV CON I FILTRI -->	
	
		<div class="container col-sm-4" >
			</-- CUISINE -->
			<div>
				<div class="heading smallSpaceTop smallSpaceBottom"><span for="comment">Select the cuisine:</span></div>
				<select class="form-control" id="cuisine">
									<option value =" ">Select a cuisine:</option>
									 <?php
									 
										$res = getAllCuisine();
								
										$value = $res[0];
										$ar = $res[1];
										 for($i = 0;$i < count($value); $i++)
										{
											echo "<option value =\"".$ar[$i]."\">".$ar[$i]."</option>";
										}
																	  
									 ?>
				</select>
			  
			  </div>
			  
				</-- OCCASION -->
			<div>
				<div class="heading smallSpaceTop smallSpaceBottom"><span for="comment">Select the occasion:</span></div>
				<select class="form-control" id="occasion">
									<option value =" ">Select an occasion:</option>
									 <?php
									 
										$res = getAllOccasion();
								
										$value = $res[0];
										$ar = $res[1];
										 for($i = 0;$i < count($value); $i++)
										{
												echo "<option value =\"".$ar[$i]."\">".$ar[$i]."</option>";
										}
																	  
									 ?>
				</select>
			  
			</div>
			  
			  
			   </-- DIET-->
			<div>
				<div class="heading smallSpaceTop smallSpaceBottom"><span for="comment">Select the diet:</span></div>
				<select class="form-control" id="diet">
									<option value =" ">Select a diet:</option>
									 <?php
									 
										$res = getAllDiet();
								
										$value = $res[0];
										$ar = $res[1];
										 for($i = 0;$i < count($value); $i++)
										{
												echo "<option value =\"".$ar[$i]."\">".$ar[$i]."</option>";
										}
																	  
									 ?>
				</select>
			  
			</div>
			  
			  
			</-- COURSE-->
			<div>
				<div class="heading smallSpaceTop smallSpaceBottom"><span for="comment">Select the course:</span></div>
				<select class="form-control" id="course">
									<option value =" ">Select a course:</option>
									 <?php
									 
										$res = getAllCourse();
								
										$value = $res[0];
										$ar = $res[1];
										 for($i = 0;$i < count($value); $i++)
										{
												echo "<option value =\"".$ar[$i]."\">".$ar[$i]."</option>";
										}
																	  
									 ?>
				</select>
			  
			</div>
		</div>
		
		
		<div class="container col-sm-4" >
			<div class="heading smallSpaceTop smallSpaceBottom"><span for="comment">Show liquids in:</span></div>
			<select  class="form-control" id="liquidMeasure">
			<option value="ml">ml</option>
				<option value="l">l</option>
				<option value="teaspoon">teaspoon</option>
				<option value="tablespoon">tablespoon</option>
				<option value="cup">cup</option>
				<option value="pint">pint</option>
			</select>
			
			<div class="heading smallSpaceTop smallSpaceBottom"><span for="comment">Show solid in:</span></div>
				<select   class="form-control" id="solidMeasure">
					<option value="g">g</option>
					<option value="kg">kg</option>
					<option value="ounce">ounce</option>
					<option value="pound">pound</option>
				</select>
			<div class="heading smallSpaceTop smallSpaceBottom">
				<span for="comment">select the language:</span>
				<input type="radio" name="lang" value="en" checked> En
				<input type="radio" name="lang" value="it" > It
			</div>	   
				   
				
			<div class="heading smallSpaceTop smallSpaceBottom">
				<div for="comment " class="smallSpaceBottom smallSpaceTop">select the type of search:</div>
				<div >
					<!--<input type="radio" name="lang" value="en" onclick="visible('wordss','ingredients','by words');" checked> words
					<input type="radio" name="lang" value="it" onclick="visible('ingredients','wordss','by ingredients');" > ingredients-->
					<input type="button" class="btn btn-info" value="Words" onclick="visible('wordss','ingredients','by words');">
					<input type="button"  class="btn btn-info" value="Ingredients" onclick="visible('ingredients','wordss','by ingredients');">
				 </div>
				<!--   Cuisine Filter<input type="text" id="cuisine">
				 Diet Filter<input type="text" id="diet">
				 Occasion Filter<input type="text" id="occasion">
				 Course Filter<input type="text" id="course"> -->
			</div>	
				
			
		</div>
		 <!--FINE CONTENITORI PARTE FILTRI -->
	
	</div> <!-- FINE DIV  CON I FILTRI -->	 
		 
		 
		 <!--RICERCA PER WORDS -->
		<div id="wordss"> 
			<div class="container col-sm-4 text-center"  >
					<div class="heading smallSpaceTop smallSpaceBottom"><span for="comment">Number of Peoples you want to serve</span></div>
					
					<input type="text" class="form-control " id="npeopleWords">
				  
					<div class="heading smallSpaceTop smallSpaceBottom">Insert words!</div>
					<div  id="words1">
						<div class="form-group">
							<i class="fa fa-shopping-cart fa-2x"></i>
							<div >
							<input type="text" placeholder="chicken,sauce,..."  class="form-control " id="words">
							</div>
						</div>
					</div>
					
			   
				
			</div>
			<div class="text-center col-sm-12"><button type="button" class="btn btn-success btn-lg smallSpaceTop smallSpaceBottom" onclick="getRecipesByWords(0);"><span>Search recipes</span></button></div>	
		
		</div>		

	  



		<!--RICERCA PER INGREDIENTS -->
		<div  id="ingredients">
			 <div class="container text-center  col-sm-4"  >
				<input type="hidden" value="1" id="ningredient">
				<div class="heading smallSpaceTop smallSpaceBottom"><span for="comment">Number of Peoples you want to serve</span></div>
				<input type="text"  class="form-control " id="npeople">
			</div>
			  
			<div  class="col-sm-4">
			<div class="heading smallSpaceTop smallSpaceBottom" for="comment">Insert Ingredients</div>
				
				<button type="button" class="btn btn-info smallSpaceTop smallSpaceBottom" onclick="add('ingredient');"><span>Add Ingredient</span></button>
				<button type="button" class="btn btn-info smallSpaceTop smallSpaceBottom" onclick="remov('ingredient');"><span>Remove Ingredient</span></button>
				
				  
			</div>
			
			   
			<div id="ingredients1" class="form-group  col-sm-4">
			
				<i class="fa fa-shopping-cart fa-2x "></i>
				<span class="heading smallSpaceTop smallSpaceBottom " for="comment">Ingredient 1</span>
				<input type="text"  class=" ingredients " id="ingredient1" />
			</div>
			<div class="text-center col-sm-12"><button type="button" class="btn btn-success btn-lg smallSpaceTop smallSpaceBottom" onclick="getRecipesByIngredients(0);"><span>Search recipes</span></button></div>	
		</div>  

		<div class="container text-center ">
		   <!-- <h3>Results:</h3>-->
			<div class="form-group col-xs-12" id="results">
			  
			</div>
			<div class="col-xs-12 smallSpaceBottom">
			<button type="button" class="btn btn-info btn-ingredients" onclick="getRecipesByIngredients(-10);" ><span>previous page</span></button>
			<button type="button" class="btn btn-info btn-ingredients" onclick="getRecipesByIngredients(10);" ><span>next page</span></button>
			
			<button type="button" class="btn btn-info btn-words" onclick="getRecipesByWords(-10);" ><span>previous page</span></button>
			<button type="button" class="btn btn-info btn-words" onclick="getRecipesByWords(10);" ><span>next page</span></button>
			</div>
		</div>	
		
		
	</div>
     <?php require_once("components/javascript-comune.php"); //Inclusione Javascript Comune ?>
    <!-- Script specifici di view -->
    <script src="js/getrecipes.js"></script>
    <script src="js/lib/highcharts.js"></script>
    <script src="js/lib/highcharts-more.js"></script>
    <script src="http://code.highcharts.com/themes/dark-unica.js"></script>
	 <script type="text/javascript" src="jquery.typeahead.js"></script>
  </body>
</html>