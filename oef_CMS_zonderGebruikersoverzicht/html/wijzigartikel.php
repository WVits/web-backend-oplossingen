<?php  

	session_start();

	////////// Automatisch zoeken naar klasses....

	function __autoload($classname) { 
		require_once("../class/" . $classname . ".php"); 
	}

	////////// Automatisch zoeken naar css en javascript
	$cssfinder = new FileFinder();
	$css = $cssfinder->FindEm("../css/", "*.{css}");
	
	$jsfinder = new FileFinder();
	$js = $jsfinder->FindEm("../js/", "*.{js}");
	
	////////// Make connection to database 

	////////// Init Variables
	$currentpage = basename($_SERVER["PHP_SELF"]);
	$X = new W_DebugHelper();

	///////// Functionality

	$X->dump($_SESSION);


	if(isset($_POST["annuleer"])){
		header('location: overzicht-artikelen.php');
	}

	//check if this user is logged in..
	if (!isset($_SESSION["user"])) 
	{
		//user is NOT logged in
		header('location: ../index.php');
		$X->dump("geen actieve user!");
	}
	else //user is logged in
	{
		//is er wel degelijk een artikel dat aangepast moet worden?
		if (isset($_SESSION["aantepassenartikel"]))
		{
			$connection  = new W_DatabaseHelper("cms");
			//artikel uit de database halen.

			if (isset($_POST["wijzig"]))
			{
				$X->dump($_POST);

				$querystring = "UPDATE `artikel` 
								SET title = :title ,
								    inhoud= :inhoud , 
								    imagelink = :imagelink ,
								    kernwoorden = :kernwoorden
								WHERE art_id = :art_id ";

				$bindValues = [ ":title" => $_POST["titel"], ":inhoud"=> $_POST["inhoud"], ":imagelink" => $_POST["imglink"], ":kernwoorden" => $_POST["kernwoorden"], ":art_id" => $_SESSION["aantepassenartikel"] ];
				//unset($_SESSION["aantepassenartikel"]);
	
				$resultset = $connection->query($querystring, $bindValues);
				$_SESSION["msg"] = "Wijzigingen zijn uitgevoerd.";
				header("location: overzicht-artikelen.php");
			}
			else{

			}
						
			////////// ARTIKEL OPHALEN 
	
				$art_id = $_SESSION["aantepassenartikel"];
	
				$querystring = "SELECT * FROM artikel WHERE art_id = :art_id";
	
				$bindValues = [ ":art_id" => $art_id];
	
				$artikel = $connection->query($querystring, $bindValues);
				$X->dump($artikel);
				$_SESSION["msg"] = "Wijzigingen zijn uitgevoerd.";
			//header("location: overzicht-artikelen.php");
		}
		else
		{
			$X->dump("Geen artikel geselecteerd");
			header('location: ../index.php');	
		}
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Wijzig artikel</title>
</head>
<body>
	<header>
		<a href='uitloggen.php' title='uitloggen'>Uitloggen.</a>
		<span> Ingelogd als <?= $_SESSION["username"] ?>. </span>
		<a href='toevoegform.php' title='artikel toevoegen'>Artikel toevoegen.</a>

		<?php ////// dynamisch invoegen van alle CSS en JS bestanden ?>
		<?php foreach ($css as $cssnr => $cssvalue): ?>
			<link rel="stylesheet" type="text/css" href="<?=$cssvalue?>" >
		<?php endforeach ?>
						
		<?php foreach ($js as $jsnr => $jsvalue): ?>
			<script src="<?=$jsvalue?>"> </script>
		<?php endforeach ?>
		<?php ////////////////////////////////////////////////////////?>

		<meta charset="utf-8" /> 
	</header>

	<h1>Artikel wijzigen</h1>

	<form  method="POST" action="<?=$currentpage?>" >


		<?php if (isset($artikel[0]['title'])): ?>
			
	
			<p><label for="titel" value="titel"> Titel </label> 
				<input type="text" name="titel" value="<?=$artikel[0]['title']?>" size=59>
			</p>

			<p><label for="kernwoorden" value="kernwoorden"> Geef de kernwoorden van het artikel in.. </label> 
				<input type="text" name="kernwoorden" value="<?=$artikel[0]['kernwoorden']?>" size=59>
			</p>
			
			<p>	<label for="inhoud" value="inhoud"> Typ de inhoud van het artikel in.. </label>
				<textarea name="inhoud" rows=15 cols=80 ><?=$artikel[0]['inhoud']?></textarea>
			</p>
	
			<p>	<label for="imglink" value="imglink"> Zet de image in de juiste map ( /img/ ) en zet hier de bestandsnaam. </label>
				<input type="text" name="imglink" value="<?=$artikel[0]['imagelink']?>"  size=59>			
			</p>
	
			<p><input type="submit" name="wijzig" value="Bevestig wijzigingen"></p>
			<p><input type="submit" name="annuleer" value="Annuleer"></p>
		<?php else: ?>
			<p><label for="titel" value="titel"> Titel </label> 
				<input type="text" name="titel" value="Geen artikel beschikbaar" size=59>
			</p>

			<p><label for="kernwoorden" value="kernwoorden"> Geef de kernwoorden van het artikel in.. </label> 
				<input type="text" name="kernwoorden" value="" size=59>
			</p>
			
			<p>	<label for="inhoud" value="inhoud"> Typ de inhoud van het artikel in.. </label>
				<textarea name="inhoud" rows=15 cols=80 >  </textarea>
			</p>
	
			<p>	<label for="imglink" value="imglink"> Zet de image in de juiste map ( /img/ ) en zet hier de bestandsnaam. </label>
				<input type="text" name="imglink" value=""  size=59>			
			</p>
	
			<p><input type="submit" name="wijzig" value="Bevestig wijzigingen"></p>
			<p><input type="submit" name="annuleer" value="Annuleer"></p>
		<?php endif ?>
	
	</form>
</body>
</html>