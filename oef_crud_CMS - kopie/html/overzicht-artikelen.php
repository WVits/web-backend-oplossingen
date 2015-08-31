
<?php 

	session_start();

	////////// Initialisatie Variablen

	$Artikels = array();

	var_dump($_SESSION);


	// nakijken of de gebruiker wel is ingelogd...
	if (!isset($_SESSION["user"])){
		header('location: ../index.php');
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

	<?php foreach ($Artikels as $key => $value): ?>
		
	<?php endforeach ?>

</body>
</html>