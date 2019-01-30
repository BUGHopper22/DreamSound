<?php
    if(isset($_REQUEST["logout"])){
        $logout=$_REQUEST["logout"];
        if( $logout == 1){
            session_start();
            session_destroy();
        }
    }
    require_once('php/functions.php');	//è un include di function
    $contentActualPage=file_get_contents('content/index.html');
    BuildPage("Home",$contentActualPage);	//funzione di buildpage dentro al file function
?>