/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.16-log : Database - db_jzeva
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_jzeva` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_jzeva`;

/*Table structure for table `tbl_attribute_master` */

DROP TABLE IF EXISTS `tbl_attribute_master`;

CREATE TABLE `tbl_attribute_master` (
  `attributeid` bigint(10) NOT NULL AUTO_INCREMENT,
  `attr_name` varchar(45) DEFAULT NULL,
  `attr_type` tinyint(2) DEFAULT NULL COMMENT '0 - Textbox, 1 - Checkbox, 2 - Radio, 3 - Dropdown, 4 - Range, 5 - Autosuggest',
  `attr_unit` varchar(45) DEFAULT NULL,
  `attr_unit_pos` tinyint(2) DEFAULT NULL COMMENT '0 - Prefix, 1 - Postfix',
  `attr_pos` int(2) DEFAULT NULL,
  `map_column` varchar(45) DEFAULT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not active, 1 - Active, 2 - Deleted',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`attributeid`),
  UNIQUE KEY `attributeid_UNIQUE` (`attributeid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_attribute_master` */

insert  into `tbl_attribute_master`(`attributeid`,`attr_name`,`attr_type`,`attr_unit`,`attr_unit_pos`,`attr_pos`,`map_column`,`active_flag`,`createdon`,`updatedon`,`updatedby`) values (1,'price',1,'rupees',0,1,'test4',2,'2016-01-14 12:24:25','2016-01-14 07:29:02','6'),(2,'brand',1,'rupees',0,1,'test2',1,'2016-01-14 12:24:26','2016-01-14 09:56:39','1'),(3,'color',1,'rupees',0,1,'test2',1,'2016-01-14 12:24:31','2016-01-14 09:56:48','1'),(4,'price',1,'rupees',0,1,'test2',1,'2016-01-14 12:24:51','2016-01-14 07:02:17','1');

/*Table structure for table `tbl_category_attribute_mapping` */

DROP TABLE IF EXISTS `tbl_category_attribute_mapping`;

CREATE TABLE `tbl_category_attribute_mapping` (
  `catid` bigint(20) NOT NULL,
  `attributeid` bigint(10) NOT NULL,
  `active_flag` varchar(45) DEFAULT '1' COMMENT '0 - not active, 1 - active, 2 - deleted',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`catid`,`attributeid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_category_attribute_mapping` */

insert  into `tbl_category_attribute_mapping`(`catid`,`attributeid`,`active_flag`,`createdon`,`updatedon`,`updatedby`) values (1,1,'1','2016-01-14 13:39:38','2016-01-14 08:09:38','6'),(1,3,'1','2016-01-14 13:42:50','2016-01-14 09:47:08','6'),(1,4,'1','2016-01-14 13:44:03','2016-01-14 09:47:14','6'),(2,3,'1','2016-01-14 14:06:16','2016-01-14 08:36:16','6'),(2,4,'1','2016-01-14 14:06:44','2016-01-14 08:36:44','6'),(9,1,'2','2016-01-15 13:56:35','2016-01-15 14:45:35','1'),(9,2,'2','2016-01-15 13:56:35','2016-01-15 14:45:35','1'),(9,3,'2','2016-01-15 13:56:35','2016-01-15 14:45:35','1'),(9,4,'2','2016-01-15 13:56:35','2016-01-15 14:45:35','1'),(9,5,'0','2016-01-15 13:50:52','2016-01-15 14:45:54','1'),(10,1,'1','2016-01-15 14:49:25','2016-01-15 14:49:25','8'),(10,2,'1','2016-01-15 14:49:26','2016-01-15 14:49:26','8'),(10,3,'1','2016-01-15 14:49:26','2016-01-15 14:49:26','8'),(10,4,'2','2016-01-15 14:49:26','2016-01-15 14:49:53','8');

/*Table structure for table `tbl_category_master` */

DROP TABLE IF EXISTS `tbl_category_master`;

CREATE TABLE `tbl_category_master` (
  `catid` bigint(20) NOT NULL AUTO_INCREMENT,
  `pcatid` bigint(20) DEFAULT '0' COMMENT 'parent category id',
  `cat_name` varchar(255) DEFAULT NULL COMMENT 'category name specifi',
  `cat_lvl` tinyint(4) DEFAULT '0' COMMENT 'category depth level',
  `lineage` text COMMENT 'lineage hierarchy',
  `active_flag` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 - Not active, 1 - Active, 2 - Deleted',
  `createdon` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time on which it was created.',
  `updatedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'timestamp on which it was last updated',
  `updatedby` varchar(45) NOT NULL,
  KEY `catid` (`catid`),
  KEY `pcatid` (`pcatid`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_category_master` */

insert  into `tbl_category_master`(`catid`,`pcatid`,`cat_name`,`cat_lvl`,`lineage`,`active_flag`,`createdon`,`updatedon`,`updatedby`) values (1,0,'jewellery',0,NULL,1,'2016-01-14 10:34:18','2016-01-14 05:04:18','2'),(2,1,'rings',0,NULL,1,'2016-01-14 10:36:28','2016-01-14 05:06:28','2'),(3,1,'earrings',0,NULL,1,'2016-01-14 10:36:38','2016-01-14 05:06:38','2'),(4,1,'pendants',0,NULL,1,'2016-01-14 10:38:10','2016-01-14 05:08:10','1'),(5,1,'chains',0,NULL,1,'2016-01-14 10:38:15','2016-01-14 05:08:15','1'),(6,1,'bangles',0,NULL,1,'2016-01-14 10:38:20','2016-01-14 05:08:20','1'),(7,1,'bracelets',0,NULL,1,'2016-01-14 10:38:25','2016-01-14 05:42:00','5'),(8,12,'rings',0,NULL,1,'2016-01-15 12:07:28','2016-01-15 12:07:28','1'),(9,12,'earrings',0,NULL,1,'2016-01-15 13:56:35','2016-01-15 13:56:35','1'),(10,12,'men rings',0,NULL,1,'2016-01-15 14:49:53','2016-01-15 14:49:53','8');

/*Table structure for table `tbl_category_product_mapping` */

DROP TABLE IF EXISTS `tbl_category_product_mapping`;

CREATE TABLE `tbl_category_product_mapping` (
  `catid` bigint(20) NOT NULL,
  `productid` bigint(20) NOT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not Active, 1 - Active',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`catid`,`productid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_category_product_mapping` */

insert  into `tbl_category_product_mapping`(`catid`,`productid`,`active_flag`,`createdon`,`updatedon`,`updatedby`) values (1,5320160119184825,1,'2016-01-19 18:48:25','2016-01-19 18:48:25','55'),(1,9220160119184913,1,'2016-01-19 18:49:13','2016-01-19 18:49:13','55'),(1,9820160119184937,1,'2016-01-19 18:49:37','2016-01-19 18:49:37','55'),(1,9920160119183239,1,'2016-01-19 18:32:39','2016-01-19 18:32:39','55'),(2,5320160119184825,1,'2016-01-19 18:48:25','2016-01-19 18:48:25','55'),(2,9220160119184913,1,'2016-01-19 18:49:13','2016-01-19 18:49:13','55'),(2,9820160119184937,1,'2016-01-19 18:49:37','2016-01-19 18:49:37','55'),(2,9920160119183239,1,'2016-01-19 18:32:39','2016-01-19 18:32:39','55'),(3,5320160119184825,1,'2016-01-19 18:48:25','2016-01-19 18:48:25','55'),(3,9220160119184913,1,'2016-01-19 18:49:13','2016-01-19 18:49:13','55'),(3,9820160119184937,1,'2016-01-19 18:49:37','2016-01-19 18:49:37','55'),(3,9920160119183239,1,'2016-01-19 18:32:39','2016-01-19 18:32:39','55'),(4,5320160119184825,1,'2016-01-19 18:48:25','2016-01-19 18:48:25','55'),(4,9220160119184913,1,'2016-01-19 18:49:13','2016-01-19 18:49:13','55'),(4,9820160119184937,1,'2016-01-19 18:49:37','2016-01-19 18:49:37','55'),(4,9920160119183239,1,'2016-01-19 18:32:39','2016-01-19 18:32:39','55'),(5,5320160119184825,1,'2016-01-19 18:48:25','2016-01-19 18:48:25','55'),(5,9220160119184913,1,'2016-01-19 18:49:13','2016-01-19 18:49:13','55'),(5,9820160119184937,1,'2016-01-19 18:49:37','2016-01-19 18:49:37','55'),(5,9920160119183239,1,'2016-01-19 18:32:39','2016-01-19 18:32:39','55');

/*Table structure for table `tbl_city_master` */

DROP TABLE IF EXISTS `tbl_city_master`;

CREATE TABLE `tbl_city_master` (
  `cityid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'city identity',
  `cityname` varchar(250) CHARACTER SET utf8 NOT NULL,
  `state` varchar(250) NOT NULL,
  `country` varchar(250) NOT NULL,
  `lng` decimal(17,15) NOT NULL,
  `lat` decimal(17,15) NOT NULL,
  `active_flag` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1-Active | 0-Inactive',
  `createdon` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time on which it was created.',
  `updatedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'timestamp on which it was last updated.',
  `updatedby` varchar(100) NOT NULL COMMENT 'CMS USER',
  PRIMARY KEY (`cityid`)
) ENGINE=MyISAM AUTO_INCREMENT=1095 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_city_master` */

/*Table structure for table `tbl_coupon_master` */

DROP TABLE IF EXISTS `tbl_coupon_master`;

CREATE TABLE `tbl_coupon_master` (
  `coupon_id` bigint(10) NOT NULL,
  `coupon_code` varchar(45) DEFAULT NULL,
  `discount_type` tinyint(2) DEFAULT NULL COMMENT '1 - Fixed Amount, 2 - Percentage',
  `discount_amount` double DEFAULT NULL,
  `minimum_amount` double DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not Active, 1 - Active, 2 - Deleted',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`coupon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_coupon_master` */

/*Table structure for table `tbl_diamond_quality_mapping` */

DROP TABLE IF EXISTS `tbl_diamond_quality_mapping`;

CREATE TABLE `tbl_diamond_quality_mapping` (
  `diamond_id` bigint(20) NOT NULL,
  `id` int(5) NOT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not Active, 1 - Active',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`diamond_id`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_diamond_quality_mapping` */

insert  into `tbl_diamond_quality_mapping`(`diamond_id`,`id`,`active_flag`,`createdon`,`updatedon`,`updatedby`) values (2820160119131420,1,1,'2016-01-19 13:14:20','2016-01-19 13:14:20','55'),(2820160119131420,2,1,'2016-01-19 13:14:20','2016-01-19 13:14:20','55'),(2820160119131420,3,1,'2016-01-19 13:14:20','2016-01-19 13:14:20','55'),(4820160119130840,1,1,'2016-01-19 13:08:40','2016-01-19 13:08:40','55'),(4820160119130840,2,1,'2016-01-19 13:08:40','2016-01-19 13:08:40','55'),(4820160119130840,3,1,'2016-01-19 13:08:40','2016-01-19 13:08:40','55'),(7820160119131420,3,1,'2016-01-19 13:14:20','2016-01-19 13:14:20','55'),(8020160119130840,3,1,'2016-01-19 13:08:40','2016-01-19 13:08:40','55');

/*Table structure for table `tbl_diamond_quality_master` */

DROP TABLE IF EXISTS `tbl_diamond_quality_master`;

CREATE TABLE `tbl_diamond_quality_master` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `dname` varchar(45) DEFAULT NULL,
  `dvalue` varchar(45) DEFAULT NULL,
  `price_per_carat` double DEFAULT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not Active, 1 - Active',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_diamond_quality_master` */

insert  into `tbl_diamond_quality_master`(`id`,`dname`,`dvalue`,`price_per_carat`,`active_flag`,`createdon`,`updatedon`,`updatedby`) values (1,'VVS - IF','VVS - IF',15000,1,'2016-01-18 17:09:46','2016-01-18 17:09:46','backend'),(2,'VVS - EF','VVS - EF',150000,1,'2016-01-18 17:12:58','2016-01-18 17:12:58','backend'),(3,'VVS - GH','VVS - GH',10000,1,'2016-01-18 17:12:58','2016-01-18 17:12:58','backend'),(4,'VS - EF','VS - EF',10000,1,'2016-01-18 17:12:58','2016-01-18 17:12:58','backend'),(5,'VS - GH','VS - GH',15000,1,'2016-01-18 17:12:59','2016-01-18 17:12:59','backend'),(6,'VS - IJ','VS - IJ',15000,1,'2016-01-18 17:12:59','2016-01-18 17:12:59','backend'),(7,'SI - EF','SI - EF',15000,1,'2016-01-18 17:12:59','2016-01-18 17:12:59','backend'),(8,'SI - GH','SI - GH',15000,1,'2016-01-18 17:12:59','2016-01-18 17:12:59','backend'),(9,'SI - IJ','SI - IJ',15000,1,'2016-01-18 17:12:59','2016-01-18 17:12:59','backend'),(10,'SI - JK','SI - JK',15000,1,'2016-01-18 17:12:59','2016-01-18 17:12:59','backend');

/*Table structure for table `tbl_discount_master` */

DROP TABLE IF EXISTS `tbl_discount_master`;

CREATE TABLE `tbl_discount_master` (
  `productid` bigint(20) NOT NULL,
  `discount_type` tinyint(2) DEFAULT NULL COMMENT '1 - Fixed Amount, 2 - Percentage',
  `discount_amount` double DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `active_flag` tinyint(2) NOT NULL COMMENT '0 - Not Active, 1 - Active, 2 - Deleted',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`productid`,`active_flag`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_discount_master` */

/*Table structure for table `tbl_gemstone_master` */

DROP TABLE IF EXISTS `tbl_gemstone_master`;

CREATE TABLE `tbl_gemstone_master` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `gemstone_name` varchar(45) DEFAULT NULL,
  `description` blob,
  `active_flag` tinyint(2) DEFAULT '1',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_gemstone_master` */

insert  into `tbl_gemstone_master`(`id`,`gemstone_name`,`description`,`active_flag`,`createdon`,`updatedon`,`updatedby`) values (1,'Amber','',1,'2016-01-19 10:11:52','2016-01-19 10:11:52','backend'),(2,'Amethyst','',1,'2016-01-19 10:11:52','2016-01-19 10:11:52','backend'),(3,'Aquamarine','',1,'2016-01-19 10:11:52','2016-01-19 10:11:52','backend'),(4,'Blue Topaz','',1,'2016-01-19 10:11:52','2016-01-19 10:11:52','backend'),(5,'Coral','',1,'2016-01-19 10:11:52','2016-01-19 10:11:52','backend'),(6,'Emerald','',1,'2016-01-19 10:11:53','2016-01-19 10:11:53','backend'),(7,'Garnet','',1,'2016-01-19 10:11:53','2016-01-19 10:11:53','backend'),(8,'Metalen Topaz','',1,'2016-01-19 10:11:53','2016-01-19 10:11:53','backend'),(9,'Hydro','',1,'2016-01-19 10:11:53','2016-01-19 10:11:53','backend'),(10,'Iolite','',1,'2016-01-19 10:11:53','2016-01-19 10:11:53','backend'),(11,'Lemon Topaz','',1,'2016-01-19 10:11:53','2016-01-19 10:11:53','backend'),(12,'Moonstone','',1,'2016-01-19 10:11:53','2016-01-19 10:11:53','backend'),(13,'Onyx','',1,'2016-01-19 10:11:53','2016-01-19 10:11:53','backend'),(14,'Opal','',1,'2016-01-19 10:11:53','2016-01-19 10:11:53','backend'),(15,'Pearl','',1,'2016-01-19 10:11:53','2016-01-19 10:11:53','backend'),(16,'Peridot','',1,'2016-01-19 10:11:53','2016-01-19 10:11:53','backend'),(17,'Rose Quartz','',1,'2016-01-19 10:11:53','2016-01-19 10:11:53','backend'),(18,'Rubilite','',1,'2016-01-19 10:11:53','2016-01-19 10:11:53','backend'),(19,'Ruby','',1,'2016-01-19 10:11:53','2016-01-19 10:11:53','backend'),(20,'Sapphire','',1,'2016-01-19 10:11:53','2016-01-19 10:11:53','backend'),(21,'Smoky topaz','',1,'2016-01-19 10:11:53','2016-01-19 10:11:53','backend'),(22,'Tanzanite','',1,'2016-01-19 10:11:53','2016-01-19 10:11:53','backend'),(23,'Turquoise','',1,'2016-01-19 10:11:53','2016-01-19 10:11:53','backend');

/*Table structure for table `tbl_metal_color_master` */

DROP TABLE IF EXISTS `tbl_metal_color_master`;

CREATE TABLE `tbl_metal_color_master` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `dname` varchar(45) DEFAULT NULL,
  `dvalue` varchar(45) DEFAULT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not Active, 1 - Active',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_metal_color_master` */

insert  into `tbl_metal_color_master`(`id`,`dname`,`dvalue`,`active_flag`,`createdon`,`updatedon`,`updatedby`) values (1,'yellow','Yellow',1,'2016-01-16 17:34:26','2016-01-16 17:34:26','backend'),(2,'rose','Rose',1,'2016-01-16 17:34:26','2016-01-16 17:34:26','backend'),(3,'white','White',1,'2016-01-16 17:34:26','2016-01-16 17:34:26','backend');

/*Table structure for table `tbl_metal_purity_master` */

DROP TABLE IF EXISTS `tbl_metal_purity_master`;

CREATE TABLE `tbl_metal_purity_master` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `dname` varchar(45) DEFAULT NULL,
  `dvalue` varchar(45) DEFAULT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not Active, 1 - Active',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  `price` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_metal_purity_master` */

insert  into `tbl_metal_purity_master`(`id`,`dname`,`dvalue`,`active_flag`,`createdon`,`updatedon`,`updatedby`,`price`) values (1,'9 carat','9 Carat',1,'2016-01-16 17:29:15','2016-01-16 17:29:15','backend',9375),(2,'14 carat','14 Carat',1,'2016-01-16 17:31:06','2016-01-16 17:31:06','backend',14575),(3,'18 carat','18 Carat',1,'2016-01-16 17:31:16','2016-01-16 17:31:16','backend',18774.9999),(4,'22 carat','22 Carat',1,'2016-01-16 17:31:20','2016-01-16 17:31:20','backend',22900),(5,'24 carat','24 Carat',1,'2016-01-16 17:31:22','2016-01-16 17:31:22','backend',25000);

/*Table structure for table `tbl_product_color_purity_mapping` */

DROP TABLE IF EXISTS `tbl_product_color_purity_mapping`;

CREATE TABLE `tbl_product_color_purity_mapping` (
  `productid` bigint(20) NOT NULL,
  `id` int(5) NOT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`productid`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product_color_purity_mapping` */

/*Table structure for table `tbl_product_diamond_mapping` */

DROP TABLE IF EXISTS `tbl_product_diamond_mapping`;

CREATE TABLE `tbl_product_diamond_mapping` (
  `productid` bigint(20) NOT NULL,
  `diamond_id` bigint(20) NOT NULL,
  `shape` varchar(45) DEFAULT NULL,
  `carat` double DEFAULT NULL,
  `total_no` int(5) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`productid`,`diamond_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product_diamond_mapping` */

insert  into `tbl_product_diamond_mapping`(`productid`,`diamond_id`,`shape`,`carat`,`total_no`,`createdon`,`updatedon`,`updatedby`) values (2120160119131419,2820160119131420,'oval',2.5,5,'2016-01-19 13:14:20','2016-01-19 13:14:20','55'),(2120160119131419,7820160119131420,'Pear',5.5,5,'2016-01-19 13:14:20','2016-01-19 13:14:20','55'),(9820160119130839,4820160119130840,'oval',2.5,5,'2016-01-19 13:08:40','2016-01-19 13:08:40','55'),(9820160119130839,8020160119130840,'Pear',5.5,5,'2016-01-19 13:08:40','2016-01-19 13:08:40','55');

/*Table structure for table `tbl_product_gemstone_mapping` */

DROP TABLE IF EXISTS `tbl_product_gemstone_mapping`;

CREATE TABLE `tbl_product_gemstone_mapping` (
  `productid` bigint(20) NOT NULL,
  `gemstone_id` bigint(20) NOT NULL,
  `gemstone_name` varchar(45) DEFAULT NULL,
  `total_no` int(5) DEFAULT NULL,
  `carat` double DEFAULT NULL,
  `price_per_carat` double DEFAULT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not Active, 1 - Active',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`productid`,`gemstone_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product_gemstone_mapping` */

insert  into `tbl_product_gemstone_mapping`(`productid`,`gemstone_id`,`gemstone_name`,`total_no`,`carat`,`price_per_carat`,`active_flag`,`createdon`,`updatedon`,`updatedby`) values (2120160119131419,2520160119131420,'Amber',1,1.2,1000,1,'2016-01-19 13:14:20','2016-01-19 13:14:20','55'),(2120160119131419,5820160119131420,'Blue Topaz',4,4.2,1300,1,'2016-01-19 13:14:20','2016-01-19 13:14:20','55'),(2120160119131419,8820160119131420,'Amethyst',2,2.2,1100,1,'2016-01-19 13:14:20','2016-01-19 13:14:20','55'),(2120160119131419,9320160119131420,'Aquamarine',3,3.2,1200,1,'2016-01-19 13:14:20','2016-01-19 13:14:20','55'),(9820160119130839,4120160119130840,'Amber',1,1.2,1000,1,'2016-01-19 13:08:40','2016-01-19 13:08:40','55'),(9820160119130839,5120160119130840,'Blue Topaz',4,4.2,1300,1,'2016-01-19 13:08:40','2016-01-19 13:08:40','55'),(9820160119130839,5420160119130840,'Aquamarine',3,3.2,1200,1,'2016-01-19 13:08:40','2016-01-19 13:08:40','55'),(9820160119130839,6420160119130840,'Amethyst',2,2.2,1100,1,'2016-01-19 13:08:40','2016-01-19 13:08:40','55');

/*Table structure for table `tbl_product_master` */

DROP TABLE IF EXISTS `tbl_product_master`;

CREATE TABLE `tbl_product_master` (
  `productid` bigint(20) NOT NULL,
  `product_code` varchar(45) DEFAULT NULL,
  `vendorid` int(10) DEFAULT NULL,
  `product_name` varchar(60) DEFAULT NULL,
  `product_seo_name` varchar(150) DEFAULT NULL,
  `gender` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 - Female 1 - Male 2 - Unisex',
  `product_weight` double DEFAULT NULL,
  `diamond_setting` varchar(255) DEFAULT NULL,
  `metal_weight` double DEFAULT NULL,
  `making_charges` double DEFAULT NULL,
  `procurement_cost` double DEFAULT NULL,
  `margin` double DEFAULT NULL,
  `measurement` varchar(45) DEFAULT NULL,
  `customise_purity` tinyint(2) DEFAULT '0' COMMENT '0 - Customisable,1 - Not customisable',
  `customise_color` tinyint(2) DEFAULT '0' COMMENT '0 - Customisable,1 - Not customisable',
  `certificate` varchar(45) DEFAULT NULL,
  `has_diamond` tinyint(2) DEFAULT NULL COMMENT '0 - No diamond, 1 - has diamond',
  `has_solitaire` tinyint(2) DEFAULT NULL COMMENT '0 - No solitaire, 1 - has solitaire',
  `has_uncut` tinyint(2) DEFAULT NULL COMMENT '0 - No uncut diamonds, 1 - has uncut diamonds',
  `has_gemstone` tinyint(2) DEFAULT NULL COMMENT '0 - No gemstone, 1 - has gemstone',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`productid`),
  UNIQUE KEY `productid_UNIQUE` (`productid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product_master` */

/*Table structure for table `tbl_product_metal_color_mapping` */

DROP TABLE IF EXISTS `tbl_product_metal_color_mapping`;

CREATE TABLE `tbl_product_metal_color_mapping` (
  `productid` bigint(20) NOT NULL,
  `id` int(5) NOT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not Active, 1 - Active',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`productid`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product_metal_color_mapping` */

insert  into `tbl_product_metal_color_mapping`(`productid`,`id`,`active_flag`,`createdon`,`updatedon`,`updatedby`) values (1120160120114824,2,1,'2016-01-20 11:48:24','2016-01-20 11:48:24','55'),(1120160120114824,3,1,'2016-01-20 11:48:24','2016-01-20 11:48:24','55'),(1320160120112431,2,1,'2016-01-20 11:24:31','2016-01-20 11:24:31','55'),(1320160120112431,3,1,'2016-01-20 11:24:31','2016-01-20 11:24:31','55'),(2020160120114115,2,1,'2016-01-20 11:41:15','2016-01-20 11:41:15','55'),(2020160120114115,3,1,'2016-01-20 11:41:15','2016-01-20 11:41:15','55'),(2120160120113730,2,1,'2016-01-20 11:37:30','2016-01-20 11:37:30','55'),(2120160120113730,3,1,'2016-01-20 11:37:30','2016-01-20 11:37:30','55'),(2620160120113710,2,1,'2016-01-20 11:37:10','2016-01-20 11:37:10','55'),(2620160120113710,3,1,'2016-01-20 11:37:10','2016-01-20 11:37:10','55'),(2920160120111852,2,1,'2016-01-20 11:18:52','2016-01-20 11:18:52','55'),(2920160120111852,3,1,'2016-01-20 11:18:52','2016-01-20 11:18:52','55'),(3120160120113222,2,1,'2016-01-20 11:32:22','2016-01-20 11:32:22','55'),(3120160120113222,3,1,'2016-01-20 11:32:22','2016-01-20 11:32:22','55'),(3620160120113129,2,1,'2016-01-20 11:31:29','2016-01-20 11:31:29','55'),(3620160120113129,3,1,'2016-01-20 11:31:29','2016-01-20 11:31:29','55'),(3620160120113701,2,1,'2016-01-20 11:37:01','2016-01-20 11:37:01','55'),(3620160120113701,3,1,'2016-01-20 11:37:01','2016-01-20 11:37:01','55'),(3720160120113950,2,1,'2016-01-20 11:39:50','2016-01-20 11:39:50','55'),(3720160120113950,3,1,'2016-01-20 11:39:50','2016-01-20 11:39:50','55'),(4020160120112410,2,1,'2016-01-20 11:24:10','2016-01-20 11:24:10','55'),(4020160120112410,3,1,'2016-01-20 11:24:10','2016-01-20 11:24:10','55'),(4020160120113755,2,1,'2016-01-20 11:37:55','2016-01-20 11:37:55','55'),(4020160120113755,3,1,'2016-01-20 11:37:55','2016-01-20 11:37:55','55'),(4120160120112214,2,1,'2016-01-20 11:22:14','2016-01-20 11:22:14','55'),(4120160120112214,3,1,'2016-01-20 11:22:14','2016-01-20 11:22:14','55'),(4120160120113017,2,1,'2016-01-20 11:30:17','2016-01-20 11:30:17','55'),(4120160120113017,3,1,'2016-01-20 11:30:17','2016-01-20 11:30:17','55'),(4320160120113452,2,1,'2016-01-20 11:34:52','2016-01-20 11:34:52','55'),(4320160120113452,3,1,'2016-01-20 11:34:52','2016-01-20 11:34:52','55'),(4720160120111316,2,1,'2016-01-20 11:13:16','2016-01-20 11:13:16','55'),(4720160120111316,3,1,'2016-01-20 11:13:16','2016-01-20 11:13:16','55'),(4920160120113151,2,1,'2016-01-20 11:31:51','2016-01-20 11:31:51','55'),(4920160120113151,3,1,'2016-01-20 11:31:51','2016-01-20 11:31:51','55'),(5020160120113117,2,1,'2016-01-20 11:31:17','2016-01-20 11:31:17','55'),(5020160120113117,3,1,'2016-01-20 11:31:17','2016-01-20 11:31:17','55'),(5120160120112316,2,1,'2016-01-20 11:23:16','2016-01-20 11:23:16','55'),(5120160120112316,3,1,'2016-01-20 11:23:16','2016-01-20 11:23:16','55'),(5120160120113602,2,1,'2016-01-20 11:36:02','2016-01-20 11:36:02','55'),(5120160120113602,3,1,'2016-01-20 11:36:02','2016-01-20 11:36:02','55'),(5620160120112411,2,1,'2016-01-20 11:24:11','2016-01-20 11:24:11','55'),(5620160120112411,3,1,'2016-01-20 11:24:11','2016-01-20 11:24:11','55'),(5920160120113258,2,1,'2016-01-20 11:32:58','2016-01-20 11:32:58','55'),(5920160120113258,3,1,'2016-01-20 11:32:58','2016-01-20 11:32:58','55'),(6220160120112226,2,1,'2016-01-20 11:22:26','2016-01-20 11:22:26','55'),(6220160120112226,3,1,'2016-01-20 11:22:26','2016-01-20 11:22:26','55'),(6920160120113059,2,1,'2016-01-20 11:30:59','2016-01-20 11:30:59','55'),(6920160120113059,3,1,'2016-01-20 11:30:59','2016-01-20 11:30:59','55'),(7120160120113825,2,1,'2016-01-20 11:38:25','2016-01-20 11:38:25','55'),(7120160120113825,3,1,'2016-01-20 11:38:25','2016-01-20 11:38:25','55'),(7320160120113041,2,1,'2016-01-20 11:30:41','2016-01-20 11:30:41','55'),(7320160120113041,3,1,'2016-01-20 11:30:41','2016-01-20 11:30:41','55'),(7420160120113627,2,1,'2016-01-20 11:36:27','2016-01-20 11:36:27','55'),(7420160120113627,3,1,'2016-01-20 11:36:27','2016-01-20 11:36:27','55'),(7620160120111804,2,1,'2016-01-20 11:18:04','2016-01-20 11:18:04','55'),(7620160120111804,3,1,'2016-01-20 11:18:04','2016-01-20 11:18:04','55'),(7620160120114145,2,1,'2016-01-20 11:41:45','2016-01-20 11:41:45','55'),(7620160120114145,3,1,'2016-01-20 11:41:45','2016-01-20 11:41:45','55'),(7720160120114039,2,1,'2016-01-20 11:40:39','2016-01-20 11:40:39','55'),(7720160120114039,3,1,'2016-01-20 11:40:39','2016-01-20 11:40:39','55'),(7820160120112126,2,1,'2016-01-20 11:21:26','2016-01-20 11:21:26','55'),(7820160120112126,3,1,'2016-01-20 11:21:26','2016-01-20 11:21:26','55'),(8220160120113720,2,1,'2016-01-20 11:37:20','2016-01-20 11:37:20','55'),(8220160120113720,3,1,'2016-01-20 11:37:20','2016-01-20 11:37:20','55'),(8720160120113621,2,1,'2016-01-20 11:36:21','2016-01-20 11:36:21','55'),(8720160120113621,3,1,'2016-01-20 11:36:21','2016-01-20 11:36:21','55'),(9020160120104544,2,1,'2016-01-20 10:45:44','2016-01-20 10:45:44','55'),(9020160120104544,3,1,'2016-01-20 10:45:44','2016-01-20 10:45:44','55'),(9020160120104551,2,1,'2016-01-20 10:45:51','2016-01-20 10:45:51','55'),(9020160120104551,3,1,'2016-01-20 10:45:51','2016-01-20 10:45:51','55'),(9120160120111950,2,1,'2016-01-20 11:19:50','2016-01-20 11:19:50','55'),(9120160120111950,3,1,'2016-01-20 11:19:50','2016-01-20 11:19:50','55'),(9220160120104251,2,1,'2016-01-20 10:42:51','2016-01-20 10:42:51','55'),(9220160120104251,3,1,'2016-01-20 10:42:51','2016-01-20 10:42:51','55'),(9320160120113306,2,1,'2016-01-20 11:33:06','2016-01-20 11:33:06','55'),(9320160120113306,3,1,'2016-01-20 11:33:06','2016-01-20 11:33:06','55'),(9420160120111744,2,1,'2016-01-20 11:17:44','2016-01-20 11:17:44','55'),(9420160120111744,3,1,'2016-01-20 11:17:44','2016-01-20 11:17:44','55'),(9820160120113738,2,1,'2016-01-20 11:37:38','2016-01-20 11:37:38','55'),(9820160120113738,3,1,'2016-01-20 11:37:38','2016-01-20 11:37:38','55'),(9920160120111302,2,1,'2016-01-20 11:13:02','2016-01-20 11:13:02','55'),(9920160120111302,3,1,'2016-01-20 11:13:02','2016-01-20 11:13:02','55');

/*Table structure for table `tbl_product_metal_purity_mapping` */

DROP TABLE IF EXISTS `tbl_product_metal_purity_mapping`;

CREATE TABLE `tbl_product_metal_purity_mapping` (
  `productid` bigint(20) NOT NULL,
  `id` int(5) NOT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`productid`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product_metal_purity_mapping` */

insert  into `tbl_product_metal_purity_mapping`(`productid`,`id`,`createdon`,`updatedon`,`updatedby`) values (7020160119195600,2,'2016-01-19 19:56:54','2016-01-19 19:56:54','55'),(7020160119195600,3,'2016-01-19 19:56:54','2016-01-19 19:56:54','55'),(7020160119195600,4,'2016-01-19 19:56:54','2016-01-19 19:56:54','55'),(7020160119195600,5,'2016-01-19 19:56:54','2016-01-19 19:56:54','55'),(7020160119195620,2,'2016-01-19 19:56:20','2016-01-19 19:56:20','55'),(7020160119195620,3,'2016-01-19 19:56:20','2016-01-19 19:56:20','55'),(7020160119195620,4,'2016-01-19 19:56:20','2016-01-19 19:56:20','55'),(7020160119195620,5,'2016-01-19 19:56:20','2016-01-19 19:56:20','55');

/*Table structure for table `tbl_product_size_mapping` */

DROP TABLE IF EXISTS `tbl_product_size_mapping`;

CREATE TABLE `tbl_product_size_mapping` (
  `productid` bigint(20) NOT NULL,
  `size_id` int(5) NOT NULL,
  `quantity` int(5) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`productid`,`size_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product_size_mapping` */

/*Table structure for table `tbl_product_solitaire_mapping` */

DROP TABLE IF EXISTS `tbl_product_solitaire_mapping`;

CREATE TABLE `tbl_product_solitaire_mapping` (
  `productid` bigint(20) NOT NULL,
  `solitaire_id` bigint(20) NOT NULL,
  `shape` varchar(45) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `clarity` varchar(10) DEFAULT NULL,
  `cut` varchar(15) DEFAULT NULL,
  `symmetry` varchar(15) DEFAULT NULL,
  `polish` varchar(15) DEFAULT NULL,
  `fluorescence` varchar(15) DEFAULT NULL,
  `carat` double DEFAULT NULL,
  `price_per_carat` double DEFAULT NULL,
  `table_no` varchar(45) DEFAULT NULL,
  `crown_angle` varchar(45) DEFAULT NULL,
  `girdle` varchar(45) DEFAULT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not Active, 1 - Active',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`productid`,`solitaire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product_solitaire_mapping` */

insert  into `tbl_product_solitaire_mapping`(`productid`,`solitaire_id`,`shape`,`color`,`clarity`,`cut`,`symmetry`,`polish`,`fluorescence`,`carat`,`price_per_carat`,`table_no`,`crown_angle`,`girdle`,`active_flag`,`createdon`,`updatedon`,`updatedby`) values (1120160120114824,4220160120114825,'Pear','E','VVS1','very good','good','good','none',0.6,5005.25,'56','25','25',1,'2016-01-20 11:49:29','2016-01-20 11:49:29','55'),(1120160120114824,4920160120114825,'Cushion','H','VS2','very good','very good','good','none',0.9,5005.25,'56','25','25',1,'2016-01-20 11:49:29','2016-01-20 11:49:29','55'),(1120160120114824,5420160120114825,'Round','D','IF','very good','very good','good','none',0.5,5005.25,'56','25','25',1,'2016-01-20 11:49:29','2016-01-20 11:49:29','55'),(1120160120114824,5620160120114825,'Oval','G','VVS2','very good','fair','good','none',0.8,5005.25,'56','25','25',1,'2016-01-20 11:49:29','2016-01-20 11:49:29','55'),(1120160120114824,6820160120114825,'Heart','F','IF','very good','good','good','none',0.7,5005.25,'56','25','25',1,'2016-01-20 11:49:29','2016-01-20 11:49:29','55'),(2120160119131419,1120160119131420,'Round','F','IF','very good','good','good','none',0.7,5005.25,'56','25','25',1,'2016-01-19 13:14:20','2016-01-19 13:14:20','55'),(2120160119131419,4020160119131420,'Round','E','VVS1','very good','good','good','none',0.6,5005.25,'56','25','25',1,'2016-01-19 13:14:20','2016-01-19 13:14:20','55'),(2120160119131419,5520160119131420,'Round','G','VVS2','very good','fair','good','none',0.8,5005.25,'56','25','25',1,'2016-01-19 13:14:20','2016-01-19 13:14:20','55'),(2120160119131419,6420160119131420,'Round','D','IF','very good','very good','good','none',0.5,5005.25,'56','25','25',1,'2016-01-19 13:14:20','2016-01-19 13:14:20','55'),(2120160119131419,9720160119131420,'Round','H','VS2','very good','very good','good','none',0.9,5005.25,'56','25','25',1,'2016-01-19 13:14:20','2016-01-19 13:14:20','55');

/*Table structure for table `tbl_product_uncut_mapping` */

DROP TABLE IF EXISTS `tbl_product_uncut_mapping`;

CREATE TABLE `tbl_product_uncut_mapping` (
  `productid` bigint(20) NOT NULL,
  `uncut_id` bigint(20) NOT NULL,
  `color` varchar(10) DEFAULT NULL,
  `quality` varchar(10) DEFAULT NULL,
  `total_no` int(5) DEFAULT NULL,
  `carat` double DEFAULT NULL,
  `price_per_carat` double DEFAULT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not Active, 1 - Active',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`productid`,`uncut_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product_uncut_mapping` */

insert  into `tbl_product_uncut_mapping`(`productid`,`uncut_id`,`color`,`quality`,`total_no`,`carat`,`price_per_carat`,`active_flag`,`createdon`,`updatedon`,`updatedby`) values (2120160119131419,1720160119131420,'F','JK',3,0.3,1025.25,1,'2016-01-19 13:14:20','2016-01-19 13:14:20','55'),(2120160119131419,6120160119131420,'D','IF',1,0.1,1000.25,1,'2016-01-19 13:14:20','2016-01-19 13:14:20','55'),(2120160119131419,8420160119131420,'E','GH',2,0.2,1015.25,1,'2016-01-19 13:14:20','2016-01-19 13:14:20','55'),(9820160119130839,5120160119130840,'D','IF',1,0.1,1000.25,1,'2016-01-19 13:08:40','2016-01-19 13:08:40','55'),(9820160119130839,6920160119130840,'F','JK',3,0.3,1025.25,1,'2016-01-19 13:08:40','2016-01-19 13:08:40','55'),(9820160119130839,7020160119130840,'E','GH',2,0.2,1015.25,1,'2016-01-19 13:08:40','2016-01-19 13:08:40','55');

/*Table structure for table `tbl_size_master` */

DROP TABLE IF EXISTS `tbl_size_master`;

CREATE TABLE `tbl_size_master` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `size_value` decimal(3,1) DEFAULT NULL,
  `catid` bigint(20) DEFAULT NULL,
  `active_flag` tinyint(2) DEFAULT NULL COMMENT '0 - not active, 1 - active, 2 - deleted',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_size_master` */

insert  into `tbl_size_master`(`id`,`name`,`size_value`,`catid`,`active_flag`,`createdon`,`updatedon`,`updatedby`) values (1,NULL,4.0,2,NULL,'2016-01-16 17:45:59','2016-01-16 17:45:59','backend'),(2,NULL,4.5,2,NULL,'2016-01-16 17:45:59','2016-01-16 17:45:59','backend'),(3,NULL,5.0,2,NULL,'2016-01-16 17:45:59','2016-01-16 17:45:59','backend'),(4,NULL,5.5,2,NULL,'2016-01-16 17:45:59','2016-01-16 17:45:59','backend'),(5,NULL,6.0,2,NULL,'2016-01-16 17:45:59','2016-01-16 17:45:59','backend'),(6,NULL,6.5,2,NULL,'2016-01-16 17:45:59','2016-01-16 17:45:59','backend'),(7,NULL,7.0,2,NULL,'2016-01-16 17:45:59','2016-01-16 17:45:59','backend'),(8,NULL,7.5,2,NULL,'2016-01-16 17:45:59','2016-01-16 17:45:59','backend'),(9,NULL,8.0,2,NULL,'2016-01-16 17:45:59','2016-01-16 17:45:59','backend'),(10,NULL,8.5,2,NULL,'2016-01-16 17:45:59','2016-01-16 17:45:59','backend'),(11,NULL,9.0,2,NULL,'2016-01-16 17:46:00','2016-01-16 17:46:00','backend'),(12,NULL,9.5,2,NULL,'2016-01-16 17:46:00','2016-01-16 17:46:00','backend'),(13,NULL,10.0,2,NULL,'2016-01-16 17:46:00','2016-01-16 17:46:00','backend'),(14,NULL,10.5,2,NULL,'2016-01-16 17:46:00','2016-01-16 17:46:00','backend'),(15,NULL,11.0,2,NULL,'2016-01-16 17:46:00','2016-01-16 17:46:00','backend'),(16,NULL,11.5,2,NULL,'2016-01-16 17:46:00','2016-01-16 17:46:00','backend'),(17,NULL,12.0,2,NULL,'2016-01-16 17:46:00','2016-01-16 17:46:00','backend'),(18,NULL,12.5,2,NULL,'2016-01-16 17:46:00','2016-01-16 17:46:00','backend'),(19,NULL,13.0,2,NULL,'2016-01-16 17:46:00','2016-01-16 17:46:00','backend'),(20,NULL,13.5,2,NULL,'2016-01-16 17:46:00','2016-01-16 17:46:00','backend'),(21,NULL,14.0,2,NULL,'2016-01-16 17:46:00','2016-01-16 17:46:00','backend'),(22,NULL,14.5,2,NULL,'2016-01-16 17:46:00','2016-01-16 17:46:00','backend'),(23,NULL,15.0,2,NULL,'2016-01-16 17:46:00','2016-01-16 17:46:00','backend'),(24,NULL,15.5,2,NULL,'2016-01-16 17:46:00','2016-01-16 17:46:00','backend'),(25,NULL,16.0,2,NULL,'2016-01-16 17:46:00','2016-01-16 17:46:00','backend');

/*Table structure for table `tbl_vendor_master` */

DROP TABLE IF EXISTS `tbl_vendor_master`;

CREATE TABLE `tbl_vendor_master` (
  `vendorid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'vendor name',
  `city` varchar(255) DEFAULT NULL,
  `mobile` bigint(15) DEFAULT NULL COMMENT 'person''s mobile number',
  `email` varchar(45) DEFAULT NULL COMMENT 'email address of contact person',
  `landline` varchar(45) DEFAULT NULL COMMENT 'fields separated by |~|',
  `lng` decimal(17,15) NOT NULL DEFAULT '0.000000000000000' COMMENT 'longitutde',
  `lat` decimal(17,15) NOT NULL DEFAULT '0.000000000000000' COMMENT 'latitude',
  `active_flag` tinyint(2) NOT NULL DEFAULT '1' COMMENT 'vendor profile activation status- {0-Inactive | 1- Active}',
  `createdon` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time on which it was created',
  `updatedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'timestamp on which it was last updated',
  `updatedby` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`vendorid`),
  UNIQUE KEY `vendorid_UNIQUE` (`vendorid`),
  KEY `vendor_id` (`vendorid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_vendor_master` */

insert  into `tbl_vendor_master`(`vendorid`,`name`,`city`,`mobile`,`email`,`landline`,`lng`,`lat`,`active_flag`,`createdon`,`updatedon`,`updatedby`) values (1,'Patdiam','Mumbai',NULL,'8767194608',NULL,0.000000000000000,0.000000000000000,1,'2016-01-18 13:09:40','2016-01-18 13:09:40','55'),(2,'Maharani','Mumbai',NULL,'8767194608',NULL,0.000000000000000,0.000000000000000,1,'2016-01-18 13:09:40','2016-01-18 13:09:40','55'),(3,'SP Kulthiya','Mumbai',NULL,'8767194608',NULL,0.000000000000000,0.000000000000000,1,'2016-01-18 13:09:40','2016-01-18 13:09:40','55'),(4,'DN Jewels','Mumbai',NULL,'8767194608',NULL,0.000000000000000,0.000000000000000,1,'2016-01-18 13:09:40','2016-01-18 13:09:40','55');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
