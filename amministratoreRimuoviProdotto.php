


<?php
require_once('php/functions.php');
require_once('./database/connessione.php');


// if(sei amministratore)



//_____________________________________ELIMINA PRODOTTO
    $contentActualPage=
    '<div class="titlePage">
        <h1>Rimuovi prodotto</h1>
    </div>
<div id="administratorPage">
    cerca per categoria categoria
    <form method="post" >
        <select name="categoriaN" >';
        $allCategory=allCategory($conn);
            $contentActualPage=insertCategoryInSelect($contentActualPage,$allCategory);
            $contentActualPage.=
        '</select>
        <br><br>
        <input type="submit" name="categoria" value="cerca">
    </form>';
    

    if(isset($_POST["categoria"])){
        $_SESSION["categoriaN"]=$_POST["categoriaN"];
        echo  $_SESSION["categoriaN"];
        if(isset($_POST["categoriaN"]))echo("categoria ok");
        $contentActualPage.=
        'cerca per nome
        <form method="post">
            <select name="Nome">';

                $contentActualPage=insertProductsInSelect($conn,$_SESSION["categoriaN"],$contentActualPage);
                $contentActualPage.=
            '</select>
            <br><br>
            <input type="submit" name="elimina" value="elimina">
        </form>';
    }

    if(isset($_POST["elimina"])){
        $selectedProduct=$_POST["Nome"];
        $messaggio=queryDeleteProduct($conn, $_SESSION["categoriaN"],$selectedProduct);
        echo ($messaggio);
    }

    BuildPage("Rimuovi prodotto",$contentActualPage);
    ?>