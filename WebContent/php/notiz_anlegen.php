<?php
// Einbinden der Datenbankverbindung
include 'dbconnect.php';

// �berpr�fen ob Daten eingegeben wurden
if (isset ( $_POST ["submit"] )) {
	
	if (! empty ( $_POST ["notiz"] )) {
		/*
		 * escapen der eingaben
		 */
		$notiz = mysql_real_escape_string ( $_POST ["notiz"] );
		//zuwei�en  der variablen aus der session
		$zuknr = $_SESSION ["zugewiesen"];
		$mitarbeiternr = $_SESSION ["user"] ["Mitarbeiternummer"];
		
		// SQL Statement f�r das anlegen der Notiz
		$sql = "INSERT INTO notiz (`Feedback`, `verk�ufer_Mitarbeiternummer`, `kunde_Kundennummer`) VALUES ('$notiz', '$mitarbeiternr', '$zuknr');";
		// ausf�hren des Befehls und Z�hlen der Reihen
		$res = mysql_query ( $sql, $link );
		header ( 'location: ../beratung.php?id1='.$zuknr );
	} else {
		echo '<script type="text/javascript">alert("Bitte geben Sie eine Notiz ein!");window.history.go(-1);</script>';
	}
} else {
	echo "fehler";
}