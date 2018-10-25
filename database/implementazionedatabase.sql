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
('2','In-Ear','30.90','Apple','..','..','Il design confortevole di Apple offre una qualità del suono ad alte prestazionicon bassi profondi estremamente dinamici.'),
('3','In-Ear','19,90','KLIM','Fusion','..','Gli auricolari KLIM Fusion sono dotati di cuscinetti in schiuma Memory che assumono la forma perfetta per addattarsi alle orecchie. KLIM Fusion inoltre ti offre in assoluto la miglior qualità del suono nella sua fascia di prezzo.'),
('4','On-Ear','49,90','JBL','T450','..','Sono molto brutto'),
('5','On-Ear','110,00','Sony','MDR-XB950AP','..','Sono molto brutto'),
('6','On-Ear','89,99','Marshall','Major II','..','Suoni, look e durata aggiornati, oltre ad una migliore ergonomia cedono il passo ad un nuovo livello di ascolto. Le funzioni audio avanzate includono driver custom per offrire bassi più profondi e alti dettagliati.'),
('7','Wireless','145,00','Apple','A1523 Airpods','..','Sono molto brutto'),
('8','Wireless','17,90','Mpow','Swift','..','Disegno classico ed ergonomico con tecnologia bluetooth adatto a tutte le persone che vogliono allenarsi senza pensare ai fili di troppo.'),
('9','Wireless','50,99','Muzili','X9-lan','..','Cuffie bluetooth sportive con touch control. Questo auricolare Muzili è dotato di una scatola di ricarica intelligente, facile da caricare');


INSERT INTO Casse (Id_p, Categoria, Prezzo, Marca, Modello, Url_immagine, Descrizione) VALUES 
('10','Altoparlanti','129,90','Edifier','R1280DB','..','Set di altoparlanti 2.0 di alta qualità e potenza dal suono impressionante, inclusi di telecomando a raggi infrarossi'),
('11','Altoparlanti','30,99','Logitech','Z200','..','Sono molto brutto'),
('12','Altoparlanti','20,99','AUDIOCORE','AC860','..','Altoparlanti di piccole dimensioni ed economici adatti da posizionare nella scrivania e da portare in viaggio. Posso essere collegati semplicemente tramite cavo USB o jack.'),
('13','Casse Bluetooth','179,00','JBL','Charge 3','..','Sono molto brutto'),
('14','Casse Bluetooth','200,00','Beats','Phill ML4M2ZM/B','..','Sono molto brutto'),
('15','Casse Bluetooth','35,90','JBL','GO2','..','Sono molto brutto');

INSERT INTO Accessori (Id_p, Categoria, Prezzo, Marca, Modello, Url_immagine, Descrizione) VALUES 
('16','Per Cuffie','15,40','Kwmobile','..','..','I cuscinetti per cuffie Bose Soundlink Around-Ear Wireless II sono realizzati in ecopelle resistente, e grazie alla morbida imbottitura in schiuma offrono il massimo comfort di ascolto.'),
('17','Per Cuffie','7,99','Avantree','ADAD-TR302', '..', 'Divertitevi a condividere canzoni e film con i vostri amici, senza disturbare altri, utilizzando questo duplicatore a Y da 3.5mm con il vostro telefono o tablet o MP3 con due paia di cuffie.'),
('18','Per Cuffie','15,90','Moretek','..','..', 'Custodia Portatile Case per Airpods, protettiva in silicone dalle linee moderne con inclusi diversi ganci utili per vivere ogni momento della tua vita.'),
('19','Per Casse','7,50','deleyCON','MK3331','..','Cavo deleyCON 2x 1,5mm² - 48x0,20mm (treccia) in alluminio rivestito in rame compatibile con altoparlanti e casse. Marcatura della polarità (nero/rosso).');
('20','Per Casse','34,99','Duronic','SPS1022','..','Due piedistalli per casse acustiche, base di appoggio 12*12. Il prodotto ha una altezza di 40cm per permettervi di posizionare le vostre casse ad un altezza ottimale.');
('21','Per Casse','10,99','Khanka','UK-T-JBL-02','..','Custodia per casse bluetooth JBL, pratica e imbottita per mantenere la propria cassa e gli accessori sicuri, protetti e organizzati');