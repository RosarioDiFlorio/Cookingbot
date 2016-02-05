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
     $is_add = true;
	if(!$loggedin)
	{
		header("Location: index.php?message=noLogin");
		die();
	}
	
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
				//$('[data-toggle="tooltip"]').tooltip();  //init tooltip
				
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
    <link href="css/addrecipe.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php require_once("components/topbar.php"); //Inclusione topbar?>

	<!-- DIV LOADING -->
<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#pleaseWaitDialog">Open Modal</button>-->

	<?php require_once("components/waitdialog.php");?>

	
	
     <div class="container text-center" >
        <div class="heading"><h2>Help us, add a new recipe!</h2></div>

		<div class="bs-component" id="info" >
		
          <div class="form-group simple" >
            <i class="fa fa-star fa-3x"></i>
              <h4>Name</h4>
            <div class="col-lg-12">
              <input type="text" id="name" class="form-control" />
            </div>
          </div>

          <div class="form-group simple" >
            <i class="fa fa-star fa-3x"></i>
              <h4>Product</h4>
			  <div class="heading smallSpaceTop smallSpaceBottom"><span for="comment">Select the food product from this recipe:</span></div>
            <div class="col-lg-12">
              <input type="text" id="food" class="ingredients" />
            </div>
          </div>

          <div class="form-group simple">
            <i class="fa fa-users fa-3x"></i>
              <h4>How much people will it serves?</h4>
            <div class="col-lg-12">
              <input type="number" value="1" id="nopeople" min ="1" max="10" class="form-control"/>
            </div>  
          
             <div class="form-group simple">
            <i class="fa fa-clock-o fa-3x"></i>
            <div class="col-lg-12">
            <input type="checkbox" value="occasion" onclick="visibile('ptime');"> 
              <h4>Preparation Time</h4>
              <input type="text" id="ptime" class="form-control" disabled />
            </div>  
          </div>


           <div class="form-group simple">
            <i class="fa fa-clock-o fa-3x"></i>
            <div class="col-lg-12">
            <input type="checkbox" value="occasion" onclick="visibile('ctime');"> 
              <h4>Cook Time</h4>
              <input type="text" id="ctime" class="form-control" disabled />
            </div>  
          </div>


          <div class="form-group simple">
            <i class="fa fa-cutlery fa-3x"></i>
            <div class="col-lg-12">
           
              <h4>What is the cuisine of this recipe?</h4>
            
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
            </div>  
          </div>
          <div class="form-group box">
            <i class="fa fa-balance-scale fa-3x "></i>
            <div class="col-lg-12">
               <input type="checkbox" value="diet" onclick="visibile('diet');"> 
               <h4> Diet </h4>
               
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
			   
            </div>
          </div> 
          <div class="form-group box">
            <i class="fa fa-birthday-cake fa-3x"></i>
            <div class="col-lg-12">
              
               <h4>Occasion to made it?</h4>
              
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
			  
            </div>
          </div> 
           <div class="form-group box">
            <i class="fa fa-shopping-basket fa-3x"></i>
            <div class="col-lg-12">
              
               <h4>What king of dish is it?</h4>
				
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
          </div>
        
           <div class="form-group box">
            <i class="fa fa-language fa-3x"></i>
            <div class="col-lg-12"> 
               <h4>What language?</h4>
               <input type="radio" name="lang" value="en" checked>En
               <input type="radio" name="lang" value="it" > It
            </div>
          </div>




          <button type="button" class="btn btn-success " onclick="scelte('info');"><span>Continue to add Steps</span></button>
        </div>
      </div>
	</div><!-- /.container -->
	
	<div class="container text-center"  id="stages" >
        <div class="bs-component" >
		
          <input type="hidden" value="1" id="nstep">
          <i class="fa fa-file-text fa-3x"></i>
          <h3>Decribe the steps of the Stage</h3>
          <div class="row text-center" id="steps">
          <div class="form-group">
            
              <h4>Step 1</h4>
            <div >
				  <textarea class="form-control" rows="5" id="step1"></textarea>
             <!-- <input type="text" id="step1" class="form-control" />-->
            </div>
          </div>
        </div>
            <button type="button" class="btn btn-default " onclick="add('step');"><span>Add Step</span></button>
            <button type="button" class="btn btn-default " onclick="remov('step');"><span>Remove Step</span></button>
           <button type="button" class="btn btn-success " onclick="scelte('stages');"><span>Insert steps into recipes</span></button>
		   
		   
        </div>
		
	</div>
	
	
	<div class="container text-center"  id="ingredients">
       
		
          <input type="hidden" value="1" id="ningredient" >
          
          <div class="suggest">What are the ingredients of this recipe?</div>
          <div  id="ingredients1">
		  <i class="fa fa-shopping-cart fa-3x"></i>
              <h4>Ingredient 1</h4>
          <div class="form-group col-xs-12">
            
            <div class="col-sm-4">
             <div> Name </div>
              <input type="text" id="ingredient1" class="ingredients" />
			</div>
			<div class="col-sm-4">			
			Detail
              <input type="text" id="detail1" class="form-control" />
              </div>
			  <div class="col-sm-4">
			  Quantity
              <input type="number" id="quantity1" class="form-control" />
               <input type="radio" name="mis1" value="unit" onclick="show('unit','1');" checked> Unit
               <input type="radio" name="mis1" value="metric" onclick="show('metric','1');"> Metric
               <input type="radio" name="mis1" value="imperial" onclick="show('imperial','1');"> Imperial
               <select id="misurazione1" class="">
                <option value="unit">Unit</option>
               </select>
            </div>
          </div>
        </div>
		<?php
		/*echo "<i class=\"fa fa-shopping-cart fa-3x\"></i>
				<h4>Ingredient "+n+"</h4>
				<div class=\"form-group col-xs-12\">
				<div class=\"col-lg-12\">
				  <div class=\"col-sm-4\">
				<div>Name </div> 
				<input type=\"text\" id=\"ingredient"+n+"\" />
				</div>
				<div class=\"col-sm-4\">		
				Detail 
				<input type='text' id=\"detail"+n+"\" />
				</div>
				<div class=\"col-sm-4\">				
				Quantity 
				<input type='number' id=\"quantity"+n+"\" /> 
				<input type='radio' name=\"mis"+n+"\" value='unit' onclick=\"show('unit','"+n+"');\" checked> Unit 
				<input type='radio' name=\"mis"+n+"\" value='metric' onclick=\"show('metric','"+n+"');\" > 
				Metric <input type='radio' name=\"mis"+n+"\" value='imperial' onclick=\"show('imperial','"+n+"');\"> Imperial
				<select id=\"misurazione"+n+"\" disabled><option value=\"unit\">Unit</option></select></div></div></div>";
		
		*/
		?>
		
            <button type="button" class="btn btn-default " onclick="add('ingredient');"><span>Add Ingredient</span></button>
            <button type="button" class="btn btn-default " onclick="remov('ingredient');"><span>Remove Ingredient</span></button>
           <button type="button" class="btn btn-success " onclick="scelte('ingredients');"><span>Insert ingredient into recipe</span></button>
		   
       

	</div>	
	
	<div class="container text-center"  id="photo">
        <div class="bs-component "   >
          
          <h3>Upload a Photo</h3>
		  <div class="form-group">
		  <form action="saveImage.php" method="post" enctype="multipart/form-data" target="upload_target">
                     <p id="f1_upload_form" align="center"><br/>
						<label>
							<input type="hidden" value="recipe" name="photo_id" id="photo_id" />
						</label>	
                         <label> 
                              <input name="myfile" class="form-control" type="file" size="30" />
                         </label>
                         <label>
                             <input type="submit" name="submitBtn" class="form-control sbtn" value="Upload" onclick="suctoa();" />
                         </label>
                     </p>
          </form>
			</div>
			</div>
           <button type="button" class="btn btn-success " onclick="location.reload();"><span>Add another recipe</span></button>
        </div>
		</div>
		
	</div>
   
     <?php require_once("components/javascript-comune.php"); //Inclusione Javascript Comune ?>
    <!-- Script specifici di view -->
    <script src="js/addrecipe.js"></script>
    <script src="js/lib/highcharts.js"></script>
    <script src="js/lib/highcharts-more.js"></script>
    <script src="http://code.highcharts.com/themes/dark-unica.js"></script>
	 <script type="text/javascript" src="jquery.typeahead.js"></script>
	  <script type="text/javascript" src="js/lib/progressbar.js"></script>
  </body>
</html>