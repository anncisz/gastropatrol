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
			echo $_POST['objectidocena'].'</br>';
			$idobiektu = $_POST['objectidocena'];
			echo 'idobiektu: '.$idobiektu.'</br>';
			
			if(isset($_POST['1'])){
			$ocena=(int)$_POST['1'];
			}
			if(isset($_POST['2'])){
			$ocena=(int)$_POST['2'];
			}
			if(isset($_POST['3'])){
			$ocena=(int)$_POST['3'];
			}
			if(isset($_POST['4'])){
			$ocena=(int)$_POST['4'];
			}
			if(isset($_POST['5'])){
			$ocena=(int)$_POST['5'];
			}
			if(isset($_POST['6'])){
			$ocena=(int)$_POST['6'];
			}
			$rezultat = $connection->query("SELECT * FROM object WHERE objectid='$idobiektu'");
			
			if(!$rezultat) throw new Exception($connection->error);
			
			$row = $rezultat->fetch_assoc();
			
			$rezultat2 = $connection->query("SELECT * FROM rating WHERE idobiektu='$idobiektu'");
			
			if(!$rezultat2) throw new Exception($connection->error);
			
			$row2 = $rezultat2->fetch_assoc();
		
			$idoceny = (int)$row2['ratingid'];
		
			$srednia = (int)$row2['srednia'];
			
			$suma = (int)$row2['suma'];
			
			$ilosc = (int)$row2['iloscocen'];
			
			$nowasuma = $suma + $ocena;
			
			$nowailosc = $ilosc + 1;
			
			$nowasrednia = $nowasuma/$nowailosc;
			
			echo $nowasrednia.'</br>';
			$iduzytkownika = $_SESSION['id'];
			if($connection->query("INSERT INTO user_rating VALUES(NULL, '$idoceny', '$ocena', '$iduzytkownika', '$idobiektu')"))
				{
					//$_SESSION['udanarejestracja']=true;
					//header('Location: witamy.php');
				}
				else
				{
					throw new Exception($connection->error);
				}
				
				
			if($connection->query("UPDATE rating SET srednia='$nowasrednia', suma='$nowasuma', iloscocen='$nowailosc' WHERE ratingid='$idoceny'"))
				{
					//$_SESSION['udanaocena']=true;
					//header('Location: witamy.php');
				}
				else
				{
					throw new Exception($connection->error);
				}
				
				$connection->close();
			
		
		}
	}catch(Exception $e)
	{
		echo '<span style="color:red;">Błąd serwera! </span>';
		echo $e;
	}
?>
