<?php
session_start();
    // unset($_SESSION["login"]);
    // unset($_SESSION["USER"]);//cancello la variabile login
    // unset($_SESSION["IDUSER"]);
    // $PAGEU=$_SESSION["page"];
    // unset($_SESSION["page"]);
    // $urlbread=$_SESSION["urlbread"];
    // $ntabbre=$_SESSION["nometabbre"];
    session_destroy();
    require_once('php/functions.php');
    BuildPage("Accessori Cuffie",null);	//funzione di buildpage dentro al file function
    // session_start();
    // $_SESSION["urlbread"]=$urlbread;
    // $_SESSION["nometabbre"]=$ntabbre;
    // //aggiungere session destroy
    // /*if(isset($_REQUEST["PAGE"])) 
    //     $PAGEU=$_REQUEST["PAGE"]; 
    //     trim ($PAGEU);*/
    //     header("location:".$PAGEU);
?>