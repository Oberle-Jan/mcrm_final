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
		<h1>Nutzer anlegen</h1>


		<div class="jumbotron" id="nutzerAnlegenbox">



			<form action=php/benutzer_anlegen.php method="post">
				<div class="form-group">
					<div class="form-group">
						<label for="user" class="col-sm-2 topmargin large">Benutzername</label>
						<div class="col-sm-10">
							<input type="text" class="form-control input-lg topmargin"
								placeholder="Benutzername" name="user" />
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="col-sm-2 topmargin large">Passwort</label>
						<div class="col-sm-10 topmargin">
							<input type="password" class="form-control input-lg"
								placeholder="Passwort" name="password" />
						</div>
					</div>

					<div class="form-group">
						<label for="fname" class="col-sm-2 topmargin large">Vorname</label>
						<div class="col-sm-10 topmargin">
							<input type="text" class="form-control input-lg"
								placeholder="Vorname" name="fname" />
						</div>
					</div>

					<div class="form-group">
						<label for="lname" class="col-sm-2 topmargin large">Nachname</label>
						<div class="col-sm-10 topmargin">
							<input type="text" class="form-control input-lg"
								placeholder="Nachname" name="lname" />
						</div>
					</div>

					<div class="row">

						<div class="form-group col-sm-4 col-sm-offset-2">
							<label class="radio-inline large"> <input type="radio"
								name="role" id="inlineRadio1" value="1"> Admin
							</label> <label class="radio-inline large"> <input type="radio"
								name="role" id="inlineRadio2" checked="checked" value="0"> User
							</label>
						</div>
						<div>*Nutzerbilder bitte im Ordner pics/nutzer mit username.jpg anlegen</div>
					</div>

					<div class="row">

						<div class="form-group col-sm-offset-2">

							<input type="submit" name="submit" class="btn btn-success btn-lg"
								id="loginbutton" value="Nutzer anlegen!" />

						</div>

					</div>


				</div>
			</form>
		</div>
	</div>

</body>
</html>