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

insert  into `tbl_category_product_mapping`(`catid`,`productid`,`active_flag`,`createdon`,`updatedon`,`updatedby`) values (1,1220160116163544,1,'2016-01-16 16:35:44','2016-01-16 16:35:44','55'),(2,1220160116163544,1,'2016-01-16 16:35:44','2016-01-16 16:35:44','55'),(3,1220160116163544,1,'2016-01-16 16:35:44','2016-01-16 16:35:44','55'),(4,1220160116163544,1,'2016-01-16 16:35:44','2016-01-16 16:35:44','55'),(5,1220160116163544,1,'2016-01-16 16:35:44','2016-01-16 16:35:44','55');

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

/*Table structure for table `tbl_diamond_quality_master` */

DROP TABLE IF EXISTS `tbl_diamond_quality_master`;

CREATE TABLE `tbl_diamond_quality_master` (
  `id` int(5) NOT NULL,
  `dname` varchar(45) DEFAULT NULL,
  `dvalue` varchar(45) DEFAULT NULL,
  `price_per_carat` double DEFAULT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not Active, 1 - Active',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_diamond_quality_master` */

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
  `id` int(4) NOT NULL,
  `gemstone_name` varchar(45) DEFAULT NULL,
  `description` blob,
  `active_flag` tinyint(2) DEFAULT '1',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_gemstone_master` */

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

/*Table structure for table `tbl_product_gemstone_mapping` */

DROP TABLE IF EXISTS `tbl_product_gemstone_mapping`;

CREATE TABLE `tbl_product_gemstone_mapping` (
  `productid` bigint(20) NOT NULL,
  `gemstone_id` bigint(20) NOT NULL,
  `genstone_name` varchar(45) DEFAULT NULL,
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

/*Table structure for table `tbl_product_master` */

DROP TABLE IF EXISTS `tbl_product_master`;

CREATE TABLE `tbl_product_master` (
  `productid` bigint(20) NOT NULL,
  `product_code` varchar(45) DEFAULT NULL,
  `vendorid` int(10) DEFAULT NULL,
  `product_name` varchar(60) DEFAULT NULL,
  `product_seo_name` varchar(150) DEFAULT NULL,
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

insert  into `tbl_product_master`(`productid`,`product_code`,`vendorid`,`product_name`,`product_seo_name`,`product_weight`,`diamond_setting`,`metal_weight`,`making_charges`,`procurement_cost`,`margin`,`measurement`,`customise_purity`,`customise_color`,`certificate`,`has_diamond`,`has_solitaire`,`has_uncut`,`has_gemstone`,`createdon`,`updatedon`,`updatedby`) values (4120160116165741,'JZEVA0525604585',1,'18k ring golden','18K Gold Office Wear Ring',5.5,'prong',4,12500.56,11000.52,5,'10X50',0,0,'SGL',1,1,1,1,'2016-01-16 16:57:41','2016-01-16 16:57:41','55'),(6820160116165751,'JZEVA0525604585',1,'18k ring golden','18K Gold Office Wear Ring',5.5,'prong',4,12500.56,11000.52,5,'10X50',0,0,'SGL',1,1,1,1,'2016-01-16 16:57:51','2016-01-16 16:57:51','55'),(8520160116190000,'JZEVA0525604585',1,'18k ring golden','18K Gold Office Wear Ring',5.5,'prong',4,12500.56,11000.52,5,'10X50',0,0,'SGL',1,1,1,1,'2016-01-16 19:00:00','2016-01-16 19:00:00','55'),(8820160116190041,'JZEVA0525604585',1,'18k ring golden','18K Gold Office Wear Ring',5.5,'prong',4,12500.56,11000.52,5,'10X50',0,0,'SGL',1,1,1,1,'2016-01-16 19:00:42','2016-01-16 19:00:42','55'),(9320160116185736,'JZEVA0525604585',1,'18k ring golden','18K Gold Office Wear Ring',5.5,'prong',4,12500.56,11000.52,5,'10X50',0,0,'SGL',1,1,1,1,'2016-01-16 18:57:36','2016-01-16 18:57:36','55');

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

insert  into `tbl_product_size_mapping`(`productid`,`size_id`,`quantity`,`createdon`,`updatedon`,`updatedby`) values (8820160116190041,1,20,'2016-01-16 19:00:41','2016-01-16 19:00:41','55'),(8820160116190041,2,22,'2016-01-16 19:00:41','2016-01-16 19:00:41','55'),(8820160116190041,5,5,'2016-01-16 19:00:41','2016-01-16 19:00:41','55'),(8820160116190041,7,2,'2016-01-16 19:00:41','2016-01-16 19:00:41','55'),(8820160116190041,9,3,'2016-01-16 19:00:41','2016-01-16 19:00:41','55'),(8820160116190041,11,1,'2016-01-16 19:00:42','2016-01-16 19:00:42','55'),(8820160116190041,13,7,'2016-01-16 19:00:42','2016-01-16 19:00:42','55');

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
  `table` varchar(45) DEFAULT NULL,
  `crown_angle` varchar(45) DEFAULT NULL,
  `girdle` varchar(45) DEFAULT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not Active, 1 - Active',
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_vendor_master` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
