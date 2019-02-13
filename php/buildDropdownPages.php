<?php
/*ritorna un array associato con tutti i prodotti da inserire nella pagina titlePage*/
function insertProductList($titleTable,$category){
    require "./database/connessione.php";
    $result = $conn->query("SELECT * FROM `{$titleTable}` WHERE categoria='$category' AND Visibile='1'");
    // $resultSql = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    $htmlProduct='
    <div class="titlePage">
        <h1>'.$category.'</h1>
    </div>
    <div id="productsListContainer">';
    $cont=0;
    foreach($result as $listProduct){
        $cont=$cont+1;
        $htmlProduct=$htmlProduct.'
        <div class="productsContainer">
            <div class="imgsContainer">
                <img class="productsImg" src="./img/prodotti'.$listProduct["Url_immagine"].'" alt="'.$listProduct["Modello"].'" >
            </div>
        
            <div class="descriptionsContainer">
                <h2>'.$listProduct['Modello'].'</h2>
                <p>'.$listProduct['Descrizione'].'</p>
                <div class="details">
                    <div class="productsPrice">
                        <h4>Pezzo: '.$listProduct['Prezzo'].'€</h4>
                    </div>
                    <a class="button" href="./singoloProdotto.php?idProdotto='.$listProduct['Id_p'].'&titleTable='.$titleTable.'&categoria='.$category.'" title="'.$listProduct['Modello'].'" tabindex="'.$cont.'">
                        <p>Piú dettagli</p>
                    </a>
                </div>
            </div>
        </div>';
    }
    $htmlProduct=$htmlProduct.'</div>';
    // <div class="productsImg"></div>
    // height="300" width="300"
    return $htmlProduct;   
}
?>