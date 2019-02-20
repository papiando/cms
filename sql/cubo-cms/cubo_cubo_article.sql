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
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
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
  `intro` longtext,
  `language` int(20) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `published` datetime DEFAULT NULL,
  `publisher` int(20) DEFAULT NULL,
  `rating` varchar(100) DEFAULT NULL,
  `status` int(20) DEFAULT NULL,
  `tags` text,
  `template` int(20) DEFAULT NULL,
  `title` text,
  `visits` int(20) DEFAULT NULL,
  PRIMARY KEY (`#`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1003 DEFAULT CHARSET=utf8mb4 COMMENT='Article';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,'home','{\"show_title\":\"3\",\"show_author\":\"4\",\"show_category\":\"3\",\"show_tags\":\"-1\",\"show_date\":\"4\",\"show_image\":\"3\",\"position_image\":\"2\",\"show_info\":\"-1\",\"position_info\":\"3\",\"show_readmore\":\"1\"}',1,1,'<p>Welcome to the home page.</p>',1,'1968-12-10 00:00:00','This is the home page',NULL,NULL,'<p>There is no place like home.</p>',1,NULL,'1968-12-10 00:00:00',1,NULL,1,NULL,NULL,'Home',1),(2,'login','{\"show_title\":\"3\",\"show_author\":\"4\",\"show_category\":\"2\",\"show_tags\":\"2\",\"show_date\":\"2\",\"show_image\":\"2\",\"position_image\":\"2\",\"show_info\":\"2\",\"position_info\":\"3\",\"show_readmore\":\"0\"}',3,1,'<cubo:module name=\"login\" content=\"\" />',1,'1968-12-10 00:00:00','This is the login page',NULL,NULL,'<p>Please provide your user name and password</p>',1,NULL,'1968-12-10 00:00:00',1,NULL,1,NULL,1,'User Login',0),(1001,'unpublished',NULL,1,2,'<p>This article is not published</p>',1,NULL,'Unpublished article',NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,NULL,'Unpublished article',0),(1002,'restricted',NULL,2,2,'<p>This article is restricted</p>',1,NULL,'Restricted article',NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,NULL,'Restricted article',0);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-20 16:27:33
