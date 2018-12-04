<?php
session_start();
require_once "../../database/connessione.php";



if(isset($_REQUEST["idProdotto"]))
    $idProdotto=$_REQUEST["idProdotto"];


mysqli_query($conn,"DELETE FROM Carrello WHERE Username = '".$_SESSION["sessionUserId"]."' and Id_p = '".$idProdotto."' ");



//CODICE SPARTANO NON TOCCARE
// //----------------------------------------
$paginadaricordare=$_SESSION["PAGINA"];//-
unset($_SESSION["PAGINA"]);            //-
header("location:".$paginadaricordare);//-
// //----------------------------------------


?>