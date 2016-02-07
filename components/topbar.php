<?php
    //Lo script non si può contattare dall'esterno
    if (basename(__FILE__) == basename($_SERVER['PHP_SELF']))
        exit();
	
	require_once dirname(__FILE__) . "/MasterText.php";
	require_once dirname(__FILE__) . "/geoCheckIP.php";
	
	$lang;
	if(isset($_GET['lang']))
	{
	 $lang = $_GET['lang'];
	}else
	{
	   $lang = getCountryCodeFromIP();
	}
	
	$masterText = new MasterText($lang,true);
?>
<html>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
<link href="css/topbar.css" rel="stylesheet">
</head>
<link href="css/flagsmin.css" rel="stylesheet">
<!-- Topbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Attiva navigazione</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"> <img src="img/cookingbot.png" alt="Logo GRI" /> CookingBot</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li <?php if(isset($is_index)) echo 'class="active"'; ?>><a href="index.php">Home</a></li>


        <li <?php if(isset($is_add)) echo 'class="active"'; ?> class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php $masterText->_("addMenu") ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="addRecipe.php"><?php $masterText->_("recipeMenu") ?></a></li>
            <li><a href="addSubstitution.php"><?php $masterText->_("substitutionMenu") ?></a></li>
            <li><a href="insertFood.php"><?php $masterText->_("foodMenu") ?></a></li>
          </ul>
        </li>




        <li <?php if(isset($is_search)) echo 'class="active"'; ?> class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php $masterText->_("searchMenu") ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="getRecipes.php"><?php $masterText->__("recipeMenu") ?></a></li>
            <li><a href="searchFood.php"><?php $masterText->__("substitutionsMenu") ?></a></li>
          </ul>
        </li>

       <script>
	   
	   var base = '<?php echo basename($_SERVER['PHP_SELF']); ?>';
	   var topbarLang = '<?php echo $lang ?>';
	   function cambiaLingua(val)
	   {
		   //pagine in cui non si può cambiare lingua
			if(base == 'showRecipe.php')
			{	if(topbarLang == 'IT')
					alert("perfavore chiudi questa pagina per cambiare lingua. Effettua la ricerca in italiano");
				else
					alert("please close this page then change language in another page. Search in english")
			}else
				window.location.replace(base+'?lang='+val);
	   }
	   
	   </script>

        </ul>
      <ul class="nav navbar-nav navbar-right">
		<!--<li><a href="#" onclick="cambiaLingua('EN')" >English</a></li>
			<li><a href="#" onclick=" cambiaLingua('IT');"> Italiano</a> </li>
         -->
		 <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Language<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#" onclick="cambiaLingua('EN')" >English</a></li>
			<li><a href="#" onclick=" cambiaLingua('IT');"> Italiano</a> </li>
            </ul>
          </li>

        <?php if($loggedin) { ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['email']; ?><span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="scripts/logout.php">Logout</a></li>
            </ul>
          </li>
        <?php }
        else { 
          echo '<li><a href="login.php">Login</a></li>';
         } ?>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
<!-- fine topbar -->
</html>