-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 04, 2016 at 01:44 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_jzeva_shubham`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address_master`
--

DROP TABLE IF EXISTS `tbl_address_master`;
CREATE TABLE IF NOT EXISTS `tbl_address_master` (
  `address_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_active` tinyint(2) DEFAULT NULL COMMENT '0-Inactive | 1- Active | 2-Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attribute_master`
--

DROP TABLE IF EXISTS `tbl_attribute_master`;
CREATE TABLE IF NOT EXISTS `tbl_attribute_master` (
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
  UNIQUE KEY `attributeid_UNIQUE` (`attributeid`),
  UNIQUE KEY `idxName` (`attr_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_attribute_master`
--

INSERT INTO `tbl_attribute_master` (`attributeid`, `attr_name`, `attr_values`, `attr_type`, `attr_unit`, `attr_unit_pos`, `attr_pos`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(8420160401132318, 'Price', '1000,1000000', 4, 'Rs.', 0, 0, 1, '2016-04-01 13:23:18', '2016-04-01 07:53:18', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_attribute_mapping`
--

DROP TABLE IF EXISTS `tbl_category_attribute_mapping`;
CREATE TABLE IF NOT EXISTS `tbl_category_attribute_mapping` (
  `catid` bigint(20) NOT NULL,
  `attributeid` bigint(10) NOT NULL,
  `active_flag` varchar(45) DEFAULT '1' COMMENT '0 - not active, 1 - active, 2 - deleted',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`catid`,`attributeid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category_attribute_mapping`
--

INSERT INTO `tbl_category_attribute_mapping` (`catid`, `attributeid`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(5520160401195043, 8420160401132318, '1', '2016-04-01 19:50:43', '2016-04-01 14:20:43', '1'),
(5720160401200242, 8420160401132318, '1', '2016-04-01 20:02:42', '2016-04-01 14:32:42', '1'),
(5920160401195057, 8420160401132318, '1', '2016-04-01 19:50:57', '2016-04-01 14:20:57', '1'),
(6420160401195033, 8420160401132318, '1', '2016-04-01 19:50:33', '2016-04-01 14:20:33', '1'),
(6820160401184401, 8420160401132318, '1', '2016-04-01 18:44:01', '2016-04-01 15:26:09', '1'),
(7720160401174700, 8420160401132318, '1', '2016-04-01 17:47:00', '2016-04-01 12:17:00', '1'),
(8020160402111829, 8420160401132318, '1', '2016-04-02 11:18:29', '2016-04-02 05:48:29', '1'),
(9020160402113032, 8420160401132318, '1', '2016-04-02 11:30:32', '2016-04-02 06:00:32', '1'),
(9120160401174728, 8420160401132318, '1', '2016-04-01 17:47:28', '2016-04-02 05:48:38', '1'),
(9120160401184301, 8420160401132318, '1', '2016-04-01 19:50:03', '2016-04-01 14:20:03', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_master`
--

DROP TABLE IF EXISTS `tbl_category_master`;
CREATE TABLE IF NOT EXISTS `tbl_category_master` (
  `catid` bigint(20) NOT NULL,
  `pcatid` varchar(256) DEFAULT '9999' COMMENT 'parent category id | 9999 for parent category',
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
  FULLTEXT KEY `pcatid` (`pcatid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category_master`
--

INSERT INTO `tbl_category_master` (`catid`, `pcatid`, `cat_name`, `description`, `cat_lvl`, `lineage`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(9120160401184301, '9120160401174728', 'Category C', '', 0, NULL, 1, '2016-04-01 18:43:01', '2016-04-01 14:20:03', '1'),
(9120160401174728, '99999', 'Category B', '', 0, NULL, 1, '2016-04-01 17:47:28', '2016-05-04 08:09:14', '1'),
(7720160401174700, '99999', 'Category A', '', 0, NULL, 1, '2016-04-01 17:47:00', '2016-05-04 08:09:19', '1'),
(6420160401195033, '6820160401184401', 'Category E', '', 0, NULL, 1, '2016-04-01 19:50:33', '2016-04-01 14:20:33', '1'),
(6820160401184401, '9120160401174728', 'Category D', '', 0, NULL, 1, '2016-04-01 18:44:01', '2016-04-01 15:26:09', '1'),
(9020160402113032, '7720160401174700,6820160401184401', 'Category J', '', 0, NULL, 1, '2016-04-02 11:30:32', '2016-04-02 06:00:32', '1'),
(5520160401195043, '6420160401195033', 'Category F', '', 0, NULL, 1, '2016-04-01 19:50:43', '2016-04-01 14:20:43', '1'),
(5920160401195057, '5520160401195043', 'Category G', '', 0, NULL, 1, '2016-04-01 19:50:57', '2016-04-01 14:20:57', '1'),
(5720160401200242, '5920160401195057,5520160401195043,6420160401195033', 'Category H', '', 0, NULL, 1, '2016-04-01 20:02:42', '2016-04-01 14:32:42', '1'),
(8020160402111829, '7720160401174700', 'Category I', '', 0, NULL, 1, '2016-04-02 11:18:29', '2016-04-02 05:48:29', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_product_mapping`
--

DROP TABLE IF EXISTS `tbl_category_product_mapping`;
CREATE TABLE IF NOT EXISTS `tbl_category_product_mapping` (
  `catid` bigint(20) NOT NULL,
  `productid` bigint(20) NOT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not Active, 1 - Active',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`catid`,`productid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city_master`
--

DROP TABLE IF EXISTS `tbl_city_master`;
CREATE TABLE IF NOT EXISTS `tbl_city_master` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1095 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coupon_master`
--

DROP TABLE IF EXISTS `tbl_coupon_master`;
CREATE TABLE IF NOT EXISTS `tbl_coupon_master` (
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

--
-- Dumping data for table `tbl_coupon_master`
--

INSERT INTO `tbl_coupon_master` (`coupon_id`, `coupon_code`, `coupon_name`, `discount_type`, `discount_amount`, `minimum_amount`, `description`, `start_date`, `end_date`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(2120160201202457, 'JZEVA12525', 'ASSS', 1, 65, 1200, 'jkhkj jhgjhgj', '2016-02-06', '2016-02-24', 1, '2016-02-01 20:24:57', '2016-02-10 07:19:24', '1'),
(2120160202163812, 'JZEVA12525', 'Coupoun 2', 2, 5, 15000, 'Coupoun 2 Description', '2016-02-12', '2016-02-15', 2, '2016-02-02 16:38:12', '2016-03-31 12:19:42', '1'),
(2420160202163537, 'JZEVA12525', 'COUPON 1', 1, 5, 150052, 'Test Coupon 1', '2016-02-07', '2016-02-27', 1, '2016-02-02 16:35:37', '2016-03-31 12:19:47', '1'),
(2520160208120111, 'JZEVA12525', 'ttt', 2, 5, 500044, 'Testing Again', '2016-02-29', '2016-02-29', 2, '2016-02-08 12:01:11', '2016-03-31 12:19:09', '1'),
(3220160201202856, 'JZEVA12525', 'Dipawali', 0, 1500.25, 1500, 'Testing', '2016-01-25', '2016-03-25', 1, '2016-02-01 20:28:56', '2016-02-10 07:19:24', '1'),
(4820160202162022, 'JZEVA12525', 'New Year Special', 0, 1500.25, 1500, 'Testing', '2016-01-25', '2016-03-25', 1, '2016-02-02 16:20:22', '2016-02-10 07:19:24', '1'),
(6920160202170453, 'JZEVA12525', 'C22', 1, 5, 1500, 'Updated to 25%', '2016-02-06', '2016-02-13', 2, '2016-02-02 17:09:21', '2016-03-31 12:19:37', '1'),
(7220160212111716, 'JZEVA12525', 'rewgerg', 1, 6, 500, 'Test Coupon', '2016-02-12', '2016-02-12', 2, '2016-02-12 11:17:16', '2016-03-31 12:10:41', '1'),
(8420160201203118, 'JZEVA12525', 'New Year Special', 0, 1500.25, 1500, 'Testing', '2016-01-25', '2016-03-25', 1, '2016-02-01 20:31:18', '2016-02-10 07:19:24', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_diamond_quality_mapping`
--

DROP TABLE IF EXISTS `tbl_diamond_quality_mapping`;
CREATE TABLE IF NOT EXISTS `tbl_diamond_quality_mapping` (
  `diamond_id` bigint(20) NOT NULL,
  `id` int(5) NOT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not Active, 1 - Active',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`diamond_id`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_diamond_quality_master`
--

DROP TABLE IF EXISTS `tbl_diamond_quality_master`;
CREATE TABLE IF NOT EXISTS `tbl_diamond_quality_master` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `dname` varchar(45) DEFAULT NULL,
  `dvalue` varchar(45) DEFAULT NULL,
  `price_per_carat` double DEFAULT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not Active, 1 - Active',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_diamond_quality_master`
--

INSERT INTO `tbl_diamond_quality_master` (`id`, `dname`, `dvalue`, `price_per_carat`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(1, 'VVS - IF', 'VVS - IF', 1000, 1, '2016-01-18 17:09:46', '2016-01-29 05:17:00', '1'),
(2, 'VVS - EF', 'VVS - EF', 2500, 1, '2016-01-18 17:12:58', '2016-01-28 06:29:38', '1'),
(3, 'VVS - GH', 'VVS - GH', 3500, 1, '2016-01-18 17:12:58', '2016-01-28 06:29:38', '1'),
(4, 'VS - EF', 'VS - EF', 4500, 1, '2016-01-18 17:12:58', '2016-01-28 06:29:38', '1'),
(5, 'VS - GH', 'VS - GH', 5500, 1, '2016-01-18 17:12:59', '2016-01-28 06:29:38', '1'),
(6, 'VS - IJ', 'VS - IJ', 6500, 1, '2016-01-18 17:12:59', '2016-01-28 06:29:38', '1'),
(7, 'SI - EF', 'SI - EF', 7500, 1, '2016-01-18 17:12:59', '2016-01-28 06:29:38', '1'),
(8, 'SI - GH', 'SI - GH', 8500, 1, '2016-01-18 17:12:59', '2016-01-28 06:29:38', '1'),
(9, 'SI - IJ', 'SI - IJ', 9500, 1, '2016-01-18 17:12:59', '2016-01-28 06:29:38', '1'),
(10, 'SI - JK', 'SI - JK', 10500, 1, '2016-01-18 17:12:59', '2016-01-28 06:29:38', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_discount_master`
--

DROP TABLE IF EXISTS `tbl_discount_master`;
CREATE TABLE IF NOT EXISTS `tbl_discount_master` (
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gemstone_master`
--

DROP TABLE IF EXISTS `tbl_gemstone_master`;
CREATE TABLE IF NOT EXISTS `tbl_gemstone_master` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `gemstone_name` varchar(45) DEFAULT NULL,
  `description` blob,
  `active_flag` tinyint(2) DEFAULT '1',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tbl_gemstone_master`
--

INSERT INTO `tbl_gemstone_master` (`id`, `gemstone_name`, `description`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(1, 'Amber', '', 1, '2016-01-19 10:11:52', '2016-01-19 04:41:52', 'backend'),
(2, 'Amethyst', '', 1, '2016-01-19 10:11:52', '2016-01-19 04:41:52', 'backend'),
(3, 'Aquamarine', '', 1, '2016-01-19 10:11:52', '2016-01-19 04:41:52', 'backend'),
(4, 'Blue Topaz', '', 1, '2016-01-19 10:11:52', '2016-01-19 04:41:52', 'backend'),
(5, 'Coral', '', 1, '2016-01-19 10:11:52', '2016-01-19 04:41:52', 'backend'),
(6, 'Emerald', '', 1, '2016-01-19 10:11:53', '2016-01-19 04:41:53', 'backend'),
(7, 'Garnet', '', 1, '2016-01-19 10:11:53', '2016-01-19 04:41:53', 'backend'),
(8, 'Metalen Topaz', '', 1, '2016-01-19 10:11:53', '2016-01-19 04:41:53', 'backend'),
(9, 'Hydro', '', 1, '2016-01-19 10:11:53', '2016-01-19 04:41:53', 'backend'),
(10, 'Iolite', '', 1, '2016-01-19 10:11:53', '2016-01-19 04:41:53', 'backend'),
(11, 'Lemon Topaz', '', 1, '2016-01-19 10:11:53', '2016-01-19 04:41:53', 'backend'),
(12, 'Moonstone', '', 1, '2016-01-19 10:11:53', '2016-01-19 04:41:53', 'backend'),
(13, 'Onyx', '', 1, '2016-01-19 10:11:53', '2016-01-19 04:41:53', 'backend'),
(14, 'Opal', '', 1, '2016-01-19 10:11:53', '2016-01-19 04:41:53', 'backend'),
(15, 'Pearl', '', 1, '2016-01-19 10:11:53', '2016-01-19 04:41:53', 'backend'),
(16, 'Peridot', '', 1, '2016-01-19 10:11:53', '2016-01-19 04:41:53', 'backend'),
(17, 'Rose Quartz', '', 1, '2016-01-19 10:11:53', '2016-01-19 04:41:53', 'backend'),
(18, 'Rubilite', '', 1, '2016-01-19 10:11:53', '2016-01-19 04:41:53', 'backend'),
(19, 'Ruby', '', 1, '2016-01-19 10:11:53', '2016-01-19 04:41:53', 'backend'),
(20, 'Sapphire', '', 1, '2016-01-19 10:11:53', '2016-01-19 04:41:53', 'backend'),
(21, 'Smoky topaz', '', 1, '2016-01-19 10:11:53', '2016-01-19 04:41:53', 'backend'),
(22, 'Tanzanite', '', 1, '2016-01-19 10:11:53', '2016-01-19 04:41:53', 'backend'),
(23, 'Turquoise', '', 1, '2016-01-19 10:11:53', '2016-01-19 04:41:53', 'backend');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_metal_color_master`
--

DROP TABLE IF EXISTS `tbl_metal_color_master`;
CREATE TABLE IF NOT EXISTS `tbl_metal_color_master` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `dname` varchar(45) DEFAULT NULL,
  `dvalue` varchar(45) DEFAULT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not Active, 1 - Active',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_metal_color_master`
--

INSERT INTO `tbl_metal_color_master` (`id`, `dname`, `dvalue`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(1, 'yellow', 'Yellow', 1, '2016-01-16 17:34:26', '2016-01-16 12:04:26', 'backend'),
(2, 'rose', 'Rose', 1, '2016-01-16 17:34:26', '2016-03-30 06:52:02', 'backend'),
(3, 'white', 'White', 1, '2016-01-16 17:34:26', '2016-01-16 12:04:26', 'backend');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_metal_purity_master`
--

DROP TABLE IF EXISTS `tbl_metal_purity_master`;
CREATE TABLE IF NOT EXISTS `tbl_metal_purity_master` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `dname` varchar(45) DEFAULT NULL,
  `dvalue` varchar(45) DEFAULT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not Active, 1 - Active',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  `price` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_metal_purity_master`
--

INSERT INTO `tbl_metal_purity_master` (`id`, `dname`, `dvalue`, `active_flag`, `createdon`, `updatedon`, `updatedby`, `price`) VALUES
(1, '9 carat', '9 Carat', 1, '2016-01-16 17:29:15', '2016-02-01 11:55:24', '1', 18750),
(2, '14 carat', '14 Carat', 1, '2016-01-16 17:31:06', '2016-02-01 11:55:24', '1', 29150),
(3, '18 carat', '18 Carat', 1, '2016-01-16 17:31:16', '2016-02-01 11:55:24', '1', 37550),
(4, '22 carat', '22 Carat', 1, '2016-01-16 17:31:20', '2016-02-01 11:55:24', '1', 45800),
(5, '24 carat', '24 Carat', 1, '2016-01-16 17:31:22', '2016-02-01 11:55:24', '1', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_master`
--

DROP TABLE IF EXISTS `tbl_order_master`;
CREATE TABLE IF NOT EXISTS `tbl_order_master` (
  `order_id` bigint(20) NOT NULL COMMENT 'order id generated by random number function',
  `product_id` bigint(20) DEFAULT NULL COMMENT 'id number of the product',
  `user_id` bigint(20) NOT NULL COMMENT 'user id of the customer',
  `order_date` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time of the order being placed',
  `delivery_date` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'date of the expected delivery',
  `order_status` tinyint(2) DEFAULT '1' COMMENT '0 - order placed | 1 - order approved | 2 - getting manufactured | 3 - in qc | 4 - in certification |5 - shipped | 6 - delivered | 7 - not delivered | 8 - rescheduled | 9 - cancelled',
  `active_flag` tinyint(2) DEFAULT '1' COMMENT 'active status of the order (0-Inactive | 1- Active | 2- Deleted | 3- Completed)',
  `createdon` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time of the order being entered in db',
  `updatedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'data and time of the order entry being updated',
  `updatedby` varchar(30) DEFAULT 'mysql' COMMENT 'name of the user who updated entry',
  `product_price` decimal(10,2) DEFAULT '0.00' COMMENT 'price of the total products being calculated from cart',
  `payment` tinyint(4) DEFAULT NULL COMMENT '0-Credit Card | 1-Debit Card | 2-Net Banking | 3-EMI | 4-COD',
  UNIQUE KEY `idx_user_order` (`order_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_attributes_mapping`
--

DROP TABLE IF EXISTS `tbl_product_attributes_mapping`;
CREATE TABLE IF NOT EXISTS `tbl_product_attributes_mapping` (
  `productid` bigint(20) NOT NULL COMMENT 'product id',
  `attributeid` bigint(20) NOT NULL COMMENT 'attribute id',
  `value` varchar(256) NOT NULL COMMENT 'Mapped Values',
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not Active, 1 - Active',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  UNIQUE KEY `idxPid` (`productid`,`attributeid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_diamond_mapping`
--

DROP TABLE IF EXISTS `tbl_product_diamond_mapping`;
CREATE TABLE IF NOT EXISTS `tbl_product_diamond_mapping` (
  `productid` bigint(20) NOT NULL,
  `diamond_id` bigint(20) NOT NULL,
  `shape` varchar(45) DEFAULT NULL,
  `carat` double DEFAULT NULL,
  `total_no` int(5) DEFAULT NULL,
  `active_flag` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 - Not active, 1 - Active, 2 - Deleted',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`productid`,`diamond_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_diamond_mapping`
--

INSERT INTO `tbl_product_diamond_mapping` (`productid`, `diamond_id`, `shape`, `carat`, `total_no`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(9320160211205332, 7120160213170145, 'Princess', 1, 1, 1, '2016-02-13 17:01:45', '2016-02-13 11:31:45', '1'),
(9320160211205332, 7420160213170100, 'Marquise', 1, 1, 1, '2016-02-13 17:01:00', '2016-02-13 11:31:00', '1'),
(9320160211205332, 7520160211205332, 'Princess', 1, 1, 1, '2016-02-11 20:53:32', '2016-02-11 15:23:32', '1'),
(9320160211205332, 7720160211205834, 'Marquise', 1, 1, 1, '2016-02-11 20:58:34', '2016-02-13 06:34:38', '1'),
(9320160211205332, 8220160213170145, 'Marquise', 1, 1, 1, '2016-02-13 17:01:45', '2016-02-13 11:31:45', '1'),
(9320160211205332, 8320160213170145, 'Marquise', 1, 1, 1, '2016-02-13 17:01:45', '2016-02-13 11:31:45', '1'),
(9320160211205332, 8420160213170145, 'Princess', 1, 1, 1, '2016-02-13 17:01:45', '2016-02-13 11:31:45', '1'),
(9320160211205332, 9120160213170145, 'Marquise', 1, 1, 1, '2016-02-13 17:01:45', '2016-02-13 11:31:45', '1'),
(9620160213140709, 6320160213140709, 'Emerald', 1, 1, 1, '2016-02-13 14:07:09', '2016-02-13 08:37:09', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_gemstone_mapping`
--

DROP TABLE IF EXISTS `tbl_product_gemstone_mapping`;
CREATE TABLE IF NOT EXISTS `tbl_product_gemstone_mapping` (
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_image_mapping`
--

DROP TABLE IF EXISTS `tbl_product_image_mapping`;
CREATE TABLE IF NOT EXISTS `tbl_product_image_mapping` (
  `product_id` bigint(20) NOT NULL COMMENT 'product_id filled by vendor',
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Auto Incremented ID to differenciate images of same product',
  `product_image` text COMMENT 'product_images',
  `active_flag` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0-Inactive,1-Active,2-Deleted,3-Rejected,4-Approve',
  `image_sequence` text COMMENT 'sequence of images',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `upload_date` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'image uploaded date',
  KEY `idx_id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_master`
--

DROP TABLE IF EXISTS `tbl_product_master`;
CREATE TABLE IF NOT EXISTS `tbl_product_master` (
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_metal_color_mapping`
--

DROP TABLE IF EXISTS `tbl_product_metal_color_mapping`;
CREATE TABLE IF NOT EXISTS `tbl_product_metal_color_mapping` (
  `productid` bigint(20) NOT NULL,
  `id` int(5) NOT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not Active, 1 - Active',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`productid`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_metal_purity_mapping`
--

DROP TABLE IF EXISTS `tbl_product_metal_purity_mapping`;
CREATE TABLE IF NOT EXISTS `tbl_product_metal_purity_mapping` (
  `productid` bigint(20) NOT NULL,
  `id` int(5) NOT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`productid`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_size_mapping`
--

DROP TABLE IF EXISTS `tbl_product_size_mapping`;
CREATE TABLE IF NOT EXISTS `tbl_product_size_mapping` (
  `productid` bigint(20) NOT NULL,
  `size_id` int(5) NOT NULL,
  `quantity` int(5) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`productid`,`size_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_solitaire_mapping`
--

DROP TABLE IF EXISTS `tbl_product_solitaire_mapping`;
CREATE TABLE IF NOT EXISTS `tbl_product_solitaire_mapping` (
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_uncut_mapping`
--

DROP TABLE IF EXISTS `tbl_product_uncut_mapping`;
CREATE TABLE IF NOT EXISTS `tbl_product_uncut_mapping` (
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

--
-- Dumping data for table `tbl_product_uncut_mapping`
--

INSERT INTO `tbl_product_uncut_mapping` (`productid`, `uncut_id`, `color`, `quality`, `total_no`, `carat`, `price_per_carat`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(9320160211205332, 6020160213170145, 'G,H,I,J', 'SI1', 205, 12, 2200, 1, '2016-02-13 17:01:45', '2016-02-13 11:31:45', '1'),
(9320160211205332, 8620160211205332, 'F', 'VVS1', 5, 1, 1, 1, '2016-02-11 20:53:32', '2016-02-11 15:23:32', '1'),
(9320160211205332, 9420160213170100, 'G,H,I,J', 'SI1', 205, 12, 2200, 1, '2016-02-13 17:01:00', '2016-02-13 11:31:00', '1'),
(9320160211205332, 9920160213170145, 'F', 'VVS1', 5, 1, 1, 1, '2016-02-13 17:01:45', '2016-02-13 11:31:45', '1'),
(9620160213140709, 1820160213140709, 'D,E,F,G', 'VVS1', 1, 1, 1, 1, '2016-02-13 14:07:09', '2016-02-13 08:37:09', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_size_master`
--

DROP TABLE IF EXISTS `tbl_size_master`;
CREATE TABLE IF NOT EXISTS `tbl_size_master` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `size_value` decimal(3,1) DEFAULT NULL,
  `catid` bigint(20) DEFAULT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - not active, 1 - active, 2 - deleted',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `tbl_size_master`
--

INSERT INTO `tbl_size_master` (`id`, `name`, `size_value`, `catid`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(1, NULL, '4.0', 6120160130123733, 1, '2016-01-16 17:45:59', '2016-03-15 08:54:07', 'backend'),
(2, NULL, '4.5', 6120160130123733, 1, '2016-01-16 17:45:59', '2016-03-15 08:54:07', 'backend'),
(3, NULL, '5.0', 6120160130123733, 1, '2016-01-16 17:45:59', '2016-03-15 08:54:07', 'backend'),
(4, NULL, '5.5', 6120160130123733, 1, '2016-01-16 17:45:59', '2016-03-15 08:54:07', 'backend'),
(5, NULL, '6.0', 6120160130123733, 1, '2016-01-16 17:45:59', '2016-03-15 08:54:07', 'backend'),
(6, NULL, '6.5', 6120160130123733, 1, '2016-01-16 17:45:59', '2016-03-15 08:54:07', 'backend'),
(7, NULL, '7.0', 6120160130123733, 1, '2016-01-16 17:45:59', '2016-03-15 08:54:07', 'backend'),
(8, NULL, '7.5', 6120160130123733, 1, '2016-01-16 17:45:59', '2016-03-15 08:54:07', 'backend'),
(9, NULL, '8.0', 6120160130123733, 1, '2016-01-16 17:45:59', '2016-03-15 08:54:07', 'backend'),
(10, NULL, '8.5', 6120160130123733, 1, '2016-01-16 17:45:59', '2016-03-15 08:54:07', 'backend'),
(11, NULL, '9.0', 6120160130123733, 1, '2016-01-16 17:46:00', '2016-03-15 08:54:07', 'backend'),
(12, NULL, '9.5', 6120160130123733, 1, '2016-01-16 17:46:00', '2016-03-15 08:54:07', 'backend'),
(13, NULL, '10.0', 6120160130123733, 1, '2016-01-16 17:46:00', '2016-03-15 08:54:07', 'backend'),
(14, NULL, '10.5', 6120160130123733, 1, '2016-01-16 17:46:00', '2016-03-15 08:54:07', 'backend'),
(15, NULL, '11.0', 6120160130123733, 1, '2016-01-16 17:46:00', '2016-03-15 08:54:07', 'backend'),
(16, NULL, '11.5', 6120160130123733, 1, '2016-01-16 17:46:00', '2016-03-15 08:54:07', 'backend'),
(17, NULL, '12.0', 6120160130123733, 1, '2016-01-16 17:46:00', '2016-03-15 08:54:07', 'backend'),
(18, NULL, '12.5', 6120160130123733, 1, '2016-01-16 17:46:00', '2016-03-15 08:54:07', 'backend'),
(19, NULL, '13.0', 6120160130123733, 1, '2016-01-16 17:46:00', '2016-03-15 08:54:07', 'backend'),
(20, NULL, '13.5', 6120160130123733, 1, '2016-01-16 17:46:00', '2016-03-15 08:54:07', 'backend'),
(21, NULL, '14.0', 6120160130123733, 1, '2016-01-16 17:46:00', '2016-03-15 08:54:07', 'backend'),
(22, NULL, '14.5', 6120160130123733, 1, '2016-01-16 17:46:00', '2016-03-15 08:54:07', 'backend'),
(23, NULL, '15.0', 6120160130123733, 1, '2016-01-16 17:46:00', '2016-03-15 08:54:07', 'backend'),
(24, NULL, '15.5', 6120160130123733, 1, '2016-01-16 17:46:00', '2016-03-15 08:54:07', 'backend'),
(25, NULL, '16.0', 6120160130123733, 1, '2016-01-16 17:46:00', '2016-03-15 08:54:07', 'backend'),
(26, NULL, '2.2', 6, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(27, NULL, '2.4', 6, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(28, NULL, '2.6', 6, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(29, NULL, '2.8', 6, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(30, NULL, '2.1', 6, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(31, 'Collar', '14.0', 5, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(32, 'Choker', '16.0', 5, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(33, 'Princess', '18.0', 5, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(34, 'Matinee', '20.0', 5, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(35, 'Matinee', '24.0', 5, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(36, 'Opera', '30.0', 5, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(37, 'Opera', '33.0', 5, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(38, NULL, '16.5', 6120160130123733, 1, '2016-01-16 17:46:00', '2016-03-15 08:54:07', 'backend'),
(39, NULL, '17.0', 6120160130123733, 1, '2016-01-16 17:46:00', '2016-03-15 08:54:07', 'backend'),
(40, NULL, '17.5', 6120160130123733, 1, '2016-01-16 17:46:00', '2016-03-15 08:54:07', 'backend'),
(41, NULL, '18.0', 6120160130123733, 1, '2016-03-15 14:25:44', '2016-03-15 08:55:44', 'backend'),
(42, NULL, '18.5', 6120160130123733, 1, '2016-03-15 14:34:16', '2016-03-15 09:04:16', 'backend'),
(43, NULL, '19.0', 6120160130123733, 1, '2016-03-15 14:34:16', '2016-03-15 09:04:16', 'backend'),
(44, NULL, '19.5', 6120160130123733, 1, '2016-03-15 14:34:16', '2016-03-15 09:04:16', 'backend'),
(45, NULL, '20.0', 6120160130123733, 1, '2016-03-15 14:34:16', '2016-03-15 09:04:16', 'backend'),
(46, NULL, '21.0', 6120160130123733, 1, '2016-03-15 14:34:16', '2016-03-15 09:04:16', 'backend'),
(47, NULL, '21.5', 6120160130123733, 1, '2016-03-15 14:34:16', '2016-03-15 09:04:16', 'backend'),
(48, NULL, '22.0', 6120160130123733, 1, '2016-03-15 14:34:16', '2016-03-15 09:04:16', 'backend'),
(49, NULL, '22.5', 6120160130123733, 1, '2016-03-15 14:34:17', '2016-03-15 09:04:17', 'backend'),
(50, NULL, '23.0', 6120160130123733, 1, '2016-03-15 14:34:17', '2016-03-15 09:04:17', 'backend'),
(51, NULL, '24.0', 6120160130123733, 1, '2016-03-15 14:34:17', '2016-03-15 09:04:17', 'backend'),
(52, NULL, '24.5', 6120160130123733, 1, '2016-03-15 14:34:17', '2016-03-15 09:04:17', 'backend'),
(53, NULL, '25.0', 6120160130123733, 1, '2016-03-15 14:34:17', '2016-03-15 09:04:17', 'backend'),
(54, NULL, '25.5', 6120160130123733, 1, '2016-03-15 14:34:17', '2016-03-15 09:04:17', 'backend'),
(55, NULL, '26.0', 6120160130123733, 1, '2016-03-15 14:34:17', '2016-03-15 09:04:17', 'backend');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_master`
--

DROP TABLE IF EXISTS `tbl_user_master`;
CREATE TABLE IF NOT EXISTS `tbl_user_master` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'auto generated userid from random id creator',
  `user_name` varchar(100) NOT NULL COMMENT 'Name of User',
  `password` varchar(255) NOT NULL COMMENT 'Password for login',
  `logmobile` bigint(15) NOT NULL COMMENT 'Mobile number of User',
  `email` varchar(255) NOT NULL COMMENT 'Email of user',
  `city` varchar(255) NOT NULL DEFAULT '' COMMENT 'city of the user',
  `address` varchar(255) NOT NULL COMMENT 'Multiple address sseperated by |~|',
  `is_vendor` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1-Vendor, 0-Not Vendor',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and Time of registration',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'updated at',
  `updated_by` varchar(100) NOT NULL COMMENT 'Details of the user or vendor who updated details',
  `subscribe` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '1-Active | 0-Inactive',
  `is_active` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1-Active, 0-Non Active',
  `pass_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Change Password Flag',
  `gender` tinyint(2) DEFAULT '0' COMMENT '0- Female | 1-Male | 2-Other',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `idx_login` (`logmobile`,`email`,`is_vendor`),
  KEY `idx_user_name` (`user_name`),
  KEY `idx_mobile` (`logmobile`),
  KEY `idx_is_active` (`is_active`),
  KEY `idx_date_time` (`date_time`),
  KEY `idx_update_time` (`update_time`),
  KEY `idx_updated_by` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendor_master`
--

DROP TABLE IF EXISTS `tbl_vendor_master`;
CREATE TABLE IF NOT EXISTS `tbl_vendor_master` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_vendor_master`
--

INSERT INTO `tbl_vendor_master` (`vendorid`, `name`, `city`, `mobile`, `email`, `landline`, `lng`, `lat`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(1, 'Patdiam', 'Mumbai', NULL, '8767194608', NULL, '0.000000000000000', '0.000000000000000', 1, '2016-01-18 13:09:40', '2016-01-18 07:39:40', '55'),
(2, 'Maharani', 'Mumbai', NULL, '8767194608', NULL, '0.000000000000000', '0.000000000000000', 1, '2016-01-18 13:09:40', '2016-01-18 07:39:40', '55'),
(3, 'SP Kulthiya', 'Mumbai', NULL, '8767194608', NULL, '0.000000000000000', '0.000000000000000', 1, '2016-01-18 13:09:40', '2016-01-18 07:39:40', '55'),
(4, 'DN Jewels', 'Mumbai', NULL, '8767194608', NULL, '0.000000000000000', '0.000000000000000', 1, '2016-01-18 13:09:40', '2016-01-18 07:39:40', '55');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
