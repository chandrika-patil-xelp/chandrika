-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2015 at 07:19 AM
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
create database db_jzeva;
use db_jzeva;
-- --------------------------------------------------------

--
-- Table structure for table `tbl_addid_generator`
--

CREATE TABLE IF NOT EXISTS `tbl_addid_generator` (
  `addid` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'random id generator',
  `uid` bigint(15) NOT NULL COMMENT 'user logged in mobile',
  PRIMARY KEY (`addid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100023 ;

--
-- Dumping data for table `tbl_brandid_generator`
--

INSERT INTO `tbl_brandid_generator` (`id`, `name`, `category_name`) VALUES
(100009, '', ''),
(100021, 'aaa', 'Glasses'),
(100020, 'aaaaaa', 'Glasses'),
(100015, 'erwewpae', ''),
(100012, 'Jewel', ''),
(100011, 'orra', ''),
(100014, 'pae', ''),
(100013, 'panauche', ''),
(100022, 'qqq', 'Glasses'),
(100019, 'sefafaf', 'Glasses');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cartid_generator`
--

CREATE TABLE IF NOT EXISTS `tbl_cartid_generator` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cart_id` varchar(20) NOT NULL,
  `logmobile` bigint(15) unsigned DEFAULT NULL,
  `ipadd` varchar(200) NOT NULL,
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `aflag` bit(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_cartid_generator`
--

INSERT INTO `tbl_cartid_generator` (`id`, `cart_id`, `logmobile`, `ipadd`, `cdt`, `udt`, `aflag`) VALUES
(7, 'P3E6U7I7', 9975887206, '192.168.2.21', '2015-09-23 22:29:44', '2015-09-23 16:59:44', b'1'),
(8, 'F6A3Y0I4', 8878767576, '192.168.2.22', '2015-09-23 22:45:17', '2015-09-23 17:15:17', b'1'),
(12, 'N1K5N1E1', 7878787878, '192.168.2.20', '2015-09-25 10:36:10', '2015-09-25 05:06:10', b'1'),
(13, 'O5P2Z3T9', 8878787878, '192.168.2.10', '2015-09-25 10:39:09', '2015-09-25 05:09:09', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categoryid_generator`
--

CREATE TABLE IF NOT EXISTS `tbl_categoryid_generator` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10008 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10000 ;

--
-- Dumping data for table `tbl_city_master`
--

INSERT INTO `tbl_city_master` (`cityid`, `cityname`, `state_name`, `country_name`, `cdt`, `udt`, `updatedby`, `active_flag`) VALUES
(1, 'Delhi', 'delhi', 'India', '0000-00-00 00:00:00', '2015-09-15 17:41:53', '', b'0'),
(2, 'lahore', 'Punjab', 'Pakistan', '0000-00-00 00:00:00', '2015-09-16 15:25:40', '', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contactus_master`
--

CREATE TABLE IF NOT EXISTS `tbl_contactus_master` (
  `cid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'contact id',
  `logmobile` bigint(15) unsigned NOT NULL,
  `cname` varchar(250) DEFAULT NULL COMMENT 'customer name',
  `cemail` varchar(300) DEFAULT NULL COMMENT 'customer email',
  `cquery` text NOT NULL COMMENT 'customre query',
  `dflag` bit(1) NOT NULL DEFAULT b'0' COMMENT 'display flag{0-Inacive | 1-Active}',
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'created date',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'update date',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_custom_des`
--

CREATE TABLE IF NOT EXISTS `tbl_custom_des` (
  `customid` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT 'auto incremented custom design',
  `title` char(6) NOT NULL COMMENT 'MR|MRS|MISS|MASTER',
  `cname` varchar(150) NOT NULL COMMENT 'customer name',
  `cemail` varchar(300) NOT NULL COMMENT 'customer email',
  `cmob` bigint(15) unsigned NOT NULL COMMENT 'customer mobile',
  `des_img` text NOT NULL COMMENT '|~| image path name comma separated',
  `dflag` bit(1) NOT NULL DEFAULT b'0' COMMENT 'display flag {0-Inactive | 1-Active}',
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'created date',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'updated date',
  PRIMARY KEY (`customid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_designer_product_mapping`
--

CREATE TABLE IF NOT EXISTS `tbl_designer_product_mapping` (
  `designer_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Auto incremented designer id',
  `product_id` bigint(20) unsigned NOT NULL COMMENT 'product_code',
  `logmobile` bigint(20) unsigned NOT NULL COMMENT 'designer''s registered number',
  `desname` varchar(250) NOT NULL COMMENT 'Designer''s Name',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'update date',
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'created date',
  `active_flag` bit(1) NOT NULL COMMENT '{ 0-Inactive| 1-Active }',
  PRIMARY KEY (`product_id`,`logmobile`,`designer_id`),
  KEY `designer_id` (`designer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `tbl_designer_product_mapping`
--

INSERT INTO `tbl_designer_product_mapping` (`designer_id`, `product_id`, `logmobile`, `desname`, `udt`, `cdt`, `active_flag`) VALUES
(1, 10000, 889898989, 'shiamak', '2015-09-16 04:36:20', '2015-09-16 10:06:20', b'1'),
(5, 10000, 889898989, 'shiamak', '2015-09-16 15:30:16', '2015-09-16 21:00:16', b'1'),
(6, 10000, 889898989, 'shiamak', '2015-09-23 04:54:11', '2015-09-23 10:24:11', b'1'),
(27, 10000, 889898989, 'shiamak', '2015-09-23 06:02:19', '2015-09-23 11:32:19', b'1'),
(28, 10000, 889898989, 'shiamak', '2015-09-23 06:08:17', '2015-09-23 11:38:17', b'1'),
(29, 10000, 889898989, 'shiamak', '2015-09-23 06:08:39', '2015-09-23 11:38:39', b'1'),
(7, 10001, 889898989, 'shiamak', '2015-09-23 04:55:43', '2015-09-23 10:25:43', b'1'),
(8, 10001, 889898989, 'shiamak', '2015-09-23 04:56:31', '2015-09-23 10:26:31', b'1'),
(9, 10002, 889898989, 'shiamak', '2015-09-23 04:57:33', '2015-09-23 10:27:33', b'1'),
(10, 10003, 889898989, 'shiamak', '2015-09-23 04:58:12', '2015-09-23 10:28:12', b'1'),
(11, 10003, 889898989, 'shiamak', '2015-09-23 04:58:41', '2015-09-23 10:28:41', b'1'),
(12, 10004, 889898989, 'shiamak', '2015-09-23 05:00:20', '2015-09-23 10:30:20', b'1'),
(13, 10004, 889898989, 'shiamak', '2015-09-23 05:02:47', '2015-09-23 10:32:47', b'1'),
(14, 10004, 889898989, 'shiamak', '2015-09-23 05:03:10', '2015-09-23 10:33:10', b'1'),
(15, 10004, 889898989, 'shiamak', '2015-09-23 05:03:17', '2015-09-23 10:33:17', b'1'),
(16, 10004, 889898989, 'shiamak', '2015-09-23 05:08:20', '2015-09-23 10:38:20', b'1'),
(17, 10005, 889898989, 'shiamak', '2015-09-23 05:10:18', '2015-09-23 10:40:18', b'1'),
(18, 10005, 889898989, 'shiamak', '2015-09-23 05:10:18', '2015-09-23 10:40:18', b'1'),
(19, 10005, 889898989, 'shiamak', '2015-09-23 05:10:19', '2015-09-23 10:40:19', b'1'),
(20, 10005, 889898989, 'shiamak', '2015-09-23 05:10:28', '2015-09-23 10:40:28', b'1'),
(21, 10006, 889898989, 'shiamak', '2015-09-23 05:11:00', '2015-09-23 10:41:00', b'1'),
(22, 10006, 889898989, 'shiamak', '2015-09-23 05:15:08', '2015-09-23 10:45:08', b'1'),
(23, 10006, 889898989, 'shiamak', '2015-09-23 05:15:10', '2015-09-23 10:45:10', b'1'),
(24, 10006, 889898989, 'shiamak', '2015-09-23 05:15:11', '2015-09-23 10:45:11', b'1'),
(25, 10006, 889898989, 'shiamak', '2015-09-23 05:15:12', '2015-09-23 10:45:12', b'1'),
(26, 10006, 889898989, 'shiamak', '2015-09-23 05:15:33', '2015-09-23 10:45:33', b'1'),
(30, 10008, 889898989, 'shiamak', '2015-09-23 06:09:47', '2015-09-23 11:39:47', b'1'),
(31, 10009, 889898989, 'shiamak', '2015-09-23 06:12:22', '2015-09-23 11:42:22', b'1'),
(32, 10010, 889898989, 'shiamak', '2015-09-23 06:13:43', '2015-09-23 11:43:43', b'1');

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

--
-- Dumping data for table `tbl_lineage`
--

INSERT INTO `tbl_lineage` (`catid`, `p_catid`, `cat_name`, `cat_lvl`, `lineage`, `product_flag`) VALUES
(10000, 0, 'Fashion & Accessories', 1, '', 0),
(10001, 10000, 'Glasses', 2, '~10000~', 0),
(10002, 10001, 'Sunglasses', 3, '~10000~10001~', 0),
(10003, 10001, 'Eyeglasses', 3, '~10000~10001~', 0),
(10004, 10001, 'Contact Lenses', 3, '~10000~10001~', 0),
(100000, 10002, 'Vincent Chase', 4, '~10000~10001~10002~', 0),
(100001, 10002, 'Parim', 4, '~10000~10001~10002~', 0),
(100002, 10002, 'John Jacobs', 4, '~10000~10001~10002~', 0),
(100003, 10002, 'Chhota Bheem', 4, '~10000~10001~10002~', 0),
(100004, 10002, 'Killer', 4, '~10000~10001~10002~', 0),
(100005, 10002, 'Bultaco', 4, '~10000~10001~10002~', 0),
(100006, 10002, 'Baolulai', 4, '~10000~10001~10002~', 0),
(100007, 10002, 'Fastrack', 4, '~10000~10001~10002~', 0),
(100008, 10002, 'Panache', 4, '~10000~10001~10002~', 0),
(1000443, 100000, 'Vincent Chase Colorato VC 5155 Matte Black Grey Gradient 1111/52 Aviator Light Weight Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000496, 100000, 'Vincent Chase VC 5148 Matte Black Grey Gradient 1111/52 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000491, 100000, 'Vincent Chase VC 5147/P Matte Black Grey 1111/50 Wayfarer Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000487, 100000, 'Vincent Chase VC 5147 Matte Grey Transparent Grey Gradient A1A1/52 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000545, 100000, 'Vincent Chase VC 5167 Matte Black Grey 1111V2 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000492, 100000, 'Vincent Chase VC 5147/P Shiny Black Grey 1212/50 Wayfarer Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000481, 100000, 'Vincent Chase VC 5147 Matte Blue Grey Gradient 23D1/52 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000478, 100000, 'Vincent Chase VC 5147 Matte Black Blue Mirror 11A1/No Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000521, 100000, 'Vincent Chase VC 5158/P Black Grey Gradient 1112/VO Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000475, 100000, 'Vincent Chase VC 5147 Matte Black Blue Gradient 1111/27 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000499, 100000, 'Vincent Chase VC 5148/P Shiny Black Grey 1212/50 Wayfarer Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000392, 100001, 'Parim 3406 Purple Blue V1 Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000484, 100000, 'Vincent Chase VC 5147 Matte Blue Transparent Blue Gradient D1D1/27 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000445, 100000, 'Vincent Chase Colorato VC 5156 Black Grey 1112/VO Aviator Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000486, 100000, 'Vincent Chase VC 5147 Matte Grey Transparent Blue Mirror A1A1/No Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000407, 100001, 'Parim 9301 Grey Green Grey Gradient G1 Women''s Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000441, 100000, 'Vincent Chase Colorato VC 5155 Aqua Blue Blue Gradient 2323/52 Aviator Light Weight Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000389, 100001, 'Parim 3403 Brown Brown Gradient B1 Women''s Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000479, 100000, 'Vincent Chase VC 5147 Matte Black Grey Gradient 11B1/52 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000390, 100001, 'Parim 3403 Maroon Blue Gradient V1 Women''s Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000408, 100001, 'Parim 9301 Purple Grey Gradient V1 Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000406, 100001, 'Parim 9301 Grey Brown Grey Gradient S1 Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000489, 100000, 'Vincent Chase VC 5147 S. Black Amber Yellow 1212/E1 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000518, 100000, 'Vincent Chase VC 5158/P Black Blue Gradient 1112/27 Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000391, 100001, 'Parim 3406 Pink Grey Gradient S2 Women''s Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000395, 100001, 'Parim 9207 Pink Pink Gradient R1 Women''s Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000397, 100001, 'Parim 9208 Black Purple Pink Gradient V1 Women''s Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000548, 100000, 'Vincent Chase VC 5167/P Black Green 1212SO Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000506, 100000, 'Vincent Chase VC 5158 Black Blue Mirror 1112/NO Aviator Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000404, 100001, 'Parim 9213 Green Brown Brown Gradient B1 Women''s Polarized Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000449, 100000, 'Vincent Chase Colorato VC 5157 Aqua Green Blue Grey Gradient 23D1/52 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000428, 100000, 'Vincent Chase Chennai Express VC 5135-A Silver Green Aviator Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000505, 100000, 'Vincent Chase VC 5158 Black Blue Gradient 1112/27 Aviator Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000549, 100000, 'Vincent Chase VC 5167/P Light Blue Grey D1D1V2 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000458, 100000, 'Vincent Chase Platinum VC 1025 G Gunmetal Green C200 Aviator Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000403, 100001, 'Parim 9213 Brown Pink Gradient V1 Women''s Polarized Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000533, 100000, 'Vincent Chase VC 5165 Matte Sky Blue Blue Gradient D1D127 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000539, 100000, 'Vincent Chase VC 5166 Matte Black Grey Gradient 1111B2 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000393, 100001, 'Parim 9101 Grey Blue Pink Gradient V1 Women''s Polarized Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000360, 100002, 'John Jacobs JJ 5142 Black Blue Gradient 101027 Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000381, 100002, 'John Jacobs JJ 5148 Black Gunmetal Blue Gradient 1010B2 Wayfarer Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000396, 100001, 'Parim 9208 Black Pink Pink Gradient V1 Women''s Polarized Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000516, 100000, 'Vincent Chase VC 5158 Matte Black Blue Grey 1120/10 Aviator Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000446, 100000, 'Vincent Chase Colorato VC 5156 Gunmetal Grey AO12/21 Aviator Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000265, 100003, 'Chhota Bheem BOB333 Black Grey Wayfarer Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000273, 100003, 'Chhota Bheem BOB361 Black Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000363, 100002, 'John Jacobs JJ 5143 Black Blue Gradient 1010B2 Kids'' Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000368, 100002, 'John Jacobs JJ 5144 Grey Blue Gradient A2A2B2 Wayfarer Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000357, 100002, 'John Jacobs JJ 5141 Black Blue Gradient 101027 Wayfarer Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000334, 100002, 'John Jacobs by Prosun 4179 MG Matt Grey Green Polarized Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000373, 100002, 'John Jacobs JJ 5146 Black Grey Gradient 10P1/B2 Wayfarer Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000359, 100002, 'John Jacobs JJ 5141 Matte Black Blue Gradient 1111B2 Wayfarer Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000323, 100002, 'John Jacobs by Prosun 1908 D Gunmetal Green Men''s Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000495, 100000, 'Vincent Chase VC 5148 Matte Black Blue Mirror 11N1/No Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000367, 100002, 'John Jacobs JJ 5144 Black Blue Gradient 1010/27 Wayfarer Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000274, 100003, 'Chhota Bheem BOB361 Matte Black Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000332, 100002, 'John Jacobs by Prosun 41004 M Matt Black Green Polarized Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000497, 100000, 'Vincent Chase VC 5148 Matte Blue Transparent Grey Gradient 23D1/52 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000511, 100000, 'Vincent Chase VC 5158 Black Yellow Mirror 1130/V1 Aviator Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000524, 100000, 'Vincent Chase VC 5158/P Gunmetal Grey Gradient DO12/VO Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000328, 100002, 'John Jacobs by Prosun 3905 M Matt Black Grey Men''s Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000519, 100000, 'Vincent Chase VC 5158/P Black Green 1112/SO Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000527, 100000, 'Vincent Chase VC 5165 Matte Blue Blue Mirror O2O2P2 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000476, 100000, 'Vincent Chase VC 5147 Matte Black Blue Gradient 1123/27 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000409, 100001, 'Parim 9301 Purple Pink Grey Gradient V1 Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000507, 100000, 'Vincent Chase VC 5158 Black Blue Mirror 1120/U1 Aviator Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000448, 100000, 'Vincent Chase Colorato VC 5157 Aqua Blue Blue D1D1/27 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000326, 100002, 'John Jacobs by Prosun 3903 D Gunmetal Grey Polarized Men''s Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000463, 100000, 'Vincent Chase VC 5102 Matte Black Green Gradient Aviator Men''s Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000471, 100000, 'Vincent Chase VC 5129 Matte Black Blue Gradient 1150 Men''s Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000325, 100002, 'John Jacobs by Prosun 31012 MD Black Gunmetal Grey Gradient Aviator Polarized Men''s Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000372, 100002, 'John Jacobs JJ 5145 Grey Blue N1N1/20 Aviator Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000402, 100001, 'Parim 9213 Brown Green Grey Gradient S1 Women''s Polarized Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000378, 100002, 'John Jacobs JJ 5147 Black Transparent Silver Blue A2DOB2 Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000510, 100000, 'Vincent Chase VC 5158 Black Purple Mirror 1125/W1 Aviator Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000370, 100002, 'John Jacobs JJ 5145 Black Green Gradient 1010/81 Aviator Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000371, 100002, 'John Jacobs JJ 5145 Blue Blue Gradient C2C2/27 Aviator Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000493, 100000, 'Vincent Chase VC 5148 Matte Black Blue Gradient 1111/27 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000353, 100002, 'John Jacobs JJ 3244 Black Green Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000330, 100002, 'John Jacobs by Prosun 41003 M Matt Black Green Polarized Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000285, 100003, 'Chhota Bheem BOB516 Black Yellow Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000387, 100004, 'Killer KL3012 Gunmetal Smoke Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100004~', 1),
(1000329, 100002, 'John Jacobs by Prosun 41002 MG Matt Grey Green Polarized Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000522, 100000, 'Vincent Chase VC 5158/P Golden Blue Gradient 90EO/21 Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000490, 100000, 'Vincent Chase VC 5147 Shiny Black Grey Gradient 1211/52 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000379, 100002, 'John Jacobs JJ 5147 Blue Blue Gradient D2D2/B2 Wayfarer Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000382, 100002, 'John Jacobs JJ 5148 Blue Gunmetal Blue Gradient D2D227 Wayfarer Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000309, 100003, 'Chhota Bheem S806 P Black Blue CE18 Aviator Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000520, 100000, 'Vincent Chase VC 5158/P Black Green 1212/SO Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000485, 100000, 'Vincent Chase VC 5147 Matte Brown Brown Gradient Popo/Io Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000317, 100002, 'John Jacobs 1509 Black Silver Blue Gradient C1 Aviator Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000525, 100000, 'Vincent Chase VC 5158/P Silver Blue Gradient AO12/21 Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000513, 100000, 'Vincent Chase VC 5158 Golden Green 90EO/SO Aviator Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000318, 100002, 'John Jacobs 1509 Golden Brown Gradient C2 Aviator Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000327, 100002, 'John Jacobs by Prosun 3905 AC Brown Brown Gradient Polarized Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000512, 100000, 'Vincent Chase VC 5158 Golden Blue Gradient 90EO/21 Aviator Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000532, 100000, 'Vincent Chase VC 5165 Matte Pink Pink Gradient J2J2Y0 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000376, 100002, 'John Jacobs JJ 5146 Transparent Blue Gradient A2A227 Wayfarer Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000447, 100000, 'Vincent Chase Colorato VC 5156 Silver Grey AO12/50 Aviator Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000364, 100002, 'John Jacobs JJ 5143 Matte Black Blue Gradient 1111/27 Kids'' Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000385, 100002, 'John Jacobs S515 Black Grey C01 Aviator Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000473, 100000, 'Vincent Chase VC 5131 Matte Black Blue Gradient 1150 Aviator Men''s Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000523, 100000, 'Vincent Chase VC 5158/P Gunmetal Blue Gradient Do12/27 Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000528, 100000, 'Vincent Chase VC 5165 Matte Brown Yellow Mirror K2K2L2 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000551, 100000, 'Vincent Chase VC 5167/P Matte Grey Transparent Grey A1A1B2 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000313, 100003, 'Chhota Bheem S830 P Matte Black Grey CE13 Wayfarer Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000279, 100003, 'Chhota Bheem BOB396 Black Grey Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000324, 100002, 'John Jacobs by Prosun 31007 B Black Grey Gradient Polarized Men''s Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000535, 100000, 'Vincent Chase VC 5165 Transparent Purple Purple Gradient F2F2H2 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000438, 100000, 'Vincent Chase Colorato VC 5153 Matte Blue Grey Gradient 2727/52 Polarized Light Weight Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000514, 100000, 'Vincent Chase VC 5158 Gunmetal Blue Gradient DO12/27 Aviator Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000257, 100005, 'Bultaco BTC 3048 Black Grey Col1 Sunglasses', 5, '~10000~10001~10002~100005~', 1),
(1000543, 100000, 'Vincent Chase VC 5166 Matte Grey Transparent Grey Gradient A1A1B2 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000466, 100000, 'Vincent Chase VC 5127 Golden Brown Gradient 9040 Men''s Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000508, 100000, 'Vincent Chase VC 5158 Black Green 1212/SO Aviator Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000530, 100000, 'Vincent Chase VC 5165 Matte Green Green Gradient J1J181 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000440, 100000, 'Vincent Chase Colorato VC 5154 Aqua Blue Blue Gradient D1D1/52 Wayfarer Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000547, 100000, 'Vincent Chase VC 5167 Matte Brown Grey Brown Gradient U2U2I0 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000362, 100002, 'John Jacobs JJ 5142 Matte Grey Green Mirror N1N127 Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000405, 100001, 'Parim 9214 Purple Brown Green Grey Gradient V1 Women''s Polarized Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000515, 100000, 'Vincent Chase VC 5158 Gunmetal Grey Gradient DO12/VO Aviator Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000345, 100002, 'John Jacobs JJ 1508 Brown Brown Gradient C3 Aviator Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000331, 100002, 'John Jacobs by Prosun 41003 MG Matt Grey Green Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000442, 100000, 'Vincent Chase Colorato VC 5155 Aqua Green Grey Gradient D1D1/52 Aviator Light Weight Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000361, 100002, 'John Jacobs JJ 5142 Matte Grey Blue Mirror Z1Z127 Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000465, 100000, 'Vincent Chase VC 5106 Matte Black Blue Gradient Aviator Men''s Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000531, 100000, 'Vincent Chase VC 5165 Matte Pink Blue Gradient G2G2H2 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000488, 100000, 'Vincent Chase VC 5147 Matte Red Transparent Grey Gradient C1D1/52 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000517, 100000, 'Vincent Chase VC 5158 Silver Grey Gradient AO12/VO Aviator Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000468, 100000, 'Vincent Chase VC 5127 Matte Black Grey Gradient 1150 Aviator Men''s Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000426, 100000, 'Vincent Chase A 2305 Black Grey Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000342, 100002, 'John Jacobs JJ 1506 Brown Brown Gradient C3 Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000398, 100001, 'Parim 9209 Maroon Pink Gradient R1 Women''s Polarized Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000498, 100000, 'Vincent Chase VC 5148 Matte Brown Brown Gradient Popo/Io Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000339, 100002, 'John Jacobs JJ 1503 Golden Brown C3 Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000336, 100002, 'John Jacobs by Prosun 4185 MG Matt Grey Green Polarized Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000354, 100002, 'John Jacobs JJ 3244 Gunmetal Grey Green Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000380, 100002, 'John Jacobs JJ 5147 Tortoise Brown Gradient A2E2/IO Wayfarer Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000526, 100000, 'Vincent Chase VC 5158/P Silver Grey Gradient AO12/VO Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000341, 100002, 'John Jacobs JJ 1506 Black Gradient C1 Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000482, 100000, 'Vincent Chase VC 5147 Matte Blue Grey Gradient 23H1/52 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000435, 100000, 'Vincent Chase Colorato 04 Black Pink Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000346, 100002, 'John Jacobs JJ 1508 Gunmetal C2 Aviator Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000295, 100003, 'Chhota Bheem BOB546 Black Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000480, 100000, 'Vincent Chase VC 5147 Matte Black Grey Gradient 11J1/50 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000477, 100000, 'Vincent Chase VC 5147 Matte Black Blue Gradient 11F1/27 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000544, 100000, 'Vincent Chase VC 5167 Matte Black Blue Gradient 1111P2 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000355, 100002, 'John Jacobs JJ 3249 Black Green Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000509, 100000, 'Vincent Chase VC 5158 Black Grey 1112/10 Aviator Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000460, 100000, 'Vincent Chase VC 1301 Cream Brown Gradient Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000454, 100000, 'Vincent Chase Colorato VC P03 Matte Black Pink Grey Gradient BLK/PNK Wayfarer Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000529, 100000, 'Vincent Chase VC 5165 Matte Cream Brown Gradient I2I2IO Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000412, 100000, 'Vincent Chase 60173 Black Grey Polarized Men''s Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000472, 100000, 'Vincent Chase VC 5131 Golden Brown Gradient 9040 Aviator Men''s Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000337, 100002, 'John Jacobs JJ 1501 Brown Brown Gradient C3 Aviator Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000297, 100003, 'Chhota Bheem BOB556 Black White Silver Mirror Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000338, 100002, 'John Jacobs JJ 1501 Gunmetal Grey Gradient C2 Aviator Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000321, 100002, 'John Jacobs by Prosun 11028 D Gunmetal Green Polarized Men''s Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000369, 100002, 'John Jacobs JJ 5144 Tortoise Brown Gradient Y1Y1/I0 Wayfarer Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000366, 100002, 'John Jacobs JJ 5143 Tortoise Brown Gradient Y1Y1/IO Wayfarer Kids'' Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000358, 100002, 'John Jacobs JJ 5141 Brown Brown Gradient Y1Y1IO Wayfarer Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000305, 100003, 'Chhota Bheem BOB558 Matte Sky Blue Blue Mirror Gradient Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000302, 100003, 'Chhota Bheem BOB558 Matte Black Silver Mirror Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000383, 100002, 'John Jacobs JJ 5148 Brown Tortoise Golden Brown Gradient Y1E2IO Wayfarer Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000374, 100002, 'John Jacobs JJ 5146 Brown Tortoise Brown Y1Y140 Wayfarer Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000432, 100000, 'Vincent Chase Colorato 03 Black Yellow Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000542, 100000, 'Vincent Chase VC 5166 Matte Grey Grey Gradient N1N1B2 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000437, 100000, 'Vincent Chase Colorato VC 5134 Black Grey Silver Mirror 50J0 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000503, 100000, 'Vincent Chase VC 5150 Matte Blue Grey Gradient D1D1/52 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000537, 100000, 'Vincent Chase VC 5166 Matte Black Blue Mirror 1111P2 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000394, 100001, 'Parim 9207 Grey Design Grey Gradient S1 Polarized Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000434, 100000, 'Vincent Chase Colorato 04 Black Green Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000540, 100000, 'Vincent Chase VC 5166 Matte Blue Blue Gradient O2O227 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000538, 100000, 'Vincent Chase VC 5166 Matte Black Brown Gradient 111110 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000344, 100002, 'John Jacobs JJ 1508 Black Grey Gradient C1 Aviator Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000421, 100000, 'Vincent Chase A 2254 Gunmetal Grey Polarized Men''s Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000431, 100000, 'Vincent Chase Colorato 02 Blue Yellow Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000436, 100000, 'Vincent Chase Colorato 04 Black Purple Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000433, 100000, 'Vincent Chase Colorato 03 Pink Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000419, 100000, 'Vincent Chase A 2227 Black Grey Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000474, 100000, 'Vincent Chase VC 5147 M. Turquoise Transparent Grey Gradient G1G1/52 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000375, 100002, 'John Jacobs JJ 5146 Transparent Blue Gradient A2A2/27 Wayfarer Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000452, 100000, 'Vincent Chase Colorato VC P01 Matte Black Yellow Blue Gradient BLK/YLW Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000278, 100003, 'Chhota Bheem BOB395 Black Orange Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000494, 100000, 'Vincent Chase VC 5148 Matte Black Blue Gradient 1123/27 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000292, 100003, 'Chhota Bheem BOB534 Black Yellow Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000456, 100000, 'Vincent Chase Colorato VC P04 Pink Grey PNK Wayfarer Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000365, 100002, 'John Jacobs JJ 5143 Matte Black Blue Gradient 1111/27 Wayfarer Kids'' Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000263, 100003, 'Chhota Bheem BOB245 Matte Black Silver Mirror Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000461, 100000, 'Vincent Chase VC 1301 Maroon Transparent Grey Gradient Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000420, 100000, 'Vincent Chase A 2227 Gunmetal Grey Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000483, 100000, 'Vincent Chase VC 5147 Matte Blue Grey Gradient 23I1/52 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000457, 100000, 'Vincent Chase M 1049 Gunmetal Grey Polarized Men''s Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000377, 100002, 'John Jacobs JJ 5147 Black Tortoise Golden Brown Gradient A2E2IO Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000459, 100000, 'Vincent Chase VC 1301 Black Tortoise Grey Gradient Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000340, 100002, 'John Jacobs JJ 1503 Silver C1 Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000451, 100000, 'Vincent Chase Colorato VC 5157 Aqua Green White Grey Gradient 2311/52 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000356, 100002, 'John Jacobs JJ 3249 Gunmetal Green Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000418, 100000, 'Vincent Chase A 2131 Gunmetal Grey Polarized Men''s Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000311, 100003, 'Chhota Bheem S830 P Black Grey CE11 Wayfarer Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000534, 100000, 'Vincent Chase VC 5165 Matte Sky Blue Blue Mirror M2M2N2 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000307, 100003, 'Chhota Bheem BOB559 Matte Black Silver Mirror Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000306, 100003, 'Chhota Bheem BOB559 Black Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000500, 100000, 'Vincent Chase VC 5150 Matte Black Blue Gradient 1111/27 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000351, 100002, 'John Jacobs JJ 3239 Black Green Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000430, 100000, 'Vincent Chase Colorato 02 Black Green Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000352, 100002, 'John Jacobs JJ 3239 Gunmetal Green Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000541, 100000, 'Vincent Chase VC 5166 Matte Grey Blue Mirror N1N110 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000455, 100000, 'Vincent Chase Colorato VC P03 Matte Black Purple Grey Gradient BLK/PUR Wayfarer Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000281, 100003, 'Chhota Bheem BOB512 Black Red Grey Wayfarer Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000422, 100000, 'Vincent Chase A 2300 Gunmetal Green Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000415, 100000, 'Vincent Chase 9324 Black Grey Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000288, 100003, 'Chhota Bheem BOB531 Black Transparent Grey Wayfarer Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000322, 100002, 'John Jacobs by Prosun 11029 D Gunmetal Green Polarized Men''s Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000410, 100001, 'Parim 9302 Maroon Transparent Grey Pink Gradient R1 Women''s Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000450, 100000, 'Vincent Chase Colorato VC 5157 Aqua Green Grey Gradient T1T1/52 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000536, 100000, 'Vincent Chase VC 5166 Brown Grey Brown Gradient U2U2I0 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000424, 100000, 'Vincent Chase A 2302 Black Grey Polarized Men''s Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000268, 100003, 'Chhota Bheem BOB333 Matte Black Grey Wayfarer Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000258, 100003, 'Chhota Bheem BOB216 Black Grey Aviator Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000411, 100000, 'Vincent Chase 60167 Black Grey Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000256, 100005, 'Bultaco BTC 3045 Black Silver Line Grey Col2 Sunglasses', 5, '~10000~10001~10002~100005~', 1),
(1000464, 100000, 'Vincent Chase VC 5104 Golden Brown Gradient Men''s Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000453, 100000, 'Vincent Chase Colorato VC P03 Blue Yellow Grey BLU/YLW Wayfarer Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000301, 100003, 'Chhota Bheem BOB558 Black Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000439, 100000, 'Vincent Chase Colorato VC 5153 Matte Brown Gradient POPO/IO Light Weight Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000413, 100000, 'Vincent Chase 60173 Gunmetal Green Polarized Men''s Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000272, 100003, 'Chhota Bheem BOB359 Black Orange Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000280, 100003, 'Chhota Bheem BOB396 Blue Grey Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000417, 100000, 'Vincent Chase A 2131 Black Grey Polarized Men''s Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000469, 100000, 'Vincent Chase VC 5128 Gunmetal Blue Gradient DO50 Aviator Men''s Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000347, 100002, 'John Jacobs JJ 3205 Black Green Polarized Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000290, 100003, 'Chhota Bheem BOB532 Blue Yellow Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000401, 100001, 'Parim 9213 Brown Green Blue Gradient S1 Women''s Polarized Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000425, 100000, 'Vincent Chase A 2304 Gunmetal Grey Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000304, 100003, 'Chhota Bheem BOB558 Matte Orange Yellow Mirror Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000470, 100000, 'Vincent Chase VC 5129 Copper Brown Gradient 4040 Men''s Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000423, 100000, 'Vincent Chase A 2300 Gunmetal Grey Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000414, 100000, 'Vincent Chase 60173 Gunmetal Grey Polarized Men''s Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000308, 100003, 'Chhota Bheem BOB810 Light Pink Pink Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000550, 100000, 'Vincent Chase VC 5167/P Matte Blue Grey Gradient O2O2B2 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000429, 100000, 'Vincent Chase Colorato 01 Blue Yellow Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000552, 100000, 'Vincent Chase VC S001 Matte Black Green Men''s Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000467, 100000, 'Vincent Chase VC 5127 Gunmetal Grey Brown Gradient D050 Aviator Men''s Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000462, 100000, 'Vincent Chase VC 1301 Matte Brown Gradient Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000386, 100002, 'John Jacobs S888 Matte Golden Grey Gradient C4 Aviator Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000255, 100006, 'Baolulai BLL008 Black Grey Unisex Sunglasses', 5, '~10000~10001~10002~100006~', 1),
(1000416, 100000, 'Vincent Chase 9324 Gunmetal Grey Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000502, 100000, 'Vincent Chase VC 5150 Matte Black Grey Gradient 1111/52 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000348, 100002, 'John Jacobs JJ 3205 Gunmetal Grey Green Polarized Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000427, 100000, 'Vincent Chase A 2325 Gunmetal Grey Polarized Men''s Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000343, 100002, 'John Jacobs JJ 1506 Gunmetal Grey Gradient C2 Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000335, 100002, 'John Jacobs by Prosun 4185 M Matt Black Green Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000312, 100003, 'Chhota Bheem S830 P Blue Yellow Grey CE12 Wayfarer Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000277, 100003, 'Chhota Bheem BOB363 Matte Black Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000269, 100003, 'Chhota Bheem BOB333 Red Pink Wayfarer Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000293, 100003, 'Chhota Bheem BOB534 Blue Yellow Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000314, 100007, 'Fastrack P185BR1F Black Green 04Y Unisex Sunglasses', 5, '~10000~10001~10002~100007~', 1),
(1000333, 100002, 'John Jacobs by Prosun 4179 M Matt Black Green Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000320, 100002, 'John Jacobs 9201 Golden Brown Gradient B1 Polarized Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000349, 100002, 'John Jacobs JJ 3234 Black Green Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000319, 100002, 'John Jacobs 3313 Gunmetal Grey Gradient A1 Women''s Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000264, 100003, 'Chhota Bheem BOB245 White Silver Mirror Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000400, 100001, 'Parim 9212 Black Tortoise Grey Gradient S1 Women''s Polarized Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000310, 100003, 'Chhota Bheem S806 P Matte Black Blue CE21 Aviator Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000270, 100003, 'Chhota Bheem BOB339 Black Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000294, 100003, 'Chhota Bheem BOB534 Grey Yellow Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000259, 100003, 'Chhota Bheem BOB216 Grey Grey Aviator Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000260, 100003, 'Chhota Bheem BOB216 Orange Brown Aviator Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000275, 100003, 'Chhota Bheem BOB361 Silver Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000296, 100003, 'Chhota Bheem BOB546 Silver Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000298, 100003, 'Chhota Bheem BOB556 Green White Silver Mirror Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000501, 100000, 'Vincent Chase VC 5150 Matte Black Blue Gradient 1123/27 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000399, 100001, 'Parim 9212 Black Tortoise Blue Gradient S1 Women''s Polarized Sunglasses', 5, '~10000~10001~10002~100001~', 1),
(1000286, 100003, 'Chhota Bheem BOB516 Blue Yellow Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000267, 100003, 'Chhota Bheem BOB333 Light Blue Blue Gradient Wayfarer Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000300, 100003, 'Chhota Bheem BOB556 Red White Silver Mirror Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000299, 100003, 'Chhota Bheem BOB556 Pink White Silver Mirror Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000444, 100000, 'Vincent Chase Colorato VC 5155 Matte Brown Brown Gradient POPO/10 Aviator Light Weight Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000350, 100002, 'John Jacobs JJ 3234 Gunmetal Green Aviator Polarized Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(1000262, 100003, 'Chhota Bheem BOB245 Grey Silver Mirror Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000303, 100003, 'Chhota Bheem BOB558 Matte Green Blue Mirror Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000282, 100003, 'Chhota Bheem BOB512 Cream Red Brown Wayfarer Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000283, 100003, 'Chhota Bheem BOB512 Light Green White Blue Gradient Wayfarer Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000289, 100003, 'Chhota Bheem BOB531 Pink Transparent Pink Wayfarer Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000315, 100007, 'Fastrack PC002BR7 Yellow Black Brown Wayfarer Sunglasses', 5, '~10000~10001~10002~100007~', 1),
(1000504, 100000, 'Vincent Chase VC 5154 Matte Brown Gradient POPO/IO Wayfarer Polarized Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000287, 100003, 'Chhota Bheem BOB516 Grey Red Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000266, 100003, 'Chhota Bheem BOB333 Grey Grey Wayfarer Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000291, 100003, 'Chhota Bheem BOB532 Grey Red Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000271, 100003, 'Chhota Bheem BOB339 Pink Maroon Design Pink Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000276, 100003, 'Chhota Bheem BOB363 Black Grey Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000284, 100003, 'Chhota Bheem BOB512 Pink White Pink Wayfarer Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000546, 100000, 'Vincent Chase VC 5167 Matte Black Yellow Mirror 1111W2 Wayfarer Sunglasses', 5, '~10000~10001~10002~100000~', 1),
(1000261, 100003, 'Chhota Bheem BOB245 Black Silver Mirror Kids'' Sunglasses', 5, '~10000~10001~10002~100003~', 1),
(1000316, 100007, 'Fastrack Sunglasses Summer - Model:P117WH3', 5, '~10000~10001~10002~100007~', 1),
(1000388, 100008, 'Panache New Age Black White Blue Gradient C1-1 Aviator Sunglasses', 5, '~10000~10001~10002~100008~', 1),
(1000384, 100002, 'John Jacobs S371 Golden Tortoise Brown Gradient C6 Aviator Sunglasses', 5, '~10000~10001~10002~100002~', 1),
(10005, 0, 'Entertainment', 1, '', 0),
(10006, 10005, 'Events', 2, '~10005~', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10011 ;

--
-- Dumping data for table `tbl_productid_generator`
--

INSERT INTO `tbl_productid_generator` (`product_id`, `product_name`, `product_brand`) VALUES
(10007, '', ''),
(10009, 'aaaaaaaa', 'aaa'),
(10000, 'bluediamond', 'orra'),
(10010, 'qqq', 'qqq'),
(10008, 'sdfsfwfwf', 'aaaaaa'),
(10001, 'Sui Dhaga', 'panauche'),
(10004, 'Sui1 Dhaga', 'dfwefwe'),
(10003, 'Sui1 Dhaga', 'erwewpae'),
(10002, 'Sui1 Dhaga', 'pae'),
(10006, 'Sui1 Dhaga', 'sefafaf'),
(10005, 'Sui1 Dhaga', 'sfaf');

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

--
-- Dumping data for table `tbl_product_attributes`
--

INSERT INTO `tbl_product_attributes` (`product_id`, `attribute_id`, `category_id`, `value`, `active_flag`, `updatedby`, `updatedon`) VALUES
(7, 111, 0, 'green', b'1', 'CMS_USER', '2015-09-10 11:19:19'),
(8, 43, 3, 'green', b'1', 'CMS_USER', '2015-09-14 04:58:56'),
(9, 43, 0, 'kj', b'1', 'CMS_USER', '2015-09-14 08:39:57'),
(9, 100014, 0, 'earring', b'1', 'CMS_USER', '2015-09-23 04:55:43'),
(10000, 100014, 3, 'necklace', b'1', 'CMS_USER', '2015-09-16 04:36:20'),
(10002, 111, 0, 'green', b'1', 'CMS_USER', '2015-09-23 04:57:33'),
(10003, 111, 0, 'green', b'1', 'CMS_USER', '2015-09-23 04:58:12'),
(10004, 111, 0, 'earring', b'1', 'CMS_USER', '2015-09-23 05:00:20'),
(10005, 111, 0, 'green', b'1', 'CMS_USER', '2015-09-23 05:10:18'),
(10006, 111, 0, 'green', b'1', 'CMS_USER', '2015-09-23 05:11:00'),
(10008, 111, 0, 'green', b'1', 'CMS_USER', '2015-09-23 06:09:47'),
(10009, 111, 0, 'blue', b'1', 'CMS_USER', '2015-09-23 06:12:22'),
(10010, 111, 0, 'green', b'1', 'CMS_USER', '2015-09-23 06:13:43');

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
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_master`
--

INSERT INTO `tbl_product_master` (`product_id`, `barcode`, `lotref`, `lotno`, `product_name`, `product_display_name`, `product_model`, `product_brand`, `prd_price`, `lineage`, `product_currency`, `product_keyword`, `product_desc`, `prd_wt`, `prd_img`, `category_id`, `product_warranty`, `updatedby`, `updatedon`, `cdt`) VALUES
(7, 'qw211111', '1123', 1133, 'bluediamond', 'marveric blue silver diamond', 'rw231', 'orra', '5.02', NULL, 'INR', 'blue,silver,diamond', 'a clear cut solitaire diamond in the vault', '223.210', 'abc.jpeg', 1, '1 year', 'CMS USER', '2015-09-14 08:36:34', '2015-09-14 14:06:34'),
(8, 'qw211111', '1123', 1133, 'Nakshatra', 'marveric blue silver diamond', 'rw231', 'orra', '12211223.02', NULL, 'INR', 'blue,silver,diamond', 'a clear cut solitaire diamond in the vault', '223.210', 'abc.jpeg', 1, '1 year', 'CMS USER', '2015-09-14 04:58:56', '2015-09-14 10:28:56'),
(9, 'asf5sf', '233', 6454, 'helvic bridal ring', 'sfsaf iabvibf aidbvdibv anvvnf', 'twe32ew', 'Jewel', '302.09', NULL, 'INR', 'helvic', 'wefwfa ewfw ffw ef wfwe fwferf gewrg ewe', '3.010', 'c.png', 2, '2.3 year', 'CMS USER', '2015-09-14 08:39:57', '2015-09-14 14:09:57'),
(10000, 'qw211111', '1123', 1133, 'bluediamond', 'marveric blue silver diamond', 'rw231', 'orra', '12211223.02', NULL, 'INR', 'blue,silver,diamond', 'a clear cut solitaire diamond in the vault', '223.210', 'abc.jpeg', 1, '1 year', 'CMS USER', '2015-09-23 06:08:39', '2015-09-16 10:06:20'),
(10008, 'ssf1111', '1222', 3212, 'sdfsfwfwf', 'sfsf eefwfw weffewf', 'rw2ewwd1', 'aaaaaa', '12211223.02', NULL, 'INR', 'blue,silver,diamond', 'a clear cut solitaire diamond in the vault', '223.210', 'abc.jpeg', 10001, '1 year', 'CMS USER', '2015-09-23 06:10:08', '2015-09-23 11:39:47'),
(10009, 'aaa1111', '2222', 3232, 'aaaaaaaa', 'aaaa aa aaaaaa', 'aa32aa2', 'aaa', '12211223.02', NULL, 'INR', 'blue,silver,diamond', 'a clear cut solitaire diamond in the vault', '223.210', 'abc.jpeg', 10001, '1 year', 'CMS USER', '2015-09-23 06:12:22', '2015-09-23 11:42:22'),
(10010, 'aaa1111', '2222', 3232, 'qqq', 'qqq qq qqq', 'aa3qqqw2', 'qqq', '12211223.02', NULL, 'INR', 'blue,silver,diamond', 'a clear cut solitaire diamond in the vault', '223.210', 'abc.jpeg', 10001, '1 year', 'CMS USER', '2015-09-23 06:13:43', '2015-09-23 11:43:43');

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
  `subscribe` bit(1) NOT NULL DEFAULT b'0' COMMENT 'Subscribe {0-No | 1-Yes}',
  PRIMARY KEY (`reg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='registration for every user' AUTO_INCREMENT=10102 ;

--
-- Dumping data for table `tbl_registration`
--

INSERT INTO `tbl_registration` (`reg_id`, `userName`, `gender`, `logmobile`, `password`, `usertype`, `email`, `alt_email`, `dob`, `working_phone`, `fulladdress`, `pincode`, `cityname`, `id_type`, `id_proof_no`, `active_flag`, `cdt`, `udt`, `is_complete`, `subscribe`) VALUES
(10101, 'Shubham Bajpai', b'0', 9975887206, '3b6beb51e76816e632a40d440eab0097', 2, 'shubham@gmail.com', 'shubhambaajpai@gmail.com', '1990-10-10', 7309290529, 'ES 1B/962,Sector A, Jankipuram', 223232, 'delhi', 'DL', 'VH32323HN', b'1', '2015-09-16 20:46:17', '2015-09-16 15:16:17', b'0', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_speak_master`
--

CREATE TABLE IF NOT EXISTS `tbl_speak_master` (
  `sid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'user id',
  `name` varchar(50) NOT NULL COMMENT 'user name',
  `city` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL COMMENT 'user email id',
  `mobile` bigint(20) NOT NULL COMMENT 'user mobile number',
  `pimage` text NOT NULL COMMENT 'purchased prd image',
  `opinion` text NOT NULL COMMENT 'users opinion',
  `final_opinion` text NOT NULL COMMENT 'users final opinion',
  `active_flag` bit(1) DEFAULT NULL COMMENT '0 - Active, 1 - Deleted',
  `upload_time` datetime NOT NULL COMMENT 'testimonial upload time',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sid`),
  KEY `idx_city` (`city`),
  KEY `idx_mob` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stylist_appoint`
--

CREATE TABLE IF NOT EXISTS `tbl_stylist_appoint` (
  `appointid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'auto incremented appointment id ',
  `cust_mobile` bigint(15) unsigned NOT NULL COMMENT 'customer logmobile',
  `cust_name` varchar(250) NOT NULL COMMENT 'customer name',
  `cust_email` varchar(300) NOT NULL COMMENT 'email address',
  `fulladd` text NOT NULL COMMENT 'venue of meeting',
  `prd_type` varchar(200) DEFAULT NULL COMMENT 'type of product interested in',
  `category` varchar(200) DEFAULT NULL COMMENT 'category of product',
  `budget` decimal(20,2) DEFAULT NULL COMMENT 'customer budget',
  `sty_mob` bigint(15) unsigned DEFAULT NULL COMMENT 'stylist logmobile',
  `sty_name` varchar(250) DEFAULT NULL COMMENT 'stylist appointed name',
  `meet_status` bit(1) NOT NULL DEFAULT b'0' COMMENT '1-still active 0-meet over',
  `display_flag` bit(1) NOT NULL DEFAULT b'0' COMMENT 'showing flag - 1-Active 0-Inactive',
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time of appointing',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'moment at which it is updated',
  PRIMARY KEY (`appointid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_cart`
--

CREATE TABLE IF NOT EXISTS `tbl_user_cart` (
  `cart_id` varchar(20) NOT NULL COMMENT 'Unique cart id from generator',
  `product_id` varchar(255) NOT NULL COMMENT 'product id which is added in cart',
  `vendormobile` bigint(20) unsigned NOT NULL COMMENT 'vendor mobile to know product of which vendor is added',
  `usermobile` bigint(20) unsigned NOT NULL COMMENT 'user logmobile for which cart is created',
  `quantity` int(10) NOT NULL DEFAULT '1' COMMENT 'quantity of product that is added in cart',
  `add_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time when the product was added in cart',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date and time when the record was updated',
  `active_flag` bit(1) NOT NULL DEFAULT b'1' COMMENT '1 - active, 0 - removed or deleted',
  KEY `idx_cart_id` (`cart_id`),
  KEY `idx_product_id` (`product_id`),
  KEY `idx_vendormobile` (`vendormobile`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='user cart to store incomplete transaction';

--
-- Dumping data for table `tbl_user_cart`
--

INSERT INTO `tbl_user_cart` (`cart_id`, `product_id`, `vendormobile`, `usermobile`, `quantity`, `add_date`, `update_date`, `active_flag`) VALUES
('P3E6U7I7', '9', 7309290529, 9975887206, 17, '2015-09-23 22:36:01', '2015-09-23 17:06:01', b'1'),
('P3E6U7I7', '7', 7309290529, 9975887206, 6, '2015-09-23 22:38:57', '2015-09-23 17:08:57', b'1'),
('F6A3Y0I4', '7', 7309290529, 8878767576, 1, '2015-09-23 22:45:17', '2015-09-23 17:15:17', b'1'),
('F6A3Y0I4', '9', 7309290529, 8878767576, 2, '2015-09-23 22:46:02', '2015-09-23 17:16:02', b'1'),
('P3E6U7I7', '9', 7309290529, 7878787878, 4, '2015-09-25 10:35:08', '2015-09-25 05:05:08', b'1'),
('O5P2Z3T9', '9', 7309290529, 8878787878, 2, '2015-09-25 10:39:09', '2015-09-25 05:09:09', b'1'),
('O5P2Z3T9', '9', 7309290529, 0, 1, '2015-09-25 10:58:01', '2015-09-25 05:28:01', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendorid_generator`
--

CREATE TABLE IF NOT EXISTS `tbl_vendorid_generator` (
  `vendorid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vname` varchar(200) NOT NULL,
  `logmob` bigint(20) unsigned NOT NULL,
  `cdt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`vendorid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_vendorid_generator`
--

INSERT INTO `tbl_vendorid_generator` (`vendorid`, `vname`, `logmob`, `cdt`) VALUES
(1, 'arun singh', 9421522299, '2015-09-24 09:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendor_master`
--

CREATE TABLE IF NOT EXISTS `tbl_vendor_master` (
  `vendorid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'auto incremented Vendor id',
  `vname` varchar(250) NOT NULL COMMENT 'vendor name',
  `pass` varchar(250) NOT NULL COMMENT 'password',
  `email` text NOT NULL COMMENT 'primary email',
  `logmob` bigint(20) unsigned NOT NULL COMMENT 'registered number',
  `wrk_cell` text NOT NULL COMMENT 'working contact numbers',
  `landline` text COMMENT 'land line numbers',
  `add1` text COMMENT 'basic address',
  `add2` text COMMENT 'landmark address',
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
  `aflag` bit(1) NOT NULL DEFAULT b'0' COMMENT 'Is active {0-Inactive | 1-Active}',
  PRIMARY KEY (`vendorid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_vendor_master`
--

INSERT INTO `tbl_vendor_master` (`vendorid`, `vname`, `pass`, `email`, `logmob`, `wrk_cell`, `landline`, `add1`, `add2`, `area`, `city`, `state`, `pincode`, `website`, `fax`, `lat`, `lng`, `rating`, `cdt`, `udt`, `aflag`) VALUES
(1, 'arun singh', '5c8a7a44d2edb7092f26d791873dba57', 'singharun@gmail.com', 9421522299, '887878788', '0232222132', 'jangalganj', 'rajokumar', 'ddad wdawdad adawd awda wd', 'banglore', 'karnatka', '323222', 'yahoo.com', '43322323', '0.000000000000000', '0.000000000000000', '0.00', '2015-09-24 14:56:47', '2015-09-24 09:40:22', b'1');

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
(1212, 9, 7309290529, '23424.00', 10, 'INR', 'Excellent', 1, 'vendor', '2015-09-10 18:24:54', '2015-09-23 07:36:19'),
(1213, 8, 7309290529, '3300023.00', 3, 'INR', 'Excellent', 1, 'vendor', '2015-09-12 19:39:02', '2015-09-14 09:16:50'),
(1214, 7, 7878787878, '3300023.00', 3, 'INR', 'Excellent', 1, 'vendor', '2015-09-12 19:40:14', '2015-09-14 09:16:59'),
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
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE IF NOT EXISTS `tbl_wishlist` (
  `wid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Auto Incremented ',
  `uid` bigint(15) unsigned NOT NULL COMMENT 'user id ',
  `pid` bigint(20) unsigned NOT NULL COMMENT 'product id',
  `vid` bigint(15) unsigned DEFAULT NULL COMMENT 'vendor id',
  `wf` bit(1) NOT NULL DEFAULT b'0' COMMENT 'wish flag',
  `cdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'created date',
  `udt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'updated date',
  PRIMARY KEY (`wid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
(3, 43, 1, 999, 1, 999, 1),
(3, 100014, 111, 999, 1, 999, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100021 ;

--
-- Dumping data for table `tb_attribute_master`
--

INSERT INTO `tb_attribute_master` (`attr_id`, `attr_name`, `attr_display_name`, `attr_unit`, `attr_type_flag`, `attr_unit_pos`, `attr_values`, `attr_range`, `use_list`, `active_flag`) VALUES
(43, 'flurocent', 'luminous', '10', 1, 0, '{10,20,30,40,50,60,70}', '10', NULL, b'1'),
(100013, 'tone', 'metal tone', '10', 1, 2, '{10,20,30,40,50,60,70}', '1', NULL, b'1'),
(100014, 'type', 'product type', '2', 1, 1, '{10,20,30,40,50,60,70}', '10', NULL, b'1'),
(100015, 'size', 'product size', '10', 1, 2, '{10,20,30,40,50,60,70}', '1', NULL, b'1'),
(100016, 'purity', 'gold purity', '10', 1, 2, '{10,20,30,40,50,60,70}', '10', NULL, b'1'),
(100017, 'purity', 'purity', '', 1, 0, '', '10', NULL, b'1'),
(100018, 'metal', 'metal', '', 1, 0, '', '10', NULL, b'1'),
(100019, 'metal_wt', 'metal_weight', '', 1, 0, '', '10', NULL, b'1'),
(100020, 'shape', 'shape', '', 1, 0, '', '10', NULL, b'1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
