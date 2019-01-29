<?php
    $contentActualPage='
    <div class="titlePage">
        <h1>Cuffie</h1>
    </div>
    <div id="category">
        <div class="outer outer-cuffieInEar">
            <div class="inner">
                <h2>Cuffie IN-EAR</h2>
                <p>Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit. Suspendisse tincidunt
                    vel risus quis euismod. Aenean id tellus
                    ut risus luctus mattis a nec mauris. .
                </p>
                <a class="button" href="./cuffieInEar.php?ntab=Cuffie" title=”Cuffie IN-EAR”>Tutti i prodotti</a>
            </div>
        </div>

        <div class="outer outer-cuffieOnEar">
            <div class="inner dx">
                <h2>Cuffie ON-EAR</h2>
                <p>Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit. Suspendisse tincidunt
                    vel risus quis euismod. Aenean id tellus
                    ut risus luctus mattis a nec mauris. .
                </p>
                <a class="button" href="./cuffieOnEar.php?ntab=Cuffie" title=”Cuffie ON-EAR”>Tutti i prodotti</a>
            </div>
        </div>

        <div class="outer outer-cuffieWireless">
            <div class="inner">
                <h2>Cuffie Wireless</h2>
                <p>Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit. Suspendisse tincidunt
                    vel risus quis euismod. Aenean id tellus
                    ut risus luctus mattis a nec mauris. .
                </p>
                <a class="button" href="./cuffieWireless.php?ntab=Cuffie" title=”Cuffie Wireless”>Tutti i prodotti</a>
            </div>
        </div>
    </div>';
    require_once('php/functions.php');	//è un include di function
    BuildPage("Cuffie",$contentActualPage);	//funzione di buildpage dentro al file function
?>