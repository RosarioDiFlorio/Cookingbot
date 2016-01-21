<?php
   //Controller di view
   require_once dirname(__FILE__). '/classes/Sessione.php';
   include_once dirname(__FILE__).'/API/query_sparql.php';


	$res = getAllShoppingCaterogyJson();
	
	//print_r($res);
	$data = json_decode($res);
	//print_r($data->results->bindings);
	$toCicle = $data->results->bindings;
	$ar = [];
	$value = [];
	//print_r($toCicle);
	for($i = 0 ; $i<sizeof($toCicle); $i++){
		//echo $toCicle[$i]->shopping->value;
		$value[$i] = $toCicle[$i]->shopping->value;
		$ar[$i] = $toCicle[$i]->label->value;
		//echo $ar[$i];
	}
$value = array_unique($value);
$ar = array_unique($ar);
json_encode($ar);

    //Check se collegato
    $loggedin = Sessione::isLoggedIn(true);
    //Variabile per attivare contesto della topbar
    $is_addrecipe = true;
?>
<!DOCTYPE html>
<html lang="it">
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
    <link href="css/insertFood.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php require_once("components/topbar.php"); //Inclusione topbar?>

     <div class="container text-center" id="contain">
       

			<div class="heading"><h2>Help us, add a new food!</h2></div>
	
			
					<div class="bs-component  well"  >	
						
						<form id="foodForm" >
						<i class="fa fa-spoon"></i>
						<h3 class="heading">Insert the food name</h3>
						<label for="comment">Usually an ingredient is added to the plural. Please enter the ingredient in the plural where possible</label>
						<input type="text" id="food" class="form-control" />
						<h3 class="heading">Shopping category</h3>
						<div class="form-group">
							  <label for="sel1">Select list:</label>
							  <select class="form-control" id="shopping">
								<option value ="1">select a shopping category</option>
								
								<?php 
								 for($i = 0;$i < count($value); $i++)
								 {
									 echo "<option value =\"".$value[$i]."\">".$ar[$i]."</option>";
									 
								 }
								
								?>
							  </select>
						</div>
						<h3 class="heading">KJ per 100g (optional)</h3>
<label for="comment">Nutrition data: energy (in kJ) per 100g (or 100ml for liquids). <br/>
Keep this field blank if you do not have this information</label>
						<input type="number" id="kjaul" min="0" class="form-control " />
						<br />
						<h3 class="heading">Jcal per 100g (optional)</h3>
<label for="comment">Nutrition data: energy (in kcal) per 100g (or 100ml for liquids). <br/> Keep this field blank if you do not have this information</label>
						<input type="number" id="kcal" min="0" class="form-control " />
						<br />
						
						
			
						<div class="ins-alert"><div class="alert alert-danger"><strong>Warning!</strong> missed food </div></div>
												<button id="btn-insert" type="button" class="btn btn-primary"  >enter</button>
						</form>
					</div>
					
  </div><!-- /.container -->
  
  <div id="success" class="container well text-center"><h2>Success</h2><label for="comment">Click on the button to enter another food</label><br/><button id="btn-reload" type="button" class="btn btn-primary"  >insert another food</button>
</div>
  
    <!-- Script specifici di view -->
    <script src="js/insertFood.js"></script>
    <?php require_once("components/javascript-comune.php"); //Inclusione Javascript Comune ?>
	 <script src="js/lib/highcharts.js"></script>
    <script src="js/lib/highcharts-more.js"></script>
    <script src="http://code.highcharts.com/themes/dark-unica.js"></script>

</body>
</html>
