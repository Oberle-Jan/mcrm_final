<?php
// Einbinden der Datenbankverbindung
include 'dbconnect.php';

// �berpr�fen ob verk�ufer das gespr�ch beenden will
if (isset ( $_SESSION )) {
	unset ( $_SESSION ["zugewiesen"] );
	
	// Anwesenheit des Verk�ufers auf 1=im Laden setzen; wird f�r die Verf�gbarkeit von Verk�ufern in der Ladenansicht ben�tigt
	$sql = "UPDATE verk�ufer SET InStore=1 WHERE Mitarbeiternummer=" . $_SESSION ["user"] ["Mitarbeiternummer"];
	mysql_query ( $sql, $link );
	
	
	
	header ( 'location: ../ladenansicht.php' );
}