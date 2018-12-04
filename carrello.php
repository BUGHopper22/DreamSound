<?php
require_once('php/functions.php');
require_once ('./database/connessione.php');

$userName=$_SESSION["sessionUserId"];
$userHasProducts =  mysqli_query($conn,"SELECT Id_p From Carrello WHERE Username='".$userName."' ");
    $countProductsUser=mysqli_num_rows($userHasProducts);
    // echo $countProductsUser;
// $sql = "SELECT * FROM id_prodotti JOIN casse JOIN cuffie JOIN acessori JOIN carrello
//  		WHERE '".$userName."' = Username AND Id_prodotto = Id_p;


$chartProducts= mysqli_query($conn,"SELECT * FROM Accessori a,Carrello c WHERE c.Username='".$userName."' and a.Id_p=c.Id_p
                                    UNION
                                    SELECT * FROM Cuffie cu,Carrello c WHERE c.Username='".$userName."' and cu.Id_p=c.Id_p
                                    UNION
                                    SELECT * FROM Casse ca,Carrello c WHERE c.Username='".$userName."' and ca.Id_p=c.Id_p");

buildChartContent($chartProducts,$countProductsUser);

function sumPriceChart($chartProducts){
    $tot=0;
    foreach($chartProducts as $lista){
        $tot=$tot+($lista["Prezzo"]*$lista["Quantita"]);
    }
    return $tot;
}

function buildChartContent($chartProducts,$countProductsUser){
    
    if($countProductsUser==0){
        $contentActualPage="Il carrello è  vuoto";
        BuildPage("Carrello",$contentActualPage);
    }else{
        $contentActualPage='
        <div class="titlePage">
            <h1>Carrello</h1>
        </div>';
        //CODICE SPARTANO NON TOCCARE
        //--------------------------------------------
        $paginadaricordare=$_SERVER["REQUEST_URI"];//-
        $_SESSION["PAGINA"]=$paginadaricordare;    //-
        //----
        foreach($chartProducts as $lista){
            $contentActualPage=$contentActualPage.'
            <div id="carrello">
            <div class="carrelloImgContainer">
                <img class="carrelloImg" src="./img/prodotti'.$lista["Url_immagine"].'" alt="prodotto1">
            </div>
            <div class="carrelloDescriptionContainer">
                <h3>'.$lista["Modello"].'</h3>
                <p class="carrelloDescription">'.$lista["Descrizione"].'</p>
                <div class="quantity">
                    <p>Quantita: '.$lista["Quantita"].'</p>';
                    if($lista["Quantita"]>1){
                        $contentActualPage=$contentActualPage.'
                        <a class="quantityBotton" href="php/carrello/quantityProduct.php?idProdotto='.$lista["Id_p"].'&type=-1">
                            <p>-</p>
                        </a>';
                    }
                    $contentActualPage=$contentActualPage.'
                    <a class="quantityBotton" href="php/carrello/quantityProduct.php?idProdotto='.$lista["Id_p"].'&type=1">
                        <p>+</p>
                    </a>
                </div>
                
                
                <div class="productPrice">'.$lista["Prezzo"].' euro</div>
                
                
                <a class="removeBotton" href="php/carrello/removeProduct.php?idProdotto='.$lista["Id_p"].'"><p>Rimuovi</p></a>
            </div>';
        }
        $contentActualPage=$contentActualPage.'
        <div class="totalPriceContainer">
            <h3 class="totalPrice">Totale: '.sumPriceChart($chartProducts).'</h3>
            <a class="removeBotton" href="php/carrello/buyProducts.php"><p>acquista</p></a>
        </div></div>';
            
        BuildPage("Carrello",$contentActualPage);	//funzione di buildpage dentro al file function
    }

}













?>