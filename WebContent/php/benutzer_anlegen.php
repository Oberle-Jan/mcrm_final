
<?php
// Einbinden der Datenbankverbindung
include 'dbconnect.php';

// Überprüfen ob Login-Daten eingegeben wurden
if (! empty ( $_POST ["submit"] )) {
	
	/*
	 * escapen der eingaben
	 */
	$username = mysql_real_escape_string ( $_POST ["user"] );
	$passwort = mysql_real_escape_string ( $_POST ["password"] );
	$vorname = mysql_real_escape_string ( $_POST ["fname"] );
	$nachname = mysql_real_escape_string ( $_POST ["lname"] );
	$role = mysql_real_escape_string ( $_POST ["role"] );
	
	// Bilder werden standardmäßig über den username gespeichert, entsprechend müssen
	// die nutzerbilder einfach als "username".jpg im ordner abgelegt werden
	$pic = "pics/nutzer/".$username.".jpg";
	//md5 hash des passworts
	$passwort=md5($passwort);
	
	
	// SQL zum überprüfen auf Dupletten. Es gibt zwar eine eindeutige ID Nummer,
	// mir persönlich gehts hier aber um den username. Vor/ Nachname ist egal, da eine Person
	// durchaus mehere accounts haben könnte
	$sql = "SELECT * FROM Verkäufer WHERE Nutzername='$username'";
	// ausführen des Befehls und Zählen der Reihen
	$res = mysql_query ( $sql, $link );
	$anzahl = @mysql_num_rows ( $res );
	
	if ($anzahl > 0) {
		
		echo '<script type="text/javascript">alert("Dieser Nutzer existiert bereits!");window.history.go(-1);</script>';
	} else {
		
		// SQL Statement zum anlegen eines neuen Nutzers
		$sql = "INSERT INTO verkäufer ( `Nutzername`, `Passwort`, `Vorname`, `Nachname`,`InStore`, `Abteilung_Abteilungsnummer`, `Rolle_Rollennummer`, `Pic`) VALUES ('$username', '$passwort', '$vorname', '$nachname', 0, 1, '$role', '$pic')";
		
		// Anlegen des Nutzers
		$res = mysql_query ( $sql, $link );
		header ( 'location: ../nutzerverwaltung.php' );
	}
} else {
	echo "Problem beim submit";
}
mysql_close ( $link );
?>		