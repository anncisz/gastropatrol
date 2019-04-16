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
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  
</head>
<body>
		
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
    
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
   
				?>
				<div class="page-footer orange">
				<div class="container">
				<div class="row">
				<div class="col l6 s12">
				<?php
				echo "<b>".$row2['nazwa']." ".$row['nazwa']."</b></br>";
				echo $row['adres']."</br></br>";
				
				?>


				</div>
				<div class="col l3 s12">
				<a href = "pobierzobiekt.php?idobiektu=<?php echo $row['objectid'];?>" id="download-button" class="btn-small">info oraz fotki</a>
				</div>
				</div>
				</div>
				</div>
			
		
    </div>
  </div>



  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
