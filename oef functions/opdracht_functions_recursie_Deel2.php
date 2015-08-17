<?php  

/*OOpdracht recursive: deel 1

Een old school vraagstuk!
Hans heeft 100 000€ geërfd. Hij kan zijn geld aan de bank geven tegen een rentevoet van 8%. 

Als hij dat doet is hij wel verplicht om zijn geld 10 jaar op de bank te laten staan. 
Hans wil weten hoeveel geld hij na 10 jaar zal overhouden.

Maak gebruik van een recursieve functie om te berekenen hoeveel geld Hans na 10 jaar zal overhouden
Zorg er ook voor dat Hans kan zien hoeveel zijn geld na elk jaar waard is. Rond daarbij alle getallen af naar beneden.
Je mag hiervoor -voorlopig- met static variabelen werken
Als je je verbonden voelt met de onderstaande meme, vraag dan even wat uitleg om je op weg te helpen..*/


////////////// VARIABLES //////////////////////////

$kapitaal = 100000;
$uiteindelijkBedrag = 0;
$looptijd = 10;
$interest = array();
$uiteindelijkBedrag = berekeninterest($kapitaal, 10, 8, false, $interest);


////////////// FUNCTIONS //////////////////////////

function berekeninterest($som, $aantalJaren, $rentevoet = 2, $end='false', $interestarr){

	//static $end = FALSE;
	/*while ($aantalJaren > 1){
		$res = $rentevoet * berekeninterest($som, ($aantalJaren-1), $rentevoet);
	}*/

	if (( $aantalJaren > -1) && ( $end === FALSE)) {
		$som = round( $som + ($som * $rentevoet/100));

		//var_dump($aantalJaren);
		$interestarr[$aantalJaren] = $som;
		//var_dump($som);

		return berekeninterest($som, --$aantalJaren, $rentevoet, $end, $interestarr); 
	
	}
	else{
		$end = TRUE;
	}
	
	return $interestarr;
	
}




///////////// Overige code //////////////////////




?>

<!DOCTYPE html>
<html>
<head>
	<title> Functions Deel 2</title>
</head>
<body>
	<h1> Functions Deel 2</h1>
	<p>Interestberekening</p>
	<div>
		<?php foreach ($uiteindelijkBedrag as $key => $value): ?>
			
					<li> Je ontvangt je geld binnen <?=  $key ?> jaar en hebt momenteel €<?= $value ?> op je rekening staan. </li>
				
		<?php endforeach ?>
	</div>
</body>
</html>