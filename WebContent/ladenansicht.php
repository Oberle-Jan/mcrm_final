<!-- Login Status überprüfen, Wenn nicht eingeloggt, dann Weiterleitung zur LogIn-Ansicht -->
<?php include 'php/loginstatus.php'?>
<?php include 'navigation.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="ISO-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport"
	content="width=device-width, initial-scale=1 user-scalable=no">
<title>Multichannel CRM</title>
<!-- Bootstrap -->
<!-- Latest compiled and minified CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

<!--  Einbinden des Javascripts, welches die Kundenliste aus der DB generiert-->
<script type="text/javascript" src="js/liste_ladenansicht.js"></script>

<!--  Einbinden des Javascripts, welches die Verkäuferliste aus der DB generiert-->
<script type="text/javascript" src="js/liste_ladenansicht_vk.js"></script>

<!-- Einbinden des Stylesheets -->
<link rel="stylesheet" href="css/mcrmstyle.css">

</head>
<body>

	<div class="container">
		<h2>Kunden ausw&auml;hlen</h2>

		<div class="jumbotron" id="listendiv"></div>

		<div class="row">
			<div class="col-xs-4 col-xs-offset-4">
				<button type="button" class="btn btn-warning" id="verkaeuferToggle">
					Weitere Verk&auml;ufer verf&uuml;gbar?</button>
			</div>
		</div>
		<div class="row">
			<div class="jumbotron" id="verkaeuferVerfuegbar"></div>
		</div>

	</div>

	<script type="text/javascript">

		//nachfolgend für das toggle element
		$("#verkaeuferVerfuegbar").hide();
				
		$("#verkaeuferToggle").click(function(){
			$("#verkaeuferVerfuegbar").slideToggle();
			
		});
	</script>
</body>
</html>