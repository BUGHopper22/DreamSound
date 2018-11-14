
<?php
    require "connessione.php";
    
	// $ntab = "Cuffie";//per provare abbiamo daoto il nome alla tabella con ntab. 
	// 					// `{$ntab}` nella query metodo per dargli nome variabile altrimenti non va
        
    // //dato che su ntab c è la stringa "accessori" mi seleziona tutte le righe del db che sono accessori    
    // $sql = "SELECT * FROM `{$ntab}` ";
    // //$sql = "SELECT Id_p, Categoria, Prezzo, Marca, Modello, Url_immagine, Descrizione FROM Cuffie ";//oppure così
        
    // //nella variabile resul verranno inseriti tutti i dati che ho sselezionato precedentemente sulla variabile sql tramite query
    // $result = $conn->query($sql);

    // //con la funzione mysqlfectharray inserisco dentro la variabile prova,
    // // inserisce il contenuto si result in un tipo array associato, in modo da poterlo utilizzare.
    // $prova = mysqli_fetch_array($result);
    //     print $prova[6];


    //     //asd corrisponde all indice dell' array
    //     foreach ($result as $asd) {
    //         //print $asd["Marca"]; echo " "; print $asd["Modello"];
    //         print $asd["Id_p"];
    //         print $asd["Categoria"];
    //         print $asd["Prezzo"];
    //         echo '<br>';
    //     }


    //     $count = mysqli_num_rows($result);
    //     echo $count;
    //     $i=0;
    //     while($i < $count){
    //         print $prova["Id_p"];
    //         print $prova[11];
    //         //print $prova[$i]["Id_p"];
    //         $prova ++;
    //         $i++;
    //     }
        //require "./database/connessione.php";
        $titleTable = "Cuffie";
        $category = "Cuffie in ear";
        $result = $conn->query("SELECT * FROM `{$titleTable}` WHERE categoria='$category'");

        $count = mysqli_num_rows($result);

        echo $count;
        // $resultSql = mysqli_fetch_array($result,MYSQLI_ASSOC);
        foreach($result as $listProduct){
            // echo("\n");
            $htmlProducts=$htmlProduct.'<div class="singleProductList">
            <img class="productImg" src="'.$listProduct['Url_immagine'].'"  height="300" width="300">
            <div class="productDescription">
                <h3> '.$listProduct['Modello'].'</h3>
                <h4> '.$listProduct['Marca'].'</h4>
                <p>  '.$listProduct['Descrizione'].'</p>
                <h3>Euro'.$listProduct['Prezzo'].'</h3>
                <button class="productButton">vedi dettagli</button>
            </div>
            </div>';
        }
        echo $htmlProducts;

       
?>
