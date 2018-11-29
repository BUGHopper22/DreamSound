<?php

    // if(isset($_REQUEST["modello"])){
    //     echo ("modello è definito");
        $modello=$_REQUEST["modello"];
        $marca=$_REQUEST["marca"];
        $img=$_REQUEST["img"];
        $descrizione=$_REQUEST["descrizione"];
        $prezzo=$_REQUEST["prezzo"];
        $categoria=$_REQUEST["categoria"];
        
    // }
    // else
    //     echo("modello non è definito");



    $contentActualPage='
    <div id="productContainer">
    <h1>'.$modello.'</h1>
        <div class="imgContainer">
            <img class="productImg" src="./img/prodotti/'.$img.'" alt="'.$modello.'" >
        </div>
        <div class="product">
            <p>
                Marca: '.$marca.'<br>
                Descrizione: '.$descrizione.'<br>
            </p>
        </div>
        <div class="buyContainer">
            <div class="productPrice">
                <h3>Pezzo: '.$prezzo.'</h3>
            </div>
            <a class="compra" href="">
                <p>Aggiungi al carrello</p>
            </a>
        </div>
    </div>';
    require_once('php/functions.php');	//è un include di function
    BuildPage($modello,$contentActualPage);	//funzione di buildpage dentro al file function
?>