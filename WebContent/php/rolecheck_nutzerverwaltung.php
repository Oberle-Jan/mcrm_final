<?php

#�berpr�fen ob der ein User eingeloggt ist und welcher Rolle er angeh�rt
if (! isset ( $_SESSION )) {
	SESSION_START ();
}

if ($_SESSION ["admin"] != 1) {
	header ( 'location: ladenansicht.php' );
	mysql_close ( $link );
	exit ();
}

?>