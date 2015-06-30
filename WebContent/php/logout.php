<?php
include 'dbconnect.php';
# UNBEDINGT NOCH INSTORE auf 0 setzen

// Anwesenheit des Verkäufers auf 0 setzen; wird für die Verfügbarkeit von Verkäufern in der Ladenansicht benötigt
$sql = "UPDATE verkäufer SET InStore=0 WHERE Mitarbeiternummer=" . $_SESSION ["user"] ["Mitarbeiternummer"];
mysql_query ( $sql, $link );


#löschen der user session 
session_destroy();

header('Location: ../index.php');
mysql_close ( $link );
?>