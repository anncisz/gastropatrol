<?php

session_start();

if ((!isset($_SESSION['udanarejestracja'])))
{
	header('Location:login.php');
	exit();
}
else
{
	unset($_SESSION['udanarejestracja']);
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

Dziękujemy za rejestrację w serwisie! Możesz już zalogowć się na swoje konto!<br/><br/>

<a href="login.php">Zaloguj się na swoje konto! </a>
<br/><br/>
	
	
</body>
</html>