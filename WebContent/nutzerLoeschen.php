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
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"
	type="text/javascript"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>


<link href="css/mcrmstyle.css" rel="stylesheet">





</head>

<body>


	<div class="container">
		<h1>Nutzer l&ouml;schen</h1>


		<div class="jumbotron" id="formContainerLoeschen">



			<form action=php/benutzer_loeschen.php method="post">
				<div class="form-group">
					<div class="form-group">
						<label for="user" class="col-sm-2 topmargin large">Zu l&ouml;schender Benutzer:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control input-lg topmargin"
								placeholder="Benutzername" name="user" />
						</div>
					</div>

				</div>

				<div class="form-group col-sm-offset-2 topmargin">

					<input type="submit" name="submit" class="btn btn-warning"
						id="deletebutton" value="L&ouml;schen!" />

				</div>
		</form>	
		</div>
		
	</div>
	

</body>
</html>