
<?php /*

Opdracht string concatenate: deel 1

Plaats je voornaam en familienaam in afzonderlijke variabelen
Concateneer beide variabelen en stop ze in een nieuwe variabele $volledigeNaam
Druk de variabele af
Druk vervolgens het aantal karakters in $volledigeNaam af op een nieuwe lijn

*/

$voornaam = "Wim";
$achternaam = "vits";
$volledigenaam = $voornaam . ' ' . $achternaam;

?>

<html!>

	<head>
		<title></title>
		<meta characterset = "utf8">

	</head>

	<body>
		<h1>Oefening Concateneer</h1>

		<p> <?= $volledigenaam  ?></p>
		
	</body>


</html!>
