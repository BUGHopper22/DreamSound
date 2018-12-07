


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
        $selectedCategory=$_POST["categoriaN"];
        $contentActualPage.=
        'cerca per nome
        <form method="post">
            <select name="Nome">';
                $contentActualPage=insertProductsInSelect($conn,$selectedCategory,$contentActualPage);
                $contentActualPage.=
            '</select>
            <br><br>
            <input type="submit" name="elimina" value="elimina">
        </form>';
    }
    if(isset($_POST["elimina"])){
        $selectedProduct=$_POST["Nome"];
        queryDeleteProduct($conn,$selectedProduct);
        echo ("query della delete non definita perche altrimenti elimino tutti i prodotti nel provarla");
    }

    BuildPage("Rimuovi prodotto",$contentActualPage);
    ?>