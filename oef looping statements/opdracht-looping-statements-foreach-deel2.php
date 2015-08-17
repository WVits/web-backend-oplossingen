
<?php  
/*
Maak een HTML-document met een PHP code-block
Lees de tekst (text-file.txt) in en stop de tekst in een variabele $text Misschien helpt de functie file_get_contents
Splits de tekst op per karakter en sla deze op in een array $textChars ( dus een array die bestaat uit waarden van maximum 1 karakter)
Zorg ervoor dat deze array gesorteerd wordt van Z naar A
Draai nu de volgorde van de array volledig om
Zorg er nu voor dat je via een for-lus alle karakters van de tekst overloopt en bijhoudt hoeveel keer elk karakter voorkomt. Toon een lijst met:
Hoeveel verschillende karakters er in totaal voorkomen
Hoeveel elk karakter voorkomt.
*/

$aantalverschillende = 0;
//$charteller = array();
$alfabetCharCount = array();

$text = file_get_contents("text-file.txt");

$textChars = str_split($text , 1 );
rsort($textChars);
$textChars = array_reverse($textChars);


//Alle 
/*
foreach ($textChars as $char) {
	if (!isset($charteller[$char]) ) {
		$charteller[$char] = 1;
		++$aantalverschillende;
	}
	else{

		$charteller[$char] += 1;
	}

*/

//Alfabet alleen
foreach ($textChars as $char) {
	if ((ord($char) > 64 && ord($char) < 91) || (ord($char) > 96 && ord($char) < 122)) {
		if (!isset($alfabetCharCount[$char]) ) {
			$alfabetCharCount[$char] = 1;
			++$aantalverschillende;
		}
		else{
			$alfabetCharCount[$char] += 1;
		}

	}
}

//var_dump($textChars);
var_dump($aantalverschillende);
//var_dump($charteller);
var_dump($alfabetCharCount);
var_dump($text);


?>




<!DOCTYPE html>
<html>
<head>
	<title> Foreach oefening deel 2 </title>
</head>
<body>
	<h1>Foreach oefening deel 2</h1>
	<span>
		<?php foreach ($alfabetCharCount as $key => $value): ?>
			

					<li> <?=  $key . ' ' . $value ?> </li>
				
		<?php endforeach ?>
	</span>



</body>
</html>