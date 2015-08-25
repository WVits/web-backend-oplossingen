
<?php /*FileFinder.php*/
	
	/*written by WVits. */

	class FileFinder{

		//public $testvalue = 0;

		public function __construct(){
			//$this->testvalue=1;
			//var_dump($this->testvalue);
		}

		//you can use FindEm to find all files of one or more types. By default, it searches for pictures.
		public function FindEm($dir, $filetypes = '*.{jpg,jpeg,png,gif}')
		{
			$found=array();
			$found[] = glob($dir . $filetypes, GLOB_BRACE);
			//var_dump($found);
			return $found[0];
		}

		public static function Find_Js_Css(){

			$cssfinder = new FileFinder();
			$css = $cssfinder->FindEm("css/", "*.{css}");
			$jsfinder = new FileFinder();
			$js = $jsfinder->FindEm("js/", "*.{js}");


			$resources = '
								<?php foreach ($css as $cssnr => $cssvalue): ?>
									<link rel="stylesheet" type="text/css" href="<?=$cssvalue?>">
								<?php endforeach ?>
						
								<?php foreach ($js as $jsnr => $jsvalue): ?>
									<script src="<?=$jsvalue?>"> </script>
								<?php endforeach ?>
						';
			return $resources;


		}







	}

	/* EXAMPLE ON HOW TO USE THIS CLASS TO FIND IMAGES
	//PHP
	//in your php script, add the following lines:

	$finder = new FileFinder();
	$images = $finder->FindEm("img/", "*.{jpg, jpeg, png, gif}");

	//HTML
	//In your html, in the appropriate spot (where you want them to show), add the following lines
	<?php foreach ($images as $key => $value): ?>
		<?= var_dump($value) ?>
		<img src="<?=$value?>" alt="picture number <?=$value?>">
	<?php endforeach ?>
	*/

?>

