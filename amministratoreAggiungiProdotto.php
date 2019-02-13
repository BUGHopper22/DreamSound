<?php
require_once('php/functions.php');
require_once('./database/connessione.php');



function checkSubmitClickedDoQueryAdd($conn){
    if(isset($_POST["submit"])){
        $messaggio="hai cliccato su submit";
        $categoria=$_POST["categoria"];
        $modello=$_POST["modello"];
        $marca=$_POST["marca"];
        $prezzo=$_POST["prezzo"];
        $urlImg=$_POST["urlImg"];
        $descrizione=$_POST["descrizione"];
        $messaggio=queryAddProduct($conn,$categoria,$modello,$marca,$prezzo,$urlImg,$descrizione);
    }else{
        $messaggio="";
    }
    return $messaggio;
}

// if(sei amministratore)
$messaggio=checkSubmitClickedDoQueryAdd($conn);
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


}//non sei amministratore
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