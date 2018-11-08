
<?php
    require "connessione.php";
    
	$ntab = "accessori";//per provare abbiamo daoto il nome alla tabella con ntab. 
						// `{$ntab}` nella query metodo per dargli nome variabile altrimenti non va
        
    //dato che su ntab c è la stringa "accessori" mi seleziona tutte le righe del db che sono accessori    
    $sql = "SELECT Id_p, Categoria, Prezzo, Marca, Modello, Url_immagine, Descrizione FROM `{$ntab}` ";
    //$sql = "SELECT Id_p, Categoria, Prezzo, Marca, Modello, Url_immagine, Descrizione FROM Cuffie ";//oppure così
        
    //nella variabile resul verranno inseriti tutti i dati che ho sselezionato precedentemente sulla variabile sql tramite query
    $result = $conn->query($sql);

    //con la funzione mysqlfectharray inserisco dentro la variabile prova,
    // inserisce il contenuto si result in un tipo array associato, in modo da poterlo utilizzare.
    $prova = mysqli_fetch_array($result);
        print $prova[6];
        echo "Mi piace il cazzo di bacchetto ";


        //asd corrisponde all indice dell' array
        foreach ($result as $asd) {
            //print $asd["Marca"]; echo " "; print $asd["Modello"];
            print $asd["Id_p"];
            print $asd["Categoria"];
            print $asd["Prezzo"];
            echo '<br>';
}
?>
