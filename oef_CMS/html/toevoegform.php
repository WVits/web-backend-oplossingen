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

	///////// Functionality

	//check if this user is logged in..
	if (!isset($_SESSION["user"])) 
	{
		//user is NOT logged in
		header('location: ../index.php');
	}
	else //user is logged in
	{
		if (isset($_POST["annuleer"]))
		{
			header("location: overzicht-artikelen.php");
		}

		if (isset($_POST["VoegArtikelToe"]))
		{
			//artikel toevoegen aan database EN automatisch linken aan de huidige gebruiker.

			////////// ARTIKEL TOEVOEGEN

			$connection  = new W_DatabaseHelper("cms");

			$querystring = "INSERT INTO artikel (title, inhoud, imagelink, kernwoorden, date, is_active) 
							VALUES (:titel, :inhoud, :imglink, :kernwoorden, current_date(), 1 )";

			$bindValues = [ ":titel" => $_POST["titel"], ":inhoud"=> $_POST["inhoud"], ":imglink" => $_POST["imglink"], ":kernwoorden" => $_POST["kernwoorden"]];
			//var_dump($bindValues);

			$resultset = $connection->query($querystring, $bindValues);
			//var_dump($resultset);

			////////// LINK TUSSEN ARTIKEL EN HUIDIGE GEBRUIKER

			//ophalen van de id van het nieuwe artikel
			$querystring = "SELECT art_id FROM artikel ORDER BY art_id DESC LIMIT 1";

			$resultset = $connection->query($querystring);
			$newartid = $resultset[0]["art_id"];

			$curruser = $_SESSION["user"];

			$querystring = "INSERT INTO user_art ( userid, art_id)
							VALUES ($curruser, $newartid)";

			$resultset = $connection->query($querystring);			

			header("location: overzicht-artikelen.php");
		}
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Artikel toevoegen</title>
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

	<h1>Artikel toevoegen</h1>

	<form  method="POST" action="<?=$currentpage?>" >
			<p><label for="titel" value="titel"> Geef de titel van het artikel in.. </label> 
				<input type="text" name="titel" value="" size=59>
			</p>

			<p><label for="kernwoorden" value="kernwoorden"> Geef de kernwoorden van het artikel in.. </label> 
				<input type="text" name="kernwoorden" value="" size=59>
			</p>
			
			<p>	<label for="inhoud" value="inhoud"> Typ de inhoud van het artikel in.. </label>
				<textarea name="inhoud" value="" rows=15 cols=80 ></textarea>
			</p>
	
			<p>	<label for="imglink" value="imglink"> Zet de image in de juiste map ( /img/ ) en zet hier de bestandsnaam. </label>
				<input type="text" name="imglink" value=""  size=59>			
			</p>
	
			<p><input type="submit" name="VoegArtikelToe" value="Voeg artikel toe"></p>
			<p><input type="submit" name="annuleer" value="Annuleer"></p>
		</form>
</body>
</html>