-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2015 at 06:38 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jzeva`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int(5) NOT NULL,
  `city_name` varchar(250) NOT NULL,
  `c_state` tinyint(5) NOT NULL COMMENT 'city state',
  `c_code` tinyint(3) NOT NULL COMMENT 'Country code',
  PRIMARY KEY (`city_id`),
  KEY `c_code` (`c_code`),
  KEY `city_id` (`city_id`),
  KEY `c_state` (`c_state`),
  KEY `c_code_2` (`c_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `c_state`, `c_code`) VALUES
(1, 'bangalore', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `country_id` tinyint(3) NOT NULL,
  `cname` varchar(300) NOT NULL COMMENT 'country name',
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `cname`) VALUES
(1, 'INDIA');

-- --------------------------------------------------------

--
-- Table structure for table `customdesign`
--

CREATE TABLE IF NOT EXISTS `customdesign` (
  `cdid` varchar(50) NOT NULL COMMENT 'custom design id',
  `user_id` varchar(60) NOT NULL COMMENT 'user id FK ',
  `r_name` varchar(200) NOT NULL COMMENT 'requestor name',
  `email` varchar(200) NOT NULL,
  `dp` blob NOT NULL COMMENT 'design pic',
  `cdt` date NOT NULL COMMENT 'created date',
  `ea` varchar(250) NOT NULL COMMENT 'expert assigned',
  `status` bit(2) NOT NULL COMMENT '{ 1-Active | 0-Inactive }',
  UNIQUE KEY `cdid` (`cdid`,`user_id`),
  KEY `ea` (`ea`),
  KEY `ea_2` (`ea`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` varchar(60) NOT NULL COMMENT 'random',
  `user_type` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '2-customer (update in user table)',
  `gender` tinyint(1) unsigned NOT NULL COMMENT '1-Male,2-Female',
  `cust_name` varchar(250) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `address` text NOT NULL,
  `dob` date NOT NULL COMMENT 'date of birth',
  `username` varchar(200) NOT NULL COMMENT 'will be updated in user table',
  `country_id` tinyint(3) NOT NULL,
  `state_id` int(5) unsigned NOT NULL COMMENT 'foreign key state table',
  `city_id` int(5) NOT NULL COMMENT 'F.K. from city table',
  `pincode` int(6) unsigned NOT NULL,
  `id_proof` varchar(200) NOT NULL COMMENT 'id proof number',
  `id_type` enum('1','2','3') NOT NULL COMMENT '1-PAN,2-License,3-Passport',
  `offer_id` bigint(20) NOT NULL COMMENT 'Offer table FK',
  `cdt` timestamp NOT NULL COMMENT 'created date',
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `customer_id_2` (`customer_id`),
  UNIQUE KEY `city_id_2` (`city_id`),
  KEY `customer_id` (`customer_id`),
  KEY `country_id` (`state_id`),
  KEY `offer_id` (`offer_id`),
  KEY `city_id` (`city_id`),
  KEY `country_id_2` (`country_id`),
  FULLTEXT KEY `address` (`address`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `designer`
--

CREATE TABLE IF NOT EXISTS `designer` (
  `desid` bigint(20) NOT NULL,
  `desname` varchar(250) NOT NULL,
  `deslocation` varchar(60) NOT NULL,
  `desexperience` int(2) NOT NULL,
  `cdt` date NOT NULL,
  PRIMARY KEY (`desid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designer`
--

INSERT INTO `designer` (`desid`, `desname`, `deslocation`, `desexperience`, `cdt`) VALUES
(1121, 'devsharan Tiwari', 'Shimla', 3, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `diamond_cat`
--

CREATE TABLE IF NOT EXISTS `diamond_cat` (
  `did` bigint(20) NOT NULL COMMENT 'Diamond ID',
  `dtype` varchar(100) NOT NULL COMMENT 'Diamond type',
  `dshape` int(3) NOT NULL COMMENT '{ 1-round | 2-Oval | 3-Hexagonal | [...] }',
  `applic` bigint(20) unsigned NOT NULL COMMENT 'Approval License',
  `color` varchar(120) NOT NULL,
  `subcat` set('if any') NOT NULL,
  `dimensions` varchar(30) NOT NULL COMMENT 'DImensions with symbols(mt inch mm)',
  `Weight(carot)` decimal(3,2) unsigned zerofill NOT NULL,
  `ppc($)` float(10,2) NOT NULL COMMENT 'price per carot',
  `diameter(mm)` decimal(3,2) NOT NULL,
  `iso` varchar(15) NOT NULL COMMENT 'ISO Standard',
  `width(%)` float(3,2) NOT NULL,
  `depth(%)` varchar(50) NOT NULL,
  `clarity` set('FL','IF','I1','I2','I3','VVS1','VVS2','VS1','VS2') NOT NULL COMMENT '{ FL-Flawless | IF-Internally flawless | I-Included | VVSI-Very Very Slightly Included | VVS-Very Very Slightly }',
  `anatomy` varchar(200) NOT NULL COMMENT 'crown,gridle,pavilion,',
  PRIMARY KEY (`did`),
  UNIQUE KEY `did` (`did`),
  KEY `did_2` (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diamond_cat`
--

INSERT INTO `diamond_cat` (`did`, `dtype`, `dshape`, `applic`, `color`, `subcat`, `dimensions`, `Weight(carot)`, `ppc($)`, `diameter(mm)`, `iso`, `width(%)`, `depth(%)`, `clarity`, `anatomy`) VALUES
(1, '', 0, 0, '', '', '', '0.00', 0.00, '0.00', '', 0.00, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `gold_cat`
--

CREATE TABLE IF NOT EXISTS `gold_cat` (
  `gid` bigint(20) NOT NULL COMMENT 'gold id',
  `gold_cat` tinyint(1) NOT NULL COMMENT 'category { 1- 18k | 2- 20K | 3- 22k | 4-24k }',
  `wt` decimal(3,3) NOT NULL COMMENT 'weight in grams',
  `alloy` varchar(30) NOT NULL,
  `authorizationn` varchar(250) NOT NULL,
  `isdate` date NOT NULL COMMENT 'issue date',
  `mprice` double(10,2) NOT NULL COMMENT 'market gold price',
  PRIMARY KEY (`gid`),
  UNIQUE KEY `gid` (`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gold_cat`
--

INSERT INTO `gold_cat` (`gid`, `gold_cat`, `wt`, `alloy`, `authorizationn`, `isdate`, `mprice`) VALUES
(1, 1, '0.012', 'silver', '564hjgug230315', '2015-08-18', 25445.22);

-- --------------------------------------------------------

--
-- Table structure for table `helpdesk`
--

CREATE TABLE IF NOT EXISTS `helpdesk` (
  `did` bigint(15) NOT NULL AUTO_INCREMENT COMMENT 'Helpdesk ID',
  `sid` varchar(30) NOT NULL COMMENT 'sender F.K. uid from users',
  `rid` varchar(30) NOT NULL COMMENT 'receiver F.K. uid from users',
  `sname` varchar(200) NOT NULL COMMENT 'sender name',
  `sub` varchar(120) NOT NULL COMMENT 'subject',
  `spno` bigint(20) NOT NULL COMMENT 'sender cellnumber',
  `semail` varchar(250) NOT NULL COMMENT 'sender email',
  `smsg` text NOT NULL COMMENT 'sender query',
  `cdt` date NOT NULL COMMENT 'created date',
  `status` bit(2) NOT NULL COMMENT '{1-Active | 2-InActive }',
  PRIMARY KEY (`did`),
  KEY `sid` (`sid`,`rid`),
  KEY `sid_2` (`sid`),
  KEY `rid` (`rid`),
  KEY `sname` (`sname`),
  KEY `semail` (`semail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE IF NOT EXISTS `offer` (
  `offid` bigint(20) NOT NULL COMMENT 'offer id',
  `des` text NOT NULL COMMENT 'description',
  `amdp` decimal(3,2) NOT NULL COMMENT 'amount discount percentage',
  `valid` int(4) unsigned NOT NULL COMMENT 'validity in days',
  `cdt` date NOT NULL COMMENT 'created date ',
  `flag` bit(2) NOT NULL COMMENT '{0-Active | 1-Inactive }',
  `vdesc` text NOT NULL COMMENT 'voucher description',
  PRIMARY KEY (`offid`),
  UNIQUE KEY `offid` (`offid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`offid`, `des`, `amdp`, `valid`, `cdt`, `flag`, `vdesc`) VALUES
(1, 'ugugu uyf ', '9.99', 2233223, '2015-08-26', b'01', 'sfaaag');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `oid` bigint(20) NOT NULL COMMENT 'order id',
  `uid` varchar(60) NOT NULL DEFAULT 'guest',
  `offid` bigint(20) NOT NULL COMMENT 'FK offer table',
  `shopcartid` bigint(15) NOT NULL,
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
  `dt` date NOT NULL,
  PRIMARY KEY (`oid`),
  UNIQUE KEY `transid` (`transid`),
  KEY `bill_city` (`bill_city`),
  KEY `shopcartid` (`shopcartid`),
  KEY `offid` (`offid`),
  KEY `offid_2` (`offid`),
  KEY `ship_city` (`ship_city`),
  KEY `bill_country` (`bill_country`),
  KEY `ship_state` (`ship_state`),
  KEY `ship_state_2` (`ship_state`),
  KEY `bill_country_2` (`bill_country`),
  KEY `bill_state` (`bill_state`),
  KEY `bill_state_2` (`bill_state`),
  KEY `bill_city_2` (`bill_city`),
  KEY `offid_3` (`offid`),
  KEY `uid` (`uid`),
  KEY `uid_2` (`uid`),
  KEY `uid_3` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `pcode` varchar(50) NOT NULL COMMENT 'product code',
  `pname` varchar(100) NOT NULL COMMENT 'product name',
  `tags` varchar(120) NOT NULL,
  `ptype` tinyint(3) unsigned NOT NULL COMMENT '1-RING,2-EARRING,3-PENDANTS,4-BANGLES,5-NOSEPINS,6-NECKLACE,7-MANGALSUTRA,8-CHAINS,9-ACCESSORIES,10-STONES',
  `mtype` tinyint(1) unsigned NOT NULL COMMENT 'metal type: 1-GOLD,2-BRONZE,3-IRON,4-SILVER',
  `color` char(20) NOT NULL,
  `shape` tinyint(2) unsigned NOT NULL COMMENT '1-ROUND,2-OVAL,3-PEAR,4-HEART,5-EMERALD,6-RADIANT,7-CUSHION',
  `diamond_id` bigint(20) NOT NULL,
  `gold_id` bigint(20) NOT NULL,
  `mwt` float(4,3) unsigned NOT NULL COMMENT 'metal weight',
  `twt` float(5,4) unsigned NOT NULL COMMENT 'total weight',
  `gwt` float(5,4) unsigned NOT NULL COMMENT 'gem wt',
  `pimg` text COMMENT 'product image',
  `sid` bigint(20) NOT NULL,
  `vat` float(3,2) unsigned NOT NULL COMMENT 'value added tax inclusion',
  `lcharge` decimal(6,2) NOT NULL COMMENT 'labor charge',
  `did` varchar(30) NOT NULL COMMENT 'Designer ID fk designer table',
  `height` int(4) unsigned NOT NULL COMMENT '(MM)',
  `width` int(4) NOT NULL,
  `offid` bigint(20) NOT NULL,
  `cwv` float(10,2) NOT NULL COMMENT 'cost without voucher',
  `cva` float(10,2) NOT NULL COMMENT 'cost voucher amount',
  `pstatus` bit(2) NOT NULL COMMENT 'product status : 0-outstock,1-instock',
  `cdt` date NOT NULL,
  PRIMARY KEY (`pcode`),
  KEY `gold_id` (`gold_id`),
  KEY `diamond_id` (`diamond_id`),
  KEY `sid` (`sid`),
  KEY `offid` (`offid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pcode`, `pname`, `tags`, `ptype`, `mtype`, `color`, `shape`, `diamond_id`, `gold_id`, `mwt`, `twt`, `gwt`, `pimg`, `sid`, `vat`, `lcharge`, `did`, `height`, `width`, `offid`, `cwv`, `cva`, `pstatus`, `cdt`) VALUES
('product1414895', 'ring', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '0000-00-00'),
('product1651296', 'ring', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '0000-00-00'),
('product1833687', 'ring', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '0000-00-00'),
('product2468735', 'ring', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '0000-00-00'),
('product3011506', 'ring', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '0000-00-00'),
('product3142279', 'ring', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '0000-00-00'),
('product315199', 'ring', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '0000-00-00'),
('product3330002', 'ring', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '0000-00-00'),
('product3402231', 'cccxs', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '0000-00-00'),
('product4061833', 'ring', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '0000-00-00'),
('product4249839', 'ring', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '0000-00-00'),
('product4881303', 'ring', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '0000-00-00'),
('product4884299', 'ring', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '0000-00-00'),
('product5229423', 'ring', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '0000-00-00'),
('product554851', 'ring', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '0000-00-00'),
('product6175243', 'ring', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '0000-00-00'),
('product6797628', 'ring', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '0000-00-00'),
('product7024480', 'w', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '0000-00-00'),
('product7814125', 'avsdade', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '0000-00-00'),
('product8043574', 'ruby', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '2015-08-03'),
('product8366906', 'ring', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '0000-00-00'),
('product9363225', 'asdafafaef', 'round', 2, 0, '1', 1, 1, 1, 1.000, 1.0000, 1.0000, NULL, 1, 1.00, '1.00', '1', 1, 1, 1, 90923.00, 994323.00, b'11', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `shopcart`
--

CREATE TABLE IF NOT EXISTS `shopcart` (
  `scid` bigint(15) NOT NULL COMMENT 'shop cart id',
  `pcode` varchar(50) NOT NULL COMMENT 'product code',
  `cdt` date NOT NULL COMMENT 'create date',
  `quantity` int(4) NOT NULL COMMENT 'per product quantity',
  `status` bit(2) NOT NULL DEFAULT b'0' COMMENT '{1-Active | 0-Inactive }',
  `offid` bigint(20) NOT NULL COMMENT 'F.K offer table ',
  `user_id` varchar(60) NOT NULL,
  `udt` date NOT NULL,
  UNIQUE KEY `scid` (`scid`),
  KEY `pcode` (`pcode`),
  KEY `offid` (`offid`),
  KEY `offid_2` (`offid`),
  KEY `pcode_2` (`pcode`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shopshare`
--

CREATE TABLE IF NOT EXISTS `shopshare` (
  `shopid` bigint(15) NOT NULL COMMENT 'shop id',
  `vid` bigint(15) NOT NULL COMMENT 'Vendor id F.K. users',
  `wtype` tinyint(1) NOT NULL COMMENT 'worker type {1-Designer | 2-Retailer | 3-Jewellery | 4-Manufacturer }',
  `wname` varchar(200) NOT NULL COMMENT 'worker name',
  `wemail` varchar(250) NOT NULL COMMENT 'worker email',
  `wpno` bigint(20) NOT NULL COMMENT 'worker cell number',
  `wbrand` varchar(100) NOT NULL COMMENT 'brand name',
  `req` tinyint(1) NOT NULL COMMENT 'request { 1-Accept | 2-Pending | 3-Delayed }',
  UNIQUE KEY `shopid` (`shopid`),
  KEY `vid` (`vid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE IF NOT EXISTS `size` (
  `size_id` bigint(20) NOT NULL,
  `size` int(11) NOT NULL COMMENT 'size in mm',
  PRIMARY KEY (`size_id`),
  UNIQUE KEY `size_id` (`size_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`size_id`, `size`) VALUES
(1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `sid` int(5) unsigned NOT NULL,
  `ccode` tinyint(3) NOT NULL COMMENT 'country code',
  `sname` varchar(250) NOT NULL COMMENT 'state name',
  UNIQUE KEY `sid_2` (`sid`),
  KEY `sid` (`sid`),
  KEY `ccode` (`ccode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`sid`, `ccode`, `sname`) VALUES
(12, 1, 'Gujarat');

-- --------------------------------------------------------

--
-- Table structure for table `stylist_appoint`
--

CREATE TABLE IF NOT EXISTS `stylist_appoint` (
  `appid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `log_id` bigint(15) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(60) DEFAULT 'guest' COMMENT 'id indexing to user_type table',
  `user_type` tinyint(1) DEFAULT '1' COMMENT '1-guest,2-customer,3-vendor,4-stylist,5-consultant,6-designer,7-admin,8-supadmin',
  `uname` varchar(250) NOT NULL COMMENT 'Person name',
  `email` varchar(200) DEFAULT 'NULL',
  `username` varchar(300) NOT NULL COMMENT 'username unique for all',
  `password` varchar(30) NOT NULL,
  `facility` tinyint(1) DEFAULT '0' COMMENT '{ 0-None | 1-Newsletter | 2-Subscribe | 3-Both }',
  `status` tinyint(1) DEFAULT '0' COMMENT '0-inactive,1-active',
  PRIMARY KEY (`log_id`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `email_3` (`email`),
  KEY `log_id` (`log_id`),
  KEY `user_id_2` (`user_id`),
  KEY `uname` (`uname`),
  KEY `email` (`email`),
  KEY `email_2` (`email`),
  KEY `uname_2` (`uname`),
  KEY `uname_3` (`uname`),
  KEY `user_id_3` (`user_id`),
  KEY `username_2` (`username`),
  KEY `username` (`username`),
  KEY `username_3` (`username`),
  KEY `username_4` (`username`),
  KEY `user_id_4` (`user_id`),
  KEY `user_id_5` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`log_id`, `user_id`, `user_type`, `uname`, `email`, `username`, `password`, `facility`, `status`) VALUES
(1, 'customer001', 2, 'chinmay', 'chinmay@gmail.com', 'chinmay123', 'bajpai', 123, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE IF NOT EXISTS `vendor` (
  `vendor_id` varchar(60) NOT NULL COMMENT 'referenced to user table',
  `user_type` tinyint(1) NOT NULL DEFAULT '3' COMMENT '3-vendor type',
  `gender` tinyint(1) unsigned NOT NULL COMMENT '{ 1-male | 2-female }',
  `vender_name` varchar(250) NOT NULL,
  `email` varchar(200) NOT NULL,
  `vendor_phone` bigint(20) NOT NULL,
  `address` text NOT NULL,
  `dob` date NOT NULL COMMENT 'date of birth',
  `username` varchar(250) NOT NULL COMMENT 'will be updated in user table',
  `country_id` tinyint(3) NOT NULL COMMENT 'F.K. country table',
  `state_id` int(5) unsigned NOT NULL COMMENT 'F.K. state table',
  `city_id` int(5) NOT NULL COMMENT 'city table refference',
  `pincode` int(6) unsigned NOT NULL,
  `vendor_license` varchar(30) NOT NULL,
  `lid` date NOT NULL COMMENT 'license issue date',
  `eid` date NOT NULL COMMENT 'expiry issue date',
  `dealin` tinyint(3) unsigned NOT NULL COMMENT '1-gold,2-diamond,3-gemstones,12-gold&diamond,23-diamond&gemstones,13-gold&gemstone,123-all',
  `pdt` date NOT NULL COMMENT 'profile created date',
  `pstatus` bit(2) NOT NULL COMMENT '0-inactive,1-active',
  `diamond_lic` varchar(30) NOT NULL,
  `cdt` timestamp NULL DEFAULT NULL COMMENT 'created date',
  `last_updated` timestamp NULL DEFAULT NULL COMMENT 'Later on updated ',
  UNIQUE KEY `vendor_license` (`vendor_license`,`diamond_lic`),
  UNIQUE KEY `country_id_2` (`country_id`),
  UNIQUE KEY `email` (`email`),
  KEY `vendor_id` (`vendor_id`),
  KEY `country_id` (`country_id`,`state_id`),
  KEY `city_id` (`city_id`),
  KEY `country_id_3` (`country_id`),
  KEY `state_id` (`state_id`),
  KEY `city_id_2` (`city_id`),
  KEY `diamond_lic` (`diamond_lic`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`c_code`) REFERENCES `country` (`country_id`);

--
-- Constraints for table `customdesign`
--
ALTER TABLE `customdesign`
  ADD CONSTRAINT `customdesign_ibfk_1` FOREIGN KEY (`ea`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `customdesign_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`username`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_ibfk_3` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`),
  ADD CONSTRAINT `customer_ibfk_5` FOREIGN KEY (`state_id`) REFERENCES `state` (`sid`),
  ADD CONSTRAINT `customer_ibfk_6` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`),
  ADD CONSTRAINT `customer_ibfk_7` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`offid`);

--
-- Constraints for table `helpdesk`
--
ALTER TABLE `helpdesk`
  ADD CONSTRAINT `helpdesk_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `helpdesk_ibfk_2` FOREIGN KEY (`rid`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `helpdesk_ibfk_3` FOREIGN KEY (`semail`) REFERENCES `users` (`email`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_10` FOREIGN KEY (`uid`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`ship_city`) REFERENCES `city` (`city_id`),
  ADD CONSTRAINT `order_ibfk_4` FOREIGN KEY (`bill_country`) REFERENCES `country` (`country_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_ibfk_5` FOREIGN KEY (`bill_city`) REFERENCES `city` (`city_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_ibfk_6` FOREIGN KEY (`shopcartid`) REFERENCES `shopcart` (`scid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_ibfk_7` FOREIGN KEY (`ship_state`) REFERENCES `state` (`sid`),
  ADD CONSTRAINT `order_ibfk_8` FOREIGN KEY (`bill_state`) REFERENCES `state` (`sid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_ibfk_9` FOREIGN KEY (`offid`) REFERENCES `offer` (`offid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`gold_id`) REFERENCES `gold_cat` (`gid`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`diamond_id`) REFERENCES `diamond_cat` (`did`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`sid`) REFERENCES `size` (`size_id`),
  ADD CONSTRAINT `product_ibfk_4` FOREIGN KEY (`offid`) REFERENCES `offer` (`offid`);

--
-- Constraints for table `shopcart`
--
ALTER TABLE `shopcart`
  ADD CONSTRAINT `shopcart_ibfk_1` FOREIGN KEY (`pcode`) REFERENCES `product` (`pcode`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `shopcart_ibfk_2` FOREIGN KEY (`offid`) REFERENCES `offer` (`offid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `shopcart_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `state_ibfk_1` FOREIGN KEY (`ccode`) REFERENCES `country` (`country_id`);

--
-- Constraints for table `vendor`
--
ALTER TABLE `vendor`
  ADD CONSTRAINT `vendor_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`),
  ADD CONSTRAINT `vendor_ibfk_3` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`),
  ADD CONSTRAINT `vendor_ibfk_4` FOREIGN KEY (`state_id`) REFERENCES `state` (`sid`),
  ADD CONSTRAINT `vendor_ibfk_5` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_ibfk_6` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_ibfk_7` FOREIGN KEY (`email`) REFERENCES `users` (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
