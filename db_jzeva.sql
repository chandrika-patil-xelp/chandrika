-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 14, 2016 at 03:36 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_jzeva`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attribute_master`
--

DROP TABLE IF EXISTS `tbl_attribute_master`;
CREATE TABLE IF NOT EXISTS `tbl_attribute_master` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_attribute_master`
--

INSERT INTO `tbl_attribute_master` (`attributeid`, `attr_name`, `attr_type`, `attr_unit`, `attr_unit_pos`, `attr_pos`, `map_column`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(1, 'price', 1, 'rupees', 0, 1, 'test4', 2, '2016-01-14 12:24:25', '2016-01-14 07:29:02', '6'),
(2, 'brand', 1, 'rupees', 0, 1, 'test2', 1, '2016-01-14 12:24:26', '2016-01-14 09:56:39', '1'),
(3, 'color', 1, 'rupees', 0, 1, 'test2', 1, '2016-01-14 12:24:31', '2016-01-14 09:56:48', '1'),
(4, 'price', 1, 'rupees', 0, 1, 'test2', 1, '2016-01-14 12:24:51', '2016-01-14 07:02:17', '1');

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
(1, 1, '1', '2016-01-14 13:39:38', '2016-01-14 08:09:38', '6'),
(1, 3, '1', '2016-01-14 13:42:50', '2016-01-14 09:47:08', '6'),
(1, 4, '1', '2016-01-14 13:44:03', '2016-01-14 09:47:14', '6'),
(2, 3, '1', '2016-01-14 14:06:16', '2016-01-14 08:36:16', '6'),
(2, 4, '1', '2016-01-14 14:06:44', '2016-01-14 08:36:44', '6');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_master`
--

DROP TABLE IF EXISTS `tbl_category_master`;
CREATE TABLE IF NOT EXISTS `tbl_category_master` (
  `catid` bigint(20) NOT NULL AUTO_INCREMENT,
  `pcatid` bigint(20) DEFAULT '0' COMMENT 'parent category id',
  `cat_name` varchar(255) DEFAULT NULL COMMENT 'category name specifi',
  `cat_lvl` tinyint(4) DEFAULT '0' COMMENT 'category depth level',
  `lineage` text COMMENT 'lineage hierarchy',
  `active_flag` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 - Not active, 1 - Active, 2 - Deleted',
  `createdon` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time on which it was created.',
  `updatedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'timestamp on which it was last updated',
  `updatedby` varchar(150) NOT NULL,
  KEY `catid` (`catid`),
  KEY `pcatid` (`pcatid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_category_master`
--

INSERT INTO `tbl_category_master` (`catid`, `pcatid`, `cat_name`, `cat_lvl`, `lineage`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(1, 0, 'jewellery', 0, NULL, 1, '2016-01-14 10:34:18', '2016-01-14 05:04:18', '2'),
(2, 1, 'rings', 0, NULL, 1, '2016-01-14 10:36:28', '2016-01-14 05:06:28', '2'),
(3, 1, 'earrings', 0, NULL, 1, '2016-01-14 10:36:38', '2016-01-14 05:06:38', '2'),
(4, 1, 'pendants', 0, NULL, 1, '2016-01-14 10:38:10', '2016-01-14 05:08:10', '1'),
(5, 1, 'chains', 0, NULL, 1, '2016-01-14 10:38:15', '2016-01-14 05:08:15', '1'),
(6, 1, 'bangles', 0, NULL, 1, '2016-01-14 10:38:20', '2016-01-14 05:08:20', '1'),
(7, 1, 'bracelets', 0, NULL, 1, '2016-01-14 10:38:25', '2016-01-14 05:42:00', '5');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
