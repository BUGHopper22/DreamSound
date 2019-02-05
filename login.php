<?php
require_once "./database/connessione.php";
require_once "php/functions.php";	//è un include di function

function insertVoidValue($contentActualPage){
    $contentActualPage=str_replace('{nomeReload}','',$contentActualPage);
    $contentActualPage=str_replace('{surnameReload}','',$contentActualPage);
    $contentActualPage=str_replace('{userIdReload}','',$contentActualPage);
    $contentActualPage=str_replace('{emailReload}','',$contentActualPage);
    return $contentActualPage;
}

    
//ENTRA SSE HO CLICCATO IL TASTO REGISTRAZIONE (Dopo  averlo cliccato)
if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['userId']) && isset($_POST['email']) && isset($_POST['psw1']) && isset($_POST['psw2'])){
    
    $name=$_POST['name'];
    $surname=$_POST['surname'];
    $userId=$_POST['userId'];
    $email=$_POST['email'];
    $psw1=$_POST['psw1'];
    $psw2=$_POST['psw2'];

    //QUERY PER CHECK PREVENTIVO
    // query di controllo per checcare se userId è già presente nel DB
    $resultUserId= mysqli_query($conn,"SELECT * FROM Utente WHERE Username='".$userId."'");
    $contaResultUserId=mysqli_num_rows($resultUserId);
    // query di controllo per checcare se email è già presente nel DB
    $resultEmail= mysqli_query($conn,"SELECT * FROM Utente WHERE Email='".$email."'"); 
    $contaResultEmail=mysqli_num_rows($resultEmail);
    
    $checkName= strlen($name);
    $checkSurname= strlen($surname);
    $checkUserId= strlen($userId);
    $checkPsw= strlen($psw1);
    //REGISTRAZIONE HA SUCCESSO
    if($contaResultUserId==0 && $contaResultEmail==0 && $checkName>0 && $checkSurname>0 
                                        && $checkUserId>4 && $checkPsw>5 &&  $psw1==$psw2){
        $insert="INSERT INTO Utente(Username,Email,Password,Nome,Cognome) VALUES('".$userId."','".$email."','".md5($psw1)."','".$name."','".$surname."')";
        $result = $conn->query($insert);
        if($result){
            $nomeReload="";
            $surnameReload="";
            $userIdReload="";
            $emailReload="";
            $loginError="";
            $registerError='la query è andata a buon fine deve stampare utente registrato';
        }else{
            echo 'queri andata malissimo magari erreori di server o boh';
        }
    //REGISTRAZIONE SENZA SUCCESSO => CERCO L'ERRORE
    }else{
        $findError=0;//findError==0 => ancora nessun nessun errore trovato, findError==1 è stato trovato l'errore di input
        //voglio vedere gli errori uno alla volta =>registerError
        if($checkName==NULL && $findError==0)       {$registerError="inserisci un nome";$findError=1;}
        if($checkSurname==NULL && $findError==0)    {$registerError="inserisci il cognome,";$findError=1;}
        if($checkUserId<5 && $findError==0)         {$registerError="inserisci un userId di minimo 6 caratteri";$findError=1; }
        if($contaResultUserId>0 && $findError==0)   {$registerError="username non disponibile,provane un altro"; $findError=1;}
        if($contaResultEmail>0 && $findError==0)    {$registerError="email già presente utilizzata,provane un' altra";$findError=1;}
        if($checkPsw<6 && $findError==0)            {$registerError="devi inserire una password,";$findError=1;}
        if($psw1!=$psw2)                            {$registerError="hai inserito due password diverse";$findError=1;}
        //esempio di sostituzione value="{nomeReload}"
        $nomeReload=$name;
        $surnameReload=$surname;
        $userIdReload=$userId;
        $emailReload=$registerError;
        $loginError="";
    }
//ENTRA SSE HO CLICCATO IL TASTO LOGIN (DOPO averlo cliccato)
}else if(isset($_POST['loginUsername']) && isset($_POST['loginPassword'])){
    $userId=$_POST['loginUsername'];
    $userPassword=$_POST['loginPassword'];

    $resultUserId= mysqli_query($conn,"SELECT * FROM Utente WHERE Username='".$userId."' AND Password='".md5($userPassword)."' ");
    $contaResultUserId=mysqli_num_rows($resultUserId);
    //SE TROVATO IL NOME SUL DB
    if($contaResultUserId==1){
        $_SESSION["sessionUserId"]=$userId;

        $array=mysqli_fetch_array($resultUserId);
        $amministratore=$array["Amministratore"];
        $_SESSION["sessionAmm"]=$amministratore;
        
        $loginError="login avvenuta con successo";
    }
    //NOME LOGIN NON PRESENTE NEL DB
    else{
        $loginError="nome utente o password errati";
    }
    $nomeReload="";
    $surnameReload="";
    $userIdReload="";
    $emailReload="";
    $registerError="";
}
//ENTRA SSE NON HO CLICCATO NESSUN TASTO
else{
    $nomeReload="";
    $surnameReload="";
    $userIdReload="";
    $emailReload="";
    $loginError="";
    $registerError="";

}



    
    $contentActualPage='
    <div class="titlePage">
        <h1>Accedi o registrati</h1>
    </div>
    <div id="formContainer">
        <div class="loginContainer">
            <h2>Accedi</h2>
            <br>
            '.$loginError.'
            <form  class="formCenter" method="post">
                <p>Username:</p>
                <input type="text" name="loginUsername" placeholder="inserisci il username">
                <p>Password:</p>
                <input type="password" name="loginPassword" placeholder="inserisci il password">
                <input  class="formBtn" type="submit" value="Accedi">
            </form>
        </div>
        <div class="registerContainer">
            <h2>Registrati</h2>
            <br>
            '.$registerError.'
            <form class="formCenter" method="post">
                <p>nome:</p>
                <input type="text" name="name" placeholder="inserisci il nome" value="'.$nomeReload.'">
                <p>cognome:</p>
                <input type="text" name="surname" placeholder="inserisci il cognome" value="'.$surnameReload.'">
                <p>username:</p>
                <input type="text" name="userId" placeholder="inserisci il nome utente" value="'.$userIdReload.'">
                <p>email:</p>
                <input type="email" name="email" placeholder="inserisci email" value="'.$emailReload.'">
                <p>Scegli la tua password:</p>
                <input type="password" name="psw1" placeholder="inserisci password">
                <p>Conferma la password:</p>
                <input type="password" name="psw2" placeholder="inserisci password" >
                <input  class="formBtn" type="submit" value="Registrati">

            </form>
        </div> 
    </div>';

    
    BuildPage("Login",$contentActualPage);	//funzione di buildpage dentro al file function
?>