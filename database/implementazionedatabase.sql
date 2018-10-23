DROP TABLE IF EXISTS Accessori;
DROP TABLE IF EXISTS Casse;
DROP TABLE IF EXISTS Cuffie;
DROP TABLE IF EXISTS Id_prodotti;
DROP TABLE IF EXISTS Utente;

CREATE TABLE Utente
(
Id_utente int AUTO_INCREMENT primary key,
Username char(16) NOT NULL,
Email varchar(50) NOT NULL,
Password varchar(100) NOT NULL,
Nome varchar(50) NOT NULL,
Cognome varchar(50) NOT NULL,
Sesso enum('M','F') NOT NULL,
Data_Nascita date NOT NULL
) ENGINE=InnoDB;

CREATE TABLE Id_prodotti
(
Id_prodotto int AUTO_INCREMENT primary key
)ENGINE=InnoDB;

CREATE TABLE Cuffie
(
Id_p int,
Categoria char(20) NOT NULL,
Prezzo double NOT NULL,
Marca char(20) NOT NULL,
Modello char(20) NOT NULL,
Url_immagine char(50) NOT NULL,
Descrizione varchar(255) NOT NULL,
FOREIGN KEY (Id_p) REFERENCES Id_prodotti(Id_prodotto)
ON DELETE CASCADE
ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE Casse
(
Id_p int,
Categoria char(20) NOT NULL,
Prezzo double NOT NULL,
Marca char(20) NOT NULL,
Modello char(20) NOT NULL,
Url_immagine char(50) NOT NULL,
Descrizione varchar(255) NOT NULL,
FOREIGN KEY (Id_p) REFERENCES Id_prodotti(Id_prodotto)
ON DELETE CASCADE
ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE Accessori
(
Id_p int,
Categoria char(20) NOT NULL,
Prezzo double NOT NULL,
Marca char(20) NOT NULL,
Modello char(20) NOT NULL,
Url_immagine char(50) NOT NULL,
Descrizione varchar(255) NOT NULL,
FOREIGN KEY (Id_p) REFERENCES Id_prodotti(Id_prodotto)
ON DELETE CASCADE
ON UPDATE NO ACTION
) ENGINE=InnoDB;

INSERT INTO Id_prodotti (Id_prodotto)
VALUES ('1');

INSERT INTO Accessori (Id_p, Categoria, Prezzo, Marca, Modello, Url_immagine, Descrizione)
VALUES ('1','Cuffie','200','Sony','Culo','provaasd','Sono molto brutto');