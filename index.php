<?php
    if(isset($_REQUEST["logout"])){
        $logout=$_REQUEST["logout"];
        if( $logout == 1){
            session_start();
            session_destroy();
        }
    }
    $contentActualPage='
    <div id="home">
        <div class="outer outer-home">
            <div class="inner">
                <h1>Without music, life would be a mistake.</h1>
                <p>La musica esprime ciò che non può essere espresso a parole e ciò che non può rimanere in silenzio.</p>
                <a class="button">Acquista marshall</a>
            </div>
        </div>

        <div class="content">
            <div class="data-template">
                <h2>In Vetrina</h2>
                <div class="vetrina">
                    <a href="">
                        <div class="product-box">
                            <img src="./img/prodotti/Marshall1.jpg" alt="marshall">
                                <h4>Marshall</h4>
                                <p> Lorem ipsum dolor sit amet, consectetur 
                                    adipiscing elit. Suspendisse tincidunt 
                                    ut risus luctus mattis a nec mauris.
                                </p>
                        </div>
                    </a>
                    <a href="">
                        <div class="product-box">
                            <img src="./img/prodotti/cuffieWireless/wireless1.png" alt="airpods">
                                <h4>AirPods</h4>
                                <p> 
                                    Lorem ipsum dolor sit amet, consectetur 
                                    adipiscing elit. Suspendisse tincidunt 
                                    vel risus quis euismod. Aenean id tellus 
                                    ut risus luctus mattis a nec mauris.
                                </p>
                        </div>
                    </a>
                    <a href="">
                        <div class="product-box">
                            <img src="./img/prodotti/Marshall2.jpg" alt="beats">
                                <h4>Beats</h4>
                                <p> adipiscing elit. Suspendisse tincidunt 
                                    vel risus quis euismod. Aenean id tellus 
                                    ut risus luctus mattis a nec mauris.
                                </p>
                        </div>
                    </a>
                    <a href="">
                        <div class="product-box">
                            <img src="./img/prodotti/accessoriCuffie/accessoriCuffie2.png" alt="ADAD-TR302">
                                <h4>ADAD-TR302</h4>
                                <p> Lorem ipsum dolor sit amet, consectetur 
                                    adipiscing elit. Suspendisse tincidunt 
                                    vel risus quis euismod. Aenean id tellus 
                                    ut risus luctus mattis a nec mauris.
                                </p>
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