<?php
include 'dbconnect.php';

if (! empty ( $_POST ["submit"] )) {
	
	/*
	 * escapen der �bergegebenen daten
	 */
	$username = mysql_real_escape_string ( $_POST ["user"] );
	
	// SQL zum �berpr�fen ob der Nutzer existiert
	$sql = "SELECT * FROM verk�ufer WHERE Nutzername='$username'";
	$res = mysql_query ( $sql, $link );
	$anzahl = @mysql_num_rows ( $res );
	$row = mysql_fetch_assoc ( $res );
	$mnr=$row ['Mitarbeiternummer'];
	
	// �berpr�fen ob nutzer existiert
	if ($anzahl == 0) {
		echo '<script type="text/javascript">alert("Dieser Nutzer existiert nicht!");window.location = "../nutzerverwaltung.php";</script>';
	} else {
		
		// Verhindern, dass findige administratoren sich selbst l�schen
		if ($_SESSION ['user'] ['Nutzername'] == $username) {
			echo '<script type="text/javascript">alert("Computer says no: pls don\'t suicide!");window.history.go(-1);</script>';
		} else {
			
			// Falls der User Notizen erstellt hat, m�ssen diese wegen fremdschl�sselbeziehungen
			// auf einen "l�schdummy" gesetzt werden (delete on cascade macht wenig sinn)
			$sql = "UPDATE notiz SET verk�ufer_Mitarbeiternummer = '100' WHERE verk�ufer_Mitarbeiternummer = '$mnr'";
			$res = mysql_query ( $sql, $link );
			//selbiges gilt f�r verk�ufer zu kunde beziehungen, die wir aber sowieso nicht eingebunden haben
			$sql = "UPDATE verk�uferzukunde SET verk�ufer_Mitarbeiternummer = '100' WHERE verk�ufer_Mitarbeiternummer = '$mnr'";
			$res = mysql_query ( $sql, $link );
			
			// SQL Statement zum l�schen des angegebenen benutzers
			$sql = "DELETE FROM verk�ufer WHERE Mitarbeiternummer='$mnr'";
			
			// Ausf�hren des L�schbefehls
			$del = mysql_query ( $sql, $link );
		
			header ( 'location: ../nutzerverwaltung.php' );
		}
	}
} else {
	echo "Fehler beim submit";
}
mysql_close ( $link );
?>