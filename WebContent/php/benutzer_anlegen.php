
<?php
// Einbinden der Datenbankverbindung
include 'dbconnect.php';

// �berpr�fen ob Login-Daten eingegeben wurden
if (! empty ( $_POST ["submit"] )) {
	
	/*
	 * escapen der eingaben
	 */
	$username = mysql_real_escape_string ( $_POST ["user"] );
	$passwort = mysql_real_escape_string ( $_POST ["password"] );
	$vorname = mysql_real_escape_string ( $_POST ["fname"] );
	$nachname = mysql_real_escape_string ( $_POST ["lname"] );
	$role = mysql_real_escape_string ( $_POST ["role"] );
	
	// Bilder werden standardm��ig �ber den username gespeichert, entsprechend m�ssen
	// die nutzerbilder einfach als "username".jpg im ordner abgelegt werden
	$pic = "pics/nutzer/".$username.".jpg";
	//md5 hash des passworts
	$passwort=md5($passwort);
	
	
	// SQL zum �berpr�fen auf Dupletten. Es gibt zwar eine eindeutige ID Nummer,
	// mir pers�nlich gehts hier aber um den username. Vor/ Nachname ist egal, da eine Person
	// durchaus mehere accounts haben k�nnte
	$sql = "SELECT * FROM Verk�ufer WHERE Nutzername='$username'";
	// ausf�hren des Befehls und Z�hlen der Reihen
	$res = mysql_query ( $sql, $link );
	$anzahl = @mysql_num_rows ( $res );
	
	if ($anzahl > 0) {
		
		echo '<script type="text/javascript">alert("Dieser Nutzer existiert bereits!");window.history.go(-1);</script>';
	} else {
		
		// SQL Statement zum anlegen eines neuen Nutzers
		$sql = "INSERT INTO verk�ufer ( `Nutzername`, `Passwort`, `Vorname`, `Nachname`,`InStore`, `Abteilung_Abteilungsnummer`, `Rolle_Rollennummer`, `Pic`) VALUES ('$username', '$passwort', '$vorname', '$nachname', 0, 1, '$role', '$pic')";
		
		// Anlegen des Nutzers
		$res = mysql_query ( $sql, $link );
		header ( 'location: ../nutzerverwaltung.php' );
	}
} else {
	echo "Problem beim submit";
}
mysql_close ( $link );
?>		