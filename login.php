<?php
require_once "./database/connessione.php";
require_once "php/functions.php";	//è un include di function



    







$loginError=checkLoginDbAndError($conn);

if(!isset($_SESSION["sessionUserId"])){
    $contentActualPage='
    <div class="titlePage">
        <h1>Accedi o registrati</h1>
    </div>
    <div id="formContainer">
        <div class="loginContainer">
            <h2>Accedi</h2>
            <br>
            
            <form  class="formCenter" method="post">
                <div class="insideForm">
                    <p class="backgroundRed">'.$loginError.'</p>
                    <p>Username:</p>
                    <input type="text" name="loginUsername" placeholder="inserisci username" tabindex="1">
                    <p>Password:</p>
                    <input type="password" name="loginPassword" placeholder="inserisci password" tabindex="2">
                    <input  class="formBtn distanceBtn" type="submit" value="Accedi" tabindex="3">
                    <p>Sei nuovo su Dreamsound? <a class="" href="register.php" tabindex="4">Registrati</a></p>
                </div>
                
            </form>
        </div>
    </div>';
}
else{
    $contentActualPage='
    <div class="titlePage">
        <h1>Accedi o registrati</h1>
    </div>
    <div id="formContainer">
        <div class="loginContainer">
            <p>'.$loginError.'</p>
        </div>
    </div>';
}


BuildPage("Login",$contentActualPage);	//funzione di buildpage dentro al file function
?>