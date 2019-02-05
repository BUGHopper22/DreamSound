<?php 
 session_start();
 
 require_once "buildHeader.php";
 require_once "buildBreadcrumb.php";
 require_once "buildDropdownPages.php";


// function sumTotChart($chartProducts){

// }

/*L' idea si basa sul fatto che se una pagina ha l ' attributo type==dropDown-content
    allora è una pagina di prodotti=> andrò a creare dinamicamente i prodotti della pagina.
    Ritorna true sse sono su una pagina prodotti*/ 
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


function isCategoryPage($title,$menuPages){
    $esci=FALSE;
    $size=count($menuPages);
    $scorri=0;
    // echo ($esci==FALSE); 
    while($scorri<$size and $esci==FALSE){
        if($title==$menuPages[$scorri]->getName() and $menuPages[$scorri]->getType()=='dropDown'){
            $esci=TRUE;
        }
        $scorri++;
    }
    return $esci;
}

function isSinglePage($title,$menuPages){
    $esci=FALSE;
    $size=count($menuPages);
    $scorri=0;
    // echo ($esci==FALSE); 
    while($scorri<$size and $esci==FALSE){
        if($title==$menuPages[$scorri]->getName() and $menuPages[$scorri]->getType()!='dropDown' and $menuPages[$scorri]->getType()!='dropdown-content'){
            $esci=TRUE;
        }
        $scorri++;
    }
    return $esci;
}

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

function insertCategoryInSelect($contentActualPage,$allCategory){
    foreach($allCategory as $shit){
        $contentActualPage=$contentActualPage.
        '<option value="'.$shit["Categoria"].'">'.$shit["Categoria"].'</option>';
    }
    return $contentActualPage;
}

function insertProductsInSelect($conn,$selectedCategory,$contentActualPage){
    // echo $selectedCategory;
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

function queryDeleteProduct($conn,$categoria,$selectedProduct){
    if($categoria=="Cuffie in ear" || $categoria=="Cuffie on ear" || $categoria=="Cuffie wireless")
        $table="cuffie";
    if($categoria=="Casse Altoparlanti" || $categoria=="Casse Bluetooth")
        $table="Casse";
    if($categoria=="Accessori Cuffie" || $categoria=="Accessori Casse")
        $table="Accessori";
    echo($table);
//     UPDATE Customers
// SET ContactName='Alfred Schmidt', City='Frankfurt'
// WHERE CustomerID=1;

    $delete = "UPDATE `{$table}` SET Visibile='0' WHERE Modello='".$selectedProduct."' ";
    $result = $conn->query($delete);

    if ($result) {
        $messaggio="Prodotto reso non visibile, non si può più comprare";
    } else {
        $messaggio="C'è stato un errore";
    }
    // $messaggio=" ermano";
    return $messaggio;
  
    
}

function queryAddProduct($conn,$categoria,$modello,$marca,$prezzo,$urlImg,$descrizione){
    
    echo($categoria);
    echo($modello);
    echo($marca);
    echo($prezzo);
    echo($urlImg);
    echo($descrizione);



    if($categoria=="Cuffie in ear" || $categoria=="Cuffie on ear" || $categoria=="Cuffie wireless")
        $table="cuffie";
    if($categoria=="Casse Altoparlanti" || $categoria=="Casse Bluetooth")
        $table="Casse";
    if($categoria=="Accessori Cuffie" || $categoria=="Accessori Casse")
        $table="Accessori";
    echo($table);
    
    $insert = "INSERT INTO id_prodotti VALUE ()";
    $result = $conn->query($insert);

    $popId = "SELECT MAX(Id_prodotto) as Id_prodotto FROM id_prodotti";
    $result = $conn->query($popId);
    $arrayId =mysqli_fetch_row($result);
    print_r($arrayId);
    
    $idToInsert = $arrayId[0];

    //QUERY
    $insert = "INSERT INTO `{$table}` (Id_p,Categoria,Prezzo,Marca,Modello,Url_Immagine,Descrizione)
    VALUES ('".$idToInsert."','".$categoria."', '".$prezzo."', '".$marca."','".$modello."','".$urlImg."','".$descrizione."')";

    $result = $conn->query($insert);
    
    if ($result) {
        $messaggio="Prodotto inserito con successo";
    } else {
        $messaggio="C'è stato un errore";
    }
    // $messaggio=" ermano";
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
    
    //$isProductPage determina se è una pagina prodotti o no
    $isProductPage=isProductPage($title,$menuPages);
    $isCategoryPage=isCategoryPage($title,$menuPages);
    $isSinglePage=isSinglePage($title,$menuPages);

    //se è una pagina prodotti => vado ad inserire dinamicamente tutti i prodotti dal DB
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
 
    //BREADCRUMB (deve essere messo alla fine)
    $breadcrumb=prepareBreadcrumb($title,$isProductPage,$isCategoryPage,$isSinglePage);
    $page=str_replace('{breadcrumb}',$breadcrumb,$page);
    
    echo $page;
}

?>