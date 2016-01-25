<?php
   //Controller di view
   require_once dirname(__FILE__). '/classes/Sessione.php';

    //Check se collegato
    $loggedin = Sessione::isLoggedIn(true);
    //Variabile per attivare contesto della topbar
    $is_showRecipe = true;
	
	//VARIABILI PASSATE DALLA PAGINA CHE INVOCA QUESTA
	/*$name = $_POST['name'];						//nome ricetta
	$lang = $_POST['lang'];							//lingua in cui visualizzare i dati
	$originalserves = $_POST['originalserves'];		//persone servite dalla ricetta in origine (dato ontologia)
	$serves = $_POST['serves'];						//persone che si voglio servire (dato della ricerca)
	$cuisine = $_POST['cuisine'];					//cucina
	$course = $_POST['course'];						//portata
	$occasion = $_POST['occasion'];					//occasione
	$diet = $_POST['diet'];							//dieta
	$recipeURI = $_POST['recipeURI'];				//uri oggetti
	$liquidMeasure = $_POST['liquidMeasure'];		//"ml","l","teaspoon","tablespoon","cup","pint"
	$solidMeasure = $_POST['solidMeasure'];			//"g","kg","ounce","pound"
	*/
	//TEST HARDCODED
	$lang = "it";
	$name='Insalata di pollo della mamma';
	$originalserves = 4;
	$serves = 5;
	$cuisine = "Cucina Italiana";
	$course = "Secondo Piatto";
	$occasion = "";
	$diet = "";
	$recipeURI = "comp:Recipe_insalata_di_pollo_della_mamma";
	$liquidMeasure = "ml";
	$solidMeasure = "g";
	
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
        <div class="heading"><h2>Recipe Details</h2></div>
	
	
<div class="container text-center"  id="wordss">
        <div class="bs-component well"   >
          <?php 
				$url = 'http://localhost/CookingBot/API/get_recipe_details_API.php';
				$fields = array(
					'name' => urlencode($name),
					'originalserves' => urlencode($originalserves),
					'serves' => urlencode($serves),
					'cuisine' => urlencode($cuisine),
					'course' => urlencode($course),
					'occasion' => urlencode($occasion),
					'diet' => urlencode($diet),
					'lang' => urlencode($lang),
					'recipeURI' => urlencode($recipeURI),
					'liquidMeasure' => urlencode($liquidMeasure),
					'solidMeasure' => urlencode($solidMeasure)
					
				);
				
				$fields_string='';
				//url-ify the data for the POST
				foreach($fields as $key=>$value) {
					$fields_string .= $key.'='.$value.'&';
				}
				rtrim($fields_string, '&');

				//open connection
				$ch = curl_init();

				//set the url, number of POST vars, POST data
				curl_setopt($ch,CURLOPT_URL, $url);
				curl_setopt($ch,CURLOPT_POST, count($fields));
				curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

				//execute post
				$result = curl_exec($ch);

				//close connection
				curl_close($ch);
		  ?>
       
        </div>

  </div>  
     <?php require_once("components/javascript-comune.php"); //Inclusione Javascript Comune ?>
    <!-- Script specifici di view -->
    <script src="js/lib/highcharts.js"></script>
    <script src="js/lib/highcharts-more.js"></script>
    <script src="http://code.highcharts.com/themes/dark-unica.js"></script>
  </body>
</html>
