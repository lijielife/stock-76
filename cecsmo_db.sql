-- MySQL dump 10.11
--
-- Host: localhost    Database: cecsmo_db
-- ------------------------------------------------------
-- Server version	5.0.68-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin1 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categ`
--

DROP TABLE IF EXISTS `categ`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `categ` (
  `id_categ` int(10) NOT NULL auto_increment,
  `id_titre` int(10) NOT NULL,
  `categ` varchar(255) NOT NULL,
  PRIMARY KEY  (`id_categ`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `categ`
--

LOCK TABLES `categ` WRITE;
/*!40000 ALTER TABLE `categ` DISABLE KEYS */;
INSERT INTO `categ` VALUES (1,1,'chainette');
INSERT INTO `categ` VALUES (2,1,'ligature');
INSERT INTO `categ` VALUES (3,2,'arc Niti');
INSERT INTO `categ` VALUES (4,1,'ressort');
INSERT INTO `categ` VALUES (7,2,'Arc Acier');
INSERT INTO `categ` VALUES (8,4,'colle');
INSERT INTO `categ` VALUES (9,4,'etching');
INSERT INTO `categ` VALUES (10,4,'adhesif');
INSERT INTO `categ` VALUES (11,4,'ciment');
INSERT INTO `categ` VALUES (12,4,'collage ceramique');
INSERT INTO `categ` VALUES (13,4,'accessoires');
INSERT INTO `categ` VALUES (14,1,'divers');
INSERT INTO `categ` VALUES (15,2,'Arc CoNiti Damon');
INSERT INTO `categ` VALUES (16,2,'Arc Niti Thermal');
INSERT INTO `categ` VALUES (18,2,'Arc Niti Courbe de Spee');
INSERT INTO `categ` VALUES (19,2,'Arc Niti cdspee, torqué');
INSERT INTO `categ` VALUES (20,2,'Arc TMA');
INSERT INTO `categ` VALUES (21,2,'Arc TMA (lingual universel)');
INSERT INTO `categ` VALUES (22,2,'Arc TMA (Beta Titanium)');
INSERT INTO `categ` VALUES (23,2,'Fils acier, en longueur');
INSERT INTO `categ` VALUES (24,2,'Fils acier tressés, SUPRAFLEX, en longueur');
INSERT INTO `categ` VALUES (25,2,'Fils TMA, en longueur');
INSERT INTO `categ` VALUES (26,2,'arc Drect');
INSERT INTO `categ` VALUES (27,2,'arc Respond');
INSERT INTO `categ` VALUES (28,2,'Respond Lingual');
INSERT INTO `categ` VALUES (29,2,'Drect lingual');
INSERT INTO `categ` VALUES (30,2,'Niti lingual');
INSERT INTO `categ` VALUES (31,2,'Copper Niti Lingual');
INSERT INTO `categ` VALUES (32,5,'Forsus');
INSERT INTO `categ` VALUES (33,5,'Elastiques animaux');
INSERT INTO `categ` VALUES (34,5,'Distaliseur de Carrière');
INSERT INTO `categ` VALUES (35,5,'Quad helix');
INSERT INTO `categ` VALUES (36,5,'Lip Bumper');
INSERT INTO `categ` VALUES (37,5,'Barre palatine');
INSERT INTO `categ` VALUES (38,6,'Myobrace');
INSERT INTO `categ` VALUES (39,6,'MULTI P');
INSERT INTO `categ` VALUES (40,6,'EF');
INSERT INTO `categ` VALUES (41,6,'T4');
INSERT INTO `categ` VALUES (42,6,'FEO');
INSERT INTO `categ` VALUES (43,7,'Gant');
INSERT INTO `categ` VALUES (44,7,'hygiene patient');
INSERT INTO `categ` VALUES (45,7,'Produit sté');
INSERT INTO `categ` VALUES (46,7,'hygiene fauteuil');
INSERT INTO `categ` VALUES (47,8,'Biostar');
INSERT INTO `categ` VALUES (48,8,'Platre');
INSERT INTO `categ` VALUES (49,8,'Alginate');
INSERT INTO `categ` VALUES (50,8,'Contention');
/*!40000 ALTER TABLE `categ` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flux`
--

DROP TABLE IF EXISTS `flux`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `flux` (
  `id_flux` int(10) NOT NULL auto_increment,
  `id_produit` int(10) NOT NULL,
  `quantite` int(10) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id_flux`)
) ENGINE=MyISAM AUTO_INCREMENT=135 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `flux`
--

LOCK TABLES `flux` WRITE;
/*!40000 ALTER TABLE `flux` DISABLE KEYS */;
INSERT INTO `flux` VALUES (1,1,-3,'2009-04-29');
INSERT INTO `flux` VALUES (2,1,-1,'2009-04-29');
INSERT INTO `flux` VALUES (3,1,-1,'2009-04-29');
INSERT INTO `flux` VALUES (4,1,-1,'2009-04-29');
INSERT INTO `flux` VALUES (5,1,-3,'2009-04-29');
INSERT INTO `flux` VALUES (6,1,-1,'2009-04-29');
INSERT INTO `flux` VALUES (7,1,-1,'2009-04-29');
INSERT INTO `flux` VALUES (8,1,-1,'2009-04-29');
INSERT INTO `flux` VALUES (9,1,25,'2009-04-29');
INSERT INTO `flux` VALUES (10,1,-3,'2009-05-07');
INSERT INTO `flux` VALUES (11,1,-1,'2009-05-07');
INSERT INTO `flux` VALUES (12,89,10,'2009-05-12');
INSERT INTO `flux` VALUES (13,94,-2,'2009-05-12');
INSERT INTO `flux` VALUES (14,1,-3,'2009-05-22');
INSERT INTO `flux` VALUES (15,1,-1,'2009-05-22');
INSERT INTO `flux` VALUES (16,1,5,'2009-05-22');
INSERT INTO `flux` VALUES (17,1,15,'2009-05-22');
INSERT INTO `flux` VALUES (18,63,1,'2009-05-22');
INSERT INTO `flux` VALUES (19,1,50,'2009-05-22');
INSERT INTO `flux` VALUES (20,94,-2,'2009-06-04');
INSERT INTO `flux` VALUES (21,92,-1,'2009-06-04');
INSERT INTO `flux` VALUES (22,127,10,'2009-06-04');
INSERT INTO `flux` VALUES (23,55,-2,'2009-06-23');
INSERT INTO `flux` VALUES (24,55,2,'2009-06-23');
INSERT INTO `flux` VALUES (25,319,2,'2009-06-23');
INSERT INTO `flux` VALUES (26,149,-1,'2009-07-15');
INSERT INTO `flux` VALUES (27,109,-1,'2009-07-15');
INSERT INTO `flux` VALUES (28,249,-1,'2009-07-15');
INSERT INTO `flux` VALUES (29,313,-1,'2009-07-15');
INSERT INTO `flux` VALUES (30,149,-1,'2009-07-15');
INSERT INTO `flux` VALUES (31,247,-1,'2009-07-17');
INSERT INTO `flux` VALUES (32,120,-1,'2009-07-21');
INSERT INTO `flux` VALUES (33,53,-1,'2009-07-21');
INSERT INTO `flux` VALUES (34,47,-1,'2009-07-21');
INSERT INTO `flux` VALUES (35,312,10,'2009-07-21');
INSERT INTO `flux` VALUES (36,52,-1,'2009-07-22');
INSERT INTO `flux` VALUES (37,327,-1,'2009-07-22');
INSERT INTO `flux` VALUES (38,327,-1,'2009-07-22');
INSERT INTO `flux` VALUES (39,312,-1,'2009-07-22');
INSERT INTO `flux` VALUES (40,313,-2,'2009-07-22');
INSERT INTO `flux` VALUES (41,348,-1,'2009-07-22');
INSERT INTO `flux` VALUES (42,356,-1,'2009-07-22');
INSERT INTO `flux` VALUES (43,122,-1,'2009-07-22');
INSERT INTO `flux` VALUES (44,122,-1,'2009-07-22');
INSERT INTO `flux` VALUES (45,313,-1,'2009-07-22');
INSERT INTO `flux` VALUES (46,120,-2,'2009-08-26');
INSERT INTO `flux` VALUES (47,357,8,'2009-08-26');
INSERT INTO `flux` VALUES (48,362,-1,'2009-08-26');
INSERT INTO `flux` VALUES (49,122,-1,'2009-08-26');
INSERT INTO `flux` VALUES (50,118,-2,'2009-08-27');
INSERT INTO `flux` VALUES (51,120,-2,'2009-08-27');
INSERT INTO `flux` VALUES (52,149,-1,'2009-08-27');
INSERT INTO `flux` VALUES (53,313,25,'2009-08-27');
INSERT INTO `flux` VALUES (54,51,-1,'2009-08-27');
INSERT INTO `flux` VALUES (55,313,-1,'2009-08-27');
INSERT INTO `flux` VALUES (56,356,-1,'2009-08-27');
INSERT INTO `flux` VALUES (57,59,-1,'2009-08-27');
INSERT INTO `flux` VALUES (58,52,-1,'2009-08-27');
INSERT INTO `flux` VALUES (59,47,-1,'2009-08-27');
INSERT INTO `flux` VALUES (60,51,-1,'2009-08-27');
INSERT INTO `flux` VALUES (61,312,-1,'2009-08-27');
INSERT INTO `flux` VALUES (62,120,-1,'2009-08-27');
INSERT INTO `flux` VALUES (63,122,-1,'2009-09-02');
INSERT INTO `flux` VALUES (64,312,-1,'2009-09-02');
INSERT INTO `flux` VALUES (65,315,-1,'2009-09-02');
INSERT INTO `flux` VALUES (66,313,-1,'2009-09-02');
INSERT INTO `flux` VALUES (67,330,-1,'2009-09-02');
INSERT INTO `flux` VALUES (68,122,-1,'2009-09-02');
INSERT INTO `flux` VALUES (69,47,-1,'2009-09-02');
INSERT INTO `flux` VALUES (70,313,-1,'2009-09-02');
INSERT INTO `flux` VALUES (71,260,3,'2009-09-02');
INSERT INTO `flux` VALUES (72,261,3,'2009-09-02');
INSERT INTO `flux` VALUES (73,248,8,'2009-09-02');
INSERT INTO `flux` VALUES (74,312,-1,'2009-09-02');
INSERT INTO `flux` VALUES (75,313,-1,'2009-09-02');
INSERT INTO `flux` VALUES (76,47,4,'2009-09-04');
INSERT INTO `flux` VALUES (77,91,3,'2009-09-04');
INSERT INTO `flux` VALUES (78,88,3,'2009-09-04');
INSERT INTO `flux` VALUES (79,90,14,'2009-09-04');
INSERT INTO `flux` VALUES (80,118,5,'2009-09-04');
INSERT INTO `flux` VALUES (81,120,6,'2009-09-04');
INSERT INTO `flux` VALUES (82,121,4,'2009-09-04');
INSERT INTO `flux` VALUES (83,149,3,'2009-09-04');
INSERT INTO `flux` VALUES (84,1,5,'2009-09-04');
INSERT INTO `flux` VALUES (85,313,-2,'2009-09-04');
INSERT INTO `flux` VALUES (86,329,-1,'2009-09-04');
INSERT INTO `flux` VALUES (87,190,-1,'2009-09-04');
INSERT INTO `flux` VALUES (88,312,-1,'2009-09-05');
INSERT INTO `flux` VALUES (89,313,-1,'2009-09-05');
INSERT INTO `flux` VALUES (90,313,-1,'2009-09-05');
INSERT INTO `flux` VALUES (91,52,-1,'2009-09-05');
INSERT INTO `flux` VALUES (92,120,2,'2009-09-07');
INSERT INTO `flux` VALUES (93,120,2,'2009-09-07');
INSERT INTO `flux` VALUES (94,259,-1,'2009-09-07');
INSERT INTO `flux` VALUES (95,106,60,'2009-09-08');
INSERT INTO `flux` VALUES (96,106,-10,'2009-09-08');
INSERT INTO `flux` VALUES (97,106,-2,'2009-09-08');
INSERT INTO `flux` VALUES (98,106,-2,'2009-09-08');
INSERT INTO `flux` VALUES (99,248,-1,'2009-09-09');
INSERT INTO `flux` VALUES (100,315,-1,'2009-09-09');
INSERT INTO `flux` VALUES (101,364,1,'2009-09-09');
INSERT INTO `flux` VALUES (102,364,7,'2009-09-09');
INSERT INTO `flux` VALUES (103,122,20,'2009-09-09');
INSERT INTO `flux` VALUES (104,89,4,'2009-09-09');
INSERT INTO `flux` VALUES (105,313,-1,'2009-09-09');
INSERT INTO `flux` VALUES (106,47,-1,'2009-09-09');
INSERT INTO `flux` VALUES (107,312,-1,'2009-09-09');
INSERT INTO `flux` VALUES (108,313,-1,'2009-09-09');
INSERT INTO `flux` VALUES (109,249,-1,'2009-09-09');
INSERT INTO `flux` VALUES (110,149,-1,'2009-09-09');
INSERT INTO `flux` VALUES (111,52,-1,'2009-09-11');
INSERT INTO `flux` VALUES (112,122,-1,'2009-09-11');
INSERT INTO `flux` VALUES (113,120,-1,'2009-09-11');
INSERT INTO `flux` VALUES (114,364,-1,'2009-09-11');
INSERT INTO `flux` VALUES (115,120,-1,'2009-09-11');
INSERT INTO `flux` VALUES (116,122,-1,'2009-09-11');
INSERT INTO `flux` VALUES (117,364,-1,'2009-09-11');
INSERT INTO `flux` VALUES (118,364,-1,'2009-09-11');
INSERT INTO `flux` VALUES (119,51,3,'2009-09-11');
INSERT INTO `flux` VALUES (120,49,2,'2009-09-11');
INSERT INTO `flux` VALUES (121,259,-1,'2009-09-12');
INSERT INTO `flux` VALUES (122,53,-1,'2009-09-12');
INSERT INTO `flux` VALUES (123,313,-2,'2009-09-12');
INSERT INTO `flux` VALUES (124,312,-1,'2009-09-12');
INSERT INTO `flux` VALUES (125,315,-1,'2009-09-12');
INSERT INTO `flux` VALUES (126,148,-1,'2009-09-12');
INSERT INTO `flux` VALUES (127,313,-2,'2009-09-12');
INSERT INTO `flux` VALUES (128,52,-1,'2009-09-14');
INSERT INTO `flux` VALUES (129,313,-2,'2009-09-15');
INSERT INTO `flux` VALUES (130,312,-1,'2009-09-15');
INSERT INTO `flux` VALUES (131,120,-1,'2009-09-15');
INSERT INTO `flux` VALUES (132,118,-1,'2009-09-15');
INSERT INTO `flux` VALUES (133,122,-1,'2009-09-15');
INSERT INTO `flux` VALUES (134,122,-1,'2009-09-15');
/*!40000 ALTER TABLE `flux` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `fournisseur` (
  `id_fournisseur` int(10) NOT NULL auto_increment,
  `fournisseur` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` text NOT NULL,
  `client` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `portable` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_cmd` varchar(255) NOT NULL,
  PRIMARY KEY  (`id_fournisseur`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `fournisseur`
--

LOCK TABLES `fournisseur` WRITE;
/*!40000 ALTER TABLE `fournisseur` DISABLE KEYS */;
INSERT INTO `fournisseur` VALUES (0,'--------','','','','','','','','','');
INSERT INTO `fournisseur` VALUES (1,'GACD','','','BP 39-93601\r\nAulnay-sous-Bois cedex','','01.42.46.82.64','','01.45.91.16.93','service.clientele@gacd.fr','');
INSERT INTO `fournisseur` VALUES (2,'Ormodent','AUBERT','Olivia 06 03 48 78 86','BP 37\r\n 93101 Montreuil Cedex','','08.00.71.39.39','','08.00.71.41.41','ormodent@ormodent.com','');
INSERT INTO `fournisseur` VALUES (3,'Schein','','','4 rue de Charenton\r\n 94140 Alfortville Cedex        ','','01.41.79.65.65','','01.41.79.65.76','','');
INSERT INTO `fournisseur` VALUES (4,'american orthodontic','Boulesteix','Angelina','Les Flamants Bat 7 Paris Nord 2\r\n13 rue de la Perdrix\r\n93290 Tremblay en France','','01-49-38-16-60','','01-49-38-16-60','lvalentin@americanortho.fr','');
INSERT INTO `fournisseur` VALUES (5,'BISICO','','','BP 60- L\'Opéra\r\n\r\n13680 lançon de Provence','','04.90.42.92.92','','04.90.42.92.61','www.bisico.fr','');
INSERT INTO `fournisseur` VALUES (6,'New Ortho','','','1390,Avenue Campon\r\n06117 Le Canet Cedex','','04.93.46.66.67','','04.93.45.61.67','newortho@new-ortho.fr','');
INSERT INTO `fournisseur` VALUES (7,'Ortho Force','','','30,rue Rivay\r\n\r\n92300-LEVALLOIS-PERRET','','01.42.30.81.12-01.47.31.85.61','','01.47.31.03.23','mel@ortho-force.com','');
INSERT INTO `fournisseur` VALUES (8,'Ortho Organizers','','','','','','','','','');
INSERT INTO `fournisseur` VALUES (9,'Ortho Technology','','','','','','','','','');
INSERT INTO `fournisseur` VALUES (10,'RMO','RUMIZ','Nathalie','Rue Geiler de Kaysersberg\r\nBP 20334\r\n67411 ILLKIRCH Cedex','','03.88.40.67.40','','03.88.67.96.95','SALES@rmoeurope.com','');
INSERT INTO `fournisseur` VALUES (11,'Ortho Plus','','Géraldine','28,rue Ampère\r\nBP 28\r\n91430 Igny','','01.69.41.90.28','','01.60.19.32.22','orthoplus@orthoplus.fr','');
INSERT INTO `fournisseur` VALUES (12,'Septodont',' Mr POULAIN','','58 Rue du Pont de Créteil\r\n94107 Saint-Maur-des-Fossés cedex','','01.49.76.70.39','','01.49.76.70.78','mmercier@septodont.com','');
INSERT INTO `fournisseur` VALUES (13,'Oral B','','','163/165 Quai Aulagnier\r\n92600 Asnières-sur-Seine','','08.25.87.84.98','','04.50.66.33.26','wwworalbprofessional.com/fr','');
INSERT INTO `fournisseur` VALUES (14,'GSM','','SAMIA','77 Quater,rue du Point du Jour\r\n92100 Boulogne-Billancourt','','01.58.17.08.85','','01.58.17.08.81','gsm.dentaire@wanadoo.fr','');
INSERT INTO `fournisseur` VALUES (15,'W&H','','','','','','','','','');
INSERT INTO `fournisseur` VALUES (16,'Discus Dental','','','Succursale Française 118-122,Avenue de France ZAC Paris Rive Gauche\r\n75013 PARIS','','08.10.40.08.46','','01.43.40.00.24','','');
INSERT INTO `fournisseur` VALUES (17,'3M','GRETTNER','','Laboratoire 3M santé Département orthodontie Boulevard de l\'Oise\r\n95029 Cergy Pontoise cedex','','01.30.31.84.26','','01.30.31.84.39','info@gac-ortho.com','');
INSERT INTO `fournisseur` VALUES (20,'GAC','','','SOF SAS ZA de Chatenay\r\n4 ter Allée des Messagers \r\n37210 ROCHECORBON','','08.20.20.37.20','','08.20.20.37.87','','');
INSERT INTO `fournisseur` VALUES (22,'Ortho Company','','','28, avenue du Président Kennedy\r\n92160 ANTONY\r\n\r\n','','www.ortho-company.com','','','','www.ortho-company.com');
/*!40000 ALTER TABLE `fournisseur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membres`
--

DROP TABLE IF EXISTS `membres`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `membres` (
  `id` int(10) NOT NULL auto_increment,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(40) NOT NULL,
  `adresse` longtext NOT NULL,
  `annee` varchar(50) NOT NULL,
  `fac` varchar(50) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `statut` varchar(10) NOT NULL,
  `sessionid` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  UNIQUE KEY `id` (`id`,`pseudo`)
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `membres`
--

LOCK TABLES `membres` WRITE;
/*!40000 ALTER TABLE `membres` DISABLE KEYS */;
INSERT INTO `membres` VALUES (2,'Lopater','Alexis','alexis@cecsmo.net','0621492043','20 rue cassette\r\n75006 Paris','C3','P5','alexlop','alexlop','m','lsaem1zafhf99th4e3my','2007-02-22 01:08:28','2008-07-23 01:26:00');
INSERT INTO `membres` VALUES (3,'Benamran','Laurent','laurentbenamran@gmail.com','06 81 96 99 64','17 rue van loo 75016 Paris','C3','P7','laurent','laurent','m','nhc34fxyrbqykwydesik','2007-02-22 01:24:23','2007-03-07 23:42:56');
INSERT INTO `membres` VALUES (9,'benaïnous','lionel','lionelbenainous@hotmail.com','06.03.04.41.14','','C2','P7','Lionel','jelion','m','1jy4wl78e8oibx7bab1r','2007-02-25 15:39:49','2007-03-10 21:26:08');
INSERT INTO `membres` VALUES (24,'renaud','fabien','fabdentiste@yahoo.fr','0621584615','34 quai de dion bouton\r\n92800 puteaux','C3','P5','fabdentiste','fab2512','m','69ulhl9n2l5muoh3vzf3','2007-03-01 18:29:50','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (25,'bouju','stéphanie','stephanie.bouju@voila.fr','06 62 32 75 45','3 bis rue de la breloque 78610 LE PERRAY EN YVELINES','C3','P7','cecsmo','garrec','m','we0raasgo8cwmyzlz4uj','2007-03-01 22:50:35','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (26,'soiron','camille','desfraisesetdesabricots@wanadoo.fr','0680731301','220 Bd Pereire\r\n75017 Paris','C3','P5','SOIRON','CAMILLE','m','qmlaamaoovlvhkkhlrag','2007-03-02 14:16:59','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (36,'billet','marion','billetmarion@hotmail.com','0626535528','2 square de Port Royal\r\n75013 Paris','C3','P7','billetmarion','marbil','m','0eymosv7ta83fr35pdog','2007-03-03 18:37:56','2007-04-03 18:41:41');
INSERT INTO `membres` VALUES (37,'popelut','rosalie','','','','C3','P7','rose','choupi8','m','xp902yi8kw8sdkhcrn91','2007-03-04 19:06:15','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (38,'boussard','caroline','caroline.boussard@hotmail.fr','0650147556','','C3','P5','caroline','petitefleur','m','qmpl3tvmxmx2dr6yno9h','2007-03-07 20:51:26','2008-09-12 15:49:19');
INSERT INTO `membres` VALUES (39,'le guennec','sylvie','sc.micheau@free.fr','06 18 45 66 78','12 rue du renard\r\n75004','C3','P7','sc.micheau','sceami','m','yj802bdaf4vopa8qk1pc','2007-03-28 20:42:44','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (40,'seif','joumana','joumana.seif@free.fr','0682298644','9 rue louis rousseau BatD 94200 ivy su seine','C3','P5','joumana','base','m','zfdoh2hx2p5vphqu4cli','2007-03-30 23:29:28','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (41,'mougin','dorothee','dorotheemougin@caramail.com','0664128024','6 rue del\'oratoire 54000 nancy','C3','P5','dodo','adm','m','m6r6mgg4fd2d74oqepka','2007-04-18 22:39:23','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (42,'rioux','emmanuelle','emmanuelle_rioux@hotmail.fr','0675202900','5,rue tardieu\r\n75018 paris','C2','P5','emmanuelle','sophinette','m','67plogaubuvtcl007mr0','2007-04-27 19:15:26','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (43,'laget','pauline','plaget@hotmail.com','06-63-42-52-40','','C3','P7','popomobile','penbaz','m','6g5se4pl1z16xu7i9l1s','2007-05-01 10:19:34','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (44,'ohana','ilana','ilanaohana@hotmail.com','0664272905','22 rue André Citroen\r\n92300 Levallois Perret','C2','P7','zilana','zilana','m','hjcfnvap12b19oct0c4y','2008-01-13 21:53:39','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (45,'brandelet','mélanie','nanibrand@hotmail.com','','','C2','P7','nani','1406','m','','2008-01-13 22:55:41','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (46,'ho','bich','bichhovotuan@yahoo.fr','06 98 18 45 64','48 rue eugène oudiné\r\n75013 paris','C2','P5','bichhovotuan','dalailama','m','ywv0bao3hgp7la0wt9bu','2008-01-13 23:50:02','2008-01-20 23:39:25');
INSERT INTO `membres` VALUES (47,'gibassier','claire','claire.gibassier@gmail.com','','','C2','P5','gib','FABRICE22','m','vck9zy5mug1dg5oyp2h1','2008-01-14 00:19:13','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (48,'saidi','sophia','lucky13fr@yahoo.fr','','11 bis rue charbonnel 75013','C2','P5','sophia','sophia','m','czg45tngj652p82l1szw','2008-01-15 15:01:17','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (49,'bidange','guillaume','frezbull@yahoo.fr','','','C2','P7','frezbull','poupou','m','2jbg74lokbmddutuw7wd','2008-01-15 22:16:47','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (50,'boucherit','sabine','sabine.boucherit@hotmail.fr','0686793537','22 rue d\'arcueil\r\n75014 paris','C2','P5','sabine','valtho','m','63w9ynxxc794krkv8xb8','2008-01-16 00:53:57','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (51,'adda','laetitia','laetiadda@hotmail.com','','','C2','P7','laetiadda','azerty','m','a63kzqiet2o47p11nbf4','2008-01-16 18:56:51','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (52,'larcher','dorothée','dorotheelarcher@hotmail.com','06 88 76 61 16','35 rue de la gaité\r\n75014 paris','C2','P5','dorotheelarcher','batzisland','m','ukdvegay5onhcw28nr95','2008-01-17 12:50:44','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (53,'louin','olivia','','','','C2','P5','sololibera','kasablanka','m','vari0zltngfevf21it5u','2008-01-20 18:28:29','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (54,'de papé','romain','romaindepape@gmail.com','0615921476','','C2','P7','romain','craccrac','m','7tg9aoziayigz7eetjjm','2008-01-20 21:31:58','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (55,'soussan','jessica','jessisoussan@yahoo.fr','','','C2','P7','250580','ortho','m','1p8k3nisk25mqz2u35v3','2008-01-22 17:04:48','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (56,'belat','audrey','audrey.belat@gmail.com','06 65 43 73 51','','C2','P5','dana','dana','m','6d2owfyptufqahobi5la','2008-01-28 14:52:13','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (57,'decker','alain','alain.decker@univ-paris5.fr','','','enseignant','P5','decker','130247','p','gerjgfzzdzbhsxfrb9yy','2008-01-29 09:51:07','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (58,'huguet','emilie','emiliehuguet@gmail.com','06 22 12 62 87','75 rue de lourmel 75015 PARIS','C2','P7','Emilie','chouchou','m','2s0gw2wuxme36v6bu8jz','2008-02-03 18:10:28','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (59,'el moumi','hasnaa','elmoumih@gmail.com','0637812663','7 rue de coulmiers 75014 paris','C2','P7','hachounette','monada','m','kxfv85w18h9fkz6agaj6','2008-03-11 08:09:34','2008-05-25 00:18:30');
INSERT INTO `membres` VALUES (60,'benahmed','malika','dr.benahmedm@wanadoo.fr','','','enseignant','P5','mali','mali','p','','2008-03-11 16:04:07','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (61,'haigneré','claire','klrobscure@gmail.com','','','vioc','P5','klrobscure','pilouface','m','','2008-03-13 12:05:09','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (62,'lemanissier','virginie','','','','C4','P5','virginie','080396','m','','2008-03-13 12:06:31','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (63,'haussmann','william','william.haussmann@gmail.com','0684959193','25, rue du général Bertrand\r\n75007 Paris','vioc','P5','william','haussmann','m','','2008-03-13 12:08:33','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (64,'garsany','sabrina','sabrinagarsani@wanadoo.fr','','','C3','P5','sabrina','1902','m','3o8hnsd650fmynis9zw4','2008-04-04 09:19:00','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (65,'cohen','anne-gaël','annegaco@yahoo.fr','0623173974','','C4','P5','annegaco','ninche','m','3zbn92x6yqvf7oitrbgt','2008-04-15 22:37:49','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (66,'santos chaves','camila','chavescamila@msn.com','','','vioc','P5','mila','mila','m','9r8w3eq4or2jcqr3kau0','2008-04-17 15:22:03','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (67,'joly','thomas','dr.thomas@paris.com','','','vioc','P7','thomas','andrew','m','j293k6d8qmdxbp97k8q8','2008-04-22 17:00:51','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (68,'dahan','serge','dahansergio@yahoo.fr','','','C3','Ma','sergio79','trustnoone','m','0usn5anqc0jiah986n16','2008-04-22 21:25:44','2008-04-22 22:29:52');
INSERT INTO `membres` VALUES (69,'szustakiewicz','bertrand','bertrandzz@free.fr','06 18 00 85 12','126, Parvis de La Treille\r\n59800 LILLE','C3','Li','Xcontrol','lapierre','m','bp3thvhcdz4sfb1qkuqi','2008-04-23 13:59:06','2008-04-27 22:46:06');
INSERT INTO `membres` VALUES (70,'barthelet','romain','rbarthelet@hotmail.com','','','vioc','P5','barthelet','333333','m','','2008-04-23 14:09:54','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (71,'barthelemy','viviane','viviane.barthelemy@free.fr','','','vioc','P5','viviane','vb0578','m','9154dkx9v5irgmfgifxj','2008-04-23 14:10:52','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (72,'grossias','narimane','narimane31@yahoo.fr','','','vioc','To','narimane','toulouse','m','','2008-04-24 23:55:00','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (73,'chabre','claude','cl.chabre@free.fr','','','enseignant','P7','cchabre','chabre','p','57gx4rm1ukdwrzi04f4x','2008-04-25 11:16:54','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (74,'frindel','clement','doc.cfrindel@orange.fr','0687240607','17 rue des doc. Charcot 42100 SAINT ETIENNE','C3','Ly','clemfrind','dentaire','m','hsclxt2l9tbcgzbfpzej','2008-05-07 08:47:28','2008-05-07 08:49:26');
INSERT INTO `membres` VALUES (75,'daanoux','aline','adannoux@caramail.com','0661882743','39 RUE GUILLOUD\r\n69003 LYON','C3','Ly','bouille','dentiste','m','i7x6vq1rsq7xymq9hoii','2008-05-07 20:41:02','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (76,'dubos','sandrine','dubos.sand@wanadoo.fr','0623248843','','C3','Ly','geraldine','capricorne','m','xjb2dxz7k7fi1usz6tvy','2008-05-08 00:39:49','2008-05-08 01:04:41');
INSERT INTO `membres` VALUES (77,'TAHIRI-MONGIN','jamila','tahiri.j@gmail.com','06-81-68-95-24','13 rue des Glacis 54000 NANCY','C3','St','j.t','caudalie','m','n8mmoat39u3j9si7wshl','2008-05-25 21:27:45','2008-05-25 21:29:16');
INSERT INTO `membres` VALUES (78,'le carboulec','yann','yannlecarboulec@yahoo.fr','06 32 37 27 50','57 chemin de chavril\r\n69110 SAINTE FOY LES LYON','C4','Ly','Carbu','prodigy','m','lin34i4sxu0a7ykgcjdt','2008-06-08 16:24:15','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (79,'devisse','thomas','thom.devisse@wanadoo.fr','0608830180','201 rue de la Cense aux blés - appartement 310\r\n59000 Lille','C3','Li','tdevisse','310580','m','','2008-06-15 13:46:02','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (80,'bravetti','morgane','morgane.bravetti@wanadoo.fr','','13 blvrd du Recteur Senn 54 000 NANCY','vioc','St','morgane.bravetti','bartok','m','','2008-06-15 16:08:54','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (81,'pralat','hélène','helpral@gmail.com','','2/61 RESIDENCE LES CITEAUX AVENUE MORMAL 59000 LILLE','C4','Li','helpral','jalodf','m','ib66hg7ow0f2ew1k0bic','2008-06-15 23:30:02','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (82,'pointeau lafond','delphine','cedrik.lafond@free.fr','06 76 17 40 24','15 Bd de Scarpone \r\n54000 NANCY','C3','Rs','THOMAS 06','Thomas 06','m','0udpr2661ld7i7o9fmoo','2008-06-16 08:28:01','2008-07-05 19:52:15');
INSERT INTO `membres` VALUES (83,'saumen','claire','claire.saumen@hotmail.fr','0665756578','20 rue de l\'Arquebuse\r\nReims','C4','Rs','0','0812','m','','2008-06-16 09:29:05','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (84,'schwartz','claudine','claudineschwartz@free.fr','','1 rue du bon pasteur\r\nRésidence Le Dabo\r\n67000 Strasbourg','C3','St','titounie','titounie','m','ceioccci5c2r3qwyr4fl','2008-06-16 10:05:16','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (85,'tronet','justine','justine.tronet@gmail.com','','','C2','Li','justine.tronet','cobalt','m','n52d1rg5cd6sxf4da2vk','2008-06-16 11:32:44','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (86,'charbonnier','athénaïs','athenais.charbonnier@wanadoo.fr','06 18 31 95 71','','vioc','Rs','athe','coucou','m','iwrpax72flkc31ab0ovr','2008-06-16 12:59:51','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (87,'heck-breit','aurélie','cleliaheck@aol.com','','','vioc','St','cleliaheck','equateur','m','','2008-06-16 17:10:15','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (89,'george','olivier','olivgeorge@yahoo.fr','0663741703','1, Rue de la PRIMATIALE\r\n54000 NANCY','vioc','Ny','olivgeorge','guitare','m','u3v9s1u1ihasxynzm2xr','2008-06-16 20:45:28','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (90,'rochon','emilie','rochon.emilie@wanadoo.fr','0681209897','54000 Nancy','C2','Ly','rochon.emilie','bruno','m','tgsb08tz4zjz2s5bcv7v','2008-06-17 11:22:39','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (91,'sergent','olivier','olivier.sergent@gmail.com','','','C2','Li','olivier.sergent','251104','m','57azn3yzrzd9lnottr08','2008-06-17 13:24:26','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (92,'dubois','claire','','','','C3','Li','duboisclaire','emmanuel','m','','2008-06-17 15:26:48','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (93,'werli','thomas','thomas.werli@wanadoo.fr','','1, Rue Erckmann Chatrian\r\n57400 SARREBOURG','vioc','St','lolita','lolita','m','1t64q0j6ga4jpl4tsc2w','2008-06-17 16:16:00','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (94,'muller-kaempf','peggy','guikaempf@free.fr','','','vioc','St','1424','1424','m','bjyaeez95rtul7mkjqqa','2008-06-17 16:44:39','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (95,'uzel','severine','uzelseverine@yahoo.fr','0622410818','','C4','Rs','suzel','audrey','m','m7s2x627ac9l35l1xyti','2008-06-17 17:00:02','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (96,'lenoble','olivier','kourounitara@yahoo.fr','0662663317','','vioc','Rs','kourouni','madelidelaine','m','','2008-06-18 11:54:46','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (97,'vassal','axelle','axelle.vassal@wanadoo.fr','0685129250','30 rue JF KENNEDY\r\n59290 WASQUEHAL','C3','Li','login','israel','m','oo2ynfn4aqqxu40futdf','2008-06-18 22:04:18','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (98,'pindi','guy','gumanpi@hotmail.com','06.79.13.73.94','','C2','Li','guy','juin81','m','n3wouhg6yqinfk4e35ni','2008-07-04 20:09:27','2008-12-08 21:14:18');
INSERT INTO `membres` VALUES (99,'durand','thomas','thomasdurandfac@yahoo.fr','','','C4','Na','thomasdurand','durandt','m','5c216d6p2z2um9ysf2he','2008-08-02 15:11:22','2008-10-26 15:26:25');
INSERT INTO `membres` VALUES (100,'galievsky','mathilde','mgalievsky@gmail.com','','','vioc','P5','mgalievsky','mathmath','m','x6qztqwig6p88u1a963o','2008-10-02 14:54:31','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (101,'depardieu','fabien','depardieufab@hotmail.fr','0624373930','','C2','P5','fabio','sardine','m','khclzr6d61h4whevrydl','2009-01-12 14:15:13','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (102,'grimberg payrot','alina','alina_grimberg@hotmail.com','','','C1','P5','ALINA','YAMAMAYA','m','dwa4e3vqvg1jh2zz3r1o','2009-01-19 19:46:42','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (103,'felpeto','bruno','brunofelpeto@gmail.com','0650707845','114 rue hoche 92700 Colombes','C1','P7','bruno','1234','m','lj9op9t8h5nawsx4cbcw','2009-02-02 22:26:49','2009-02-02 22:50:22');
INSERT INTO `membres` VALUES (104,'paulme','gaëtan','gaetan.paulme@yahoo.fr','0625700789','8 RUE DES TAILLANDIERS\r\n75011 PARIS','C1','P7','kouekoue','kouette','m','9y8kkza8wm89snirqr5j','2009-02-05 11:24:00','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (105,'vinogradova','yulia','y.vinogradova@yahoo.fr','06.0337.30.30','4, rue Tessier\r\n75015 Paris','C1','P7','ramtin','140482','m','8m7crp74esyeuozz565n','2009-02-05 21:24:01','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (106,'tran-minh','mai-ly','','','','C1','P7','maily','250481','m','zl1744yh2cf03titqokg','2009-02-09 14:26:37','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (107,'michel','frédérique','frederique.michel@hotmail.fr','0661890208','82 rue Louis Rouquier\r\n92300 Levallois-Perret','C1','P7','frederiquemichel','dentiste','m','a6zkowdiqsysk8dcvkl4','2009-02-09 23:21:28','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (108,'bas-kneip','dominique','kneipbas@hotmail.fr','','','C3','St','tribu','tribu','m','','2009-03-17 09:36:38','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (109,'lavignasse','julie','lavignasse.julie@hotmail.fr','','','C1','P5','lavishu','hamster','m','dtp5fyxr5f3l7t23bo05','2009-03-19 15:28:51','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (110,'skinazi','maud','maudski3@hotmail.com','0603884041','','C1','P5','ht03707','bdfxh4v','m','zvr1vmk7kytqxlvtdm92','2009-03-21 10:03:04','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (111,'guedj-david','sophie','sophieguedjdavid@yahoo.fr','','','C1','P5','hi04899','bisous','m','v4hs8m18hjenjapa397c','2009-03-22 15:57:36','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (112,'dumat','marion','','','','C1','P5','hu02215','primatice','m','','2009-03-25 12:17:05','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (113,'ben haouia','lassaad','lassaad.bh@hotmail.fr','0663249109','12 rue cadet, 75009 paris ','C1','P7','lassaad','garges','m','jre3kby8b89vfs4xuqwd','2009-04-03 00:36:26','2009-04-11 15:08:12');
INSERT INTO `membres` VALUES (114,'brandelet','mélanie','nanibrand@hotmail.com','0607165147','','C2','P7','melortho','1406','m','wwr2nlu2kz2grctmo7tv','2009-04-05 16:00:49','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (115,'pham','florence','','','','C1','P5','florencepham','9866','m','ul90uuqgn00uhje658za','2009-04-06 17:14:37','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (116,'flitti','sabrina','s.flitti@free.fr','0683148725','11 ter rue Nicolo\r\n75116 PARIS','C1','P5','dentiste','lullaby','m','quaontmsiupyggzs3huj','2009-05-29 07:07:34','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (117,'alcabes','yael','yael.orjekh@gmail.com','0618151866','6 rue marceau \r\n92300 levallois','C1','P5','yael','mathias','m','zy8rdqrwy66rrtb00etz','2009-06-08 10:54:46','0000-00-00 00:00:00');
INSERT INTO `membres` VALUES (118,'maire','claire-hélène','clairehelene32@hotmail.com','0682075433','54 bis avenue de la Motte Picquet\r\n75015 Paris','C1','P7','clairehelene','dentiste','m','oomz2y9b0oulfkzn5nms','2009-07-20 16:48:04','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `membres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `news` (
  `id_news` int(10) NOT NULL auto_increment,
  `titre` varchar(255) NOT NULL default '',
  `corps` text NOT NULL,
  `categ` varchar(20) NOT NULL default '',
  `id_membres` int(20) NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id_news`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'Ouverture CECSMO.NET','Apres une longue attente le site est enfin là. Il pourrait me permettre de l\'utiliser comme un défouloir apres avoir passé le probatoire, mais je n\'ai pas l\'intention de l\'utiliser comme un blog mais plutot comme un site permettant de fournir des petits services bien pratique comme le trombinoscope, l\'agenda des cours... et les cours !				\r\n\r\nEt puis aussi pour des activités plus sérieuses comme un guide des meilleur(e)s patissier(e)s de la promo','P5-C1',2,'2007-03-22 23:44:00');
INSERT INTO `news` VALUES (2,'Cours et conférence à venir','Pour rappeler à tous les conférences de l\'APOM\r\n\r\nMardi 3 avril 2007\r\n9h – 12h Amphi Pierre Dargent (SO4)	\r\nDocteur Françoise FLAGEUL	\r\nBiomécanique orthodontique\r\n\r\nEgalement pour les C1 paris\r\nun rajout à l\'emploi du temps:\r\nlundi 23 avril 9h-12h évaluation des tp ricketts à garancière','P5-C1',2,'2007-03-23 00:35:53');
INSERT INTO `news` VALUES (3,'Sauvegarde informatique','Voici une petite news pour vous conseiller de faire une sauvegarde\r\nde toutes vos données informatiques et notamment de vos observ et photo clinique de vos patients\r\nsoit sur CD ou DVD, ou sur disque-dur\r\nAfin de parer a tout événement informatique indépendant de votre volonté\r\nEn cas de soucis cela vous rendra bien service\r\n\r\nC\'etait un message à caractère informatif ;)','P5-C1',2,'2007-05-01 22:33:36');
INSERT INTO `news` VALUES (4,'Format d\'image des photos','Rapport largeur/hauteur des photos\r\n\r\nphotos exobuccales:\r\n-profil:         1/1\r\n-face:           1/1,3\r\n-sourire:       1/1,2\r\n\r\nphotos intrabuccales:\r\n-droite, gauche et face: 1,5/1\r\n-occlusales: 1,3/1','P5-C1',2,'2007-05-08 20:05:27');
INSERT INTO `news` VALUES (5,'Video de pliage','Bientot des videos de pliage\r\n[videoflash]boucleU[/videoflash]\r\nLes boucles en U','P5-C1',2,'2007-07-11 00:00:00');
INSERT INTO `news` VALUES (6,'Orthodontistes au bout du fil','Voici ce que titre un article a propos des JO 2007 concernant l\'initiative de mettre en place un numero vert pour les patients souhaitant se renseigner sur l\'orthodontie pendant la journée du 10 novembre\r\n[quote]La Fédération française d’Orthodontie (FFO) vient de mettre à disposition un numéro vert : le 0805 10 00 31. C’est à l’occasion des 10èmes Journées de l’Orthodontie qui auront lieu les 10, 11 et 12 novembre au Palais des Congrès de Paris que l’initiative a été lancée. Des spécialistes de la FFO répondront ainsi, le 10 novembre prochaine de 9h à 18h, aux questions que chacun se pose : « Pourquoi consulter un orthodontiste ? Les adultes sont-ils autant concernés que les enfants ? A quel âge doit - on se laver les dents ? Pourquoi faut-il mettre des bagues ? Doit-on enlever les dents de sagesse ? » (Communiqué de la FFO)\r\n\r\nL’objectif de la FFO est de faire mieux connaître cette spécialité qu’est l’orthodontie et d’apporter les éléments nécessaires, aux adultes comme aux enfants, à la compréhension des traitements dentaires.\r\n\r\nEn savoir plus :www.orthodontie-ffo.org/[/quote]\r\n[url=http://www.naturavox.fr/article.php3?id_article=2506]lien direct de l\'article[/url]\r\n[url=http://www.orthodontie-ffo.org]Site de la FFO[/url]','P5-C2',2,'2007-11-13 23:48:55');
INSERT INTO `news` VALUES (7,'Video probatoire du Cecsmo','Voici une video tres bien realisée et hilarante sur le probatoire du cecsmo\r\non remercie Antoine pour ce magnifique travaille\r\n[videoflash]probaversionfin[/videoflash]\r\n','P5-C4',2,'2008-03-09 15:50:46');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produit`
--

DROP TABLE IF EXISTS `produit`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `produit` (
  `id_produit` int(10) NOT NULL auto_increment,
  `id_categ` int(10) NOT NULL,
  `produit` varchar(255) NOT NULL,
  `id_fournisseur` int(10) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `conditionnement` varchar(255) NOT NULL,
  `prix` decimal(9,2) NOT NULL,
  `stock` int(10) NOT NULL,
  `stock_mini` int(10) NOT NULL,
  `used` int(10) NOT NULL,
  `commande` int(10) NOT NULL,
  `quantite_commande` int(11) NOT NULL,
  `date_commande` date NOT NULL,
  `codabar` varchar(255) NOT NULL,
  PRIMARY KEY  (`id_produit`)
) ENGINE=MyISAM AUTO_INCREMENT=370 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `produit`
--

LOCK TABLES `produit` WRITE;
/*!40000 ALTER TABLE `produit` DISABLE KEYS */;
INSERT INTO `produit` VALUES (1,3,'014',2,'33','par 10','0.55',80,80,1,1,5,'0000-00-00','AM-1');
INSERT INTO `produit` VALUES (2,2,'ligature elastomerique',4,'1245O9I','1000','7.89',15,20,1,1,0,'0000-00-00','AM-2');
INSERT INTO `produit` VALUES (367,14,'bouton pic langue',2,'je0610000B','boite de 10','28.70',2,1,1,0,0,'0000-00-00','');
INSERT INTO `produit` VALUES (6,7,'18.25',2,'98080','par 100','2.00',20,20,1,0,0,'0000-00-00','AM-6');
INSERT INTO `produit` VALUES (53,8,'Colle Gren Gloo, pour bracket metal',2,'740-0321','seringue de 4g','73.98',3,3,1,0,0,'0000-00-00','AM-53');
INSERT INTO `produit` VALUES (55,10,'Primer Ortho Solo',2,'740-0271','flacon de 5 ml','57.36',1,1,1,0,0,'0000-00-00','AM-55');
INSERT INTO `produit` VALUES (54,8,'Blue Gloo, pour bracket ceram',2,'740-0272','seringue de 4g','73.98',3,0,1,0,0,'0000-00-00','AM-54');
INSERT INTO `produit` VALUES (52,9,'Etch gel, acide de mordançage',1,'12558','boite de 4 seringues de 1,2 ml','21.90',2,6,1,1,4,'2009-09-15','AM-52');
INSERT INTO `produit` VALUES (51,11,'Ciment verre ionomère Multi Cure pour bagues',17,'712-050','boite poudre/liquide','101.48',4,3,1,0,0,'2009-09-08','AM-51');
INSERT INTO `produit` VALUES (50,8,'Colle Transbond LR pour contention',17,'712-038','25 embouts de 0,2g','106.16',6,5,1,0,0,'0000-00-00','AM-50');
INSERT INTO `produit` VALUES (49,8,'Colle Transbond Plus Color change',17,'712-104','25 embouts de 0,2g','206.65',2,2,1,0,0,'2009-09-08','AM-49');
INSERT INTO `produit` VALUES (48,8,'Colle Transbond Plus Color change',17,'712-101','seringue de 4g','169.00',3,2,1,0,0,'0000-00-00','AM-48');
INSERT INTO `produit` VALUES (47,10,'Primer Transbond MIP',17,'712-025','flacon de 6 ml','99.23',5,6,1,0,0,'0000-00-00','AM-47');
INSERT INTO `produit` VALUES (63,14,'bouton à coller lingual (base plate)',2,'300-0097','sachet de 10','4.78',1,40,1,0,10,'0000-00-00','AM-63');
INSERT INTO `produit` VALUES (56,12,'Collage ceramique Etch et Silane',5,'10050-U3','coffret','0.00',1,1,1,0,0,'0000-00-00','AM-56');
INSERT INTO `produit` VALUES (57,13,'LC block out resin',5,'UP240','coffret de 4','0.00',2,1,1,0,0,'0000-00-00','AM-57');
INSERT INTO `produit` VALUES (58,13,'pinceaux à colle (court), par 400',6,'BND 400','par 400','30.00',1,1,1,0,0,'0000-00-00','AM-58');
INSERT INTO `produit` VALUES (59,13,'micro brush pinceau à colle',6,'GR 0854','par 100','33.00',8,6,1,0,0,'0000-00-00','AM-59');
INSERT INTO `produit` VALUES (60,13,'bloc feuilles plastique pour mélange ciment',6,'FIX-7','bloc de 50','7.00',8,5,1,0,0,'0000-00-00','AM-60');
INSERT INTO `produit` VALUES (61,13,'system inlay (protection photopolymérisable)',0,'560 189 AN','tube','0.00',8,3,1,0,0,'0000-00-00','AM-61');
INSERT INTO `produit` VALUES (62,13,'spatule à ciment, jetable',6,'GMS 100','par 100','6.00',4,4,1,0,0,'0000-00-00','AM-62');
INSERT INTO `produit` VALUES (101,4,'ressorts easy niti 010x045 distaliseur',7,'dist/1045EF NI','','3.04',15,1,1,0,0,'0000-00-00','AM-101');
INSERT INTO `produit` VALUES (100,14,'crochets à sertir',2,'SGO4050022','','3.40',100,30,1,0,0,'0000-00-00','AM-100');
INSERT INTO `produit` VALUES (99,14,'tube de protection pour arc, 027\'',2,'ASPTC 027','','5.00',3,2,1,0,0,'0000-00-00','AM-99');
INSERT INTO `produit` VALUES (98,4,'ressort acier fermé, en bobine',2,'221-0930','','41.00',1,2,1,1,0,'0000-00-00','AM-98');
INSERT INTO `produit` VALUES (97,14,'clear power tube 25',2,'640-4026','','5.00',2,2,1,0,0,'0000-00-00','AM-97');
INSERT INTO `produit` VALUES (96,2,'mini ligatures préformées métal pour lingual',2,'270-0001','paquet de 1000','52.64',1,0,1,0,0,'0000-00-00','AM-96');
INSERT INTO `produit` VALUES (95,2,'anneaux élastomériques gris, en diamètre 120) par 1000',2,'NE 00600003','','19.26',45,0,1,0,0,'0000-00-00','AM-95');
INSERT INTO `produit` VALUES (94,1,'chainette élastique',2,'639-0046','par bobine de 4 m','66.03',0,0,1,0,0,'0000-00-00','AM-94');
INSERT INTO `produit` VALUES (93,1,'chainette élastique (génération II, grise)',2,'639-0047','par bobine de 4 m','66.03',1,0,1,0,0,'0000-00-00','AM-93');
INSERT INTO `produit` VALUES (92,1,'chainette élastique (génération II, grise)',2,'639-0019','par bobine de 4 m','66.03',1,3,1,1,0,'0000-00-00','AM-92');
INSERT INTO `produit` VALUES (91,1,'chainette élastique (génération II, grise)',2,'639-0001','par bobine de 4 m','66.03',7,5,1,0,0,'0000-00-00','AM-91');
INSERT INTO `produit` VALUES (90,1,'chainette élastique (génération II, grise)',2,'639-0003','par bobine de 4 m','66.03',18,5,1,0,0,'0000-00-00','AM-90');
INSERT INTO `produit` VALUES (89,1,'chainette élastique (génération II, claire)',2,'639-0002','par bobine de 4 m','66.03',19,5,1,0,0,'0000-00-00','AM-89');
INSERT INTO `produit` VALUES (88,1,'chainette élastique (génération II, claire)',2,'639-0004','par bobine de 4 m','66.03',8,5,1,0,0,'0000-00-00','AM-88');
INSERT INTO `produit` VALUES (87,14,'bouton à coller lingual (base courbe)',2,'300-0096','sachet de 10','4.78',30,0,1,0,0,'0000-00-00','AM-87');
INSERT INTO `produit` VALUES (86,14,'bouton à coller lingual (base plate)',2,'300-0097','sachet de 10','4.78',40,0,1,0,0,'0000-00-00','AM-86');
INSERT INTO `produit` VALUES (102,4,'ressorts distaliseur molaire titanium',8,'100-647','','40.00',2,1,1,0,0,'0000-00-00','AM-102');
INSERT INTO `produit` VALUES (103,4,'ressorts NiTi coil spring',2,'221-5514','','48.94',5,0,1,0,0,'0000-00-00','AM-103');
INSERT INTO `produit` VALUES (104,14,'séparateurs post',2,'6400080','sachet de 1000','72.38',3,0,1,0,0,'0000-00-00','AM-104');
INSERT INTO `produit` VALUES (105,14,'coin de rotation',0,'','sachet de 100','14.00',18,0,0,0,0,'0000-00-00','AM-105');
INSERT INTO `produit` VALUES (106,14,'lame à stripper diamantée (pièce)',2,'ID01130610','par 12','31.69',48,60,1,0,0,'0000-00-00','AM-106');
INSERT INTO `produit` VALUES (107,14,'crochet pour placer élastique',6,'EPT 100','sachet de 100','15.50',100,1,1,0,0,'0000-00-00','AM-107');
INSERT INTO `produit` VALUES (108,14,'pinces crocodile réductrice',0,'JO 08011988','','0.00',6,0,1,0,0,'0000-00-00','AM-108');
INSERT INTO `produit` VALUES (109,3,'.012',9,'','paquet de 10 arcs','0.90',0,60,1,0,0,'0000-00-00','AM-109');
INSERT INTO `produit` VALUES (110,3,'.014',9,'','paquet de 10 arcs','0.90',35,60,1,0,0,'0000-00-00','AM-110');
INSERT INTO `produit` VALUES (111,3,'.016',1,'','paquet de 10 arcs','2.00',0,60,1,0,0,'0000-00-00','AM-111');
INSERT INTO `produit` VALUES (112,3,'.018 V',9,'','paquet de 10 arcs','0.90',560,60,1,0,0,'0000-00-00','AM-112');
INSERT INTO `produit` VALUES (113,3,'.020',9,'','paquet de 10 arcs','0.90',60,0,1,0,0,'0000-00-00','AM-113');
INSERT INTO `produit` VALUES (114,3,'16.22',1,'','paquet de 10 arcs','2.60',25,20,1,0,0,'0000-00-00','AM-114');
INSERT INTO `produit` VALUES (115,3,'17.25',1,'','paquet de 10 arcs','2.60',325,60,1,0,0,'0000-00-00','AM-115');
INSERT INTO `produit` VALUES (116,3,'18.25',9,'','paquet de 10 arcs','1.20',120,60,1,0,0,'0000-00-00','AM-116');
INSERT INTO `produit` VALUES (117,3,'21.25',9,'','paquet de 10 arcs','1.20',240,40,1,0,0,'0000-00-00','AM-117');
INSERT INTO `produit` VALUES (118,15,'.014',2,'2 051 902','paquet de 10 arcs','4.12',59,80,1,0,0,'0000-00-00','AM-118');
INSERT INTO `produit` VALUES (119,15,'.018',2,'2 051 904','paquet de 10 arcs','4.12',17,0,1,0,0,'0000-00-00','AM-119');
INSERT INTO `produit` VALUES (120,15,'14.25',2,'2 101 905','paquet de 10 arcs','4.12',79,80,1,0,0,'0000-00-00','AM-120');
INSERT INTO `produit` VALUES (121,15,'16.25',2,'2 101 906','paquet de 10 arcs','4.12',90,40,1,0,0,'0000-00-00','AM-121');
INSERT INTO `produit` VALUES (122,15,'18.25',2,'2 101 907','paquet de 10 arcs','4.12',52,80,1,0,0,'0000-00-00','AM-122');
INSERT INTO `produit` VALUES (123,18,'19.25 cds',9,'','paquet de 5 arcs','2.40',10,0,1,0,0,'0000-00-00','AM-123');
INSERT INTO `produit` VALUES (124,16,'.014',9,'','paquet de 10 arcs','2.36',340,0,1,0,0,'0000-00-00','AM-124');
INSERT INTO `produit` VALUES (125,16,'.018',9,'','paquet de 10 arcs','2.36',220,0,1,0,0,'0000-00-00','AM-125');
INSERT INTO `produit` VALUES (126,16,'18.25',9,'','paquet de 10 arcs','2.36',230,0,1,0,0,'0000-00-00','AM-126');
INSERT INTO `produit` VALUES (127,3,'.012',7,'','paquet de 10 arcs','0.72',210,0,1,0,0,'0000-00-00','AM-127');
INSERT INTO `produit` VALUES (128,3,'.014',7,'','paquet de 10 arcs','0.72',170,0,1,0,0,'0000-00-00','AM-128');
INSERT INTO `produit` VALUES (129,3,'.016',7,'','paquet de 10 arcs','0.72',190,0,1,0,0,'0000-00-00','AM-129');
INSERT INTO `produit` VALUES (130,3,'16.22',7,'','paquet de 10 arcs','0.98',100,0,1,0,0,'0000-00-00','AM-130');
INSERT INTO `produit` VALUES (131,3,'14.25',7,'','paquet de 10 arcs','0.98',90,0,1,0,0,'0000-00-00','AM-131');
INSERT INTO `produit` VALUES (132,18,'16.22 cds',7,'','paquet de 10 arcs','2.80',50,0,1,0,0,'0000-00-00','AM-132');
INSERT INTO `produit` VALUES (133,18,'19.25 cds',7,'','paquet de 10 arcs','2.80',30,0,1,0,0,'0000-00-00','AM-133');
INSERT INTO `produit` VALUES (134,19,'19.25',7,'','paquet de 5 arcs','8.80',20,0,1,0,0,'0000-00-00','AM-134');
INSERT INTO `produit` VALUES (135,20,'.016',0,'','paquet de 10 arcs','5.00',40,0,1,0,0,'0000-00-00','AM-135');
INSERT INTO `produit` VALUES (136,20,'16.22',0,'','paquet de 10 arcs','6.10',20,0,1,0,0,'0000-00-00','AM-136');
INSERT INTO `produit` VALUES (137,20,'17.25',0,'','paquet de 10 arcs','6.10',80,0,1,0,0,'0000-00-00','AM-137');
INSERT INTO `produit` VALUES (138,21,'175.175',2,'202-0018','paquet de 10 arcs','10.00',6,0,1,0,0,'0000-00-00','AM-138');
INSERT INTO `produit` VALUES (139,21,'17.25',2,'202-0020','paquet de 10 arcs','10.00',7,0,1,0,0,'0000-00-00','AM-139');
INSERT INTO `produit` VALUES (140,21,'.016',2,'202-0025','paquet de 10 arcs','10.00',3,0,1,0,0,'0000-00-00','AM-140');
INSERT INTO `produit` VALUES (141,22,'17.25',7,'DM 017x025 EF Beta','paquet de 10 arcs','2.93',20,0,1,0,0,'0000-00-00','AM-141');
INSERT INTO `produit` VALUES (142,22,'19.25',7,'DM 019x025 EF Beta','paquet de 10 arcs','2.93',50,0,1,0,0,'0000-00-00','AM-142');
INSERT INTO `produit` VALUES (143,20,'21.25',0,'','paquet de 10 arcs','6.10',100,0,1,0,0,'0000-00-00','AM-143');
INSERT INTO `produit` VALUES (144,20,'19.25',0,'','paquet de 5 arcs','6.10',150,0,1,0,0,'0000-00-00','AM-144');
INSERT INTO `produit` VALUES (145,26,'16.22',0,'','paquet de 10 arcs','1.50',50,0,1,0,0,'0000-00-00','AM-145');
INSERT INTO `produit` VALUES (146,27,'.0175',0,'','paquet de 10 arcs','1.50',11,0,1,0,0,'0000-00-00','AM-146');
INSERT INTO `produit` VALUES (147,7,'16.22',0,'','paquet de 10 arcs','0.60',49,0,1,0,0,'0000-00-00','AM-147');
INSERT INTO `produit` VALUES (148,7,'18.25',0,'','paquet de 25 arcs','0.60',37,0,1,0,0,'0000-00-00','AM-148');
INSERT INTO `produit` VALUES (149,7,'19.25',0,'','','0.60',74,0,1,0,0,'0000-00-00','AM-149');
INSERT INTO `produit` VALUES (150,7,'21.25',0,'','','0.60',260,0,1,0,0,'0000-00-00','AM-150');
INSERT INTO `produit` VALUES (151,7,'22.28',0,'','','0.60',110,0,0,0,0,'0000-00-00','AM-151');
INSERT INTO `produit` VALUES (152,23,'.014',0,'','tube de 10 longueurs','2.65',2,0,1,0,0,'0000-00-00','AM-152');
INSERT INTO `produit` VALUES (153,23,'.016',0,'','tube de 10 longueurs','2.65',3,0,1,0,0,'0000-00-00','AM-153');
INSERT INTO `produit` VALUES (154,23,'.018',0,'','tube de 10 longueurs','2.65',3,0,1,0,0,'0000-00-00','AM-154');
INSERT INTO `produit` VALUES (155,23,'21.25',10,'E 90','tube de 10 brins','4.50',2,0,1,0,0,'0000-00-00','AM-155');
INSERT INTO `produit` VALUES (156,23,'18.25',10,'E 00097','tube de 10 brins','4.50',2,0,1,0,0,'0000-00-00','AM-156');
INSERT INTO `produit` VALUES (157,23,'16.22',10,'E 00098','tube de 10 brins','4.50',3,0,1,0,0,'0000-00-00','AM-157');
INSERT INTO `produit` VALUES (158,23,'17.22',10,'E 00099','tube de 10 brins','4.50',3,0,1,0,0,'0000-00-00','AM-158');
INSERT INTO `produit` VALUES (159,23,'19.26',10,'E 95','tube de 10 brins','4.50',2,0,1,0,0,'0000-00-00','AM-159');
INSERT INTO `produit` VALUES (160,23,'.030',10,'E 17','tube de 10 brins','4.50',2,0,1,0,0,'0000-00-00','AM-160');
INSERT INTO `produit` VALUES (161,23,'.036',10,'E 00019','tube de 10 brins','4.50',1,0,1,0,0,'0000-00-00','AM-161');
INSERT INTO `produit` VALUES (162,24,'.0155',10,'E 00179','tube de 10 brins','15.20',11,0,1,0,0,'0000-00-00','AM-162');
INSERT INTO `produit` VALUES (163,24,'.0175',10,'E 00180','tube de 10 brins','15.20',1,0,1,0,0,'0000-00-00','AM-163');
INSERT INTO `produit` VALUES (164,24,'.0195',10,'E 00181','tube de 10 brins','15.20',7,0,1,0,0,'0000-00-00','AM-164');
INSERT INTO `produit` VALUES (165,24,'.021',10,'E 00182','tube de 10 brins','15.20',8,0,1,0,0,'0000-00-00','AM-165');
INSERT INTO `produit` VALUES (166,24,'.0195',2,'2640195','tube de 10 brins','4.50',1,0,1,0,0,'0000-00-00','AM-166');
INSERT INTO `produit` VALUES (167,25,'17.25',7,'EABF 1725','tube de 10 brins','61.00',2,0,1,0,0,'0000-00-00','AM-167');
INSERT INTO `produit` VALUES (168,25,'16.22',2,'2660010','tube de 10 brins','61.00',1,0,1,0,0,'0000-00-00','AM-168');
INSERT INTO `produit` VALUES (169,25,'17.25',2,'2660011','tube de 10 brins','61.00',1,0,1,0,0,'0000-00-00','AM-169');
INSERT INTO `produit` VALUES (170,25,'19.25',2,'2660013','tube de 10 brins','61.00',1,0,1,0,0,'0000-00-00','AM-170');
INSERT INTO `produit` VALUES (171,28,'.0155',2,'203-0006','paquet de 10 arcs','2.00',0,0,1,0,0,'0000-00-00','AM-171');
INSERT INTO `produit` VALUES (172,28,'.0175',2,'203-0007','paquet de 10 arcs','2.00',16,0,1,0,0,'0000-00-00','AM-172');
INSERT INTO `produit` VALUES (173,29,'16.22',2,'201-0011','paquet de 10 arcs','2.00',5,0,1,0,0,'0000-00-00','AM-173');
INSERT INTO `produit` VALUES (174,29,'175.175',2,'02-530-73','paquet de 10 arcs','2.00',6,0,1,0,0,'0000-00-00','AM-174');
INSERT INTO `produit` VALUES (175,30,'.016',2,'205-0021','paquet de 10 arcs','8.50',11,0,1,0,0,'0000-00-00','AM-175');
INSERT INTO `produit` VALUES (176,31,'universel',2,'','arcs','10.00',64,0,1,0,0,'0000-00-00','AM-176');
INSERT INTO `produit` VALUES (177,32,'ressort universel',17,'','par 5','80.00',2,0,1,0,0,'0000-00-00','AM-177');
INSERT INTO `produit` VALUES (178,32,'pin universel',17,'','par 10','52.00',2,0,1,0,0,'0000-00-00','AM-178');
INSERT INTO `produit` VALUES (179,32,'Droite 32 mm',17,'','par 5','62.44',5,0,1,0,0,'0000-00-00','AM-179');
INSERT INTO `produit` VALUES (180,32,'Droite 29 mm',17,'','par 5','62.44',6,0,1,0,0,'0000-00-00','AM-180');
INSERT INTO `produit` VALUES (181,32,'Droite 25 mm',17,'','par 5','62.44',8,0,1,0,0,'0000-00-00','AM-181');
INSERT INTO `produit` VALUES (182,32,'Droite 35 mm',17,'','par 5','62.44',8,0,1,0,0,'0000-00-00','AM-182');
INSERT INTO `produit` VALUES (183,32,'Droite 38 mm',17,'','par 5','62.44',5,0,1,0,0,'0000-00-00','AM-183');
INSERT INTO `produit` VALUES (184,32,'Gauche 25 mm',17,'','par 5','62.44',9,0,1,0,0,'0000-00-00','AM-184');
INSERT INTO `produit` VALUES (185,32,'Gauche 29 mm',17,'','par 5','62.44',6,0,1,0,0,'0000-00-00','AM-185');
INSERT INTO `produit` VALUES (186,32,'Gauche 32 mm',17,'','par 5','62.44',8,0,1,0,0,'0000-00-00','AM-186');
INSERT INTO `produit` VALUES (187,32,'Gauche 35 mm',17,'','par 5','62.44',6,0,1,0,0,'0000-00-00','AM-187');
INSERT INTO `produit` VALUES (188,32,'Gauche 38 mm',17,'','par 5','62.44',5,0,1,0,0,'0000-00-00','AM-188');
INSERT INTO `produit` VALUES (189,32,'stop ? sertir',17,'','par 50','20.00',1,0,1,0,0,'0000-00-00','AM-189');
INSERT INTO `produit` VALUES (190,33,'Impala',2,'630-0050','boite de 10 sachets','46.11',2,5,1,1,3,'2009-09-15','AM-190');
INSERT INTO `produit` VALUES (191,33,'Kangourou',2,'630-0040','boite de 10 sachets','46.11',3,1,1,0,0,'0000-00-00','AM-191');
INSERT INTO `produit` VALUES (192,33,'Lama',2,'630-0036','boite de 10 sachets','46.11',4,1,1,0,0,'0000-00-00','AM-192');
INSERT INTO `produit` VALUES (193,33,'Renard',2,'630-0032','boite de 10 sachets','46.11',2,2,1,0,0,'0000-00-00','AM-193');
INSERT INTO `produit` VALUES (194,33,'Ours',2,'630-0041','boite de 10 sachets','46.11',1,1,1,0,0,'0000-00-00','AM-194');
INSERT INTO `produit` VALUES (195,33,'Ram',2,'630-0051','boite de 10 sachets','46.11',2,2,1,0,0,'0000-00-00','AM-195');
INSERT INTO `produit` VALUES (196,33,'Moose',2,'630-0052','boite de 10 sachets','46.11',2,1,1,0,0,'0000-00-00','AM-196');
INSERT INTO `produit` VALUES (197,33,'Hummingbird',2,'630-0010','boite de 10 sachets','46.11',1,1,1,0,0,'0000-00-00','AM-197');
INSERT INTO `produit` VALUES (198,33,'Ecureuil',2,'630-0030','boite de 10 sachets','46.11',3,3,1,0,0,'0000-00-00','AM-198');
INSERT INTO `produit` VALUES (199,33,'Lapin',2,'630-0031','boite de 10 sachets','46.11',2,3,1,1,1,'2009-09-15','AM-199');
INSERT INTO `produit` VALUES (200,33,'Elephant',2,'635-0066','boite de 10 sachets','46.11',1,1,1,0,0,'0000-00-00','AM-200');
INSERT INTO `produit` VALUES (201,33,'Panther',2,'635-0060','boite de 10 sachets','46.11',7,2,1,0,0,'0000-00-00','AM-201');
INSERT INTO `produit` VALUES (202,33,'Baleine',2,'634-0142','boite de 10 sachets','46.11',1,1,1,0,0,'0000-00-00','AM-202');
INSERT INTO `produit` VALUES (203,33,'Bêlier',2,'630-0051','boite de 10 sachets','46.11',2,2,1,0,0,'0000-00-00','AM-203');
INSERT INTO `produit` VALUES (204,33,'Leopard',2,'635-0059','boite de 10 sachets','46.11',1,2,1,1,1,'2009-09-15','AM-204');
INSERT INTO `produit` VALUES (205,33,'Lion',2,'635-0062','boite de 10 sachets','46.11',5,1,1,0,0,'0000-00-00','AM-205');
INSERT INTO `produit` VALUES (206,33,'Cougar',2,'635-0058','boite de 10 sachets','46.11',1,2,1,1,1,'2009-09-15','AM-206');
INSERT INTO `produit` VALUES (207,33,'Chameau',2,'','boite de 10 sachets','46.11',1,1,1,0,0,'0000-00-00','AM-207');
INSERT INTO `produit` VALUES (208,33,'Buffalo',2,'','boite de 10 sachets','46.11',1,1,1,0,0,'0000-00-00','AM-208');
INSERT INTO `produit` VALUES (209,33,'Tigre',2,'635-0061','boite de 10 sachets','46.11',5,2,1,0,0,'0000-00-00','AM-209');
INSERT INTO `produit` VALUES (210,34,'15 mm, D',11,'CDA  15R','','89.89',4,0,1,0,0,'0000-00-00','AM-210');
INSERT INTO `produit` VALUES (211,34,'15 mm, G',11,'CDA  15L','','89.89',4,0,1,0,0,'0000-00-00','AM-211');
INSERT INTO `produit` VALUES (212,34,'16 mm, D',11,'CDA  16R','','89.89',3,0,1,0,0,'0000-00-00','AM-212');
INSERT INTO `produit` VALUES (213,34,'16 mm, G',11,'CDA  16L','','89.89',3,0,1,0,0,'0000-00-00','AM-213');
INSERT INTO `produit` VALUES (214,34,'18 mm, D',11,'CDA  18R','','89.89',2,0,1,0,0,'0000-00-00','AM-214');
INSERT INTO `produit` VALUES (215,34,'18 mm, G',11,'CDA  18L','','89.89',3,0,1,0,0,'0000-00-00','AM-215');
INSERT INTO `produit` VALUES (216,34,'20 mm, D',11,'CDA  20R','','89.89',3,0,1,0,0,'0000-00-00','AM-216');
INSERT INTO `produit` VALUES (217,34,'20 mm, G',11,'CDA  20L','','89.89',3,0,1,0,0,'0000-00-00','AM-217');
INSERT INTO `produit` VALUES (218,34,'23 mm, D',11,'CDA  23R','','89.89',4,0,1,0,0,'0000-00-00','AM-218');
INSERT INTO `produit` VALUES (219,34,'23 mm, G',11,'CDA  23L','','89.89',6,0,1,0,0,'0000-00-00','AM-219');
INSERT INTO `produit` VALUES (220,34,'25 mm, D',11,'CDA  25R','','89.89',3,0,1,0,0,'0000-00-00','AM-220');
INSERT INTO `produit` VALUES (221,34,'25 mm, G',11,'CDA  25L','','89.89',4,0,1,0,0,'0000-00-00','AM-221');
INSERT INTO `produit` VALUES (222,34,'27 mm, D',11,'CDA  27R','','89.89',3,0,1,0,0,'0000-00-00','AM-222');
INSERT INTO `produit` VALUES (223,34,'27 mm, G',11,'CDA  27L','','89.89',2,0,1,0,0,'0000-00-00','AM-223');
INSERT INTO `produit` VALUES (224,34,'34 mm, D',11,'CDA  34R','','89.89',5,0,1,0,0,'0000-00-00','AM-224');
INSERT INTO `produit` VALUES (225,34,'34 mm, G',11,'CDA  34L','','89.89',5,0,1,0,0,'0000-00-00','AM-225');
INSERT INTO `produit` VALUES (226,35,'taille n°1',11,'DIFI 031','par 3','30.22',2,1,1,0,0,'0000-00-00','AM-226');
INSERT INTO `produit` VALUES (227,35,'taille n°2',11,'DIFI 032','par 3','30.22',3,2,1,0,0,'0000-00-00','AM-227');
INSERT INTO `produit` VALUES (228,35,'taille n°2',11,'DIFI 022','par 5','30.22',1,0,1,0,0,'0000-00-00','AM-228');
INSERT INTO `produit` VALUES (229,35,'taille n°3',11,'DIFI 023','par 5','30.22',1,0,1,0,0,'0000-00-00','AM-229');
INSERT INTO `produit` VALUES (230,35,'taille n°4',11,'DIFI 024','par 5','30.22',1,0,1,0,0,'0000-00-00','AM-230');
INSERT INTO `produit` VALUES (231,36,'Lip Bumper',0,'','','10.00',15,0,1,0,0,'0000-00-00','AM-231');
INSERT INTO `produit` VALUES (232,37,'38mm',20,'','','3.50',11,0,1,0,0,'0000-00-00','AM-232');
INSERT INTO `produit` VALUES (233,37,'40mm',20,'','','3.50',17,0,1,0,0,'0000-00-00','AM-233');
INSERT INTO `produit` VALUES (234,37,'42mm',20,'','','3.50',20,0,1,0,0,'0000-00-00','AM-234');
INSERT INTO `produit` VALUES (235,37,'44mm',20,'','','3.50',18,0,1,0,0,'0000-00-00','AM-235');
INSERT INTO `produit` VALUES (236,37,'46mm',20,'','','3.50',10,0,1,0,0,'0000-00-00','AM-236');
INSERT INTO `produit` VALUES (237,37,'48mm',1,'','','3.50',10,0,1,0,0,'0000-00-00','AM-237');
INSERT INTO `produit` VALUES (238,37,'50mm',1,'','','3.50',9,0,1,0,0,'0000-00-00','AM-238');
INSERT INTO `produit` VALUES (239,37,'52mm',1,'','','3.50',12,0,1,0,0,'0000-00-00','AM-239');
INSERT INTO `produit` VALUES (240,37,'54mm',1,'','','3.50',14,0,1,0,0,'0000-00-00','AM-240');
INSERT INTO `produit` VALUES (241,37,'56mm',1,'','','3.50',14,0,1,0,0,'0000-00-00','AM-241');
INSERT INTO `produit` VALUES (242,42,'Casque nu',2,'AIOO716405','','8.00',100,0,1,0,0,'0000-00-00','AM-242');
INSERT INTO `produit` VALUES (243,42,'Bande de nuque',9,'','','5.20',200,0,1,0,0,'0000-00-00','AM-243');
INSERT INTO `produit` VALUES (244,42,'Modules de forces extra-orales',9,'','','2.40',200,0,1,0,0,'0000-00-00','AM-244');
INSERT INTO `produit` VALUES (245,42,'High Pull médium',2,'LEO 071 2002','','0.00',6,4,1,0,0,'0000-00-00','AM-245');
INSERT INTO `produit` VALUES (246,42,'High Pull large',2,'LEO 071 2003','','0.00',3,2,1,0,0,'0000-00-00','AM-246');
INSERT INTO `produit` VALUES (247,40,'EF1 jaune',11,'D590000','? l\'unit?','36.30',10,8,1,0,0,'0000-00-00','AM-247');
INSERT INTO `produit` VALUES (248,40,'EF2 blanc',11,'D590003','? l\'unit?','36.30',10,6,1,0,0,'0000-00-00','AM-248');
INSERT INTO `produit` VALUES (249,40,'EF3 vert',11,'D590004','? l\'unit?','36.30',9,8,1,0,0,'0000-00-00','AM-249');
INSERT INTO `produit` VALUES (250,40,'EF type classe III, I3',11,'I 3','à l\'unité','54.92',3,2,1,0,0,'0000-00-00','AM-250');
INSERT INTO `produit` VALUES (251,41,'T4K',11,'D591001','? l\'unit?','44.73',5,4,1,0,0,'0000-00-00','AM-251');
INSERT INTO `produit` VALUES (252,41,'T4B',11,'D591030','? l\'unit?','44.73',4,3,1,0,0,'0000-00-00','AM-252');
INSERT INTO `produit` VALUES (253,41,'TMJ',11,'TMJ','? l\'unit?','44.73',10,3,1,0,0,'0000-00-00','AM-253');
INSERT INTO `produit` VALUES (254,40,'Infant trainer bleu',11,'D591012','? l\'unit?','39.96',2,2,1,0,0,'0000-00-00','AM-254');
INSERT INTO `produit` VALUES (255,40,'Infant trainer rose',11,'D591011','? l\'unit?','39.96',2,2,1,0,0,'0000-00-00','AM-255');
INSERT INTO `produit` VALUES (256,38,'MB1',11,'MB1','? l\'unit?','54.96',4,2,1,0,0,'0000-00-00','AM-256');
INSERT INTO `produit` VALUES (257,38,'MB2',11,'MB2','? l\'unit?','54.93',2,2,1,0,0,'0000-00-00','AM-257');
INSERT INTO `produit` VALUES (258,38,'MB3',11,'MB3','? l\'unit?','54.93',5,3,1,0,0,'0000-00-00','AM-258');
INSERT INTO `produit` VALUES (259,38,'MB4',11,'MB4','? l\'unit?','54.93',1,2,1,0,0,'0000-00-00','AM-259');
INSERT INTO `produit` VALUES (260,38,'MB5',11,'MB5','? l\'unit?','54.93',3,3,1,0,0,'0000-00-00','AM-260');
INSERT INTO `produit` VALUES (261,38,'MB6',11,'MB6','? l\'unit?','54.93',4,3,1,0,0,'0000-00-00','AM-261');
INSERT INTO `produit` VALUES (262,39,'35 LOW ',10,'','','50.00',3,2,1,0,0,'0000-00-00','AM-262');
INSERT INTO `produit` VALUES (263,39,'40 LOW ',10,'','','50.00',2,2,1,0,0,'0000-00-00','AM-263');
INSERT INTO `produit` VALUES (264,39,'45 LOW ',10,'','','50.00',2,2,1,0,0,'0000-00-00','AM-264');
INSERT INTO `produit` VALUES (265,39,'50 LOW ',10,'','','50.00',1,1,1,0,0,'0000-00-00','AM-265');
INSERT INTO `produit` VALUES (266,39,'55 LOW ',10,'','','50.00',3,2,1,0,0,'0000-00-00','AM-266');
INSERT INTO `produit` VALUES (267,39,'35 HIGH',10,'','','50.00',1,1,1,0,0,'0000-00-00','AM-267');
INSERT INTO `produit` VALUES (268,39,'40 HIGH',10,'','','50.00',2,2,1,0,0,'0000-00-00','AM-268');
INSERT INTO `produit` VALUES (269,39,'45 HIGH',10,'','','50.00',2,2,1,0,0,'0000-00-00','AM-269');
INSERT INTO `produit` VALUES (270,39,'50 HIGH',10,'','','50.00',4,2,1,0,0,'0000-00-00','AM-270');
INSERT INTO `produit` VALUES (271,39,'55 HIGH',10,'','','50.00',2,2,1,0,0,'0000-00-00','AM-271');
INSERT INTO `produit` VALUES (272,42,'fronde mentonnière',2,'0B0071130B','L\'unité','50.00',3,2,1,0,0,'0000-00-00','AM-272');
INSERT INTO `produit` VALUES (273,42,'fronde mentonnière',2,'0B0071130A','','50.00',2,2,1,0,0,'0000-00-00','AM-273');
INSERT INTO `produit` VALUES (274,42,'masque de Delaire',2,'F007160802','','87.95',2,2,1,0,0,'0000-00-00','AM-274');
INSERT INTO `produit` VALUES (332,45,'Traynet (desinfectant portes empreintes)',12,'','par 1','50.00',3,0,1,0,0,'0000-00-00','AM-332');
INSERT INTO `produit` VALUES (331,45,'Dimenol (desinfectant empreintes)',12,'','par 3','57.45',2,0,1,0,0,'0000-00-00','AM-331');
INSERT INTO `produit` VALUES (330,45,'Pochettes stérilisation 90x230mm',1,'4420','par 200','22.50',5,0,1,0,0,'0000-00-00','AM-330');
INSERT INTO `produit` VALUES (329,46,'Serviettes carrés, blanches 29x29',1,'5122','lot de 3000','54.80',0,0,1,0,0,'0000-00-00','AM-329');
INSERT INTO `produit` VALUES (328,46,'Masques à lanières',1,'5792','boite de 50','12.90',6,0,1,0,0,'0000-00-00','AM-328');
INSERT INTO `produit` VALUES (327,46,'Masques élastiques',1,'5379','boite de 50','16.00',9,0,1,0,0,'0000-00-00','AM-327');
INSERT INTO `produit` VALUES (326,44,'Brosses à dent de voyage',6,'44003','par 12','12.00',4,0,1,0,0,'0000-00-00','AM-326');
INSERT INTO `produit` VALUES (325,44,'Brosses à dent jetables avec dentifrice',6,'20609','par 144','43.00',1,0,1,0,0,'0000-00-00','AM-325');
INSERT INTO `produit` VALUES (324,44,'Brosses à dent 3S Ortho',13,'','par 12','16.36',7,0,1,0,0,'0000-00-00','AM-324');
INSERT INTO `produit` VALUES (323,45,'Mediklar',14,'','','0.00',2,0,1,0,0,'0000-00-00','AM-323');
INSERT INTO `produit` VALUES (322,45,'Proclean',14,'PRC5L','bidon 5L','80.40',2,0,1,0,0,'0000-00-00','AM-322');
INSERT INTO `produit` VALUES (321,45,'Mediclean Forte',14,'405033','bidon 5L','136.52',3,0,1,0,0,'0000-00-00','AM-321');
INSERT INTO `produit` VALUES (320,46,'Embouts sprays jetables',14,'44R600','par 100','33.89',10,0,1,0,0,'0000-00-00','AM-320');
INSERT INTO `produit` VALUES (319,46,'Plateaux jetables',1,'15887','boite de 400','28.10',6,6,1,0,0,'0000-00-00','AM-319');
INSERT INTO `produit` VALUES (318,46,'Perotection embouts lampe photo, Cure Sleeve',2,'OR07052019','boite de 400','45.91',3,0,1,0,0,'0000-00-00','AM-318');
INSERT INTO `produit` VALUES (317,46,'Protection embouts seringue air/eau',2,'ORO 7052010','boite de 500','22.03',8,0,1,0,0,'0000-00-00','AM-317');
INSERT INTO `produit` VALUES (316,46,'Pompes à salive jetables',1,'5755','par 100','2.65',8,0,1,0,0,'0000-00-00','AM-316');
INSERT INTO `produit` VALUES (315,46,'Lingettes désinfectantes',12,'','boite de 150','7.60',22,0,1,0,0,'0000-00-00','AM-315');
INSERT INTO `produit` VALUES (314,43,'Gants micro touch Nitrile L',1,'400 670 073','boite de 100','10.00',4,0,1,0,0,'0000-00-00','AM-314');
INSERT INTO `produit` VALUES (313,43,'Gants M',3,'9 001 925','boite de 100','8.60',41,0,1,0,0,'0000-00-00','AM-313');
INSERT INTO `produit` VALUES (312,43,'Gants S',1,'242 160','boite de 100','6.60',38,0,1,0,0,'0000-00-00','AM-312');
INSERT INTO `produit` VALUES (311,43,'Gants latex, non poudrés XS',1,'43,64','boite de 100','13.80',6,0,1,0,0,'0000-00-00','AM-311');
INSERT INTO `produit` VALUES (335,45,'KIRACTIS 77 (désinfectant surface)',1,'4112','bidon 5L','51.90',2,0,1,0,0,'0000-00-00','AM-335');
INSERT INTO `produit` VALUES (334,45,'KIRACTIS 33 (lavage mains)',1,'4433','bidon 5L','47.50',2,0,1,0,0,'0000-00-00','AM-334');
INSERT INTO `produit` VALUES (333,45,'OROTOL (pour aspiration)',1,'4241','bidon 2,5L','37.90',2,0,1,0,0,'0000-00-00','AM-333');
INSERT INTO `produit` VALUES (336,45,'MICRO 10 (désinfectant fraises)',1,'4038','bidon 2,5L','70.00',2,0,1,0,0,'0000-00-00','AM-336');
INSERT INTO `produit` VALUES (337,45,'ESEMFIX (mousse désinfectante surface)',1,'4673','bidon 5L','80.60',1,0,1,0,0,'0000-00-00','AM-337');
INSERT INTO `produit` VALUES (338,45,'STERISET (bidon désinfectant)',12,'','par 1','0.00',4,0,1,0,0,'0000-00-00','AM-338');
INSERT INTO `produit` VALUES (339,44,'Trousses sourires',1,'15952','par 12','16.90',10,0,1,0,0,'0000-00-00','AM-339');
INSERT INTO `produit` VALUES (340,44,'Trousses hygiène',1,'15956','par 36','99.90',4,0,1,0,0,'0000-00-00','AM-340');
INSERT INTO `produit` VALUES (341,46,'Tabliers',1,'5156','rouleau','57.50',2,0,1,0,0,'0000-00-00','AM-341');
INSERT INTO `produit` VALUES (342,44,'Gobelets',1,'5144','par 1500','33.70',1,0,1,0,0,'0000-00-00','AM-342');
INSERT INTO `produit` VALUES (343,44,'Brosses à dents stage 4',1,'15958','unit?','2.10',16,0,1,0,0,'0000-00-00','AM-343');
INSERT INTO `produit` VALUES (344,45,'Filtres jetables système aspiration jaune',14,'','par 12','35.88',2,0,1,0,0,'0000-00-00','AM-344');
INSERT INTO `produit` VALUES (345,45,'Filtres anti-bactériens (autoclave)',15,'W3224001','unit?','0.00',3,0,1,0,0,'0000-00-00','AM-345');
INSERT INTO `produit` VALUES (346,45,'Filtre machine thermodésinfecteur MIELE',14,'2398970','unit?','0.00',6,0,1,0,0,'0000-00-00','AM-346');
INSERT INTO `produit` VALUES (347,47,'Granulé acier Biostar',3,'878-7998','boite 1kg','41.00',3,0,1,0,0,'0000-00-00','AM-347');
INSERT INTO `produit` VALUES (348,48,'Platre speed stone',16,'NWD 1032','boite de 2kg','13.00',4,0,1,0,0,'0000-00-00','AM-348');
INSERT INTO `produit` VALUES (349,48,'Platre Fujirock',3,'8864291','3kg','31.00',2,0,1,0,0,'0000-00-00','AM-349');
INSERT INTO `produit` VALUES (350,47,'Plaque gouttière copyplast C, 1x125',10,'34032','boite de 100','155.00',1,0,1,0,0,'0000-00-00','AM-350');
INSERT INTO `produit` VALUES (351,47,'Plaque gouttière DURAN, 1x125',3,'8816912','boite de 100','155.00',1,0,1,0,0,'0000-00-00','AM-351');
INSERT INTO `produit` VALUES (352,47,'Plaque gouttière DURAN, 1,5x125',3,'8819027','boite de 10','20.00',1,0,1,0,0,'0000-00-00','AM-352');
INSERT INTO `produit` VALUES (353,47,'Bioplast Transparent, 1,5x125',3,'8787978','boite de 10','19.00',0,0,1,0,0,'0000-00-00','AM-353');
INSERT INTO `produit` VALUES (354,47,'Bioplast bleu, 2x125',3,'32781','boite de 10','26.00',1,0,1,0,0,'0000-00-00','AM-354');
INSERT INTO `produit` VALUES (355,50,'Boite de contention',2,'','boite de 10','1.72',140,0,1,0,0,'0000-00-00','AM-355');
INSERT INTO `produit` VALUES (356,49,'Alginate R&S, 500 gr',1,'1129','','10.80',4,5,1,0,1,'0000-00-00','AM-356');
INSERT INTO `produit` VALUES (357,49,'Alginate Chroma, 500 gr',1,'1986','','12.90',14,4,1,1,2,'2009-07-22','AM-357');
INSERT INTO `produit` VALUES (360,1,'aaa',1,'3','par 3','3.00',10,20,1,1,3,'2009-07-10','');
INSERT INTO `produit` VALUES (361,18,'19.25 cds',2,'OR02163809','5','10.79',0,5,1,1,5,'2009-07-22','');
INSERT INTO `produit` VALUES (362,18,'17.25 cds',2,'PN 2163807','5','10.79',0,5,1,1,5,'2009-07-22','');
INSERT INTO `produit` VALUES (363,7,'19.25',22,'OCG 430 1100 ','par 25','0.44',0,0,1,0,0,'0000-00-00','');
INSERT INTO `produit` VALUES (364,7,'19.25',2,'AY02271071','sous sachet, pack de 10','1.28',6,0,1,0,0,'0000-00-00','');
INSERT INTO `produit` VALUES (365,3,'014',2,'OR02050101','par 100','0.55',0,0,1,0,0,'0000-00-00','');
INSERT INTO `produit` VALUES (366,3,'19.25',2,'OR02100524','par 100','0.79',0,0,1,0,0,'0000-00-00','');
INSERT INTO `produit` VALUES (368,2,'ligature preformée .010',2,'OR02700010','1000','21.32',5000,0,1,0,0,'0000-00-00','');
INSERT INTO `produit` VALUES (369,14,'papier a articuler',0,'D-50769 koln','300','0.00',2,0,1,0,0,'0000-00-00','');
/*!40000 ALTER TABLE `produit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `punbb_bans`
--

DROP TABLE IF EXISTS `punbb_bans`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `punbb_bans` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(200) default NULL,
  `ip` varchar(255) default NULL,
  `email` varchar(50) default NULL,
  `message` varchar(255) default NULL,
  `expire` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `punbb_bans`
--

LOCK TABLES `punbb_bans` WRITE;
/*!40000 ALTER TABLE `punbb_bans` DISABLE KEYS */;
/*!40000 ALTER TABLE `punbb_bans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `punbb_categories`
--

DROP TABLE IF EXISTS `punbb_categories`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `punbb_categories` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `cat_name` varchar(80) NOT NULL default 'New Category',
  `disp_position` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `punbb_categories`
--

LOCK TABLES `punbb_categories` WRITE;
/*!40000 ALTER TABLE `punbb_categories` DISABLE KEYS */;
INSERT INTO `punbb_categories` VALUES (1,'Test category',1);
/*!40000 ALTER TABLE `punbb_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `punbb_censoring`
--

DROP TABLE IF EXISTS `punbb_censoring`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `punbb_censoring` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `search_for` varchar(60) NOT NULL default '',
  `replace_with` varchar(60) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `punbb_censoring`
--

LOCK TABLES `punbb_censoring` WRITE;
/*!40000 ALTER TABLE `punbb_censoring` DISABLE KEYS */;
/*!40000 ALTER TABLE `punbb_censoring` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `punbb_config`
--

DROP TABLE IF EXISTS `punbb_config`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `punbb_config` (
  `conf_name` varchar(255) NOT NULL default '',
  `conf_value` text,
  PRIMARY KEY  (`conf_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `punbb_config`
--

LOCK TABLES `punbb_config` WRITE;
/*!40000 ALTER TABLE `punbb_config` DISABLE KEYS */;
INSERT INTO `punbb_config` VALUES ('o_cur_version','1.2.15');
INSERT INTO `punbb_config` VALUES ('o_board_title','My PunBB forum');
INSERT INTO `punbb_config` VALUES ('o_board_desc','Unfortunately no one can be told what PunBB is - you have to see it for yourself.');
INSERT INTO `punbb_config` VALUES ('o_server_timezone','0');
INSERT INTO `punbb_config` VALUES ('o_time_format','H:i:s');
INSERT INTO `punbb_config` VALUES ('o_date_format','Y-m-d');
INSERT INTO `punbb_config` VALUES ('o_timeout_visit','600');
INSERT INTO `punbb_config` VALUES ('o_timeout_online','300');
INSERT INTO `punbb_config` VALUES ('o_redirect_delay','1');
INSERT INTO `punbb_config` VALUES ('o_show_version','0');
INSERT INTO `punbb_config` VALUES ('o_show_user_info','1');
INSERT INTO `punbb_config` VALUES ('o_show_post_count','1');
INSERT INTO `punbb_config` VALUES ('o_smilies','1');
INSERT INTO `punbb_config` VALUES ('o_smilies_sig','1');
INSERT INTO `punbb_config` VALUES ('o_make_links','1');
INSERT INTO `punbb_config` VALUES ('o_default_lang','English');
INSERT INTO `punbb_config` VALUES ('o_default_style','Oxygen');
INSERT INTO `punbb_config` VALUES ('o_default_user_group','4');
INSERT INTO `punbb_config` VALUES ('o_topic_review','15');
INSERT INTO `punbb_config` VALUES ('o_disp_topics_default','30');
INSERT INTO `punbb_config` VALUES ('o_disp_posts_default','25');
INSERT INTO `punbb_config` VALUES ('o_indent_num_spaces','4');
INSERT INTO `punbb_config` VALUES ('o_quickpost','1');
INSERT INTO `punbb_config` VALUES ('o_users_online','1');
INSERT INTO `punbb_config` VALUES ('o_censoring','0');
INSERT INTO `punbb_config` VALUES ('o_ranks','1');
INSERT INTO `punbb_config` VALUES ('o_show_dot','0');
INSERT INTO `punbb_config` VALUES ('o_quickjump','1');
INSERT INTO `punbb_config` VALUES ('o_gzip','0');
INSERT INTO `punbb_config` VALUES ('o_additional_navlinks','');
INSERT INTO `punbb_config` VALUES ('o_report_method','0');
INSERT INTO `punbb_config` VALUES ('o_regs_report','0');
INSERT INTO `punbb_config` VALUES ('o_mailing_list','alexis@cecsmo.net');
INSERT INTO `punbb_config` VALUES ('o_avatars','1');
INSERT INTO `punbb_config` VALUES ('o_avatars_dir','img/avatars');
INSERT INTO `punbb_config` VALUES ('o_avatars_width','60');
INSERT INTO `punbb_config` VALUES ('o_avatars_height','60');
INSERT INTO `punbb_config` VALUES ('o_avatars_size','10240');
INSERT INTO `punbb_config` VALUES ('o_search_all_forums','1');
INSERT INTO `punbb_config` VALUES ('o_base_url','http://www.cecsmo.net/forum');
INSERT INTO `punbb_config` VALUES ('o_admin_email','alexis@cecsmo.net');
INSERT INTO `punbb_config` VALUES ('o_webmaster_email','alexis@cecsmo.net');
INSERT INTO `punbb_config` VALUES ('o_subscriptions','1');
INSERT INTO `punbb_config` VALUES ('o_smtp_host',NULL);
INSERT INTO `punbb_config` VALUES ('o_smtp_user',NULL);
INSERT INTO `punbb_config` VALUES ('o_smtp_pass',NULL);
INSERT INTO `punbb_config` VALUES ('o_regs_allow','1');
INSERT INTO `punbb_config` VALUES ('o_regs_verify','0');
INSERT INTO `punbb_config` VALUES ('o_announcement','0');
INSERT INTO `punbb_config` VALUES ('o_announcement_message','Enter your announcement here.');
INSERT INTO `punbb_config` VALUES ('o_rules','0');
INSERT INTO `punbb_config` VALUES ('o_rules_message','Enter your rules here.');
INSERT INTO `punbb_config` VALUES ('o_maintenance','0');
INSERT INTO `punbb_config` VALUES ('o_maintenance_message','The forums are temporarily down for maintenance. Please try again in a few minutes.<br />\n<br />\n/Administrator');
INSERT INTO `punbb_config` VALUES ('p_mod_edit_users','1');
INSERT INTO `punbb_config` VALUES ('p_mod_rename_users','0');
INSERT INTO `punbb_config` VALUES ('p_mod_change_passwords','0');
INSERT INTO `punbb_config` VALUES ('p_mod_ban_users','0');
INSERT INTO `punbb_config` VALUES ('p_message_bbcode','1');
INSERT INTO `punbb_config` VALUES ('p_message_img_tag','1');
INSERT INTO `punbb_config` VALUES ('p_message_all_caps','1');
INSERT INTO `punbb_config` VALUES ('p_subject_all_caps','1');
INSERT INTO `punbb_config` VALUES ('p_sig_all_caps','1');
INSERT INTO `punbb_config` VALUES ('p_sig_bbcode','1');
INSERT INTO `punbb_config` VALUES ('p_sig_img_tag','0');
INSERT INTO `punbb_config` VALUES ('p_sig_length','400');
INSERT INTO `punbb_config` VALUES ('p_sig_lines','4');
INSERT INTO `punbb_config` VALUES ('p_allow_banned_email','1');
INSERT INTO `punbb_config` VALUES ('p_allow_dupe_email','0');
INSERT INTO `punbb_config` VALUES ('p_force_guest_email','1');
/*!40000 ALTER TABLE `punbb_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `punbb_forum_perms`
--

DROP TABLE IF EXISTS `punbb_forum_perms`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `punbb_forum_perms` (
  `group_id` int(10) NOT NULL default '0',
  `forum_id` int(10) NOT NULL default '0',
  `read_forum` tinyint(1) NOT NULL default '1',
  `post_replies` tinyint(1) NOT NULL default '1',
  `post_topics` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`group_id`,`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `punbb_forum_perms`
--

LOCK TABLES `punbb_forum_perms` WRITE;
/*!40000 ALTER TABLE `punbb_forum_perms` DISABLE KEYS */;
/*!40000 ALTER TABLE `punbb_forum_perms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `punbb_forums`
--

DROP TABLE IF EXISTS `punbb_forums`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `punbb_forums` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `forum_name` varchar(80) NOT NULL default 'New forum',
  `forum_desc` text,
  `redirect_url` varchar(100) default NULL,
  `moderators` text,
  `num_topics` mediumint(8) unsigned NOT NULL default '0',
  `num_posts` mediumint(8) unsigned NOT NULL default '0',
  `last_post` int(10) unsigned default NULL,
  `last_post_id` int(10) unsigned default NULL,
  `last_poster` varchar(200) default NULL,
  `sort_by` tinyint(1) NOT NULL default '0',
  `disp_position` int(10) NOT NULL default '0',
  `cat_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `punbb_forums`
--

LOCK TABLES `punbb_forums` WRITE;
/*!40000 ALTER TABLE `punbb_forums` DISABLE KEYS */;
INSERT INTO `punbb_forums` VALUES (1,'Test forum','This is just a test forum',NULL,NULL,1,1,1216761424,1,'alexlop',0,1,1);
/*!40000 ALTER TABLE `punbb_forums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `punbb_groups`
--

DROP TABLE IF EXISTS `punbb_groups`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `punbb_groups` (
  `g_id` int(10) unsigned NOT NULL auto_increment,
  `g_title` varchar(50) NOT NULL default '',
  `g_user_title` varchar(50) default NULL,
  `g_read_board` tinyint(1) NOT NULL default '1',
  `g_post_replies` tinyint(1) NOT NULL default '1',
  `g_post_topics` tinyint(1) NOT NULL default '1',
  `g_post_polls` tinyint(1) NOT NULL default '1',
  `g_edit_posts` tinyint(1) NOT NULL default '1',
  `g_delete_posts` tinyint(1) NOT NULL default '1',
  `g_delete_topics` tinyint(1) NOT NULL default '1',
  `g_set_title` tinyint(1) NOT NULL default '1',
  `g_search` tinyint(1) NOT NULL default '1',
  `g_search_users` tinyint(1) NOT NULL default '1',
  `g_edit_subjects_interval` smallint(6) NOT NULL default '300',
  `g_post_flood` smallint(6) NOT NULL default '30',
  `g_search_flood` smallint(6) NOT NULL default '30',
  PRIMARY KEY  (`g_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `punbb_groups`
--

LOCK TABLES `punbb_groups` WRITE;
/*!40000 ALTER TABLE `punbb_groups` DISABLE KEYS */;
INSERT INTO `punbb_groups` VALUES (1,'Administrators','Administrator',1,1,1,1,1,1,1,1,1,1,0,0,0);
INSERT INTO `punbb_groups` VALUES (2,'Moderators','Moderator',1,1,1,1,1,1,1,1,1,1,0,0,0);
INSERT INTO `punbb_groups` VALUES (3,'Guest',NULL,1,0,0,0,0,0,0,0,1,1,0,0,0);
INSERT INTO `punbb_groups` VALUES (4,'Members',NULL,1,1,1,1,1,1,1,0,1,1,300,60,30);
/*!40000 ALTER TABLE `punbb_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `punbb_online`
--

DROP TABLE IF EXISTS `punbb_online`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `punbb_online` (
  `user_id` int(10) unsigned NOT NULL default '1',
  `ident` varchar(200) NOT NULL default '',
  `logged` int(10) unsigned NOT NULL default '0',
  `idle` tinyint(1) NOT NULL default '0',
  UNIQUE KEY `punbb_online_user_id_ident_idx` (`user_id`,`ident`),
  KEY `punbb_online_user_id_idx` (`user_id`)
) ENGINE=MEMORY DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `punbb_online`
--

LOCK TABLES `punbb_online` WRITE;
/*!40000 ALTER TABLE `punbb_online` DISABLE KEYS */;
/*!40000 ALTER TABLE `punbb_online` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `punbb_posts`
--

DROP TABLE IF EXISTS `punbb_posts`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `punbb_posts` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `poster` varchar(200) NOT NULL default '',
  `poster_id` int(10) unsigned NOT NULL default '1',
  `poster_ip` varchar(15) default NULL,
  `poster_email` varchar(50) default NULL,
  `message` text,
  `hide_smilies` tinyint(1) NOT NULL default '0',
  `posted` int(10) unsigned NOT NULL default '0',
  `edited` int(10) unsigned default NULL,
  `edited_by` varchar(200) default NULL,
  `topic_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `punbb_posts_topic_id_idx` (`topic_id`),
  KEY `punbb_posts_multi_idx` (`poster_id`,`topic_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `punbb_posts`
--

LOCK TABLES `punbb_posts` WRITE;
/*!40000 ALTER TABLE `punbb_posts` DISABLE KEYS */;
INSERT INTO `punbb_posts` VALUES (1,'alexlop',2,'127.0.0.1',NULL,'If you are looking at this (which I guess you are), the install of PunBB appears to have worked! Now log in and head over to the administration control panel to configure your forum.',0,1216761424,NULL,NULL,1);
/*!40000 ALTER TABLE `punbb_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `punbb_ranks`
--

DROP TABLE IF EXISTS `punbb_ranks`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `punbb_ranks` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `rank` varchar(50) NOT NULL default '',
  `min_posts` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `punbb_ranks`
--

LOCK TABLES `punbb_ranks` WRITE;
/*!40000 ALTER TABLE `punbb_ranks` DISABLE KEYS */;
INSERT INTO `punbb_ranks` VALUES (1,'New member',0);
INSERT INTO `punbb_ranks` VALUES (2,'Member',10);
/*!40000 ALTER TABLE `punbb_ranks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `punbb_reports`
--

DROP TABLE IF EXISTS `punbb_reports`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `punbb_reports` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `post_id` int(10) unsigned NOT NULL default '0',
  `topic_id` int(10) unsigned NOT NULL default '0',
  `forum_id` int(10) unsigned NOT NULL default '0',
  `reported_by` int(10) unsigned NOT NULL default '0',
  `created` int(10) unsigned NOT NULL default '0',
  `message` text,
  `zapped` int(10) unsigned default NULL,
  `zapped_by` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`),
  KEY `punbb_reports_zapped_idx` (`zapped`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `punbb_reports`
--

LOCK TABLES `punbb_reports` WRITE;
/*!40000 ALTER TABLE `punbb_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `punbb_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `punbb_search_cache`
--

DROP TABLE IF EXISTS `punbb_search_cache`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `punbb_search_cache` (
  `id` int(10) unsigned NOT NULL default '0',
  `ident` varchar(200) NOT NULL default '',
  `search_data` text,
  PRIMARY KEY  (`id`),
  KEY `punbb_search_cache_ident_idx` (`ident`(8))
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `punbb_search_cache`
--

LOCK TABLES `punbb_search_cache` WRITE;
/*!40000 ALTER TABLE `punbb_search_cache` DISABLE KEYS */;
INSERT INTO `punbb_search_cache` VALUES (295323292,'clemfrind','a:5:{s:14:\"search_results\";s:1:\"1\";s:8:\"num_hits\";i:1;s:7:\"sort_by\";i:4;s:8:\"sort_dir\";s:4:\"DESC\";s:7:\"show_as\";s:6:\"topics\";}');
/*!40000 ALTER TABLE `punbb_search_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `punbb_search_matches`
--

DROP TABLE IF EXISTS `punbb_search_matches`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `punbb_search_matches` (
  `post_id` int(10) unsigned NOT NULL default '0',
  `word_id` mediumint(8) unsigned NOT NULL default '0',
  `subject_match` tinyint(1) NOT NULL default '0',
  KEY `punbb_search_matches_word_id_idx` (`word_id`),
  KEY `punbb_search_matches_post_id_idx` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `punbb_search_matches`
--

LOCK TABLES `punbb_search_matches` WRITE;
/*!40000 ALTER TABLE `punbb_search_matches` DISABLE KEYS */;
/*!40000 ALTER TABLE `punbb_search_matches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `punbb_search_words`
--

DROP TABLE IF EXISTS `punbb_search_words`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `punbb_search_words` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `word` varchar(20) character set latin1 collate latin1_bin NOT NULL default '',
  PRIMARY KEY  (`word`),
  KEY `punbb_search_words_id_idx` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `punbb_search_words`
--

LOCK TABLES `punbb_search_words` WRITE;
/*!40000 ALTER TABLE `punbb_search_words` DISABLE KEYS */;
/*!40000 ALTER TABLE `punbb_search_words` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `punbb_subscriptions`
--

DROP TABLE IF EXISTS `punbb_subscriptions`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `punbb_subscriptions` (
  `user_id` int(10) unsigned NOT NULL default '0',
  `topic_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`user_id`,`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `punbb_subscriptions`
--

LOCK TABLES `punbb_subscriptions` WRITE;
/*!40000 ALTER TABLE `punbb_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `punbb_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `punbb_topics`
--

DROP TABLE IF EXISTS `punbb_topics`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `punbb_topics` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `poster` varchar(200) NOT NULL default '',
  `subject` varchar(255) NOT NULL default '',
  `posted` int(10) unsigned NOT NULL default '0',
  `last_post` int(10) unsigned NOT NULL default '0',
  `last_post_id` int(10) unsigned NOT NULL default '0',
  `last_poster` varchar(200) default NULL,
  `num_views` mediumint(8) unsigned NOT NULL default '0',
  `num_replies` mediumint(8) unsigned NOT NULL default '0',
  `closed` tinyint(1) NOT NULL default '0',
  `sticky` tinyint(1) NOT NULL default '0',
  `moved_to` int(10) unsigned default NULL,
  `forum_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `punbb_topics_forum_id_idx` (`forum_id`),
  KEY `punbb_topics_moved_to_idx` (`moved_to`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `punbb_topics`
--

LOCK TABLES `punbb_topics` WRITE;
/*!40000 ALTER TABLE `punbb_topics` DISABLE KEYS */;
INSERT INTO `punbb_topics` VALUES (1,'alexlop','Test post',1216761424,1216761424,1,'alexlop',7,0,0,0,NULL,1);
/*!40000 ALTER TABLE `punbb_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `punbb_users`
--

DROP TABLE IF EXISTS `punbb_users`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `punbb_users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `group_id` int(10) unsigned NOT NULL default '4',
  `username` varchar(200) NOT NULL default '',
  `password` varchar(40) NOT NULL default '',
  `email` varchar(50) NOT NULL default '',
  `title` varchar(50) default NULL,
  `realname` varchar(40) default NULL,
  `url` varchar(100) default NULL,
  `jabber` varchar(75) default NULL,
  `icq` varchar(12) default NULL,
  `msn` varchar(50) default NULL,
  `aim` varchar(30) default NULL,
  `yahoo` varchar(30) default NULL,
  `location` varchar(30) default NULL,
  `use_avatar` tinyint(1) NOT NULL default '0',
  `signature` text,
  `disp_topics` tinyint(3) unsigned default NULL,
  `disp_posts` tinyint(3) unsigned default NULL,
  `email_setting` tinyint(1) NOT NULL default '1',
  `save_pass` tinyint(1) NOT NULL default '1',
  `notify_with_post` tinyint(1) NOT NULL default '0',
  `show_smilies` tinyint(1) NOT NULL default '1',
  `show_img` tinyint(1) NOT NULL default '1',
  `show_img_sig` tinyint(1) NOT NULL default '1',
  `show_avatars` tinyint(1) NOT NULL default '1',
  `show_sig` tinyint(1) NOT NULL default '1',
  `timezone` float NOT NULL default '0',
  `language` varchar(25) NOT NULL default 'English',
  `style` varchar(25) NOT NULL default 'Oxygen',
  `num_posts` int(10) unsigned NOT NULL default '0',
  `last_post` int(10) unsigned default NULL,
  `registered` int(10) unsigned NOT NULL default '0',
  `registration_ip` varchar(15) NOT NULL default '0.0.0.0',
  `last_visit` int(10) unsigned NOT NULL default '0',
  `admin_note` varchar(30) default NULL,
  `activate_string` varchar(50) default NULL,
  `activate_key` varchar(8) default NULL,
  PRIMARY KEY  (`id`),
  KEY `punbb_users_registered_idx` (`registered`),
  KEY `punbb_users_username_idx` (`username`(8))
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `punbb_users`
--

LOCK TABLES `punbb_users` WRITE;
/*!40000 ALTER TABLE `punbb_users` DISABLE KEYS */;
INSERT INTO `punbb_users` VALUES (1,3,'Guest','Guest','Guest',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,0,'0.0.0.0',0,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (2,1,'alexlop','abfd6d5a2b45786fd8db69f172408cb615f1ea4d','alexis@cecsmo.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',1,1216761424,1216761424,'127.0.0.1',1219775728,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (110,4,'ht03707','50ed1fc211d85bd4d2e91aa03232f684b3696041','maudski3@hotmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1237626191,'81.57.166.156',1237626191,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (109,4,'lavishu','d65bbe6f4a5359044b88cdcefc78119170d2906a','lavignasse.julie@hotmail.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1237472935,'83.202.133.21',1237472935,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (108,4,'tribu','551a21b340b2f249e2f0a0ea969bc1d38896a3e0','kneipbas@hotmail.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1237279002,'91.165.245.245',1237279002,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (107,4,'frederiquemichel','94262ac87c48a3a33bb140a17bf8f9b7d875deaf','frederique.michel@hotmail.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1234218113,'88.164.135.162',1234218113,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (105,4,'ramtin','bc2835cde113bd39dd34460487e8aa671b8c7695','y.vinogradova@yahoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1233865445,'86.69.68.103',1233865445,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (106,4,'maily','2f3fd9d4ea2c3f93d6aba6010d6ec47c825dd6e0','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1234185999,'81.64.102.203',1234185999,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (104,4,'kouekoue','899042fb84508108a02c454fee619b75643fff43','gaetan.paulme@yahoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1233829446,'81.64.212.107',1233829446,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (103,4,'bruno','7110eda4d09e062aa5e4a390b0a572ac0d2c0220','brunofelpeto@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1233610010,'77.195.248.5',1233610010,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (102,4,'ALINA','f1a47c9fe3183e9e3ec2f554743e2e9095a03de8','alina_grimberg@hotmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1232390804,'82.66.52.77',1232390804,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (101,4,'fabio','bc4d6c093d14cf794f0c740071d0d419420c046c','depardieufab@hotmail.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1231766115,'164.2.255.244',1231766115,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (99,4,'thomasdurand','3f1799357f982a78e65bb5294a0261290dcb89dc','thomasdurandfac@yahoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1217682680,'89.2.24.24',1217682680,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (100,4,'mgalievsky','1985506f409af8a92b143a8b2eb2df43afdd9f72','mgalievsky@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1222952067,'164.2.255.244',1222952067,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (97,4,'login','8f4f9f2dcbaf9bd8ee9e4d1a2cb971a04084157b','axelle.vassal@wanadoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1213819458,'127.0.0.1',1213819458,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (98,4,'guy','4ef673abbf46400ff2e0e92de258ddf5cabdebdd','gumanpi@hotmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1215194967,'127.0.0.1',1215194967,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (96,4,'kourouni','d8b8eb386c4f6b5f7126e42e352b19c3a3e437bf','kourounitara@yahoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1213782886,'127.0.0.1',1213782886,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (95,4,'suzel','8716254880101d372f24828e590aee83812cc1c2','uzelseverine@yahoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1213714802,'127.0.0.1',1213714802,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (94,4,'1424','b9add70531519c256186579d20bc7cec509b4bd3','guikaempf@free.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1213713879,'127.0.0.1',1213713879,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (92,4,'duboisclaire','bd234ba4276433f0e5fc7a8fa2d18274fa711567','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1213709208,'127.0.0.1',1213709208,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (93,4,'lolita','dc1af77d2e5ce67bbc5547b1bb56771c0b952c77','thomas.werli@wanadoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1213712160,'127.0.0.1',1213712160,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (91,4,'olivier.sergent','2d1e2f26e167bdff2f182178740417c56420c415','olivier.sergent@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1213701866,'127.0.0.1',1213701866,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (90,4,'rochon.emilie','660609b171607ff3dcd294929e5d8239736f4298','rochon.emilie@wanadoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1213694559,'127.0.0.1',1213694559,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (89,4,'olivgeorge','6d00a48c2858d091a984f67d19c5ba6aa7fc184a','olivgeorge@yahoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1213641928,'127.0.0.1',1213641928,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (87,4,'cleliaheck','43dbfcdc839c8f994cb128aec846e4db617b0fb4','cleliaheck@aol.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1213629015,'127.0.0.1',1213629015,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (86,4,'athe','5ed25af7b1ed23fb00122e13d7f74c4d8262acd8','athenais.charbonnier@wanadoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1213613991,'127.0.0.1',1213613991,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (84,4,'titounie','7835de40302e3911feebb309e54d1d607c343cc7','claudineschwartz@free.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1213603516,'127.0.0.1',1213603516,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (85,4,'justine.tronet','e9d6da3056775d3c958f6e949b015041f8b0e8ad','justine.tronet@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1213608764,'127.0.0.1',1213608764,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (83,4,'0','178f71645d8d762522ede90115f4f50f1e19d62b','claire.saumen@hotmail.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1213601345,'127.0.0.1',1213601345,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (82,4,'THOMAS 06','c09252328b51e5c53fc43f88660a81e05d85a13d','cedrik.lafond@free.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1213597681,'127.0.0.1',1213597681,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (81,4,'helpral','1985a9657f877380174af9ba17407b0e941d72b1','helpral@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1213565402,'127.0.0.1',1213565402,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (80,4,'morgane.bravetti','fa109ad9cb2b072e4b5a6268e8a5033f4fead6d0','morgane.bravetti@wanadoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1213538934,'127.0.0.1',1213538934,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (79,4,'tdevisse','e19a7688c51f39c30b50eb9ce0cff1d2bf92c9c0','thom.devisse@wanadoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1213530362,'127.0.0.1',1213530362,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (77,4,'j.t','45eeb2db9912b3d512fcf65ba7b189317d0504ad','tahiri.j@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1211743665,'127.0.0.1',1211743665,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (78,4,'Carbu','cdb5acda31d9899ef55ffb90dc17bd61119601c0','yannlecarboulec@yahoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1212935055,'127.0.0.1',1212935055,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (76,4,'geraldine','35f27bffd5b7f7a60ff785405010515f16c2802f','dubos.sand@wanadoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1210199989,'127.0.0.1',1210199989,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (75,4,'bouille','94262ac87c48a3a33bb140a17bf8f9b7d875deaf','adannoux@caramail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1210185662,'127.0.0.1',1210185662,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (74,4,'clemfrind','84b2a669f63bd9cf2c8fa283281a4b330b4d7a50','doc.cfrindel@orange.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1210142848,'127.0.0.1',1219400586,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (73,4,'cchabre','e426a00251f8bef9bdac42fb4e3933009212239d','cl.chabre@free.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1209115014,'127.0.0.1',1209115014,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (72,4,'narimane','452c3c4bde39794851b4a7ef8135a7ed58509f3a','narimane31@yahoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1209074100,'127.0.0.1',1209074100,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (70,4,'barthelet','77bce9fb18f977ea576bbcd143b2b521073f0cd6','rbarthelet@hotmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1208952594,'127.0.0.1',1208952594,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (71,4,'viviane','1b4b2926a829d1216e1b1613d75f27f74a9d5bd0','viviane.barthelemy@free.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1208952652,'127.0.0.1',1208952652,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (69,4,'Xcontrol','9dffcd4970fa6c9d13405485c6eabd81b768d6d6','bertrandzz@free.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1208951946,'127.0.0.1',1208951946,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (68,4,'sergio79','e7e94b97dc4d1f0599f5637ea05e530bc45f6a2d','dahansergio@yahoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1208892344,'127.0.0.1',1208892344,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (67,4,'thomas','02e0a999c50b1f88df7a8f5a04e1b76b35ea6a88','dr.thomas@paris.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1208876451,'127.0.0.1',1208876451,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (66,4,'mila','55172926eb9e5a0db8a97565cdf485de88d6035a','chavescamila@msn.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1208438523,'127.0.0.1',1208438523,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (65,4,'annegaco','67f6800be2c2046e3fa7fb40ead83e69510e101f','annegaco@yahoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1208291869,'127.0.0.1',1208291869,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (63,4,'william','f434eafc749ea931c11bd709159f5e982bb44aaa','william.haussmann@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1205406513,'127.0.0.1',1205406513,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (64,4,'sabrina','30c9e2782e9f0c59a0da2da8666a32f545d05121','sabrinagarsani@wanadoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1207293540,'127.0.0.1',1207293540,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (62,4,'virginie','cad5822ea1a20da07d2492f9b30e40b3b9104804','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1205406391,'127.0.0.1',1205406391,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (61,4,'klrobscure','00a440613b4746c96571c3cd190cf26885efd800','klrobscure@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1205406309,'127.0.0.1',1205406309,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (60,4,'mali','9426e2eba89cc33f00c5e7c3040255d65b1588e9','dr.benahmedm@wanadoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1205247847,'127.0.0.1',1205247847,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (59,4,'hachounette','881f210412d7d1e6d182bd5a0efaaceeae92677d','elmoumih@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1205219374,'127.0.0.1',1205219374,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (57,4,'decker','4dec61504b277e9ef242192b957aa1747b845085','alain.decker@univ-paris5.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1201596667,'127.0.0.1',1201596667,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (58,4,'Emilie','8ccfb8d7e20ea9bb7aa76c9f39f1cc2b9612f716','emiliehuguet@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1202058628,'127.0.0.1',1202058628,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (56,4,'dana','1cb970812cb29b59faf5b8a36713647f0e484d61','audrey.belat@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1201528333,'127.0.0.1',1201528333,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (55,4,'250580','ea379b249c3114f9c6f1d342197cd867a33fcf92','jessisoussan@yahoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1201017888,'127.0.0.1',1201017888,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (54,4,'romain','c652000d169c4c46d469ba0962808b40d7b2c4c7','romaindepape@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1200861118,'127.0.0.1',1200861118,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (53,4,'sololibera','536e5b0c65f11ce598c100ddd56c4f74b8ca6ac5','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1200850109,'127.0.0.1',1200850109,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (51,4,'laetiadda','9cf95dacd226dcf43da376cdb6cbba7035218921','laetiadda@hotmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1200506211,'127.0.0.1',1200506211,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (52,4,'dorotheelarcher','811adc18e52508c3424c1d8890a73b1b5c4895c9','dorotheelarcher@hotmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1200570644,'127.0.0.1',1200570644,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (50,4,'sabine','c98d8c2eca65c2a13dfc53f696a8f0308addda96','sabine.boucherit@hotmail.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1200441237,'127.0.0.1',1200441237,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (49,4,'frezbull','2667f85c2b849acbab5f0ea5a0d9aa74ae1a245c','frezbull@yahoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1200431807,'127.0.0.1',1200431807,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (48,4,'sophia','c7d4a630661cd719ea504dba56393f78278b296b','lucky13fr@yahoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1200405677,'127.0.0.1',1200405677,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (47,4,'gib','718079499d8da6174543d64b0ef70066be72ce5b','claire.gibassier@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1200266353,'127.0.0.1',1200266353,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (45,4,'nani','21ff0c98f5fd5754371c16c4cc6ac33571e2735c','nanibrand@hotmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1200261341,'127.0.0.1',1200261341,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (46,4,'bichhovotuan','333ca0668fc52730826f47e992728b3097765d44','bichhovotuan@yahoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1200264602,'127.0.0.1',1200264602,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (44,4,'zilana','b8060e288ece2cd442ec236107237cdf47c90932','ilanaohana@hotmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1200257619,'127.0.0.1',1200257619,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (43,4,'popomobile','c1171b861ca43d8e643829639d66134c9a60491e','plaget@hotmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1178007574,'127.0.0.1',1178007574,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (42,4,'emmanuelle','909b5770b9dda526735f13fb0d0910764339103e','emmanuelle_rioux@hotmail.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1177694126,'127.0.0.1',1177694126,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (41,4,'dodo','42ef63e7836ef622d9185c1a456051edf16095cc','dorotheemougin@caramail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1176928763,'127.0.0.1',1176928763,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (39,4,'sc.micheau','3b2de0191e19ea26d86ff698464e33561f620d3e','sc.micheau@free.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1175107364,'127.0.0.1',1175107364,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (40,4,'joumana','1405df66cbe219b0bf6355bc3d60361a8376b6b4','joumana.seif@free.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1175290168,'127.0.0.1',1175290168,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (38,4,'caroline','2e8a0dcb9ad1493fbbf7b036bb44a11d05b3d486','caroline.boussard@hotmail.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1173297086,'127.0.0.1',1173297086,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (37,4,'rose','e3cd2a16129127c78f9ca68574abf61e1c16277b','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1173031575,'127.0.0.1',1173031575,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (36,4,'billetmarion','579ac4127f94a60f0983f442b9dd46357be92ef2','billetmarion@hotmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1172943476,'127.0.0.1',1172943476,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (26,4,'SOIRON','0599505c36750667b2275a4f768bf2b2948e46aa','desfraisesetdesabricots@wanadoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1172841419,'127.0.0.1',1172841419,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (25,4,'cecsmo','66599a2292f7a24908b3da3c3dcf4337dba1b887','stephanie.bouju@voila.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1172785835,'127.0.0.1',1216768629,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (24,4,'fabdentiste','2677b9c89c247defac674ff002c68fb209afe762','fabdentiste@yahoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1172770190,'127.0.0.1',1172770190,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (3,4,'laurent','f1b010126f61b5c59e7d5eb42c5c68f6105c5914','laurentbenamran@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1172103863,'127.0.0.1',1172103863,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (9,4,'Lionel','415caab35a75f8c239bd5d8a7124db951b9b3bf9','lionelbenainous@hotmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1172414389,'127.0.0.1',1172414389,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (111,4,'hi04899','adfeb7e51ce242cfada35c8b278c38d583bb19bd','sophieguedjdavid@yahoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1237733861,'82.229.142.128',1237733861,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (112,4,'hu02215','f7e8a5b8c8b5b3a3f8a6ffcddc8f7e4b33bf4db6','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1237979835,'86.65.184.182',1237979835,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (113,4,'lassaad','1e69e3b41dbd3c91fc3284638c3073ebe606bae1','lassaad.bh@hotmail.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1238711794,'88.185.120.122',1238711794,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (114,4,'melortho','21ff0c98f5fd5754371c16c4cc6ac33571e2735c','nanibrand@hotmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1238940054,'82.230.131.143',1238940054,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (115,4,'florencepham','a5752f3d9b2365ee9a8a2efad28743396371b13f','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1239030882,'193.253.230.165',1239030882,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (116,4,'dentiste','70eb3637975444afef8e79db5538bd8529d2f466','s.flitti@free.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1243573665,'83.202.7.101',1243573665,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (117,4,'yael','17a2cbc4e33156874a9862b0f530521117e66a3d','yael.orjekh@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1244451298,'88.188.105.157',1244451298,NULL,NULL,NULL);
INSERT INTO `punbb_users` VALUES (118,4,'clairehelene','94262ac87c48a3a33bb140a17bf8f9b7d875deaf','clairehelene32@hotmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,1,0,1,1,1,1,1,0,'French','alexis',0,NULL,1248101292,'164.2.255.244',1248101292,NULL,NULL,NULL);
/*!40000 ALTER TABLE `punbb_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `titre`
--

DROP TABLE IF EXISTS `titre`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `titre` (
  `id_titre` int(10) NOT NULL auto_increment,
  `titre` varchar(255) NOT NULL,
  `classement` int(10) NOT NULL,
  PRIMARY KEY  (`id_titre`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `titre`
--

LOCK TABLES `titre` WRITE;
/*!40000 ALTER TABLE `titre` DISABLE KEYS */;
INSERT INTO `titre` VALUES (1,'accessoire MB',1);
INSERT INTO `titre` VALUES (2,'ARC',2);
INSERT INTO `titre` VALUES (4,'Collage',0);
INSERT INTO `titre` VALUES (5,'Elastique et Forsus',0);
INSERT INTO `titre` VALUES (6,'Fonctionnel et Feo',0);
INSERT INTO `titre` VALUES (7,'Hygiène et Stérilisation',0);
INSERT INTO `titre` VALUES (8,'Laboratoire',0);
/*!40000 ALTER TABLE `titre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `urg_bk`
--

DROP TABLE IF EXISTS `urg_bk`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `urg_bk` (
  `id_bk` int(10) NOT NULL auto_increment,
  `bk` varchar(255) NOT NULL,
  PRIMARY KEY  (`id_bk`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `urg_bk`
--

LOCK TABLES `urg_bk` WRITE;
/*!40000 ALTER TABLE `urg_bk` DISABLE KEYS */;
INSERT INTO `urg_bk` VALUES (1,'clarity SL');
INSERT INTO `urg_bk` VALUES (2,'Damon');
INSERT INTO `urg_bk` VALUES (3,'victory');
INSERT INTO `urg_bk` VALUES (4,'bague');
INSERT INTO `urg_bk` VALUES (5,'clarity');
INSERT INTO `urg_bk` VALUES (6,'GAC ceram');
INSERT INTO `urg_bk` VALUES (7,'Ice');
/*!40000 ALTER TABLE `urg_bk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `urg_list`
--

DROP TABLE IF EXISTS `urg_list`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `urg_list` (
  `id_list` int(10) NOT NULL auto_increment,
  `date` date NOT NULL,
  `num_dossier` varchar(255) NOT NULL,
  `type` int(10) NOT NULL,
  `dent` varchar(255) NOT NULL,
  `bk` varchar(255) NOT NULL,
  `cause` text NOT NULL,
  `fracture` varchar(255) NOT NULL,
  `praticien` varchar(255) NOT NULL,
  `acte` varchar(255) NOT NULL,
  PRIMARY KEY  (`id_list`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `urg_list`
--

LOCK TABLES `urg_list` WRITE;
/*!40000 ALTER TABLE `urg_list` DISABLE KEYS */;
INSERT INTO `urg_list` VALUES (1,'2009-03-24','010203',3,'22','3','sandwich','cohesive','alexis','recollage');
INSERT INTO `urg_list` VALUES (2,'2009-04-01','123',1,'15','3','sandwich','cohesive','alexis','recollage');
INSERT INTO `urg_list` VALUES (3,'2009-04-01','',0,'','','','','','');
INSERT INTO `urg_list` VALUES (4,'2009-04-01','123',1,'15','3','sandwich','cohesive','alexis','recollage');
INSERT INTO `urg_list` VALUES (5,'2009-04-01','123',1,'15','3','sandwich','cohesive','alexis','recollage');
INSERT INTO `urg_list` VALUES (6,'2009-04-01','123',5,'','','','','olivier','coupe');
INSERT INTO `urg_list` VALUES (7,'2009-04-01','10804',1,'26','2','manger','','alyae','baguage');
INSERT INTO `urg_list` VALUES (8,'2009-04-01','12553',1,'25','3','repas','cohesive','alexis','recollage');
INSERT INTO `urg_list` VALUES (9,'2009-04-01','9045',1,'26','2','repas','cohesive','olivier','coupe');
INSERT INTO `urg_list` VALUES (10,'2009-04-01','11214',1,'45','2','repas','adhesivebk','olivier','recollage');
INSERT INTO `urg_list` VALUES (11,'2009-04-03','11348',1,'46','3','repas','','catherine','baguer');
INSERT INTO `urg_list` VALUES (12,'2009-04-03','12353',1,'13','2','pomme','cohesive','alexis','recollage');
INSERT INTO `urg_list` VALUES (13,'2009-04-03','11803',5,'','','','','catherine','meuler  ');
INSERT INTO `urg_list` VALUES (14,'2009-04-04','12956',7,'','','','','olivier','');
INSERT INTO `urg_list` VALUES (15,'2009-04-04','12898',1,'45','2','repas','cohesive','alexis','recollage');
INSERT INTO `urg_list` VALUES (16,'2009-04-04','8710',1,'16','2','repas','cohesive','olivier','recollage new');
INSERT INTO `urg_list` VALUES (17,'2009-04-04','7467',1,'16','2','sans raison','adhesivedent','alyae','bague 16');
INSERT INTO `urg_list` VALUES (18,'2009-04-04','12300',2,'16','4','','','olivier','rescellement');
INSERT INTO `urg_list` VALUES (19,'2009-04-04','12300',2,'26','4','','','olivier','rescellement');
INSERT INTO `urg_list` VALUES (20,'2009-04-08','8623',5,'','','','','alexis','new arc');
INSERT INTO `urg_list` VALUES (21,'2009-04-08','13149',1,'26','2','','cohesive','olivier','recollage new');
INSERT INTO `urg_list` VALUES (22,'2009-04-10','12466',1,'16','2','inconnue','adhesivedent','olivier','recollage new 16');
INSERT INTO `urg_list` VALUES (23,'2009-04-10','9116',3,'','','','','alyae','retouche gout');
INSERT INTO `urg_list` VALUES (24,'2009-04-10','9922',1,'22','1','manger','cohesive','olivier','recollage new');
INSERT INTO `urg_list` VALUES (25,'2009-04-21','11673',1,'22','1','','adhesivebk','olivier','recollage new');
INSERT INTO `urg_list` VALUES (26,'2009-04-21','10732',1,'26','2','bruxisme nuit','','olivier','baguage 26');
INSERT INTO `urg_list` VALUES (27,'2009-04-25','12367',1,'16','2','repas','adhesivedent','olivier','recollage new');
INSERT INTO `urg_list` VALUES (28,'2009-04-25','13291',1,'35','2','','adhesivedent','alexis','recollage');
INSERT INTO `urg_list` VALUES (29,'2009-04-29','9833',1,'22','1','','adhesivebk','olivier','recollage new');
INSERT INTO `urg_list` VALUES (30,'2009-04-29','10393',6,'','','','','alyae','');
INSERT INTO `urg_list` VALUES (31,'2009-04-29','6959',6,'','','','','catherine','');
INSERT INTO `urg_list` VALUES (32,'2009-04-29','8660',6,'','','','','alexis','');
INSERT INTO `urg_list` VALUES (33,'2009-04-29','13365',1,'63','1','','adhesivebk','olivier','recollage new');
INSERT INTO `urg_list` VALUES (34,'2009-05-05','13351',1,'26','2','pain','cohesive','olivier','recoller même 26');
INSERT INTO `urg_list` VALUES (35,'2009-05-05','10681',5,'','','','','olivier','chgt arc');
INSERT INTO `urg_list` VALUES (36,'2009-05-06','11894',1,'11','3','choc','cohesive','catherine','recollage new');
INSERT INTO `urg_list` VALUES (37,'2009-05-06','11894',1,'21','3','choc','cohesive','catherine','recollage new');
INSERT INTO `urg_list` VALUES (38,'2009-05-06','10842',1,'13','4','repas','','catherine','recollage');
INSERT INTO `urg_list` VALUES (39,'2009-05-09','9367',1,'13','1','','adhesivebk','alexis','recollage new');
INSERT INTO `urg_list` VALUES (40,'2009-05-09','9367',1,'23','1','','adhesivebk','alexis','recollage new');
INSERT INTO `urg_list` VALUES (41,'2009-05-09','10267',1,'41','2','repas','','olivier','recollage');
INSERT INTO `urg_list` VALUES (42,'2009-05-13','9169',1,'11','1','repas','adhesivebk','alexis','recollage new');
INSERT INTO `urg_list` VALUES (43,'2009-05-16','12353',1,'21','6','','adhesivebk','olivier','recollage');
INSERT INTO `urg_list` VALUES (44,'2009-05-20','10358',1,'11','2','choc','cohesive','alexis','recollage');
INSERT INTO `urg_list` VALUES (45,'2009-05-22','12877',1,'13','6','repas','adhesivebk','olivier','recollage');
INSERT INTO `urg_list` VALUES (46,'2009-05-22','13229',1,'17','2','repas','cohesive','olivier','recollage new');
INSERT INTO `urg_list` VALUES (47,'2009-06-03','13149',1,'36','2','','','olivier','recollage new');
INSERT INTO `urg_list` VALUES (48,'2009-06-10','4729',1,'16','2','repas','cohesive','catherine','recollage');
INSERT INTO `urg_list` VALUES (49,'2009-06-10','13557',1,'23','6','','adhesivebk','catherine','recollage');
INSERT INTO `urg_list` VALUES (50,'2009-06-24','6959',1,'26','2','repas','adhesivedent','catherine','recollage');
INSERT INTO `urg_list` VALUES (51,'2009-06-24','9887',1,'36','2','','adhesivedent','olivier','recollage new 36');
/*!40000 ALTER TABLE `urg_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `urg_type`
--

DROP TABLE IF EXISTS `urg_type`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `urg_type` (
  `id_type` int(10) NOT NULL auto_increment,
  `type` varchar(255) NOT NULL,
  UNIQUE KEY `id_type` (`id_type`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `urg_type`
--

LOCK TABLES `urg_type` WRITE;
/*!40000 ALTER TABLE `urg_type` DISABLE KEYS */;
INSERT INTO `urg_type` VALUES (1,'decollement');
INSERT INTO `urg_type` VALUES (2,'descellement');
INSERT INTO `urg_type` VALUES (3,'gouttiere casse');
INSERT INTO `urg_type` VALUES (4,'gouttiere perdu');
INSERT INTO `urg_type` VALUES (5,'fil qui depasse');
INSERT INTO `urg_type` VALUES (6,'fil sorti tube');
INSERT INTO `urg_type` VALUES (7,'plaque cassée');
INSERT INTO `urg_type` VALUES (8,'plaque perdue');
INSERT INTO `urg_type` VALUES (9,'plaque gêne');
INSERT INTO `urg_type` VALUES (10,'ligature metal cassé');
INSERT INTO `urg_type` VALUES (11,'ligature elasto');
INSERT INTO `urg_type` VALUES (12,'chainette perdue');
INSERT INTO `urg_type` VALUES (13,'chainette jaunie');
INSERT INTO `urg_type` VALUES (14,'fil de contention decollé');
INSERT INTO `urg_type` VALUES (15,'arc cassé');
/*!40000 ALTER TABLE `urg_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-09-16  7:42:07
