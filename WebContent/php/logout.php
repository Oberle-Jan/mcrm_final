<?php
include 'dbconnect.php';
# UNBEDINGT NOCH INSTORE auf 0 setzen

// Anwesenheit des Verk�ufers auf 0 setzen; wird f�r die Verf�gbarkeit von Verk�ufern in der Ladenansicht ben�tigt
$sql = "UPDATE verk�ufer SET InStore=0 WHERE Mitarbeiternummer=" . $_SESSION ["user"] ["Mitarbeiternummer"];
mysql_query ( $sql, $link );


#l�schen der user session 
session_destroy();

header('Location: ../index.php');
mysql_close ( $link );
?>