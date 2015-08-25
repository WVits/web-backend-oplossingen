<?php 

$datbasetype= "mysql";
$databasename = 'bieren';
$host='localhost';


try
{

	////////// Automatisch zoeken naar klasses....

	function __autoload($classname) { 
		require_once("class/" . $classname . ".php"); 
	}

	////////// Automatisch zoeken naar css en javascript
	$cssfinder = new FileFinder();
	$css = $cssfinder->FindEm("css/", "*.{css}");
	
	$jsfinder = new FileFinder();
	$js = $jsfinder->FindEm("js/", "*.{js}");
	

	////////// Make connection to database 

	$connection  = new W_DatabaseHelper("bieren");

	////////// VARIABELEN instellen

	$currentpage = basename($_SERVER["PHP_SELF"]);
	var_dump($currentpage);


///////////////////////  SELECT : alle brouwers

	var_dump($connection->query("SELECT * FROM bieren ORDER BY biernr DESC"));


	//$connectie = new PDO('mysql:host=localhost;dbname=bieren', 'root', ''); // Connectie maken
	//$messageContainer='connectie OK.';
	/*$messageContainer	=	'';
	$querystring = 	"	SELECT * FROM bieren ORDER BY biernr DESC	";

	$query = $connection->prepare($querystring);
	$query->execute();

	$resultset = array();
	while ( $row = $query->fetch(PDO::FETCH_ASSOC) )
	{
		$resultset[]	=	$row;
	}

	$titleArr = array();
	reset($resultset);
	$titleArr = $resultset[0];
	var_dump($resultset);*/

}


catch (PDOexception $e)
{
	$messageContainer	=	'Er ging iets mis: ' . $e->getMessage();
}




/*
$imgfinder = new FileFinder();
$images = $imgfinder->FindEm("img/", "*.{jpg, jpeg, png, gif}");
*/

?>



<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php foreach ($css as $cssnr => $cssvalue): ?>
		<link rel="stylesheet" type="text/css" href="<?=$cssvalue?>" >
	<?php endforeach ?>
						
	<?php foreach ($js as $jsnr => $jsvalue): ?>
		<script src="<?=$jsvalue?>"> </script>
	<?php endforeach ?>
	
</head>
<body>
	<h1>Bieren</h1>

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
								value = " <?= $Record["biernr"] ?> " 
								name = "biernr" 
								alt="submit" > 
						</td>
						<td>
						<input class="table-img" 
								type="image" 
								src="img/edit.png" 
								value = " <?= $Record["biernr"] ?> " 
								name = "biernr" 
								alt="submit" > 

						</td>

					</tr>
				</form>

			<?php endforeach ?>

		</tbody>

	</table>


</body>
</html>