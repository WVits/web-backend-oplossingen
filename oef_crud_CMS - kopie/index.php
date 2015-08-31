<?php 

$datbasetype= "mysql";
$databasename = 'bieren';
$host='localhost';


try
{

////////////// Initialisatie/////////////////////

	session_start();

	////////// Automatisch zoeken naar klasses....

	function __autoload($classname) { 
		require_once("class/" . $classname . ".php"); 
	}

	////////// Automatisch zoeken naar css en javascript
	$cssfinder = new FileFinder();
	$css = $cssfinder->FindEm("css/", "*.{css}");
	
	$jsfinder = new FileFinder();
	$js = $jsfinder->FindEm("js/", "*.{js}");
	
	////////// Make connection to database 
	$connection  = new W_DatabaseHelper("cms");

	////////// VARIABELEN instellen
	$currentpage = basename($_SERVER["PHP_SELF"]);

	$_SESSION["home"] = $currentpage;

	$updateRecord = FALSE;
	
	////////// HTML-output-variabelen initialiseren
	$validatedUser = FALSE;

	$toonLogin = TRUE;
	$registreerUser = FALSE;

	$resultmessage ='';

///////// Functies ////////////////////////////////

	function checklogin($login, $pasw){
		$connection  = new W_DatabaseHelper("cms");
		$match = FALSE; 

		$querystring= "SELECT * 
						FROM users 
						WHERE naam LIKE :login 
						AND  paswoord LIKE :pasw
						";
		
		$bindValues = [ ":login" => $login, ":pasw"=> $pasw];

		$resultset = $connection->query($querystring, $bindValues);

		//$resultset = $connection->query($querystring);

		//var_dump($resultset);
		if (sizeof($resultset) === 1){
			$match = $resultset[0]["userid"];
		}
		$_SESSION["user"] = $match;
		$_SESSION["username"] = $login;
		return $match;
	}

	function registreerNieuweUser($login, $pasw){

		//controleren of de login reeds gebruikt is....
		$connection  = new W_DatabaseHelper("cms");
	
		$querystring= 	"SELECT * 
						 FROM users 
						 WHERE naam LIKE :login 
						";
		
		$bindValues = [ ":login" => $login];

		$resultset = $connection->query($querystring, $bindValues);

		//$resultset = $connection->query($querystring);

		//var_dump($resultset);
		if (sizeof($resultset) > 0)
		{
			$resultmessage = "Deze naam is reeds in gebruik. Gelieve een andere login te kiezen.";
		}
		else 
		{
			$querystring= "INSERT INTO users(naam, paswoord) 
							VALUES (:login, :pasw) 
							";
			$bindValues = [ ":login" => $login, ":pasw"=> $pasw];
			$resultset = $connection->query($querystring, $bindValues);

			$validatedUser = checklogin($login, $pasw);

			$resultmessage = "Proficiat met uw registratie. U bent meteen ook ingelogd met uw nieuwe login en paswoord.";
			$_SESSION["user"] = $validatedUser;
			$_SESSION["username"] = $login;
		}

		return $resultmessage;
	
	}


///////// Functionaliteit /////////////////////////


	////////// Reeds ingelogd?

	if (isset($_SESSION["user"])){
		$validatedUser = $_SESSION["user"];
		$toonLogin = FALSE;

		header("location: html/overzicht-artikelen.php");

	}

	////////// Log uit knop ---> Uitloggen

	if (isset($_POST["Uitloggen"])){
		$validatedUser = null;
		unset($_SESSION["user"]);
		unset($_SESSION["username"]);
		unset($_SESSION);
		header("location: index.php");
	}

	////////// Log in knop --->  Login - poging

	if (isset($_POST["inloggen"])){
		$login = $_POST["naam"];
		$paswoord = $_POST["paswoord"];
		$validatedUser = checklogin( $login, $paswoord );
		//var_dump($validated);
	}

	////////// Registreer knop ---> nieuwe gebruiker 
	// Toon de velden om een nieuwe gebruiker te registreren. 

	if (isset($_POST["registreren"])){
		$registreerUser = TRUE;
		$toonLogin= FALSE;	
	}

	if (isset($_POST["registreerNieuweUser"])){
		$resultmessage = registreerNieuweUser($_POST["naam"], $_POST["paswoord"]);
		//var_dump($resultmessage);
		file_put_contents("log.txt", $resultmessage);
	}

	if ($validatedUser){
		$toonLogin = FALSE;
		$registreerUser = FALSE;
		header("location: html/overzicht-artikelen.php");
	}
}


catch (PDOexception $e)
{
	$messageContainer	=	'Er ging iets mis: ' . $e->getMessage();
}//end catch

?>



<!DOCTYPE html>
<html>

<head>
	<title>ceejemes</title>

	<?php ////// dynamisch invoegen van alle CSS en JS bestanden ?>
	<?php foreach ($css as $cssnr => $cssvalue): ?>
		<link rel="stylesheet" type="text/css" href="<?=$cssvalue?>" >
	<?php endforeach ?>
						
	<?php foreach ($js as $jsnr => $jsvalue): ?>
		<script src="<?=$jsvalue?>"> </script>
	<?php endforeach ?>
	<?php ////////////////////////////////////////////////////////?>

</head>

<body>
	

	<?php if ($toonLogin): ?>
		<h1>Login.</h1>
		<form  method="POST" action="<?=$currentpage ?>" >
			<p><label for="naam" value="naam"> Naam </label> <input type="text" name="naam" value=""></p>
			<p><label for="paswoord" value="paswoord"> Paswoord </label> <input type="text" name="paswoord" value=""></p>
	
			<p><input type="submit" name="inloggen" value="Log in"></p>
			<p><input type="submit" name="registreren" value="Registreer"></p>
		</form>
	
	<?php endif ?>
	
	<?php if ($registreerUser): ?>
		<h1>Registreer nieuwe gebruiker.</h1>
		<form  method="POST" action="<?=$currentpage ?>" >
			<p><label for="naam" value="naam"> Geef de naam in die u wenst </label> <input type="text" name="naam" value=""></p>
			<p><label for="paswoord" value="paswoord"> Kies een paswoord </label> <input type="text" name="paswoord" value=""></p>
	
			<p><input type="submit" name="registreerNieuweUser" value="Registreer"></p>
			<p><input type="submit" name="registreerNieuweUser" value="Annuleer"></p>
		</form>
	<?php endif ?>

	<?php if (isset($_SESSION["user"])) : ?>
		<h1>Welkom.</h1>
		<h2>
			Gebruiker <?= $_SESSION["user"] ?>, u bent ingelogd.
		</h2>
		<form  method="POST" action="<?=$currentpage ?>" >	
			<p><input type="submit" name="Uitloggen" value="Log uit"></p>
		</form>
	<?php endif ?>
		

	<p>  <?= $resultmessage ?>  </p>


</body>
</html>