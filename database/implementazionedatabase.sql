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
Descrizione varchar(500) NOT NULL,
FOREIGN KEY (Id_p) REFERENCES Id_prodotti(Id_prodotto)
ON DELETE CASCADE
ON UPDATE NO ACTION
) ENGINE=InnoDB;

INSERT INTO Id_prodotti (Id_prodotto)
VALUES ('1'),('2'),('3'),('4'),('5'),('6'),('7'),('8'),('9'), ('10'), ('11'), ('12'), ('13'), ('14'), ('15'), ('16'), ('17'), ('18'), ('19'), ('20'), ('21');

INSERT INTO Cuffie (Id_p, Categoria, Prezzo, Marca, Modello, Url_immagine, Descrizione) VALUES 
('1','In-Ear','20,99','BlitzWolf','BW-ES2','..','Sono molto brutto'),
('2','In-Ear','30.90','Apple','..','..','Sono molto brutto'),
('3','In-Ear','19,90','KLIM','Fusion','..','Gli auricolari KLIM Fusion sono dotati di cuscinetti in schiuma Memory che assumono la forma perfetta per addattarsi alle orecchie. Per chi invece preferisce cuscinetti di tipo tradizionale, il prodotto è fornito con 3 paia di cuscinetti aggiuntivi di tutte le taglie. KLIM Fusioninoltre ti offre in assoluto la miglior qualità del suono nella sua fascia di prezzo: è impossibile acquistare un prodotto dello stesso livello a un costo inferiore.'),
('4','On-Ear','49,90','JBL','T450','..','Sono molto brutto'),
('5','On-Ear','110,00','Sony','MDR-XB950AP','..','Sono molto brutto'),
('6','On-Ear','89,99','Marshall','Major II','..','Suoni, look e durata aggiornati, oltre ad una migliore ergonomia cedono il passo ad un nuovo livello di ascolto. Un carattere solido come una roccia, costruito per durare, le Major II si fanno notare. Le funzioni audio avanzate includono driver custom per offrire bassi più profondi e alti dettagliati più estesi con una gamma media raffinata e distorsione complessiva inferiore. Il cavo staccabile a spirale con microfono e telecomando è dotato di un jack a L, che fornisce una miglior durata ed una più facile trasportabilità. Il doppio jack da 3,5 millimetri consente di scegliere da che lato si preferisce indossare il cavo o per condividere la tua musica con un amico.'),
('7','Wireless','145,00','Apple','A1523 Airpods','..','Sono molto brutto'),
('8','Wireless','17,90','Mpow','Swift','..','Sono molto brutto'),
('9','Wireless','50,99','Muzili','X9-lan','..','Sono molto brutto');


INSERT INTO Casse (Id_p, Categoria, Prezzo, Marca, Modello, Url_immagine, Descrizione) VALUES 
('10','Altoparlanti','129,90','Edifier','R1280DB','..','Sono molto brutto'),
('11','Altoparlanti','30,99','Logitech','Z200','..','Sono molto brutto'),
('12','Altoparlanti','20,99','AUDIOCORE','AC860','..','Sono molto brutto'),
('13','Casse Bluetooth','179,00','JBL','Charge 3','..','Sono molto brutto'),
('14','Casse Bluetooth','200,00','Beats','Phill ML4M2ZM/B','..','Sono molto brutto'),
('15','Casse Bluetooth','35,90','JBL','GO2','..','Sono molto brutto');

INSERT INTO Accessori (Id_p, Categoria, Prezzo, Marca, Modello, Url_immagine, Descrizione) VALUES 
('16','Cuffie','129,90','Edifier','R1280DB','..','Sono molto brutto'),
('17','Casse','129,90','Edifier','R1280DB','..','Sono molto brutto');