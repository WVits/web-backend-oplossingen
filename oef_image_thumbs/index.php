<?php 

	session_start();
	//var_dump(phpinfo());
	////////// Automatisch zoeken naar klasses....

	function __autoload($classname) { 
		require_once("class/" . $classname . ".php"); 
	}

	////////// Automatisch zoeken naar css en javascript
	$cssfinder = new FileFinder();
	$css = $cssfinder->FindEm("../css/", "*.{css}");
	
	$jsfinder = new FileFinder();
	$js = $jsfinder->FindEm("../js/", "*.{js}");
	
	$imgfinder = new FileFinder();
	$images = $imgfinder->FindEm("img/thumb/", "*.{jpg, jpeg, png, gif}");

	$_SESSION["images"]=$images;
	////////// Initialisatie Variablen
	$thumb ="";
	$currentpage = basename($_SERVER["PHP_SELF"]);

	$X = new W_DebugHelper();


	if(isset($_POST["wijzig"]))
	{ 
		var_dump($_POST);
		var_dump($_FILES);

		$pic = new PictureHandler();
		$filepath = $pic->getPicture($_FILES["file"]);
		var_dump($pic->getFilename());

		$thumb = $pic->resize(basename($filepath), $filepath);
		header("location: index.php");

	}






?>

<!DOCTYPE html>
<html>
<head>
	<title>Image thumbs</title>

		<?php ////// dynamisch invoegen van alle CSS en JS bestanden ?>
		<?php foreach ($css as $cssnr => $cssvalue): ?>
			<link rel="stylesheet" type="text/css" href="<?=$cssvalue?>" >
		<?php endforeach ?>
						
		<?php foreach ($js as $jsnr => $jsvalue): ?>
			<script src="<?=$jsvalue?>"> </script>
		<?php endforeach ?>
		<?php ////////////////////////////////////////////////////////?>

</head>
<body>

	<h1>Foto-upload en overzicht</h1>
		<form  method="POST" action="<?=$currentpage?>" enctype="multipart/form-data">

			<!-- <p><label for="naam" value="naam"> Naam </label> 
				<input type="text" name="naam" value="" size=59>
			</p> -->
			
			<p>	<label for="picture" value="picture"> Foto </label>

				<!-- <img class="profilepic" src="<?=$thumb ?>" alt="Geen profielfoto">   -->

				<input type="file" name="file" value="">
			</p> 
	
			<p><input type="submit" name="wijzig" value="Bevestig wijzigingen"></p>
			<p><input type="submit" name="annuleer" value="Annuleer"></p>
		</form>

		<?php foreach ($images as $key => $value): ?>
			<a href=<?="html/foto.php?thumb=" . $value ?> title"foto"> <img src="<?=$value?>" alt="picture number <?=$value?>"> </a>
		<?php endforeach ?>

</body>
</html>
