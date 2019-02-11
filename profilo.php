<?php
    require_once('php/functions.php');	//è un include di function
    if(!isset($_SESSION["sessionUserId"])){
        $contentActualPage='
        <div class="titlePage">
            <h1>Profilo</h1>
        </div>
        <div class="carrelloVuoto">
            <h3>Non sei loggato</h3>
            <p>Non puoi visualizzare le informazioni del tuo profilo perche\' non sei loggato </p>
        </div>';
    }else{
        $contentActualPage=file_get_contents('content/profilo.html');
    }
    BuildPage("Profilo",$contentActualPage);	//funzione di buildpage dentro al file function
?>