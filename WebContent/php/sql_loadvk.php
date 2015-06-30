<?php
// Einbinden der Datenbankverbindung
include 'dbconnect.php';

// auswählen der aktiven verkäufer
$sql = "SELECT * FROM verkäufer WHERE InStore=1";

// Durchführen des SQL befehls und speichern des Ergenisses in $res
$res = mysql_query ( $sql );
// Erstellen des Arrays reply mit den Verkäufer-Objekten aus der Datenbank
while ( $row = mysql_fetch_assoc ( $res ) ) {
	$reply [] = $row;
}


//json_encode funktioniert nicht mit umlauten, hier fehlt noch eine lösung!
// Das Array via json an die liste_ladenansicht_vk.js zurückgeben, dort wird das Ergebniss mit Ajax weiterverarbeitet
echo json_encode ( $reply );
mysql_close ( $link );
?>

