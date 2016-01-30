<?php
   //Controller di view
	require_once dirname(__FILE__). '/classes/Sessione.php';
	require_once  dirname(__FILE__).'/API/http_API.php';
	require_once  dirname(__FILE__).'/API/query_sparql.php';
	require_once  dirname(__FILE__).'/API/get_food_API.php';
	include_all_php("API/API_SPARQL");
    //Check se collegato
	$loggedin = Sessione::isLoggedIn(true);
    //Variabile per attivare contesto della topbar
    $is_addrecipe = true;
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
    <link href="css/roboto.min.css" rel="stylesheet"> -->
    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">

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
						

 

    <div class="row  ">
						<div><label for="comment" class="suggest">enter the food you want to search</label></div>
						<div>	<input class=" ingredients col-ms-12" type="text" placeholder="search a food"  id="food" ></div>
							<button id="btn-insert" type="button" class="btn btn-success smallSpaceTop" >enter</button>
					
					<div id="toAppend"></div>
						<button id="btn-subs" type="button" class="btn btn-success smallSpaceTop"  >See all substitution</button>
					<div id="toAppendSubs" class="col-sm-12" > </div>
					
    </div>
		
  </div><!-- /.container -->
   
    <!-- Script specifici di view -->
   

 <script src="js/searchFood.js"></script>
<?php require_once("components/javascript-comune.php"); //Inclusione Javascript Comune ?>
	 <script src="js/lib/highcharts.js"></script>
    <script src="js/lib/highcharts-more.js"></script>
    <script src="http://code.highcharts.com/themes/dark-unica.js"></script>
	  <script src="js/measure.js"></script>
   <script type="text/javascript" src="jquery.typeahead.js"></script>
   <link href="css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />

<script src="js/lib/star-rating.min.js" type="text/javascript"></script>
   
</body>
</html>
