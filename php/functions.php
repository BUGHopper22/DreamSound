<?php 
include 'insertUser.php';
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
        new menuElement('About us',             'aboutUs',          '',                 ''),
        new menuElement('Carrello',             'carrello',         '',                 'menuDx'),
        new menuElement('Login',                'login',            '',                 'menuDx'),
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
    while($i<=$size and $menuPages[$i]->getType()=="dropdown-content"){
        $numInternalPages +=1;
        $i++;
    }
    return $numInternalPages;
}
//POST: ritorna il numero di voci del sottomenu 

function prepareMenu($title,$menuPages){
    $menu='<nav id="navbar-container" role="navigation">
    <input type="checkbox">
        <span></span>
        <span></span>
        <span></span>';
    $menu=$menu.'<ul id="mobile">';
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
            $name=$menuPages[$i]->getName();
            $menu=$menu.'<div class="dropdown-content">';
            $numInternalPages=internalPagesCount($i+1,$menuPages,$size);//ritorna il numero delle sottopagine
            while($numInternalPages!=0){
                $i++;
                $menu=$menu.'<a ';
                if($menuPages[$i]->getName()!=$title){
                    
                    $menu=$menu.' href='.$menuPages[$i]->getUrl().'.php?ntab='.$name;
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
//               PAGINE PRODOTTI
//______________________________________________//
/*L' idea si basa sul fatto che se una pagina ha l ' attributo type==dropDown-content
    allora è una pagina di prodotti=> andrò a creare dinamicamente i prodotti della pagina.
    Ritorna true sse sono su una pagina prodotti*/ 
function isProductPage($title,$menuPages){
    $esci=FALSE;
    $size=count($menuPages);
    $scorri=0;
    // echo ($esci==FALSE); 
    while($scorri<$size and $esci==FALSE){
        if($title==$menuPages[$scorri]->getName() and $menuPages[$scorri]->getType()=='dropdown-content'){
            $esci=TRUE;
        }
        $scorri++;
    }
    return $esci;
}

/*ritorna un array associato con tutti i prodotti da inserire nella pagina titlePage*/
function insertProductList($titleTable,$category){
    require "./database/connessione.php";
    $result = $conn->query("SELECT * FROM `{$titleTable}` WHERE categoria='$category'");
    // $resultSql = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    echo $count;
    $htmlProduct=" ";
    foreach($result as $listProduct){
        $htmlProduct=$htmlProduct.'<div id="productsContainer">
        <div class="imgsContainer">
            <img class="productsImg" src="./img/prodotti'.$listProduct["Url_immagine"].'" alt="prodotto1" >
        </div>
    
        
        <div class="products">
            <h2>'.$listProduct['Modello'].'</h2>
            <p>'.$listProduct['Descrizione'].
            '</p>
        </div>
        <div class="detailsContainer">
            <div class="productsPrice">
                <h3>Pezzo: '.$listProduct['Prezzo'].'</h3>
            </div>
                <!-- <button class="details"><a href="product.html">Piú dettagli</a></button> -->
                <a class="details" href="productDetails.php">
                    <p>Piu\' dettagli</p>
                </a>
        </div>
        </div>';
    }
    // <div class="productsImg"></div>
    // height="300" width="300"
     return $htmlProduct;   
}



//______________________________________________//
//                 BUILD PAGE
//______________________________________________//

// ____SERVE PER COSTRUIRE LA PAGINA
function BuildPage($title,$content) {
    $page=file_get_contents('content/structure.html');//carica la struttura con head e body
    $page=str_replace('{title}',$title,$page);
    //crea array con le pagine
    $menuPages=createNavArray();

    //Crea html menu
    $header=PrepareMenu($title,$menuPages);
    $page=str_replace('{header}',$header,$page);
    
    //$isProductPage determina se è una pagina prodotti o no
    $isProductPage=isProductPage($title,$menuPages);
    //se è una pagina prodotti => vado ad inserire dinamicamente tutti i prodotti
    if($isProductPage){
        if(isset($_REQUEST["ntab"])){
            $titleTable=$_REQUEST["ntab"];
        }
        $contentActualPage=insertProductList($titleTable,$title);
    }
    else{//altrimenti vado a prendere il contenuto da file.html
        echo("******isProductPage è false(ELSE)*******");
        if($title=="Login"){
            echo("DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD");
            $contentActualPage=loginContent();//per ora dentro al file loginUser.php meglio cambiare i nomi
        }
        else{
            $contentActualPage=file_get_contents($content);
        }
    }
    $page=str_replace('{content}',$contentActualPage,$page);
    echo $page;
}

?>