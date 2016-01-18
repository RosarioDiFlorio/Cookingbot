<?php
   //Controller di view
	require_once dirname(__FILE__). '/classes/Sessione.php';
	include_once dirname(__FILE__).'/API/http_API.php';
	include_once dirname(__FILE__).'/API/query_sparql.php';

    //Check se collegato
    $loggedin = Sessione::isLoggedIn(true);
    //Variabile per attivare contesto della topbar
    $is_addrecipe = true;
	
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
		
		
			
		$(document).ready(function () {
			$('input.ingredients').typeahead({
                name: 'ingredients',
                local: <?php echo json_encode($ar) ?>
					

				})
				
		
			
			
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
    <!-- Tema material design -->
    <link href="css/material.min.css" rel="stylesheet">
    <link href="css/material-fullpalette.min.css" rel="stylesheet">
    <link href="css/ripples.min.css" rel="stylesheet">
    <link href="css/roboto.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">
    <!-- CSS Specifico della view-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="css/getSubstitutions.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php require_once("components/topbar.php"); //Inclusione topbar?>

     <div class="container text-center">
	 
		 
		<div class="heading" ><h2>Search a Food</h2></div>
						

 

    <div class="bs-component  well ">
						<div><label for="comment">enter the food you want to search</label></div>
							<input class="form-control ingredients " type="text" placeholder="food"  id="food"><button id="btn-insert" type="button" class="btn btn-primary"  >enter</button>
					
    </div>
		
  </div><!-- /.container -->
   
    <!-- Script specifici di view -->
   
    <script type="text/javascript" src="jquery.typeahead.js"></script>
 <script src="js/searchFood.js"></script>
</body>
</html>