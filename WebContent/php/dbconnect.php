<?php
// zuweißen der Login Konstanten
$db_host = "localhost";
$db_datenbank = "mCRM_Database";
$db_username = "root";
$db_passwort = "pmprojekt";

// start einer Session
if (! isset ( $_SESSION )) {
	SESSION_START ();
}
// Herstellen der Datenbankverbindung
$link = mysql_connect ( $db_host, $db_username, $db_passwort );
mysql_select_db ( $db_datenbank );
mysql_query("SET NAMES 'iso-8859-1'");
// Überprüfen der Verbindung
if (! $link) {
	die ( "Es konnte keine Verbindung zur Datenbank hergestellt werden: " . mysql_error () );
}

// Datenbankschema laden
$datenbank = mysql_select_db ( $db_datenbank, $link );

if (! $datenbank) {
	echo "Datenbank-Schema kann nicht geladen werden: " . mysql_error ();
	mysql_close ( $link ); // Datenbank schliessen
	exit (); // Programm beenden !
}


?>