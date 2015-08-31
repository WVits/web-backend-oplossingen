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


	$biernr ="";
	$naam= "";
	$brouwernr =  "";
	$soortnr =  "";
	$alcohol =  "";


	$ordercolumn = "biernr";
	$orderdirection ="ASC";
	//var_dump($currentpage);


	////////// Is er een element gekozen voor Update??? 

	if (isset($_POST["update"]))
	{
		//var_dump("!!UPDATE!!");
		//var_dump($_POST["update"]);
//
		//new
		/*$querystring = "SELECT bieren.biernr, bieren.naam, bieren.alcohol
						INNER JOIN brouwers on bieren.brouwernr = brouwers.brouwernr
						INNER JOIN soorten on bieren.soortnr = soorten.soortnr
						WHERE bieren.biernr = :biernr
		";*/
		//endnew
		$resultset = $connection->query("SELECT biernr, naam, brouwernr, soortnr, alcohol FROM bieren WHERE biernr = :biernr", [":biernr" => $_POST["update"]]);
		//old
		//"SELECT biernr, naam, brouwernr, soortnr, alcohol FROM bieren WHERE biernr = :biernr"

		$updateRecord = TRUE;
		$biernr = $resultset[0]["biernr"];
		$naam =  $resultset[0]["naam"];
		$brouwernr =  $resultset[0]["brouwernr"];
		$soortnr =  $resultset[0]["soortnr"];
		$alcohol =  $resultset[0]["alcohol"];


	//	var_dump($resultset);
		unset($_POST["update"]);

	}

	if (isset($_POST["commit-update"]))
	{
		//var_dump($_POST);

		$biernr = $_POST["biernr"];
		$naam =  $_POST["naam"];
		$brouwernr =  $_POST["brouwernr"];
		$soortnr =  $_POST["soortnr"];
		$alcohol =  $_POST["alcohol"];

		$querystring= "UPDATE bieren SET naam= :naam, brouwernr = :brouwernr, soortnr = :soortnr, alcohol = :alcohol WHERE biernr = :biernr";


		$resultset = $connection->query($querystring, [ ":naam"=> $naam, ":brouwernr"=> $brouwernr, ":soortnr"=> $soortnr, ":alcohol"=> $alcohol, ":biernr" => $biernr]);

		//var_dump("aangepast");
	}



	////////// Delete???

	if (isset($_POST["delete"]))
	{
		//var_dump("!!DELETE!!");
		//var_dump($_POST["delete"]);

		$resultset = $connection->query("DELETE FROM bieren WHERE biernr = :biernr", [":biernr" => $_POST["delete"]]);

	}


	////////// Sorteren?

	if (isset($_POST["asc"])){
		//var_dump($_POST["asc"]);

		$orderdirection = "ASC";
		$ordercolumn = $_POST["asc"];

		unset($_POST["asc"]);
	}

	if (isset($_POST["desc"])){
		//var_dump($_POST["desc"]);

		$orderdirection = "DESC";
		$ordercolumn = $_POST["desc"];

		unset($_POST["desc"]);
	}




	///////////////////////  SELECT : alle brouwers
	$resultset = $connection->query("SELECT biernr,	naam, brouwernr, soortnr, alcohol FROM bieren ORDER BY " . $ordercolumn . " " . $orderdirection);
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
				<th href="<?=$currentpage?>"></th>
				<?php foreach ($titleArr as $key => $value): 
				//  Titels van de kolommen plaatsen, met in elke kolom twee icoontjes om te sorteren.
				?>
					<th> 
						<form  method="POST" action="<?=$currentpage ?>" >
							<?= $value ?> 
	
							<input class="table-img" 
									type="image" 
									src="img/icon-asc.png" 
									name = "asc" 
									value= <?= $value ?>
									alt="submit" > 
	
							<input class="table-img" 
									type="image" 
									src="img/icon-desc.png" 
									name = "desc" 
									value= <?= $value ?>
										alt="submit" > 

						</form>
					</th>
				<?php endforeach ?>
				
				<th> DELETE </th>
				<th> UPDATE </th>
			</tr>
		</thead>

		<tbody>

			<?php //////////////////  FORM voor UPDATE... alleen als er op update is geklikt ?>
			<?php if ($updateRecord): ?>
				<form method="POST" action="<?=$currentpage ?>" class= "updateform" >
			
					<h2>Biernummer:  <?=$biernr?> </h2>
					<p><input type="text" name="biernr" id="biernr" value="<?=$biernr?>" >  </p>
					<p><label> Naam: </label> </p>
					<p><input type="text" name="naam" id="naam" value="<?=$naam?>"></p>
					<p><label> Brouwernr: </label> </p>
					<p><input type="text" name="brouwernr" id="brouwernr" value="<?=$brouwernr?>"></p>
					<p><label> Soortnr: </label> </p>
					<p><input type="text" name="soortnr" id="soortnr" value="<?=$soortnr?>"></p>
					<p><label> Alcohol: </label> </p>
					<p><input type="text" name="alcohol" id="alcohol" value="<?=$alcohol?>"></p>
	
					<p>
						<label> </label> <input type="submit" name="commit-update" value="Aanpassen" class="button">
						<label> </label> <input type="submit" value="Annuleren" class="button">
					</p>
	
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