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
  `attributeid` bigint(10) NOT NULL,
  `attr_name` varchar(45) DEFAULT NULL,
  `attr_values` text,
  `attr_type` tinyint(2) DEFAULT NULL COMMENT '0 - Textbox, 1 - Checkbox, 2 - Radio, 3 - Dropdown, 4 - Range, 5 - Autosuggest',
  `attr_unit` varchar(45) DEFAULT NULL,
  `attr_unit_pos` tinyint(2) DEFAULT NULL COMMENT '0 - Prefix, 1 - Postfix',
  `attr_pos` int(2) DEFAULT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not active, 1 - Active, 2 - Deleted',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`attributeid`),
  UNIQUE KEY `attributeid_UNIQUE` (`attributeid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_attribute_master` */

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

/*Table structure for table `tbl_category_master` */

DROP TABLE IF EXISTS `tbl_category_master`;

CREATE TABLE `tbl_category_master` (
  `catid` bigint(20) NOT NULL,
  `pcatid` bigint(20) DEFAULT '0' COMMENT 'parent category id',
  `cat_name` varchar(255) DEFAULT NULL COMMENT 'category name specifi',
  `description` varchar(250) NOT NULL COMMENT 'category description',
  `cat_lvl` tinyint(4) DEFAULT '0' COMMENT 'category depth level',
  `lineage` text COMMENT 'lineage hierarchy',
  `active_flag` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 - Not active, 1 - Active, 2 - Deleted',
  `createdon` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time on which it was created.',
  `updatedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'timestamp on which it was last updated',
  `updatedby` varchar(45) NOT NULL,
  PRIMARY KEY (`catid`),
  KEY `catid` (`catid`),
  KEY `pcatid` (`pcatid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_category_master` */

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
  `coupon_name` varchar(45) DEFAULT NULL,
  `discount_type` tinyint(2) DEFAULT NULL COMMENT '1 - Fixed Amount, 2 - Percentage',
  `discount_amount` double DEFAULT NULL,
  `minimum_amount` double DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
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

insert  into `tbl_diamond_quality_master`(`id`,`dname`,`dvalue`,`price_per_carat`,`active_flag`,`createdon`,`updatedon`,`updatedby`) values (1,'VVS - IF','VVS - IF',1000,1,'2016-01-18 17:09:46','2016-01-29 10:47:00','1'),(2,'VVS - EF','VVS - EF',2500,1,'2016-01-18 17:12:58','2016-01-28 11:59:38','1'),(3,'VVS - GH','VVS - GH',3500,1,'2016-01-18 17:12:58','2016-01-28 11:59:38','1'),(4,'VS - EF','VS - EF',4500,1,'2016-01-18 17:12:58','2016-01-28 11:59:38','1'),(5,'VS - GH','VS - GH',5500,1,'2016-01-18 17:12:59','2016-01-28 11:59:38','1'),(6,'VS - IJ','VS - IJ',6500,1,'2016-01-18 17:12:59','2016-01-28 11:59:38','1'),(7,'SI - EF','SI - EF',7500,1,'2016-01-18 17:12:59','2016-01-28 11:59:38','1'),(8,'SI - GH','SI - GH',8500,1,'2016-01-18 17:12:59','2016-01-28 11:59:38','1'),(9,'SI - IJ','SI - IJ',9500,1,'2016-01-18 17:12:59','2016-01-28 11:59:38','1'),(10,'SI - JK','SI - JK',10500,1,'2016-01-18 17:12:59','2016-01-28 11:59:38','1');

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

insert  into `tbl_metal_purity_master`(`id`,`dname`,`dvalue`,`active_flag`,`createdon`,`updatedon`,`updatedby`,`price`) values (1,'9 carat','9 Carat',1,'2016-01-16 17:29:15','2016-02-01 17:25:24','1',18750),(2,'14 carat','14 Carat',1,'2016-01-16 17:31:06','2016-02-01 17:25:24','1',29150),(3,'18 carat','18 Carat',1,'2016-01-16 17:31:16','2016-02-01 17:25:24','1',37550),(4,'22 carat','22 Carat',1,'2016-01-16 17:31:20','2016-02-01 17:25:24','1',45800),(5,'24 carat','24 Carat',1,'2016-01-16 17:31:22','2016-02-01 17:25:24','1',50000);

/*Table structure for table `tbl_product_diamond_mapping` */

DROP TABLE IF EXISTS `tbl_product_diamond_mapping`;

CREATE TABLE `tbl_product_diamond_mapping` (
  `productid` bigint(20) NOT NULL,
  `diamond_id` bigint(20) NOT NULL,
  `shape` varchar(45) DEFAULT NULL,
  `carat` double DEFAULT NULL,
  `total_no` int(5) DEFAULT NULL,
  `active_flag` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0 - Not active, 1 - Active, 2 - Deleted',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`productid`,`diamond_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product_diamond_mapping` */

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

/*Table structure for table `tbl_product_image_mapping` */

DROP TABLE IF EXISTS `tbl_product_image_mapping`;

CREATE TABLE `tbl_product_image_mapping` (
  `product_id` bigint(20) NOT NULL COMMENT 'product_id filled by vendor',
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Auto Incremented ID to differenciate images of same product',
  `product_image` text COMMENT 'product_images',
  `active_flag` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0-Inactive,1-Active,2-Deleted,3-Rejected,4-Approve',
  `image_sequence` int(4) DEFAULT NULL COMMENT 'sequence of images',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `upload_date` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'image uploaded date',
  KEY `idx_id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product_image_mapping` */

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
  `active_flag` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 - Not active, 1 - Active, 2 - Deleted',
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
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not active, 1 - Active, 2 - Deleted',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`productid`,`solitaire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_product_solitaire_mapping` */

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

/*Table structure for table `tbl_size_master` */

DROP TABLE IF EXISTS `tbl_size_master`;

CREATE TABLE `tbl_size_master` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `size_value` decimal(3,1) DEFAULT NULL,
  `catid` bigint(20) DEFAULT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - not active, 1 - active, 2 - deleted',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_size_master` */

insert  into `tbl_size_master`(`id`,`name`,`size_value`,`catid`,`active_flag`,`createdon`,`updatedon`,`updatedby`) values (1,NULL,4.0,2,1,'2016-01-16 17:45:59','2016-01-20 20:35:21','backend'),(2,NULL,4.5,2,1,'2016-01-16 17:45:59','2016-01-20 20:35:21','backend'),(3,NULL,5.0,2,1,'2016-01-16 17:45:59','2016-01-20 20:35:21','backend'),(4,NULL,5.5,2,1,'2016-01-16 17:45:59','2016-01-20 20:35:21','backend'),(5,NULL,6.0,2,1,'2016-01-16 17:45:59','2016-01-20 20:35:21','backend'),(6,NULL,6.5,2,1,'2016-01-16 17:45:59','2016-01-20 20:35:21','backend'),(7,NULL,7.0,2,1,'2016-01-16 17:45:59','2016-01-20 20:35:21','backend'),(8,NULL,7.5,2,1,'2016-01-16 17:45:59','2016-01-20 20:35:21','backend'),(9,NULL,8.0,2,1,'2016-01-16 17:45:59','2016-01-20 20:35:21','backend'),(10,NULL,8.5,2,1,'2016-01-16 17:45:59','2016-01-20 20:35:21','backend'),(11,NULL,9.0,2,1,'2016-01-16 17:46:00','2016-01-20 20:35:21','backend'),(12,NULL,9.5,2,1,'2016-01-16 17:46:00','2016-01-20 20:35:21','backend'),(13,NULL,10.0,2,1,'2016-01-16 17:46:00','2016-01-20 20:35:21','backend'),(14,NULL,10.5,2,1,'2016-01-16 17:46:00','2016-01-20 20:35:21','backend'),(15,NULL,11.0,2,1,'2016-01-16 17:46:00','2016-01-20 20:35:21','backend'),(16,NULL,11.5,2,1,'2016-01-16 17:46:00','2016-01-20 20:35:21','backend'),(17,NULL,12.0,2,1,'2016-01-16 17:46:00','2016-01-20 20:35:21','backend'),(18,NULL,12.5,2,1,'2016-01-16 17:46:00','2016-01-20 20:35:21','backend'),(19,NULL,13.0,2,1,'2016-01-16 17:46:00','2016-01-20 20:35:21','backend'),(20,NULL,13.5,2,1,'2016-01-16 17:46:00','2016-01-20 20:35:21','backend'),(21,NULL,14.0,2,1,'2016-01-16 17:46:00','2016-01-20 20:35:21','backend'),(22,NULL,14.5,2,1,'2016-01-16 17:46:00','2016-01-20 20:35:21','backend'),(23,NULL,15.0,2,1,'2016-01-16 17:46:00','2016-01-20 20:35:21','backend'),(24,NULL,15.5,2,1,'2016-01-16 17:46:00','2016-01-20 20:35:21','backend'),(25,NULL,16.0,2,1,'2016-01-16 17:46:00','2016-01-20 20:35:21','backend');

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
