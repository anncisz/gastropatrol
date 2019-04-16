<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Starter Template - Materialize</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/mojcss.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  
</head>
<body background="ramen.jpg">
		
      <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="index.php" class="brand-logo">GASTROPATROL</a>
		<ul class="right hide-on-med-and-down">
		<?php
	  if ((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true))
	  { ?>
  
		<li><a href="gastro.php">Moje konto</a></li>
		<li><a href="logout.php">Wyloguj</a></li>
		<?php
		} else {
		?>
		<li><a href="login.php">Zaloguj</a></li>
		<li><a href="rejestracja.php">Zarejestruj się</a></li>
		<?php
		}
		?>
    </div>
  </nav>
     <br><br> <br><br>
  <div style="background-color:white">
  <div class="row center">
  <?php
  if ((isset($_SESSION['udanarejestracja'])))
{
		echo '</br>Dziękujemy za rejestrację w serwisie! Możesz już zalogowć się na swoje konto!<br/><br/>';
		unset($_SESSION['udanarejestracja']);
}
?>
</div>
    <div >
      <br><br>
      <h1 class="header center orange-text">GASTROPATROL</h1>
      <div class="row center">
        <h5 class="header col s12 light">Przeglądaj, oceniaj, PATROLUJ z nami lokale gastronomiczne w całej Polsce!</h5>
      </div>
      <div class="row center">
        <a href="przeglądaj.php" id="download-button" class="btn-large waves-effect waves-light orange">Przeglądaj</a>
      </div>
      <br><br>

    </div>
  </div>



  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
