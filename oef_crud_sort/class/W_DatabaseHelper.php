<?php 
/*W_DataConnector*/

/**
* 
*/
class W_DatabaseHelper
{

	private $db ;
	private static $connection = '';

	/*public function __construct()
	{
			
	}*/

	public function __construct($databasename, $username = 'root', $password = '',  $hostname = 'localhost', $databasetype = "mysql")
	{
			$this->db = new PDO( ($databasetype . ":host=" . $hostname . ";dbname=" . $databasename ), $username, $password); 
			

			//var_dump(self::$connection);

			//return $this->db;
	}


	static public function connect($databasename, $username = 'root', $password = '',  $hostname = 'localhost', $databasetype = "mysql")
	{
			$connection = new PDO( ($databasetype . ":host=" . $hostname . ";dbname=" . $databasename ), $username, $password); 
			self::$connection = $connection;

			//var_dump(self::$connection);

			return $connection;
	}



	public function query ($querystring, $placeholders = FALSE){
		$statement = $this->db->prepare($querystring);

		//var_dump($this->db);

		if ($placeholders)
		{
			foreach ($placeholders as $name => $value) 
			{
				$statement->bindValue($name, $value);
			}
		}

		$statement->execute();
		$result = $this->returnArray($statement);
		return $result;
	}



	public function returnArray($statement){
		
		$resultset = array();
		//var_dump($statement);
		while ( $row = $statement->fetch(PDO::FETCH_ASSOC) )
		{
			$resultset[]	=	$row;
		}
		return $resultset;

	}

	public function buildTitleArray($resultset){

		$titleArray = array();
		foreach ($resultset[0] as $key => $value) {
			//var_dump($key);
			$titleArray[] = $key;

		}
		//$titleArr = $resultset[0];
		//var_dump($titleArray);
		return $titleArray;
	}


}



 ?>
