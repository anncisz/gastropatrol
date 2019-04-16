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
			$idobiektu = $_GET['idobiektu'];
			
			$connection->set_charset("utf8");
			$rezultat = $connection->query("SELECT * FROM object WHERE objectid='$idobiektu'");
			
			if(!$rezultat) throw new Exception($connection->error);
			
			$row = $rezultat->fetch_assoc();
			
			
			$_SESSION['nazwa'] = $row['nazwa'];
			$_SESSION['adres'] = $row['adres'];
			$_SESSION['miasto'] = $row['miasto'];
			$_SESSION['rok'] = $row['rok otwarcia'];
			$idkategorii = $row['idkategorii'];
	
			$rezultat2 = $connection->query("SELECT * FROM category WHERE categoryid='$idkategorii'");
			
			if(!$rezultat2) throw new Exception($connection->error);
			
			$row2 = $rezultat2->fetch_assoc();
			
			$_SESSION['kategoria'] = $row2['nazwa'];
			
			$rezultat3 = $connection->query("SELECT * FROM rating WHERE idobiektu='$idobiektu'");
			
			if(!$rezultat3) throw new Exception($connection->error);
			
			$row3 = $rezultat3->fetch_assoc();
			
			$_SESSION['ocena'] = $row3['srednia'];
			
			$rezultat4 = $connection->query("SELECT * FROM photo WHERE idobiektu='$idobiektu'");
			
			if(!$rezultat4) throw new Exception($connection->error);
			
			$row4 = $rezultat4->fetch_assoc();
			
			$_SESSION['zdjecie'] = $row4['sciezka'];
			
			header('Location: obiekt.php');
		
		$connection->close();
		
		}
	}catch(Exception $e)
	{
		echo '<span style="color:red;">Błąd serwera! </span>';
		echo $e;
	}
?>
