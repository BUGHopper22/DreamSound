<?php
require_once('php/functions.php');	//è un include di function
$contentActualPage=
'<div id="notFound">
    <div class="inner">
        <h1>manca la connesione al server</h1>
        <a class="button" href="index.php">Torna alla home!</a>
    </div>
</div>';
BuildPage("No server",$contentActualPage);	//funzione di buildpage dentro al file function
// echo("manca la connessione al server");
?>