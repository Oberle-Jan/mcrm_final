<?php
#Einbinden der Datenbankverbindung
include 'dbconnect.php';

/*
 * SQL statement zum abrufen aller aktiven Kunden. Sp�ter sollte, hier die Zutrittskontrolle (zb. 
 *Gesichtserkennung in Verbindung mit NFC) daf�r sorgen, dass zum einen neue Kunden in die Datenbank
 *eingetragen werden und zum anderen, dass das Attribut "Kunde_inStore" beim betreten auf 1 gesetzt wird
 *und beim Verlassen wieder auf 0. Solange dieses System nicht eingebunden ist, werden einfach Stumpf alle
 *Kunden mit Kunde_inStore=1 in die DB eingetragen.
 *Weiterhin werden die Kunden aufsteigend nach Priorit�t "Kundenklasse" geordnet.
*/
$sql = "SELECT * From kunde WHERE kunde_inStore = 1 ORDER BY kundenklasse_Kundenklasse ASC";

#INSTORE wird wnen man kunde annimt auf 0 gesetzt

# Durchf�hren des SQL befehls und speichern des Ergenisses in $res
$res = mysql_query($sql);

/*
// name des favorisierten verk�ufers
$sql2 = "SELECT verk�ufer.Vorname AS `vkVname`, verk�ufer.Nachname AS `vkNname` FROM verk�ufer where verk�ufer.Mitarbeiternummer in ( SELECT verk�ufer_Mitarbeiternummer From verk�uferzukunde WHERE kunde_Kundennummer ='$knr')";
$res2 = mysql_query ( $sql2 );
// Erstellen des Arrays reply mit den Kunden-Objekten aus der Datenbank
$row2 = mysql_fetch_assoc ( $res2 );
*/

# Erstellen des Arrays reply mit den Kunden-Objekten aus der Datenbank
while ($row = mysql_fetch_assoc($res)) {
		$reply[]=$row;
	
}


//json_encode funktioniert nicht mit umlauten, hier fehlt noch eine l�sung!
#Das Array via json an die Ladenansicht.js zur�ckgeben, dort wird das Ergebniss mit Ajax weiterverarbeitet
echo json_encode($reply);
mysql_close ( $link );
?>