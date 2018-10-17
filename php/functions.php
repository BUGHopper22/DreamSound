<?php


// _____HEADER_____
function PrepareHeader($title) {
    
    $header=file_get_contents("contents/header.html");
    $header=str_replace('{booking-btn}',$btn,$header);
    return $header;
}

// 
function PrepareMenu($title) {
    $menuEntry=array(
        'Home'=>'index.php',
        'Cuffie'=>'cuffie.php',
        'Casse'=>'casse.php',
        'Accessori'=>'accessori.php',
        'About us'=>'aboutus.php',
        'Carrello'=>'carrello.php',
        'Login'=>'login.php',
        'Menù'=>'#naventry-home'
    );
    $tabindex = 2;
    $menu='<ul>';
    foreach($menuEntry as $index=>$link) {// per ogni elemento del mio array menuentry associo la variabile index agli indici del mio array, e la variabile link a tutteìi i link all interno del mio array
        
        if($index==$title) {//title è il parametro della funzione prepareMenu
            if($index=='Cuffie' or $index=='Casse' or $index=='Accessori'){
                $menu=$menu.'<li class="dropdown"><a class="active">'.$index.'</a></li>';
            }
            else{
                $menu=$menu.'<li><a class="active">'.$index.'</a></li>';
            }
        }
        else {
            if($index=='Cuffie' or $index=='Casse' or $index=='Accessori'){
                $menu=$menu.'<li class="dropdown"><a class="not-active">'.$index.'</a></li>';
            }
            else{
                $menu=$menu.'<li><a class="not-active">'.$index.'</a></li>';
            }

        //   if($link=='#naventry-home')
        //       $menu=$menu.'<li class="menu" id="naventry-menu">' . $index .
        //         '<img src="img/menu-bars-icon.png" alt="Menu bars icon" class="menu-bars-icon" /></li>';
        //   else{
        //     $menu=$menu.'<li class="menu"><a class="not-active" tabindex="'.$tabindex.'" href="'.$link.'">'.$index.'</a></li>';
        //     $tabindex++;
          }
        }
       
    }
    $menu=$menu.'</ul>';
    return $menu;
}

// ____SERVE PER COSTRUIRE LA PAGINA
function BuildPage($title,$content,$array=0) {
    $page=file_get_contents("contents/structure.html");
    $page=str_replace('{title}',$title,$page);
    // $header=PrepareHeader($title);
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