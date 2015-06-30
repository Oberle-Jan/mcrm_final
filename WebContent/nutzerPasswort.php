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
	<h2>Passwort &auml;ndern f&uuml;r:<?php echo " ".$_GET['user']?> </h2>

	<div class="row">
		<div class="jumbotron" id="formContainerLoeschen">

			<form id="aenderform" onsubmit="passwortAendern(); return false;">
				<div class="form-group">
					<label for="password" class="col-sm-2 control-label topmargin">neues
						Passwort</label>
					<div class="col-xs-10">
						<input type="password" class="form-control topmargin"
							id="password" placeholder="neues Passwort">
					</div>
				</div>


				<div class="form-group">
					<div class="col-sm-offset-5 col-sm-10">
						<input type="button" name="submit"
							class="btn btn-success topmargin" id="aenderButton"
							onClick="passwortAendern()"
							value="Klicken um Passwort zu &auml;ndern" />
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<script type="text/javascript">

   /* passwortAendern() sendet die das eingegebene Passwort an passwort_aendern.php, wo geprüft wird ob der Nutzer
   	* existiert und die änderung über ein SQL-Update-Statement ausgeführt wird 
	*/

	function passwortAendern() {
		
		params = {
				'user': ("<?php echo $_GET['user']?>"),
				'password': $('#password').val()
				};
		$.ajax({
		    url:"php/passwort_aendern.php",
		    type:"POST",
		    data: params,
		    success: function (data) {
			    // überprüfen ob und welcher Fehler beim ändern auftritt
			if(data==2){
				$('#errorAender').remove();
	            $('#password').before('<span id="errorAender"><i style="color:red;font-size:14px;">Absurder Fehler, sollte nicht vorkommen!</i><br></span>');
	            return false;
			}
	        if(data == 1) {
	        	alert(unescape("Passwort erfolgreich ge%E4ndert%21"));
	        	window.location = "nutzerverwaltung.php";
		    } else {
			        $('#errorAender').remove();
		         	$('#password').before('<span id="errorAender"><i style="color:red;font-size:14px;">Bitte geben Sie ein neues Passwort an!</i><br></span>');
		          	return false;
			        }	
	        },
		}); 
		}

</script>



</body>
</html>