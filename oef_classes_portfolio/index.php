
<?php 

////////////// Create content /////////////


function __autoload($classname) { 
	require_once("class/" . $classname . ".php"); 
}
/*
$imgfinder = new FileFinder();
$images = $imgfinder->FindEm("img/", "*.{jpg, jpeg, png, gif}");

*/
$jsfinder = new FileFinder();
$js = $jsfinder->FindEm("js/", "*.{js}");


$cssfinder = new FileFinder();
$css = $cssfinder->FindEm("css/", "*.{css}");

var_dump($css);
var_dump($js);




//////////////  Spawn HTML ////////////////
require_once('view/header.html');
require_once('view/body.html');
require_once('view/footer.html');



?>

