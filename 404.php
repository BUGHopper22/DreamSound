<?php
    $contentActualPage='
    <div id="notFound">
        <div class="inner">
            <h1>Page not found!</h1>
            <a class="button" href="index.php">Torna alla home!</a>
        </div> 
    </div>';
    require_once('php/functions.php');	//è un include di function
    BuildPage("Accessori",$contentActualPage);	//funzione di buildpage dentro al file function
?>