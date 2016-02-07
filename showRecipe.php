<?php
   //Controller di view
   require_once dirname(__FILE__). '/classes/Sessione.php';

    //Check se collegato
    $loggedin = Sessione::isLoggedIn(true);
    //Variabile per attivare contesto della topbar
    $is_showRecipe = true;
	$str = "";
	if(isset($_POST['val']))
	{
		$str = $_POST['val'];
	}
	else
		echo "post value not found";
	
	
	$arr = explode("#",$str);
	//print_r($arr);
	//VARIABILI PASSATE DALLA PAGINA CHE INVOCA QUESTA
	$recipeURI = $arr[0];				//uri oggetti
	$lang = $arr[1];						//lingua in cui visualizzare i dati
	$solidMeasure =$arr[2];		//"g","kg","ounce","pound"
	$liquidMeasure = $arr[3];
	$name = $arr[4];					//nome ricetta	//"ml","l","teaspoon","tablespoon","cup","pint"
	$serves = $arr[5];					//persone che si vogliono servire (dato della ricerca)
	$originalserves = $arr[6];		//persone servite dalla ricetta in origine (dato ontologia)
	$cuisine = $arr[7];				//cucina
	$diet = $arr[8];							//dieta
	$occasion =$arr[9];					//occasione
	$course = $arr[10];						//portata
	$cooktime =$arr[11];					//cooktime
	$preptime = $arr[12];				//preptime*/
	
	//VARIABILI PASSATE DALLA PAGINA CHE INVOCA QUESTA
	/*
	$recipeURI = $_GET['recipeURI'];				//uri oggetti
	$lang = $_GET['lang'];							//lingua in cui visualizzare i dati
	$solidMeasure = $_GET['solidMeasure'];			//"g","kg","ounce","pound"
	$liquidMeasure = $_GET['liquidMeasure'];
	$name = $_GET['name'];						//nome ricetta	//"ml","l","teaspoon","tablespoon","cup","pint"
	$serves = $_GET['serves'];						//persone che si vogliono servire (dato della ricerca)
	$originalserves = $_GET['originalserves'];		//persone servite dalla ricetta in origine (dato ontologia)
	$cuisine = $_GET['cuisine'];					//cucina
	$diet = $_GET['diet'];							//dieta
	$occasion = $_GET['occasion'];					//occasione
	$course = $_GET['course'];						//portata
	$cooktime = $_GET['cooktime'];					//cooktime
	$preptime = $_GET['preptime'];					//preptime*/
	
	
	//TEST HARDCODED
	/*
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
	*/
?>
<!DOCTYPE html>
<html lang="it">
<script src="jquery.min.js"></script>
<script src="js/showRecipe.js"></script>
	<script>
		$(document).ready(function () {
			$('[data-toggle="tooltip"]').tooltip();  //init tooltip
		});
		
		
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
    <link href="css/roboto.min.css" rel="stylesheet">-->
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
	
	<script >
	var country = "<?php echo $lang; ?>";
	</script>
     <div class="container text-center" >
       <!-- <div ><h3><?php if($lang =="en") echo "Recipe Details"; else echo "Dettagli Ricetta";  ?></h3></div>-->
	
	
<div class="container text-center"  id="wordss">
        <div class="row well"   >
          <?php 
				$url = 'http://localhost/git/CookingBot/API/get_recipe_details_API.php';
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
					'solidMeasure' => urlencode($solidMeasure),
					'cooktime' => urlencode($cooktime),
					'preptime' => urlencode($preptime)
					
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
  
  
  <!-- Trigger the modal with a button -->
<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="header">Modal Header</h4>
      </div>
      <div class="modal-body" id="content">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  
     <?php require_once("components/javascript-comune.php"); //Inclusione Javascript Comune ?>
    <!-- Script specifici di view -->
    <script src="js/lib/highcharts.js"></script>
    <script src="js/lib/highcharts-more.js"></script>
    <script src="http://code.highcharts.com/themes/dark-unica.js"></script>
	 <link href="css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />

<script src="js/lib/star-rating.min.js" type="text/javascript"></script>
  </body>
</html>
