<?php 
	//echo "ok";
	//klasses inladen
	function __autoload($classname) 
	{ 
		require_once("classes/" . $classname . ".php"); 
	}

	//html genereren op basis van deel-html.
	$html = new HTMLBuilder(file_get_contents("html/header.partial.html"), 
								file_get_contents('html/body.partial.html'),  
								file_get_contents('html/footer.partial.html'));
	
	var_dump($html->findfiles(".txt"));
	//var_dump($testhtml);
	//require_once("html/body.partial.html");

	//$files = $html->listfiles();
	//var_dump($files);
?>

<?= $html->buildHTML() ?>


