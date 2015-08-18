<?php 
/*Opdracht date: deel 1

Maak een geldig HTML document
Zet deze datum 22u 35m 25sec 21 januari 1904 om naar een timestamp
Toon deze timestamp daarna in het volgende formaat: 21 January 1904, 10:35:25 pm*/

/*
Opdracht date: deel 2

Zorg dat de benamingen in het Nederlands komen te staan
*/

$uren = 22;
$minuten = 35;
$seconden = 25;
$dagvdmaand = 1;
$maandvolgnummer = 1;
$jaar = 1904;

$time = mktime($uren, $minuten, $seconden, $maandvolgnummer, $dagvdmaand , $jaar);


/*setlocale(LC_ALL, 'nl_NL');*/
//setlocale(LC_ALL, 'nl_NL');
setlocale(LC_ALL, 'nld_nld');

//string strftime ( string $format [, int $timestamp = time() ] )
$localdate = strftime('%d, %B, %Y', $time)


 ?>



 <!DOCTYPE html>
 <html>
 <head>
 	<title> Oefening Date </title>
 </head>
 <body>
 	<h1>Date</h1>
 	<p> <?=	$time ?> </p>
 	<p> wordt in het Nederlands:</p>
 	<p> <?= $localdate ?> </p>


 </body>
 </html>