<?php
require_once ('../../database/connessione.php');
session_start();
$userName=$_SESSION["sessionUserId"];
$chartProducts= mysqli_query($conn,"SELECT * FROM Accessori a,Carrello c WHERE c.Username='".$userName."' and a.Id_p=c.Id_p
                                    UNION
                                    SELECT * FROM Cuffie cu,Carrello c WHERE c.Username='".$userName."' and cu.Id_p=c.Id_p
                                    UNION
                                    SELECT * FROM Casse ca,Carrello c WHERE c.Username='".$userName."' and ca.Id_p=c.Id_p");

$currentDate=date("Y/m/d");
echo $currentDate;
foreach($chartProducts as $lista){
    mysqli_query($conn,"INSERT INTO Storico (Id_p,Username,Quantita,Data_Acquisto) 
                        VALUE ('".$lista["Id_p"]."', '".$lista["Username"]."','".$lista["Quantita"]."','".$currentDate."')"
                );
}
mysqli_query($conn,"DELETE FROM Carrello WHERE Username='".$userName."' "); 

?>