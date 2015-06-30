<?php
if (! isset ( $_SESSION )) {
	SESSION_START ();
}
if (array_key_exists ( 'login', $_SESSION ) == 0) {
	# User ist nicht eingeloggt, also Formular anzeigen, die Datenbank
	# schliessen und das Programm beenden
	
	header ( 'location: index.php' );
	mysql_close ( $link );
	exit ();
} else {
	#header('location: ladenansicht.php');

}

?>