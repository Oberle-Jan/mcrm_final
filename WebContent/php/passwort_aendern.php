<?php
// Einbinden der Datenbankverbindung
include 'dbconnect.php';

// Überprüfen ob Login-Daten eingegeben wurden
if (! empty ( $_POST ["password"] )) {
	
	/*
	 * Die im Login eingegeben Daten sollten "escaped" bzw.
	 * maskiert werden um beispielsweiße SQL Injections
	 * entgegenzuwirken
	 */
	$username = mysql_real_escape_string ( $_POST ["user"] );
	$passwort = mysql_real_escape_string ( $_POST ["password"] );
	
	// md5 hash für das passwort
	$passwort = md5 ( $passwort );
	
	// SQL Statemement nötig wegen safe update protection in der mysql Datenbank
	// Sinnvoller weiße hätte man von Beginn an über die ID gearbeitet... aber hier wird ein klassischer
	// bandaid fix angewandt
	$sql = "SELECT Mitarbeiternummer FROM verkäufer WHERE Nutzername = '$username'";
	$res = mysql_query ( $sql, $link );
	
	// Anzahl der Reihen aus der SQL-Anfrage wird in $Anzahl gespeichert
	$anzahl = @mysql_num_rows ( $res );
	
	if ($anzahl > 0) {
		
		// mitarbeiternummer aus query result auslesen
		$mitarbeiternr = mysql_result ( $res, 0 );
		
		// sql update über primary key mitarbeiternummer
		$sql1 = "UPDATE verkäufer SET Passwort='$passwort' WHERE Mitarbeiternummer='$mitarbeiternr'";
		$res1 = mysql_query ( $sql1, $link );
		// zurückgeben, dass Passwort erfolgreich geändert wurde erfolgreich war
		header ( 'Content-type: application/json' );
		echo json_encode ( 1 );
	} else {
		// zurückgeben, dass seltsame Dinge vonstatten gehen. Sollte prinzipiell niemals passieren,
		// da der input schon vorrausssetzt, dass der user existiert und anzahl immer >0 ist, aber wer weiß
		header ( 'Content-type: application/json' );
		echo json_encode ( 2 );
	}
}

mysql_close ( $link );
?>