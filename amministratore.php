<?php
require_once('php/functions.php');
require_once('./database/connessione.php');

//tutte le query
// $categorieCuffie=mysqli_query($conn,"SELECT DISTINCT Categoria FROM Cuffie");
// $categorieCasse=mysqli_query($conn,"SELECT DISTINCT Categoria FROM Casse");
// $categorieAccessori=mysqli_query($conn,"SELECT DISTINCT Categoria FROM Accessori");
$allCategory=mysqli_query($conn,
"SELECT DISTINCT Categoria FROM Cuffie
UNION
SELECT DISTINCT Categoria FROM Casse
UNION
SELECT DISTINCT Categoria FROM Accessori
");
//controllo consistenza query
// foreach($allCategory as $shit){
//     echo $shit["Categoria"];
// }

function insertCategoryInSelect($contentActualPage,$allCategory){
    foreach($allCategory as $shit){
        $contentActualPage=$contentActualPage.
        '<option value="'.$shit["Categoria"].'">'.$shit["Categoria"].'</option>';
    }
    return $contentActualPage;
}

function insertProductsInSelect($conn,$selectedCategory,$contentActualPage){
    echo $selectedCategory;
    $selectedProductsFromCategory=mysqli_query($conn,
    "SELECT Modello  FROM Cuffie WHERE Categoria='".$selectedCategory."'
    UNION
    SELECT Modello  FROM Casse WHERE Categoria='".$selectedCategory."'
    UNION
    SELECT Modello  FROM Accessori WHERE Categoria='".$selectedCategory."'
    ");
    foreach($selectedProductsFromCategory as $shit){
        $contentActualPage=$contentActualPage.
        '<option value="'.$shit["Modello"].'">'.$shit["Modello"].'</option>';
    }
    return $contentActualPage;
}

// function insertNameInSelect($conn,$contentActualPage,$selectedProductFromCategory){
    
// }

$contentActualPage='
<div class="titlePage">
    <h1>Amministratore</h1>
</div>
<div id="administratorPage">
    <div class="modifyProductsList">
    <h3>Aggiungi un prodotto</h3>
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
        
        <input class="formBtn" type="submit" value="Aggiungi">
    </form>

    <h3>Elimina un prodotto</h3>

    categoria
        <form method="post" >
        <select name="categoriaN" >';
            $contentActualPage=insertCategoryInSelect($contentActualPage,$allCategory);
            $contentActualPage=$contentActualPage.
        '</select>
        <br><br>
        <input type="submit" name="categoria" value="cerca">
    </form>';
    

    if(isset($_POST["categoria"])){
        $selectedCategory=$_POST["categoriaN"];
        echo $selectedCategory;
        $contentActualPage=$contentActualPage.
        'nome
        <form action="/action_page.php">
        <select name="Nome">';
            $contentActualPage=insertProductsInSelect($conn,$selectedCategory,$contentActualPage);
            //controllo consistenza query
            // foreach($selectedProductFromCategory as $shit){
            //     echo ("EESVBSBWTRSBRTNN");
            //     // echo $shit["Modello"];
            // }


            // $contentActualPage=insertNameInSelect($contentActualPage,$selectedProductFromCategory)
            // <option value="volvo">Volvo</option>
            // <option value="saab">Saab</option>
            // <option value="fiat">Fiat</option>
            // <option value="audi">Audi</option>
        $contentActualPage=$contentActualPage.
        '</select>
        <br><br>
        <input type="submit" value="elimina">
        </form>';
    }




    $contentActualPage=$contentActualPage.
    '<h3>Modifica un prodotto</h3>

    categoria
    <form action="/action_page.php">
        <select name="Categoria">';
            $contentActualPage=insertCategoryInSelect($contentActualPage,$allCategory);
            $contentActualPage=$contentActualPage.
        '</select>
        <br><br>
        <input type="submit" value="cerca">
    </form>
    
    nome
    <form action="/action_page.php">
        <select name="Nome">
            <option value="volvo">Volvo</option>
            <option value="saab">Saab</option>
            <option value="fiat">Fiat</option>
            <option value="audi">Audi</option>
        </select>
        <br><br>
        <input type="submit" value="cerca">
    </form>

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
BuildPage("Amministratore",$contentActualPage);
?>