<?php
//manca controllo numeri sulla password

require "../\database/connessione.php";
session_start();//serve per aprire una sessione->mi serve per forse dichiarare delle variabili globali per tornare indietro nella pagina con gli elementi corretti già inseriti.
//RICORDATI CHE SEI ARRIVATO FINO A QUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
// $tasto=$_POST['tasto'];
// echo $tasto;



$name=$_POST['name'];
$surname=$_POST['surname'];
$userId=$_POST['userId'];
$email=$_POST['email'];
$psw1=$_POST['psw1'];
$psw2=$_POST['psw2'];


// $controlloUserId= "SELECT * FROM Utente WHERE Username='".$userId."'";
$resultUserId= mysqli_query($conn,"SELECT * FROM Utente WHERE Username='".$userId."'");
$contaResultUserId=mysqli_num_rows($resultUserId);

$resultEmail= mysqli_query($conn,"SELECT * FROM Utente WHERE Email='".$email."'");
$contaResultEmail=mysqli_num_rows($resultEmail);

//lunghezze
$checkName= strlen($name);
$checkSurname= strlen($surname);
$checkUserId= strlen($userId);
$checkPsw= strlen($psw1);

if($contaResultUserId==0 && $contaResultEmail==0 && $checkName>0
    && $checkSurname>0 && $checkUserId>4 && $checkPsw>5 ){//è andato tutto bene

        $insert=    "INSERT INTO Utente(Username,Email,Password,Nome,Cognome)  
            VALUES('".$userId."','".$email."','".md5($psw1)."','".$name."','".$surname."')";

        $result = $conn->query($insert);
        if($result)
            echo 'la query è andata a buon fine deve stampafre utente regitrato';
        else
            echo 'queri andaga malissimo magati erreor fi server o boh';
}
else{//ce stà un errore
    $page=file_get_contents('registerPageReloaded.html');
    $numError=0;//errore==0 => nessun errore
    if($contaResultUserId>0 && $numError==0){
        $echoError="username non disponibile,";
        $numError=1;
    }
    if($contaResultEmail>0 && $numError==0){
        $echoError="email già presente utilizzane un altra,";
        $numError=2;
    }
    if($checkName==NULL && $numError==0){
        $echoError="inserisci un nome,";
        $numError=3;
        
    }
    if($checkSurname==NULL && $numError==0){
        $echoError="inserisci il cognome,";
        $numError=4;
    }
    if($checkUserId<5 && $numError==0){
        $echoError="inserisci un nickname,";
        $numError=5;
    }
    if($checkPsw<6 && $numError==0){
        $echoError="devi inserire una password,";
        $numError=6;
    }

    

    $page=str_replace('{nomeReload}',$name,$page);
    $page=str_replace('{surnameReload}',$surname,$page);
    $page=str_replace('{userIdReload}',$userId,$page);
    $page=str_replace('{emailReload}',$email,$page);
    $page=$page.$echoError;
    echo $page;    
}
?>