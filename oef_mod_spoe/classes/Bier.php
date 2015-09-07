<?php 

/*Bieren-class */

/**
* 
*/
class Bier 
{
	
	public $value = 0;

	function __construct()
	{
		$this->value = 3;
	}

	function printvalue(){
		return $this->value;
	}

	function overview(){
		echo "overview";
	}

	function insert(){
		echo "insert";
	}

	function delete(){
		echo "delete";
	}

	function update(){
		echo "update";
	}


}

?>