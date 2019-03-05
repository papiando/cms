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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `#` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `@attribute` text,
  `accesslevel` int(20) DEFAULT NULL,
  `author` int(20) DEFAULT NULL,
  `body` longtext,
  `category` int(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `description` text,
  `editor` int(20) DEFAULT NULL,
  `image` int(20) DEFAULT NULL,
  `language` int(20) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `published` datetime DEFAULT NULL,
  `publisher` int(20) DEFAULT NULL,
  `status` int(20) DEFAULT NULL,
  `tags` text,
  `title` text,
  `visits` int(20) DEFAULT '0',
  PRIMARY KEY (`#`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='Category';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (0,'none',NULL,0,1,NULL,NULL,'1968-12-10 00:00:00','Root category',NULL,NULL,1,NULL,'1968-12-10 00:00:00',1,1,NULL,'None',0),(1,'undefined',NULL,4,1,NULL,NULL,'1968-12-10 00:00:00','Undefined category',NULL,NULL,1,NULL,'1968-12-10 00:00:00',1,1,NULL,'Undefined',0),(2,'documentation','{\"show-title\":\"-1\",\"show-author\":\"-1\",\"show-category\":\"-1\",\"show-tags\":\"-1\",\"show-date\":\"-1\",\"show-image\":\"-1\",\"position-image\":\"-1\",\"show-info\":\"-1\",\"position-info\":\"-1\",\"show-readmore\":\"-1\"}',1,2,'<p>Find here everything you need to know about the Cubo CMS Framework. From a brief explanation of what the CMS has to offer, its requirements, and installation procedure, up to an extensive explanation of how to create, edit, or remove content.</p>\r\n<p>For experienced users, we are providing our Knowledgebase. And see our Support section to look for known solutions to problems you may encounter, or ask the experts.</p>',0,'2019-02-26 00:35:28','Find here everything you need to know about the Cubo CMS Framework. From a brief explanation of what the CMS has to offer, its requirements, and installation procedure, up to an extensive explanation of how to create, edit, or remove content.',NULL,NULL,1,NULL,'2019-02-26 00:35:28',2,1,'documentation,installation,configuration,prerequisites','Documentation',0),(3,'introduction','{\"show-title\":\"-1\",\"show-author\":\"-1\",\"show-category\":\"-1\",\"show-tags\":\"-1\",\"show-date\":\"-1\",\"show-image\":\"-1\",\"position-image\":\"-1\",\"show-info\":\"-1\",\"position-info\":\"-1\",\"show-readmore\":\"-1\"}',1,2,'Introduction',2,'2019-02-26 00:36:33','',NULL,NULL,1,NULL,'2019-02-26 00:36:33',2,1,'','Introduction',0);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-05  0:45:04
