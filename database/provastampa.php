
<?php
    require "connessione.php";
    
	$ntab = "accessori";//per provare abbiamo daoto il nome alla tabella con ntab. 
						// `{$ntab}` nella query metodo per dargli nome variabile altrimenti non va
        $sql = "SELECT Id_p, Categoria, Prezzo, Marca, Modello, Url_immagine, Descrizione FROM `{$ntab}` ";
        //$sql = "SELECT Id_p, Categoria, Prezzo, Marca, Modello, Url_immagine, Descrizione FROM Cuffie ";//oppure così
        $result = $conn->query($sql);

        $prova = mysqli_fetch_array($result);
        print $prova[6];
        echo "Mi piace il cazzo di bacchetto ";

        foreach ($result as $asd) {
            //print $asd["Marca"]; echo " "; print $asd["Modello"];
            print $asd["Id_p"];
            print $asd["Categoria"];
            print $asd["Prezzo"];
            echo '<br>';
}
?>
