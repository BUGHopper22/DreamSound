

<?php
require_once('php/functions.php');
require_once('./database/connessione.php');



// if(sei amministratore)

//_____________________________________MODIFICA PRODOTTO
    $contentActualPage=
    '<div class="titlePage">
        <h1>Modifica prodotto</h1>
    </div>
    
    <div id="administratorPage">
         <div class="adminContainer">';
    // <p>categoria</p>;

    // <!-- SCELTA DELLA CATEGORIA -->
    if(!isset($_POST["categoria"]) and !isset($_POST["nome"]) and !isset($_POST["attributo"]) and !isset($_POST["modify"])){
        $contentActualPage.='
            <p>Cerca categoria</p>
            <form method="post">
                <select name="categoria">';
                    $allCategory=allCategory($conn);
                    $contentActualPage=insertCategoryInSelect($contentActualPage,$allCategory);
                    $contentActualPage=$contentActualPage.
                '</select>
                <br><br>
                <input class="formBtn" type="submit" value="cerca">
            </form>
     ';
    }
    // SCELTA DEL  MODELLO
    if(isset($_POST["categoria"]) and !isset($_POST["nome"])){
        $_SESSION["categoria"]=$_POST["categoria"];
        // $selectedCategory=$_POST["categoriaN"];
        $contentActualPage.='<p> 1. Categoria scelta: "'.$_SESSION["categoria"].'"</p>
        <p>Cerca per nome </p>
        <form method="post">
            <select name="nome">';
                $contentActualPage=insertProductsInSelect($conn,$_SESSION["categoria"],$contentActualPage);
                $contentActualPage.=
            '</select>
            <br><br>
            <input class="formBtn" type="submit" name="submit2" value="seleziona">
        </form>';
    }
    // SCELTA ATTRIBUTO DA MODIFICARE
    if( isset($_POST["nome"])){
        $_SESSION["modello"]=$_POST["nome"];
        $contentActualPage.='
        <div class="modifyProductsList">
            <p> 1. Categoria scelta: "'.$_SESSION["categoria"].'"</p>
            <p> 2. Modello scelto: "'.$_SESSION["modello"].'"</p>
            <p> 3. Modifica campo: </p>
            <form class="formAdmin" method="post">
                <select name="attributo">
                    <option value="Modello">modello</option>
                    <option value="Marca">marca</option>
                    <option value="Prezzo">prezzo</option>
                    <option value="Url_immagine">url immagine</option>
                    <option value="Descrizione">descrizione</option>
                    <option value="Visibile">visibile</option>
                </select>
                <br><br>
                <input class="formBtn" type="submit" name="submit3" value="seleziona">
            </form>
        </div>';
    }
// MODIFICA VERA E PROPRIA
    if(isset($_POST["attributo"])){
        $_SESSION["attributo"]=$_POST["attributo"];
        $contentActualPage.='
        <div class="modifyProductsList">
            <p> 1. Categoria scelta: "'.$_SESSION["categoria"].'"</p>
            <p> 2. Modello scelto: "'.$_SESSION["modello"].'"</p>
            <p> 3. Attenzione, stai per andare a modificare l\'attributo "'.$_SESSION["attributo"].'" del prodotto "'.$_SESSION["modello"].'"</p>';
            if($_SESSION["attributo"]=="Visibile"){
                $contentActualPage.='
                <p> 4. Modifica il campo </p>
                <form class="formAdmin" method="post">
                    <select name="modify">
                        <option value="1"> true </option>
                        <option value="0"> false </option>
                    </select>
                    <br><br>
                    <input type="submit" name="submit3" value="seleziona">
                </form>';
            }else{
                $contentActualPage.='
                <p> 4. Inserisci qui la modifica </p>
                <form class="formAdmin" method="post">
                    <input type="text" name="modify">
                    <br><br>
                    <input class="formBtn" type="submit" name="submit4" value="modifica">
                </form>';
            }
        $contentActualPage.='</div>';
    }
    
    if(isset($_POST["modify"])){
        $_SESSION["value"]=$_POST["modify"];
        $messaggio=queryModifyProduct($conn,$_SESSION["categoria"],$_SESSION["modello"],$_SESSION["attributo"],$_SESSION["value"]);
        $contentActualPage.=
        '<p>"'.$messaggio.'"</p>
        <a class="button" href="./amministratore.php">
            Torna alla pagina amministratore
        </a>';
    }
    
    $contentActualPage.='</div>
    </div>';

BuildPage("Modifica prodotto",$contentActualPage);
?>