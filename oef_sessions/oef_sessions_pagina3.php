<?php 
	
	session_start();

	$nickname = '';
	$email='';
	$postcode = '';
	$straat= '';
	$nummer ='';
	$gemeente ='';

	if(isset($_SESSION["nickname"])){
		$nickname = $_SESSION["nickname"];
		$email = $_SESSION["email"];
		$postcode = $_SESSION["postcode"];
		$straat = $_SESSION["straat"];
		$nummer = $_SESSION["nummer"];
		$gemeente =$_SESSION["gemeente"];
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
 		
 			<p>Email : <span> <?=$email?> </span> <a href="oef_sessions_pagina1.php?focus=email" >Wijzig</a> </p>
 			<p>Nickname: <span> <?=$nickname?> </span> <a href="oef_sessions_pagina1.php?focus=nickname" >Wijzig</a> </p>
 		
 		</section>

 		<hr>
 		<h2>Adresgegevens </h2>
 		<hr>

 		<section>
 		
			<p>Straat : <span> <?=$straat?> </span>  <a href="oef_sessions_pagina2.php?focus=straat" >Wijzig</a> </p>
 			<p>Huisnummer : <span> <?=$nummer?> </span> <a href="oef_sessions_pagina2.php?focus=nummer" >Wijzig</a>  </p> 
 			<p>Postcode : <span> <?=$postcode?> </span> <a href="oef_sessions_pagina2.php?focus=postcode" >Wijzig</a>  </p>
 			<p>Gemeente : <span> <?=$gemeente?> </span> <a href="oef_sessions_pagina2.php?focus=gemeente" >Wijzig</a> </p>		
 		</section>
	</div>

 
 </body>
 </html>