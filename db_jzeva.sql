-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 13, 2016 at 01:26 PM
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

--
-- Dumping data for table `tbl_attribute_master`
--

INSERT INTO `tbl_attribute_master` (`attributeid`, `attr_name`, `attr_values`, `attr_type`, `attr_unit`, `attr_unit_pos`, `attr_pos`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(1520160129143556, 'Metal Purity', '9 carat,14 carat,18 carat,22 carat,24 carat', 1, 'Carat', 1, 1, 1, '2016-01-29 14:35:56', '2016-02-10 07:13:46', '1'),
(2620160129153823, 'Diamond Setting Type', 'Prong,Bezel,Pave,Channel,Invisible,Cluster', 1, '', 0, 0, 1, '2016-01-29 15:38:23', '2016-02-10 07:13:46', '1'),
(5420160129152545, 'Metal Type', 'Gold,Platinum', 2, '', 0, 0, 1, '2016-01-29 15:25:45', '2016-02-10 07:13:46', '1'),
(6320160129151920, 'Metal Color', 'White,Yellow,Rose', 1, '', 0, 2, 1, '2016-01-29 15:19:20', '2016-02-10 07:13:46', '1'),
(7020160212104134, 'Test Attr 1', 'test1,test2,test3', 0, '0', 0, 1, 2, '2016-02-12 10:41:34', '2016-02-12 05:13:30', '1'),
(7320160129153504, 'Price', '10000,10000000,5000', 4, 'Rs', 1, 2, 1, '2016-01-29 15:35:04', '2016-02-10 07:13:46', '1');

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
(1, 1, '2', '2016-01-14 13:39:38', '2016-01-30 10:53:37', '6'),
(1, 3, '2', '2016-01-14 13:42:50', '2016-01-30 10:53:37', '6'),
(1, 4, '2', '2016-01-14 13:44:03', '2016-01-30 10:53:37', '6'),
(1, 1520160129143556, '1', '2016-01-30 16:23:38', '2016-01-30 10:53:38', '1'),
(1, 2620160129153823, '1', '2016-01-30 16:23:38', '2016-01-30 10:53:38', '1'),
(1, 7320160129153504, '1', '2016-01-30 16:23:38', '2016-01-30 10:53:38', '1'),
(2, 3, '1', '2016-01-14 14:06:16', '2016-01-14 03:06:16', '6'),
(2, 4, '1', '2016-01-14 14:06:44', '2016-01-14 03:06:44', '6'),
(6, 1520160129143556, '1', '2016-01-30 16:23:06', '2016-01-30 10:53:06', '1'),
(6, 2620160129153823, '1', '2016-01-30 16:23:06', '2016-01-30 10:53:06', '1'),
(9, 1, '2', '2016-01-15 13:56:35', '2016-01-15 09:15:35', '1'),
(9, 2, '2', '2016-01-15 13:56:35', '2016-01-15 09:15:35', '1'),
(9, 3, '2', '2016-01-15 13:56:35', '2016-01-15 09:15:35', '1'),
(9, 4, '2', '2016-01-15 13:56:35', '2016-01-15 09:15:35', '1'),
(9, 5, '0', '2016-01-15 13:50:52', '2016-01-15 09:15:54', '1'),
(10, 1, '1', '2016-01-15 14:49:25', '2016-01-15 09:19:25', '8'),
(10, 2, '1', '2016-01-15 14:49:26', '2016-01-15 09:19:26', '8'),
(10, 3, '1', '2016-01-15 14:49:26', '2016-01-15 09:19:26', '8'),
(10, 4, '2', '2016-01-15 14:49:26', '2016-01-15 09:19:53', '8'),
(1720160129182503, 1520160129143556, '1', '2016-01-30 16:18:33', '2016-01-30 10:48:33', '1'),
(1720160129182503, 2620160129153823, '1', '2016-01-30 16:15:43', '2016-01-30 10:48:33', '1'),
(1720160129182503, 5420160129152545, '1', '2016-01-29 18:25:03', '2016-01-30 10:48:33', '1'),
(1720160129182503, 6320160129151920, '1', '2016-01-29 18:25:03', '2016-01-30 10:48:33', '1'),
(1720160129182503, 7320160129153504, '1', '2016-01-29 18:25:03', '2016-01-30 10:48:33', '1'),
(4720160203110353, 1520160129143556, '2', '2016-02-03 11:03:53', '2016-02-08 05:47:25', '1'),
(4720160203110353, 2620160129153823, '1', '2016-02-03 11:03:53', '2016-02-08 05:47:25', '1'),
(4720160203110353, 5420160129152545, '1', '2016-02-03 11:03:53', '2016-02-08 05:47:25', '1'),
(4720160203110353, 7320160129153504, '2', '2016-02-03 11:03:53', '2016-02-08 05:47:25', '1'),
(6120160130123733, 1520160129143556, '1', '2016-01-30 12:37:33', '2016-01-30 13:03:56', '1'),
(6120160130123733, 2620160129153823, '2', '2016-01-30 12:37:33', '2016-01-30 10:32:56', '1'),
(6120160130123733, 5420160129152545, '1', '2016-01-30 12:37:33', '2016-01-30 13:03:56', '1'),
(6120160130123733, 6320160129151920, '2', '2016-01-30 12:37:33', '2016-01-30 10:32:56', '1'),
(6120160130123733, 7320160129153504, '1', '2016-01-30 12:37:33', '2016-01-30 13:03:56', '1'),
(7120160129180756, 2620160129153823, '2', '2016-01-29 18:07:56', '2016-01-29 12:50:54', '1'),
(7120160129180756, 5420160129152545, '1', '2016-01-29 18:07:56', '2016-01-30 11:03:45', '1'),
(7120160129180756, 6320160129151920, '1', '2016-01-29 18:07:56', '2016-01-30 11:03:45', '1'),
(7120160129180756, 7320160129153504, '1', '2016-01-29 18:07:56', '2016-01-30 11:03:45', '1'),
(7520160203110442, 0, '1', '2016-02-03 11:04:42', '2016-02-03 05:34:42', '1'),
(8520160129184525, 2620160129153823, '1', '2016-01-29 18:45:25', '2016-01-30 12:08:37', '1'),
(8520160129184525, 5420160129152545, '1', '2016-01-29 18:45:25', '2016-01-30 12:08:37', '1'),
(8520160129184525, 6320160129151920, '1', '2016-01-29 18:45:25', '2016-01-30 12:08:37', '1'),
(8520160129184525, 7320160129153504, '1', '2016-01-29 18:46:13', '2016-01-30 12:08:37', '1'),
(9020160129184442, 6320160129151920, '1', '2016-01-29 18:44:42', '2016-01-29 13:14:42', '1'),
(9020160129184442, 7320160129153504, '1', '2016-01-29 18:44:42', '2016-01-29 13:14:42', '1'),
(9720160208112139, 7320160129153504, '1', '2016-02-08 11:21:39', '2016-02-08 05:51:39', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_master`
--

DROP TABLE IF EXISTS `tbl_category_master`;
CREATE TABLE IF NOT EXISTS `tbl_category_master` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category_master`
--

INSERT INTO `tbl_category_master` (`catid`, `pcatid`, `cat_name`, `description`, `cat_lvl`, `lineage`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(1, 0, 'jewellery', '', 0, NULL, 1, '2016-01-14 10:34:18', '2016-02-10 07:51:41', '1'),
(2, 1, 'rings', '', 0, NULL, 1, '2016-01-14 10:36:28', '2016-02-10 07:51:41', '1'),
(3, 1, 'earrings', '', 0, NULL, 1, '2016-01-14 10:36:38', '2016-02-10 07:51:41', '1'),
(4, 1, 'pendants', '', 0, NULL, 1, '2016-01-14 10:38:10', '2016-02-10 07:51:41', '1'),
(5, 1, 'chains', '', 0, NULL, 1, '2016-01-14 10:38:15', '2016-02-10 07:51:41', '1'),
(6, 1, 'bangles', '', 0, NULL, 1, '2016-01-14 10:38:20', '2016-02-10 07:51:41', '1'),
(7, 1, 'bracelets', '', 0, NULL, 1, '2016-01-14 10:38:25', '2016-02-10 07:51:41', '1'),
(8, 3, 'noserings', '', 0, NULL, 1, '2016-01-15 12:07:28', '2016-02-10 07:51:41', '1'),
(9, 11, 'gold earrings', '', 0, NULL, 1, '2016-01-15 13:56:35', '2016-02-10 07:51:41', '1'),
(10, 11, 'men rings', '', 0, NULL, 1, '2016-01-15 14:49:53', '2016-02-10 07:51:41', '1'),
(11, 0, 'diamond jewellery', '', 0, NULL, 1, '2016-01-21 12:44:33', '2016-02-10 07:51:41', '1'),
(7120160129180756, 4, 'Test Category 1', '', 0, NULL, 1, '2016-01-29 18:13:03', '2016-02-10 07:51:41', '1'),
(1720160129182503, 9, 'Test Category 2', '', 0, NULL, 1, '2016-01-29 18:25:03', '2016-02-10 07:51:41', '1'),
(2120160129184116, 1, 'Test Cat 3', '', 0, NULL, 1, '2016-01-29 18:41:16', '2016-02-10 07:51:41', '1'),
(3220160129184357, 4, 'Test 4', '', 0, NULL, 1, '2016-01-29 18:43:57', '2016-02-10 07:51:41', '1'),
(9020160129184442, 4, 'Test 4', '', 0, NULL, 1, '2016-01-29 18:44:42', '2016-02-10 07:51:41', '1'),
(8520160129184525, 4, 'Test 4', '', 0, NULL, 1, '2016-01-29 18:45:25', '2016-02-10 07:51:41', '1'),
(6120160130123733, 1, 'Rings', '', 0, NULL, 1, '2016-01-30 12:37:33', '2016-02-10 07:51:41', '1'),
(4720160203110353, 0, 'Collection', '', 0, NULL, 1, '2016-02-03 11:03:53', '2016-02-11 04:56:39', '1'),
(9720160208112139, 0, 'Testing', '', 0, NULL, 1, '2016-02-08 11:21:39', '2016-02-11 04:56:38', '1');

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

--
-- Dumping data for table `tbl_category_product_mapping`
--

INSERT INTO `tbl_category_product_mapping` (`catid`, `productid`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(1, 1720160125153911, 1, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(1, 1820160125152637, 1, '2016-01-25 15:26:37', '2016-01-25 09:56:37', '1'),
(1, 2220160125153103, 1, '2016-01-25 15:31:03', '2016-01-25 10:01:03', '1'),
(1, 3820160125152319, 1, '2016-01-25 15:23:19', '2016-01-25 09:53:19', '1'),
(1, 4120160125152526, 1, '2016-01-25 15:25:26', '2016-01-25 09:55:26', '1'),
(1, 4820160125153111, 1, '2016-01-25 15:31:11', '2016-01-25 10:01:11', '1'),
(1, 5420160125152802, 1, '2016-01-25 15:28:02', '2016-01-25 09:58:02', '1'),
(1, 5620160125152827, 1, '2016-01-25 15:28:27', '2016-01-25 09:58:27', '1'),
(1, 5620160125153018, 1, '2016-01-25 15:30:18', '2016-01-25 10:00:18', '1'),
(1, 8420160125152201, 1, '2016-01-25 15:22:01', '2016-01-25 09:52:01', '1'),
(1, 8920160125152717, 1, '2016-01-25 15:27:17', '2016-01-25 09:57:17', '1'),
(1, 9320160125152228, 1, '2016-01-25 15:22:28', '2016-01-25 09:52:28', '1'),
(1, 9520160125152945, 1, '2016-01-25 15:29:45', '2016-01-25 09:59:45', '1'),
(2, 1720160125153911, 1, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(2, 1820160125152637, 1, '2016-01-25 15:26:37', '2016-01-25 09:56:37', '1'),
(2, 2220160125153103, 1, '2016-01-25 15:31:03', '2016-01-25 10:01:03', '1'),
(2, 3820160125152319, 1, '2016-01-25 15:23:19', '2016-01-25 09:53:19', '1'),
(2, 4120160125152526, 1, '2016-01-25 15:25:26', '2016-01-25 09:55:26', '1'),
(2, 4820160125153111, 1, '2016-01-25 15:31:11', '2016-01-25 10:01:11', '1'),
(2, 5420160125152802, 1, '2016-01-25 15:28:02', '2016-01-25 09:58:02', '1'),
(2, 5620160125152827, 1, '2016-01-25 15:28:27', '2016-01-25 09:58:27', '1'),
(2, 5620160125153018, 1, '2016-01-25 15:30:18', '2016-01-25 10:00:18', '1'),
(2, 8420160125152201, 1, '2016-01-25 15:22:01', '2016-01-25 09:52:01', '1'),
(2, 8920160125152717, 1, '2016-01-25 15:27:17', '2016-01-25 09:57:17', '1'),
(2, 9320160125152228, 1, '2016-01-25 15:22:28', '2016-01-25 09:52:28', '1'),
(2, 9520160125152945, 1, '2016-01-25 15:29:45', '2016-01-25 09:59:45', '1'),
(4, 1720160125153911, 1, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(4, 1820160125152637, 1, '2016-01-25 15:26:37', '2016-01-25 09:56:37', '1'),
(4, 2220160125153103, 1, '2016-01-25 15:31:03', '2016-01-25 10:01:03', '1'),
(4, 3820160125152319, 1, '2016-01-25 15:23:19', '2016-01-25 09:53:19', '1'),
(4, 4120160125152526, 1, '2016-01-25 15:25:26', '2016-01-25 09:55:26', '1'),
(4, 4820160125153111, 1, '2016-01-25 15:31:11', '2016-01-25 10:01:11', '1'),
(4, 5420160125152802, 1, '2016-01-25 15:28:02', '2016-01-25 09:58:02', '1'),
(4, 5620160125152827, 1, '2016-01-25 15:28:27', '2016-01-25 09:58:27', '1'),
(4, 5620160125153018, 1, '2016-01-25 15:30:18', '2016-01-25 10:00:18', '1'),
(4, 8420160125152201, 1, '2016-01-25 15:22:01', '2016-01-25 09:52:01', '1'),
(4, 8920160125152717, 1, '2016-01-25 15:27:17', '2016-01-25 09:57:17', '1'),
(4, 9320160125152228, 1, '2016-01-25 15:22:28', '2016-01-25 09:52:28', '1'),
(4, 9520160125152945, 1, '2016-01-25 15:29:45', '2016-01-25 09:59:45', '1'),
(5, 1720160125153911, 1, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(5, 1820160125152637, 1, '2016-01-25 15:26:37', '2016-01-25 09:56:37', '1'),
(5, 2220160125153103, 1, '2016-01-25 15:31:03', '2016-01-25 10:01:03', '1'),
(5, 3820160125152319, 1, '2016-01-25 15:23:19', '2016-01-25 09:53:19', '1'),
(5, 4120160125152526, 1, '2016-01-25 15:25:26', '2016-01-25 09:55:26', '1'),
(5, 4820160125153111, 1, '2016-01-25 15:31:11', '2016-01-25 10:01:11', '1'),
(5, 5420160125152802, 1, '2016-01-25 15:28:02', '2016-01-25 09:58:02', '1'),
(5, 5620160125152827, 1, '2016-01-25 15:28:27', '2016-01-25 09:58:27', '1'),
(5, 5620160125153018, 1, '2016-01-25 15:30:18', '2016-01-25 10:00:18', '1'),
(5, 8420160125152201, 1, '2016-01-25 15:22:01', '2016-01-25 09:52:01', '1'),
(5, 8920160125152717, 1, '2016-01-25 15:27:17', '2016-01-25 09:57:17', '1'),
(5, 9320160125152228, 1, '2016-01-25 15:22:28', '2016-01-25 09:52:28', '1'),
(5, 9520160125152945, 1, '2016-01-25 15:29:45', '2016-01-25 09:59:45', '1'),
(6, 1820160125152637, 1, '2016-01-25 15:26:37', '2016-01-25 09:56:37', '1'),
(6, 2220160125153103, 1, '2016-01-25 15:31:03', '2016-01-25 10:01:03', '1'),
(6, 3820160125152319, 1, '2016-01-25 15:23:19', '2016-01-25 09:53:19', '1'),
(6, 4120160125152526, 1, '2016-01-25 15:25:26', '2016-01-25 09:55:26', '1'),
(6, 4820160125153111, 1, '2016-01-25 15:31:11', '2016-01-25 10:01:11', '1'),
(6, 5420160125152802, 1, '2016-01-25 15:28:02', '2016-01-25 09:58:02', '1'),
(6, 5620160125152827, 1, '2016-01-25 15:28:27', '2016-01-25 09:58:27', '1'),
(6, 5620160125153018, 1, '2016-01-25 15:30:18', '2016-01-25 10:00:18', '1'),
(6, 8420160125152201, 1, '2016-01-25 15:22:01', '2016-01-25 09:52:01', '1'),
(6, 8920160125152717, 1, '2016-01-25 15:27:17', '2016-01-25 09:57:17', '1'),
(6, 9320160125152228, 1, '2016-01-25 15:22:28', '2016-01-25 09:52:28', '1'),
(6, 9520160125152945, 1, '2016-01-25 15:29:45', '2016-01-25 09:59:45', '1'),
(7, 1820160125152637, 1, '2016-01-25 15:26:37', '2016-01-25 09:56:37', '1'),
(7, 2220160125153103, 1, '2016-01-25 15:31:03', '2016-01-25 10:01:03', '1'),
(7, 3820160125152319, 1, '2016-01-25 15:23:19', '2016-01-25 09:53:19', '1'),
(7, 4120160125152526, 1, '2016-01-25 15:25:26', '2016-01-25 09:55:26', '1'),
(7, 4820160125153111, 1, '2016-01-25 15:31:11', '2016-01-25 10:01:11', '1'),
(7, 5420160125152802, 1, '2016-01-25 15:28:02', '2016-01-25 09:58:02', '1'),
(7, 5620160125152827, 1, '2016-01-25 15:28:27', '2016-01-25 09:58:27', '1'),
(7, 5620160125153018, 1, '2016-01-25 15:30:18', '2016-01-25 10:00:18', '1'),
(7, 8420160125152201, 1, '2016-01-25 15:22:01', '2016-01-25 09:52:01', '1'),
(7, 8920160125152717, 1, '2016-01-25 15:27:17', '2016-01-25 09:57:17', '1'),
(7, 9320160125152228, 1, '2016-01-25 15:22:28', '2016-01-25 09:52:28', '1'),
(7, 9520160125152945, 1, '2016-01-25 15:29:45', '2016-01-25 09:59:45', '1'),
(9, 1820160125152637, 1, '2016-01-25 15:26:37', '2016-01-25 09:56:37', '1'),
(9, 2220160125153103, 1, '2016-01-25 15:31:03', '2016-01-25 10:01:03', '1'),
(9, 3820160125152319, 1, '2016-01-25 15:23:19', '2016-01-25 09:53:19', '1'),
(9, 4120160125152526, 1, '2016-01-25 15:25:26', '2016-01-25 09:55:26', '1'),
(9, 4820160125153111, 1, '2016-01-25 15:31:11', '2016-01-25 10:01:11', '1'),
(9, 5420160125152802, 1, '2016-01-25 15:28:02', '2016-01-25 09:58:02', '1'),
(9, 5620160125152827, 1, '2016-01-25 15:28:27', '2016-01-25 09:58:27', '1'),
(9, 5620160125153018, 1, '2016-01-25 15:30:18', '2016-01-25 10:00:18', '1'),
(9, 8420160125152201, 1, '2016-01-25 15:22:01', '2016-01-25 09:52:01', '1'),
(9, 8920160125152717, 1, '2016-01-25 15:27:17', '2016-01-25 09:57:17', '1'),
(9, 9320160125152228, 1, '2016-01-25 15:22:28', '2016-01-25 09:52:28', '1'),
(9, 9520160125152945, 1, '2016-01-25 15:29:45', '2016-01-25 09:59:45', '1'),
(10, 1720160125153911, 1, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(10, 1820160125152637, 1, '2016-01-25 15:26:37', '2016-01-25 09:56:37', '1'),
(10, 2220160125153103, 1, '2016-01-25 15:31:03', '2016-01-25 10:01:03', '1'),
(10, 3820160125152319, 1, '2016-01-25 15:23:19', '2016-01-25 09:53:19', '1'),
(10, 4120160125152526, 1, '2016-01-25 15:25:26', '2016-01-25 09:55:26', '1'),
(10, 4820160125153111, 1, '2016-01-25 15:31:11', '2016-01-25 10:01:11', '1'),
(10, 5420160125152802, 1, '2016-01-25 15:28:02', '2016-01-25 09:58:02', '1'),
(10, 5620160125152827, 1, '2016-01-25 15:28:27', '2016-01-25 09:58:27', '1'),
(10, 5620160125153018, 1, '2016-01-25 15:30:18', '2016-01-25 10:00:18', '1'),
(10, 8420160125152201, 1, '2016-01-25 15:22:01', '2016-01-25 09:52:01', '1'),
(10, 8920160125152717, 1, '2016-01-25 15:27:17', '2016-01-25 09:57:17', '1'),
(10, 9320160125152228, 1, '2016-01-25 15:22:28', '2016-01-25 09:52:28', '1'),
(10, 9520160125152945, 1, '2016-01-25 15:29:45', '2016-01-25 09:59:45', '1'),
(11, 1720160125153911, 1, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(11, 1820160125152637, 1, '2016-01-25 15:26:37', '2016-01-25 09:56:37', '1'),
(11, 2220160125153103, 1, '2016-01-25 15:31:03', '2016-01-25 10:01:03', '1'),
(11, 3820160125152319, 1, '2016-01-25 15:23:19', '2016-01-25 09:53:19', '1'),
(11, 4120160125152526, 1, '2016-01-25 15:25:26', '2016-01-25 09:55:26', '1'),
(11, 4820160125153111, 1, '2016-01-25 15:31:11', '2016-01-25 10:01:11', '1'),
(11, 5420160125152802, 1, '2016-01-25 15:28:02', '2016-01-25 09:58:02', '1'),
(11, 5620160125152827, 1, '2016-01-25 15:28:27', '2016-01-25 09:58:27', '1'),
(11, 5620160125153018, 1, '2016-01-25 15:30:18', '2016-01-25 10:00:18', '1'),
(11, 8420160125152201, 1, '2016-01-25 15:22:01', '2016-01-25 09:52:01', '1'),
(11, 8920160125152717, 1, '2016-01-25 15:27:17', '2016-01-25 09:57:17', '1'),
(11, 9320160125152228, 1, '2016-01-25 15:22:28', '2016-01-25 09:52:28', '1'),
(11, 9520160125152945, 1, '2016-01-25 15:29:45', '2016-01-25 09:59:45', '1'),
(4720160203110353, 3320160211201304, 1, '2016-02-11 20:13:04', '2016-02-11 14:43:04', '1'),
(4720160203110353, 4620160212143119, 1, '2016-02-12 14:31:19', '2016-02-12 09:01:19', '1'),
(4720160203110353, 4620160212164658, 1, '2016-02-12 16:46:58', '2016-02-12 11:16:58', '1'),
(4720160203110353, 6520160211201105, 1, '2016-02-11 20:11:05', '2016-02-11 14:41:05', '1'),
(4720160203110353, 8620160212143043, 1, '2016-02-12 14:30:43', '2016-02-12 09:00:43', '1'),
(9720160208112139, 1620160212143338, 1, '2016-02-12 14:33:38', '2016-02-12 09:03:38', '1'),
(9720160208112139, 3320160211201304, 1, '2016-02-11 20:13:04', '2016-02-11 14:43:04', '1'),
(9720160208112139, 4420160212143530, 1, '2016-02-12 14:35:30', '2016-02-12 09:05:30', '1'),
(9720160208112139, 4420160212164523, 1, '2016-02-12 16:45:23', '2016-02-12 11:15:23', '1'),
(9720160208112139, 4620160211205732, 1, '2016-02-11 20:57:32', '2016-02-11 15:27:32', '1'),
(9720160208112139, 4620160212143119, 1, '2016-02-12 14:31:19', '2016-02-12 09:01:19', '1'),
(9720160208112139, 4620160212164658, 1, '2016-02-12 16:46:58', '2016-02-12 11:16:58', '1'),
(9720160208112139, 6520160211201105, 1, '2016-02-11 20:11:05', '2016-02-11 14:41:05', '1'),
(9720160208112139, 7820160211205834, 1, '2016-02-11 20:58:34', '2016-02-11 15:28:34', '1'),
(9720160208112139, 8620160212143043, 1, '2016-02-12 14:30:43', '2016-02-12 09:00:43', '1'),
(9720160208112139, 9320160211205332, 1, '2016-02-11 20:53:32', '2016-02-11 15:23:32', '1');

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
(2120160202163812, 'JZEVA12525', 'Coupoun 2', 2, 5, 15000, 'Coupoun 2 Description', '2016-02-12', '2016-02-15', 1, '2016-02-02 16:38:12', '2016-02-10 07:19:24', '1'),
(2420160202163537, 'JZEVA12525', 'COUPON 1', 1, 5, 150052, 'Test Coupon 1', '2016-02-07', '2016-02-27', 1, '2016-02-02 16:35:37', '2016-02-10 07:19:24', '1'),
(2520160208120111, 'JZEVA12525', 'ttt', 2, 5, 500044, 'Testing Again', '2016-02-29', '2016-02-29', 1, '2016-02-08 12:01:11', '2016-02-10 07:19:38', '1'),
(3220160201202856, 'JZEVA12525', 'Dipawali', 0, 1500.25, 1500, 'Testing', '2016-01-25', '2016-03-25', 1, '2016-02-01 20:28:56', '2016-02-10 07:19:24', '1'),
(4820160202162022, 'JZEVA12525', 'New Year Special', 0, 1500.25, 1500, 'Testing', '2016-01-25', '2016-03-25', 1, '2016-02-02 16:20:22', '2016-02-10 07:19:24', '1'),
(6920160202170453, 'JZEVA12525', 'C22', 1, 5, 1500, 'Updated to 25%', '2016-02-06', '2016-02-13', 1, '2016-02-02 17:09:21', '2016-02-10 07:19:37', '1'),
(7220160212111716, 'JZEVA12525', 'rewgerg', 1, 6, 500, 'Test Coupon', '2016-02-12', '2016-02-12', 1, '2016-02-12 11:17:16', '2016-02-12 05:50:00', '1'),
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

--
-- Dumping data for table `tbl_diamond_quality_mapping`
--

INSERT INTO `tbl_diamond_quality_mapping` (`diamond_id`, `id`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(2220160211205732, 1, 1, '2016-02-11 20:57:32', '2016-02-11 15:27:32', '1'),
(2220160211205732, 2, 1, '2016-02-11 20:57:32', '2016-02-11 15:27:32', '1'),
(2920160125153911, 1, 1, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(2920160125153911, 2, 1, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(2920160125153911, 3, 1, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(3820160125153112, 1, 1, '2016-01-25 15:31:12', '2016-01-25 10:01:12', '1'),
(3820160125153112, 2, 1, '2016-01-25 15:31:12', '2016-01-25 10:01:12', '1'),
(3820160125153112, 3, 1, '2016-01-25 15:31:12', '2016-01-25 10:01:12', '1'),
(4720160211205834, 1, 1, '2016-02-11 20:58:34', '2016-02-11 15:28:34', '1'),
(4720160211205834, 2, 1, '2016-02-11 20:58:34', '2016-02-11 15:28:34', '1'),
(7320160211205732, 1, 1, '2016-02-11 20:57:32', '2016-02-11 15:27:32', '1'),
(7320160211205732, 2, 1, '2016-02-11 20:57:32', '2016-02-11 15:27:32', '1'),
(7520160211205330, 2, 1, '2016-02-11 20:53:32', '2016-02-13 06:53:10', '1'),
(7520160211205332, 1, 1, '2016-02-11 20:53:32', '2016-02-11 15:23:32', '1'),
(7720160211205834, 1, 1, '2016-02-11 20:58:34', '2016-02-11 15:28:34', '1'),
(7720160211205834, 2, 1, '2016-02-11 20:58:34', '2016-02-11 15:28:34', '1');

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
(2, 'rose', 'Rose', 1, '2016-01-16 17:34:26', '2016-01-16 12:04:26', 'backend'),
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
-- Table structure for table `tbl_product_diamond_mapping`
--

DROP TABLE IF EXISTS `tbl_product_diamond_mapping`;
CREATE TABLE IF NOT EXISTS `tbl_product_diamond_mapping` (
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

--
-- Dumping data for table `tbl_product_diamond_mapping`
--

INSERT INTO `tbl_product_diamond_mapping` (`productid`, `diamond_id`, `shape`, `carat`, `total_no`, `createdon`, `updatedon`, `updatedby`) VALUES
(1720160125153911, 2920160125153911, 'Emerald', 11, 52, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(4620160211205732, 2220160211205732, 'Princess', 1, 1, '2016-02-11 20:57:32', '2016-02-11 15:27:32', '1'),
(4620160211205732, 7320160211205732, 'Marquise', 1, 1, '2016-02-11 20:57:32', '2016-02-11 15:27:32', '1'),
(4820160125153111, 3820160125153112, 'Round', 0.5, 5, '2016-01-25 15:31:12', '2016-01-25 10:01:12', '1'),
(7820160211205834, 4720160211205834, 'Princess', 1, 1, '2016-02-11 20:58:34', '2016-02-11 15:28:34', '1'),
(9320160211205332, 7520160211205332, 'Princess', 1, 1, '2016-02-11 20:53:32', '2016-02-11 15:23:32', '1'),
(9320160211205332, 7720160211205834, 'Marquise', 1, 1, '2016-02-11 20:58:34', '2016-02-13 06:34:38', '1');

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

--
-- Dumping data for table `tbl_product_gemstone_mapping`
--

INSERT INTO `tbl_product_gemstone_mapping` (`productid`, `gemstone_id`, `gemstone_name`, `total_no`, `carat`, `price_per_carat`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(1720160125153911, 9620160125153911, 'Moonstone', 54, 520, 1525, 1, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(4620160211205732, 7120160211205732, 'Opal', 50, 4, 5, 1, '2016-02-11 20:57:32', '2016-02-11 15:27:32', '1'),
(4620160211205732, 7720160211205732, 'Emerald', 5, 50, 5, 1, '2016-02-11 20:57:32', '2016-02-11 15:27:32', '1'),
(4820160125153111, 4020160125153112, 'Onyx', 1, 100, 10000, 1, '2016-01-25 15:31:12', '2016-01-25 10:01:12', '1'),
(4820160125153111, 4520160125153112, 'Hydro', 2, 10, 5205, 1, '2016-01-25 15:31:12', '2016-01-25 10:01:12', '1'),
(7820160211205834, 7120160211205834, 'Opal', 50, 4, 5, 1, '2016-02-11 20:58:34', '2016-02-11 15:28:34', '1'),
(9320160211205332, 1, 'Emerald', 5, 50, 5, 1, '2016-02-11 20:58:34', '2016-02-13 07:38:51', '1'),
(9320160211205332, 2, 'Opal', 50, 4, 5, 1, '2016-02-11 20:53:32', '2016-02-13 07:39:02', '1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `tbl_product_image_mapping`
--

INSERT INTO `tbl_product_image_mapping` (`product_id`, `id`, `product_image`, `active_flag`, `image_sequence`, `update_date`, `upload_date`) VALUES
(1720160125153911, 1, 'uploads/1720160125153911/1455019498screenshot-localhost2016-02-0116-17-38.jpg', 0, '1', '2016-02-11 12:18:10', '2016-02-09 17:34:58'),
(1720160125153911, 2, 'uploads/1720160125153911/1455019498screenshot-localhost2016-02-0313-08-22.jpg', 0, '2', '2016-02-11 10:33:47', '2016-02-09 17:34:58'),
(1720160125153911, 3, 'uploads/1720160125153911/1455019498screenshot-localhost2016-01-2117-23-43.jpg', 0, '3', '2016-02-11 10:33:51', '2016-02-09 17:34:58'),
(1720160125153911, 4, 'uploads/1720160125153911/1455019498screenshot-localhost2016-02-0117-42-56.jpg', 0, '4', '2016-02-11 10:33:53', '2016-02-09 17:34:58'),
(1720160125153911, 5, 'uploads/1720160125153911/1455019498screenshot-localhost2016-01-2117-23-58.jpg', 0, '5', '2016-02-11 10:33:55', '2016-02-09 17:34:58'),
(4820160125153111, 6, 'uploads/4820160125153111/1455189557p5.png', 0, '1', '2016-02-11 11:19:17', '2016-02-11 16:49:17'),
(4820160125153111, 7, 'uploads/4820160125153111/1455189557p6.png', 0, '1', '2016-02-11 11:19:17', '2016-02-11 16:49:17'),
(4820160125153111, 8, 'uploads/4820160125153111/1455189557p1.png', 0, '1', '2016-02-11 11:19:17', '2016-02-11 16:49:17'),
(4820160125153111, 9, 'uploads/4820160125153111/1455189557p3.png', 0, '1', '2016-02-11 11:19:17', '2016-02-11 16:49:17'),
(4820160125153111, 10, 'uploads/4820160125153111/1455189557p4.png', 0, '1', '2016-02-11 11:19:17', '2016-02-11 16:49:17'),
(4820160125153111, 11, 'uploads/4820160125153111/1455189557p2.png', 0, '1', '2016-02-11 11:19:17', '2016-02-11 16:49:17'),
(4820160125153111, 12, 'uploads/4820160125153111/1455189557p7.png', 0, '2', '2016-02-11 11:19:17', '2016-02-11 16:49:17'),
(4820160125153111, 13, 'uploads/4820160125153111/1455189557p12.png', 0, '3', '2016-02-11 11:19:17', '2016-02-11 16:49:17'),
(4820160125153111, 14, 'uploads/4820160125153111/1455189557p8.png', 0, '3', '2016-02-11 11:19:17', '2016-02-11 16:49:17'),
(4820160125153111, 15, 'uploads/4820160125153111/1455189557p9.png', 0, '3', '2016-02-11 11:19:17', '2016-02-11 16:49:17'),
(4820160125153111, 16, 'uploads/4820160125153111/1455189557p10.png', 0, '3', '2016-02-11 11:19:17', '2016-02-11 16:49:17'),
(4820160125153111, 17, 'uploads/4820160125153111/1455189557p11.png', 0, '4', '2016-02-11 11:19:17', '2016-02-11 16:49:17'),
(7820160211205834, 18, 'uploads/7820160211205834/1455204760p8.png', 0, '1', '2016-02-11 15:32:40', '2016-02-11 21:02:40'),
(7820160211205834, 19, 'uploads/7820160211205834/1455204760p9.png', 0, '1', '2016-02-11 15:32:40', '2016-02-11 21:02:40'),
(7820160211205834, 20, 'uploads/7820160211205834/1455204760p10.png', 0, '2', '2016-02-11 15:32:40', '2016-02-11 21:02:40');

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

--
-- Dumping data for table `tbl_product_master`
--

INSERT INTO `tbl_product_master` (`productid`, `product_code`, `vendorid`, `product_name`, `product_seo_name`, `gender`, `product_weight`, `diamond_setting`, `metal_weight`, `making_charges`, `procurement_cost`, `margin`, `measurement`, `customise_purity`, `customise_color`, `certificate`, `has_diamond`, `has_solitaire`, `has_uncut`, `has_gemstone`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(1620160212143338, 'JZEVA0525604585', 1, 'Testing New', 'Testing New SEO', 1, 15, '', 10, 10000, 150000, 10, '10X20', 0, 0, 'SGL', 0, 0, 0, 0, 1, '2016-02-12 14:33:38', '2016-02-12 09:03:38', '1'),
(1720160125153911, 'JZEVA0525604585', 1, '24K Ring', '24 K Golden Ring', 0, 6, '', 11, 56000, 545454, 5, '41X10', 0, 0, '', 1, 1, 1, 1, 1, '2016-01-25 15:39:11', '2016-02-11 04:56:19', '1'),
(4420160212164523, 'JZEVA0525604585', 1, 'Test', 'Test SEO', 1, 5, 'Prong,Bezel', 1, 1, 100, 51, '10X10', 1, 0, 'SGL', 0, 0, 0, 0, 1, '2016-02-12 16:45:24', '2016-02-12 11:15:24', '1'),
(4620160211205732, 'JZEVA0525604585', 1, 'Test Label 1', 'Test Label SEO', 0, 5, '', 5, 500, 5000, 5, '10X20', 1, 0, 'IGI', 1, 1, 1, 1, 1, '2016-02-11 20:57:32', '2016-02-11 15:27:32', '1'),
(4620160212143119, 'JZEVA0525604585', 1, 'Test Product 1', 'Test Product 1 SEO', 1, 15, '', 10, 15000, 200000, 10, '10X12', 0, 0, 'SGL', 0, 0, 0, 0, 1, '2016-02-12 14:31:20', '2016-02-12 09:01:20', '1'),
(4620160212164658, 'JZEVA0525604585', 4, 'Rajesh', 'Rajesh SEO', 0, 5, 'Prong,Bezel,Pave', 1, 1, 100, 1, '10X10', 0, 0, 'IGI', 0, 0, 0, 0, 1, '2016-02-12 16:46:58', '2016-02-12 11:16:58', '1'),
(4820160125153111, 'JZEVA0525604585', 1, '22K Gold Ring', '22K White Gold Ring', 0, 5, '', 10, 15000, 150000, 5, '10X20', 0, 0, 'SGL', 1, 1, 1, 1, 1, '2016-01-25 15:31:12', '2016-02-10 06:03:10', '1'),
(6520160211201105, 'JZEVA0525604585', 1, 'Test Product 1', 'Test Product 1 SEO', 0, 5, '', 5, 1000, 10000, 0, '10X20', 0, 0, 'IGI', 0, 0, 0, 0, 1, '2016-02-11 20:11:05', '2016-02-11 14:41:05', '1'),
(7820160211205834, 'JZEVA0525604588', 1, 'Test Label 1', 'Test Label SEO', 0, 5, '', 5, 500, 5000, 5, '10X20', 0, 0, 'IGI', 1, 1, 1, 1, 1, '2016-02-11 20:58:34', '2016-02-11 15:32:12', '1'),
(8620160212143043, 'JZEVA0525604585', 1, 'Test Product 1', 'Test Product 1 SEO', 1, 15, '', 10, 15000, 200000, 10, '10X12', 0, 0, 'SGL', 0, 0, 0, 0, 1, '2016-02-12 14:30:44', '2016-02-12 09:00:44', '1'),
(9320160211205332, 'JZEVA0525604585', 1, '22K Gold Ring', '22K Office wear Golden Ring', 2, 5, 'Prong,Bezel,Pave', 5, 500, 5000, 5, '10X20', 0, 0, 'IGI', 1, 1, 1, 1, 1, '2016-02-11 20:53:32', '2016-02-13 05:25:16', '1');

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

--
-- Dumping data for table `tbl_product_metal_color_mapping`
--

INSERT INTO `tbl_product_metal_color_mapping` (`productid`, `id`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(1620160212143338, 1, 1, '2016-02-12 14:33:38', '2016-02-12 09:03:38', '1'),
(1620160212143338, 2, 1, '2016-02-12 14:33:38', '2016-02-12 09:03:38', '1'),
(1720160125153911, 1, 1, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(1720160125153911, 2, 1, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(1720160125153911, 3, 1, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(2220160125153103, 1, 1, '2016-01-25 15:31:03', '2016-01-25 10:01:03', '1'),
(2220160125153103, 2, 1, '2016-01-25 15:31:03', '2016-01-25 10:01:03', '1'),
(3320160211201304, 1, 1, '2016-02-11 20:13:04', '2016-02-11 14:43:04', '1'),
(3320160211201304, 2, 1, '2016-02-11 20:13:04', '2016-02-11 14:43:04', '1'),
(4420160212143530, 1, 1, '2016-02-12 14:35:30', '2016-02-12 09:05:30', '1'),
(4420160212143530, 2, 1, '2016-02-12 14:35:30', '2016-02-12 09:05:30', '1'),
(4420160212164523, 1, 1, '2016-02-12 16:45:24', '2016-02-12 11:15:24', '1'),
(4420160212164523, 2, 1, '2016-02-12 16:45:24', '2016-02-12 11:15:24', '1'),
(4620160211205732, 1, 1, '2016-02-11 20:57:32', '2016-02-11 15:27:32', '1'),
(4620160211205732, 2, 1, '2016-02-11 20:57:32', '2016-02-11 15:27:32', '1'),
(4620160212143119, 1, 1, '2016-02-12 14:31:20', '2016-02-12 09:01:20', '1'),
(4620160212143119, 2, 1, '2016-02-12 14:31:20', '2016-02-12 09:01:20', '1'),
(4620160212164658, 1, 1, '2016-02-12 16:46:58', '2016-02-12 11:16:58', '1'),
(4620160212164658, 2, 1, '2016-02-12 16:46:58', '2016-02-12 11:16:58', '1'),
(4820160125153111, 1, 1, '2016-01-25 15:31:11', '2016-01-25 10:01:11', '1'),
(4820160125153111, 2, 1, '2016-01-25 15:31:11', '2016-01-25 10:01:11', '1'),
(6520160211201105, 1, 1, '2016-02-11 20:11:05', '2016-02-11 14:41:05', '1'),
(6520160211201105, 2, 1, '2016-02-11 20:11:05', '2016-02-11 14:41:05', '1'),
(7820160211205834, 1, 1, '2016-02-11 20:58:34', '2016-02-11 15:28:34', '1'),
(7820160211205834, 2, 1, '2016-02-11 20:58:34', '2016-02-11 15:28:34', '1'),
(8620160212143043, 1, 1, '2016-02-12 14:30:44', '2016-02-12 09:00:44', '1'),
(8620160212143043, 2, 1, '2016-02-12 14:30:44', '2016-02-12 09:00:44', '1'),
(9320160211205332, 1, 1, '2016-02-13 10:57:01', '2016-02-13 05:27:01', 'backend'),
(9320160211205332, 2, 1, '2016-02-11 20:53:32', '2016-02-11 15:23:32', '1');

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

--
-- Dumping data for table `tbl_product_metal_purity_mapping`
--

INSERT INTO `tbl_product_metal_purity_mapping` (`productid`, `id`, `createdon`, `updatedon`, `updatedby`) VALUES
(1620160212143338, 1, '2016-02-12 14:33:38', '2016-02-12 09:03:38', '1'),
(1620160212143338, 2, '2016-02-12 14:33:38', '2016-02-12 09:03:38', '1'),
(1720160125153911, 1, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(1720160125153911, 2, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(1720160125153911, 5, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(2220160125153103, 1, '2016-01-25 15:31:03', '2016-01-25 10:01:03', '1'),
(2220160125153103, 2, '2016-01-25 15:31:03', '2016-01-25 10:01:03', '1'),
(2220160125153103, 5, '2016-01-25 15:31:03', '2016-01-25 10:01:03', '1'),
(3320160211201304, 1, '2016-02-11 20:13:04', '2016-02-11 14:43:04', '1'),
(3320160211201304, 2, '2016-02-11 20:13:04', '2016-02-11 14:43:04', '1'),
(4420160212143530, 1, '2016-02-12 14:35:30', '2016-02-12 09:05:30', '1'),
(4420160212143530, 2, '2016-02-12 14:35:30', '2016-02-12 09:05:30', '1'),
(4420160212164523, 2, '2016-02-12 16:45:24', '2016-02-12 11:15:24', '1'),
(4620160211205732, 3, '2016-02-11 20:57:32', '2016-02-11 15:27:32', '1'),
(4620160212143119, 1, '2016-02-12 14:31:20', '2016-02-12 09:01:20', '1'),
(4620160212143119, 2, '2016-02-12 14:31:20', '2016-02-12 09:01:20', '1'),
(4620160212164658, 1, '2016-02-12 16:46:58', '2016-02-12 11:16:58', '1'),
(4620160212164658, 2, '2016-02-12 16:46:58', '2016-02-12 11:16:58', '1'),
(4820160125153111, 1, '2016-01-25 15:31:11', '2016-01-25 10:01:11', '1'),
(4820160125153111, 2, '2016-01-25 15:31:11', '2016-01-25 10:01:11', '1'),
(4820160125153111, 5, '2016-01-25 15:31:11', '2016-01-25 10:01:11', '1'),
(5420160125152802, 1, '2016-01-25 15:28:02', '2016-01-25 09:58:02', '1'),
(5420160125152802, 2, '2016-01-25 15:28:02', '2016-01-25 09:58:02', '1'),
(5420160125152802, 5, '2016-01-25 15:28:02', '2016-01-25 09:58:02', '1'),
(5620160125152827, 1, '2016-01-25 15:28:27', '2016-01-25 09:58:27', '1'),
(5620160125152827, 2, '2016-01-25 15:28:27', '2016-01-25 09:58:27', '1'),
(5620160125152827, 5, '2016-01-25 15:28:27', '2016-01-25 09:58:27', '1'),
(5620160125153018, 1, '2016-01-25 15:30:18', '2016-01-25 10:00:18', '1'),
(5620160125153018, 2, '2016-01-25 15:30:18', '2016-01-25 10:00:18', '1'),
(5620160125153018, 5, '2016-01-25 15:30:18', '2016-01-25 10:00:18', '1'),
(6520160211201105, 1, '2016-02-11 20:11:05', '2016-02-11 14:41:05', '1'),
(6520160211201105, 2, '2016-02-11 20:11:05', '2016-02-11 14:41:05', '1'),
(7820160211205834, 3, '2016-02-11 20:58:34', '2016-02-11 15:28:34', '1'),
(8620160212143043, 1, '2016-02-12 14:30:44', '2016-02-12 09:00:44', '1'),
(8620160212143043, 2, '2016-02-12 14:30:44', '2016-02-12 09:00:44', '1'),
(9320160211205332, 1, '2016-02-13 10:49:11', '2016-02-13 05:19:11', 'backend'),
(9320160211205332, 2, '2016-02-11 20:53:32', '2016-02-11 15:23:32', '1'),
(9320160211205332, 3, '2016-02-13 10:49:21', '2016-02-13 05:19:21', 'backend'),
(9320160211205332, 4, '2016-02-13 10:49:26', '2016-02-13 05:19:26', 'backend'),
(9520160125152945, 1, '2016-01-25 15:29:45', '2016-01-25 09:59:45', '1'),
(9520160125152945, 2, '2016-01-25 15:29:45', '2016-01-25 09:59:45', '1'),
(9520160125152945, 5, '2016-01-25 15:29:45', '2016-01-25 09:59:45', '1');

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

--
-- Dumping data for table `tbl_product_size_mapping`
--

INSERT INTO `tbl_product_size_mapping` (`productid`, `size_id`, `quantity`, `createdon`, `updatedon`, `updatedby`) VALUES
(1620160212143338, 1, 10, '2016-02-12 14:33:38', '2016-02-12 09:03:38', '1'),
(1620160212143338, 2, 10, '2016-02-12 14:33:38', '2016-02-12 09:03:38', '1'),
(1720160125153911, 1, 1, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(1720160125153911, 2, 21, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(1720160125153911, 3, 33, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(1720160125153911, 4, 44, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(1820160125152637, 1, 10, '2016-01-25 15:26:37', '2016-01-25 09:56:37', '1'),
(1820160125152637, 2, 10, '2016-01-25 15:26:37', '2016-01-25 09:56:37', '1'),
(1820160125152637, 3, 10, '2016-01-25 15:26:37', '2016-01-25 09:56:37', '1'),
(1820160125152637, 4, 20, '2016-01-25 15:26:37', '2016-01-25 09:56:37', '1'),
(2220160125153103, 1, 10, '2016-01-25 15:31:03', '2016-01-25 10:01:03', '1'),
(2220160125153103, 2, 10, '2016-01-25 15:31:03', '2016-01-25 10:01:03', '1'),
(2220160125153103, 3, 10, '2016-01-25 15:31:03', '2016-01-25 10:01:03', '1'),
(2220160125153103, 4, 20, '2016-01-25 15:31:03', '2016-01-25 10:01:03', '1'),
(3320160211201304, 1, 10, '2016-02-11 20:13:04', '2016-02-11 14:43:04', '1'),
(3320160211201304, 2, 20, '2016-02-11 20:13:04', '2016-02-11 14:43:04', '1'),
(3320160211201304, 3, 20, '2016-02-11 20:13:04', '2016-02-11 14:43:04', '1'),
(3820160125152319, 1, 10, '2016-01-25 15:23:19', '2016-01-25 09:53:19', '1'),
(3820160125152319, 2, 10, '2016-01-25 15:23:19', '2016-01-25 09:53:19', '1'),
(3820160125152319, 3, 10, '2016-01-25 15:23:19', '2016-01-25 09:53:19', '1'),
(3820160125152319, 4, 20, '2016-01-25 15:23:19', '2016-01-25 09:53:19', '1'),
(4120160125152526, 1, 10, '2016-01-25 15:25:26', '2016-01-25 09:55:26', '1'),
(4120160125152526, 2, 10, '2016-01-25 15:25:26', '2016-01-25 09:55:26', '1'),
(4120160125152526, 3, 10, '2016-01-25 15:25:26', '2016-01-25 09:55:26', '1'),
(4120160125152526, 4, 20, '2016-01-25 15:25:26', '2016-01-25 09:55:26', '1'),
(4420160212143530, 1, 10, '2016-02-12 14:35:30', '2016-02-12 09:05:30', '1'),
(4420160212143530, 2, 10, '2016-02-12 14:35:30', '2016-02-12 09:05:30', '1'),
(4420160212164523, 1, 10, '2016-02-12 16:45:23', '2016-02-12 11:15:23', '1'),
(4420160212164523, 2, 10, '2016-02-12 16:45:23', '2016-02-12 11:15:23', '1'),
(4620160211205732, 1, 50, '2016-02-11 20:57:32', '2016-02-11 15:27:32', '1'),
(4620160211205732, 2, 50, '2016-02-11 20:57:32', '2016-02-11 15:27:32', '1'),
(4620160211205732, 3, 50, '2016-02-11 20:57:32', '2016-02-11 15:27:32', '1'),
(4620160212143119, 1, 10, '2016-02-12 14:31:20', '2016-02-12 09:01:20', '1'),
(4620160212143119, 2, 15, '2016-02-12 14:31:20', '2016-02-12 09:01:20', '1'),
(4620160212164658, 1, 10, '2016-02-12 16:46:58', '2016-02-12 11:16:58', '1'),
(4620160212164658, 2, 20, '2016-02-12 16:46:58', '2016-02-12 11:16:58', '1'),
(4820160125153111, 1, 10, '2016-01-25 15:31:11', '2016-01-25 10:01:11', '1'),
(4820160125153111, 2, 10, '2016-01-25 15:31:11', '2016-01-25 10:01:11', '1'),
(4820160125153111, 3, 10, '2016-01-25 15:31:11', '2016-01-25 10:01:11', '1'),
(4820160125153111, 4, 20, '2016-01-25 15:31:11', '2016-01-25 10:01:11', '1'),
(5420160125152802, 1, 10, '2016-01-25 15:28:02', '2016-01-25 09:58:02', '1'),
(5420160125152802, 2, 10, '2016-01-25 15:28:02', '2016-01-25 09:58:02', '1'),
(5420160125152802, 3, 10, '2016-01-25 15:28:02', '2016-01-25 09:58:02', '1'),
(5420160125152802, 4, 20, '2016-01-25 15:28:02', '2016-01-25 09:58:02', '1'),
(5620160125152827, 1, 10, '2016-01-25 15:28:27', '2016-01-25 09:58:27', '1'),
(5620160125152827, 2, 10, '2016-01-25 15:28:27', '2016-01-25 09:58:27', '1'),
(5620160125152827, 3, 10, '2016-01-25 15:28:27', '2016-01-25 09:58:27', '1'),
(5620160125152827, 4, 20, '2016-01-25 15:28:27', '2016-01-25 09:58:27', '1'),
(5620160125153018, 1, 10, '2016-01-25 15:30:18', '2016-01-25 10:00:18', '1'),
(5620160125153018, 2, 10, '2016-01-25 15:30:18', '2016-01-25 10:00:18', '1'),
(5620160125153018, 3, 10, '2016-01-25 15:30:18', '2016-01-25 10:00:18', '1'),
(5620160125153018, 4, 20, '2016-01-25 15:30:18', '2016-01-25 10:00:18', '1'),
(6520160211201105, 1, 10, '2016-02-11 20:11:05', '2016-02-11 14:41:05', '1'),
(6520160211201105, 2, 20, '2016-02-11 20:11:05', '2016-02-11 14:41:05', '1'),
(6520160211201105, 3, 20, '2016-02-11 20:11:05', '2016-02-11 14:41:05', '1'),
(7820160211205834, 1, 50, '2016-02-11 20:58:34', '2016-02-11 15:28:34', '1'),
(7820160211205834, 2, 50, '2016-02-11 20:58:34', '2016-02-11 15:28:34', '1'),
(7820160211205834, 3, 50, '2016-02-11 20:58:34', '2016-02-11 15:28:34', '1'),
(8620160212143043, 1, 10, '2016-02-12 14:30:44', '2016-02-12 09:00:44', '1'),
(8620160212143043, 2, 15, '2016-02-12 14:30:44', '2016-02-12 09:00:44', '1'),
(8920160125152717, 1, 10, '2016-01-25 15:27:17', '2016-01-25 09:57:17', '1'),
(8920160125152717, 2, 10, '2016-01-25 15:27:17', '2016-01-25 09:57:17', '1'),
(8920160125152717, 3, 10, '2016-01-25 15:27:17', '2016-01-25 09:57:17', '1'),
(8920160125152717, 4, 20, '2016-01-25 15:27:17', '2016-01-25 09:57:17', '1'),
(9320160125152228, 1, 10, '2016-01-25 15:22:28', '2016-01-25 09:52:28', '1'),
(9320160125152228, 2, 10, '2016-01-25 15:22:28', '2016-01-25 09:52:28', '1'),
(9320160125152228, 3, 10, '2016-01-25 15:22:28', '2016-01-25 09:52:28', '1'),
(9320160125152228, 4, 20, '2016-01-25 15:22:28', '2016-01-25 09:52:28', '1'),
(9320160211205332, 1, 50, '2016-02-11 20:53:32', '2016-02-11 15:23:32', '1'),
(9320160211205332, 2, 50, '2016-02-11 20:53:32', '2016-02-11 15:23:32', '1'),
(9320160211205332, 5, 10, '2016-02-11 20:53:32', '2016-02-13 05:46:08', '1'),
(9520160125152945, 1, 10, '2016-01-25 15:29:45', '2016-01-25 09:59:45', '1'),
(9520160125152945, 2, 10, '2016-01-25 15:29:45', '2016-01-25 09:59:45', '1'),
(9520160125152945, 3, 10, '2016-01-25 15:29:45', '2016-01-25 09:59:45', '1'),
(9520160125152945, 4, 20, '2016-01-25 15:29:45', '2016-01-25 09:59:45', '1');

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
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Not Active, 1 - Active',
  `createdon` datetime DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`productid`,`solitaire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_solitaire_mapping`
--

INSERT INTO `tbl_product_solitaire_mapping` (`productid`, `solitaire_id`, `shape`, `color`, `clarity`, `cut`, `symmetry`, `polish`, `fluorescence`, `carat`, `price_per_carat`, `table_no`, `crown_angle`, `girdle`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(1720160125153911, 5820160125153911, 'Emerald', 'E', 'IF', 'Excellent', 'Excellent', 'Very Good', 'None', 1, 111, '56', '66', '52.55', 1, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(4620160211205732, 2520160211205732, 'Round', 'F', 'VVS2', 'Very Good', 'Very Good', 'Very Good', 'Medium', 1, 1, '1', '1', '1', 1, '2016-02-11 20:57:32', '2016-02-11 15:27:32', '1'),
(4620160211205732, 5420160211205732, 'Round', 'F', 'VVS2', 'Very Good', 'Very Good', 'Very Good', 'Faint', 1, 120, '101', '12', '1.2', 1, '2016-02-11 20:57:32', '2016-02-11 15:27:32', '1'),
(4820160125153111, 4620160125153111, 'Emerald', 'D', 'IF', 'Excellent', 'Excellent', 'Excellent', 'Faint', 1, 5000, '10', '52', '21', 1, '2016-01-25 15:31:11', '2016-01-25 10:01:11', '1'),
(9320160211205332, 5820160211205834, 'Heart', 'F', 'VVS2', 'Very Good', 'Very Good', 'Very Good', 'Medium', 1, 1, '1', '1', '1', 1, '2016-02-11 20:58:34', '2016-02-13 06:18:28', '1'),
(9320160211205332, 6220160211205332, 'Round', 'F', 'VVS2', 'Very Good', 'Very Good', 'Very Good', 'Medium', 1, 1, '1', '1', '1', 1, '2016-02-11 20:53:32', '2016-02-11 15:23:32', '1'),
(9320160211205332, 8320160211205834, 'Round', 'F', 'VVS2', 'Very Good', 'Very Good', 'Very Good', 'Faint', 1, 120, '101', '12', '1.2', 1, '2016-02-11 20:58:34', '2016-02-13 06:17:25', '1');

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
(1720160125153911, 2420160125153911, 'D,E,F,G', 'IF', 5, 1, 1111, 1, '2016-01-25 15:39:11', '2016-01-25 10:09:11', '1'),
(4620160211205732, 2220160211205732, 'G,H,I,J', 'SI1', 205, 12, 2200, 1, '2016-02-11 20:57:32', '2016-02-11 15:27:32', '1'),
(4620160211205732, 3420160211205732, 'F', 'VVS1', 5, 1, 1, 1, '2016-02-11 20:57:32', '2016-02-11 15:27:32', '1'),
(4620160211205732, 9620160211205732, 'F,G,I', 'VVS1', 5, 1, 11, 1, '2016-02-11 20:57:32', '2016-02-11 15:27:32', '1'),
(4820160125153111, 4920160125153112, 'Array', 'VVS1', 5, 0.5, 1000, 1, '2016-01-25 15:31:12', '2016-01-25 10:01:12', '1'),
(7820160211205834, 3320160211205834, 'F,G,I', 'VVS1', 5, 1, 11, 1, '2016-02-11 20:58:34', '2016-02-11 15:28:34', '1'),
(7820160211205834, 7020160211205834, 'F', 'VVS1', 5, 1, 1, 1, '2016-02-11 20:58:34', '2016-02-11 15:28:34', '1'),
(9320160211205332, 2020160211205834, 'G,H,I,J', 'SI1', 205, 12, 2200, 1, '2016-02-11 20:58:34', '2016-02-13 07:12:59', '1'),
(9320160211205332, 8620160211205332, 'F', 'VVS1', 5, 1, 1, 1, '2016-02-11 20:53:32', '2016-02-11 15:23:32', '1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `tbl_size_master`
--

INSERT INTO `tbl_size_master` (`id`, `name`, `size_value`, `catid`, `active_flag`, `createdon`, `updatedon`, `updatedby`) VALUES
(1, NULL, '4.0', 2, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(2, NULL, '4.5', 2, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(3, NULL, '5.0', 2, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(4, NULL, '5.5', 2, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(5, NULL, '6.0', 2, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(6, NULL, '6.5', 2, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(7, NULL, '7.0', 2, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(8, NULL, '7.5', 2, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(9, NULL, '8.0', 2, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(10, NULL, '8.5', 2, 1, '2016-01-16 17:45:59', '2016-01-20 15:05:21', 'backend'),
(11, NULL, '9.0', 2, 1, '2016-01-16 17:46:00', '2016-01-20 15:05:21', 'backend'),
(12, NULL, '9.5', 2, 1, '2016-01-16 17:46:00', '2016-01-20 15:05:21', 'backend'),
(13, NULL, '10.0', 2, 1, '2016-01-16 17:46:00', '2016-01-20 15:05:21', 'backend'),
(14, NULL, '10.5', 2, 1, '2016-01-16 17:46:00', '2016-01-20 15:05:21', 'backend'),
(15, NULL, '11.0', 2, 1, '2016-01-16 17:46:00', '2016-01-20 15:05:21', 'backend'),
(16, NULL, '11.5', 2, 1, '2016-01-16 17:46:00', '2016-01-20 15:05:21', 'backend'),
(17, NULL, '12.0', 2, 1, '2016-01-16 17:46:00', '2016-01-20 15:05:21', 'backend'),
(18, NULL, '12.5', 2, 1, '2016-01-16 17:46:00', '2016-01-20 15:05:21', 'backend'),
(19, NULL, '13.0', 2, 1, '2016-01-16 17:46:00', '2016-01-20 15:05:21', 'backend'),
(20, NULL, '13.5', 2, 1, '2016-01-16 17:46:00', '2016-01-20 15:05:21', 'backend'),
(21, NULL, '14.0', 2, 1, '2016-01-16 17:46:00', '2016-01-20 15:05:21', 'backend'),
(22, NULL, '14.5', 2, 1, '2016-01-16 17:46:00', '2016-01-20 15:05:21', 'backend'),
(23, NULL, '15.0', 2, 1, '2016-01-16 17:46:00', '2016-01-20 15:05:21', 'backend'),
(24, NULL, '15.5', 2, 1, '2016-01-16 17:46:00', '2016-01-20 15:05:21', 'backend'),
(25, NULL, '16.0', 2, 1, '2016-01-16 17:46:00', '2016-01-20 15:05:21', 'backend');

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
