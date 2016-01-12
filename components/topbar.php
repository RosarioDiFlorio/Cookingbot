<?php
    //Lo script non si può contattare dall'esterno
    if (basename(__FILE__) == basename($_SERVER['PHP_SELF']))
        exit();
?>
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
      <a class="navbar-brand" href="index.php"> <img src="img/grimini.png" alt="Logo GRI" /> CookingBot</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li <?php if(isset($is_index)) echo 'class="active"'; ?>><a href="index.php">Home</a></li>
            <li <?php if(isset($is_addrecipe)) echo 'class="active"'; ?>><a href="addrecipe.php">Add Recipe</a></li>
        <li <?php if(isset($is_wizard)) echo 'class="active"'; ?>><a href="wizardbase.php">Wizard Avanzato</a></li>
        <li <?php if(isset($is_aggiungi)) echo 'class="active"'; ?>><a href="aggiungi.php">Aggiungi offerta</a></li>
		 <li <?php if(isset($is_tutto)) echo 'class="active"'; ?>><a href="allIstance.php">Mostra Tutto</a></li>
		  </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if($loggedin) { ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['email']; ?><span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="scripts/logout.php">Logout</a></li>
            </ul>
          </li>
        <? }
        else { ?>
          <li><a href="login.php">Login</a></li>
        <?php } ?>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
<!-- fine topbar -->