<?php
    $contentActualPage='
    <body>
        <!-- IMMAGINE  CUFFIE IN-EAR -->
        <div id="outer" class="outer-accessoricuffie">
            <div class="inner">
                <h2>Accessori per Cuffie</h2>
                <p>Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit. Suspendisse tincidunt
                    vel risus quis euismod. Aenean id tellus
                    ut risus luctus mattis a nec mauris. .
                </p>
                <a href="./accessoriCuffie.php?ntab=Accessori">
                    <button class="button" type="submit">Tutti i prodotti</button>
                </a>
            </div>
        </div>

        <!-- IMMAGINE CUFFIE ON-EAR -->
        <div id="outer" class="outer-accessoricasse">
            <div class="inner dx">
                <h2>Accessori per Casse</h2>
                <p>Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit. Suspendisse tincidunt
                    vel risus quis euismod. Aenean id tellus
                    ut risus luctus mattis a nec mauris. .
                </p>
                <a href="./accessoriCasse.php?ntab=Accessori">
                    <button class="button" type="submit">Tutti i prodotti</button>
                </a>
            </div>
        </div>
    </body>';
    require_once('php/functions.php');	//è un include di function
    BuildPage("Accessori",$contentActualPage);	//funzione di buildpage dentro al file function
?>