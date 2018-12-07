<?php
require_once('php/functions.php');
require_once ('./database/connessione.php');       

function sumPriceChart($chartProducts){
    $tot=0;
    foreach($chartProducts as $lista){
        $tot=$tot+($lista["Prezzo"]*$lista["Quantita"]);
    }
    return $tot;
}

function withAjax($contentActualPage,$lista){
    echo ("P ");
    if($lista["Quantita"]>1){
        $contentActualPage=$contentActualPage.'
        <a class="quantityBotton" href="php/carrello/quantityProduct.php?idProdotto='.$lista["Id_p"].'&type=-1"> <p>-</p> </a>';
    }
    $contentActualPage=$contentActualPage.'
    <a class="quantityBotton" href="php/carrello/quantityProduct.php?idProdotto='.$lista["Id_p"].'&type=1"> <p>+</p> </a>';
    return $contentActualPage;
}

function withoutAjax($contentActualPage,$lista){
    if($lista["Quantita"]>1){
        $contentActualPage=$contentActualPage.'
        <a class="quantityBotton" href="php/carrello/quantityProduct.php?idProdotto='.$lista["Id_p"].'&type=-1"> <p>-</p> </a>';
    }
    $contentActualPage=$contentActualPage.'
    <a class="quantityBotton" href="php/carrello/quantityProduct.php?idProdotto='.$lista["Id_p"].'&type=1"> <p>+</p> </a>';
    return $contentActualPage;
}

function buildChartContent($chartProducts,$countProductsUser,$contentActualPage){
     
    if($countProductsUser==0){
        $contentActualPage=$contentActualPage."Il carrello è  vuoto";
    }else{
        
        //CODICE SPARTANO NON TOCCARE
        //--------------------------------------------
        $paginadaricordare=$_SERVER["REQUEST_URI"];//-
        $_SESSION["PAGINA"]=$paginadaricordare;    //-
        //----
        foreach($chartProducts as $lista){
            $contentActualPage=$contentActualPage.'
            <div class="carrelloContainer">
                <div class="carrelloImgContainer">
                    <img class="carrelloImg" src="./img/prodotti'.$lista["Url_immagine"].'" alt="prodotto1">
                </div>
                <div class="carrelloDescriptionContainer">
                    <h3>'.$lista["Modello"].'</h3>
                    <p class="carrelloDescription">'.$lista["Descrizione"].'</p>
                    <div class="quantity"> <p>Quantita: '.$lista["Quantita"].'</p>';
                    
                    // $contentActualPage=$contentActualPage.'<script>';
                    $contentActualPage=withAjax($contentActualPage,$lista);
                    // $contentActualPage=$contentActualPage.'</script>';

                    // $contentActualPage=$contentActualPage.'<noscript>';
                    // $contentActualPage=withoutAjax($contentActualPage,$lista);
                    // $contentActualPage=$contentActualPage.'</noscript>';


                    $contentActualPage=$contentActualPage.
                    '</div>
                    <div class="productPrice">'.$lista["Prezzo"].'€</div>
                    <a class="button" href="php/carrello/removeProduct.php?idProdotto='.$lista["Id_p"].'"><p>Rimuovi</p></a>
                </div>
            </div>';
        }
        $contentActualPage=$contentActualPage.'
        <div class="totalPriceContainer">
            <h3>Totale: '.sumPriceChart($chartProducts).'</h3>
            <a class="button" href="php/carrello/buyProducts.php"><p>Acquista</p></a>
        </div>';
    } 
    return $contentActualPage;
}
 $contentActualPage='
    <div id="carrello">
        <div class="titlePage">
            <h1>Carrello</h1>
        </div>';

        
if(!isset($_SESSION["sessionUserId"])){
    $contentActualPage=$contentActualPage.'devi loggare per accedere al tuo carrello mona';
}
else{
    $userName=$_SESSION["sessionUserId"];
    $userHasProducts =  mysqli_query($conn,"SELECT Id_p From Carrello WHERE Username='".$userName."' ");
    $countProductsUser=mysqli_num_rows($userHasProducts);
    $chartProducts= mysqli_query($conn,
    "SELECT * FROM Accessori a,Carrello c WHERE c.Username='".$userName."' and a.Id_p=c.Id_p
    UNION
    SELECT * FROM Cuffie cu,Carrello c WHERE c.Username='".$userName."' and cu.Id_p=c.Id_p
    UNION
    SELECT * FROM Casse ca,Carrello c WHERE c.Username='".$userName."' and ca.Id_p=c.Id_p");
    
    $contentActualPage=buildChartContent($chartProducts,$countProductsUser,$contentActualPage);
   
}
$contentActualPage=$contentActualPage.'
    </div>';
BuildPage("Carrello",$contentActualPage);	//funzione di buildpage dentro al file function  













?>