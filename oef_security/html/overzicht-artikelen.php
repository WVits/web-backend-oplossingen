
<?php 

	session_start();

	////////// Automatisch zoeken naar klasses....

	function __autoload($classname) { 
		require_once("../class/" . $classname . ".php"); 
	}

	////////// Initialisatie Variablen

	$Artikels = array();

	var_dump($_SESSION);


		// nakijken of de gebruiker wel is ingelogd...
	if (!isset($_SESSION["user"])){
		header('location: ../index.php');
	}

	else{
		// Artikels ophalen...

	$connection  = new W_DatabaseHelper("cms");

	$querystring = "SELECT * FROM artikel 
					INNER JOIN user_art ON user_art.art_id = artikel.art_id
					INNER JOIN users ON users.userid = user_art.userid
					WHERE users.userid = :user
	";

	$bindValues = [ ":user" => $_SESSION["user"]];
	//$saltArr = $connection->query($querygetsalt, $bindValues);
	//var_dump($saltArr);
	//var_dump("saltArrayDump in oef-security");

	$resultset = $connection->query($querystring, $bindValues);

	var_dump($resultset);

	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>OVerzicht</title>
</head>
<body>
	<header>
		<a href='uitloggen.php' title='uitloggen'> Uitloggen </a>
	</header>

	<h1>Welkom <?= $_SESSION["username"]?> </h1>


	<?php if (isset($_SESSION["msg"])) : ?>

		<p> <?= $_SESSION["msg"] ?> </p>
	<?php endif ?>

	<?php foreach ($resultset as $key => $value): ?>
		<h1> <?= $value["title"] ?> </h1>
		<p> <?= $value["inhoud"] ?> </p>
		
	<?php endforeach ?>

</body>
</html>