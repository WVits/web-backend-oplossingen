<?php 

$message = '';
$array_login_pasword =  json_decode(file_get_contents("logpasss.txt"));
$inputlogin ='';
$inputpass = '';
$logged_in = FALSE;

var_dump($array_login_pasword);

foreach ($array_login_pasword as $key => $value) {
	if ($key === "jan") {
		# code...v
		var_dump($key);
		var_dump($value);
	}
}

if (isset($_GET['cookie'])) {
	
		if ($_GET['cookie'] == 'delete') {
		
			setcookie('authenticated','', time() - 3600 );
			
			header('location: oef_cookies.php');
		}
	}




if (isset($_POST["submit"])){
	$logged_in = FALSE;
	$inputlogin = $_POST["login"];
	$inputpass = $_POST["pass"];
	//var_dump($inputlogin);
	//var_dump($inputpass);

	foreach ($array_login_pasword as $key => $value) {
		if (($key === $inputlogin) && ($value === $inputpass)){
			//setcookie("autenthicated")= true;
			if (isset($_POST["onthouden"])) {
				setcookie("authenticated", true, time()+300000);
				var_dump("Remember me true!");
			}else{
				setcookie("authenticated", true, time()+360);
				var_dump("DO NOT remember me !");
				var_dump($_POST);
			}
			$logged_in = TRUE;
			header('oef_cookies.php');
		}
	}

	if ($logged_in === FALSE){
		$message = "Er is iets foutgelopen, probeer opnieuw.";
	}
}


if (isset($_COOKIE["authenticated"])){
	$logged_in = TRUE;
}


?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Oefening Cookies</title>
 	<style type="text/css">
 	.container{
 		max-width: 80%;
 		margin-left: 10%;
 		text-align: center;
 	}

 	.container h1{
 		color : #0CC;
 	}

 	.errormsg{
 		background-color: orange;
 		font-size: 1.5em;
 	}
 	</style>
 </head>
<body>
	<div class="container" action="oef_cookies.php">
		 <h1>Welkom</h1>
		 <p class= "errormsg"> <?= $message ?> </p>

		 <?php if ($logged_in === TRUE): ?>
		 	<h2>Welkom terug, <?= $_POST["login"]?>. </h2>
		 	<h2>Je bent ingelogd.</h2>
		 	<a href='?cookie=delete'>UITLOGGEN</a>
		 <?php else: ?>
		 	 <form method="post">
			<p>
		 		<label for="login">Login</label> <input type="text" name="login" id="login">
		 	</p>
		 	<p>
		 		<label for="pass">Passwoord</label> <input type="password" name="pass" id="pass">
		 	</p>
		 	
		 	<p>
		 		 <input type="checkbox" name="onthouden" value="onthouden" id="onthouden" value="Yes"> Mij onthouden.<br>
		 	</p>
		 	<p>
		 		<input	type="submit" name="submit">
		 	</p>
		 	
		 </form>
		 <?php endif ?>

		
	 </div>


 </body>
 </html>