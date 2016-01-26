<?php
   //Controller di view
   require_once dirname(__FILE__). '/classes/Sessione.php';
    include_once dirname(__FILE__).'/API/query_sparql.php';

	
    //Check se collegato
    $loggedin = Sessione::isLoggedIn(true);
    //Variabile per attivare contesto della topbar
    $is_add= true;
	if(!$loggedin)
	{
		header("Location: index.php?message=noLogin");
		die();
	}
	
	$base = getPrefix();
		
	$query = $base . "SELECT ?label WHERE { ?food rdf:type comp:Food; rdfs:label ?label}";
	
	$res = sparqlQuery($query,"json");
	//print_r($res);
	$data = json_decode($res);
	//print_r($data->results->bindings);
	$toCicle = $data->results->bindings;
	$ar = [];
	for($i = 0 ; $i<sizeof($toCicle); $i++){
		//print_r($toCicle[$i]->label->value);
		$ar[$i] = $toCicle[$i]->label->value;
	}
//$ar = array('apple', 'orange', 'banana', 'strawberry');
$ar = array_unique($ar);
json_encode($ar);


?>

<!DOCTYPE html>
<html lang="it">
<script src="jquery.min.js"></script>
    <link href="typeahead.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
		
		var locale = <?php echo json_encode($ar) ?>;
			
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
					
						<div><label for="comment">enter the food you want to search</label></div>
							<input class="form-control ingredients" type="text" placeholder="food"  id="sel1" />
					
						<br />
						
						<i class="glyphicon glyphicon-transfer "></i>
						<div class="heading"><h2>Enter the substitutes ingredients</h2></div>
						
						<div class="input_fields_wrap ">
							
							
					<div >
							<h3 class="heading">food</h3>
							<input class=" form-control ingredients " type="text" name="mytext[]" onfocus="$(this).css('background','');" />
							<h3 class="heading">quantity</h3>
							<input type="text"  class="col-ms-12 " name="quantity[]" />
               <input type="radio" name="mis1" value="unit" onclick="show('unit','1');"> Unit
               <input type="radio" name="mis1" value="metric" onclick="show('metric','1');"> Metric
               <input type="radio" name="mis1" value="imperial" onclick="show('imperial','1');"> Imperial
               <select id="misurazione1" class="" disabled>
               </select></div>
           
			
						</div>
						<button type="button" class="btn btn-primary add_field_button">Add More Ingredients</button>
						<button href="#" type="button" class=" btn btn-primary  remove_field" >Remove last</button>
						<br />
						<i class="glyphicon glyphicon-scale" ></i>
						<h3 class="heading">resulting quantity</h3>
						
			 <div class="col-lg-12">
             <input type="text" name="qantityResult" class="col-ms-12" />
               <input type="radio" name="misResult" value="unit" onclick="show('unit','Result');"> Unit
               <input type="radio" name="misResult" value="metric" onclick="show('metric','Result');"> Metric
               <input type="radio" name="misResult" value="imperial" onclick="show('imperial','Result');"> Imperial
               <select id="misurazioneResult" class="" disabled>
               </select>
            </div>

			
			
			
			
						</form>
						<div class="ins-alert"><div class="alert alert-danger"><strong>Warning!</strong> One or more ingredient missed</div></div>
						<button id="btn" type="button" class="btn btn-primary" >enter</button>
				
						
				
					</div>		
	</div><!-- /.container -->
  <!-- Script specifici di view -->
    
    <script src="js/addSubstitution.js"></script>
	<?php require_once("components/javascript-comune.php"); //Inclusione Javascript Comune ?>
	 <script src="js/lib/highcharts.js"></script>
    <script src="js/lib/highcharts-more.js"></script>
    <script src="http://code.highcharts.com/themes/dark-unica.js"></script>
	  <script src="js/measure.js"></script>
   <script type="text/javascript" src="jquery.typeahead.js"></script>
   
</body>
</html>
