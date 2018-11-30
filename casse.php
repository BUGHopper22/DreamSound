<?php
    $contentActualPage='
    <div class="titlePage">
        <h1>Casse</h1>
    </div>
    <div id="outer" class="outer-altoparlanti">
        <div class="inner">
            <h2>Casse Altoparlanti</h2>
            <p>Lorem ipsum dolor sit amet, consectetur
                adipiscing elit. Suspendisse tincidunt
                vel risus quis euismod. Aenean id tellus
                ut risus luctus mattis a nec mauris. .
            </p>
            <a class="button" href="./casseAltoparlanti.php?ntab=Casse">Tutti i prodotti</a>
        </div>
    </div>

    <div id="outer" class="outer-casseBluetooth">
        <div class="inner dx">
            <h2>Casse Bluetooth</h2>
            <p>Lorem ipsum dolor sit amet, consectetur
                adipiscing elit. Suspendisse tincidunt
                vel risus quis euismod. Aenean id tellus
                ut risus luctus mattis a nec mauris. .
            </p>
            <a class="button" href="./casseBluetooth.php?ntab=Casse">Tutti i prodotti</a>
        </div>
    </div>';
    require_once('php/functions.php');	//è un include di function
    BuildPage("Casse",$contentActualPage);	//funzione di buildpage dentro al file function
?>