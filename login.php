<?php
require_once "./database/connessione.php";
require_once "php/functions.php";	//è un include di function



    







$loginError=checkLoginDbAndError($conn);


    
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
                <p>'.$loginError.'</p>
                <p>Username:</p>
                <input type="text" name="loginUsername" placeholder="inserisci il username">
                <p>Password:</p>
                <input type="password" name="loginPassword" placeholder="inserisci il password">
                <input  class="formBtn" type="submit" value="Accedi">
                <p>sei nuovo su Dreamsound? <a class="" href="register.php">registrati</a></p>
            </div>
            
        </form>
    </div>
</div>';
BuildPage("Login",$contentActualPage);	//funzione di buildpage dentro al file function
?>