/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.6.24 : Database - db_jzeva_backend
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_jzeva_backend` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_jzeva_backend`;

/*Table structure for table `address` */

DROP TABLE IF EXISTS `address`;

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `company` varchar(40) NOT NULL,
  `address_1` varchar(128) NOT NULL,
  `address_2` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '0',
  `zone_id` int(11) NOT NULL DEFAULT '0',
  `custom_field` text NOT NULL,
  PRIMARY KEY (`address_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `address` */

/*Table structure for table `affiliate` */

DROP TABLE IF EXISTS `affiliate`;

CREATE TABLE `affiliate` (
  `affiliate_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `telephone` varchar(32) NOT NULL,
  `fax` varchar(32) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(9) NOT NULL,
  `company` varchar(40) NOT NULL,
  `website` varchar(255) NOT NULL,
  `address_1` varchar(128) NOT NULL,
  `address_2` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `country_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `code` varchar(64) NOT NULL,
  `commission` decimal(4,2) NOT NULL DEFAULT '0.00',
  `tax` varchar(64) NOT NULL,
  `payment` varchar(6) NOT NULL,
  `cheque` varchar(100) NOT NULL,
  `paypal` varchar(64) NOT NULL,
  `bank_name` varchar(64) NOT NULL,
  `bank_branch_number` varchar(64) NOT NULL,
  `bank_swift_code` varchar(64) NOT NULL,
  `bank_account_name` varchar(64) NOT NULL,
  `bank_account_number` varchar(64) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`affiliate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `affiliate` */

/*Table structure for table `affiliate_activity` */

DROP TABLE IF EXISTS `affiliate_activity`;

CREATE TABLE `affiliate_activity` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `affiliate_id` int(11) NOT NULL,
  `key` varchar(64) NOT NULL,
  `data` text NOT NULL,
  `ip` varchar(40) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`activity_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `affiliate_activity` */

/*Table structure for table `affiliate_login` */

DROP TABLE IF EXISTS `affiliate_login`;

CREATE TABLE `affiliate_login` (
  `affiliate_login_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(96) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `total` int(4) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`affiliate_login_id`),
  KEY `email` (`email`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `affiliate_login` */

/*Table structure for table `affiliate_transaction` */

DROP TABLE IF EXISTS `affiliate_transaction`;

CREATE TABLE `affiliate_transaction` (
  `affiliate_transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `affiliate_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`affiliate_transaction_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `affiliate_transaction` */

/*Table structure for table `api` */

DROP TABLE IF EXISTS `api`;

CREATE TABLE `api` (
  `api_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `key` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`api_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `api` */

insert  into `api`(`api_id`,`name`,`key`,`status`,`date_added`,`date_modified`) values (1,'Default','uwhmiO2YI0tHdKMit0fWgwUajAzUZImGjExGqWIe8gTJzPwWatSJKvowemTtq4PrAXaT2stcqEVkkx0o26bGMpeVCVCeW4coFcnBJzURJZEEjYkmWAN1fjnlTIjAAOVVPJLGw646ufxpIhbmceANTi6hGQolR1OY9c1XCPthZDQSsvHwQBWc9Mre9MgkkvUYJwfVMlaHA8NWFwR6fOT2XBm93rQl6JU9cc5F0pLJpLzIXO7FssII0ZBpEdWOmc96',1,'2015-10-21 10:26:51','2015-10-21 10:26:51');

/*Table structure for table `api_ip` */

DROP TABLE IF EXISTS `api_ip`;

CREATE TABLE `api_ip` (
  `api_ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `api_id` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  PRIMARY KEY (`api_ip_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `api_ip` */

insert  into `api_ip`(`api_ip_id`,`api_id`,`ip`) values (1,1,'::1');

/*Table structure for table `api_session` */

DROP TABLE IF EXISTS `api_session`;

CREATE TABLE `api_session` (
  `api_session_id` int(11) NOT NULL AUTO_INCREMENT,
  `api_id` int(11) NOT NULL,
  `token` varchar(32) NOT NULL,
  `session_id` varchar(32) NOT NULL,
  `session_name` varchar(32) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`api_session_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `api_session` */

insert  into `api_session`(`api_session_id`,`api_id`,`token`,`session_id`,`session_name`,`ip`,`date_added`,`date_modified`) values (1,1,'qznx2UXboVm9luPT2FOJAN4nS8f8n6HT','446rreqc24k0frik4dlvvj20i4','temp_session_56271d50d2788','::1','2015-10-21 10:36:24','2015-10-21 10:36:24'),(2,1,'oOMtzNyogNGFGhZ7RiD5BmCDVZvopFVO','446rreqc24k0frik4dlvvj20i4','temp_session_56271d551eea3','::1','2015-10-21 10:36:29','2015-10-21 10:36:29'),(3,1,'1nvgRCXnFOIZmIJeh3BwsplgPCgb0Tep','446rreqc24k0frik4dlvvj20i4','temp_session_56271e0494797','::1','2015-10-21 10:39:24','2015-10-21 10:39:24'),(4,1,'vohErD6lmSzzrvlrlK1KzmciwPfIrLrV','446rreqc24k0frik4dlvvj20i4','temp_session_56271e3d272da','::1','2015-10-21 10:40:21','2015-10-21 10:40:21'),(5,1,'OnolnXk8AumuH8g1obj7Nb6GcE7MofHi','446rreqc24k0frik4dlvvj20i4','temp_session_56271e73d5858','::1','2015-10-21 10:41:15','2015-10-21 10:41:28'),(6,1,'q8WSDlTZqrHXk10QwUyqcLQfLWnnOZyO','446rreqc24k0frik4dlvvj20i4','temp_session_56271e854ae36','::1','2015-10-21 10:41:33','2015-10-21 10:41:33'),(7,1,'uR9q4pPK9Cacub63tyqTajJUE6esRGGE','446rreqc24k0frik4dlvvj20i4','temp_session_56271ecee83fc','::1','2015-10-21 10:42:46','2015-10-21 10:42:46');

/*Table structure for table `attribute` */

DROP TABLE IF EXISTS `attribute`;

CREATE TABLE `attribute` (
  `attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_group_id` int(11) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`attribute_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `attribute` */

insert  into `attribute`(`attribute_id`,`attribute_group_id`,`sort_order`) values (1,6,1),(2,6,5),(3,6,3),(4,3,1),(5,3,2),(6,3,3),(7,3,4),(8,3,5),(9,3,6),(10,3,7),(11,3,8);

/*Table structure for table `attribute_description` */

DROP TABLE IF EXISTS `attribute_description`;

CREATE TABLE `attribute_description` (
  `attribute_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`attribute_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `attribute_description` */

insert  into `attribute_description`(`attribute_id`,`language_id`,`name`) values (1,1,'Description'),(2,1,'No. of Cores'),(4,1,'test 1'),(5,1,'test 2'),(6,1,'test 3'),(7,1,'test 4'),(8,1,'test 5'),(9,1,'test 6'),(10,1,'test 7'),(11,1,'test 8'),(3,1,'Clockspeed');

/*Table structure for table `attribute_group` */

DROP TABLE IF EXISTS `attribute_group`;

CREATE TABLE `attribute_group` (
  `attribute_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`attribute_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `attribute_group` */

insert  into `attribute_group`(`attribute_group_id`,`sort_order`) values (3,2),(4,1),(5,3),(6,4);

/*Table structure for table `attribute_group_description` */

DROP TABLE IF EXISTS `attribute_group_description`;

CREATE TABLE `attribute_group_description` (
  `attribute_group_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`attribute_group_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `attribute_group_description` */

insert  into `attribute_group_description`(`attribute_group_id`,`language_id`,`name`) values (3,1,'Memory'),(4,1,'Technical'),(5,1,'Motherboard'),(6,1,'Processor');

/*Table structure for table `banner` */

DROP TABLE IF EXISTS `banner`;

CREATE TABLE `banner` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

/*Data for the table `banner` */

insert  into `banner`(`banner_id`,`name`,`status`) values (6,'HP Products',1),(7,'Home Page Slideshow',1),(8,'Manufacturers',1),(77,'Theme Brands',1);

/*Table structure for table `banner_image` */

DROP TABLE IF EXISTS `banner_image`;

CREATE TABLE `banner_image` (
  `banner_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`banner_image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1009 DEFAULT CHARSET=utf8;

/*Data for the table `banner_image` */

insert  into `banner_image`(`banner_image_id`,`banner_id`,`link`,`image`,`sort_order`) values (79,7,'index.php?route=product/product&amp;path=57&amp;product_id=49','catalog/demo/banners/iPhone6.jpg',0),(87,6,'index.php?route=product/manufacturer/info&amp;manufacturer_id=7','catalog/demo/compaq_presario.jpg',0),(94,8,'','catalog/demo/manufacturer/nfl.png',0),(95,8,'','catalog/demo/manufacturer/redbull.png',0),(96,8,'','catalog/demo/manufacturer/sony.png',0),(91,8,'','catalog/demo/manufacturer/cocacola.png',0),(92,8,'','catalog/demo/manufacturer/burgerking.png',0),(93,8,'','catalog/demo/manufacturer/canon.png',0),(88,8,'','catalog/demo/manufacturer/harley.png',0),(89,8,'','catalog/demo/manufacturer/dell.png',0),(90,8,'','catalog/demo/manufacturer/disney.png',0),(80,7,'','catalog/demo/banners/MacBookAir.jpg',0),(97,8,'','catalog/demo/manufacturer/starbucks.png',0),(98,8,'','catalog/demo/manufacturer/nintendo.png',0),(1001,77,'index.php','catalog/brands/brand1.png',0),(1002,77,'index.php','catalog/brands/brand2.png',0),(1003,77,'index.php','catalog/brands/brand3.png',0),(1004,77,'index.php','catalog/brands/brand4.png',0),(1005,77,'index.php','catalog/brands/brand5.png',0),(1006,77,'index.php','catalog/brands/brand6.png',0),(1007,77,'index.php','catalog/brands/brand7.png',0),(1008,77,'index.php','catalog/brands/brand8.png',0);

/*Table structure for table `banner_image_description` */

DROP TABLE IF EXISTS `banner_image_description`;

CREATE TABLE `banner_image_description` (
  `banner_image_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `banner_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  PRIMARY KEY (`banner_image_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `banner_image_description` */

insert  into `banner_image_description`(`banner_image_id`,`language_id`,`banner_id`,`title`) values (79,1,7,'iPhone 6'),(87,1,6,'HP Banner'),(93,1,8,'Canon'),(92,1,8,'Burger King'),(91,1,8,'Coca Cola'),(90,1,8,'Disney'),(89,1,8,'Dell'),(80,1,7,'MacBookAir'),(88,1,8,'Harley Davidson'),(94,1,8,'NFL'),(95,1,8,'RedBull'),(96,1,8,'Sony'),(97,1,8,'Starbucks'),(98,1,8,'Nintendo'),(1001,1,77,'brand01'),(1002,1,77,'brand02'),(1003,1,77,'brand03'),(1004,1,77,'brand04'),(1005,1,77,'brand05'),(1006,1,77,'brand06'),(1007,1,77,'brand07'),(1008,1,77,'brand08');

/*Table structure for table `cart` */

DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `session_id` varchar(32) NOT NULL,
  `product_id` int(11) NOT NULL,
  `recurring_id` int(11) NOT NULL,
  `option` text NOT NULL,
  `quantity` int(5) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `cart_id` (`customer_id`,`session_id`,`product_id`,`recurring_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cart` */

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `top` tinyint(1) NOT NULL,
  `column` int(3) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

/*Data for the table `category` */

insert  into `category`(`category_id`,`image`,`parent_id`,`top`,`column`,`sort_order`,`status`,`date_added`,`date_modified`) values (25,'',0,1,1,4,1,'2009-01-31 01:04:25','2015-12-16 21:01:59'),(64,'',33,0,0,5,1,'2015-11-18 17:25:01','2015-11-18 17:25:01'),(20,'catalog/6.jpg',0,1,6,2,1,'2009-01-05 21:49:43','2015-12-16 21:02:17'),(73,'',20,0,0,6,1,'2015-11-19 19:53:03','2015-11-19 19:53:03'),(18,'catalog/6.jpg',0,1,0,3,1,'2009-01-05 21:49:15','2015-12-16 21:03:02'),(72,'',20,0,0,5,1,'2015-11-19 19:52:22','2015-11-19 19:52:22'),(67,'',20,0,0,0,1,'2015-11-19 18:46:59','2015-11-19 18:49:00'),(63,'',33,0,0,4,1,'2015-11-18 17:24:33','2015-11-18 17:24:33'),(66,'',0,1,5,7,1,'2015-11-18 17:32:04','2015-12-16 21:02:29'),(65,'',0,1,5,6,1,'2015-11-18 17:30:24','2015-12-16 21:03:17'),(33,'catalog/6.jpg',0,1,5,1,1,'2009-02-03 14:17:55','2015-12-16 21:03:30'),(34,'catalog/6.jpg',0,1,1,5,1,'2009-02-03 14:18:11','2015-12-16 21:02:46'),(70,'',20,0,0,3,1,'2015-11-19 18:51:47','2015-11-19 18:51:47'),(68,'',20,0,0,1,1,'2015-11-19 18:50:30','2015-11-19 18:50:30'),(69,'',20,0,0,2,1,'2015-11-19 18:51:17','2015-11-19 18:51:17'),(62,'',33,0,0,3,1,'2015-11-18 17:23:52','2015-11-18 17:23:52'),(60,'',33,0,0,1,1,'2015-11-18 17:22:20','2015-11-18 17:22:20'),(61,'',33,0,0,2,1,'2015-11-18 17:23:22','2015-11-18 17:23:22'),(59,'',33,0,0,0,1,'2015-11-18 17:21:23','2015-11-18 17:21:23'),(71,'',20,0,0,4,1,'2015-11-19 18:52:22','2015-11-19 18:52:22');

/*Table structure for table `category_description` */

DROP TABLE IF EXISTS `category_description`;

CREATE TABLE `category_description` (
  `category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`,`language_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `category_description` */

insert  into `category_description`(`category_id`,`language_id`,`name`,`description`,`meta_title`,`meta_description`,`meta_keyword`) values (33,1,'Rings','&lt;p&gt;&lt;br&gt;&lt;/p&gt;','Rings','',''),(59,1,'Bridal','&lt;p&gt;&lt;br&gt;&lt;/p&gt;','Bridal','',''),(60,1,'Day In Day Out','&lt;p&gt;&lt;br&gt;&lt;/p&gt;','Day In Day Out','',''),(25,1,'Bangles','&lt;p&gt;&lt;br&gt;&lt;/p&gt;','Bangles','',''),(20,1,'Earrings','&lt;p&gt;\r\n	Example of category description text&lt;/p&gt;\r\n','Earrings','Example of category description',''),(34,1,'Necklaces','&lt;p&gt;&lt;br&gt;&lt;/p&gt;\r\n','Necklaces','',''),(61,1,'Bands','&lt;p&gt;&lt;br&gt;&lt;/p&gt;','Bands','',''),(62,1,'Matched Sets','&lt;p&gt;&lt;br&gt;&lt;/p&gt;','Matched Sets','',''),(63,1,'Cocktail','&lt;p&gt;&lt;br&gt;&lt;/p&gt;','Cocktail','',''),(64,1,'Couple Bands','&lt;p&gt;&lt;br&gt;&lt;/p&gt;','Couple Bands','',''),(65,1,'Platinum','&lt;p&gt;&lt;br&gt;&lt;/p&gt;','Platinum','',''),(18,1,'Pendants','&lt;p&gt;&lt;br&gt;&lt;/p&gt;\r\n','Pendants','',''),(66,1,'Mens','&lt;p&gt;&lt;br&gt;&lt;/p&gt;','Mens','',''),(67,1,'Jhumkis','&lt;p&gt;&lt;br&gt;&lt;/p&gt;','Jhumkis','',''),(68,1,'Chandeliers','&lt;p&gt;&lt;br&gt;&lt;/p&gt;','Chandeliers','',''),(69,1,'Studs','&lt;p&gt;&lt;br&gt;&lt;/p&gt;','Studs','',''),(70,1,'Drops','&lt;p&gt;&lt;br&gt;&lt;/p&gt;','Drops','',''),(71,1,'Balis','&lt;p&gt;&lt;br&gt;&lt;/p&gt;','Balis','',''),(72,1,'Hoops','&lt;p&gt;&lt;br&gt;&lt;/p&gt;','Hoops','',''),(73,1,'Ear Cuffs','&lt;p&gt;&lt;br&gt;&lt;/p&gt;','Ear Cuffs','','');

/*Table structure for table `category_filter` */

DROP TABLE IF EXISTS `category_filter`;

CREATE TABLE `category_filter` (
  `category_id` int(11) NOT NULL,
  `filter_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`filter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `category_filter` */

/*Table structure for table `category_path` */

DROP TABLE IF EXISTS `category_path`;

CREATE TABLE `category_path` (
  `category_id` int(11) NOT NULL,
  `path_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`path_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `category_path` */

insert  into `category_path`(`category_id`,`path_id`,`level`) values (25,25,0),(72,72,1),(73,20,0),(73,73,1),(71,20,0),(71,71,1),(72,20,0),(70,20,0),(70,70,1),(69,20,0),(69,69,1),(68,20,0),(68,68,1),(20,20,0),(67,20,0),(67,67,1),(65,65,0),(66,66,0),(18,18,0),(63,63,1),(63,33,0),(64,64,1),(64,33,0),(33,33,0),(34,34,0),(62,62,1),(62,33,0),(61,61,1),(61,33,0),(60,60,1),(60,33,0),(59,59,1),(59,33,0);

/*Table structure for table `category_to_layout` */

DROP TABLE IF EXISTS `category_to_layout`;

CREATE TABLE `category_to_layout` (
  `category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `category_to_layout` */

insert  into `category_to_layout`(`category_id`,`store_id`,`layout_id`) values (33,0,6),(20,0,4),(18,0,0),(25,0,0),(34,0,0),(59,0,0),(60,0,0),(61,0,0),(62,0,0),(63,0,0),(64,0,0),(65,0,4),(66,0,0),(67,0,4),(68,0,4),(69,0,4),(70,0,4),(71,0,4),(72,0,4),(73,0,4);

/*Table structure for table `category_to_store` */

DROP TABLE IF EXISTS `category_to_store`;

CREATE TABLE `category_to_store` (
  `category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `category_to_store` */

insert  into `category_to_store`(`category_id`,`store_id`) values (18,0),(20,0),(25,0),(33,0),(34,0),(59,0),(60,0),(61,0),(62,0),(63,0),(64,0),(65,0),(66,0),(67,0),(68,0),(69,0),(70,0),(71,0),(72,0),(73,0);

/*Table structure for table `country` */

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `iso_code_2` varchar(2) NOT NULL,
  `iso_code_3` varchar(3) NOT NULL,
  `address_format` text NOT NULL,
  `postcode_required` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM AUTO_INCREMENT=258 DEFAULT CHARSET=utf8;

/*Data for the table `country` */

insert  into `country`(`country_id`,`name`,`iso_code_2`,`iso_code_3`,`address_format`,`postcode_required`,`status`) values (99,'India','IN','IND','',0,1),(222,'United Kingdom','GB','GBR','',1,1);

/*Table structure for table `coupon` */

DROP TABLE IF EXISTS `coupon`;

CREATE TABLE `coupon` (
  `coupon_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `code` varchar(10) NOT NULL,
  `type` char(1) NOT NULL,
  `discount` decimal(15,4) NOT NULL,
  `logged` tinyint(1) NOT NULL,
  `shipping` tinyint(1) NOT NULL,
  `total` decimal(15,4) NOT NULL,
  `date_start` date NOT NULL DEFAULT '0000-00-00',
  `date_end` date NOT NULL DEFAULT '0000-00-00',
  `uses_total` int(11) NOT NULL,
  `uses_customer` varchar(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`coupon_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `coupon` */

insert  into `coupon`(`coupon_id`,`name`,`code`,`type`,`discount`,`logged`,`shipping`,`total`,`date_start`,`date_end`,`uses_total`,`uses_customer`,`status`,`date_added`) values (4,'-10% Discount','2222','P',10.0000,0,0,0.0000,'2014-01-01','2020-01-01',10,'10',0,'2009-01-27 13:55:03'),(5,'Free Shipping','3333','P',0.0000,0,1,100.0000,'2014-01-01','2014-02-01',10,'10',0,'2009-03-14 21:13:53'),(6,'-10.00 Discount','1111','F',10.0000,0,0,10.0000,'2014-01-01','2020-01-01',100000,'10000',0,'2009-03-14 21:15:18');

/*Table structure for table `coupon_category` */

DROP TABLE IF EXISTS `coupon_category`;

CREATE TABLE `coupon_category` (
  `coupon_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`coupon_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `coupon_category` */

/*Table structure for table `coupon_history` */

DROP TABLE IF EXISTS `coupon_history`;

CREATE TABLE `coupon_history` (
  `coupon_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`coupon_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `coupon_history` */

/*Table structure for table `coupon_product` */

DROP TABLE IF EXISTS `coupon_product`;

CREATE TABLE `coupon_product` (
  `coupon_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`coupon_product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `coupon_product` */

/*Table structure for table `currency` */

DROP TABLE IF EXISTS `currency`;

CREATE TABLE `currency` (
  `currency_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `code` varchar(3) NOT NULL,
  `symbol_left` varchar(12) NOT NULL,
  `symbol_right` varchar(12) NOT NULL,
  `decimal_place` char(1) NOT NULL,
  `value` float(15,8) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`currency_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `currency` */

insert  into `currency`(`currency_id`,`title`,`code`,`symbol_left`,`symbol_right`,`decimal_place`,`value`,`status`,`date_modified`) values (4,'Indian Rupees','INR','Rs','','2',1.00000000,1,'2015-11-19 21:02:19'),(2,'US Dollar','USD','$','','2',1.00000000,0,'2015-11-19 16:28:19');

/*Table structure for table `custom_field` */

DROP TABLE IF EXISTS `custom_field`;

CREATE TABLE `custom_field` (
  `custom_field_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  `value` text NOT NULL,
  `location` varchar(7) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`custom_field_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `custom_field` */

/*Table structure for table `custom_field_customer_group` */

DROP TABLE IF EXISTS `custom_field_customer_group`;

CREATE TABLE `custom_field_customer_group` (
  `custom_field_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `required` tinyint(1) NOT NULL,
  PRIMARY KEY (`custom_field_id`,`customer_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `custom_field_customer_group` */

/*Table structure for table `custom_field_description` */

DROP TABLE IF EXISTS `custom_field_description`;

CREATE TABLE `custom_field_description` (
  `custom_field_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`custom_field_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `custom_field_description` */

/*Table structure for table `custom_field_value` */

DROP TABLE IF EXISTS `custom_field_value`;

CREATE TABLE `custom_field_value` (
  `custom_field_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `custom_field_id` int(11) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`custom_field_value_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `custom_field_value` */

/*Table structure for table `custom_field_value_description` */

DROP TABLE IF EXISTS `custom_field_value_description`;

CREATE TABLE `custom_field_value_description` (
  `custom_field_value_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `custom_field_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`custom_field_value_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `custom_field_value_description` */

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_group_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `telephone` varchar(32) NOT NULL,
  `fax` varchar(32) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(9) NOT NULL,
  `cart` text,
  `wishlist` text,
  `newsletter` tinyint(1) NOT NULL DEFAULT '0',
  `address_id` int(11) NOT NULL DEFAULT '0',
  `custom_field` text NOT NULL,
  `ip` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `safe` tinyint(1) NOT NULL,
  `token` text NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `customer` */

/*Table structure for table `customer_activity` */

DROP TABLE IF EXISTS `customer_activity`;

CREATE TABLE `customer_activity` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `key` varchar(64) NOT NULL,
  `data` text NOT NULL,
  `ip` varchar(40) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`activity_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `customer_activity` */

insert  into `customer_activity`(`activity_id`,`customer_id`,`key`,`data`,`ip`,`date_added`) values (1,0,'order_guest','{\"name\":\"Karan Mehta\",\"order_id\":1}','::1','2015-10-21 10:38:42');

/*Table structure for table `customer_group` */

DROP TABLE IF EXISTS `customer_group`;

CREATE TABLE `customer_group` (
  `customer_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `approval` int(1) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`customer_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `customer_group` */

insert  into `customer_group`(`customer_group_id`,`approval`,`sort_order`) values (1,0,1);

/*Table structure for table `customer_group_description` */

DROP TABLE IF EXISTS `customer_group_description`;

CREATE TABLE `customer_group_description` (
  `customer_group_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`customer_group_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `customer_group_description` */

insert  into `customer_group_description`(`customer_group_id`,`language_id`,`name`,`description`) values (1,1,'Default','test');

/*Table structure for table `customer_history` */

DROP TABLE IF EXISTS `customer_history`;

CREATE TABLE `customer_history` (
  `customer_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `customer_history` */

/*Table structure for table `customer_ip` */

DROP TABLE IF EXISTS `customer_ip`;

CREATE TABLE `customer_ip` (
  `customer_ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_ip_id`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `customer_ip` */

/*Table structure for table `customer_login` */

DROP TABLE IF EXISTS `customer_login`;

CREATE TABLE `customer_login` (
  `customer_login_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(96) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `total` int(4) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`customer_login_id`),
  KEY `email` (`email`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `customer_login` */

/*Table structure for table `customer_online` */

DROP TABLE IF EXISTS `customer_online`;

CREATE TABLE `customer_online` (
  `ip` varchar(40) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `referer` text NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `customer_online` */

/*Table structure for table `customer_reward` */

DROP TABLE IF EXISTS `customer_reward`;

CREATE TABLE `customer_reward` (
  `customer_reward_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `points` int(8) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_reward_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `customer_reward` */

/*Table structure for table `customer_transaction` */

DROP TABLE IF EXISTS `customer_transaction`;

CREATE TABLE `customer_transaction` (
  `customer_transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_transaction_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `customer_transaction` */

/*Table structure for table `customer_wishlist` */

DROP TABLE IF EXISTS `customer_wishlist`;

CREATE TABLE `customer_wishlist` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_id`,`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `customer_wishlist` */

/*Table structure for table `download` */

DROP TABLE IF EXISTS `download`;

CREATE TABLE `download` (
  `download_id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(128) NOT NULL,
  `mask` varchar(128) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`download_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `download` */

/*Table structure for table `download_description` */

DROP TABLE IF EXISTS `download_description`;

CREATE TABLE `download_description` (
  `download_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`download_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `download_description` */

/*Table structure for table `event` */

DROP TABLE IF EXISTS `event`;

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(32) NOT NULL,
  `trigger` text NOT NULL,
  `action` text NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `event` */

insert  into `event`(`event_id`,`code`,`trigger`,`action`) values (1,'voucher','post.order.history.add','total/voucher/send');

/*Table structure for table `extension` */

DROP TABLE IF EXISTS `extension`;

CREATE TABLE `extension` (
  `extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  `code` varchar(32) NOT NULL,
  PRIMARY KEY (`extension_id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

/*Data for the table `extension` */

insert  into `extension`(`extension_id`,`type`,`code`) values (1,'payment','cod'),(2,'total','shipping'),(3,'total','sub_total'),(4,'total','tax'),(5,'total','total'),(22,'module','topslider'),(21,'module','account'),(8,'total','credit'),(9,'shipping','flat'),(10,'total','handling'),(11,'total','low_order_fee'),(12,'total','coupon'),(15,'total','reward'),(16,'total','voucher'),(17,'payment','free_checkout'),(23,'module','footer_info'),(24,'module','latest'),(25,'module','special'),(26,'module','random'),(27,'module','bestseller'),(28,'module','featured'),(29,'module','carousel'),(30,'module','category'),(31,'module','html'),(32,'module','filter'),(33,'module','fcategory');

/*Table structure for table `filter` */

DROP TABLE IF EXISTS `filter`;

CREATE TABLE `filter` (
  `filter_id` int(11) NOT NULL AUTO_INCREMENT,
  `filter_group_id` int(11) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`filter_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `filter` */

insert  into `filter`(`filter_id`,`filter_group_id`,`sort_order`) values (3,1,3),(2,1,1),(1,1,2),(4,2,1),(5,2,2),(6,2,3),(7,1,4),(8,1,5);

/*Table structure for table `filter_description` */

DROP TABLE IF EXISTS `filter_description`;

CREATE TABLE `filter_description` (
  `filter_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `filter_group_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`filter_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `filter_description` */

insert  into `filter_description`(`filter_id`,`language_id`,`filter_group_id`,`name`) values (3,1,1,'green'),(2,1,1,'blue'),(1,1,1,'brown'),(4,1,2,'$0 - $100'),(5,1,2,'$101 - $200'),(6,1,2,'$201 - $500'),(7,1,1,'red'),(8,1,1,'violet');

/*Table structure for table `filter_group` */

DROP TABLE IF EXISTS `filter_group`;

CREATE TABLE `filter_group` (
  `filter_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`filter_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `filter_group` */

insert  into `filter_group`(`filter_group_id`,`sort_order`) values (1,1),(2,2);

/*Table structure for table `filter_group_description` */

DROP TABLE IF EXISTS `filter_group_description`;

CREATE TABLE `filter_group_description` (
  `filter_group_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`filter_group_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `filter_group_description` */

insert  into `filter_group_description`(`filter_group_id`,`language_id`,`name`) values (1,1,'Color'),(2,1,'Price');

/*Table structure for table `geo_zone` */

DROP TABLE IF EXISTS `geo_zone`;

CREATE TABLE `geo_zone` (
  `geo_zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`geo_zone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `geo_zone` */

/*Table structure for table `information` */

DROP TABLE IF EXISTS `information`;

CREATE TABLE `information` (
  `information_id` int(11) NOT NULL AUTO_INCREMENT,
  `bottom` int(1) NOT NULL DEFAULT '0',
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`information_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `information` */

insert  into `information`(`information_id`,`bottom`,`sort_order`,`status`) values (3,1,3,1),(4,1,1,1),(5,1,4,1),(6,1,2,1);

/*Table structure for table `information_description` */

DROP TABLE IF EXISTS `information_description`;

CREATE TABLE `information_description` (
  `information_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`information_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `information_description` */

insert  into `information_description`(`information_id`,`language_id`,`title`,`description`,`meta_title`,`meta_description`,`meta_keyword`) values (4,1,'About Us','&lt;p&gt;\r\n	About Us&lt;/p&gt;\r\n','','',''),(5,1,'Terms &amp; Conditions','&lt;p&gt;\r\n	Terms &amp;amp; Conditions&lt;/p&gt;\r\n','','',''),(3,1,'Privacy Policy','&lt;p&gt;\r\n	Privacy Policy&lt;/p&gt;\r\n','','',''),(6,1,'Delivery Information','&lt;p&gt;\r\n	Delivery Information&lt;/p&gt;\r\n','','','');

/*Table structure for table `information_to_layout` */

DROP TABLE IF EXISTS `information_to_layout`;

CREATE TABLE `information_to_layout` (
  `information_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`information_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `information_to_layout` */

/*Table structure for table `information_to_store` */

DROP TABLE IF EXISTS `information_to_store`;

CREATE TABLE `information_to_store` (
  `information_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`information_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `information_to_store` */

insert  into `information_to_store`(`information_id`,`store_id`) values (3,0),(4,0),(5,0),(6,0);

/*Table structure for table `language` */

DROP TABLE IF EXISTS `language`;

CREATE TABLE `language` (
  `language_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `code` varchar(5) NOT NULL,
  `locale` varchar(255) NOT NULL,
  `image` varchar(64) NOT NULL,
  `directory` varchar(32) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`language_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `language` */

insert  into `language`(`language_id`,`name`,`code`,`locale`,`image`,`directory`,`sort_order`,`status`) values (1,'English','en','en_US.UTF-8,en_US,en-gb,english','gb.png','english',1,1);

/*Table structure for table `layout` */

DROP TABLE IF EXISTS `layout`;

CREATE TABLE `layout` (
  `layout_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`layout_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `layout` */

insert  into `layout`(`layout_id`,`name`) values (1,'Home'),(2,'Product'),(3,'Category'),(4,'Default'),(5,'Manufacturer'),(6,'Account'),(7,'Checkout'),(8,'Contact'),(9,'Sitemap'),(10,'Affiliate'),(11,'Information'),(12,'Compare'),(13,'Search');

/*Table structure for table `layout_module` */

DROP TABLE IF EXISTS `layout_module`;

CREATE TABLE `layout_module` (
  `layout_module_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) NOT NULL,
  `code` varchar(64) NOT NULL,
  `position` varchar(14) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`layout_module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=utf8;

/*Data for the table `layout_module` */

insert  into `layout_module`(`layout_module_id`,`layout_id`,`code`,`position`,`sort_order`) values (80,1,'html.35','content_top',3),(76,1,'special.43','product_widget',2),(77,1,'footer_info.36','content_top',8),(79,1,'html.32','top_promo',1),(78,1,'carousel.31','content_top',7),(75,1,'latest.38','content_top',5),(74,1,'html.42','product_widget',4),(81,1,'featured.37','content_top',4),(82,1,'topslider.34','content_top',2),(83,1,'bestseller.50','product_widget',3),(84,1,'random.47','product_widget',1),(85,2,'html.51','column_right',1),(86,2,'html.32','top_promo',1),(87,3,'upsells','content_bottom',1),(88,3,'bestseller.50','column_left',3),(89,3,'category','column_left',0),(90,3,'filter','column_left',2),(91,3,'html.32','top_promo',1),(92,4,'html.32','top_promo',1),(93,5,'html.32','top_promo',1),(94,6,'account','column_left',1),(95,6,'html.32','top_promo',1),(96,7,'html.32','top_promo',1),(97,8,'html.57','content_top',1),(98,8,'html.58','column_right',1),(99,8,'html.32','top_promo',1),(100,9,'html.32','top_promo',1),(101,9,'html.53','column_left',1),(102,10,'html.32','top_promo',1),(103,11,'html.32','top_promo',1),(104,12,'html.32','top_promo',1),(105,13,'html.32','top_promo',1),(106,14,'html.32','top_promo',1),(107,16,'html.39','column_right',2),(108,16,'simple_blog_category','column_right',1),(109,16,'html.49','column_right',3),(110,16,'html.32','top_promo',1);

/*Table structure for table `layout_route` */

DROP TABLE IF EXISTS `layout_route`;

CREATE TABLE `layout_route` (
  `layout_route_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `route` varchar(255) NOT NULL,
  PRIMARY KEY (`layout_route_id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

/*Data for the table `layout_route` */

insert  into `layout_route`(`layout_route_id`,`layout_id`,`store_id`,`route`) values (38,6,0,'account/%'),(17,10,0,'affiliate/%'),(44,3,0,'product/category'),(42,1,0,'common/home'),(20,2,0,'product/product'),(24,11,0,'information/information'),(23,7,0,'checkout/%'),(31,8,0,'information/contact'),(32,9,0,'information/sitemap'),(34,4,0,''),(45,5,0,'product/manufacturer'),(52,12,0,'product/compare'),(53,13,0,'product/search');

/*Table structure for table `length_class` */

DROP TABLE IF EXISTS `length_class`;

CREATE TABLE `length_class` (
  `length_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `value` decimal(15,8) NOT NULL,
  PRIMARY KEY (`length_class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `length_class` */

insert  into `length_class`(`length_class_id`,`value`) values (1,1.00000000),(2,10.00000000),(3,0.39370000);

/*Table structure for table `length_class_description` */

DROP TABLE IF EXISTS `length_class_description`;

CREATE TABLE `length_class_description` (
  `length_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `unit` varchar(4) NOT NULL,
  PRIMARY KEY (`length_class_id`,`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `length_class_description` */

insert  into `length_class_description`(`length_class_id`,`language_id`,`title`,`unit`) values (1,1,'Centimeter','cm'),(2,1,'Millimeter','mm'),(3,1,'Inch','in');

/*Table structure for table `location` */

DROP TABLE IF EXISTS `location`;

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `address` text NOT NULL,
  `telephone` varchar(32) NOT NULL,
  `fax` varchar(32) NOT NULL,
  `geocode` varchar(32) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `open` text NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`location_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `location` */

/*Table structure for table `manufacturer` */

DROP TABLE IF EXISTS `manufacturer`;

CREATE TABLE `manufacturer` (
  `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`manufacturer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `manufacturer` */

insert  into `manufacturer`(`manufacturer_id`,`name`,`image`,`sort_order`) values (5,'HTC','catalog/demo/htc_logo.jpg',0),(6,'Palm','catalog/demo/palm_logo.jpg',0),(7,'Hewlett-Packard','catalog/demo/hp_logo.jpg',0),(8,'Apple','catalog/demo/apple_logo.jpg',0),(9,'Canon','catalog/demo/canon_logo.jpg',0),(10,'Sony','catalog/demo/sony_logo.jpg',0);

/*Table structure for table `manufacturer_to_store` */

DROP TABLE IF EXISTS `manufacturer_to_store`;

CREATE TABLE `manufacturer_to_store` (
  `manufacturer_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`manufacturer_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `manufacturer_to_store` */

insert  into `manufacturer_to_store`(`manufacturer_id`,`store_id`) values (5,0),(6,0),(7,0),(8,0),(9,0),(10,0);

/*Table structure for table `marketing` */

DROP TABLE IF EXISTS `marketing`;

CREATE TABLE `marketing` (
  `marketing_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `code` varchar(64) NOT NULL,
  `clicks` int(5) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`marketing_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `marketing` */

/*Table structure for table `modification` */

DROP TABLE IF EXISTS `modification`;

CREATE TABLE `modification` (
  `modification_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `code` varchar(64) NOT NULL,
  `author` varchar(64) NOT NULL,
  `version` varchar(32) NOT NULL,
  `link` varchar(255) NOT NULL,
  `xml` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`modification_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `modification` */

/*Table structure for table `module` */

DROP TABLE IF EXISTS `module`;

CREATE TABLE `module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `code` varchar(32) NOT NULL,
  `setting` text NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

/*Data for the table `module` */

insert  into `module`(`module_id`,`name`,`code`,`setting`) values (31,'default Layout_Home Page_Brands','carousel','{\"name\":\"default Layout_Home Page_Brands\",\"banner_id\":\"77\",\"width\":\"160\",\"height\":\"65\",\"status\":\"1\"}'),(32,'default Layout_all layouts_Block Services','html','{\"name\":\"default Layout_all layouts_Block Services\",\"module_description\":{\"1\":{\"title\":\"\",\"description\":\"&lt;div class=&quot;col-xs-12 col-sm-4 col-lg-4&quot;&gt;\\r\\n                &lt;a href=&quot;index.php&quot; class=&quot;item anim-icon&quot;&gt;\\r\\n                    &lt;span class=&quot;icon&quot;&gt;&lt;img src=&quot;image\\/catalog\\/blocks\\/anim-icon-1.gif&quot; width=&quot;45&quot; height=&quot;45&quot; data-hover=&quot;image\\/catalog\\/blocks\\/anim-icon-1-hover.gif&quot; alt=&quot;&quot;&gt;&lt;\\/span&gt;\\r\\n                    &lt;span class=&quot;title&quot;&gt;Free shipping on orders over $200&lt;\\/span&gt;\\r\\n                &lt;\\/a&gt;\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n            &lt;div class=&quot;col-xs-12 col-sm-4 col-lg-4&quot;&gt;\\r\\n                &lt;a href=&quot;index.php&quot; class=&quot;item anim-icon&quot;&gt;\\r\\n                    &lt;span class=&quot;icon&quot;&gt;&lt;img src=&quot;image\\/catalog\\/blocks\\/anim-icon-2.gif&quot; width=&quot;45&quot; height=&quot;45&quot; data-hover=&quot;image\\/catalog\\/blocks\\/anim-icon-2-hover.gif&quot; alt=&quot;&quot;&gt;&lt;\\/span&gt;\\r\\n                    &lt;span class=&quot;title&quot;&gt;30-day returns&lt;\\/span&gt;\\r\\n                &lt;\\/a&gt;\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n            &lt;div class=&quot;col-xs-12 col-sm-4 col-lg-4&quot;&gt;\\r\\n                &lt;a href=&quot;index.php&quot; class=&quot;item anim-icon&quot;&gt;\\r\\n                    &lt;span class=&quot;icon&quot;&gt;&lt;img src=&quot;image\\/catalog\\/blocks\\/anim-icon-3.gif&quot; width=&quot;45&quot; height=&quot;45&quot; data-hover=&quot;image\\/catalog\\/blocks\\/anim-icon-3-hover.gif&quot; alt=&quot;&quot;&gt;&lt;\\/span&gt;\\r\\n                    &lt;span class=&quot;title&quot;&gt;24\\/7 Support &lt;\\/span&gt;\\r\\n                &lt;\\/a&gt;\\r\\n            &lt;\\/div&gt;\"}},\"status\":\"1\"}'),(34,'default Layout_Home Page_Revolution Slider','topslider','{\"name\":\"default Layout_Home Page_Revolution Slider\",\"module_description\":{\"1\":{\"title\":\"\",\"description\":\"&lt;ul&gt;\\r\\n\\r\\n\\r\\n                &lt;li id=&quot;slide1&quot; data-transition=&quot;zoomout&quot; data-slotamount=&quot;7&quot; data-masterspeed=&quot;500&quot; data-title=&quot;First Slide&quot; data-link=&quot;index.php&quot;&gt;\\r\\n                    &lt;img src=&quot;image\\/catalog\\/dummy.png&quot; width=&quot;10&quot; height=&quot;10&quot; alt=&quot;slide1&quot; data-lazyload=&quot;image\\/catalog\\/sliders\\/slide1.png&quot;&gt;\\r\\n                    &lt;div class=&quot;tp-caption fadein fadeout  rs-parallaxlevel-1&quot; data-x=&quot;500&quot; data-y=&quot;0&quot; data-speed=&quot;1000&quot; data-start=&quot;500&quot; data-easing=&quot;Power3.easeInOut&quot; data-elementdelay=&quot;0.1&quot; data-endelementdelay=&quot;0.1&quot; style=&quot;z-index: 4;&quot;&gt;\\r\\n                        &lt;img src=&quot;image\\/catalog\\/sliders\\/slide1-1.png&quot; width=&quot;271&quot; height=&quot;504&quot; alt=&quot;&quot;&gt;\\r\\n                    &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n                    &lt;div class=&quot;tp-caption lfl fadeout  rs-parallaxlevel-2&quot; data-x=&quot;200&quot; data-y=&quot;0&quot; data-speed=&quot;1000&quot; data-start=&quot;1000&quot; data-easing=&quot;Power3.easeInOut&quot; data-elementdelay=&quot;0.1&quot; data-endelementdelay=&quot;0.1&quot; style=&quot;z-index: 4;&quot;&gt;\\r\\n                        &lt;img src=&quot;image\\/catalog\\/sliders\\/slide1-2.png&quot; width=&quot;344&quot; height=&quot;504&quot; alt=&quot;&quot;&gt;\\r\\n                    &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n                    &lt;div class=&quot;tp-caption lfr fadeout  rs-parallaxlevel-3&quot; data-x=&quot;700&quot; data-y=&quot;0&quot; data-speed=&quot;1200&quot; data-start=&quot;1600&quot; data-easing=&quot;Power3.easeInOut&quot; data-elementdelay=&quot;0.1&quot; data-endelementdelay=&quot;0.1&quot; style=&quot;z-index: 4;&quot;&gt;\\r\\n                        &lt;img src=&quot;image\\/catalog\\/sliders\\/slide1-3.png&quot; width=&quot;317&quot; height=&quot;504&quot; alt=&quot;&quot;&gt;\\r\\n                    &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n                    &lt;div class=&quot;tp-caption text0 fadeout&quot; data-x=&quot;1050&quot; data-y=&quot;140&quot; data-speed=&quot;800&quot; data-start=&quot;2500&quot; data-easing=&quot;Power3.easeInOut&quot; data-splitout=&quot;none&quot; data-elementdelay=&quot;0.1&quot; data-endelementdelay=&quot;0.1&quot; data-endspeed=&quot;300&quot; style=&quot;z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;&quot;&gt; \\u201c\\r\\n                    &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n                    &lt;div class=&quot;tp-caption text1 fadeout&quot; data-x=&quot;1080&quot; data-y=&quot;150&quot; data-speed=&quot;800&quot; data-start=&quot;3000&quot; data-easing=&quot;Power3.easeInOut&quot; data-splitout=&quot;none&quot; data-elementdelay=&quot;0.1&quot; data-endelementdelay=&quot;0.1&quot; data-endspeed=&quot;300&quot; style=&quot;z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;&quot;&gt;Clothes make&lt;br&gt;\\r\\n                        the man.\\r\\n                    &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n                    &lt;div class=&quot;tp-caption text2 fadeout&quot; data-x=&quot;1080&quot; data-y=&quot;255&quot; data-speed=&quot;500&quot; data-start=&quot;3500&quot; data-easing=&quot;Power3.easeInOut&quot; data-splitout=&quot;none&quot; data-elementdelay=&quot;0.1&quot; data-endelementdelay=&quot;0.1&quot; data-endspeed=&quot;300&quot; style=&quot;z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;&quot;&gt;Naked people have\\r\\n                        little&lt;br&gt;\\r\\n                        or no influenceon society.\\r\\n                    &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n                    &lt;div class=&quot;tp-caption text3 fadeout&quot; data-x=&quot;1080&quot; data-y=&quot;305&quot; data-speed=&quot;1000&quot; data-start=&quot;4000&quot; data-easing=&quot;Power3.easeInOut&quot; data-splitin=&quot;none&quot; data-splitout=&quot;none&quot; data-elementdelay=&quot;0.1&quot; data-endelementdelay=&quot;0.1&quot; data-endspeed=&quot;300&quot; style=&quot;z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;&quot;&gt;Mark Twain &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n                &lt;\\/li&gt;\\r\\n\\r\\n\\r\\n                &lt;li id=&quot;slide2&quot; data-transition=&quot;zoomout&quot; data-slotamount=&quot;7&quot; data-masterspeed=&quot;500&quot; data-title=&quot;Second Slide&quot; data-link=&quot;index.php&quot;&gt;\\r\\n                    &lt;img src=&quot;image\\/catalog\\/dummy.png&quot; width=&quot;10&quot; height=&quot;10&quot; alt=&quot;slide2&quot; data-lazyload=&quot;image\\/catalog\\/sliders\\/slide2.jpg&quot;&gt;\\r\\n                    &lt;div class=&quot;tp-caption fadein fadeout  rs-parallaxlevel-1&quot; data-x=&quot;750&quot; data-y=&quot;0&quot; data-speed=&quot;1000&quot; data-start=&quot;500&quot; data-easing=&quot;Power3.easeInOut&quot; data-elementdelay=&quot;0.1&quot; data-endelementdelay=&quot;0.1&quot; style=&quot;z-index: 4;&quot;&gt;\\r\\n                        &lt;img src=&quot;image\\/catalog\\/sliders\\/slide2.gif&quot; width=&quot;421&quot; height=&quot;504&quot; alt=&quot;&quot;&gt;\\r\\n                    &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n                    &lt;div class=&quot;tp-caption text0 fadeout&quot; data-x=&quot;380&quot; data-y=&quot;210&quot; data-speed=&quot;800&quot; data-start=&quot;1000&quot; data-easing=&quot;Power3.easeInOut&quot; data-splitout=&quot;none&quot; data-elementdelay=&quot;0.1&quot; data-endelementdelay=&quot;0.1&quot; data-endspeed=&quot;300&quot; style=&quot;z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;&quot;&gt; \\u201c\\r\\n                    &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n                    &lt;div class=&quot;tp-caption text1 fadeout&quot; data-x=&quot;410&quot; data-y=&quot;220&quot; data-speed=&quot;800&quot; data-start=&quot;1000&quot; data-easing=&quot;Power3.easeInOut&quot; data-splitout=&quot;none&quot; data-elementdelay=&quot;0.1&quot; data-endelementdelay=&quot;0.1&quot; data-endspeed=&quot;300&quot; style=&quot;z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;&quot;&gt;The most\\r\\n                        beautiful&lt;br&gt;\\r\\n                        clothes\\r\\n                    &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n                    &lt;div class=&quot;tp-caption text2 fadeout&quot; data-x=&quot;410&quot; data-y=&quot;325&quot; data-speed=&quot;500&quot; data-start=&quot;1500&quot; data-easing=&quot;Power3.easeInOut&quot; data-splitout=&quot;none&quot; data-elementdelay=&quot;0.1&quot; data-endelementdelay=&quot;0.1&quot; data-endspeed=&quot;300&quot; style=&quot;z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;&quot;&gt;that can dress a\\r\\n                        woman are&lt;br&gt;\\r\\n                        the arms of the man she loves.\\r\\n                    &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n                    &lt;div class=&quot;tp-caption text3 fadeout&quot; data-x=&quot;410&quot; data-y=&quot;375&quot; data-speed=&quot;1000&quot; data-start=&quot;2000&quot; data-easing=&quot;Power3.easeInOut&quot; data-splitin=&quot;none&quot; data-splitout=&quot;none&quot; data-elementdelay=&quot;0.1&quot; data-endelementdelay=&quot;0.1&quot; data-endspeed=&quot;300&quot; style=&quot;z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;&quot;&gt;Yves Saint-Laurent\\r\\n                    &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n                &lt;\\/li&gt;\\r\\n\\r\\n\\r\\n            &lt;\\/ul&gt;\"}},\"status\":\"1\"}'),(35,'default Layout_Home Page_Block Circled Banners','html','{\"name\":\"default Layout_Home Page_Block Circled Banners\",\"module_description\":{\"1\":{\"title\":\"\",\"description\":\"&lt;div class=&quot;container content circle_banners slick-style2 margin_bottom1&quot;&gt;\\r\\n    &lt;div class=&quot;row&quot;&gt;\\r\\n        &lt;div class=&quot;col-xs-6 col-sm-6 col-md-4 col-lg-4&quot;&gt;\\r\\n            &lt;div class=&quot;banner-circle animate fadeInDown&quot; onclick=&quot;location.href=\'index.php\'&quot;&gt;\\r\\n                &lt;div class=&quot;image&quot;&gt;&lt;img src=&quot;image\\/catalog\\/blocks\\/img1.jpg&quot; alt=&quot;&quot; class=&quot;animate-scale&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n                &lt;div class=&quot;title&quot;&gt;&lt;span&gt;New Arrivals&lt;\\/span&gt;&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n        &lt;div class=&quot;col-xs-6 col-sm-6 col-md-4 col-lg-4&quot;&gt;\\r\\n            &lt;div class=&quot;banner-circle animate fadeInDown&quot; onclick=&quot;location.href=\'index.php\'&quot;&gt;\\r\\n                &lt;div class=&quot;image&quot;&gt;&lt;img src=&quot;image\\/catalog\\/blocks\\/img2.jpg&quot; alt=&quot;&quot; class=&quot;animate-scale&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n                &lt;div class=&quot;title&quot;&gt;&lt;span&gt;Summer Sale&lt;\\/span&gt;&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n        &lt;div class=&quot;col-xs-6 col-sm-6 col-md-4 col-lg-4&quot;&gt;\\r\\n            &lt;div class=&quot;banner-circle animate fadeInDown&quot; onclick=&quot;location.href=\'index.php\'&quot;&gt;\\r\\n                &lt;div class=&quot;image&quot;&gt;&lt;img src=&quot;image\\/catalog\\/blocks\\/img3.jpg&quot; alt=&quot;&quot; class=&quot;animate-scale&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n                &lt;div class=&quot;title&quot;&gt;&lt;span&gt;Fur Clothing&lt;\\/span&gt;&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n    &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n\\r\\n&lt;\\/div&gt;\"}},\"status\":\"1\"}'),(36,'default Layout_Home Page','footer_info','{\"name\":\"default Layout_Home Page\",\"module_description\":{\"account_facebook\":\"tonytemplates\",\"account_twitter\":\"tonytemplates\",\"sort_order_facebook\":\"1\",\"sort_order_twitter\":\"2\",\"sort_order_about\":\"3\",\"sort_order_testimonials\":\"4\",\"1\":{\"heading_facebook\":\"Facebook\",\"heading_twitter\":\"Twitter\",\"heading_about\":\"About us\",\"description_about\":\"&lt;p&gt;&lt;img src=&quot;image\\/catalog\\/blocks\\/img-about.jpg&quot; width=&quot;261&quot; height=&quot;132&quot; alt=&quot;&quot; class=&quot;img-responsive&quot;&gt;&lt;\\/p&gt;\\r\\n\\r\\n\\r\\n&lt;p&gt;Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu\\r\\n    enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce\\r\\n    vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor ullamcorper massa pellentesque\\r\\n    sagittis. Morbi sit amet quam labore diam nonumy. &lt;\\/p&gt;\",\"heading_contact\":\"Testimonials\",\"description_contact\":\"&lt;div class=&quot;carousel-item&quot;&gt;\\r\\n                                &lt;div class=&quot;text&quot;&gt;Maecenas eu enim in lorem scelerisq ue auctor. Ut non erat.\\r\\n                                    Suspendisse tesque sagittis. Morbi quam.\\r\\n                                    &lt;div class=&quot;arrow&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n                                &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n                                &lt;div class=&quot;author&quot;&gt;Andrea Willson&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n                            &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n                            &lt;div class=&quot;carousel-item&quot;&gt;\\r\\n                                &lt;div class=&quot;text&quot;&gt;Maecenas eu enim in lorem scelerisq ue auctor. Ut non erat.\\r\\n                                    Suspendisse tesque sagittis. Morbi quam. Nullam ac nisi non eros gravida venenatis.\\r\\n                                    Ut eu dictum justo urna et mi. Integer dictum est vitae sem. Ut euis, turpis\\r\\n                                    lobortis.\\r\\n                                    &lt;div class=&quot;arrow&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n                                &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n                                &lt;div class=&quot;author&quot;&gt;Mark Donovan&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n                            &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n                            &lt;div class=&quot;carousel-item&quot;&gt;\\r\\n                                &lt;div class=&quot;text&quot;&gt;Maecenas eu enim in lorem scelerisq ue auctor. Ut non erat.\\r\\n                                    Suspendisse tesque sagittis. Morbi quam.\\r\\n                                    &lt;div class=&quot;arrow&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n                                &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n                                &lt;div class=&quot;author&quot;&gt;Andrea Willson&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n                            &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n                            &lt;div class=&quot;carousel-item&quot;&gt;\\r\\n                                &lt;div class=&quot;text&quot;&gt;Maecenas eu enim in lorem scelerisq ue auctor. Ut non erat.\\r\\n                                    Suspendisse tesque sagittis. Morbi quam. Nullam ac nisi non eros gravida venenatis.\\r\\n                                    Ut eu dictum justo urna et mi. Integer dictum est vitae sem. Ut euis, turpis\\r\\n                                    lobortis.\\r\\n                                    &lt;div class=&quot;arrow&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n                                &lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n                                &lt;div class=&quot;author&quot;&gt;Mark Donovan&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n\\r\\n                            &lt;\\/div&gt;\"}},\"status\":\"1\"}'),(37,'default Layout_Home Page','featured','{\"name\":\"default Layout_Home Page\",\"product\":[\"42\",\"30\",\"41\",\"40\",\"36\",\"49\",\"33\",\"46\",\"47\",\"28\"],\"limit\":\"12\",\"width\":\"256\",\"height\":\"273\",\"status\":\"1\"}'),(38,'default Layout_Home Page','latest','{\"name\":\"default Layout_Home Page\",\"limit\":\"8\",\"width\":\"290\",\"height\":\"406\",\"status\":\"1\"}'),(39,'default Layout_Simple Blog_Text','html','{\"name\":\"default Layout_Simple Blog_Text\",\"module_description\":{\"1\":{\"title\":\"&lt;h3&gt;ABOUT THE BLOG&lt;\\/h3&gt;\",\"description\":\"&lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor sagittis. Morbi sit amet quam.&lt;\\/p&gt;\"}},\"status\":\"0\"}'),(40,'default Layout_Simple Blog_Tags','html','{\"name\":\"default Layout_Simple Blog_Tags\",\"module_description\":{\"1\":{\"title\":\"Tags\",\"description\":\"&lt;ul class=&quot;tags&quot;&gt;\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;Web Design &lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;Wordpress&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;a href=&quot;index.php&quot;&gt; Animation &lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;Collection &lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;Fall &lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;a href=&quot;index.php&quot;&gt; Retail &lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;Sale &lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;Spring &lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;Summer &lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;a href=&quot;index.php&quot;&gt; Winter&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;Discount&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n&lt;\\/ul&gt;\\r\\n\\r\\n\\r\\n&lt;div class=&quot;clearfix&quot;&gt;&lt;\\/div&gt;\"}},\"status\":\"1\"}'),(42,'default Layout_Home Page_Block Flickr','html','{\"name\":\"default Layout_Home Page_Block Flickr\",\"module_description\":{\"1\":{\"title\":\"&lt;div class=&quot;pull-left vertical_title_outer title-sm flickr&quot;&gt; &lt;div&gt;&lt;span&gt;Flickr photos&lt;\\/span&gt;&lt;\\/div&gt;&lt;\\/div&gt;\",\"description\":\"&lt;div class=&quot;pull-left padding-left flickr&quot;&gt;\\r\\n    &lt;div id=&quot;flickr_badge_wrapper&quot;&gt;\\r\\n    &lt;script type=&quot;text\\/javascript&quot; src=&quot;http:\\/\\/www.flickr.com\\/badge_code_v2.gne?count=9&amp;amp;display=latest&amp;amp;size=s&amp;amp;layout=x&amp;amp;source=user&amp;amp;user=52617155@N08&quot;&gt;&lt;\\/script&gt;\\r\\n    &lt;\\/div&gt;\\r\\n    &lt;div class=&quot;text-center flickr&quot;&gt;&lt;a class=&quot;btn-cool&quot; href=&quot;https:\\/\\/www.flickr.com\\/photos\\/we-are-envato&quot;&gt; more photos &lt;\\/a&gt;&lt;\\/div&gt;\\r\\n&lt;\\/div&gt;\"}},\"status\":\"1\"}'),(43,'default Layout_Home Page','special','{\"name\":\"default Layout_Home Page\",\"limit\":\"3\",\"width\":\"68\",\"height\":\"91\",\"status\":\"1\"}'),(47,'default Layout_Home Page','random','{\"name\":\"default Layout_Home Page\",\"limit\":\"3\",\"width\":\"68\",\"height\":\"91\",\"status\":\"1\"}'),(49,'default Layout_Simple Blog_Flickr','html','{\"name\":\"default Layout_Simple Blog_Flickr\",\"module_description\":{\"1\":{\"title\":\"&lt;h3&gt;Flickr photos&lt;\\/h3&gt;\",\"description\":\"&lt;div class=&quot;flickr&quot;&gt;\\r\\n    &lt;div id=&quot;flickr_badge_wrapper&quot;&gt;\\r\\n        &lt;script type=&quot;text\\/javascript&quot; src=&quot;http:\\/\\/www.flickr.com\\/badge_code_v2.gne?count=9&amp;amp;display=latest&amp;amp;size=s&amp;amp;layout=x&amp;amp;source=user&amp;amp;user=52617155@N08&quot;&gt;&lt;\\/script&gt;\\r\\n        &lt;center&gt;&lt;small&gt;Created with &lt;a href=&quot;http:\\/\\/www.flickrbadge.com&quot;&gt;flickr badge&lt;\\/a&gt;.&lt;\\/small&gt;&lt;\\/center&gt;\\r\\n    &lt;\\/div&gt;\\r\\n    &lt;div class=&quot;text-center flickr&quot;&gt;&lt;a class=&quot;btn-cool&quot; href=&quot;https:\\/\\/www.flickr.com\\/photos\\/we-are-envato&quot;&gt; more photos &lt;\\/a&gt;&lt;\\/div&gt;\\r\\n&lt;\\/div&gt;\"}},\"status\":\"1\"}'),(50,'default Layout_Category Page','bestseller','{\"name\":\"default Layout_Category Page\",\"limit\":\"3\",\"width\":\"68\",\"height\":\"91\",\"status\":\"1\"}'),(51,'default Layout_Product Page_Custom Block','html','{\"name\":\"default Layout_Product Page_Custom Block\",\"module_description\":{\"1\":{\"title\":\"&lt;h3&gt;CUSTOM HTML BLOCK&lt;\\/h3&gt;\",\"description\":\"&lt;div&gt;\\r\\nYou can add your content here, like promotions or some additional info\\r\\n&lt;div class=&quot;custom-block&quot;&gt;\\r\\n    &lt;a href=&quot;index.php&quot; class=&quot;item&quot;&gt;\\r\\n        &lt;span class=&quot;icon flaticon-outlined3&quot;&gt;&lt;\\/span&gt;\\r\\n        &lt;span class=&quot;text&quot;&gt;\\r\\n            &lt;span class=&quot;title&quot;&gt;Special Offer 1+1=3&lt;\\/span&gt;\\r\\n            &lt;span class=&quot;description&quot;&gt;Get a gift!&lt;\\/span&gt;\\r\\n        &lt;\\/span&gt;\\r\\n    &lt;\\/a&gt;\\r\\n    &lt;a href=&quot;index.php&quot; class=&quot;item&quot;&gt;\\r\\n        &lt;span class=&quot;icon flaticon-credit22&quot;&gt;&lt;\\/span&gt;\\r\\n        &lt;span class=&quot;text&quot;&gt;&lt;span class=&quot;title&quot;&gt;FREE REWARD CARD&lt;\\/span&gt; &lt;span class=&quot;description&quot;&gt;Worth 10$, 50$, 100$&lt;\\/span&gt; &lt;\\/span&gt;\\r\\n    &lt;\\/a&gt;\\r\\n    &lt;a href=&quot;index.php&quot; class=&quot;item&quot;&gt;\\r\\n        &lt;span class=&quot;icon flaticon-business137&quot;&gt;&lt;\\/span&gt;\\r\\n        &lt;span class=&quot;text&quot;&gt; &lt;span class=&quot;title&quot;&gt;Join Our Club&lt;\\/span&gt; &lt;\\/span&gt;\\r\\n    &lt;\\/a&gt;\\r\\n    &lt;a href=&quot;index.php&quot; class=&quot;item&quot;&gt;\\r\\n        &lt;span class=&quot;icon flaticon-global10&quot;&gt;&lt;\\/span&gt;\\r\\n        &lt;span class=&quot;text&quot;&gt;&lt;span class=&quot;title&quot;&gt;Free Shipping&lt;\\/span&gt;&lt;\\/span&gt;\\r\\n    &lt;\\/a&gt;\\r\\n&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n&lt;\\/div&gt;\"}},\"status\":\"1\"}'),(53,'default Layout_SiteMapImage','html','{\"name\":\"default Layout_SiteMapImage\",\"module_description\":{\"1\":{\"title\":\"\",\"description\":\"&lt;img class=&quot;img-responsive animate scale&quot; src=&quot;image\\/catalog\\/blocks\\/sitemap-img.png&quot; alt=&quot;&quot;&gt;\"}},\"status\":\"1\"}'),(55,'boxed Landing Layout_Home Page','html','{\"name\":\"boxed Landing Layout_Home Page\",\"module_description\":{\"1\":{\"title\":\"\",\"description\":\"&lt;div class=&quot;container&quot;&gt;\\r\\n    &lt;div class=&quot;products-land row&quot;&gt;\\r\\n        &lt;div class=&quot;products-land-row&quot;&gt;\\r\\n            &lt;div class=&quot;item col1&quot;&gt;\\r\\n                &lt;img src=&quot;image\\/catalog\\/skin_landing\\/product-boxed-land1.jpg&quot; alt=&quot;&quot;&gt;\\r\\n                &lt;div class=&quot;hover&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n                &lt;div class=&quot;info middle-left text-center&quot;&gt;\\r\\n                    &lt;div class=&quot;inside&quot;&gt;\\r\\n                        &lt;div class=&quot;fsize18&quot;&gt;party dress&lt;br&gt; trending&lt;\\/div&gt;\\r\\n\\r\\n                        &lt;div class=&quot;fsize30&quot;&gt;2015&lt;\\/div&gt;\\r\\n\\r\\n                        &lt;div class=&quot;fsize10&quot;&gt;Shop arrivals!&lt;\\/div&gt;\\r\\n\\r\\n                        &lt;br&gt;\\r\\n                        &lt;a href=&quot;index.php&quot; class=&quot;btn-cool btn-transparent btn-small&quot;&gt;Shop now&lt;\\/a&gt;&lt;\\/div&gt;\\r\\n\\r\\n                &lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n            &lt;div class=&quot;item col10&quot;&gt;\\r\\n                &lt;a href=&quot;index.php&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_landing\\/image-boxed-land-1.jpg&quot; alt=&quot;&quot;&gt;&lt;\\/a&gt;\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n            &lt;div class=&quot;item col1&quot;&gt;\\r\\n                &lt;img src=&quot;image\\/catalog\\/skin_landing\\/product-boxed-land2.jpg&quot; alt=&quot;&quot;&gt;\\r\\n                &lt;div class=&quot;hover&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n                &lt;div class=&quot;info middle-left text-center&quot;&gt;\\r\\n                    &lt;div class=&quot;inside&quot;&gt;\\r\\n                        &lt;div&gt;&lt;span class=&quot;fsize50&quot;&gt;40&lt;\\/span&gt;&lt;span class=&quot;fsize16&quot;&gt;%off&lt;\\/span&gt;&lt;\\/div&gt;\\r\\n\\r\\n                        &lt;div class=&quot;fsize18&quot;&gt; on entire categories&lt;\\/div&gt;\\r\\n\\r\\n                        &lt;div class=&quot;line&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n                        &lt;div class=&quot;fsize10&quot;&gt;start from $10&lt;\\/div&gt;\\r\\n\\r\\n                        &lt;br&gt;\\r\\n                        &lt;a href=&quot;index.php&quot; class=&quot;btn-cool btn-transparent btn-small&quot;&gt;Shop now&lt;\\/a&gt;&lt;\\/div&gt;\\r\\n\\r\\n                &lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n        &lt;div class=&quot;products-land-row&quot;&gt;\\r\\n            &lt;div class=&quot;item col3&quot;&gt;\\r\\n                &lt;img src=&quot;image\\/catalog\\/skin_landing\\/product-boxed-land3.jpg&quot; alt=&quot;&quot;&gt;\\r\\n                &lt;div class=&quot;hover&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n                &lt;div class=&quot;info middle-right text-center&quot;&gt;\\r\\n                    &lt;div class=&quot;inside&quot;&gt;\\r\\n                        &lt;div class=&quot;fsize24&quot;&gt;SUMMER 2015 &lt;\\/div&gt;\\r\\n\\r\\n                        &lt;div class=&quot;fsize50&quot;&gt;FASHION TRENDS&lt;\\/div&gt;\\r\\n\\r\\n                        &lt;a href=&quot;index.php&quot; class=&quot;btn-cool btn-transparent btn-small&quot;&gt;Shop now&lt;\\/a&gt;&lt;\\/div&gt;\\r\\n\\r\\n                &lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n            &lt;div class=&quot;item col4&quot;&gt;\\r\\n                &lt;img src=&quot;image\\/catalog\\/skin_landing\\/product-boxed-land4.jpg&quot; alt=&quot;&quot;&gt;\\r\\n                &lt;div class=&quot;hover&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n                &lt;div class=&quot;info top-right text-center&quot;&gt;\\r\\n                    &lt;div class=&quot;inside&quot;&gt;\\r\\n                        &lt;div class=&quot;fsize24&quot;&gt;Must Have&lt;\\/div&gt;\\r\\n\\r\\n                        &lt;div class=&quot;fsize18&quot;&gt;Looks&lt;\\/div&gt;\\r\\n\\r\\n                        &lt;br&gt;\\r\\n                        &lt;a href=&quot;index.php&quot; class=&quot;btn-cool btn-transparent btn-small&quot;&gt;Shop now&lt;\\/a&gt;&lt;\\/div&gt;\\r\\n\\r\\n                &lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n            &lt;div class=&quot;item col2 pull-top-1 video-item&quot;&gt;\\r\\n                &lt;div class=&quot;video-poster&quot;&gt;&lt;a href=&quot;index.php&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_landing\\/video\\/video-women1.jpg&quot; alt=&quot;&quot;&gt;&lt;\\/a&gt;&lt;\\/div&gt;\\r\\n\\r\\n                &lt;div class=&quot;product-video&quot;&gt;\\r\\n                    &lt;video autoplay=&quot;&quot; preload=&quot;auto&quot; loop=&quot;&quot;&gt;\\r\\n                        &lt;source src=&quot;image\\/catalog\\/skin_landing\\/video\\/video-women1.mp4&quot; type=&quot;video\\/mp4&quot;&gt;\\r\\n                        &lt;source src=&quot;image\\/catalog\\/skin_landing\\/video\\/video-women1.ogv&quot; type=&quot;video\\/ogg&quot;&gt;\\r\\n                        &lt;a href=&quot;index.php&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_landing\\/video\\/video-women1.jpg&quot; alt=&quot;&quot;&gt;&lt;\\/a&gt;\\r\\n                    &lt;\\/video&gt;\\r\\n                &lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n        &lt;div class=&quot;products-land-row&quot;&gt;\\r\\n            &lt;div class=&quot;item col6 video-item&quot;&gt;\\r\\n                &lt;div class=&quot;video-poster&quot;&gt;&lt;a href=&quot;index.php&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_landing\\/video\\/video-women2.jpg&quot; alt=&quot;&quot;&gt;&lt;\\/a&gt;&lt;\\/div&gt;\\r\\n\\r\\n                &lt;div class=&quot;product-video&quot;&gt;\\r\\n                    &lt;video autoplay=&quot;&quot; preload=&quot;auto&quot; loop=&quot;&quot;&gt;\\r\\n                    &lt;source src=&quot;image\\/catalog\\/skin_landing\\/video\\/video-women2.mp4&quot; type=&quot;video\\/mp4&quot;&gt;\\r\\n                    &lt;source src=&quot;image\\/catalog\\/skin_landing\\/video\\/video-women2.ogv&quot; type=&quot;video\\/ogg&quot;&gt;\\r\\n                        &lt;a href=&quot;index.php&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_landing\\/video\\/video-women2.jpg&quot; alt=&quot;&quot;&gt;&lt;\\/a&gt;\\r\\n                    &lt;\\/video&gt;\\r\\n                &lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n            &lt;div class=&quot;item col7&quot;&gt;\\r\\n                &lt;img src=&quot;image\\/catalog\\/skin_landing\\/product-boxed-land5.jpg&quot; alt=&quot;&quot;&gt;\\r\\n                &lt;div class=&quot;hover&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n                &lt;div class=&quot;info middle-left text-center&quot;&gt;\\r\\n                    &lt;div class=&quot;inside&quot;&gt;\\r\\n                        &lt;div class=&quot;fsize28&quot;&gt;Falls&lt;br&gt; Fashion&lt;\\/div&gt;\\r\\n\\r\\n                        &lt;div class=&quot;fsize18&quot;&gt;2015&lt;\\/div&gt;\\r\\n\\r\\n                        &lt;br&gt;\\r\\n                        &lt;a href=&quot;index.php&quot; class=&quot;btn-cool btn-transparent btn-small&quot;&gt;Shop now&lt;\\/a&gt;\\r\\n                    &lt;\\/div&gt;\\r\\n\\r\\n                &lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n            &lt;div class=&quot;item col8 pull-top-2&quot;&gt;\\r\\n                &lt;a href=&quot;index.php&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_landing\\/image-boxed-land-2.jpg&quot; alt=&quot;&quot;&gt;&lt;\\/a&gt;\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n            &lt;div class=&quot;pull-left pull-top-3 col col9&quot;&gt;\\r\\n                &lt;div class=&quot;item&quot;&gt;\\r\\n                    &lt;img src=&quot;image\\/catalog\\/skin_landing\\/product-boxed-land6.jpg&quot; alt=&quot;&quot;&gt;\\r\\n                    &lt;div class=&quot;hover&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n                    &lt;div class=&quot;info bottom-center text-center&quot;&gt;\\r\\n                        &lt;div class=&quot;inside&quot;&gt;\\r\\n                            &lt;div class=&quot;fsize18&quot;&gt;hottest, trending, reclaimed  luxury product&lt;\\/div&gt;\\r\\n&lt;br&gt;\\r\\n                            &lt;a href=&quot;index.php&quot; class=&quot;btn-cool btn-transparent btn-small&quot;&gt;Shop now&lt;\\/a&gt;\\r\\n                        &lt;\\/div&gt;\\r\\n\\r\\n                    &lt;\\/div&gt;\\r\\n\\r\\n                &lt;\\/div&gt;\\r\\n\\r\\n                &lt;div class=&quot;item&quot;&gt;\\r\\n                    &lt;img src=&quot;image\\/catalog\\/skin_landing\\/product-boxed-land7.jpg&quot; alt=&quot;&quot;&gt;\\r\\n                    &lt;div class=&quot;hover&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n                    &lt;div class=&quot;info top-left text-center&quot;&gt;\\r\\n                        &lt;div class=&quot;inside&quot;&gt;\\r\\n                            &lt;div class=&quot;fsize21&quot;&gt;MID SEASON&lt;\\/div&gt;\\r\\n\\r\\n                            &lt;div class=&quot;fsize40 text-white&quot;&gt;SALE&lt;\\/div&gt;\\r\\n\\r\\n                            &lt;div class=&quot;fsize16&quot;&gt;up to 70% off&lt;\\/div&gt;\\r\\n\\r\\n                            &lt;a href=&quot;index.php&quot; class=&quot;btn-cool btn-transparent btn-small&quot;&gt;Shop now&lt;\\/a&gt;\\r\\n                        &lt;\\/div&gt;\\r\\n\\r\\n                    &lt;\\/div&gt;\\r\\n\\r\\n                &lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n    &lt;\\/div&gt;\\r\\n\\r\\n&lt;\\/div&gt;\"}},\"status\":\"1\"}'),(56,'Landing Banners Layout_Home Page','html','{\"name\":\"Landing Banners Layout_Home Page\",\"module_description\":{\"1\":{\"title\":\"\",\"description\":\"&lt;div&gt;\\r\\n    &lt;div class=&quot;products-land&quot;&gt;\\r\\n        &lt;div class=&quot;item&quot;&gt;\\r\\n            &lt;img src=&quot;image\\/catalog\\/skin_landing\\/image-land-01.jpg&quot; alt=&quot;&quot;&gt;\\r\\n            &lt;div class=&quot;hover&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n            &lt;div class=&quot;info top-left text-center&quot;&gt;\\r\\n                &lt;div class=&quot;inside&quot;&gt;\\r\\n                    &lt;h6&gt;Shop arrivals!&lt;\\/h6&gt;\\r\\n\\r\\n                    &lt;h2 class=&quot;border&quot;&gt;POPULAR BAGS&lt;\\/h2&gt;\\r\\n\\r\\n                    &lt;h4&gt;hottest, trending, reclaimed\\r\\n                        luxury product&lt;\\/h4&gt;\\r\\n\\r\\n                    &lt;a href=&quot;index.php&quot; class=&quot;btn-cool btn-light&quot;&gt;Shop now&lt;\\/a&gt;\\r\\n                &lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n        &lt;div class=&quot;item&quot;&gt;\\r\\n            &lt;img src=&quot;image\\/catalog\\/skin_landing\\/image-land-02.jpg&quot; alt=&quot;&quot;&gt;\\r\\n            &lt;div class=&quot;hover&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n            &lt;div class=&quot;stamp top-right&quot;&gt;\\r\\n                &lt;div class=&quot;inside&quot;&gt;UP&lt;span&gt;50%&lt;\\/span&gt;TO&lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n            &lt;div class=&quot;info bottom-center text-center&quot;&gt;\\r\\n                &lt;div class=&quot;inside&quot;&gt;\\r\\n                    &lt;h6&gt;anniversary event&lt;\\/h6&gt;\\r\\n\\r\\n                    &lt;h2 class=&quot;border&quot;&gt;exclusive jewelry&lt;\\/h2&gt;\\r\\n\\r\\n                    &lt;h4&gt;Special Pricing on all\\r\\n                        jewelry designers&lt;\\/h4&gt;\\r\\n\\r\\n                    &lt;a href=&quot;index.php&quot; class=&quot;btn-cool btn-light&quot;&gt;Shop now&lt;\\/a&gt;\\r\\n                &lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n        &lt;div class=&quot;item&quot;&gt;\\r\\n            &lt;img src=&quot;image\\/catalog\\/skin_landing\\/image-land-03.jpg&quot; alt=&quot;&quot;&gt;\\r\\n            &lt;div class=&quot;hover&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n            &lt;div class=&quot;info invert top-right text-center&quot;&gt;\\r\\n                &lt;div class=&quot;inside&quot;&gt;\\r\\n                    &lt;h6&gt;NOW TRENDING&lt;\\/h6&gt;\\r\\n\\r\\n                    &lt;h2 class=&quot;border&quot;&gt;LADIES\\u2019 WATCHES&lt;\\/h2&gt;\\r\\n\\r\\n                    &lt;h4&gt;ESIGNS OF THE YEAR&lt;br&gt;\\r\\n                        2015&lt;\\/h4&gt;\\r\\n\\r\\n                    &lt;a href=&quot;index.php&quot; class=&quot;btn-cool btn-light&quot;&gt;Shop now&lt;\\/a&gt;\\r\\n                &lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n        &lt;div class=&quot;item&quot;&gt;\\r\\n            &lt;img src=&quot;image\\/catalog\\/skin_landing\\/image-land-04.jpg&quot; alt=&quot;&quot;&gt;\\r\\n            &lt;div class=&quot;hover&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n            &lt;div class=&quot;inside&quot;&gt;\\r\\n                &lt;div class=&quot;info bottom-center text-right&quot;&gt;\\r\\n                    &lt;h2 class=&quot;quote&quot;&gt;Elegance&lt;br&gt;\\r\\n                        is the only beauty&lt;br&gt;\\r\\n                        that never fades&lt;\\/h2&gt;\\r\\n\\r\\n                    &lt;h4&gt;\\u2014 Audrey Hepburn&lt;\\/h4&gt;\\r\\n\\r\\n                    &lt;a href=&quot;index.php&quot; class=&quot;btn-cool btn-dark&quot;&gt;Shop now&lt;\\/a&gt;\\r\\n                &lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n        &lt;div class=&quot;item double-width&quot;&gt;\\r\\n            &lt;img src=&quot;image\\/catalog\\/skin_landing\\/image-land-05.jpg&quot; alt=&quot;&quot;&gt;\\r\\n            &lt;div class=&quot;hover&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n            &lt;div class=&quot;stamp bottom-left&quot;&gt;\\r\\n                &lt;div class=&quot;inside&quot;&gt;UP&lt;span&gt;25%&lt;\\/span&gt;TO&lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n            &lt;div class=&quot;info top-right text-center&quot;&gt;\\r\\n                &lt;div class=&quot;inside&quot;&gt;\\r\\n                    &lt;h6&gt;For Men Only&lt;\\/h6&gt;\\r\\n\\r\\n                    &lt;h2 class=&quot;border&quot;&gt;Special weekend discounts&lt;\\/h2&gt;\\r\\n\\r\\n                    &lt;h4&gt;Featured Men\'s Suits and Fashion&lt;br&gt;\\r\\n                        Accessories&lt;\\/h4&gt;\\r\\n\\r\\n                    &lt;a href=&quot;index.php&quot; class=&quot;btn-cool btn-white&quot;&gt;Shop now&lt;\\/a&gt;\\r\\n                &lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n        &lt;div class=&quot;item double-width&quot;&gt;\\r\\n            &lt;img src=&quot;image\\/catalog\\/skin_landing\\/image-land-06.jpg&quot; alt=&quot;&quot;&gt;\\r\\n            &lt;div class=&quot;hover&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n            &lt;div class=&quot;info middle-right invert text-center&quot;&gt;\\r\\n                &lt;div class=&quot;inside&quot;&gt;\\r\\n                    &lt;h6&gt;crazy deal: only monday &amp;amp; tuesday&lt;\\/h6&gt;\\r\\n\\r\\n                    &lt;h2 class=&quot;border&quot;&gt;girls SUMMER COLLECTIONS&lt;\\/h2&gt;\\r\\n\\r\\n                    &lt;h4&gt;Save 20-40% at our shop&lt;br&gt;\\r\\n                        and get free shippng&lt;\\/h4&gt;\\r\\n\\r\\n                    &lt;a href=&quot;index.php&quot; class=&quot;btn-cool btn-light&quot;&gt;Shop now&lt;\\/a&gt;\\r\\n                &lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n        &lt;div class=&quot;item&quot;&gt;\\r\\n            &lt;img src=&quot;image\\/catalog\\/skin_landing\\/image-land-07.jpg&quot; alt=&quot;&quot;&gt;\\r\\n            &lt;div class=&quot;hover&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n            &lt;div class=&quot;info middle-left text-center&quot;&gt;\\r\\n                &lt;div class=&quot;inside&quot;&gt;\\r\\n                    &lt;div class=&quot;stamp&quot;&gt;\\r\\n                        &lt;div class=&quot;inside&quot;&gt;UP&lt;span&gt;50%&lt;\\/span&gt;TO&lt;\\/div&gt;\\r\\n\\r\\n                    &lt;\\/div&gt;\\r\\n\\r\\n                    &lt;h2 class=&quot;underline&quot;&gt;FALL FASHION&lt;\\/h2&gt;\\r\\n\\r\\n                    &lt;h4&gt;mini style, big brands,&lt;br&gt;\\r\\n                        always 50% oFF&lt;br&gt;\\r\\n                        or less&lt;\\/h4&gt;\\r\\n\\r\\n                    &lt;a href=&quot;index.php&quot; class=&quot;btn-cool btn-dark&quot;&gt;Shop now&lt;\\/a&gt;\\r\\n                &lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n    &lt;\\/div&gt;\\r\\n\\r\\n&lt;\\/div&gt;\"}},\"status\":\"1\"}'),(57,'default Layout_Google Map_Contact Page','html','{\"name\":\"default Layout_Google Map_Contact Page\",\"module_description\":{\"1\":{\"title\":\"\",\"description\":\"&lt;iframe src=&quot;https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m14!1m8!1m3!1d6115.684863819771!2d-82.9719195443651!3d39.96727545833253!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf3846176f3dff5ed!2sLa+Aurora!5e0!3m2!1sen!2sus!4v1416911994304&quot; class=&quot;google-map&quot;&gt;&lt;\\/iframe&gt;\"}},\"status\":\"1\"}'),(58,'default Layout_Social Block_Contact Page','html','{\"name\":\"default Layout_Social Block_Contact Page\",\"module_description\":{\"1\":{\"title\":\"\",\"description\":\"&lt;p&gt;&lt;strong&gt;Vestibulum justo. Nulla mauris ipsum, convallis ut, vestibulum eu, tincidunt vel, nisi.\\r\\n    Pellentesque adipiscing nisi.&lt;\\/strong&gt;&lt;\\/p&gt;\\r\\n\\r\\n\\r\\n&lt;p&gt;Nulla facilisi. Mauris lacinia lectus sit amet felis. Aliquam erat volutpat. Nulla porttitor tortor at nisl. Nam lectus nulla, bibendum pretium, dictum a, mattis nec, dolor. Nullam id justo enim sem ut tum ut, turpis. Mauris et ligula quis erat dignissim imperdiet. Integer ligula magna, dictum et, pulvinar non, ultricies ac, nibh. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. &lt;\\/p&gt;\\r\\n\\r\\n\\r\\n&lt;ul class=&quot;socials socials-lg&quot;&gt;\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;&lt;span class=&quot;icon flaticon-facebook12&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;&lt;span class=&quot;icon flaticon-twitter20&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;&lt;span class=&quot;icon flaticon-google10&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;&lt;span class=&quot;icon flaticon-pinterest9&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;&lt;span class=&quot;icon flaticon-linkedin11&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;&lt;span class=&quot;icon flaticon-youtube18&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;&lt;span class=&quot;icon flaticon-instagram&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;&lt;span class=&quot;icon flaticon-skype12&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n&lt;\\/ul&gt;\"}},\"status\":\"1\"}'),(59,'Bio Layout_Home Page_Block Circled Banners','html','{\"name\":\"Bio Layout_Home Page_Block Circled Banners\",\"module_description\":{\"1\":{\"title\":\"\",\"description\":\"&lt;div class=&quot;container content circle_banners&quot;&gt;\\r\\n    &lt;div class=&quot;row&quot;&gt;\\r\\n        &lt;div class=&quot;col-xs-4 col-sm-4 col-md-4 col-lg-4&quot;&gt;\\r\\n            &lt;div class=&quot;banner-circle animate fadeInDown&quot; onclick=&quot;location.href=\'index.php\'&quot;&gt;\\r\\n                &lt;div class=&quot;image&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_bio\\/img1.jpg&quot; alt=&quot;&quot; class=&quot;animate-scale&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n                &lt;div class=&quot;title&quot;&gt;&lt;span&gt;New Arrivals&lt;\\/span&gt;&lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n        &lt;div class=&quot;col-xs-4 col-sm-4 col-md-4 col-lg-4&quot;&gt;\\r\\n            &lt;div class=&quot;banner-circle animate fadeInDown&quot; onclick=&quot;location.href=\'index.php\'&quot;&gt;\\r\\n                &lt;div class=&quot;image&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_bio\\/img2.jpg&quot; alt=&quot;&quot; class=&quot;animate-scale&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n                &lt;div class=&quot;title&quot;&gt;&lt;span&gt;Summer Sale&lt;\\/span&gt;&lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n        &lt;div class=&quot;col-xs-4 col-sm-4 col-md-4 col-lg-4&quot;&gt;\\r\\n            &lt;div class=&quot;banner-circle animate fadeInDown&quot; onclick=&quot;location.href=\'index.php\'&quot;&gt;\\r\\n                &lt;div class=&quot;image&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_bio\\/img3.jpg&quot; alt=&quot;&quot; class=&quot;animate-scale&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n                &lt;div class=&quot;title&quot;&gt;&lt;span&gt;Fur Clothing&lt;\\/span&gt;&lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n    &lt;\\/div&gt;\\r\\n\\r\\n&lt;\\/div&gt;\"}},\"status\":\"1\"}'),(60,'Bio Layout_Home Page_Revolution Slider','topslider','{\"name\":\"Bio Layout_Home Page_Revolution Slider\",\"module_description\":{\"1\":{\"title\":\"\",\"description\":\"&lt;ul&gt;\\r\\n\\r\\n\\r\\n    &lt;li id=&quot;slide1&quot; data-transition=&quot;papercut&quot; data-masterspeed=&quot;500&quot; data-title=&quot;First Slide&quot;&gt;\\r\\n        &lt;img src=&quot;image\\/catalog\\/dummy.png&quot; alt=&quot;slide1&quot; data-lazyload=&quot;image\\/catalog\\/skin_bio\\/slide1.jpg&quot;&gt;\\r\\n        &lt;div class=&quot;tp-caption text1 sfr&quot; data-x=&quot;850&quot; data-y=&quot;200&quot; data-speed=&quot;800&quot; data-start=&quot;1000&quot; data-easing=&quot;Power3.easeInOut&quot; data-splitout=&quot;none&quot; data-elementdelay=&quot;0.1&quot; data-endelementdelay=&quot;0.1&quot; data-endspeed=&quot;300&quot; style=&quot;z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;&quot;&gt;Non-GMO&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n        &lt;div class=&quot;tp-caption text2 sfr&quot; data-x=&quot;850&quot; data-y=&quot;320&quot; data-speed=&quot;550&quot; data-start=&quot;1500&quot; data-easing=&quot;Power3.easeInOut&quot; data-splitout=&quot;none&quot; data-elementdelay=&quot;0.1&quot; data-endelementdelay=&quot;0.1&quot; data-endspeed=&quot;300&quot; style=&quot;z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;&quot;&gt;foods 15% extra savings&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n        &lt;div class=&quot;tp-caption text3 sfr&quot; data-x=&quot;850&quot; data-y=&quot;365&quot; data-speed=&quot;550&quot; data-start=&quot;1800&quot; data-easing=&quot;Power3.easeInOut&quot; data-splitout=&quot;none&quot; data-elementdelay=&quot;0.1&quot; data-endelementdelay=&quot;0.1&quot; data-endspeed=&quot;300&quot; style=&quot;z-index: 4; max-width: 50%; max-height: auto; white-space: nowrap;&quot;&gt;Enjoy Life, Pro Bar &amp;amp; more&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n        &lt;div class=&quot;tp-caption randomrotate&quot; data-x=&quot;850&quot; data-y=&quot;400&quot; data-speed=&quot;550&quot; data-start=&quot;2000&quot; data-easing=&quot;Power3.easeInOut&quot; data-splitout=&quot;none&quot; data-elementdelay=&quot;0.1&quot; data-endelementdelay=&quot;0.1&quot; data-endspeed=&quot;300&quot; style=&quot;z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;&quot;&gt;&lt;a href=&quot;index.php&quot; class=&quot;btn btn-cool btn-lg&quot;&gt;SHOP NOW&lt;\\/a&gt;&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n    &lt;\\/li&gt;\\r\\n\\r\\n\\r\\n    &lt;li id=&quot;slide2&quot; data-transition=&quot;papercut&quot; data-masterspeed=&quot;500&quot; data-title=&quot;Second Slide&quot;&gt;\\r\\n        &lt;img src=&quot;image\\/catalog\\/dummy.png&quot; alt=&quot;slide1&quot; data-lazyload=&quot;image\\/catalog\\/skin_bio\\/slide2.jpg&quot;&gt;\\r\\n        &lt;div class=&quot;tp-caption text1 sfl&quot; data-x=&quot;150&quot; data-y=&quot;100&quot; data-speed=&quot;800&quot; data-start=&quot;1000&quot; data-easing=&quot;Power3.easeInOut&quot; data-splitout=&quot;none&quot; data-elementdelay=&quot;0.1&quot; data-endelementdelay=&quot;0.1&quot; data-endspeed=&quot;300&quot; style=&quot;z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;&quot;&gt;QUALITY&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n        &lt;div class=&quot;tp-caption text2 sfl&quot; data-x=&quot;150&quot; data-y=&quot;220&quot; data-speed=&quot;550&quot; data-start=&quot;1500&quot; data-easing=&quot;Power3.easeInOut&quot; data-splitout=&quot;none&quot; data-elementdelay=&quot;0.1&quot; data-endelementdelay=&quot;0.1&quot; data-endspeed=&quot;300&quot; style=&quot;z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;&quot;&gt;FROM SEED TO SUPPLEMENT&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n        &lt;div class=&quot;tp-caption text3 sfl&quot; data-x=&quot;150&quot; data-y=&quot;280&quot; data-speed=&quot;550&quot; data-start=&quot;1800&quot; data-easing=&quot;Power3.easeInOut&quot; data-splitout=&quot;none&quot; data-elementdelay=&quot;0.1&quot; data-endelementdelay=&quot;0.1&quot; data-endspeed=&quot;300&quot; style=&quot;z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;&quot;&gt;For more than 85 years, Standard Process has formulated supplements &lt;br&gt;made with whole food ingredients that fill the gaps of less-than-perfect &lt;br&gt;diets. Discover just how resilient your body can be when given the&lt;br&gt; proper nutrition.&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n        &lt;div class=&quot;tp-caption randomrotate&quot; data-x=&quot;150&quot; data-y=&quot;400&quot; data-speed=&quot;550&quot; data-start=&quot;2000&quot; data-easing=&quot;Power3.easeInOut&quot; data-splitout=&quot;none&quot; data-elementdelay=&quot;0.1&quot; data-endelementdelay=&quot;0.1&quot; data-endspeed=&quot;300&quot; style=&quot;z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;&quot;&gt;&lt;a href=&quot;index.php&quot; class=&quot;btn btn-cool btn-lg&quot;&gt;SHOP NOW&lt;\\/a&gt;&lt;\\/div&gt;\\r\\n\\r\\n\\r\\n    &lt;\\/li&gt;\\r\\n\\r\\n\\r\\n&lt;\\/ul&gt;\"}},\"status\":\"1\"}'),(62,'Lingerie Layout_Block Services','html','{\"name\":\"Lingerie Layout_Block Services\",\"module_description\":{\"1\":{\"title\":\"\",\"description\":\"&lt;div&gt;\\r\\n    &lt;div class=&quot;col-xs-12 col-sm-4 col-lg-4&quot;&gt;\\r\\n        &lt;a href=&quot;index.php&quot; class=&quot;item&quot;&gt;&lt;span class=&quot;icon&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_lingerie\\/icon-1.gif&quot; alt=&quot;&quot;&gt;&lt;\\/span&gt;&lt;span class=&quot;title&quot;&gt;Free shipping on orders over $200&lt;\\/span&gt; &lt;\\/a&gt;\\r\\n    &lt;\\/div&gt;\\r\\n\\r\\n    &lt;div class=&quot;col-xs-12 col-sm-4 col-lg-4&quot;&gt;\\r\\n        &lt;a href=&quot;index.php&quot; class=&quot;item&quot;&gt;&lt;span class=&quot;icon&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_lingerie\\/icon-2.gif&quot; alt=&quot;&quot;&gt;&lt;\\/span&gt;&lt;span class=&quot;title&quot;&gt;30-day returns&lt;\\/span&gt;&lt;\\/a&gt;\\r\\n    &lt;\\/div&gt;\\r\\n\\r\\n    &lt;div class=&quot;col-xs-12 col-sm-4 col-lg-4&quot;&gt;\\r\\n        &lt;a href=&quot;index.php&quot; class=&quot;item&quot;&gt;&lt;span class=&quot;icon&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_lingerie\\/icon-3.gif&quot; alt=&quot;&quot;&gt;&lt;\\/span&gt;&lt;span class=&quot;title&quot;&gt;24\\/7 Support &lt;\\/span&gt;&lt;\\/a&gt;\\r\\n    &lt;\\/div&gt;\\r\\n\\r\\n&lt;\\/div&gt;\"}},\"status\":\"1\"}'),(64,'Lingerie Layout_Home Page_Block Circled Banners','html','{\"name\":\"Lingerie Layout_Home Page_Block Circled Banners\",\"module_description\":{\"1\":{\"title\":\"\",\"description\":\"&lt;div class=&quot;container content circle_banners&quot;&gt;\\r\\n    &lt;div class=&quot;row&quot;&gt;\\r\\n        &lt;div class=&quot;col-xs-4 col-sm-4 col-md-4 col-lg-4&quot;&gt;\\r\\n            &lt;div class=&quot;banner-circle animate fadeInDown&quot; onclick=&quot;location.href=\'index.php\'&quot;&gt;\\r\\n                &lt;div class=&quot;image&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_lingerie\\/img1.jpg&quot; alt=&quot;&quot; class=&quot;animate-scale&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n                &lt;div class=&quot;title&quot;&gt;&lt;span&gt;New Arrivals&lt;\\/span&gt;&lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n        &lt;div class=&quot;col-xs-4 col-sm-4 col-md-4 col-lg-4&quot;&gt;\\r\\n            &lt;div class=&quot;banner-circle animate fadeInDown&quot; onclick=&quot;location.href=\'index.php\'&quot;&gt;\\r\\n                &lt;div class=&quot;image&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_lingerie\\/img2.jpg&quot; alt=&quot;&quot; class=&quot;animate-scale&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n                &lt;div class=&quot;title&quot;&gt;&lt;span&gt;Summer Sale&lt;\\/span&gt;&lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n        &lt;div class=&quot;col-xs-4 col-sm-4 col-md-4 col-lg-4&quot;&gt;\\r\\n            &lt;div class=&quot;banner-circle animate fadeInDown&quot; onclick=&quot;location.href=\'index.php\'&quot;&gt;\\r\\n                &lt;div class=&quot;image&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_lingerie\\/img3.jpg&quot; alt=&quot;&quot; class=&quot;animate-scale&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n                &lt;div class=&quot;title&quot;&gt;&lt;span&gt;Fur Clothing&lt;\\/span&gt;&lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n    &lt;\\/div&gt;\\r\\n\\r\\n&lt;\\/div&gt;\"}},\"status\":\"1\"}'),(67,'Kids Layout_Block Services','html','{\"name\":\"Kids Layout_Block Services\",\"module_description\":{\"1\":{\"title\":\"\",\"description\":\"&lt;div class=&quot;col-xs-12 col-sm-4 col-lg-4 service_item item1&quot;&gt;\\r\\n        &lt;a href=&quot;index.php&quot; class=&quot;item&quot;&gt;&lt;span class=&quot;icon&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_kids\\/icon-1.png&quot; alt=&quot;&quot;&gt;&lt;\\/span&gt;&lt;span class=&quot;title&quot;&gt;Free shipping on orders over $200&lt;\\/span&gt; &lt;\\/a&gt;\\r\\n    &lt;\\/div&gt;\\r\\n\\r\\n    &lt;div class=&quot;col-xs-12 col-sm-4 col-lg-4 service_item item2&quot;&gt;\\r\\n        &lt;a href=&quot;index.php&quot; class=&quot;item&quot;&gt;&lt;span class=&quot;icon&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_kids\\/icon-2.png&quot; alt=&quot;&quot;&gt;&lt;\\/span&gt;&lt;span class=&quot;title&quot;&gt;30-day returns moneyback guarantee&lt;\\/span&gt;&lt;\\/a&gt;\\r\\n    &lt;\\/div&gt;\\r\\n\\r\\n    &lt;div class=&quot;col-xs-12 col-sm-4 col-lg-4 service_item item3&quot;&gt;\\r\\n        &lt;a href=&quot;index.php&quot; class=&quot;item&quot;&gt;&lt;span class=&quot;icon&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_kids\\/icon-3.png&quot; alt=&quot;&quot;&gt;&lt;\\/span&gt;&lt;span class=&quot;title&quot;&gt;24\\/7 Support online consultation&lt;\\/span&gt;&lt;\\/a&gt;\\r\\n    &lt;\\/div&gt;\"}},\"status\":\"1\"}'),(68,'Kids Layout_Home Page_Block Circled Banners','html','{\"name\":\"Kids Layout_Home Page_Block Circled Banners\",\"module_description\":{\"1\":{\"title\":\"\",\"description\":\"&lt;div class=&quot;container content circle_banners&quot;&gt;\\r\\n    &lt;div class=&quot;row&quot;&gt;\\r\\n        &lt;div class=&quot;col-xs-4 col-sm-4 col-md-4 col-lg-4&quot;&gt;\\r\\n            &lt;div class=&quot;banner-circle animate fadeInDown&quot; onclick=&quot;location.href=\'index.php\'&quot;&gt;\\r\\n                &lt;div class=&quot;image&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_kids\\/img1.jpg&quot; alt=&quot;&quot; class=&quot;animate-scale&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n                &lt;div class=&quot;title&quot;&gt;&lt;span&gt;New Arrivals&lt;\\/span&gt;&lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n        &lt;div class=&quot;col-xs-4 col-sm-4 col-md-4 col-lg-4&quot;&gt;\\r\\n            &lt;div class=&quot;banner-circle animate fadeInDown&quot; onclick=&quot;location.href=\'index.php\'&quot;&gt;\\r\\n                &lt;div class=&quot;image&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_kids\\/img2.jpg&quot; alt=&quot;&quot; class=&quot;animate-scale&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n                &lt;div class=&quot;title&quot;&gt;&lt;span&gt;Summer Sale&lt;\\/span&gt;&lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n        &lt;div class=&quot;col-xs-4 col-sm-4 col-md-4 col-lg-4&quot;&gt;\\r\\n            &lt;div class=&quot;banner-circle animate fadeInDown&quot; onclick=&quot;location.href=\'index.php\'&quot;&gt;\\r\\n                &lt;div class=&quot;image&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_kids\\/img3.jpg&quot; alt=&quot;&quot; class=&quot;animate-scale&quot;&gt;&lt;\\/div&gt;\\r\\n\\r\\n                &lt;div class=&quot;title&quot;&gt;&lt;span&gt;Fur Clothing&lt;\\/span&gt;&lt;\\/div&gt;\\r\\n\\r\\n            &lt;\\/div&gt;\\r\\n\\r\\n        &lt;\\/div&gt;\\r\\n\\r\\n    &lt;\\/div&gt;\\r\\n\\r\\n&lt;\\/div&gt;\"}},\"status\":\"1\"}'),(69,'default Layout_Home Page_Featured Categories','fcategory','{\"name\":\"default Layout_Home Page_Featured Categories\",\"category\":[\"20\",\"18\",\"24\"],\"limit\":\"6\",\"limit_products\":\"3\",\"status_size\":\"1\",\"width\":\"390\",\"height\":\"525\",\"status\":\"1\"}'),(70,'Art Layout_Block Services','html','{\"name\":\"Art Layout_Block Services\",\"module_description\":{\"1\":{\"title\":\"\",\"description\":\"&lt;div class=&quot;col-xs-12 col-sm-4 col-lg-4&quot;&gt;\\r\\n    &lt;a href=&quot;index.php&quot; class=&quot;item&quot;&gt;&lt;span class=&quot;icon&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_art\\/icon-1.png&quot; alt=&quot;&quot;&gt;&lt;\\/span&gt;&lt;span class=&quot;title&quot;&gt;Free shipping on orders over $200&lt;\\/span&gt; &lt;\\/a&gt;\\r\\n&lt;\\/div&gt;\\r\\n\\r\\n&lt;div class=&quot;col-xs-12 col-sm-4 col-lg-4&quot;&gt;\\r\\n    &lt;a href=&quot;index.php&quot; class=&quot;item&quot;&gt;&lt;span class=&quot;icon&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_art\\/icon-2.png&quot; alt=&quot;&quot;&gt;&lt;\\/span&gt;&lt;span class=&quot;title&quot;&gt;30-day returns&lt;\\/span&gt;&lt;\\/a&gt;\\r\\n&lt;\\/div&gt;\\r\\n\\r\\n&lt;div class=&quot;col-xs-12 col-sm-4 col-lg-4&quot;&gt;\\r\\n    &lt;a href=&quot;index.php&quot; class=&quot;item&quot;&gt;&lt;span class=&quot;icon&quot;&gt;&lt;img src=&quot;image\\/catalog\\/skin_art\\/icon-3.png&quot; alt=&quot;&quot;&gt;&lt;\\/span&gt;&lt;span class=&quot;title&quot;&gt;24\\/7 Support&lt;\\/span&gt;&lt;\\/a&gt;\\r\\n&lt;\\/div&gt;\"}},\"status\":\"1\"}');

/*Table structure for table `option` */

DROP TABLE IF EXISTS `option`;

CREATE TABLE `option` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `option` */

insert  into `option`(`option_id`,`type`,`sort_order`) values (1,'radio',1),(2,'checkbox',2),(4,'text',3),(5,'select',4),(6,'textarea',5),(7,'file',6),(8,'date',7),(9,'time',8),(10,'datetime',9),(11,'select',10),(12,'date',11);

/*Table structure for table `option_description` */

DROP TABLE IF EXISTS `option_description`;

CREATE TABLE `option_description` (
  `option_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`option_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `option_description` */

insert  into `option_description`(`option_id`,`language_id`,`name`) values (1,1,'Radio'),(2,1,'Checkbox'),(4,1,'Text'),(6,1,'Textarea'),(8,1,'Date'),(7,1,'File'),(5,1,'Select'),(9,1,'Time'),(10,1,'Date &amp; Time'),(12,1,'Delivery Date'),(11,1,'Size'),(100,1,'Colors');

/*Table structure for table `option_value` */

DROP TABLE IF EXISTS `option_value`;

CREATE TABLE `option_value` (
  `option_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`option_value_id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

/*Data for the table `option_value` */

insert  into `option_value`(`option_value_id`,`option_id`,`image`,`sort_order`) values (43,1,'',3),(32,1,'',1),(45,2,'',4),(44,2,'',3),(42,5,'',4),(41,5,'',3),(39,5,'',1),(40,5,'',2),(31,1,'',2),(23,2,'',1),(24,2,'',2),(46,11,'',1),(47,11,'',2),(48,11,'',3),(49,100,'catalog/colors/blue.jpg',1),(50,100,'catalog/colors/brown.jpg',2),(51,100,'catalog/colors/green.jpg',3),(52,100,'catalog/colors/red.jpg',4),(53,100,'catalog/colors/violet.jpg',5);

/*Table structure for table `option_value_description` */

DROP TABLE IF EXISTS `option_value_description`;

CREATE TABLE `option_value_description` (
  `option_value_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`option_value_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `option_value_description` */

insert  into `option_value_description`(`option_value_id`,`language_id`,`option_id`,`name`) values (43,1,1,'Large'),(32,1,1,'Small'),(45,1,2,'Checkbox 4'),(44,1,2,'Checkbox 3'),(31,1,1,'Medium'),(42,1,5,'Yellow'),(41,1,5,'Green'),(39,1,5,'Red'),(40,1,5,'Blue'),(23,1,2,'Checkbox 1'),(24,1,2,'Checkbox 2'),(48,1,11,'Large'),(47,1,11,'Medium'),(46,1,11,'Small'),(49,1,100,'blue'),(50,1,100,'brown'),(51,1,100,'green'),(52,1,100,'red'),(53,1,100,'violet');

/*Table structure for table `order` */

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` int(11) NOT NULL DEFAULT '0',
  `invoice_prefix` varchar(26) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
  `store_name` varchar(64) NOT NULL,
  `store_url` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `customer_group_id` int(11) NOT NULL DEFAULT '0',
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `telephone` varchar(32) NOT NULL,
  `fax` varchar(32) NOT NULL,
  `custom_field` text NOT NULL,
  `payment_firstname` varchar(32) NOT NULL,
  `payment_lastname` varchar(32) NOT NULL,
  `payment_company` varchar(40) NOT NULL,
  `payment_address_1` varchar(128) NOT NULL,
  `payment_address_2` varchar(128) NOT NULL,
  `payment_city` varchar(128) NOT NULL,
  `payment_postcode` varchar(10) NOT NULL,
  `payment_country` varchar(128) NOT NULL,
  `payment_country_id` int(11) NOT NULL,
  `payment_zone` varchar(128) NOT NULL,
  `payment_zone_id` int(11) NOT NULL,
  `payment_address_format` text NOT NULL,
  `payment_custom_field` text NOT NULL,
  `payment_method` varchar(128) NOT NULL,
  `payment_code` varchar(128) NOT NULL,
  `shipping_firstname` varchar(32) NOT NULL,
  `shipping_lastname` varchar(32) NOT NULL,
  `shipping_company` varchar(40) NOT NULL,
  `shipping_address_1` varchar(128) NOT NULL,
  `shipping_address_2` varchar(128) NOT NULL,
  `shipping_city` varchar(128) NOT NULL,
  `shipping_postcode` varchar(10) NOT NULL,
  `shipping_country` varchar(128) NOT NULL,
  `shipping_country_id` int(11) NOT NULL,
  `shipping_zone` varchar(128) NOT NULL,
  `shipping_zone_id` int(11) NOT NULL,
  `shipping_address_format` text NOT NULL,
  `shipping_custom_field` text NOT NULL,
  `shipping_method` varchar(128) NOT NULL,
  `shipping_code` varchar(128) NOT NULL,
  `comment` text NOT NULL,
  `total` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `order_status_id` int(11) NOT NULL DEFAULT '0',
  `affiliate_id` int(11) NOT NULL,
  `commission` decimal(15,4) NOT NULL,
  `marketing_id` int(11) NOT NULL,
  `tracking` varchar(64) NOT NULL,
  `language_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `currency_code` varchar(3) NOT NULL,
  `currency_value` decimal(15,8) NOT NULL DEFAULT '1.00000000',
  `ip` varchar(40) NOT NULL,
  `forwarded_ip` varchar(40) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `accept_language` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `order` */

/*Table structure for table `order_custom_field` */

DROP TABLE IF EXISTS `order_custom_field`;

CREATE TABLE `order_custom_field` (
  `order_custom_field_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `custom_field_id` int(11) NOT NULL,
  `custom_field_value_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `type` varchar(32) NOT NULL,
  `location` varchar(16) NOT NULL,
  PRIMARY KEY (`order_custom_field_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `order_custom_field` */

/*Table structure for table `order_history` */

DROP TABLE IF EXISTS `order_history`;

CREATE TABLE `order_history` (
  `order_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_status_id` int(11) NOT NULL,
  `notify` tinyint(1) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`order_history_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `order_history` */

/*Table structure for table `order_option` */

DROP TABLE IF EXISTS `order_option`;

CREATE TABLE `order_option` (
  `order_option_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_product_id` int(11) NOT NULL,
  `product_option_id` int(11) NOT NULL,
  `product_option_value_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `type` varchar(32) NOT NULL,
  PRIMARY KEY (`order_option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `order_option` */

/*Table structure for table `order_product` */

DROP TABLE IF EXISTS `order_product`;

CREATE TABLE `order_product` (
  `order_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `model` varchar(64) NOT NULL,
  `quantity` int(4) NOT NULL,
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `tax` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `reward` int(8) NOT NULL,
  PRIMARY KEY (`order_product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `order_product` */

/*Table structure for table `order_recurring` */

DROP TABLE IF EXISTS `order_recurring`;

CREATE TABLE `order_recurring` (
  `order_recurring_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `recurring_id` int(11) NOT NULL,
  `recurring_name` varchar(255) NOT NULL,
  `recurring_description` varchar(255) NOT NULL,
  `recurring_frequency` varchar(25) NOT NULL,
  `recurring_cycle` smallint(6) NOT NULL,
  `recurring_duration` smallint(6) NOT NULL,
  `recurring_price` decimal(10,4) NOT NULL,
  `trial` tinyint(1) NOT NULL,
  `trial_frequency` varchar(25) NOT NULL,
  `trial_cycle` smallint(6) NOT NULL,
  `trial_duration` smallint(6) NOT NULL,
  `trial_price` decimal(10,4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`order_recurring_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `order_recurring` */

/*Table structure for table `order_recurring_transaction` */

DROP TABLE IF EXISTS `order_recurring_transaction`;

CREATE TABLE `order_recurring_transaction` (
  `order_recurring_transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_recurring_id` int(11) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` decimal(10,4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`order_recurring_transaction_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `order_recurring_transaction` */

/*Table structure for table `order_status` */

DROP TABLE IF EXISTS `order_status`;

CREATE TABLE `order_status` (
  `order_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`order_status_id`,`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `order_status` */

insert  into `order_status`(`order_status_id`,`language_id`,`name`) values (2,1,'Processing'),(3,1,'Shipped'),(7,1,'Canceled'),(5,1,'Complete'),(8,1,'Denied'),(9,1,'Canceled Reversal'),(10,1,'Failed'),(11,1,'Refunded'),(12,1,'Reversed'),(13,1,'Chargeback'),(1,1,'Pending'),(16,1,'Voided'),(15,1,'Processed'),(14,1,'Expired');

/*Table structure for table `order_total` */

DROP TABLE IF EXISTS `order_total`;

CREATE TABLE `order_total` (
  `order_total_id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`order_total_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `order_total` */

/*Table structure for table `order_voucher` */

DROP TABLE IF EXISTS `order_voucher`;

CREATE TABLE `order_voucher` (
  `order_voucher_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `code` varchar(10) NOT NULL,
  `from_name` varchar(64) NOT NULL,
  `from_email` varchar(96) NOT NULL,
  `to_name` varchar(64) NOT NULL,
  `to_email` varchar(96) NOT NULL,
  `voucher_theme_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  PRIMARY KEY (`order_voucher_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `order_voucher` */

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(64) NOT NULL,
  `sku` varchar(64) NOT NULL,
  `upc` varchar(12) NOT NULL,
  `ean` varchar(14) NOT NULL,
  `jan` varchar(13) NOT NULL,
  `isbn` varchar(17) NOT NULL,
  `mpn` varchar(64) NOT NULL,
  `location` varchar(128) NOT NULL,
  `quantity` int(4) NOT NULL DEFAULT '0',
  `stock_status_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `shipping` tinyint(1) NOT NULL DEFAULT '1',
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `points` int(8) NOT NULL DEFAULT '0',
  `tax_class_id` int(11) NOT NULL,
  `date_available` date NOT NULL DEFAULT '0000-00-00',
  `weight` decimal(15,8) NOT NULL DEFAULT '0.00000000',
  `weight_class_id` int(11) NOT NULL DEFAULT '0',
  `length` decimal(15,8) NOT NULL DEFAULT '0.00000000',
  `width` decimal(15,8) NOT NULL DEFAULT '0.00000000',
  `height` decimal(15,8) NOT NULL DEFAULT '0.00000000',
  `length_class_id` int(11) NOT NULL DEFAULT '0',
  `subtract` tinyint(1) NOT NULL DEFAULT '1',
  `minimum` int(11) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `viewed` int(5) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

/*Data for the table `product` */

insert  into `product`(`product_id`,`model`,`sku`,`upc`,`ean`,`jan`,`isbn`,`mpn`,`location`,`quantity`,`stock_status_id`,`image`,`manufacturer_id`,`shipping`,`price`,`points`,`tax_class_id`,`date_available`,`weight`,`weight_class_id`,`length`,`width`,`height`,`length_class_id`,`subtract`,`minimum`,`sort_order`,`status`,`viewed`,`date_added`,`date_modified`) values (50,'ZEVTUUFTUC','','','','','','','',100,6,'catalog/ring1.jpg',0,1,56000.0000,0,0,'2015-11-19',0.00000000,2,0.00000000,0.00000000,0.00000000,1,1,1,1,1,6,'2015-11-19 20:39:48','2015-11-19 21:04:10'),(51,'ZEVTUUFTDD','','','','','','','',20,6,'catalog/ring3.jpg',0,1,10859.0000,0,0,'2015-11-19',0.00000000,1,0.00000000,0.00000000,0.00000000,1,1,1,1,1,6,'2015-11-19 20:50:23','2015-11-19 20:55:14');

/*Table structure for table `product_attribute` */

DROP TABLE IF EXISTS `product_attribute`;

CREATE TABLE `product_attribute` (
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`product_id`,`attribute_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `product_attribute` */

/*Table structure for table `product_description` */

DROP TABLE IF EXISTS `product_description`;

CREATE TABLE `product_description` (
  `product_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `tag` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`product_id`,`language_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `product_description` */

insert  into `product_description`(`product_id`,`language_id`,`name`,`description`,`tag`,`meta_title`,`meta_description`,`meta_keyword`) values (50,1,'ATLANTIS RING','&lt;p&gt;&lt;br&gt;&lt;/p&gt;','','ATLANTIS RING','',''),(51,1,'THE OLAVI RING','&lt;p&gt;&lt;br&gt;&lt;/p&gt;','','THE OLAVI RING','','');

/*Table structure for table `product_discount` */

DROP TABLE IF EXISTS `product_discount`;

CREATE TABLE `product_discount` (
  `product_discount_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `quantity` int(4) NOT NULL DEFAULT '0',
  `priority` int(5) NOT NULL DEFAULT '1',
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `date_start` date NOT NULL DEFAULT '0000-00-00',
  `date_end` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`product_discount_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=444 DEFAULT CHARSET=utf8;

/*Data for the table `product_discount` */

/*Table structure for table `product_filter` */

DROP TABLE IF EXISTS `product_filter`;

CREATE TABLE `product_filter` (
  `product_id` int(11) NOT NULL,
  `filter_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`filter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `product_filter` */

insert  into `product_filter`(`product_id`,`filter_id`) values (20,1),(20,2),(20,3);

/*Table structure for table `product_image` */

DROP TABLE IF EXISTS `product_image`;

CREATE TABLE `product_image` (
  `product_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_image_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2370 DEFAULT CHARSET=utf8;

/*Data for the table `product_image` */

insert  into `product_image`(`product_image_id`,`product_id`,`image`,`sort_order`) values (2369,50,'catalog/ring2.jpg',2),(2368,50,'catalog/ring1.jpg',1),(2366,51,'catalog/ring3.jpg',1),(2367,51,'catalog/ring4.jpg',2);

/*Table structure for table `product_option` */

DROP TABLE IF EXISTS `product_option`;

CREATE TABLE `product_option` (
  `product_option_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `value` text NOT NULL,
  `required` tinyint(1) NOT NULL,
  PRIMARY KEY (`product_option_id`)
) ENGINE=MyISAM AUTO_INCREMENT=231 DEFAULT CHARSET=utf8;

/*Data for the table `product_option` */

/*Table structure for table `product_option_value` */

DROP TABLE IF EXISTS `product_option_value`;

CREATE TABLE `product_option_value` (
  `product_option_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_option_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `option_value_id` int(11) NOT NULL,
  `quantity` int(3) NOT NULL,
  `subtract` tinyint(1) NOT NULL,
  `price` decimal(15,4) NOT NULL,
  `price_prefix` varchar(1) NOT NULL,
  `points` int(8) NOT NULL,
  `points_prefix` varchar(1) NOT NULL,
  `weight` decimal(15,8) NOT NULL,
  `weight_prefix` varchar(1) NOT NULL,
  PRIMARY KEY (`product_option_value_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

/*Data for the table `product_option_value` */

/*Table structure for table `product_recurring` */

DROP TABLE IF EXISTS `product_recurring`;

CREATE TABLE `product_recurring` (
  `product_id` int(11) NOT NULL,
  `recurring_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`recurring_id`,`customer_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `product_recurring` */

/*Table structure for table `product_related` */

DROP TABLE IF EXISTS `product_related`;

CREATE TABLE `product_related` (
  `product_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`related_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `product_related` */

/*Table structure for table `product_reward` */

DROP TABLE IF EXISTS `product_reward`;

CREATE TABLE `product_reward` (
  `product_reward_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `customer_group_id` int(11) NOT NULL DEFAULT '0',
  `points` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_reward_id`)
) ENGINE=MyISAM AUTO_INCREMENT=547 DEFAULT CHARSET=utf8;

/*Data for the table `product_reward` */

insert  into `product_reward`(`product_reward_id`,`product_id`,`customer_group_id`,`points`) values (546,50,1,200);

/*Table structure for table `product_special` */

DROP TABLE IF EXISTS `product_special`;

CREATE TABLE `product_special` (
  `product_special_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `priority` int(5) NOT NULL DEFAULT '1',
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `date_start` date NOT NULL DEFAULT '0000-00-00',
  `date_end` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`product_special_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=453 DEFAULT CHARSET=utf8;

/*Data for the table `product_special` */

insert  into `product_special`(`product_special_id`,`product_id`,`customer_group_id`,`priority`,`price`,`date_start`,`date_end`) values (451,51,1,0,9859.0000,'0000-00-00','0000-00-00'),(452,50,1,0,52000.0000,'2015-11-18','2015-11-30');

/*Table structure for table `product_to_category` */

DROP TABLE IF EXISTS `product_to_category`;

CREATE TABLE `product_to_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `product_to_category` */

insert  into `product_to_category`(`product_id`,`category_id`) values (50,33),(50,60),(51,33),(51,60),(51,64);

/*Table structure for table `product_to_download` */

DROP TABLE IF EXISTS `product_to_download`;

CREATE TABLE `product_to_download` (
  `product_id` int(11) NOT NULL,
  `download_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`download_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `product_to_download` */

/*Table structure for table `product_to_layout` */

DROP TABLE IF EXISTS `product_to_layout`;

CREATE TABLE `product_to_layout` (
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `product_to_layout` */

insert  into `product_to_layout`(`product_id`,`store_id`,`layout_id`) values (50,0,4),(51,0,4);

/*Table structure for table `product_to_store` */

DROP TABLE IF EXISTS `product_to_store`;

CREATE TABLE `product_to_store` (
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `product_to_store` */

insert  into `product_to_store`(`product_id`,`store_id`) values (50,0),(51,0);

/*Table structure for table `recurring` */

DROP TABLE IF EXISTS `recurring`;

CREATE TABLE `recurring` (
  `recurring_id` int(11) NOT NULL AUTO_INCREMENT,
  `price` decimal(10,4) NOT NULL,
  `frequency` enum('day','week','semi_month','month','year') NOT NULL,
  `duration` int(10) unsigned NOT NULL,
  `cycle` int(10) unsigned NOT NULL,
  `trial_status` tinyint(4) NOT NULL,
  `trial_price` decimal(10,4) NOT NULL,
  `trial_frequency` enum('day','week','semi_month','month','year') NOT NULL,
  `trial_duration` int(10) unsigned NOT NULL,
  `trial_cycle` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`recurring_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `recurring` */

/*Table structure for table `recurring_description` */

DROP TABLE IF EXISTS `recurring_description`;

CREATE TABLE `recurring_description` (
  `recurring_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`recurring_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `recurring_description` */

/*Table structure for table `return` */

DROP TABLE IF EXISTS `return`;

CREATE TABLE `return` (
  `return_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `telephone` varchar(32) NOT NULL,
  `product` varchar(255) NOT NULL,
  `model` varchar(64) NOT NULL,
  `quantity` int(4) NOT NULL,
  `opened` tinyint(1) NOT NULL,
  `return_reason_id` int(11) NOT NULL,
  `return_action_id` int(11) NOT NULL,
  `return_status_id` int(11) NOT NULL,
  `comment` text,
  `date_ordered` date NOT NULL DEFAULT '0000-00-00',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`return_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `return` */

/*Table structure for table `return_action` */

DROP TABLE IF EXISTS `return_action`;

CREATE TABLE `return_action` (
  `return_action_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`return_action_id`,`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `return_action` */

insert  into `return_action`(`return_action_id`,`language_id`,`name`) values (1,1,'Refunded'),(2,1,'Credit Issued'),(3,1,'Replacement Sent');

/*Table structure for table `return_history` */

DROP TABLE IF EXISTS `return_history`;

CREATE TABLE `return_history` (
  `return_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `return_id` int(11) NOT NULL,
  `return_status_id` int(11) NOT NULL,
  `notify` tinyint(1) NOT NULL,
  `comment` text NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`return_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `return_history` */

/*Table structure for table `return_reason` */

DROP TABLE IF EXISTS `return_reason`;

CREATE TABLE `return_reason` (
  `return_reason_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`return_reason_id`,`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `return_reason` */

insert  into `return_reason`(`return_reason_id`,`language_id`,`name`) values (1,1,'Dead On Arrival'),(2,1,'Received Wrong Item'),(3,1,'Order Error'),(4,1,'Faulty, please supply details'),(5,1,'Other, please supply details');

/*Table structure for table `return_status` */

DROP TABLE IF EXISTS `return_status`;

CREATE TABLE `return_status` (
  `return_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`return_status_id`,`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `return_status` */

insert  into `return_status`(`return_status_id`,`language_id`,`name`) values (1,1,'Pending'),(3,1,'Complete'),(2,1,'Awaiting Products');

/*Table structure for table `review` */

DROP TABLE IF EXISTS `review`;

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `author` varchar(64) NOT NULL,
  `text` text NOT NULL,
  `rating` int(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`review_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `review` */

/*Table structure for table `setting` */

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL DEFAULT '0',
  `code` varchar(32) NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` text NOT NULL,
  `serialized` tinyint(1) NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1102 DEFAULT CHARSET=utf8;

/*Data for the table `setting` */

insert  into `setting`(`setting_id`,`store_id`,`code`,`key`,`value`,`serialized`) values (1,0,'shipping','shipping_sort_order','3',0),(2,0,'sub_total','sub_total_sort_order','1',0),(3,0,'sub_total','sub_total_status','1',0),(4,0,'tax','tax_status','1',0),(5,0,'total','total_sort_order','9',0),(6,0,'total','total_status','1',0),(7,0,'tax','tax_sort_order','5',0),(8,0,'free_checkout','free_checkout_sort_order','1',0),(9,0,'cod','cod_sort_order','5',0),(10,0,'cod','cod_total','0.01',0),(11,0,'cod','cod_order_status_id','1',0),(12,0,'cod','cod_geo_zone_id','0',0),(13,0,'cod','cod_status','1',0),(14,0,'shipping','shipping_status','1',0),(15,0,'shipping','shipping_estimator','1',0),(27,0,'coupon','coupon_sort_order','4',0),(28,0,'coupon','coupon_status','1',0),(34,0,'flat','flat_sort_order','1',0),(35,0,'flat','flat_status','1',0),(36,0,'flat','flat_geo_zone_id','0',0),(37,0,'flat','flat_tax_class_id','9',0),(41,0,'flat','flat_cost','5.00',0),(42,0,'credit','credit_sort_order','7',0),(43,0,'credit','credit_status','1',0),(53,0,'reward','reward_sort_order','2',0),(54,0,'reward','reward_status','1',0),(408,0,'customisation','customisation_general_store','{\"preloader\":[\"1\"],\"homepage_mode\":[\"full\"],\"back_top_arrow\":[\"\"],\"back_top_mouse\":[\"\"],\"back_top_status\":[\"1\"],\"search_block\":[\"1\"],\"cart_button\":[\"1\"],\"header_service_buttons\":[\"1\"],\"footerpopup\":[\"1\"],\"css_file\":[\"0\"],\"phone_number\":[\"0\"],\"1\":{\"welcome_message\":[\"Default welcome msg!\"],\"customitem_item_title1\":[\"buy now\"],\"blog_link_title\":[\"blog\"],\"pages_link_title\":[\"Pages\"],\"contact_map_title\":[\"contact us\"],\"footer_socials_title\":[\"FIND US\"],\"custom_html_title\":[\"CUSTOM HTML BLOCK\"],\"customblock_html\":[\"&lt;ul class=&quot;menu menu-icon&quot;&gt;\\r\\n\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;span class=&quot;icon flaticon-home113&quot;&gt;&lt;\\/span&gt;7563 St. Vincent Place, Glasgow&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;span class=&quot;icon flaticon-phone163&quot;&gt;&lt;\\/span&gt;321321321, 321321321&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;span class=&quot;icon icon-xs flaticon-new78&quot;&gt;&lt;\\/span&gt;&lt;a href=&quot;mailto:info@mydomain.com&quot;&gt;info@mydomain.com&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n\\r\\n    &lt;li&gt;&lt;span class=&quot;icon flaticon-skype12&quot;&gt;&lt;\\/span&gt;&lt;a href=&quot;index.php&quot;&gt;shop.test&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\\r\\n\\r\\n\\r\\n&lt;\\/ul&gt;\"],\"newsletter_title\":[\"NEWSLETTER SIGNUP\"],\"newsletter_promo\":[\"Enter your email and we\'ll send you a coupon with 10% off your next order.\"],\"newsletter_placeholder\":[\"YOUR E-MAIL...\"],\"newsletter_button\":[\"SUBSCRIBE\"],\"newsletter_close\":[\"Don\'t show this popup again\"],\"preloader_html\":[\"&lt;p&gt;&lt;br&gt;&lt;\\/p&gt;\"],\"sale_text\":[\"SALE\"],\"new_text\":[\"NEW\"],\"quick_view_text\":[\"Quick View\"]},\"header_type\":[\"1\"],\"service_buttons_type\":[\"1\"],\"top_menu_type\":[\"1\"],\"category_divider\":[\"1\"],\"customitem_item_url1\":[\"index.php\"],\"blog_link_status\":[\"1\"],\"blog_link_url\":[\"index.php?route=simple_blog\\/article\"],\"pages_link_url\":[\"\"],\"pages_status\":[\"1\"],\"contact_map_status\":[\"1\"],\"additional_page_id\":{\"10\":\"10\",\"4\":\"4\",\"18\":\"18\",\"6\":\"6\",\"11\":\"11\",\"15\":\"15\",\"16\":\"16\",\"17\":\"17\",\"14\":\"14\",\"3\":\"3\",\"19\":\"19\",\"5\":\"5\",\"12\":\"12\",\"20\":\"20\"},\"additional_page_status\":{\"10\":[\"1\"],\"4\":[\"0\"],\"18\":[\"1\"],\"6\":[\"0\"],\"11\":[\"1\"],\"15\":[\"1\"],\"16\":[\"1\"],\"17\":[\"1\"],\"14\":[\"1\"],\"3\":[\"0\"],\"19\":[\"1\"],\"5\":[\"0\"],\"12\":[\"1\"],\"20\":[\"1\"]},\"additional_page_checkout_status\":[\"1\"],\"additional_page_account_status\":[\"1\"],\"footer_type\":[\"1\"],\"footercopyright\":[\"&amp;copy; 2015 &lt;a href=&quot;index.php&quot;&gt;Coolbaby&lt;\\/a&gt;. All Rights Reserved.\"],\"socials\":[\"&lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;&lt;span class=&quot;icon flaticon-facebook12&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n&lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;&lt;span class=&quot;icon flaticon-twitter20&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n&lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;&lt;span class=&quot;icon flaticon-google10&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n&lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;&lt;span class=&quot;icon flaticon-pinterest9&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n&lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;&lt;span class=&quot;icon flaticon-linkedin11&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n&lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;&lt;span class=&quot;icon flaticon-youtube18&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n&lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;&lt;span class=&quot;icon flaticon-instagram&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n&lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;&lt;span class=&quot;icon flaticon-skype12&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n\"],\"socials_status\":[\"1\"],\"footerpayment\":[\"&lt;li&gt;&lt;img src=&quot;image\\/catalog\\/blocks\\/icon-payment-01.png&quot; width=&quot;36&quot; height=&quot;22&quot; alt=&quot;&quot;&gt;&lt;\\/li&gt;\\r\\n&lt;li&gt;&lt;img src=&quot;image\\/catalog\\/blocks\\/icon-payment-02.png&quot; width=&quot;36&quot; height=&quot;22&quot; alt=&quot;&quot;&gt;&lt;\\/li&gt;\\r\\n&lt;li&gt;&lt;img src=&quot;image\\/catalog\\/blocks\\/icon-payment-03.png&quot; width=&quot;36&quot; height=&quot;22&quot; alt=&quot;&quot;&gt;&lt;\\/li&gt;\\r\\n&lt;li&gt;&lt;img src=&quot;image\\/catalog\\/blocks\\/icon-payment-04.png&quot; width=&quot;36&quot; height=&quot;22&quot; alt=&quot;&quot;&gt;&lt;\\/li&gt;\\r\\n&lt;li&gt;&lt;img src=&quot;image\\/catalog\\/blocks\\/icon-payment-05.png&quot; width=&quot;36&quot; height=&quot;22&quot; alt=&quot;&quot;&gt;&lt;\\/li&gt;\\r\\n\"],\"footerpayment_status\":[\"1\"],\"customblock_status\":[\"1\"],\"apikey\":[\"test\"],\"list_unique_id\":[\"test\"],\"newsletter_status\":[\"1\"],\"newsletter_popup_status\":[\"1\"],\"share_block1\":[\"&lt;a href=&quot;https:\\/\\/www.facebook.com\\/&quot;&gt;&lt;span class=&quot;icon flaticon-facebook12&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;\"],\"share_block2\":[\"&lt;a href=&quot;https:\\/\\/twitter.com&quot;&gt;&lt;span class=&quot;icon flaticon-twitter20&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;\"],\"share_block3\":[\"&lt;a href=&quot;https:\\/\\/www.google.com\\/&quot;&gt;&lt;span class=&quot;icon flaticon-google10&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;\"],\"share_block4\":[\"&lt;a href=&quot;https:\\/\\/www.pinterest.com\\/&quot;&gt;&lt;span class=&quot;icon flaticon-pinterest9&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;\"],\"slick_row\":[\"7\"],\"preloader_status\":[\"1\"]}',1),(159,0,'affiliate','affiliate_status','1',0),(1100,0,'config','config_error_log','1',0),(1101,0,'config','config_error_filename','error.log',0),(1098,0,'config','config_file_mime_allowed','text/plain\r\nimage/png\r\nimage/jpeg\r\nimage/gif\r\nimage/bmp\r\nimage/tiff\r\nimage/svg+xml\r\napplication/zip\r\n&quot;application/zip&quot;\r\napplication/x-zip\r\n&quot;application/x-zip&quot;\r\napplication/x-zip-compressed\r\n&quot;application/x-zip-compressed&quot;\r\napplication/rar\r\n&quot;application/rar&quot;\r\napplication/x-rar\r\n&quot;application/x-rar&quot;\r\napplication/x-rar-compressed\r\n&quot;application/x-rar-compressed&quot;\r\napplication/octet-stream\r\n&quot;application/octet-stream&quot;\r\naudio/mpeg\r\nvideo/quicktime\r\napplication/pdf',0),(1099,0,'config','config_error_display','1',0),(1096,0,'config','config_file_max_size','300000',0),(1097,0,'config','config_file_ext_allowed','zip\r\ntxt\r\npng\r\njpe\r\njpeg\r\njpg\r\ngif\r\nbmp\r\nico\r\ntiff\r\ntif\r\nsvg\r\nsvgz\r\nzip\r\nrar\r\nmsi\r\ncab\r\nmp3\r\nqt\r\nmov\r\npdf\r\npsd\r\nai\r\neps\r\nps\r\ndoc',0),(1095,0,'config','config_encryption','8K0mhim2yx09RZixeDAvmgH8gk1cob5rJrDbt5MxwXhchtQFknfCc2FuwnffxPw6SX47d3GvzTCtkxqpYSzjqiFGCgHxkwELtkQ6iG6RrcWTyNxnG1mAOlpfQHFcLjdh8zItcBf3Es1piuKLwe4Czq445kROLTBGucDJVMPTy4wZfVLVKUKjmfKP8C8lEL3TVJThpEJVmSy4ciUZ25uQgywskZNx8Y8V0U5iEuD2Xv6wBC1etnUaBqSCWxwyEPfMtcEXSfpb5LZhozwBiqlJEVp7GyNbtdHOnVYVlxLBDJGk0dt3lNjt55e1RvQZg2zgf7auGHzLtsDKA8GbhLD5YrbAOzGXQCkPXiqfC8VGrRsefRHb0hiaIz6NilToxrLeH4Z32mkI5XOfthZrRFi2w3dtdjMgI7GFlqzaqEGLehY1RNpoyvgccjf5qqxGfrqYTNg5MwiDtHuOAqLn714DkuTFUtHdjk09Gh0gxmoOsW5VryrZkBPH29SWqT3rihX7xACp06nlGeQB99R1uENTzikCjayoSLy5mDSli9aLvDRf75n6BeRkZJnp7xS69IxRwkTPrba5uXXYOQS5BAAEr5IIKxuypFK90n5biEF3mTlfxqjZ522sEaFoIMrT0wpyF9faRFEiQKipkHmNpYZhwMa7aiRJx62I3o4Gpv437ArAWaXo2SGXE0u9HQz1iRJJvabh4spX1jLsDf1baOmxRjUn7hbOcBLhYWywAz8CveXMkFGrHvlmwUZiG0u9NCQRRRifOJ8BgN64THLbFCBOCR9J7a58vlooGlX3QXkPFe9PrgdQVTS9WdFXq4ozLSyHvr4uW3qCkpMRCb2Um0yJD8SOky75XcWoqVrdo4CgYqJt7SQpByz1cFfdCrw0rPTsm3MeOfGXjIvOpWjBi6SSv2Sn1fnRXr7h1FVZBa4FOUtdhSSQNLKmvXPasZHnNpDXMMbLzINtjM4l5HYwb8uSTJEHWBtSII8vz4DjYA9r9CbKe6w1qYDMOUrIrPCoATeY',0),(1094,0,'config','config_shared','0',0),(1093,0,'config','config_password','1',0),(1090,0,'config','config_robots','abot\r\ndbot\r\nebot\r\nhbot\r\nkbot\r\nlbot\r\nmbot\r\nnbot\r\nobot\r\npbot\r\nrbot\r\nsbot\r\ntbot\r\nvbot\r\nybot\r\nzbot\r\nbot.\r\nbot/\r\n_bot\r\n.bot\r\n/bot\r\n-bot\r\n:bot\r\n(bot\r\ncrawl\r\nslurp\r\nspider\r\nseek\r\naccoona\r\nacoon\r\nadressendeutschland\r\nah-ha.com\r\nahoy\r\naltavista\r\nananzi\r\nanthill\r\nappie\r\narachnophilia\r\narale\r\naraneo\r\naranha\r\narchitext\r\naretha\r\narks\r\nasterias\r\natlocal\r\natn\r\natomz\r\naugurfind\r\nbackrub\r\nbannana_bot\r\nbaypup\r\nbdfetch\r\nbig brother\r\nbiglotron\r\nbjaaland\r\nblackwidow\r\nblaiz\r\nblog\r\nblo.\r\nbloodhound\r\nboitho\r\nbooch\r\nbradley\r\nbutterfly\r\ncalif\r\ncassandra\r\nccubee\r\ncfetch\r\ncharlotte\r\nchurl\r\ncienciaficcion\r\ncmc\r\ncollective\r\ncomagent\r\ncombine\r\ncomputingsite\r\ncsci\r\ncurl\r\ncusco\r\ndaumoa\r\ndeepindex\r\ndelorie\r\ndepspid\r\ndeweb\r\ndie blinde kuh\r\ndigger\r\nditto\r\ndmoz\r\ndocomo\r\ndownload express\r\ndtaagent\r\ndwcp\r\nebiness\r\nebingbong\r\ne-collector\r\nejupiter\r\nemacs-w3 search engine\r\nesther\r\nevliya celebi\r\nezresult\r\nfalcon\r\nfelix ide\r\nferret\r\nfetchrover\r\nfido\r\nfindlinks\r\nfireball\r\nfish search\r\nfouineur\r\nfunnelweb\r\ngazz\r\ngcreep\r\ngenieknows\r\ngetterroboplus\r\ngeturl\r\nglx\r\ngoforit\r\ngolem\r\ngrabber\r\ngrapnel\r\ngralon\r\ngriffon\r\ngromit\r\ngrub\r\ngulliver\r\nhamahakki\r\nharvest\r\nhavindex\r\nhelix\r\nheritrix\r\nhku www octopus\r\nhomerweb\r\nhtdig\r\nhtml index\r\nhtml_analyzer\r\nhtmlgobble\r\nhubater\r\nhyper-decontextualizer\r\nia_archiver\r\nibm_planetwide\r\nichiro\r\niconsurf\r\niltrovatore\r\nimage.kapsi.net\r\nimagelock\r\nincywincy\r\nindexer\r\ninfobee\r\ninformant\r\ningrid\r\ninktomisearch.com\r\ninspector web\r\nintelliagent\r\ninternet shinchakubin\r\nip3000\r\niron33\r\nisraeli-search\r\nivia\r\njack\r\njakarta\r\njavabee\r\njetbot\r\njumpstation\r\nkatipo\r\nkdd-explorer\r\nkilroy\r\nknowledge\r\nkototoi\r\nkretrieve\r\nlabelgrabber\r\nlachesis\r\nlarbin\r\nlegs\r\nlibwww\r\nlinkalarm\r\nlink validator\r\nlinkscan\r\nlockon\r\nlwp\r\nlycos\r\nmagpie\r\nmantraagent\r\nmapoftheinternet\r\nmarvin/\r\nmattie\r\nmediafox\r\nmediapartners\r\nmercator\r\nmerzscope\r\nmicrosoft url control\r\nminirank\r\nmiva\r\nmj12\r\nmnogosearch\r\nmoget\r\nmonster\r\nmoose\r\nmotor\r\nmultitext\r\nmuncher\r\nmuscatferret\r\nmwd.search\r\nmyweb\r\nnajdi\r\nnameprotect\r\nnationaldirectory\r\nnazilla\r\nncsa beta\r\nnec-meshexplorer\r\nnederland.zoek\r\nnetcarta webmap engine\r\nnetmechanic\r\nnetresearchserver\r\nnetscoop\r\nnewscan-online\r\nnhse\r\nnokia6682/\r\nnomad\r\nnoyona\r\nnutch\r\nnzexplorer\r\nobjectssearch\r\noccam\r\nomni\r\nopen text\r\nopenfind\r\nopenintelligencedata\r\norb search\r\nosis-project\r\npack rat\r\npageboy\r\npagebull\r\npage_verifier\r\npanscient\r\nparasite\r\npartnersite\r\npatric\r\npear.\r\npegasus\r\nperegrinator\r\npgp key agent\r\nphantom\r\nphpdig\r\npicosearch\r\npiltdownman\r\npimptrain\r\npinpoint\r\npioneer\r\npiranha\r\nplumtreewebaccessor\r\npogodak\r\npoirot\r\npompos\r\npoppelsdorf\r\npoppi\r\npopular iconoclast\r\npsycheclone\r\npublisher\r\npython\r\nrambler\r\nraven search\r\nroach\r\nroad runner\r\nroadhouse\r\nrobbie\r\nrobofox\r\nrobozilla\r\nrules\r\nsalty\r\nsbider\r\nscooter\r\nscoutjet\r\nscrubby\r\nsearch.\r\nsearchprocess\r\nsemanticdiscovery\r\nsenrigan\r\nsg-scout\r\nshai\'hulud\r\nshark\r\nshopwiki\r\nsidewinder\r\nsift\r\nsilk\r\nsimmany\r\nsite searcher\r\nsite valet\r\nsitetech-rover\r\nskymob.com\r\nsleek\r\nsmartwit\r\nsna-\r\nsnappy\r\nsnooper\r\nsohu\r\nspeedfind\r\nsphere\r\nsphider\r\nspinner\r\nspyder\r\nsteeler/\r\nsuke\r\nsuntek\r\nsupersnooper\r\nsurfnomore\r\nsven\r\nsygol\r\nszukacz\r\ntach black widow\r\ntarantula\r\ntempleton\r\n/teoma\r\nt-h-u-n-d-e-r-s-t-o-n-e\r\ntheophrastus\r\ntitan\r\ntitin\r\ntkwww\r\ntoutatis\r\nt-rex\r\ntutorgig\r\ntwiceler\r\ntwisted\r\nucsd\r\nudmsearch\r\nurl check\r\nupdated\r\nvagabondo\r\nvalkyrie\r\nverticrawl\r\nvictoria\r\nvision-search\r\nvolcano\r\nvoyager/\r\nvoyager-hc\r\nw3c_validator\r\nw3m2\r\nw3mir\r\nwalker\r\nwallpaper\r\nwanderer\r\nwauuu\r\nwavefire\r\nweb core\r\nweb hopper\r\nweb wombat\r\nwebbandit\r\nwebcatcher\r\nwebcopy\r\nwebfoot\r\nweblayers\r\nweblinker\r\nweblog monitor\r\nwebmirror\r\nwebmonkey\r\nwebquest\r\nwebreaper\r\nwebsitepulse\r\nwebsnarf\r\nwebstolperer\r\nwebvac\r\nwebwalk\r\nwebwatch\r\nwebwombat\r\nwebzinger\r\nwhizbang\r\nwhowhere\r\nwild ferret\r\nworldlight\r\nwwwc\r\nwwwster\r\nxenu\r\nxget\r\nxift\r\nxirq\r\nyandex\r\nyanga\r\nyeti\r\nyodao\r\nzao\r\nzippp\r\nzyborg',0),(1091,0,'config','config_compression','9',0),(1092,0,'config','config_secure','0',0),(1089,0,'config','config_seo_url','1',0),(1088,0,'config','config_maintenance','0',0),(1087,0,'config','config_mail_alert','',0),(94,0,'voucher','voucher_sort_order','8',0),(95,0,'voucher','voucher_status','1',0),(103,0,'free_checkout','free_checkout_status','1',0),(104,0,'free_checkout','free_checkout_order_status_id','1',0),(1086,0,'config','config_mail_smtp_timeout','5',0),(1085,0,'config','config_mail_smtp_port','25',0),(1084,0,'config','config_mail_smtp_password','',0),(1083,0,'config','config_mail_smtp_username','',0),(1082,0,'config','config_mail_smtp_hostname','',0),(1081,0,'config','config_mail_parameter','',0),(1079,0,'config','config_ftp_status','0',0),(1080,0,'config','config_mail_protocol','mail',0),(1078,0,'config','config_ftp_root','',0),(1077,0,'config','config_ftp_password','',0),(1076,0,'config','config_ftp_username','',0),(1075,0,'config','config_ftp_port','21',0),(1074,0,'config','config_ftp_hostname','localhost',0),(1073,0,'config','config_image_location_height','50',0),(1072,0,'config','config_image_location_width','268',0),(1071,0,'config','config_image_cart_height','47',0),(1070,0,'config','config_image_cart_width','47',0),(1069,0,'config','config_image_wishlist_height','47',0),(1068,0,'config','config_image_wishlist_width','47',0),(1067,0,'config','config_image_compare_height','90',0),(1066,0,'config','config_image_compare_width','90',0),(1065,0,'config','config_image_related_height','80',0),(1064,0,'config','config_image_related_width','80',0),(1063,0,'config','config_image_additional_height','74',0),(1062,0,'config','config_image_additional_width','74',0),(1061,0,'config','config_image_product_height','228',0),(1060,0,'config','config_image_product_width','228',0),(1059,0,'config','config_image_popup_height','500',0),(1058,0,'config','config_image_popup_width','500',0),(1057,0,'config','config_image_thumb_height','228',0),(1056,0,'config','config_image_thumb_width','228',0),(1055,0,'config','config_image_category_height','80',0),(1054,0,'config','config_image_category_width','80',0),(1053,0,'config','config_icon','catalog/jzeva.png',0),(1050,0,'config','config_captcha','',0),(1051,0,'config','config_captcha_page','[\"review\",\"return\",\"contact\"]',1),(1052,0,'config','config_logo','catalog/logo.png',0),(1049,0,'config','config_return_status_id','2',0),(1048,0,'config','config_return_id','0',0),(1047,0,'config','config_affiliate_mail','0',0),(1046,0,'config','config_affiliate_id','4',0),(1041,0,'config','config_stock_warning','0',0),(1042,0,'config','config_stock_checkout','0',0),(1043,0,'config','config_affiliate_approval','0',0),(1044,0,'config','config_affiliate_auto','0',0),(1045,0,'config','config_affiliate_commission','5',0),(1040,0,'config','config_stock_display','0',0),(1039,0,'config','config_api_id','1',0),(1038,0,'config','config_order_mail','0',0),(1034,0,'config','config_order_status_id','1',0),(1035,0,'config','config_processing_status','[\"5\",\"1\",\"2\",\"12\",\"3\"]',1),(1036,0,'config','config_complete_status','[\"5\",\"3\"]',1),(1037,0,'config','config_fraud_status_id','7',0),(1033,0,'config','config_checkout_id','5',0),(1032,0,'config','config_checkout_guest','1',0),(1031,0,'config','config_cart_weight','1',0),(1030,0,'config','config_invoice_prefix','INV-2013-00',0),(1029,0,'config','config_account_mail','0',0),(1028,0,'config','config_account_id','3',0),(1027,0,'config','config_login_attempts','5',0),(1026,0,'config','config_customer_price','0',0),(1024,0,'config','config_customer_group_id','1',0),(1025,0,'config','config_customer_group_display','[\"1\"]',1),(1023,0,'config','config_customer_online','0',0),(1022,0,'config','config_tax_customer','shipping',0),(1021,0,'config','config_tax_default','shipping',0),(1020,0,'config','config_tax','1',0),(1019,0,'config','config_voucher_max','1000',0),(1018,0,'config','config_voucher_min','1',0),(1017,0,'config','config_review_mail','1',0),(1016,0,'config','config_review_guest','1',0),(1015,0,'config','config_review_status','1',0),(1012,0,'config','config_product_limit','30',0),(1013,0,'config','config_product_description_length','100',0),(1014,0,'config','config_limit_admin','20',0),(1011,0,'config','config_product_count','1',0),(1010,0,'config','config_weight_class_id','1',0),(1009,0,'config','config_length_class_id','1',0),(1008,0,'config','config_currency_auto','0',0),(1007,0,'config','config_currency','INR',0),(1006,0,'config','config_admin_language','en',0),(1005,0,'config','config_language','en',0),(1004,0,'config','config_zone_id','1489',0),(1003,0,'config','config_country_id','99',0),(1002,0,'config','config_comment','',0),(1001,0,'config','config_open','',0),(1000,0,'config','config_image','',0),(999,0,'config','config_fax','',0),(998,0,'config','config_telephone','123456789',0),(997,0,'config','config_email','admin@jzeva.com',0),(996,0,'config','config_geocode','',0),(994,0,'config','config_owner','Your Name',0),(995,0,'config','config_address','Address 1',0),(409,0,'customisation','customisation_slider_store','{\"featured_type\":[\"slick\"],\"latest_type\":[\"horizontal\"],\"bestseller_type\":[\"vertical\"],\"popular_type\":[\"vertical\"],\"special_type\":[\"vertical\"],\"random_type\":[\"vertical\"]}',1),(410,0,'customisation','customisation_translation_store','{\"1\":{\"dd_title\":[\"New Products\"],\"view_details\":[\"add to cart\"],\"share_title\":[\"share\"],\"tags_tab_title\":[\"tags\"],\"brands_title\":[\"BRANDS\"],\"countdown_title\":[\"special price valid:\"],\"countdown_title_day\":[\"days\"],\"countdown_title_hour\":[\"hrs\"],\"countdown_title_minute\":[\"min\"],\"countdown_title_second\":[\"sec\"]}}',1),(411,0,'customisation','customisation_colors_store','{\"layout_skin\":[\"default\"],\"general_bgcolor\":[\"\"],\"contentbg\":[\"\"],\"content_bg_mode\":[\"repeat\"],\"general_themecolor\":[\"\"],\"general_text\":[\"\"],\"general_link\":[\"\"],\"captions_text\":[\"\"],\"topline_bgcolor\":[\"\"],\"topline_texts\":[\"\"],\"header_icons_color\":[\"\"],\"toolline_border\":[\"\"],\"toolline_ink\":[\"\"],\"toolline_icons\":[\"\"],\"toolline_bgcolor\":[\"\"],\"top_menu_bgcolor\":[\"\"],\"topmenu_items\":[\"\"],\"toopmenu_highlight\":[\"\"],\"topmenu_hot\":[\"\"],\"topmenu_new\":[\"\"],\"promo_bg\":[\"\"],\"promo_texts\":[\"\"],\"circle_texts\":[\"\"],\"container_bgcolor\":[\"\"],\"blog_bg\":[\"\"],\"blog_bg_image\":[\"\"],\"blog_bg_mode\":[\"repeat\"],\"newsletter_wrapper_bg\":[\"\"],\"newsletter_bg\":[\"\"],\"listing_border\":[\"\"],\"listing_regular_price\":[\"\"],\"listing_old_price\":[\"\"],\"listing_special_price\":[\"\"],\"footerpopup_captions\":[\"\"],\"footerpopup_link\":[\"\"],\"footerpopup_bgcolor\":[\"\"],\"footerpopup_image\":[\"\"],\"footerpopup_bg_mode\":[\"repeat\"],\"footerbottom_captions\":[\"\"],\"footerbottom_texts\":[\"\"],\"footerbottom_bg\":[\"\"],\"footerbottom_icons\":[\"\"]}',1),(412,0,'customisation','customisation_products_store','{\"product_catalog_mode\":[\"0\"],\"product_listing_type\":[\"small_with_column\"],\"quick_sliders_type\":[\"2\"],\"quick_sliders_slick_type\":[\"1\"],\"quick_listing_type\":[\"2\"],\"sale_status\":[\"1\"],\"sale_label_bg\":[\"\"],\"new_status\":[\"1\"],\"days\":[\"1000\"],\"new_label_bg\":[\"\"],\"discount_label_bg\":[\"\"],\"quick_status\":[\"1\"],\"discount_status\":[\"1\"],\"countdown_status\":[\"1\"],\"popup_small_status\":[\"1\"],\"related\":[\"enable\"],\"video_image\":[\"\"],\"product_page_button\":[\"&lt;span class=&quot;pull-left&quot;&gt;Share:&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&lt;\\/span&gt;\\r\\n&lt;ul class=&quot;socials&quot;&gt;\\r\\n    &lt;li&gt;&lt;a href=&quot;https:\\/\\/www.facebook.com\\/&quot;&gt;&lt;span class=&quot;icon flaticon-facebook12&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n    &lt;li&gt;&lt;a href=&quot;https:\\/\\/twitter.com\\/&quot;&gt;&lt;span class=&quot;icon flaticon-twitter20&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n    &lt;li&gt;&lt;a href=&quot;https:\\/\\/www.google.com&quot;&gt;&lt;span class=&quot;icon flaticon-google10&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n    &lt;li&gt;&lt;a href=&quot;https:\\/\\/www.pinterest.com\\/&quot;&gt;&lt;span class=&quot;icon flaticon-pinterest9&quot;&gt;&lt;\\/span&gt;&lt;\\/a&gt;&lt;\\/li&gt;\\r\\n&lt;\\/ul&gt;\\r\\n\"]}',1),(413,0,'news','news_status','1',0),(414,0,'category','category_status','1',0),(415,0,'filter','filter_status','1',0),(416,0,'account','account_status','1',0),(417,0,'upsells','upsells_status','1',0),(993,0,'config','config_name','Your Store',0),(992,0,'config','config_layout_id','4',0),(991,0,'config','config_template','coolbaby',0),(990,0,'config','config_meta_keyword','',0),(989,0,'config','config_meta_description','My Store',0),(988,0,'config','config_meta_title','Your Store',0);

/*Table structure for table `stock_status` */

DROP TABLE IF EXISTS `stock_status`;

CREATE TABLE `stock_status` (
  `stock_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`stock_status_id`,`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `stock_status` */

insert  into `stock_status`(`stock_status_id`,`language_id`,`name`) values (7,1,'In Stock'),(8,1,'Pre-Order'),(5,1,'Out Of Stock'),(6,1,'2-3 Days');

/*Table structure for table `store` */

DROP TABLE IF EXISTS `store`;

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `url` varchar(255) NOT NULL,
  `ssl` varchar(255) NOT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `store` */

/*Table structure for table `tax_class` */

DROP TABLE IF EXISTS `tax_class`;

CREATE TABLE `tax_class` (
  `tax_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`tax_class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `tax_class` */

insert  into `tax_class`(`tax_class_id`,`title`,`description`,`date_added`,`date_modified`) values (9,'Taxable Goods','Taxed goods','2009-01-06 23:21:53','2015-11-19 14:48:58'),(10,'Downloadable Products','Downloadable','2011-09-21 22:19:39','2015-11-19 14:48:36');

/*Table structure for table `tax_rate` */

DROP TABLE IF EXISTS `tax_rate`;

CREATE TABLE `tax_rate` (
  `tax_rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `geo_zone_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(32) NOT NULL,
  `rate` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `type` char(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`tax_rate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;

/*Data for the table `tax_rate` */

/*Table structure for table `tax_rate_to_customer_group` */

DROP TABLE IF EXISTS `tax_rate_to_customer_group`;

CREATE TABLE `tax_rate_to_customer_group` (
  `tax_rate_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  PRIMARY KEY (`tax_rate_id`,`customer_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tax_rate_to_customer_group` */

/*Table structure for table `tax_rule` */

DROP TABLE IF EXISTS `tax_rule`;

CREATE TABLE `tax_rule` (
  `tax_rule_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_class_id` int(11) NOT NULL,
  `tax_rate_id` int(11) NOT NULL,
  `based` varchar(10) NOT NULL,
  `priority` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tax_rule_id`)
) ENGINE=MyISAM AUTO_INCREMENT=129 DEFAULT CHARSET=utf8;

/*Data for the table `tax_rule` */

/*Table structure for table `upload` */

DROP TABLE IF EXISTS `upload`;

CREATE TABLE `upload` (
  `upload_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`upload_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `upload` */

/*Table structure for table `url_alias` */

DROP TABLE IF EXISTS `url_alias`;

CREATE TABLE `url_alias` (
  `url_alias_id` int(11) NOT NULL AUTO_INCREMENT,
  `query` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`url_alias_id`),
  KEY `query` (`query`),
  KEY `keyword` (`keyword`)
) ENGINE=MyISAM AUTO_INCREMENT=875 DEFAULT CHARSET=utf8;

/*Data for the table `url_alias` */

insert  into `url_alias`(`url_alias_id`,`query`,`keyword`) values (730,'manufacturer_id=8','apple'),(772,'information_id=4','about_us'),(851,'category_id=59',''),(852,'category_id=60',''),(853,'category_id=61',''),(854,'category_id=62',''),(855,'category_id=63',''),(856,'category_id=64',''),(872,'category_id=73',''),(871,'category_id=72',''),(870,'category_id=71',''),(869,'category_id=70',''),(868,'category_id=69',''),(867,'category_id=68',''),(828,'manufacturer_id=9','canon'),(829,'manufacturer_id=5','htc'),(830,'manufacturer_id=7','hewlett-packard'),(831,'manufacturer_id=6','palm'),(832,'manufacturer_id=10','sony'),(841,'information_id=6','delivery'),(842,'information_id=3','privacy'),(843,'information_id=5','terms');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(9) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `image` varchar(255) NOT NULL,
  `code` varchar(40) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`user_id`,`user_group_id`,`username`,`password`,`salt`,`firstname`,`lastname`,`email`,`image`,`code`,`ip`,`status`,`date_added`) values (1,1,'admin','b696fc1ff9efaec61e06eec3a5d38eaf020fd0f4','Yh7u1EowI','John','Doe','admin@jzeva.com','','','::1',1,'2015-10-21 10:26:51');

/*Table structure for table `user_group` */

DROP TABLE IF EXISTS `user_group`;

CREATE TABLE `user_group` (
  `user_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `permission` text NOT NULL,
  PRIMARY KEY (`user_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `user_group` */

insert  into `user_group`(`user_group_id`,`name`,`permission`) values (1,'Administrator','{\"access\":[\"analytics\\/google_analytics\",\"captcha\\/basic_captcha\",\"captcha\\/google_captcha\",\"catalog\\/attribute\",\"catalog\\/attribute_group\",\"catalog\\/category\",\"catalog\\/download\",\"catalog\\/filter\",\"catalog\\/information\",\"catalog\\/manufacturer\",\"catalog\\/mcategory\",\"catalog\\/mproduct\",\"catalog\\/option\",\"catalog\\/product\",\"catalog\\/recurring\",\"catalog\\/review\",\"common\\/column_left\",\"common\\/filemanager\",\"common\\/menu\",\"common\\/profile\",\"common\\/sass\",\"common\\/stats\",\"customer\\/custom_field\",\"customer\\/customer\",\"customer\\/customer_group\",\"design\\/banner\",\"design\\/layout\",\"extension\\/analytics\",\"extension\\/captcha\",\"extension\\/feed\",\"extension\\/fraud\",\"extension\\/installer\",\"extension\\/modification\",\"extension\\/module\",\"extension\\/openbay\",\"extension\\/payment\",\"extension\\/shipping\",\"extension\\/total\",\"feed\\/google_base\",\"feed\\/google_sitemap\",\"feed\\/openbaypro\",\"fraud\\/fraudlabspro\",\"fraud\\/ip\",\"fraud\\/maxmind\",\"localisation\\/country\",\"localisation\\/currency\",\"localisation\\/geo_zone\",\"localisation\\/language\",\"localisation\\/length_class\",\"localisation\\/location\",\"localisation\\/order_status\",\"localisation\\/return_action\",\"localisation\\/return_reason\",\"localisation\\/return_status\",\"localisation\\/stock_status\",\"localisation\\/tax_class\",\"localisation\\/tax_rate\",\"localisation\\/weight_class\",\"localisation\\/zone\",\"marketing\\/affiliate\",\"marketing\\/contact\",\"marketing\\/coupon\",\"marketing\\/marketing\",\"module\\/account\",\"module\\/affiliate\",\"module\\/amazon_login\",\"module\\/amazon_pay\",\"module\\/banner\",\"module\\/bestseller\",\"module\\/carousel\",\"module\\/category\",\"module\\/customisation\",\"module\\/ebay_listing\",\"module\\/fcategory\",\"module\\/featured\",\"module\\/filter\",\"module\\/footer_info\",\"module\\/google_hangouts\",\"module\\/html\",\"module\\/information\",\"module\\/latest\",\"module\\/popular\",\"module\\/pp_button\",\"module\\/pp_login\",\"module\\/random\",\"module\\/slideshow\",\"module\\/smartmenu\",\"module\\/special\",\"module\\/store\",\"module\\/topslider\",\"module\\/upsells\",\"openbay\\/amazon\",\"openbay\\/amazon_listing\",\"openbay\\/amazon_product\",\"openbay\\/amazonus\",\"openbay\\/amazonus_listing\",\"openbay\\/amazonus_product\",\"openbay\\/ebay\",\"openbay\\/ebay_profile\",\"openbay\\/ebay_template\",\"openbay\\/etsy\",\"openbay\\/etsy_product\",\"openbay\\/etsy_shipping\",\"openbay\\/etsy_shop\",\"payment\\/amazon_login_pay\",\"payment\\/authorizenet_aim\",\"payment\\/authorizenet_sim\",\"payment\\/bank_transfer\",\"payment\\/bluepay_hosted\",\"payment\\/bluepay_redirect\",\"payment\\/cheque\",\"payment\\/cod\",\"payment\\/firstdata\",\"payment\\/firstdata_remote\",\"payment\\/free_checkout\",\"payment\\/g2apay\",\"payment\\/globalpay\",\"payment\\/globalpay_remote\",\"payment\\/klarna_account\",\"payment\\/klarna_invoice\",\"payment\\/liqpay\",\"payment\\/nochex\",\"payment\\/paymate\",\"payment\\/paypoint\",\"payment\\/payza\",\"payment\\/perpetual_payments\",\"payment\\/pp_express\",\"payment\\/pp_payflow\",\"payment\\/pp_payflow_iframe\",\"payment\\/pp_pro\",\"payment\\/pp_pro_iframe\",\"payment\\/pp_standard\",\"payment\\/realex\",\"payment\\/realex_remote\",\"payment\\/sagepay_direct\",\"payment\\/sagepay_server\",\"payment\\/sagepay_us\",\"payment\\/securetrading_pp\",\"payment\\/securetrading_ws\",\"payment\\/skrill\",\"payment\\/twocheckout\",\"payment\\/web_payment_software\",\"payment\\/worldpay\",\"report\\/affiliate\",\"report\\/affiliate_activity\",\"report\\/affiliate_login\",\"report\\/customer_activity\",\"report\\/customer_credit\",\"report\\/customer_login\",\"report\\/customer_online\",\"report\\/customer_order\",\"report\\/customer_reward\",\"report\\/marketing\",\"report\\/product_purchased\",\"report\\/product_viewed\",\"report\\/sale_coupon\",\"report\\/sale_order\",\"report\\/sale_return\",\"report\\/sale_shipping\",\"report\\/sale_tax\",\"sale\\/order\",\"sale\\/recurring\",\"sale\\/return\",\"sale\\/voucher\",\"sale\\/voucher_theme\",\"setting\\/setting\",\"setting\\/store\",\"shipping\\/auspost\",\"shipping\\/citylink\",\"shipping\\/fedex\",\"shipping\\/flat\",\"shipping\\/free\",\"shipping\\/item\",\"shipping\\/parcelforce_48\",\"shipping\\/pickup\",\"shipping\\/royal_mail\",\"shipping\\/ups\",\"shipping\\/usps\",\"shipping\\/weight\",\"tool\\/backup\",\"tool\\/error_log\",\"tool\\/upload\",\"total\\/coupon\",\"total\\/credit\",\"total\\/handling\",\"total\\/klarna_fee\",\"total\\/low_order_fee\",\"total\\/reward\",\"total\\/shipping\",\"total\\/sub_total\",\"total\\/tax\",\"total\\/total\",\"total\\/voucher\",\"user\\/api\",\"user\\/user\",\"user\\/user_permission\"],\"modify\":[\"analytics\\/google_analytics\",\"captcha\\/basic_captcha\",\"captcha\\/google_captcha\",\"catalog\\/attribute\",\"catalog\\/attribute_group\",\"catalog\\/category\",\"catalog\\/download\",\"catalog\\/filter\",\"catalog\\/information\",\"catalog\\/manufacturer\",\"catalog\\/mcategory\",\"catalog\\/mproduct\",\"catalog\\/option\",\"catalog\\/product\",\"catalog\\/recurring\",\"catalog\\/review\",\"common\\/column_left\",\"common\\/filemanager\",\"common\\/menu\",\"common\\/profile\",\"common\\/sass\",\"common\\/stats\",\"customer\\/custom_field\",\"customer\\/customer\",\"customer\\/customer_group\",\"design\\/banner\",\"design\\/layout\",\"extension\\/analytics\",\"extension\\/captcha\",\"extension\\/feed\",\"extension\\/fraud\",\"extension\\/installer\",\"extension\\/modification\",\"extension\\/module\",\"extension\\/openbay\",\"extension\\/payment\",\"extension\\/shipping\",\"extension\\/total\",\"feed\\/google_base\",\"feed\\/google_sitemap\",\"feed\\/openbaypro\",\"fraud\\/fraudlabspro\",\"fraud\\/ip\",\"fraud\\/maxmind\",\"localisation\\/country\",\"localisation\\/currency\",\"localisation\\/geo_zone\",\"localisation\\/language\",\"localisation\\/length_class\",\"localisation\\/location\",\"localisation\\/order_status\",\"localisation\\/return_action\",\"localisation\\/return_reason\",\"localisation\\/return_status\",\"localisation\\/stock_status\",\"localisation\\/tax_class\",\"localisation\\/tax_rate\",\"localisation\\/weight_class\",\"localisation\\/zone\",\"marketing\\/affiliate\",\"marketing\\/contact\",\"marketing\\/coupon\",\"marketing\\/marketing\",\"module\\/account\",\"module\\/affiliate\",\"module\\/amazon_login\",\"module\\/amazon_pay\",\"module\\/banner\",\"module\\/bestseller\",\"module\\/carousel\",\"module\\/category\",\"module\\/customisation\",\"module\\/ebay_listing\",\"module\\/fcategory\",\"module\\/featured\",\"module\\/filter\",\"module\\/footer_info\",\"module\\/google_hangouts\",\"module\\/html\",\"module\\/information\",\"module\\/latest\",\"module\\/popular\",\"module\\/pp_button\",\"module\\/pp_login\",\"module\\/random\",\"module\\/slideshow\",\"module\\/smartmenu\",\"module\\/special\",\"module\\/store\",\"module\\/topslider\",\"module\\/upsells\",\"openbay\\/amazon\",\"openbay\\/amazon_listing\",\"openbay\\/amazon_product\",\"openbay\\/amazonus\",\"openbay\\/amazonus_listing\",\"openbay\\/amazonus_product\",\"openbay\\/ebay\",\"openbay\\/ebay_profile\",\"openbay\\/ebay_template\",\"openbay\\/etsy\",\"openbay\\/etsy_product\",\"openbay\\/etsy_shipping\",\"openbay\\/etsy_shop\",\"payment\\/amazon_login_pay\",\"payment\\/authorizenet_aim\",\"payment\\/authorizenet_sim\",\"payment\\/bank_transfer\",\"payment\\/bluepay_hosted\",\"payment\\/bluepay_redirect\",\"payment\\/cheque\",\"payment\\/cod\",\"payment\\/firstdata\",\"payment\\/firstdata_remote\",\"payment\\/free_checkout\",\"payment\\/g2apay\",\"payment\\/globalpay\",\"payment\\/globalpay_remote\",\"payment\\/klarna_account\",\"payment\\/klarna_invoice\",\"payment\\/liqpay\",\"payment\\/nochex\",\"payment\\/paymate\",\"payment\\/paypoint\",\"payment\\/payza\",\"payment\\/perpetual_payments\",\"payment\\/pp_express\",\"payment\\/pp_payflow\",\"payment\\/pp_payflow_iframe\",\"payment\\/pp_pro\",\"payment\\/pp_pro_iframe\",\"payment\\/pp_standard\",\"payment\\/realex\",\"payment\\/realex_remote\",\"payment\\/sagepay_direct\",\"payment\\/sagepay_server\",\"payment\\/sagepay_us\",\"payment\\/securetrading_pp\",\"payment\\/securetrading_ws\",\"payment\\/skrill\",\"payment\\/twocheckout\",\"payment\\/web_payment_software\",\"payment\\/worldpay\",\"report\\/affiliate\",\"report\\/affiliate_activity\",\"report\\/affiliate_login\",\"report\\/customer_activity\",\"report\\/customer_credit\",\"report\\/customer_login\",\"report\\/customer_online\",\"report\\/customer_order\",\"report\\/customer_reward\",\"report\\/marketing\",\"report\\/product_purchased\",\"report\\/product_viewed\",\"report\\/sale_coupon\",\"report\\/sale_order\",\"report\\/sale_return\",\"report\\/sale_shipping\",\"report\\/sale_tax\",\"sale\\/order\",\"sale\\/recurring\",\"sale\\/return\",\"sale\\/voucher\",\"sale\\/voucher_theme\",\"setting\\/setting\",\"setting\\/store\",\"shipping\\/auspost\",\"shipping\\/citylink\",\"shipping\\/fedex\",\"shipping\\/flat\",\"shipping\\/free\",\"shipping\\/item\",\"shipping\\/parcelforce_48\",\"shipping\\/pickup\",\"shipping\\/royal_mail\",\"shipping\\/ups\",\"shipping\\/usps\",\"shipping\\/weight\",\"tool\\/backup\",\"tool\\/error_log\",\"tool\\/upload\",\"total\\/coupon\",\"total\\/credit\",\"total\\/handling\",\"total\\/klarna_fee\",\"total\\/low_order_fee\",\"total\\/reward\",\"total\\/shipping\",\"total\\/sub_total\",\"total\\/tax\",\"total\\/total\",\"total\\/voucher\",\"user\\/api\",\"user\\/user\",\"user\\/user_permission\"]}'),(10,'Demonstration','');

/*Table structure for table `voucher` */

DROP TABLE IF EXISTS `voucher`;

CREATE TABLE `voucher` (
  `voucher_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `from_name` varchar(64) NOT NULL,
  `from_email` varchar(96) NOT NULL,
  `to_name` varchar(64) NOT NULL,
  `to_email` varchar(96) NOT NULL,
  `voucher_theme_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`voucher_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `voucher` */

/*Table structure for table `voucher_history` */

DROP TABLE IF EXISTS `voucher_history`;

CREATE TABLE `voucher_history` (
  `voucher_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`voucher_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `voucher_history` */

/*Table structure for table `voucher_theme` */

DROP TABLE IF EXISTS `voucher_theme`;

CREATE TABLE `voucher_theme` (
  `voucher_theme_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`voucher_theme_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `voucher_theme` */

insert  into `voucher_theme`(`voucher_theme_id`,`image`) values (8,'catalog/demo/canon_eos_5d_2.jpg'),(7,'catalog/demo/gift-voucher-birthday.jpg'),(6,'catalog/demo/apple_logo.jpg');

/*Table structure for table `voucher_theme_description` */

DROP TABLE IF EXISTS `voucher_theme_description`;

CREATE TABLE `voucher_theme_description` (
  `voucher_theme_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`voucher_theme_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `voucher_theme_description` */

insert  into `voucher_theme_description`(`voucher_theme_id`,`language_id`,`name`) values (6,1,'Christmas'),(7,1,'Birthday'),(8,1,'General');

/*Table structure for table `weight_class` */

DROP TABLE IF EXISTS `weight_class`;

CREATE TABLE `weight_class` (
  `weight_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `value` decimal(15,8) NOT NULL DEFAULT '0.00000000',
  PRIMARY KEY (`weight_class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `weight_class` */

insert  into `weight_class`(`weight_class_id`,`value`) values (1,1.00000000),(2,1000.00000000),(5,2.20460000),(6,35.27400000);

/*Table structure for table `weight_class_description` */

DROP TABLE IF EXISTS `weight_class_description`;

CREATE TABLE `weight_class_description` (
  `weight_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `unit` varchar(4) NOT NULL,
  PRIMARY KEY (`weight_class_id`,`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `weight_class_description` */

insert  into `weight_class_description`(`weight_class_id`,`language_id`,`title`,`unit`) values (1,1,'Kilogram','kg'),(2,1,'Gram','g'),(5,1,'Pound ','lb'),(6,1,'Ounce','oz');

/*Table structure for table `zone` */

DROP TABLE IF EXISTS `zone`;

CREATE TABLE `zone` (
  `zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `code` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`zone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4232 DEFAULT CHARSET=utf8;

/*Data for the table `zone` */

insert  into `zone`(`zone_id`,`country_id`,`name`,`code`,`status`) values (1475,99,'Andaman and Nicobar Islands','AN',1),(1476,99,'Andhra Pradesh','AP',1),(1477,99,'Arunachal Pradesh','AR',1),(1478,99,'Assam','AS',1),(1479,99,'Bihar','BI',1),(1480,99,'Chandigarh','CH',1),(1481,99,'Dadra and Nagar Haveli','DA',1),(1482,99,'Daman and Diu','DM',1),(1483,99,'Delhi','DE',1),(1484,99,'Goa','GO',1),(1485,99,'Gujarat','GU',1),(1486,99,'Haryana','HA',1),(1487,99,'Himachal Pradesh','HP',1),(1488,99,'Jammu and Kashmir','JA',1),(1489,99,'Karnataka','KA',1),(1490,99,'Kerala','KE',1),(1491,99,'Lakshadweep Islands','LI',1),(1492,99,'Madhya Pradesh','MP',1),(1493,99,'Maharashtra','MA',1),(1494,99,'Manipur','MN',1),(1495,99,'Meghalaya','ME',1),(1496,99,'Mizoram','MI',1),(1497,99,'Nagaland','NA',1),(1498,99,'Orissa','OR',1),(1499,99,'Puducherry','PO',1),(1500,99,'Punjab','PU',1),(1501,99,'Rajasthan','RA',1),(1502,99,'Sikkim','SI',1),(1503,99,'Tamil Nadu','TN',1),(1504,99,'Tripura','TR',1),(1505,99,'Uttar Pradesh','UP',1),(1506,99,'West Bengal','WB',1),(3563,222,'Lancashire','LANCS',1),(4231,99,'Telangana','TS',1);

/*Table structure for table `zone_to_geo_zone` */

DROP TABLE IF EXISTS `zone_to_geo_zone`;

CREATE TABLE `zone_to_geo_zone` (
  `zone_to_geo_zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL DEFAULT '0',
  `geo_zone_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`zone_to_geo_zone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;

/*Data for the table `zone_to_geo_zone` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
