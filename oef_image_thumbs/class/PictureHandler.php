<?php 


/**
* 
*/
class PictureHandler
{

	public $filename = '';
	
	public function __construct()
	{
		
	}

	public function getPicture($picture){

		if ((($picture["type"] == "image/gif")
			|| ($picture["type"] == "image/jpeg")
			|| ($picture["type"] == "image/png"))
			&& ($picture["size"] < 2000000)) 
		{
				if ($picture["error"] > 0) 
				{
						// Als er een fout in het bestand wordt gevonden (bv. corrupte file door onderbroken upload), moet er een foutboodschap getoond worden
						throw new Exception( "Return Code: " . $picture["error"] );
				} 
				else 
				{
						// De root van het bestand moet achterhaald worden om de absolute pathnaam (de plaats op de schijf van de server) te achterhalen
						// Zo weet de server waar het bestand moet terecht komen.
						// We kunnen dit doen door de functie dirname() toe te passen op dit bestand (=__FILE__)
						define('ROOT', dirname(dirname(__FILE__)));
						
						$newfile = self::GetAvailableName($picture["name"]) ;
						//var_dump($newfile);
							//Als het bestand reeds bestaat in de map, moet er een foutboodschap getoond worden
					//		throw new Exception( $_FILES["file"]["name"] . " bestaat al. " );

							// Anders mag het bestand geüpload worden naar de map
							//$destination = ROOT . "/img/" . $_FILES["file"]["name"];
							//move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
							$filename =  $picture["name"];
							$destination = ROOT . "/img/" . $newfile;
						//	var_dump($destination);
							move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
							$this->filename = $destination;
				}
		}					 
		else 
		{
				throw new Exception( 'Ongeldig bestand' );
		}
		//return $filename;
		return $destination;
	}

	public static function GetAvailableName($name)
	{
		if (file_exists(ROOT . "/img/" . $name)) 
					{				
						//Als het bestand reeds bestaat in de map, moet er een foutboodschap getoond worden
							$name = "a" . $name;
							//var_dump("bestaat al");
							return self::GetAvailableName($name);

					} 
		else{
			//var_dump($name);
			return $name;
		}

	}

	public function resize($filename, $fileandpath, $outputpath = "img/thumb/"){
		var_dump($filename, "is being resized");
		list($width, $height) = getimagesize($fileandpath);

		$kortstezijde = $this->bepaalkortste($width, $height);

		$newwidth = round($kortstezijde / 3); //$width * $percent;
		$newheight = round($kortstezijde / 3); //$height * $percent;


		$newwidth = 200;
		$newheight = 200;

		// Load
		$thumb = imagecreatetruecolor($newwidth, $newheight);
		$source = imagecreatefromjpeg($fileandpath);

		// Resize
		$dst_x = 0;
		$dst_y = 0;
		if ($width = $kortstezijde)
		{ //portrait
			$src_y = $height/2 - $width/2;
			$src_x = 0;
			$dst_w = $newwidth;
			$dst_h = $newheight;
			$src_h = $height - ($height - $width);
			$src_w = $width;
		}
		else //landscape
		{
			$src_x = $width/2 - $height/2;
			$src_y = 0;
			$dst_w = $newwidth;
			$dst_h = $newheight;
			$src_w = $width - ($width - $height);
			$src_h = $height - 0;
		}
		

		imagecopyresampled ( $thumb , $source , $dst_x ,$dst_y ,  $src_x , $src_y , $dst_w ,  $dst_h , $src_w , $src_h );
		
		//imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

		// Output

		//echo imagejpeg($thumb);
		imagejpeg($thumb, ( $outputpath . 'thumb_' . $filename ), 100 );

	}

	private function bepaalkortste($a, $b){
		if ($a < $b)
		{
			return $a;
		}
		else
		{
			return $b;
		}
	}



	public function getFilename(){
		return $this->filename;
	}

}

 ?>