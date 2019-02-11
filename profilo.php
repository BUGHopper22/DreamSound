<?php
    require_once('php/functions.php');	//è un include di function
    if(!isset($_SESSION["sessionUserId"])){
        $contentActualPage='
        <div class="titlePage">
            <h1>Profilo</h1>
        </div>
        <div class="carrelloVuoto">
            <h3>Non sei loggato</h3>
            <p>Non puoi visualizzare le informazioni del tuo profilo perche\' non sei loggato </p>
        </div>';
    }else{
        $contentActualPage=file_get_contents('content/profilo.html');
        //sostituzione dati inline per velocità:
        $result= mysqli_query($conn,"SELECT Nome,Cognome,Email FROM Utente WHERE Username='".$_SESSION["sessionUserId"]."' ");
        $result=mysqli_fetch_array($result);
        $name=$result["Nome"];
        $surname=$result["Cognome"];
        $email=$result["Email"];
        
        $contentActualPage=str_replace('{name}',$name,$contentActualPage);
        $contentActualPage=str_replace('{surname}',$surname,$contentActualPage);
        $contentActualPage=str_replace('{username}',$_SESSION["sessionUserId"],$contentActualPage);
        $contentActualPage=str_replace('{email}',$email,$contentActualPage);
    }
    BuildPage("Profilo",$contentActualPage);	//funzione di buildpage dentro al file function
?>