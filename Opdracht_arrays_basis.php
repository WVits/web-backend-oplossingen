

<?php

//Maak een array waarin je 10 dieren opslaat( doe dit op 2 verschillende manieren )

$dieren[] = "koe";
$dieren[] = "varken";
$dieren[] = "paard";
$dieren[] = "geit";
$dieren[] = "schaap";



/*associatief: */
$knaagdieren = array("een" => "rat", "twee" => "konijn", "drie" => "muis", "vier" => "hamster", "vijf" => "cavia");

/*Maak een nieuwe array met daarin 5 voertuigen, zorg er voor dat je kan bepalen om welke categorie van voertuig het gaat ( 2-dimensionele array), zoals 'landvoertuigen', 'watervoertuigen', 'luchtvoertuigen'.
Wanneer je een var_dump van deze array doet, ziet het resultaat er ongeveer als volgt uit:

[ 'landvoertuigen' ] => 
[ 0 ] => 'Vespa'
[ 1 ] => 'fiets'
[ 'watervoertuigen' ] => 
[ 0 ] => 'surfplank'
[ 1 ] => 'vlot'
[ 2 ] => 'schoener'
[ 3 ] => 'driemaster'
[ 'luchtvoertuigen' ] => 
[ 0 ] => 'luchtballon'
[ 1 ] => 'helicopter'
[ 2 ] => 'B52'*/


$voertuigen = array("landvoertuigen" => array("vespa", "fiets"), "watervoertuigen" => array('surfplank', 'vlot', 'schoener', 'driemaster'), 'luchtvoertuigen' => array('luchtballon', 'helicopter', 'B52'));





var_dump($dieren);
var_dump($knaagdieren);
var_dump($voertuigen);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Opdracht Arrays Basis</title>
</head>
<body>
	<H1>Opdracht arrays basis</H1>
	<p></p>

</body>
</html>