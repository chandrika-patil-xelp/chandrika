-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2015 at 04:35 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_jzeva`
--
CREATE DATABASE IF NOT EXISTS `db_jzeva` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_jzeva`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_addid_generator`
--

CREATE TABLE IF NOT EXISTS `tbl_addid_generator` (
  `addid` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'random id generator',
  `user_id` bigint(20) NOT NULL COMMENT 'user logged in mobile',
  PRIMARY KEY (`addid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2000 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address_master`
--

CREATE TABLE IF NOT EXISTS `tbl_address_master` (
  `addid` bigint(20) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `addtitle` int(11) NOT NULL,
  `add1` int(11) NOT NULL,
  `add2` text NOT NULL,
  `fulladd` text NOT NULL,
  `area` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `state` varchar(250) NOT NULL,
  `pincode` int(6) NOT NULL,
  `country` varchar(250) NOT NULL,
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dflag` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brandid_generator`
--

CREATE TABLE IF NOT EXISTS `tbl_brandid_generator` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `category_name` varchar(255) NOT NULL DEFAULT '',
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `aflg` bit(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brand_category` (`name`,`category_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100023 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cartid_generator`
--

CREATE TABLE IF NOT EXISTS `tbl_cartid_generator` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cart_id` varchar(20) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `aflag` bit(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1100 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categoryid_generator`
--

CREATE TABLE IF NOT EXISTS `tbl_categoryid_generator` (
  `category_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL DEFAULT '',
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `aflg` bit(1) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10008 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10001 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contactus_master`
--

CREATE TABLE IF NOT EXISTS `tbl_contactus_master` (
  `cid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'contact id',
  `user_id` bigint(20) unsigned NOT NULL,
  `logmobile` bigint(15) unsigned NOT NULL,
  `cname` varchar(250) DEFAULT NULL COMMENT 'customer name',
  `cemail` varchar(300) DEFAULT NULL COMMENT 'customer email',
  `cquery` text NOT NULL COMMENT 'customre query',
  `dflag` bit(1) NOT NULL DEFAULT b'0' COMMENT 'display flag{0-Inacive | 1-Active}',
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'created date',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'update date',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2000 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_custom_des`
--

CREATE TABLE IF NOT EXISTS `tbl_custom_des` (
  `customid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'auto incremented custom design',
  `title` char(6) NOT NULL COMMENT 'MR|MRS|MISS|MASTER',
  `cname` varchar(150) NOT NULL COMMENT 'customer name',
  `cemail` varchar(300) NOT NULL COMMENT 'customer email',
  `cmob` bigint(15) unsigned NOT NULL COMMENT 'unique id',
  `des_img` text NOT NULL COMMENT '|~| image path name comma separated',
  `dflag` bit(1) NOT NULL DEFAULT b'0' COMMENT 'display flag {0-Inactive | 1-Active}',
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'created date',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'updated date',
  PRIMARY KEY (`customid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9000 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_designer_product_mapping`
--

CREATE TABLE IF NOT EXISTS `tbl_designer_product_mapping` (
  `designer_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Auto incremented designer id',
  `product_id` bigint(20) unsigned NOT NULL COMMENT 'product_code',
  `desname` varchar(250) NOT NULL COMMENT 'Designer''s Name',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'update date',
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'created date',
  `active_flag` bit(1) NOT NULL COMMENT '{ 0-Inactive| 1-Active }',
  PRIMARY KEY (`product_id`,`designer_id`),
  KEY `designer_id` (`designer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3500 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lineage`
--

CREATE TABLE IF NOT EXISTS `tbl_lineage` (
  `catid` bigint(20) unsigned NOT NULL COMMENT 'Auto incremented',
  `p_catid` bigint(20) DEFAULT NULL COMMENT 'parent category id',
  `cat_name` varchar(255) DEFAULT NULL COMMENT 'category name specifi',
  `cat_lvl` tinyint(4) DEFAULT '0' COMMENT 'category depth level',
  `lineage` text COMMENT 'lineage hierarchy',
  `product_flag` tinyint(4) DEFAULT '0' COMMENT '1-product in | 0-Product out'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newsletter_master`
--

CREATE TABLE IF NOT EXISTS `tbl_newsletter_master` (
  `newsid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'auto incremented Newsid',
  `name` varchar(250) DEFAULT NULL COMMENT 'news heading',
  `descr` text COMMENT 'news description',
  `content` longtext COMMENT 'content',
  `dflag` bit(1) NOT NULL COMMENT '{1-Active | 0-Inactive}',
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'created date',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'updated date',
  PRIMARY KEY (`newsid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1000 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news_user_map`
--

CREATE TABLE IF NOT EXISTS `tbl_news_user_map` (
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'user id',
  `newsid` bigint(20) unsigned NOT NULL COMMENT 'newletter id',
  `dflag` bit(1) NOT NULL COMMENT 'display flag',
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'created date',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'update date',
  `dpos` tinyint(4) unsigned NOT NULL DEFAULT '111' COMMENT 'priority{111-low| 999-high}',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6000 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offer_user_mapping`
--

CREATE TABLE IF NOT EXISTS `tbl_offer_user_mapping` (
  `offerid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'offer id used by user',
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'user id',
  `display_flag` bit(1) NOT NULL COMMENT '1-active 0-inactive',
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'created date',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'updated date',
  `active_flag` bit(1) NOT NULL COMMENT '1-Active | 0-Inactive',
  PRIMARY KEY (`offerid`,`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3000 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_master`
--

CREATE TABLE IF NOT EXISTS `tbl_order_master` (
  `oid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'order id',
  `user_id` bigint(20) NOT NULL COMMENT 'login mobile / ip address',
  `cart_id` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT 'shopping cart id',
  `shipAddId` bigint(15) NOT NULL,
  `billAddId` bigint(15) NOT NULL,
  `transid` varchar(50) DEFAULT NULL COMMENT 'update after payment confirms',
  `ordstatus` bit(1) NOT NULL COMMENT '0-InActive | 1-Active',
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dflag` bit(1) NOT NULL DEFAULT b'0' COMMENT 'display flag{0-Inacive | 1-Active}',
  PRIMARY KEY (`oid`),
  KEY `idx_transid` (`transid`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_cart_id` (`cart_id`),
  KEY `idx_shipAddId` (`shipAddId`),
  KEY `idx_billAddId` (`billAddId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=400 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prd_cat_mapping`
--

CREATE TABLE IF NOT EXISTS `tbl_prd_cat_mapping` (
  `product_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `attr_id` text NOT NULL COMMENT '|~| all attributes with in that category',
  `pflag` bit(1) NOT NULL,
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='for lineage and category handling';

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10012 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_attributes`
--

CREATE TABLE IF NOT EXISTS `tbl_product_attributes` (
  `product_id` bigint(20) unsigned NOT NULL,
  `attribute_id` int(4) unsigned NOT NULL,
  `category_id` bigint(15) unsigned NOT NULL,
  `value` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `active_flag` bit(1) NOT NULL,
  `updatedby` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `updatedon` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`,`attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `lineage` varchar(250) DEFAULT NULL COMMENT 'lineage ids set',
  `product_currency` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'INR',
  `product_keyword` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `product_desc` text CHARACTER SET utf8,
  `prd_wt` decimal(7,3) NOT NULL,
  `prd_img` text,
  `category_id` int(11) DEFAULT NULL,
  `product_warranty` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `updatedby` varchar(50) DEFAULT NULL,
  `updatedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `desname` varchar(250) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_registration`
--

CREATE TABLE IF NOT EXISTS `tbl_registration` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Auto increment registration key',
  `userName` varchar(250) CHARACTER SET latin7 NOT NULL COMMENT 'Name of the user',
  `logmobile` bigint(20) unsigned DEFAULT NULL COMMENT 'Mobile registered',
  `password` varchar(250) CHARACTER SET latin7 NOT NULL COMMENT 'password with MD5 encryption',
  `usertype` tinyint(3) NOT NULL DEFAULT '0' COMMENT 'usertype:{0-vendor|1-Customer|2-guest|3-Stylist|4-Designer|5-Consultant|6-Admin}',
  `email` varchar(300) CHARACTER SET latin7 NOT NULL COMMENT 'Email address',
  `active_flag` bit(1) NOT NULL COMMENT 'profile status:{1-Active | 0-Inactive}',
  `cdt` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'Date of creation',
  `udt` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date of updation',
  `is_complete` bit(1) DEFAULT NULL COMMENT 'completed:{0-No|1-Yes}',
  `subscribe` bit(1) NOT NULL DEFAULT b'0' COMMENT 'Subscribe {0-No | 1-Yes}',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='registration for every user' AUTO_INCREMENT=10106 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_speak_master`
--

CREATE TABLE IF NOT EXISTS `tbl_speak_master` (
  `sid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'auto incremented id',
  `name` varchar(50) NOT NULL COMMENT 'user name',
  `city` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL COMMENT 'user email id',
  `mobile` bigint(20) NOT NULL COMMENT 'user mobile number',
  `pimage` text NOT NULL COMMENT 'purchased prd image',
  `opinion` text NOT NULL COMMENT 'users opinion',
  `final_opinion` text NOT NULL COMMENT 'users final opinion',
  `active_flag` bit(1) DEFAULT b'1' COMMENT '0 - Active, 1 - Deleted',
  `upload_time` datetime NOT NULL COMMENT 'testimonial upload time',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `uid` bigint(20) unsigned NOT NULL COMMENT 'user id',
  PRIMARY KEY (`sid`),
  KEY `idx_city` (`city`),
  KEY `idx_mob` (`mobile`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3000 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stylist_appoint`
--

CREATE TABLE IF NOT EXISTS `tbl_stylist_appoint` (
  `appointid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'auto incremented appointment id ',
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'customer logmobile',
  `cust_name` varchar(250) NOT NULL COMMENT 'customer name',
  `cust_email` varchar(300) NOT NULL COMMENT 'email address',
  `fulladd` text NOT NULL COMMENT 'venue of meeting',
  `prd_type` varchar(200) DEFAULT NULL COMMENT 'type of product interested in',
  `category` varchar(200) DEFAULT NULL COMMENT 'category of product',
  `budget` varchar(200) DEFAULT NULL COMMENT '|~|customer budget',
  `sty_mob` bigint(15) unsigned DEFAULT NULL COMMENT 'stylist logmobile',
  `sty_name` varchar(250) DEFAULT NULL COMMENT 'stylist appointed name',
  `meet_status` bit(1) NOT NULL DEFAULT b'0' COMMENT '1-still active 0-meet over',
  `display_flag` bit(1) NOT NULL DEFAULT b'0' COMMENT 'showing flag - 1-Active 0-Inactive',
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time of appointing',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'moment at which it is updated',
  `cust_mobile` bigint(15) unsigned NOT NULL,
  PRIMARY KEY (`appointid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=500 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trans_master`
--

CREATE TABLE IF NOT EXISTS `tbl_trans_master` (
  `transid` bigint(20) unsigned NOT NULL,
  `paytype` varchar(150) NOT NULL,
  `paymode` varchar(150) NOT NULL,
  `card_use` varchar(150) NOT NULL,
  `paydate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `curr` varchar(50) NOT NULL,
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tstatus` bit(1) NOT NULL,
  `tdesc` text NOT NULL,
  `amt` decimal(20,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_cart`
--

CREATE TABLE IF NOT EXISTS `tbl_user_cart` (
  `cart_id` varchar(20) NOT NULL COMMENT 'Unique cart id from generator',
  `product_id` varchar(255) NOT NULL COMMENT 'product id which is added in cart',
  `vid` bigint(20) unsigned NOT NULL COMMENT 'vendor mobile to know product of which vendor is added',
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'user logmobile for which cart is created',
  `quantity` int(10) NOT NULL DEFAULT '1' COMMENT 'quantity of product that is added in cart',
  `add_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time when the product was added in cart',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date and time when the record was updated',
  `active_flag` bit(1) NOT NULL DEFAULT b'1' COMMENT '1 - active, 0 - removed or deleted',
  KEY `idx_cart_id` (`cart_id`),
  KEY `idx_product_id` (`product_id`),
  KEY `idx_vendormobile` (`vid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='user cart to store incomplete transaction';

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
  `cdt` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'Date of creation',
  `udt` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date of updation',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='registration for every user';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendor_master`
--

CREATE TABLE IF NOT EXISTS `tbl_vendor_master` (
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'auto incremented Vendor id',
  `vname` varchar(250) NOT NULL COMMENT 'vendor name',
  `logmob` bigint(20) unsigned NOT NULL COMMENT 'registered number',
  `wrk_cell` text NOT NULL COMMENT 'working contact numbers',
  `landline` text COMMENT 'land line numbers',
  `add1` text COMMENT 'basic address',
  `area` text COMMENT 'popular area name',
  `city` varchar(250) DEFAULT NULL COMMENT 'city name',
  `state` varchar(250) DEFAULT NULL COMMENT 'state name',
  `pincode` varchar(50) DEFAULT NULL COMMENT 'postal area code',
  `website` text COMMENT 'website address',
  `fax` text COMMENT 'fax numbers',
  `lat` decimal(17,15) DEFAULT '0.000000000000000' COMMENT 'lattitude ',
  `lng` decimal(17,15) DEFAULT '0.000000000000000' COMMENT 'longitude',
  `rating` decimal(3,2) DEFAULT '0.00' COMMENT 'rating of vendor',
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'created date',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'updated date',
  `gender` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `active_flag` tinyint(4) DEFAULT '0',
  `updatedby` varchar(50) DEFAULT NULL,
  `updatedon` datetime DEFAULT '0000-00-00 00:00:00',
  `backendupdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`vendor_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_viewlog`
--

CREATE TABLE IF NOT EXISTS `tbl_viewlog` (
  `user_id` bigint(20) NOT NULL COMMENT 'for user record',
  `userName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(250) CHARACTER SET utf8 NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `vid` bigint(20) unsigned NOT NULL,
  `updatedby` varchar(50) CHARACTER SET utf8 NOT NULL,
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE IF NOT EXISTS `tbl_wishlist` (
  `wid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Auto Incremented ',
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'user id ',
  `pid` bigint(20) unsigned NOT NULL COMMENT 'product id',
  `vid` bigint(20) unsigned DEFAULT NULL COMMENT 'vendor id',
  `wf` bit(1) NOT NULL DEFAULT b'0' COMMENT 'wish flag',
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'created date',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'updated date',
  PRIMARY KEY (`wid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3000 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100023 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
