<?php
    require_once('php/functions.php');	//è un include di function
    $contentActualPage=file_get_contents('content/profilo.html');
    BuildPage("Profilo",$contentActualPage);	//funzione di buildpage dentro al file function
?>