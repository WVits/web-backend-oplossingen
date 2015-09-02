<?php  

	session_start();

	////////// Automatisch zoeken naar klasses....

	function __autoload($classname) { 
		require_once("../class/" . $classname . ".php"); 
	}

	////////// Automatisch zoeken naar css en javascript
	$cssfinder = new FileFinder();
	$css = $cssfinder->FindEm("../css/", "*.{css}");
	
	$jsfinder = new FileFinder();
	$js = $jsfinder->FindEm("../js/", "*.{js}");
	
	////////// Make connection to database 

	////////// Init Variables
	$currentpage = basename($_SERVER["PHP_SELF"]);
	$X = new W_DebugHelper();

	///////// Functionality

	$X->dump($_SESSION);


	if(isset($_POST["annuleer"])){
		header('location: overzicht-artikelen.php');
	}

	//check if this user is logged in..
	if (!isset($_SESSION["user"])) 
	{
		//user is NOT logged in
		header('location: ../index.php');
		$X->dump("geen actieve user!");
	}
	else //user is logged in
	{
		if(isset($_FILES["file"])){
			$X->dump($_FILES);
		}

		if(isset($_POST["wijzig"]))
		{
			
			$X->dump($_FILES);
			//juiste type en juiste grootte
			if ((($_FILES["file"]["type"] == "image/gif")
			|| ($_FILES["file"]["type"] == "image/jpeg")
			|| ($_FILES["file"]["type"] == "image/png"))
			&& ($_FILES["file"]["size"] < 2000000)) 
			{
				if ($_FILES["file"]["error"] > 0) 
				{
						// Als er een fout in het bestand wordt gevonden (bv. corrupte file door onderbroken upload), moet er een foutboodschap getoond worden
						throw new Exception( "Return Code: " . $_FILES["file"]["error"] );
				} 
				else 
				{
						// De root van het bestand moet achterhaald worden om de absolute pathnaam (de plaats op de schijf van de server) te achterhalen
						// Zo weet de server waar het bestand moet terecht komen.
						// We kunnen dit doen door de functie dirname() toe te passen op dit bestand (=__FILE__)
						define('ROOT', dirname(dirname(__FILE__)));
						
					GetAvailableName($_FILES["file"]["name"]) ;
					
							
							//Als het bestand reeds bestaat in de map, moet er een foutboodschap getoond worden
					//		throw new Exception( $_FILES["file"]["name"] . " bestaat al. " );
					 
					 
					
						
							// Anders mag het bestand geüpload worden naar de map
							//$destination = ROOT . "/img/" . $_FILES["file"]["name"];
							//move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
							$filename =  $_FILES["file"]["name"];
							$destination = ROOT . "/img/" . $_FILES["file"]["name"];
						//	var_dump($destination);
							move_uploaded_file($_FILES["file"]["tmp_name"], $destination);


							/*
							$message[ 'type' ]	=	'success';
							$message[ 'text' ]	=	'<p>Upload: ' . $_FILES["file"]["name"] .'</p>';
							$message[ 'text' ]	=	'<p>Type: ' . $_FILES["file"]["type"] .'</p>';
							$message[ 'text' ]	=	'<p>Size: ' . $_FILES["file"]["size"] / 1024 .'</p>';
							$message[ 'text' ]	=	'<p>Temp file: ' . $_FILES["file"]["tmp_name"] .'</p>';
							$message[ 'text' ]	=	'<p>Opgeslagen in: : ' . ROOT . "/img/" . $_FILES["file"]["name"] .'</p>';
							*/

							//en de link naar deze foto wordt bijgehouden in de database, bij de user
							$connection  = new W_DatabaseHelper("cms");
							$querystring = "UPDATE users SET users.picture = :imagelink WHERE users.userid = :userid" ;
							$bindValues = [ ":imagelink" => ("img/" . $filename ),":userid" => $_SESSION["user"]];
							$resultset = $connection->query($querystring, $bindValues);

						//	$X->dump($bindValues);
							
					}
				}
			}					 
			else 
			{
				//throw new Exception( 'Ongeldig bestand' );
			}
		
		

	$connection  = new W_DatabaseHelper("cms");
	$querystring = "SELECT users.naam, users.picture FROM users WHERE users.userid = :userid" ;
	$bindValues = [ ":userid" => $_SESSION["user"]];
	//unset($_SESSION["aantepassenartikel"]);
	$user = $connection->query($querystring, $bindValues);
	$_SESSION["msg"] = "Wijzigingen zijn uitgevoerd.";
	//header("location: overzicht-artikelen.php");

	}

	function GetAvailableName($name)
	{
		if (file_exists(ROOT . "/img/" . $name)) 
					{
							
							//Als het bestand reeds bestaat in de map, moet er een foutboodschap getoond worden
							$name = "1" . "$name";
							GetAvailableName($name);
					} 
		else{
			return $name;
		}
	}
			
		

?>
<!DOCTYPE html>
<html>
<head>
	<title>Wijzig profiel</title>
</head>
<body>
	<header>
		<a href='uitloggen.php' title='uitloggen'>Uitloggen.</a>
		<span> Ingelogd als <?= $_SESSION["username"] ?>. </span>
		<a href='toevoegform.php' title='artikel toevoegen'>Artikel toevoegen.</a>

		<?php ////// dynamisch invoegen van alle CSS en JS bestanden ?>
		<?php foreach ($css as $cssnr => $cssvalue): ?>
			<link rel="stylesheet" type="text/css" href="<?=$cssvalue?>" >
		<?php endforeach ?>
						
		<?php foreach ($js as $jsnr => $jsvalue): ?>
			<script src="<?=$jsvalue?>"> </script>
		<?php endforeach ?>
		<?php ////////////////////////////////////////////////////////?>

		<meta charset="utf-8" /> 
	</header>

	<h1>Profiel wijzigen</h1>

	<form  method="POST" action="<?=$currentpage?>" enctype="multipart/form-data">


		<?php if (isset($user[0]['naam'])): ?>
			
			<p><label for="naam" value="naam"> Naam </label> 
				<input type="text" name="naam" value="<?=$user[0]['naam']?>" size=59>
			</p>
			
			<p>	<label for="picture" value="picture"> Profielfoto </label>

				<img class="profilepic" src="<?='../' . $user[0]['picture']?>" alt="Geen profielfoto"> 

				<input type="file" name="file">

			</p>
	

		<?php else: ?>
			<p>Er liep iets mis. Gelieve opnieuw in te loggen. </p>	
		<?php endif ?>
	
			<p><input type="submit" name="wijzig" value="Bevestig wijzigingen"></p>
			<p><input type="submit" name="annuleer" value="Annuleer"></p>
	</form>
</body>
</html>