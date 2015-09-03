
<?php 


session_start();
	//var_dump(phpinfo());
	////////// Automatisch zoeken naar klasses....

	function __autoload($classname) { 
		require_once("../class/" . $classname . ".php"); 
	}

	////////// Automatisch zoeken naar css en javascript
	$cssfinder = new FileFinder();
	$css = $cssfinder->FindEm("../css/", "*.{css}");
	
	$jsfinder = new FileFinder();
	$js = $jsfinder->FindEm("../js/", "*.{js}");
	


//var_dump($_GET);

$file = basename($_GET["thumb"]);



$file = substr($file, 6);
$file = "../img/" . $file;


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Bekijk de originele foto.</title>
	
</head>
<body>
	<header>
		<a href="../index.php" title ="home">Terug</a>
	</header>

	<h1>Originele foto: </h1>
	<hr>
	<form class="masonry">
	
		<a class="item" href="../index.php" title ="home"> 	<img src="<?= $file ?>" alt="geen foto"> </a>
		<input class="item" type="submit" name="verwijderen" value="verwijder deze foto">
	</form>



</body>
</html>