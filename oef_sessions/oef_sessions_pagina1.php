<?php 
	session_start();
	$email = '';
	$nickname = '';
	$focus='';


	if (isset($_POST["submit"])){
		//var_dump("ok");

		$_SESSION = $_POST;

		//var_dump($_SESSION);
		header('location: oef_sessions_pagina2.php');
	}

	// invullen van reeds gekende waarden 
	if (isset($_SESSION["email"]))
	{
		$email = $_SESSION["email"];
		$nickname = $_SESSION["nickname"];
	}

	//moet er een focus op een bepaald veld gezet worden?
	if (isset($_GET["focus"]))
	{
		//var_dump("focus op " . $_GET["focus"]);
		$focus = $_GET["focus"];
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
 				<label for="email">E-mail</label>
 				<input <?= ( $focus == "email" ) ? 'autofocus' : '' ?> type="text" id="email" name="email" value="<?=$email?>">
 			</p>
 			<p>
 				<label for="nickname">Nickname</label>
 				<input <?= ( $focus == "nickname" ) ? 'autofocus' : ''?>  type="text" id="nickname" name="nickname" value="<?=$nickname?>" >
 			</p>
 			<p>
 				<input type ="submit" value="Volgende" name="submit" id="submit">
 			</p>
 		</form>
	</div>

 
 </body>
 </html>