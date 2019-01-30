<?php
    require_once('php/functions.php');	//è un include di function
    $contentActualPage=file_get_contents('content/404.html');
    BuildPage("Accessori",$contentActualPage);	//funzione di buildpage dentro al file function
?>