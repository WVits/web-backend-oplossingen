<?php 

/*
Opdracht while: deel 1

Druk alle getallen af van 0 tot 100 afgescheiden door een komma en een spatie ' , '.
Op een volgende lijn druk je alle getallen af die deelbaar zijn door 3 én groter zijn dan 40 mààr kleiner zijn dan 80.

*/

$i = 0;
$output_all = '';
$output_filtered = '';

while ( $i <= 100) {
	$output_all .= $i . ', ';
	$i++;

	if (($i % 3 === 0 ) && ($i > 40) && ($i< 80) ){
		$output_filtered .= $i . ', ';
	}

};

//var_dump($output_all);
//var_dump($output_filtered);


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Looping statements: while</title>
</head>



<body>
	<h1>Looping statements: while</h1>
	<p> Getallen van 0 tot 100 <p>
	<p> <?php echo $output_all ?></p>


	<p> Alle getallen af die deelbaar zijn door 3 én groter zijn dan 40 mààr kleiner zijn dan 80: </p>
	<p> <?php echo $output_filtered ?></p>


</body>
</html>