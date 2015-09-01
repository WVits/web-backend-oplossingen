
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



	////////// Initialisatie Variablen

	$currentpage = basename($_SERVER["PHP_SELF"]);
	$Artikels = array();

	$X = new W_DebugHelper();

	//var_dump($_SESSION);


		// nakijken of de gebruiker wel is ingelogd...
	if (!isset($_SESSION["user"])){
		header('location: ../index.php');
	}
	else
	{
		if (isset($_POST["ArtikelAanpassen"]))
		{
			$_SESSION["aantepassenartikel"] = $_POST["art_id"];
	
			//var_dump($_SESSION);
			$X->dump($_SESSION);
			$X->dump("klaar om te navigeren");
			header('location: wijzigartikel.php');
			//header('location: uitloggen.php');
			//break;
		}
		
		if (isset($_POST["ArtikelVerwijderen"])){
			$_SESSION["teVerwijderenArtikel"] = $_POST["art_id"];
			header('location: verwijderartikel.php');
		}


		// Artikels ophalen...

		$connection  = new W_DatabaseHelper("cms");
	
		$querystring = "SELECT * FROM artikel 
						INNER JOIN user_art ON user_art.art_id = artikel.art_id
						INNER JOIN users ON users.userid = user_art.userid
						WHERE users.userid = :user
						AND artikel.is_active = 1
						AND artikel.is_archived = 0
						AND user_art.active = 1
		";
	
		//var_dump($_SESSION);
		if (isset($bindValues["user"]["userid"])){
			$bindValues = [ ":user" => $_SESSION["user"]["userid"]];
		}else{
			$bindValues = [ ":user" => $_SESSION["user"]];
		}
	
		
		//$saltArr = $connection->query($querygetsalt, $bindValues);
		//var_dump($saltArr);
		//var_dump("saltArrayDump in oef-security");
	
		$resultset = $connection->query($querystring, $bindValues);
	
		//var_dump($resultset);
	
	}

	

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>OVerzicht</title>
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

	<h1>Welkom <?= $_SESSION["username"]?> </h1>


	<?php if (isset($_SESSION["msg"])) : ?>

		<p> <?= $_SESSION["msg"] ?> </p>
	<?php endif ?>

	<div class="wrapper">
		<div class="masonry"> 
			<?php foreach ($resultset as $key => $value): ?>
				<article class="item">	
					
					<form method="POST" action = <?= $currentpage ?> >
						<h1> <?= $value["title"] ?> </h1>
			
						<img src="<?= "../" . $value["imagelink"] ?>" alt="image for the article">
						<p class="article-date"> <?=$value["date"] ?> </p>
						<p> <?= $value["inhoud"] ?> </p>
						<input type="hidden" name="art_id" value="<?= $value["art_id"] ?>">
						<p><input type="submit" name="ArtikelAanpassen" value="Wijzigen"></p>
						<p><input type="submit" name="ArtikelVerwijderen" value="Verwijderen"></p>
						
						<hr>
					</form>
				</article>
			<?php endforeach ?>
		</div>
	</div>
</body>
</html>