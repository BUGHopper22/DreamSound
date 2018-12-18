<?php
require_once('php/functions.php');
require_once('./database/connessione.php');

// if("sei amministratore"){
$contentActualPage='
<div class="titlePage">
    <h1>Amministratore</h1>
</div>
<div class="outer">
    <a class="button" href="./amministratoreAggiungiProdotto.php"><p>Aggiungi un prodotto</p></a>
    <a class="button" href="./amministratoreRimuoviProdotto.php"><p>Rimuovi un prodotto</p></a>
    <a class="button" href="./amministratoreModificaProdotto.php"><p>modifica un prodotto</p></a>
</div>';
// }else{
//     echo ("non sei amministratore, torna al sito");
// }

BuildPage("Amministratore",$contentActualPage);
?>