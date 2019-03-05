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
  `visits` int(20) DEFAULT '0',
  PRIMARY KEY (`#`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1008 DEFAULT CHARSET=utf8mb4 COMMENT='Article';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,'home','{\"show-title\":\"1\",\"show-author\":\"4\",\"show-category\":\"1\",\"show-tags\":\"1\",\"show-date\":\"6\",\"show-image\":\"1\",\"position-image\":\"2\",\"show-info\":\"1\",\"position-info\":\"3\",\"show-readmore\":\"1\"}',1,1,'<p>Welcome to the home page.</p>',1,'1968-12-10 00:00:00','This is the home page',2,NULL,'<p>There is no place like home.</p>',1,'2019-02-24 23:52:35','1968-12-10 00:00:00',1,NULL,1,NULL,NULL,'Home',79),(2,'login','{\"show_title\":\"3\",\"show_author\":\"4\",\"show_category\":\"2\",\"show_tags\":\"2\",\"show_date\":\"2\",\"show_image\":\"2\",\"position_image\":\"2\",\"show_info\":\"2\",\"position_info\":\"3\",\"show_readmore\":\"0\"}',3,1,'<cubo:module name=\"login\" content=\"\" />',1,'1968-12-10 00:00:00','This is the login page',NULL,NULL,'<p>Please provide your user name and password</p>',1,NULL,'1968-12-10 00:00:00',1,NULL,1,NULL,1,'User Login',27),(1001,'unpublished','{\"show-title\":\"-1\",\"show-author\":\"-1\",\"show-category\":\"-1\",\"show-tags\":\"-1\",\"show-date\":\"-1\",\"show-image\":\"-1\",\"position-image\":\"-1\",\"show-info\":\"-1\",\"position-info\":\"-1\",\"show-readmore\":\"-1\"}',1,2,'<p>This article is not published</p>',1,NULL,'Unpublished article',2,NULL,NULL,1,'2019-02-24 21:51:29',NULL,NULL,NULL,2,NULL,NULL,'Unpublished article',0),(1002,'restricted','{\"show-title\":\"-1\",\"show-author\":\"-1\",\"show-category\":\"-1\",\"show-tags\":\"-1\",\"show-date\":\"-1\",\"show-image\":\"-1\",\"position-image\":\"-1\",\"show-info\":\"-1\",\"position-info\":\"-1\",\"show-readmore\":\"-1\"}',2,2,'<p>This article is restricted</p>',1,NULL,'Restricted article',2,10,NULL,1,'2019-02-24 17:29:46',NULL,NULL,NULL,1,NULL,NULL,'Restricted article',0),(1003,'customer','{\"show-title\":\"1\",\"show-author\":\"-1\",\"show-category\":\"-1\",\"show-tags\":\"-1\",\"show-date\":\"-1\",\"show-image\":\"-1\",\"position-image\":\"-1\",\"show-info\":\"1\",\"position-info\":\"-1\",\"show-readmore\":\"-1\"}',2,2,NULL,1,'2019-02-19 00:42:00','Registered as a customer',2,NULL,NULL,1,'2019-02-24 21:52:04','2019-02-24 21:52:04',2,NULL,1,NULL,NULL,'Customer',2),(1004,'this-is-a-new-article','{\"show-title\":\"-1\",\"show-author\":\"-1\",\"show-category\":\"-1\",\"show-tags\":\"-1\",\"show-date\":\"-1\",\"show-image\":\"-1\",\"position-image\":\"-1\",\"show-info\":\"-1\",\"position-info\":\"-1\",\"show-readmore\":\"-1\"}',1,1001,'Article body',1,'2019-02-20 23:16:24','',2,NULL,'Article info',1,'2019-02-24 18:58:20','2019-02-24 18:58:20',2,NULL,1,'',NULL,'This is a new article',0),(1005,'another-article','{\"show-title\":\"-1\",\"show-author\":\"-1\",\"show-category\":\"-1\",\"show-tags\":\"-1\",\"show-date\":\"-1\",\"show-image\":\"-1\",\"position-image\":\"-1\",\"show-info\":\"-1\",\"position-info\":\"-1\",\"show-readmore\":\"-1\"}',1,2,'How are you doing?',3,'2019-02-20 23:59:03','',2,NULL,'What\'s up?',1,'2019-02-26 00:36:59','2019-02-20 23:59:03',2,NULL,1,'',NULL,'Another article',0),(1006,'this-is-a-test','{\"show-title\":\"1\",\"show-author\":\"-1\",\"show-category\":\"-1\",\"show-tags\":\"-1\",\"show-date\":\"-1\",\"show-image\":\"-1\",\"position-image\":\"-1\",\"show-info\":\"-1\",\"position-info\":\"-1\",\"show-readmore\":\"-1\"}',1,1001,'Let\'s see what happens',1,'2019-02-21 22:11:32','',2,NULL,'Trying to change',1,'2019-02-21 22:18:39',NULL,NULL,NULL,4,'',NULL,'This is a test',0),(1007,'sirle','{\"show-title\":\"-1\",\"show-author\":\"-1\",\"show-category\":\"-1\",\"show-tags\":\"-1\",\"show-date\":\"-1\",\"show-image\":\"-1\",\"position-image\":\"-1\",\"show-info\":\"-1\",\"position-info\":\"-1\",\"show-readmore\":\"-1\"}',1,2,'Goodbye',1,'2019-02-24 21:51:00','',NULL,NULL,'Hello',1,NULL,'2019-02-24 21:51:00',2,NULL,1,'',NULL,'Sirle',0);
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

-- Dump completed on 2019-03-05  0:45:02
