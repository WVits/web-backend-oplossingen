<?php 
$login = "letmein";
$paswoord = "1234";

$message = 'Gelieve in te loggen....';

if (isset($_POST["naam"])){
	if (($_POST["naam"] === $login) && ($_POST["paswoord"] === $paswoord)){
		$message = "Welkom, " . $login ;
	}
	else{
		$message = "Er is iets foutgelopen... probeer opnieuw.";
	}
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title> Oefening post</title>
	<style type="text/css">

	</style>
</head>
<body>
	<h1> LOGIN: </h1>
	<p><?= $message ?><p>
	<form action="oef_post.php" method="post">
		<p><label for="naam"> Naam </label><input id="naam" name="naam"> </p>
		<p> <label fpr="paswoord"> Paswoord </label> <input id="pasw" name="paswoord" type="password"> </p>
		<input type="submit" name="submit">
	</form>
</body>
</html>