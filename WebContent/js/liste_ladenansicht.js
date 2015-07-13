(function() {
	//ajax ruft sql_loadkunden auf, welche eine SQL Abfrage macht und die Daten über ein JSON 
	//Objekt zurück gibt, anschließend werden die divs in einer Schleife erzeugt und angehängt
	$
			.ajax({
				type : "POST",
				url : "php/sql_loadkunden.php",
				dataType : "json",

				success : function(data) {

					for (var i = 0; i < data.length; i++) {

						var div = '<div class="row kundenliste"><div class="col-xs-2"> <img src="'
								+ data[i].Pic
								+ '" width="90px" height="90px"/></div><div class="col-xs-8 framed"> <div class="row"><div class="col-xs-1"> <span class="badge">'
								+ data[i].kundenklasse_Kundenklasse
								+ '  </span>  </div><div class="col-xs-2">Name: </div><div class="col-xs-5">'
								+ data[i].Vorname
								+ ' '
								+ data[i].Nachname
								+ '</div></div><div class="row"><div class="col-xs-2 col-xs-offset-1"> Wartezeit: </div>	<div class="col-xs-5"> '
								+ i
								+ ' min </div>	</div></div><div class="col-xs-2"> <button onclick="kundenAnnehmen(\''
								+ data[i].Kundennummer
								+ '\' )" class="btn btn-success btn-lg acceptKunde" id="testKunde"> Kunden annehmen </button> </div></div>';

						// Anhängen des jeweils erzeugten Elements via jquery an
						// das div mit der entsprechenden id
						jQuery("#listendiv").append(div);

					}
				}
			});

})();


// weitergabe der Kundennummer an Beratungsansicht via Buttonclick
// Falls bereits ein Beratungsgespräch im Gange ist kommt ein Popup, dass man
// dieses beenden muss
function kundenAnnehmen(knr) {
	if (typeof zuknr === 'undefined') {
		window.location = "beratung.php?id1=" + knr;
	} else {
		event.preventDefault();
		alert("Sie betreuen bereits einen Kunden, bitte schließen sie die Beratung erst ab!");
	}
}
