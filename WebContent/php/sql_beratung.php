<?php
include 'dbconnect.php';
$knr = $_GET ['id1'];
$sql = "SELECT * From kunde WHERE Kundennummer ='$knr'";
$res = mysql_query ( $sql );
// Erstellen des Arrays reply mit den Kunden-Objekten aus der Datenbank
$row = mysql_fetch_assoc ( $res );

// übergeben des ergebniss-arrays an einzelne variablen
$verkaeufer = $_SESSION ['user'] ['Nutzername'];
$vname = $row ['Vorname'];
$nname = $row ['Nachname'];
$umsatz = $row ['Durchschnittsumsatz'];
$prio = $row ['kundenklasse_Kundenklasse'];
$pic = $row ['Pic'];


// name des favorisierten verkäufers
$sql = "SELECT verkäufer.Vorname, verkäufer.Nachname FROM verkäufer where verkäufer.Mitarbeiternummer in ( SELECT verkäufer_Mitarbeiternummer From verkäuferzukunde WHERE kunde_Kundennummer ='$knr')";
$res = mysql_query ( $sql );
// Erstellen des Arrays reply mit den Kunden-Objekten aus der Datenbank
$row = mysql_fetch_assoc ( $res );
$favvk=$row ['Vorname']." ".$row['Nachname'];

if(empty($favvk)){
	$favvk = 'Bislang keiner!';
}

// wird bei der Navigation gebraucht um beim Verlassen der Beratungsansicht wieder zum Kunden
// gespräch zurückkehren zu können
$_SESSION ["zugewiesen"] = $knr;

// Anwesenheit des Verkäufers auf 3=im Gespräch setzen; wird für die Verfügbarkeit von Verkäufern in der Ladenansicht benötigt
$sql = "UPDATE verkäufer SET InStore=3 WHERE Mitarbeiternummer=" . $_SESSION ["user"] ["Mitarbeiternummer"];
mysql_query ( $sql, $link );

// Anwesenheit des Kunden auf 3=im Gespräch setzen; wird für die Kundenliste in der Ladenansicht benötigt
$sql = "UPDATE kunde SET Kunde_InStore=3 WHERE Kundennummer='$knr'";
mysql_query ( $sql, $link );

// Abfrage für Sonderrabatte
$sql = "SELECT sonderaktionen.Rabatt FROM kunde, sonderaktionen WHERE kunde.sonderaktionen_Sonderaktionnummer = sonderaktionen.Sonderaktionnummer AND kunde.Kundennummer = '$knr'";
$res = mysql_query ( $sql, $link );
$row = mysql_fetch_assoc ( $res );
$rabatt = $row ['Rabatt'];

?>