<?php 

session_start();

$artikels = array( "appel" => array("appel", "appels"), 
					"banaan" => array("banaan", "bananen"), 
					"peer" => array("peer", "peren"),
					"meloen" => array("meloen", "meloenen"),
					"avocado" => array("avocado" , "avocado's" ) 
					)  ;


var_dump($artikels);

$winkelmandje = '';

//zit er al iets in het winkelmandje?
if (isset($_SESSION["winkelmandje"])){
	foreach ($_SESSION["winkelmandje"] as $key => $value) {
		$winkelmandje[$key] = $value;
	}
}	

//iets toevoegen aan het mandje
if (isset($_POST["toevoegen"])){
	

}

function insert($arr){
	var_dump($arr);
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
			<button value="insert(<?=$value?>)"> <?=$value[0]?>  </button> 
		<?php endforeach ?>
	</section>
	<aside>
		
	</aside>

</body>
</html>