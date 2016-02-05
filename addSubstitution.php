<?php
   //Controller di view
   require_once dirname(__FILE__). '/classes/Sessione.php';
    include_once dirname(__FILE__).'/API/query_sparql.php';
	require_once  dirname(__FILE__).'/API/get_food_API.php';
	include_all_php("API/API_SPARQL");
	
    //Check se collegato
    $loggedin = Sessione::isLoggedIn(true);
    //Variabile per attivare contesto della topbar
    $is_addSubstitution = true;
	if(!$loggedin)
	{
		header("Location: index.php?message=noLogin");
		die();
	}
	
   $arr = getAllFoodsAPI();
   $toSearch = "";
   if(isset($_GET['food']))
   {
	   
	   $toSearch = $_GET['food'];
   }
?>

<!DOCTYPE html>
<html lang="it">
<script src="jquery.min.js"></script>
    <link href="typeahead.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
		
		var locale = <?php echo $arr; ?>;
			
		$(document).ready(function () {
			
			$('input.ingredients').typeahead({
               // name: 'ingredients',
                local: locale
				
				
				
			})
				
		
			
			
		});
	</script>
  <head>
   <script src="js/lib/jquery-1.11.3.min.js"></script>
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
    <link href="css/addSubstitution.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	
	<?php require_once("components/topbar.php"); //Inclusione topbar?>
	<?php require_once("components/waitdialog.php"); ?>
	<div class="container text-center" id="contMain">
			
						<div class="heading"><h2>Select an ingredient that you want to replace</h2></div>
					
					<div class="bs-component">	
					<form id="formSubstitute">
					
						<div><label for="comment" class="suggest">enter the food you want to search</label></div>
						
							<input class=" ingredients" type="text" <?php if($toSearch== "")echo  "placeholder=\"food\"";else echo "value=\"".$toSearch."\"" ?>  id="sel1" />
					
						<br />
						
						<i class="glyphicon glyphicon-circle-arrow-down smallSpaceTop"></i>
						<div class="heading"><h2>Enter the substitutes ingredients</h2></div>
						<div class="heading smallSpaceBottom smallSpaceTop suggest">add or remove these fields for many ingredients we need to create a replacement to the ingredient desired</div>
						<div class="input_fields_wrap ">
							
							
								<div class="col-sm-12 ">
								<div class="heading ">food</div>
								<input class=" ingredients " type="text" name="mytext[]" onfocus="$(this).css('background','');" />
								<div class="heading ">quantity</div>
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
								<input type="number" min="0" class="form-control " name="quantity[]" />
								<input type="radio" name="mis1" value="unit" onclick="show('unit','1');"> Unit
								<input type="radio" name="mis1" value="metric" onclick="show('metric','1');"> Metric
								<input type="radio" name="mis1" value="imperial" onclick="show('imperial','1');"> Imperial
								<select id="misurazione1" class="" disabled>
								</select>
								</div>
								</div>
           
			
						</div>
			<div class="col-xs-12">
						<button type="button" class="btn btn-info add_field_button smallSpaceTop smallSpaceBottom">Add More Ingredients</button>
						<button href="#" type="button" class=" btn btn-info  remove_field smallSpaceTop smallSpaceBottom" >Remove last</button>
						<br />
						<i class="glyphicon glyphicon-scale" ></i>
						<h3 class="heading">resulting quantity</h3>
					<div class="heading smallSpaceBottom smallSpaceTop suggest">you can specify the amount resulting in the following field</div>
				<div class="col-sm-4"></div>
				<div class="col-sm-2"><input type="number" min="0" name="qantityResult" class="form-control" /></div>
				<div class="col-sm-4">
					<input type="radio" name="misResult" value="unit" onclick="show('unit','Result');"> Unit
					<input type="radio" name="misResult" value="metric" onclick="show('metric','Result');"> Metric
					<input type="radio" name="misResult" value="imperial" onclick="show('imperial','Result');"> Imperial
					<select id="misurazioneResult" class="" disabled>
					</select>
				</div>
            </div>

			
			
			
			
						</form>
					<div class="col-sm-12">	
						<div class="ins-alert"><div class="alert alert-danger"><strong>Warning!</strong> One or more ingredient missed</div></div>
						<button id="btn" type="button" class="btn btn-success btn-lg smallSpaceTop" >enter</button>
					</div>
						
				
		</div>		
	</div><!-- /.container -->
	
	  <div id="success" class="container well text-center"><h2>Success</h2><label for="comment">Click on the button to enter another substitutions</label><br/><button id="btn-reload" type="button" class="btn btn-primary"  >insert another substitition</button>
</div>
	
	<!-- Trigger the modal with a button -->
<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

<!-- Modal -->
<div id="modalResume" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content text-center">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		
        <h4 class="modal-title">Resume of substitute</h4>
      </div>
      <div class="modal-body" id="modalSubList">
       
		<i class="glyphicon glyphicon-cutlery"></i>
		<div id="nameFoodModal"><h2><strong>food 100ml</strong></h2></div>
			<div class="suggest">it is replaceable</div><i class="glyphicon glyphicon-triangle-bottom"></i>
	    <div id="subsFoodModal">
			<div class="subsModal">
				
				<div><h2><strong>food 100ml</strong></h2></div>
			</div>
			<div class="subsModal">
				<i class="glyphicon glyphicon-plus"></i>
				<div><h2><strong>food 100ml</strong></h2></div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="btn-insert">Accept and insert</button>
		 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
	
	
  <!-- Script specifici di view -->
    
    <script src="js/addSubstitution.js"></script>
	<?php require_once("components/javascript-comune.php"); //Inclusione Javascript Comune ?>
	 <script src="js/lib/highcharts.js"></script>
    <script src="js/lib/highcharts-more.js"></script>
    <script src="http://code.highcharts.com/themes/dark-unica.js"></script>
	  <script src="js/measure.js"></script>
   <script type="text/javascript" src="jquery.typeahead.js"></script>
    <script type="text/javascript" src="js/lib/progressbar.js"></script>
   
</body>
</html>
