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
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `language` (
  `#` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `accesslevel` int(20) DEFAULT NULL,
  `alpha2` varchar(10) DEFAULT NULL,
  `alpha3` varchar(10) DEFAULT NULL,
  `author` int(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `description` text,
  `editor` int(20) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `nativename` varchar(10) DEFAULT NULL,
  `published` datetime DEFAULT NULL,
  `publisher` int(20) DEFAULT NULL,
  `status` int(20) DEFAULT NULL,
  `title` text,
  PRIMARY KEY (`#`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COMMENT='Language';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `language`
--

LOCK TABLES `language` WRITE;
/*!40000 ALTER TABLE `language` DISABLE KEYS */;
INSERT INTO `language` VALUES (1,'undefined',1,NULL,NULL,1,'1968-12-10 00:00:00',NULL,NULL,NULL,NULL,'1968-12-10 00:00:00',1,1,'Undefined Language'),(2,'pashto',1,'ps','pus',1,'2019-02-20 11:02:42','Pashto',NULL,NULL,'پښتو','2019-02-20 11:02:42',1,1,'Pashto'),(3,'uzbek',1,'uz','uzb',1,'2019-02-20 11:02:42','Uzbek',NULL,NULL,'Oʻzbek','2019-02-20 11:02:42',1,1,'Uzbek'),(4,'turkmen',1,'tk','tuk',1,'2019-02-20 11:02:42','Turkmen',NULL,NULL,'Türkmen','2019-02-20 11:02:42',1,1,'Turkmen'),(5,'swedish',1,'sv','swe',1,'2019-02-20 11:02:42','Swedish',NULL,NULL,'svenska','2019-02-20 11:02:42',1,1,'Swedish'),(6,'albanian',1,'sq','sqi',1,'2019-02-20 11:02:42','Albanian',NULL,NULL,'Shqip','2019-02-20 11:02:42',1,1,'Albanian'),(7,'arabic',1,'ar','ara',1,'2019-02-20 11:02:42','Arabic',NULL,NULL,'العربية','2019-02-20 11:02:42',1,1,'Arabic'),(8,'english',1,'en','eng',1,'2019-02-20 11:02:42','English',NULL,NULL,'English','2019-02-20 11:02:42',1,1,'English'),(9,'catalan',1,'ca','cat',1,'2019-02-20 11:02:42','Catalan',NULL,NULL,'català','2019-02-20 11:02:42',1,1,'Catalan'),(10,'portuguese',1,'pt','por',1,'2019-02-20 11:02:42','Portuguese',NULL,NULL,'Português','2019-02-20 11:02:42',1,1,'Portuguese'),(11,'russian',1,'ru','rus',1,'2019-02-20 11:02:42','Russian',NULL,NULL,'Русский','2019-02-20 11:02:42',1,1,'Russian'),(12,'spanish',1,'es','spa',1,'2019-02-20 11:02:42','Spanish',NULL,NULL,'Español','2019-02-20 11:02:42',1,1,'Spanish'),(13,'guarani',1,'gn','grn',1,'2019-02-20 11:02:42','Guaraní',NULL,NULL,'Avañe\'ẽ','2019-02-20 11:02:42',1,1,'Guaraní'),(14,'armenian',1,'hy','hye',1,'2019-02-20 11:02:42','Armenian',NULL,NULL,'Հայերեն','2019-02-20 11:02:42',1,1,'Armenian'),(15,'dutch',1,'nl','nld',1,'2019-02-20 11:02:42','Dutch',NULL,NULL,'Nederlands','2019-02-20 11:02:42',1,1,'Dutch'),(16,'punjabi',1,'pa','pan',1,'2019-02-20 11:02:42','Punjabi',NULL,NULL,'ਪੰਜਾਬੀ','2019-02-20 11:02:42',1,1,'Punjabi'),(17,'german',1,'de','deu',1,'2019-02-20 11:02:42','German',NULL,NULL,'Deutsch','2019-02-20 11:02:42',1,1,'German'),(18,'bengali',1,'bn','ben',1,'2019-02-20 11:02:42','Bengali',NULL,NULL,'বাংলা','2019-02-20 11:02:42',1,1,'Bengali'),(19,'french',1,'fr','fra',1,'2019-02-20 11:02:42','French',NULL,NULL,'français','2019-02-20 11:02:42',1,1,'French'),(20,'dzongkha',1,'dz','dzo',1,'2019-02-20 11:02:42','Dzongkha',NULL,NULL,'རྫོང་ཁ','2019-02-20 11:02:42',1,1,'Dzongkha'),(21,'aymara',1,'ay','aym',1,'2019-02-20 11:02:42','Aymara',NULL,NULL,'aymar aru','2019-02-20 11:02:42',1,1,'Aymara'),(22,'quechua',1,'qu','que',1,'2019-02-20 11:02:42','Quechua',NULL,NULL,'Runa Simi','2019-02-20 11:02:42',1,1,'Quechua'),(23,'tswana',1,'tn','tsn',1,'2019-02-20 11:02:42','Tswana',NULL,NULL,'Setswana','2019-02-20 11:02:42',1,1,'Tswana'),(24,'norwegian',1,'no','nor',1,'2019-02-20 11:02:42','Norwegian',NULL,NULL,'Norsk','2019-02-20 11:02:42',1,1,'Norwegian'),(25,'fulah',1,'ff','ful',1,'2019-02-20 11:02:42','Fulah',NULL,NULL,'Fulfulde','2019-02-20 11:02:42',1,1,'Fulah'),(26,'kirundi',1,'rn','run',1,'2019-02-20 11:02:42','Kirundi',NULL,NULL,'Ikirundi','2019-02-20 11:02:42',1,1,'Kirundi'),(27,'khmer',1,'km','khm',1,'2019-02-20 11:02:42','Khmer',NULL,NULL,'ខ្មែរ','2019-02-20 11:02:42',1,1,'Khmer'),(28,'lingala',1,'ln','lin',1,'2019-02-20 11:02:42','Lingala',NULL,NULL,'Lingála','2019-02-20 11:02:42',1,1,'Lingala'),(29,'kongo',1,'kg','kon',1,'2019-02-20 11:02:42','Kongo',NULL,NULL,'Kikongo','2019-02-20 11:02:42',1,1,'Kongo'),(30,'swahili',1,'sw','swa',1,'2019-02-20 11:02:42','Swahili',NULL,NULL,'Kiswahili','2019-02-20 11:02:42',1,1,'Swahili'),(31,'luba-katanga',1,'lu','lub',1,'2019-02-20 11:02:42','Luba-Katanga',NULL,NULL,'Tshiluba','2019-02-20 11:02:42',1,1,'Luba-Katanga'),(32,'greek',1,'el','ell',1,'2019-02-20 11:02:42','Greek',NULL,NULL,'ελληνικά','2019-02-20 11:02:42',1,1,'Greek'),(33,'turkish',1,'tr','tur',1,'2019-02-20 11:02:42','Turkish',NULL,NULL,'Türkçe','2019-02-20 11:02:42',1,1,'Turkish'),(34,'czech',1,'cs','ces',1,'2019-02-20 11:02:42','Czech',NULL,NULL,'čeština','2019-02-20 11:02:42',1,1,'Czech'),(35,'slovak',1,'sk','slk',1,'2019-02-20 11:02:42','Slovak',NULL,NULL,'slovenčina','2019-02-20 11:02:42',1,1,'Slovak'),(36,'danish',1,'da','dan',1,'2019-02-20 11:02:42','Danish',NULL,NULL,'dansk','2019-02-20 11:02:42',1,1,'Danish'),(37,'tigrinya',1,'ti','tir',1,'2019-02-20 11:02:42','Tigrinya',NULL,NULL,'ትግርኛ','2019-02-20 11:02:42',1,1,'Tigrinya'),(38,'estonian',1,'et','est',1,'2019-02-20 11:02:42','Estonian',NULL,NULL,'eesti','2019-02-20 11:02:42',1,1,'Estonian'),(39,'amharic',1,'am','amh',1,'2019-02-20 11:02:42','Amharic',NULL,NULL,'አማርኛ','2019-02-20 11:02:42',1,1,'Amharic'),(40,'faroese',1,'fo','fao',1,'2019-02-20 11:02:42','Faroese',NULL,NULL,'føroyskt','2019-02-20 11:02:42',1,1,'Faroese'),(41,'hindi',1,'hi','hin',1,'2019-02-20 11:02:42','Hindi',NULL,NULL,'हिन्दी','2019-02-20 11:02:42',1,1,'Hindi'),(42,'urdu',1,'ur','urd',1,'2019-02-20 11:02:43','Urdu',NULL,NULL,'اردو','2019-02-20 11:02:43',1,1,'Urdu'),(43,'finnish',1,'fi','fin',1,'2019-02-20 11:02:43','Finnish',NULL,NULL,'suomi','2019-02-20 11:02:43',1,1,'Finnish'),(44,'georgian',1,'ka','kat',1,'2019-02-20 11:02:43','Georgian',NULL,NULL,'ქართული','2019-02-20 11:02:43',1,1,'Georgian'),(45,'chamorro',1,'ch','cha',1,'2019-02-20 11:02:43','Chamorro',NULL,NULL,'Chamoru','2019-02-20 11:02:43',1,1,'Chamorro'),(46,'latin',1,'la','lat',1,'2019-02-20 11:02:43','Latin',NULL,NULL,'latine','2019-02-20 11:02:43',1,1,'Latin'),(47,'italian',1,'it','ita',1,'2019-02-20 11:02:43','Italian',NULL,NULL,'Italiano','2019-02-20 11:02:43',1,1,'Italian'),(48,'hungarian',1,'hu','hun',1,'2019-02-20 11:02:43','Hungarian',NULL,NULL,'magyar','2019-02-20 11:02:43',1,1,'Hungarian'),(49,'icelandic',1,'is','isl',1,'2019-02-20 11:02:43','Icelandic',NULL,NULL,'Íslenska','2019-02-20 11:02:43',1,1,'Icelandic'),(50,'farsi',1,'fa','fas',1,'2019-02-20 11:02:43','Farsi',NULL,NULL,'فارسی','2019-02-20 11:02:43',1,1,'Farsi'),(51,'kurdish',1,'ku','kur',1,'2019-02-20 11:02:43','Kurdish',NULL,NULL,'Kurdî','2019-02-20 11:02:43',1,1,'Kurdish'),(52,'irish',1,'ga','gle',1,'2019-02-20 11:02:43','Irish',NULL,NULL,'Gaeilge','2019-02-20 11:02:43',1,1,'Irish'),(53,'manx',1,'gv','glv',1,'2019-02-20 11:02:43','Manx',NULL,NULL,'Gaelg','2019-02-20 11:02:43',1,1,'Manx'),(54,'hebrew',1,'he','heb',1,'2019-02-20 11:02:43','Hebrew',NULL,NULL,'עברית','2019-02-20 11:02:43',1,1,'Hebrew'),(55,'japanese',1,'ja','jpn',1,'2019-02-20 11:02:43','Japanese',NULL,NULL,'日本語 (にほんご)','2019-02-20 11:02:43',1,1,'Japanese'),(56,'kazakh',1,'kk','kaz',1,'2019-02-20 11:02:43','Kazakh',NULL,NULL,'қазақ тілі','2019-02-20 11:02:43',1,1,'Kazakh'),(57,'kyrgyz',1,'ky','kir',1,'2019-02-20 11:02:43','Kyrgyz',NULL,NULL,'Кыргызча','2019-02-20 11:02:43',1,1,'Kyrgyz'),(58,'lao',1,'lo','lao',1,'2019-02-20 11:02:43','Lao',NULL,NULL,'ພາສາລາວ','2019-02-20 11:02:43',1,1,'Lao'),(59,'southern-sotho',1,'st','sot',1,'2019-02-20 11:02:43','Southern-Sotho',NULL,NULL,'Sesotho','2019-02-20 11:02:43',1,1,'Southern-Sotho'),(60,'chichewa',1,'ny','nya',1,'2019-02-20 11:02:43','Chichewa',NULL,NULL,'chiCheŵa','2019-02-20 11:02:43',1,1,'Chichewa'),(61,'divehi',1,'dv','div',1,'2019-02-20 11:02:43','Divehi',NULL,NULL,'ދިވެހި','2019-02-20 11:02:43',1,1,'Divehi'),(62,'maltese',1,'mt','mlt',1,'2019-02-20 11:02:43','Maltese',NULL,NULL,'Malti','2019-02-20 11:02:43',1,1,'Maltese'),(63,'romanian',1,'ro','ron',1,'2019-02-20 11:02:43','Romanian',NULL,NULL,'Română','2019-02-20 11:02:43',1,1,'Romanian'),(64,'mongolian',1,'mn','mon',1,'2019-02-20 11:02:43','Mongolian',NULL,NULL,'Монгол хэл','2019-02-20 11:02:43',1,1,'Mongolian'),(65,'burmese',1,'my','mya',1,'2019-02-20 11:02:43','Burmese',NULL,NULL,'ဗမာစာ','2019-02-20 11:02:43',1,1,'Burmese'),(66,'afrikaans',1,'af','afr',1,'2019-02-20 11:02:43','Afrikaans',NULL,NULL,'Afrikaans','2019-02-20 11:02:43',1,1,'Afrikaans'),(67,'nepali',1,'ne','nep',1,'2019-02-20 11:02:43','Nepali',NULL,NULL,'नेपाली','2019-02-20 11:02:43',1,1,'Nepali'),(68,'korean',1,'ko','kor',1,'2019-02-20 11:02:43','Korean',NULL,NULL,'한국어','2019-02-20 11:02:43',1,1,'Korean'),(69,'tamil',1,'ta','tam',1,'2019-02-20 11:02:43','Tamil',NULL,NULL,'தமிழ்','2019-02-20 11:02:43',1,1,'Tamil'),(70,'somali',1,'so','som',1,'2019-02-20 11:02:43','Somali',NULL,NULL,'Soomaaliga','2019-02-20 11:02:43',1,1,'Somali'),(71,'southern-ndebele',1,'nr','nbl',1,'2019-02-20 11:02:43','Southern-Ndebele',NULL,NULL,'isiNdebele','2019-02-20 11:02:43',1,1,'Southern-Ndebele'),(72,'swati',1,'ss','ssw',1,'2019-02-20 11:02:43','Swati',NULL,NULL,'SiSwati','2019-02-20 11:02:43',1,1,'Swati'),(73,'tsonga',1,'ts','tso',1,'2019-02-20 11:02:43','Tsonga',NULL,NULL,'Xitsonga','2019-02-20 11:02:43',1,1,'Tsonga'),(74,'venda',1,'ve','ven',1,'2019-02-20 11:02:43','Venda',NULL,NULL,'Tshivenḓa','2019-02-20 11:02:43',1,1,'Venda'),(75,'xhosa',1,'xh','xho',1,'2019-02-20 11:02:43','Xhosa',NULL,NULL,'isiXhosa','2019-02-20 11:02:43',1,1,'Xhosa'),(76,'zulu',1,'zu','zul',1,'2019-02-20 11:02:43','Zulu',NULL,NULL,'isiZulu','2019-02-20 11:02:43',1,1,'Zulu'),(77,'sinhalese',1,'si','sin',1,'2019-02-20 11:02:43','Sinhalese',NULL,NULL,'සිංහල','2019-02-20 11:02:43',1,1,'Sinhalese'),(78,'tajik',1,'tg','tgk',1,'2019-02-20 11:02:43','Tajik',NULL,NULL,'тоҷикӣ','2019-02-20 11:02:43',1,1,'Tajik'),(79,'thai',1,'th','tha',1,'2019-02-20 11:02:43','Thai',NULL,NULL,'ไทย','2019-02-20 11:02:43',1,1,'Thai'),(80,'tonga',1,'to','ton',1,'2019-02-20 11:02:43','Tonga',NULL,NULL,'faka Tonga','2019-02-20 11:02:43',1,1,'Tonga'),(81,'ukrainian',1,'uk','ukr',1,'2019-02-20 11:02:43','Ukrainian',NULL,NULL,'Українська','2019-02-20 11:02:43',1,1,'Ukrainian'),(82,'bislama',1,'bi','bis',1,'2019-02-20 11:02:43','Bislama',NULL,NULL,'Bislama','2019-02-20 11:02:43',1,1,'Bislama'),(83,'vietnamese',1,'vi','vie',1,'2019-02-20 11:02:43','Vietnamese',NULL,NULL,'Tiếng Việt','2019-02-20 11:02:43',1,1,'Vietnamese'),(84,'shona',1,'sn','sna',1,'2019-02-20 11:02:43','Shona',NULL,NULL,'chiShona','2019-02-20 11:02:43',1,1,'Shona'),(85,'northern-ndebele',1,'nd','nde',1,'2019-02-20 11:02:43','Northern-Ndebele',NULL,NULL,'isiNdebele','2019-02-20 11:02:43',1,1,'Northern-Ndebele');
/*!40000 ALTER TABLE `language` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-20 16:27:34
