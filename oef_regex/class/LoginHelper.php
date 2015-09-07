<?php  
/**
* 
*/
	class LoginHelper 
	{
		function __construct()
		{
			# code...
		}

		public static function checklogin($login, $pasw)
		{
			$_SESSION["msg"] = "Deze combinatie komt niet voor. Mogelijk maakte u een vergissing.";
			$connection  = new W_DatabaseHelper("cms");
			$match = FALSE; 

			////////// SALT ophalen
			$querygetsalt = "SELECT salt FROM users WHERE naam LIKE :login";
			$bindValues = [ ":login" => $login];
			$saltArr = $connection->query($querygetsalt, $bindValues);
			//var_dump($saltArr);
			//var_dump("saltArrayDump in registratie");

			//////////SALT gebruiken in combinatie met paswoord...
	
			//////////kijken of het gehashte pasw + salt voorkomt in de DB...
				if (sizeof($saltArr) === 1)
				{
				$salt = $saltArr[0]["salt"];
				//var_dump($salt);
				$hashedpasw = hash("sha256", $pasw . $salt);
				//var_dump($hashedpasw);
				$querystring= "SELECT * 
								FROM users 
								WHERE naam LIKE :login 
								AND salt LIKE :salt
								AND  paswoord LIKE :hashedpasw
								";
	
				$bindValues = [ ":login" => $login, ":salt" => $salt, ":hashedpasw"=> $hashedpasw];
				
	
				$resultset = $connection->query($querystring, $bindValues);
			

				$_SESSION["msg"] = FALSE;
				//$resultset = $connection->query($querystring);
	
				//var_dump($resultset);
				if (sizeof($resultset) === 1)
					{
						$match = $resultset[0]["userid"];
					
						$_SESSION["user"] = $match;
						$_SESSION["username"] = $login;
						//var_dump($_SESSION);	
						$X->dump($_SESSION);
					}	
				}
			return $match;
			
		}
	
	
	}
?>