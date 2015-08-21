<?php 

	class Animal
	{

		/*
			$name (member, protected)
			$gender (member, protected)
			$health (member, protected)
			__construct (method, public) met drie parameters: $name, $gender en $health
			Deze constructor kent de parameter-waarden toe aan de class members
			getName (method, public)
			Returnt de class member $name
			getGender (method, public)
			Returnt de class member $gender
			getHealth (method, public)
			Returnt de class member $health
			changeHealth (method, public) met één parameter: $healthPoints
			Telt de parameter-waarde op bij de class member $health
			De waarde van $healthPoints kan zowel positief als negatief zijn.
			
			doSpecialMove (method, public)
			Returnt de string 'walk'
			
			*/
		
		protected $name;
		protected $gender;
		protected $health;
		private $specialMove = 'walk';
	
		public function __construct($name, $gender, $health){
			$this->name = $name;
			$this->gender = $gender;
			$this->health = $health;
		}

		/////// GETTERS ///////////////////////////////////	
		public function getName(){
			return $this->name;
		}

		public function getGender(){
			return $this->gender ;
		}

		public function getHEalth(){
			return $this->health ;
		}

		/////// SETTERS //////////////////////////////////
		public function changeHealth($value= -1)
		{
			$this->health += $value;
		}

		/////// other functions //////////////////////////
		public function doSpecialMove(){
			return $this->specialMove;
		}

	}


 ?>