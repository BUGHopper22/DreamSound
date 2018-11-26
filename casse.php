<?php
    $contentActualPage='
    <!-- IMMAGINE  CUFFIE IN-EAR -->
    <div id="outer" class="outer-altoparlanti"> <!-- La classe outer gestisce l immagine di sfondo -->
        <div class="inner">
            <h2>Casse Altoparlanti</h2>
            <p>Lorem ipsum dolor sit amet, consectetur
                adipiscing elit. Suspendisse tincidunt
                vel risus quis euismod. Aenean id tellus
                ut risus luctus mattis a nec mauris. .
            </p>
            <a href="./casseAltoparlanti.php?ntab=Casse">
                <button class="button" type="submit">Tutti i prodotti</button>
            </a>
        </div>
    </div>

    <!-- IMMAGINE CUFFIE ON-EAR -->
    <div id="outer" class="outer-casseBluetooth"> <!-- La classe outer gestisce l immagine di sfondo -->
        <div class="inner dx">
            <h2>Casse Bluetooth</h2>
            <p>Lorem ipsum dolor sit amet, consectetur
                adipiscing elit. Suspendisse tincidunt
                vel risus quis euismod. Aenean id tellus
                ut risus luctus mattis a nec mauris. .
            </p>
            <a href="./casseBluetooth.php?ntab=Casse">
                <button class="button" type="submit">Tutti i prodotti</button>
            </a>
        </div>
    </div>';
    require_once('php/functions.php');	//è un include di function
    BuildPage("Casse",$contentActualPage);	//funzione di buildpage dentro al file function
?>