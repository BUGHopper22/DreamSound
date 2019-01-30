<?php
    require_once('php/functions.php');	//è un include di function
    $contentActualPage=file_get_contents('content/cuffie.html');
    BuildPage("Cuffie",$contentActualPage);	//funzione di buildpage dentro al file function
?>