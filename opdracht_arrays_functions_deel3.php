

<?php
/*
Opdracht array functies: deel 3

Maak een array met volgende waarden:
8, 7, 8, 7, 3, 2, 1, 2, 4

Haal de duplicaten uit de array
Sorteer de array van groot naar klein
*/

$numbers = array(8, 7, 8, 7, 3, 2, 1, 2, 4);
var_dump($numbers);

//array array_unique ( array $array [, int $sort_flags = SORT_STRING ] )

$arr_unique_numbers = array_unique($numbers);

//sort($arr_unique_numbers);
rsort($arr_unique_numbers);
var_dump($arr_unique_numbers);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Opdracht Arrays Functies - deel 3</title>
</head>
<body>
	<H1>Opdracht arrays functies - deel 3</H1>
	<p></p>

</body>
</html>