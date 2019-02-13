<?php 

	/*
	  Connessione al DBMS e selezione del database.
	*/
	# blocco dei parametri di connessione
	// nome di host
	$host = "tecweb1819.studenti.math.unipd.it/albacco";
	// username dell'utente in connessione
	$user = "root";
	// password dell'utente
	$password = "phee2phoNa5waeRa";
	// nome del database
	$db = "dreamsound";
	# stringa di connessione al DBMS
	// istanza dell'oggetto della classe MySQLi
	$conn = new mysqli($host, $user, $password, $db);
	$_SESSION["connS"]=$conn;
	// verifica su eventuali errori di connessione
	if ($conn->connect_errno) {
		header("location:NoServer.php");
	}
	//exit();
?>