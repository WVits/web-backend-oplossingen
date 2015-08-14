<?php  

/*Opdracht functies: deel 2

Maak een functie drukArrayAf die 1 parameter heeft, $array
Deze $array bevat enkele waarden die je zelf mag kiezen
Zorg ervoor dat je uiteindelijk tot dit resultaat komt:
Opdracht functies

helden[ 0 ] heeft waarde 'Elon Musk'

De naam van de array afdrukken is niet zo belangerijk (mag hardcoded of via een andere inventieve manier)
Zorg ervoor dat je ook meerdimensionale arrays kan afdrukken op dezelfde manier
Maak een functie validateHtmlTag die 1 parameter heeft, $html
Zorg ervoor dat deze functie kan valideren of er een correcte <html></html> tag aanwezig is in de gegeven string $html
Voer al deze functies uit en zorg ervoor dat de resultaten op het scherm verschijnen.*/


////////////// VARIABLES //////////////////////////

$arraytoprint = randomarr(rand(4, 20), rand(8, 15), rand(16, 30));
$outputstr = drukArrayAf($arraytoprint);
var_dump($arraytoprint);
var_dump($outputstr);

////////////// FUNCTIONS //////////////////////////

function drukArrayAf($array){
	$result ='';
	foreach ($array as $key => $value) {
		$result .= $key . ' ' . $value . '. ';
	}
	return $result;
}


function randomstring($length = 10){
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	return $randomString;
}

function randomarr($arrlength, $wordlengthmin = 10, $wordlengthmax =20){
	$arr;

	for ($key=0; $key < $arrlength ; $key++) { 
		$arr[$key] = randomstring(rand($wordlengthmin, $wordlengthmax));
	}
	return $arr;
}






///////////// Overige code //////////////////////




?>

<!DOCTYPE html>
<html>
<head>
	<title> Functions Deel 2</title>
</head>
<body>
	<h1> Functions Deel 2</h1>
	<p>Random array</p>
	<p> <?= $outputstr ?> </p>
	<span>
		<?php foreach ($arraytoprint as $key => $value): ?>
			
					<li> <?=  $key . ' ' . $value ?> </li>
				
		<?php endforeach ?>
	</span>
</body>
</html>