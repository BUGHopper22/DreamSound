<?php
require_once('php/functions.php');
require_once('./database/connessione.php');

// if("sei amministratore"){
$contentActualPage=file_get_contents('content/amministratore.html');
// }else{
//     echo ("non sei amministratore, torna al sito");
// }

BuildPage("Amministratore",$contentActualPage);
?>