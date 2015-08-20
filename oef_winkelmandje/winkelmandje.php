<?php 

session_start();


////////////// INTIIALISATIE VARIABELEN //////////////////////////////////////

$artikels = array( "appel" => array("appel", 0), 
					"banaan" => array("banaan", 0), 
					"peer" => array("peer", 0),
					"meloen" => array("meloen", 0),
					"avocado" => array("avocado" , 0 ) 
					);
//$artikels = array( "appel", "banaan", "peer", "meloen",	"avocado");



//var_dump($artikels);


//$winkelmandje = array();
$artikels_in_mandje = FALSE;




//////////////   Winkelmandje vullen   //////////////////////////////////////////////////////////

//zit er al iets in het winkelmandje?


if (isset($_SESSION["winkelmandje"])){
	/*foreach ($_SESSION["winkelmandje"] as $key => $value) {
		$winkelmandje[$key] = $value;
	}*/
	$artikels_in_mandje = TRUE;
}	


//iets toevoegen aan het mandje
$gevonden = FALSE;
foreach ($artikels as $key => $value) 
{
	//$gevonden = FALSE;
	if (isset($_POST[$key]))
	{
		

		// nakijken of er al een artikel met die naam in het winkelmandje zit...
		if (isset($_SESSION["winkelmandje"]))
		{
			foreach ($_SESSION["winkelmandje"] as $winkelmandvolgnummer => $artikelarray) 
			{
	
				var_dump("artikelarray bevat ");
				var_dump($artikelarray);
				if($_POST[$key] == $artikelarray[0])
				{
					var_dump($artikelarray);
					var_dump($_POST[$key] . " bestaat reeds");
					$artikelarray[1] = $artikelarray[1] + 1;
					++$_SESSION["winkelmandje"][$winkelmandvolgnummer][1];
					var_dump($artikelarray);
					$gevonden = TRUE;
				}
			}
		}
	}

		// als het artikel nog niet in het winkelmandje zit voegen we het toe.
		if ($gevonden === FALSE){
			var_dump('nieuw artikel');
			$nieuw_element = array();
			$nieuw_element[0] = $key;
			$nieuw_element[1] = 1;
			array_push(	$_SESSION["winkelmandje"], $nieuw_element);
			$gevonden = TRUE;
		}
		var_dump($_SESSION);


	//var_dump($key . " " . $value[0] . ' ' . $value[1]);
}	



///////////// Een element verwijderen uit het winkelmandje indien er op een delete-knop geklikt is //////////////

///// -------------------------WERKT NOG NIET
/*
if (isset($_GET["remove"])){
	var_dump("verwijder " . $_GET["remove"]);

	foreach ($_SESSION["winkelmandje"] as $key => $value) {
		var_dump("nu: key= -" . $key . "- value : -" . $value[0] . "- en ['remove']= " . $_GET["remove"]);
		if($value[0] == $_GET["remove"]){

			//zijn er één of meerdere items van deze soort in het winkelmandje?

			//als er één is, dan moet het artikel uit de lijst
			if ($_SESSION["winkelmandje"][$key][1] <= 1)
			{
				unset($_SESSION["winkelmandje"][$key]);
				var_dump($key);
				var_dump("verwijderd" . $_GET["remove"]);
			}
			// als er meerdere items zijn, moet het eentje minder worden. 
			else{
				--$_SESSION["winkelmandje"][$key][1];
			}
		}else{
			var_dump($_GET["remove"] . " werd niet gevonden en verwijderd.");
		}

	}
	$_GET["remove"] = '';
	unset($_GET["remove"]);
	var_dump($_SESSION["winkelmandje"] );
	//header('location: winkelmandje.php');
}

*/



//iets verwijderen uit het mandje
foreach ($artikels as $key => $value) 
{
	$gevonden = FALSE;
	if (isset($_GET["remove"]))
	{
		$gevonden = FALSE;

		// nakijken of er al een artikel met die naam in het winkelmandje zit...
		if (isset($_SESSION["winkelmandje"]))
		{
			foreach ($_SESSION["winkelmandje"] as $winkelmandvolgnummer => $artikelarray) 
			{
	
					var_dump("artikelarray bevat ");
					var_dump($artikelarray);
					if($_GET["remove"] == $artikelarray[0])
					{
						var_dump($artikelarray);
						var_dump($_POST[$key] . " bestaat reeds");
						$artikelarray[1] = $artikelarray[1] - 1;
						--$_SESSION["winkelmandje"][$winkelmandvolgnummer][1];
						var_dump($artikelarray);
						$gevonden = TRUE;

						if ($artikelarray[1] == 0)
						{
						unset($_SESSION["winkelmandje"][$key]);
						var_dump($key);
						var_dump("verwijderd" . $_GET["remove"]);
						}
					}
			}
		}
	}
			

		// als het artikel nog niet in het winkelmandje zit voegen we het toe.
		if ($gevonden === FALSE){
			var_dump('nieuw artikel');
			$nieuw_element = array();
			$nieuw_element[0] = $key;
			$nieuw_element[1] = 1;
			array_push(	$_SESSION["winkelmandje"], $nieuw_element);
		}
		var_dump($_SESSION);


	//var_dump($key . " " . $value[0] . ' ' . $value[1]);
}	



//////////// Winkelmandje leegmaken //////////////////////////////////////////////////
if(isset($_POST["maak_leeg"])){
	//$winkelmandje = array();
	unset($_SESSION["winkelmandje"]);
	$_SESSION["winkelmandje"] = array();
	$artikels_in_mandje = FALSE;
	unset($_POST["maak_leeg"]);
	unset($_GET["remove"]);
}





////////////////// Refresh page //////////////////////////////////////////////
//header('location winkelmandje.php');



//////////////// HTML Below //////////////////////////////////////////////////
?>

<!DOCTYPE html>
<html>
<head>
	<title>winkelmandje</title>
</head>
<body>
	<h1>Welkom bij Fruit&Co</h1>
	<section>
		<?php foreach ($artikels as $key => $value): ?>
			<form method="post">
				<button value="<?=$key?>" type="submit"  id="<?=$key?>" name="<?=$key?>" > <?=$key?>   </button> 
			</form>
		<?php endforeach ?>
	</section>

	<aside>
		<?php if ($artikels_in_mandje) : ?>
			<?php foreach ($_SESSION["winkelmandje"] as $volgnummer => $artikelnaam): ?>
				
				<p> <a href='?remove="<?=$artikelnaam[0]?>"' name= "<?=$artikelnaam[0]?>" > x </a> <?=$artikelnaam[0]?> <?=$artikelnaam[1]?> </p>
			<?php endforeach ?>
			
		<?php endif ?>
	</aside>

	<form method="post">
		<button value="maak_leeg" type="submit" id="maak_leeg" name="maak_leeg"> Maak winkelmanje leeg </button>

	</form>
	

</body>
</html>