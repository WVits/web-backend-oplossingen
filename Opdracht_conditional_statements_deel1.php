
<?php  
/*Opdracht conditional statements: deel 1

Maak een HTML-document met een PHP code-block
Maak een PHP-script dat aan de hand van een getal ( tussen 1 en 7 ) de bijhorende dag afprint in kleine letters (geen hoofdletters!)
Bijvoorbeeld, wanneer $getal gelijk is aan 1 dan wordt de string 'maandag' op het scherm getoond
*/

$getal = '2';
$dag = '';

switch ($getal) {
	case '1':
		$dag = 'maandag';
		break;
	
	case '2':
		$dag = 'dinsdag';
		break;

	case '3':
		$dag = 'woensdag';
		break;

	case '4':
		$dag = 'donderdag';
		break;

	case '5':
		$dag = 'vrijdag';
		break;

	case '6':
		$dag = 'zaterdag';
		break;

	case '7':
		$dag = 'zondag';

	default:
		# code...
		break;
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Opdracht conditional statements: deel 1</title>
</head>
<body>
	<h1>Opdracht conditional statements: deel 1</h1>
	<p>Vandaag is het <?= $dag ?></p>


</body>
</html>