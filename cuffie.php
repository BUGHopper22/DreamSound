<?php
    $contentActualPage='
    <div class="titlePage">
        <h1>Cuffie</h1>
    </div>
    <div id="outer" class="outer-cuffieInEar">
        <div class="inner">
            <h2>Cuffie IN-EAR</h2>
            <p>Lorem ipsum dolor sit amet, consectetur
                adipiscing elit. Suspendisse tincidunt
                vel risus quis euismod. Aenean id tellus
                ut risus luctus mattis a nec mauris. .
            </p>
            <a class="button" href="./cuffieInEar.php?ntab=Cuffie">Tutti i prodotti</a>
        </div>
    </div>

    <!-- IMMAGINE CUFFIE ON-EAR -->
    <div id="outer" class="outer-cuffieOnEar">
        <div class="inner dx">
            <h2>Cuffie ON-EAR</h2>
            <p>Lorem ipsum dolor sit amet, consectetur
                adipiscing elit. Suspendisse tincidunt
                vel risus quis euismod. Aenean id tellus
                ut risus luctus mattis a nec mauris. .
            </p>
            <a class="button" href="./cuffieOnEar.php?ntab=Cuffie">Tutti i prodotti</a>
        </div>
    </div>

    <!-- IMMAGINE CUFFIE WIRELESS -->
    <div id="outer" class="outer-cuffieWireless">
        <div class="inner">
            <h2>Cuffie Wireless</h2>
            <p>Lorem ipsum dolor sit amet, consectetur
                adipiscing elit. Suspendisse tincidunt
                vel risus quis euismod. Aenean id tellus
                ut risus luctus mattis a nec mauris. .
            </p>
            <a class="button" href="./cuffieWireless.php?ntab=Cuffie">Tutti i prodotti</a>
        </div>
    </div>';
    require_once('php/functions.php');	//è un include di function
    BuildPage("Cuffie",$contentActualPage);	//funzione di buildpage dentro al file function
?>