
<?php
/*
Maak een PHP-script dat achterhaalt hoeveel volledige jaren, maanden, weken, dagen, uren, minuten en seconden er in een gegeven aantal seconden zit (bv. 221108521)
Ga er van uit dat een maand 31 dagen kent en een jaar 365 dagen. 

*/



$seconden = rand ( 2 , 9999999999999 );


//TESTWAARDEN:
//$seconden = 61;
//$seconden = 3621;
//$seconden = ;


$minuten = floor($seconden / 60);
$uren = floor($seconden / (60*60));
$dagen = floor ($seconden / (60*60*24));
$weken = floor($seconden / (60*60*24*7));
$maanden = floor ($seconden / (60*60*24*31));
$jaren = floor($seconden / (60*60*24*365));


?>


<!DOCTYPE html>
<html>
<head>
	<title>Scrhikkeljaar</title>
</head>
<body>
	<h1>Schrikkeljaar?</h1>
	<p><?= $seconden?> seconden komen overeen met:</p>
	<p><?=$minuten ?> minuten</p>
	<p><?=$uren ?> uren</p>
	<p><?=$dagen ?> dagen</p>
	<p><?=$weken ?> weken</p>
	<p><?=$maanden ?> maanden</p>	
	<p><?=$jaren?> jaren</p>


</body>
</html>