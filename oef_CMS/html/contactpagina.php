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

	if(isset($_POST["annuleer"])){
		header("location: ../index.php");
	}

	


?>
<!DOCTYPE html>
<html>
<head>
	<title>Contactpagina</title>
</head>
<body>
	<header>
	

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

	<h1>Contacteer ons</h1>

	<form  method="POST" action="contact.php" >


	
			<p><label for="mailadres" value="mailadres"> Geef uw mailadres op:  </label> 
				<input type="text" name="mailadres" value="" size=59>
			</p>

			<p><label for="inhoud" value="inhoud"> Geef uw boodschap in: </label> 
				<textarea name="inhoud" rows=15 cols=80 ></textarea>
			</p>
	
	
			<p><input type="submit" name="wijzig" value="Verzenden"></p>
			<p><input type="submit" name="annuleer" value="Annuleer"></p>
	
	
	</form>
</body>
</html>