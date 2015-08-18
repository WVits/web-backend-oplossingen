<?php 
	
	session_start();


	$nickname = $_SESSION["nickname"];
	$email = $_SESSION["email"];
	
	var_dump($_SESSION);


	if (isset($_POST["submit"])){
		var_dump("ok");	
	}

	
	if (isset($_POST["submit"])){
		var_dump("ok");

		
		foreach ($_POST as $key => $value) {
			$_SESSION[$key] = $_POST[$key];
		}
			
		var_dump($_SESSION);
		header('location: oef_sessions_pagina3.php');
		
	}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>OEF Sessions</title>
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
 		form, section{
 			padding-top: 10px;
 			margin-top: 5%;
 			text-align: right;
 			margin-right: 35%;
 		}
 		span{
 			color: teal;
 		}
 	</style>

 </head>
 <body>
 	<div class="container">
 		<h1>Registratie: Deel 2, adresgegevens</h1>
 		<hr>
 		<section>
 		<h2> Registratiegegevens </h2>
 			<p>Email : <span> <?= $email ?> </span> </p>
 			<p>Nickname: <span> <?= $nickname?> </span> </p>
 		
 		</section>
 		<hr>

 		<h2>Deel 2: Adres</h2>
 		<hr>
	
 		<form method="post" >
 			<p>
 				<label for="straat"> Straatnaam </label><input type="text" id="straat" name="straat">
 			</p>
 			<p>
 				<label for="nummer"> Nummer  </label><input type="text" id="nummer" name="nummer">
 			</p>
 			<p>
 				<label for="postcode"> Postcode  </label><input type="number" id="postcode" name="postcode">
 			</p>
 			<p>
 				<label for="gemeente"> Gemeente  </label><input type="text" id="gemeente" name="gemeente">
 			</p>
 			<p>
 				<input type ="submit" value="Volgende" name="submit" id="submit">
 			</p>
 		</form>
	</div>

 
 </body>
 </html>