-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2015 at 06:33 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_jzeva_sb`
--
create database db_jzeva;
use db_jzeva;
-- --------------------------------------------------------

--
-- Table structure for table `tbl_brandid_generator`
--

CREATE TABLE IF NOT EXISTS `tbl_brandid_generator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `category_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `brand_category` (`name`,`category_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100013 ;

--
-- Dumping data for table `tbl_brandid_generator`
--

INSERT INTO `tbl_brandid_generator` (`id`, `name`, `category_name`) VALUES
(100009, '', ''),
(100012, 'Jewel', ''),
(100011, 'orra', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categoryid_generator`
--

CREATE TABLE IF NOT EXISTS `tbl_categoryid_generator` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10009 ;

--
-- Dumping data for table `tbl_categoryid_generator`
--

INSERT INTO `tbl_categoryid_generator` (`category_id`, `category_name`) VALUES
(10004, 'Contact Lenses'),
(10007, 'Diamond'),
(10005, 'Entertainment'),
(10006, 'Events'),
(10003, 'Eyeglasses'),
(10000, 'Fashion & Accessories'),
(10001, 'Glasses'),
(10002, 'Sunglasses');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city_master`
--

CREATE TABLE IF NOT EXISTS `tbl_city_master` (
  `cityid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'city identity',
  `cityname` varchar(250) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `state_name` varchar(250) NOT NULL,
  `country_name` varchar(250) NOT NULL,
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedby` varchar(100) NOT NULL,
  `active_flag` bit(1) NOT NULL COMMENT '1-Active | 0-Inactive',
  PRIMARY KEY (`cityid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_city_master`
--

INSERT INTO `tbl_city_master` (`cityid`, `cityname`, `state_name`, `country_name`, `cdt`, `udt`, `updatedby`, `active_flag`) VALUES
(1, 'Delhi', 'delhi', 'India', '0000-00-00 00:00:00', '2015-09-15 17:41:53', '', b'0'),
(2, 'lahore', 'Punjab', 'Pakistan', '0000-00-00 00:00:00', '2015-09-16 15:25:40', '', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_designer_product_mapping`
--

CREATE TABLE IF NOT EXISTS `tbl_designer_product_mapping` (
  `designer_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Auto incremented designer id',
  `product_id` bigint(20) unsigned NOT NULL COMMENT 'product_code',
  `logmobile` bigint(20) unsigned NOT NULL COMMENT 'designer''s registered number',
  `desname` varchar(250) NOT NULL COMMENT 'Designer''s Name',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'update date',
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'created date',
  `active_flag` bit(1) NOT NULL COMMENT '{ 0-Inactive| 1-Active }',
  PRIMARY KEY (`product_id`,`logmobile`,`designer_id`),
  KEY `designer_id` (`designer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_designer_product_mapping`
--

INSERT INTO `tbl_designer_product_mapping` (`designer_id`, `product_id`, `logmobile`, `desname`, `udt`, `cdt`, `active_flag`) VALUES
(1, 10000, 889898989, 'shiamak', '2015-09-16 04:36:20', '2015-09-16 10:06:20', b'1'),
(5, 10000, 889898989, 'shiamak', '2015-09-16 15:30:16', '2015-09-16 21:00:16', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offer_master`
--

CREATE TABLE IF NOT EXISTS `tbl_offer_master` (
  `offid` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'offer id',
  `offername` varchar(100) NOT NULL COMMENT 'name of the offer',
  `des` text NOT NULL COMMENT 'description',
  `amdp` decimal(3,2) NOT NULL COMMENT 'amount discount percentage',
  `valid` varchar(30) NOT NULL COMMENT 'validity in days',
  `vdesc` text NOT NULL COMMENT 'voucher description',
  `active_flag` bit(1) NOT NULL COMMENT '{0-Active | 1-Inactive }',
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'created date ',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'update date',
  PRIMARY KEY (`offid`),
  UNIQUE KEY `offid` (`offid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_offer_master`
--

INSERT INTO `tbl_offer_master` (`offid`, `offername`, `des`, `amdp`, `valid`, `vdesc`, `active_flag`, `cdt`, `udt`) VALUES
(1, 'diwalidhamaka', 'a well reknown festive offer we are celebrating since ages', '1.10', '1 year', '1123fwhf232', b'0', '2015-09-16 15:25:23', '2015-09-16 09:55:23'),
(2, 'diwalidhamaka', 'a well reknown festive offer we are celebrating since ages', '1.10', '1 year', '1123fwhf232', b'0', '2015-09-16 15:25:38', '2015-09-16 09:55:38'),
(3, 'diwalidhamaka', 'a well reknown festive offer we are celebrating since ages', '1.10', '1 year', '1123fwhf232', b'0', '2015-09-16 21:02:39', '2015-09-16 15:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offer_user_mapping`
--

CREATE TABLE IF NOT EXISTS `tbl_offer_user_mapping` (
  `offerid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'offer id used by user',
  `usermobile` bigint(20) unsigned NOT NULL COMMENT 'user login mobile',
  `display_flag` bit(1) NOT NULL COMMENT '1-active 0-inactive',
  `display_position` tinyint(4) unsigned NOT NULL COMMENT 'high-999 low-111',
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'created date',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'updated date',
  `active_flag` bit(1) NOT NULL COMMENT '1-Active | 0-Inactive',
  PRIMARY KEY (`offerid`,`usermobile`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_offer_user_mapping`
--

INSERT INTO `tbl_offer_user_mapping` (`offerid`, `usermobile`, `display_flag`, `display_position`, `cdt`, `udt`, `active_flag`) VALUES
(2, 9975887206, b'1', 255, '2015-09-16 21:04:17', '2015-09-16 15:34:17', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_master`
--

CREATE TABLE IF NOT EXISTS `tbl_order_master` (
  `oid` bigint(20) NOT NULL COMMENT 'order id',
  `usermobile` bigint(20) NOT NULL COMMENT 'user_logmobile',
  `offid` bigint(20) NOT NULL COMMENT 'FK offer table',
  `shopcartid` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT 'shopcart id',
  `ship_scheme` tinyint(2) NOT NULL COMMENT '{1-type1 | 2-type2 | 3-type3 | 4-type4 }',
  `billingname` varchar(250) NOT NULL COMMENT 'Order Person Name',
  `shipp_address` text NOT NULL COMMENT 'ship address',
  `ship_country` tinyint(3) NOT NULL COMMENT 'foreign key country',
  `ship_city` int(5) NOT NULL COMMENT 'F.K. for city related to country index',
  `ship_state` int(5) unsigned NOT NULL COMMENT 'F.K. for state relative to country',
  `bill_address` text NOT NULL,
  `bill_country` tinyint(3) NOT NULL COMMENT 'F.K. for country',
  `bill_state` int(5) unsigned NOT NULL COMMENT 'F.K for state',
  `bill_city` int(5) NOT NULL,
  `bill_pincode` int(6) unsigned NOT NULL,
  `paymentmode` tinyint(2) unsigned NOT NULL COMMENT '{1-Online | 2-On-Delivery }',
  `card_use` set('Debit','Credit','NetBank') NOT NULL,
  `paydate` date NOT NULL,
  `transid` varchar(50) NOT NULL COMMENT 'update after payment confirms',
  `ordstatus` bit(2) NOT NULL COMMENT '0-InActive | 1-Active',
  `dt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productid_generator`
--

CREATE TABLE IF NOT EXISTS `tbl_productid_generator` (
  `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL DEFAULT '',
  `product_brand` varchar(255) DEFAULT '',
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `name_brand` (`product_name`,`product_brand`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10001 ;

--
-- Dumping data for table `tbl_productid_generator`
--

INSERT INTO `tbl_productid_generator` (`product_id`, `product_name`, `product_brand`) VALUES
(10000, 'bluediamond', 'orra');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_attributes`
--

CREATE TABLE IF NOT EXISTS `tbl_product_attributes` (
  `product_id` bigint(20) unsigned NOT NULL,
  `attribute_id` int(4) unsigned NOT NULL,
  `value` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `active_flag` bit(1) NOT NULL,
  `updatedby` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`,`attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_attributes`
--

INSERT INTO `tbl_product_attributes` (`product_id`, `attribute_id`, `value`, `active_flag`, `updatedby`, `updatedon`) VALUES
(7, 111, 'green', b'1', 'CMS_USER', '2015-09-10 11:19:19'),
(8, 111, 'green', b'1', 'CMS_USER', '2015-09-14 04:58:56'),
(9, 21, '32', b'1', 'CMS_USER', '2015-09-14 08:39:57'),
(10000, 111, 'green', b'1', 'CMS_USER', '2015-09-16 04:36:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_master`
--

CREATE TABLE IF NOT EXISTS `tbl_product_master` (
  `product_id` bigint(20) unsigned NOT NULL,
  `barcode` varchar(8) CHARACTER SET utf8 NOT NULL,
  `lotref` varchar(12) CHARACTER SET utf8 NOT NULL,
  `lotno` int(4) unsigned NOT NULL,
  `product_name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `product_display_name` varchar(250) CHARACTER SET utf8 NOT NULL COMMENT 'name displayed on web',
  `product_model` varchar(250) CHARACTER SET utf8 NOT NULL,
  `product_brand` varchar(250) CHARACTER SET utf8 NOT NULL,
  `prd_price` decimal(20,2) NOT NULL,
  `product_currency` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'INR',
  `product_keyword` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `product_desc` text CHARACTER SET utf8,
  `prd_wt` decimal(7,3) NOT NULL,
  `prd_img` text,
  `category_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `product_warranty` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `updatedby` varchar(50) DEFAULT NULL,
  `updatedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_master`
--

INSERT INTO `tbl_product_master` (`product_id`, `barcode`, `lotref`, `lotno`, `product_name`, `product_display_name`, `product_model`, `product_brand`, `prd_price`, `product_currency`, `product_keyword`, `product_desc`, `prd_wt`, `prd_img`, `category_id`, `brand_id`, `product_warranty`, `updatedby`, `updatedon`, `cdt`) VALUES
(7, 'qw211111', '1123', 1133, 'bluediamond', 'marveric blue silver diamond', 'rw231', 'orra', '12211223.02', 'INR', 'blue,silver,diamond', 'a clear cut solitaire diamond in the vault', '223.210', 'abc.jpeg', 1, 100011, '1 year', 'CMS USER', '2015-09-14 08:36:34', '2015-09-14 14:06:34'),
(8, 'qw211111', '1123', 1133, 'Nakshatra', 'marveric blue silver diamond', 'rw231', 'orra', '12211223.02', 'INR', 'blue,silver,diamond', 'a clear cut solitaire diamond in the vault', '223.210', 'abc.jpeg', 1, 100011, '1 year', 'CMS USER', '2015-09-14 04:58:56', '2015-09-14 10:28:56'),
(9, 'asf5sf', '233', 6454, 'helvic bridal ring', 'sfsaf iabvibf aidbvdibv anvvnf', 'twe32ew', 'Jewel', '42242312.02', 'INR', 'helvic', 'wefwfa ewfw ffw ef wfwe fwferf gewrg ewe', '3.010', 'c.png', 2, 100012, '2.3 year', 'CMS USER', '2015-09-14 08:39:57', '2015-09-14 14:09:57'),
(10000, 'qw211111', '1123', 1133, 'bluediamond', 'marveric blue silver diamond', 'rw231', 'orra', '12211223.02', 'INR', 'blue,silver,diamond', 'a clear cut solitaire diamond in the vault', '223.210', 'abc.jpeg', 1, 100011, '1 year', 'CMS USER', '2015-09-16 15:30:16', '2015-09-16 10:06:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_registration`
--

CREATE TABLE IF NOT EXISTS `tbl_registration` (
  `reg_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Auto increment registration key',
  `userName` varchar(250) CHARACTER SET latin7 NOT NULL COMMENT 'Name of the user',
  `gender` bit(1) NOT NULL COMMENT 'title{0-Male|1-Female}',
  `logmobile` bigint(20) unsigned DEFAULT NULL COMMENT 'Mobile registered',
  `password` varchar(250) CHARACTER SET latin7 NOT NULL COMMENT 'password with MD5 encryption',
  `usertype` tinyint(3) NOT NULL DEFAULT '0' COMMENT 'usertype:{0-Guest|1-Customer|2-Vendor|3-Stylist|4-Designer|5-Consultant|6-Admin}',
  `email` varchar(300) CHARACTER SET latin7 NOT NULL COMMENT 'Email address',
  `alt_email` varchar(300) CHARACTER SET latin7 DEFAULT NULL COMMENT 'alternate email address',
  `dob` date NOT NULL COMMENT 'date of birth',
  `working_phone` bigint(20) unsigned NOT NULL,
  `fulladdress` text CHARACTER SET latin7 NOT NULL COMMENT 'street|landmark|area',
  `pincode` int(6) unsigned DEFAULT NULL COMMENT 'postal area code',
  `cityname` varchar(150) CHARACTER SET latin7 NOT NULL COMMENT 'cityname which has already state and country',
  `id_type` varchar(100) CHARACTER SET latin7 NOT NULL COMMENT 'identity type',
  `id_proof_no` varchar(200) CHARACTER SET latin7 NOT NULL COMMENT 'idproof number',
  `active_flag` bit(1) NOT NULL COMMENT 'profile status:{1-Active | 0-Inactive}',
  `cdt` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'Date of creation',
  `udt` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date of updation',
  `is_complete` bit(1) DEFAULT NULL COMMENT 'completed:{0-No|1-Yes}',
  PRIMARY KEY (`reg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='registration for every user' AUTO_INCREMENT=10102 ;

--
-- Dumping data for table `tbl_registration`
--

INSERT INTO `tbl_registration` (`reg_id`, `userName`, `gender`, `logmobile`, `password`, `usertype`, `email`, `alt_email`, `dob`, `working_phone`, `fulladdress`, `pincode`, `cityname`, `id_type`, `id_proof_no`, `active_flag`, `cdt`, `udt`, `is_complete`) VALUES
(10101, 'Shubham Bajpai', b'0', 9975887206, '3b6beb51e76816e632a40d440eab0097', 1, 'shubham@gmail.com', 'shubhambaajpai@gmail.com', '1990-10-10', 7309290529, 'ES 1B/962,Sector A, Jankipuram', 223232, 'delhi', 'DL', 'VH32323HN', b'1', '2015-09-16 20:46:17', '2015-09-16 15:16:17', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stylist_customer_appoint`
--

CREATE TABLE IF NOT EXISTS `tbl_stylist_customer_appoint` (
  `appointid` bigint(20) NOT NULL COMMENT 'auto incremented appointment id ',
  `stylist_id` bigint(20) NOT NULL COMMENT 'stylist logmobile',
  `customer_id` bigint(20) NOT NULL COMMENT 'customer logmobile',
  `appoint_date` date NOT NULL COMMENT 'date of meet up',
  `appoint_time` time NOT NULL COMMENT 'time of meeting',
  `appoint_purpose` text NOT NULL COMMENT 'reason for calling a stylist',
  `meet_status` bit(1) NOT NULL COMMENT '1-still active 0-meet over',
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time of appointing',
  `display_flag` bit(1) NOT NULL COMMENT 'showing flag - 1-Active 0-Inactive',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'moment at which it is updated'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_cart`
--

CREATE TABLE IF NOT EXISTS `tbl_user_cart` (
  `cart_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Cart ID used to show items in cart',
  `product_id` varchar(255) NOT NULL COMMENT 'product id which is added in cart',
  `vendormobile` bigint(20) unsigned NOT NULL COMMENT 'vendor mobile to know product of which vendor is added',
  `usermobile` bigint(20) unsigned NOT NULL COMMENT 'user logmobile for which cart is created',
  `quantity` int(10) NOT NULL DEFAULT '1' COMMENT 'quantity of product that is added in cart',
  `add_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time when the product was added in cart',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date and time when the record was updated',
  `active_flag` bit(1) NOT NULL DEFAULT b'1' COMMENT '1 - active, 0 - removed or deleted',
  PRIMARY KEY (`cart_id`),
  KEY `idx_cart_id` (`cart_id`),
  KEY `idx_product_id` (`product_id`),
  KEY `idx_user_id` (`usermobile`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='user cart to store incomplete transaction' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_user_cart`
--

INSERT INTO `tbl_user_cart` (`cart_id`, `product_id`, `vendormobile`, `usermobile`, `quantity`, `add_date`, `update_date`, `active_flag`) VALUES
(3, '7', 7309290529, 9975887206, 80, '2015-09-16 17:19:51', '2015-09-16 11:49:51', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendor_product_mapping`
--

CREATE TABLE IF NOT EXISTS `tbl_vendor_product_mapping` (
  `vendor_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `vendormobile` bigint(15) NOT NULL,
  `vendor_price` decimal(20,2) DEFAULT '0.00',
  `vendor_quantity` int(11) DEFAULT '0',
  `vendor_currency` varchar(10) DEFAULT 'Rs',
  `vendor_remarks` varchar(255) DEFAULT NULL,
  `active_flag` tinyint(4) DEFAULT '0',
  `updatedby` varchar(50) DEFAULT NULL,
  `updatedon` datetime DEFAULT '0000-00-00 00:00:00',
  `backendupdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`vendor_id`,`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1219 ;

--
-- Dumping data for table `tbl_vendor_product_mapping`
--

INSERT INTO `tbl_vendor_product_mapping` (`vendor_id`, `product_id`, `vendormobile`, `vendor_price`, `vendor_quantity`, `vendor_currency`, `vendor_remarks`, `active_flag`, `updatedby`, `updatedon`, `backendupdate`) VALUES
(1212, 9, 9975887206, '23424.00', 10, 'INR', 'Excellent', 1, 'vendor', '2015-09-10 18:24:54', '2015-09-14 09:16:42'),
(1213, 8, 7309290529, '3300023.00', 3, 'INR', 'Excellent', 1, 'vendor', '2015-09-12 19:39:02', '2015-09-14 09:16:50'),
(1214, 7, 7878787878, '3300023.00', 3, 'INR', 'Excellent', 1, 'vendor', '2015-09-12 19:40:14', '2015-09-14 09:16:59'),
(1215, 9, 7878787878, '554757.00', 1, 'INR', 'Good', 1, 'vendor', '2015-09-14 15:29:08', '2015-09-14 09:59:08'),
(1216, 7, 9975887206, '3300023.00', 3, 'INR', 'Excellent', 1, 'vendor', '2015-09-15 23:10:10', '2015-09-15 17:40:10'),
(1217, 7, 9975887206, '3300023.00', 3, 'INR', 'Excellent', 1, 'vendor', '2015-09-16 20:54:53', '2015-09-16 15:24:53'),
(1218, 7, 9975887206, '3300023.00', 3, 'INR', 'Excellent', 0, 'vendor', '2015-09-16 20:54:58', '2015-09-16 15:24:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_viewlog`
--

CREATE TABLE IF NOT EXISTS `tbl_viewlog` (
  `umob` bigint(15) NOT NULL COMMENT 'for user record',
  `userName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(250) CHARACTER SET utf8 NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `vendormobile` bigint(15) unsigned NOT NULL,
  `updatedby` varchar(50) CHARACTER SET utf8 NOT NULL,
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_viewlog`
--

INSERT INTO `tbl_viewlog` (`umob`, `userName`, `email`, `product_id`, `vendormobile`, `updatedby`, `udt`, `cdt`) VALUES
(9975887206, 'Shushrut Kumar', 'shubham@gmail.com', 7, 9975887206, 'customer', '2015-09-16 09:16:23', '2015-09-16 14:46:23'),
(9975887206, 'Shushrut Kumar', 'shubham@gmail.com', 7, 9975887206, 'customer', '2015-09-16 09:22:58', '2015-09-16 14:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `tb_attribute_mapping`
--

CREATE TABLE IF NOT EXISTS `tb_attribute_mapping` (
  `category_id` int(11) NOT NULL,
  `attribute_id` int(4) unsigned NOT NULL,
  `attr_display_flag` tinyint(4) DEFAULT NULL,
  `attr_display_position` int(11) DEFAULT '999',
  `attr_filter_flag` tinyint(4) DEFAULT NULL,
  `attr_filter_position` int(11) DEFAULT '999',
  `active_flag` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_attribute_mapping`
--

INSERT INTO `tb_attribute_mapping` (`category_id`, `attribute_id`, `attr_display_flag`, `attr_display_position`, `attr_filter_flag`, `attr_filter_position`, `active_flag`) VALUES
(2, 100012, 1, 999, 1, 999, 1),
(3, 43, 1, 999, 1, 999, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_attribute_master`
--

CREATE TABLE IF NOT EXISTS `tb_attribute_master` (
  `attr_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `attr_name` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `attr_display_name` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `attr_unit` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `attr_type_flag` tinyint(4) DEFAULT NULL COMMENT '1-Text Only | 2-Textarea | 3-Numeric | 4-Decimal | 5-DropDown | 6 Date | 7-Checkbox | 8-RadioBtn | 9-Use Pre Defined List',
  `attr_unit_pos` tinyint(4) DEFAULT '0' COMMENT '0-prefix 1-postfix',
  `attr_values` varchar(250) CHARACTER SET utf8 NOT NULL COMMENT 'list of all possible values separated by |~|',
  `attr_range` text CHARACTER SET utf8 COMMENT 'range of numric value it can attain LB and UB separated by |~|',
  `use_list` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `active_flag` bit(1) DEFAULT b'1',
  PRIMARY KEY (`attr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100017 ;

--
-- Dumping data for table `tb_attribute_master`
--

INSERT INTO `tb_attribute_master` (`attr_id`, `attr_name`, `attr_display_name`, `attr_unit`, `attr_type_flag`, `attr_unit_pos`, `attr_values`, `attr_range`, `use_list`, `active_flag`) VALUES
(100012, 'flurocent', 'luminous', '10', 1, 2, '{10,20,30,40,50,60,70}', '10', NULL, b'1'),
(100013, 'flurocent', 'luminous', '10', 1, 2, '{10,20,30,40,50,60,70}', '1', NULL, b'1'),
(100014, 'flurocent', 'luminous', '10', 1, 2, '{10,20,30,40,50,60,70}', '10', NULL, b'1'),
(100015, 'flurocent', 'luminous', '10', 1, 2, '{10,20,30,40,50,60,70}', '1', NULL, b'1'),
(100016, 'flurocent', 'luminous', '10', 1, 2, '{10,20,30,40,50,60,70}', '10', NULL, b'1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
