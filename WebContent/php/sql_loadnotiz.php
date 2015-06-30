<?php
// Einbinden der Datenbankverbindung
include 'dbconnect.php';

// abfragen der Kundennummer aus der Session
if (isset ( $_SESSION )) {
	$knr = $_SESSION ["zugewiesen"];
}

/*
 * SQL Statement zum abrufen der Kommentare
 */
$sql = "SELECT Feedback FROM notiz WHERE kunde_Kundennummer ='$knr'";

// Durchführen des SQL befehls und speichern des Ergenisses in $res
$res = mysql_query ( $sql );
// Erstellen des Arrays reply mit den Kunden-Objekten aus der Datenbank
while ( $row = mysql_fetch_assoc ( $res ) ) {
	$reply [] = $row;
}



//json_encode funktioniert nicht mit umlauten, hier fehlt noch eine lösung!
/*while ($i<count($reply)){
	$encode[i]=htmlentities($reply[i]);
	i++;}
*/
#DAS Array via json an die Ladenansicht.js zurückgeben, dort wird dAS Ergebniss mit Ajax weiterverarbeitet
echo json_encode($reply);
mysql_close ( $link );
?>
