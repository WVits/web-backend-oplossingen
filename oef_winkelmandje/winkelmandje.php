<?php 

session_start();


////////////// INTIIALISATIE VARIABELEN //////////////////////////////////////

$artikels = array( "appel" => array("appel", "appels"), 
					"banaan" => array("banaan", "bananen"), 
					"peer" => array("peer", "peren"),
					"meloen" => array("meloen", "meloenen"),
					"avocado" => array("avocado" , "avocado's" ) 
					)  ;


//var_dump($artikels);


$winkelmandje = '';
$artikels_in_mandje = FALSE;




//////////////   Winkelmandje vullen   //////////////////////////////////////////////////////////

//zit er al iets in het winkelmandje?


// PROBLEEM wanneer lijst leeg wordt gemaakt.......................................!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
if (isset($_SESSION["winkelmandje"])){
	foreach ($_SESSION["winkelmandje"] as $key => $value) {
		$winkelmandje[$key] = $value;
	}
	$artikels_in_mandje = TRUE;
}	


//iets toevoegen aan het mandje
foreach ($artikels as $key => $value) {
	if (isset($_POST[$key])){
		$_SESSION["winkelmandje"][] = $key;	
	//	var_dump($_SESSION);
	}
	//var_dump($key . " " . $value[0] . ' ' . $value[1]);
}

if(isset($_POST["maak_leeg"])){
	$winkelmandje = '';
	$_SESSION["winkelmandje"] = $winkelmandje;
}

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
			<?php foreach ($winkelmandje as $volgnummer => $artikelnaam): ?>
				
				<p><?=$artikelnaam?></p>
			<?php endforeach ?>
			
		<?php endif ?>
	</aside>

	<form method="post">
		<button value="maak_leeg" type="submit" id="maak_leeg" name="maak_leeg"> Maak winkelmanje leeg </button>
	</form>
	

</body>
</html>