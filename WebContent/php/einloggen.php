 <?php
	// Einbinden der Datenbankverbindung
	include 'dbconnect.php';
	
	// Überprüfen ob Login-Daten eingegeben wurden
	if (! empty ( $_POST ["user"] )) {
		
		// nurzum debuggen foreach($_POST as $k=>$v) echo $k . ' -> ' . $v."<br />";
		
		/*
		 * Die im Login eingegeben Daten sollten "escaped" bzw.
		 * maskiert werden um beispielsweiße SQL Injections
		 * entgegenzuwirken
		 */
		$username = mysql_real_escape_string ( $_POST ["user"] );
		$passwort = mysql_real_escape_string ( $_POST ["password"] );
		//md5 hash erstellen
		$passwort = md5($passwort);
		// SQL Statement zum überprüfen des Logins
		$sql = "SELECT * FROM verkäufer WHERE Nutzername='$username' AND Passwort='$passwort' LIMIT 1";
		
		// Durchführen der Überprüfung
		$res = mysql_query ( $sql, $link );
		// Anzahl der Reihen aus der SQL-Anfrage wird in $Anzahl gespeichert
		$anzahl = @mysql_num_rows ( $res );
		
		// nur zum debuggen echo "Anzahl: ".$anzahl."<br />";
		
		// Wenn Anzahl = 0, dann gibt es keinen User, der den Anmeldedaten entspricht, sonst war der Login erfolgreich
		if ($anzahl > 0) {
			
			// Speichern des Login-Status in der Session
			$_SESSION ["login"] = 1;
			
			// Den Eintrag vom User in der Session speichern !
			$_SESSION ["user"] = mysql_fetch_array ( $res, MYSQL_ASSOC );
			
			// Anwesenheit des Verkäufers auf 1 setzen; wird für die Verfügbarkeit von Verkäufern in der Ladenansicht benötigt
			$sql = "UPDATE verkäufer SET InStore=1 WHERE Mitarbeiternummer=" . $_SESSION ["user"] ["Mitarbeiternummer"];
			mysql_query ( $sql, $link );
			
			// Überprüfen ob der User administrationsberechtigt ist
			if ($_SESSION ['user'] ['rolle_Rollennummer'] == 1) {
				$_SESSION ["admin"] = 1;
			} else {
				$_SESSION ["admin"] = 0;
			}
			
			// header ( 'location: ../ladenansicht.php' );
			
			// zurückgeben, dass Login erfolgreich war
			header ( 'Content-type: application/json' );
			echo json_encode ( 1 );
		} else {
			// zurückgeben, dass login nicht erfolgreich war
			header ( 'Content-type: application/json' );
			echo json_encode ( 0 );
		}
	}
	
	// Datenbankverbindung wieder schliessen
	mysql_close ( $link );
	?> 