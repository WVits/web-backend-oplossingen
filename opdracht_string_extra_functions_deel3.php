<?php 

/*
Opdracht string extra functions: deel 3

Maak een variabele $lettertje met 'e' als value
Maak een variabele $cijfertje met 3 als value
Maak een variabele $langsteWoord met 'zandzeepsodemineralenwatersteenstralen' als value
Vervang nu alle e’s in de $langsteWoord variable door 3's.
*/

$lettertje = "e";
$cijfertje = "3";

$langsteWoord = 'zandzeepsodemineralenwatersteenstralen';

//mixed str_replace ( mixed $search , mixed $replace , mixed $subject [, int &$count ] )
$newlangste = str_replace($lettertje, $cijfertje, $langsteWoord);

?>

<html!>

	<head>
		<title>Oef String Extra Functions Deel 3</title>
		<meta characterset = "utf8">

	</head>

	<body>
		<h1>Oefening String Extra Functions</h1>

		<p> Als we in het woord <?= $langsteWoord?> elke <?= $lettertje ?> vervangen door een <?= $cijfertje ?> dan bekomen we....  <?= $newlangste ?></p>
		
	</body>


</html!>