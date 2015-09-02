<?php 

session_start();

	////////// Automatisch zoeken naar klasses....

	function __autoload($classname) { 
		require_once("../class/" . $classname . ".php"); 
	}

	if (!isset($_POST["toonArtikels"]))
	{
		$_POST["toonArtikels"]  = 0;
	}
	if (!isset($_POST["toonUsers"]))
	{
		$_POST["toonUsers"]  = 0;
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

	


		// Artikels ophalen...

		$connection  = new W_DatabaseHelper("cms");
	
		$querystring = "SELECT * FROM artikel";
	
		$resultset = $connection->query($querystring);

		$querystring ="SELECT * FROM users";
		$userset = $connection->query($querystring);



	
		if(isset($_POST["toggleArtikels"]))
		{
			if($_POST["toonArtikels"] == 1)
			{
				$_POST["toonArtikels"]  = 0;
				unset($_POST["toggleArtikels"]);
			}
			else
			{
				$_POST["toonArtikels"]  = 1;
				unset($_POST["toggleArtikels"]);
			}
		}


		if(isset($_POST["toggleUsers"]))
		{
			if($_POST["toonUsers"] == 1)
			{
				$_POST["toonUsers"]  = 0;
				unset($_POST["toggleUsers"]);
			}
			else
			{
				$_POST["toonUsers"]  = 1;
				unset($_POST["toggleUsers"]);
			}
		}

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



 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>ADMIN</title>
 	

 	<?php ////// dynamisch invoegen van alle CSS en JS bestanden ?>
	<?php foreach ($css as $cssnr => $cssvalue): ?>
		<link rel="stylesheet" type="text/css" href="<?=$cssvalue?>" >
	<?php endforeach ?>
						
	<?php foreach ($js as $jsnr => $jsvalue): ?>
		<script src="<?=$jsvalue?>"> </script>
	<?php endforeach ?>
	<?php ////////////////////////////////////////////////////////?>

	<meta charset="utf-8" /> 


 </head>
 <body>
	<header>
		<span> Ingelogd als <?= $_SESSION["username"] ?>. </span>
		<p>
		<a href='toevoegform.php' title='artikel toevoegen'>Artikel toevoegen.</a>
		<a href='wijzigprofiel.php' title='profiel aanpassen'>Profiel aanpassen.</a>
		<a href='uitloggen.php' title='uitloggen'>Uitloggen.</a>
		<a href='overzicht-artikelen.php' title='Bekijk Mijn Artikels'>Bekijk Mijn Artikels.</a>
		</p>

		<form method="POST" action="<?=$currentpage?>">
			<input type="submit" name="toggleArtikels" value="Toon Artikels">
			<input type="submit" name="toggleUsers" value="Toon Users">
			<input type="submit" name="verberg" value="Verberg Alles">  

		</form>
		
	</header>

	<h1>Welkom <?= $_SESSION["username"]?> </h1>


	<?php if (isset($_SESSION["msg"])) : ?>

		<p> <?= $_SESSION["msg"] ?> </p>
	<?php endif ?>

	<?php if ($_POST["toonUsers"] === 1): ?>
		<div class="wrapper">
			<div class="masonry"> 
			<?php foreach ($userset as $key => $value): ?>
				<article class="item">	
					
					<form method="POST" action = <?= $currentpage ?> >
						<h1> <?= $value["naam"] ?> </h1>
			
						<img src="<?='../' . $value['picture']?>" alt="image for the article">
						
						
						<hr>
					</form>
				</article>
			<?php endforeach ?>
		</div>
	</div>
	<?php endif ?>
	<?php if ($_POST["toonArtikels"] === 1): ?>
		<div class="wrapper">
			<div class="masonry"> 
			<?php foreach ($resultset as $key => $value): ?>
				<article class="item">	
					
					<form method="POST" action = <?= $currentpage ?> >
						<h1> <?= $value["title"] ?> </h1>
			
						<img src="<?='../' . $value['imagelink']?>" alt="image for the article">
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
	<?php endif ?>
	
</body>
 </html>