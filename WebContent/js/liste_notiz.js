(function() {

	$
			.ajax({
				type : "POST",
				url : "php/sql_loadnotiz.php",
				dataType : "json",
			
				success : function(data) {
				
					for (var i = 0; i < data.length; i++) {

						var div = '<div class="col-xs-12">&#8226; '+data[i].Feedback+'</div>';

						// Anhängen des jeweils erzeugten Elements via jquery an
						// das div mit der entsprechenden id
						jQuery("#kommentare").append(div);

					}
				}
			});

})();

