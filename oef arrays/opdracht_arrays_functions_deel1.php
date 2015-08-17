
<?php 
/*
Opdracht array functies: deel 1

Maak een array waarin je meer dan 5 dieren plaatst
Laat het script berekenen hoeveel elementen er in de array zitten en druk af naar het scherm
Maak het mogelijk om met een variabele $teZoekenDier een dier te zoeken in de array, druk tevens een gepaste boodschap af (gevonden/niet gevonden).
*/



$output_size ='';
$output_gevonden= '';

$dier[] = "aap";
$dier[] = "beer";
$dier[] = "cameleon";
$dier[] = "das";
$dier[] = "eland";
$dier[] = "giraf";


var_dump($dier);

$output_size = sizeof($dier);

$teZoekenDier = 'eland';


if ( in_array ($teZoekenDier, $dier)) {
	$output_gevonden = 'Het dier zit in onze database.';

}else{
	$output_gevonden = 'Het dier wordt niet teruggevonden in onze database. ';

}



?>



<!DOCTYPE html>
<html>
<head>
	<title>Opdracht array functies: deel 1</title>
</head>
<body>
	<H1>Opdracht array functies: deel 1</H1>
	<p> <?= $output_size ?> </p>
	<p> Zoeken in de database naar het dier "<?= $teZoekenDier ?>" ... </p>
	<p> <?= $output_gevonden ?> </p>
	

</body>
</html>