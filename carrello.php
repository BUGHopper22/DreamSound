<?php
require_once('php/functions.php');
require_once ('./database/connessione.php');       






// costruisce la pagina carrello
function buildChartContent($chartProducts,$countProductsUser,$contentActualPage){
    $cont=0;
    if($countProductsUser==0){
        $contentActualPage=$contentActualPage.'
        <div class="carrelloVuoto">
            <h3>Il carrello è vuoto</h3>
            <p>Il tuo carrello è vuoto. Per aggiungere articoli al tuo carrello naviga su DreamSound.it, quando trovi un articolo che ti interessa, clicca su "Aggiungi al carrello". </p>
        </div>';
    }else{
        
        //CODICE SPARTANO NON TOCCARE
        //--------------------------------------------
        $paginadaricordare=$_SERVER["REQUEST_URI"];//-
        $_SESSION["PAGINA"]=$paginadaricordare;    //-
        //----
        
        $contentActualPage=insertProductInChart($contentActualPage,$chartProducts,$cont);
        $contentActualPage.='
        <div class="totalPriceContainer">
            <h3>Totale: '.sumPriceChart($chartProducts).'€</h3>
            <a class="button" href="php/carrello/buyProducts.php" tabindex="'.$cont.'">Acquista</a>
        </div>
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
    $contentActualPage=$contentActualPage.'<div class="carrelloVuoto"><p>Devi loggare per accedere al tuo carrello mona</p></div>';
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