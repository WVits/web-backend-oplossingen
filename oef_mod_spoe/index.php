<?php 
	//var_dump($_GET);

	
	function __autoload($classname) { 
		require_once("classes/" . $classname . ".php"); 
	}

//
	$controller = 0;
	$method = 0;
	$value = 0;

	if (isset($_GET["hook"])){

		$urlgetvalues = explode("/", $_GET["hook"]);
		var_dump($urlgetvalues);


		if (sizeof($urlgetvalues) === 3 ){
			$controller = $urlgetvalues[0];
			$method = $urlgetvalues[1];
			$value = $urlgetvalues[2];
		}
		elseif (sizeof($urlgetvalues) === 2) {
			$controller = "Bier";
			$method = $urlgetvalues[0];
			$value = $urlgetvalues[1];
		}
		elseif (sizeof($urlgetvalues) === 1) {
			$controller = "Bier";
			$method = "overview";
			$value = $urlgetvalues[0];
		}	

		var_dump($controller);
		var_dump($method);
		var_dump($value);

		$instantie = new $controller;

		var_dump($instantie->printvalue());

		$instantie->$method();

	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Single point of entry</title>
</head>
<body>
	<h1>Single point of entry.</h1>
</body>
</html>