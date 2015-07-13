<?php
// Einbinden der Datenbankverbindung
include 'dbconnect.php';

// Überprüfen ob Daten eingegeben wurden
if (isset ( $_POST ["submit"] )) {
	
	if (! empty ( $_POST ["notiz"] )) {
		/*
		 * escapen der eingaben
		 */
		$notiz = mysql_real_escape_string ( $_POST ["notiz"] );
		//zuweißen  der variablen aus der session
		$zuknr = $_SESSION ["zugewiesen"];
		$mitarbeiternr = $_SESSION ["user"] ["Mitarbeiternummer"];
		
		// SQL Statement für das anlegen der Notiz
		$sql = "INSERT INTO notiz (`Feedback`, `verkäufer_Mitarbeiternummer`, `kunde_Kundennummer`) VALUES ('$notiz', '$mitarbeiternr', '$zuknr');";
		// ausführen des Befehls und Zählen der Reihen
		$res = mysql_query ( $sql, $link );
		header ( 'location: ../beratung.php?id1='.$zuknr );
	} else {
		echo '<script type="text/javascript">alert("Bitte geben Sie eine Notiz ein!");window.history.go(-1);</script>';
	}
} else {
	echo "fehler";
}