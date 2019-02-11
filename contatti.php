<?php
    require_once('php/functions.php');	//è un include di function
    $contentActualPage=file_get_contents('content/contatti.html');
    BuildPage("Contatti",$contentActualPage);	//funzione di buildpage dentro al file function
?>