<?php




/*ritorna un array associato con tutti i prodotti da inserire nella pagina titlePage*/
function insertProductList($titleTable,$category){
    require "./database/connessione.php";
    $result = $conn->query("SELECT * FROM `{$titleTable}` WHERE categoria='$category'");
    // $resultSql = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    $htmlProduct=" ";
    foreach($result as $listProduct){
        $htmlProduct=$htmlProduct.'
        <div id="productsContainer">
            <div class="imgsContainer">
                <img class="productsImg" src="./img/prodotti'.$listProduct["Url_immagine"].'" alt="prodotto1" >
            </div>
        
            
            <div class="descriptionsContainer">
                <h2>'.$listProduct['Modello'].'</h2>
                <p>'.$listProduct['Descrizione'].
                '</p>
            
                <div class="details">
                    <div class="productsPrice">
                        <h4>Pezzo: '.$listProduct['Prezzo'].'</h4>
                    </div>
                    <a class="button" href="productDetails.php?modello='.$listProduct['Modello'].'&marca='.$listProduct['Marca'].'&descrizione='.$listProduct['Descrizione'].'&prezzo='.$listProduct['Prezzo'].'&img='.$listProduct['Url_immagine'].'&categoria='.$listProduct['Categoria'].'">
                        <p>Piu\' dettagli</p>
                    </a>
                </div>
            </div>
        </div>';
    }
    // <div class="productsImg"></div>
    // height="300" width="300"
     return $htmlProduct;   
}
?>