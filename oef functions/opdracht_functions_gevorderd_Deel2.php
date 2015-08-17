<?php  
/*
Opdracht functies gevorderd: deel 2 (Angry Birds)

De bedoeling is om een versimpelde tekstversie van Angry Birds te maken (http://chrome.angrybirds.com/)
Maak een global variable $pigHealth met value 5 en een global variable $maximumThrows met value 8

Maak een functie calculateHit. Deze functie staat in voor:
Het berekenen van de raakkans (40%). Gebruik hiervoor de functie rand.

Het verminderen van de $pigHealth variable met één van zodra er raak is geschoten.
Het teruggeven van de string 'Raak! Er zijn nog maar xxx varkens over.' of
 'Mis! Nog xxx varkens in het team.' naargelang het resultaat van het willekeurige getal. 
 De xxx moet vervangen worden door het effectieve getal.

Maak een functie launchAngryBird. Deze functie staat in voor:
Deze functie bevat een static variable om bij te houden hoeveel keer de functie reeds is aangeroepen.
Zolang deze static variable kleiner is dan het aantal $maximumThrows wordt de static variable met één vermeerderd en 
spreekt de functie launchAngryBird zichzelf weer aan.

Van zodra de static variabele gelijk is de $maximumThrows wordt er gekeken of het $pigHealth gelijk is aan nul. 
Als dit het geval is moet de boodschap 'Gewonnen!' verschijnen. Is de variable pigHealth groter dan nul verschijnt de 
boodschap 'Verloren!'
Je mag de functie launchAngryBird maximum één keer aanroepen in het document.
*/

//////// VARIABELEN ////////////////////

$pighealth = 5;
$maximumThrows = 8;
$game = array();

$game = LaunchAngryBirds($maximumThrows, $pighealth);
//var_dump($game);


//////// FUNCTIONS /////////////////////


function LaunchAngryBirds($numberOfThrowsLeft, $pighealth)
{
	//static $count = 0;

	static $result = array();
	$result["victory"] = "Het spel is bezig.";
	$result["throwsLeft"] = $numberOfThrowsLeft;


	$pighealth = calculateHit($pighealth);
	$result[$numberOfThrowsLeft] = $pighealth;

	
	if ($pighealth <= 0) 
	{
		$result["victory"] = "U heeft GEWONNEN ! ";
	}
	else
	{
		if ($numberOfThrowsLeft > 0)
		{
			LaunchAngryBirds(--$numberOfThrowsLeft, $pighealth);
		}
		else
		{
			$result["victory"] = "U heeft verloren... probeer het nog eens.";
		}
	}

	return $result;
}


function calculateHit($health){
	if (Hit())
	{
		--$health;
	}
	return $health;
}


function Hit(){
	// 40% kans om te raken.... als de worp hoger of gelijk is aan 60, dan is het een hit.
	$hit = rand(0, 100);
	//var_dump($hit);
	if ($hit >= 60){
		return TRUE;
	}else{
		return FALSE;
	}
}




////////// HTML BELOW //////////////////
?>


<!DOCTYPE html>
<html>
<head>
	<title> Angry Birds TEXTBASED</title>
</head>
<body>
<h1>Angry Brids..... TEXTBASED!</h1>

	<?php foreach ($game as $key => $value): ?>
		<?php if (is_int($key) ): ?>
			<p> Worp <?= $key ?> brengt <?= ($value > 1) ? 'de varkens' : ' het varken' ?> op <?= $value ?> levenspunten </p>
		<?php endif ?>
	<?php endforeach ?>

<p> <?= $game["victory"] ?> </p>



</body>
</html>