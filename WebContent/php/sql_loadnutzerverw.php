<?php
#Einbinden der Datenbankverbindung
include 'dbconnect.php';

/*
 * SQL Abfrage f�r die Nutzer, diese sind bei uns untypischer wei�e in der Tabelle Verk�ufer gespeichert
 * Mitarbeiter 100 ist ein l�sch dummy um bei bedarf fremdkeys umzuh�ngen
 */
$sql = "SELECT * From verk�ufer WHERE Mitarbeiternummer != '100'";




# Durchf�hren des SQL befehls und speichern des Ergenisses in $res
$res = mysql_query($sql);
# Erstellen des Arrays reply mit den Kunden-Objekten aus der Datenbank
while ($row = mysql_fetch_assoc($res)) {
	$reply[]=$row;

}


//json_encode funktioniert nicht mit umlauten, hier fehlt noch eine l�sung!
#Das Array via json an die Ladenansicht.js zur�ckgeben, dort wird das Ergebniss mit Ajax weiterverarbeitet
echo json_encode($reply);
mysql_close ( $link );
?>