<?php
function insertVoidValue($contentActualPage){
    $contentActualPage=str_replace('{nomeReload}','',$contentActualPage);
    $contentActualPage=str_replace('{surnameReload}','',$contentActualPage);
    $contentActualPage=str_replace('{userIdReload}','',$contentActualPage);
    $contentActualPage=str_replace('{emailReload}','',$contentActualPage);
    return $contentActualPage;
}

function createContetnLogin($contentActualPage){
    require_once "./database/connessione.php";
    //ENTRA SSE HO CLICCATO IL TASTO REGISTRAZIONE
    if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['userId']) && isset($_POST['email']) && isset($_POST['psw1']) && isset($_POST['psw2'])){
        
        $name=$_POST['name'];
        $surname=$_POST['surname'];
        $userId=$_POST['userId'];
        $email=$_POST['email'];
        $psw1=$_POST['psw1'];
        $psw2=$_POST['psw2'];
        
        $resultUserId= mysqli_query($conn,"SELECT * FROM Utente WHERE Username='".$userId."'");// query di controllo per checcare se userId è già presente nel DB
        $contaResultUserId=mysqli_num_rows($resultUserId);
        $resultEmail= mysqli_query($conn,"SELECT * FROM Utente WHERE Email='".$email."'"); // query di controllo per checcare se email è già presente nel DB
        $contaResultEmail=mysqli_num_rows($resultEmail);
        
        $checkName= strlen($name);
        $checkSurname= strlen($surname);
        $checkUserId= strlen($userId);
        $checkPsw= strlen($psw1);
        
        if($contaResultUserId==0 && $contaResultEmail==0 && $checkName>0 && $checkSurname>0 
                                            && $checkUserId>4 && $checkPsw>5 &&  $psw1==$psw2){//registrazione avvenuta con successo
            $insert="INSERT INTO Utente(Username,Email,Password,Nome,Cognome) VALUES('".$userId."','".$email."','".md5($psw1)."','".$name."','".$surname."')";
            $result = $conn->query($insert);
            if($result){
                $contentActualPage=insertVoidValue($contentActualPage);
                $registerError='la query è andata a buon fine deve stampare utente registrato';
                $contentActualPage=str_replace('{registerError}',$registerError,$contentActualPage);
                $contentActualPage=str_replace('{loginError}','',$contentActualPage);
            }else{
                echo 'queri andata malissimo magari erreori di server o boh';
            }
        }else{//errore di input per la registrazione
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
            $contentActualPage=str_replace('{nomeReload}',$name,$contentActualPage);
            $contentActualPage=str_replace('{surnameReload}',$surname,$contentActualPage);
            $contentActualPage=str_replace('{userIdReload}',$userId,$contentActualPage);
            $contentActualPage=str_replace('{emailReload}',$email,$contentActualPage);
            $contentActualPage=str_replace('{registerError}',$registerError,$contentActualPage);
            $contentActualPage=str_replace('{loginError}','',$contentActualPage);
        }
    }
    //ENTRA SSE HO CLICCATO IL TASTO LOGIN
    else if(isset($_POST['loginUsername']) && isset($_POST['loginPassword'])){
        $userId=$_POST['loginUsername'];
        $userPassword=$_POST['loginPassword'];

        $resultUserId= mysqli_query($conn,"SELECT * FROM Utente WHERE Username='".$userId."' AND Password='".md5($userPassword)."' ");
        $contaResultUserId=mysqli_num_rows($resultUserId);

        if($contaResultUserId==1){
            $_SESSION["sessionUserId"]=$userId;
        }else{
            echo 'queri andata malissimo magari erreori di server o boh';
        }
        
        $loginError="login avvenuta con successo";
        $contentActualPage=str_replace('{nomeReload}','',$contentActualPage);
        $contentActualPage=str_replace('{surnameReload}','',$contentActualPage);
        $contentActualPage=str_replace('{userIdReload}','',$contentActualPage);
        $contentActualPage=str_replace('{emailReload}','',$contentActualPage);
        $contentActualPage=str_replace('{registerError}','',$contentActualPage);
        $contentActualPage=str_replace('{loginError}',$loginError,$contentActualPage);
    }
    //ENTRA SSE NON HO CLICCATO NESSUN TASTO
    else{
        $contentActualPage=insertVoidValue($contentActualPage);
        $contentActualPage=str_replace('{registerError}','',$contentActualPage);
        $contentActualPage=str_replace('{loginError}','',$contentActualPage);

    }
    return $contentActualPage;
    
}
?>