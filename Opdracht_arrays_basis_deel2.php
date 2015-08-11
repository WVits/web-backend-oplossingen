<?php  

/*
Opdracht arrays basis: deel 2

Maak een array waarin je de getallen 1, 2, 3, 4, 5 in plaatst
Vermenigvuldig alle getallen met elkaar en druk af naar het scherm
Druk de oneven getallen af (controle in script, niet zelf selecteren welke je afdrukt)
Maak een tweede array waarin je de getallen 5, 4, 3, 2, 1 in plaatst
Tel de getallen uit beide arrays met dezelfde index met elkaar op
*/

$getallen[0]  = 1;
$getallen[1]  = 2;
$getallen[2]  = 3;
$getallen[3]  = 4;
$getallen[4]  = 5;
//echo sizeof($getallen);

$result= 1; //neutraal element voor de vermigvuldiging.

for ($i=0; $i < sizeof($getallen) ; $i++) { 
	
	$result *= $getallen[$i];

}



?>



<!DOCTYPE html>
<html>
<head>
	<title>Arrays basis, deel 2</title>
</head>
<body>
	<h1>Arrays basis, deel 2</h1>
	<p> Alle getallen in de array met elkaar vermenigvuldigen geeft als resultaat: <?= $result ?> </p>


</body>
</html>