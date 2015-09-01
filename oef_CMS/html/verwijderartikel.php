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
		//is er wel degelijk een artikel dat aangepast moet worden?
		if (isset($_SESSION["teVerwijderenArtikel"]))
		{
			$connection  = new W_DatabaseHelper("cms");
			//artikel uit de database halen.

		
				$X->dump($_POST);
/* UPDATE `user_art` SET active = 0 WHERE userid = 14 AND art_id = 1*/
				$querystring = "UPDATE user_art 
								SET active = 0 
								WHERE art_id = :art_id 
								AND userid = :user ";

				$bindValues = [ ":art_id" => $_SESSION["teVerwijderenArtikel"], ":user" => $_SESSION["user"]];
				//unset($_SESSION["aantepassenartikel"]);
	
				$resultset = $connection->query($querystring, $bindValues);
				$_SESSION["msg"] = "Artikel verwijderd.";
				header("location: overzicht-artikelen.php");
		}
		else
		{
			$X->dump("Geen artikel geselecteerd");
			header('location: ../index.php');	
		}
	}

?>

<!--
<!DOCTYPE html>
<html>
<head>
	<title>Wijzig artikel</title>
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

	<h1>Artikel verwijderen</h1>

	<p>Bij user <?= $_SESSION["user"]?> </p>
	<p>wordt artikel <?= $_SESSION["teVerwijderenArtikel"]?> </p>

</body>
</html>

-->