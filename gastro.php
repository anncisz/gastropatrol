	<?php
	session_start();
	
	if(!isset($_SESSION['logged']))
	{
		header('Location: login.php');
		exit();
	}
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
		<li><a href="logout.php">Wyloguj</a></li>
		<?php
		} else {
		?>
		<li><a href="login.php">Zaloguj</a></li>
		<?php
		}
		?>
		 </ul>
    </div>
  </nav>

  <?php
  
  
	echo "<p>Witaj, ".$_SESSION['nick']."!";
	echo "<p><b>DANE UŻYTKOWNIKA</b></p>";
	echo "<p><b>Imię: </b>".$_SESSION['first name']."</p>";
	echo "<p><b>Nazwisko: </b>".$_SESSION['last name']."</p>";
	echo "<p><b>Adres e-mail: </b>".$_SESSION['e-mail']."</p>";
	echo "<p><b>Telephone number: </b>".$_SESSION['telephone number']."</p>";
  ?>
	
	
</body>
</html>