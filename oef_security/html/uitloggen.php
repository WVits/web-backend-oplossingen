		
<?php  
		session_start();

		$homepage = $_SESSION["home"];

		if (isset($_SESSION))
		{
			unset($_SESSION["user"]);
			unset($_SESSION["username"]);
			unset($_SESSION["msg"]);
			unset($_SESSION);

			//require_once(realpath(__DIR__ . '/../index.php'));
			//header("location: /../index.php");
		}
		var_dump("Dit is de uitlogpagina. Als u niet automatisch wordt doorgestuurd is er iets foutgelopen.");

		header("location: ../index.php");
?>

