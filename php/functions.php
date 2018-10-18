<?php


// _____HEADER_____
function PrepareHeader($title) {
    
    $header=file_get_contents("contents/header.html");
    $header=str_replace('{booking-btn}',$btn,$header);
    return $header;
}

// function PrepareDropDownContent($index,$title){
//     $memDiv='<div class="dropdown-content">';
//     if($index=='Cuffie'){
//         if($title==''){
//             $memDiv=$memDiv.
//             '<a href="#">Cuffie in-ear</a>
//             <a href="#">Cuffie on-ear</a>
//             <a href="#">Cuffie wireless</a>';
//         }
//     }
//     if($index=='Casse')
//     if($index=='Accessori')
//     $memDiv=$memDiv.'</div>';
//     return $memDiv;
// }

// 

class menuElement{
    //proprietà (sono i campi dati della classe)
    private $url;
    private $classe;
    //costruttore
    public function __costruct($url,$classe){
        $this->url=$url;
        $this->classe=$classe;
    }
    //metodi
    public function getUrl() const{
        return $this->url;
    }
    public function getClasse() const{
        return $this->classe;
    }
    
}

//___Per aggiungere pagine ai sottomenu:
function InsertInternalMenu($namePage){
    if($namePage=='Cuffie')
        return array(
            'Cuffie in-ear'=>'cuffieInEar.php',
            'Cuffie on-ear'=>'cuffieOnEar.php',
            'Cuffie wireless'=>'cuffieWireless.php',
        );
    if($namePage=='Casse')
        return array(
            'Casse altoparlanti'=>'casseAltoparlanti',
            'Casse bluetooth'=>'casseBluetooth',
        );
    if($namePage=='Accessori')
        return array(
            'Accessori per cuffie'=>'accessoriPerCuffie',
            'Accessori per casse'=>'accessoriPerCasse'
        );
}

function PrepareMenu($title) {
    $menuEntry=array(
        'Home'      =>new menuElement('index.php',''),
        'Cuffie'    =>new menuElement('cuffie.php','dropdown'),
        'Casse'     =>new menuElement('casse.php','dropdown'),
        'Accessori' =>new menuElement('accessori.php','dropdown'),
        'About us'  =>new menuElement('aboutUs.php',''),
        'Carrello'  =>new menuElement('carrello.php','menuDx'),
        'Login'     =>new menuElement('login.php','menuDx'),
    );

    $menu='<ul>';
    //  per ogni elemento del mio array menuentry associo la variabile $element agli indici del mio array,
    foreach($menuEntry as $index=>$element) {
        if($index==$title)
            $isActive='active';
        else
            $isActive='notActive';
        if($element->getClasse()=='dropDown'){//<li> con dropdown
            $menuInternalEntry=InsertInternalMenu($index);//riempie $menuInternalEntry con le pagine del sottomenu cosrrispondente
            $menu=$menu.
            '<li class="'.$isActive.' '.$element->getClasse().'><a class="dropbtn">'.$index.'</a><div class="dropdown-content">';
            $menu=$menu.'<div>';
            foreach($menuInternalEntry as $indexI=>$elementI){//non trattato isActive per il menu interno
                $menu=$menu.'<a href="'.$elementI'">'.$indexI.'</a>';
            }
            $menu=$menu.'</div></li>';
        }
        else{//<li> senza dropdown   
            $menu=$menu.
            '<li class="'.$isActive.' '.$element->getClasse().'><a class="dropbtn">'.$index.'</a></li>';
        }
    }
    $menu=$menu.'</ul>';
    return $menu;
}

// ____SERVE PER COSTRUIRE LA PAGINA
function BuildPage($title,$content,$array=0) {
    $page=file_get_contents("contents/structure.html");
    $page=str_replace('{title}',$title,$page);// $header=PrepareHeader($title);
    $navbar=PrepareMenu($title);
    
    $header=file_get_contents("contents/header.html");
    $page=str_replace('{header}',$header,$page);
    $navbar=PrepareMenu($title);
    $page=str_replace('{navbar}',$navbar,$page);
    $breadcrumb=PrepareBreadcrumb($title);
    $page=str_replace('{breadcrumb}',$breadcrumb,$page);
    if($array==1)
        $body=$content;
    else
        $body=file_get_contents($content);
    $page=str_replace('{content}',$body,$page);
    $mobilenavbar=PrepareMobileMenu($title);
    $page=str_replace('{mobilenavbar}',$mobilenavbar,$page);
    $footer=PrepareFooter($title);
    $page=str_replace('{footer}',$footer,$page);
    echo $page;

}

?>