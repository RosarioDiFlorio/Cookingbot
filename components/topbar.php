<?php
    //Lo script non si può contattare dall'esterno
    if (basename(__FILE__) == basename($_SERVER['PHP_SELF']))
        exit();
?>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
<link href="css/topbar.css" rel="stylesheet">
</head>
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
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Add <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="addRecipe.php">Recipe</a></li>
            <li><a href="addSubstitution.php">Substitution</a></li>
            <li><a href="insertFood.php">Food</a></li>
          </ul>
        </li>




        <li <?php if(isset($is_search)) echo 'class="active"'; ?> class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Search <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="getRecipes.php">Recipes</a></li>
            <li><a href="searchFood.php">Substitutions</a></li>
          </ul>
        </li>

       

        </ul>
      <ul class="nav navbar-nav navbar-right">
         <li><a href="http://www.facebook.com/cookingbot" target="_blank"><i class="fa fa-facebook"></i></a></li>

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