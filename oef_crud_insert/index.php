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
$message='';

try
{

	if(isset($_POST["brnaam"]))
	{

		$brnaam = $_POST["brnaam"];
		$adres = $_POST["adres"];
		$postcode = $_POST["postcode"];
		$gemeente = $_POST["gemeente"];
		$omzet = $_POST["omzet"];

		//INSERT Query opbouwen

		$querystring = " INSERT INTO brouwers 
						(brnaam, adres, postcode, gemeente, omzet) 
						VALUES  (:brnaam , :adres, :postcode , :gemeente , :omzet)"
						; 

						//end of query-string

		$connectie = new PDO('mysql:host=localhost;dbname=bieren', 'root', ''); // Connectie maken

		$messageContainer='connectie OK.';
		
		$query = $connectie->prepare($querystring);
		
		$query->bindValue(':brnaam', $brnaam);
		$query->bindValue(':adres', $adres);
		$query->bindValue(':postcode', $postcode);
		$query->bindValue(':gemeente', $gemeente);
		$query->bindValue(':omzet', $omzet);


		/* 
		$statement = $db->prepare($queryString);

		$statement->bindValue(':alcoholPercentage', $alcoholPercentage );
		*/




			// Een query uitvoeren

			var_dump($querystring);
			$query->execute();
			unset($_POST);

			$querystring = "SELECT * FROM brouwers ORDER BY brouwernr DESC LIMIT 1 ";

			$query = $connectie->prepare($querystring);

			// Een query uitvoeren

			var_dump($querystring);
			$query->execute();

			$resultset = array();

			while ( $row = $query->fetch(PDO::FETCH_ASSOC) )
			{
				$resultset[]	=	$row;
			}
			var_dump($resultset);
			$message = 'Toevoegen geslaagd. De nieuwe brouwerij heeft volgnummer ' . $resultset[0]["brouwernr"];
			var_dump($message);
			unset($_POST);

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
	<h1>Brouwerij Toevoegen</h1>
	
	<form method="POST" action="index.php" >
		
		<label> Brouwernaam: </label> <input type="text" name="brnaam" id="brnaam" value="">
		<label> Adres: </label> <input type="adres" name="adres" id="adres" value="">
		<label> Postcode: </label> <input type="postcode" name="postcode" id="postcode" value="">
		<label> Gemeente: </label> <input type="gemeente" name="gemeente" id="gemeente" value="">
		<label> Omzet: </label> <input type="omzet" name="omzet" id="omzet" value="">

		<label> </label> <input type="submit" value="Toevoegen" class="button">

	</form>


	<p> <?=$message ?> </p>

</body>
