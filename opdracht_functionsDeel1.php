<?php  

/*Maak een functie berekenSom die 2 parameters heeft, $getal1 en $getal2
Zorg ervoor dat in deze functie de som van de twee getallen wordt berekend.
Deze functie returnt het resultaat
Zorg ervoor dat de functie enkel een waarde returnt. Het afdrukken moet buiten de functie gebeuren. 
Het combineren van meerdere functionaliteiten in één functie vermindert de herbruikbaarheid van de functie. 
Probeer vanaf nu te vermijden dat een functie meerdere dingen doet (zoals berekenen én afdrukken), ook al lijkt dit in het begin meer werk.

Maak een functie vermenigvuldig die 2 parameters heeft, $getal1 en $getal2
Zorg ervoor dat in deze functie het product wordt berekend.
Deze functie returnt het resultaat
Maak een functie isEven met 1 parameter $getal
Zorg ervoor dat in deze functie een boolean returnt die afhankelijk van het gegeven getal true of false is.
Voer al deze functies uit en zorg ervoor dat de resultaten op het scherm verschijnen
Maak een functie aan die de lengte én de uppercase-versie van een string returnt. Druk daarna de lengte en de uppercase-versie van de string af buiten de functie. return een array.*/


////////////// VARIABLES //////////////////////////

$aantalStuks = rand(1, 15);
$prijsPerStuk = rand(1,1000);
$totalePrijs = vermenigvuldig($aantalStuks, $prijsPerStuk);
$startstring = "dit is de string die we gaan gebruiken in de functie uppercaseandlength";
$resultArr = array();
$outputstr = '';

////////////// FUNCTIONS //////////////////////////


function berekenSom($getal1, $getal2){
	$som = $getal1 * $getal2;
	return $som;
}


function vermenigvuldig($getal1, $getal2){
	$product = $getal1 * $getal2;
	return $product;
}

function isEven($getal){
	$result = FALSE;
	if ($getal % 2 === 0){
		$result = TRUE;
	}
	return $result;
}

function uppercaseandlength($str){

	$arr_result["length"] = strlen($str);
	$arr_result["uppercase"] = strtoupper($str);

	return $arr_result;
}


function randomstring($length = 10){
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	return $randomString;
}




///////////// Overige code //////////////////////


$startstring = randomstring(rand(10, 400));
$resultArr = uppercaseandlength($startstring);

$outputstr = "De string " . $startstring . " heeft een lengte van: " . $resultArr["length"] . " en ziet er in hoofdletters zo uit: " . $resultArr["uppercase"];

?>

<!DOCTYPE html>
<html>
<head>
	<title> Functions Deel 1</title>
</head>
<body>
	<h1> Functions Deel 1</h1>
	<h2> Vermenigvuldig </h2>
	<p> U kocht <?= $aantalStuks?> aan €<?=$prijsPerStuk?> voor een totaal bedrag van €<?= $totalePrijs?>. Bedankt voor het vertrouwen.</p>

	<h2> Een even prijs? Dan krijgt u korting!</h2>
	<p> Uw totale prijs bedraagt <?= $totalePrijs ?>. </p>
	<p> Dit bedrag is <?= (isEven($totalePrijs))? "even, u krijgt de verzending gratis!": "oneven.. U heeft pech." ?>  </p>

	<h2> Lengte van een string en string in uppercase </h2>
	<p> <?= $outputstr ?></p>


</body>
</html>