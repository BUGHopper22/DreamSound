<?php 
 session_start();
 
 require_once("buildHeader.php");
 require_once("buildDropdownPages.php");
 require_once('./database/connessione.php');



/*L' idea si basa sul fatto che se una pagina ha l ' attributo type==dropDown-content
    allora è una pagina di prodotti(subcategory), (potrò successivamente creare dinamicamente i prodotti della pagina)
    Ritorna true sse sono su una pagina LISTA PRODOTTI*/ 
function isProductPage($title,$menuPages){
    $esci=FALSE;
    $size=count($menuPages);
    $scorri=0;
    // echo ($esci==FALSE); 
    while($scorri<$size and $esci==FALSE){
        if($title==$menuPages[$scorri]->getName() && $menuPages[$scorri]->getType()=='dropdown-content' && $title!="Carrello" && $title!="Storico ordini"){
            $esci=TRUE;
        }
        $scorri++;
    }
    return $esci;
}

// ritorna true sse sono su una pagina di tipo dropDown, cioè su una pagina category
function isCategoryPage($title,$menuPages){
    $esci=FALSE;
    $size=count($menuPages);
    $scorri=0;
    while($scorri<$size and $esci==FALSE){
        if($title==$menuPages[$scorri]->getName() and $menuPages[$scorri]->getType()=='dropDown'){
            $esci=TRUE;
        }
        
        $scorri++;
    }
   
    return $esci;
}

// ritorna true sse non è una pagina category ne subcategory
function isSinglePage($title,$menuPages){
    $esci=FALSE;
    $size=count($menuPages);
    $scorri=0;
    while($scorri<$size and $esci==FALSE){
        if($title==$menuPages[$scorri]->getName() and $menuPages[$scorri]->getType()!='dropDown' and $menuPages[$scorri]->getType()!='dropdown-content'){
            $esci=TRUE;
        }
        $scorri++;
    }
    return $esci;
}

// ___________________BREADCRUMB_________________________
function SelectFirstLevelPageFromSecond($subcategory){
    $firstLevel="";
    if($subcategory=="Cuffie in ear" || $subcategory=="Cuffie on ear" || $subcategory=="Cuffie wireless")
        $firstLevel="Cuffie";
    if($subcategory=="Casse Altoparlanti" || $subcategory=="Casse Bluetooth")
        $firstLevel="Casse";
    if($subcategory=="Accessori Cuffie" || $subcategory=="Accessori Casse")
        $firstLevel="Accessori";
    if($subcategory=="Carrello" || $subcategory=="Storico ordini")
        $firstLevel="Profilo";
    return $firstLevel;
}

function isSecondLevelPage($title,$menuPages){
    $esci=FALSE;
    $size=count($menuPages);
    $scorri=0;
    while($scorri<$size and $esci==FALSE){
        if($title==$menuPages[$scorri]->getName() && $menuPages[$scorri]->getType()=='dropdown-content'){
            $esci=TRUE;
        }
        $scorri++;
    }
    return $esci;
}

function SelectSecondLevelPageFromProduct($conn,$title){
    // PROBLEMI DI CONNESSIONE, FUNZIONA SOLO COSI PURTROPPO
    
    
    $stri="SELECT Categoria FROM cuffie WHERE Modello='".$title."' 
    UNION
    SELECT Categoria FROM accessori WHERE Modello='".$title."'
    UNION
    SELECT Categoria FROM casse WHERE Modello='".$title."' ";
    $tableNeeds=mysqli_query($conn,$stri);
    $subcategoryAr=mysqli_fetch_array($tableNeeds);
    $subcategory=$subcategoryAr["Categoria"];
    return $subcategory;
}

function breadcrumbHtml(){
    $bread='
    <div id="breadcrumb"> {BreadcrumbLink}';
    
    if(isset( $_SESSION["sessionUserId"])){
        $bread.='
        <div class="welcomeUser">
            <div class="showWelcome">
                <div class="nomeUtente">
                    <p>Benvenuto '.$_SESSION["sessionUserId"].', 
                </p></div>
                <a href="./index.php?logout=1"> Logout</a>
            </div>
        </div>';
    }else{
        $bread.='
        <div class="welcomeUser">
            <div class="showWelcome">
            <a href="./login.php"> Login</a>
            </div>
        </div>';
    }
    $bread.='</div>';
    return $bread;
}
function breadcrumbLinkSubstitution($title,$isSecondLevelPage,$isCategoryPage,$menuPages){
    $host = "localhost";
	$user = "root";
	$password = "";
	$db = "dreamsound";
    $conn = new mysqli($host, $user, $password, $db);

    $substitution="";
    if($title=="Home" || $title=="404")
       $substitution.='Home';
    else if($isCategoryPage || $title=="Login" || $title=="Register" || $title=="Amministratore" || $title=="Contatti"){
        $substitution.='<a href="./index.php"> Home</a> > '.$title;
    }
    else if($isSecondLevelPage){
        //ritorna la categoria corrispondente alla subcategory(title)
        $category=SelectFirstLevelPageFromSecond($title);
        $substitution.='<a href="./index.php">Home</a> > <a href="./'.$category.'.php"> '.$category.'</a> > '.$title;
    }
    else if($title=="Rimuovi prodotto" || $title=="Modifica prodotto" || $title=="Aggiungi prodotto"){
        $substitution.='<a href="./index.php">Home</a> > <a href="./Amministratore.php"> Amministratore</a> > '.$title;
    }
    // ATTENZIONE NEL CASO ELSE VANNO TUTTTE LE PAGINE DEL SINGOLO PRODOTTO, SE SI AGGIUNGONO ALTRE PAGINE POTREBBERO FINIRE QUI ERRONEAMENTE
    else{
        $subcategory=SelectSecondLevelPageFromProduct($conn,$title);
        $category=SelectFirstLevelPageFromSecond($subcategory);

        // PROBLEMI A TROVARE URL => USO MENUPAGES 
        $rememberUrl="";
        $esci=FALSE;
        $size=count($menuPages);
        $scorri=0;
        while($scorri<$size and $esci==FALSE){
            if($subcategory==$menuPages[$scorri]->getName()){
                $rememberUrl=$menuPages[$scorri]->getUrl();
                $esci=TRUE;
            }
            $scorri++;
        }

        $substitution.='<a href="./index.php"> Home</a> > 
        <a href="./'.$category.'.php"> '.$category.'</a> > 
        <a href="./'.$rememberUrl.'.php?ntab='.$category.'"> '.$subcategory.'</a> > '.$title;
    }
// manca parte se utente è connesso
    return $substitution;
}

// ___________________PAGINA CARRELLO_________________________
// inserisce su contentActualPage tutti i tag per vedere i prodotti sul carrello dell'utente
function insertProductInChart($contentActualPage,$chartProducts,$cont){
    foreach($chartProducts as $lista){
        $contentActualPage=$contentActualPage.'
        <div class="carrelloContainer">
            <div class="carrelloImgContainer">
                <img class="carrelloImg" src="./img/prodotti'.$lista["Url_immagine"].'" alt="prodotto1">
            </div>
            <div class="carrelloDescriptionContainer">
                <h3>'.$lista["Modello"].'</h3>
                <p class="carrelloDescription">'.$lista["Descrizione"].'</p>
                <div class="quantity">';
                $contentActualPage.='<p>Quantita: </p>';
                    if($lista["Quantita"]>1){
                        $contentActualPage=$contentActualPage.'
                        <a class="quantityBotton" alt="rimuovi una quantitá" href="php/carrello/quantityProduct.php?idProdotto='.$lista["Id_p"].'&type=-1" tabindex="';$cont=$cont+1; $contentActualPage.=$cont.'">
                            <p>-</p>
                        </a>';
                    }
                    $contentActualPage.='
                    <p>'.$lista["Quantita"].'</p>
                    <a class="quantityBotton" alt="aggiungi una quantitá" href="php/carrello/quantityProduct.php?idProdotto='.$lista["Id_p"].'&type=1" tabindex="';$cont=$cont+1; $contentActualPage.=$cont.'">
                        <p>+</p>
                    </a>
                </div>';
                $contentActualPage=$contentActualPage.'
                <div class="productPrice"><h4>'.$lista["Prezzo"].'€</h4></div>
                <a class="button" alt="rimuovi il prodotto" href="php/carrello/removeProduct.php?idProdotto='.$lista["Id_p"].'" tabindex="';$cont=$cont+1; $contentActualPage.=$cont.'">Rimuovi</a>
            </div>
        </div>';
        $cont=$cont+1;
    }
    return $contentActualPage;
}
// restituisce il totale in euro della somma di tutti i prodotti nel carrello
function sumPriceChart($chartProducts){
    $tot=0;
    foreach($chartProducts as $lista){
        $tot=$tot+($lista["Prezzo"]*$lista["Quantita"]);
    }
    return $tot;
}
// funzioni non ancora utilizzate
// function withAjax($contentActualPage,$lista){
//     if($lista["Quantita"]>1){
//         $contentActualPage=$contentActualPage.'
//         <a class="quantityBotton" href="php/carrello/quantityProduct.php?idProdotto='.$lista["Id_p"].'&type=-1"> <p>-</p> </a>';
//     }
//     $contentActualPage=$contentActualPage.'
//     <a class="quantityBotton" href="php/carrello/quantityProduct.php?idProdotto='.$lista["Id_p"].'&type=1"> <p>+</p> </a>';
//     return $contentActualPage;  
// }

// function withoutAjax($contentActualPage,$lista){
//     echo("sssss");
//     if($lista["Quantita"]>1){
//         $contentActualPage=$contentActualPage.'
//         <a class="quantityBotton" href="php/carrello/quantityProduct.php?idProdotto='.$lista["Id_p"].'&type=-1"> <p>-</p> </a>';
//     }
//     $contentActualPage=$contentActualPage.'
//     <a class="quantityBotton" href="php/carrello/quantityProduct.php?idProdotto='.$lista["Id_p"].'&type=1"> <p>+</p> </a>';
//     return $contentActualPage;
// }

// ___________________PAGINA LOGIN_________________________
// sostituisce le stringhe con valori vuoti, se ci saranno errori un altra funzione inserira i valori d'errore
function insertVoidValue($contentActualPage){
    $contentActualPage=str_replace('{nomeReload}','',$contentActualPage);
    $contentActualPage=str_replace('{surnameReload}','',$contentActualPage);
    $contentActualPage=str_replace('{userIdReload}','',$contentActualPage);
    $contentActualPage=str_replace('{emailReload}','',$contentActualPage);
    return $contentActualPage;
}
// controlla errori sulla login
function checkLoginDbAndError($conn){
    //ENTRA SSE HO CLICCATO IL TASTO LOGIN (DOPO averlo cliccato)
    if(isset($_POST['loginUsername']) && isset($_POST['loginPassword'])){
        $userId=$_POST['loginUsername'];
        $userPassword=$_POST['loginPassword'];

        $resultUserId= mysqli_query($conn,"SELECT * FROM Utente WHERE Username='".$userId."' AND Password='".md5($userPassword)."' ");
        $contaResultUserId=mysqli_num_rows($resultUserId);
        //SE TROVATO IL NOME SUL DB
        if($contaResultUserId==1){
            $_SESSION["sessionUserId"]=$userId;

            $array=mysqli_fetch_array($resultUserId);
            // 1 se è amministratore, 0 altrimenti
            $amministratore=$array["Amministratore"];
            $_SESSION["sessionAmm"]=$amministratore;
            
            $loginError='Sei loggato,torna alla <a class="" href="index.php">home</a>';
        }
        //NOME LOGIN NON PRESENTE NEL DB
        else{
            $loginError="Nome utente o password errati";
        }
    }
    //ENTRA SSE NON HO CLICCATO NESSUN TASTO
    else
        $loginError="";
    return $loginError;
}
// ___________________PAGINA STORICO_________________________

// trova i prodotti che sono nello storico di $userName
function findHistoryProducts($conn,$userName){
    $historyProducts= mysqli_query($conn,
    "SELECT * FROM Accessori a,Storico s WHERE s.Username='".$userName."' and a.Id_p=s.Id_p
    UNION
    SELECT * FROM Cuffie cu,Storico s WHERE s.Username='".$userName."' and cu.Id_p=s.Id_p
    UNION
    SELECT * FROM Casse ca,Storico s WHERE s.Username='".$userName."' and ca.Id_p=s.Id_p");
    return $historyProducts;
}
// ritorna il prezzo del prodotto*quantità
function qtaPerPrice($lista){
    return $lista["Quantita"]*$lista["Prezzo"];
}
// costruisce la pagina storico sse l'utente è loggato
function buildHistoryContent($historyProducts,$countProductsUser){
    // se non hai comprato ancora nessun prodotto
    if($countProductsUser==0){
        $contentActualPage='
        <div id="storicoOrdini">
            <div class="titlePage">
                <h1>Storico ordini</h1>
            </div>
            <div class="storicoVuoto">
                <p>Non hai ancora acquistato nulla, cosa aspetti?</p>
            </div>
        </div>';
        // BuildPage("Storico",$contentActualPage);
    }else{
        $contentActualPage='
        <div class="titlePage">
            <h1>Storico Ordini</h1>
        </div>
        <div id="carrello">';
        //CODICE SPARTANO NON TOCCARE
        //--------------------------------------------
        $paginadaricordare=$_SERVER["REQUEST_URI"];//-
        $_SESSION["PAGINA"]=$paginadaricordare;    //-
        //----
        foreach($historyProducts as $lista){
            $contentActualPage=$contentActualPage.'
            <div class="carrelloContainer">
                <div class="carrelloImgContainer">
                    <img class="carrelloImg" src="./img/prodotti'.$lista["Url_immagine"].'" alt="prodotto1">
                </div>
                <div class="carrelloDescriptionContainer">
                    <h3>'.$lista["Modello"].'</h3>
                    <p class="carrelloDescription">'.$lista["Descrizione"].'</p>
                    <div>
                        <p>Data: '.$lista["Data_acquisto"].'</p>
                    </div>
                    <div class="quantity">
                        <p>Quantita: '.$lista["Quantita"].'</p>
                    </div>
                    <div class="productPrice">'.qtaPerPrice($lista).' euro</div>
                </div>
            </div>';
        }
    }
    return $contentActualPage;
}
// _________________________QUERY
// ritorna tutte le subcategory
function allCategory($conn){
    $allCategory=mysqli_query($conn,
    "SELECT DISTINCT Categoria FROM Cuffie
    UNION
    SELECT DISTINCT Categoria FROM Casse
    UNION
    SELECT DISTINCT Categoria FROM Accessori
    ");
    return $allCategory;
}
//ritorna tutte le subcategory nel tag option(per le form)
function insertCategoryInSelect($contentActualPage,$allCategory){
    foreach($allCategory as $shit){
        $contentActualPage=$contentActualPage.
        '<option value="'.$shit["Categoria"].'">'.$shit["Categoria"].'</option>';
    }
    return $contentActualPage;
}
// ritorna tutti i modelli della subcategory con i tag option(per le form)
function insertProductsInSelect($conn,$selectedCategory,$contentActualPage){
    $selectedProductsFromCategory=mysqli_query($conn,
    "SELECT Modello  FROM Cuffie WHERE Categoria='".$selectedCategory."' 
    UNION
    SELECT Modello  FROM Casse WHERE Categoria='".$selectedCategory."'
    UNION
    SELECT Modello  FROM Accessori WHERE Categoria='".$selectedCategory."'
    ");
    foreach($selectedProductsFromCategory as $shit){
        $contentActualPage=$contentActualPage.
        '<option value="'.$shit["Modello"].'">'.$shit["Modello"].'</option>';
    }
    return $contentActualPage;
}


// ricava il nome della tabella a cui appartiene la sottocategoria(es. input:cuffie on ear, output:cuffie)
function SelectTableNameFromSubcategory($conn,$subcategory){
    if($subcategory=="Cuffie in ear" || $subcategory=="Cuffie on ear" || $subcategory=="Cuffie wireless")
        $tableName="Cuffie";
    if($subcategory=="Casse Altoparlanti" || $subcategory=="Casse Bluetooth")
        $tableName="Casse";
    if($subcategory=="Accessori Cuffie" || $subcategory=="Accessori Casse")
        $tableName="Accessori";
    return $tableName;
}
//modifica il $attributo di $modello con il valore &value
function queryModifyProduct($conn,$subcategory,$modello,$attribute,$value){
    $table= SelectTableNameFromSubcategory($conn,$subcategory);
    $modify="UPDATE `{$table}` SET ".$attribute."='".$value."' WHERE Modello='".$modello."' ";
    $result = $conn->query($modify);
    if ($result)
        $messaggio="Prodotto modificato";
    else
        $messaggio="C'è stato un errore";
    return $messaggio;
}
// Rende il prodotto con modello==$selectedProduct non visibile, significa che non verrà più venduto 
// ma sarà ancora visibile nello sotrico degli utenti
function queryDeleteProduct($conn,$subcategory,$selectedProduct){
    $table= SelectTableNameFromSubcategory($conn,$subcategory);
    $delete = "UPDATE `{$table}` SET Visibile='0' WHERE Modello='".$selectedProduct."' ";
    $result = $conn->query($delete);
    if ($result)
        $messaggio="Prodotto reso non visibile, non si può più comprare";
    else
        $messaggio="C'è stato un errore";
    return $messaggio;
}
// aggiunge un nuovo prodotto nel DB
function queryAddProduct($conn,$subcategory,$modello,$marca,$prezzo,$urlImg,$descrizione){
    $table= SelectTableNameFromSubcategory($conn,$subcategory);
    //inserimento nuovo id
    $insert = "INSERT INTO id_prodotti VALUE ()";
    $result = $conn->query($insert);
    // il nuovo idValue viene messo in $idToInsert
    $popId = "SELECT MAX(Id_prodotto) as Id_prodotto FROM id_prodotti";
    $result = $conn->query($popId);
    $arrayId =mysqli_fetch_row($result);
    $idToInsert = $arrayId[0];
    //inserisce il nuovo prodotto nella tabella corretta
    $insert = "INSERT INTO `{$table}` (Id_p,Categoria,Prezzo,Marca,Modello,Url_Immagine,Descrizione)
    VALUES ('".$idToInsert."','".$categoria."', '".$prezzo."', '".$marca."','".$modello."','".$urlImg."','".$descrizione."')";
    $result = $conn->query($insert);
    if ($result)
        $messaggio="Prodotto inserito con successo";
    else
        $messaggio="C'è stato un errore";
    return $messaggio;
}



// ____SERVE PER COSTRUIRE LA PAGINA
function BuildPage($title,$contentActualPage) {
    //carica la struttura con head e body
    $page=file_get_contents('./content/structure.html');
    $page=str_replace('{title}',$title,$page);
    
    $menuPages=createNavArray();//crea array con le pagine

    //HEADER
    $header=PrepareMenu($title,$menuPages);
    $page=str_replace('{header}',$header,$page);
    
    $isProductPage=isProductPage($title,$menuPages);//è una pagina di secondo livello? (SOLO PRODOTTI)
    $isCategoryPage=isCategoryPage($title,$menuPages);//è una pagina prodotti di primo livello? (SOLO PRODOTTI)
    $isSinglePage=isSinglePage($title,$menuPages);

    //se è una pagina prodotti => vado ad inserire dinamicamente tutti i prodotti dal DB
    //COSTRUZIONE PAGINA DI SECONDO LIVELLO (SOLO SE PAGINA DI SECONDO LIVELLO PER I PRODOTTI)
    if($isProductPage){
        //ntab -> vedi creazione menu url.
        if(isset($_REQUEST["ntab"])){
            $titleTable=$_REQUEST["ntab"];
        }
        $contentActualPage=insertProductList($titleTable,$title);
    }
    $page=str_replace('{content}',$contentActualPage,$page);
    //FOOTER
    //se loggato con utente amministratore => vede footerAmm.html altrimente footer.html
    if(isset($_SESSION["sessionAmm"]) and $_SESSION["sessionAmm"]=='1')
        $footer=file_get_contents('content/footerAmm.html');
    else
        $footer=file_get_contents('content/footer.html');
    $page=str_replace('{footer}',$footer,$page);
 

    //BREADCRUMB (deve essere messo alla fine) CORRETTO
    // $breadcrumb=prepareBreadcrumb($title,$isProductPage,$isCategoryPage,$isSinglePage);
    // $page=str_replace('{breadcrumb}',$breadcrumb,$page);

    // breadcrumb ridefinito
    $breadcrumb=breadcrumbHtml();
    $page=str_replace('{breadcrumb}',$breadcrumb,$page);
    $isSecondLevelPage=isSecondLevelPage($title,$menuPages);
    $substitution=breadcrumbLinkSubstitution($title,$isSecondLevelPage,$isCategoryPage,$menuPages);
    $page=str_replace('{BreadcrumbLink}',$substitution,$page);

    echo $page;
}

?>