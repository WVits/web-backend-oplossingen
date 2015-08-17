
<?php  
/*Maak een kopie van deel 1
Zet de naam van de dag (bv 'maandag') doormiddel van een string-functie dan naar hoofdletters om (bv 'MAANDAG').
Zet alle letters in hoofdletters, behalve de 'a'
Zet alle letters in hoofdletters, behalve de laatste 'a'
*/

$getal = '1';
$dag = '';
$daghoofdletters = '';
$letter = 'a';
$hoofdletter = strtoupper($letter);
$dagMetHoofdBehalveLetter = '';
$dagMetHoofdBehalveLaatsteLetter = '';
$lastpos = 0;
$needleposition = 0;

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

$daghoofdletters=strtoupper($dag);

$dagMetHoofdBehalveLetter = str_replace(strtoupper($letter), $letter, strtoupper($dag));

//int substr_count ( string $haystack , string $needle [, int $offset = 0 [, int $length ]] )
$lettercount = substr_count ($dagMetHoofdBehalveLetter, $letter);

//mixed str_replace ( mixed $search , mixed $replace , mixed $subject [, int &$count ] )

$dagMetHoofdBehalveLaatsteLetter = strtoupper($dag);

$needleposition = strpos(strrev($dagMetHoofdBehalveLaatsteLetter), $hoofdletter);
$lastpos = strlen($dagMetHoofdBehalveLaatsteLetter) - $needleposition;

$dagMetHoofdBehalveLaatsteLetter = substr_replace($dagMetHoofdBehalveLaatsteLetter, $letter, ($lastpos-1), 1);

 


?>

<!DOCTYPE html>
<html>
<head>
	<title>Opdracht conditional statements: deel 2</title>
</head>
<body>
	<h1>Opdracht conditional statements: deel 2</h1>
	<p>Vandaag is het <?= $daghoofdletters ?></p>
	<p>Vandaag is het <?= $dagMetHoofdBehalveLetter ?></p>
	<p>In het woord <?= $dagMetHoofdBehalveLetter ?> komt <?= $letter ?> <?= $lettercount?> keer voor. </p>
	<p>De laaste keer dat dat de letter voorkomt is op plaats <?= $lastpos?> (de eerste letter tellen we als één) </p>
	<p>Vandaag is het <?= $dagMetHoofdBehalveLaatsteLetter ?></p>

</body>
</html>