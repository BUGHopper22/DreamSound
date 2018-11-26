<?php
    // session_start();
    $contentActualPage='
    <div id="formContainer">
        <div class="loginContainer">
            <h2>Accedi</h2>
            <br></br>
            {loginError}
            <form  class="formCenter" method="post">
                <p>Username:</p>
                <input type="text" name="loginUsername">
                <p>Password:</p>
                <input type="password" name="loginPassword">
                <input  class="formBtn" type="submit" value="Accedi">
            </form>
        </div>
        <div class="registerContainer">
            <h2>Registrati</h2>
            <br></br>
            {registerError}
            <form class="formCenter" method="post">
                <p>Inserisci un nome:</p>
                <input type="text" name="name" placeholder="inserisci il nome" value="{nomeReload}">
                <p>Inserisci un cognome:</p>
                <input type="text" name="surname" placeholder="inserisci il cognome" value="{surnameReload}">
                <p>Inserisci un username:</p>
                <input type="text" name="userId" placeholder="inserisci il nome utente" value="{userIdReload}">
                <p>Inserisci una email:</p>
                <input type="email" name="email" placeholder="inserisci email" value="{emailReload}">
                <p>Scegli la tua password:</p>
                <input type="password" name="psw1" placeholder="inserisci password">
                <p>Conferma la password:</p>
                <input type="password" name="psw2" placeholder="inserisci password" >
                <input  class="formBtn" type="submit" value="Registrati">

            </form>
        </div> 
    </div>';

    require_once('php/functions.php');	//è un include di function
    BuildPage("Login",$contentActualPage);	//funzione di buildpage dentro al file function
?>