<!-- charset für alle dateien ist ISO-8859-1, Programm wurde auf Windows, XAMPP in Chrome auf 1680x1050
getestet und weißt unter diesen Bedingungen keine Fehler auf. Ich könnte mir allerdings vorstellen, dass zb.
Hochladen auf Linux zu Problemen führen könnte, da dort afaik utf-8 unterstützt wird. -->
<?php
include 'navigation.php';
if (! isset ( $_SESSION )) {
	SESSION_START ();
}
if (array_key_exists ( 'index', $_SESSION ) == 1) {
	// User ist bereits eingeloggt
	header ( 'location: ladenansicht.php' );
}
?>
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

<!-- Einbinden des Stylesheets -->
<link rel="stylesheet" href="css/mcrmstyle.css">

</head>
<body>

	<div class="container">
		<h1>Login</h1>


		<div class="jumbotron" id="loginbox">



			<form id="logbox">
				<div class="form-group">
					<div class="form-group">
						<label for="user" class="col-sm-2 topmargin large">Benutzername</label>
						<div class="col-sm-10">
							<input type="text" class="form-control input-lg topmargin"
								placeholder="Benutzername" name="user" id='eUser' />
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="col-sm-2 topmargin large">Passwort</label>
						<div class="col-sm-10 topmargin">
							<input type="password" class="form-control input-lg"
								placeholder="Passwort" name="password" id='ePassword' />
						</div>
					</div>

					<div class="form-group col-sm-offset-2 topmargin">


						<input type="button" name="submit" class="btn btn-success btn-lg"
							id="loginbutton" value="Login!" onclick="testLogin()" />

					</div>


				</div>
			</form>
		</div>
	</div>

	<!-- Eigentlich wollten wir hier ganznormal via form mit action und post arbeiten,
leider waren wir nicht in der lage dann vom backend eine sinnvolle meldung zurückzugeben, weshalb wir 
nun auf ajax umgestiegen sind -->
	<script type="text/javascript">

   /* testLogin() sendet die Login-Daten an einloggen.php, wo sie via SQL überprüft werden
	* anschließend wird geprüft, ob ein login stattgefunden hat und entsprechend
	* weitergeleitet, oder ein fehler ausgegeben
	*/
	function testLogin() {
		params = {
				'user': $('#eUser').val(),
				'password': $('#ePassword').val()
				};
		$.ajax({
		    url:"php/einloggen.php",
		    type:"POST",
		    data: params,
		    success: function (data) {
	            if(data == 1) {
	            	window.location = "ladenansicht.php";
		            } else {
			            $('#errorLogin').remove();
		            	$('#eUser').before('<span id="errorLogin"><i style="color:red;font-size:14px;">Username/Password ist falsch</i><br></span>');
		            	return false;
			            }	
	        },
		}); 
		}

	$("#logbox").keyup(function(event){
	    if(event.keyCode == 13){
	        $("#loginbutton").click();
	    }
	});



</script>





</body>
</html>