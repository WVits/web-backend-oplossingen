<?php 
 /*klasse Lion  

 */

 	/**
 	* 
 	*/	
 	class Lion extends Animal
	 {
 		
	 	protected $species;
 	
 		public function __construct($species, $name, $gender, $health)
 		{
 			parent::__construct($name, $gender, $health);
 			$this->species = $species;
 			$this->specialMove = 'roar';
 		}


 		public function doSpecialMove(){
 			return $this->specialMove;
 		}


 		////  GETTERS /////////////////////

 		public function getSpecies(){
 			return $this->species;
 		}

 	}

 ?>