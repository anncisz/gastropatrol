<?php
	session_start();

	require_once "connect.php";
	
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	try
	{
		$connection = new mysqli($host, $db_user, $db_password, $db_name);
		if($connection->connect_errno!=0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		else
		{
			$rezultat = $connection->query("SELECT * FROM photo WHERE photoid=2");
			
			if(!$rezultat) throw new Exception($connection->error);
			
			$ile_takich_maili = $rezultat->num_rows;
			
			if($ile_takich_maili>0)
			{
				$ok=false;
				$_SESSION['e_email']="Istenieje juz konto prypisane do tego adresu e-mail";
			}
			
			$row = $rezultat->fetch_assoc();
			
			$_SESSION['zdjecie'] = $row['sciezka'];
			
			$connection->close();
		}
	}
	catch(Exception $e)
	{
		echo '<span style="color:red;">Błąd serwera! </span>';
		echo $e;
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
<?php
 $image = $_SESSION['zdjecie'];
$imageData = base64_encode(file_get_contents($image));
echo '<img src="data:image/jpeg;base64,'.$imageData.'">';

	?>
	
</body>
</html>