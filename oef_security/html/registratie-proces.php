<?php 

////////////// Initialisatie/////////////////////

	session_start();

	////////// Automatisch zoeken naar klasses....

	function __autoload($classname) { 
		require_once("../class/" . $classname . ".php"); 
	}

///////////////////////////////////////////////////

var_dump("ok");
var_dump($_POST);



	if(isset($_POST["annuleer"]))
	{
		$_SESSION["showthis"] = "Login";
	}
	else
	{
		if (isset($_POST["registreerNieuweUser"]))
		{
			$resultmessage = registreerNieuweUser($_POST["naam"], $_POST["paswoord"]);
			//var_dump($resultmessage);
			file_put_contents("log.txt", $resultmessage);
		}


		if(isset($_POST["genereerpaswoord"]))
		{
			var_dump($_POST);
			$_SESSION["ingevuldenaam"] = $_POST["naam"];
			$_SESSION["generatedpass"] = generateSalt();
			$_SESSION["showthis"]="registratie";
			var_dump($_SESSION["ingevuldenaam"]);
		}
	
	
	}
/*
	if (isset($_SESSION["ingevuldenaam"])){
		$toonLogin= FALSE;
		$registreerUser = TRUE;
		var_dump($_POST);
	}
*/
// Redirect ...

	header('location: ../index.php');


///////// Functions below ////////////////////////////////////////////////


	function registreerNieuweUser($login, $pasw)
	{
		$_SESSION["msg"] ="Registratie niet gelukt. Probeer later opnieuw." ;  //default message 
		//controleren of de login reeds gebruikt is....
		$connection  = new W_DatabaseHelper("cms");
	
		$querystring= 	"SELECT * 
						 FROM users 
						 WHERE naam LIKE :login 
						";
		
		$bindValues = [ ":login" => $login];

		$resultset = $connection->query($querystring, $bindValues);

		//$resultset = $connection->query($querystring);

		//var_dump($resultset);
		if (sizeof($resultset) > 0)
		{
			$_SESSION["msg"] = "Deze naam is reeds in gebruik. Gelieve een andere login te kiezen.";
		}
		else 
		{
			$querystring= "INSERT INTO users(naam, paswoord, salt) 
							VALUES (:login, :pasw, :newsalt) 
							";

			///// SECURITY voor paswoord...
							//salt aanmaken
			$newsalt = generateSalt();

			//parameter 5 in onderstaande lijn betekent dat we kiezen voor algoritme SHA256...
			$pasw = hash("sha256", $pasw . $newsalt);
			var_dump($pasw);



			$bindValues = [ ":login" => $login, ":pasw"=> $pasw, ":newsalt" => $newsalt];
			$resultset = $connection->query($querystring, $bindValues);
	
			$validatedUser = checklogin($login, $pasw);
	
			$_SESSION["msg"] = "Proficiat met uw registratie. U bent meteen ook ingelogd met uw nieuwe login en paswoord.";
		

			/// get the new user's userid...


			$querystring= "SELECT userid FROM users
							WHERE naam LIKE :login 
							AND paswoord LIKE :pasw 
							AND salt LIKE :newsalt
							";

			$bindValues = [ ":login" => $login, ":pasw"=> $pasw, ":newsalt" => $newsalt];
			
			$resultset = $connection->query($querystring, $bindValues);
	
			var_dump($resultset);
			$_SESSION["user"] = $resultset[0];
			$_SESSION["username"] = $login;
		}

		//return $resultmessage;
	
	}

function checklogin($login, $pasw)
	{
		$_SESSION["msg"] = "Deze combinatie komt niet voor. Mogelijk maakte u een vergissing.";
		$connection  = new W_DatabaseHelper("cms");
		$match = FALSE; 

		////////// SALT ophalen
		$querygetsalt = "SELECT salt FROM users WHERE naam LIKE :login";
		$bindValues = [ ":login" => $login];
		$saltArr = $connection->query($querygetsalt, $bindValues);
		var_dump($saltArr);
		var_dump("saltArrayDump in registratie");

		//////////SALT gebruiken in combinatie met paswoord...
	
		//////////kijken of het gehashte pasw + salt voorkomt in de DB...
			if (sizeof($saltArr) === 1)
			{
			$salt = $saltArr[0]["salt"];
			var_dump($salt);
			$hashedpasw = hash("sha256", $pasw . $salt);
			var_dump($hashedpasw);
			$querystring= "SELECT * 
							FROM users 
							WHERE naam LIKE :login 
							AND salt LIKE :salt
							AND  paswoord LIKE :hashedpasw
							";
	
			$bindValues = [ ":login" => $login, ":salt" => $salt, ":hashedpasw"=> $hashedpasw];
			
	
			$resultset = $connection->query($querystring, $bindValues);
			var_dump($querystring);

			$_SESSION["msg"] = FALSE;
			//$resultset = $connection->query($querystring);
	
			var_dump($resultset);
			if (sizeof($resultset) === 1)
				{
					$match = $resultset[0]["userid"];
				
					$_SESSION["user"] = $match;
					$_SESSION["username"] = $login;
					var_dump($_SESSION);	
				}	
			}
		return $match;
		
	}


	function generateSalt($max = 15) 
	{
		 $characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
	      $i = 0;
	      $salt = "";
	      while ($i < $max) {
	          $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
	          $i++;
	      }
	      return $salt;
	}


 ?>