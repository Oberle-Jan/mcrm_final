(function() {
	//ajax ruft sql_loadnutzerverw auf, welche eine SQL Abfrage macht und die Daten über ein JSON 
	//Objekt zurück gibt, anschließend werden die divs in einer Schleife erzeugt und angehängt
	$
			.ajax({
				type : "POST",
				url : "php/sql_loadnutzerverw.php",
				dataType : "json",

				success : function(data) {

					for (var i = 0; i < data.length; i++) {

						var div = '<div class="row nutzerliste">	<div class="col-xs-2">  <img src="'
								+ data[i].Pic
								+ '" width="60px" height="60px"> </div><div class="col-xs-8 framed"><div class="row"><div class="col-xs-2"> Name:  </div>	<div class="col-xs-6"> '
								+ data[i].Vorname
								+ ' '
								+ data[i].Nachname
								+ '  </div></div><div class="row"><div class="col-xs-2"> Username: </div><div class="col-xs-6">  '
								+ data[i].Nutzername
								+ ' </div>	</div></div><div class="col-xs-2"> <button onclick="passAendern(\''
								+ data[i].Nutzername
								+ '\' ) "class="btn btn-success btn-lg"> Passwort &auml;ndern </button></div>'

						// Anhängen des jeweils erzeugten Elements via jquery an
						// das div mit der entsprechenden id
						jQuery("#nutzerContainer").append(div);

					}
				}
			});

})();

// weitergabe des usernames an Löschformular via Buttonclick
function passAendern(user) {
	window.location = "nutzerPasswort.php?user=" + user;

}
