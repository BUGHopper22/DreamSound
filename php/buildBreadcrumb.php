<?php
//ATTENZIONE MANCA IL CASO DEL SINGOLO PRODOTTO!!!!!!!!!!!!!!!! RICORDATI
function prepareBreadcrumb($title,$isProductPage,$isCategoryPage,$isSinglePage){
    $breadcrumb='<div id="breadcrumb">';
    if($title=="Home"){
        $breadcrumb=$breadcrumb.'Home ';
    }
    elseif($title=="Storico ordini" || $title=="Carrello" ){
        $breadcrumb=$breadcrumb.'<a href="./index.php"> Home</a> > <a href="./profilo.php"> Profilo</a> > '
                    .$title;
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
    else if($isSinglePage || $title=="Login" || $title="Amministratore"){
        $breadcrumb=$breadcrumb.'<a href="./index.php"> Home</a> > '.$title;
    }
    else{//sono sul singolo product detail DA FINIRE BREADCRUMB PER PAGINE DETTAGLIO
        $categoria=$_REQUEST["categoria"];
        switch ($categoria) {
            case "Cuffie in ear":
                $ntab="Cuffie";
                $primaryCategory="cuffie";
                $urlSecondaryCategory="./cuffieInEar";
                break;
            case "Cuffie on ear":
            $ntab="Cuffie";
                $primaryCategory="cuffie";
                $urlSecondaryCategory="./cuffieOnEar";
                break;
            case "Cuffie wireless":
                $ntab="Cuffie";
                $primaryCategory="cuffie";
                $urlSecondaryCategory="./cuffieWireless";
                break;
            case "Casse Altoparlanti":
                $ntab="Casse";
                $primaryCategory="casse";
                $urlSecondaryCategory="./casseAltoparlanti";
                break;
            case "Casse Bluetooth":
                $ntab="Casse";
                $primaryCategory="casse";
                $urlSecondaryCategory="./casseBluetooth";
                break;
            case "Accessori Cuffie":
                $ntab="Accessori";
                $primaryCategory="accessori";
                $urlSecondaryCategory="./accessoriCuffie";
                break;
            case "Accessori Casse":
                $ntab="Accessori";
                $primaryCategory="accessori";
                $urlSecondaryCategory="./accessoriCasse";
                break;
            default:
                echo "Your favorite color is neither red, blue, nor green!";
        }
        $breadcrumb=$breadcrumb.'<a href="./index.php"> Home</a> ><a href="./'.$primaryCategory.'.php"> '.$ntab.'</a> > <a href="./'.$urlSecondaryCategory.'.php?ntab='.$ntab.'"> '.$categoria.'</a> > '.$title;
    }
    //se l' utente è connesso
    if(isset( $_SESSION["sessionUserId"])){
        $breadcrumb=$breadcrumb.'
        <div class="welcomeUser">
            <div class="showWelcome">
            benvenuto '.$_SESSION["sessionUserId"].', <a href="./index.php?logout=1"> logout</a>
            </div>
        </div>';
    }else{
        $breadcrumb=$breadcrumb.'
        <div class="welcomeUser">
            <div class="showWelcome">
            <a href="./login.php"> login</a>
            </div>
        </div>';
    }
    return $breadcrumb;            
}
?>