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
	$updateRecord = FALSE;
	//var_dump($currentpage);


	////////// Update??? 

	if (isset($_POST["update"]))
	{
		var_dump("!!UPDATE!!");
		var_dump($_POST["update"]);

		$resultset = $connection->query("SELECT biernr,	naam, brouwernr, soortnr, alcohol FROM bieren WHERE biernr = :biernr", [":biernr" => $_POST["update"]]);
		

		$updateRecord = TRUE;
		$biernr = $resultset[0]["biernr"];


		var_dump($resultset);
		unset($_POST["update"]);

	}
	////////// Delete???

	if (isset($_POST["delete"]))
	{
		var_dump("!!DELETE!!");
		var_dump($_POST["delete"]);

		$resultset = $connection->query("DELETE FROM bieren WHERE biernr = :biernr", [":biernr" => $_POST["delete"]]);

	}





	///////////////////////  SELECT : alle brouwers
	$resultset = $connection->query("SELECT biernr,	naam, brouwernr, soortnr, alcohol FROM bieren ORDER BY biernr DESC");
	$titleArr = $connection->buildTitleArray($resultset);

} //end try

catch (PDOexception $e)
{
	$messageContainer	=	'Er ging iets mis: ' . $e->getMessage();
}//end catch

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
				<?php foreach ($titleArr as $key => $value): ?>
					<th> <?= $value ?></th>
				<?php endforeach ?>
				
				<th> DELETE </th>
				<th> UPDATE </th>
			</tr>
		</thead>


		<tbody>


			<?php //////////////////  FORM voor UPDATE... alleen als er op update is geklikt ?>
			<?php if ($updateRecord): ?>
				<form method="POST" action="<?=$currentpage ?>" class= "updateform" >
			
					<p><label> Brouwernaam: </label> </p>
					<p><input type="text" name="brnaam" id="brnaam" value="<?= $biernr ?>">  </p>
					<p><label> Adres: </label> </p>
					<p><input type="adres" name="adres" id="adres" value=""></p>
					<p><label> Postcode: </label> </p>
					<p><input type="postcode" name="postcode" id="postcode" value=""></p>
					<p><label> Gemeente: </label> </p>
					<p><input type="gemeente" name="gemeente" id="gemeente" value=""></p>
					<p><label> Omzet: </label> </p>
					<p><input type="omzet" name="omzet" id="omzet" value=""></p>
	
					<p><label> </label> <input type="submit" value="Toevoegen" class="button"></p>
	
				</form>
	
	
			<?php endif ?>
				

			<?php //////////////////  FORM voor tabel met alle bieren. Hierin kan je UPDATE of DELETE kiezen?>
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
								name = "delete" 
								alt="submit" > 
						</td>
						<td>
						<input class="table-img" 
								type="image" 
								src="img/edit.png" 
								value = " <?= $Record["biernr"] ?> " 
								name = "update" 
								alt="submit" > 

						</td>

					</tr>
				</form>

			<?php endforeach ?>

		</tbody>

	</table>


</body>
</html>