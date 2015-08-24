<?php 


function __autoload($classname) { 
	require_once("class/" . $classname . ".php"); 
}
/*
$imgfinder = new FileFinder();
$images = $imgfinder->FindEm("img/", "*.{jpg, jpeg, png, gif}");

*/
$jsfinder = new FileFinder();
$js = $jsfinder->FindEm("js/", "*.{js}");


$cssfinder = new FileFinder();
$css = $cssfinder->FindEm("css/", "*.{css}");


$messageContainer	=	'';
$querystring = "
				
				SELECT * FROM `brouwers` ";

try{
	$connectie = new PDO('mysql:host=localhost;dbname=bieren', 'root', ''); // Connectie maken
	$messageContainer='connectie OK.';
	try{

		$query = $connectie->prepare($querystring);

		// Een query uitvoeren
		$query->execute();

		$resultset = array();

		while ( $row = $query->fetch(PDO::FETCH_ASSOC) )
		{
			$resultset[]	=	$row;
		}

//		var_dump($resultset);
	}
	catch (PDOexception $e){
		throw new Exception("Error Processing Request", 1);
		
	}
}

catch (PDOexception $e)
{
	$messageContainer	=	'Er ging iets mis: ' . $e->getMessage();
}

$titleArr = array();

reset($resultset);
$titleArr = $resultset[0];

//var_dump("titles:");
//var_dump($titleArr);


//var_dump($messageContainer);
?>



<!DOCTYPE html>
<html>
<head>
	<title>Brouwers</title>

	<?php foreach ($css as $cssnr => $cssvalue): ?>
		<link rel="stylesheet" type="text/css" href="<?=$cssvalue?>">
	<?php endforeach ?>
	
	<?php foreach ($js as $jsnr => $jsvalue): ?>
		<script src="<?=$jsvalue?>"> </script>
	<?php endforeach ?>


</head>
<body>
	<h1>Brouwers</h1>

	<table>
		<thead>
			<tr>
				<th></th>
				<?php foreach ($titleArr as $keyName => $DontUse): ?>
					<th> <?= $keyName ?></th>
				<?php endforeach ?>
				<th> DELETE </th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($resultset as $key => $Record): ?>

				<form action="index.php" method="post">
					<tr class=" <?= ( $key % 2 ===0 ) ? 'even' : 'odd' ?>">
						<td><?=$key?></td>
						<?php foreach ($Record as $fieldkey => $fieldvalue): ?>
							<td><?= $fieldvalue ?> </td>
						<?php endforeach ?>
						<td> <input class="table-img" type="image"img src="img/trash_green.png" value = " <?= $key ?> " alt="submit" > </td>
					</tr>
				</form>

			<?php endforeach ?>

		</tbody>

	</table>

</body>
</html>