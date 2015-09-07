<?php 


	////////// Autoload classes //////////////////////////////////////
	function __autoload($classname) { 
		require_once("class/" . $classname . ".php"); 
	}

	////////// Automatisch zoeken naar css en javascript /////////////
	$cssfinder = new FileFinder();
	$css = $cssfinder->FindEm("css/", "*.{css}");
	
	$jsfinder = new FileFinder();
	$js = $jsfinder->FindEm("js/", "*.{js}");
	

	////////// Instantiëren van variabelen ///////////////////////////

	$resultstring = FALSE;
	$replacement = "<span class='match'>#</span>";


	////////// functionaliteit ///////////////////////////////////////

	if (isset($_POST["testregex"])){
		//var_dump($_POST);
		$pattern = "/" . $_POST["regex"] . "/";
		$replacement = "<span class='match'>#</span>";

		$resultstring = $_POST["text"];

		if ($pattern !== ""){
			$resultstring = preg_replace($pattern, $replacement, $resultstring);
			//var_dump($resultstring);
		}
		else 
		{
			$resultstring = "U gaf een lege regular expression in.";
		}
		
		unset($_POST["testregex"]);
	}

	///////// hardcoded testen van een aantal regular expressions ////

	/*Match alle letters tussen a en d, en u en z (hoofdletters inclusief)
	String: Memory can change the shape of a room; it can change the color of a car. And memories can be distorted. They're just an interpretation, they're not a record, and they're irrelevant if you have the facts.*/

	$regex1 = "a";
	$replacement1 = $replacement;
	$text1 = "Memory can change the shape of a room; it can change the color of a car. And memories can be distorted. They're just an interpretation, they're not a record, and they're irrelevant if you have the facts.";

	$result1 = preg_replace( "/" . $regex1 . "/" , $replacement1, $text1);


/*match color en colour */

	$regex2 = "\b(colou?r)\b";
	$replacement2 = $replacement;
	$text2 = "color and colour are both correct.";

	$result2 = preg_replace( "/" .  $regex2 . "/", $replacement2, $text2);

/*Match enkel de getallen die een 1 als duizendtal hebben.
String: 1020 1050 9784 1560 0231 1546 8745*/
	$regex3 = "(1[0-9]{3})";
	$replacement3 = $replacement;
	$text3 = "1020 1050 9784 1560 0231 1546 8745";

	$result3 = preg_replace( "/" .  $regex3 . "/", $replacement3, $text3);

/*Match alle data zodat er enkel een reeks "en" overblijft.
String: 24/07/1978 en 24-07-1978 en 24.07.1978*/


	$regex4 = "[0-9]{2}.[0-9]{2}.[0-9]{4}";
	$replacement4 = $replacement;
	$text4 = "24/07/1978 en 24-07-1978 en 24.07.1978";

	$result4 = preg_replace("/" .  $regex4 . "/", $replacement4, $text4);

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Regular Expression Tester</title>

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

	<h1>Expres : De regular expression tester.</h1>
	<form action="index.php" method="POST">
		<p><label> Typ hier je regular expression in: </label> <input class="inputfield" type="text" name="regex" value="<?=( isset($_POST["regex"]) ) ? $_POST["regex"] : '' ?>"></p>
		<p><label> Typ hier je tekst in: </label> <textarea name="text" ><?=( isset($_POST["text"]) ) ? $_POST["text"] : '' ?></textarea></p>

		<input type="submit" name="testregex">
	</form>


	<?php if ($resultstring): ?>
		<p class="inputfield"> Resultaat: <?=$resultstring?> <p>
	<?php endif ?>



	<h2>Enkele voorbeelden.</h2>

	<h3>Regular expression 	: <?= $regex1 ?> </h3> 
	<p>String				: <?= $text1 ?> </p>
	<p>Geeft 				: <?= $result1 ?> </p>

	<h3>Regular expression 	: <?= $regex2 ?> </h3> 
	<p>String				: <?= $text2 ?> </p>
	<p>Geeft 				: <?= $result2 ?> </p>

	<h3>Regular expression 	: <?= $regex3 ?> </h3> 
	<p>String				: <?= $text3 ?> </p>
	<p>Geeft 				: <?= $result3 ?> </p>

	<h3>Regular expression 	: <?= $regex4 ?> </h3> 
	<p>String				: <?= $text4 ?> </p>
	<p>Geeft 				: <?= $result4 ?> </p>



</body>
</html>