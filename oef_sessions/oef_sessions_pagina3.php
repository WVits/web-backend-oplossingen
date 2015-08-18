<?php 
	
	session_start();


	$nickname = "";
	$email ="";
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
 			margin-bottom: 20px;
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
 		<h1>Overzichtspagina</h1>

 		<hr>

 		<h2> Registratiegegevens </h2>
 		<hr>
 		<section>
 		
 			<p>Email : <span> <?= $email ?> </span> </p>
 			<p>Nickname: <span> <?= $nickname?> </span> </p>
 		
 		</section>
 		<hr>
 		<h2>Adresgegevens </h2>
 		<hr>

 		<section>
 		
			<p>Straat : <span> <?= $email ?> </span>  <a href="" >Wijzig</a> </p>
 			<p>Huisnummer: <span> <?= $nickname?> </span> <a href="" >Wijzig</a>  </p> 
 			<p>Postcode : <span> <?= $email ?> </span> <a href="" >Wijzig</a>  </p>
 			<p>Gemeente: <span> <?= $nickname?> </span> <a href="" >Wijzig</a> </p>		
 		</section>
	</div>

 
 </body>
 </html>