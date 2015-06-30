<!DOCTYPE html>
<!-- in Zeile 55 befindet sich ein php include auf die Datei nav_loginanzeige. 
Diese fügt der Navigation in Zusammenarbeit mit dem Javascript, welches in Zeile 62 eingebunden ist Funktionalität
hinzu (dynamisches anzeigen von Menüelementen, je nach Rolle, highlighting usw-->
<html>
<head>
<meta charset="ISO-8859-1">
<title>Multichannel CRM</title>


<!-- INCLUDED FILES -->
<!-- Bootstrap -->
<!-- Latest compiled and minified CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>



<!-- Einbinden des Stylesheets -->
<link rel="stylesheet" href="css/mcrmstyle.css">

</head>

<body>
	<div class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<a href="" class="navbar-brand"> mCRM </a>
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-collapse">
					<span class="sr-only"> Toggle Navigation</span> <span
						class="icon-bar"> </span> <span class="icon-bar"> </span> <span
						class="icon-bar"> </span>
				</button>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li id="menuLadenansicht"><a href="ladenansicht.php"><span
							class="glyphicon glyphicon-tasks big"> </span> Kunden
							ausw&auml;hlen</a></li>
					<li id="menuBeratung"><a href="beratung.php" id="blink"><span
							class="glyphicon glyphicon-comment big"> </span> Kunden beraten</a>
					</li>

					<li id="menuNutzerverwaltung"><a href="nutzerverwaltung.php"><span
							class="glyphicon glyphicon-cog big"> </span> Nutzer verwalten</a></li>
					<li id="menuLogut"><a href="php/logout.php"><span
							class="glyphicon glyphicon-off big"> </span> Logut</a>
				
				</ul>
				<!-- Die eingebundene nav_loginanzeige.php sorgt zusammen mit der nav_logik daüfr, dass das Menü funktioniert.
		Mit funktioniert ist gemeint, dass Elemente gehighlighted werdne, bzw gesperrt/versteck werden je nach dem
		welche Rechte der User hat und an welchem Punkt im Programmablauf er sich gerade befindet -->
				<p class="navbar-text navbar-right" id=menuLoginstatus> <?php include 'php/nav_loginanzeige.php'?></p>
			</div>
		</div>
	</div>


	<!--  Einbinden des Javascripts, für highlighting und dynamische Elementeanzeige in der Navbar-->
	<script type="text/javascript" src="js/nav_logik.js"></script>


</body>
</html>