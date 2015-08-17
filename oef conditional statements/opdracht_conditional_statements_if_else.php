
<?php
/*
Opdracht if else: deel 1

Maak een PHP-script dat kan bepalen of de variabele 'jaartal' al dan niet een schrikkeljaar is
Een jaar is een schrikkeljaar als het deelbaar is door 4
Een jaartal deelbaar door 100 is geen schrikkeljaar
Een jaartal deelbaar door 400 is wel een schrikkeljaar
*/
$jaartal = rand ( -4000 , 4000 );
$schrikkeljaar = "GEEN";

if ($jaartal % 4 == 0) {
	# deelbaar door 4 : schrikkeljaar! 
	$schrikkeljaar = "een";

	if ($jaartal % 100 == 0) {
		# deelbaar door 100, GEEN schrikkeljaar.
		$schrikkeljaar = "GEEN";

		if ($jaartal % 400 == 0) {
			# deelbaar door 400, schrikkeljaar!
			$schrikkeljaar= "een";
		}
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Scrhikkeljaar</title>
</head>
<body>
	<h1>Schrikkeljaar?</h1>
	<p>Het jaar <?= $jaartal?> is <?= $schrikkeljaar ?> schrikkeljaar!</p>


</body>
</html>