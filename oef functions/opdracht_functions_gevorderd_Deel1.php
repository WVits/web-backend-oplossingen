<?php  

/*Opdracht functies gevorderd: deel 1

Maak een global variable $md5HashKey met als value 'd1fa402db91a7a93c4f414b8278ce073'
Maak drie verschillende functies die de global variable $md5HashKey telkens op een andere manier aanspreken.
Het doel van deze functie is altijd hetzelfde: tellen hoeveel procent een bepaalde parameter voorkomt in $md5HashKey.
Spreek elke functie één keer aan, telkens met een ander argument:
Argument Functie 1: '2'
Argument Functie 2: '8'
Argument Functie 3: 'a'
Zorg ervoor dat het volgende wordt weergegeven:*/


////////////// VARIABLES //////////////////////////

$md5HashKey = 'd1fa402db91a7a93c4f414b8278ce073';

$FunctieArgument1 = '2';
$FunctieArgument2 = '8';
$FunctieArgument3 = 'a';

$output1 =0;
$output2 =0;
$output3 =0;

////////////// FUNCTIONS //////////////////////////


function BepaalPercentageInGlobaleVariabeleMd5HashKey($needle){
	global $md5HashKey;
	return (substr_count($md5HashKey, $needle) / strlen($md5HashKey)) ;
}

function BepaalPercentage($haystack, $needle){
	return (substr_count($haystack, $needle) / strlen($haystack)) ; 
}



///////////// Overige code //////////////////////

$output1 = (100 * BepaalPercentageInGlobaleVariabeleMd5HashKey(2)) . "%";
//var_dump($output1);
$output2 = (100 * substr_count($md5HashKey, $FunctieArgument2) / strlen($md5HashKey)) . '%';

$output3 = (100 * BepaalPercentage($md5HashKey, $FunctieArgument3)) . '%';

?>

<!DOCTYPE html>
<html>
<head>
	<title> Functions Gevorderd Deel 1</title>
</head>
<body>
	<h1> Functions Gevorderd Deel 1</h1>
	
	<p> De needle <?= $FunctieArgument1 ?> komt <?= $output1 ?> voor in de haystack <?= $md5HashKey?></p>
	<p> De needle <?= $FunctieArgument2 ?> komt <?= $output2 ?> voor in de haystack <?= $md5HashKey?></p>
	<p> De needle <?= $FunctieArgument3 ?> komt <?= $output3 ?> voor in de haystack <?= $md5HashKey?></p>


</body>
</html>

