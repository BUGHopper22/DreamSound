<?php
require_once('php/functions.php');
require_once('./database/connessione.php');

if(isset($_SESSION["sessionAmm"]) and $_SESSION["sessionAmm"]=='1'){
    $contentActualPage=file_get_contents('content/amministratore.html');
}else{
    $contentActualPage=file_get_contents('content/amministratoreError.html');
    // echo ("non sei amministratore, torna al sito");
}

BuildPage("Amministratore",$contentActualPage);
?>