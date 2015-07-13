<?php
#Einbinden der Datenbankverbindung
include 'dbconnect.php';


//abfragen der Kundennummer aus der Session
if (isset ( $_SESSION )) {
	 $knr=$_SESSION ["zugewiesen"];
	
}


/*
 * SQL Statement zum abrufen der Artikelempfehlungen f�r den Kunden
 * gegenw�rtig werden diese �ber einen einzelnen Wert zugeordnet.
 * Theoretisch w�re dies erweiterbar und man k�nnte zb. dem Kunden 
 * je nach Hobbies/Kaufverhalten usw. beliebig viele inizes in die 
 * Tabelle schreiben, die dann wiederrum auf indizes von Artikeln gemappt
 * werden.
 * Die SQL Abfrage w�re dann entsprechend dynamisch umzusetzen, anstatt mit
 * 8 Artikeln, die einem Vorschlagsmuster zugeordnet sind.
*/
$sql = "SELECT T.Bezeichner, preis.Preis , T.Pic  FROM preis,(
SELECT a.Artikelnummer, a.Bezeichner, a.preis_idPreis, a.Pic  FROM artikel AS a WHERE a.Artikelnummer in(
(SELECT e.artikel_Artikelnummer1
FROM kunde AS k, empfehlung AS e WHERE k.empfehlung_idEmpfehlung = e.idEmpfehlung AND k.Kundennummer='$knr'), 
(SELECT e.artikel_Artikelnummer2
FROM kunde AS k, empfehlung AS e WHERE k.empfehlung_idEmpfehlung = e.idEmpfehlung AND k.Kundennummer='$knr'),
(SELECT e.artikel_Artikelnummer3
FROM kunde AS k, empfehlung AS e WHERE k.empfehlung_idEmpfehlung = e.idEmpfehlung AND k.Kundennummer='$knr'), 
(SELECT e.artikel_Artikelnummer4
FROM kunde AS k, empfehlung AS e WHERE k.empfehlung_idEmpfehlung = e.idEmpfehlung AND k.Kundennummer='$knr'), 
(SELECT e.artikel_Artikelnummer5
FROM kunde AS k, empfehlung AS e WHERE k.empfehlung_idEmpfehlung = e.idEmpfehlung AND k.Kundennummer='$knr'), 
(SELECT e.artikel_Artikelnummer6
FROM kunde AS k, empfehlung AS e WHERE k.empfehlung_idEmpfehlung = e.idEmpfehlung AND k.Kundennummer='$knr'), 
(SELECT e.artikel_Artikelnummer7
FROM kunde AS k, empfehlung AS e WHERE k.empfehlung_idEmpfehlung = e.idEmpfehlung AND k.Kundennummer='$knr'), 
(SELECT e.artikel_Artikelnummer8
FROM kunde AS k, empfehlung AS e WHERE k.empfehlung_idEmpfehlung = e.idEmpfehlung AND k.Kundennummer='$knr')
))AS T WHERE preis.idPreis= T.preis_idPreis";






# Durchf�hren des SQL befehls und speichern des Ergenisses in $res
$res = mysql_query($sql);
# Erstellen des Arrays reply mit den Kunden-Objekten aus der Datenbank
while ($row = mysql_fetch_ASsoc($res)) {
		$reply[]=$row;
	
}


//json_encode funktioniert nicht mit umlauten, hier fehlt noch eine l�sung!
#DAS Array via json an die liste_artikel.js zur�ckgeben, dort wird dAS Ergebniss mit Ajax weiterverarbeitet
echo json_encode($reply);
mysql_close ( $link );
?>
