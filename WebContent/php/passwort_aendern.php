<?php
// Einbinden der Datenbankverbindung
include 'dbconnect.php';

// �berpr�fen ob Login-Daten eingegeben wurden
if (! empty ( $_POST ["password"] )) {
	
	/*
	 * Die im Login eingegeben Daten sollten "escaped" bzw.
	 * maskiert werden um beispielswei�e SQL Injections
	 * entgegenzuwirken
	 */
	$username = mysql_real_escape_string ( $_POST ["user"] );
	$passwort = mysql_real_escape_string ( $_POST ["password"] );
	
	// md5 hash f�r das passwort
	$passwort = md5 ( $passwort );
	
	// SQL Statemement n�tig wegen safe update protection in der mysql Datenbank
	// Sinnvoller wei�e h�tte man von Beginn an �ber die ID gearbeitet... aber hier wird ein klassischer
	// bandaid fix angewandt
	$sql = "SELECT Mitarbeiternummer FROM verk�ufer WHERE Nutzername = '$username'";
	$res = mysql_query ( $sql, $link );
	
	// Anzahl der Reihen aus der SQL-Anfrage wird in $Anzahl gespeichert
	$anzahl = @mysql_num_rows ( $res );
	
	if ($anzahl > 0) {
		
		// mitarbeiternummer aus query result auslesen
		$mitarbeiternr = mysql_result ( $res, 0 );
		
		// sql update �ber primary key mitarbeiternummer
		$sql1 = "UPDATE verk�ufer SET Passwort='$passwort' WHERE Mitarbeiternummer='$mitarbeiternr'";
		$res1 = mysql_query ( $sql1, $link );
		// zur�ckgeben, dass Passwort erfolgreich ge�ndert wurde erfolgreich war
		header ( 'Content-type: application/json' );
		echo json_encode ( 1 );
	} else {
		// zur�ckgeben, dass seltsame Dinge vonstatten gehen. Sollte prinzipiell niemals passieren,
		// da der input schon vorrausssetzt, dass der user existiert und anzahl immer >0 ist, aber wer wei�
		header ( 'Content-type: application/json' );
		echo json_encode ( 2 );
	}
}

mysql_close ( $link );
?>