(function() {

	$
			.ajax({
				type : "POST",
				url : "php/sql_loadartikel.php",
				dataType : "json",

				success : function(data) {
				
					for (var i = 0; i < data.length; i++) {

						var div = '<div class="col-xs-3"><div class="row"><div class="col-xs-3"><img class="artikelbild" src="'
								+ data[i].Pic
								+ '" width="90px" height="90px"/></div></div><div class="row"><div class="col-xs-3">'
								+ data[i].Bezeichner
								+ '</div></div><div class="row lastline"><div class="col-xs-3">'
								+ data[i].Preis + '&euro;</div></div></div>'

						// Anhängen des jeweils erzeugten Elements via jquery an
						// das div mit der entsprechenden id
						jQuery("#artikelliste").append(div);

					}
				}
			});

})();
