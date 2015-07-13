(function() {
	//ajax ruft sql_loadvk auf, welche eine SQL Abfrage macht und die Daten über ein JSON 
	//Objekt zurück gibt, anschließend werden die divs in einer Schleife erzeugt und angehängt
	$
			.ajax({
				type : "POST",
				url : "php/sql_loadvk.php",
				dataType : "json",
			
				success : function(data) {

					for (var i = 0; i < data.length; i++) {

						var div = '<div class="col-xs-2"><div class="row" > <img src="'
								+ data[i].Pic
								+ '" width="90px" height="90px"</div><div class="row" style="padding: 15px"> '
								+ data[i].Vorname
								+ " "
								+ data[i].Nachname
								+ ' </div></div>'
						jQuery("#verkaeuferVerfuegbar").append(div);
					}
				}
			});

})();
