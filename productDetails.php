<?php
    $contentActualPage='
    <div id="productContainer">
    <h1>Auricolari Apple EarPodss</h1>
        <div class="imgContainer">
            <img class="productImg" src="./img/prodotti/cuffieInear/inear1.png" alt="prodotto1" >
        </div>
        <div class="product">
            <p>Tipo connettore:Auricolare (jack 3.5 mm 4 poli)<br> Controllo del volume sul cavo: Sì<br> Fattore di forma
                cuffie:In-ear<br> Impedenza:23 Ohm <br>Risposta frequenza:5 - 21000 Hz<br>
                Sensibilità:109 dB/mW<br> Modalità uscita audio:Stereo<br>
                Tecnologia di connessione:Cablato <br>Tipo prodotto:Cuffie con microfono<br> Peso:10.2
            </p>
        </div>
        <div class="buyContainer">
            <div class="productPrice">
                <h3>Pezzo: 50$</h3>
            </div>
            <a class="compra" href="">
                <p>Aggiungi al carrello</p>
            </a>
        </div>
    </div>';
    require_once('php/functions.php');	//è un include di function
    BuildPage("Dettagli prodotto",$contentActualPage);	//funzione di buildpage dentro al file function
?>