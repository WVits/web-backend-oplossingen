<?php

/*Bouw een <table> door gebruik te maken van een for-loop.
Maak een variabele $rijen met waarde 10 en maak een variabele $kolommen met waarde 10.
Probeer eerst 10 rijen in de <table> te tonen. 
Werk verder met een geneste for-loop om de kolommen weer te geven.
Vervang de <td>rij<td> in je code door een for-loop die 10 kolommen zal afdrukken. Plaat hierin telkens het woord "kolom".
*/

$titel = 'Tafels';
$tafel = array();
$rijen = 11;
$kolommen= 11;

// vullen van de array $tafels met de tafels van vermenigvuldiging 
for ($rij=0; $rij < $rijen; $rij++) { 
	for ($kolom=0; $kolom < $kolommen; $kolom++) { 
		$tafel[$rij][$kolom] = ($rij) * ($kolom);
	}
}

//vullen van de titelrij horizontaal

for ($kolom=0; $kolom < $kolommen; $kolom++) { 
	$tafel[0][$kolom] = $kolom ;
}

//vullen van de eerste kolom

for ($rij=0; $rij < $rijen; $rij++) { 
	$tafel[$rij][0] = $rij ;
}

//cel nul aanpassen

$tafel[0][0] = $titel;

//var_dump($tafel);

?>





<!DOCTYPE html>
<html>
<head>
	<title> For </title>
	<style type="text/css">
	.green{
		background-color: lightgreen;
	}
	</style>
</head>
<body>

	<h1> Tafels gegenereerd met een For-lus </h1>
	
	 <table>
		
		<!-- uitschrijven van de titels -->			
		<?php for ($titelKey = 0; $titelKey< $kolommen; ++$titelKey): ?>
			<?= "<th>" . $tafel[0][$titelKey] . "</th>" ?>
		<?php endfor; ?>


		<!-- uitschrijven van de andere rijen	-->	
		<?php for ($rij = 1; $rij< $rijen; ++$rij): ?>

			<tr>
<!--
				<?php foreach ($tafel[$rij] as $cel ): ?>
					
				

					 <?= ($rij === 0) ? $cel : (($cel % 2 === 0) ? "<td>" . $cel : "<td class = green>" . $cel) ?> </td>

				<?php endforeach ?>	
-->

				<?php for ($kolom=0; $kolom < $kolommen; $kolom++): ?> 
					
					<?= ($kolom === 0) ? ("<td>" . $tafel[$rij][$kolom]) : (($tafel[$rij][$kolom] % 2 === 0 ) ? ("<td>" . $tafel[$rij][$kolom]) : ("<td class =green>" . $tafel[$rij][$kolom]) ) ?> </td>

				<?php endfor; ?>


			</tr>
		<?php endfor; ?>


		<!-- Uitschrijven van de tafel met foreach zonder titels en kleuren-->
		
		<!-- vvvvvvvvvvvvvvvvvvvvvvvvvvv
		
		<?php foreach ($tafel as $rij): ?>

			<?= "<tr>" ?>

				<?php foreach ($rij as $cel ): ?>

					<?= "<td>" . $cel . "</td>" ?>
				
				<?php endforeach ?>
				
			<?= "</tr> "?>
		<?php endforeach ?>
		
		^^^^^^^^^^^^^^^^^^^^^^^^^^^--> 

	 </table>

</body>
</html>