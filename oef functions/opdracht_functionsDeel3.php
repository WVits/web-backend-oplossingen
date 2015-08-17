<?php  

/*Opdracht functies: deel 2b

Maak een functie validateHtmlTag die 1 parameter heeft, $html
Zorg ervoor dat deze functie kan valideren of er een correcte <html></html> tag aanwezig is in de gegeven string $html
Voer al deze functies uit en zorg ervoor dat de resultaten op het scherm verschijnen

*/

////////////// VARIABLES //////////////////////////

//random ééndimensionale array afdrukken
$arraytoprint = randomarr(rand(4, 20), rand(8, 15), rand(16, 30));


//meerdimensionale array afdrukken:
/*
$arraytoprint = array();
$arraytoprint[1] = ['a', 'b', 'c'];
$arraytoprint[0] = ['a', 'b', 'c'];
$arraytoprint[2] = ['a', 'b', 'c'];
*/


$outputstr = validateHtmlTag("<html> tegeagae </html>");
//var_dump($arraytoprint);
//var_dump($outputstr);

////////////// FUNCTIONS //////////////////////////

function validateHtmlTag($haystack){

	$returnvalue = 'false';
	
	if (strrpos($haystack, "<html>") < strrpos($haystack, "</html>")){
		$returnvalue = TRUE;
	}
	else{
		$returnvalue = FALSE;
	}
	return $returnvalue;
}


//////////////////// HTML BELOW /////////////////////
?>




<!DOCTYPE html>
<html>
<head>
	<title> Functions Deel 3</title>
</head>
<body>
	<h1> Functions Deel 3</h1>
	<p>Random array</p>
	<p> <?= $outputstr ?> </p>
	<span>
		<!--<?php foreach ($arraytoprint as $key => $value): ?>
			
					<li> <?=  $key . ' ' . $value ?> </li>
				
		<?php endforeach ?>-->

		<?= ($outputstr)? 'Geldig': 'Niet geldig' ?>

	</span>
</body>
</html>