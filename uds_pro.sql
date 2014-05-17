-- MySQL dump 10.13  Distrib 5.5.28, for Win64 (x86)
--
-- Host: localhost    Database: uds
-- ------------------------------------------------------
-- Server version	5.5.28

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

CREATE DATABASE IF NOT EXISTS uds;

--
-- Table structure for table `acos`
--

DROP TABLE IF EXISTS `acos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=303 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acos`
--

LOCK TABLES `acos` WRITE;
/*!40000 ALTER TABLE `acos` DISABLE KEYS */;
INSERT INTO `acos` VALUES (173,NULL,NULL,NULL,'controllers',1,260),(174,173,NULL,NULL,'Accesses',2,15),(175,174,NULL,NULL,'index',3,4),(176,174,NULL,NULL,'view',5,6),(177,174,NULL,NULL,'add',7,8),(178,174,NULL,NULL,'edit',9,10),(179,174,NULL,NULL,'delete',11,12),(180,174,NULL,NULL,'debug',13,14),(181,173,NULL,NULL,'Agencies',16,29),(182,181,NULL,NULL,'index',17,18),(183,181,NULL,NULL,'view',19,20),(184,181,NULL,NULL,'add',21,22),(185,181,NULL,NULL,'edit',23,24),(186,181,NULL,NULL,'delete',25,26),(187,181,NULL,NULL,'debug',27,28),(188,173,NULL,NULL,'Attributes',30,43),(189,188,NULL,NULL,'index',31,32),(190,188,NULL,NULL,'view',33,34),(191,188,NULL,NULL,'add',35,36),(192,188,NULL,NULL,'edit',37,38),(193,188,NULL,NULL,'delete',39,40),(194,188,NULL,NULL,'debug',41,42),(195,173,NULL,NULL,'EntityAttributeValues',44,57),(196,195,NULL,NULL,'index',45,46),(197,195,NULL,NULL,'view',47,48),(198,195,NULL,NULL,'add',49,50),(199,195,NULL,NULL,'edit',51,52),(200,195,NULL,NULL,'delete',53,54),(201,195,NULL,NULL,'debug',55,56),(202,173,NULL,NULL,'Experiments',58,71),(203,202,NULL,NULL,'index',59,60),(204,202,NULL,NULL,'view',61,62),(205,202,NULL,NULL,'add',63,64),(206,202,NULL,NULL,'edit',65,66),(207,202,NULL,NULL,'delete',67,68),(208,202,NULL,NULL,'debug',69,70),(209,173,NULL,NULL,'Grants',72,85),(210,209,NULL,NULL,'index',73,74),(211,209,NULL,NULL,'view',75,76),(212,209,NULL,NULL,'add',77,78),(213,209,NULL,NULL,'edit',79,80),(214,209,NULL,NULL,'delete',81,82),(215,209,NULL,NULL,'debug',83,84),(216,173,NULL,NULL,'Pages',86,93),(217,216,NULL,NULL,'display',87,88),(218,216,NULL,NULL,'show_excel',89,90),(219,216,NULL,NULL,'debug',91,92),(220,173,NULL,NULL,'Participants',94,107),(221,220,NULL,NULL,'index',95,96),(222,220,NULL,NULL,'view',97,98),(223,220,NULL,NULL,'add',99,100),(224,220,NULL,NULL,'edit',101,102),(225,220,NULL,NULL,'delete',103,104),(226,220,NULL,NULL,'debug',105,106),(227,173,NULL,NULL,'Projects',108,121),(228,227,NULL,NULL,'index',109,110),(229,227,NULL,NULL,'view',111,112),(230,227,NULL,NULL,'add',113,114),(231,227,NULL,NULL,'edit',115,116),(232,227,NULL,NULL,'delete',117,118),(233,227,NULL,NULL,'debug',119,120),(234,173,NULL,NULL,'Responses',122,135),(235,234,NULL,NULL,'index',123,124),(236,234,NULL,NULL,'view',125,126),(237,234,NULL,NULL,'add',127,128),(238,234,NULL,NULL,'edit',129,130),(239,234,NULL,NULL,'delete',131,132),(240,234,NULL,NULL,'debug',133,134),(241,173,NULL,NULL,'Roles',136,149),(242,241,NULL,NULL,'index',137,138),(243,241,NULL,NULL,'view',139,140),(244,241,NULL,NULL,'add',141,142),(245,241,NULL,NULL,'edit',143,144),(246,241,NULL,NULL,'delete',145,146),(247,241,NULL,NULL,'debug',147,148),(248,173,NULL,NULL,'Stimuli',150,163),(249,248,NULL,NULL,'index',151,152),(250,248,NULL,NULL,'view',153,154),(251,248,NULL,NULL,'add',155,156),(252,248,NULL,NULL,'edit',157,158),(253,248,NULL,NULL,'delete',159,160),(254,248,NULL,NULL,'debug',161,162),(255,173,NULL,NULL,'StimulusCategories',164,177),(256,255,NULL,NULL,'index',165,166),(257,255,NULL,NULL,'view',167,168),(258,255,NULL,NULL,'add',169,170),(259,255,NULL,NULL,'edit',171,172),(260,255,NULL,NULL,'delete',173,174),(261,255,NULL,NULL,'debug',175,176),(262,173,NULL,NULL,'StimulusConditions',178,191),(263,262,NULL,NULL,'index',179,180),(264,262,NULL,NULL,'view',181,182),(265,262,NULL,NULL,'add',183,184),(266,262,NULL,NULL,'edit',185,186),(267,262,NULL,NULL,'delete',187,188),(268,262,NULL,NULL,'debug',189,190),(269,173,NULL,NULL,'Uploads',192,207),(270,269,NULL,NULL,'index',193,194),(271,269,NULL,NULL,'handler',195,196),(272,269,NULL,NULL,'getColumns',197,198),(273,269,NULL,NULL,'map',199,200),(274,269,NULL,NULL,'sse',201,202),(275,269,NULL,NULL,'test',203,204),(276,269,NULL,NULL,'debug',205,206),(277,173,NULL,NULL,'Users',208,225),(278,277,NULL,NULL,'login',209,210),(279,277,NULL,NULL,'logout',211,212),(280,277,NULL,NULL,'index',213,214),(281,277,NULL,NULL,'view',215,216),(282,277,NULL,NULL,'add',217,218),(283,277,NULL,NULL,'edit',219,220),(284,277,NULL,NULL,'delete',221,222),(285,277,NULL,NULL,'debug',223,224),(286,173,NULL,NULL,'AclExtras',226,227),(287,173,NULL,NULL,'AjaxMultiUpload',228,245),(288,287,NULL,NULL,'Uploads',229,244),(289,288,NULL,NULL,'index',230,231),(290,288,NULL,NULL,'handler',232,233),(291,288,NULL,NULL,'getColumns',234,235),(292,288,NULL,NULL,'map',236,237),(293,288,NULL,NULL,'sse',238,239),(294,288,NULL,NULL,'test',240,241),(295,288,NULL,NULL,'debug',242,243),(296,173,NULL,NULL,'FileUpload',246,259),(297,296,NULL,NULL,'FileUpload',247,252),(298,297,NULL,NULL,'index',248,249),(299,297,NULL,NULL,'debug',250,251),(300,296,NULL,NULL,'Handler',253,258),(301,300,NULL,NULL,'index',254,255),(302,300,NULL,NULL,'debug',256,257);
/*!40000 ALTER TABLE `acos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `request` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `controller` varchar(90) DEFAULT NULL,
  `action` varchar(90) DEFAULT NULL,
  `user_browser` varchar(255) DEFAULT NULL,
  `clicked_from` varchar(255) DEFAULT NULL,
  `user_ip` varchar(15) DEFAULT NULL,
  `project_id` varchar(45) DEFAULT NULL,
  `experiment_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2566 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `meta_key` varchar(255) NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `agencies`
--

DROP TABLE IF EXISTS `agencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agencies` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `qid` int(11) NOT NULL,
  `version` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `aros`
--

DROP TABLE IF EXISTS `aros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros`
--

LOCK TABLES `aros` WRITE;
/*!40000 ALTER TABLE `aros` DISABLE KEYS */;
INSERT INTO `aros` VALUES (1,NULL,'Role',1,'',1,10),(2,NULL,'Role',2,'',11,50),(3,NULL,'Role',3,'',51,102),(4,NULL,'Role',4,'',103,110),(6,1,'User',2,'',2,3),(7,2,'User',3,'',12,13),(8,3,'User',4,'',52,53),(9,4,'User',5,'',104,105),(10,3,'User',6,'',62,63),(11,2,'User',7,'',14,15),(12,1,'User',6,'',4,5),(13,2,'User',7,'',16,17),(14,2,'User',1,'',18,19),(15,1,'User',2,'',6,7),(16,3,'User',3,'',54,55),(17,4,'User',4,'',106,107),(18,2,'User',5,'',20,21),(19,2,'User',6,'',22,23),(20,2,'User',7,'',24,25),(21,2,'User',1,'',26,27),(22,1,'User',2,'',8,9),(23,3,'User',3,'',56,57),(24,4,'User',4,'',108,109),(25,3,'User',5,'',58,59),(26,3,'User',6,'',60,61),(27,2,'User',7,'',28,29),(28,2,'User',8,'',30,31),(29,3,'User',9,'',64,65),(30,3,'User',10,'',66,67),(31,3,'User',11,'',68,69),(32,3,'User',12,'',70,71),(33,3,'User',13,'',72,73),(34,3,'User',14,'',74,75),(35,3,'User',15,'',76,77),(36,3,'User',16,'',78,79),(37,3,'User',17,'',80,81),(38,3,'User',18,'',82,83),(39,3,'User',19,'',84,85),(40,3,'User',20,'',86,87),(41,3,'User',21,'',88,89),(42,2,'User',22,'',32,33),(43,2,'User',23,'',34,35),(44,2,'User',24,'',36,37),(45,2,'User',25,'',38,39),(46,2,'User',26,'',40,41),(47,2,'User',27,'',42,43),(48,3,'User',28,'',90,91),(49,3,'User',29,'',92,93),(50,2,'User',30,'',44,45),(51,3,'User',31,'',94,95),(52,3,'User',32,'',96,97),(53,2,'User',33,'',46,47),(54,3,'User',34,'',98,99),(55,3,'User',35,'',100,101),(56,2,'User',36,'',48,49);
/*!40000 ALTER TABLE `aros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aros_acos`
--

DROP TABLE IF EXISTS `aros_acos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aros_acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) unsigned NOT NULL,
  `aco_id` int(10) unsigned NOT NULL,
  `_create` char(2) NOT NULL DEFAULT '0',
  `_read` char(2) NOT NULL DEFAULT '0',
  `_update` char(2) NOT NULL DEFAULT '0',
  `_delete` char(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros_acos`
--

LOCK TABLES `aros_acos` WRITE;
/*!40000 ALTER TABLE `aros_acos` DISABLE KEYS */;
INSERT INTO `aros_acos` VALUES (1,1,173,'1','1','1','1'),(2,2,173,'-1','-1','-1','-1'),(3,2,227,'1','1','1','1'),(4,2,202,'1','1','1','1'),(5,2,277,'1','1','1','1'),(6,3,173,'-1','-1','-1','-1'),(7,3,230,'1','1','1','1'),(8,3,231,'1','1','1','1'),(9,3,205,'1','1','1','1'),(10,3,206,'1','1','1','1'),(11,4,173,'-1','-1','-1','-1'),(12,4,229,'1','1','1','1'),(13,4,204,'1','1','1','1'),(14,2,281,'1','1','1','1'),(15,2,174,'1','1','1','1'),(16,2,248,'1','1','1','1'),(17,2,234,'1','1','1','1'),(18,2,269,'1','1','1','1'),(19,3,229,'1','1','1','1'),(20,3,204,'1','1','1','1'),(21,3,250,'1','1','1','1'),(22,3,236,'1','1','1','1'),(23,3,269,'1','1','1','1'),(24,3,281,'1','1','1','1'),(25,4,250,'1','1','1','1'),(26,4,236,'1','1','1','1'),(27,2,220,'1','1','1','1'),(28,3,222,'1','1','1','1'),(29,2,280,'1','1','1','1'),(30,3,228,'1','1','1','1'),(31,3,203,'1','1','1','1'),(32,3,221,'1','1','1','1'),(33,3,249,'1','1','1','1'),(34,3,235,'1','1','1','1'),(35,3,280,'1','1','1','1'),(36,4,228,'1','1','1','1'),(37,4,203,'1','1','1','1'),(38,4,249,'1','1','1','1'),(39,4,235,'1','1','1','1'),(40,2,279,'1','1','1','1'),(41,2,188,'1','1','1','1'),(42,3,279,'1','1','1','1'),(43,3,190,'1','1','1','1'),(44,4,279,'1','1','1','1'),(45,3,189,'1','1','1','1');
/*!40000 ALTER TABLE `aros_acos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attributes`
--

DROP TABLE IF EXISTS `attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attributes` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(8) NOT NULL,
  `experiment_id` int(8) unsigned DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `display` tinyint(1) DEFAULT '1',
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=163 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `entity_attribute_values`
--

DROP TABLE IF EXISTS `entity_attribute_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity_attribute_values` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entity_id` int(5) DEFAULT NULL,
  `attribute_id` int(5) DEFAULT NULL,
  `value` text,
  `entity_type` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=160056 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `experiments`
--

DROP TABLE IF EXISTS `experiments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `experiments` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `description` text,
  `project_id` int(8) unsigned NOT NULL,
  `start_time` date DEFAULT NULL,
  `end_time` date DEFAULT NULL,
  `experiment_design` text,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `grants`
--

DROP TABLE IF EXISTS `grants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grants` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `description` text,
  `agency_id` int(5) unsigned NOT NULL,
  `start_time` date DEFAULT NULL,
  `end_time` date DEFAULT NULL,
  `user_id` int(8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `xagenc` (`agency_id`),
  KEY `xpers` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `participants`
--

DROP TABLE IF EXISTS `participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `participants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) NOT NULL,
  `project_id` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15449 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `privileges`
--

DROP TABLE IF EXISTS `privileges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `privileges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(8) NOT NULL,
  `project_id` int(8) NOT NULL,
  `experiment_id` int(8) NOT NULL,
  `start_time` date DEFAULT NULL,
  `end_time` date DEFAULT NULL,
  `role_id` int(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `experiment_id` (`experiment_id`),
  KEY `role_id` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `description` text,
  `start_time` date DEFAULT NULL,
  `end_time` date DEFAULT NULL,
  `user_id` int(8) NOT NULL,
  `grant_id` int(8) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `qid` int(11) DEFAULT NULL,
  `version` int(11) DEFAULT NULL,
  `question` text NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=139 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `responses`
--

DROP TABLE IF EXISTS `responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `responses` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `experiment_id` int(8) unsigned NOT NULL,
  `participant_id` int(10) unsigned NOT NULL,
  `stimulus_id` int(5) unsigned DEFAULT NULL,
  `response_value` text,
  `date_entered` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `experiment_id` (`experiment_id`),
  KEY `participant_id` (`participant_id`),
  KEY `stimulus_id` (`stimulus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=307337 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','System administrator'),(2,'PI','A Principal Investigator (PI) has full ownership of the data for the whole project; A PI has all privileges of suboridinate roles.'),(3,'Researcher','A Researcher will be assigned by the project\'s PI owining the project to handle all data about a given experiment of the project.'),(4,'Visitor','A visitor can only view data for an experiment when granted explcit access privileges by the owner PI.');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stimuli`
--

DROP TABLE IF EXISTS `stimuli`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stimuli` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `experiment_id` int(8) NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1764 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `uploads`
--

DROP TABLE IF EXISTS `uploads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `project_id` int(8) unsigned NOT NULL,
  `experiment_id` int(8) unsigned DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=499 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `role_id` int(8) DEFAULT '3',
  `status` tinyint(1) DEFAULT '0',
  `race` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `lang` varchar(45) DEFAULT 'en',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-09-23 21:32:53
