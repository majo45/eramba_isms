-- MySQL dump 10.13  Distrib 5.5.15, for osx10.6 (i386)
--
-- Host: localhost    Database: isms_v2
-- ------------------------------------------------------
-- Server version	5.5.15

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
-- Table structure for table `asset_classification_join`
--

DROP TABLE IF EXISTS `asset_classification_join`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asset_classification_join` (
  `asset_classification_join_asset_id` int(11) DEFAULT NULL,
  `asset_classification_join_asset_classification_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_classification_join`
--

LOCK TABLES `asset_classification_join` WRITE;
/*!40000 ALTER TABLE `asset_classification_join` DISABLE KEYS */;
/*!40000 ALTER TABLE `asset_classification_join` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asset_classification_tbl`
--

DROP TABLE IF EXISTS `asset_classification_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asset_classification_tbl` (
  `asset_classification_id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_classification_name` varchar(100) DEFAULT NULL,
  `asset_classification_criteria` text,
  `asset_classification_type` varchar(45) DEFAULT NULL,
  `asset_classification_value` int(11) DEFAULT NULL,
  `asset_classification_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`asset_classification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_classification_tbl`
--

LOCK TABLES `asset_classification_tbl` WRITE;
/*!40000 ALTER TABLE `asset_classification_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `asset_classification_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asset_dashboard_tbl`
--

DROP TABLE IF EXISTS `asset_dashboard_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asset_dashboard_tbl` (
  `asset_dashboard_id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_dashboard_type_data_asset` int(11) DEFAULT NULL,
  `asset_dashboard_type_human_asset` int(11) DEFAULT NULL,
  `asset_dashboard_type_information` int(11) DEFAULT NULL,
  `asset_dashboard_date` date DEFAULT NULL,
  `asset_dashboard_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`asset_dashboard_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_dashboard_tbl`
--

LOCK TABLES `asset_dashboard_tbl` WRITE;
/*!40000 ALTER TABLE `asset_dashboard_tbl` DISABLE KEYS */;
INSERT INTO `asset_dashboard_tbl` VALUES (2,0,0,0,'2013-01-02',0);
/*!40000 ALTER TABLE `asset_dashboard_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asset_media_type_tbl`
--

DROP TABLE IF EXISTS `asset_media_type_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asset_media_type_tbl` (
  `asset_media_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asset_media_type_name` varchar(100) DEFAULT NULL,
  `asset_media_type_disabled` int(11) DEFAULT NULL,
  PRIMARY KEY (`asset_media_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_media_type_tbl`
--

LOCK TABLES `asset_media_type_tbl` WRITE;
/*!40000 ALTER TABLE `asset_media_type_tbl` DISABLE KEYS */;
INSERT INTO `asset_media_type_tbl` VALUES (1,'Data Asset',0),(2,'Information System Asset',0),(3,'Human Assets',0);
/*!40000 ALTER TABLE `asset_media_type_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asset_tbl`
--

DROP TABLE IF EXISTS `asset_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asset_tbl` (
  `asset_id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_name` varchar(100) DEFAULT NULL,
  `asset_description` text,
  `asset_media_type_id` int(11) DEFAULT NULL,
  `asset_legal_id` int(11) DEFAULT NULL,
  `asset_owner_id` int(11) DEFAULT NULL,
  `asset_guardian_id` int(11) DEFAULT NULL,
  `asset_user_id` int(11) DEFAULT NULL,
  `asset_container_id` int(11) DEFAULT NULL,
  `asset_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`asset_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_tbl`
--

LOCK TABLES `asset_tbl` WRITE;
/*!40000 ALTER TABLE `asset_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `asset_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bu_tbl`
--

DROP TABLE IF EXISTS `bu_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bu_tbl` (
  `bu_id` int(11) NOT NULL AUTO_INCREMENT,
  `bu_name` varchar(100) DEFAULT NULL,
  `bu_description` text,
  `bu_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`bu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bu_tbl`
--

LOCK TABLES `bu_tbl` WRITE;
/*!40000 ALTER TABLE `bu_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `bu_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compliance_dashboard_tbl`
--

DROP TABLE IF EXISTS `compliance_dashboard_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compliance_dashboard_tbl` (
  `compliance_dashboard_id` int(11) NOT NULL AUTO_INCREMENT,
  `compliance_dashboard_comp_items` int(11) DEFAULT NULL,
  `compliance_dashboard_strategy_mitigate` int(11) DEFAULT NULL,
  `compliance_dashboard_strategy_na` int(11) DEFAULT NULL,
  `compliance_dashboard_status_ongoing` int(11) DEFAULT NULL,
  `compliance_dashboard_status_compliant` int(11) DEFAULT NULL,
  `compliance_dashboard_status_noncomp` int(11) DEFAULT NULL,
  `compliance_dashboard_status_na` int(11) DEFAULT NULL,
  `compliance_dashboard_date` date DEFAULT NULL,
  `compliance_dashboard_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`compliance_dashboard_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compliance_dashboard_tbl`
--

LOCK TABLES `compliance_dashboard_tbl` WRITE;
/*!40000 ALTER TABLE `compliance_dashboard_tbl` DISABLE KEYS */;
INSERT INTO `compliance_dashboard_tbl` VALUES (4,0,0,0,0,0,0,0,'2013-01-02',0);
/*!40000 ALTER TABLE `compliance_dashboard_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compliance_exception_tbl`
--

DROP TABLE IF EXISTS `compliance_exception_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compliance_exception_tbl` (
  `compliance_exception_id` int(11) NOT NULL AUTO_INCREMENT,
  `compliance_exception_title` varchar(100) DEFAULT NULL,
  `compliance_exception_description` text,
  `compliance_exception_author` varchar(100) DEFAULT NULL,
  `compliance_exception_expiration` date DEFAULT NULL,
  `compliance_exception_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`compliance_exception_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compliance_exception_tbl`
--

LOCK TABLES `compliance_exception_tbl` WRITE;
/*!40000 ALTER TABLE `compliance_exception_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `compliance_exception_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compliance_management_tbl`
--

DROP TABLE IF EXISTS `compliance_management_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compliance_management_tbl` (
  `compliance_management_id` int(11) NOT NULL AUTO_INCREMENT,
  `compliance_management_item_id` int(11) DEFAULT NULL,
  `compliance_management_response_id` int(11) DEFAULT NULL,
  `compliance_management_status_id` int(11) DEFAULT NULL,
  `compliance_management_exception_id` int(11) DEFAULT NULL,
  `compliance_management_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`compliance_management_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compliance_management_tbl`
--

LOCK TABLES `compliance_management_tbl` WRITE;
/*!40000 ALTER TABLE `compliance_management_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `compliance_management_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compliance_package_item_tbl`
--

DROP TABLE IF EXISTS `compliance_package_item_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compliance_package_item_tbl` (
  `compliance_package_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `compliance_package_id` int(11) DEFAULT NULL,
  `compliance_package_item_original_id` varchar(45) DEFAULT NULL,
  `compliance_package_item_name` varchar(100) DEFAULT NULL,
  `compliance_package_item_description` text,
  `compliance_package_item_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`compliance_package_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compliance_package_item_tbl`
--

LOCK TABLES `compliance_package_item_tbl` WRITE;
/*!40000 ALTER TABLE `compliance_package_item_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `compliance_package_item_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compliance_package_tbl`
--

DROP TABLE IF EXISTS `compliance_package_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compliance_package_tbl` (
  `compliance_package_id` int(11) NOT NULL AUTO_INCREMENT,
  `compliance_package_tp_id` int(11) DEFAULT NULL,
  `compliance_package_original_id` varchar(45) DEFAULT NULL,
  `compliance_package_name` varchar(100) DEFAULT NULL,
  `compliance_package_description` text,
  `compliance_package_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`compliance_package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compliance_package_tbl`
--

LOCK TABLES `compliance_package_tbl` WRITE;
/*!40000 ALTER TABLE `compliance_package_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `compliance_package_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compliance_response_strategy_tbl`
--

DROP TABLE IF EXISTS `compliance_response_strategy_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compliance_response_strategy_tbl` (
  `compliance_response_strategy_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `compliance_response_strategy_name` varchar(100) DEFAULT NULL,
  `compliance_response_strategy_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`compliance_response_strategy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compliance_response_strategy_tbl`
--

LOCK TABLES `compliance_response_strategy_tbl` WRITE;
/*!40000 ALTER TABLE `compliance_response_strategy_tbl` DISABLE KEYS */;
INSERT INTO `compliance_response_strategy_tbl` VALUES (1,'Mitigate',0),(2,'Not Applicable',0);
/*!40000 ALTER TABLE `compliance_response_strategy_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compliance_security_services_join`
--

DROP TABLE IF EXISTS `compliance_security_services_join`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compliance_security_services_join` (
  `compliance_security_services_join_compliance_id` int(11) DEFAULT NULL,
  `compliance_security_services_join_security_services_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compliance_security_services_join`
--

LOCK TABLES `compliance_security_services_join` WRITE;
/*!40000 ALTER TABLE `compliance_security_services_join` DISABLE KEYS */;
/*!40000 ALTER TABLE `compliance_security_services_join` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compliance_status_tbl`
--

DROP TABLE IF EXISTS `compliance_status_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compliance_status_tbl` (
  `compliance_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `compliance_status_name` varchar(100) DEFAULT NULL,
  `compliance_status_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`compliance_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compliance_status_tbl`
--

LOCK TABLES `compliance_status_tbl` WRITE;
/*!40000 ALTER TABLE `compliance_status_tbl` DISABLE KEYS */;
INSERT INTO `compliance_status_tbl` VALUES (1,'On-Going',0),(2,'Compliant',0),(3,'Non-Compliant',0),(4,'Not-Applicable',0);
/*!40000 ALTER TABLE `compliance_status_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_asset_security_services_join`
--

DROP TABLE IF EXISTS `data_asset_security_services_join`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_asset_security_services_join` (
  `data_asset_security_services_join_data_asset_id` int(11) DEFAULT NULL,
  `data_asset_security_services_join_security_services_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_asset_security_services_join`
--

LOCK TABLES `data_asset_security_services_join` WRITE;
/*!40000 ALTER TABLE `data_asset_security_services_join` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_asset_security_services_join` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_asset_status_tbl`
--

DROP TABLE IF EXISTS `data_asset_status_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_asset_status_tbl` (
  `data_asset_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `data_asset_status_name` varchar(100) DEFAULT NULL,
  `data_asset_status_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`data_asset_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_asset_status_tbl`
--

LOCK TABLES `data_asset_status_tbl` WRITE;
/*!40000 ALTER TABLE `data_asset_status_tbl` DISABLE KEYS */;
INSERT INTO `data_asset_status_tbl` VALUES (1,'Created',0),(2,'Modified',0),(3,'Stored',0),(4,'Transit',0),(5,'Deleted',0),(6,'Tainted / Broken',0),(7,'Unnecessary',0);
/*!40000 ALTER TABLE `data_asset_status_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_asset_tbl`
--

DROP TABLE IF EXISTS `data_asset_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_asset_tbl` (
  `data_asset_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_asset_asset_id` int(11) DEFAULT NULL,
  `data_asset_status_id` int(11) DEFAULT NULL,
  `data_asset_description` text,
  `data_asset_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`data_asset_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_asset_tbl`
--

LOCK TABLES `data_asset_tbl` WRITE;
/*!40000 ALTER TABLE `data_asset_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_asset_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legal_tbl`
--

DROP TABLE IF EXISTS `legal_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `legal_tbl` (
  `legal_id` int(11) NOT NULL AUTO_INCREMENT,
  `legal_name` varchar(100) DEFAULT NULL,
  `legal_description` text,
  `legal_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`legal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legal_tbl`
--

LOCK TABLES `legal_tbl` WRITE;
/*!40000 ALTER TABLE `legal_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `legal_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `process_legal_join`
--

DROP TABLE IF EXISTS `process_legal_join`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `process_legal_join` (
  `process_legal_join_id` int(11) NOT NULL AUTO_INCREMENT,
  `process_id` int(11) DEFAULT NULL,
  `legal_id` int(11) DEFAULT NULL,
  `process_legal_join_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`process_legal_join_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `process_legal_join`
--

LOCK TABLES `process_legal_join` WRITE;
/*!40000 ALTER TABLE `process_legal_join` DISABLE KEYS */;
/*!40000 ALTER TABLE `process_legal_join` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `process_tbl`
--

DROP TABLE IF EXISTS `process_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `process_tbl` (
  `process_id` int(11) NOT NULL AUTO_INCREMENT,
  `process_name` varchar(100) DEFAULT NULL,
  `bu_id` int(11) DEFAULT NULL,
  `process_description` text,
  `process_rto` int(11) DEFAULT NULL,
  `process_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`process_id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `process_tbl`
--

LOCK TABLES `process_tbl` WRITE;
/*!40000 ALTER TABLE `process_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `process_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_improvements_status_tbl`
--

DROP TABLE IF EXISTS `project_improvements_status_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_improvements_status_tbl` (
  `project_improvements_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_improvements_status_name` varchar(45) DEFAULT NULL,
  `project_improvements_status_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`project_improvements_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_improvements_status_tbl`
--

LOCK TABLES `project_improvements_status_tbl` WRITE;
/*!40000 ALTER TABLE `project_improvements_status_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_improvements_status_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_improvements_tbl`
--

DROP TABLE IF EXISTS `project_improvements_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_improvements_tbl` (
  `project_improvements_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_improvements_title` varchar(100) DEFAULT NULL,
  `project_improvements_goal` text,
  `project_improvements_start` date DEFAULT NULL,
  `project_improvements_deadline` date DEFAULT NULL,
  `project_improvements_status_id` int(11) DEFAULT NULL,
  `project_improvements_source_section` varchar(45) DEFAULT NULL,
  `project_improvements_source_subsection` varchar(45) DEFAULT NULL,
  `project_improvements_source_item_id` int(11) DEFAULT NULL,
  `project_improvements_owner_id` char(100) DEFAULT 'Undefined',
  `project_improvements_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`project_improvements_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_improvements_tbl`
--

LOCK TABLES `project_improvements_tbl` WRITE;
/*!40000 ALTER TABLE `project_improvements_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_improvements_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `risk_asset_join`
--

DROP TABLE IF EXISTS `risk_asset_join`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `risk_asset_join` (
  `risk_asset_join_risk_id` int(11) NOT NULL,
  `risk_asset_join_asset_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`risk_asset_join_risk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `risk_asset_join`
--

LOCK TABLES `risk_asset_join` WRITE;
/*!40000 ALTER TABLE `risk_asset_join` DISABLE KEYS */;
/*!40000 ALTER TABLE `risk_asset_join` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `risk_classification_join`
--

DROP TABLE IF EXISTS `risk_classification_join`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `risk_classification_join` (
  `risk_classification_join_risk_id` int(11) DEFAULT NULL,
  `risk_classification_join_risk_classification_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `risk_classification_join`
--

LOCK TABLES `risk_classification_join` WRITE;
/*!40000 ALTER TABLE `risk_classification_join` DISABLE KEYS */;
/*!40000 ALTER TABLE `risk_classification_join` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `risk_classification_tbl`
--

DROP TABLE IF EXISTS `risk_classification_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `risk_classification_tbl` (
  `risk_classification_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `risk_classification_name` varchar(100) DEFAULT NULL,
  `risk_classification_criteria` text,
  `risk_classification_type` varchar(45) DEFAULT NULL,
  `risk_classification_value` int(11) DEFAULT NULL,
  `risk_classification_disabled` int(11) DEFAULT NULL,
  PRIMARY KEY (`risk_classification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `risk_classification_tbl`
--

LOCK TABLES `risk_classification_tbl` WRITE;
/*!40000 ALTER TABLE `risk_classification_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `risk_classification_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `risk_dashboard_tbl`
--

DROP TABLE IF EXISTS `risk_dashboard_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `risk_dashboard_tbl` (
  `risk_dashboard_id` int(11) NOT NULL AUTO_INCREMENT,
  `risk_dashboard_risk_score` int(11) DEFAULT NULL,
  `risk_dashboard_risk_residual_score` int(11) DEFAULT NULL,
  `risk_dashboard_date` date DEFAULT NULL,
  `risk_dashboard_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`risk_dashboard_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `risk_dashboard_tbl`
--

LOCK TABLES `risk_dashboard_tbl` WRITE;
/*!40000 ALTER TABLE `risk_dashboard_tbl` DISABLE KEYS */;
INSERT INTO `risk_dashboard_tbl` VALUES (2,0,0,'2013-01-02',0);
/*!40000 ALTER TABLE `risk_dashboard_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `risk_exception_tbl`
--

DROP TABLE IF EXISTS `risk_exception_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `risk_exception_tbl` (
  `risk_exception_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `risk_exception_title` varchar(100) DEFAULT NULL,
  `risk_exception_description` text,
  `risk_exception_author` varchar(100) DEFAULT NULL,
  `risk_exception_expiration` date DEFAULT NULL,
  `risk_exception_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`risk_exception_id`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `risk_exception_tbl`
--

LOCK TABLES `risk_exception_tbl` WRITE;
/*!40000 ALTER TABLE `risk_exception_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `risk_exception_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `risk_mitigation_strategy_tbl`
--

DROP TABLE IF EXISTS `risk_mitigation_strategy_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `risk_mitigation_strategy_tbl` (
  `risk_mitigation_strategy_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `risk_mitigation_strategy_name` varchar(100) DEFAULT NULL,
  `risk_mitigation_strategy_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`risk_mitigation_strategy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `risk_mitigation_strategy_tbl`
--

LOCK TABLES `risk_mitigation_strategy_tbl` WRITE;
/*!40000 ALTER TABLE `risk_mitigation_strategy_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `risk_mitigation_strategy_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `risk_risk_exception_join`
--

DROP TABLE IF EXISTS `risk_risk_exception_join`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `risk_risk_exception_join` (
  `risk_risk_exception_join_risk_id` int(11) DEFAULT NULL,
  `risk_risk_exception_join_risk_exception_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `risk_risk_exception_join`
--

LOCK TABLES `risk_risk_exception_join` WRITE;
/*!40000 ALTER TABLE `risk_risk_exception_join` DISABLE KEYS */;
/*!40000 ALTER TABLE `risk_risk_exception_join` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `risk_security_services_join`
--

DROP TABLE IF EXISTS `risk_security_services_join`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `risk_security_services_join` (
  `risk_security_services_join_risk_id` int(11) DEFAULT NULL,
  `risk_security_services_join_security_services_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `risk_security_services_join`
--

LOCK TABLES `risk_security_services_join` WRITE;
/*!40000 ALTER TABLE `risk_security_services_join` DISABLE KEYS */;
/*!40000 ALTER TABLE `risk_security_services_join` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `risk_tbl`
--

DROP TABLE IF EXISTS `risk_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `risk_tbl` (
  `risk_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `risk_threat` text,
  `risk_vulnerabilities` text,
  `risk_classification_score` int(11) DEFAULT NULL,
  `risk_mitigation_strategy_id` int(11) DEFAULT NULL,
  `risk_periodicity_review` int(11) DEFAULT NULL,
  `risk_residual_score` int(11) DEFAULT NULL,
  `risk_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`risk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `risk_tbl`
--

LOCK TABLES `risk_tbl` WRITE;
/*!40000 ALTER TABLE `risk_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `risk_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `security_incident_classification_tbl`
--

DROP TABLE IF EXISTS `security_incident_classification_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `security_incident_classification_tbl` (
  `security_incident_classification_id` int(11) NOT NULL AUTO_INCREMENT,
  `security_incident_classification_name` varchar(100) DEFAULT NULL,
  `security_incident_classification_criteria` text,
  `security_incident_classification_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`security_incident_classification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `security_incident_classification_tbl`
--

LOCK TABLES `security_incident_classification_tbl` WRITE;
/*!40000 ALTER TABLE `security_incident_classification_tbl` DISABLE KEYS */;
INSERT INTO `security_incident_classification_tbl` VALUES (1,'Severe','se rompe tdo',1);
/*!40000 ALTER TABLE `security_incident_classification_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `security_incident_status_tbl`
--

DROP TABLE IF EXISTS `security_incident_status_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `security_incident_status_tbl` (
  `security_incident_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `security_incident_status_name` varchar(100) DEFAULT NULL,
  `security_incident_status_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`security_incident_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `security_incident_status_tbl`
--

LOCK TABLES `security_incident_status_tbl` WRITE;
/*!40000 ALTER TABLE `security_incident_status_tbl` DISABLE KEYS */;
INSERT INTO `security_incident_status_tbl` VALUES (1,'Reported',0),(2,'Ongoing',0),(3,'Closed',0);
/*!40000 ALTER TABLE `security_incident_status_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `security_incident_tbl`
--

DROP TABLE IF EXISTS `security_incident_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `security_incident_tbl` (
  `security_incident_id` int(11) NOT NULL AUTO_INCREMENT,
  `security_incident_owner_id` varchar(45) DEFAULT NULL,
  `security_incident_title` varchar(45) DEFAULT NULL,
  `security_incident_open_date` date DEFAULT NULL,
  `security_incident_description` text,
  `security_incident_compromised_asset_id` int(11) DEFAULT NULL,
  `security_incident_closure_date` date DEFAULT NULL,
  `security_incident_classification_id` int(11) DEFAULT NULL,
  `security_incident_status_id` int(11) DEFAULT NULL,
  `security_incident_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`security_incident_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `security_incident_tbl`
--

LOCK TABLES `security_incident_tbl` WRITE;
/*!40000 ALTER TABLE `security_incident_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `security_incident_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `security_operations_dashboard_tbl`
--

DROP TABLE IF EXISTS `security_operations_dashboard_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `security_operations_dashboard_tbl` (
  `security_operations_dashboard_id` int(11) NOT NULL AUTO_INCREMENT,
  `security_operations_dashboard_project_count` int(11) DEFAULT NULL,
  `security_operations_dashboard_project_idea` int(11) DEFAULT NULL,
  `security_operations_dashboard_project_initiated` int(11) DEFAULT NULL,
  `security_operations_dashboard_project_complet` int(11) DEFAULT NULL,
  `security_operations_dashboard_incident_count` int(11) DEFAULT NULL,
  `security_operations_dashboard_incident_reported` int(11) DEFAULT NULL,
  `security_operations_dashboard_incident_open` int(11) DEFAULT NULL,
  `security_operations_dashboard_incident_closed` int(11) DEFAULT NULL,
  `security_operations_dashboard_date` date DEFAULT NULL,
  `security_operations_dashboard_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`security_operations_dashboard_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `security_operations_dashboard_tbl`
--

LOCK TABLES `security_operations_dashboard_tbl` WRITE;
/*!40000 ALTER TABLE `security_operations_dashboard_tbl` DISABLE KEYS */;
INSERT INTO `security_operations_dashboard_tbl` VALUES (2,0,0,0,0,0,0,0,0,'2013-01-02',0);
/*!40000 ALTER TABLE `security_operations_dashboard_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `security_services_audit_calendar_tbl`
--

DROP TABLE IF EXISTS `security_services_audit_calendar_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `security_services_audit_calendar_tbl` (
  `security_services_audit_calendar_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `security_services_audit_calendar_name` varchar(45) DEFAULT NULL,
  `security_services_audit_calendar_value` int(11) DEFAULT NULL,
  PRIMARY KEY (`security_services_audit_calendar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `security_services_audit_calendar_tbl`
--

LOCK TABLES `security_services_audit_calendar_tbl` WRITE;
/*!40000 ALTER TABLE `security_services_audit_calendar_tbl` DISABLE KEYS */;
INSERT INTO `security_services_audit_calendar_tbl` VALUES (1,'Jan',1),(2,'Feb',2),(3,'Mar',3),(4,'Apr',4),(5,'May',5),(6,'Jun',6),(7,'Jul',7),(8,'Aug',8),(9,'Sep',9),(10,'Oct',10),(11,'Nov',11),(12,'Dec',12);
/*!40000 ALTER TABLE `security_services_audit_calendar_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `security_services_audit_result_tbl`
--

DROP TABLE IF EXISTS `security_services_audit_result_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `security_services_audit_result_tbl` (
  `security_services_audit_result_id` int(11) NOT NULL AUTO_INCREMENT,
  `security_services_audit_result_name` varchar(100) DEFAULT NULL,
  `security_services_audit_result_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`security_services_audit_result_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `security_services_audit_result_tbl`
--

LOCK TABLES `security_services_audit_result_tbl` WRITE;
/*!40000 ALTER TABLE `security_services_audit_result_tbl` DISABLE KEYS */;
INSERT INTO `security_services_audit_result_tbl` VALUES (1,'NA',1),(2,'Pass',0),(3,'Fail',0),(4,'Inconclusive',1);
/*!40000 ALTER TABLE `security_services_audit_result_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `security_services_audit_status_tbl`
--

DROP TABLE IF EXISTS `security_services_audit_status_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `security_services_audit_status_tbl` (
  `security_services_audit_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `security_services_audit_status_name` varchar(100) DEFAULT NULL,
  `security_services_audit_status_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`security_services_audit_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `security_services_audit_status_tbl`
--

LOCK TABLES `security_services_audit_status_tbl` WRITE;
/*!40000 ALTER TABLE `security_services_audit_status_tbl` DISABLE KEYS */;
INSERT INTO `security_services_audit_status_tbl` VALUES (1,'Not Initiated',0),(2,'Initiated',0),(3,'Completed',0);
/*!40000 ALTER TABLE `security_services_audit_status_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `security_services_audit_tbl`
--

DROP TABLE IF EXISTS `security_services_audit_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `security_services_audit_tbl` (
  `security_services_audit_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `security_services_audit_security_service_id` int(11) DEFAULT NULL,
  `security_services_audit_status` int(11) DEFAULT NULL,
  `security_services_audit_calendar_id` int(11) DEFAULT NULL,
  `security_services_audit_planned_year` int(11) DEFAULT NULL,
  `security_services_audit_metric` text,
  `security_services_audit_criteria` text,
  `security_services_audit_start_audit_date` date DEFAULT NULL,
  `security_services_audit_end_audit_date` date DEFAULT NULL,
  `security_services_audit_auditor` varchar(100) DEFAULT NULL,
  `security_services_audit_result` int(11) DEFAULT '1',
  `security_services_audit_result_description` text,
  `security_services_audit_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`security_services_audit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14677 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `security_services_audit_tbl`
--

LOCK TABLES `security_services_audit_tbl` WRITE;
/*!40000 ALTER TABLE `security_services_audit_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `security_services_audit_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `security_services_catalogue_audit_calendar_join`
--

DROP TABLE IF EXISTS `security_services_catalogue_audit_calendar_join`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `security_services_catalogue_audit_calendar_join` (
  `security_service_catalogue_id` int(11) NOT NULL DEFAULT '0',
  `security_services_audit_calendar_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `security_services_catalogue_audit_calendar_join`
--

LOCK TABLES `security_services_catalogue_audit_calendar_join` WRITE;
/*!40000 ALTER TABLE `security_services_catalogue_audit_calendar_join` DISABLE KEYS */;
/*!40000 ALTER TABLE `security_services_catalogue_audit_calendar_join` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `security_services_dashboard_tbl`
--

DROP TABLE IF EXISTS `security_services_dashboard_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `security_services_dashboard_tbl` (
  `security_services_dashboard_id` int(11) NOT NULL AUTO_INCREMENT,
  `security_services_dashboard_opex` int(11) DEFAULT NULL,
  `security_services_dashboard_capex` int(11) DEFAULT NULL,
  `security_services_dashboard_resource` int(11) DEFAULT NULL,
  `security_services_dashboard_proposed` int(11) DEFAULT NULL,
  `security_services_dashboard_design` int(11) DEFAULT NULL,
  `security_services_dashboard_transition` int(11) DEFAULT NULL,
  `security_services_dashboard_production` int(11) DEFAULT NULL,
  `security_services_dashboard_retired` int(11) DEFAULT NULL,
  `security_services_dashboard_total` int(11) DEFAULT NULL,
  `security_services_dashboard_date` date DEFAULT NULL,
  `security_services_dashboard_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`security_services_dashboard_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `security_services_dashboard_tbl`
--

LOCK TABLES `security_services_dashboard_tbl` WRITE;
/*!40000 ALTER TABLE `security_services_dashboard_tbl` DISABLE KEYS */;
INSERT INTO `security_services_dashboard_tbl` VALUES (5,0,0,0,0,0,0,0,0,0,'2013-01-02',0);
/*!40000 ALTER TABLE `security_services_dashboard_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `security_services_status_tbl`
--

DROP TABLE IF EXISTS `security_services_status_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `security_services_status_tbl` (
  `security_services_status_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `security_services_status_name` varchar(100) DEFAULT NULL,
  `security_services_status_disabled` int(11) DEFAULT NULL,
  PRIMARY KEY (`security_services_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `security_services_status_tbl`
--

LOCK TABLES `security_services_status_tbl` WRITE;
/*!40000 ALTER TABLE `security_services_status_tbl` DISABLE KEYS */;
INSERT INTO `security_services_status_tbl` VALUES (1,'Proposed',0),(2,'Design',0),(3,'Transition',0),(4,'Production',0),(5,'Retired',0);
/*!40000 ALTER TABLE `security_services_status_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `security_services_tbl`
--

DROP TABLE IF EXISTS `security_services_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `security_services_tbl` (
  `security_services_id` int(11) NOT NULL AUTO_INCREMENT,
  `security_services_name` varchar(100) DEFAULT NULL,
  `security_services_objective` text,
  `security_services_documentation_url` text,
  `security_services_status` int(11) DEFAULT NULL,
  `security_services_audit_metric` text,
  `security_services_audit_success_criteria` text,
  `security_services_cost_opex` int(11) DEFAULT NULL,
  `security_services_cost_capex` int(11) DEFAULT NULL,
  `security_services_cost_operational_resource` decimal(10,2) DEFAULT NULL,
  `security_services_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`security_services_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `security_services_tbl`
--

LOCK TABLES `security_services_tbl` WRITE;
/*!40000 ALTER TABLE `security_services_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `security_services_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_contracts_security_services_join`
--

DROP TABLE IF EXISTS `service_contracts_security_services_join`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_contracts_security_services_join` (
  `security_services_id` int(11) DEFAULT NULL,
  `service_contracts_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_contracts_security_services_join`
--

LOCK TABLES `service_contracts_security_services_join` WRITE;
/*!40000 ALTER TABLE `service_contracts_security_services_join` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_contracts_security_services_join` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_contracts_tbl`
--

DROP TABLE IF EXISTS `service_contracts_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_contracts_tbl` (
  `service_contracts_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_contracts_name` varchar(100) DEFAULT NULL,
  `service_contracts_description` text,
  `service_contracts_value` int(11) DEFAULT NULL,
  `service_contracts_start` date DEFAULT NULL,
  `service_contracts_end` date DEFAULT NULL,
  `service_contracts_provider_id` int(11) DEFAULT NULL,
  `service_contracts_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`service_contracts_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_contracts_tbl`
--

LOCK TABLES `service_contracts_tbl` WRITE;
/*!40000 ALTER TABLE `service_contracts_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_contracts_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_authorization_group_role_join`
--

DROP TABLE IF EXISTS `system_authorization_group_role_join`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_authorization_group_role_join` (
  `system_authorization_group_role_role_id` int(11) DEFAULT NULL,
  `system_authorization_group_auth_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_authorization_group_role_join`
--

LOCK TABLES `system_authorization_group_role_join` WRITE;
/*!40000 ALTER TABLE `system_authorization_group_role_join` DISABLE KEYS */;
INSERT INTO `system_authorization_group_role_join` VALUES (0,1),(0,2),(0,3),(0,7),(0,9),(0,11),(0,13),(0,15),(0,17),(0,19),(0,21),(0,23),(0,25),(0,27),(0,29),(0,31),(0,35),(0,36),(0,39),(0,40),(0,43),(0,46),(0,48),(0,49),(0,54),(0,55),(5,1),(5,2),(5,3),(5,7),(5,9),(5,11),(5,13),(5,15),(5,17),(5,19),(5,21),(5,23),(5,25),(5,27),(5,29),(5,31),(5,35),(5,36),(5,39),(5,40),(5,43),(5,46),(5,48),(5,49),(5,54),(5,55),(5,4),(5,5),(5,6),(5,8),(5,10),(5,12),(5,14),(5,16),(5,18),(5,20),(5,22),(5,24),(5,26),(5,28),(5,30),(5,32),(5,33),(5,34),(5,37),(5,41),(5,44),(5,45),(5,47),(5,50);
/*!40000 ALTER TABLE `system_authorization_group_role_join` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_authorization_tbl`
--

DROP TABLE IF EXISTS `system_authorization_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_authorization_tbl` (
  `system_authorization_id` int(11) NOT NULL AUTO_INCREMENT,
  `system_authorization_order` int(11) DEFAULT NULL,
  `system_authorization_action_type` varchar(1) DEFAULT NULL,
  `system_authorization_section_name` varchar(100) DEFAULT NULL,
  `system_authorization_section_cute_name` varchar(100) DEFAULT NULL,
  `system_authorization_subsection_name` varchar(100) DEFAULT NULL,
  `system_authorization_subsection_cute_name` varchar(100) DEFAULT NULL,
  `system_authorization_subsection_submenu` int(1) NOT NULL DEFAULT '1',
  `system_authorization_target_url` varchar(100) DEFAULT NULL,
  `system_authorization_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`system_authorization_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_authorization_tbl`
--

LOCK TABLES `system_authorization_tbl` WRITE;
/*!40000 ALTER TABLE `system_authorization_tbl` DISABLE KEYS */;
INSERT INTO `system_authorization_tbl` VALUES (1,7,'r','system','System Configuration','system_records','System Records',1,'system/system_records_list.php',0),(2,7,'r','system','System Configuration','system_authorization_list','System Authorization',1,'system/system_authorization_list.php',0),(3,7,'r','system','System Configuration','system_roles_list','System Roles',1,'system/system_roles_list.php',0),(4,7,'w','system','System Configuration','system_records','System Records',1,'system/system_records_edit.php',0),(5,7,'w','system','System Configuration','system_authorization_edit','System Authorization',1,'system/system_authorization_edit.php',0),(6,7,'w','system','System Configuration','system_roles_edit','System Roles',1,'system/system_roles_edit.php',0),(7,1,'r','organization','Organization','bu_list','Business Units',1,'organization/bu_list.php',0),(8,1,'w','organization','Organization','bu_edit','Business Units',1,'organization/bu_edit.php',0),(9,1,'r','organization','Organization','legal_list','Legal Constrains',1,'organization/legal_list.php',0),(10,1,'w','organization','Organization','legal_edit','Legal Constrains',1,'organization/legal_edit.php',0),(11,1,'r','organization','Organization','tp_list','Third Parties',1,'organization/tp_list.php',0),(12,1,'w','organization','Organization','tp_edit','Third Parties',1,'organization/tp_edit.php',0),(13,2,'r','asset','Asset Management','asset_classification_list','Asset Classification',1,'asset/asset_classification_list.php',0),(14,2,'w','asset','Asset Management','asset_classification_edit','Asset Classification',1,'asset/asset_classification_edit.php',0),(15,2,'r','asset','Asset Management','asset_list','Asset Identification',1,'asset/asset_list.php',0),(16,2,'w','asset','Asset Management','asset_edit','Asset Identification',1,'asset/asset_edit.php',0),(17,2,'r','asset','Asset Management','data_asset_list','Data Asset Analysis',1,'asset/data_asset_list.php',0),(18,2,'w','asset','Asset Management','data_asset_edit','Data Asset Analysis',1,'asset/data_asset_edit.php',0),(19,3,'r','risk','Risk Management','risk_classification_list','Risk Classification',1,'risk/risk_classification_list.php',0),(20,3,'w','risk','Risk Management','risk_classification_edit','Risk Classification',1,'risk/risk_classification_edit.php',0),(21,3,'r','risk','Risk Management','risk_management_list','Risk Analysis',1,'risk/risk_management_list.php',0),(22,3,'w','risk','Risk Management','risk_management_edit','Risk Analysis',1,'risk/risk_management_edit.php',0),(23,3,'r','risk','Risk Management','risk_exception_list','Risk Exception',1,'risk/risk_exception_list.php',0),(24,3,'w','risk','Risk Management','risk_exception_edit','Risk Exception',1,'risk/risk_exception_edit.php',0),(25,4,'r','security_services','Security Services','security_catalogue_list','Security Catalogue',1,'services/security_catalogue_list.php',0),(26,4,'w','security_services','Security Services','security_catalogue_edit','Security Catalogue',1,'services/security_catalogue_edit.php',0),(27,4,'r','security_services','Security Services','security_services_audit_list','Security Services Audit',1,'services/security_services_audit_list.php',0),(28,4,'w','security_services','Security Services','security_services_audit_edit','Security Services Audit',1,'services/security_services_audit_edit.php',0),(29,4,'r','security_services','Security Services','service_contracts_list','Service Contracts',1,'services/service_contracts_list.php',0),(30,4,'w','security_services','Security Services','service_contracts_edit','Service Contracts',1,'services/service_contracts_edit.php',0),(31,5,'r','compliance','Compliance Management','compliance_package_list','Compliance Packages',1,'compliance/compliance_package_list.php',0),(32,5,'w','compliance','Compliance Management','compliance_package_edit','Compliance Packages',1,'compliance/compliance_package_edit.php',0),(33,5,'w','compliance','Compliance Management','compliance_package_item_edit','Compliance Packages',1,'compliance/compliance_package_item_edit.php',0),(34,5,'w','compliance','Compliance Management','compliance_package_upload','Compliance Packages',1,'compliance/compliance_package_upload.php',0),(35,5,'r','compliance','Compliance Management','compliance_management_list','Compliance Analysis',1,'compliance/compliance_management_list.php',0),(36,5,'r','compliance','Compliance Management','compliance_management_step_two','Compliance Analysis',0,'compliance/compliance_management_list_step_two.php',0),(37,5,'w','compliance','Compliance Management','compliance_management_edit','Compliance Analysis',1,'compliance/compliance_management_edit.php',0),(39,5,'r','compliance','Compliance Management','compliance_management','Compliance Analysis',0,'compliance/compliance_management_list.php',0),(40,5,'r','compliance','Compliance Management','compliance_exception_list','Compliance Exception',1,'compliance/compliance_exception_list.php',0),(41,5,'w','compliance','Compliance Management','compliance_exception_edit','Compliance Exception',1,'compliance/compliance_exception_edit.php',0),(43,6,'r','operations','Security Operations','project_improvements_list','Project Improvements',1,'operations/project_improvements_list.php',0),(44,6,'w','operations','Security Operations','project_improvements_edit','Project Improvements',1,'operations/project_improvements_edit.php',0),(45,6,'w','operations','Security Operations','security_incident_edit','Security Incidents',1,'operations/security_incident_edit.php',0),(46,6,'r','operations','Security Operations','security_incident_list','Security Incidents',1,'operations/security_incident_list.php',0),(47,1,'w','organization','Organization','process_edit','Process',1,'organization/process_edit.php',0),(48,4,'r','security_services','Security Services','dashboard','Dashboard',0,'services/dashboard.php',0),(49,6,'r','operations','Security Operations','security_incident_classification_list','Security Incident Classification',1,'operations/security_incident_classification_list.php',0),(50,6,'w','operations','Security Operations','security_incident_classification_edit','Security Incident Classification',1,'operations/security_incident_classification_edit.php',0),(54,3,'r','risk','Risk Management','dashboard','Dashboard',0,'risk/dashboard.php',0),(55,2,'r','asset','Asset Management','dashboard','Dashboard',0,'asset/dashboard.php',0);
/*!40000 ALTER TABLE `system_authorization_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_conf_pwd_tbl`
--

DROP TABLE IF EXISTS `system_conf_pwd_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_conf_pwd_tbl` (
  `system_conf_pwd_id` int(11) NOT NULL AUTO_INCREMENT,
  `system_conf_timestamp` int(11) DEFAULT NULL,
  `system_conf_login_id` int(11) DEFAULT NULL,
  `system_conf_pwd` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`system_conf_pwd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_conf_pwd_tbl`
--

LOCK TABLES `system_conf_pwd_tbl` WRITE;
/*!40000 ALTER TABLE `system_conf_pwd_tbl` DISABLE KEYS */;
INSERT INTO `system_conf_pwd_tbl` VALUES (1,1355339512,1,'5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8');
/*!40000 ALTER TABLE `system_conf_pwd_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_dashboard_tbl`
--

DROP TABLE IF EXISTS `system_dashboard_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_dashboard_tbl` (
  `system_dashboard_id` int(11) NOT NULL AUTO_INCREMENT,
  `system_dashboard_login_ok` int(11) DEFAULT NULL,
  `system_dashboard_login_not_ok` int(11) DEFAULT NULL,
  `system_dashboard_date` date DEFAULT NULL,
  `system_dashboard_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`system_dashboard_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_dashboard_tbl`
--

LOCK TABLES `system_dashboard_tbl` WRITE;
/*!40000 ALTER TABLE `system_dashboard_tbl` DISABLE KEYS */;
INSERT INTO `system_dashboard_tbl` VALUES (3,1,1,'2013-01-02',0);
/*!40000 ALTER TABLE `system_dashboard_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_group_role_tbl`
--

DROP TABLE IF EXISTS `system_group_role_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_group_role_tbl` (
  `system_group_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `system_group_role_name` varchar(100) DEFAULT NULL,
  `system_group_role_description` text,
  `system_group_role_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`system_group_role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_group_role_tbl`
--

LOCK TABLES `system_group_role_tbl` WRITE;
/*!40000 ALTER TABLE `system_group_role_tbl` DISABLE KEYS */;
INSERT INTO `system_group_role_tbl` VALUES (1,'CISO','Can do all',1),(5,'CISO','Can do all',0);
/*!40000 ALTER TABLE `system_group_role_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_records_tbl`
--

DROP TABLE IF EXISTS `system_records_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_records_tbl` (
  `system_records_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system_records_section` varchar(100) DEFAULT NULL,
  `system_records_subsection` varchar(100) DEFAULT NULL,
  `system_records_item_id` varchar(100) DEFAULT NULL,
  `system_records_author` varchar(100) DEFAULT NULL,
  `system_records_action` varchar(100) DEFAULT NULL,
  `system_records_notes` text,
  `system_records_date` datetime DEFAULT NULL,
  PRIMARY KEY (`system_records_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5547 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_records_tbl`
--

LOCK TABLES `system_records_tbl` WRITE;
/*!40000 ALTER TABLE `system_records_tbl` DISABLE KEYS */;
INSERT INTO `system_records_tbl` VALUES (5543,'system','system_roles','','','Insert','','2013-01-02 21:13:35'),(5544,'system','system_roles','5','','Update','','2013-01-02 21:13:42'),(5545,'system','system_authorization','','admin','Wrong Login','','2013-01-02 21:18:17'),(5546,'system','system_authorization','1','admin','Login','','2013-01-02 21:21:39');
/*!40000 ALTER TABLE `system_records_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_users_tbl`
--

DROP TABLE IF EXISTS `system_users_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_users_tbl` (
  `system_users_id` int(11) NOT NULL AUTO_INCREMENT,
  `system_users_name` varchar(45) DEFAULT NULL,
  `system_users_surname` varchar(45) DEFAULT NULL,
  `system_users_group_role_id` int(11) DEFAULT NULL,
  `system_users_login` varchar(45) DEFAULT NULL,
  `system_users_password` text NOT NULL,
  `system_users_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`system_users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_users_tbl`
--

LOCK TABLES `system_users_tbl` WRITE;
/*!40000 ALTER TABLE `system_users_tbl` DISABLE KEYS */;
INSERT INTO `system_users_tbl` VALUES (1,'System','Administrator',-1,'admin','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8',0);
/*!40000 ALTER TABLE `system_users_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_tbl`
--

DROP TABLE IF EXISTS `tp_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_tbl` (
  `tp_id` int(11) NOT NULL AUTO_INCREMENT,
  `tp_name` varchar(100) DEFAULT NULL,
  `tp_description` text,
  `tp_type_id` int(11) DEFAULT NULL,
  `tp_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`tp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_tbl`
--

LOCK TABLES `tp_tbl` WRITE;
/*!40000 ALTER TABLE `tp_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_type_tbl`
--

DROP TABLE IF EXISTS `tp_type_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_type_tbl` (
  `tp_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `tp_type_name` varchar(100) DEFAULT NULL,
  `tp_type_disabled` int(11) DEFAULT '1',
  PRIMARY KEY (`tp_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_type_tbl`
--

LOCK TABLES `tp_type_tbl` WRITE;
/*!40000 ALTER TABLE `tp_type_tbl` DISABLE KEYS */;
INSERT INTO `tp_type_tbl` VALUES (1,'Customers',0),(2,'Providers',0),(3,'Regulators',0);
/*!40000 ALTER TABLE `tp_type_tbl` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-01-02 21:22:32
