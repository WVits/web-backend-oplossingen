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
				
				SELECT brouwernr, brnaam FROM brouwers
				
				";

try{

	$connectie = new PDO('mysql:host=localhost;dbname=bieren', 'root', ''); // Connectie maken

	$messageContainer='connectie OK.';
	
		$query = $connectie->prepare($querystring);

		// Een query uitvoeren
		$query->execute();

		$resultset = array();

		while ( $row = $query->fetch(PDO::FETCH_ASSOC) )
		{
			$resultset[]	=	$row;
		}

//		var_dump($resultset);



//var_dump("titles:");
//var_dump($titleArr);


//var_dump($messageContainer);

///// nakijken of er al een brouwerij is gekozen....

	if (isset($_GET["brouwerijSelectie"]))
	{
	//var_dump($_GET["brouwerijSelectie"]);
		
		// ZOEKEN naar alle bieren van deze brouwerij...
		$querystring_bieren = "	SELECT naam as 'Naam van het bier' FROM bieren WHERE brouwernr = ". $_GET["brouwerijSelectie"]	;
		//var_dump($querystring_bieren);
							
		$query_bieren = $connectie->prepare($querystring_bieren);
		
				// Een query uitvoeren
				$query_bieren->execute();
		
				$resultset_bieren = array();
		
				while ( $row = $query_bieren->fetch(PDO::FETCH_ASSOC) )
				{
					$resultset_bieren[]	=	$row;
				}
		
				//var_dump($resultset_bieren);

	}


}

catch (PDOexception $e)
{
	$messageContainer	=	'Error: ' . $e->getMessage();
	//var_dump($messageContainer);
	throw $e;
	
}

?>



<!DOCTYPE html>
<html>
<head>
	<title>Bieren</title>

	<?php foreach ($css as $cssnr => $cssvalue): ?>
		<link rel="stylesheet" type="text/css" href="<?=$cssvalue?>">
	<?php endforeach ?>
	
	<?php foreach ($js as $jsnr => $jsvalue): ?>
		<script src="<?=$jsvalue?>"> </script>
	<?php endforeach ?>


</head>
<body>
	<h1>Bieren</h1>
	<label>Brouwerij: </label>

	<form method="GET">
		<select name="brouwerijSelectie">
	
			<?php foreach ($resultset as $key => $value): ?>
				
				<!--Option -->
				<option 	name="<?=$value["brouwernr"]?>" 
							value="<?=$value["brouwernr"]?>"
							<?= ( $value["brouwernr"] == $_GET["brouwerijSelectie"]  ) ? "selected" : '' ?>
							>
					
					<?=$value["brnaam"]?>

				</option>


			<?php endforeach ?>
		</select>
		<button type="submit" > Zoek bieren... </button>
	</form>

	<table>
		<thead>
			<tr>
				<th></th>
				<?php foreach ($resultset_bieren[0] as $keyName => $DontUse): ?>
					<th> <?= $keyName ?></th>
				<?php endforeach ?>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($resultset_bieren as $key => $Record): ?>
				<tr class=" <?= ( $key % 2 ===0 ) ? 'even' : 'odd' ?>">
					<td><?=$key?></td>
					<?php foreach ($Record as $fieldkey => $fieldvalue): ?>
						<td><?= $fieldvalue ?> </td>
					<?php endforeach ?>
				</tr>
			<?php endforeach ?>

		</tbody>

	</table>



</body>
