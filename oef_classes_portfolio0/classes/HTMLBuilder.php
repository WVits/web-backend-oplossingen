<?php 
/*
HTMLBuilder.php
Deze bevat een klasse HTMLBuilder
Voorzie een manier om de bestandsnamen van de header, body en footer mee te geveren (dmv constructor, dmv setters, ...)
Deze bevat de publieke methodes buildHeader, buildFooter en buildBody
buildHeader
zorgt ervoor dat de header op het scherm verschijnt
Zorg ervoor dat alle bestanden uit de css map automatisch worden ingeladen. Dus wanneer je een .css bestand verwijdert, mag dit niet in de header verschijnen.
buildBody
zorgt ervoor dat de body op het scherm verschijnt
buildFooter
Zorgt ervoor dat de footer op het scherm verschijnt
Zorgt ervoor dat alle bestanden uit de jsmap automatisch worden ingeladen. Dus wanneer je een .js bestand verwijdert, mag dit niet in de footer verschijnen.
*/

class HTMLBuilder{

	protected $header = "";
	protected $body="";
	protected $footer="";

	//constructor met standaardwaarden.
	public function __construct(
		$header = "	<!DOCTYPE html>
					<html>
					<head>
						<title></title>
					</head>
				  	<body>
						<header></header>",
		$body =' <div class="container" > 
					<section> </section> ',
		$footer = '<footer> </footer> 
					</div><!--container-->
					</body>
					</html>')
		{

			$this->header = $header;
			$this->body = $body;
			$this->footer = $footer;
		}

	//SETTERS 
	
	public function setHeader($file){
		$this->header = $file;
	}
	public function setBody($file){
		$this->body = $file;
	}		
	public function setFooter($file){
		$this->footer = $file;
	}


	//GETTERS

	//other functions

	public function buildHTML(){
		$html = $this->header . $this->body . $this->footer;
		return $html;
	}


	public function findFiles($type, $dir = '.')
	{

		$typeFiles = array();
		var_dump("test");
		foreach (glob('/*.'$type) as $filename) {
			$typeFiles[] = $filename;
			var_dump("typefiles" , $typeFiles);
			//echo "$filename" . filesize($filename) . "\n";
		}
		return scandir($dir);
	}

/*
	public function listFiles( $from = '.')
	{
    	if(! is_dir($from))
    	    return false;
    	
    	$files = array();
    	$dirs = array( $from);
    	while( NULL !== ($dir = array_pop( $dirs)))
    	{
    	    if( $dh = opendir($dir))
    	    {
    	        while( false !== ($file = readdir($dh)))
    	        {
    	            if( $file == '.' || $file == '..')
    	                continue;
    	            $path = $dir . '/' . $file;
    	            if( is_dir($path))
    	                $dirs[] = $path;
    	            else
    	                $files[] = $path;
    	        }
    	        closedir($dh);
    	    }
    	}
    	return $files;
	}
	
*/

}


 ?>