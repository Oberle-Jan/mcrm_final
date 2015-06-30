<?php
// Einbinden der Datenbankverbindung
include 'dbconnect.php';

// überprüfen ob verkäufer das gespräch beenden will
if (isset ( $_SESSION )) {
	unset ( $_SESSION ["zugewiesen"] );
	
	// Anwesenheit des Verkäufers auf 1=im Laden setzen; wird für die Verfügbarkeit von Verkäufern in der Ladenansicht benötigt
	$sql = "UPDATE verkäufer SET InStore=1 WHERE Mitarbeiternummer=" . $_SESSION ["user"] ["Mitarbeiternummer"];
	mysql_query ( $sql, $link );
	
	
	
	header ( 'location: ../ladenansicht.php' );
}