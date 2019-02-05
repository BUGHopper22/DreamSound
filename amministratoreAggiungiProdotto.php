<?php
require_once('php/functions.php');
require_once('./database/connessione.php');




// if(sei amministratore)

$contentActualPage='
<div class="titlePage">
    <h1>Aggiungi prodotto</h1>
</div>
<div id="administratorPage">';

//_____________________________________AGGIUNGI PRODOTTO
    $contentActualPage.=
    '<div class="modifyProductsList">
    <h3>Aggiungi un prodotto</h3>
    <form class="formAdmin" method="post">
        <p>categoria:</p>
        <select name="categoria" >';
            $allCategory=allCategory($conn);
            $contentActualPage=insertCategoryInSelect($contentActualPage,$allCategory);
            $contentActualPage.=
        '</select>
        <p>modello:</p>
        <input type="text" name="modello" placeholder="inserisci il modello" >
        <p>marca:</p>
        <input type="text" name="marca" placeholder="inserisci la marca" >
        <p>prezzo:</p>
        <input type="text" name="prezzo" placeholder="inserisci il prezzo" >
        
        <p>url immagine:</p>
        <input type="text" name="urlImg" placeholder="inserisci url immagine" >
        <p>Descrizione:</p>
        <input type="text" name="descrizione" placeholder="inserisci una descrizione" >
        
        <input class="formBtn" type="submit" name="submit" value="Aggiungi">
    </form>';
    
    if(isset($_POST["submit"])){
        echo("hai cliccato su submit");
        $categoria=$_POST["categoria"];
        $modello=$_POST["modello"];
        $marca=$_POST["marca"];
        $prezzo=$_POST["prezzo"];
        $urlImg=$_POST["urlImg"];
        $descrizione=$_POST["descrizione"];
        $messaggio=queryAddProduct($conn,$categoria,$modello,$marca,$prezzo,$urlImg,$descrizione);
        echo($messaggio);
    }







BuildPage("Aggiungi prodotto",$contentActualPage);
?>