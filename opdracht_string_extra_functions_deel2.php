<?php 

/*

Opdracht string extra functions: deel 2

Maak een variabele fruit met waarde 'ananas'
Bepaal de positie van de laatste 'a' in de variabele $fruit.
Druk deze waarde af.
Zet het de value van de $fruit variable in hoofdletters enkel door gebruik te maken van een PHP-functie. 

*/

$fruit = "Ananas";
$needle = "a";

$needleposition = strpos(strrev($fruit), $needle);
$lastpos = strlen($fruit) - $needleposition;

$fruit = strtoupper($fruit);
?>

<html!>

	<head>
		<title>Oef String Extra Functions Deel 2</title>
		<meta characterset = "utf8">

	</head>

	<body>
		<h1>Oefening String Extra Functions</h1>

		<p> In het woord <?= $fruit?> komt de letter <?= $needle ?> voor de laatste keer voor op plaats <?= $lastpos ?></p>
		
	</body>


</html!>