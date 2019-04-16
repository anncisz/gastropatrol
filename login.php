<?php

session_start();

if ((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true))
{
	header('Location:index.php');
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

    </div>
  </nav>
<br/><br/>
<form action="zaloguj.php" method="post">

Login:<br/> <input type="text" name="login" /><br/>
Hasło:<br/> <input type="password" name="password" /><br/><br/>
<br/><input type="submit" value="Zaloguj się" id="download-button" class="btn-large waves-effect waves-light orange"/><br/><br/>

</form>

<?php

if(isset($_SESSION['error'])) echo '<div class="red-text">'.$_SESSION['error'];
unset($_SESSION['error']);
?>
	
	
</body>
</html>