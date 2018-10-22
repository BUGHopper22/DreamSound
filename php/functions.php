<?php

    
//______________________________________________//
//                  HEADER
//______________________________________________//

class menuElement{
    //proprietà (o campi dati)
    var $name;
    var $url;
    var $buttonType;
    var $otherClass;
    //costruttore
    function __construct($name,$url,$buttonType,$otherClass){
        $this->name=$name;
        $this->url=$url;
        $this->buttonType=$buttonType;
        $this->otherClass=$otherClass;
    }
    //metodi:
    function getName(){
        return $this->name;
    }
    function getUrl(){
        return $this->url;
    }
    function getType(){
        return $this->buttonType;
    }
    function getClasse(){
        return $this->otherClass;
    }
    
}

function insertPages(){
    //ATTENZIONE LE PAGINE DEL SOTTOMENU DEVONO ESSERE SCRITTE IMMEDIATAMENTE DOPO IL DROPDOWN CHE LE CONTIENE
    echo("costruisce gli oggetti");
    $menuPages=array(
                    //  NAME                    URL                     TYPE                OTHERCLASS
        new menuElement('Home',                 'index.php',            'noDropDown',        ''),
        new menuElement('Cuffie',               'cuffie.php',          'dropDown',          ''),
        new menuElement('Cuffie in-ear',        'cuffieInEar.php',      'dropdown-content',  ''),
        new menuElement('Cuffie on-ear',        'cuffieOnEar.php',      'dropdown-content',  ''),
        new menuElement('Cuffie wireless',      'cuffieWireless.php',   'dropdown-content',  ''),
        new menuElement('Casse',                'casse.php',            'dropDown',          ''),
        new menuElement('Casse altoparlanti',   'casseAltoparlanti.php',    'dropdown-content',  ''),
        new menuElement('Casse bluetooth',      'casseBluetooth.php',       'dropdown-content',  ''),
        new menuElement('Accessori',            'accessori.php',        'dropDown',          ''),
        new menuElement('Accessori per cuffie', 'accessoriCuffie.php',   'dropdown-content',  ''),
        new menuElement('Accessori per casse',  'accessoriCasse.php',    'dropdown-content',  ''),
        new menuElement('About us',             'aboutUs.php',          'noDropDown',        ''),
        new menuElement('Carrello',             'carrello.php',         'noDropDown',        'menuDx'),
        new menuElement('Login',                'login.php',            'noDropDown',        'menuDx'),
    );
    return $menuPages;
}



//PRE: $i sarà l' indice della prima pagina del sottomenu, potenzialmente potrebbero non esserci pagine di sottomenu
function internalPagesCount($i,$menuPages,$size){
    $numInternalPages=0;
    while($i<=$size and $menuPages[$i]->getType()=="dropdown-content"){
        $numInternalPages +=1;
        $i++;
    }
    return $numInternalPages;
}
//POST: ritorna il numero di voci del sottomenu 

function prepareMenu($title){
    $menu='<ul>';
    $menuPages=insertPages();
    $size=count($menuPages);
    $i=0;
    while($i<$size){
        if($menuPages[$i]->getName()==$title){//active
            $menu=$menu.'<li class="active '.$menuPages[$i]->getType().' '.$menuPages[$i]->getClasse().' "><a class="dropbtn">'.$menuPages[$i]->getName().'</a>';
        }
        else{//notActive
            $menu=$menu.'<li class="notActive '.$menuPages[$i]->getType().' '.$menuPages[$i]->getClasse().'">
                        <a class="dropbtn" href="'.$menuPages[$i]->getUrl().'">'.$menuPages[$i]->getName().'</a>';
        }
        if($menuPages[$i]->getType()=='dropDown'){//sse dropdown
            $menu=$menu.'<div class="dropdown-content">';
            $numInternalPages=internalPagesCount($i+1,$menuPages,$size);//ritorna il numero delle sottopagine
            while($numInternalPages!=0){
                $i++;
                if($menuPages[$i]->getName()==$title){
                        $menu=$menu.'<a>'.$menuPages[$i]->getName().'</a>';
                }
                else{
                        $menu=$menu.'<a href='.$menuPages[$i]->getUrl().'>'.$menuPages[$i]->getName().'</a>';
                }
                $numInternalPages--;
            }
            $menu=$menu.'</div>';
        }
        $menu=$menu.'</li>';
        $i++;
    }
    $menu=$menu.'</ul>';
    return $menu;
}

//______________________________________________//
//                 BUILD PAGE
//______________________________________________//

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