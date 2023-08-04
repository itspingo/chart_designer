-- MySQL dump 10.13  Distrib 5.7.33, for Win64 (x86_64)
--
-- Host: localhost    Database: snoobix5
-- ------------------------------------------------------
-- Server version	5.7.21

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
-- Table structure for table `active_status`
--

DROP TABLE IF EXISTS `active_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `active_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` varchar(5) DEFAULT NULL,
  `active` varchar(5) NOT NULL DEFAULT '1',
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `active_status`
--

LOCK TABLES `active_status` WRITE;
/*!40000 ALTER TABLE `active_status` DISABLE KEYS */;
INSERT INTO `active_status` VALUES (1,'Yes','1','2022-03-09 13:54:32'),(2,'No','1','2022-03-09 13:54:32');
/*!40000 ALTER TABLE `active_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_image` varchar(100) DEFAULT NULL,
  `blog_title` varchar(500) DEFAULT NULL,
  `blog_contents` text,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` varchar(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (1,'1T0ABJoOBsPmFtimIgZgSz5txLkJaGRyansC5vfN.jpg','Buying a used car? Keep an eye on these things before you do','<p>Buying used cars is an art. It can become extra tricky if they are old used cars. There are many things that can go wrong when you buy a pre-used car. Some people prefer used car dealerships, some preferring buying from individuals. There are some disadvantages of buying a used car from the dealer, like hidden costs, as well as from private sellers, like the shady history of the car. Just keep in mind the chances of Murphy&rsquo;s law when buying something, anything, from a stranger.</p>\r\n\r\n<p>It is all about what to look for and what to ask when buying a second-hand car. Here are some things to know when buying a used car from a private seller or a car dealer in Pakistan. You can call it your second hand car checklist, if you will.</p>\r\n\r\n<h3>Engine</h3>\r\n\r\n<p>There are a handful of things that need to be checked engine-wise before buying your used car. Make sure there is no smoke of any kind. Smoke depending upon the colour can mean something minor like bad fuel mixture to something extreme like needing a complete engine rebuild. Also, listen for odd noise. There should not be any odd and out of the ordinary sounds.</p>\r\n\r\n<p>Also, see if there is any OBD code. New cars are pretty clever and can tell you in detail if there is any nasty hidden surprise for you AFTER you have bought the car. OBD scanning is especially useful for hybrid vehicles and cars with DCT.</p>\r\n\r\n<p>Transmission is also part of this thing. For manual check if the clutch is good or slipping. For newer cars with clever dual clutch transmissions like Honda Vezel, get an expert to thoroughly check it since replacing a DCT&rsquo;s clutch is a massive cost.</p>','2022-04-09 16:12:35','1'),(2,'uploads/eAsGwRMegr8qfn8dgFHh0THanITynymvzMwIRmgl.jpg','this is test blog CDEF','<p>t has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n','2022-04-28 00:41:17','1'),(12,NULL,'Create Your Ultimate Income','<p>&nbsp;gsg sdfg&nbsp;</p>\r\n','2022-04-28 01:46:36','1'),(11,NULL,'Create Your Ultimate Income','<p>&nbsp;gsg sdfg&nbsp;</p>\r\n','2022-04-28 01:40:49','1'),(10,NULL,'Create Your Ultimate Income','<p>&nbsp;gsg sdfg&nbsp;</p>\r\n','2022-04-28 01:39:42','1'),(9,'estERAfzD3gRrIlzAoMdlt7faqL6QIXqJ81QO199.png','this is test blog','<p>ghj fdgh</p>\r\n','2022-04-28 01:12:35','1'),(13,NULL,'this is test blog','<p>s gsdfg sdfg</p>\r\n','2022-04-28 01:47:17','1'),(14,NULL,'this is test blog','<p>s gsdfg sdfg</p>\r\n','2022-04-28 01:47:40','1');
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contactus`
--

DROP TABLE IF EXISTS `contactus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contactus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(200) DEFAULT NULL,
  `email_address` varchar(200) DEFAULT NULL,
  `message` text,
  `reply_message` text,
  `reply_date` date DEFAULT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` varchar(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactus`
--

LOCK TABLES `contactus` WRITE;
/*!40000 ALTER TABLE `contactus` DISABLE KEYS */;
INSERT INTO `contactus` VALUES (1,'Nadeem Iqbal','itspingo@yahoo.com','adf sdfg ',NULL,NULL,'2022-04-06 21:20:53','1');
/*!40000 ALTER TABLE `contactus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dznr_module_fields`
--

DROP TABLE IF EXISTS `dznr_module_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dznr_module_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moduleid` varchar(10) DEFAULT NULL,
  `module_name` varchar(200) DEFAULT NULL,
  `divid` varchar(20) DEFAULT NULL,
  `fieldid` varchar(10) DEFAULT NULL,
  `field_label` varchar(200) DEFAULT NULL,
  `field_name` varchar(200) DEFAULT NULL,
  `old_field_name` varchar(100) DEFAULT NULL,
  `field_type` varchar(100) DEFAULT NULL,
  `isrequired` varchar(5) DEFAULT NULL,
  `display_pos` varchar(10) DEFAULT NULL,
  `display_seq` int(11) DEFAULT NULL,
  `default_value` varchar(200) DEFAULT NULL,
  `range_min` int(11) DEFAULT '0',
  `range_max` int(11) DEFAULT '999999999',
  `item_values` text,
  `list_type` varchar(200) DEFAULT NULL,
  `staticlist` text,
  `codelist` varchar(200) DEFAULT NULL,
  `newcodelist` varchar(200) DEFAULT NULL,
  `listmodulename` varchar(200) DEFAULT NULL,
  `listmoduleitem` varchar(200) DEFAULT NULL,
  `codes_list_name` varchar(100) DEFAULT NULL,
  `onlistpag` varchar(5) DEFAULT NULL,
  `clientid` varchar(50) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  `active` varchar(5) DEFAULT 'Y',
  `userid` varchar(10) DEFAULT NULL,
  `recdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dznr_module_fields`
--

LOCK TABLES `dznr_module_fields` WRITE;
/*!40000 ALTER TABLE `dznr_module_fields` DISABLE KEYS */;
INSERT INTO `dznr_module_fields` VALUES (1,'47','Test modlue Nad3','88954',NULL,'Full Name','full_name',NULL,'text_input','N','',0,'',0,999999999,'','','','','','','','','',NULL,'add','Y',NULL,'2022-07-31 18:36:57'),(2,'47','Test modlue Nad3','5792',NULL,'Full Name','full_name',NULL,'text_input','N','',0,'',0,999999999,'','','','','','','','','',NULL,'add','Y',NULL,'2022-07-31 18:39:40'),(3,'47','test module 2','92102',NULL,'Full Name','full_name',NULL,'text_input','N','',0,'',0,999999999,'','','','','','','','','',NULL,'add','Y',NULL,'2022-07-31 18:41:39'),(4,'48','test module 2','6670',NULL,'Full Name','full_name',NULL,'text_input','N','',0,'',0,999999999,'','','','','','','','','',NULL,'add','Y',NULL,'2022-07-31 22:22:17'),(5,'48','test module 2','18860',NULL,'DOB','dob',NULL,'date_input','N','',0,'',0,999999999,'','','','','','','','','',NULL,'add','Y',NULL,'2022-07-31 22:22:22'),(6,'49','test module 2','34829',NULL,'Full Name','full_name',NULL,'text_input','N','',0,'',0,999999999,'','','','','','','','','',NULL,'add','Y',NULL,'2022-07-31 23:11:01'),(7,'49','test module 2','82233',NULL,'DOB','dob',NULL,'date_input','N','',0,'',0,999999999,'','','','','','','','','',NULL,'add','Y',NULL,'2022-07-31 23:11:07');
/*!40000 ALTER TABLE `dznr_module_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dznr_modules`
--

DROP TABLE IF EXISTS `dznr_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dznr_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(200) NOT NULL,
  `parent_module` varchar(100) DEFAULT '0',
  `module_folder` varchar(50) DEFAULT NULL,
  `module_type` varchar(100) DEFAULT 'application',
  `module_descr` text,
  `module_icon` varchar(50) DEFAULT NULL,
  `table_name` varchar(100) DEFAULT NULL,
  `controller_file` varchar(50) DEFAULT NULL,
  `view_file` varchar(50) DEFAULT NULL,
  `form_code` text,
  `dznr_code` text,
  `filter` varchar(500) DEFAULT NULL,
  `is_hidden` varchar(5) NOT NULL DEFAULT 'N',
  `active` varchar(5) NOT NULL DEFAULT '1',
  `user_id` varchar(10) DEFAULT NULL,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dznr_modules`
--

LOCK TABLES `dznr_modules` WRITE;
/*!40000 ALTER TABLE `dznr_modules` DISABLE KEYS */;
INSERT INTO `dznr_modules` VALUES (1,'Contact Us','0',NULL,'application',NULL,'fa fa-list','contactus',NULL,NULL,NULL,NULL,NULL,'N','1',NULL,'2022-03-09 18:14:24'),(2,'FAQs','0',NULL,'application',NULL,'fa fa-list','faqs',NULL,NULL,NULL,NULL,NULL,'N','1',NULL,'2022-03-09 18:57:07'),(3,'Blogs','0',NULL,'application',NULL,'fa fa-list','blogs',NULL,NULL,NULL,NULL,NULL,'N','1',NULL,'2022-03-09 19:11:50'),(35,'Menu','0',NULL,'application',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'N','1',NULL,'2022-03-29 06:48:41'),(46,'test module 2','0',NULL,'lookup','asd asdf asd',NULL,'test_module_2',NULL,NULL,'',' \r\n	\r\n    &lt;p name=&quot;text_input&quot; id=&quot;92102&quot; draggable=&quot;false&quot; class=&quot;list-group-item dragging&quot;&gt;\r\n\r\n\r\n\r\n			\r\n			&lt;span class=&quot;row&quot;&gt;\r\n				&lt;span class=&quot;col-6 float-left&quot; id=&quot;label_92102&quot;&gt;\r\n					&lt;label&gt;Full Name &lt;/label&gt;\r\n				&lt;/span&gt;\r\n				&lt;span id=&quot;controls_92102&quot; class=&quot;col-6 float-right item_icons item_icons_show&quot; style=&quot;align:right;&quot; align=&quot;right&quot;&gt;\r\n					&lt;a style=&quot;cursor:pointer;color:blue;&quot; onclick=&quot;showattribs(&apos;text_input&apos;, 92102)&quot;&gt;&lt;i class=&quot;bi bi-gear&quot;&gt;&lt;/i&gt;&lt;/a&gt;	\r\n					&lt;a style=&quot;cursor:pointer;color:red;&quot; onclick=&quot;remove_item(92102)&quot;&gt;&lt;i class=&quot;bi bi-trash&quot;&gt;&lt;/i&gt;&lt;/a&gt;\r\n				&lt;/span&gt;\r\n			&lt;/span&gt;\r\n			&lt;span class=&quot;row&quot;&gt;\r\n				&lt;span class=&quot;col-12&quot; id=&quot;input_92102&quot;&gt;\r\n					&lt;input type=&quot;text&quot; name=&quot;full_name&quot; id=&quot;full_name&quot; class=&quot;form-control&quot; value=&quot;&quot;&gt;\r\n					&lt;div style=&quot;color:red;font-size:12px;&quot;&gt;&lt;/div&gt;				&lt;/span&gt;\r\n			&lt;/span&gt;\r\n			\r\n			\r\n &lt;/p&gt;',NULL,'N','1','','2022-07-31 18:47:04'),(47,'test module 2','0',NULL,'lookup','asd asdf asd',NULL,'test_module_2',NULL,NULL,'',' \n	\n    &lt;p name=&quot;text_input&quot; id=&quot;92102&quot; draggable=&quot;false&quot; class=&quot;list-group-item dragging&quot;&gt;\n\n\n\n			\n			&lt;span class=&quot;row&quot;&gt;\n				&lt;span class=&quot;col-6 float-left&quot; id=&quot;label_92102&quot;&gt;\n					&lt;label&gt;Full Name &lt;/label&gt;\n				&lt;/span&gt;\n				&lt;span id=&quot;controls_92102&quot; class=&quot;col-6 float-right item_icons item_icons_show&quot; style=&quot;align:right;&quot; align=&quot;right&quot;&gt;\n					&lt;a style=&quot;cursor:pointer;color:blue;&quot; onclick=&quot;showattribs(&apos;text_input&apos;, 92102)&quot;&gt;&lt;i class=&quot;bi bi-gear&quot;&gt;&lt;/i&gt;&lt;/a&gt;	\n					&lt;a style=&quot;cursor:pointer;color:red;&quot; onclick=&quot;remove_item(92102)&quot;&gt;&lt;i class=&quot;bi bi-trash&quot;&gt;&lt;/i&gt;&lt;/a&gt;\n				&lt;/span&gt;\n			&lt;/span&gt;\n			&lt;span class=&quot;row&quot;&gt;\n				&lt;span class=&quot;col-12&quot; id=&quot;input_92102&quot;&gt;\n					&lt;input type=&quot;text&quot; name=&quot;full_name&quot; id=&quot;full_name&quot; class=&quot;form-control&quot; value=&quot;&quot;&gt;\n					&lt;div style=&quot;color:red;font-size:12px;&quot;&gt;&lt;/div&gt;				&lt;/span&gt;\n			&lt;/span&gt;\n			\n			\n &lt;/p&gt;',NULL,'N','1','','2022-07-31 19:11:06'),(48,'test module 2','0',NULL,'lookup','adsf asdfad',NULL,'test_module_2',NULL,NULL,'',' \n	\n    &lt;p name=&quot;text_input&quot; id=&quot;6670&quot; draggable=&quot;false&quot; class=&quot;list-group-item dragging&quot;&gt;\n\n\n\n			\n			&lt;span class=&quot;row&quot;&gt;\n				&lt;span class=&quot;col-6 float-left&quot; id=&quot;label_6670&quot;&gt;\n					&lt;label&gt;Full Name &lt;/label&gt;\n				&lt;/span&gt;\n				&lt;span id=&quot;controls_6670&quot; class=&quot;col-6 float-right item_icons item_icons_show&quot; style=&quot;align:right;&quot; align=&quot;right&quot;&gt;\n					&lt;a style=&quot;cursor:pointer;color:blue;&quot; onclick=&quot;showattribs(&apos;text_input&apos;, 6670)&quot;&gt;&lt;i class=&quot;bi bi-gear&quot;&gt;&lt;/i&gt;&lt;/a&gt;	\n					&lt;a style=&quot;cursor:pointer;color:red;&quot; onclick=&quot;remove_item(6670)&quot;&gt;&lt;i class=&quot;bi bi-trash&quot;&gt;&lt;/i&gt;&lt;/a&gt;\n				&lt;/span&gt;\n			&lt;/span&gt;\n			&lt;span class=&quot;row&quot;&gt;\n				&lt;span class=&quot;col-12&quot; id=&quot;input_6670&quot;&gt;\n					&lt;input type=&quot;text&quot; name=&quot;full_name&quot; id=&quot;full_name&quot; class=&quot;form-control&quot; value=&quot;&quot;&gt;\n					&lt;div style=&quot;color:red;font-size:12px;&quot;&gt;&lt;/div&gt;				&lt;/span&gt;\n			&lt;/span&gt;\n			\n			\n &lt;/p&gt;&lt;p name=&quot;date_input&quot; id=&quot;18860&quot; draggable=&quot;false&quot; class=&quot;list-group-item dragging&quot;&gt;\n\n\n\n			&lt;span class=&quot;row&quot;&gt;\n				&lt;span class=&quot;col-6 float-left&quot; id=&quot;label_18860&quot;&gt;\n					&lt;label&gt;DOB&lt;/label&gt;\n				&lt;/span&gt;\n				&lt;span id=&quot;controls_18860&quot; class=&quot;col-6 float-right item_icons item_icons_show&quot; style=&quot;align:right;&quot; align=&quot;right&quot;&gt;\n					&lt;a style=&quot;cursor:pointer;color:blue;&quot; onclick=&quot;showattribs(&apos;date_input&apos;, 18860)&quot;&gt;&lt;i class=&quot;bi bi-gear&quot;&gt;&lt;/i&gt;&lt;/a&gt;	\n					&lt;a style=&quot;cursor:pointer;color:red;&quot; onclick=&quot;remove_item(18860)&quot;&gt;&lt;i class=&quot;bi bi-trash&quot;&gt;&lt;/i&gt;&lt;/a&gt;\n					\n				&lt;/span&gt;\n			&lt;/span&gt;\n			&lt;span class=&quot;row&quot;&gt;\n				&lt;span class=&quot;col-12&quot; id=&quot;input_18860&quot;&gt;\n					&lt;input type=&quot;date&quot; name=&quot;dob&quot; id=&quot;dob&quot; class=&quot;form-control&quot; value=&quot;&quot;&gt;\n					&lt;div style=&quot;color:red;font-size:12px;&quot;&gt;&lt;/div&gt;				&lt;/span&gt;\n			&lt;/span&gt;\n				\n\n&lt;/p&gt;',NULL,'N','1','','2022-07-31 22:22:32'),(49,'test module 2','0',NULL,'lookup','asdf asdfa sd',NULL,'test_module_2',NULL,NULL,' \n	\n    &lt;p name=&quot;text_input&quot; id=&quot;34829&quot; draggable=&quot;false&quot; class=&quot;list-group-item dragging&quot;&gt;\n\n\n\n			\n			&lt;span class=&quot;row&quot;&gt;\n				&lt;span class=&quot;col-6 float-left&quot; &gt;\n					&lt;label&gt;Full Name &lt;/label&gt;\n				&lt;/span&gt;\n				&lt;span &gt;\n					&lt;a style=&quot;cursor:pointer;color:blue;&quot; onclick=&quot;showattribs(&apos;text_input&apos;, 34829)&quot;&gt;&lt;i class=&quot;bi bi-gear&quot;&gt;&lt;/i&gt;&lt;/a&gt;	\n					\n				&lt;/span&gt;\n			&lt;/span&gt;\n			&lt;span class=&quot;row&quot;&gt;\n				&lt;span class=&quot;col-12&quot; &gt;\n					&lt;input type=&quot;text&quot; name=&quot;full_name&quot; id=&quot;full_name&quot; class=&quot;form-control&quot; value=&quot;&quot;&gt;\n					&lt;div style=&quot;color:red;font-size:12px;&quot;&gt;&lt;/div&gt;				&lt;/span&gt;\n			&lt;/span&gt;\n			\n			\n &lt;/p&gt;&lt;p &gt;\n\n\n\n			&lt;span class=&quot;row&quot;&gt;\n				&lt;span class=&quot;col-6 float-left&quot; &gt;\n					&lt;label&gt;DOB&lt;/label&gt;\n				&lt;/span&gt;\n				&lt;span &gt;\n						\n					\n					\n				&lt;/span&gt;\n			&lt;/span&gt;\n			&lt;span class=&quot;row&quot;&gt;\n				&lt;span class=&quot;col-12&quot; &gt;\n					&lt;input type=&quot;date&quot; name=&quot;dob&quot; id=&quot;dob&quot; class=&quot;form-control&quot; value=&quot;&quot;&gt;\n					&lt;div style=&quot;color:red;font-size:12px;&quot;&gt;&lt;/div&gt;				&lt;/span&gt;\n			&lt;/span&gt;\n				\n\n&lt;/p&gt;',' \n	\n    &lt;p name=&quot;text_input&quot; id=&quot;34829&quot; draggable=&quot;false&quot; class=&quot;list-group-item dragging&quot;&gt;\n\n\n\n			\n			&lt;span class=&quot;row&quot;&gt;\n				&lt;span class=&quot;col-6 float-left&quot; id=&quot;label_34829&quot;&gt;\n					&lt;label&gt;Full Name &lt;/label&gt;\n				&lt;/span&gt;\n				&lt;span id=&quot;controls_34829&quot; class=&quot;col-6 float-right item_icons item_icons_show&quot; style=&quot;align:right;&quot; align=&quot;right&quot;&gt;\n					&lt;a style=&quot;cursor:pointer;color:blue;&quot; onclick=&quot;showattribs(&apos;text_input&apos;, 34829)&quot;&gt;&lt;i class=&quot;bi bi-gear&quot;&gt;&lt;/i&gt;&lt;/a&gt;	\n					&lt;a style=&quot;cursor:pointer;color:red;&quot; onclick=&quot;remove_item(34829)&quot;&gt;&lt;i class=&quot;bi bi-trash&quot;&gt;&lt;/i&gt;&lt;/a&gt;\n				&lt;/span&gt;\n			&lt;/span&gt;\n			&lt;span class=&quot;row&quot;&gt;\n				&lt;span class=&quot;col-12&quot; id=&quot;input_34829&quot;&gt;\n					&lt;input type=&quot;text&quot; name=&quot;full_name&quot; id=&quot;full_name&quot; class=&quot;form-control&quot; value=&quot;&quot;&gt;\n					&lt;div style=&quot;color:red;font-size:12px;&quot;&gt;&lt;/div&gt;				&lt;/span&gt;\n			&lt;/span&gt;\n			\n			\n &lt;/p&gt;&lt;p name=&quot;date_input&quot; id=&quot;82233&quot; draggable=&quot;false&quot; class=&quot;list-group-item dragging&quot;&gt;\n\n\n\n			&lt;span class=&quot;row&quot;&gt;\n				&lt;span class=&quot;col-6 float-left&quot; id=&quot;label_82233&quot;&gt;\n					&lt;label&gt;DOB&lt;/label&gt;\n				&lt;/span&gt;\n				&lt;span id=&quot;controls_82233&quot; class=&quot;col-6 float-right item_icons item_icons_show&quot; style=&quot;align:right;&quot; align=&quot;right&quot;&gt;\n					&lt;a style=&quot;cursor:pointer;color:blue;&quot; onclick=&quot;showattribs(&apos;date_input&apos;, 82233)&quot;&gt;&lt;i class=&quot;bi bi-gear&quot;&gt;&lt;/i&gt;&lt;/a&gt;	\n					&lt;a style=&quot;cursor:pointer;color:red;&quot; onclick=&quot;remove_item(82233)&quot;&gt;&lt;i class=&quot;bi bi-trash&quot;&gt;&lt;/i&gt;&lt;/a&gt;\n					\n				&lt;/span&gt;\n			&lt;/span&gt;\n			&lt;span class=&quot;row&quot;&gt;\n				&lt;span class=&quot;col-12&quot; id=&quot;input_82233&quot;&gt;\n					&lt;input type=&quot;date&quot; name=&quot;dob&quot; id=&quot;dob&quot; class=&quot;form-control&quot; value=&quot;&quot;&gt;\n					&lt;div style=&quot;color:red;font-size:12px;&quot;&gt;&lt;/div&gt;				&lt;/span&gt;\n			&lt;/span&gt;\n				\n\n&lt;/p&gt;',NULL,'N','1','','2022-07-31 23:11:14');
/*!40000 ALTER TABLE `dznr_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(500) DEFAULT NULL,
  `answer` text,
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` varchar(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (1,'How to start bidding?','All successful bidders can confirm their winning bid by checking the “Sbidu”. In addition, all successful bidders will receive an email notifying them of their winning bid after the auction closes.','2022-04-09 12:01:09','1'),(2,'Security Deposit / Bidding Power','All successful bidders can confirm their winning bid by checking the “Sbidu”. In addition, all successful bidders will receive an email notifying them of their winning bid after the auction closes.','2022-04-09 12:01:31','1'),(3,'Delivery time to the destination port','All successful bidders can confirm their winning bid by checking the “Sbidu”. In addition, all successful bidders will receive an email notifying them of their winning bid after the auction closes.','2022-04-09 12:01:50','1'),(4,'How to register to bid in an auction?','All successful bidders can confirm their winning bid by checking the “Sbidu”. In addition, all successful bidders will receive an email notifying them of their winning bid after the auction closes.','2022-04-09 12:02:07','1'),(5,'How will I know if my bid was successful?','All successful bidders can confirm their winning bid by checking the “Sbidu”. In addition, all successful bidders will receive an email notifying them of their winning bid after the auction closes.','2022-04-09 12:02:21','1'),(6,'What happens if I bid on the wrong lot?','All successful bidders can confirm their winning bid by checking the “Sbidu”. In addition, all successful bidders will receive an email notifying them of their winning bid after the auction closes.','2022-04-09 12:02:39','1');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_modules`
--

DROP TABLE IF EXISTS `sys_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(500) NOT NULL,
  `ctrl_name` varchar(100) DEFAULT NULL,
  `table_name` varchar(50) DEFAULT NULL,
  `module_icon` varchar(50) NOT NULL DEFAULT 'far fa-circle',
  `sort_order` int(5) NOT NULL DEFAULT '1',
  `parent` varchar(10) DEFAULT NULL,
  `active` varchar(5) NOT NULL DEFAULT '1',
  `recdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_modules`
--

LOCK TABLES `sys_modules` WRITE;
/*!40000 ALTER TABLE `sys_modules` DISABLE KEYS */;
INSERT INTO `sys_modules` VALUES (20,'Dashboard','#',NULL,'far fa-circle',1,'0','1','2020-08-25 15:37:11'),(28,'Users','Users',NULL,'far fa-circle',1,NULL,'1','2020-08-25 15:37:11'),(39,'Countries','countries',NULL,'far fa-circle',1,NULL,'N','2020-08-25 15:37:11'),(43,'Roles','Users/roles',NULL,'far fa-circle',1,NULL,'1','2020-08-25 15:37:11'),(44,'Code Generator','code_generator',NULL,'far fa-circle',1,NULL,'1','2020-08-25 15:37:11');
/*!40000 ALTER TABLE `sys_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@email.com',NULL,'$2y$10$dMJDxLYobp2vdFFFyxvJtu1GfevRjIgXKGW/fI3PYSKtVAeWkC.WS',NULL,'2022-03-09 08:19:50','2022-03-09 08:19:50');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-25 20:01:42
