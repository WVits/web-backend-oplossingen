<?php 
	
	if (isset($_POST["submit"])){
		var_dump("ok");

		session_start();
		$_SESSION = $_POST;

	
		var_dump($_SESSION);
		header('location: oef_sessions_pagina2.php');
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
 		form{
 			padding-top: 10px;
 			margin-top: 5%;
 			text-align: right;
 			margin-right: 35%;
 		}
 	</style>
 </head>
 <body>
 	<div class="container">
 		<h1>Welkom bij onze registratiemodule</h1>
 		<h2>Deel 1: Registratiegevens</h2>
 		<hr>
	
 		<form method="post" >
 			<p>
 				<label for="email"> E-mail  </label><input type="text" id="email" name="email">
 			</p>
 			<p>
 				<label for="nickname"> Nickname  </label><input type="text" id="nickname" name="nickname">
 			</p>
 			<p>
 				<input type ="submit" value="Volgende" name="submit" id="submit">
 			</p>
 		</form>
	</div>

 
 </body>
 </html>