
DROP TABLE IF EXISTS Accessori;
DROP TABLE IF EXISTS Casse;
DROP TABLE IF EXISTS Cuffie;
DROP TABLE IF EXISTS Carrello;
DROP TABLE IF EXISTS Storico;
DROP TABLE IF EXISTS Id_prodotti;
DROP TABLE IF EXISTS Utente;


CREATE TABLE Utente
(
Username char(16) NOT NULL primary key,
Email varchar(50) NOT NULL,
Password varchar(100) NOT NULL,
Nome varchar(50) NOT NULL,
Cognome varchar(50) NOT NULL
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

CREATE TABLE Carrello
(
Id_p int,
Username char(16),
Quantita int,
FOREIGN KEY (Id_p) REFERENCES Id_prodotti(Id_prodotto),
FOREIGN KEY (Username) REFERENCES Utente(Username)
ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE Storico
(
Id_p int,
Username char(16),
Quantita int,
FOREIGN KEY (Id_p) REFERENCES Id_prodotti(Id_prodotto),
FOREIGN KEY (Username) REFERENCES Utente(Username)
ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO Id_prodotti (Id_prodotto)
VALUES ('1'),('2'),('3'),('4'),('5'),('6'),('7'),('8'),('9'), ('10'), ('11'), ('12'), ('13'), ('14'), ('15'), ('16'), ('17'), ('18'), ('19'), ('20'), ('21');

INSERT INTO Cuffie (Id_p, Categoria, Prezzo, Marca, Modello, Url_immagine, Descrizione) VALUES 
('1','Cuffie in ear','20','BlitzWolf','BW-ES2','/cuffieInEar/inear1.png','Design accattivante e suono penetrante sono gli elementi che distinguono le BlitzWolf BW-ES2 da tutte le altre cuffie in-ear nel mercato.'),
('2','Cuffie in ear','30','Apple','EarPodss','/cuffieInEar/inear2.png','Il design confortevole di Apple offre una qualità del suono ad alte prestazionicon bassi profondi estremamente dinamici.'),
('3','Cuffie in ear','19','KLIM','Fusion','/cuffieInEar/inear3.png','Gli auricolari KLIM Fusion sono dotati di cuscinetti in schiuma Memory che assumono la forma perfetta per addattarsi alle orecchie. KLIM Fusion inoltre ti offre in assoluto la miglior qualità del suono nella sua fascia di prezzo.'),
('4','Cuffie on ear','49','JBL','T450','/cuffieOnEar/onear1.png','Ecco le cuffie supra-aurali JBL T450. Sono leggere, comode e compatte. una coppia di driver da 32mm riprodurrà bassi super potenti, con il mitico suono JBL Pure Bass che hai ascoltato in sale da concerto ben più grandi.'),
('5','Cuffie on ear','110','Sony','MDR-XB950AP','/cuffieOnEar/onear2.png','Ascolta tutti i bassi e i battiti più vigorosi. I driver da 40 mm, racchiusi in un design che aderisce all’ orecchio, offrono un suono profondo e bilanciato anche ad alto volume.'),
('6','Cuffie on ear','89','Marshall','Major II','/cuffieOnEar/onear3.png','Suoni, look e durata aggiornati, oltre ad una migliore ergonomia cedono il passo ad un nuovo livello di ascolto. Le funzioni audio avanzate includono driver custom per offrire bassi più profondi e alti dettagliati.'),
('7','Cuffie wireless','145','Apple','A1523 Airpods','/cuffieWireless/wireless1.png','Gli AirPods cambieranno per sempre il modo in cui usi gli auricolari. Quando li estrai dalla custodia di ricarica, si accendono all’istante collegandosi al tuo iPhone. L’audio si attiva non appena li indossi e va in pausa quando li togli.'),
('8','Cuffie wireless','17','Mpow','Swift','/cuffieWireless/wireless2.png','Disegno classico ed ergonomico con tecnologia bluetooth adatto a tutte le persone che vogliono allenarsi senza pensare ai fili di troppo.'),
('9','Cuffie wireless','50','Muzili','X9-lan','/cuffieWireless/wireless3.png','Cuffie bluetooth sportive con touch control. Questo auricolare Muzili è dotato di una scatola di ricarica intelligente, facile da caricare');


INSERT INTO Casse (Id_p, Categoria, Prezzo, Marca, Modello, Url_immagine, Descrizione) VALUES 
('10','Casse Altoparlanti','129','Edifier','R1280DB','/casseAltoparlanti/altoparlanti1.png','Set di altoparlanti 2.0 di alta qualità e potenza dal suono impressionante, inclusi di telecomando a raggi infrarossi'),
('11','Casse Altoparlanti','34','Logitech','Z200','/casseAltoparlanti/altoparlanti2.png','Controlli frontali di volume e accensione rendono queste casse una fusione unica tra semplicità e praticabilità. Compatibili con PC, smartphone, tablet e mp3. Alimentatore integrato'),
('12','Casse Altoparlanti','20','AUDIOCORE','AC860','/casseAltoparlanti/altoparlanti3.png','Altoparlanti di piccole dimensioni ed economici adatti da posizionare nella scrivania e da portare in viaggio. Possono essere collegati semplicemente tramite cavo USB o jack.'),
('13','Casse Bluetooth','179','JBL','Charge 3','/casseBluetooth/bluetooth1.png','Le JBL Charge 3 utilizzano una velocissima tecnologia wireless di ultima generazione. Il materiale che le riveste le rende impermeabili e perfette da portare con sè in vacanza. Adatte per godersi interrottamente oltre 20 ore di musica.'),
('14','Casse Bluetooth','200','Beats','Pill ML4M2ZM/B','/casseBluetooth/bluetooth2.png','Beats Pill presenta un sistema di crossover a 2 vie stereo attivo che crea un campo sonoro ottimizzato. Le sue 12 ore di autonomia e il suo design semplice la rendono un must per tutte le età'),
('15','Casse Bluetooth','35','JBL','GO2','/casseBluetooth/bluetooth3.png','JBL Go 2 è un piccolo altoparlante Bluetooth accattivante. Waterproof e con una diffusione del suono ottima per le sue piccole dimensioni. Ha un autonomia di 5 ore');

INSERT INTO Accessori (Id_p, Categoria, Prezzo, Marca, Modello, Url_immagine, Descrizione) VALUES 
('16','Accessori Cuffie','15','Kwmobile','BO-7899','/accessoriCuffie/accessoriCuffie1.png','I cuscinetti per cuffie Bose Soundlink Around-Ear Wireless II sono realizzati in ecopelle resistente, e grazie alla morbida imbottitura in schiuma offrono il massimo comfort di ascolto.'),
('17','Accessori Cuffie','7','Avantree','ADAD-TR302', '/accessoriCuffie/accessoriCuffie2.png', 'Divertitevi a condividere canzoni e film con i vostri amici, senza disturbare altri, utilizzando questo duplicatore a Y da 3.5mm con il vostro telefono o tablet o MP3 con due paia di cuffie.'),
('18','Accessori Cuffie','15','Moretek','BC-92','/accessoriCuffie/accessoriCuffie3.png', 'Custodia Portatile Case per Airpods, protettiva in silicone dalle linee moderne con inclusi diversi ganci utili per vivere ogni momento della tua vita.'),
('19','Accessori Casse','7','deleyCON','MK3331','/accessoriCasse/accessoriCasse1.png','Cavo deleyCON 2x 1,5mm² - 48x0,20mm (treccia) in alluminio rivestito in rame compatibile con altoparlanti e casse. Marcatura della polarità (nero/rosso).'),
('20','Accessori Casse','34','Duronic','SPS1022','/accessoriCasse/accessoriCasse2.png','Due piedistalli per casse acustiche, base di appoggio 12*12. Il prodotto ha una altezza di 40cm per permettervi di posizionare le vostre casse ad un altezza ottimale.'),
('21','Accessori Casse','10','Khanka','UK-T-JBL-02','/accessoriCasse/accessoriCasse3.png','Custodia per casse bluetooth JBL, pratica e imbottita per mantenere la propria cassa e gli accessori sicuri, protetti e organizzati');

INSERT INTO Utente (Username, Email, Password, Nome, Cognome) VALUES
('alberto', 'alberto@alberto.alberto','177dacb14b34103960ec27ba29bd686b','Alberto','Alberto'),
('alessio', 'alessio@alessio.alessio','d2462e55381a20059ed811cefd42493e','Alessio','Alessio');