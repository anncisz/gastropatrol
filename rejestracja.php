<?php

session_start();

if (isset($_POST['email']))
{
	//Udana walidacja? 
	$ok = true;
	
	$nick = $_POST['nick'];
	
	if((strlen($nick)<3)||(strlen($nick)>20))
	{
		$ok=false;
		$_SESSION['e_nick']="Nick musi posiadać od 3 do 20 znaków";
	}
	
	if(ctype_alnum($nick)==false)
	{
		$ok=false;
		$_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr(bez polskich znaków)";
	}
	
	$email = $_POST['email'];
	
	$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
	
	if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($email!=$email))
	{
		$ok=false;
		$_SESSION['e_email']="Podaj poprawny adres e-mail";
	}
	
	$haslo=$_POST['haslo'];
	$haslo2=$_POST['haslo2'];
	
	if((strlen($haslo)<8) || (strlen($haslo)>20))
	{
		$ok=false;
		$_SESSION['e_haslo']="Hasło musi posidać od 8 do 20 znaków";
	}
	
	if($haslo!=$haslo2)
	{
		$ok=false;
		$_SESSION['e_haslo']="Podane hasła nie są identyczne";
	}
	
	$telefon=$_POST['telefon'];
	
	if((strlen($telefon)!=9) && (!is_int($telefon)))
	{
		$ok = false;
		$_SESSION['e_telefon'] = "Wpisz poprawny numer telefonu";
	}
	
	$sekret = "6LfYWokUAAAAAHCYkkje48Uql3WrPrAHtM7BXlx1";
	
	$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
	
	$odpowiedz = json_decode($sprawdz);
	
	if($odpowiedz->success==false)
		{
		$ok=false;
		$_SESSION['e_bot']="Potwierdż, że nie jesteś botem";
	}
	
	$haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);
	
	require_once "connect.php";
	
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	$imie = $_POST['imie'];
	$nazwisko = $_POST['nazwisko'];
	
	try
	{
		$connection = new mysqli($host, $db_user, $db_password, $db_name);
		if($connection->connect_errno!=0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		else
		{
			$rezultat = $connection->query("SELECT userid FROM user WHERE email='$email'");
			
			if(!$rezultat) throw new Exception($connection->error);
			
			$ile_takich_maili = $rezultat->num_rows;
			
			if($ile_takich_maili>0)
			{
				$ok=false;
				$_SESSION['e_email']="Istenieje juz konto prypisane do tego adresu e-mail";
			}
			
			$rezultat = $connection->query("SELECT userid FROM user WHERE nick='$nick'");
			
			if(!$rezultat) throw new Exception($connection->error);
			
			$ile_takich_nickow = $rezultat->num_rows;
			
			if($ile_takich_nickow>0)
			{
				$ok=false;
				$_SESSION['e_nick']="Istenieje już konto o tym nicku";
			}
			
			if($ok==true)
			{
				if($connection->query("INSERT INTO user VALUES(NULL, '$imie', '$nazwisko', '$nick', '$haslo_hash', '$telefon', '$email')"))
				{
					$_SESSION['udanarejestracja']=true;
					header('Location: index.php');
				}
				else
				{
					throw new Exception($connection->error);
				}
			}
			
			$connection->close();
		}
	}
	catch(Exception $e)
	{
		echo '<span style="color:red;">Błąd serwera! </span>';
		echo $e;
	}
}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
	<title>gastropatrol - rejestracja</title>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	
	</head>
<body>
<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
 <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="index.php" class="brand-logo">GASTROPATROL</a>
    </div>
  </nav>
<form method="post">
Imię: <br/> <input type="text" name="imie"/><br/>
Nazwisko: <br/> <input type="text" name="nazwisko"/><br/>

<?php

if (isset($_SESSION['e_nick']))
{
	echo '<div class="red-text">'.$_SESSION['e_nick'].'</div>';
	unset($_SESSION['e_nick']);
}
?>

Nick: <br/> <input type="text" name="nick"/><br/>

<?php

if (isset($_SESSION['e_haslo']))
{
	echo '<div class="red-text">'.$_SESSION['e_haslo'].'</div>';
	unset($_SESSION['e_haslo']);
}
?>

Hasło: <br/> <input type="password" name="haslo"/><br/>
Powtorz haslo: <br/> <input type="password" name="haslo2"/><br/>

<?php

if (isset($_SESSION['e_telefon']))
{
	echo '<div class="red-text">'.$_SESSION['e_telefon'].'</div>';
	unset($_SESSION['e_telefon']);
}
?>

Numer telefonu: <br/> <input type="text" name="telefon"/><br/>

<?php

if (isset($_SESSION['e_email']))
{
	echo '<div class="red-text">'.$_SESSION['e_email'].'</div>';
	unset($_SESSION['e_email']);
}
?>

Adres e-mail: <br/> <input type="text" name="email"/><br/>

<?php

if (isset($_SESSION['e_bot']))
{
	echo '<div class="red-text">'.$_SESSION['e_bot'].'</div>';
	unset($_SESSION['e_bot']);
}
?>

<br/><div class="g-recaptcha" data-sitekey="6LfYWokUAAAAADgKnopayHxK3PvjPY9N7PDFW8-_"></div>

<br/><input type="submit" value="Zarejestruj się" id="download-button" class="btn-large waves-effect waves-light orange"/><br/><br/>

</form>
	
</body>
</html>