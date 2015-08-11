<?php 

/*Opdracht string extra functions: deel 1

Maak een variabele $fruit met 'kokosnoot' als value
Bereken hoeveel karakters de variabele fruit telt, uiteraard door middel van een PHP-functie.
Druk deze waarde af.
Bepaal de positie van de eerste 'o' in de variabele $fruit. Druk deze waarde af. */

$fruit = "Kokosnoot";
$needle = "o";
$needleposition = strpos($fruit, $needle);
$needleposition += 1;

?>

<html!>

	<head>
		<title>Oef String Extra Functions Deel 1</title>
		<meta characterset = "utf8">

	</head>

	<body>
		<h1>Oefening String Extra Functions</h1>

		<p> In het woord <?= $fruit?> komt de letter <?= $needle ?> voor op plaats <?= $needleposition ?></p>
		
	</body>


</html!>