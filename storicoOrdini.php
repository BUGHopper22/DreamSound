<?php
require_once('php/functions.php');
require_once ('./database/connessione.php');

// se sei loggato
if(isset($_SESSION["sessionUserId"])){
    $userName=$_SESSION["sessionUserId"];
    $userHasProducts =  mysqli_query($conn,"SELECT Id_p From Storico WHERE Username='".$userName."' ");
    $countProductsUser=mysqli_num_rows($userHasProducts);
    $historyProducts= findHistoryProducts($conn,$userName);
    $contentActualPage=buildHistoryContent($historyProducts,$countProductsUser);
}
// se non sei loggato
else{
    $contentActualPage='
    <div id="storicoOrdini">
        <div class="titlePage">
            <h1>Storico ordini</h1>
        </div>
        <div class="storicoVuoto">
            <p>Non sei loggato, cosa aspetti? <a href="./login.php">login</a></p>
        </div>
    </div>';
}
BuildPage("Storico ordini",$contentActualPage);	//funzione di buildpage dentro al file function





?>