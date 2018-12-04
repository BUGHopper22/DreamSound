<?php
session_start();
require_once "../../database/connessione.php";

if(isset($_REQUEST["idProdotto"]))
    $idProdotto=$_REQUEST["idProdotto"];
$u=mysqli_query($conn,"SELECT Quantita FROM Carrello WHERE Username = '".$_SESSION["sessionUserId"]."' and Id_p = '".$idProdotto."' ");
if(isset($_REQUEST["type"]) ){
    $type=$_REQUEST["type"];
    echo ("entra");
    $array=mysqli_fetch_array($u);
    $Quantita=$array["Quantita"];
    if($type==1){
        $Quantita=$Quantita+1;
    }else if($type==-1){
        $Quantita=$Quantita-1;
    }
    $aggiornaQuantita="UPDATE Carrello SET Quantita = '".$Quantita."' WHERE Username = '".$_SESSION["sessionUserId"]."' and  Id_p = '".$idProdotto."' " ;
    $conn->query($aggiornaQuantita);
}

// $count= mysqli_num_rows($result);




    



//CODICE SPARTANO NON TOCCARE
//----------------------------------------
$paginadaricordare=$_SESSION["PAGINA"];//-
unset($_SESSION["PAGINA"]);            //-
header("location:".$paginadaricordare);//-
//----------------------------------------


?>