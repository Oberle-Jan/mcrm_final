<?php
#Einbinden der Datenbankverbindung
include 'dbconnect.php';

/*
 * SQL statement zum abrufen aller aktiven Kunden. Später sollte, hier die Zutrittskontrolle (zb. 
 *Gesichtserkennung in Verbindung mit NFC) dafür sorgen, dass zum einen neue Kunden in die Datenbank
 *eingetragen werden und zum anderen, dass das Attribut "Kunde_inStore" beim betreten auf 1 gesetzt wird
 *und beim Verlassen wieder auf 0. Solange dieses System nicht eingebunden ist, werden einfach Stumpf alle
 *Kunden mit Kunde_inStore=1 in die DB eingetragen.
 *Weiterhin werden die Kunden aufsteigend nach Priorität "Kundenklasse" geordnet.
*/
$sql = "SELECT * From kunde WHERE kunde_inStore = 1 ORDER BY kundenklasse_Kundenklasse ASC";

#INSTORE wird wnen man kunde annimt auf 0 gesetzt

# Durchführen des SQL befehls und speichern des Ergenisses in $res
$res = mysql_query($sql);

/*
// name des favorisierten verkäufers
$sql2 = "SELECT verkäufer.Vorname AS `vkVname`, verkäufer.Nachname AS `vkNname` FROM verkäufer where verkäufer.Mitarbeiternummer in ( SELECT verkäufer_Mitarbeiternummer From verkäuferzukunde WHERE kunde_Kundennummer ='$knr')";
$res2 = mysql_query ( $sql2 );
// Erstellen des Arrays reply mit den Kunden-Objekten aus der Datenbank
$row2 = mysql_fetch_assoc ( $res2 );
*/

# Erstellen des Arrays reply mit den Kunden-Objekten aus der Datenbank
while ($row = mysql_fetch_assoc($res)) {
		$reply[]=$row;
	
}


//json_encode funktioniert nicht mit umlauten, hier fehlt noch eine lösung!
#Das Array via json an die Ladenansicht.js zurückgeben, dort wird das Ergebniss mit Ajax weiterverarbeitet
echo json_encode($reply);
mysql_close ( $link );
?>