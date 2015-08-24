<?php 

function __autoload($classname) { 
	require_once("class/" . $classname . ".php"); 
}

$finder = new FileFinder();
$images = $finder->FindEm("img/", "*.{jpg, jpeg, png, gif}");

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
	img{
		max-width : 29%;
	}
	</style>
	
</head>
<body>

	<?php foreach ($images as $key => $value): ?>
		<img src="<?=$value?>" alt="picture number <?=$value?>">
	<?php endforeach ?>

</body>
</html>