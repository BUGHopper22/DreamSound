<?php
//ATTENZIONE MANCA IL CASO DEL SINGOLO PRODOTTO!!!!!!!!!!!!!!!! RICORDATI
function prepareBreadcrumb($title,$isProductPage,$isCategoryPage){
    $breadcrumb='<div id="breadcrumb">';
    if($title=="Home"){
        $breadcrumb=$breadcrumb.'Home ';
    }
    else if($isProductPage){//pagina prodotti(pagina con la lista dei prodotti per categoria)
        $breadcrumb=$breadcrumb.
                    '<a href="./index.php"> Home</a> >
                    <a href="./'.$_REQUEST["ntab"].'.php"> '.$_REQUEST["ntab"].'</a> > '
                    .$title;
    }
    else if($isCategoryPage){//pagina categorie(CUFFIE,CASSE,ECC)
        $breadcrumb=$breadcrumb.'<a href="./index.php"> Home</a> > '.$title;
    }
    else{//sono sul singolo product detail DA FINIRE BREADCRUMB PER PAGINE DETTAGLIO
        $breadcrumb=$breadcrumb.'<a href="./index.php"> Home</a> >
                                <a href="./'.$_REQUEST["ntab"].'.php">'.$_REQUEST["ntab"].'</a> >
                                '.$title;
    }
    //se l' utente è connesso
    if(isset( $_SESSION["sessionUserId"])){
        $breadcrumb=$breadcrumb.'
        <div class="welcomeUser">
            <div class="showWelcome">
            benvenuto '.$_SESSION["sessionUserId"].', <a href="./index.php?logout=1"> logout</a>
            </div>
        </div>';
    }
    return $breadcrumb;            
}
?>