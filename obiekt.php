<?php

	session_start();


?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
	<title>gastropatrol</title>
	</head>
<body>

<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
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
<br/><br/>

<?php
	echo '<h5 class="header col s12 light">'.$_SESSION['kategoria'].' '.$_SESSION['nazwa'].'</h5>';
	echo "<p><b>DANE LOKALU</b></p>";
	echo "<p><b>Adres: </b>".$_SESSION['adres']."</p>";
	echo "<p><b>Miasto: </b>".$_SESSION['miasto']."</p>";
	echo "<p><b>Rok otwarcia: </b>".$_SESSION['rok']."</p>";
	echo "<p><b>Ocena użytkowników: </b>".$_SESSION['ocena']."</p>";
	$image = $_SESSION['zdjecie'];
	$imageData = base64_encode(file_get_contents($image));
	echo '<div class="row center"><img src="data:image/jpeg;base64,'.$imageData.'" height="500" width="420"></div>';
?>
	
	
</body>
</html>