<?php

/*Bouw een <table> door gebruik te maken van een for-loop.
Maak een variabele $rijen met waarde 10 en maak een variabele $kolommen met waarde 10.
Probeer eerst 10 rijen in de <table> te tonen. 
Werk verder met een geneste for-loop om de kolommen weer te geven.
Vervang de <td>rij<td> in je code door een for-loop die 10 kolommen zal afdrukken. Plaat hierin telkens het woord "kolom".
*/

$rijen = 10;
$kolommen= 10;

$tafel = '<table>';

for ($i=0; $i < $rijen; $i++) { 
	$tafel = $tafel . "<tr>" ;
	for ($j=0; $j < $kolommen; $j++) { 
		$tafel = $tafel . "<td>" . (($i + 1) * ($j + 1)) . "</td>";
	}

	$tafel = $tafel . "</tr>";
	

}
 

$tafel = $tafel . '</table>';

var_dump($tafel);


?>

<!DOCTYPE html>
<html>
<head>
	<title> For </title>

</head>
<body>
	<h1> Tafels gegenereerd met een For-lus </h1>
	 <?= $tafel ?> 
</body>
</html>