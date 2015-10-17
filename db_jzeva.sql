-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2015 at 03:18 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jzeva`
--
CREATE DATABASE IF NOT EXISTS `db_jzeva` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_jzeva`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_addressid_generator`
--

CREATE TABLE IF NOT EXISTS `tbl_addressid_generator` (
  `address_id` bigint(20) NOT NULL COMMENT 'random id generator',
  `user_id` bigint(20) NOT NULL COMMENT 'user logged in mobile',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and time on which it was created',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was last updated'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_addressid_generator`
--

INSERT INTO `tbl_addressid_generator` (`address_id`, `user_id`, `date_time`, `update_time`) VALUES
(1, 10105, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address_master`
--

CREATE TABLE IF NOT EXISTS `tbl_address_master` (
  `address_id` bigint(20) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_title` int(11) NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `full_address` text NOT NULL,
  `area` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `state` varchar(250) NOT NULL,
  `pincode` int(6) NOT NULL,
  `country` varchar(250) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and time on',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'timestamp on which it was last updated',
  `active_flag` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_address_master`
--

INSERT INTO `tbl_address_master` (`address_id`, `user_id`, `address_title`, `address1`, `address2`, `full_address`, `area`, `city`, `state`, `pincode`, `country`, `date_time`, `update_time`, `active_flag`) VALUES
(1, 10105, 0, '1', 'singharun@gmail.com', '1990 10 08', '9696969696', '223232', 'Delhi', 221212, 'india', '2015-10-05 18:40:59', '2015-10-05 13:10:59', 1),
(1, 10105, 0, '1', 'singharun@gmail.com', '1990 10 08', '9696969696', '223232', 'Delhi', 221212, 'india', '2015-10-05 18:41:43', '2015-10-05 13:11:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attribute_category_mapping`
--

CREATE TABLE IF NOT EXISTS `tbl_attribute_category_mapping` (
  `category_id` int(11) NOT NULL,
  `attribute_id` int(4) unsigned NOT NULL,
  `attribute_display_flag` tinyint(4) DEFAULT NULL,
  `attribute_display_position` int(11) DEFAULT '999',
  `attribute_filter_flag` tinyint(4) DEFAULT NULL,
  `attribute_filter_position` int(11) DEFAULT '999',
  `active_flag` tinyint(4) DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and time on which it was created',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was last updated'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_attribute_category_mapping`
--

INSERT INTO `tbl_attribute_category_mapping` (`category_id`, `attribute_id`, `attribute_display_flag`, `attribute_display_position`, `attribute_filter_flag`, `attribute_filter_position`, `active_flag`, `date_time`, `update_time`) VALUES
(2, 100012, 1, 999, 1, 999, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 43, 1, 999, 1, 999, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 100014, 111, 999, 1, 999, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1, 43, 1, 999, 1, 999, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attribute_master`
--

CREATE TABLE IF NOT EXISTS `tbl_attribute_master` (
  `attribute_id` int(4) unsigned NOT NULL,
  `attribute_name` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `attribute_display_name` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `attribute_unit` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `attribute_type_flag` tinyint(4) DEFAULT NULL COMMENT '1-Text Only | 2-Textarea | 3-Numeric | 4-Decimal | 5-DropDown | 6 Date | 7-Checkbox | 8-RadioBtn | 9-Use Pre Defined List',
  `attribute_unit_position` tinyint(4) DEFAULT '0' COMMENT '0-prefix 1-postfix',
  `attribute_values` varchar(250) CHARACTER SET utf8 NOT NULL COMMENT 'list of all possible values separated by |~|',
  `attribute_range` text CHARACTER SET utf8 COMMENT 'range of numric value it can attain LB and UB separated by |~|',
  `use_list` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `active_flag` bit(1) DEFAULT b'1',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and time on which it was created ',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was last updated'
) ENGINE=MyISAM AUTO_INCREMENT=100023 DEFAULT CHARSET=latin1 COMMENT='Table Attribute Master';

--
-- Dumping data for table `tbl_attribute_master`
--

INSERT INTO `tbl_attribute_master` (`attribute_id`, `attribute_name`, `attribute_display_name`, `attribute_unit`, `attribute_type_flag`, `attribute_unit_position`, `attribute_values`, `attribute_range`, `use_list`, `active_flag`, `date_time`, `update_time`) VALUES
(43, 'flurocent', 'luminous', '10', 1, 0, '{10,20,30,40,50,60,70}', '10', NULL, b'1', '0000-00-00 00:00:00', '2015-10-15 09:15:47'),
(100013, 'tone', 'metal tone', '10', 1, 2, '{10,20,30,40,50,60,70}', '1', NULL, b'1', '0000-00-00 00:00:00', '2015-10-15 09:15:47'),
(100014, 'type', 'product type', '2', 1, 1, '{10,20,30,40,50,60,70}', '10', NULL, b'1', '0000-00-00 00:00:00', '2015-10-15 09:15:47'),
(100015, 'size', 'product size', '10', 1, 2, '{10,20,30,40,50,60,70}', '1', NULL, b'1', '0000-00-00 00:00:00', '2015-10-15 09:15:47'),
(100016, 'purity', 'gold purity', '10', 1, 2, '{10,20,30,40,50,60,70}', '10', NULL, b'1', '0000-00-00 00:00:00', '2015-10-15 09:15:47'),
(100017, 'purity', 'purity', '', 1, 0, '', '10', NULL, b'1', '0000-00-00 00:00:00', '2015-10-15 09:15:47'),
(100018, 'metal', 'metal', '', 1, 0, '', '10', NULL, b'1', '0000-00-00 00:00:00', '2015-10-15 09:15:47'),
(100019, 'metal_wt', 'metal_weight', '', 1, 0, '', '10', NULL, b'1', '0000-00-00 00:00:00', '2015-10-15 09:15:47'),
(100020, 'shape', 'shape', '', 1, 0, '', '10', NULL, b'1', '0000-00-00 00:00:00', '2015-10-15 09:15:47'),
(100021, 'flurocent', 'luminous', '10', 1, 2, '{10,20,30,40,50,60,70}', '10', NULL, b'1', '0000-00-00 00:00:00', '2015-10-15 09:15:47'),
(100022, 'flurocent', 'luminous', '10', 1, 2, '{10,20,30,40,50,60,70}', '10', NULL, b'1', '0000-00-00 00:00:00', '2015-10-15 09:15:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_available_autosuggest_lists`
--

CREATE TABLE IF NOT EXISTS `tbl_available_autosuggest_lists` (
  `id` bigint(20) unsigned NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `display_name` varchar(250) DEFAULT NULL,
  `active_flag` tinyint(2) NOT NULL DEFAULT '1',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time on which it was created.',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'timestamp on which it was last updated',
  `updated_by` varchar(100) NOT NULL DEFAULT 'CMS_USER'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brandid_generator`
--

CREATE TABLE IF NOT EXISTS `tbl_brandid_generator` (
  `id` bigint(20) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `category_name` varchar(255) NOT NULL DEFAULT '',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and time on created',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was last updated',
  `active_flag` tinyint(2) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=100023 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brandid_generator`
--

INSERT INTO `tbl_brandid_generator` (`id`, `name`, `category_name`, `date_time`, `update_time`, `active_flag`) VALUES
(100009, '', '', '0000-00-00 00:00:00', '2015-10-05 07:01:18', 0),
(100011, 'orra', '', '0000-00-00 00:00:00', '2015-10-05 07:01:18', 0),
(100012, 'Jewel', '', '0000-00-00 00:00:00', '2015-10-05 07:01:18', 0),
(100013, 'panauche', '', '0000-00-00 00:00:00', '2015-10-05 07:01:18', 0),
(100014, 'pae', '', '0000-00-00 00:00:00', '2015-10-05 07:01:18', 0),
(100015, 'erwewpae', '', '0000-00-00 00:00:00', '2015-10-05 07:01:18', 0),
(100019, 'sefafaf', 'Glasses', '0000-00-00 00:00:00', '2015-10-05 07:01:18', 0),
(100020, 'aaaaaa', 'Glasses', '0000-00-00 00:00:00', '2015-10-05 07:01:18', 0),
(100021, 'aaa', 'Glasses', '0000-00-00 00:00:00', '2015-10-05 07:01:18', 0),
(100022, 'qqq', 'Glasses', '0000-00-00 00:00:00', '2015-10-05 07:01:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cartid_generator`
--

CREATE TABLE IF NOT EXISTS `tbl_cartid_generator` (
  `id` bigint(20) NOT NULL,
  `cart_id` varchar(20) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and time on which it was created',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was last updated',
  `active_flag` tinyint(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cartid_generator`
--

INSERT INTO `tbl_cartid_generator` (`id`, `cart_id`, `user_id`, `date_time`, `update_time`, `active_flag`) VALUES
(7, 'P3E6U7I7', 9975887206, '2015-09-23 22:29:44', '2015-09-23 16:59:44', 1),
(8, 'F6A3Y0I4', 8878767576, '2015-09-23 22:45:17', '2015-09-23 17:15:17', 1),
(12, 'N1K5N1E1', 7878787878, '2015-09-25 10:36:10', '2015-09-25 05:06:10', 1),
(13, 'O5P2Z3T9', 8878787878, '2015-09-25 10:39:09', '2015-09-25 05:09:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categoryid_generator`
--

CREATE TABLE IF NOT EXISTS `tbl_categoryid_generator` (
  `category_id` bigint(20) unsigned NOT NULL,
  `category_name` varchar(255) NOT NULL DEFAULT '',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and time on which it was created',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was updated',
  `active_flag` tinyint(2) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10008 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_categoryid_generator`
--

INSERT INTO `tbl_categoryid_generator` (`category_id`, `category_name`, `date_time`, `update_time`, `active_flag`) VALUES
(10000, 'Fashion & Accessories', '0000-00-00 00:00:00', '2015-10-05 06:57:23', 0),
(10001, 'Glasses', '0000-00-00 00:00:00', '2015-10-05 06:57:23', 0),
(10002, 'Sunglasses', '0000-00-00 00:00:00', '2015-10-05 06:57:23', 0),
(10003, 'Eyeglasses', '0000-00-00 00:00:00', '2015-10-05 06:57:23', 0),
(10004, 'Contact Lenses', '0000-00-00 00:00:00', '2015-10-05 06:57:23', 0),
(10005, 'Entertainment', '0000-00-00 00:00:00', '2015-10-05 06:57:23', 0),
(10006, 'Events', '0000-00-00 00:00:00', '2015-10-05 06:57:23', 0),
(10007, 'Diamond', '0000-00-00 00:00:00', '2015-10-05 06:57:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_master`
--

CREATE TABLE IF NOT EXISTS `tbl_category_master` (
  `category_id` bigint(20) NOT NULL,
  `parent_category_id` bigint(20) DEFAULT '0' COMMENT 'parent category id',
  `category_name` varchar(255) DEFAULT NULL COMMENT 'category name specifi',
  `category_level` tinyint(4) DEFAULT '0' COMMENT 'category depth level',
  `lineage` text COMMENT 'lineage hierarchy',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time on which it was created.',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'timestamp on which it was last updated',
  `updated_by` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city_master`
--

CREATE TABLE IF NOT EXISTS `tbl_city_master` (
  `cityid` bigint(20) unsigned NOT NULL COMMENT 'city identity',
  `cityname` varchar(250) CHARACTER SET utf8 NOT NULL,
  `state_name` varchar(250) NOT NULL,
  `country_name` varchar(250) NOT NULL,
  `lng` decimal(17,15) NOT NULL,
  `lat` decimal(17,15) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time on which it was created.',
  `updatedby` varchar(100) NOT NULL COMMENT 'CMS USER',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'timestamp on which it was last updated.',
  `active_flag` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1-Active | 0-Inactive'
) ENGINE=MyISAM AUTO_INCREMENT=1095 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_city_master`
--

INSERT INTO `tbl_city_master` (`cityid`, `cityname`, `state_name`, `country_name`, `lng`, `lat`, `date_time`, `updatedby`, `update_time`, `active_flag`) VALUES
(1, 'Abinashpur', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(2, 'Abohar', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(3, 'Abu Road', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(4, 'Adampur', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(5, 'Adilabad', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(6, 'Adoni', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(7, 'Adoor', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(8, 'Agartala', 'Tripura', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(9, 'Agra', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(10, 'Ahmedabad', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(11, 'Ahmednagar', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(12, 'Aigali', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(13, 'Aizawl', 'Mizoram', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(14, 'Ajmer', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(15, 'Akkalkot', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(16, 'Akola', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(17, 'Alampur', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(18, 'Alangudi', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(19, 'Alappuzha', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(20, 'Alibaug', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(21, 'Aligarh', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(22, 'Alirajpur', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(23, 'Allahabad', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(24, 'Almora', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(25, 'Alwar', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(26, 'Amalapuram', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(27, 'Ambad', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(28, 'Ambala', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(29, 'Ambasa', 'Tripura', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(30, 'Ambedkar Nagar', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(31, 'Ambikapur', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(32, 'Amboli', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(33, 'Ambur', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(34, 'Amerigog', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(35, 'Amingad', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(36, 'Amla', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(37, 'Ammasandra', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(38, 'Amravati', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(39, 'Amreli', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(40, 'Amritsar', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(41, 'Anakapalle', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(42, 'Anand', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(43, 'Anantapur', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(44, 'Anantnag', 'Jammu And Kashmir', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(45, 'Anavatti', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(46, 'Angul', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(47, 'Ankleshwar', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(48, 'Ankola', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(49, 'Anuppur', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(50, 'Arakkonam', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(51, 'Arambagh', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(52, 'Arani', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(53, 'Araria', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(54, 'Aravakurichi', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(55, 'Arcot', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(56, 'Ariyalur', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(57, 'Armoor', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(58, 'Arrah', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(59, 'Aruppukottai', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(60, 'Arwal', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(61, 'Asansol', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(62, 'Ashoknagar', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(63, 'Asifabad', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(64, 'Aska', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(65, 'Aswaraopet', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(66, 'Athamallick', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(67, 'Atmakur', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(68, 'Attili', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(69, 'Aundipatti', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(70, 'Auraiya', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(71, 'Aurangabad-Bihar', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(72, 'Aurangabad-Maharashtra', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(73, 'Avanashi', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(74, 'Ayodhya', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(75, 'Azamgarh', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(76, 'Badamalhera', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(77, 'Badrinath', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(78, 'Bagalkot', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(79, 'Bageshwar', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(80, 'Baghpat', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(81, 'Bagnapara', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(82, 'Bahadurgarh', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(83, 'Bahraich', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(84, 'Bahula', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(85, 'Baikunthpur', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(86, 'Bakshirhat', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(87, 'Balaghat', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(88, 'Balangir', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(89, 'Balasore', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(90, 'Balikuda', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(91, 'Ballia', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(92, 'Balrampur', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(93, 'Banaskantha', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(94, 'Banda', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(95, 'Bangalore', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(96, 'Bangarpet', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(97, 'Banka', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(98, 'Bankikodla', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(99, 'Bankura', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(100, 'Banswara', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(101, 'Bapatla', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(102, 'Bara Jaguli', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(103, 'Barabanki', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(104, 'Barakar', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(105, 'Baramati', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(106, 'Baramulla', 'Jammu And Kashmir', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(107, 'Baran', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(108, 'Baraut', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(109, 'Barbil', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(110, 'Bardhaman', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(111, 'Bareilly', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(112, 'Bargarh', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(113, 'Barhi', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(114, 'Baripada', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(115, 'Barkot', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(116, 'Barmer', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(117, 'Barnala', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(118, 'Barpeta', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(119, 'Barwani', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(120, 'Basirhat', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(121, 'Bastar', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(122, 'Basti', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(123, 'Batala', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(124, 'Beed', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(125, 'Begusarai', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(126, 'Belekeri', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(127, 'Belgaum', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(128, 'Bellad Bagewadi', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(129, 'Bellampally', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(130, 'Bellary', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(131, 'Belthangady', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(132, 'Berhampore-West Bengal', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(133, 'Berhampur-Orrisa', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(134, 'Bettiah', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(135, 'Betul', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(136, 'Bhadohi', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(137, 'Bhadrachalam', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(138, 'Bhadrak', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(139, 'Bhagalpur', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(140, 'Bhandara', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(141, 'Bhandardara', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(142, 'Bharatpur', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(143, 'Bharuch', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(144, 'Bhatinda', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(145, 'Bhatkal', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(146, 'Bhavani', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(147, 'Bhavnagar', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(148, 'Bhawanipatna', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(149, 'Bhigwan', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(150, 'Bhilai', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(151, 'Bhilwara', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(152, 'Bhimavaram', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(153, 'Bhind', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(154, 'Bhiwadi', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(155, 'Bhiwani', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(156, 'Bhojpur', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(157, 'Bhokardan', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(158, 'Bhopal', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(159, 'Bhor', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(160, 'Bhubaneshwar', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(161, 'Bhuj', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(162, 'Bhusawal', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(163, 'Bidar', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(164, 'Bijapur-Chhattisgarh', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(165, 'Bijapur-Karnataka', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(166, 'Bijni', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(167, 'Bijnor', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(168, 'Bikaner', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(169, 'Bilashipara', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(170, 'Bilaspur-Chhattisgarh', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(171, 'Bilaspur-Himachal Pradesh', 'Himachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(172, 'Biramaharajpur', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(173, 'Birbhum', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(174, 'Birpara', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(175, 'Bishnupur', 'Manipur', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(176, 'Bobbili', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(177, 'Bodhan', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(178, 'Bodhgaya', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(179, 'Bokaro', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(180, 'Bolpur', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(181, 'Bongaigaon', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(182, 'Boudh', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(183, 'Budaun', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(184, 'Budgam', 'Jammu And Kashmir', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(185, 'Bulandshahr', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(186, 'Buldhana', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(187, 'Bundi', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(188, 'Burhanpur', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(189, 'Burla-Orrisa', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(190, 'Burnihat', 'Meghalaya', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(191, 'Burnpur', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(192, 'Buxar', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(193, 'Chaibasa', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(194, 'Chakdah', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(195, 'Chakradharpur', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(196, 'Chamarajanagar', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(197, 'Chamba', 'Himachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(198, 'Chamoli', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(199, 'Champawat', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(200, 'Champhai', 'Mizoram', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(201, 'Chandauli', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(202, 'Chandel', 'Manipur', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(203, 'Chandigarh', 'Chandigarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(204, 'Chandragiri', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(205, 'Chandrapur', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(206, 'Changlang', 'Arunachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(207, 'Channapatna', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(208, 'Chapra', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(209, 'Chas', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(210, 'Chatra', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(211, 'Chengalpattu', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(212, 'Chengam', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(213, 'Chennai', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(214, 'Chhatarpur', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(215, 'Chhindwara', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(216, 'Chickballapur', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(217, 'Chidambaram', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(218, 'Chikhaldara', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(219, 'Chikmagalur', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(220, 'Chilakaluripeta', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(221, 'Chintalapudi', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(222, 'Chintamani', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(223, 'Chirala', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(224, 'Chirkunda', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(225, 'Chitradurga', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(226, 'Chitrakoot-Mp', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(227, 'Chitrakoot-UP', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(228, 'Chittaranjan', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(229, 'Chittoor', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(230, 'Chittorgarh', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(231, 'Chomu', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(232, 'Churachandpur', 'Manipur', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(233, 'Churu', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(234, 'Churu', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(235, 'Coimbatore', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(236, 'Contai', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(237, 'Cooch Behar', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(238, 'Coonoor', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(239, 'Coorg', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(240, 'Cuddalore', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(241, 'Cumbum', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(242, 'Cuttack', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(243, 'Daang', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(244, 'Dahod', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(245, 'Dakshina Kannada', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(246, 'Dalhousie', 'Himachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(247, 'Dallirajhara', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(248, 'Daltanganj', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(249, 'Daman', 'Daman & Diu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(250, 'Daman', 'Daman And Diu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(251, 'Damanjori', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(252, 'Damoh', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(253, 'Dandeli', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(254, 'Dantewada', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(255, 'Dapoli', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(256, 'Darbhanga', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(257, 'Darjeeling', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(258, 'Darrang', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(259, 'Darsi', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(260, 'Datia', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(261, 'Daund', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(262, 'Dausa', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(263, 'Davangere', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(264, 'Debagarh', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(265, 'Dehradun', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(266, 'Delhi', 'Delhi', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(267, 'Deoghar-Jharkhand', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(268, 'Deoria', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(269, 'Devakottai', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(270, 'Devarapalli', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(271, 'Dewas', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(272, 'Dhalai', 'Tripura', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(273, 'Dhamtari', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(274, 'Dhanbad', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(275, 'Dhanmandal', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(276, 'Dhar', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(277, 'Dharamshala', 'Himachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(278, 'Dharapuram', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(279, 'Dharmanagar', 'Tripura', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(280, 'Dharmapuri', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(281, 'Dharmavaram', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(282, 'Dharwad', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(283, 'Dhemaji', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(284, 'Dhenkanal', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(285, 'Dholpur', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(286, 'Dhone', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(287, 'Dhubri', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(288, 'Dhule', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(289, 'Dhupguri', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(290, 'Dibang Valley', 'Arunachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(291, 'Dibrugarh', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(292, 'Digboi', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(293, 'Digha', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(294, 'Dimapur', 'Nagaland', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(295, 'Dinajpur', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(296, 'Dindigul', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(297, 'Dindori', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(298, 'Dinhata', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(299, 'Diphu', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(300, 'Diu', 'Daman And Diu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(301, 'Diveagar', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(302, 'Dumka', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(303, 'Dungarpur', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(304, 'Dunguripali', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(305, 'Durg', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(306, 'Durgapur', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(307, 'Dwarka-Gujarat', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(308, 'East Champaran', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(309, 'East Garo Hills', 'Meghalaya', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(310, 'East Godavari', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(311, 'East Kameng', 'Arunachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(312, 'East Khasi Hills', 'Meghalaya', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(313, 'East Siang', 'Arunachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(314, 'East Singhbhum', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(315, 'Egra', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(316, 'Eluru', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(317, 'Ernakulam', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(318, 'Erode', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(319, 'Etah', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(320, 'Etawah', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(321, 'Faizabad', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(322, 'Falakata', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(323, 'Faridabad', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(324, 'Faridkot', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(325, 'Farrukhabad', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(326, 'Fatehabad-Haryana', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(327, 'Fatehabad-Uttar Pradesh', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(328, 'Fatehgarh Sahib', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(329, 'Fatehpur-Uttar Pradesh', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(330, 'Ferozepur', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(331, 'Firozabad', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(332, 'Gadag', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(333, 'Gadchiroli', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(334, 'Gadwal', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(335, 'Gajapati', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(336, 'Gandhidham', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(337, 'Gandhinagar-Gujarat', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(338, 'Gangotri', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(339, 'Gangtok', 'Sikkim', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(340, 'Ganjam', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(341, 'Ganpatipule', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(342, 'Garhmukteshwar', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(343, 'Garhwa', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(344, 'Gaya', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(345, 'Geyzing', 'Sikkim', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(346, 'Ghatshila', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(347, 'Ghaziabad', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(348, 'Ghazipur', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(349, 'Giddalur', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(350, 'Gingee', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(351, 'Ginigera', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(352, 'Giridih', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(353, 'Goa', 'Goa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(354, 'Goalpara', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(355, 'Gobichettipalayam', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1);
INSERT INTO `tbl_city_master` (`cityid`, `cityname`, `state_name`, `country_name`, `lng`, `lat`, `date_time`, `updatedby`, `update_time`, `active_flag`) VALUES
(356, 'Godavarikhani', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(357, 'Godda', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(358, 'Golaghat', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(359, 'Gonda', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(360, 'Gondia', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(361, 'Gooty', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(362, 'Gopalganj', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(363, 'Gopalpur', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(364, 'Gorakhpur', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(365, 'Gudalur', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(366, 'Gudivada', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(367, 'Gudiyattam', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(368, 'Gudur', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(369, 'Guhagar', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(370, 'Gulbarga', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(371, 'Gumla', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(372, 'Guna', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(373, 'Guntakal', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(374, 'Guntur', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(375, 'Guntur', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(376, 'Gurdaspur', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(377, 'Gurgaon', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(378, 'Guwahati', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(379, 'Gwalior', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(380, 'Haflong', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(381, 'Haiborgaon', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(382, 'Hailakandi', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(383, 'Hajipur', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(384, 'Haldia', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(385, 'Haldwani', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(386, 'Haliyal', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(387, 'Hamirpur-Himachal Pradesh', 'Himachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(388, 'Hamirpur-Uttar Pradesh', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(389, 'Hanumangarh', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(390, 'Hapur', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(391, 'Harda', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(392, 'Hardoi', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(393, 'Haridwar', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(394, 'Harur', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(395, 'Hassan', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(396, 'Hathras', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(397, 'Haveri', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(398, 'Hazaribagh', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(399, 'Heggarni', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(400, 'Herur', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(401, 'Himatnagar', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(402, 'Hindaun', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(403, 'Hindupur', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(404, 'Hingoli', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(405, 'Hirehally', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(406, 'Hissar', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(407, 'Holealur', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(408, 'Honavar', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(409, 'Honnali', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(410, 'Hooghly', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(411, 'Horanadu', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(412, 'Hosaritti', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(413, 'Hoshangabad', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(414, 'Hoshiarpur', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(415, 'Hospet', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(416, 'Hosur', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(417, 'Howrah', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(418, 'Hubli', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(419, 'Huzurabad', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(420, 'Huzurnagar', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(421, 'Hyderabad', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(422, 'Ichalkaranji', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(423, 'Idukki', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(424, 'Imphal', 'Manipur', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(425, 'Indapur', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(426, 'Indore', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(427, 'Islampur', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(428, 'Itanagar', 'Arunachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(429, 'Itarsi', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(430, 'Jabalpur', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(431, 'Jagatsinghapur', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(432, 'Jagdalpur', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(433, 'Jaintia Hills', 'Meghalaya', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(434, 'Jaipur', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(435, 'Jaipur', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(436, 'Jaisalmer', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(437, 'Jajpur', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(438, 'Jalan Nagar', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(439, 'Jalandhar', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(440, 'Jalaun', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(441, 'Jalgaon', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(442, 'Jalna', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(443, 'Jalore', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(444, 'Jalpaiguri', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(445, 'Jammalamadugu', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(446, 'Jammikunta', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(447, 'Jammu', 'Jammu And Kashmir', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(448, 'Jamnagar', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(449, 'Jamshedpur', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(450, 'Jamtara', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(451, 'Jamui', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(452, 'Jangaon', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(453, 'Jangareddygudem', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(454, 'Janjgir Champa', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(455, 'Janmane', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(456, 'Jashpur', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(457, 'Jaunpur', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(458, 'Jawali', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(459, 'Jehanabad', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(460, 'Jejuri', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(461, 'Jeypore', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(462, 'Jhabua', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(463, 'Jhajjar', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(464, 'Jhalawar', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(465, 'Jhanjharpur', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(466, 'Jhansi', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(467, 'Jharsuguda', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(468, 'Jhumritelaiya', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(469, 'Jhunjhunu', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(470, 'Jind', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(471, 'Jnanaganga', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(472, 'Jodhpur', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(473, 'Jodumarga', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(474, 'Jog Falls', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(475, 'Jorhat', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(476, 'Jowai', 'Meghalaya', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(477, 'Junagadh', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(478, 'Jyotiba Phule Nagar', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(479, 'Kadapa', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(480, 'Kadirganj', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(481, 'Kadiri', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(482, 'Kaiga', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(483, 'Kaikalur', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(484, 'Kaimara', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(485, 'Kaimur', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(486, 'Kaithal', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(487, 'Kakinada', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(488, 'Kalahandi', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(489, 'Kalain', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(490, 'Kalimpong', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(491, 'Kalka', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(492, 'Kallakurichi', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(493, 'Kalna', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(494, 'Kalyandurg', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(495, 'Kalyani', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(496, 'Kamareddy', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(497, 'Kamrup', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(498, 'Kanchipuram', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(499, 'Kandhamal', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(500, 'Kandi', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(501, 'Kandukur', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(502, 'Kangayam', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(503, 'Kangra', 'Himachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(504, 'Kanigiri', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(505, 'Kanker', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(506, 'Kankroli', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(507, 'Kannauj', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(508, 'Kannur', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(509, 'Kanpur', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(510, 'Kanyakumari', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(511, 'Kapurthala', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(512, 'Karaikal', 'Pondicherry', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(513, 'Karaikudi', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(514, 'Karanjia', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(515, 'Karauli', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(516, 'Kargil', 'Jammu And Kashmir', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(517, 'Karimganj', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(518, 'Karimnagar', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(519, 'Karnal', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(520, 'Karur', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(521, 'Karwar', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(522, 'Kasaragod', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(523, 'Kasganj', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(524, 'Kashipur', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(525, 'Kathua', 'Jammu & Kashmir', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(526, 'Kathua', 'Jammu And Kashmir', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(527, 'Katihar', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(528, 'Katni', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(529, 'Katpadi', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(530, 'Katra', 'Jammu And Kashmir', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(531, 'Katwa', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(532, 'Kaushambi', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(533, 'Kavali', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(534, 'Kawalgundi', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(535, 'Kawardha', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(536, 'Kedarnath', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(537, 'Kemmanagundi', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(538, 'Kendrapara', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(539, 'Kenduadihi', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(540, 'Keonjhar', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(541, 'Keonjhargarh', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(542, 'Khagaria', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(543, 'Khajuraho', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(544, 'Khammam', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(545, 'Khandala', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(546, 'Khandwa', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(547, 'Khanna', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(548, 'Kharagpur', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(549, 'Khargone', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(550, 'Kharupetia', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(551, 'Khawzawl', 'Mizoram', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(552, 'Kheda', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(553, 'Khurda', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(554, 'Kinnaur', 'Himachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(555, 'Kiphire', 'Nagaland', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(556, 'Kishanganj', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(557, 'Kodaikanal', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(558, 'Koderma', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(559, 'Kohima', 'Nagaland', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(560, 'Koilwar', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(561, 'Kokrajhar', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(562, 'Kolar', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(563, 'Kolasib', 'Mizoram', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(564, 'Kolhapur', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(565, 'Kolkata', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(566, 'Kollam', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(567, 'Konark', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(568, 'Kondagaon', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(569, 'Kopargaon', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(570, 'Koppa', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(571, 'Koppal', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(572, 'Koraput', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(573, 'Koratagere', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(574, 'Koratla', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(575, 'Korba', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(576, 'Korea', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(577, 'Kosi Kalan', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(578, 'Kota-Rajasthan', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(579, 'Kotkapura', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(580, 'Kottayam', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(581, 'Kovalam', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(582, 'Kovilpatti', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(583, 'Koyyalagudem', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(584, 'Kozhikode', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(585, 'Krishna', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(586, 'Krishnagiri', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(587, 'Kullu', 'Himachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(588, 'Kumarakom', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(589, 'Kumbakonam', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(590, 'Kumbanadu', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(591, 'Kumta', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(592, 'Kundli', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(593, 'Kupwara', 'Jammu And Kashmir', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(594, 'Kurhani', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(595, 'Kurnool', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(596, 'Kurukshetra', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(597, 'Kurung Kumey', 'Arunachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(598, 'Kushinagar', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(599, 'Kutch', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(600, 'Laheriasarai', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(601, 'Lakhimpur', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(602, 'Lakhimpur Kheri', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(603, 'Lakhisarai', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(604, 'Lakshadweep', 'Lakshadweep', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(605, 'Lakshettipet', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(606, 'Lalitpur', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(607, 'Latehar', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(608, 'Latur', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(609, 'Lawngtlai', 'Mizoram', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(610, 'Leh Ladakh', 'Jammu And Kashmir', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(611, 'Lohardaga', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(612, 'Lohit', 'Arunachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(613, 'Lonavala', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(614, 'Longleng', 'Nagaland', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(615, 'Lower Chandmari', 'Meghalaya', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(616, 'Lower Subansiri', 'Arunachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(617, 'Lucknow', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(618, 'Ludhiana', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(619, 'Lunglei', 'Mizoram', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(620, 'Machilipatnam', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(621, 'Madakasira', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(622, 'Madanapalle', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(623, 'Madangeri', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(624, 'Madhepura', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(625, 'Madhubani', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(626, 'Madurai', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(627, 'Mahabaleshwar', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(628, 'Mahabalipuram', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(629, 'Mahabubnagar', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(630, 'Maharajganj', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(631, 'Mahasamund', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(632, 'Mahbubabad', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(633, 'Mahe', 'Pondicherry', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(634, 'Mahendergarh', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(635, 'Mahoba', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(636, 'Mainpuri', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(637, 'Malappuram', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(638, 'Malda', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(639, 'Malegaon', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(640, 'Malgi', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(641, 'Malkangiri', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(642, 'Malvan', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(643, 'Mammit', 'Mizoram', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(644, 'Manali', 'Himachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(645, 'Mancherial', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(646, 'Mandamarri', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(647, 'Mandi', 'Himachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(648, 'Mandla', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(649, 'Mandsaur', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(650, 'Mandvi', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(651, 'Mandya', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(652, 'Manendragarh', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(653, 'Mangalagiri', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(654, 'Mangaldai', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(655, 'Mangalore', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(656, 'Mangan', 'Sikkim', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(657, 'Mannargudi', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(658, 'Mansa', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(659, 'Mantripukhri', 'Manipur', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(660, 'Manuguru', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(661, 'Maralur', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(662, 'Matheran', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(663, 'Mathura', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(664, 'Mau', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(665, 'Mayiladuthurai', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(666, 'Mayurbhanj', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(667, 'Mecheda', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(668, 'Medak', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(669, 'Meerut', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(670, 'Megamalai', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(671, 'Mehsana', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(672, 'Melchhamunda', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(673, 'Melkote', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(674, 'Melmaruvathur', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(675, 'Mettur', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(676, 'Midnapore', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(677, 'Mihijam', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(678, 'Mirik', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(679, 'Mirzapur', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(680, 'Moga', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(681, 'Mohali', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(682, 'Mokokchung', 'Nagaland', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(683, 'Mon', 'Nagaland', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(684, 'Moradabad', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(685, 'Morbi', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(686, 'Morena', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(687, 'Morigaon', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(688, 'Motihari', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(689, 'Mount Abu', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(690, 'Mudalgi', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(691, 'Mudigubba', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(692, 'Muktsar', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(693, 'Mumbai', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(694, 'Mundgod', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(695, 'Mundra', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(696, 'Munger', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(697, 'Munnar', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(698, 'Murshidabad', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(699, 'Murud', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(700, 'Mussoorie', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(701, 'Muzaffarnagar', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(702, 'Muzaffarpur', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(703, 'Mysore', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(704, 'Nabarangpur', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(705, 'Nabha', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(706, 'Nadia', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(707, 'Nadiad', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(708, 'Nagaon', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(709, 'Nagapattinam', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(710, 'Nagaur', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(711, 'Nagercoil', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1);
INSERT INTO `tbl_city_master` (`cityid`, `cityname`, `state_name`, `country_name`, `lng`, `lat`, `date_time`, `updatedby`, `update_time`, `active_flag`) VALUES
(712, 'Nagpur', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(713, 'Nainital', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(714, 'Nalanda', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(715, 'Nalbari', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(716, 'Nalco Nagar', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(717, 'Nalgonda', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(718, 'Namakkal', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(719, 'Namchi', 'Sikkim', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(720, 'Nandangadda', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(721, 'Nanded', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(722, 'Nandurbar', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(723, 'Nandyal', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(724, 'Narayangaon', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(725, 'Narayanpatna', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(726, 'Narayanpur', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(727, 'Narmada', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(728, 'Narnaul', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(729, 'Narsampet', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(730, 'Narsinghpur', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(731, 'Nashik', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(732, 'Nathdwara', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(733, 'Nathnagar', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(734, 'Navi Mumbai', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(735, 'Navsari', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(736, 'Nawada', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(737, 'Nawalgarh', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(738, 'Nawanshahr', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(739, 'Nayagarh', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(740, 'Nazira', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(741, 'Neemuch', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(742, 'Nellore', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(743, 'Nerli', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(744, 'Neyveli', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(745, 'Nidasoshi', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(746, 'Nilgiri', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(747, 'Nira', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(748, 'Nirmal', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(749, 'Nizamabad', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(750, 'Noida', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(751, 'North 24 Parganas', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(752, 'North Cachar Hills', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(753, 'North Lakhimpur', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(754, 'North Tripura', 'Tripura', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(755, 'Nowgong', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(756, 'Nuapada', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(757, 'Omkareshwar', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(758, 'Ongole', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(759, 'Ooty', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(760, 'Orai', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(761, 'Osmanabad', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(762, 'Pachmarhi', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(763, 'Padrauna', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(764, 'Paithan', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(765, 'Pakaur', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(766, 'Palakkad', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(767, 'Palamu', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(768, 'Palani', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(769, 'Palanpur', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(770, 'Pali-Maharashtra', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(771, 'Pali-Rajasthan', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(772, 'Palvancha', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(773, 'Palwal', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(774, 'Panchgani', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(775, 'Panchkula', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(776, 'Panchmahal', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(777, 'Pandharpur', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(778, 'Panhala', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(779, 'Panipat', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(780, 'Panna', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(781, 'Panruti', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(782, 'Panskura', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(783, 'Paonta Sahib', 'Himachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(784, 'Papanasam', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(785, 'Paradip', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(786, 'Paramakudi', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(787, 'Paramathi', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(788, 'Parbhani', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(789, 'Parli Vaijnath', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(790, 'Parulia', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(791, 'Parwanoo', 'Himachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(792, 'Patan-Gujarat', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(793, 'Pathanamthitta', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(794, 'Pathankot', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(795, 'Patiala', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(796, 'Patna', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(797, 'Pattamundai', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(798, 'Pattukottai', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(799, 'Pauri', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(800, 'Perambalur', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(801, 'Peren', 'Nagaland', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(802, 'Perundurai', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(803, 'Phagwara', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(804, 'Phek', 'Nagaland', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(805, 'Pilibhit', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(806, 'Pithoragarh', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(807, 'Pollachi', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(808, 'Pondicherry', 'Pondicherry', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(809, 'Porbandar', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(810, 'Port Blair', 'Andaman And Nicobar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(811, 'Prakasam', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(812, 'Pratapgarh-Rajasthan', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(813, 'Pratapgarh-Uttar Pradesh', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(814, 'Proddatur', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(815, 'Pudukkottai', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(816, 'Pulivendula', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(817, 'Pulwama', 'Jammu And Kashmir', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(818, 'Pundibari', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(819, 'Pune', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(820, 'Puri', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(821, 'Purnia', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(822, 'Purulia', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(823, 'Pushkar', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(824, 'Puttur', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(825, 'Puttur', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(826, 'Radhakishorepur', 'Tripura', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(827, 'Raebareli', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(828, 'Raghunathganj', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(829, 'Raichur', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(830, 'Raigad', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(831, 'Raigad-Maharashtra', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(832, 'Raiganj', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(833, 'Raigarh', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(834, 'Raigarh-Chhattisgarh', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(835, 'Raipur-Chhattisgarh', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(836, 'Raisen', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(837, 'Rajahmundry', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(838, 'Rajam', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(839, 'Rajgangpur', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(840, 'Rajgarh', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(841, 'Rajgir', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(842, 'Rajkot', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(843, 'Rajnandgaon', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(844, 'Rajouri', 'Jammu And Kashmir', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(845, 'Rajpipla', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(846, 'Rajpura', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(847, 'Rajsamand', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(848, 'Ramagundam', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(849, 'Ramanagara', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(850, 'Ramanathapuram', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(851, 'Rameswaram', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(852, 'Ramgarh-Jharkhand', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(853, 'Ramgarh-Jharkhand', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(854, 'Rampur', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(855, 'Ranaghat', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(856, 'Ranchi', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(857, 'Ranchi', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(858, 'Rangareddy', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(859, 'Rangia', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(860, 'Rangpo', 'Sikkim', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(861, 'Raniganj', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(862, 'Ranikhet', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(863, 'Ranipet', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(864, 'Rasipuram', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(865, 'Ratlam', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(866, 'Ratnagiri', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(867, 'Ravangla', 'Sikkim', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(868, 'Ravulapalem', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(869, 'Rayachoti', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(870, 'Rayagada', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(871, 'Repalle', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(872, 'Rewa', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(873, 'Rewari', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(874, 'Rishikesh', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(875, 'Rohtak', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(876, 'Rohtas', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(877, 'Roorkee', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(878, 'Ropar', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(879, 'Rourkela', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(880, 'Rudraprayag', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(881, 'Rudrapur', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(882, 'Sabarkantha', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(883, 'Sagar', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(884, 'Saharanpur', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(885, 'Saharsa', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(886, 'Sahibganj', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(887, 'Saiha', 'Mizoram', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(888, 'Sainthia', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(889, 'Sairang', 'Mizoram', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(890, 'Sakti', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(891, 'Salem', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(892, 'Samastipur', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(893, 'Sambalpur', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(894, 'Sanand', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(895, 'Sanchi', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(896, 'Sangareddy', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(897, 'Sangli', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(898, 'Sangrur', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(899, 'Sant Kabir Nagar', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(900, 'Sant Ravidas Nagar', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(901, 'Santipur', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(902, 'Saran', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(903, 'Sasaram', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(904, 'Saswad', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(905, 'Satara', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(906, 'Satna', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(907, 'Saundatti', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(908, 'Sawai Madhopur', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(909, 'Seegur', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(910, 'Sehore', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(911, 'Senapati', 'Manipur', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(912, 'Sendhwa', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(913, 'Seoni', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(914, 'Seraikela Kharsawan', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(915, 'Serchhip', 'Mizoram', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(916, 'Shahdol', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(917, 'Shahjahanpur', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(918, 'Shajapur', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(919, 'Sheikhpura', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(920, 'Shencottah', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(921, 'Sheohar', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(922, 'Sheopur', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(923, 'Shillong', 'Meghalaya', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(924, 'Shimla', 'Himachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(925, 'Shimoga', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(926, 'Shirali', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(927, 'Shirdi', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(928, 'Shirguppi', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(929, 'Shivpuri', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(930, 'Shravanabelagola', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(931, 'Shrirampur', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(932, 'Shrivardhan', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(933, 'Shriwada', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(934, 'Sibsagar', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(935, 'Siddapur', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(936, 'Siddipet', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(937, 'Sidhart Nagar', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(938, 'Sidhi', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(939, 'Sikar', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(940, 'Silchar', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(941, 'Siliguri', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(942, 'Silvassa', 'Dadra Nager Haveli', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(943, 'Simdega', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(944, 'Sindhudurg', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(945, 'Singrauli', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(946, 'Sirmaur', 'Himachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(947, 'Sirohi', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(948, 'Sirsa-Haryana', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(949, 'Sirsi', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(950, 'Sitamarhi', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(951, 'Sitapur', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(952, 'Sitbankura', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(953, 'Sivaganga', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(954, 'Sivakasi', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(955, 'Siwan', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(956, 'Sojat', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(957, 'Solan', 'Himachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(958, 'Solapur', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(959, 'Sonbhadra', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(960, 'Sonepat', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(961, 'Sonepur', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(962, 'Sonitpur', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(963, 'South 24 Parganas', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(964, 'South Garo Hills', 'Meghalaya', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(965, 'South Tripura', 'Tripura', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(966, 'Spiti', 'Himachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(967, 'Sravasti', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(968, 'Sri Ganganagar-Rajasthan', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(969, 'Srikakulam', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(970, 'Srikalahasti', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(971, 'Srinagar', 'Jammu And Kashmir', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(972, 'Srisailam', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(973, 'Srivilliputtur', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(974, 'Sultanpur', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(975, 'Sundargarh', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(976, 'Supaul', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(977, 'Surat', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(978, 'Surendra Nagar-Gujarat', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(979, 'Surguja', 'Chhattisgarh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(980, 'Suryapet', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(981, 'Tadepalligudem', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(982, 'Tadipatri', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(983, 'Talaja', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(984, 'Talcher', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(985, 'Tamenglong', 'Manipur', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(986, 'Tamluk', 'West Bengal', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(987, 'Tandur', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(988, 'Tanuku', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(989, 'Tarn Taran', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(990, 'Tawang', 'Arunachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(991, 'Teghra', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(992, 'Tehri Garhwal', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(993, 'Tenali', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(994, 'Tenkasi', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(995, 'Thalassery', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(996, 'Thane', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(997, 'Thanjavur', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(998, 'Theni', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(999, 'Thirthahalli', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1000, 'Thiruvalla', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1001, 'Thiruvananthapuram', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1002, 'Thoothukudi', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1003, 'Thoubal', 'Manipur', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1004, 'Thrissur', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1005, 'Tigadi-Belgaum', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1006, 'Tikamgarh', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1007, 'Tindivanam', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1008, 'Tinsukia', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1009, 'Tirap', 'Arunachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1010, 'Tiruchendur', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1011, 'Tiruchengode', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1012, 'Tirunelveli', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1013, 'Tirupati', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1014, 'Tirupur', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1015, 'Tiruttani', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1016, 'Tiruvallur', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1017, 'Tiruvannamalai', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1018, 'Tiruvarur', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1019, 'Titabor', 'Assam', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1020, 'Tonk', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1021, 'Trichy', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1022, 'Tuensang', 'Nagaland', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1023, 'Tumkur', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1024, 'Tuni', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1025, 'Tura', 'Meghalaya', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1026, 'Udaipur-Rajasthan', 'Rajasthan', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1027, 'Udham Singh Nagar', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1028, 'Udhampur', 'Jammu And Kashmir', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1029, 'Udumalpet', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1030, 'Udupi', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1031, 'Ujjain', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1032, 'Ukhrul', 'Manipur', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1033, 'Ulunda', 'Orissa', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1034, 'Umariya', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1035, 'UNA', 'Himachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1036, 'Unnao', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1037, 'Upper Subansiri', 'Arunachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1038, 'Uravakonda', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1039, 'Uttara Kannada', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1040, 'Uttarkashi', 'Uttarakhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1041, 'Vadakara', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1042, 'Vadodara', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1043, 'Vaishali', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1044, 'Valparai', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1045, 'Valsad', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1046, 'Vaniyambadi', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1047, 'Vapi', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1048, 'Varanasi', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1049, 'Varvand', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1050, 'Vayalpad', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1051, 'Velankanni', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1052, 'Velhe', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1053, 'Vellore', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1054, 'Veraval', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1055, 'Vidisha', 'Madhya Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1056, 'Vijapur', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1057, 'Vijayawada', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1058, 'Villupuram', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1059, 'Virudhunagar', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1060, 'Visakhapatnam', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1061, 'Visnagar', 'Gujarat', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1062, 'Vizianagaram', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1063, 'Vriddhachalam', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1064, 'Vrindavan', 'Uttar Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1);
INSERT INTO `tbl_city_master` (`cityid`, `cityname`, `state_name`, `country_name`, `lng`, `lat`, `date_time`, `updatedby`, `update_time`, `active_flag`) VALUES
(1065, 'Vuyyuru', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1066, 'Walchandnagar', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1067, 'Warangal', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1068, 'Wardha', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1069, 'Washim', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1070, 'Wayanad', 'Kerala', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1071, 'West Champaran', 'Bihar', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1072, 'West Garo Hills', 'Meghalaya', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1073, 'West Godavari', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1074, 'West Kameng', 'Arunachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1075, 'West Khasi Hills', 'Meghalaya', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1076, 'West Siang', 'Arunachal Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1077, 'West Singhbhum', 'Jharkhand', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1078, 'West Tripura', 'Tripura', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1079, 'Wokha', 'Nagaland', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1080, 'Yadgir', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1081, 'Yamunanagar', 'Haryana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1082, 'Yavatmal', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1083, 'Yelagiri Hills', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1084, 'Yelandur', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1085, 'Yeliyur', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1086, 'Yellapur', 'Karnataka', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1087, 'Yemmiganur', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1088, 'Yeola', 'Maharashtra', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1089, 'Yercaud', 'Tamil Nadu', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1090, 'Yerraguntla', 'Andhra Pradesh', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1091, 'Zahirabad', 'Telangana', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1092, 'Zemabawk', 'Mizoram', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1093, 'Zirakpur', 'Punjab', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1),
(1094, 'Zunheboto', 'Nagaland', 'India', '0.000000000000000', '0.000000000000000', '2015-10-08 10:34:08', 'mysql', '2015-10-08 05:03:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contactus`
--

CREATE TABLE IF NOT EXISTS `tbl_contactus` (
  `contanctus_id` bigint(20) unsigned NOT NULL COMMENT 'contact id',
  `user_id` bigint(20) unsigned NOT NULL,
  `logmobile` bigint(15) unsigned NOT NULL,
  `customer_name` varchar(250) DEFAULT NULL COMMENT 'customer name',
  `customer_email` varchar(300) DEFAULT NULL COMMENT 'customer email',
  `customer_query` text NOT NULL COMMENT 'customre query',
  `active_flag` tinyint(2) NOT NULL DEFAULT '1' COMMENT 'display flag{0-Inacive | 1-Active}',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time on which it was created',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'timestamp on which it was last updated'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_custom_design`
--

CREATE TABLE IF NOT EXISTS `tbl_custom_design` (
  `custom_id` bigint(20) unsigned NOT NULL COMMENT 'auto incremented custom design',
  `title` char(6) NOT NULL COMMENT 'MR|MRS|MISS|MASTER',
  `customer_name` varchar(150) NOT NULL COMMENT 'customer name',
  `customer_email` varchar(300) NOT NULL COMMENT 'customer email',
  `customer_mobile` bigint(15) unsigned NOT NULL COMMENT 'unique id',
  `design_image` text NOT NULL COMMENT '|~| image path name comma separated',
  `active_flag` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'active display flag {0-Inactive | 1-Active}',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and time on which it was created ',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was last updated'
) ENGINE=MyISAM AUTO_INCREMENT=9000 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_custom_design`
--

INSERT INTO `tbl_custom_design` (`custom_id`, `title`, `customer_name`, `customer_email`, `customer_mobile`, `design_image`, `active_flag`, `date_time`, `update_time`) VALUES
(6, 'qdqd w', 'Insane Rider', 'rider.insane@motorbikes.com', 7309290529, 'earring.png', 1, '2015-10-01 10:03:04', '2015-10-01 04:33:04'),
(7, 'qdqd w', 'Insane Rider', 'rider.insane@motorbikes.com', 7309290529, 'earring.png', 1, '2015-10-05 17:56:25', '2015-10-05 12:26:25'),
(8, 'qdqd w', 'Insane Rider', 'rider.insane@motorbikes.com', 7309290529, 'earring.png', 1, '2015-10-05 18:08:09', '2015-10-05 12:38:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_designer_product_mapping`
--

CREATE TABLE IF NOT EXISTS `tbl_designer_product_mapping` (
  `designer_id` bigint(20) unsigned NOT NULL COMMENT 'Auto incremented designer id',
  `product_id` bigint(20) unsigned NOT NULL COMMENT 'product_code',
  `designer_name` varchar(250) NOT NULL COMMENT 'Designer''s Name',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was last updated',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and time on which it was created',
  `active_flag` tinyint(2) NOT NULL COMMENT '{ 0-Inactive| 1-Active }'
) ENGINE=MyISAM AUTO_INCREMENT=3500 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_designer_product_mapping`
--

INSERT INTO `tbl_designer_product_mapping` (`designer_id`, `product_id`, `designer_name`, `update_time`, `date_time`, `active_flag`) VALUES
(1, 10000, 'jackdeniel', '2015-09-16 04:36:20', '2015-09-16 10:06:20', 1),
(5, 10000, 'shiamak', '2015-09-16 15:30:16', '2015-09-16 21:00:16', 1),
(6, 10000, 'shiamak', '2015-09-23 04:54:11', '2015-09-23 10:24:11', 1),
(27, 10000, 'shiamak', '2015-09-23 06:02:19', '2015-09-23 11:32:19', 1),
(28, 10000, 'shiamak', '2015-09-23 06:08:17', '2015-09-23 11:38:17', 1),
(29, 10000, 'shiamak', '2015-09-23 06:08:39', '2015-09-23 11:38:39', 1),
(33, 10000, 'shiamak', '2015-09-30 13:40:27', '2015-09-30 19:10:27', 1),
(7, 10001, 'shiamak', '2015-09-23 04:55:43', '2015-09-23 10:25:43', 1),
(8, 10001, 'shiamak', '2015-09-23 04:56:31', '2015-09-23 10:26:31', 1),
(9, 10002, 'shiamak', '2015-09-23 04:57:33', '2015-09-23 10:27:33', 1),
(10, 10003, 'shiamak', '2015-09-23 04:58:12', '2015-09-23 10:28:12', 1),
(11, 10003, 'shiamak', '2015-09-23 04:58:41', '2015-09-23 10:28:41', 1),
(12, 10004, 'shiamak', '2015-09-23 05:00:20', '2015-09-23 10:30:20', 1),
(13, 10004, 'shiamak', '2015-09-23 05:02:47', '2015-09-23 10:32:47', 1),
(14, 10004, 'shiamak', '2015-09-23 05:03:10', '2015-09-23 10:33:10', 1),
(15, 10004, 'shiamak', '2015-09-23 05:03:17', '2015-09-23 10:33:17', 1),
(16, 10004, 'shiamak', '2015-09-23 05:08:20', '2015-09-23 10:38:20', 1),
(17, 10005, 'shiamak', '2015-09-23 05:10:18', '2015-09-23 10:40:18', 1),
(18, 10005, 'shiamak', '2015-09-23 05:10:18', '2015-09-23 10:40:18', 1),
(19, 10005, 'shiamak', '2015-09-23 05:10:19', '2015-09-23 10:40:19', 1),
(20, 10005, 'shiamak', '2015-09-23 05:10:28', '2015-09-23 10:40:28', 1),
(21, 10006, 'shiamak', '2015-09-23 05:11:00', '2015-09-23 10:41:00', 1),
(22, 10006, 'shiamak', '2015-09-23 05:15:08', '2015-09-23 10:45:08', 1),
(23, 10006, 'shiamak', '2015-09-23 05:15:10', '2015-09-23 10:45:10', 1),
(24, 10006, 'shiamak', '2015-09-23 05:15:11', '2015-09-23 10:45:11', 1),
(25, 10006, 'shiamak', '2015-09-23 05:15:12', '2015-09-23 10:45:12', 1),
(26, 10006, 'shiamak', '2015-09-23 05:15:33', '2015-09-23 10:45:33', 1),
(30, 10008, 'shiamak', '2015-09-23 06:09:47', '2015-09-23 11:39:47', 1),
(31, 10009, 'shiamak', '2015-09-23 06:12:22', '2015-09-23 11:42:22', 1),
(32, 10010, 'shiamak', '2015-09-23 06:13:43', '2015-09-23 11:43:43', 1),
(34, 10011, 'jackdeniel', '2015-10-05 12:15:43', '2015-10-05 17:45:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newsletter_master`
--

CREATE TABLE IF NOT EXISTS `tbl_newsletter_master` (
  `news_id` bigint(20) unsigned NOT NULL COMMENT 'auto incremented Newsid',
  `news_headline` varchar(250) DEFAULT NULL COMMENT 'news heading',
  `news_description` text COMMENT 'news description',
  `content` longtext COMMENT 'content',
  `active_flag` tinyint(2) NOT NULL COMMENT '{1-Active | 0-Inactive}',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and time on which it was created',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was last updated'
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news_user_map`
--

CREATE TABLE IF NOT EXISTS `tbl_news_user_map` (
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'user id',
  `news_id` bigint(20) unsigned NOT NULL COMMENT 'newletter id',
  `active_flag` tinyint(2) NOT NULL COMMENT 'display flag',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and time on which it was created',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was last updated',
  `display_position` tinyint(4) unsigned NOT NULL DEFAULT '111' COMMENT 'priority{111-low| 999-high}'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offer_master`
--

CREATE TABLE IF NOT EXISTS `tbl_offer_master` (
  `offer_id` bigint(20) NOT NULL COMMENT 'offer id',
  `offer_name` varchar(100) NOT NULL COMMENT 'name of the offer',
  `offer_description` text NOT NULL COMMENT 'description',
  `offer_discount_percentage` decimal(3,2) NOT NULL COMMENT 'amount discount percentage',
  `offer_validity_days` varchar(30) NOT NULL COMMENT 'validity in days',
  `offer_voucher_description` text NOT NULL COMMENT 'voucher description',
  `active_flag` tinyint(2) NOT NULL COMMENT '{0-Active | 1-Inactive }',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT 'Date and time on which it was created',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was last updated'
) ENGINE=MyISAM AUTO_INCREMENT=6000 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_offer_master`
--

INSERT INTO `tbl_offer_master` (`offer_id`, `offer_name`, `offer_description`, `offer_discount_percentage`, `offer_validity_days`, `offer_voucher_description`, `active_flag`, `date_time`, `update_time`) VALUES
(1, 'diwalidhamaka', 'a well reknown festive offer we are celebrating since ages', '1.10', '1 year', '1123fwhf232', 1, '2015-09-16 15:25:23', '2015-09-16 09:55:23'),
(2, 'diwalidhamaka', 'a well reknown festive offer we are celebrating since ages', '1.10', '1 year', '1123fwhf232', 0, '2015-09-16 15:25:38', '2015-09-16 09:55:38'),
(3, 'diwalidhamaka', 'a well reknown festive offer we are celebrating since ages', '1.10', '1 year', '1123fwhf232', 0, '2015-09-16 21:02:39', '2015-09-16 15:32:39'),
(4, 'diwalidhamaka', 'a well reknown festive offer we are celebrating since ages', '1.10', '1 year', '1123fwhf232', 0, '2015-09-30 19:28:22', '2015-09-30 13:58:22'),
(5, 'diwalidhamaka', 'a well reknown festive offer we are celebrating since ages', '1.10', '1 year', '1123fwhf232', 0, '2015-10-05 17:50:28', '2015-10-05 12:20:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offer_user_mapping`
--

CREATE TABLE IF NOT EXISTS `tbl_offer_user_mapping` (
  `offer_id` bigint(20) unsigned NOT NULL COMMENT 'offer id used by user',
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'user id',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and time on which it was created',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was last updated',
  `active_flag` tinyint(2) NOT NULL COMMENT '1-Active | 0-Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_offer_user_mapping`
--

INSERT INTO `tbl_offer_user_mapping` (`offer_id`, `user_id`, `date_time`, `update_time`, `active_flag`) VALUES
(2, 9975887206, '2015-09-16 21:04:17', '2015-09-16 15:34:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_master`
--

CREATE TABLE IF NOT EXISTS `tbl_order_master` (
  `order_id` bigint(20) unsigned NOT NULL COMMENT 'order id',
  `user_id` bigint(20) NOT NULL COMMENT 'login mobile / ip address',
  `cart_id` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT 'shopping cart id',
  `shippping_address_id` bigint(15) NOT NULL,
  `bill_address_Id` bigint(15) NOT NULL,
  `transaction_id` varchar(50) DEFAULT NULL COMMENT 'update after payment confirms',
  `order_status` tinyint(2) NOT NULL COMMENT '0-InActive | 1-Active',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and time on which it was created',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was last updated',
  `active_flag` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'display flag{0-Inacive | 1-Active}'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order_master`
--

INSERT INTO `tbl_order_master` (`order_id`, `user_id`, `cart_id`, `shippping_address_id`, `bill_address_Id`, `transaction_id`, `order_status`, `date_time`, `update_time`, `active_flag`) VALUES
(1, 10105, '111', 1, 1, '9975887206', 0, '2015-10-05 19:32:01', '2015-10-05 14:02:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productid_generator`
--

CREATE TABLE IF NOT EXISTS `tbl_productid_generator` (
  `product_id` int(10) unsigned NOT NULL,
  `product_name` varchar(255) NOT NULL DEFAULT '',
  `product_brand` varchar(255) DEFAULT '',
  `date_time` datetime NOT NULL COMMENT 'Date and time on which it was created',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was last updated'
) ENGINE=MyISAM AUTO_INCREMENT=10012 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_productid_generator`
--

INSERT INTO `tbl_productid_generator` (`product_id`, `product_name`, `product_brand`, `date_time`, `update_time`) VALUES
(10011, 'bluediamond', 'orra', '0000-00-00 00:00:00', '2015-10-15 10:18:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_attributes`
--

CREATE TABLE IF NOT EXISTS `tbl_product_attributes` (
  `product_id` bigint(20) unsigned NOT NULL,
  `attribute_id` int(4) unsigned NOT NULL,
  `category_id` bigint(15) unsigned NOT NULL,
  `value` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `active_flag` tinyint(2) NOT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '''timestamp on which it was last updated',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and time on which it was created'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_attributes`
--

INSERT INTO `tbl_product_attributes` (`product_id`, `attribute_id`, `category_id`, `value`, `active_flag`, `updated_by`, `update_time`, `date_time`) VALUES
(7, 111, 0, 'green', 1, 'CMS_USER', '2015-09-10 11:19:19', '0000-00-00 00:00:00'),
(8, 43, 3, 'green', 1, 'CMS_USER', '2015-09-14 04:58:56', '0000-00-00 00:00:00'),
(9, 43, 0, 'kj', 1, 'CMS_USER', '2015-09-14 08:39:57', '0000-00-00 00:00:00'),
(9, 100014, 0, 'earring', 1, 'CMS_USER', '2015-09-23 04:55:43', '0000-00-00 00:00:00'),
(10000, 111, 3, 'green', 1, 'CMS_USER', '2015-10-05 12:14:50', '0000-00-00 00:00:00'),
(10000, 100014, 3, 'necklace', 1, 'CMS_USER', '2015-09-16 04:36:20', '0000-00-00 00:00:00'),
(10002, 111, 0, 'green', 1, 'CMS_USER', '2015-09-23 04:57:33', '0000-00-00 00:00:00'),
(10003, 111, 0, 'green', 1, 'CMS_USER', '2015-09-23 04:58:12', '0000-00-00 00:00:00'),
(10004, 111, 0, 'earring', 1, 'CMS_USER', '2015-09-23 05:00:20', '0000-00-00 00:00:00'),
(10005, 111, 0, 'green', 1, 'CMS_USER', '2015-09-23 05:10:18', '0000-00-00 00:00:00'),
(10006, 111, 0, 'green', 1, 'CMS_USER', '2015-09-23 05:11:00', '0000-00-00 00:00:00'),
(10008, 111, 0, 'green', 1, 'CMS_USER', '2015-09-23 06:09:47', '0000-00-00 00:00:00'),
(10009, 111, 0, 'blue', 1, 'CMS_USER', '2015-09-23 06:12:22', '0000-00-00 00:00:00'),
(10010, 111, 0, 'green', 1, 'CMS_USER', '2015-09-23 06:13:43', '0000-00-00 00:00:00'),
(10011, 111, 3, 'green', 1, 'CMS_USER', '2015-10-05 12:15:43', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_category_mapping`
--

CREATE TABLE IF NOT EXISTS `tbl_product_category_mapping` (
  `product_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `price` decimal(20,3) DEFAULT '0.000',
  `rating` decimal(2,2) DEFAULT '0.00',
  `display_flag` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1-Active,0-Inactive',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time on which it was created',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'timestamp on which it was last updated'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='for lineage and category handling';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_master`
--

CREATE TABLE IF NOT EXISTS `tbl_product_master` (
  `product_id` bigint(20) unsigned NOT NULL,
  `product_barcode` varchar(8) CHARACTER SET utf8 NOT NULL,
  `product_lot_reference` varchar(12) CHARACTER SET utf8 NOT NULL,
  `product_lot_number` int(4) unsigned NOT NULL,
  `product_name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `product_display_name` varchar(250) CHARACTER SET utf8 NOT NULL COMMENT 'name displayed on web',
  `product_model` varchar(250) CHARACTER SET utf8 NOT NULL,
  `product_brand` varchar(250) CHARACTER SET utf8 NOT NULL,
  `product_price` decimal(20,2) NOT NULL,
  `product_currency` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'INR',
  `product_keyword` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `product_description` text CHARACTER SET utf8,
  `product_weight` decimal(7,3) NOT NULL,
  `product_image` text,
  `product_warranty` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Date and time on which it was created',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was last updated''',
  `designer_name` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_master`
--

INSERT INTO `tbl_product_master` (`product_id`, `product_barcode`, `product_lot_reference`, `product_lot_number`, `product_name`, `product_display_name`, `product_model`, `product_brand`, `product_price`, `product_currency`, `product_keyword`, `product_description`, `product_weight`, `product_image`, `product_warranty`, `updated_by`, `update_time`, `date_time`, `designer_name`) VALUES
(10011, 'qw211111', '1123', 1133, 'bluediamond', 'marveric blue silver diamond', 'rw231', 'orra', '12211223.02', 'INR', 'blue,silver,diamond', 'a clear cut solitaire diamond in the vault', '223.210', 'abc.jpeg', '1 year', 'CMS USER', '2015-10-05 12:15:43', '2015-10-05 17:45:43', 'jackdeniel');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_search`
--

CREATE TABLE IF NOT EXISTS `tbl_product_search` (
  `product_id` bigint(20) unsigned NOT NULL,
  `color` varchar(20) DEFAULT NULL,
  `carat` decimal(6,2) DEFAULT '0.00',
  `certified` varchar(50) DEFAULT NULL,
  `shape` varchar(30) DEFAULT NULL,
  `cut` varchar(26) DEFAULT NULL,
  `clarity` varchar(4) DEFAULT NULL,
  `base` int(5) DEFAULT '0',
  `tabl` decimal(4,2) DEFAULT '0.00',
  `price` decimal(9,2) DEFAULT '0.00',
  `p_disc` int(3) DEFAULT '0',
  `prop` varchar(4) DEFAULT NULL,
  `polish` varchar(50) DEFAULT NULL,
  `symmetry` varchar(50) DEFAULT NULL,
  `fluo` varchar(4) DEFAULT NULL,
  `td` decimal(4,2) DEFAULT '0.00',
  `measurement` varchar(16) DEFAULT NULL,
  `cno` varchar(11) DEFAULT NULL,
  `pa` decimal(4,2) DEFAULT '0.00',
  `cr_hgt` decimal(4,2) DEFAULT '0.00',
  `cr_ang` decimal(4,2) DEFAULT '0.00',
  `girdle` decimal(3,2) DEFAULT '0.00',
  `pd` decimal(4,2) DEFAULT '0.00',
  `type` varchar(20) DEFAULT NULL,
  `metal` varchar(20) DEFAULT NULL,
  `purity` decimal(5,2) DEFAULT '0.00',
  `nofd` int(4) DEFAULT '0',
  `dwt` decimal(7,3) DEFAULT '0.000',
  `gemwt` decimal(7,3) DEFAULT '0.000',
  `quality` varchar(15) DEFAULT NULL,
  `goldwt` decimal(7,3) DEFAULT '0.000',
  `rating` decimal(2,1) DEFAULT '0.0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time on which it was created',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'timestamp on which it was last updated'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_registration`
--

CREATE TABLE IF NOT EXISTS `tbl_registration` (
  `user_id` bigint(20) unsigned NOT NULL,
  `user_name` varchar(100) NOT NULL COMMENT 'Name of User',
  `password` varchar(255) NOT NULL COMMENT 'Password for login',
  `logmobile` bigint(15) NOT NULL COMMENT 'Mobile number of User',
  `email` varchar(255) NOT NULL COMMENT 'Email of user',
  `is_vendor` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1-Vendor, 0-Not Vendor',
  `is_active` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1-Active, 0-Non Active',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and Time of registration',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'updated at',
  `updated_by` varchar(100) NOT NULL COMMENT 'Details of the user or vendor who updated details',
  `subscribe` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '1-Active | 0-Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_registration`
--

INSERT INTO `tbl_registration` (`user_id`, `user_name`, `password`, `logmobile`, `email`, `is_vendor`, `is_active`, `date_time`, `update_time`, `updated_by`, `subscribe`) VALUES
(1, 'White Fire Jewels', '123456', 8888888888, 'whitefirejewels@jwelers.com', 1, 1, '2015-10-15 17:42:32', '2015-10-15 12:08:25', 'User', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_speak_master`
--

CREATE TABLE IF NOT EXISTS `tbl_speak_master` (
  `speak_id` bigint(20) unsigned NOT NULL COMMENT 'auto incremented id',
  `name` varchar(50) NOT NULL COMMENT 'user name',
  `city` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL COMMENT 'user email id',
  `mobile` bigint(20) NOT NULL COMMENT 'user mobile number',
  `product_image` text NOT NULL COMMENT 'purchased prd image',
  `opinion` text NOT NULL COMMENT 'users opinion',
  `final_opinion` text NOT NULL COMMENT 'users final opinion',
  `active_flag` tinyint(2) DEFAULT '1' COMMENT '0 - Active, 1 - Deleted',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date time on which it was created / testimonial upload time',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was last updated',
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'user id'
) ENGINE=MyISAM AUTO_INCREMENT=3000 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_speak_master`
--

INSERT INTO `tbl_speak_master` (`speak_id`, `name`, `city`, `email`, `mobile`, `product_image`, `opinion`, `final_opinion`, `active_flag`, `date_time`, `update_time`, `user_id`) VALUES
(1, 'Insane Rider', 'rider.insane@motorbikes.com', 'adf@fewf.com', 7309290529, 'a.png', 'earring.png', 'earring.png', 1, '2015-10-05 18:14:45', '2015-10-05 12:44:45', 0),
(2, 'Insane Rider', 'rider.insane@motorbikes.com', 'adf@fewf.com', 7309290529, 'a.png', 'earring.png', 'earring.png', 1, '2015-10-05 18:16:08', '2015-10-05 12:46:08', 10105);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stylist_appoint`
--

CREATE TABLE IF NOT EXISTS `tbl_stylist_appoint` (
  `appointment_id` bigint(20) unsigned NOT NULL COMMENT 'auto incremented appointment id ',
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'customer logmobile',
  `customer_name` varchar(250) NOT NULL COMMENT 'customer name',
  `customer_email` varchar(300) NOT NULL COMMENT 'email address',
  `customer_address` text NOT NULL COMMENT 'venue of meeting',
  `product_type` varchar(200) DEFAULT NULL COMMENT 'type of product interested in',
  `category` varchar(200) DEFAULT NULL COMMENT 'category of product',
  `budget` varchar(200) DEFAULT NULL COMMENT '|~|customer budget',
  `stylist_id` bigint(15) unsigned DEFAULT NULL COMMENT 'stylist logmobile',
  `stylist_name` varchar(250) DEFAULT NULL COMMENT 'stylist appointed name',
  `meet_status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1-still active 0-meet over',
  `display_flag` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'showing flag - 1-Active 0-Inactive',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time on which it was created',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'timestamp on which it was last updated',
  `customer_mobile` bigint(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_stylist_appoint`
--

INSERT INTO `tbl_stylist_appoint` (`appointment_id`, `user_id`, `customer_name`, `customer_email`, `customer_address`, `product_type`, `category`, `budget`, `stylist_id`, `stylist_name`, `meet_status`, `display_flag`, `date_time`, `update_time`, `customer_mobile`) VALUES
(1, 7309290529, 'Insane Rider', 'rider.insane@motorbikes.com', 'qdqd wedwdw wcec wwwedd wdewd', 'earring', 'diamond,gold', '10000.00', NULL, NULL, 0, 1, '2015-10-01 09:02:03', '2015-10-01 03:32:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE IF NOT EXISTS `tbl_transaction` (
  `transaction_id` bigint(20) unsigned NOT NULL,
  `payment_type` varchar(150) NOT NULL,
  `payment_mode` varchar(150) NOT NULL,
  `card_use` varchar(150) NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `currency` varchar(50) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and time on which it was created ',
  `transaction_status` bit(1) NOT NULL,
  `transcation_desc` text NOT NULL,
  `amount` decimal(20,3) NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was last updated'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`transaction_id`, `payment_type`, `payment_mode`, `card_use`, `payment_date`, `currency`, `date_time`, `transaction_status`, `transcation_desc`, `amount`, `updated_time`) VALUES
(9975887206, 'sadd', '1', 'singharun@gmail.com', '2015-10-05 19:44:59', '1990 10 08', '2015-10-05 19:44:59', b'1', 'sddv cd qwdd', '120012.000', '2015-10-15 10:55:36'),
(9975887206, 'sadd', '1', 'singharun@gmail.com', '2015-10-05 19:45:24', '1990 10 08', '2015-10-05 19:45:24', b'1', 'sddv cd qwdd', '120012.000', '2015-10-15 10:55:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_cart`
--

CREATE TABLE IF NOT EXISTS `tbl_user_cart` (
  `cart_id` varchar(20) NOT NULL COMMENT 'Unique cart id from generator',
  `product_id` varchar(255) NOT NULL COMMENT 'product id which is added in cart',
  `vendor_id` bigint(20) unsigned NOT NULL COMMENT 'vendor mobile to know product of which vendor is added',
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'user logmobile for which cart is created',
  `quantity` int(10) NOT NULL DEFAULT '1' COMMENT 'quantity of product that is added in cart',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time when the product was added in cart',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'date and time when the record was updated',
  `active_flag` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1 - active, 0 - removed or deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='user cart to store incomplete transaction';

--
-- Dumping data for table `tbl_user_cart`
--

INSERT INTO `tbl_user_cart` (`cart_id`, `product_id`, `vendor_id`, `user_id`, `quantity`, `date_time`, `update_time`, `active_flag`) VALUES
('P3E6U7I7', '9', 7309290529, 9975887206, 18, '2015-09-23 22:36:01', '2015-09-23 17:06:01', 1),
('P3E6U7I7', '7', 7309290529, 9975887206, 2, '2015-09-23 22:38:57', '2015-09-30 14:38:25', 1),
('F6A3Y0I4', '7', 7309290529, 8878767576, 1, '2015-09-23 22:45:17', '2015-09-23 17:15:17', 1),
('F6A3Y0I4', '9', 7309290529, 8878767576, 2, '2015-09-23 22:46:02', '2015-09-23 17:16:02', 1),
('P3E6U7I7', '9', 7309290529, 7878787878, 4, '2015-09-25 10:35:08', '2015-09-25 05:05:08', 1),
('O5P2Z3T9', '9', 7309290529, 8878787878, 2, '2015-09-25 10:39:09', '2015-09-25 05:09:09', 1),
('O5P2Z3T9', '9', 7309290529, 0, 1, '2015-09-25 10:58:01', '2015-09-25 05:28:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_info`
--

CREATE TABLE IF NOT EXISTS `tbl_user_info` (
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'Auto increment registration key',
  `userName` varchar(250) CHARACTER SET latin7 NOT NULL COMMENT 'Name of the user',
  `gender` bit(1) NOT NULL COMMENT 'title{0-Male|1-Female}',
  `logmobile` bigint(20) unsigned DEFAULT NULL COMMENT 'Mobile registered',
  `alt_email` varchar(300) CHARACTER SET latin7 DEFAULT NULL COMMENT 'alternate email address',
  `dob` date NOT NULL COMMENT 'date of birth',
  `working_phone` bigint(20) unsigned NOT NULL,
  `fulladdress` text CHARACTER SET latin7 NOT NULL COMMENT 'street|landmark|area',
  `pincode` int(6) unsigned DEFAULT NULL COMMENT 'postal area code',
  `cityname` varchar(150) CHARACTER SET latin7 NOT NULL COMMENT 'cityname which has already state and country',
  `id_type` varchar(100) CHARACTER SET latin7 NOT NULL COMMENT 'identity type',
  `id_proof_no` varchar(200) CHARACTER SET latin7 NOT NULL COMMENT 'idproof number',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and time when it was created',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was updated'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='registration for every user';

--
-- Dumping data for table `tbl_user_info`
--

INSERT INTO `tbl_user_info` (`user_id`, `userName`, `gender`, `logmobile`, `alt_email`, `dob`, `working_phone`, `fulladdress`, `pincode`, `cityname`, `id_type`, `id_proof_no`, `date_time`, `update_time`) VALUES
(10101, 'Shubham Bajpai', b'0', 9975887206, 'shubhambaajpai@gmail.com', '1990-10-10', 7309290529, 'ES 1B/962,Sector A, Jankipuram', 223232, 'delhi', 'DL', 'VH32323HN', '2015-09-16 20:46:17', '2015-09-16 15:16:17'),
(10103, 'shivangi', b'1', 9096903638, 'shivi@gmail.com', '1990-10-28', 80887545, 'ho ni payega', 226021, 'firozabad', '323222', '323222', '2015-09-30 17:33:24', '2015-10-05 11:56:52'),
(10104, 'Shubham Bajpai', b'0', 9975887206, NULL, '0000-00-00', 0, '', NULL, '', '', '', '2015-10-05 17:22:40', '2015-10-05 11:52:40'),
(10105, 'Shubham Bajpai', b'0', 9975887206, NULL, '0000-00-00', 0, '', NULL, '', '', '', '2015-10-05 17:25:10', '2015-10-05 11:55:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendor_master`
--

CREATE TABLE IF NOT EXISTS `tbl_vendor_master` (
  `vendor_id` bigint(20) NOT NULL,
  `orgName` varchar(255) DEFAULT NULL COMMENT 'organisation name',
  `fulladdress` text COMMENT 'company address',
  `address1` text,
  `area` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `telephones` text COMMENT 'telephone numbers of company',
  `alt_email` text COMMENT 'alternate email addresses',
  `officecity` text COMMENT 'offices in different cities',
  `officecountry` text COMMENT 'offices in different countries',
  `contact_person` varchar(250) DEFAULT NULL COMMENT 'contact person name',
  `position` varchar(15) DEFAULT NULL COMMENT 'person designation',
  `contact_mobile` bigint(15) DEFAULT NULL COMMENT 'person''s mobile number',
  `email` text COMMENT 'email address of contact person',
  `memship_Cert` text NOT NULL COMMENT 'membership certificate',
  `bdbc` text COMMENT 'bharat diamond bourse certificate',
  `other_bdbc` text,
  `vatno` varchar(15) DEFAULT NULL COMMENT 'Value added tax',
  `website` text COMMENT 'website address',
  `landline` text COMMENT 'fields separated by |~|',
  `mdbw` text COMMENT 'membership of other diamond bourses in world',
  `banker` text COMMENT 'different bank supports',
  `pancard` varchar(12) NOT NULL COMMENT 'pan car number',
  `turnover` varchar(20) NOT NULL COMMENT 'company turnover',
  `lng` decimal(17,15) NOT NULL DEFAULT '0.000000000000000' COMMENT 'longitutde',
  `lat` decimal(17,15) NOT NULL DEFAULT '0.000000000000000' COMMENT 'latitude',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'timestamp on which it was last updated',
  `updatedby` varchar(50) DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time on which it was created',
  `is_complete` tinyint(2) DEFAULT '0' COMMENT '0-Not complete | 1-business Det Complete | 2-Complete'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vendor_master`
--

INSERT INTO `tbl_vendor_master` (`vendor_id`, `orgName`, `fulladdress`, `address1`, `area`, `postal_code`, `city`, `country`, `state`, `telephones`, `alt_email`, `officecity`, `officecountry`, `contact_person`, `position`, `contact_mobile`, `email`, `memship_Cert`, `bdbc`, `other_bdbc`, `vatno`, `website`, `landline`, `mdbw`, `banker`, `pancard`, `turnover`, `lng`, `lat`, `update_time`, `updatedby`, `date_time`, `is_complete`) VALUES
(1, 'White Fire Jewels', 'GW 9876 Bharat Diamond Bourse,\r\nBandra Kurla Complex,\r\nBandrea East,\r\nMumbai 400051,\r\nMaharastra', NULL, NULL, NULL, NULL, NULL, NULL, '0222-32623263~0222-32623263~0222-32623263~0222-32623263', 'wfj@gmail.com~xyx@hotmail.com', 'Bangalore', 'India', 'Sandipan Chattopadhyay', 'Director', 990051525, 'ankur@xelpmoc.in', 'GJEPC/HO-MUM(M)/G25885/AM/I', 'M-12345', NULL, '1234567890', 'www.whitefirejwels.in', '0222-32623263', 'Russia~London~Hongkong', 'Indus Bank~Kotak Bank~State Bank Of India', 'BOSPB5539L', '100', '12.966700000000000', '77.566700000000000', '2015-10-15 12:44:05', 'VENDOR', '0000-00-00 00:00:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendor_product_mapping`
--

CREATE TABLE IF NOT EXISTS `tbl_vendor_product_mapping` (
  `vendor_id` bigint(20) NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `vendor_price` decimal(20,2) DEFAULT '0.00',
  `vendor_quantity` int(11) DEFAULT '0',
  `vendor_currency` varchar(10) DEFAULT 'Rs',
  `vendor_remarks` varchar(255) DEFAULT NULL,
  `active_flag` tinyint(2) DEFAULT '0',
  `updated_by` varchar(50) DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and time on which it was ceated',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was updated'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vendor_product_mapping`
--

INSERT INTO `tbl_vendor_product_mapping` (`vendor_id`, `product_id`, `vendor_price`, `vendor_quantity`, `vendor_currency`, `vendor_remarks`, `active_flag`, `updated_by`, `date_time`, `update_time`) VALUES
(7, 1, '7309290529.00', 1, 'INR', '4.21', 1, 'vendor', '2015-10-05 19:46:55', '2015-10-05 14:16:55'),
(1212, 9, '23424.00', 10, 'INR', 'Excellent', 1, 'vendor', '2015-09-10 18:24:54', '2015-09-23 07:36:19'),
(1213, 8, '3300023.00', 3, 'INR', 'Excellent', 1, 'vendor', '2015-09-12 19:39:02', '2015-09-14 09:16:50'),
(1214, 7, '3300023.00', 3, 'INR', 'Excellent', 1, 'vendor', '2015-09-12 19:40:14', '2015-09-14 09:16:59'),
(1216, 7, '3300023.00', 3, 'INR', 'Excellent', 1, 'vendor', '2015-09-15 23:10:10', '2015-09-15 17:40:10'),
(1217, 7, '3300023.00', 3, 'INR', 'Excellent', 1, 'vendor', '2015-09-16 20:54:53', '2015-09-16 15:24:53'),
(1218, 7, '3300023.00', 3, 'INR', 'Excellent', 0, 'vendor', '2015-09-16 20:54:58', '2015-09-16 15:24:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_viewlog`
--

CREATE TABLE IF NOT EXISTS `tbl_viewlog` (
  `user_id` bigint(20) NOT NULL COMMENT 'for user record',
  `user_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(250) CHARACTER SET utf8 NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `vendor_id` bigint(20) unsigned NOT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8 NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Date and time on which it was created',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Timestamp on which it was updated'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_viewlog`
--

INSERT INTO `tbl_viewlog` (`user_id`, `user_name`, `email`, `product_id`, `vendor_id`, `updated_by`, `update_time`, `date_time`) VALUES
(9975887206, 'Shushrut Kumar', 'shubham@gmail.com', 7, 9975887206, 'customer', '2015-09-16 09:16:23', '2015-09-16 14:46:23'),
(9975887206, 'Shushrut Kumar', 'shubham@gmail.com', 7, 9975887206, 'customer', '2015-09-16 09:22:58', '2015-09-16 14:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE IF NOT EXISTS `tbl_wishlist` (
  `wishlist_id` bigint(20) unsigned NOT NULL COMMENT 'Auto Incremented ',
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'user id ',
  `product_id` bigint(20) unsigned NOT NULL COMMENT 'product id',
  `vendor_id` bigint(20) unsigned DEFAULT NULL COMMENT 'vendor id',
  `active_flag` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'wish flag',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and time on which it was created',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was updated'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`wishlist_id`, `user_id`, `product_id`, `vendor_id`, `active_flag`, `date_time`, `update_time`) VALUES
(1, 0, 10011, 9975887206, 1, '2015-10-05 18:21:16', '2015-10-05 12:51:16'),
(2, 0, 0, 9975887206, 1, '2015-10-05 19:18:36', '2015-10-05 13:48:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_addressid_generator`
--
ALTER TABLE `tbl_addressid_generator`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `tbl_attribute_master`
--
ALTER TABLE `tbl_attribute_master`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Indexes for table `tbl_brandid_generator`
--
ALTER TABLE `tbl_brandid_generator`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brand_category` (`name`,`category_name`);

--
-- Indexes for table `tbl_cartid_generator`
--
ALTER TABLE `tbl_cartid_generator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_categoryid_generator`
--
ALTER TABLE `tbl_categoryid_generator`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `tbl_category_master`
--
ALTER TABLE `tbl_category_master`
  ADD KEY `catid` (`category_id`),
  ADD KEY `p_catid` (`parent_category_id`);

--
-- Indexes for table `tbl_city_master`
--
ALTER TABLE `tbl_city_master`
  ADD PRIMARY KEY (`cityid`);

--
-- Indexes for table `tbl_contactus`
--
ALTER TABLE `tbl_contactus`
  ADD PRIMARY KEY (`contanctus_id`),
  ADD KEY `uid` (`user_id`);

--
-- Indexes for table `tbl_custom_design`
--
ALTER TABLE `tbl_custom_design`
  ADD PRIMARY KEY (`custom_id`);

--
-- Indexes for table `tbl_designer_product_mapping`
--
ALTER TABLE `tbl_designer_product_mapping`
  ADD PRIMARY KEY (`product_id`,`designer_id`),
  ADD KEY `designer_id` (`designer_id`);

--
-- Indexes for table `tbl_newsletter_master`
--
ALTER TABLE `tbl_newsletter_master`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `tbl_news_user_map`
--
ALTER TABLE `tbl_news_user_map`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_offer_master`
--
ALTER TABLE `tbl_offer_master`
  ADD PRIMARY KEY (`offer_id`),
  ADD UNIQUE KEY `offid` (`offer_id`);

--
-- Indexes for table `tbl_offer_user_mapping`
--
ALTER TABLE `tbl_offer_user_mapping`
  ADD PRIMARY KEY (`offer_id`,`user_id`);

--
-- Indexes for table `tbl_order_master`
--
ALTER TABLE `tbl_order_master`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `idx_transid` (`transaction_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_cart_id` (`cart_id`),
  ADD KEY `idx_shipAddId` (`shippping_address_id`),
  ADD KEY `idx_billAddId` (`bill_address_Id`);

--
-- Indexes for table `tbl_productid_generator`
--
ALTER TABLE `tbl_productid_generator`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `name_brand` (`product_name`,`product_brand`) USING BTREE;

--
-- Indexes for table `tbl_product_attributes`
--
ALTER TABLE `tbl_product_attributes`
  ADD PRIMARY KEY (`product_id`,`attribute_id`);

--
-- Indexes for table `tbl_product_category_mapping`
--
ALTER TABLE `tbl_product_category_mapping`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_product_master`
--
ALTER TABLE `tbl_product_master`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_product_search`
--
ALTER TABLE `tbl_product_search`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `product_id_2` (`product_id`);

--
-- Indexes for table `tbl_registration`
--
ALTER TABLE `tbl_registration`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `idx_user_name` (`user_name`),
  ADD KEY `idx_mobile` (`logmobile`),
  ADD KEY `idx_is_active` (`is_active`),
  ADD KEY `idx_date_time` (`date_time`),
  ADD KEY `idx_update_time` (`update_time`),
  ADD KEY `idx_updated_by` (`updated_by`);

--
-- Indexes for table `tbl_speak_master`
--
ALTER TABLE `tbl_speak_master`
  ADD PRIMARY KEY (`speak_id`),
  ADD KEY `idx_city` (`city`),
  ADD KEY `idx_mob` (`mobile`);

--
-- Indexes for table `tbl_stylist_appoint`
--
ALTER TABLE `tbl_stylist_appoint`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `tbl_user_cart`
--
ALTER TABLE `tbl_user_cart`
  ADD KEY `idx_cart_id` (`cart_id`),
  ADD KEY `idx_product_id` (`product_id`),
  ADD KEY `idx_vendormobile` (`vendor_id`);

--
-- Indexes for table `tbl_user_info`
--
ALTER TABLE `tbl_user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_vendor_master`
--
ALTER TABLE `tbl_vendor_master`
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `tbl_vendor_product_mapping`
--
ALTER TABLE `tbl_vendor_product_mapping`
  ADD PRIMARY KEY (`vendor_id`,`product_id`);

--
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`wishlist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_addressid_generator`
--
ALTER TABLE `tbl_addressid_generator`
  MODIFY `address_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'random id generator',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_attribute_master`
--
ALTER TABLE `tbl_attribute_master`
  MODIFY `attribute_id` int(4) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100023;
--
-- AUTO_INCREMENT for table `tbl_brandid_generator`
--
ALTER TABLE `tbl_brandid_generator`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100023;
--
-- AUTO_INCREMENT for table `tbl_cartid_generator`
--
ALTER TABLE `tbl_cartid_generator`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_categoryid_generator`
--
ALTER TABLE `tbl_categoryid_generator`
  MODIFY `category_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10008;
--
-- AUTO_INCREMENT for table `tbl_city_master`
--
ALTER TABLE `tbl_city_master`
  MODIFY `cityid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'city identity',AUTO_INCREMENT=1095;
--
-- AUTO_INCREMENT for table `tbl_contactus`
--
ALTER TABLE `tbl_contactus`
  MODIFY `contanctus_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'contact id';
--
-- AUTO_INCREMENT for table `tbl_custom_design`
--
ALTER TABLE `tbl_custom_design`
  MODIFY `custom_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'auto incremented custom design',AUTO_INCREMENT=9000;
--
-- AUTO_INCREMENT for table `tbl_designer_product_mapping`
--
ALTER TABLE `tbl_designer_product_mapping`
  MODIFY `designer_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Auto incremented designer id',AUTO_INCREMENT=3500;
--
-- AUTO_INCREMENT for table `tbl_newsletter_master`
--
ALTER TABLE `tbl_newsletter_master`
  MODIFY `news_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'auto incremented Newsid',AUTO_INCREMENT=1000;
--
-- AUTO_INCREMENT for table `tbl_offer_master`
--
ALTER TABLE `tbl_offer_master`
  MODIFY `offer_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'offer id',AUTO_INCREMENT=6000;
--
-- AUTO_INCREMENT for table `tbl_offer_user_mapping`
--
ALTER TABLE `tbl_offer_user_mapping`
  MODIFY `offer_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'offer id used by user',AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_order_master`
--
ALTER TABLE `tbl_order_master`
  MODIFY `order_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'order id',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_productid_generator`
--
ALTER TABLE `tbl_productid_generator`
  MODIFY `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10012;
--
-- AUTO_INCREMENT for table `tbl_registration`
--
ALTER TABLE `tbl_registration`
  MODIFY `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_speak_master`
--
ALTER TABLE `tbl_speak_master`
  MODIFY `speak_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'auto incremented id',AUTO_INCREMENT=3000;
--
-- AUTO_INCREMENT for table `tbl_stylist_appoint`
--
ALTER TABLE `tbl_stylist_appoint`
  MODIFY `appointment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'auto incremented appointment id ',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `wishlist_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Auto Incremented ',AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
