


<?php
require_once('php/functions.php');
require_once('./database/connessione.php');

$messaggio=checkSubmitClickedDoQueryRemove($conn);

// sse amministratore
if(isset($_SESSION["sessionUserId"])){
    $contentActualPage=
    '<div class="titlePage">
        <h1>Rimuovi prodotto</h1>
    </div>
    <div id="administratorPage">
        <div class="adminContainer">
            <p class="backgroundRed">'.$messaggio.'</p>
            <p>Cerca per categoria</p>
            <form method="post" >
                <select name="categoriaN" >';
                    $allCategory=allCategory($conn);
                    $contentActualPage=insertCategoryInSelect($contentActualPage,$allCategory);
                    $contentActualPage.=
                '</select>
                <br><br>
                <input class="formBtn" type="submit" name="categoria" value="cerca">
            </form>
            ';
            // sse è stato cliccato il submit di categoria
            if(isset($_POST["categoria"])){
                $_SESSION["categoriaN"]=$_POST["categoriaN"];
                if(isset($_POST["categoriaN"]));
                $contentActualPage.=
                '<p>Cerca per nome</p>
                <form method="post">
                    <select name="Nome">';
                        $contentActualPage=insertProductsInSelect($conn,$_SESSION["categoriaN"],$contentActualPage);
                        $contentActualPage.=
                    '</select>
                    <br><br>
                    <input class="formBtn" type="submit" name="elimina" value="elimina">
                </form>';
            }
    $contentActualPage.='
        </div>   
    </div>';
}
//non sei amministratore
else{
    $contentActualPage='
    <div class="titlePage">
        <h1>Rimuovi prodotto</h1>
    </div>
    <div id="administratorPage">
        <p>Non sei un amministratore</p>
    </div>';
}
    
BuildPage("Rimuovi prodotto",$contentActualPage);    
?>