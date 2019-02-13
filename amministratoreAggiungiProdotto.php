<?php
require_once('php/functions.php');
require_once('./database/connessione.php');

//controlla se è stato cliccato il submit ritorna il messaggio da stampare, query che aggiunge il prodotto
$messaggio=checkSubmitClickedDoQueryAdd($conn);

// se sei amministratore
if(isset($_SESSION["sessionUserId"])){
    $contentActualPage='
    <div class="titlePage">
        <h1>Aggiungi prodotto</h1>
    </div>
    <div id="administratorPage">
        
        <div class="adminContainer">
        <p class="backgroundRed">'.$messaggio.'</p>
            <form class="formAdmin" method="post">
                <p>Categoria:</p>
                <select name="categoria" >';
                    $allCategory=allCategory($conn);
                    $contentActualPage=insertCategoryInSelect($contentActualPage,$allCategory);
                    $contentActualPage.=
                '</select>
                <p>Modello:</p>
                <input type="text" name="modello" placeholder="inserisci il modello" >
                <p>Marca:</p>
                <input type="text" name="marca" placeholder="inserisci la marca" >
                <p>Prezzo:</p>
                <input type="text" name="prezzo" placeholder="inserisci il prezzo" >
                
                <p>URL immagine:</p>
                <input type="text" name="urlImg" placeholder="inserisci url immagine" >
                <p>Descrizione:</p>
                <input type="text" name="descrizione" placeholder="inserisci una descrizione" >
                
                <input class="formBtn distanceBtn" type="submit" name="submit" value="Aggiungi">
            </form>
        </div>
    </div>';   
}
//non sei amministratore
else{
    $contentActualPage='
    <div class="titlePage">
        <h1>Aggiungi prodotto</h1>
    </div>
    <div id="administratorPage">
        <p>Non sei un amministratore</p>
    </div>';
}




BuildPage("Aggiungi prodotto",$contentActualPage);
?>