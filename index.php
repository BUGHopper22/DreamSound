<?php
    if(isset($_REQUEST["logout"])){
        $logout=$_REQUEST["logout"];
        if( $logout == 1){
            session_start();
            session_destroy();
        }
    }
    $contentActualPage='
    <!-- CONTENITORE PRODOTTI CON IMMAGINE HOME -->
    <div id="outer" class="outer-home">
        <div class="inner">
            <h2>Without music, life would be a mistake.</h2>
            <p>La musica esprime ciò che non può essere espresso a parole e ciò che non può rimanere in silenzio.</p>
            <button class="button">Acquista marshall</button>
        </div>
    </div>

    <!-- DIV PRINCIPALE -->
    <div class="content">
            <div class="data-template">
                <h2>I più venduti</h2>
                <div class="outer">
                    <a href="">
                        <div class="product-box first-prod">
                            <img src="./img/prodotti/Marshall1.jpg" alt="marshall">
                            <div class="tit-desc-box">
                                <h4>Marshall</h4>
                                <p> Lorem ipsum dolor sit amet, consectetur 
                                    adipiscing elit. Suspendisse tincidunt 
                                    ut risus luctus mattis a nec mauris.
                                </p>
                            </div>  
                        </div>
                    </a>
                    <a href="">
                        <div class="product-box central-prod">
                            <img src="./img/prodotti/bred1.jpg" alt="marshall">
                            <div class="tit-desc-box">    
                                <h4>Bred</h4>
                                <p> 
                                    Lorem ipsum dolor sit amet, consectetur 
                                    adipiscing elit. Suspendisse tincidunt 
                                    vel risus quis euismod. Aenean id tellus 
                                    ut risus luctus mattis a nec mauris.
                                </p>
                            </div>
                        </div>
                    </a>
                    <a href="">
                        <div class="product-box central-prod">
                            <img src="./img/prodotti/Marshall2.jpg" alt="marshall">
                            <div class="tit-desc-box">
                                <h4>Beats</h4>
                                <p> adipiscing elit. Suspendisse tincidunt 
                                    vel risus quis euismod. Aenean id tellus 
                                    ut risus luctus mattis a nec mauris.
                                </p>
                            </div>
                        </div>
                    </a>
                    <a href="">
                        <div class="product-box central-prod">
                            <img src="./img/prodotti/maxell.jpg" alt="marshall">
                            <div class="tit-desc-box">
                                <h4>Maxell</h4>
                                <p> Lorem ipsum dolor sit amet, consectetur 
                                    adipiscing elit. Suspendisse tincidunt 
                                    vel risus quis euismod. Aenean id tellus 
                                    ut risus luctus mattis a nec mauris.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

    <!--         
            <div class="icon-wrapper">
                <div class="icon-row">
                    <div class="icon-col">
                        <div class="icon" id="shipping-icon"></div>
                        <p> Lorem ipsum dolor sit amet, consectetur 
                                adipiscing elit. Suspendisse tincidunt 
                                vel risus quis euismod. Aenean id tellus 
                                ut risus luctus mattis a nec mauris.

                        </p>
                    </div>
                    <div class="icon-col">
                        <div class="icon" id="color-personalizer"></div>
                        <p> Lorem ipsum dolor sit amet, consectetur 
                                adipiscing elit. Suspendisse tincidunt 
                                vel risus quis euismod. Aenean id tellus 
                                ut risus luctus mattis a nec mauris.

                        </p>
                    </div>
                    <div class="icon-col">
                        <div class="icon" id="supervisioned"></div>
                        <p> Lorem ipsum dolor sit amet, consectetur 
                                adipiscing elit. Suspendisse tincidunt 
                                vel risus quis euismod. Aenean id tellus 
                                ut risus luctus mattis a nec mauris.

                        </p>
                    </div>
                </div>
            </div> -->
            
            
    </div>


    <!-- Alberto utili in futuro: 
        -Le versioni di Internet Explorer precedenti alla 9 non sono in grado di applicare uno stile
    a elementi sconosciuti.Un disastro nella visualizzazione del documento. Sembra che il solo
    modo per ovviare a questo sfacelo sia di creare in memoria questi elementi, via
    JavaScript, ricorrendo al metodo createElement dell’oggetto document.
    <script>
    document.createElement("article");
    document.createElement("header");
    document.createElement("aside");
    document.createElement("footer");
    </script>
    -->';
    require_once('php/functions.php');	//è un include di function
    BuildPage("Home",$contentActualPage);	//funzione di buildpage dentro al file function
?>