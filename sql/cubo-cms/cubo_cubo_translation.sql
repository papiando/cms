-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: cubo_cubo
-- ------------------------------------------------------
-- Server version	5.7.11-log

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
-- Table structure for table `translation`
--

DROP TABLE IF EXISTS `translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `translation` (
  `#` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `accesslevel` int(20) DEFAULT NULL,
  `author` int(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `editor` int(20) DEFAULT NULL,
  `language` int(20) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `published` datetime DEFAULT NULL,
  `publisher` int(20) DEFAULT NULL,
  `status` int(20) DEFAULT NULL,
  `title` text,
  `translation` text,
  PRIMARY KEY (`#`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COMMENT='Translation';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translation`
--

LOCK TABLES `translation` WRITE;
/*!40000 ALTER TABLE `translation` DISABLE KEYS */;
INSERT INTO `translation` VALUES (1,'eng-unknown-controller-method',1,1,'1968-12-10 00:00:00',NULL,8,NULL,'1968-12-10 00:00:00',1,1,'Controller \'{controller}\' does not have the method \'{method}\' defined','Controller \'{controller}\' does not have the method \'{method}\' defined'),(2,'spa-unknown-controller-method',1,1,'1968-12-10 00:00:00',NULL,12,NULL,'1968-12-10 00:00:00',1,1,'Controller \'{controller}\' does not have the method \'{method}\' defined','Controlador \'{controller}\' no tiene definido el método \'{method}\''),(3,'eng-unknown-controller',1,1,'1968-12-10 00:00:00',NULL,8,NULL,'1968-12-10 00:00:00',1,1,'Controller \'{controller}\' does not exist','Controller \'{controller}\' does not exist'),(4,'spa-unknown-controller',1,1,'1968-12-10 00:00:00',NULL,12,NULL,'1968-12-10 00:00:00',1,1,'Controller \'{controller}\' does not exist','Controlador \'{controller}\' no existe'),(5,'eng-no-data-model',1,1,'1968-12-10 00:00:00',NULL,8,NULL,'1968-12-10 00:00:00',1,1,'Model \'{model}\' returned no data','Model \'{model}\' returned no data'),(6,'spa-no-data-model',1,1,'1968-12-10 00:00:00',NULL,12,NULL,'1968-12-10 00:00:00',1,1,'Model \'{model}\' returned no data','Modelo \'{model}\' no devolvió datos'),(7,'eng-unknown-model',1,1,'1968-12-10 00:00:00',NULL,8,NULL,'1968-12-10 00:00:00',1,1,'Model \'{model}\' does not exist','Model \'{model}\' does not exist'),(8,'spa-unknown-model',1,1,'1968-12-10 00:00:00',NULL,12,NULL,'1968-12-10 00:00:00',1,1,'Model \'{model}\' does not exist','Modelo \'{model}\' no existe'),(9,'eng-unknown-view-method',1,1,'1968-12-10 00:00:00',NULL,8,NULL,'1968-12-10 00:00:00',1,1,'View \'{view}\' does not have the method \'{method}\' defined','View \'{view}\' does not have the method \'{method}\' defined'),(10,'spa-unknown-view-method',1,1,'1968-12-10 00:00:00',NULL,12,NULL,'1968-12-10 00:00:00',1,1,'View \'{view}\' does not have the method \'{method}\' defined','Vista \'{view}\' no tiene definido el método \'{method}\''),(11,'eng-unknown-view',1,1,'1968-12-10 00:00:00',NULL,8,NULL,'1968-12-10 00:00:00',1,1,'View \'{view}\' does not exist','View \'{view}\' does not exist'),(12,'spa-unknown-view',1,1,'1968-12-10 00:00:00',NULL,12,NULL,'1968-12-10 00:00:00',1,1,'View \'{view}\' does not exist','Vista \'{view}\' no existe');
/*!40000 ALTER TABLE `translation` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-05  0:45:03
