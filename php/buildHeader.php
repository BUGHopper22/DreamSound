<?php
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
    //ATTENZIONE: LE PAGINE DEL SOTTOMENU DEVONO ESSERE SCRITTE IMMEDIATAMENTE DOPO IL DROPDOWN CHE LE CONTIENE
    $menuPages=array(
                    //  NAME                    URL                     TYPE                OTHERCLASS
        new menuElement('Home',                 'index',            '',                 ''),
        new menuElement('Cuffie',               'cuffie',           'dropDown',         ''),
        new menuElement('Cuffie in ear',        'cuffieInEar',      'dropdown-content', ''),
        new menuElement('Cuffie on ear',        'cuffieOnEar',      'dropdown-content', ''),
        new menuElement('Cuffie wireless',      'cuffieWireless',   'dropdown-content', ''),
        new menuElement('Casse',                'casse',            'dropDown',         ''),
        new menuElement('Casse Altoparlanti',   'casseAltoparlanti','dropdown-content', ''),
        new menuElement('Casse Bluetooth',      'casseBluetooth',   'dropdown-content', ''),
        new menuElement('Accessori',            'accessori',        'dropDown',         ''),
        new menuElement('Accessori Cuffie',     'accessoriCuffie',  'dropdown-content', ''),
        new menuElement('Accessori Casse',      'accessoriCasse',   'dropdown-content', ''),
        new menuElement('Contatti',             'contatti',          '',                 ''),
        new menuElement('Profilo',              'profilo',          'dropDown',         ' menuDx'),
        new menuElement('Carrello',             'carrello',         'dropdown-content',  ''),
        new menuElement('Storico ordini',       'storicoOrdini',    'dropdown-content',  ''),
        // new menuElement('Login',                'login',            '',                 'menuDx'),
        //1)manca una pagina dinamica per la struttura unica di ogni singlo prodotto.
        //per quel che riguarda le pagine con la lista dei prodotti(stile amazon) basta semplicemente
        //2)creare un unica pagina dinamica che creerà la stessa struttura per tutti ma con idfferenti prodotti in base al nome della pagina
        //richiesta, prendendo questi dati dal database
        //3)paigna di admin da aggngere
    );
    return $menuPages;
}



//PRE: $i sarà l' indice della prima pagina del sottomenu, potenzialmente potrebbero non esserci pagine di sottomenu
function internalPagesCount($i,$menuPages,$size){
    $numInternalPages=0;
    while($i<$size and $menuPages[$i]->getType()=="dropdown-content"){
        $numInternalPages +=1;
        $i++;
    }
    return $numInternalPages;
}
//POST: ritorna il numero di voci del sottomenu 

function prepareMenu($title,$menuPages){
    if($title=="Home"){
        $linkLogo="";
    }else{
        $linkLogo="./index.php";
    }
    
    $menu='<div id="navbar-container" role="navigation">
                <input type="checkbox">
                    <span></span>
                    <span></span>
                    <span></span>
                <a href="'.$linkLogo.'"><img src=./img/icon/logo2.png class="logo" alt="Logo DreamSound"></a>
                <img src=./img/icon/logomobile.png class="logoMobile" alt="Logo DreamSound">';
        //<img src=./img/icon/logomobile.png class="logoMobile">; Ho commentato perchè sballava tutto, riflettere se da rimettere
        
    $menu=$menu.'
                <ul class="mobile">';
    $size=count($menuPages);
    $i=0;
    while($i<$size){
        //si potrebbe fare con find actual page
        if($menuPages[$i]->getName()==$title){//active
            
            $menu=$menu.'
                    <li class="active '.$menuPages[$i]->getType().''.$menuPages[$i]->getClasse().'">
                        <a class="dropbtn">'.$menuPages[$i]->getName().'</a>';
        }
        else{//notActive
            $menu=$menu.'
                    <li class="notActive '.$menuPages[$i]->getType().''.$menuPages[$i]->getClasse().'">
                        <a href="'.$menuPages[$i]->getUrl().'.php">'.$menuPages[$i]->getName().'</a>';
        }
        if($menuPages[$i]->getType()=='dropDown'){//sse dropdown
            $name=$menuPages[$i]->getName();
            $menu=$menu.'
                            <img class="arrow" src="./img/icon/arrowDown2.png" aria-hidden="true" alt="freccia dropdown">
                            <div class="dropdown-content">';
            $numInternalPages=internalPagesCount($i+1,$menuPages,$size);//ritorna il numero delle sottopagine
            while($numInternalPages!=0){
                $i++;
                $menu=$menu.'
                                <a ';
                if($menuPages[$i]->getName()!=$title){
                    
                    $menu=$menu.'href='.$menuPages[$i]->getUrl().'.php?ntab='.$name;
                }
                $menu=$menu.'>'.$menuPages[$i]->getName().'</a>';
                $numInternalPages--;
            }
            $menu=$menu.'
                            </div>';
        }
        $menu=$menu.'
                    </li>';
        $i++;
    }
    $menu=$menu.'
                </ul>';
    $menu=$menu.'
            </div>';
    return $menu;
}
?>