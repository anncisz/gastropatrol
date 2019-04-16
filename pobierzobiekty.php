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
  <link href="css/mojcss.css" type="text/css" rel="stylesheet" media="screen,projection"/>

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
     <?php

	
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
			$connection->set_charset("utf8");
			if(isset($_POST['poznan'])){
			$miasto=$_POST['poznan'];
			}
			if(isset($_POST['lodz'])){
			$miasto=$_POST['lodz'];
			}
			if(isset($_POST['wroclaw'])){
			$miasto=$_POST['wroclaw'];
			}
			$rezultat = $connection->query("SELECT * FROM object WHERE miasto='$miasto'");
			
			if(!$rezultat) throw new Exception($connection->error);
			echo '<h1 class="header center orange-text">'.$miasto.'</h1>';
			while($row = $rezultat->fetch_assoc())
			{
				$idkategorii =$row['idkategorii'];
				$idobiektu =$row['objectid'];
				$rezultat2 = $connection->query("SELECT * FROM category WHERE categoryid='$idkategorii'");
				
				if(!$rezultat2) throw new Exception($connection->error);
				
				$row2 = $rezultat2->fetch_assoc();
				
				$rezultat3 = $connection->query("SELECT * FROM rating WHERE idobiektu='$idobiektu'");
				
				if(!$rezultat3) throw new Exception($connection->error);
				
				$row3 = $rezultat3->fetch_assoc();
				
				$nick = $_SESSION['nick'];
				
				$rezultat5 = $connection->query("SELECT * FROM user WHERE nick='$nick'");
				
				if(!$rezultat5) throw new Exception($connection->error);
				
				$row5 = $rezultat5->fetch_assoc();
				
				$iduzytkownika = $row5['userid'];
				
				
				$rezultat4 = $connection->query("SELECT * FROM user_rating WHERE iduzytkownika='$iduzytkownika'");
				
				if(!$rezultat4) throw new Exception($connection->error);
				
				$row4 = $rezultat4->fetch_assoc();
				
				
				
				echo $idobiektu;
					?>
					
					<div class="page-footer orange">
					<div class="container">
					<div class="row">
					<div class="col l6 s12">
					<?php
					echo "<b>".$row2['nazwa']." ".$row['nazwa']."</b></br>";
					echo $row['adres']."</br>";
					echo "ocena użytkowników: ".$row3['srednia']."</br>";
					
					?>
					<a href = "pobierzobiekt.php?idobiektu=<?php echo $row['objectid'];?>" id="download-button" class="btn-small">info oraz fotki</a>
					</br></br>
					</div>
					
					<div class="col l6 s12">
					<?php
					if ((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true))
					{ 
						if ($row4['idobiektu']==$idobiektu){
							echo '<h5 class="header col s12 light">Już oceniłeś ten lokal. Twoja ocena: '.$row4['ocena'].'</h5>';
						}else{
					 
							
						echo '<h5 class="header col s12 light">Oceń:</h5>';
						?>
						<div class="row center">
						
						<form action="ocen.php" method="post">
						<input type="hidden" name="objectidocena" value="<?php echo $idobiektu; ?>" />
						<input type="submit" value="1" id="download-button" class="btn-small" name="1"/>
						<input type="submit" value="2" id="download-button" class="btn-small" name="2"/>
						<input type="submit" value="3" id="download-button" class="btn-small" name="3"/>
						<input type="submit" value="4" id="download-button" class="btn-small" name="4"/>
						<input type="submit" value="5" id="download-button" class="btn-small" name="5"/>
						<input type="submit" value="6" id="download-button" class="btn-small" name="6"/>
						</div>
						<?php
						}
					}
					?>
					
					</div>
					</div>
					</div>
					</div>
				
					<?php
				}
			$rezultat->close();
			$rezultat2->close();
			$rezultat3->close();
			$rezultat4->close();
		$connection->close();
		
		}
	}catch(Exception $e)
	{
		echo '<span style="color:red;">Błąd serwera! </span>';
		echo $e;
	}
	
	
  

?>
    </div>
  </div>



  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
