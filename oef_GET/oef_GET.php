
<?php

/*Maak een array $artikels. Dit wordt een multidimensionele array
Op de values van de array $artikels komt een associatieve array met daarin de volgende keys:
 'titel', 'datum', 'inhoud', 'afbeelding', 'afbeeldingBeschrijving'
De value van deze keys stemt overeen met de inhoud van de drie artikels die je gevonden hebt.*/


$artikel = -1; 
//var_dump($GLOBALS);


///////////////// OUR HARDCODED DATABASE ... MULTI-DIMENSIONAL ARRAY CONTAINING ARTICLES

$alles = array(
	0 => array(
		'titel' => 'The network is hostile',
		'datum' => '16 augustus 2015',
		'inhoud' => 'Yesterday the New York Times and ProPublica posted a lengthy investigation based on leaked NSA documents, outlining the extensive surveillance collaboration between AT&T and the U.S. government. This surveillance includes gems such as AT&T\'s assistance in tapping the main fiber connection supporting the United Nations, and that\'s only the start.',
		'afbeelding' => 'img/att-logo.jpg',
		'afbeeldingBeschrijving' => 'logo ATT',
		'chosen' => false
	),
	1 => array(
		'titel' => 'Friedrich Nietzsche on Solitude',
		'datum' => '14 august 2015',
		'inhoud' => 'Friedrich Nietzsche (1844-1900) was one of the most forceful philosophical writers of modern times, influencing many philosophers as well as figures in the creative arts, literature, and politics. He virtually originated concepts like nihilism, the will to power, and eternal recurrence. This is not the place to analyze Nietzsche\'s thought and writing but to explore his concept and use of solitude and his presentation of the solitary as a new thinker on the horizon of history.

			Solitude in Nietzsche can be approached in at least three ways: 1) as an aspect of his personal and professional life, voluntary and involuntary, 2) Nietzsche\'s personal use of solitude as a creative person, and 3) his concept of solitude as a philosophical and existential state of being for the individual. The first two approaches tend to converge. All three will be touched upon here.

			Nietzsche was not a philosopher by profession but a brilliant student first, then for ten years professor of philology in a university before his retirement due to health problems that were to plague him through his mental collapse in 1889. Studying in a rigorous boarding school where Greek and Latin were not only taught but read, written, and spoken by the students, and a brilliant university student and professor, Nietzsche was to have little patience with the philosophers he read, and turned to ancient modes of thought and expression for his models.

			His writings range from deductive , discursive and aphoristic essays, to the grand drama of Thus Spoke Zarathustra, to autobiographical sketches in Ecce Homo, his last lucid work. His chief works are Beyond Good and Evil and On the Genealogy of Morals. The writings are characterized by scintillating insight, wit, logic, and irony, and filled with many literary devices and layers of creative masks or personas. Nietzsche is complex and subtle but forceful and provocative. He is easily misunderstood and taken to represent whatever caricature many modern abusers have contrived to find in his concepts of nihilism, will to power, and the Ubermensch or Overman.',
		'afbeelding' => 'img/Nietzsche.jpg',
		'afbeeldingBeschrijving' => 'portrait picture of Friedrich Nietzsche',
		'chosen' => false
	
	),
	2 => array(
		'titel' => 'Vlaamse regering koopt nieuwe doofpotten',
		'datum' => '',
		'inhoud' => 'De Vlaamse regering investeert in tien nieuwe doofpotten ter waarde van 30 miljoen euro. Dat moet de werking van de overheid – althans het deel dat niet in de doofpot belandt – transparanter maken.

 			Homans-nagels Liesbeth Homans luidt de alarmbel over de huidige doofpotten: door slijtage lekken ze.
			Een conceptnota van Vlaams minister van Binnenlandse Aangelegenheden Liesbeth Homans (N-VA) vertolkt de ambitie om tegen 2020 alle interacties met de Vlaamse overheid te mystificeren en ondoorgrondelijker te maken. De huidige doofpotten van Vlaanderen voldoen volgens Homans niet meer aan hedendaagse normen.

			‘Samen met een hoop bevoegdheden zijn de doofpotten overgekomen van het federaal niveau. Ze dateren nog uit de jaren tachtig, zijn verouderd en tot op de draad versleten. Door de talrijke lekken tengevolge van slijtage komt de werking van de overheidsdiensten in het gedrang’, ',

		'afbeelding' => 'img/Homans.jpg',
		'afbeeldingBeschrijving' => 'portrait picture Liesbeth Homans',
		'chosen' => false
	),
);

$artikels = $alles;


//////////// FILTER ARTICLES BASED ON SEARCH .. IF ANY

//has the search field been filled in? 
if(( isset($_GET["needle"])) && ( $_GET["needle"] !== '')){ 
	$artikels = array();
	$needle = $_GET["needle"];
	foreach ($alles as $key => $value) {


		//does het article contain the search string?
		if (strstr(  $value["inhoud"], $needle  )) 
		{
			//article should be shown.
			//var_dump($_GET["needle"] . " was found!");
			$artikels[] = $value;

		}
		else{
			//article should not be shown.
			//var_dump($_GET["needle"] . " was not found!");
			//var_dump($value["inhoud"]);
		}

		if (sizeof($artikels) === 0){
			$artikels[0]["titel"] = "Nope... ";
 			$artikels[0]["afbeelding"] = "";
 			$artikels[0]["inhoud"] =  " No search results when searching for " . $needle;

		}
	}
	//var_dump($artikels);

}
else{
	$artikels = $alles;
}


///////// DO WE NEED ONE SPECIFIC ARTICLE? 

//was a specific article chosen?
if (isset($_GET["id"])){
	
	if (isset($artikels[$_GET['id']])	){
		$artikel = $artikels[$_GET['id']];
	}
	else 
	{
		//dit artikel bestaat niet

		//var_dump("Error 404.");
		$artikel = array();
		$artikel["titel"] = "Nope... ";
 		$artikel["afbeelding"] = "";
 		$artikel["inhoud"] =  " No such article.  ";
	}

}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Oef GET</title>
		
		<style type="text/css">

		.container{
			margin-left: 20%;
			vertical-align: center;
			max-width : 60%;
			background-color: #FFF;
			text-align: center;
		}

		.fullblown{
			max-width: 80%;
			background-color: #AAA;
		}

		section{

			float: left;
			max-width : 20%;
			display: block;

		}

		img{
			max-width: 100px;
			max-height: auto;
			margin: 0;
		}

		article{
			margin: 0;
			text-align: right;
		}

		section {
			text-align: center;
			background-color: #CCC;
			padding : 2em;
			margin : 1em;
		}
		</style>

	</head>
	<body>
		<div class= "container">
			<h1>My first blog..</h1>

			<form>
				<h2> Search here </h2>
				<label>Zoeken naar artikels met het woord.... </label><input name="needle">  
				<input type="submit" text="submit"> 
			</form>
			

			<h2> </h2>

		<?php if ($artikel != -1 ): ?>
			
			<section class="fullblown">
								
						
			<h2> <?= $artikel["titel"] ?>  </h2>
			<img src=  <?= $artikel["afbeelding"] ?>  >
				<article>
					<?= $artikel["inhoud"] ?>
					 
				</article>
				<a href= <?= 'oef_GET.php?' ?>> Terug naar overzicht.... </a>
			</section>
		
		<?php else: ?>
			<?php foreach ($artikels as $key => $value): ?>
				<section >
										
								
					<h2> <?= $artikels[$key]["titel"] ?>  </h2>
					<img src=  <?= $artikels[$key]["afbeelding"] ?>  >
					<article>
						 
						  <?= substr($artikels[$key]["inhoud"], 0, 100) . "..."  ?>
						 <a href= <?= '"oef_GET.php?id=' . $key . '"' ?>> Lees meer.... </a>
					</article>
						
				</section>
			<?php endforeach ?>
		<?php endif ?>


			
		</div> <!--container -->
	</body>
</html>

