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

function queryDeleteProduct($conn,$name){
    return;
}

function queryAddProduct($conn){

}



// ____SERVE PER COSTRUIRE LA PAGINA
function BuildPage($title,$contentActualPage) {
    $page=file_get_contents('./content/structure.html');//carica la struttura con head e body
    $page=str_replace('{title}',$title,$page);
    
    $menuPages=createNavArray();//crea array con le pagine

    //Crea html menu
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
    //Aggiunta footer alla pagina
    $footer=file_get_contents('content/footer.html');
    $page=str_replace('{footer}',$footer,$page);
    // if(isset( $_SESSION["sessionUserId"])){
    //     echo("PECASDVAERBYRETTJETUYWHTAEGRFRAGSTRBH");
    //     $page=$page."ciao ".$_SESSION["sessionUserId"];
    // }

    //Breadcrumb
    $breadcrumb=prepareBreadcrumb($title,$isProductPage,$isCategoryPage,$isSinglePage);
    $page=str_replace('{breadcrumb}',$breadcrumb,$page);
    
    echo $page;
}

?>