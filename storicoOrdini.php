<?php
require_once('php/functions.php');
require_once ('./database/connessione.php');

$userName=$_SESSION["sessionUserId"];
$userHasProducts =  mysqli_query($conn,"SELECT Id_p From Storico WHERE Username='".$userName."' ");
$countProductsUser=mysqli_num_rows($userHasProducts);


$historyProducts= mysqli_query($conn,"SELECT * FROM Accessori a,Storico s WHERE s.Username='".$userName."' and a.Id_p=s.Id_p
                                    UNION
                                    SELECT * FROM Cuffie cu,Storico s WHERE s.Username='".$userName."' and cu.Id_p=s.Id_p
                                    UNION
                                    SELECT * FROM Casse ca,Storico s WHERE s.Username='".$userName."' and ca.Id_p=s.Id_p");
// if(isset($historyProducts)){
// echo ("è definito");
// echo (var_dump($historyProducts));
// };

buildHistoryContent($historyProducts,$countProductsUser);

function qtaPerPrice($lista){
    return $lista["Quantita"]*$lista["Prezzo"];
}

function buildHistoryContent($historyProducts,$countProductsUser){
    
    if($countProductsUser==0){
        $contentActualPage='
        <div id="storicoOrdini">
            <div class="titlePage">
                <h1>Storico ordini</h1>
            </div>
            <div class="storicoVuoto">
                <p>Non hai ancora acquistato nulla, cosa aspetti?</p>
            </div>
        </div>';
        BuildPage("Storico",$contentActualPage);
    }else{
        $contentActualPage='
        <div class="titlePage">
            <h1>Storico Ordini</h1>
        </div>
        <div id="carrello">';
        //CODICE SPARTANO NON TOCCARE
        //--------------------------------------------
        $paginadaricordare=$_SERVER["REQUEST_URI"];//-
        $_SESSION["PAGINA"]=$paginadaricordare;    //-
        //----
        foreach($historyProducts as $lista){
            $contentActualPage=$contentActualPage.'
            <div class="carrelloContainer">
                <div class="carrelloImgContainer">
                    <img class="carrelloImg" src="./img/prodotti'.$lista["Url_immagine"].'" alt="prodotto1">
                </div>
                <div class="carrelloDescriptionContainer">
                    <h3>'.$lista["Modello"].'</h3>
                    <p class="carrelloDescription">'.$lista["Descrizione"].'</p>
                    <div>
                        <p>Data: '.$lista["Data_acquisto"].'</p>
                    </div>
                    <div class="quantity">
                        <p>Quantita: '.$lista["Quantita"].'</p>
                    </div>
                    <div class="productPrice">'.qtaPerPrice($lista).' euro</div>
                </div>
            </div>';
        }
        // $contentActualPage=$contentActualPage.'</div>';




    BuildPage("Storico ordini",$contentActualPage);	//funzione di buildpage dentro al file function
    }
}
?>