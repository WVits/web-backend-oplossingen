
<?php  
/*Opdracht switch: deel 1

Maak een HTML-document met een PHP code-block
Maak een PHP-script dat aan de hand van een getal ( tussen 1 en 7 ) de bijhorende dag afprint in kleine letters (geen hoofdletters!)
Maak gebruik van een switch en probeer alles te herschrijven i.p.v. te kopiëren.
*/

$getal = rand ( 1 , 7 );
$dag = '';

switch ($getal) {
	case '1':
		$dag = 'Maandag';
		break;
	
	case '2':
		$dag = 'Dinsdag';
		break;

	case '3':
		$dag = 'Woensdag';
		break;

	case '4':
		$dag = 'Donderdag';
		break;

	case '5':
		$dag = 'Vrijdag';
		break;

	case '6':
		$dag = 'Zaterdag';
		break;

	case '7':
		$dag = 'Zondag';

	default:
		# code...
		break;
	}

	$dag = strtolower($dag);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Opdracht conditional statements: Switch</title>
</head>
<body>
	<h1>Opdracht conditional statements: Switch</h1>
	<p>Vandaag is het <?= $dag ?>.</p>
	<p>(Druk refresh voor een andere willekeurige dag)</p>
	
</body>
</html>