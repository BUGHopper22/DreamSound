<?php


class menuElement{
    //proprietà (sono i campi dati della classe)
    var $url;
    var $classe;
    //costruttore
    function __construct($url,$classe){
        echo("Costruisce\n");
        $this->url=$url;
        $this->classe=$classe;
    }
    //metodi
    function getUrl(){
        return $this->url;
    }
    function getClasse(){
        // echo("entra in getClasse\n");
        
        $prova=$this->classe;
        var_dump($prova);
        return $prova;
    }
    // public function toStringClass(){
    //     return "$this->classe";
    // }
    // public function __toStringUrl(){
    //     return "$this->classe";
    // }
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
        'Home'      =>new menuElement('index.php',' '),
        'Cuffie'    =>new menuElement('cuffie.php','dropDown'),
        'Casse'     =>new menuElement('casse.php','dropDown'),
        'Accessori' =>new menuElement('accessori.php','dropDown'),
        'About us'  =>new menuElement('aboutUs.php',''),
        'Carrello'  =>new menuElement('carrello.php','menuDx'),
        'Login'     =>new menuElement('login.php','menuDx'),
    );
    $menu='<ul>';
    //  per ogni elemento del mio array menuentry associo la variabile $element agli indici del mio array,
    
    foreach($menuEntry as $index=>$element) {
        if($index==$title){//active
            $menu=$menu.'<li class="active '.$element->getClasse().'"><a class="dropbtn">'.$index.'</a>';
        }
        else{//notActive
            $menu=$menu.'<li class="notActive '.$element->getClasse().'"><a class="dropbtn" href="'.$element->getUrl().'">'.$index.'</a>';
        }
        if($element->getClasse()=='dropDown'){//sse dropdown
            // echo("stampa");
            // echo($element->getClasse());
            $menuInternalEntry=InsertInternalMenu($index);//riempie $menuInternalEntry con le pagine del sottomenu cosrrispondente
            $menu=$menu.'<div class="dropdown-content">';
            foreach($menuInternalEntry as $indexI=>$elementI){
                if($indexI==$title)
                    $menu=$menu.'<a>'.$indexI.'</a>';
                else
                    $menu=$menu.'<a href='.$elementI.'">'.$indexI.'</a>';
            }
            $menu=$menu.'</div>';
        }
        $menu=$menu.'</li>';
    }
    $menu=$menu.'</ul>';
    return $menu;
}

// ____SERVE PER COSTRUIRE LA PAGINA
function BuildPage($title,$content,$array=0) {
    $page=file_get_contents('content/structure.html');
    $page=str_replace('{title}',$title,$page);
    $header=PrepareMenu($title);// costruisce header con menu
    $page=str_replace('{header}',$header,$page);
    // $header=file_get_contents("contents/header.html");
    // $page=str_replace('{header}',$header,$page);
    // $navbar=PrepareMenu($title);
    // $page=str_replace('{navbar}',$navbar,$page);
    // $breadcrumb=PrepareBreadcrumb($title);
    // $page=str_replace('{breadcrumb}',$breadcrumb,$page);
    // if($array==1)
    //     $body=$content;
    // else
    //     $body=file_get_contents($content);
    // $page=str_replace('{content}',$body,$page);
    // $mobilenavbar=PrepareMobileMenu($title);
    // $page=str_replace('{mobilenavbar}',$mobilenavbar,$page);
    // $footer=PrepareFooter($title);
    // $page=str_replace('{footer}',$footer,$page);
    echo $page;

}

?>