<?php
// Einbinden der Datenbankverbindung
include 'dbconnect.php';

/*
 * SQL statement zum abrufen aller aktiven Kunden. Sp�ter sollte, hier die Zutrittskontrolle (zb.
 * Gesichtserkennung in Verbindung mit NFC) daf�r sorgen, dass zum einen neue Kunden in die Datenbank
 * eingetragen werden und zum anderen, dass das Attribut "Kunde_inStore" beim betreten auf 1 gesetzt wird
 * und beim Verlassen wieder auf 0. Solange dieses System nicht eingebunden ist, werden einfach Stumpf alle
 * Kunden mit Kunde_inStore=1 in die DB eingetragen.
 * Weiterhin werden die Kunden aufsteigend nach Priorit�t "Kundenklasse" geordnet.
 */
$sql = "SELECT * From kunde WHERE kunde_inStore = 1 ORDER BY kundenklasse_Kundenklasse ASC";

// INSTORE wird wnen man kunde annimt auf 0 gesetzt

// Durchf�hren des SQL befehls und speichern des Ergenisses in $res
$res = mysql_query ( $sql );

/*
 * // name des favorisierten verk�ufers 
 * irgendwie so das Statement, bau ich ggf. noch ein...zube sagt aber brauchen wir nicht
 *
 * SELECT "Kunde"."Kundennummer", "Kunde"."Ansprechpatner", "Kunde"."Firma", "Kunde"."Ort",
 * "Kunde"."Notiz", case when "verk�ufernummer" is
 * not null then"verk�ufer"."Vorname" else 'nicht gefunden' 
 * end as verk�ufer, "verk�ufer"."Vorname", "verk�ufer"."Nachname", "verk�ufer"."Nummer", 
 * "Kundeverk�ufer"."Notiz" FROM { oj "Kundeverk�ufer" RIGHT OUTER JOIN "Kunde" ON 
 * "Kundeverk�ufer"."Kundennummer" = "Kunde"."Kundennummer" LEFT OUTER JOIN "verk�ufer" ON 
 * "verk�ufer"."Nummer" = "Kundeverk�ufer"."verk�ufernummer" }
 *
 */

// Erstellen des Arrays reply mit den Kunden-Objekten aus der Datenbank
while ( $row = mysql_fetch_assoc ( $res ) /*AND $row2 = mysql_fetch_array($res2)*/) {
	$reply [] = $row; // +row2
}

// json_encode funktioniert nicht mit umlauten, hier fehlt noch eine l�sung!
// Das Array via json an die liste_ladenansicht.js zur�ckgeben, dort wird das Ergebniss mit Ajax weiterverarbeitet
echo json_encode ( $reply );
mysql_close ( $link );
?>