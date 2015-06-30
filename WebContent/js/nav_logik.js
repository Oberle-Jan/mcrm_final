
	
		//dynamische Anzeige der Navigationselemente:	
		//Adminansicht: Nutzerverwaltung sichtbar - für andere Nutzer unsichtbar
		
		$("#menuLogut").hide();
		$("#menuLadenansicht").hide();
		$("#menuBeratung").hide();
		$("#menuNutzerverwaltung").hide();
		
		 if (rolle==0){
			 $("#menuNutzerverwaltung").hide();
		 } else {
			 $("#menuNutzerverwaltung").show();			 
		 }
	
		//Eingeloggte Nutzer sehen Logut, nicht eingeloggte den Login-Button:
		
		
		 if (eingeloggt==0){
			 $("#menuLogut").hide();
			 $("#menuLadenansicht").hide();
			 $("#menuBeratung").hide();
		 } else {
			 $("#menuLogut").show();
			 $("#menuLadenansicht").show();
			 $("#menuBeratung").show();
		 }
		 		 
		//Hinterlege aktive Seite in der Navigationsleiste mit Farbe:
		/*	1. Bestimme Pfad
			2. Extrahiere Dateinamen
			3. Entferne Dateierweiterung (.php)
			4. Erstelle einen Identifizierenden String f�r die Men�-Elemente
			5. Highlighte entsprechenden Men�punkt
			6. Markiere bei den Unterseiten der Nutzerverwaltung weiterhin das Men�element Nutzerverwaltung als aktiv*/

		//1. Bestimme Pfad:
		var path = window.location.pathname;
		//2. Extrahiere Dateinamen:
		var patt = /[a-z]*.php/ig; //Regulärer Ausdruck - matcht auf Zeichenketten, die dem Muster folgen /<beliebige Buchstabenfolge>.php
		var page = patt.exec(path); //Sucht im Dateipfad nach diesem Muster und extrahiert den String aus dem Pfad
		//3. Entferne Dateierweiterung: 
		var strPage = String(page); //Umwandeln des Obejektes in String
		var p = strPage.indexOf("."); //Stelle des Punktes herausfinden
		var pageID = strPage.slice(0,p); //.php abschneiden 
		//4. Erstelle MenüID
		pageID = "#menu"+pageID.substring(0,1).toUpperCase() + pageID.substring(1).toLowerCase(); //Erstelle String, der auf Navigationselemente referenziert
		//5. Highlighte Menüeintrag der aktiven Seite
		$(pageID).addClass("active");
		//6. Unterseiten der Nutzerverwaltung highlighten auch den menupunkt Nutzerverwaltung
		if ((pageID=="#menuNutzeranlegen")||(pageID=="#menuNutzerloeschen")||(pageID=="#menuNutzerpasswort")){
			$("#menuNutzerverwaltung").addClass("active");
		}
		
		//Überprüfen ob ein Kundenberater einen Kunden angenommen hat
		//Wenn nicht, wird er via Popup zurückgewießenm wenn doch
		//Wird er an die beratungsseite mit der jeweils relevanten zugewießenen Kundennummer (zuknr) verlinkt,
		//die er zuvor angenommen hat
		$("#blink").click(function(event){
			if (typeof zuknr == 'undefined'){
				event.preventDefault();
				alert("Bitte erst Kunden annehmen!");
				
				//window.history.go(-1);
			} else {
				var beratungsLink = "beratung.php?id1=" + zuknr;
					$("#blink").attr("href", beratungsLink);
			}
		});
