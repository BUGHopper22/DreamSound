<?php
session_start();
require_once "../../database/connessione.php";
if(isset($_REQUEST["idProdotto"]))
    $idProdotto=$_REQUEST["idProdotto"];

$checkExistProduct="SELECT * FROM Carrello WHERE Username = '".$_SESSION["sessionUserId"]."' and Id_p = '".$idProdotto."' ";
$result = $conn->query($checkExistProduct);
$count= mysqli_num_rows($result);


if($count==0){//non ha trovato prodotti devo inserire nel db
    $insert="INSERT INTO Carrello (Id_p,Username,Quantita) VALUES ('".$idProdotto."','".$_SESSION["sessionUserId"]."','1') ";
    $conn->query($insert);
}else{//ha trovato prodotti devo aggiornare la quantità
    $array=mysqli_fetch_array($result);
    $Quantita=$array["Quantita"];
    $Quantita=$Quantita+1;
    $aggiornaQuantita="UPDATE Carrello SET Quantita = '".$Quantita."' WHERE Username = '".$_SESSION["sessionUserId"]."' and  Id_p = '".$idProdotto."' " ;
    $conn->query($aggiornaQuantita);
}

//CODICE SPARTANO NON TOCCARE
//----------------------------------------
$paginadaricordare=$_SESSION["PAGINA"];//-
unset($_SESSION["PAGINA"]);            //-
header("location:".$paginadaricordare);//-
//----------------------------------------


?>