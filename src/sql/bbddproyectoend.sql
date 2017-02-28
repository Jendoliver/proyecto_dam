CREATE DATABASE  IF NOT EXISTS `proyecto` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `proyecto`;
-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: kato.epsevg.upc.es    Database: ohhhmusic3
-- ------------------------------------------------------
-- Server version	5.5.52-0+deb7u1-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciudad` (
  `idciudad` int(11) NOT NULL AUTO_INCREMENT,
  `nomciudad` varchar(60) NOT NULL,
  `provincia` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idciudad`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudad`
--

LOCK TABLES `ciudad` WRITE;
/*!40000 ALTER TABLE `ciudad` DISABLE KEYS */;
INSERT INTO `ciudad` VALUES (1,'Barcelona','Barcelona'),(2,'Badalona','Barcelona'),(3,'Cornella','Barcelona'),(4,'Tarragona','Tarragona'),(5,'LLeida','LLeida'),(6,'Tortosa','Tarragona'),(7,'Girona','Girona'),(8,'Castelldefels','Barcelona'),(9,'Salou','Tarragona'),(10,'Figueres','Girona');
/*!40000 ALTER TABLE `ciudad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `concierto`
--

DROP TABLE IF EXISTS `concierto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `concierto` (
  `idconcierto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `estado` char(1) NOT NULL,
  `dia` date NOT NULL,
  `hora` time NOT NULL,
  `pago` decimal(6,2) NOT NULL,
  `idlocal` int(11) NOT NULL,
  `genero` int(11) NOT NULL,
  PRIMARY KEY (`idconcierto`),
  KEY `fk_concierto_2_idx` (`genero`),
  KEY `fk_concierto_1_idx` (`idlocal`),
  CONSTRAINT `fk_concierto_1` FOREIGN KEY (`idlocal`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_concierto_2` FOREIGN KEY (`genero`) REFERENCES `genero` (`idgenero`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `concierto`
--

LOCK TABLES `concierto` WRITE;
/*!40000 ALTER TABLE `concierto` DISABLE KEYS */;
INSERT INTO `concierto` VALUES (2,'Viernes copas y mas','T','2017-01-27','12:00:00',240.00,5,6),(3,'Contigo somos mejores','C','2017-01-14','11:30:00',190.00,8,10),(5,'Fiesta 25 aniversario','T','2017-02-11','11:00:00',175.00,10,5),(6,'Carnaval 2017','T','2017-02-24','11:30:00',250.00,12,11),(7,'Festa mes animal amb Sant Antoni','O','2017-01-20','10:30:00',300.00,13,2),(8,'Fes la teva festa','O','2017-02-24','11:00:00',275.00,14,12),(9,'Sempre amb tu','T','2017-03-03','11:00:00',200.00,16,1),(10,'Fiesta de 18 ','O','2017-03-10','11:30:00',250.00,19,12),(11,'Sabados de sueños','O','2017-01-28','11:30:00',200.00,4,1);
/*!40000 ALTER TABLE `concierto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genero`
--

DROP TABLE IF EXISTS `genero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genero` (
  `idgenero` int(11) NOT NULL AUTO_INCREMENT,
  `nomestilo` varchar(45) NOT NULL,
  PRIMARY KEY (`idgenero`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genero`
--

LOCK TABLES `genero` WRITE;
/*!40000 ALTER TABLE `genero` DISABLE KEYS */;
INSERT INTO `genero` VALUES (1,'Pop'),(2,'Punk'),(3,'Reggae'),(4,'Reguetón'),(5,'Soul'),(6,'Jazz'),(7,'Funk'),(8,'Blues'),(9,'Rock'),(10,'Rap'),(11,'Hip-Hop'),(12,'Bachata');
/*!40000 ALTER TABLE `genero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propuesta`
--

DROP TABLE IF EXISTS `propuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `propuesta` (
  `idconcierto` int(11) NOT NULL,
  `idgrupo` int(11) NOT NULL,
  `aceptado` char(1) NOT NULL,
  PRIMARY KEY (`idconcierto`,`idgrupo`),
  KEY `fk_propuesta_2_idx` (`idgrupo`),
  CONSTRAINT `fk_propuesta_1` FOREIGN KEY (`idconcierto`) REFERENCES `concierto` (`idconcierto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_propuesta_2` FOREIGN KEY (`idgrupo`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propuesta`
--

LOCK TABLES `propuesta` WRITE;
/*!40000 ALTER TABLE `propuesta` DISABLE KEYS */;
INSERT INTO `propuesta` VALUES (2,23,'P'),(2,28,'A'),(3,24,'P'),(3,27,'P'),(5,31,'P'),(5,34,'A'),(6,24,'A'),(6,27,'P'),(7,29,'P'),(7,33,'P'),(8,26,'P'),(8,32,'P'),(9,25,'A'),(9,30,'P'),(10,26,'P'),(10,32,'P'),(11,22,'P'),(11,25,'P'),(11,30,'P');
/*!40000 ALTER TABLE `propuesta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(15) NOT NULL,
  `password` varchar(10) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `ciudad` int(11) DEFAULT NULL,
  `sexo` varchar(1) DEFAULT NULL,
  `nacimiento` date DEFAULT NULL,
  `nombre_artistico` varchar(60) DEFAULT NULL,
  `genero` int(11) DEFAULT NULL,
  `componentes` int(11) DEFAULT NULL,
  `direccion` varchar(60) DEFAULT NULL,
  `aforo` int(11) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `perfil` char(1) NOT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `nombre_usuario_UNIQUE` (`nombre_usuario`),
  KEY `fk_usuario_1_idx` (`ciudad`),
  KEY `fk_usuario_2_idx` (`genero`),
  CONSTRAINT `fk_usuario_1` FOREIGN KEY (`ciudad`) REFERENCES `ciudad` (`idciudad`) ON UPDATE CASCADE,
  CONSTRAINT `fk_usuario_2` FOREIGN KEY (`genero`) REFERENCES `genero` (`idgenero`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (2,'andres.perez','123456','Andrés','Pérez','andres.perez@gmail.com','600100200',1,'H','1995-12-30',NULL,NULL,NULL,NULL,NULL,NULL,'f'),(3,'lola.casals','123456','Lola','Casals','lola.casals@gmail.com','600100200',1,'D','1996-10-20',NULL,NULL,NULL,NULL,NULL,NULL,'f'),(4,'heliogabal','123456','Juan','Salon','heliogabal@gmail.com','620300300',1,'H','1990-07-05','HELIOGÀBAL',NULL,NULL,'Ramón y Cajal, 80',300,NULL,'l'),(5,'freedonia','123456','Carles','Mendez','freedonia@gmail.com','620301010',1,'H','1980-03-04','Freedonia',NULL,NULL,'Lleialtat 6',240,NULL,'l'),(6,'hijauhusb','123456','Ana','Sanchez','hijauhusb@hotmail.com','660100200',1,'D','1985-04-10','hijauhusb',NULL,NULL,'Passatge Caminal número 13',190,NULL,'l'),(7,'larouge','123456','Oscar','Armengol','larouge-barcleona@gmail.com','610203040',1,'H','1983-08-03','La Rouge',NULL,NULL,'Rambla del Raval, 10',330,NULL,'l'),(8,'robadors','123456','Ivan','Aragones','robadors23@gmail.com','678200100',1,'H','1984-05-03','Robadors 23',NULL,NULL,'Robadors 23',175,NULL,'l'),(9,'jazzsi','123456','Olga','Saez','jazzsi@gmail.com','650200670',1,'D','1988-10-10','Jazz SI',NULL,NULL,'Requesens, 2',200,NULL,'l'),(10,'marulacafe','123456','Sonia','Merlin','marulacafe@gmail.com','640378956',1,'D','1986-09-08','Marula Café',NULL,NULL,'Escudellers, 49',230,NULL,'l'),(11,'barts','123456','Xavier','Alavedra','barts-barcelona@gmail.com','645900700',1,'H','1975-08-02','Barts Club',NULL,NULL,'Paral·lel, 62',290,NULL,'l'),(12,'KoittonClub','123456','Sandra','Lopez','KoittonClub@gmail.com','672100200',1,'D','1978-11-20','Koitton Club',NULL,NULL,'Rossend Arús, 9',190,NULL,'l'),(13,'SARAU08911','123456','Toni','Clape','Sarau08911@gmail.com','645340800',2,'H','1981-10-10','SARAU 08911',NULL,NULL,'Ramon Martí i Alsina, 32',220,NULL,'l'),(14,'SalaMontigala','123456','Enric','Munne','salamontigala@gmail.com','680702010',2,'H','1984-11-03','Sala Montigala',NULL,NULL,'Rambla frança,  21-27',50,NULL,'l'),(15,'CafeCantonada','123456','Sonia','Roca','cafecantonada@gmail.com','679700200',4,'D','1987-12-06','Cafe Cantonada',NULL,NULL,'Fortuny, 23',125,NULL,'l'),(16,'Cucut','123456','Pere','Raya','cucut@gmail.com','680908765',7,'H','1991-10-05','Cu-cut',NULL,NULL,'Plaza Independència, 10',150,NULL,'l'),(17,'Cafefar','123456','Silvia','Villar','cafedelfar@gmail.com','689099006',9,'D','1993-03-06','Café del Far',NULL,NULL,'Cala Crancs, 2',100,NULL,'l'),(18,'coyote','123456','Jaume','Ras','coyotelive@gmail.com','678909654',10,'H','1985-08-08','Coyote Live',NULL,NULL,'Alemanya 16',150,NULL,'l'),(19,'Federalwest ','123456','Carlota','Ruiz','Federalwest@hotmail.com','650700200',10,'D','1980-02-20','Federal west ',NULL,NULL,'Plaza del sol n 10',130,NULL,'l'),(21,'koppers','123456','Sergio','Rodriguez','info@koppers.com','100100200',NULL,'H','1981-10-03','KOPPRES',2,5,NULL,NULL,NULL,'m'),(22,'Mediterranium','123456','Alicia','Bello','mediterranium@gmail.com','100200300',NULL,'D','1986-04-02','Mediterranium',1,2,NULL,NULL,NULL,'m'),(23,'Sackers','123456','Juan','Ortega','sackers@gmail.com','100200301',NULL,'H','1989-01-02','SACKERS',6,3,NULL,NULL,NULL,'m'),(24,'Mans','123456','Teo','Sarroca','mans@gmail.com','100200303',NULL,'H','1977-02-10','MANS',11,1,NULL,NULL,NULL,'m'),(25,'Leiazul','123456','Sheila','Saez','leiasheila@gmail.com','100200304',NULL,'D','1979-05-09','LeiAzul',1,2,NULL,NULL,NULL,'m'),(26,'MalaVida','123456','David','Canos','davidcanos@gmail.com','100200305',NULL,'H','1971-10-02','Mala Vida',12,3,NULL,NULL,NULL,'m'),(27,'SuperGes','123456','Daniel','Marin','danielmarin@gmail.com','100200306',NULL,'H','1972-12-10','Super Ges',10,2,NULL,NULL,NULL,'m'),(28,'Jazz3','123456','Jose','Rodriguez','jazz3@gmail.com','100200307',NULL,'H','1978-09-10','Jazz3',6,2,NULL,NULL,NULL,'m'),(29,'BandPunk','123456','Gustavo','Serra','bandpunk@gmail.com','100200308',NULL,'H','1977-03-02','Band Punk',2,5,NULL,NULL,NULL,'m'),(30,'SeisGirls','123456','Ana','Rostit','seisgirls@gmail.com','100200309',NULL,'D','1981-09-10','Seis Girls',1,6,NULL,NULL,NULL,'m'),(31,'Trencats','123456','Jan','Salvado','jansalvado@gmail.com','100200310',NULL,'H','1980-01-16','Trencats',5,2,NULL,NULL,NULL,'m'),(32,'Ecos','123456','Adrian','Segura','adriansegura@gmail.com','100200311',NULL,'H','1979-12-01','ECOS',4,2,NULL,NULL,NULL,'m'),(33,'DoubleRock','123456','Sebastian','Garcia','sebastiangarcia@gmail.com','100200312',NULL,'H','1974-06-27','Double ROCK',9,4,NULL,NULL,NULL,'m'),(34,'Sentidos','123456','Andrea','Marti','andreamarti@gmail.com','100200313',NULL,'D','1980-10-14','Sentidos',8,2,NULL,NULL,NULL,'m'),(35,'Sheila.adell','123456','Sheila','Adell','sheila.adell@gmail.com','600200111',1,'D','1990-11-12',NULL,NULL,NULL,NULL,NULL,NULL,'f'),(36,'JordiMas','123456','Jordi','Mas','jordi.mas@gmail.com','600200222',1,'H','1997-06-11',NULL,NULL,NULL,NULL,NULL,NULL,'f'),(38,'SandroGomez','123456','Sandro','Gomez','Sandro.gomez@gmail.com','600300303',2,'H','1998-10-01',NULL,NULL,NULL,NULL,NULL,NULL,'f'),(39,'SantiRamirez','123456','Santi','Ramirez','santi.ramirez@gmail.com','600203088',2,'H','1997-01-06',NULL,NULL,NULL,NULL,NULL,NULL,'f'),(40,'SaraBeltran','123456','Sara','Beltran','sara.beltran@gmail.com','600303044',3,'D','1996-08-01',NULL,NULL,NULL,NULL,NULL,NULL,'f'),(41,'LaraCostal','123456','Lara','Costal','lara.costal@gmail.com','600200111',4,'D','1995-03-30',NULL,NULL,NULL,NULL,NULL,NULL,'f'),(42,'InesSoriano','123456','Ines','Soriano','ines.soriano@gmail.com','600800200',5,'D','1994-05-20',NULL,NULL,NULL,NULL,NULL,NULL,'f'),(43,'PolMenendez','123456','Pol','Menendez','pol.menendez@gmail.com','600900444',7,'H','1993-10-05',NULL,NULL,NULL,NULL,NULL,NULL,'f');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voto_concierto`
--

DROP TABLE IF EXISTS `voto_concierto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voto_concierto` (
  `idfan` int(11) NOT NULL,
  `idconcierto` int(11) NOT NULL,
  PRIMARY KEY (`idfan`,`idconcierto`),
  KEY `fk_voto_concierto_2_idx` (`idconcierto`),
  CONSTRAINT `fk_voto_concierto_1` FOREIGN KEY (`idfan`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_voto_concierto_2` FOREIGN KEY (`idconcierto`) REFERENCES `concierto` (`idconcierto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voto_concierto`
--

LOCK TABLES `voto_concierto` WRITE;
/*!40000 ALTER TABLE `voto_concierto` DISABLE KEYS */;
INSERT INTO `voto_concierto` VALUES (2,2),(3,2),(35,2),(36,2),(38,2),(39,2),(40,2),(41,2),(42,2),(43,2),(2,5),(3,5),(35,5),(36,5),(38,5),(39,5),(40,5),(41,5),(40,6),(41,6),(42,6),(43,6),(36,9),(38,9),(39,9);
/*!40000 ALTER TABLE `voto_concierto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voto_musico`
--

DROP TABLE IF EXISTS `voto_musico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voto_musico` (
  `idfan` int(11) NOT NULL,
  `idmusico` int(11) NOT NULL,
  PRIMARY KEY (`idfan`,`idmusico`),
  KEY `usuario_idx` (`idmusico`),
  CONSTRAINT `fan` FOREIGN KEY (`idfan`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `musico` FOREIGN KEY (`idmusico`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voto_musico`
--

LOCK TABLES `voto_musico` WRITE;
/*!40000 ALTER TABLE `voto_musico` DISABLE KEYS */;
INSERT INTO `voto_musico` VALUES (2,21),(3,21),(35,21),(36,21),(38,21),(39,21),(40,21),(41,21),(42,21),(43,21),(2,22),(3,22),(35,22),(36,22),(38,22),(39,22),(40,22),(41,22),(36,23),(38,23),(39,23),(40,23),(41,23),(42,23),(43,23),(3,24),(36,24),(38,24),(39,24),(40,24),(41,24),(42,24),(41,25),(42,25),(43,25),(39,26),(40,26),(35,27),(38,27),(3,28);
/*!40000 ALTER TABLE `voto_musico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'ohhhmusic3'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-11  0:50:44