

<?php
require_once('php/functions.php');
require_once('./database/connessione.php');



// if(sei amministratore)

//_____________________________________MODIFICA PRODOTTO
    $contentActualPage=
    '<div class="titlePage">
        <h1>Modifica prodotto</h1>
    </div>
    categoria
    <form action="/action_page.php">
        <select name="Categoria">';
            $allCategory=allCategory($conn);
            $contentActualPage=insertCategoryInSelect($contentActualPage,$allCategory);
            $contentActualPage=$contentActualPage.
        '</select>
        <br><br>
        <input type="submit" value="cerca">
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
    $contentActualPage.='
    <div class="modifyProductsList">
        <form class="formAdmin" method="post">
            <p>prezzo:</p>
            <input type="text" name="prezzo" placeholder="inserisci il prezzo" >
            <p>marca:</p>
            <input type="text" name="marca" placeholder="inserisci la marca" >
            <p>modello:</p>
            <input type="text" name="modello" placeholder="inserisci il modello" >
            <p>url immagine:</p>
            <input type="text" name="urlImg" placeholder="inserisci url immagine" >
            <p>Descrizione:</p>
            <input type="text" name="descrizione" placeholder="inserisci una descrizione" >
    
            <input class="formBtn" type="submit" value="modifica">
        </form>

    </div>
</div>';

BuildPage("Modifica prodotto",$contentActualPage);
?>