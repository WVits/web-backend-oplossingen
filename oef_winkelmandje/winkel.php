<?php 

session_start();

////// variables 
	$winkelmand = array();
	$inventory = null;

///// functions 
	function zetArtikelenInWinkel($inventory){
		$inventory[] = "appel";
		$inventory[] = "citroen";
		$inventory[] = "peer";
		$inventory[] = "meloen";
		$inventory[] = "mango";
		$inventory[] = "mango";
		$inventory[] = "kokosnoot";
		return $inventory;
	}

	function hervulMand($legemand, $vollemand){
		if (isset($vollemand)){
			$legemand = $vollemand;
		}
		return $legemand;
	}

	function maakleeg($winkelmand){
		$winkelmand = array();
	}


	function voegArtikelToe($mand, $artikelnaam){
		if (zitInMand($mand, key($artikelnaam))){
			//eentje bijtellen
			++$mand[key($artikelnaam)];
			var_dump("++");
		}else{
			//toevoegen
			var_dump($mand);
			var_dump(key($artikelnaam));
			$mand[key($artikelnaam)] = 1;
		}
		return $mand;
	}
/*
	function verwijderArtikel($mand, $artikelnaam){
		if (zitInMand($mand, $artikelnaam) > 1){
			//eentje verwijderen
		}else{
			//
		}
		return $mand;
	}
*/

	function zitInMand($mand, $artikelnaam){
		$inMand = FALSE;

		foreach ($mand as $naamkey => $value) {

			if ($artikelnaam == $naamkey){
				$inMand= $value;
			}
		}
		return $inMand;
	}

/////// other code

// initialiseer pagina
	if (isset($_SESSION["winkelmand"])){
		$winkel = $_SESSION["winkelmand"];
	}

	$inventory = zetArtikelenInWinkel($inventory);

// check of er al items in de winkelmand zitten
	$winkelmand = array();
	if (isset($_SESSION["winkelmand"])){
		$winkelmand = hervulMand($winkelmand, $_SESSION["winkelmand"]);
	}
//check of er op een toevoegen knop geklikt werd... 
	if (isset($_POST)){
		var_dump($_POST);
		$winkelmand = voegArtikelToe($winkelmand, $_POST);
	}



//afhandeling variabelen
	$_SESSION["winkelmand"] = $winkelmand;

/// HTML Below //////

?>

<!DOCTYPE html>
<html>
<head>
	<title>winkel</title>
	<style type="text/css">
		button{
			min-width: 40px;
			height: 40px;
		}
	</style>
</head>
<body>
	<h1>Het fruitkraam</h1>
	<h2> Vandaag te koop ...</h2>
	<form method = "POST">
		<?php foreach ($inventory as $key => $value): ?>
			<button type="submit" id="<?=$value?>" name ="<?=$value?>"> <?= $value ?> </button>
			
		<?php endforeach ?>
	</form>

	<h2> Reeds in uw mandje ...</h2>
	<form method="post">
		<?php foreach ($winkelmand as $key => $value): ?>
			<button name="<?= 'x' . $key?>"> x </button>
			<p> Naam <?= $key ?> Aantal <?= $value ?></p>
			<button> + </button>
			<button> - </button>

		<?php endforeach ?>

	</form>
</body>
</html>