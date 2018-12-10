<?php
    $contentActualPage='
    <div id="notFound">
        <h1>Page not found!</h1> 
    </div>';
    require_once('php/functions.php');	//è un include di function
    BuildPage("Accessori",$contentActualPage);	//funzione di buildpage dentro al file function
?>