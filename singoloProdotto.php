<?php
require "./database/connessione.php";
    require_once('php/functions.php');
    // echo $_REQUEST["idProdotto"];
    // echo $_REQUEST["titleTable"];
    if(isset($_REQUEST["idProdotto"]) && isset($_REQUEST["titleTable"])){
        $idProdotto=$_REQUEST["idProdotto"];
        $titleTable=$_REQUEST["titleTable"];
        $result = $conn->query("SELECT * FROM `{$titleTable}` WHERE Id_p='".$idProdotto."' ");
    }
    // echo var_dump($result);
    
    // echo $idProdotto;
    // echo $titleTable;
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
    <h1>'.$modello.'</h1>
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
                    $contentActualPage=$contentActualPage.'<a class="button" href="./carrello.php"><p>già nel carrello</p></a>';
                }else{
                    $contentActualPage=$contentActualPage.'<a class="button" href="./php/carrello/addChart.php?idProdotto='.$idProdotto.'"><p>aggiungi al carrello</p></a>';
                }
            }else{//non sono loggato
                $contentActualPage=$contentActualPage.'<a class="button" href="./login.php"><p>logga per acquistare</p></a>';
            }
            
            
            
    $contentActualPage=$contentActualPage.'</div></div>';

    BuildPage($modello,$contentActualPage);	//funzione di buildpage dentro al file function
?>