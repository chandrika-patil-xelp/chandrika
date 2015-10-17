-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2015 at 08:41 AM
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
  `city_id` bigint(20) unsigned NOT NULL COMMENT 'city identity',
  `city_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `state_name` varchar(250) NOT NULL,
  `country_name` varchar(250) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and time on it was created',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was last updated',
  `updated_by` varchar(100) NOT NULL,
  `active_flag` tinyint(2) NOT NULL COMMENT '1-Active | 0-Inactive'
) ENGINE=MyISAM AUTO_INCREMENT=10001 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_city_master`
--

INSERT INTO `tbl_city_master` (`city_id`, `city_name`, `state_name`, `country_name`, `date_time`, `update_time`, `updated_by`, `active_flag`) VALUES
(1, 'Delhi', 'delhi', 'India', '0000-00-00 00:00:00', '2015-09-15 17:41:53', '', 0),
(2, 'Delhi', 'delhi', 'India', '0000-00-00 00:00:00', '2015-09-16 15:25:40', '', 0),
(10000, 'Bhilai', 'Chattisgarh', 'India', '0000-00-00 00:00:00', '2015-09-30 13:18:43', '', 0);

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
  `offerid` bigint(20) unsigned NOT NULL COMMENT 'offer id used by user',
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'user id',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and time on which it was created',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was last updated',
  `active_flag` tinyint(2) NOT NULL COMMENT '1-Active | 0-Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_offer_user_mapping`
--

INSERT INTO `tbl_offer_user_mapping` (`offerid`, `user_id`, `date_time`, `update_time`, `active_flag`) VALUES
(2, 9975887206, '2015-09-16 21:04:17', '2015-09-16 15:34:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_master`
--

CREATE TABLE IF NOT EXISTS `tbl_order_master` (
  `order_id` bigint(20) unsigned NOT NULL COMMENT 'order id',
  `user_id` bigint(20) NOT NULL COMMENT 'login mobile / ip address',
  `cart_id` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT 'shopping cart id',
  `shipAddId` bigint(15) NOT NULL,
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

INSERT INTO `tbl_order_master` (`order_id`, `user_id`, `cart_id`, `shipAddId`, `bill_address_Id`, `transaction_id`, `order_status`, `date_time`, `update_time`, `active_flag`) VALUES
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
  `product_desc` text CHARACTER SET utf8,
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

INSERT INTO `tbl_product_master` (`product_id`, `product_barcode`, `product_lot_reference`, `product_lot_number`, `product_name`, `product_display_name`, `product_model`, `product_brand`, `product_price`, `product_currency`, `product_keyword`, `product_desc`, `product_weight`, `product_image`, `product_warranty`, `updated_by`, `update_time`, `date_time`, `designer_name`) VALUES
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
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'Auto increment registration key',
  `user_name` varchar(250) CHARACTER SET latin7 NOT NULL COMMENT 'Name of the user',
  `logmobile` bigint(20) unsigned DEFAULT NULL COMMENT 'Mobile registered',
  `password` varchar(250) CHARACTER SET latin7 NOT NULL COMMENT 'password with MD5 encryption',
  `user_type` tinyint(3) NOT NULL DEFAULT '0' COMMENT 'usertype:{0-vendor|1-Customer|2-guest|3-Stylist|4-Designer|5-Consultant|6-Admin}',
  `email` varchar(300) CHARACTER SET latin7 NOT NULL COMMENT 'Email address',
  `active_flag` tinyint(2) NOT NULL COMMENT 'profile status:{1-Active | 0-Inactive}',
  `date_time` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'Date of creation',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'date of updation',
  `is_complete` bit(1) DEFAULT NULL COMMENT 'completed:{0-No|1-Yes}',
  `subscribe` bit(1) NOT NULL DEFAULT b'0' COMMENT 'Subscribe {0-No | 1-Yes}'
) ENGINE=MyISAM AUTO_INCREMENT=10106 DEFAULT CHARSET=latin1 COMMENT='registration for every user';

--
-- Dumping data for table `tbl_registration`
--

INSERT INTO `tbl_registration` (`user_id`, `user_name`, `logmobile`, `password`, `user_type`, `email`, `active_flag`, `date_time`, `update_time`, `is_complete`, `subscribe`) VALUES
(10105, 'Shubham Bajpai', 9975887206, '3b6beb51e76816e632a40d440eab0097', 0, 'shubham@gmail.com', 1, '2015-10-05 17:25:10', '2015-10-05 11:55:10', b'0', b'1');

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
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'auto incremented Vendor id',
  `vendor_name` varchar(250) NOT NULL COMMENT 'vendor name',
  `logmob` bigint(20) unsigned NOT NULL COMMENT 'registered number',
  `alternate_mobile` text NOT NULL COMMENT 'working contact numbers',
  `landline` text COMMENT 'land line numbers',
  `address` text COMMENT 'basic address',
  `area` text COMMENT 'popular area name',
  `city` varchar(250) DEFAULT NULL COMMENT 'city name',
  `state` varchar(250) DEFAULT NULL COMMENT 'state name',
  `pincode` varchar(50) DEFAULT NULL COMMENT 'postal area code',
  `website` text COMMENT 'website address',
  `fax` text COMMENT 'fax numbers',
  `lat` decimal(17,15) DEFAULT '0.000000000000000' COMMENT 'lattitude ',
  `lng` decimal(17,15) DEFAULT '0.000000000000000' COMMENT 'longitude',
  `rating` decimal(3,2) DEFAULT '0.00' COMMENT 'rating of vendor',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date and time on which it was created',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp on which it was updated',
  `gender` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vendor_master`
--

INSERT INTO `tbl_vendor_master` (`user_id`, `vendor_name`, `logmob`, `alternate_mobile`, `landline`, `address`, `area`, `city`, `state`, `pincode`, `website`, `fax`, `lat`, `lng`, `rating`, `date_time`, `update_time`, `gender`) VALUES
(10105, 'shivangi', 9975887206, '80887545', '5222362705', 'ho ni payega', 'ddad wdawdad adawd awda wd', 'firozabad', 'UP', '226021', 'yahoo.com', '020221313', '32.323442323420000', '1.231231310000000', '0.00', '2015-10-05 17:25:10', '2015-10-05 11:57:26', b'1');

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
  ADD PRIMARY KEY (`city_id`);

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
  ADD PRIMARY KEY (`offerid`,`user_id`);

--
-- Indexes for table `tbl_order_master`
--
ALTER TABLE `tbl_order_master`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `idx_transid` (`transaction_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_cart_id` (`cart_id`),
  ADD KEY `idx_shipAddId` (`shipAddId`),
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
  ADD PRIMARY KEY (`user_id`);

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
  ADD PRIMARY KEY (`user_id`);

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
  MODIFY `city_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'city identity',AUTO_INCREMENT=10001;
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
  MODIFY `offerid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'offer id used by user',AUTO_INCREMENT=3;
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
  MODIFY `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Auto increment registration key',AUTO_INCREMENT=10106;
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
