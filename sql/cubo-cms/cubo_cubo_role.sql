-- MySQL dump 10.13  Distrib 5.6.23, for Win64 (x86_64)
--
-- Host: localhost    Database: cubo_cubo
-- ------------------------------------------------------
-- Server version	5.6.25-log

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
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `#` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `access` int(20) DEFAULT NULL,
  `author` int(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `description` text,
  `editor` int(20) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `published` datetime DEFAULT NULL,
  `publisher` int(20) DEFAULT NULL,
  `status` int(20) DEFAULT NULL,
  `title` text,
  PRIMARY KEY (`#`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8mb4 COMMENT='User Role';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (0,'guest',0,1,'1968-12-10 00:00:00','User is not logged in, and cannot change any item',NULL,NULL,'1968-12-10 00:00:00',1,1,'Guest'),(1,'user',4,1,'1968-12-10 00:00:00','User is logged in, but cannot change any item',NULL,NULL,'1968-12-10 00:00:00',1,1,'User'),(2,'author',4,1,'1968-12-10 00:00:00','User can create items, or change their own items',NULL,NULL,'1968-12-10 00:00:00',1,1,'Author'),(3,'editor',4,1,'1968-12-10 00:00:00','User can add items, or change any unpublished items',NULL,NULL,'1968-12-10 00:00:00',1,1,'Editor'),(4,'publisher',4,1,'1968-12-10 00:00:00','User can add, change, or publish any item',NULL,NULL,'1968-12-10 00:00:00',1,1,'Publisher'),(5,'manager',4,1,'1968-12-10 00:00:00','User can manipulate any item, and manage users',NULL,NULL,'1968-12-10 00:00:00',1,1,'Manager'),(6,'administrator',4,1,'1968-12-10 00:00:00','User can do everything',NULL,NULL,'1968-12-10 00:00:00',1,1,'Administrator');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-21 15:22:47
