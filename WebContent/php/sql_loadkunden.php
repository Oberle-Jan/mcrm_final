<?php
// Einbinden der Datenbankverbindung
include 'dbconnect.php';

/*
 * SQL statement zum abrufen aller aktiven Kunden. Später sollte, hier die Zutrittskontrolle (zb.
 * Gesichtserkennung in Verbindung mit NFC) dafür sorgen, dass zum einen neue Kunden in die Datenbank
 * eingetragen werden und zum anderen, dass das Attribut "Kunde_inStore" beim betreten auf 1 gesetzt wird
 * und beim Verlassen wieder auf 0. Solange dieses System nicht eingebunden ist, werden einfach Stumpf alle
 * Kunden mit Kunde_inStore=1 in die DB eingetragen.
 * Weiterhin werden die Kunden aufsteigend nach Priorität "Kundenklasse" geordnet.
 */
$sql = "SELECT * From kunde WHERE kunde_inStore = 1 ORDER BY kundenklasse_Kundenklasse ASC";

// INSTORE wird wnen man kunde annimt auf 0 gesetzt

// Durchführen des SQL befehls und speichern des Ergenisses in $res
$res = mysql_query ( $sql );

/*
 * // name des favorisierten verkäufers 
 * irgendwie so das Statement, bau ich ggf. noch ein...zube sagt aber brauchen wir nicht
 *
 * SELECT "Kunde"."Kundennummer", "Kunde"."Ansprechpatner", "Kunde"."Firma", "Kunde"."Ort",
 * "Kunde"."Notiz", case when "verkäufernummer" is
 * not null then"verkäufer"."Vorname" else 'nicht gefunden' 
 * end as verkäufer, "verkäufer"."Vorname", "verkäufer"."Nachname", "verkäufer"."Nummer", 
 * "Kundeverkäufer"."Notiz" FROM { oj "Kundeverkäufer" RIGHT OUTER JOIN "Kunde" ON 
 * "Kundeverkäufer"."Kundennummer" = "Kunde"."Kundennummer" LEFT OUTER JOIN "verkäufer" ON 
 * "verkäufer"."Nummer" = "Kundeverkäufer"."verkäufernummer" }
 *
 */

// Erstellen des Arrays reply mit den Kunden-Objekten aus der Datenbank
while ( $row = mysql_fetch_assoc ( $res ) /*AND $row2 = mysql_fetch_array($res2)*/) {
	$reply [] = $row; // +row2
}

// json_encode funktioniert nicht mit umlauten, hier fehlt noch eine lösung!
// Das Array via json an die liste_ladenansicht.js zurückgeben, dort wird das Ergebniss mit Ajax weiterverarbeitet
echo json_encode ( $reply );
mysql_close ( $link );
?>