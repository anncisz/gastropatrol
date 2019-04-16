<?php

	session_start();
	
	if(!isset($_POST['login']) || (!isset($_POST['password'])))
	{
		header('Location: login.php');
		exit();
	}
	
	require_once "connect.php";

	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if($connection->connect_errno!=0)
	{
		echo "Error: ".$connection->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		
		if($result = @$connection->query(
		sprintf("SELECT * FROM user WHERE nick='%s'",
		mysqli_real_escape_string($connection, $login))))
		{
			$how_many_users = $result->num_rows;
			if($how_many_users>0)
			{
				$row = $result->fetch_assoc();
				
				if(password_verify($password, $row['password'])) 
				{
		
					
					$_SESSION['logged'] = true;
					
					$_SESSION['id'] = $row['userid'];
					$_SESSION['nick'] = $row['nick'];
					$_SESSION['first name'] = $row['first name'];
					$_SESSION['last name'] = $row['last name'];
					$_SESSION['telephone number'] = $row['telephone number'];
					$_SESSION['e-mail'] = $row['email'];
					
					unset($_SESSION['error']);
					$result->close();
					$_SESSION['udanelogowanie']=true;
					header('Location: index.php');
				} 
				else
				{
				
					$_SESSION['error'] = "Nieprawidłowy login lub hasło";
					header('Location:login.php');
				} 
			}
			else{
				
					$_SESSION['error'] = "Nieprawidłowy login lub hasło";
					header('Location:login.php');
			}
			
		}
		
		$connection->close();
	}
	
	
  

?>