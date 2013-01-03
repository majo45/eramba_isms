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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bu_tbl`
--

LOCK TABLES `bu_tbl` WRITE;
/*!40000 ALTER TABLE `bu_tbl` DISABLE KEYS */;
INSERT INTO `bu_tbl` VALUES (12,'Finance','',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=239 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compliance_package_item_tbl`
--

LOCK TABLES `compliance_package_item_tbl` WRITE;
/*!40000 ALTER TABLE `compliance_package_item_tbl` DISABLE KEYS */;
INSERT INTO `compliance_package_item_tbl` VALUES (145,89,'A.5.1.2','Review of the information security policy','The information security policy shall be reviewed at planned intervals or if significant changes occur to ensure its continuing suitability, adequacy, and effectiveness.',0),(146,90,'A.6.1.2','Information security coordination','Information security activities shall be co-ordinated by representatives from different parts of the organization with relevant roles and job function.',0),(147,90,'A.6.1.3','Allocation of information security responsibilities','All information security responsibilities shall be clearly defined.',0),(148,90,'A.6.1.4','Authorization process for information processing facilities','A management authorization process for new information processing facilities shall be defined and implemented.',0),(149,90,'A.6.1.5','Confidentiality agreements','Requirements for confidentiality or non-disclosure agreements reflecting the organization\'s needs for the protection of information shall be identified and regularly reviewed.',0),(150,90,'A.6.1.6','Contact with authorities','Appropriate contacts with relevant authorities shall be maintained.',0),(151,90,'A.6.1.7','Contact with special interest groups','Appropriate contacts with special interest groups or other specialist security forums and professional associations shall be maintained.',0),(152,90,'A.6.1.8','Independent review of information security','The organization\'s approach to managing information security and its implementation (i.e. control objectives, controls, policies, processes, and procedures for information security) shall be reviewed independently at planned intervals, or when significant changes to the security implementation occur.',0),(153,91,'A.6.2.2','Addressing security when dealing with customers','All identified security requirements shall be addressed before giving customers access to the organization\'s information or assets.',0),(154,91,'A.6.2.3','Addressing security in third party contracts','Agreements with third parties involving accessing, processing, communicating or managing the organization\'s information or information processing facilities, or adding products or services to information processing facilities shall cover all relevant security requirements.',0),(155,92,'A.7.1.2','Ownership of assets','All information and assets associated with information processing facilities shall be owned by a designated part of the organization.',0),(156,92,'A.7.1.3','Acceptable use of assets','Rules for the acceptable use of information and assets associated with information processing facilities shall be identified, documented, and implemented.',0),(157,93,'A.7.2.2','Information labelling and handling','An appropriate set of procedures for information labelling and handling shall be developed and implemented in accordance with the classification scheme adopted by the organization.',0),(158,94,'A.8.1.2','Screening','Background verification checks on all candidates for employment, contractors, and third party users shall be carried out in accordance with relevant laws, regulations and ethics, and proportional to the business requirements, the classification of the information to be accessed, and the perceived risks.',0),(159,94,'A.8.1.3','Terms and conditions of employment','As part of their contractual obligation, employees, contractors and third party users shall agree and sign the terms and conditions of their employment contract, which shall state their and the organization\'s responsibilities for information security.',0),(160,95,'A.8.2.2','Information security awareness, education and training','All employees of the organization and, where relevant, contractors and third-party users, shall receive appropriate awareness training and regular updates in organizational policies and procedures, as relevant for their job function.',0),(161,95,'A.8.2.3','Disciplinary process','There shall be a formal disciplinary process for employees who have committed a security breach.',0),(162,97,'A.8.3.2','Return of assets','All employees, contractors and third party users shall return all of the organization\'s assets in their possession upon termination of their employment, contract or agreement.',0),(163,97,'A.8.3.3','Removal of access rights','The access rights of all employees, contractors and third party users to information and information processing facilities shall be removed upon termination of their employment, contract or agreement, or adjusted upon change.',0),(164,98,'A9.1.2','Physical entry controls','Secure areas shall be protected by appropriate entry controls to ensure that only authorized personnel are allowed access.',0),(165,98,'A9.1.3','Securing offices, rooms and facilities','Physical security for offices, rooms, and facilities shall be designed and applied',0),(166,98,'A9.1.4','Protecting against external and environmental threats','Physical protection against damage from fire, flood, earthquake, explosion, civil unrest, and other forms of natural or man-made disaster shall be designed and applied.',0),(167,98,'A9.1.5','Working in secure areas','Physical protection and guidelines for working in secure areas shall be designed and applied.',0),(168,98,'A9.1.6','Public access, delivery and loading areas','Access points such as delivery and loading areas and other points where unauthorized persons may enter the premises shall be controlled and, if possible, isolated from information processing facilities to avoid unauthorized access.',0),(169,99,'A9.2.2','Supporting utilities','Equipment shall be protected from power failures and other disruptions caused by failures in supporting utilities.',0),(170,99,'A9.2.3','Cabling security','Power and telecommunications cabling carrying data or supporting information services shall be protected from interception or damage.',0),(171,99,'A9.2.4','Equipment maintenance','Equipment shall be correctly maintained to enable its continued availability and integrity.',0),(172,99,'A9.2.5','Security of equipment off-premises','Security shall be applied to off-site equipment taking into account the different risks of working outside the organization\'s premises.',0),(173,99,'A9.2.6','Secure disposal or \rre-use of equipment','All items of equipment containing storage media shall be checked to ensure that any sensitive data and licensed software has been removed or securely overwritten prior to disposal.',0),(174,99,'A9.2.7','Removal of property','Equipment, information or software shall not be taken off-site without prior authorization.',0),(175,100,'A10.1.2','Change management','Changes to information processing facilities and systems shall be controlled.',0),(176,100,'A10.1.3','Segregation of duties','Duties and areas of responsibility shall be segregated to reduce opportunities for unauthorized or unintentional modification or misuse of the organization\'s assets.',0),(177,100,'A10.1.4','Separation of development, test and operational facilities','Development, test and operational facilities shall be separated to reduce the risks of unauthorized access or changes to the operational system.',0),(178,101,'A10.2.2','Monitoring and review of third party services','The services, reports and records provided by the third party shall be regularly monitored and reviewed, and audits shall be carried out regularly.',0),(179,101,'A10.2.3','Managing changes to third party services','Changes to the provision of services, including maintaining and improving existing information security policies, procedures and controls, shall be managed, taking account of the criticality of business systems and processes involved and re-assessment of risks.',0),(180,102,'A10.3.2','System acceptance','Acceptance criteria for new information systems, upgrades, and new versions shall be established and suitable tests of the system\'s) carried out during development and prior to acceptance.',0),(181,103,'A10.4.2','Controls against mobile code','Where the use of mobile code is authorized, the configuration shall ensure that the authorized mobile code operates according to a clearly defined security policy, and unauthorized mobile code shall be prevented from executing.',0),(182,105,'A10.6.2','Security of network services','Security features, service levels, and management requirements of all network services shall be identified and included in any network services agreement, whether these services are provided in-house or outsourced.',0),(183,106,'A10.7.2','Disposal of media','Media shall be disposed of securely and safely when no longer required, using formal procedures.',0),(184,106,'A10.7.3','Information handling procedures ','Procedures for the handling and storage of information shall be established to protect this information from unauthorized disclosure or misuse.',0),(185,106,'A10.7.4','Security of system documentation','System documentation shall be protected against unauthorized access. ',0),(186,107,'A10.8.2','Exchange agreements','Agreements shall be established for the exchange of information and software between the organization and external parties.',0),(187,107,'A10.8.3','Physical media in transit','Media containing information shall be protected against unauthorized access, misuse or corruption during transportation beyond an organization\'s physical boundaries.',0),(188,107,'A10.8.4','Electronic messaging','Information involved in electronic messaging shall be appropriately protected.',0),(189,107,'A10.8.5','Business information systems','Policies and procedures shall be developed and implemented to protect information associated with the interconnection of business information systems.',0),(190,108,'A10.9.2','On-line transactions','Information involved in on-line transactions shall be protected to prevent incomplete transmission, mis-routing, unauthorized message alteration, unauthorized disclosure, unauthorized message duplication or replay.',0),(191,108,'A10.9.3','Publicly available information','The integrity of information being made available on a publicly available system shall be protected to prevent unauthorized modification.',0),(192,109,'A10.10.2','Monitoring system use','Procedures for monitoring use of information processing facilities shall be established and the results of the monitoring activities reviewed regularly.',0),(193,109,'A10.10.3','Protection of log information','Logging facilities and log information shall be protected against tampering and unauthorized access.',0),(194,109,'A10.10.4','Administrator and operator logs','System administrator and system operator activities shall be logged.',0),(195,109,'A10.10.5','Fault logging','Faults shall be logged, analyzed, and appropriate action taken.',0),(196,109,'A10.10.6','Clock synchronization','The clocks of all relevant information processing systems within an organization or security domain shall be synchronized with an agreed accurate time source.',0),(197,111,'A11.2.2','Privilege management','The allocation and use of privileges shall be restricted and controlled.',0),(198,111,'A11.2.3','User password management','The allocation of passwords shall be controlled through a formal management process.',0),(199,111,'A11.2.4','Review of user access rights','Management shall  review users\' access rights at regular intervals using a formal process.',0),(200,112,'A11.3.2','Unattended user equipment','Users shall ensure that unattended equipment has appropriate protection.',0),(201,112,'A11.3.3','Clear desk and clear screen policy','A clear desk policy for papers and removable storage media and a clear screen policy for information processing facilities shall be adopted.',0),(202,113,'A11.4.2','User authentication for external connections','Appropriate authentication methods shall be used to control access by remote users.',0),(203,113,'A11.4.3','Equipment identification in networks','Automatic equipment identification shall be considered as a means to authenticate connections from specific locations and equipment.',0),(204,113,'A11.4.4','Remote diagnostic and configuration port protection','Physical and logical access to diagnostic and configuration ports shall be controlled.',0),(205,113,'A11.4.5','Segregation in networks','Groups of information services, users and information systems shall be segregated on networks.',0),(206,113,'A11.4.6','Network connection control','For shared networks, especially those extending across the organization\'s boundaries, the capability of users to connect to the network shall be restricted, in line with the access control policy and requirements of the business applications (see 11.1).',0),(207,113,'A11.4.7','Network routing control','Routing controls shall be implemented for networks to ensure that computer connections and information flows do not breach the access control policy of the business applications.',0),(208,114,'A11.5.2','User identification and authentication','All users shall have a unique identifier (user ID) for their personal use only, and a suitable authentication technique shall be chosen to substantiate the claimed identity of a user.',0),(209,114,'A11.5.3','Password management system','Systems for managing passwords shall be interactive and shall ensure quality passwords.',0),(210,114,'A11.5.4','Use of system utilities','The use of utility programs that might be capable of overriding system and application controls shall be restricted and tightly controlled.',0),(211,114,'A11.5.5','Session time-out','Inactive sessions shall be shut down after a defined period of inactivity.',0),(212,114,'A11.5.6','Limitation of connection time','Restrictions on connection times shall be used to provide additional security for high-risk applications.',0),(213,115,'A11.6.2','Sensitive system isolation','Sensitive systems shall have a dedicated (isolated) computing environment.',0),(214,116,'A11.7.2','Teleworking','A policy, operational plans and procedures shall be developed and implemented for teleworking activities.',0),(215,118,'12.2.2','Control of internal processing','Validation checks shall be incorporated into applications to detect any corruption of information through processing errors or deliberate acts.',0),(216,118,'12.2.3','Message integrity','Requirements for ensuring authenticity and protecting message integrity in applications shall be identified, and appropriate controls identified and implemented.',0),(217,118,'12.2.4','Output data validation','Data output from an application shall be validated to ensure that the processing of stored information is correct and appropriate to the circumstances.',0),(218,119,'12.3.2','Key management','Key management shall be in place to support the organization\'s use of cryptographic techniques.',0),(219,120,'A12.4.2','Protection of system test data','Test data shall be selected carefully, and protected and controlled.',0),(220,120,'A12.4.3','Access control to program source code','Access to program source code shall be restricted.',0),(221,121,'A12.5.2','Technical review of applications after operating system changes','When operating systems are changed, business critical applications shall be reviewed and tested to ensure there is no adverse impact on organizational operations or security.',0),(222,121,'A12.5.3','Restrictions on changes to software packages','Modifications to software packages shall be discouraged, limited to necessary changes, and all changes shall be strictly controlled.',0),(223,121,'A12.5.4','Information leakage','Opportunities for information leakage shall be prevented.',0),(224,121,'A12.5.5','Outsourced software development','Outsourced software development shall be supervised and monitored by the organization.',0),(225,123,'A13.1.2','Reporting security weaknesses','All employees, contractors and third party users of information systems and services shall be required to note and report any observed or suspected security weaknesses in systems or services.',0),(226,124,'A13.2.2','Learning from information security incidents ','There shall be mechanisms in place to enable the types, volumes, and costs of information security incidents to be quantified and monitored.',0),(227,124,'A13.2.3','Collection of evidence','Where a follow-up action against a person or organization after an information security incident involves legal action (either civil or criminal), evidence shall be collected, retained, and presented to conform to the rules for evidence laid down in the relevant jurisdiction(s).',0),(228,125,'A14.1.2','Business continuity and risk analysis','Events that can cause interruptions to business processes shall be identified, along with the probability and impact of such interruptions and their consequences for information security.',0),(229,125,'A14.1.3','Developing and implementing continuity plans including information security','Plans shall be developed and implemented to maintain or restore operations and ensure availability of information at the required level and in the required time scales following interruption to, or failure of, critical business processes.',0),(230,125,'A14.1.4','Business continuity planning framework','A single framework of business continuity plans shall be maintained to ensure all plans are consistent, to consistently address information security requirements, and to identify priorities for testing and maintenance.',0),(231,125,'A14.1.5','Testing, maintaining and re-assessing business continuity plans','Business continuity plans shall be tested and updated regularly to ensure that they are up to date and effective.',0),(232,126,'A15.1.2','Intellectual property rights (IPR)','Appropriate procedures shall be implemented to ensure compliance with legislative, regulatory, and contractual requirements on the use of material in respect of which there may be intellectual property rights and on the use of proprietary software products.',0),(233,126,'A15.1.3','Protection of organizational records','Important records shall be protected from loss, destruction and falsification, in accordance with statutory, regulatory, contractual, and business requirements.',0),(234,126,'A15.1.4','Data protection and privacy of personal information','Data protection and privacy shall be ensured as required in relevant legislation, regulations, and, if applicable, contractual clauses.',0),(235,126,'A15.1.5','Prevention of misuse of information processing facilities','Users shall be deterred from using information processing facilities for unauthorized purposes.',0),(236,126,'A15.1.6','Regulation of cryptographic controls','Cryptographic controls shall be used in compliance with all relevant agreements, laws, and regulations.',0),(237,127,'A15.2.2','Technical compliance checking','Information systems shall be regularly checked for compliance with security implementation standards.',0),(238,128,'A15.3.2','Protection of information systems audit tools','Access to information systems audit tools shall be protected to prevent any possible misuse or compromise.',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compliance_package_tbl`
--

LOCK TABLES `compliance_package_tbl` WRITE;
/*!40000 ALTER TABLE `compliance_package_tbl` DISABLE KEYS */;
INSERT INTO `compliance_package_tbl` VALUES (89,11,'A5.1','Information security policy','To provide management direction and support for information security in accordance with business requirements and relevant laws and regulations.',0),(90,11,'A.6.1','Internal Organization','To manage information security within the organization.',0),(91,11,'A6.2','External parties','To maintain the security of organization\'s information and information processing facilities that are accessed, processed, communicated to, or managed by external parties.',0),(92,11,'A.7.1','Responsibility for assets','To achieve and maintain appropriate protection of organizational assets.',0),(93,11,'A.7.2','Information classification','To ensure that information receives an appropriate level of protection.',0),(94,11,'A.8.1','Prior to employment','To ensure that employees, contractors and third party users understand their responsibilities, and are suitable for the roles they are considered for, and to reduce the risk of theft, fraud or misuse of facilities.',0),(95,11,'A.8.2','During employment','To ensure that all employees, contractors and third party users are aware of information security threats and concerns, their responsibilities and liabilities, and are equipped to support organizational security policy in the course of their normal work, and to reduce the risk of human error.',0),(96,11,'','','',0),(97,11,'A.8.3','Termination or change of employment','To ensure that employees, contractors and third party users exit an organization or change employment in an orderly manner.',0),(98,11,'A9.1','Secure areas','To prevent unauthorized physical access, damage and interference to the organization\'s premises and information.',0),(99,11,'A9.2','Equipment security','To prevent loss, damage, theft or compromise of assets and interruption to organization\'s activities.',0),(100,11,'A10.1','Operational procedures and responsibilities','To ensure the correct and secure operation of information processing facilities.',0),(101,11,'A10.2','Third party service delivery management','To implement and maintain the appropriate level of information security and service delivery in line with third party service delivery agreements.',0),(102,11,'A10.3','System planning and acceptance','To minimize the risk of systems failure.',0),(103,11,'A10.4','Protection against malicious and mobile code ','To protect the integrity of software and information.',0),(104,11,'A10.5','Back-up','To maintain the integrity and availability of information and information processing facilities.',0),(105,11,'A10.6','Network security management','To ensure the protection of information in networks and the protection of the supporting infrastructure.',0),(106,11,'A10.7','Media handling','To prevent unauthorized disclosure, modification, removal or destruction of assets, and interruption to business activities.',0),(107,11,'A10.8','Exchange of information','To maintain the security of information and software exchanged within an organization and with any external entity.',0),(108,11,'A10.9','Electronic commerce services','To ensure the security of electronic commerce services, and their secure use.',0),(109,11,'A10.10','Monitoring ','To detect unauthorized information processing activities.',0),(110,11,'A11.1','Business requirement for access control','To control access to information.',0),(111,11,'A11.2','User access management','To ensure authorized user access and to prevent unauthorized access to information systems',0),(112,11,'A11.3','User responsibilities','To prevent unauthorized user access, and compromise or theft of information and information processing facilities.',0),(113,11,'A11.4','Network access control','To prevent unauthorized access to networked services.',0),(114,11,'A11.5','Operating system access control','To prevent unauthorized access to operating systems.',0),(115,11,'A11.6','Application and information access control','To prevent unauthorized access to information held in application systems.',0),(116,11,'A11.7','Mobile computing and Teleworking','To ensure information security when using mobile computing and teleworking facilities.',0),(117,11,'A12.1','Security requirements of information systems','To ensure that security is an integral part of information systems.',0),(118,11,'A12.2','Correct processing in applications','To prevent errors, loss, unauthorized modification or misuse of information in application.',0),(119,11,'A12.3','Cryptographic controls','To protect the confidentiality, authenticity or integrity of information by cryptographic means.',0),(120,11,'A12.4','Security of system files','To ensure the security of system files',0),(121,11,'A12.5','Security in development and support processes','To maintain the security of application system software and information.',0),(122,11,'A12.6','Technical Vulnerability Management','To reduce risks resulting from exploitation of published technical vulnerabilities.',0),(123,11,'A13.1','Reporting information security events and weaknesses','To ensure information security events and weaknesses associated with information systems are communicated in a manner allowing timely corrective action to be taken.',0),(124,11,'A13.2','Management of information security incidents and improvements','To ensure a consistent and effective approach is applied to the management of information security incidents.',0),(125,11,'A14.1','Information security aspects of business continuity management','To counteract interruptions to business activities and to protect critical business processes from the effects of major failures of information systems or disasters and to ensure their timely resumption.',0),(126,11,'A15.1','Compliance with legal requirements','To avoid breaches of any law, statutory, regulatory or contractual obligations, and of any security requirements.',0),(127,11,'A15.2','Compliance with security policies and standards, and technical compliance','To ensure compliance of systems with organizational security policies and standards',0),(128,11,'A15.3','Information system audit considerations','To maximize the effectiveness of and to minimize interference to/from the information systems audit process.',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=14701 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `security_services_audit_tbl`
--

LOCK TABLES `security_services_audit_tbl` WRITE;
/*!40000 ALTER TABLE `security_services_audit_tbl` DISABLE KEYS */;
INSERT INTO `security_services_audit_tbl` VALUES (14677,37,1,2,2013,'Nothing yet','','0000-00-00','0000-00-00','',0,'',1),(14678,37,1,8,2013,'Nothing yet','','0000-00-00','0000-00-00','',0,'',1),(14679,39,1,4,2013,'nothing yet','','0000-00-00','0000-00-00','',0,'',1),(14680,39,1,8,2013,'nothing yet','','0000-00-00','0000-00-00','',0,'',1),(14681,260,1,4,2013,'Total number of computers with AV deployed','','0000-00-00','0000-00-00','',0,'',0),(14682,260,1,7,2013,'Total number of computers with AV deployed','','0000-00-00','0000-00-00','',0,'',0),(14683,260,1,10,2013,'Total number of computers with AV deployed','','0000-00-00','0000-00-00','',0,'',0),(14684,261,1,3,2013,'Visit wiki link','','0000-00-00','0000-00-00','',0,'',0),(14685,261,1,6,2013,'Visit wiki link','','0000-00-00','0000-00-00','',0,'',0),(14686,261,1,9,2013,'Visit wiki link','','0000-00-00','0000-00-00','',0,'',0),(14687,261,1,12,2013,'Visit wiki link','','0000-00-00','0000-00-00','',0,'',0),(14688,263,1,5,2013,'At least 90 days of video backups must be available.','','0000-00-00','0000-00-00','',0,'',0),(14689,264,1,5,2013,'At least 90 days of video backups must be available.','','0000-00-00','0000-00-00','',0,'',0),(14690,265,1,5,2013,'At least 90 days of video backups must be available.','','0000-00-00','0000-00-00','',0,'',0),(14691,266,1,3,2013,'Random check on 10 laptops','','0000-00-00','0000-00-00','',0,'',0),(14692,266,1,6,2013,'Random check on 10 laptops','','0000-00-00','0000-00-00','',0,'',0),(14693,266,1,10,2013,'Random check on 10 laptops','','0000-00-00','0000-00-00','',0,'',0),(14694,267,1,1,2013,'Random check on 10 network devices','','0000-00-00','0000-00-00','',0,'',0),(14695,267,1,4,2013,'Random check on 10 network devices','','0000-00-00','0000-00-00','',0,'',0),(14696,267,1,7,2013,'Random check on 10 network devices','','0000-00-00','0000-00-00','',0,'',0),(14697,267,1,11,2013,'Random check on 10 network devices','','0000-00-00','0000-00-00','',0,'',0),(14698,261,1,4,2013,'Visit wiki link','','0000-00-00','0000-00-00','',0,'',0),(14699,262,1,6,2013,'Number of Severe vulnerabilities found','','0000-00-00','0000-00-00','',0,'',0),(14700,263,1,7,2013,'At least 90 days of video backups must be available.','','0000-00-00','0000-00-00','',0,'',0);
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
INSERT INTO `security_services_catalogue_audit_calendar_join` VALUES (0,6),(0,11),(0,1),(0,12),(264,5),(266,3),(266,6),(266,10),(267,1),(267,4),(267,7),(267,11),(260,7),(261,4),(262,6),(263,7),(265,5);
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
) ENGINE=InnoDB AUTO_INCREMENT=345 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `security_services_tbl`
--

LOCK TABLES `security_services_tbl` WRITE;
/*!40000 ALTER TABLE `security_services_tbl` DISABLE KEYS */;
INSERT INTO `security_services_tbl` VALUES (260,'Corporate Antivirus','Control virus worms etc.','http://projects.corp.globant.com/trac/glb-security/wiki/AV',4,'Total number of computers with AV deployed','> %80',0,0,0.00,0),(261,'Regular Vulnerability Scanning - External','Control technical vulnerabilities','http://projects.corp.globant.com/trac/glb-security/wiki/VulnerabilityScanDetails',4,'Visit wiki link','Visit wiki link',0,0,0.00,0),(262,'Regular Vulnerability Scanning - Internal','Control technical vulnerabilities','http://projects.corp.globant.com/trac/glb-security/wiki/VulnerabilityScanDetails',2,'Number of Severe vulnerabilities found','Visit wiki link',0,0,0.00,0),(263,'CCTV - Laminar','Monitor access to facilities and offices','https://drive.google.com/a/globant.com/#folders/0B-jGZCVkUOtZejNkcEFfVXBOUHM',4,'At least 90 days of video backups must be available.','Must Exist',0,0,0.00,0),(264,'CCTV - SP','Monitor access to facilities and offices','https://drive.google.com/a/globant.com/#folders/0B-jGZCVkUOtZcW1MTHFZT1o2SXM',4,'At least 90 days of video backups must be available.','Must Exist',0,0,0.00,0),(265,'CCTV - NP','Monitor access to facilities and offices','https://drive.google.com/a/globant.com/#folders/0B-jGZCVkUOtZcW1MTHFZT1o2SXM',4,'At least 90 days of video backups must be available.','Must Exist',0,0,0.00,0),(266,'Laptop Encryption Policy','Minimize the likelihood of undesired disclosure of information','https://drive.google.com/a/globant.com/#folders/0B-jGZCVkUOtZcW5ybHpiSG5KM1k',4,'Random check on 10 laptops','> 8 Encrypted',0,0,0.00,0),(267,'User Administrator reviews of network devices','Review that only the network team has access to the network devices','http://projects.corp.globant.com/trac/glb-security/wiki/Network_Security',4,'Random check on 10 network devices','%100 Accuracy',0,0,0.00,0),(268,'PBX DOS Log Detector','Detect DOS attacks against the PBX','http://projects.corp.globant.com/trac/glb-security/wiki/PBX_DOS_Blocker',NULL,'Number of blocked IPs','> 1',NULL,NULL,NULL,0),(269,'PMO Share drive user review','','',NULL,'','',NULL,NULL,NULL,0),(270,'General Data Access Criteria Matrix','The matrix provides the criteria for service desk and other teams to allow or grant access without asking permission to GIST','http://projects.corp.globant.com/trac/glb-security/wiki/Administration_Rights_Matrix_Approval',NULL,'Review three TAR\'s where exceptions where approved.','%100 Accuracy',NULL,NULL,NULL,0),(271,'Fire Detection Systems - SP','Prevent fires at the offices','https://drive.google.com/a/globant.com/#folders/0B-jGZCVkUOtZMEpPY1AwLUpLckU',NULL,'Generate smoke until the alarm triggers','Must Trigger the Alarm',NULL,NULL,NULL,0),(272,'Fire Detection Systems - NP','Prevent fires at the offices','https://drive.google.com/a/globant.com/#folders/0B-jGZCVkUOtZMEpPY1AwLUpLckU',NULL,'Generate smoke until the alarm triggers','Must Trigger the Alarm',NULL,NULL,NULL,0),(273,'Security Awareness Trainings','Ensure all Globers understand the basic concepts of Globant Security.','http://projects.corp.globant.com/trac/glb-security/wiki/Security_Awareness',NULL,'Number of employees (Human Resources) divided the number of compliant employees  (Log into wonderland)','>%80',NULL,NULL,NULL,0),(274,'People Care - File Drive','Users and Access Reviews','http://projects.corp.globant.com/trac/glb-security/wiki/Audit_Share_Drives',NULL,'The members assigned to groups must all be valid','%100 Accuracy',NULL,NULL,NULL,0),(275,'Google Apps Mobile Phone Policy','Ensure all Globant mobile devices used by employees have the Mobile GPO applied.','http://projects.corp.globant.com/trac/glb-security/wiki/mobile_security',NULL,'Random check on 10 users with Android or iOS phones and validation that the security policy is enforced','>%80',NULL,NULL,NULL,0),(276,'Wifi WPA2 Encryption','Ensure all Wifi Corporate access requires credentials from the AD','https://drive.google.com/a/globant.com/#folders/0B-jGZCVkUOtZUnpwV3BmU3poWXM',NULL,'Verificar configuracion random de 2 APs ensure WPA2 is enforced.','%100 Accuracy',NULL,NULL,NULL,0),(277,'Astaro VPN SSL','','',NULL,'','',NULL,NULL,NULL,0),(278,'Secure Disposal of Data and Equipment','Ensure all data located at systems which are re-assigned or discarded is securely removed.','',NULL,'Shred receipt for every quarter','%100 Accuracy',NULL,NULL,NULL,0),(279,'Laptops and Desktops Windows Standard Image','Ensure all systems use the same operating systems','https://drive.google.com/a/globant.com/#folders/0B-jGZCVkUOtZZHdsVjRzaWRkdlk',NULL,'Random 10 PCs se analiza si estan built con la imagen estandard','%100 Accuracy',NULL,NULL,NULL,0),(280,'Laptops and Desktops Mac-OS Standard Configuration','This control aims to secure the deployment of OSx computers.','',NULL,'','',NULL,NULL,NULL,0),(281,'Motion Alarms - SP','Detect un-authorized access to the offices','https://drive.google.com/a/globant.com/#folders/0B-jGZCVkUOtZZ3B6ZE5LYlFZLW8',NULL,'Trigger the alarm','Alarm must trigger correctly',NULL,NULL,NULL,0),(282,'Motion Alarms - NP','Detect un-authorized access to the offices','https://drive.google.com/a/globant.com/#folders/0B-jGZCVkUOtZZ3B6ZE5LYlFZLW8',NULL,'Trigger the alarm','Alarm must trigger correctly',NULL,NULL,NULL,0),(283,'Disponible','','',NULL,'','',NULL,NULL,NULL,0),(284,'Disponible','','',NULL,'','',NULL,NULL,NULL,0),(285,'Globant AD GPO','Ensure all end-point systems have consistent security policies','https://drive.google.com/a/globant.com/#folders/0B-jGZCVkUOtZN1F0WmpEZFV5Rk0',NULL,'Random test on 5 computers and check if the user is associated with the AD and the GPO main components are enabled.','%100 Accuracy',NULL,NULL,NULL,0),(286,'Log Book - NP','Ensure all visitors are documented','',NULL,'Ensure log books for the last 6 months exist and are available for review','%100 Accuracy',NULL,NULL,NULL,0),(287,'Log Book - SP','Ensure all visitors are documented','',NULL,'Ensure log books for the last 6 months exist and are available for review','%100 Accuracy',NULL,NULL,NULL,0),(288,'Disponible','','',NULL,'','',NULL,NULL,NULL,0),(289,'InvGate Software Reviews','Review the software deployed on the end-point stations','http://projects.corp.globant.com/trac/glb-security/wiki/End_User_Software_Reviews',NULL,'Non-authorized software reports being reviewed and users warned when not-complying.','%30 less than previous audit',NULL,NULL,NULL,0),(290,'Disponible','','',NULL,'','',NULL,NULL,NULL,0),(291,'Glow Periodic Administrator Rights Reviews','Ensure only the appropriate administrators can handle Glow information in particular billing information. (subject to SOX compliance etc).','',NULL,'Roles de administrators','',NULL,NULL,NULL,0),(292,'Trac-Internal Periodic User Reviews','Ensure only the appropriate administrators can handle repository information','http://projects.corp.globant.com/trac/glb-security/wiki/Trac_Access_Reviews',NULL,'Number of projects with more than 3 administrators Number of administrators discrepancies','',NULL,NULL,NULL,0),(293,'Trac-External Periodic User Reviews','Ensure only the appropriate administrators can handle repository information','http://projects.corp.globant.com/trac/glb-security/wiki/Trac_Access_Reviews',NULL,'Number of projects with more than 3 administrators Number of administrators discrepancies under 20 items','%80 Accuracy',NULL,NULL,NULL,0),(294,'Globant Systems Backup Policy','Ensure adequate backups exist for sensitive information and restore tests are done at regular intervals.','Undef',NULL,'Ver si se puede tener un log del restore\rLink de Pablo con el calendar de los backups','Undef',NULL,NULL,NULL,0),(295,'Physical Access Controls - Laminar','Control de access of individuals to Globant offices','https://drive.google.com/a/globant.com/?tab=mo#folders/0B0VAFRDML31HMzF6WHlwV2FYNU0',NULL,'Number of discrepancies between Globant Human Resources list and allowed users on the physical controls.','< 5%',NULL,NULL,NULL,0),(296,'Physical Access Controls - NP','Control de access of individuals to Globant offices','https://drive.google.com/a/globant.com/#folders/0B4nryaoxlRBRSEhuMjV6Q1hGcGM',NULL,'Number of discrepancies between Globant Human Resources list and allowed users on the physical controls.','< 5%',NULL,NULL,NULL,0),(297,'Physical Access Controls - SP','Control de access of individuals to Globant offices','https://drive.google.com/a/globant.com/#folders/0B4nryaoxlRBRSEhuMjV6Q1hGcGM',NULL,'Number of discrepancies between Globant Human Resources list and allowed users on the physical controls.','< 5%',NULL,NULL,NULL,0),(298,'Review of Rogue Wifi APs','Ensure there\'s no access to Globant network trough non-standard wifi APs','https://drive.google.com/a/globant.com/?tab=mo#folders/0B4nryaoxlRBRN0RwNzBlN1dXQTA',NULL,'Verificar que no haya rogue wifi\'s en las oficinas de Globant. Verificar la configuracion de los AP y hacer una recorrida por el edificio buscando rouge access points.','%100 Accurate',NULL,NULL,NULL,0),(299,'Glow - Database User Reviews','Ensure that only the required users have access to the Prod and Dev databases of Glow','http://projects.corp.globant.com/trac/glb-security/wiki/Glow',NULL,'Number of wrong users (old changed roles etc)','%30 less than previous audit',NULL,NULL,NULL,0),(300,'CCTV - Tucuman','Monitor access to facilities and offices','',NULL,'At least 90 days of video backups must be available.','Must Exist',NULL,NULL,NULL,0),(301,'CCTV - Rosario','Monitor access to facilities and offices','https://drive.google.com/a/globant.com/#folders/0B0VAFRDML31HbV9na2ROaXFKdGc',NULL,'At least 90 days of video backups must be available.','Must Exist',NULL,NULL,NULL,0),(302,'CCTV - Chaco','Monitor access to facilities and offices','https://drive.google.com/a/globant.com/#folders/0B0VAFRDML31HMmJUc3cwS1FiTWM',NULL,'At least 90 days of video backups must be available.','Must Exist',NULL,NULL,NULL,0),(303,'CCTV - Bogota','Monitor access to facilities and offices','N/A',NULL,'At least 90 days of video backups must be available.','Must Exist',NULL,NULL,NULL,0),(304,'Globant-Employee NDA Agreements','Ensure Globant employee have NDA signed.','https://drive.google.com/a/globant.com/#folders/0B0VAFRDML31HLVhPSkVWLXVsdTQ',NULL,'Ten random employees NDA\'s','%100 Accuracy',NULL,NULL,NULL,0),(305,'Customer-Globant Employee NDA Agreements','Ensure Globant customers specific NDA are in use.','https://drive.google.com/a/globant.com/#folders/0B0VAFRDML31HSFp6ZVdSNjEtMjQ',NULL,'Five random employees assigned to a customer where a specific NDA','%100 Accuracy',NULL,NULL,NULL,0),(306,'Screening Checks - Physical Aptitude','It\'s a legal requirement that all employees complete a physical aptitude check','https://drive.google.com/a/globant.com/#folders/0B0VAFRDML31HQWk4eUwzUUVTWUE',NULL,'Five random employees reviews of their hiring files','%100 Accuracy',NULL,NULL,NULL,0),(307,'Screening Checks - Customer Specific Backgrounds Check','Some customers require specific background checks.','https://drive.google.com/a/globant.com/#folders/0B0VAFRDML31HQWk4eUwzUUVTWUE',NULL,'Ten random employees assigned to a customer with this requirement','%100 Accuracy',NULL,NULL,NULL,0),(308,'Clear Desk Policy','Ensure no sensitive documents are left on desktops and public areas.','',NULL,'Walk-trough around offices','%100 Accuracy',NULL,NULL,NULL,0),(309,'Paper Shreders','Paper Shredders are deployed close to printing areas so people is well aware of their responsibilities. ','https://drive.google.com/a/globant.com/?pli=1#folders/0B4nryaoxlRBRYnNvZ1RtSzhuNFE',NULL,'Review that more than %50 of the Shredders at SP or NP are being used.','%100 Accuracy',NULL,NULL,NULL,0),(310,'UPS Systems / Diesel Generator - SP','UPS are required to provide availability to critical systems in the case of energy disruption.','https://drive.google.com/a/globant.com/?tab=mo#folders/0B0VAFRDML31HMlA0b21mWHZIQms',NULL,'The UPS/Power Generator will start running when a power shortage happens.','%100 Accuracy',NULL,NULL,NULL,0),(311,'UPS Systems / Diesel Generator - NP','UPS are required to provide availability to critical systems in the case of energy disruption.','https://drive.google.com/a/globant.com/?tab=mo#folders/0B0VAFRDML31HMlA0b21mWHZIQms',NULL,'The UPS/Power Generator will start running when a power shortage happens.','%100 Accuracy',NULL,NULL,NULL,0),(312,'UPS Systems / Diesel Generator - Laminar','UPS are required to provide availability to critical systems in the case of energy disruption.','https://drive.google.com/a/globant.com/?tab=mo#folders/0B0VAFRDML31Hd3hVcXhzQnZqSHM',NULL,'The UPS/Power Generator will start running when a power shortage happens.','%100 Accuracy',NULL,NULL,NULL,0),(313,'UPS Systems - Datacenter Telmex','','',NULL,'No metrica - Out of Scope','',NULL,NULL,NULL,0),(314,'UPS Systems - Datacenter Global Crossing','','',NULL,'No metrica - Out of Scope','',NULL,NULL,NULL,0),(315,'Network Firewalls','Firewalls are utilised to control access to networks in particular from un-secured zones to secured zones.','https://drive.google.com/a/globant.com/?tab=mo#folders/0B4nryaoxlRBRSTM4RzllRV9KY3c',NULL,'Check 5 random TarTool tickets to see if the implementation on the firewall was performed according to the request.','%100 Accuracy',NULL,NULL,NULL,0),(316,'Envision SIEM','','',4,'Describe the metric','Describe the metric success criteria',0,9000,0.00,0),(317,'Globant Time Server','Verify that all devices are synchronized against our corporate ntp server. ','',NULL,'Elegir 5 servers random y verificar que este configurado el NTP \rGenerar evidencia','%100 Accuracy',NULL,NULL,NULL,0),(318,'Centralised Logging ','','',NULL,'Central repository of logs','',NULL,NULL,NULL,0),(319,'Business Continuity Plans','To provide continuity of services in the event of mayor availability incidents.','https://drive.google.com/a/globant.com/?tab=mo#folders/0B-jGZCVkUOtZcEFSQlNxVnVpZEk',NULL,'BCM Plan\'s testing','',NULL,NULL,NULL,0),(320,'CCTV - Datacenter Global Crossing','','',NULL,'No metrica - Out of Scope','',NULL,NULL,NULL,0),(321,'CCTV - Datacenter Telmex','','',NULL,'No metrica - Out of Scope','',NULL,NULL,NULL,0),(322,'Fire Alarm - Datacenter Global Crossing','','',NULL,'No metrica - Out of Scope','',NULL,NULL,NULL,0),(323,'Fire Alarm - Datacenter Telmex','','',NULL,'No metrica - Out of Scope','',NULL,NULL,NULL,0),(324,'Motion Sensors - Datacenter Telmex','','',NULL,'No metrica - Out of Scope','',NULL,NULL,NULL,0),(325,'Manned Guards - Datacenter Global Crossing','','',NULL,'No metrica - Out of Scope','',NULL,NULL,NULL,0),(326,'Motion Sensors - Datacenter Global Crossing','','',NULL,'No metrica - Out of Scope','',NULL,NULL,NULL,0),(327,'Manned Security - Datacenter Telmex','','',NULL,'No metrica - Out of Scope','',NULL,NULL,NULL,0),(328,'Manned Guards - SP','Provide manned security at Globant offices','',NULL,'Random check if they controlled la gente de limpieza (CCTV) y si el libro de visitas esta completo.','%100 Accuracy checking cleaning personal and logbook',NULL,NULL,NULL,0),(329,'Manned Guards - NP','Provide manned security at Globant offices','',NULL,'Random check if they controlled la gente de limpieza (CCTV) y si el libro de visitas esta completo.','%100 Accuracy checking cleaning personal and logbook',NULL,NULL,NULL,0),(330,'Standard Linux Servers Configuration','Verify that Linux Servers are built according to the server security standard configuration.','',NULL,'Check 3 random servers/vms for standard configuration.','100% Accuracy',NULL,NULL,NULL,0),(331,'Standard Windows Servers Configuration','Verify that Windows Servers are built according to the server security standard configuration.','',NULL,'Check 3 random servers/vms for standard configuration.','100% Accuracy',NULL,NULL,NULL,0),(332,'Standard Switches Routers Configuration','Verify that network devices are built according to network device security standard configuration.','',NULL,'Check 3 random switches/routers for standard configuration.','100% Accuracy',NULL,NULL,NULL,0),(333,'CCTV - Cordoba','Monitor access to facilities and offices','https://drive.google.com/a/globant.com/#folders/0B0VAFRDML31HMGhBLUZuYVplTTg',NULL,'At least 90 days of video backups must be available.','Must Exist',NULL,NULL,NULL,0),(334,'System Patching','All the management required to keep sytems patched up to date','http://projects.corp.globant.com/trac/glb-security/wiki/WSUS',NULL,'The extent to which security patches has been applied.','%90 of critical and security patches applied',NULL,NULL,NULL,0),(335,'Glober change of assignment','Verify that responsibilities are defined when a job change is performed.','https://drive.google.com/a/globant.com/?pli=1#folders/0B0VAFRDML31HY1Bnel82UEtxVEk',NULL,'','',NULL,NULL,NULL,0),(336,'Legal Team Repository User Review','Verify that only authorized users are able to access this folder.','https://drive.google.com/a/globant.com/#folders/0B-jGZCVkUOtZaXZudzhCMU5ESVk',NULL,'Check that only authorized users have access to this folder.','%100 Accuracy',NULL,NULL,NULL,0),(337,'Redundant Network Connectivity','Provide alternative paths to Internet by the use of multiple Internet carriers where possible',' https://drive.google.com/a/globant.com/?tab=mo#folders/0B4nryaoxlRBRRzFhWnJNeWtQbFE',NULL,'Routing to backup carriers must work with manual intervention (not automated)','Alternative Path must work',NULL,NULL,NULL,0),(338,'Glober Assets Lifecycle','Verify that employees return all of the organization??s assets when the employment is finished.','https://drive.google.com/a/globant.com/?pli=1#folders/0B0VAFRDML31HTXlBU3g0bGFCcUE',NULL,'Review that 5 assets assigned have the right owners.','%100 Accuracy',NULL,NULL,NULL,0),(339,'SAP Systems User Reviews Management','','',NULL,'No creeping priviledges','%100 Accurate Users',NULL,NULL,NULL,0),(340,'Publishing Applications and Data Assets','This control is designed to control the way servers information systems data etc is published from our internal networks to external ones.','https://drive.google.com/a/globant.com/?tab=mo#folders/0B4nryaoxlRBRanZrajR6ZFRPOFU',NULL,'','',NULL,NULL,NULL,0),(341,'Awareness Training - Managers','There\'s an explicit training (on top of the base training) for managers that indicates their responsability in terms of ensuring the security policies are being followed by their directs.',' https://drive.google.com/a/globant.com/?tab=mo#folders/0B4nryaoxlRBRZWpLakJhWGNDZ3c',NULL,'','',NULL,NULL,NULL,0),(342,'Google Apps Administrator User Reviews','','',NULL,'','',NULL,NULL,NULL,0),(343,'Change managment','','https://drive.google.com/a/globant.com/?ndplr=1#folders/0B0VAFRDML31HM3BPdXp6RlNFMUU',NULL,'Check 10 random TarTool tickets from different areas to see if the change is authorized and properly implemented.','%100 Accuracy',NULL,NULL,NULL,0),(344,'IDS','Control traffic coming and going to internet.','https://drive.google.com/a/globant.com/?tab=mo#folders/0B4nryaoxlRBRbnYyRjNkRnlZMXc',NULL,NULL,NULL,NULL,NULL,NULL,0);
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
INSERT INTO `service_contracts_security_services_join` VALUES (316,18);
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_contracts_tbl`
--

LOCK TABLES `service_contracts_tbl` WRITE;
/*!40000 ALTER TABLE `service_contracts_tbl` DISABLE KEYS */;
INSERT INTO `service_contracts_tbl` VALUES (18,'Envision Support','Yearly support of the hardware and basic support hotline',8724,'2013-01-01','2014-01-01',12,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_authorization_tbl`
--

LOCK TABLES `system_authorization_tbl` WRITE;
/*!40000 ALTER TABLE `system_authorization_tbl` DISABLE KEYS */;
INSERT INTO `system_authorization_tbl` VALUES (1,7,'r','system','System Configuration','system_records','System Records',1,'system/system_records_list.php',0),(2,7,'r','system','System Configuration','system_authorization_list','System Authorization',1,'system/system_authorization_list.php',0),(3,7,'r','system','System Configuration','system_roles_list','System Roles',1,'system/system_roles_list.php',0),(4,7,'w','system','System Configuration','system_records','System Records',1,'system/system_records_edit.php',0),(5,7,'w','system','System Configuration','system_authorization_edit','System Authorization',1,'system/system_authorization_edit.php',0),(6,7,'w','system','System Configuration','system_roles_edit','System Roles',1,'system/system_roles_edit.php',0),(7,1,'r','organization','Organization','bu_list','Business Units',1,'organization/bu_list.php',0),(8,1,'w','organization','Organization','bu_edit','Business Units',1,'organization/bu_edit.php',0),(9,1,'r','organization','Organization','legal_list','Legal Constrains',1,'organization/legal_list.php',0),(10,1,'w','organization','Organization','legal_edit','Legal Constrains',1,'organization/legal_edit.php',0),(11,1,'r','organization','Organization','tp_list','Third Parties',1,'organization/tp_list.php',0),(12,1,'w','organization','Organization','tp_edit','Third Parties',1,'organization/tp_edit.php',0),(13,2,'r','asset','Asset Management','asset_classification_list','Asset Classification',1,'asset/asset_classification_list.php',0),(14,2,'w','asset','Asset Management','asset_classification_edit','Asset Classification',1,'asset/asset_classification_edit.php',0),(15,2,'r','asset','Asset Management','asset_list','Asset Identification',1,'asset/asset_list.php',0),(16,2,'w','asset','Asset Management','asset_edit','Asset Identification',1,'asset/asset_edit.php',0),(17,2,'r','asset','Asset Management','data_asset_list','Data Asset Analysis',1,'asset/data_asset_list.php',0),(18,2,'w','asset','Asset Management','data_asset_edit','Data Asset Analysis',1,'asset/data_asset_edit.php',0),(19,3,'r','risk','Risk Management','risk_classification_list','Risk Classification',1,'risk/risk_classification_list.php',0),(20,3,'w','risk','Risk Management','risk_classification_edit','Risk Classification',1,'risk/risk_classification_edit.php',0),(21,3,'r','risk','Risk Management','risk_management_list','Risk Analysis',1,'risk/risk_management_list.php',0),(22,3,'w','risk','Risk Management','risk_management_edit','Risk Analysis',1,'risk/risk_management_edit.php',0),(23,3,'r','risk','Risk Management','risk_exception_list','Risk Exception',1,'risk/risk_exception_list.php',0),(24,3,'w','risk','Risk Management','risk_exception_edit','Risk Exception',1,'risk/risk_exception_edit.php',0),(25,4,'r','security_services','Security Services','security_catalogue_list','Security Catalogue',1,'services/security_catalogue_list.php',0),(26,4,'w','security_services','Security Services','security_catalogue_edit','Security Catalogue',1,'services/security_catalogue_edit.php',0),(27,4,'r','security_services','Security Services','security_services_audit_list','Security Services Audit',1,'services/security_services_audit_list.php',0),(28,4,'w','security_services','Security Services','security_services_audit_edit','Security Services Audit',1,'services/security_services_audit_edit.php',0),(29,4,'r','security_services','Security Services','service_contracts_list','Service Contracts',1,'services/service_contracts_list.php',0),(30,4,'w','security_services','Security Services','service_contracts_edit','Service Contracts',1,'services/service_contracts_edit.php',0),(31,5,'r','compliance','Compliance Management','compliance_package_list','Compliance Packages',1,'compliance/compliance_package_list.php',0),(32,5,'w','compliance','Compliance Management','compliance_package_edit','Compliance Packages',1,'compliance/compliance_package_edit.php',0),(33,5,'w','compliance','Compliance Management','compliance_package_item_edit','Compliance Packages',1,'compliance/compliance_package_item_edit.php',0),(34,5,'w','compliance','Compliance Management','compliance_package_upload','Compliance Packages',1,'compliance/compliance_package_upload.php',0),(35,5,'r','compliance','Compliance Management','compliance_management_list','Compliance Analysis',1,'compliance/compliance_management_list.php',0),(36,5,'r','compliance','Compliance Management','compliance_management_step_two','Compliance Analysis',0,'compliance/compliance_management_list_step_two.php',0),(37,5,'w','compliance','Compliance Management','compliance_management_edit','Compliance Analysis',1,'compliance/compliance_management_edit.php',0),(39,5,'r','compliance','Compliance Management','compliance_management','Compliance Analysis',0,'compliance/compliance_management_list.php',0),(40,5,'r','compliance','Compliance Management','compliance_exception_list','Compliance Exception',1,'compliance/compliance_exception_list.php',0),(41,5,'w','compliance','Compliance Management','compliance_exception_edit','Compliance Exception',1,'compliance/compliance_exception_edit.php',0),(43,6,'r','operations','Security Operations','project_improvements_list','Project Improvements',1,'operations/project_improvements_list.php',0),(44,6,'w','operations','Security Operations','project_improvements_edit','Project Improvements',1,'operations/project_improvements_edit.php',0),(45,6,'w','operations','Security Operations','security_incident_edit','Security Incidents',1,'operations/security_incident_edit.php',0),(46,6,'r','operations','Security Operations','security_incident_list','Security Incidents',1,'operations/security_incident_list.php',0),(47,1,'w','organization','Organization','process_edit','Process',1,'organization/process_edit.php',0),(48,4,'r','security_services','Security Services','dashboard','Dashboard',0,'services/dashboard.php',0),(49,6,'r','operations','Security Operations','security_incident_classification_list','Security Incident Classification',1,'operations/security_incident_classification_list.php',0),(50,6,'w','operations','Security Operations','security_incident_classification_edit','Security Incident Classification',1,'operations/security_incident_classification_edit.php',0),(54,3,'r','risk','Risk Management','dashboard','Dashboard',0,'risk/dashboard.php',0),(55,2,'r','asset','Asset Management','dashboard','Dashboard',0,'asset/dashboard.php',0),(56,NULL,'r','compliance','Compliance Management','dashboard','Dashboard',0,'compliance/dashboard.php',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=5587 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_records_tbl`
--

LOCK TABLES `system_records_tbl` WRITE;
/*!40000 ALTER TABLE `system_records_tbl` DISABLE KEYS */;
INSERT INTO `system_records_tbl` VALUES (5543,'system','system_roles','','','Insert','','2013-01-02 21:13:35'),(5544,'system','system_roles','5','','Update','','2013-01-02 21:13:42'),(5545,'system','system_authorization','','admin','Wrong Login','','2013-01-02 21:18:17'),(5546,'system','system_authorization','1','admin','Login','','2013-01-02 21:21:39'),(5547,'organization','tp','11','','Insert','','2013-01-02 21:31:39'),(5548,'security_services','security_services_audit','','','Export','','2013-01-02 21:36:22'),(5549,'security_services','security_services_audit','','','Export','','2013-01-02 21:37:56'),(5550,'security_services','security_services_audit','','','Export','','2013-01-02 21:37:57'),(5551,'security_services','security_services_audit','','','Export','','2013-01-02 21:38:02'),(5552,'security_services','security_services_audit','','','Export','','2013-01-02 21:38:32'),(5553,'security_services','security_services_audit','','','Export','','2013-01-02 21:39:50'),(5554,'security_services','security_services_audit','','','Export','','2013-01-02 21:40:00'),(5555,'security_services','security_catalogue','','','Insert','','2013-01-02 21:48:44'),(5556,'security_services','security_catalogue','36','','Disable','','2013-01-02 21:49:09'),(5557,'security_services','security_catalogue','','','Insert','','2013-01-02 21:50:52'),(5558,'security_services','security_catalogue','37','','Update','','2013-01-02 21:55:57'),(5559,'security_services','security_catalogue','','','Insert','','2013-01-02 21:59:43'),(5560,'security_services','security_catalogue','39','','Insert','','2013-01-02 22:02:49'),(5561,'security_catalogue','service_contracts','14','','Insert','','2013-01-02 22:07:04'),(5562,'security_catalogue','service_contracts','15','','Insert','','2013-01-02 22:08:15'),(5563,'security_catalogue','service_contracts','16','','Insert','','2013-01-02 22:09:02'),(5564,'security_catalogue','service_contracts','17','','Insert','','2013-01-02 22:09:31'),(5565,'security_services','security_catalogue','37','','Disable','','2013-01-02 22:22:25'),(5566,'security_services','security_catalogue','38','','Disable','','2013-01-02 22:22:26'),(5567,'security_services','security_catalogue','39','','Disable','','2013-01-02 22:22:27'),(5568,'organization','bu','','','Insert','','2013-01-02 22:28:30'),(5569,'security_services','security_catalogue','260','','Update','','2013-01-03 15:14:38'),(5570,'security_services','security_catalogue','260','','Update','','2013-01-03 15:15:58'),(5571,'security_services','security_catalogue','261','','Update','','2013-01-03 15:16:51'),(5572,'security_services','security_catalogue','262','','Update','','2013-01-03 15:17:01'),(5573,'security_services','security_catalogue','263','','Update','','2013-01-03 15:17:24'),(5574,'security_services','security_catalogue','264','','Update','','2013-01-03 15:17:35'),(5575,'security_services','security_catalogue','265','','Update','','2013-01-03 15:17:46'),(5576,'security_services','security_catalogue','264','','Update','','2013-01-03 15:18:00'),(5577,'security_services','security_catalogue','266','','Update','','2013-01-03 15:24:55'),(5578,'security_services','security_catalogue','267','','Update','','2013-01-03 15:25:33'),(5579,'organization','tp','12','','Insert','','2013-01-03 15:29:45'),(5580,'security_catalogue','service_contracts','18','','Insert','','2013-01-03 15:30:53'),(5581,'security_services','security_catalogue','316','','Update','','2013-01-03 15:31:24'),(5582,'security_services','security_catalogue','260','','Update','','2013-01-03 15:32:41'),(5583,'security_services','security_catalogue','261','','Update','','2013-01-03 15:32:48'),(5584,'security_services','security_catalogue','262','','Update','','2013-01-03 15:32:56'),(5585,'security_services','security_catalogue','263','','Update','','2013-01-03 15:33:03'),(5586,'security_services','security_catalogue','265','','Update','','2013-01-03 15:33:29');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_tbl`
--

LOCK TABLES `tp_tbl` WRITE;
/*!40000 ALTER TABLE `tp_tbl` DISABLE KEYS */;
INSERT INTO `tp_tbl` VALUES (11,'ISO27001','',3,0),(12,'Lightech','Envision and RSA suppliers',2,0);
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

-- Dump completed on 2013-01-03 15:47:14
