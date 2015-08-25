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

$currentpage = basename( $_SERVER["PHP_SELF"] );
//var_dump($currentpage);

$messageContainer	=	'';
$querystring = "
				
				SELECT * FROM `brouwers` ";

try{

/*
if (isset($_POST)){
	var_dump($_POST);

	$connectie = new PDO('mysql:host=localhost;dbname=bieren', 'root', ''); // Connectie maken
	$messageContainer='connectie OK.';

	$querystring = "DELETE FROM brouwers WHERE brouwernr =" . $_POST['brouwernr'] . " LIMIT 1";
	var_dump($querystring);

	$query = $connectie->prepare($querystring);

			// Een query uitvoeren

	//var_dump($querystring);
	$query->execute();

	//header("Location: " . $currentpage);

}
*/
	$connectie = new PDO('mysql:host=localhost;dbname=bieren', 'root', ''); // Connectie maken
	$messageContainer='connectie OK.';
////////////////// DELETE : brouwer met het brouwernr dat gelijk is aan de POST-waarde.
if (isset($_POST['brouwernr'])){
	//var_dump($_POST);

	$querydeletestring = "DELETE FROM brouwers WHERE brouwernr = :brouwernr LIMIT 1";
	//var_dump($querystring);


	$querydelete = $connectie->prepare($querydeletestring);
	$querydelete->bindValue(':brouwernr', $_POST['brouwernr']);
	$querydelete->execute();
}


///////////////////////  SELECT : alle brouwers

	//$connectie = new PDO('mysql:host=localhost;dbname=bieren', 'root', ''); // Connectie maken
	//$messageContainer='connectie OK.';
	

	$query = $connectie->prepare($querystring);
	// Een query uitvoeren
	$query->execute();
	$resultset = array();
	while ( $row = $query->fetch(PDO::FETCH_ASSOC) )
	{
		$resultset[]	=	$row;
	}
	$titleArr = array();
	reset($resultset);
	$titleArr = $resultset[0];

//var_dump("titles:");
//var_dump($titleArr);
//var_dump($resultset);

}

catch (PDOexception $e)
{
	$messageContainer	=	'Er ging iets mis: ' . $e->getMessage();
}


/*
////////////////// DELETE : brouwer met het brouwernr dat gelijk is aan de POST-waarde.
if (isset($_POST)){
	//var_dump($_POST);
	$querystring = "DELETE FROM brouwers WHERE brouwernr =" . $_POST['brouwernr'] . " LIMIT 1";
	//var_dump($querystring);
	$query = $connectie->prepare($querystring);
	$query->execute();
}
*/
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

				<form action= "<?=$currentpage ?>" method="post">
					<tr class=" <?= ( $key % 2 ===0 ) ? 'even' : 'odd' ?>">
						<td><?=($key + 1) ?></td>
						
						<?php foreach ($Record as $fieldkey => $fieldvalue): ?>
							<td><?= $fieldvalue ?> </td>
						<?php endforeach ?>
						
						<td> 
						<input class="table-img" 
								type="image" 
								src="img/trash_green.png" 
								value = " <?= $Record["brouwernr"] ?> " 
								name = " brouwernr" 
								alt="submit" > 
						</td>

					</tr>
				</form>

			<?php endforeach ?>

		</tbody>

	</table>

</body>
</html>