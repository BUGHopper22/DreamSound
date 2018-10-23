
<?php
	require "connessione.php";
	$ntab = "accessori";//per provare abbiamo daoto il nome alla tabella con ntab. 
						// `{$ntab}` nella query metodo per dargli nome variabile altrimenti non va
        $sql = "SELECT Id_p, Categoria, Prezzo, Marca, Modello, Url_immagine, Descrizione FROM accessori ";
        //$sql = "SELECT Id_p, Categoria, Prezzo, Marca, Modello, Url_immagine, Descrizione FROM Cuffie ";//oppure così
        $result = $conn->query($sql);

        foreach ($result as $asd) {
            //print $asd["Marca"]; echo " "; print $asd["Modello"];
            print $asd["Id_p"];
            print $asd["Categoria"];
            print $asd["Prezzo"];


}
?>
