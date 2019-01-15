<?php
    $contentActualPage='
        <div id="aboutusouter" class="aboutusouter-aboutus">
        </div>
        <div class="titlePage">
            <h1>About us</h1>
        </div>
        <div id="aboutusContainer">
            <div class="imgsContainer">
                  <img class="storysImg" src="./img/icon/logo.png">
            </div>
            <div class="storys">
                <h1>IERI</h1>   
                <p>
                    Pitti Immagine is an Italian company devoted to promoting the fashion industry worldwide. From the top down, its motivated staff fully believes in the concept 
                    of the modern trade fair as an event that is in a constant stage of renewal and 
                    development – indeed Pitti Immagine has recently expanded its scope to include 
                    other industries such as food and fragrance. According to Pitti Immagine the
                    trade fair must create clear and stimulating relationships involving the exhibitors,
                     their collections and the buyers and public, by offering information, and knowledge. 
                </p>
            </div>
        </div>
        <div id="aboutusContainer">
            <div class="imgs2Container">
                  <img class="storys2Img" src="./img/aboutus/prima.jpg">
            </div>
            <div class="storys2">
                <h1>OGGI</h1>
                <p>
                    Pitti Immagine is an Italian company devoted to promoting the fashion industry worldwide. From the top down, its motivated staff fully believes in the concept 
                    of the modern trade fair as an event that is in a constant stage of renewal and 
                    development – indeed Pitti Immagine has recently expanded its scope to include 
                    other industries such as food and fragrance. According to Pitti Immagine the
                    trade fair must create clear and stimulating relationships involving the exhibitors,
                     their collections and the buyers and public, by offering information, and knowledge. 
                </p>
            </div>
        </div>';
    require_once('php/functions.php');	//è un include di function
    BuildPage("About us",$contentActualPage);	//funzione di buildpage dentro al file function
?>