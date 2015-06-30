<!-- Login Status überprüfen, Wenn nicht eingeloggt, dann Weiterleitung zur LogIn-Ansicht -->
<?php include 'php/loginstatus.php'?>
<?php include 'navigation.php';?>
<?php include 'php/sql_beratung.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="ISO-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Multichannel CRM</title>
<!-- Bootstrap -->
<!-- Latest compiled and minified CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

<!--  Einbinden des Javascripts, welches die Artikelliste aus der DB generiert-->
<script type="text/javascript" src="js/liste_artikel.js"></script>

<!--  Einbinden des Javascripts, welches die Komentare aus der DB generiert-->
<script type="text/javascript" src="js/liste_notiz.js"></script>

<!-- Einbinden des Stylesheets -->
<link rel="stylesheet" href="css/mcrmstyle.css">

</head>


<body>

	<div class="container">
		<div class="row" id="top">
			<div class="col-xs-9">
				<h1>Beratungsgespr&auml;ch mit:<?php echo " ".$vname." ".$nname;?></h1>
			</div>
			<div class="col-xs-2">
				<a href="php/beratung_beenden.php">
					<button type="button" class="btn btn-success btn-block"
						style="margin-top: 20px; margin-bottom: 20px">Beratung beenden!</button>
				</a>
			</div>
		</div>


		<div class="row" id="kundeninformationen">
			<div class="col-xs-12" id="overview">
				<div class="col-xs-8" style="position: relative; left: -15px">
					<div class="jumbotron" id="kunde">
						<!-- <div class="row">
								<div class="col-xs-3">
									
								</div>
								<div class="row">
									<div class="col-xs-2"> Name	</div>
									<div class="col-xs-3"> Peter Pan</div>
								</div>
							</div>-->
						<div class="row">
							<div class="col-xs-3">
								<div style="margin-left: 5px">
									<img src="<?php echo $pic; ?>" />
								</div>
							</div>
							<div class="col-xs-9">
								<div class="row">
									<div class="col-xs-3" style="font-weight: bold">Kunde:</div>
									<div class="col-xs-9"><?php echo $vname." ".$nname;?></div>
								</div>
								<div class="row">
									<div class="col-xs-3" style="font-weight: bold">&#216; Umsatz:</div>
									<div class="col-xs-9"><?php echo $umsatz." &#x20AC;"; ?> </div>
								</div>
								<div class="row">
									<div class="col-xs-3" style="font-weight: bold">Prio:</div>
									<div class="col-xs-9">
										<span class="badge"> <?php echo $prio;?></span>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-3" style="font-weight: bold">Stammverk&auml;ufer:</div>
									<div class="col-xs-9"><?php echo $favvk; ?> </div>
								</div>
							</div>

						</div>
					</div>
				</div>


				<div class="col-xs-4">
					<div class="jumbotron" id="rabatte"
						style="position: relative; left: 15px">Individueller Rabat: <?php echo $rabatt;?> %</div>
				</div>
			</div>
		</div>


		<div class="row" id="vorschlaege">
			<div class="col-xs-12">
				<div class="jumbotron" id="artikelliste" style="height: 300px"></div>
			</div>
		</div>

		<div class="row">
			<div class="jumbotron" id="kommentare"></div>
			<form action=php/notiz_anlegen.php method="post">
				<div class="row topmargin">
					<div class="col-xs-8">
						<input class="form-control input-lg" name="notiz" type="text" />
					</div>
					<div class="col-xs-4">
						<input type="submit" name="submit" id="komentarbutton"
							value="Kommentar Senden!" class="btn btn-lg btn-success" />
					</div>
				</div>
			</form>
		</div>
	</div>



</body>
</html>