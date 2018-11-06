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

function createNavArray(){
    //ATTENZIONE LE PAGINE DEL SOTTOMENU DEVONO ESSERE SCRITTE IMMEDIATAMENTE DOPO IL DROPDOWN CHE LE CONTIENE
    $menuPages=array(
                    //  NAME                    URL                     TYPE                OTHERCLASS
        new menuElement('Home',                 'index',            '',                 ''),
        new menuElement('Cuffie',               'cuffie',           'dropDown',         ''),
        new menuElement('Cuffie in-ear',        'cuffieInEar',      'dropdown-content', ''),
        new menuElement('Cuffie on-ear',        'cuffieOnEar',      'dropdown-content', ''),
        new menuElement('Cuffie wireless',      'cuffieWireless',   'dropdown-content', ''),
        new menuElement('Casse',                'casse',            'dropDown',         ''),
        new menuElement('Casse altoparlanti',   'casseAltoparlanti','dropdown-content', ''),
        new menuElement('Casse bluetooth',      'casseBluetooth',   'dropdown-content', ''),
        new menuElement('Accessori',            'accessori',        'dropDown',         ''),
        new menuElement('Accessori per cuffie', 'accessoriCuffie',  'dropdown-content', ''),
        new menuElement('Accessori per casse',  'accessoriCasse',   'dropdown-content', ''),
        new menuElement('About us',             'aboutUs',          '',                 ''),
        new menuElement('Carrello',             'carrello',         '',                 'menuDx'),
        new menuElement('Login',                'login',            '',                 'menuDx'),
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

function prepareMenu($title,$menuPages){
    $menu='<nav class="navbar-container">';
    $menu=$menu.'<ul>';
    $size=count($menuPages);
    $i=0;
    while($i<$size){
        //si potrebbe fare con find actual page
        if($menuPages[$i]->getName()==$title){//active
            $menu=$menu.'<li class="active '.$menuPages[$i]->getType().' '.$menuPages[$i]->getClasse().' ">
                                                            <a class="dropbtn">'.$menuPages[$i]->getName().'</a>';
        }
        else{//notActive
            $menu=$menu.'<li class="notActive '.$menuPages[$i]->getType().' '.$menuPages[$i]->getClasse().'">
                        <a class="dropbtn" href="'.$menuPages[$i]->getUrl().'.php">'.$menuPages[$i]->getName().'</a>';
        }
        if($menuPages[$i]->getType()=='dropDown'){//sse dropdown
            $menu=$menu.'<div class="dropdown-content">';
            $numInternalPages=internalPagesCount($i+1,$menuPages,$size);//ritorna il numero delle sottopagine
            while($numInternalPages!=0){
                $i++;
                $menu=$menu.'<a ';
                if($menuPages[$i]->getName()!=$title){
                    $menu=$menu.' href='.$menuPages[$i]->getUrl().'.php';
                }
                $menu=$menu.'>'.$menuPages[$i]->getName().'</a>';
                $numInternalPages--;
            }
            $menu=$menu.'</div>';
        }
        $menu=$menu.'</li>';
        $i++;
    }
    $menu=$menu.'</ul>';
    $menu=$menu.'</nav>';
    return $menu;
}

//______________________________________________//
//                 BUILD PAGE
//______________________________________________//

// function findActualUrl($title,$menuPages){
//     $esci=false;
//     $size=count($menuPages);
//     $scorri=0;
//     while($scorri<$size and !$esci){
//         if($menuPages[$scorri]->getName()==$title)
//             $esci=true;
//     }
//     return $menuPages[$scorri]->getUrl();
// }

// ____SERVE PER COSTRUIRE LA PAGINA
function BuildPage($title,$content) {
    $page=file_get_contents('content/structure.html');//carica la struttura con head e body
    $page=str_replace('{title}',$title,$page);
    //crea array con le pagine
    $menuPages=createNavArray();
    //Crea il menu con l'array di pagine
    $header=PrepareMenu($title,$menuPages);
    $page=str_replace('{header}',$header,$page);
    
    $contentActualPage=file_get_contents($content);
    $page=str_replace('{content}',$contentActualPage,$page);
    echo $page;
}

?>