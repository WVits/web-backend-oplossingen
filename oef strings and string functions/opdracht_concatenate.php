
<?php /*

Opdracht string concatenate: deel 1

Plaats je voornaam en familienaam in afzonderlijke variabelen
Concateneer beide variabelen en stop ze in een nieuwe variabele $volledigeNaam
Druk de variabele af
Druk vervolgens het aantal karakters in $volledigeNaam af op een nieuwe lijn

*/

$voornaam = "Wim";
$achternaam = "Vits";
$volledigenaam = $voornaam . ' ' . $achternaam;
$aantalletters = strlen($voornaam) + strlen($achternaam);

?>

<html!>

	<head>
		<title></title>
		<meta characterset = "utf8">

	</head>

	<body>
		<h1>Oefening Concateneer</h1>

		<p> Mijn volledige naam is <?= $volledigenaam  ?></p>
		<p> Mijn volledige naam bestaat uit <?= $aantalletters  ?> letters! </p>
		
	</body>


</html!>
