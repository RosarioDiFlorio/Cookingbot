<?php
   //Controller di view
   require_once dirname(__FILE__). '/classes/Sessione.php';
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
    <!-- Tema material design 
    <link href="css/material.min.css" rel="stylesheet">
    <link href="css/material-fullpalette.min.css" rel="stylesheet">
    <link href="css/ripples.min.css" rel="stylesheet">
    <link href="css/roboto.min.css" rel="stylesheet">-->
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

     <div class="container text-center ">
	 
		 
						<div class="heading" ><h2>Substitute of: Ingredient</h2></div>
						
			<div class="row well">
				
			<i class="glyphicon glyphicon-transfer big "></i>
						
						<div ><strong>In this section, besides being able to see what are the possible replacements for an ingredient, you can give your feedback to the replacement. In order to submit your feedback you need to log in</strong>
						</div>
	 
					
						
						<!--SUBSTITUTION-->
						<div class=" col-sm-4">	
						<h4 class="heading ">substitution 1</h4>
						<table class="table table-bordered ">
						<tr>
						<td><i class="fa fa-cutlery minIcon"></i> </td>
							<td><i class="glyphicon glyphicon-scale minIcon" ></i> </td>
						</tr>
						
						<tr>
						<td > ingredient name</td>
							<td> 300 ml</td>
						</tr>
						<tr>
						<td> ingredient name</td>
							<td> 300 ml</td>
						</tr>
						<tr>
						<td>ingredient name</td>
							<td> 300 ml</td>
						</tr>
						<tr>
						<td > <h3>rating</h3></td><td><h3>83</h3></td>
						</tr>
						<tr>
						<td > <h3>rate this substitution</h3></td><td><h3><i class="glyphicon glyphicon-thumbs-up  minIcon"></i>  <i class="glyphicon glyphicon-thumbs-down  minIcon"></i></h3></td>
						</tr>
						
						
						</table>
						</div><!-- END SUBSTITUTION-->
						
						
						<!--SUBSTITUTION-->
						<div class=" col-sm-4">	
						<h4 class="heading ">substitution 2</h4>
						<table class="table table-bordered ">
						<tr>
						<td><i class="fa fa-cutlery minIcon"></i> </td>
							<td><i class="glyphicon glyphicon-scale minIcon" ></i> </td>
						</tr>
						
						<tr>
						<td > ingredient name</td>
							<td> 300 ml</td>
						</tr>
						<tr>
						<td> ingredient name</td>
							<td> 300 ml</td>
						</tr>
						<tr>
						<td>ingredient name</td>
							<td> 300 ml</td>
						</tr>
						<tr>
						<td > <h3>rating</h3></td><td><h3>-2</h3></td>
						</tr>
						<tr>
						<td > <h3>rate this substitution</h3></td><td><h3><i class="glyphicon glyphicon-thumbs-up  minIcon"></i>  <i class="glyphicon glyphicon-thumbs-down  minIcon"></i></h3></td>
						</tr>
						
						
						</table>
						</div><!-- END SUBSTITUTION-->
						
						
						
						<!--SUBSTITUTION-->
						<div class=" col-sm-4">	
						<h4 class="heading ">substitution 3</h4>
						<table class="table table-bordered ">
						<tr>
						<td><i class="fa fa-cutlery minIcon"></i> </td>
							<td><i class="glyphicon glyphicon-scale minIcon" ></i> </td>
						</tr>
						<tr>
						
						<td > ingredient name</td>
							<td> 300 ml</td>
						</tr>
						<tr>
						<td> ingredient name</td>
							<td> 300 ml</td>
						</tr>
						<tr>
						<td>ingredient name</td>
							<td> 300 ml</td>
						</tr>
						<tr>
						<td > <h3>rating</h3></td><td><h3>99</h3></td>
						</tr>
						<tr>
						<td > <h3>rate this substitution</h3></td><td><h3><i class="glyphicon glyphicon-thumbs-up  minIcon"></i>  <i class="glyphicon glyphicon-thumbs-down  minIcon"></i></h3></td>
						</tr>
						
						
						</table>
						</div><!-- END SUBSTITUTION-->
						
											
											
						
			</div>
				
  </div><!-- /.container -->
     <!-- Script specifici di view -->
    <script src="js/insertFood.js"></script>
    <?php require_once("components/javascript-comune.php"); //Inclusione Javascript Comune ?>
	 <script src="js/lib/highcharts.js"></script>
    <script src="js/lib/highcharts-more.js"></script>
    <script src="http://code.highcharts.com/themes/dark-unica.js"></script>

</body>
</html>
