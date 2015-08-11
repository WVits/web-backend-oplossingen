
<?php
/*
Maak een getal met een waarde tussen 1-100
Zorg ervoor dat het script kan zeggen tussen welke tientallen het getal ligt, bv 'Het getal ligt tussen 20 en 30'.
Zorg er vervolgens voor dat de boodschap omgekeerd afgedrukt wordt, bv '03 ne 02 nessut tgil lateg teH'.
*/

$getal = rand ( 1 , 100 );

$onder = floor ($getal / 10) * 10;
$boven = $onder + 10;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Scrhikkeljaar</title>
</head>
<body>
	<h1>Tussen tientallen.... </h1>
	<p>Het getal <?= $getal?> ligt tussen de tientallen <?= $onder ?> en <?= $boven ?> </p>
	
</body>
</html>