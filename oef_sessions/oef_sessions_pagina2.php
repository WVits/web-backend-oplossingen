<?php 
	
	session_start();


	//var_dump for testing purposes....
	//var_dump($_SESSION);

	//initialising variables
	$nickname = '';
	$email = '';
	$postcode = '';
	$straat = '';
	$nummer = '';
	$gemeente ='';
	$focus ='';
	
	//invullen van de (in principe "zeker") gekende waarden
	$nickname = $_SESSION["nickname"];
	$email = $_SESSION["email"];
	

	// invullen van reeds gekende waarden in invulvelden
	if (isset($_SESSION["nummer"]))
	{
		$postcode = $_SESSION["postcode"];
		$straat = $_SESSION["straat"];
		$nummer = $_SESSION["nummer"];
		$gemeente =$_SESSION["gemeente"];
	
	}

	
	//on submit, we add every filled in field to our $_SESSION array. 
	if (isset($_POST["submit"])){
		var_dump("ok");

		
		foreach ($_POST as $key => $value) {
			$_SESSION[$key] = $_POST[$key];
		}
			
		var_dump($_SESSION);
		header('location: oef_sessions_pagina3.php');
		
	}

	//moet de focus op een bepaald veld?
	if (isset($_GET["focus"]))
	{
	//	var_dump("focus op " . $_GET["focus"]);
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
 			<p>Email : <span> <?=$email?> </span> </p>
 			<p>Nickname: <span> <?=$nickname?> </span> </p>
 		
 		</section>
 		<hr>

 		<h2>Deel 2: Adres</h2>
 		<hr>
	
 		<form method="post" >
 			<p>
 				<label for="straat"> Straatnaam </label>
 				<input <?= ( $focus == "straat" ) ? 'autofocus' : '' ?> type="text" id="straat" name="straat"  value="<?=$straat?>">
 			</p>
 			<p>
 				<label for="nummer"> Nummer  </label>
 				<input  <?= ( $focus == "nummer" ) ? 'autofocus' : '' ?> type="text" id="nummer" name="nummer" value="<?=$nummer?>">
 			</p>
 			<p>
 				<label for="postcode"> Postcode  </label>
 				<input  <?= ( $focus == "postcode" ) ? 'autofocus' : '' ?> type="text" id="postcode" name="postcode" value="<?=$postcode?>">
 			</p>
 			<p> 
 				<label for="gemeente"> Gemeente  </label>
 				<input  <?= ( $focus == "gemeente" ) ? 'autofocus' : '' ?>  type="text" id="gemeente" name="gemeente" value="<?=$gemeente?>">
 			</p>
 			<p>
 				<input type ="submit" value="Volgende" name="submit" id="submit">
 			</p>
 		</form>
	</div>

 
 </body>
 </html>