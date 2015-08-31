		
<?php  
		unset($_SESSION["user"]);
		unset($_SESSION["username"]);
		unset($_SESSION);
		header("location: index.php");

?>