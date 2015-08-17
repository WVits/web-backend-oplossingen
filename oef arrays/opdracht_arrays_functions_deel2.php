
<?php 
/*
Opdracht array functies: deel 2

Ga verder op deel 1 (maar maak een aparte kopie voor, overschrijf het origineel niet!)
Zorg ervoor dat de array volgens het alfabet gesorteerd wordt ( A -> Z )
Maak een array $zoogdieren en plaats hier 3 dieren in, voeg vervolgens de 2 arrays met dieren samen in de array $dierenLijst
*/



$output_size ='';
$output_gevonden= '';



$dier[] = "cameleon";
$dier[] = "aap";
$dier[] = "eland";
$dier[] = "giraf";
$dier[] = "beer";
$dier[] = "das";

var_dump($dier);
sort($dier);

var_dump($dier);

$output_size = sizeof($dier);


$zoogdieren[] = "paard";
$zoogdieren[] = "koe";
$zoogdieren[] = "hamster";


$samen = array_merge($dier, $zoogdieren);

var_dump($samen);

?>



<!DOCTYPE html>
<html>
<head>
	<title>Opdracht array functies: deel 2</title>
</head>
<body>
	<H1>Opdracht array functies: deel 2</H1>
	
	

</body>
</html>