<?php
// Anzeige für die Navigationsleiste, ob ein user eingeloggt ist, bzw welcher
IF (isset ( $_SESSION )) {
	echo "Eingeloggt als: " . $_SESSION ['user'] ['Nutzername'];
	
	//Ein Nutzer hat sich eingeloggt - dies muss nun der Navigation mitgeteilt werden ;-)
	$eingeloggt=1;
	if($_SESSION['admin']==1){
		//der eingeloggt Nutzer ist ein Admin - auch dies interessiert die Navigation
		$role=1;	
	}else{
		//Dieser Nutzer ist kein Admin, wie gehabt möchte die Navigation darüber informiert werden
		$role=0;
	}
	//Hier bekommt nun die Navigation endlich ihre Nachricht, ob der User ein Admin ist, oder nicht:
	echo('<script type="text/javascript">var rolle='.$role.';</script>');	
} else {
	echo "nicht eingeloggt";
	//Da niemand mehr eingeloggt ist, muss die Navigation davon Kenntnis erhalten
	$eingeloggt=0; 
	//Da der "übliche" Weg nicht funktioniert, muss Javascript an dieser Stelle etwas ausgetrickst werden: 
	echo('<script type="text/javascript">$("#menuLogut").hide();</script>');
	
}
//Und zu guter Letzt, noch eine Nachricht an die Navigation: "Hey, ein Nutzer ist eingeloggt" - oder eben nicht. 
echo ('<script type="text/javascript"> var eingeloggt='.$eingeloggt.';</script>');


//Übergeben der Session variable zugewiesen, an javascript für Navigationslogik
if (isset($_SESSION['zugewiesen'])){
	$zuknr= $_SESSION ["zugewiesen"];
	echo('<script type="text/javascript">var zuknr='.$zuknr.';</script>');}
?>