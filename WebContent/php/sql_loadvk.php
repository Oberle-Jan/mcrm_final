<?php
// Einbinden der Datenbankverbindung
include 'dbconnect.php';

// ausw�hlen der aktiven verk�ufer
$sql = "SELECT * FROM verk�ufer WHERE InStore=1";

// Durchf�hren des SQL befehls und speichern des Ergenisses in $res
$res = mysql_query ( $sql );
// Erstellen des Arrays reply mit den Verk�ufer-Objekten aus der Datenbank
while ( $row = mysql_fetch_assoc ( $res ) ) {
	$reply [] = $row;
}


//json_encode funktioniert nicht mit umlauten, hier fehlt noch eine l�sung!
// Das Array via json an die liste_ladenansicht_vk.js zur�ckgeben, dort wird das Ergebniss mit Ajax weiterverarbeitet
echo json_encode ( $reply );
mysql_close ( $link );
?>

