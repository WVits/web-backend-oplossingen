<?php 
/*Opdracht date: deel 1

Maak een geldig HTML document
Zet deze datum 22u 35m 25sec 21 januari 1904 om naar een timestamp
Toon deze timestamp daarna in het volgende formaat: 21 January 1904, 10:35:25 pm*/


//int mktime ([ int $hour = date("H") [, int $minute = date("i") [, int $second = date("s") [, int $month = date("n") [, int $day = date("j") [, int $year = date("Y") [, int $is_dst = -1 ]]]]]]] )
$uren = 22;
$minuten = 35;
$seconden = 25;
$dagvdmaand = 1;
$maandvolgnummer = 1;
$jaar = 1904;





$time = mktime($uren, $minuten, $seconden, $maandvolgnummer, $dagvdmaand , $jaar);
//var_dump($timestamp);

$date = date('d F Y, g:i:s a', $time);

 ?>



 <!DOCTYPE html>
 <html>
 <head>
 	<title> Oefening Date </title>
 </head>
 <body>
 	<h1>Date</h1>
 	<p> <?=	$date ?> </p>

 </body>
 </html>