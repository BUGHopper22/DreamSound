<?php
    $contentActualPage='
    <div class="titlePage">
        <h1>Carrello</h1>
    </div>
    <div id="carrello">
        <div class="carrelloImgContainer">
            <img class="carrelloImg" src="./img/prodotti/cuffieInear/inear1.png" alt="prodotto1">
        </div>
        <div class="carrelloDescriptionContainer">
            <h3>Cuffie dc</h3>
            <p class="carrelloDescription">asasdsijdajci jincsisnxndsg dsggdsfgdfs gdfsgdsfgdsg hsdfgdsh dshsdfhgsd xasuncsn xo assa sss</p>
            <div class="quantity">
                <p>Quantita: N</p>
                <a class="quantityBotton" href="">
                    <p>-</p>
                </a>
                <a class="quantityBotton" href="">
                    <p>+</p>
                </a>
            </div>
            <div class="productPrice">prezzo: 50$</div>
            <a class="removeBotton" href=""><p>Rimuovi</p></a>
        </div>
    </div>

    <div id="carrello">
        <div class="carrelloImgContainer">
            <img class="carrelloImg" src="./img/prodotti/cuffieInear/inear1.png" alt="prodotto1">
        </div>
        <div class="carrelloDescriptionContainer">
            <h3>Cuffie dc</h3>
            <p class="carrelloDescription">Cuffie dio cane di dio</p>
                <div class="quantity">
                    <p>Quantita: N</p>
                    <a class="quantityBotton" href="">
                        <p>-</p>
                    </a>
                    <a class="quantityBotton" href="">
                        <p>+</p>
                    </a>
                </div>
            <div class="productPrice">prezzo: 50$</div>
            <a class="removeBotton" href=""><p>Rimuovi</p></a>
        </div>
    </div>
    
    <div class="totalPriceContainer">
        <h3 class="totalPrice">Totale: 12312$</h3>
    </div>';
    require_once('php/functions.php');	//è un include di function
    BuildPage("Carrello",$contentActualPage);	//funzione di buildpage dentro al file function
?>