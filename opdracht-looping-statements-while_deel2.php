<?php 

/*
Opdracht While deel 2

Maak een array $boodschappenlijstje en plaats hierin enkele boodschapjes.
Print deze boodschappen af in het HTML-gedeelte en plaats ze in <li>-elementen. Al deze <li>-elementen staan op hun beurt weer in één <ul>.
Valideer je code met de W3 Validator. Dit doe je door de source-code van je document te bekijken ctrl + u / ⌘-Option-U, deze te kopiëren en te plakken in de "direct input" tab.
Als je code niet geldig is, maak je de nodige wijzigingen.
*/
$output = '';
$out = array();

$boodschappenlijstje[] = 'melk';
$boodschappenlijstje[] = 'eieren';
$boodschappenlijstje[] = 'paprika';
$boodschappenlijstje[] = 'kipfilet';
$boodschappenlijstje[] = 'wasverzachter';

//var_dump($output);
//var_dump($boodschappenlijstje);


/*
for ($i=0; $i < sizeof($boodschappenlijstje); $i++) { 
	$output = $output . '<li>' . $boodschappenlijstje[$i] . '</li>';

}
*/

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Looping statements: while</title>
</head>



<body>
	<h1>Looping statements: while</h1>
	<ul>
		<!-- <?= $output ?> --> 

		<?php foreach ($boodschappenlijstje as $value): ?>
			<?= '<li> '. $value  . '</li>' ?>
						
		<?php endforeach ?>

	</ul>


</body>
</html>