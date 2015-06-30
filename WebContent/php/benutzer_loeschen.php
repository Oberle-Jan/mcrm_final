<?php
include 'dbconnect.php';

if (! empty ( $_POST ["submit"] )) {
	
	/*
	 * escapen der übergegebenen daten
	 */
	$username = mysql_real_escape_string ( $_POST ["user"] );
	
	// SQL zum Überprüfen ob der Nutzer existiert
	$sql = "SELECT * FROM verkäufer WHERE Nutzername='$username'";
	$res = mysql_query ( $sql, $link );
	$anzahl = @mysql_num_rows ( $res );
	$row = mysql_fetch_assoc ( $res );
	$mnr=$row ['Mitarbeiternummer'];
	
	// Überprüfen ob nutzer existiert
	if ($anzahl == 0) {
		echo '<script type="text/javascript">alert("Dieser Nutzer existiert nicht!");window.location = "../nutzerverwaltung.php";</script>';
	} else {
		
		// Verhindern, dass findige administratoren sich selbst löschen
		if ($_SESSION ['user'] ['Nutzername'] == $username) {
			echo '<script type="text/javascript">alert("Computer says no: pls don\'t suicide!");window.history.go(-1);</script>';
		} else {
			
			// Falls der User Notizen erstellt hat, müssen diese wegen fremdschlüsselbeziehungen
			// auf einen "löschdummy" gesetzt werden (delete on cascade macht wenig sinn)
			$sql = "UPDATE notiz SET verkäufer_Mitarbeiternummer = '100' WHERE verkäufer_Mitarbeiternummer = '$mnr'";
			$res = mysql_query ( $sql, $link );
			//selbiges gilt für verkäufer zu kunde beziehungen, die wir aber sowieso nicht eingebunden haben
			$sql = "UPDATE verkäuferzukunde SET verkäufer_Mitarbeiternummer = '100' WHERE verkäufer_Mitarbeiternummer = '$mnr'";
			$res = mysql_query ( $sql, $link );
			
			// SQL Statement zum löschen des angegebenen benutzers
			$sql = "DELETE FROM verkäufer WHERE Mitarbeiternummer='$mnr'";
			
			// Ausführen des Löschbefehls
			$del = mysql_query ( $sql, $link );
		
			header ( 'location: ../nutzerverwaltung.php' );
		}
	}
} else {
	echo "Fehler beim submit";
}
mysql_close ( $link );
?>