<?php include 'php/rolecheck_nutzerverwaltung.php';?>
<?php include 'navigation.php';?>

<!DOCTYPE html>
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


<link href="css/mcrmstyle.css" rel="stylesheet">

<!--  Einbinden des Javascripts, welches die Kundenliste aus der DB generiert-->
<script type="text/javascript" src="js/liste_nutzerwaltung.js"></script>
</head>

<div class="container">
	<h2>Nutzerverwaltung</h2>

	

	<div class="jumbotron" id="nutzerContainer"></div>


<!-- Klick auf den Button öffnet ein Modal, das ein Formular zum Nutzeranlegen enthält -->
	<div class="row">
		<div class="col-xs-2 col-xs-offset-4">
			<a href="nutzerAnlegen.php"><button class="btn btn-success btn-lg"
					id="nutzerAnlegen">Nutzer anlegen</button></a>
			
		</div>
			<!-- Klick auf den Button öffnet eine neue Seite, das ein Formular zum Löschen eines Nutzers enthält -->
		<div class="col-xs-2">
			<a href="nutzerLoeschen.php">
				<button class="btn btn-warning btn-lg" id="nutzerLoeschen">Nutzer
					l&ouml;schen</button>
			</a>
		
		</div>

	</div>

</div>

</body>
</html>