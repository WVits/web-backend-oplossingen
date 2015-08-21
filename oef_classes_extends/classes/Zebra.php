<?php 
 /*klasse Lion  

 */

 	/**
 	* 
 	*/	
 	class Zebra extends Animal
	 {
 		
	 	protected $species;
 	
 		public function __construct($species, $name, $gender, $health)
 		{
 			parent::__construct($name, $gender, $health);
 			$this->species = $species;
 		}

 		// no special move, inherited from Animal.
 		/*public function doSpecialMove(){
 			return $this->specialMove;
 		}*/


 		////  GETTERS /////////////////////

 		public function getSpecies(){
 			return $this->species;
 		}

 	}

 ?>