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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='Template';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template`
--

LOCK TABLES `template` WRITE;
/*!40000 ALTER TABLE `template` DISABLE KEYS */;
INSERT INTO `template` VALUES (1,'default','{\"show_title\":\"3\",\"show_author\":\"4\",\"show_category\":\"3\",\"show_tags\":\"-1\",\"show_date\":\"4\",\"show_image\":\"3\",\"position_image\":\"2\",\"show_info\":\"-1\",\"position_info\":\"3\",\"show_readmore\":\"1\"}',1,1,'<!DOCTYPE html>\n<html lang=\"<cubo:param name=\'language\' />\" itemscope itemtype=\"https://schema.org/WebPage\">\n<head>\n	<title itemprop=\"name headline\"><cubo:param name=\'title\' /></title>\n	<base itemprop=\"url\" href=\"<cubo:param name=\'base-url\' />/<cubo:param name=\'route\' />\" />\n	<meta charset=\"utf-8\" />\n	<meta name=\"application_name\" content=\"<cubo:param name=\'site-name\' />\" />\n	<meta name=\"generator\" content=\"<cubo:param name=\'generator\' />\" />\n	<meta name=\"viewport\" content=\"width=device-width,initial-scale=1,shrink-to-fit=no\" />\n	<link rel=\"stylesheet\" href=\"/theme/stylesheet/<cubo:param name=\'theme\' />?minify\" />\n	<link rel=\"stylesheet\" href=\"/template/stylesheet/<cubo:param name=\'template\' />?minify\" />\n	<link rel=\"icon\" type=\"image/png\" href=\"/vendor/cubo-cms/cubo-b192.png\" />\n	<script defer src=\"https://use.fontawesome.com/releases/v5.7.2/js/solid.js\" integrity=\"sha384-6FXzJ8R8IC4v/SKPI8oOcRrUkJU8uvFK6YJ4eDY11bJQz4lRw5/wGthflEOX8hjL\" crossorigin=\"anonymous\"></script>\n	<script defer src=\"https://use.fontawesome.com/releases/v5.7.2/js/fontawesome.js\" integrity=\"sha384-xl26xwG2NVtJDw2/96Lmg09++ZjrXPc89j0j7JHjLOdSwHDHPHiucUjfllW0Ywrq\" crossorigin=\"anonymous\"></script>\n	<script src=\"/vendor/jquery/3.2.1/js/jquery.min.js\"></script>\n	<script src=\"/vendor/popper.js/1.12.3/js/popper.min.js\"></script>\n	<script src=\"/vendor/tether/1.3.3/js/tether.min.js\"></script>\n	<script src=\"/vendor/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js\"></script>\n</head>\n<body class=\"has-fixed-nav\">\n	<nav id=\"navigation\" class=\"navbar navbar-toggleable-md navbar-dark bg-primary text-inverse fixed-top\">\n		<section class=\"container d-flex flex-nowrap\" id=\"menu-content\" role=\"menu\">\n			<button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\" data-target=\"#menu\" aria-controls=\"menu\" aria-expanded=\"false\" aria-label=\"Toggle navigation\"><i class=\"fa fa-bars\"></i></button>\n			<cubo:module name=\"logo\" content=\"\" /><cubo:module name=\"menu\" content=\"\" />\n			<div class=\"ml-auto\"><cubo:module name=\"user\" content=\"\" /></div>\n		</section>\n	</nav>\n	<header id=\"header\">\n		<section id=\"header-content\" role=\"info\">\n			<cubo:module name=\"header\" content=\"\" />\n		</section>\n	</header>\n	<section id=\"message\">\n		<section class=\"container\" id=\"message-content\" role=\"message\">\n			<cubo:message />\n		</div>\n	</section>\n	<main id=\"main\">\n		<section class=\"container\" id=\"main-content\" role=\"main\">\n			<cubo:content />\n		</section>\n	</main>\n	<footer id=\"footer\" class=\"bg-inverse fixed-bottom\">\n		<section id=\"footer-content\" role=\"info\">\n			<cubo:module name=\"footer\" content=\"\" />\n		</section>\n	</footer>\n</body>\n</html>','1968-12-10 00:00:00','Default Cubo CMS template',NULL,NULL,'1968-12-10 00:00:00',1,NULL,1,'@import url(\'https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab|Roboto+Condensed|Exo\');\r\n\r\n/* Customizations */\r\n\r\nbody {\r\n	font-family: \'Roboto\',sans-serif;\r\n}\r\n\r\nbody.has-fixed-nav {\r\n	margin-top: 4rem;\r\n}\r\n.navbar {\r\n	flex-wrap: nowrap;\r\n}\r\n.navbar.fixed-top {\r\n	height: 4rem;\r\n}\r\n.navbar-brand .brand-logo {\r\n	display: inline-block;\r\n	max-height: 3rem;\r\n	-webkit-transition: -webkit-transform .5s ease-in-out;\r\n	transition: transform .5s ease-in-out;\r\n}\r\n.navbar-brand:hover .brand-logo {\r\n	-webkit-transform: rotate(360deg);\r\n	transform: rotate(360deg);\r\n}\r\n.navbar-brand .brand-name {\r\n	font-family: \'Exo\',\'Roboto\',sans-serif;\r\n	padding-left: .5rem;\r\n	vertical-align: middle;\r\n	font-size: 1.5rem;\r\n}\r\n.navbar-user {\r\n	width: 3rem;\r\n	height: 3rem;\r\n	-webkit-transition: -webkit-transform 1s ease-in-out;\r\n	transition: transform 1s ease-in-out;\r\n}\r\n.navbar-user > *:first-child {\r\n	display: flex;\r\n	justify-content: center;\r\n	align-items: center;\r\n	border-radius: 50%;\r\n	overflow: hidden;\r\n	width: 100%;\r\n	height: 100%;\r\n	font-size: 1.25rem;\r\n	background-color: rgba(255,255,255,.25);\r\n}\r\n.navbar-user:hover > *:first-child {\r\n	font-size: 1.5rem;\r\n}\r\n.navbar-user:hover img:first-child {\r\n	transform: scale(1.2);\r\n}\r\n\r\nh1, h2, h3, h4, h5, h6 {\r\n	font-family: \'Roboto Slab\',serif;\r\n}\r\n\r\n/* Minor stylistic adjustments */\r\n\r\n.navbar-dark a {\r\n	color: rgba(255,255,255,.75);\r\n}\r\n.navbar-dark a:hover,.navbar-dark a:focus {\r\n	color: white;\r\n}\r\n.navbar-dark .dropdown-menu a {\r\n	color: inherit;\r\n}\r\nlabel {\r\n	margin: 0;\r\n	font-family: \'Roboto Condensed\',sans-serif;\r\n	font-size: small;\r\n	font-style: italic;\r\n}\r\ntextarea {\r\n	padding-top: calc(.375rem + 1px);\r\n}\r\ntextarea.text-html {\r\n	font-family: monospace;\r\n}\r\nbutton {\r\n	cursor: pointer;\r\n}\r\nfigure {\r\n	margin: .125rem;\r\n}\r\nfigcaption {\r\n	font-size: smaller;\r\n	font-style: italic;\r\n	text-align: center;\r\n}\r\nselect.form-control-sm {\r\n	height: calc(1.8125rem + 2px) !important;\r\n}\r\n.custom-file-control:before {\r\n	content: \"\\f002\" !important;\r\n	font-family: FontAwesome !important;\r\n	font-size: 1rem;\r\n	font-style: normal;\r\n	background: #ff7518;\r\n	border: none;\r\n}\r\n\r\n.img-selectable img {\r\n	opacity: .75;\r\n	-webkit-opacity: .75;\r\n}\r\n.img-selectable:hover {\r\n	cursor: pointer;\r\n}\r\n.img-selectable:hover img {\r\n	opacity: 1;\r\n	-webkit-opacity: 1;\r\n}\r\n\r\n@media(min-width: 992px) {\r\n	.navbar-toggleable-md .navbar-collapse {\r\n		display: -webkit-box!important;\r\n		display: -webkit-flex!important;\r\n		display: -ms-flexbox!important;\r\n		display: flex!important;\r\n		width: 100%;\r\n	}\r\n	.navbar-toggleable-md .navbar-toggler {\r\n		display: none;\r\n	}\r\n}\r\n\r\n[data-toggle=collapse] {\r\n	text-decoration: none;\r\n	display: flex;\r\n}\r\n[data-toggle=collapse][aria-expanded=false]:after {\r\n	content: \'\\25BC\';\r\n	font-size: .5rem;\r\n	margin: 0 0 0 auto;\r\n	line-height: 1.4rem;\r\n}\r\n[data-toggle=collapse][aria-expanded=true]:after {\r\n	content: \'\\25B2\';\r\n	font-size: .5rem;\r\n	margin: 0 0 0 auto;\r\n	line-height: 1.4rem;\r\n}\r\n\r\n.align-middle {\r\n	align-self: center;\r\n}\r\n.btn-sm, .btn-group-sm > .btn {\r\n	margin: 0 .25rem;\r\n}\r\n.grid-columns {\r\n	display: grid;\r\n	grid-auto-columns: 1fr;\r\n	grid-auto-flow: column;\r\n	grid-column-gap: .5rem;\r\n}\r\n.grid-wrap-8 {\r\n	display: grid;\r\n	grid-template-columns: repeat(8,1fr);\r\n}\r\n.grid-column-2 {\r\n	grid-column: span 2;\r\n}\r\n.row-header {\r\n	border-top: solid 1px silver;\r\n	border-bottom: solid 1px silver;\r\n	padding-top: .5rem;\r\n	padding-bottom: .5rem;\r\n}\r\n.row-body {\r\n	border-bottom: solid 1px silver;\r\n	padding-top: .5rem;\r\n	padding-bottom: .5rem;\r\n}\r\n.grid-rows {\r\n	display: grid;\r\n	grid-auto-rows: auto;\r\n	grid-auto-flow: row;\r\n	grid-column-gap: .5rem;\r\n}','Default');
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

-- Dump completed on 2019-02-21 15:22:47
