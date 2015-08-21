<?php 

function __autoload($classname) { 
	require_once("classes/" . $classname . ".php"); 
}

$animals = array();

$neushoorn = new Animal("Bruno", "male", 450);

$pinguin = new Animal("Frisko", "female", 60);

$veldmuis = new Animal("Squeek", "male", 12);

$Simba = new Lion("Congo Lion", "Simba", "male", 380);

$Scar = new Lion("Kenia Lion", "Scar", "Male", 360);

$Zeke = new Zebra("Quagga", "Zeke", "Male", 100);

$Zana = new Zebra("Sesous", "Zana", "Female", 100);


/*
echo "naam, gender en health van neushoorn, door middel van getters...";
echo $neushoorn->getName();
echo $neushoorn->getGender();
echo $neushoorn->getHealth();

echo "naam, gender en health van pinguin, door middel van getters...";
echo $pinguin->getName();
echo $pinguin->getGender();
echo $pinguin->getHealth();

echo "naam, gender en health van veldmuis, door middel van getters...";
echo $veldmuis->getName();
echo $veldmuis->getGender();
echo $veldmuis->getHealth();
*/
$animals[] = $Simba;
$animals[] = $neushoorn;
$animals[] = $pinguin;
$animals[] = $veldmuis;
$animals[] = $Scar;
$animals[] = $Zana;
$animals[] = $Zeke;

?>

<!DOCTYPE html>
<html>
<head>
	

	<title>Dieren</title>

</head>
<body>
	<h1> Instanties van de Animal klasse</h1>
	<hr>
	<?php foreach ($animals as $key => $value): ?>
		<h1> <?= $value->getname() ?> </h1>	
		<p> 
			<?= $value->getname() ?>

			<?php if (method_exists($value, "getSpecies")): ?>
				<?= $value->getSpecies() ?>
			<?php endif ?>

			is van het geslacht 
			<?= $value->getGender() ?> 
			en heeft 
			<?= $value->getHealth() ?> 
			levenspunten. 
			<p>De speciale move van dit dier is <?= $value->doSpecialMove()?>. </p>
		</p>
	<?php endforeach ?>
</body>
</html>

