<?php
require "./database/connessione.php";
require_once('php/functions.php');
    if(isset($_REQUEST["idProdotto"]) && isset($_REQUEST["titleTable"])){
        $idProdotto=$_REQUEST["idProdotto"];
        $titleTable=$_REQUEST["titleTable"];
        $result = $conn->query("SELECT * FROM `{$titleTable}` WHERE Id_p='".$idProdotto."' ");
    }
    $count = mysqli_num_rows($result);
    // echo $count;

    $array=mysqli_fetch_array($result);
        $modello=$array["Modello"];
        $marca=$array["Marca"];
        $img=$array["Url_immagine"];
        $descrizione=$array["Descrizione"];
        $prezzo=$array["Prezzo"];
        $idProdotto=$array["Id_p"];


    $contentActualPage='
    <div class="titlePage">
        <h1>'.$modello.'</h1>
    </div>
    <div id="productContainer">
        <div class="imgContainer">
            <img class="productImg" src="./img/prodotti/'.$img.'" alt="'.$modello.'" >
        </div>
        <div class="descriptionContainer">
        <div class="product">
            <p>
                Marca: '.$marca.'<br>
                Descrizione: '.$descrizione.'<br>
            </p>
        </div>
        <div class="buyContainer">
            <div class="productPrice">
                <h3>Pezzo: '.$prezzo.'€</h3>
            </div>';

            //CODICE SPARTANO NON TOCCARE
            //--------------------------------------------
            $paginadaricordare=$_SERVER["REQUEST_URI"];//-
            $_SESSION["PAGINA"]=$paginadaricordare;    //-
            //--------------------------------------------
            if(isset($_SESSION["sessionUserId"] )){
                $checkIfYetInChart=mysqli_query($conn,"SELECT * FROM Carrello WHERE Username = '".$_SESSION["sessionUserId"]."' and Id_p = '".$idProdotto."' ");
                $countCheck=mysqli_num_rows($checkIfYetInChart);
            
                if($countCheck>0){
                    $contentActualPage=$contentActualPage.'<a class="button" href="./carrello.php">Vai al carrello</a>';
                }else{
                    $contentActualPage=$contentActualPage.'<a class="button" href="./php/carrello/addChart.php?idProdotto='.$idProdotto.'">Aggiungi al carrello</a>';
                }
            }else{//non sono loggato
                $contentActualPage=$contentActualPage.'<a class="button" href="./login.php">Logga per acquistare</a>';
            }
            
            
            
    $contentActualPage=$contentActualPage.'</div></div></div>';

    BuildPage($modello,$contentActualPage);	//funzione di buildpage dentro al file function
?>