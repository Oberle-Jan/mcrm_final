<?php
include 'dbconnect.php';
$knr = $_GET ['id1'];
$sql = "SELECT * From kunde WHERE Kundennummer ='$knr'";
$res = mysql_query ( $sql );
// Erstellen des Arrays reply mit den Kunden-Objekten aus der Datenbank
$row = mysql_fetch_assoc ( $res );

// �bergeben des ergebniss-arrays an einzelne variablen
$verkaeufer = $_SESSION ['user'] ['Nutzername'];
$vname = $row ['Vorname'];
$nname = $row ['Nachname'];
$umsatz = $row ['Durchschnittsumsatz'];
$prio = $row ['kundenklasse_Kundenklasse'];
$pic = $row ['Pic'];


// name des favorisierten verk�ufers
$sql = "SELECT verk�ufer.Vorname, verk�ufer.Nachname FROM verk�ufer where verk�ufer.Mitarbeiternummer in ( SELECT verk�ufer_Mitarbeiternummer From verk�uferzukunde WHERE kunde_Kundennummer ='$knr')";
$res = mysql_query ( $sql );
// Erstellen des Arrays reply mit den Kunden-Objekten aus der Datenbank
$row = mysql_fetch_assoc ( $res );
$favvk=$row ['Vorname']." ".$row['Nachname'];

if(empty($favvk)){
	$favvk = 'Bislang keiner!';
}

// wird bei der Navigation gebraucht um beim Verlassen der Beratungsansicht wieder zum Kunden
// gespr�ch zur�ckkehren zu k�nnen
$_SESSION ["zugewiesen"] = $knr;

// Anwesenheit des Verk�ufers auf 3=im Gespr�ch setzen; wird f�r die Verf�gbarkeit von Verk�ufern in der Ladenansicht ben�tigt
$sql = "UPDATE verk�ufer SET InStore=3 WHERE Mitarbeiternummer=" . $_SESSION ["user"] ["Mitarbeiternummer"];
mysql_query ( $sql, $link );

// Anwesenheit des Kunden auf 3=im Gespr�ch setzen; wird f�r die Kundenliste in der Ladenansicht ben�tigt
$sql = "UPDATE kunde SET Kunde_InStore=3 WHERE Kundennummer='$knr'";
mysql_query ( $sql, $link );

// Abfrage f�r Sonderrabatte
$sql = "SELECT sonderaktionen.Rabatt FROM kunde, sonderaktionen WHERE kunde.sonderaktionen_Sonderaktionnummer = sonderaktionen.Sonderaktionnummer AND kunde.Kundennummer = '$knr'";
$res = mysql_query ( $sql, $link );
$row = mysql_fetch_assoc ( $res );
$rabatt = $row ['Rabatt'];

?>