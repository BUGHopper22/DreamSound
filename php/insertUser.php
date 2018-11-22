<?php
//manca controllo numeri sulla password
require_once "../database/connessione.php";
require_once "./functions.php";

// /session_start();//serve per aprire una sessione->mi serve per forse dichiarare delle variabili globali per tornare indietro nella pagina con gli elementi corretti già inseriti.
//RICORDATI CHE SEI ARRIVATO FINO A QUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA

if(isset($_POST['tasto'])){
    $tasto=$_POST['tasto'];
}else{
    $tasto=NULL;
}
// echo $tasto;

if($tasto=="registerTasto"){
    $name=$_POST['name'];
    $surname=$_POST['surname'];
    $userId=$_POST['userId'];
    $email=$_POST['email'];
    $psw1=$_POST['psw1'];
    $psw2=$_POST['psw2'];
    
    // query di controllo per checcare se userId è già presente nel DB
    $resultUserId= mysqli_query($conn,"SELECT * FROM Utente WHERE Username='".$userId."'");
    $contaResultUserId=mysqli_num_rows($resultUserId);
    // query di controllo per checcare se email è già presente nel DB
    $resultEmail= mysqli_query($conn,"SELECT * FROM Utente WHERE Email='".$email."'");
    $contaResultEmail=mysqli_num_rows($resultEmail);
    //controllo sulle lunghezze degli inserimenti
    $checkName= strlen($name);
    $checkSurname= strlen($surname);
    $checkUserId= strlen($userId);
    $checkPsw= strlen($psw1);
    $page;
    if($contaResultUserId==0 && $contaResultEmail==0 && $checkName>0
        && $checkSurname>0 && $checkUserId>4 && $checkPsw>5 ){//è andato tutto bene, nessun errore
            //inserisce nel DB
            
            $insert=    "INSERT INTO Utente(Username,Email,Password,Nome,Cognome) VALUES('".$userId."','".$email."','".md5($psw1)."','".$name."','".$surname."')";

            $result = $conn->query($insert);
            if($result){
                // 	//è un include di function
                echo("registrazione corretta");
                // BuildPage("Login","registerPageReloaded.html");	//funzione di buildpage dentro al file function
                
                $page='<html lang="it">
                <head>
                    <meta charset="UTF-8"> <!--HTML5: codifica utf-8  dei caratteri in uso nel documento. Scrivere nei primi 512byte del documento -->
                    <title>login reload | DreamSound </title> <!--vale 80% dell indicizzazione -->
                    <meta name="description" content="DreamSound" />
                    <meta name="author" content="Bacco Alberto, Vidotto Giovanni, Davanzo Nicole" />
                    <meta name="keywords" content="audio, cuffie, casse, wireless" />
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <!-- <link href="img/favicon.ico" rel="shortcut icon" type="image/x-icon" /> PER ICONA DA MODIFICARE-->
            
                    <!-- CSS -->
                    <link type="text/css" rel="stylesheet" href="../content/css/style.css" />
                    <link type="text/css" rel="stylesheet" href="../content/css/style-mobile.css"/>
                    <!-- <link rel="stylesheet" type="text/css" media="screen" href="contents/css/style.css"/>
                    <link rel="stylesheet" type="text/css" media="screen and (max-width: 992px)" href="contents/css/style-tablet.css"/>
                    <link rel="stylesheet" type="text/css" media="screen and (max-width: 768px)" href="contents/css/style-mobile.css"/>
                    <link rel="stylesheet" type="text/css" media="print" href="contents/css/printS.css"/> -->
                </head>
            
                <body>
                    <header>
                        {header}
                    </header>
                    <!-- <div>
                            {breadcumb};
                    </div> -->
                    <div>
                        {content}
                    </div>
                    
                </body>
            </html>';

                //crea array con le pagine
                $menuPages=createNavArray();
                $aux='Login';
                $header=PrepareMenu($aux,$menuPages);
                $page=str_replace('{header}',$header,$page);

                $contentActualPage=file_get_contents('registerPageReloaded.html');
                $contentActualPage=str_replace('{nomeReload}',' ',$contentActualPage);
                $contentActualPage=str_replace('{surnameReload}',' ',$contentActualPage);
                $contentActualPage=str_replace('{userIdReload}',' ',$contentActualPage);
                $contentActualPage=str_replace('{emailReload}',' ',$contentActualPage);
                $registerError='la query è andata a buon fine deve stampafre utente regitrato';
                $contentActualPage=str_replace('{registerError}',$registerError,$contentActualPage);
                    
                $page=str_replace('{content}',$contentActualPage,$page);
                echo $page;
            }
            else
                echo 'queri andata malissimo magari erreori di server o boh';
    }
    else{//ce stà un errore
        $page=file_get_contents('registerPageReloaded.html');
        $numError=0;//errore==0 => nessun errore

        //voglio vedere gli errori uno alla volta
        if($checkName==NULL && $numError==0){
            $echoError="inserisci un nome";
            $numError=3;
            
        }
        if($checkSurname==NULL && $numError==0){
            $echoError="inserisci il cognome,";
            $numError=4;
        }
        if($checkUserId<5 && $numError==0){
            $echoError="inserisci un nickname di minimo 6 caratteri";
            $numError=5;
        }
        if($contaResultUserId>0 && $numError==0){
            $echoError="username non disponibile,";
            $numError=1;
            // substitution
        }
        if($contaResultEmail>0 && $numError==0){
            $echoError="email già presente utilizzane un altra,";
            $numError=2;
        }
        if($checkPsw<6 && $numError==0){
            $echoError="devi inserire una password,";
            $numError=6;
        }
        
        //esempio di sostituzione value="{nomeReload}"
        $page=str_replace('{nomeReload}',$name,$page);
        $page=str_replace('{surnameReload}',$surname,$page);
        $page=str_replace('{userIdReload}',$userId,$page);
        $page=str_replace('{emailReload}',$email,$page);
        $page=str_replace('{registerError}',$echoError,$page);
        
    }
}
else if($tasto=="loginTasto"){

}
// echo $page;

?>