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
-- Table structure for table `template`
--

DROP TABLE IF EXISTS `template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `template` (
  `#` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `@attribute` text,
  `accesslevel` int(20) DEFAULT NULL,
  `author` int(20) DEFAULT NULL,
  `body` longtext,
  `created` datetime DEFAULT NULL,
  `description` text,
  `editor` int(20) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `published` datetime DEFAULT NULL,
  `publisher` int(20) DEFAULT NULL,
  `script` longtext,
  `status` int(20) DEFAULT NULL,
  `style` longtext,
  `title` text,
  PRIMARY KEY (`#`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8mb4 COMMENT='Template';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template`
--

LOCK TABLES `template` WRITE;
/*!40000 ALTER TABLE `template` DISABLE KEYS */;
INSERT INTO `template` VALUES (1,'default','{\"show-title\":\"3\",\"show-author\":\"4\",\"show-category\":\"3\",\"show-tags\":\"3\",\"show-date\":\"4\",\"show-image\":\"3\",\"position-image\":\"2\",\"show-info\":\"3\",\"position-info\":\"3\",\"show-readmore\":\"1\"}',1,1,'<!DOCTYPE html>\n<html lang=\"<cubo:param name=\'language\' />\" itemscope itemtype=\"https://schema.org/WebPage\">\n<head>\n	<link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\" integrity=\"sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T\" crossorigin=\"anonymous\">\n	<link rel=\"stylesheet\" href=\"/template/stylesheet/<cubo:param name=\'template\' />?minify\" />\n	<link rel=\"icon\" type=\"image/png\" href=\"/vendor/cubo-cms/asset/image/cubo-b192.png\" />\n	<script defer src=\"https://use.fontawesome.com/releases/v5.7.2/js/solid.js\" integrity=\"sha384-6FXzJ8R8IC4v/SKPI8oOcRrUkJU8uvFK6YJ4eDY11bJQz4lRw5/wGthflEOX8hjL\" crossorigin=\"anonymous\"></script>\n	<script defer src=\"https://use.fontawesome.com/releases/v5.7.2/js/fontawesome.js\" integrity=\"sha384-xl26xwG2NVtJDw2/96Lmg09++ZjrXPc89j0j7JHjLOdSwHDHPHiucUjfllW0Ywrq\" crossorigin=\"anonymous\"></script>\n	<script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\" integrity=\"sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo\" crossorigin=\"anonymous\"></script>\n	<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\" integrity=\"sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1\" crossorigin=\"anonymous\"></script>\n	<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\" integrity=\"sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM\" crossorigin=\"anonymous\"></script>\n	<cubo:head />\n</head>\n<body class=\"has-fixed-nav\">\n	<nav id=\"navigation\" class=\"fixed-top bg-primary\">\n		<div class=\"navbar navbar-expand-md navbar-dark bg-primary justify-content-between container\" role=\"menu\">\n			<div class=\"navbar-nav mr-auto d-md-none\"><a class=\"nav-link\" data-toggle=\"collapse\" data-target=\"#navbar-menu\" aria-controls=\"navbar-menu\" aria-expanded=\"false\" aria-label=\"Toggle navigation\"><span class=\"circle\"><i class=\"fa fa-bars\"></i></span></a></div>\n			<cubo:module name=\"logo\" content=\"style=cubo-cms\" />\n			<div class=\"navbar-nav ml-auto d-md-none\"><cubo:module name=\"user\" content=\"\" /></div>\n			<div id=\"navbar-menu\" class=\"collapse navbar-collapse\"><cubo:module name=\"menu\" content=\"\" /></div>\n			<div class=\"navbar-nav ml-auto d-none d-md-block\"><cubo:module name=\"user\" content=\"\" /></div>\n		</div>\n	</nav>\n	<header id=\"header\">\n		<section id=\"header-content\" role=\"info\">\n			<cubo:module name=\"header\" content=\"\" />\n		</section>\n	</header>\n	<section id=\"message\">\n		<section class=\"container\" id=\"message-content\" role=\"message\">\n			<cubo:message />\n		</div>\n	</section>\n	<main id=\"main\">\n		<section class=\"container\" id=\"main-content\" role=\"main\">\n			<cubo:content />\n		</section>\n	</main>\n	<footer id=\"footer\" class=\"fixed-bottom bg-primary\">\n		<div class=\"navbar navbar-expand-md navbar-dark bg-primary justify-content-between container\" role=\"info\">\n			<cubo:module name=\"footer\" content=\"\" />\n		</div>\n	</footer>\n</body>\n</html>','1968-12-10 00:00:00','Default Cubo CMS template',NULL,NULL,'1968-12-10 00:00:00',1,NULL,1,'@import url(\'https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab|Roboto+Condensed|Exo\');\n\n/* General settings */\n\nbody {\n	font-family: \'Roboto\',sans-serif;\n}\na {\n	-webkit-transition: all .5s ease-in-out;\n	transition: all .5s ease-in-out;\n}\nh1, h2, h3, h4, h5, h6 {\n	font-family: \'Roboto Slab\',serif;\n}\n\n/* NavBar customizations */\n\nbody.has-fixed-nav {\n	margin-top: 4rem;\n}\n.navbar {\n	padding: 0 1rem;\n	min-height: calc(3rem + 2px);\n}\n.nav-link {\n	font-size: 1.125rem;\n	padding-top: 0;\n	padding-bottom: 0;\n}\n.navbar-dark .nav-link {\n	text-shadow: 2px 2px rgba(0,0,0,.25);\n}\n.navbar-dark .navbar-brand {\n	color: rgba(255,255,255,.5);\n	text-shadow: 2px 2px rgba(0,0,0,.25);\n}\n.navbar-dark .navbar-brand:hover,.navbar-dark .navbar-brand:focus {\n	color: rgba(255,255,255,.75);\n}\n.navbar-brand .brand-logo {\n	display: inline-block;\n	max-height: 2.5rem;\n	-webkit-transition: -webkit-transform .5s ease-in-out;\n	transition: transform .5s ease-in-out;\n}\n.navbar-brand:hover .brand-logo {\n	-webkit-transform: rotate(360deg);\n	transform: rotate(360deg);\n}\n.navbar-brand .brand-name {\n	font-family: \'Exo\',\'Roboto\',sans-serif;\n	padding-left: .5rem;\n	vertical-align: middle;\n	font-size: 1.5rem;\n}\n\n/* Circle button */\n\n.circle {\n	width: 2.5rem;\n	height: 2.5rem;\n	display: inline-flex;\n	justify-content: center;\n	align-items: center;\n	background-color: rgba(255,255,255,.25);\n	border-radius: 50%;\n	overflow: hidden;\n}\na .circle > * {\n	-webkit-transition: -webkit-transform .5s ease-in-out;\n	transition: transform .5s ease-in-out;\n}\na:hover .circle > *,a:hover .circle > * {\n	transform: scale(1.25);\n}\n\n/* Other customizations */\n\nlabel {\n	margin: 0;\n	font-family: \'Roboto Condensed\',sans-serif;\n	font-size: small;\n	font-style: italic;\n}\ntextarea {\n	padding-top: calc(.375rem + 1px);\n}\ntextarea.text-html {\n	font-family: monospace;\n}\nbutton {\n	cursor: pointer;\n}\nfigure {\n	margin: .125rem;\n}\nfigcaption {\n	font-size: smaller;\n	font-style: italic;\n	text-align: center;\n}\nselect.form-control-sm {\n	height: calc(1.8125rem + 2px) !important;\n}\n.custom-file-control:before {\n	content: \"\\f002\" !important;\n	font-family: FontAwesome !important;\n	font-size: 1rem;\n	font-style: normal;\n	background: #ff7518;\n	border: none;\n}\n\n.img-selectable img {\n	opacity: .75;\n	-webkit-opacity: .75;\n}\n.img-selectable:hover {\n	cursor: pointer;\n}\n.img-selectable:hover img {\n	opacity: 1;\n	-webkit-opacity: 1;\n}\n\n.align-middle {\n	align-self: center;\n}\n.btn-sm, .btn-group-sm > .btn {\n	margin: 0 .25rem;\n}\n\n.form-inline {\n	-webkit-flex-wrap: nowrap;\n	flex-wrap: nowrap;\n}','Default');
/*!40000 ALTER TABLE `template` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-01 18:16:31
