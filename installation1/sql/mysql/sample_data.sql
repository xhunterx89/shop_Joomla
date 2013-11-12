-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 20, 2011 at 09:05 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clone_theshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__assets`
--

DROP TABLE IF EXISTS `#__assets`;
CREATE TABLE IF NOT EXISTS `#__assets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set parent.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `level` int(10) unsigned NOT NULL COMMENT 'The cached level in the nested tree.',
  `name` varchar(50) NOT NULL COMMENT 'The unique name for the asset.\n',
  `title` varchar(100) NOT NULL COMMENT 'The descriptive title for the asset.',
  `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_asset_name` (`name`),
  KEY `idx_lft_rgt` (`lft`,`rgt`),
  KEY `idx_parent_id` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=196 ;

--
-- Dumping data for table `#__assets`
--

INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES
(1, 0, 1, 284, 0, 'root.1', 'Root Asset', '{"core.login.site":{"6":1,"2":1},"core.login.admin":{"6":1},"core.login.offline":[],"core.admin":{"8":1},"core.manage":{"7":1},"core.create":{"6":1,"3":1},"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1},"core.edit.own":{"6":1,"3":1}}'),
(2, 1, 2, 3, 1, 'com_admin', 'com_admin', '{}'),
(3, 1, 4, 11, 1, 'com_banners', 'com_banners', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(4, 1, 12, 13, 1, 'com_cache', 'com_cache', '{"core.admin":{"7":1},"core.manage":{"7":1}}'),
(5, 1, 14, 15, 1, 'com_checkin', 'com_checkin', '{"core.admin":{"7":1},"core.manage":{"7":1}}'),
(6, 1, 16, 17, 1, 'com_config', 'com_config', '{}'),
(7, 1, 18, 87, 1, 'com_contact', 'com_contact', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(8, 1, 88, 161, 1, 'com_content', 'com_content', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(9, 1, 162, 163, 1, 'com_cpanel', 'com_cpanel', '{}'),
(10, 1, 164, 165, 1, 'com_installer', 'com_installer', '{"core.admin":{"7":1},"core.manage":{"7":1},"core.create":[],"core.delete":[],"core.edit.state":[]}'),
(11, 1, 166, 167, 1, 'com_languages', 'com_languages', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(12, 1, 168, 169, 1, 'com_login', 'com_login', '{}'),
(13, 1, 170, 171, 1, 'com_mailto', 'com_mailto', '{}'),
(14, 1, 172, 173, 1, 'com_massmail', 'com_massmail', '{}'),
(15, 1, 174, 175, 1, 'com_media', 'com_media', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":{"5":1},"core.edit":[],"core.edit.state":[]}'),
(16, 1, 176, 177, 1, 'com_menus', 'com_menus', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(17, 1, 37, 38, 1, 'com_messages', 'com_messages', '{"core.admin":{"7":1},"core.manage":{"7":1}}'),
(18, 1, 180, 181, 1, 'com_modules', 'com_modules', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(19, 1, 182, 189, 1, 'com_newsfeeds', 'com_newsfeeds', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(20, 1, 190, 191, 1, 'com_plugins', 'com_plugins', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(21, 1, 192, 193, 1, 'com_redirect', 'com_redirect', '{"core.admin":{"7":1},"core.manage":[]}'),
(22, 1, 194, 195, 1, 'com_search', 'com_search', '{"core.admin":{"7":1},"core.manage":{"6":1}}'),
(23, 1, 196, 197, 1, 'com_templates', 'com_templates', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(24, 1, 198, 199, 1, 'com_users', 'com_users', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.own":{"6":1},"core.edit.state":[]}'),
(25, 1, 200, 217, 1, 'com_weblinks', 'com_weblinks', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1,"10":0,"12":0},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1}}'),
(26, 1, 218, 219, 1, 'com_wrapper', 'com_wrapper', '{}'),
(38, 25, 207, 208, 2, 'com_weblinks.category.13', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(37, 19, 185, 186, 2, 'com_newsfeeds.category.12', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(36, 7, 23, 24, 2, 'com_contact.category.11', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(35, 3, 7, 8, 2, 'com_banners.category.10', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(34, 8, 105, 108, 2, 'com_content.category.9', 'Uncategorised', '{"core.create":{"10":0,"12":0},"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(40, 3, 9, 10, 2, 'com_banners.category.15', 'Sample Data-Banners', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(41, 7, 25, 86, 2, 'com_contact.category.16', 'Sample Data-Contact', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(42, 19, 187, 188, 2, 'com_newsfeeds.category.17', 'Sample Data-Newsfeeds', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(43, 25, 209, 216, 2, 'com_weblinks.category.18', 'Sample Data-Weblinks', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(195, 172, 143, 144, 4, 'com_content.article.88', 'Sample Joomla Article Nr-5 From IceTheme', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(194, 172, 141, 142, 4, 'com_content.article.87', 'Sample Joomla Article Nr-4 From IceTheme', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(193, 172, 139, 140, 4, 'com_content.article.86', 'Sample Joomla Article Nr-3 From IceTheme', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(192, 172, 137, 138, 4, 'com_content.article.85', 'Sample Joomla Article Nr-2 From IceTheme', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(191, 172, 135, 136, 4, 'com_content.article.84', 'Sample Joomla Article Nr-1 From IceTheme ', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(190, 170, 119, 120, 4, 'com_content.article.83', ' Today''s Offer. 25% off for HD Monitors  ', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(189, 170, 117, 118, 4, 'com_content.article.82', 'Surprise Your Spouse With a Diamond Ring', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(188, 170, 115, 116, 4, 'com_content.article.81', 'New Arrivals. Find The Right Speakers Now!', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(56, 43, 210, 211, 3, 'com_weblinks.category.31', 'Park Links', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(57, 43, 212, 215, 3, 'com_weblinks.category.32', 'Joomla! Specific Links', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(58, 57, 213, 214, 4, 'com_weblinks.category.33', 'Other Resources', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(59, 41, 26, 27, 3, 'com_contact.category.34', 'Park Site', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(60, 41, 28, 85, 3, 'com_contact.category.35', 'Shop Site', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(61, 60, 29, 30, 4, 'com_contact.category.36', 'Staff', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(62, 60, 31, 84, 4, 'com_contact.category.37', 'Fruit Encyclopedia', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(63, 62, 32, 33, 5, 'com_contact.category.38', 'A', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(64, 62, 34, 35, 5, 'com_contact.category.39', 'B', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(65, 62, 36, 37, 5, 'com_contact.category.40', 'C', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(66, 62, 38, 39, 5, 'com_contact.category.41', 'D', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(67, 62, 40, 41, 5, 'com_contact.category.42', 'E', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(68, 62, 42, 43, 5, 'com_contact.category.43', 'F', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(69, 62, 44, 45, 5, 'com_contact.category.44', 'G', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(70, 62, 46, 47, 5, 'com_contact.category.45', 'H', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(71, 62, 48, 49, 5, 'com_contact.category.46', 'I', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(72, 62, 50, 51, 5, 'com_contact.category.47', 'J', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(73, 62, 52, 53, 5, 'com_contact.category.48', 'K', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(74, 62, 54, 55, 5, 'com_contact.category.49', 'L', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(75, 62, 56, 57, 5, 'com_contact.category.50', 'M', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(76, 62, 58, 59, 5, 'com_contact.category.51', 'N', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(77, 62, 60, 61, 5, 'com_contact.category.52', 'O', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(78, 62, 62, 63, 5, 'com_contact.category.53', 'P', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(79, 62, 64, 65, 5, 'com_contact.category.54', 'Q', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(80, 62, 66, 67, 5, 'com_contact.category.55', 'R', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(81, 62, 68, 69, 5, 'com_contact.category.56', 'S', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(82, 62, 70, 71, 5, 'com_contact.category.57', 'T', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(83, 62, 72, 73, 5, 'com_contact.category.58', 'U', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(84, 62, 74, 75, 5, 'com_contact.category.59', 'V', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(85, 62, 76, 77, 5, 'com_contact.category.60', 'W', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(86, 62, 78, 79, 5, 'com_contact.category.61', 'X', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(87, 62, 80, 81, 5, 'com_contact.category.62', 'Y', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(88, 62, 82, 83, 5, 'com_contact.category.63', 'Z', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(187, 170, 113, 114, 4, 'com_content.article.80', 'Play Full HD Live You Never Before Before.', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(186, 170, 111, 112, 4, 'com_content.article.79', 'Your New Home For 4G Smartphones!', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(185, 173, 155, 156, 4, 'com_content.article.78', 'IceTabs', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(184, 173, 153, 154, 4, 'com_content.article.77', 'IceSpeed', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(183, 173, 151, 152, 4, 'com_content.article.76', 'IceShare', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(182, 173, 157, 158, 4, 'com_content.article.75', 'IceMegaMenu', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(175, 171, 125, 126, 4, 'com_content.article.69', 'Module Positions', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(176, 171, 127, 128, 4, 'com_content.article.70', 'Module Variations', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(177, 171, 129, 130, 4, 'com_content.article.71', 'Template Styles', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(178, 171, 131, 132, 4, 'com_content.article.72', 'Typography', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(179, 1, 282, 283, 1, 'com_jshopping', 'jshopping', '{}'),
(180, 173, 147, 148, 4, 'com_content.article.73', 'IceAccordion', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(181, 173, 149, 150, 4, 'com_content.article.74', 'IceCarousel', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(174, 171, 123, 124, 4, 'com_content.article.68', 'Clone Installer', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(171, 169, 122, 133, 3, 'com_content.category.79', 'Features', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(172, 169, 134, 145, 3, 'com_content.category.80', 'Sample News', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(173, 169, 146, 159, 3, 'com_content.category.81', 'Extensions', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(170, 169, 110, 121, 3, 'com_content.category.78', 'IceTabs', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(169, 8, 109, 160, 2, 'com_content.category.77', 'IceTheme', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(168, 34, 106, 107, 3, 'com_content.article.67', 'What''s New in 1.5?', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}');

-- --------------------------------------------------------

--
-- Table structure for table `#__associations`
--

DROP TABLE IF EXISTS `#__associations`;
CREATE TABLE IF NOT EXISTS `#__associations` (
  `id` varchar(50) NOT NULL COMMENT 'A reference to the associated item.',
  `context` varchar(50) NOT NULL COMMENT 'The context of the associated item.',
  `key` char(32) NOT NULL COMMENT 'The key for the association computed from an md5 on associated ids.',
  PRIMARY KEY (`context`,`id`),
  KEY `idx_key` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__associations`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__banners`
--

DROP TABLE IF EXISTS `#__banners`;
CREATE TABLE IF NOT EXISTS `#__banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `clickurl` varchar(200) NOT NULL DEFAULT '',
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `custombannercode` varchar(2048) NOT NULL,
  `sticky` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `params` text NOT NULL,
  `own_prefix` tinyint(1) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(255) NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reset` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `language` char(7) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_state` (`state`),
  KEY `idx_own_prefix` (`own_prefix`),
  KEY `idx_metakey_prefix` (`metakey_prefix`),
  KEY `idx_banner_catid` (`catid`),
  KEY `idx_language` (`language`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `#__banners`
--

INSERT INTO `#__banners` (`id`, `cid`, `type`, `name`, `alias`, `imptotal`, `impmade`, `clicks`, `clickurl`, `state`, `catid`, `description`, `custombannercode`, `sticky`, `ordering`, `metakey`, `params`, `own_prefix`, `metakey_prefix`, `purchase_type`, `track_clicks`, `track_impressions`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `reset`, `created`, `language`) VALUES
(2, 3, 0, 'Shop 1', 'shop-1', 0, 63, 2, 'http://shop.joomla.org/amazoncom-bookstores.html', 1, 15, 'Get books about Joomla! at the Joomla! book shop.', '', 0, 1, '', '{"imageurl":"images\\/banners\\/white.png","width":"","height":"","alt":"Joomla! Books"}', 0, '', -1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2011-01-01 00:00:01', 'en-GB'),
(3, 2, 0, 'Shop 2', 'shop-2', 0, 113, 2, 'http://shop.joomla.org', 1, 15, 'T Shirts, caps and more from the Joomla! Shop.', '', 0, 2, '', '{"imageurl":"images\\/banners\\/white.png","width":"","height":"","alt":"Joomla! Shop"}', 0, '', -1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2011-01-01 00:00:01', 'en-GB'),
(4, 1, 0, 'Support Joomla!', 'support-joomla', 0, 32, 1, 'http://contribute.joomla.org', 1, 15, 'Your contributions of time, talent and money make Joomla! possible.', '', 0, 3, '', '{"imageurl":"images\\/banners\\/white.png","width":"","height":"","alt":""}', 0, '', -1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'en-GB');

-- --------------------------------------------------------

--
-- Table structure for table `#__banner_clients`
--

DROP TABLE IF EXISTS `#__banner_clients`;
CREATE TABLE IF NOT EXISTS `#__banner_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `contact` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `extrainfo` text NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `metakey` text NOT NULL,
  `own_prefix` tinyint(4) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(255) NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`),
  KEY `idx_own_prefix` (`own_prefix`),
  KEY `idx_metakey_prefix` (`metakey_prefix`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `#__banner_clients`
--

INSERT INTO `#__banner_clients` (`id`, `name`, `contact`, `email`, `extrainfo`, `state`, `checked_out`, `checked_out_time`, `metakey`, `own_prefix`, `metakey_prefix`, `purchase_type`, `track_clicks`, `track_impressions`) VALUES
(1, 'Joomla!', 'Administrator', 'email@email.com', '', 1, 0, '0000-00-00 00:00:00', '', 0, '', -1, -1, -1),
(2, 'Shop', 'Example', 'example@example.com', '', 1, 0, '0000-00-00 00:00:00', '', 0, '', -1, 0, 0),
(3, 'Bookstore', 'Bookstore Example', 'example@example.com', '', 1, 0, '0000-00-00 00:00:00', '', 0, '', -1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `#__banner_tracks`
--

DROP TABLE IF EXISTS `#__banner_tracks`;
CREATE TABLE IF NOT EXISTS `#__banner_tracks` (
  `track_date` datetime NOT NULL,
  `track_type` int(10) unsigned NOT NULL,
  `banner_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`track_date`,`track_type`,`banner_id`),
  KEY `idx_track_date` (`track_date`),
  KEY `idx_track_type` (`track_type`),
  KEY `idx_banner_id` (`banner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__banner_tracks`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__categories`
--

DROP TABLE IF EXISTS `#__categories`;
CREATE TABLE IF NOT EXISTS `#__categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `level` int(10) unsigned NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL DEFAULT '',
  `extension` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(5120) NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `metadesc` varchar(1024) NOT NULL COMMENT 'The meta description for the page.',
  `metakey` varchar(1024) NOT NULL COMMENT 'The meta keywords for the page.',
  `metadata` varchar(2048) NOT NULL COMMENT 'JSON encoded metadata properties.',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_idx` (`extension`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_path` (`path`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_language` (`language`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=82 ;

--
-- Dumping data for table `#__categories`
--

INSERT INTO `#__categories` (`id`, `asset_id`, `parent_id`, `lft`, `rgt`, `level`, `path`, `extension`, `title`, `alias`, `note`, `description`, `published`, `checked_out`, `checked_out_time`, `access`, `params`, `metadesc`, `metakey`, `metadata`, `created_user_id`, `created_time`, `modified_user_id`, `modified_time`, `hits`, `language`) VALUES
(1, 0, 0, 0, 95, 0, '', 'system', 'ROOT', 'root', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{}', '', '', '', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(9, 34, 1, 83, 84, 1, 'uncategorised', 'com_content', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 42, '2011-01-01 00:00:01', 0, '*'),
(10, 35, 1, 81, 82, 1, 'uncategorised', 'com_banners', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":"","foobar":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(11, 36, 1, 77, 78, 1, 'uncategorised', 'com_contact', 'Uncategorised', 'uncategorised', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(12, 37, 1, 13, 14, 1, 'uncategorised', 'com_newsfeeds', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(13, 38, 1, 9, 10, 1, 'uncategorised', 'com_weblinks', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(15, 40, 1, 79, 80, 1, 'sample-data-banners', 'com_banners', 'Sample Data-Banners', 'sample-data-banners', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":"","foobar":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(16, 41, 1, 15, 76, 1, 'sample-data-contact', 'com_contact', 'Sample Data-Contact', 'sample-data-contact', '', '', 1, 42, '2011-08-13 09:42:15', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(17, 42, 1, 11, 12, 1, 'sample-data-newsfeeds', 'com_newsfeeds', 'Sample Data-Newsfeeds', 'sample-data-newsfeeds', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(18, 43, 1, 1, 8, 1, 'sample-data-weblinks', 'com_weblinks', 'Sample Data-Weblinks', 'sample-data-weblinks', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(31, 56, 18, 2, 3, 2, 'sample-data-weblinks/park-links', 'com_weblinks', 'Park Links', 'park-links', '', '<p>Here are links to some of my favorite parks.</p>\r\n<p><em>The weblinks component provides an easy way to make links to external sites that are consistently formatted and categorised. You can create weblinks from the front end of your site.</em></p>', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":"images\\/sampledata\\/parks\\/banner_cradle.jpg"}', '', '', '{"author":"","robots":""}', 42, '2011-01-01 00:00:01', 42, '2011-01-01 00:00:01', 0, 'en-GB'),
(32, 57, 18, 4, 7, 2, 'sample-data-weblinks/joomla-specific-links', 'com_weblinks', 'Joomla! Specific Links', 'joomla-specific-links', '', '<p><div style="font-family: Tahoma, Helvetica, Arial, sans-serif; font-size: 76%; background-color: #ffffff; background-image: initial; background-attachment: initial; background-origin: initial; background-clip: initial; line-height: 1.3em; color: #333333;"><p>A selection of links that are all related to the Joomla! Project.</p></div></p>', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(33, 58, 32, 5, 6, 3, 'sample-data-weblinks/joomla-specific-links/other-resources', 'com_weblinks', 'Other Resources', 'other-resources', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(34, 59, 16, 16, 17, 2, 'sample-data-contact/park-site', 'com_contact', 'Park Site', 'park-site', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 42, '2011-01-01 00:00:01', 0, 'en-GB'),
(35, 60, 16, 18, 75, 2, 'sample-data-contact/shop-site', 'com_contact', 'Shop Site', 'shop-site', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(36, 61, 35, 19, 20, 3, 'sample-data-contact/shop-site/staff', 'com_contact', 'Staff', 'staff', '', '<p>Please feel free to contact our staff at any time should you need assistance.</p>', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(37, 62, 35, 21, 74, 3, 'sample-data-contact/shop-site/fruit-encyclopedia', 'com_contact', 'Fruit Encyclopedia', 'fruit-encyclopedia', '', '<p> </p><p>Our directory of information about different kinds of fruit.</p><p>We love fruit and want the world to know more about all of its many varieties.</p><p>Although it is small now, we work on it whenever we have a chance.</p><p>All of the images can be found in <a href="http://commons.wikimedia.org/wiki/Main_Page">Wikimedia Commons</a>.</p><p><img src="images/sampledata/fruitshop/apple.jpg" border="0" alt="Apples" title="Apples" /></p><p><em>This encyclopedia is implemented using the contact component, each fruit a separate contact and a category for each letter. A CSS style is used to create the horizontal layout of the alphabet headings. </em></p><p><em>If you wanted to, you could allow some users (such as your growers) to have access to just this category in the contact component and let them help you to create new content for the encyclopedia.</em></p><p> </p>', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(38, 63, 37, 22, 23, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/a', 'com_contact', 'A', 'a', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(39, 64, 37, 24, 25, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/b', 'com_contact', 'B', 'b', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(40, 65, 37, 26, 27, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/c', 'com_contact', 'C', 'c', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(41, 66, 37, 28, 29, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/d', 'com_contact', 'D', 'd', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(42, 67, 37, 30, 31, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/e', 'com_contact', 'E', 'e', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(43, 68, 37, 32, 33, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/f', 'com_contact', 'F', 'f', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(44, 69, 37, 34, 35, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/g', 'com_contact', 'G', 'g', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(45, 70, 37, 36, 37, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/h', 'com_contact', 'H', 'h', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(46, 71, 37, 38, 39, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/i', 'com_contact', 'I', 'i', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(47, 72, 37, 40, 41, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/j', 'com_contact', 'J', 'j', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(48, 73, 37, 42, 43, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/k', 'com_contact', 'K', 'k', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(49, 74, 37, 44, 45, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/l', 'com_contact', 'L', 'l', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(50, 75, 37, 46, 47, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/m', 'com_contact', 'M', 'm', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(51, 76, 37, 48, 49, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/n', 'com_contact', 'N', 'n', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(52, 77, 37, 50, 51, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/o', 'com_contact', 'O', 'o', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(53, 78, 37, 52, 53, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/p', 'com_contact', 'P', 'p', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(54, 79, 37, 54, 55, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/q', 'com_contact', 'Q', 'q', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(55, 80, 37, 56, 57, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/r', 'com_contact', 'R', 'r', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(56, 81, 37, 58, 59, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/s', 'com_contact', 'S', 's', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(57, 82, 37, 60, 61, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/t', 'com_contact', 'T', 't', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(58, 83, 37, 62, 63, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/u', 'com_contact', 'U', 'u', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(59, 84, 37, 64, 65, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/v', 'com_contact', 'V', 'v', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(60, 85, 37, 66, 67, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/w', 'com_contact', 'W', 'w', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(61, 86, 37, 68, 69, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/x', 'com_contact', 'X', 'x', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(62, 87, 37, 70, 71, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/y', 'com_contact', 'Y', 'y', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(63, 88, 37, 72, 73, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/z', 'com_contact', 'Z', 'z', '', '', -2, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(81, 173, 77, 92, 93, 2, 'icetheme/extensions', 'com_content', 'Extensions', 'extensions', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 42, '2011-08-01 12:16:05', 0, '0000-00-00 00:00:00', 0, '*'),
(77, 169, 1, 85, 94, 1, 'icetheme', 'com_content', 'IceTheme', 'icetheme', '', '<p>IceTheme Sample Data</p>', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 42, '2011-08-01 12:15:14', 0, '0000-00-00 00:00:00', 0, '*'),
(78, 170, 77, 86, 87, 2, 'icetheme/icetabs', 'com_content', 'IceTabs', 'icetabs', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 42, '2011-08-01 12:15:40', 0, '0000-00-00 00:00:00', 0, '*'),
(79, 171, 77, 88, 89, 2, 'icetheme/features', 'com_content', 'Features', 'features', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 42, '2011-08-01 12:15:46', 0, '0000-00-00 00:00:00', 0, '*'),
(80, 172, 77, 90, 91, 2, 'icetheme/sample-news', 'com_content', 'Sample News', 'sample-news', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 42, '2011-08-01 12:15:55', 0, '0000-00-00 00:00:00', 0, '*');

-- --------------------------------------------------------

--
-- Table structure for table `#__contact_details`
--

DROP TABLE IF EXISTS `#__contact_details`;
CREATE TABLE IF NOT EXISTS `#__contact_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `con_position` varchar(255) DEFAULT NULL,
  `address` text,
  `suburb` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `misc` mediumtext,
  `image` varchar(255) DEFAULT NULL,
  `imagepos` varchar(20) DEFAULT NULL,
  `email_to` varchar(255) DEFAULT NULL,
  `default_con` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  `webpage` varchar(255) NOT NULL DEFAULT '',
  `sortname1` varchar(255) NOT NULL,
  `sortname2` varchar(255) NOT NULL,
  `sortname3` varchar(255) NOT NULL,
  `language` char(7) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `#__contact_details`
--

INSERT INTO `#__contact_details` (`id`, `name`, `alias`, `con_position`, `address`, `suburb`, `state`, `country`, `postcode`, `telephone`, `fax`, `misc`, `image`, `imagepos`, `email_to`, `default_con`, `published`, `checked_out`, `checked_out_time`, `ordering`, `params`, `user_id`, `catid`, `access`, `mobile`, `webpage`, `sortname1`, `sortname2`, `sortname3`, `language`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `metakey`, `metadesc`, `metadata`, `featured`, `xreference`, `publish_up`, `publish_down`) VALUES
(1, 'Contact Name Here', 'name', 'Position', 'Street Address', 'Suburb', 'State', 'Country', 'Zip Code', 'Telephone', 'Fax', '<p>Information about or by the contact.</p>', 'images/powered_by.png', 'top', 'email@email.com', 1, -2, 0, '0000-00-00 00:00:00', 1, '{"show_contact_category":"","show_contact_list":"","presentation_style":"","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_profile":"","show_links":"1","linka_name":"Twitter","linka":"http:\\/\\/twitter.com\\/joomla","linkb_name":"YouTube","linkb":"http:\\/\\/www.youtube.com\\/user\\/joomla","linkc_name":"Facebook","linkc":"http:\\/\\/www.facebook.com\\/joomla","linkd_name":"FriendFeed","linkd":"http:\\/\\/friendfeed.com\\/joomla","linke_name":"Scribed","linke":"http:\\/\\/www.scribd.com\\/people\\/view\\/504592-joomla","contact_layout":"","show_email_form":"","show_email_copy":"","banned_email":"","banned_subject":"","banned_text":"","validate_session":"","custom_reply":"","redirect":""}', 0, 16, 1, '', '', 'last', 'first', 'middle', 'en-GB', '2011-01-01 00:00:01', 0, '', '2011-01-08 17:39:00', 42, '', '', '{"robots":"","rights":""}', 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Webmaster', 'webmaster', '', '', '', '', '', '', '', '', '', '', NULL, 'webmaster@example.com', 0, -2, 0, '0000-00-00 00:00:00', 1, '{"show_contact_category":"","show_contact_list":"","presentation_style":"","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_profile":"","show_links":"","linka_name":"","linka":"","linkb_name":"","linkb":"","linkc_name":"","linkc":"","linkd_name":"","linkd":"","linke_name":"","linke":"","show_email_form":"1","show_email_copy":"1","banned_email":"","banned_subject":"","banned_text":"","validate_session":"1","custom_reply":"","redirect":""}', 0, 34, 1, '', '', '', '', '', 'en-GB', '2011-01-01 00:00:01', 0, '', '2011-01-01 00:00:01', 42, '', '', '{"robots":"","rights":""}', 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Owner', 'owner', '', '', '', '', '', '', '', '', '<p>I''m the owner of this store.</p>', '', NULL, '', 0, -2, 0, '0000-00-00 00:00:00', 2, '{"show_contact_category":"","show_contact_list":"","presentation_style":"","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_profile":"","show_links":"","linka_name":"","linka":"","linkb_name":"","linkb":"","linkc_name":"","linkc":"","linkd_name":"","linkd":"","linke_name":"","linke":"","show_email_form":"","show_email_copy":"","banned_email":"","banned_subject":"","banned_text":"","validate_session":"","custom_reply":"","redirect":""}', 0, 36, 1, '', '', '', '', '', '*', '2011-01-01 00:00:01', 0, '', '2011-01-01 00:00:01', 42, '', '', '{"robots":"","rights":""}', 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Buyer', 'buyer', '', '', '', '', '', '', '', '', '<p>I am in charge of buying fruit. If you sell good fruit, contact me.</p>', '', NULL, '', 0, -2, 0, '0000-00-00 00:00:00', 1, '{"show_contact_category":"","show_contact_list":"","presentation_style":"","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_profile":"","show_links":"0","linka_name":"","linka":"","linkb_name":"","linkb":"","linkc_name":"","linkc":"","linkd_name":"","linkd":"","linke_name":"","linke":"","show_email_form":"","show_email_copy":"","banned_email":"","banned_subject":"","banned_text":"","validate_session":"","custom_reply":"","redirect":""}', 0, 36, 1, '', '', '', '', '', '*', '2011-01-01 00:00:01', 0, '', '2011-01-01 00:00:01', 42, '', '', '{"robots":"","rights":""}', 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Bananas', 'bananas', 'Scientific Name: Musa', 'Image Credit: Enzik\r\nRights: Creative Commons Share Alike Unported 3.0\r\nSource: http://commons.wikimedia.org/wiki/File:Bananas_-_Morocco.jpg', '', 'Type: Herbaceous', 'Large Producers: India, China, Brasil', '', '', '', '<p>Bananas are a great source of potassium.</p>\r\n<p> </p>', 'images/sampledata/fruitshop/bananas_2.jpg', NULL, '', 0, -2, 0, '0000-00-00 00:00:00', 1, '{"show_contact_category":"show_with_link","show_contact_list":"","presentation_style":"plain","show_name":"","show_position":"1","show_email":"","show_street_address":"","show_suburb":"","show_state":"1","show_postcode":"","show_country":"1","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_profile":"","show_links":"1","linka_name":"Wikipedia: Banana English","linka":"http:\\/\\/en.wikipedia.org\\/wiki\\/Banana","linkb_name":"Wikipedia:  \\u0939\\u093f\\u0928\\u094d\\u0926\\u0940 \\u0915\\u0947\\u0932\\u093e","linkb":"http:\\/\\/hi.wikipedia.org\\/wiki\\/%E0%A4%95%E0%A5%87%E0%A4%B2%E0%A4%BE","linkc_name":"Wikipedia:Banana Portugu\\u00eas","linkc":"http:\\/\\/pt.wikipedia.org\\/wiki\\/Banana","linkd_name":"Wikipedia: \\u0411\\u0430\\u043d\\u0430\\u043d  \\u0420\\u0443\\u0441\\u0441\\u043a\\u0438\\u0439","linkd":"http:\\/\\/ru.wikipedia.org\\/\\u0411\\u0430\\u043d\\u0430\\u043d","linke_name":"","linke":"","contact_layout":"beez5:encyclopedia"}', 0, 39, 1, '', '', '', '', '', '*', '2011-01-01 00:00:01', 0, '', '2011-01-01 00:00:01', 42, '', '', '{"robots":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Contact Us', 'contact-us', 'Position Goes Here', 'Address goes here', 'Miami', 'Miami', 'United States', '33110', '1-800-IceTheme', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam fermentum, turpis vitae aliquam commodo, nibh nisi ornare metus, nec lacinia nibh odio sed arcu. Cras bibendum sollicitudin quam sed accumsan. Vivamus velit tellus, elementum ut malesuada</p>', 'images/sampledata/icetheme/contact.png', NULL, 'support@icetheme.com', 0, 1, 0, '0000-00-00 00:00:00', 1, '{"show_contact_category":"","show_contact_list":"","presentation_style":"","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_profile":"","show_links":"","linka_name":"","linka":"","linkb_name":"","linkb":"","linkc_name":"","linkc":"","linkd_name":"","linkd":"","linke_name":"","linke":"","contact_layout":"beez5:encyclopedia","show_email_form":"1","show_email_copy":"","banned_email":"","banned_subject":"","banned_text":"","validate_session":"","custom_reply":"","redirect":""}', 0, 16, 1, '1-800-IceTheme-Mobile', 'http://www.icetheme.com', '', '', '', '*', '2011-01-01 00:00:01', 0, '', '2011-08-17 12:31:01', 42, '', '', '{"robots":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Tamarind', 'tamarind', 'Scientific Name: Tamarindus indica', 'Image Credit: Franz Eugen Köhler, Köhler''s Medizinal-Pflanzen \r\nRights: Public Domain\r\nSource:http://commons.wikimedia.org/wiki/File:Koeh-134.jpg', '', 'Family: Fabaceae', 'Large Producers: India, United States', '', '', '', '<p>Tamarinds are a versatile fruit used around the world. In its young form it is used in hot sauces; ripened it is the basis for many refreshing drinks.</p>\r\n<p> </p>', 'images/sampledata/fruitshop/tamarind.jpg', NULL, '', 0, -2, 0, '0000-00-00 00:00:00', 1, '{"show_contact_category":"","show_contact_list":"","presentation_style":"plain","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_profile":"","show_links":"1","linka_name":"Wikipedia: Tamarind English","linka":"http:\\/\\/en.wikipedia.org\\/wiki\\/Tamarind","linkb_name":"Wikipedia: \\u09a4\\u09c7\\u0981\\u09a4\\u09c1\\u09b2  \\u09ac\\u09be\\u0982\\u09b2\\u09be  ","linkb":"http:\\/\\/bn.wikipedia.org\\/wiki\\/\\u09a4\\u09c7\\u0981\\u09a4\\u09c1\\u09b2 ","linkc_name":"Wikipedia: Tamarinier Fran\\u00e7ais","linkc":"http:\\/\\/fr.wikipedia.org\\/wiki\\/Tamarinier","linkd_name":"Wikipedia:Tamaline lea faka-Tonga","linkd":"http:\\/\\/to.wikipedia.org\\/wiki\\/Tamaline","linke_name":"","linke":"","contact_layout":"beez5:encyclopedia"}', 0, 57, 1, '', '', '', '', '', '*', '2011-01-01 00:00:01', 0, '', '2011-01-01 00:00:01', 42, '', '', '{"robots":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Shop Address', 'shop-address', '', '', 'Our City', 'Our Province', 'Our Country', '', '555-555-5555', '', '<p>Here are directions for how to get to our shop.</p>', '', NULL, '', 0, -2, 0, '0000-00-00 00:00:00', 1, '{"show_contact_category":"","show_contact_list":"","presentation_style":"","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_profile":"","show_links":"","linka_name":"","linka":"","linkb_name":"","linkb":"","linkc_name":"","linkc":"","linkd_name":"","linkd":"","linke_name":"","linke":"","show_email_form":"","show_email_copy":"","banned_email":"","banned_subject":"","banned_text":"","validate_session":"","custom_reply":"","redirect":""}', 0, 35, 1, '', '', '', '', '', '*', '2011-01-01 00:00:01', 0, '', '2011-01-01 00:00:01', 42, '', '', '{"robots":"","rights":""}', 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `#__content`
--

DROP TABLE IF EXISTS `#__content`;
CREATE TABLE IF NOT EXISTS `#__content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `title_alias` varchar(255) NOT NULL DEFAULT '',
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `sectionid` int(10) unsigned NOT NULL DEFAULT '0',
  `mask` int(10) unsigned NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` varchar(5120) NOT NULL,
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  `language` char(7) NOT NULL COMMENT 'The language code for the article.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=89 ;

--
-- Dumping data for table `#__content`
--

INSERT INTO `#__content` (`id`, `asset_id`, `title`, `alias`, `title_alias`, `introtext`, `fulltext`, `state`, `sectionid`, `mask`, `catid`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `images`, `urls`, `attribs`, `version`, `parentid`, `ordering`, `metakey`, `metadesc`, `access`, `hits`, `metadata`, `featured`, `language`, `xreference`) VALUES
(88, 195, 'Sample Joomla Article Nr-5 From IceTheme', 'sample-joomla-article-nr-5-from-icetheme', '', '<p><img src="images/sampledata/icetheme/articles/image5.jpg" border="0" alt="Image" width="280" height="170" />  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac quam id dui sollicitudin blandit. Nam id lacinia lectus. Aliquam rhoncus leo ac sapien porta consequat. Suspendisse vitae metus et nisl cursus pharetra. Sed a dui arcu, et tristique urna. Curabitur lectus nibh, consequat vitae ultricies a, lacinia in orci. Integer eros quam, imperdiet sed blandit a, congue eu erat. Phasellus a magna pretium mauris rhoncus eleifend. Duis lacus leo, placerat a ultricies porttitor, aliquet eget nulla. Integer vehicula leo at risus rutrum sit amet pulvinar nibh condimentum. In ullamcorper, ligula vel viverra imperdiet, metus dolor posuere elit, vitae posuere nisl lorem in elit. Nulla facilisi. Praesent dui lectus, venenatis ut fringilla eu, sollicitudin quis sem.Integer eros quam, imperdiet sed blandit a, congue eu erat. Phasellus a magna pretium mauris rhoncus eleifend. Duis lacus leo, placerat a ultricies porttitor.</p>\r\n', '\r\n<p><img src="images/sampledata/icetheme/articles/image5_l.jpg" border="0" alt="Image" width="420" height="250" /> <span class="dropcap">L</span>orem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>\r\n<p>In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</p>\r\n<blockquote>\r\n<p>Just wanted to say that I''ve renewed my membership for IceTheme and decided to not renew others as they continues to make simple, elegant, useful templates that can easily incorporate any or all of the IceTheme mods and therefore cover any and all of my needs - and more. Thanks alot!</p>\r\n</blockquote>\r\n<p>Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu.</p>\r\n<p>Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, <span class="highlight">tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien</span>, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>\r\n<ul>\r\n<li>Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n<li>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing.</li>\r\n<li>Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum.</li>\r\n</ul>\r\n<p>Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.</p>', 1, 0, 0, 80, '2011-08-17 11:52:55', 42, '', '2011-08-17 12:00:22', 0, 0, '0000-00-00 00:00:00', '2011-08-17 11:52:55', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 1, 0, 0, '', '', 1, 2, '{"robots":"","author":"","rights":"","xreference":""}', 1, '*', ''),
(75, 182, 'IceMegaMenu', 'icemegamenu', '', '<p><img src="images/sampledata/icetheme/extensions/icemegamenu.jpg" border="0" alt="IceMegaMenu Module" /></p>\r\n<p><span class="dropcap">W</span>hen the time came and we had to move to the new Joomla 1.6 version, we at IceTheme wanted to give you a special gift, well in fact one of most used modules... a new menu module. But the powerful IceMegaMenu extension is not the next simple menu module that you may find anywhere. No I''m sorry you will not...</p>\r\n<p>Based from our long experience with Joomla and listening as well to your suggestions we are proud to preset one of our most mighty Joomla extension that we have ever built until now. But what makes the IceMegaMenu extension so great?!</p>\r\n<p>First on the extension package you will find the module zip and the plugin zip. The module part has all the necessary features ready at your fingertips to run the menu exactly the way you need to. You will find features like the ability to load different themes (you may have a dark website), dropdown effect like slide, fade or both, ability to load images inside the menu items, dropdown opacity, ability to disable JavaScript and much more.</p>\r\n<p>On the plugin part came the interesting part. After lots of request from our valuable members, now you are able to split the dropdown into as many columns as you wish and exactly the way you need to. Also you may load any Joomla modules inside the dropdown directly by selecting the module name or the module position. Another interesting feature that may be very handy to you is the ability to put for each menu item the width for the dropdown and the width for each column of the dropdown, so as you can see you have total control over the way the module operates.</p>\r\n<h2>Unique Features</h2>\r\n<ul class="star">\r\n<li>Chose your desired style based from your website colors from a list of pre-built module themes</li>\r\n<li>Select the dropdown running effect from slide, fade or both</li>\r\n<li>You may disable the JavaScript if you need just a simple and fast running menu with no conflicts whatsoever.</li>\r\n<li>Ability to load menu images into each menu item</li>\r\n<li>Split exactly the way your require the dropdown by having total control to the full dropdown width, to each column width and the number of menu items to display to each column.</li>\r\n<li>Ability to load any Joomla Module to the dropdown by selecting either from the Module Name of from the Module Position.</li>\r\n</ul>', '', 1, 0, 0, 81, '2011-08-02 12:12:33', 42, '', '2011-08-02 12:16:04', 42, 0, '0000-00-00 00:00:00', '2011-08-02 12:12:33', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 2, 0, 0, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(76, 183, 'IceShare', 'iceshare', '', '<p><img src="images/sampledata/icetheme/extensions/iceshare.jpg" border="0" alt="IceShare" style="border: 0;" /></p>\r\n<p><span class="dropcap">W</span>ith the IceShare plugin you have the possibility to dramatically increase your social circle by letting your users submit your stories on their preferred social websites like FaceBook, Twitter, Yahoo, Digg etc. The benefits of this plug-in are enormous as the traffic that is generated from the social websites can result not only higher but relevant, as well.</p>\r\n<p>This plugin may float on the left or the right of the page making it easier to submit the news. Also this submission is done dynamically without page-load, giving comfort to your users as they don''t have to leave the current page.</p>\r\n<p>The IceShare Plugin is redistributed under the GPL license, so is free for use but note also that for all our Joomla Extensions we provide support from our Forums</p>\r\n<h2>Unique Features</h2>\r\n<ul class="star">\r\n<li>Ability to position the plug-in (left/right)</li>\r\n<li>Ability to automatically scroll the plug-in or not</li>\r\n<li>Enable/Disable each social website and choose your preferred parameters for them</li>\r\n<li>Select the category articles in which the plug-in should appear</li>\r\n<li>Select the component page in which the plug-in should appear</li>\r\n</ul>', '', 0, 0, 0, 81, '2011-08-02 12:12:57', 42, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2011-08-02 12:12:57', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 1, 0, 2, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(77, 184, 'IceSpeed', 'icespeed', '', '<p><img src="images/sampledata/icetheme/extensions/icespeed.jpg" border="0" alt="IceCaption" style="border: 0;" /></p>\r\n<p><span class="dropcap">I</span>IceSpeed Plugin decrease the loading time of your website by compressing, optimizing, merging CSS and JavaScript on your website. With this powerful plugin your website will dramatically decrease the loading time as all CSS and JavaScriopt will be compressied and/or merged. Also you may go one step further and enable Gzip compression technology which can reduce even more the loading time. The other great part of the plugin is the ability to control at your hands the page cache and the browser cache with the parameters. Words are useless to describe how powerful this plugin can be on your website</p>\r\n<h2>Unique Features</h2>\r\n<ul class="star">\r\n<li>Optimize and/or Compress and/or Merge CSS and JavaSript files</li>\r\n<li>Optimize HTML</li>\r\n<li>Ability to exclude/include CSS and JavaScript files</li>\r\n<li>Gzip compression technology option ready!</li>\r\n<li>Ability to change the JavaScript files order (prevent conflicts)</li>\r\n<li>Enable/Disable page cache</li>\r\n<li>Enable/Disable browser default cache</li>\r\n<li>Ability to clear on the fly the cache</li>\r\n<li>You may enable/disable cache to single menu items also</li>\r\n</ul>', '', 1, 0, 0, 81, '2011-08-02 12:13:15', 42, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2011-08-02 12:13:15', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 1, 0, 1, '', '', 1, 1, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(78, 185, 'IceTabs', 'icetabs', '', '<p><img src="images/sampledata/icetheme/extensions/icetabs.jpg" border="0" alt="IceTabs" style="border: 0;" /></p>\r\n<p><span class="dropcap">I</span>ceTabs module marks another immense milestone at IceTheme. We can say without any single doubt that this module is one of the best ever built Joomla Extensions by our club and also on all the Joomla! market as well. But... why?!</p>\r\n<p>First let''s describe what is the scope of the IceTab module.</p>\r\n<p>IceTab module can display any content/banner/images/K2/VirtueMart information with a smooth and nice interface based on the tabular interface. So to describe more clearly, you may display your Joomla content and this is the primary scope of this module but you may easily use it to be a image gallery by switching to the "image" mode. Also you may use to display content from the popular K2 extension an to display products from the VirtueMart extension. The IceTab module is bult-in all parameters needed so that you have the possibility to adjust perfectly in the way you like.</p>\r\n<h2>Unique Features</h2>\r\n<ul class="star">\r\n<li>Display anything by changing mode to content/banner/image/K2/VirtueMart</li>\r\n<li>Suit easily to your website layout by choosing various pre-built themes</li>\r\n<li>Customize the module in the way you like from module parameters</li>\r\n</ul>', '', 1, 0, 0, 81, '2011-08-02 12:13:30', 42, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2011-08-02 12:13:30', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 1, 0, 0, '', '', 1, 3, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(79, 186, 'Your New Home For 4G Smartphones!', 'your-new-home-for-4g-smartphones', '', '<p><img src="images/sampledata/icetheme/icetabs/image1.jpg" border="0" alt="Image" /> Lorem ipsum dolor sit amet, consectetur adipis elit. Nulla non sapien quis tortor porta consequ at in sem. Curabitur venenatis porta suscipit. Aenean accumsan sodales mauris, congue las.</p>\r\n<p><a href="index.php/en/joomshopping/category/view/3">Browse Mobile Phones »</a></p>', '', 1, 0, 0, 78, '2011-08-07 11:01:03', 42, '', '2011-08-16 14:46:18', 42, 42, '2011-08-16 15:20:09', '2011-08-07 11:01:03', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 8, 0, 4, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(80, 187, 'Play Full HD Live You Never Before Before.', 'play-full-hd-live-you-never-before-before', '', '<p><img src="images/sampledata/icetheme/icetabs/image2.jpg" border="0" alt="Image" /> Lorem ipsum dolor sit amet, consectetur adipis elit. Nulla non sapien quis tortor porta consequ at in sem. Curabitur venenatis porta suscipit. Aenean accumsan sodales mauris, congue las.</p>\r\n<p><a href="index.php/en/joomshopping/category/view/13">Browse Video Games »</a></p>', '', 1, 0, 0, 78, '2011-08-07 11:04:06', 42, '', '2011-08-16 15:21:59', 42, 0, '0000-00-00 00:00:00', '2011-08-07 11:04:06', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 6, 0, 3, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(81, 188, 'New Arrivals. Find The Right Speakers Now!', 'new-arrivals-find-the-right-speakers-now', '', '<p><img src="images/sampledata/icetheme/icetabs/image3.jpg" border="0" alt="Image" /> Lorem ipsum dolor sit amet, consectetur adipis elit. Nulla non sapien quis tortor porta consequ at in sem. Curabitur venenatis porta suscipit. Aenean accumsan sodales mauris, congue las.</p>\r\n<p><a href="index.php/en/joomshopping/category/view/36">Browse Computer Speakers »</a></p>', '', 1, 0, 0, 78, '2011-08-07 11:04:59', 42, '', '2011-08-16 15:19:43', 42, 0, '0000-00-00 00:00:00', '2011-08-07 11:04:59', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 3, 0, 2, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(82, 189, 'Surprise Your Spouse With a Diamond Ring', 'surprise-your-spouse-with-a-diamond-ring', '', '<p><img src="images/sampledata/icetheme/icetabs/image4.jpg" border="0" alt="Image" /> Lorem ipsum dolor sit amet, consectetur adipis elit. Nulla non sapien quis tortor porta consequ at in sem. Curabitur venenatis porta suscipit. Aenean accumsan sodales mauris, congue las.</p>\r\n<p><a href="index.php/en/joomshopping/category/view/23">Browse for Rings »</a></p>', '', 1, 0, 0, 78, '2011-08-07 12:16:06', 42, '', '2011-08-16 15:20:06', 42, 0, '0000-00-00 00:00:00', '2011-08-07 12:16:06', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 4, 0, 1, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(83, 190, ' Today''s Offer. 25% off for HD Monitors  ', 'todays-offer-25-off-for-hd-monitors', '', '<p><img src="images/sampledata/icetheme/icetabs/image5.jpg" border="0" alt="Image" /> Lorem ipsum dolor sit amet, consectetur adipis elit. Nulla non sapien quis tortor porta consequ at in sem. Curabitur venenatis porta suscipit. Aenean accumsan sodales mauris, congue las.</p>\r\n<p><a href="index.php/en/joomshopping/category/view/17">Browse For Monitors »</a></p>', '', 1, 0, 0, 78, '2011-08-16 15:18:17', 42, '', '2011-08-17 12:57:43', 42, 0, '0000-00-00 00:00:00', '2011-08-16 15:18:17', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 3, 0, 0, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(84, 191, 'Sample Joomla Article Nr-1 From IceTheme ', 'sample-joomla-article-nr-1-from-icetheme', '', '<p><img src="images/sampledata/icetheme/articles/image1.jpg" border="0" alt="Image" width="160" height="90" />  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac quam id dui sollicitudin blandit. Nam id lacinia lectus. Aliquam rhoncus leo ac sapien porta consequat. Suspendisse vitae metus et nisl cursus pharetra. Sed a dui arcu, et tristique </p>\r\n', '\r\n<p><img src="images/sampledata/icetheme/articles/image1_l.jpg" border="0" alt="Image" width="420" height="250" /> <span class="dropcap">L</span>orem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>\r\n<p>In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</p>\r\n<blockquote>\r\n<p>Just wanted to say that I''ve renewed my membership for IceTheme and decided to not renew others as they continues to make simple, elegant, useful templates that can easily incorporate any or all of the IceTheme mods and therefore cover any and all of my needs - and more. Thanks alot!</p>\r\n</blockquote>\r\n<p>Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu.</p>\r\n<p>Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, <span class="highlight">tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien</span>, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>\r\n<ul>\r\n<li>Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n<li>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing.</li>\r\n<li>Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum.</li>\r\n</ul>\r\n<p>Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.</p>', 1, 0, 0, 80, '2011-08-17 11:52:55', 42, '', '2011-08-17 11:59:09', 42, 0, '0000-00-00 00:00:00', '2011-08-17 11:52:55', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 4, 0, 4, '', '', 1, 1, '{"robots":"","author":"","rights":"","xreference":""}', 1, '*', ''),
(85, 192, 'Sample Joomla Article Nr-2 From IceTheme', 'sample-joomla-article-nr-2-from-icetheme', '', '<p><img src="images/sampledata/icetheme/articles/image2.jpg" border="0" alt="Image" width="160" height="90" />  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac quam id dui sollicitudin blandit. Nam id lacinia lectus. Aliquam rhoncus leo ac sapien porta consequat. Suspendisse vitae metus et nisl cursus pharetra. Sed a dui arcu, et tristique </p>\r\n', '\r\n<p><img src="images/sampledata/icetheme/articles/image2_l.jpg" border="0" alt="Image" width="420" height="250" /> <span class="dropcap">L</span>orem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>\r\n<p>In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</p>\r\n<blockquote>\r\n<p>Just wanted to say that I''ve renewed my membership for IceTheme and decided to not renew others as they continues to make simple, elegant, useful templates that can easily incorporate any or all of the IceTheme mods and therefore cover any and all of my needs - and more. Thanks alot!</p>\r\n</blockquote>\r\n<p>Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu.</p>\r\n<p>Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, <span class="highlight">tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien</span>, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>\r\n<ul>\r\n<li>Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n<li>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing.</li>\r\n<li>Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum.</li>\r\n</ul>\r\n<p>Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.</p>', 1, 0, 0, 80, '2011-08-17 11:52:55', 42, '', '2011-08-17 11:59:28', 42, 0, '0000-00-00 00:00:00', '2011-08-17 11:52:55', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 3, 0, 3, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 1, '*', ''),
(86, 193, 'Sample Joomla Article Nr-3 From IceTheme', 'sample-joomla-article-nr-3-from-icetheme', '', '<p><img src="images/sampledata/icetheme/articles/image3.jpg" border="0" alt="Image" width="160" height="90" />  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac quam id dui sollicitudin blandit. Nam id lacinia lectus. Aliquam rhoncus leo ac sapien porta consequat. Suspendisse vitae metus et nisl cursus pharetra. Sed a dui arcu, et tristique </p>\r\n', '\r\n<p><img src="images/sampledata/icetheme/articles/image3_l.jpg" border="0" alt="Image" width="420" height="250" /> <span class="dropcap">L</span>orem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>\r\n<p>In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</p>\r\n<blockquote>\r\n<p>Just wanted to say that I''ve renewed my membership for IceTheme and decided to not renew others as they continues to make simple, elegant, useful templates that can easily incorporate any or all of the IceTheme mods and therefore cover any and all of my needs - and more. Thanks alot!</p>\r\n</blockquote>\r\n<p>Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu.</p>\r\n<p>Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, <span class="highlight">tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien</span>, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>\r\n<ul>\r\n<li>Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n<li>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing.</li>\r\n<li>Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum.</li>\r\n</ul>\r\n<p>Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.</p>', 1, 0, 0, 80, '2011-08-17 11:52:55', 42, '', '2011-08-17 11:59:44', 42, 0, '0000-00-00 00:00:00', '2011-08-17 11:52:55', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 3, 0, 2, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 1, '*', ''),
(87, 194, 'Sample Joomla Article Nr-4 From IceTheme', 'sample-joomla-article-nr-4-from-icetheme', '', '<p><img src="images/sampledata/icetheme/articles/image4.jpg" border="0" alt="Image" width="160" height="90" />  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac quam id dui sollicitudin blandit. Nam id lacinia lectus. Aliquam rhoncus leo ac sapien porta consequat. Suspendisse vitae metus et nisl cursus pharetra. Sed a dui arcu, et tristique </p>\r\n', '\r\n<p><img src="images/sampledata/icetheme/articles/image4_l.jpg" border="0" alt="Image" width="420" height="250" /> <span class="dropcap">L</span>orem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>\r\n<p>In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</p>\r\n<blockquote>\r\n<p>Just wanted to say that I''ve renewed my membership for IceTheme and decided to not renew others as they continues to make simple, elegant, useful templates that can easily incorporate any or all of the IceTheme mods and therefore cover any and all of my needs - and more. Thanks alot!</p>\r\n</blockquote>\r\n<p>Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu.</p>\r\n<p>Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, <span class="highlight">tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien</span>, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>\r\n<ul>\r\n<li>Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n<li>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing.</li>\r\n<li>Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum.</li>\r\n</ul>\r\n<p>Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.</p>', 1, 0, 0, 80, '2011-08-17 11:52:55', 42, '', '2011-08-17 12:00:22', 42, 0, '0000-00-00 00:00:00', '2011-08-17 11:52:55', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 4, 0, 1, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 1, '*', ''),
(74, 181, 'IceCarousel', 'icecarousel', '', '<p><img src="images/sampledata/icetheme/extensions/icecarousel.jpg" border="0" alt="IceCarousel" style="border: 0;" /></p>\r\n<p>IceCarousel is a very powerful Joomla module with a large set of useful parameters to filter and order your Joomla Articles. It uses Ajax technology to change the slides, which can speed up your site in case you need to display many slides. The module is very easy to be set up and within 2 minutes your Joomla website will have a nice and customized as you wish carousel module.</p>\r\n<p>Also the module support <strong>JoomShopping Extension</strong> to display your products. This part has its own paramters as well.</p>\r\n<p>The IceCarousel Module is redistributed under the GPL license, so is free for use but note also that for all our Joomla Extensions we provide support from our Forums</p>\r\n<h2>Unique Features</h2>\r\n<ul class="star">\r\n<li>Many useful paramters to display exactly those articles that your project require.</li>\r\n<li>Automatically cropeed images with the width and height that you set up</li>\r\n<li>Ajax technology to change slides, which can speed up your site if you need to display lots of items.</li>\r\n<li>Fully support the JoomShopping Extensions. It has its own paramter to filter the products you need to display.</li>\r\n</ul>', '', 1, 0, 0, 81, '2011-08-02 12:12:09', 42, '', '2011-08-16 09:49:34', 42, 0, '0000-00-00 00:00:00', '2011-08-02 12:12:09', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 2, 0, 3, '', '', 1, 10, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(73, 180, 'IceAccordion', 'iceaccordion', '', '<p><img src="images/sampledata/icetheme/extensions/iceaccordion.jpg" border="0" alt="IceAccordion" style="border: 0;" /></p>\r\n<p><span class="dropcap">I</span>ceAccordion is a simple yet powerful module based on the popular Mootools library. It can display a set of article in an accordion way. It should be used when the vertical space is limited and you have a large number of articles. As all our modules, IceAccordion is accessible and usable, mean that if in any case Javascript is disabled on the user''s browser the articles are displayed normally without any problem.</p>\r\n<p> </p>\r\n<p>The IceAccordin Module is redistributed under the GPL license, so is free for use but note also that for all our Joomla Extensions we provide support from our Forums</p>\r\n<h2>Unique Features</h2>\r\n<ul class="star">\r\n<li>Ability to load articles pertaining to a category</li>\r\n<li>Ability to load articles from individual articles IDs</li>\r\n<li>Select from 3 available theme options.</li>\r\n<li>Ability to show/hide the readmore button</li>\r\n</ul>', '', 1, 0, 0, 81, '2011-08-02 12:11:39', 42, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2011-08-02 12:11:39', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 1, 0, 4, '', '', 1, 2, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', '');
INSERT INTO `#__content` (`id`, `asset_id`, `title`, `alias`, `title_alias`, `introtext`, `fulltext`, `state`, `sectionid`, `mask`, `catid`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `images`, `urls`, `attribs`, `version`, `parentid`, `ordering`, `metakey`, `metadesc`, `access`, `hits`, `metadata`, `featured`, `language`, `xreference`) VALUES
(72, 178, 'Typography', 'typography', '', '<h1>This is an H1 Header</h1>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus sapien vel mauris viverra quis euismod dui tincidunt. Phasellus laoreet mattis est, eu vulputate sapien suscipit ac. Vestibulum porttitor justo a est elementum luctus. Nulla ac pharetra nulla. Quisque metus orci, cursus at sollicitudin sit.</p>\r\n<h2>This is an H2 Header</h2>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus sapien vel mauris viverra quis euismod dui tincidunt. Phasellus laoreet mattis est, eu vulputate sapien suscipit ac. Vestibulum porttitor justo a est elementum luctus. Nulla ac pharetra nulla. Quisque metus orci, cursus at sollicitudin sit.</p>\r\n<h3>This is an H3 Header</h3>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus sapien vel mauris viverra quis euismod dui tincidunt. Phasellus laoreet mattis est, eu vulputate sapien suscipit ac. Vestibulum porttitor justo a est elementum luctus. Nulla ac pharetra nulla. Quisque metus orci, cursus at sollicitudin sit.</p>\r\n<h4>This is an H4 Header</h4>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus sapien vel mauris viverra quis euismod dui tincidunt. Phasellus laoreet mattis est, eu vulputate sapien suscipit ac. Vestibulum porttitor justo a est elementum luctus. Nulla ac pharetra nulla. Quisque metus orci, cursus at sollicitudin sit.</p>\r\n<h5>This is an H5 Header</h5>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus sapien vel mauris viverra quis euismod dui tincidunt. Phasellus laoreet mattis est, eu vulputate sapien suscipit ac. Vestibulum porttitor justo a est elementum luctus. Nulla ac pharetra nulla. Quisque metus orci, cursus at sollicitudin sit.</p>\r\n<h6>This is an H6 Header</h6>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus sapien vel mauris viverra quis euismod dui tincidunt. Phasellus laoreet mattis est, eu vulputate sapien suscipit ac. Vestibulum porttitor justo a est elementum luctus. Nulla ac pharetra nulla. Quisque metus orci, cursus at sollicitudin sit.</p>\r\n<hr />\r\n<h2>Lists</h2>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus sapien vel mauris viverra quis euismod dui tincidunt. Phasellus laoreet mattis est, eu vulputate sapien suscipit ac. Vestibulum porttitor justo a est elementum luctus. Nulla ac pharetra nulla. Quisque metus orci, cursus at sollicitudin sit.</p>\r\n<div class="floatleft" style="width: 50%;">\r\n<h3>Ordered List</h3>\r\n<ol>\r\n<li>This is a sample <strong>Ordered List</strong>.</li>\r\n<li>Lorem ipsum dolor sit amet consectetur</li>\r\n<li>Lorem ipsum dolor sit amet consectetur</li>\r\n<li>Lorem ipsum dolor sit amet consectetur</li>\r\n<li>Lorem ipsum dolor sit amet consectetur</li>\r\n<li>Lorem ipsum dolor sit amet consectetur</li>\r\n</ol></div>\r\n<div class="floatleft" style="width: 50%;">\r\n<h3>Unordered List</h3>\r\n<ul>\r\n<li>This is a sample <strong>Unordered List</strong>.</li>\r\n<li>Lorem ipsum dolor sit amet consectetur</li>\r\n<li>Lorem ipsum dolor sit amet consectetur</li>\r\n<li>Lorem ipsum dolor sit amet consectetur</li>\r\n<li>Lorem ipsum dolor sit amet consectetur</li>\r\n<li>Lorem ipsum dolor sit amet consectetur</li>\r\n</ul>\r\n</div>\r\n<div class="floatleft" style="width: 50%;">\r\n<h3>Definition List</h3>\r\n<dl><dt>This is a sample <strong>Definition List</strong>.</dt><dd>Condimentum quis.</dd><dd>Congue Quisque augue elit dolor.</dd><dt>Definiton Lists are important</dt><dd>Congue Quisque augue elit dolor.</dd><dd>Nunc cursus sem et pretium sapien eget.</dd></dl></div>\r\n<p> </p>\r\n<h3>Unordered Lists with classes</h3>\r\n<div class="floatleft" style="width: 50%;">\r\n<ul class="check">\r\n<li>ul with class <strong>check</strong></li>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n</ul>\r\n</div>\r\n<div class="floatleft" style="width: 50%;">\r\n<ul class="arrow">\r\n<li>ul with class <strong>arrow</strong></li>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n</ul>\r\n</div>\r\n<div class="floatleft" style="width: 50%;">\r\n<ul class="cross">\r\n<li>ul with class <strong>cross</strong></li>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n</ul>\r\n</div>\r\n<div class="floatleft" style="width: 50%;">\r\n<ul class="light">\r\n<li>ul with class <strong>light</strong></li>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n</ul>\r\n</div>\r\n<div class="floatleft" style="width: 50%;">\r\n<ul class="star">\r\n<li>ul with class <strong>star</strong></li>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n</ul>\r\n</div>\r\n<div class="floatleft" style="width: 50%;">\r\n<ul class="note">\r\n<li>ul with class <strong>note</strong></li>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n</ul>\r\n</div>\r\n<hr />\r\n<h2>Other Typography</h2>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus sapien vel mauris viverra quis euismod dui tincidunt. Phasellus laoreet mattis est, eu vulputate sapien suscipit ac. Vestibulum porttitor justo a est elementum luctus. Nulla ac pharetra nulla. Quisque metus orci, cursus at sollicitudin sit.</p>\r\n<h3>BlockQuotes</h3>\r\n<p>(use &lt;blockquote&gt;&lt;p&gt;....&lt;/p&gt;&lt;/blockquote&gt;)</p>\r\n<blockquote>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus sapien vel mauris viverra quis euismod dui tincidunt. Phasellus laoreet mattis est, eu vulputate sapien suscipit ac. Vestibulum porttitor justo a est elementum luctus. Nulla ac pharetra.</p>\r\n</blockquote>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tristique sem vel turpis egestas cursus. Vivamus vehicula ligula non orci sollicitudin iaculis in nec enim. Ut eu magna at erat ultricies porta. Quisque vehicula ultrices mauris, ut pellentesque dui fermentum ac. Maecenas condimentum egestas tempor. Morbi bibendum congue purus eu ultrices. Cras pretium commodo velit non convallis. Sed ornare, arcu vitae sagittis elementum, metus lacus pulvinar ligula, non gravida elit sapien vestibulum odio. Pellentesque eget quam lectus, in fermentum urna. Ut libero dui, lobortis eget adipiscing quis, tristique fermentum nunc. Suspendisse tincidunt nisl id orci feugiat semper. Nullam dictum risus et lorem euismod vitae lacinia lacus mattis. Aliquam semper venenatis nunc et fermentum. Morbi accumsan ipsum nec nulla mattis interdum. Integer sit amet sodales enim. In porta placerat scelerisque.</p>\r\n<h3>Highlight</h3>\r\n<p>(Use span with class highlight)</p>\r\n<p>Lorem ipsum dolor sit amet <span class="highlight">consectetur adipiscing elit nulla</span> dapibus sapien vel mauris viverra quis euismod dui tincidunt.</p>\r\n<h3>Dropcaps</h3>\r\n<p>(Use span with class dropcap, on the first letter of the article) <span class="dropcap">L</span>orem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus sapien vel mauris viverra quis euismod dui tincidunt. Phasellus laoreet mattis est, eu vulputate sapien suscipit ac. Vestibulum porttitor justo a est elementum luctus. Nulla ac pharetra nulla. Quisque metus orci, cursus at sollicitudin sit.Phasellus laoreet mattis est, eu vulputate sapien suscipit ac. Vestibulum porttitor justo a est elementum luctus.</p>\r\n<p> </p>\r\n<h3>Tables</h3>\r\n<table summary="This is a sample table from IceTheme for Joomla Templates" border="0"><caption>Sample Table</caption>\r\n<thead>\r\n<tr class="odd"><th class="column1"> </th><th scope="col">Column One</th><th scope="col">Column Two</th><th scope="col">Column Three</th></tr>\r\n</thead>\r\n<tfoot>\r\n<tr class="odd">\r\n<td class="column1"> </td>\r\n<th scope="col">Footer Col One</th><th scope="col">Footer Col Two</th><th scope="col">Footer Col Three</th></tr>\r\n</tfoot>\r\n<tbody>\r\n<tr><th class="column1" scope="row">Row One</th>\r\n<td>Row One / TD One</td>\r\n<td>Row One / TD Two</td>\r\n<td>Row One / TD Three</td>\r\n</tr>\r\n<tr class="odd"><th class="column1" scope="row">Row Two</th>\r\n<td>Row Two / TD One</td>\r\n<td>Row Two / TD Two</td>\r\n<td>Row Two / TD Three</td>\r\n</tr>\r\n<tr><th class="column1" scope="row">Row Three</th>\r\n<td>Row Three / TD One</td>\r\n<td>Row Three / TD Two</td>\r\n<td>Row Three / TD Three</td>\r\n</tr>\r\n<tr class="odd"><th class="column1" scope="row">Row Four</th>\r\n<td>Row Four / TD One</td>\r\n<td>Row Four / TD Two</td>\r\n<td>Row Four / TD Three</td>\r\n</tr>\r\n<tr><th class="column1" scope="row">Row Five</th>\r\n<td>Row Five / TD One</td>\r\n<td>Row Five / TD Two</td>\r\n<td>Row Five / TD Three</td>\r\n</tr>\r\n<tr class="odd"><th class="column1" scope="row">Row Six</th>\r\n<td>Row Six / TD One</td>\r\n<td>Row Six / TD Two</td>\r\n<td>Row Six / TD Three</td>\r\n</tr>\r\n<tr><th class="column1" scope="row">Row Seven</th>\r\n<td>Row Seven / TD One</td>\r\n<td>Row Seven / TD Two</td>\r\n<td>Row Seven / TD Three</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<hr />\r\n<h1>Forms</h1>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus sapien vel mauris viverra quis euismod dui tincidunt. Phasellus laoreet mattis est, eu vulputate sapien suscipit ac. Vestibulum porttitor justo a est elementum luctus. Nulla ac pharetra nulla. Quisque metus orci, cursus at sollicitudin sit.</p>\r\n<p class="notice">This is a sample of the ''notice'' style. Use this style to give your users a message that require a note</p>\r\n<p class="success">This is a sample of the ''success'' style. Use this style to give your users a message when a successful task was completed</p>\r\n<p class="error">This is a sample of the ''error'' style. Use this style to give your users a message when a task was wrongly completed</p>\r\n<form method="post"><fieldset><legend>Sample Legend</legend>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus sapien vel mauris viverra quis euismod dui tincidunt. Phasellus laoreet mattis est, eu vulputate sapien suscipit ac. Vestibulum porttitor justo a est elementum luctus. Nulla ac pharetra nulla. Quisque metus orci.</p>\r\n<p><label for="input">Sample Input</label> <input id="name" class="inputbox" type="input" name="name" /></p>\r\n<p><input id="radio" type="radio" /><label for="radio">Sample Radio Input</label></p>\r\n<p><input id="checkbox" type="checkbox" /><label for="checkbox">Sample CheckBox Input:</label></p>\r\n<p><label for="select">Sample Select Field:</label><br /> <select id="select"><option>Option One</option><option>Option Two</option></select></p>\r\n<p><label for="textarea">Sample Textarea Field:</label><br /> <textarea id="textarea" rows="5" cols="30">Textarea text</textarea></p>\r\n<button><span class="round"><span>Submit Button</span></span></button> <button><span class="round"><span>Reset Button</span></span></button></fieldset></form>', '', 1, 0, 0, 79, '2011-08-01 12:18:31', 42, '', '2011-08-19 09:13:45', 42, 0, '0000-00-00 00:00:00', '2011-08-01 12:18:31', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 3, 0, 0, '', '', 1, 36, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(68, 174, 'Clone Installer', 'clone-installer', '', '<p><span class="dropcap">I</span>ceTheme is here to make your things as easy as possible providing you the tools that you need to make your website working as fast as a simple Joomla Installation. With the "Clone Installer" package you have the possibility to make your website exactly as you see on our demo page (http://demo.icetheme.com).</p>\r\n<p>This great feature will save you lots of time as you will have all the configurations and parameters set by default. Also you will have our sample images updated and every extension enabled and working. So all you have to do is to change the images or the some parameters and you are done.</p>\r\n<p>Anyway be careful as this package will work only if you are starting your website from scratch. If you already have a working Joomla! website you should not make use of this feature as the database sql file may delete your current database.</p>\r\n<p>For more information on how-to set up your website with the Clone Installer package please refer to the Installation Guide in PDF format which is inside the All in One Package. In case you have any questions please <a href="http://icetheme.com/About/Contact.html">Contact Us</a></p>', '', 1, 0, 0, 79, '2011-08-01 12:16:58', 42, '', '2011-08-16 10:01:05', 42, 0, '0000-00-00 00:00:00', '2011-08-01 12:16:58', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 3, 0, 4, '', '', 1, 26, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(69, 175, 'Module Positions', 'module-positions', '', '<p><span class="dropcap">T</span>his Joomla! template supports a wide variety of module positions which can be archived automatically by the system.The module positions are fully collapsible mean that if there are no modules published in particular position, this module position will disappear and the other modules with take this place.</p>\r\n<p>Also you can have 3-Columns layout (content, left and right), 2-Columns layout (content plus left or right) or 1-Column layout (only the content). The width for the left and right columns can be set through the Template Manager in Joomla Administrator.</p>\r\n<p><img src="images/sampledata/icetheme/features/layout.jpg" border="0" alt="Module Positions" /></p>', '', 1, 0, 0, 79, '2011-08-01 12:17:19', 42, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2011-08-01 12:17:19', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 1, 0, 3, '', '', 1, 13, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(70, 176, 'Module Variations', 'module-variations', '', '<p>This page on our demo template is showing you general all our possible modules with styles included. The modules are fully collapsible mean that if there are no modules published in a particular area, this module position will disappear...</p>\r\n', '\r\n<p><span class="dropcap">T</span>his page on our demo template is showing you all our possible modules with their respective styles included. The modules are fully collapsible which mean that if there are no modules published in a particular area, this module position will disappear.</p>\r\n<p>The module class suffixes that you can use are:</p>\r\n<ul>\r\n<li><strong>-style1</strong> (available to left,right,promo1,promo2 andpromo3 modules positions)</li>\r\n<li><strong>-style2</strong> (available to left,right,promo1,promo2 and promo3 modules positions)</li>\r\n</ul>\r\n<p>If you want to use a module class suffix, please follow this instructions. First login into the Joomla administrator and go to Extensions, then to Module Manager page. Select your desired module and find the "Module Class Suffix" input box. Add your module class suffix in this box and save. Note that you should NOT add the (point) before the module suffix as it is the CSS class.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed neque lacus, at fermentum turpis. Maecenas id lectus in augue consequat viverra id eu tortor. Sed suscipit, velit id venenatis sagittis, nunc magna suscipit nibh, ut laoreet velit dui sit amet turpis. Praesent molestie lobortis fermentum. Curabitur eget nisi quis lorem dapibus placerat sit amet et sapien. Curabitur in interdum ligula. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque habitant morbi tristique senectus et netus.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed neque lacus, at fermentum turpis. Maecenas id lectus in augue consequat viverra id eu tortor. Sed suscipit, velit id venenatis sagittis, nunc magna suscipit nibh, ut laoreet velit dui sit amet turpis. Praesent molestie lobortis fermentum.</p>', 1, 0, 0, 79, '2011-08-01 12:17:40', 42, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2011-08-01 12:17:40', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 1, 0, 2, '', '', 1, 224, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(71, 177, 'Template Styles', 'template-styles', '', '<p>This Joomla template is built-in with an amazing set of 6 different stylish color variations. You can easily change the template style on the Template Manager in J! Administrator. Also your users can have a option to change the style on the fly through our template style-changer.</p>\r\n<p class="notice">Click on the corresponding image to load the Style</p>\r\n<ul class="ice-template-style">\r\n<li><span>Style1</span> <a href="index.php/features/template-styles?&amp;TemplateStyle=style1"> <img src="images/sampledata/icetheme/features/styles/style_1.jpg" border="0" alt="Template Style 1" width="245" height="150" /></a></li>\r\n<li><span>Style2</span> <a href="index.php/features/template-styles?&amp;TemplateStyle=style2"> <img src="images/sampledata/icetheme/features/styles/style_2.jpg" border="0" alt="Template Style 2" width="245" height="150" /></a></li>\r\n<li><span>Style3</span> <a href="index.php/features/template-styles?&amp;TemplateStyle=style3"> <img src="images/sampledata/icetheme/features/styles/style_3.jpg" border="0" alt="Template Style 3" width="245" height="150" /></a></li>\r\n<li><span>Style4</span> <a href="index.php/features/template-styles?&amp;TemplateStyle=style4"> <img src="images/sampledata/icetheme/features/styles/style_4.jpg" border="0" alt="Template Style 4" width="245" height="150" /></a></li>\r\n<li><span>Style5</span> <a href="index.php/features/template-styles?&amp;TemplateStyle=style5"> <img src="images/sampledata/icetheme/features/styles/style_5.jpg" border="0" alt="Template Style 5" width="245" height="150" /></a></li>\r\n<li><span>Style6</span> <a href="index.php/features/template-styles?&amp;TemplateStyle=style6"> <img src="images/sampledata/icetheme/features/styles/style_6.jpg" border="0" alt="Template Style 6" width="245" height="150" /></a></li>\r\n</ul>', '', 1, 0, 0, 79, '2011-08-01 12:18:09', 42, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2011-08-01 12:18:09', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 1, 0, 1, '', '', 1, 11, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(67, 168, 'What''s New in 1.5?', 'whats-new-in-15', '', '<p>This article deliberately archived as an example.</p><p>As with previous releases, Joomla! provides a unified and easy-to-use framework for delivering content for Web sites of all kinds. To support the changing nature of the Internet and emerging Web technologies, Joomla! required substantial restructuring of its core functionality and we also used this effort to simplify many challenges within the current user interface. Joomla! 1.5 has many new features.</p>\r\n<p style="margin-bottom: 0in;">In Joomla! 1.5, you''''ll notice:</p>\r\n<ul>\r\n<li>Substantially improved usability, manageability, and scalability far beyond the original Mambo foundations</li>\r\n<li>Expanded accessibility to support internationalisation, double-byte characters and right-to-left support for Arabic, Farsi, and Hebrew languages among others</li>\r\n<li>Extended integration of external applications through Web services</li>\r\n<li>Enhanced content delivery, template and presentation capabilities to support accessibility standards and content delivery to any destination</li>\r\n<li>A more sustainable and flexible framework for Component and Extension developers</li>\r\n<li>Backward compatibility with previous releases of Components, Templates, Modules, and other Extensions</li>\r\n</ul>', '', 2, 0, 0, 9, '2011-01-01 00:00:01', 42, 'Joomla! 1.5', '2011-01-01 00:00:01', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 1, 0, 0, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', '');

-- --------------------------------------------------------

--
-- Table structure for table `#__content_frontpage`
--

DROP TABLE IF EXISTS `#__content_frontpage`;
CREATE TABLE IF NOT EXISTS `#__content_frontpage` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__content_frontpage`
--

INSERT INTO `#__content_frontpage` (`content_id`, `ordering`) VALUES
(8, 7),
(35, 9),
(24, 6),
(50, 8),
(84, 1),
(85, 2),
(86, 3),
(87, 4),
(88, 5);

-- --------------------------------------------------------

--
-- Table structure for table `#__content_rating`
--

DROP TABLE IF EXISTS `#__content_rating`;
CREATE TABLE IF NOT EXISTS `#__content_rating` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `rating_sum` int(10) unsigned NOT NULL DEFAULT '0',
  `rating_count` int(10) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__content_rating`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__core_log_searches`
--

DROP TABLE IF EXISTS `#__core_log_searches`;
CREATE TABLE IF NOT EXISTS `#__core_log_searches` (
  `search_term` varchar(128) NOT NULL DEFAULT '',
  `hits` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__core_log_searches`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__extensions`
--

DROP TABLE IF EXISTS `#__extensions`;
CREATE TABLE IF NOT EXISTS `#__extensions` (
  `extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `element` varchar(100) NOT NULL,
  `folder` varchar(100) NOT NULL,
  `client_id` tinyint(3) NOT NULL,
  `enabled` tinyint(3) NOT NULL DEFAULT '1',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `protected` tinyint(3) NOT NULL DEFAULT '0',
  `manifest_cache` text NOT NULL,
  `params` text NOT NULL,
  `custom_data` text NOT NULL,
  `system_data` text NOT NULL,
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) DEFAULT '0',
  `state` int(11) DEFAULT '0',
  PRIMARY KEY (`extension_id`),
  KEY `element_clientid` (`element`,`client_id`),
  KEY `element_folder_clientid` (`element`,`folder`,`client_id`),
  KEY `extension` (`type`,`element`,`folder`,`client_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10045 ;

--
-- Dumping data for table `#__extensions`
--

INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(1, 'com_mailto', 'component', 'com_mailto', '', 0, 1, 1, 1, '{"legacy":false,"name":"com_mailto","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_MAILTO_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(2, 'com_wrapper', 'component', 'com_wrapper', '', 0, 1, 1, 1, '{"legacy":false,"name":"com_wrapper","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_WRAPPER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(3, 'com_admin', 'component', 'com_admin', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_admin","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_ADMIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(4, 'com_banners', 'component', 'com_banners', '', 1, 1, 1, 0, '{"legacy":false,"name":"com_banners","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_BANNERS_XML_DESCRIPTION","group":""}', '{"purchase_type":"3","track_impressions":"0","track_clicks":"0","metakey_prefix":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(5, 'com_cache', 'component', 'com_cache', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_cache","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_CACHE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(6, 'com_categories', 'component', 'com_categories', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_categories","type":"component","creationDate":"December 2007","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_CATEGORIES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(7, 'com_checkin', 'component', 'com_checkin', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_checkin","type":"component","creationDate":"Unknown","author":"Joomla! Project","copyright":"(C) 2005 - 2008 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_CHECKIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(8, 'com_contact', 'component', 'com_contact', '', 1, 1, 1, 0, '{"legacy":false,"name":"com_contact","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_CONTACT_XML_DESCRIPTION","group":""}', '{"contact_layout":"_:default","show_contact_category":"hide","show_contact_list":"0","presentation_style":"sliders","show_name":"1","show_position":"1","show_email":"0","show_street_address":"1","show_suburb":"1","show_state":"1","show_postcode":"1","show_country":"1","show_telephone":"1","show_mobile":"1","show_fax":"1","show_webpage":"1","show_misc":"1","show_image":"1","image":"","allow_vcard":"0","show_articles":"0","show_profile":"0","show_links":"0","linka_name":"","linkb_name":"","linkc_name":"","linkd_name":"","linke_name":"","contact_icons":"0","icon_address":"","icon_email":"","icon_telephone":"","icon_mobile":"","icon_fax":"","icon_misc":"","category_layout":"_:default","show_category_title":"1","show_description":"1","show_description_image":"0","maxLevel":"-1","show_empty_categories":"0","show_subcat_desc":"1","show_cat_items":"1","show_base_description":"1","maxLevelcat":"-1","show_empty_categories_cat":"0","show_subcat_desc_cat":"1","show_cat_items_cat":"1","show_pagination_limit":"1","show_headings":"1","show_position_headings":"1","show_email_headings":"0","show_telephone_headings":"1","show_mobile_headings":"0","show_fax_headings":"0","show_suburb_headings":"1","show_state_headings":"1","show_country_headings":"1","show_pagination":"2","show_pagination_results":"1","show_email_form":"1","show_email_copy":"1","banned_email":"","banned_subject":"","banned_text":"","validate_session":"1","custom_reply":"0","redirect":"","show_feed_link":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(9, 'com_cpanel', 'component', 'com_cpanel', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_cpanel","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_CPANEL_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10, 'com_installer', 'component', 'com_installer', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_installer","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_INSTALLER_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(11, 'com_languages', 'component', 'com_languages', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_languages","type":"component","creationDate":"2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_LANGUAGES_XML_DESCRIPTION","group":""}', '{"administrator":"en-GB","site":"en-GB"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(12, 'com_login', 'component', 'com_login', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_login","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_LOGIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(13, 'com_media', 'component', 'com_media', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_media","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_MEDIA_XML_DESCRIPTION","group":""}', '{"upload_extensions":"bmp,csv,doc,gif,ico,jpg,jpeg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,BMP,CSV,DOC,GIF,ICO,JPG,JPEG,ODG,ODP,ODS,ODT,PDF,PNG,PPT,SWF,TXT,XCF,XLS","upload_maxsize":"10","file_path":"images","image_path":"images","restrict_uploads":"1","allowed_media_usergroup":"3","check_mime":"1","image_extensions":"bmp,gif,jpg,png","ignore_extensions":"","upload_mime":"image\\/jpeg,image\\/gif,image\\/png,image\\/bmp,application\\/x-shockwave-flash,application\\/msword,application\\/excel,application\\/pdf,application\\/powerpoint,text\\/plain,application\\/x-zip","upload_mime_illegal":"text\\/html","enable_flash":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(14, 'com_menus', 'component', 'com_menus', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_menus","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_MENUS_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(15, 'com_messages', 'component', 'com_messages', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_messages","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_MESSAGES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(16, 'com_modules', 'component', 'com_modules', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_modules","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_MODULES_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(17, 'com_newsfeeds', 'component', 'com_newsfeeds', '', 1, 1, 1, 0, '{"legacy":false,"name":"com_newsfeeds","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_NEWSFEEDS_XML_DESCRIPTION","group":""}', '{"show_feed_image":"1","show_feed_description":"1","show_item_description":"1","feed_word_count":"0","show_headings":"1","show_name":"1","show_articles":"0","show_link":"1","show_description":"1","show_description_image":"1","display_num":"","show_pagination_limit":"1","show_pagination":"1","show_pagination_results":"1","show_cat_items":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(18, 'com_plugins', 'component', 'com_plugins', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_plugins","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_PLUGINS_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(19, 'com_search', 'component', 'com_search', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_search","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_SEARCH_XML_DESCRIPTION","group":""}', '{"enabled":"0","show_date":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(20, 'com_templates', 'component', 'com_templates', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_templates","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_TEMPLATES_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(21, 'com_weblinks', 'component', 'com_weblinks', '', 1, 1, 1, 0, '{"legacy":false,"name":"com_weblinks","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_WEBLINKS_XML_DESCRIPTION","group":""}', '{"show_comp_description":"1","comp_description":"","show_link_hits":"1","show_link_description":"1","show_other_cats":"0","show_headings":"0","show_numbers":"0","show_report":"1","count_clicks":"1","target":"0","link_icons":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(22, 'com_content', 'component', 'com_content', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_content","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_CONTENT_XML_DESCRIPTION","group":""}', '{"article_layout":"_:default","show_title":"1","link_titles":"1","show_intro":"0","show_category":"1","link_category":"1","show_parent_category":"0","link_parent_category":"0","show_author":"1","link_author":"0","show_create_date":"0","show_modify_date":"0","show_publish_date":"1","show_item_navigation":"1","show_vote":"0","show_readmore":"1","show_readmore_title":"1","readmore_limit":"100","show_icons":"1","show_print_icon":"1","show_email_icon":"1","show_hits":"1","show_noauth":"0","category_layout":"_:blog","show_category_title":"0","show_description":"0","show_description_image":"0","maxLevel":"1","show_empty_categories":"0","show_no_articles":"1","show_subcat_desc":"1","show_cat_num_articles":"0","show_base_description":"1","maxLevelcat":"-1","show_empty_categories_cat":"0","show_subcat_desc_cat":"1","show_cat_num_articles_cat":"1","num_leading_articles":"1","num_intro_articles":"4","num_columns":"2","num_links":"4","multi_column_order":"0","show_subcategory_content":"0","show_pagination_limit":"1","filter_field":"hide","show_headings":"1","list_show_date":"0","date_format":"","list_show_hits":"1","list_show_author":"1","orderby_pri":"order","orderby_sec":"rdate","order_date":"published","show_pagination":"2","show_pagination_results":"1","show_feed_link":"1","feed_summary":"0","filters":{"1":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"6":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"7":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"2":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"3":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"4":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"5":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"10":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"12":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"8":{"filter_type":"BL","filter_tags":"","filter_attributes":""}}}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(23, 'com_config', 'component', 'com_config', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_config","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_CONFIG_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(24, 'com_redirect', 'component', 'com_redirect', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_redirect","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_REDIRECT_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(25, 'com_users', 'component', 'com_users', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_users","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"COM_USERS_XML_DESCRIPTION","group":""}', '{"allowUserRegistration":"1","new_usertype":"2","useractivation":"1","frontend_userparams":"1","mailSubjectPrefix":"","mailBodySuffix":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(100, 'PHPMailer', 'library', 'phpmailer', '', 0, 1, 1, 1, '{"legacy":false,"name":"PHPMailer","type":"library","creationDate":"2008","author":"PHPMailer","copyright":"Copyright (C) PHPMailer.","authorEmail":"","authorUrl":"http:\\/\\/phpmailer.codeworxtech.com\\/","version":"1.7.0","description":"Classes for sending email","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(101, 'SimplePie', 'library', 'simplepie', '', 0, 1, 1, 1, '{"legacy":false,"name":"SimplePie","type":"library","creationDate":"2008","author":"SimplePie","copyright":"Copyright (C) 2008 SimplePie","authorEmail":"","authorUrl":"http:\\/\\/simplepie.org\\/","version":"1.0.1","description":"A PHP-Based RSS and Atom Feed Framework.","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(102, 'phputf8', 'library', 'phputf8', '', 0, 1, 1, 1, '{"legacy":false,"name":"phputf8","type":"library","creationDate":"2008","author":"Harry Fuecks","copyright":"Copyright various authors","authorEmail":"","authorUrl":"http:\\/\\/sourceforge.net\\/projects\\/phputf8","version":"1.7.0","description":"Classes for UTF8","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(103, 'Joomla! Web Application Framework', 'library', 'joomla', '', 0, 1, 1, 1, '{"legacy":false,"name":"Joomla! Web Application Framework","type":"library","creationDate":"2008","author":"Joomla","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"http:\\/\\/www.joomla.org","version":"1.7.0","description":"The Joomla! Web Application Framework is the Core of the Joomla! Content Management System","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(200, 'mod_articles_archive', 'module', 'mod_articles_archive', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_articles_archive","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters.\\n\\t\\tAll rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_ARTICLES_ARCHIVE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(201, 'mod_articles_latest', 'module', 'mod_articles_latest', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_articles_latest","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_LATEST_NEWS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(202, 'mod_articles_popular', 'module', 'mod_articles_popular', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_articles_popular","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_POPULAR_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(203, 'mod_banners', 'module', 'mod_banners', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_banners","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_BANNERS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(204, 'mod_breadcrumbs', 'module', 'mod_breadcrumbs', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_breadcrumbs","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_BREADCRUMBS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(205, 'mod_custom', 'module', 'mod_custom', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_custom","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_CUSTOM_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(206, 'mod_feed', 'module', 'mod_feed', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_feed","type":"module","creationDate":"July 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_FEED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(207, 'mod_footer', 'module', 'mod_footer', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_footer","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_FOOTER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(208, 'mod_login', 'module', 'mod_login', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_login","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_LOGIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(209, 'mod_menu', 'module', 'mod_menu', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_menu","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_MENU_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(210, 'mod_articles_news', 'module', 'mod_articles_news', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_articles_news","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_ARTICLES_NEWS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(211, 'mod_random_image', 'module', 'mod_random_image', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_random_image","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_RANDOM_IMAGE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(212, 'mod_related_items', 'module', 'mod_related_items', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_related_items","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_RELATED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(213, 'mod_search', 'module', 'mod_search', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_search","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_SEARCH_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(214, 'mod_stats', 'module', 'mod_stats', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_stats","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_STATS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(215, 'mod_syndicate', 'module', 'mod_syndicate', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_syndicate","type":"module","creationDate":"May 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_SYNDICATE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(216, 'mod_users_latest', 'module', 'mod_users_latest', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_users_latest","type":"module","creationDate":"December 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_USERS_LATEST_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(217, 'mod_weblinks', 'module', 'mod_weblinks', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_weblinks","type":"module","creationDate":"July 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_WEBLINKS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(218, 'mod_whosonline', 'module', 'mod_whosonline', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_whosonline","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_WHOSONLINE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(219, 'mod_wrapper', 'module', 'mod_wrapper', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_wrapper","type":"module","creationDate":"October 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_WRAPPER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(220, 'mod_articles_category', 'module', 'mod_articles_category', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_articles_category","type":"module","creationDate":"February 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters.\\n\\t\\tAll rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_ARTICLES_CATEGORY_XML_DESCRIPTION\\n\\t","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(221, 'mod_articles_categories', 'module', 'mod_articles_categories', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_articles_categories","type":"module","creationDate":"February 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_ARTICLES_CATEGORIES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(222, 'mod_languages', 'module', 'mod_languages', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_languages","type":"module","creationDate":"February 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_LANGUAGES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(300, 'mod_custom', 'module', 'mod_custom', '', 1, 1, 1, 1, '{"legacy":false,"name":"mod_custom","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_CUSTOM_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(301, 'mod_feed', 'module', 'mod_feed', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_feed","type":"module","creationDate":"July 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_FEED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(302, 'mod_latest', 'module', 'mod_latest', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_latest","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_LATEST_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(303, 'mod_logged', 'module', 'mod_logged', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_logged","type":"module","creationDate":"January 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_LOGGED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(304, 'mod_login', 'module', 'mod_login', '', 1, 1, 1, 1, '{"legacy":false,"name":"mod_login","type":"module","creationDate":"March 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_LOGIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(305, 'mod_menu', 'module', 'mod_menu', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_menu","type":"module","creationDate":"March 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_MENU_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(306, 'mod_online', 'module', 'mod_online', '', 1, 1, 1, 1, 'false', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(307, 'mod_popular', 'module', 'mod_popular', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_popular","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_POPULAR_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(308, 'mod_quickicon', 'module', 'mod_quickicon', '', 1, 1, 1, 1, '{"legacy":false,"name":"mod_quickicon","type":"module","creationDate":"Nov 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_QUICKICON_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(309, 'mod_status', 'module', 'mod_status', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_status","type":"module","creationDate":"Feb 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_STATUS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(310, 'mod_submenu', 'module', 'mod_submenu', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_submenu","type":"module","creationDate":"Feb 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_SUBMENU_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(311, 'mod_title', 'module', 'mod_title', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_title","type":"module","creationDate":"Nov 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_TITLE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(312, 'mod_toolbar', 'module', 'mod_toolbar', '', 1, 1, 1, 1, '{"legacy":false,"name":"mod_toolbar","type":"module","creationDate":"Nov 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"MOD_TOOLBAR_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(313, 'mod_unread', 'module', 'mod_unread', '', 1, 1, 1, 1, 'false', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(400, 'plg_authentication_gmail', 'plugin', 'gmail', 'authentication', 0, 0, 1, 0, '{"legacy":false,"name":"plg_authentication_gmail","type":"plugin","creationDate":"February 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_GMAIL_XML_DESCRIPTION","group":""}', '{"applysuffix":"0","suffix":"","verifypeer":"1","user_blacklist":""}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(401, 'plg_authentication_joomla', 'plugin', 'joomla', 'authentication', 0, 1, 1, 1, '{"legacy":false,"name":"plg_authentication_joomla","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_AUTH_JOOMLA_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(402, 'plg_authentication_ldap', 'plugin', 'ldap', 'authentication', 0, 0, 1, 0, '{"legacy":false,"name":"plg_authentication_ldap","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_LDAP_XML_DESCRIPTION","group":""}', '{"host":"","port":"389","use_ldapV3":"0","negotiate_tls":"0","no_referrals":"0","auth_method":"bind","base_dn":"","search_string":"","users_dn":"","username":"admin","password":"bobby7","ldap_fullname":"fullName","ldap_email":"mail","ldap_uid":"uid"}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(404, 'plg_content_emailcloak', 'plugin', 'emailcloak', 'content', 0, 1, 1, 0, '{"legacy":false,"name":"plg_content_emailcloak","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_CONTENT_EMAILCLOAK_XML_DESCRIPTION","group":""}', '{"mode":"1"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(405, 'plg_content_geshi', 'plugin', 'geshi', 'content', 0, 0, 1, 0, '{"legacy":false,"name":"plg_content_geshi","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"","authorUrl":"qbnz.com\\/highlighter","version":"1.7.0","description":"PLG_CONTENT_GESHI_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(406, 'plg_content_loadmodule', 'plugin', 'loadmodule', 'content', 0, 1, 1, 0, '{"legacy":false,"name":"plg_content_loadmodule","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_LOADMODULE_XML_DESCRIPTION","group":""}', '{"style":"none"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(407, 'plg_content_pagebreak', 'plugin', 'pagebreak', 'content', 0, 1, 1, 1, '{"legacy":false,"name":"plg_content_pagebreak","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_CONTENT_PAGEBREAK_XML_DESCRIPTION","group":""}', '{"title":"1","multipage_toc":"1","showall":"1"}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(408, 'plg_content_pagenavigation', 'plugin', 'pagenavigation', 'content', 0, 1, 1, 1, '{"legacy":false,"name":"plg_content_pagenavigation","type":"plugin","creationDate":"January 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_PAGENAVIGATION_XML_DESCRIPTION","group":""}', '{"position":"1"}', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(409, 'plg_content_vote', 'plugin', 'vote', 'content', 0, 1, 1, 1, '{"legacy":false,"name":"plg_content_vote","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_VOTE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 6, 0),
(410, 'plg_editors_codemirror', 'plugin', 'codemirror', 'editors', 0, 1, 1, 1, '{"legacy":false,"name":"plg_editors_codemirror","type":"plugin","creationDate":"28 March 2011","author":"Marijn Haverbeke","copyright":"","authorEmail":"N\\/A","authorUrl":"","version":"1.0","description":"PLG_CODEMIRROR_XML_DESCRIPTION","group":""}', '{"linenumbers":"0","tabmode":"indent"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(411, 'plg_editors_none', 'plugin', 'none', 'editors', 0, 1, 1, 1, '{"legacy":false,"name":"plg_editors_none","type":"plugin","creationDate":"August 2004","author":"Unknown","copyright":"","authorEmail":"N\\/A","authorUrl":"","version":"1.7.0","description":"PLG_NONE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(412, 'plg_editors_tinymce', 'plugin', 'tinymce', 'editors', 0, 1, 1, 1, '{"legacy":false,"name":"plg_editors_tinymce","type":"plugin","creationDate":"2005-2011","author":"Moxiecode Systems AB","copyright":"Moxiecode Systems AB","authorEmail":"N\\/A","authorUrl":"tinymce.moxiecode.com\\/","version":"3.4.3.2","description":"PLG_TINY_XML_DESCRIPTION","group":""}', '{"mode":"1","skin":"0","compressed":"0","cleanup_startup":"0","cleanup_save":"2","entity_encoding":"raw","lang_mode":"0","lang_code":"en","text_direction":"ltr","content_css":"1","content_css_custom":"","relative_urls":"1","newlines":"0","invalid_elements":"script,applet,iframe","extended_elements":"","toolbar":"top","toolbar_align":"left","html_height":"550","html_width":"750","element_path":"1","fonts":"1","paste":"1","searchreplace":"1","insertdate":"1","format_date":"%Y-%m-%d","inserttime":"1","format_time":"%H:%M:%S","colors":"1","table":"1","smilies":"1","media":"1","hr":"1","directionality":"1","fullscreen":"1","style":"1","layer":"1","xhtmlxtras":"1","visualchars":"1","nonbreaking":"1","template":"1","blockquote":"1","wordcount":"1","advimage":"1","advlink":"1","autosave":"1","contextmenu":"1","inlinepopups":"1","safari":"0","custom_plugin":"","custom_button":""}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(413, 'plg_editors-xtd_article', 'plugin', 'article', 'editors-xtd', 0, 1, 1, 1, '{"legacy":false,"name":"plg_editors-xtd_article","type":"plugin","creationDate":"October 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_ARTICLE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(414, 'plg_editors-xtd_image', 'plugin', 'image', 'editors-xtd', 0, 1, 1, 0, '{"legacy":false,"name":"plg_editors-xtd_image","type":"plugin","creationDate":"August 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_IMAGE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(415, 'plg_editors-xtd_pagebreak', 'plugin', 'pagebreak', 'editors-xtd', 0, 1, 1, 0, '{"legacy":false,"name":"plg_editors-xtd_pagebreak","type":"plugin","creationDate":"August 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_EDITORSXTD_PAGEBREAK_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(416, 'plg_editors-xtd_readmore', 'plugin', 'readmore', 'editors-xtd', 0, 1, 1, 0, '{"legacy":false,"name":"plg_editors-xtd_readmore","type":"plugin","creationDate":"March 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_READMORE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(417, 'plg_search_categories', 'plugin', 'categories', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"plg_search_categories","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_SEARCH_CATEGORIES_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(418, 'plg_search_contacts', 'plugin', 'contacts', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"plg_search_contacts","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_SEARCH_CONTACTS_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(419, 'plg_search_content', 'plugin', 'content', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"plg_search_content","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_SEARCH_CONTENT_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(420, 'plg_search_newsfeeds', 'plugin', 'newsfeeds', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"plg_search_newsfeeds","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_SEARCH_NEWSFEEDS_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(421, 'plg_search_weblinks', 'plugin', 'weblinks', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"plg_search_weblinks","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_SEARCH_WEBLINKS_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(422, 'plg_system_languagefilter', 'plugin', 'languagefilter', 'system', 0, 1, 1, 1, '{"legacy":false,"name":"plg_system_languagefilter","type":"plugin","creationDate":"July 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_SYSTEM_LANGUAGEFILTER_XML_DESCRIPTION","group":""}', '{"detect_browser":"0","automatic_change":"1","menu_associations":"1"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(423, 'plg_system_p3p', 'plugin', 'p3p', 'system', 0, 1, 1, 1, '{"legacy":false,"name":"plg_system_p3p","type":"plugin","creationDate":"September 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_P3P_XML_DESCRIPTION","group":""}', '{"headers":"NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM"}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(424, 'plg_system_cache', 'plugin', 'cache', 'system', 0, 0, 1, 1, '{"legacy":false,"name":"plg_system_cache","type":"plugin","creationDate":"February 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_CACHE_XML_DESCRIPTION","group":""}', '{"browsercache":"0","cachetime":"15"}', '', '', 0, '0000-00-00 00:00:00', 9, 0),
(425, 'plg_system_debug', 'plugin', 'debug', 'system', 0, 1, 1, 0, '{"legacy":false,"name":"plg_system_debug","type":"plugin","creationDate":"December 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_DEBUG_XML_DESCRIPTION","group":""}', '{"profile":"1","queries":"1","memory":"1","language_files":"1","language_strings":"1","strip-first":"1","strip-prefix":"","strip-suffix":""}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(426, 'plg_system_log', 'plugin', 'log', 'system', 0, 1, 1, 1, '{"legacy":false,"name":"plg_system_log","type":"plugin","creationDate":"April 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_LOG_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(427, 'plg_system_redirect', 'plugin', 'redirect', 'system', 0, 1, 1, 1, '{"legacy":false,"name":"plg_system_redirect","type":"plugin","creationDate":"April 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_REDIRECT_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 6, 0),
(428, 'plg_system_remember', 'plugin', 'remember', 'system', 0, 1, 1, 1, '{"legacy":false,"name":"plg_system_remember","type":"plugin","creationDate":"April 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_REMEMBER_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 7, 0),
(429, 'plg_system_sef', 'plugin', 'sef', 'system', 0, 1, 1, 0, '{"legacy":false,"name":"plg_system_sef","type":"plugin","creationDate":"December 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_SEF_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 8, 0),
(430, 'plg_system_logout', 'plugin', 'logout', 'system', 0, 1, 1, 1, '{"legacy":false,"name":"plg_system_logout","type":"plugin","creationDate":"April 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_SYSTEM_LOGOUT_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(431, 'plg_user_contactcreator', 'plugin', 'contactcreator', 'user', 0, 0, 1, 1, '{"legacy":false,"name":"plg_user_contactcreator","type":"plugin","creationDate":"August 2009","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_CONTACTCREATOR_XML_DESCRIPTION","group":""}', '{"autowebpage":"","category":"34","autopublish":"0"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(432, 'plg_user_joomla', 'plugin', 'joomla', 'user', 0, 1, 1, 0, '{"legacy":false,"name":"plg_user_joomla","type":"plugin","creationDate":"December 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2009 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_USER_JOOMLA_XML_DESCRIPTION","group":""}', '{"autoregister":"1"}', '', '', 0, '0000-00-00 00:00:00', 2, 0);
INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(433, 'plg_user_profile', 'plugin', 'profile', 'user', 0, 0, 1, 1, '{"legacy":false,"name":"plg_user_profile","type":"plugin","creationDate":"January 2008","author":"Joomla! Project","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_USER_PROFILE_XML_DESCRIPTION","group":""}', '{"register-require_address1":"1","register-require_address2":"1","register-require_city":"1","register-require_region":"1","register-require_country":"1","register-require_postal_code":"1","register-require_phone":"1","register-require_website":"1","register-require_favoritebook":"1","register-require_aboutme":"1","register-require_tos":"1","register-require_dob":"1","profile-require_address1":"1","profile-require_address2":"1","profile-require_city":"1","profile-require_region":"1","profile-require_country":"1","profile-require_postal_code":"1","profile-require_phone":"1","profile-require_website":"1","profile-require_favoritebook":"1","profile-require_aboutme":"1","profile-require_tos":"1","profile-require_dob":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(434, 'plg_extension_joomla', 'plugin', 'joomla', 'extension', 0, 1, 1, 1, '{"legacy":false,"name":"plg_extension_joomla","type":"plugin","creationDate":"May 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_EXTENSION_JOOMLA_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(435, 'plg_content_joomla', 'plugin', 'joomla', 'content', 0, 1, 1, 0, '{"legacy":false,"name":"plg_content_joomla","type":"plugin","creationDate":"November 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"PLG_CONTENT_JOOMLA_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(500, 'atomic', 'template', 'atomic', '', 0, 1, 1, 0, '{"legacy":false,"name":"atomic","type":"template","creationDate":"10\\/10\\/09","author":"Ron Severdia","copyright":"Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.","authorEmail":"contact@kontentdesign.com","authorUrl":"http:\\/\\/www.kontentdesign.com","version":"1.7.0","description":"TPL_ATOMIC_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(502, 'bluestork', 'template', 'bluestork', '', 1, 1, 1, 0, '{"legacy":false,"name":"bluestork","type":"template","creationDate":"07\\/02\\/09","author":"Ron Severdia","copyright":"Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.","authorEmail":"contact@kontentdesign.com","authorUrl":"http:\\/\\/www.kontentdesign.com","version":"1.7.0","description":"TPL_BLUESTORK_XML_DESCRIPTION","group":""}', '{"useRoundedCorners":"1","showSiteName":"0","textBig":"0","highContrast":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(503, 'beez_20', 'template', 'beez_20', '', 0, 1, 1, 0, '{"legacy":false,"name":"beez_20","type":"template","creationDate":"25 November 2009","author":"Angie Radtke","copyright":"Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.","authorEmail":"a.radtke@derauftritt.de","authorUrl":"http:\\/\\/www.der-auftritt.de","version":"1.7.0","description":"TPL_BEEZ2_XML_DESCRIPTION","group":""}', '{"wrapperSmall":"53","wrapperLarge":"72","sitetitle":"","sitedescription":"","navposition":"center","templatecolor":"nature"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(504, 'hathor', 'template', 'hathor', '', 1, 1, 1, 0, '{"legacy":false,"name":"hathor","type":"template","creationDate":"May 2010","author":"Andrea Tarr","copyright":"Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.","authorEmail":"hathor@tarrconsulting.com","authorUrl":"http:\\/\\/www.tarrconsulting.com","version":"1.7.0","description":"TPL_HATHOR_XML_DESCRIPTION","group":""}', '{"showSiteName":"0","colourChoice":"0","boldText":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(505, 'beez5', 'template', 'beez5', '', 0, 1, 1, 0, '{"legacy":false,"name":"beez5","type":"template","creationDate":"21 May 2010","author":"Angie Radtke","copyright":"Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.","authorEmail":"a.radtke@derauftritt.de","authorUrl":"http:\\/\\/www.der-auftritt.de","version":"1.7.0","description":"TPL_BEEZ5_XML_DESCRIPTION","group":""}', '{"wrapperSmall":"53","wrapperLarge":"72","sitetitle":"","sitedescription":"","navposition":"center","html5":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(600, 'English (United Kingdom)', 'language', 'en-GB', '', 0, 1, 1, 1, '{"legacy":false,"name":"English (United Kingdom)","type":"language","creationDate":"2008-03-15","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"en-GB site language","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(601, 'English (United Kingdom)', 'language', 'en-GB', '', 1, 1, 1, 1, '{"legacy":false,"name":"English (United Kingdom)","type":"language","creationDate":"2008-03-15","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"en-GB administrator language","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(700, 'files_joomla', 'file', 'joomla', '', 0, 1, 1, 1, '{"legacy":false,"name":"files_joomla","type":"file","creationDate":"July 2011","author":"Joomla!","copyright":"(C) 2005 - 2011 Open Source Matters. All rights reserved","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"1.7.0","description":"FILES_JOOMLA_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(800, 'Joomla! Content Management System', 'package', 'pkg_joomla', '', 0, 1, 1, 1, '{"legacy":false,"name":"Joomla! Content Management System","type":"package","creationDate":"2006","author":"Joomla!","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"http:\\/\\/www.joomla.org","version":"1.7.0","description":"The Joomla! Content Management System is one of the most popular content management system''s available today.","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10000, 'it_theshop', 'template', 'it_theshop', '', 0, 1, 1, 0, '{"legacy":false,"name":"it_theshop","type":"template","creationDate":"01 August 2011","author":"IceTheme","copyright":"Copyright (C) 2008 - 2011 IceTheme.com","authorEmail":"info@icetheme.com","authorUrl":"http:\\/\\/www.icetheme.com","version":"1.7.0","description":"\\n\\t\\n\\t\\t<h2>IT TheShop - August 2011 Premium Joomla Template By IceTheme.com<\\/h2>NOTE: This Joomla Template it is not free or public. This Joomla Template is for members of the IceTheme club only.<br\\/><br\\/><a href=\\"http:\\/\\/www.icetheme.com\\" target=\\"_blank\\" >Visit IceTheme<\\/a><br\\/><a href=\\"http:\\/\\/www.icetheme.com\\/Forums\\/\\" target=\\"_blank\\">Get Support<\\/a><br\\/><a href=\\"http:\\/\\/www.icetheme.com\\/Legal\\/terms-of-use.html\\" target=\\"_blank\\">Terms of Use<\\/a><br\\/>\\n\\t\\t\\n\\t","group":""}', '{"TemplateStyle":"style1","layout_leftcol_width":"240","layout_rightcol_width":"240","go2top":"1","icelogo":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10001, 'IceMegaMenu Plugin', 'plugin', 'icemegamenu', 'system', 0, 1, 1, 0, '{"legacy":false,"name":"IceMegaMenu Plugin","type":"plugin","creationDate":"Mrch 2011","author":"www.icetheme.com","copyright":"Copyright (C) Copyright  2008 - 2011 IceTheme.com. All rights reserved.","authorEmail":"info@icethemes.com","authorUrl":"http:\\/\\/www.icethemes.com","version":"1.6.0","description":"IceMegaMenu plugin used in conjuction with the IceMegaMenu Module. You may change the paramters to each menu item throught the Menu Manager","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10002, 'IceMegaMenu Module', 'module', 'mod_icemegamenu', '', 0, 1, 0, 0, '{"legacy":false,"name":"IceMegaMenu Module","type":"module","creationDate":"March 2011","author":"IceTheme","copyright":"GNU \\/ GPL","authorEmail":"info@icetheme.com","authorUrl":"http:\\/\\/www.icetheme.com","version":"1.6.0","description":"IceMegaMenu extension is a powerful Joomla (module + plugin) to help you take the most from the navigation system. Top features includes ability to split dropdown columns, option to load modules inside the dropdown, works without JavaScript and much more.","group":""}', '{"theme_style":"","startLevel":"1","endLevel":"0","showAllChildren":"1","class_sfx":"","window_open":"","tag_id":"","js_effect":"slide & fade","js_physics":"Fx.Transitions.Pow.easeOut","js_duration":"600","js_hideDelay":"1000","js_opacity":"95","use_js":"1","moduleclass_sfx":"","cache":"1","cache_time":"30","menu_images":"0","menu_images_align":"0","menu_images_link":"0","expand_menu":"0","activate_parent":"0","full_active_id":"0","@spacer":"","indent_image":"0","indent_image1":"","indent_image2":"","indent_image3":"","indent_image4":"","indent_image5":"","indent_image6":"","spacer":"","end_spacer":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10003, 'IceTabs Module', 'module', 'mod_icetabs', '', 0, 1, 0, 0, '{"legacy":false,"name":"IceTabs Module","type":"module","creationDate":"November 2010","author":"IceTheme","copyright":"GNU \\/ GPL","authorEmail":"info@icetheme.com","authorUrl":"http:\\/\\/www.icetheme.com","version":"1.6.1","description":"\\n\\t\\t\\n\\t\\t<h2>IceTabs Module<\\/h2>IceTabs module can display any content\\/banner\\/images\\/K2\\/VirtueMart information with a smooth and nice interface based on a tabular interface.<br><br><ul><li><a href=\\"http:\\/\\/icetheme.com\\/Joomla-Extensions\\/icetabs.html\\">IceTabs Page<\\/a><\\/li><li><a target=\\"_blank\\" href=\\"http:\\/\\/icetheme.com\\/Forums\\/IceTabs\\/\\">Get Support<\\/a><\\/li><\\/ul><\\/li><\\/ul> <script type=\\"text\\/javascript\\" src=\\"..\\/modules\\/mod_icetabs\\/assets\\/form.js\\"><\\/script> <style>.lof-group{ padding:2px;color:#666;background:#CCC;cursor:hand; font-weight:bold; cursor:pointer}<\\/style>\\n\\t\\t\\n\\t","group":""}', '{"theme":"default-white","module_width":"auto","module_height":"auto","main_width":"600","main_height":"300","imagemain_width":"160","imagemain_height":"220","limit_items":"5","display_button":"1","show_readmore":"1","auto_strip_tags":"0","description_max_chars":"100","group":"content","source":"content_category","article_ids":"","content_category":"","ordering":"created_asc","image_folder":"images\\/sampledata\\/fruitshop","image_category":"","image_ordering":"","k2_source":"k2_category","k2_items_ids":"","k2_category":"","featured_items_show":"1","k2_ordering":"created_asc","clientids":"","banner_category":"","banner_ordering":"ordering_desc","vm_source":"vm_category","vm_items_ids":"","vm_category":"","vm_ordering":"ordering_desc","navigator_pos":"right","navitem_width":"290","navitem_height":"100","max_items_display":"3","auto_renderthumb":"1","image_quanlity":"100","thumbnail_width":"60","thumbnail_height":"60","title_max_chars":"100","layout_style":"vrdown","interval":"2000","duration":"700","effect":"Fx.Transitions.Sine.easeInOut","auto_start":"1","cache":"1","cache_time":"900","cachemode":"static"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10004, 'jshopping', 'component', 'com_jshopping', '', 1, 1, 0, 0, '{"legacy":false,"name":"jshopping","type":"component","creationDate":"22.07.2011","author":"MAXXmarketing GmbH","copyright":"","authorEmail":"marketing@maxx-marketing.net","authorUrl":"http:\\/\\/www.webdesigner-profi.de","version":"3.2.3","description":"Joomshopping - shop component. Note: JoomShopping code files are named as jshopping","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10006, 'NederlandsNL', 'language', 'nl-NL', '', 0, 1, 0, 0, '{"legacy":false,"name":"Nederlands (NL)","type":"language","creationDate":"2011-07-18","author":"Dutch Translation Team","copyright":"Copyright (C) 2005 - 2011 Dutch Translation Team en Open Source Matters. All rights reserved.","authorEmail":"taal@joomlacommunity.eu","authorUrl":"http:\\/\\/joomlacode.org\\/gf\\/project\\/nederlands\\/","version":"1.7.0","description":"Nederlands taalbestand Joomla! 1.7.0 (site)","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10007, 'NederlandsNL', 'language', 'nl-NL', '', 1, 1, 0, 0, '{"legacy":false,"name":"Nederlands (NL)","type":"language","creationDate":"2011-07-18","author":"Dutch Translation Team","copyright":"Copyright (C) 2005 - 2011 Dutch Translation Team en Open Source Matters. All rights reserved.","authorEmail":"taal@joomlacommunity.eu","authorUrl":"http:\\/\\/joomlacode.org\\/gf\\/project\\/nederlands\\/","version":"1.7.0","description":"Nederlands taalbestand Joomla! 1.7.0 (beheergedeelte)","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10008, 'nl-NL', 'package', 'pkg_nl-NL', '', 0, 1, 1, 0, '{"legacy":false,"name":"Dutch Language Pack","type":"package","creationDate":"Unknown","author":"Unknown","copyright":"","authorEmail":"","authorUrl":"","version":"1.7","description":"1.7 Joomla Dutch Language Package","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10009, 'Russian', 'language', 'ru-RU', '', 0, 1, 0, 0, '{"legacy":true,"name":"Russian","type":"language","creationDate":"2011-07-28","author":"Russian Translation Team","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved","authorEmail":"smart@joomlaportal.ru","authorUrl":"www.joomlaportal.ru","version":"1.7.0","description":"Russian language pack (site) for Joomla! 1.6","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10010, 'Russian', 'language', 'ru-RU', '', 1, 1, 0, 0, '{"legacy":true,"name":"Russian","type":"language","creationDate":"2011-07-28","author":"Russian Translation Team","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved","authorEmail":"smart@joomlaportal.ru","authorUrl":"www.joomlaportal.ru","version":"1.7.0","description":"Russian language pack (administrator) for Joomla! 1.6","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10011, 'ru-RU', 'package', 'pkg_ru-RU', '', 0, 1, 1, 0, '{"legacy":false,"name":"Russian Language Pack","type":"package","creationDate":"Unknown","author":"Unknown","copyright":"","authorEmail":"","authorUrl":"","version":"1.6","description":"Joomla 1.6 Russian Language Package","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10012, 'SvenskaSE', 'language', 'sv-SE', '', 0, 1, 0, 0, '{"legacy":false,"name":"Svenska (SE)","type":"language","creationDate":"2011-07-13","author":"Swedish Translation Team - SvenskJoomla!","copyright":"Copyright (C) 2005 - 2011 SvenskJoomla! och Open Source Matters. All rights reserved.","authorEmail":"info@svenskjoomla.se","authorUrl":"www.svenskjoomla.se","version":"1.7.0","description":"Svensk \\u00f6vers\\u00e4ttning f\\u00f6r Joomla! 1.7.0 Site<br \\/>\\u00d6versatt av SvenskJoomla<br \\/><br \\/>Du hittar fler svenska \\u00f6vers\\u00e4ttningar p\\u00e5 <a target=\\"_blank\\" href=\\"http:\\/\\/www.svenskjoomla.se\\">http:\\/\\/www.svenskjoomla.se<\\/a>","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10013, 'SvenskaSE', 'language', 'sv-SE', '', 1, 1, 0, 0, '{"legacy":false,"name":"Svenska (SE)","type":"language","creationDate":"2011-07-13","author":"Swedish Translation Team - SvenskJoomla!","copyright":"Copyright (C) 2005 - 2011 SvenskJoomla! och Open Source Matters. All rights reserved.","authorEmail":"info@svenskjoomla.se","authorUrl":"www.svenskjoomla.se","version":"1.7.0","description":"Svensk \\u00f6vers\\u00e4ttning f\\u00f6r Joomla! 1.7.0 Admin<br \\/>\\u00d6versatt av SvenskJoomla<br \\/><br \\/>Du hittar fler svenska \\u00f6vers\\u00e4ttningar p\\u00e5 <a target=\\"_blank\\" href=\\"http:\\/\\/www.svenskjoomla.se\\">http:\\/\\/www.svenskjoomla.se<\\/a>","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10014, 'sv-SE', 'package', 'pkg_sv-SE', '', 0, 1, 1, 0, '{"legacy":false,"name":"Swedish Language Pack","type":"package","creationDate":"Unknown","author":"Unknown","copyright":"","authorEmail":"","authorUrl":"","version":"1.7.0","description":"Svensk \\u00f6vers\\u00e4ttning f\\u00f6r Joomla! 1.7.0<br \\/>\\u00d6versatt av SvenskJoomla<br \\/><br \\/>Du hittar fler svenska \\u00f6vers\\u00e4ttningar p\\u00e5 <a target=\\"_blank\\" href=\\"http:\\/\\/www.svenskjoomla.se\\">http:\\/\\/www.svenskjoomla.se<\\/a>","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10015, 'GermanDE-CH-AT', 'language', 'de-DE', '', 0, 1, 0, 0, '{"legacy":false,"name":"German (DE-CH-AT)","type":"language","creationDate":"19.07.2011","author":"J!German","copyright":"Copyright (C) 2008 - 2011 J!German. All rights reserved.","authorEmail":"team@jgerman.de","authorUrl":"www.jgerman.de","version":"1.7.0v1","description":"\\n    <div align=\\"center\\">\\n      <table border=\\"0\\" width=\\"90%\\">\\n  \\t    <tr>\\n  \\t\\t    <td width=\\"100%\\" colspan=\\"2\\">\\n  \\t\\t      <div align=\\"center\\">\\n  \\t\\t        <h3>Deutsche \\u00dcbersetzung f\\u00fcr Joomla! 1.7 von J!German<\\/h3>\\n  \\t\\t      <\\/div>\\n  \\t\\t      <hr \\/>\\n  \\t\\t    <\\/td>\\n  \\t    <\\/tr>\\n  \\t    <tr>\\n  \\t\\t    <td width=\\"20%\\"><u><strong>Bereich:<\\/strong><\\/u><\\/td>\\n  \\t\\t    <td width=\\"80%\\">Website (Frontend)<\\/td>\\n  \\t    <\\/tr>\\n  \\t    <tr>\\n  \\t\\t    <td width=\\"20%\\"><u><strong>Joomla!-Version:<\\/strong><\\/u><\\/td>\\n  \\t\\t    <td width=\\"80%\\">1.7.0<\\/td>\\n  \\t    <\\/tr>\\n  \\t    <tr>\\n  \\t\\t    <td width=\\"20%\\"><u><strong>&Uuml;bersetzungsversion:<\\/strong><\\/u><\\/td>\\n  \\t\\t    <td width=\\"80%\\">1.7.0v1<\\/td>\\n  \\t    <\\/tr>\\n  \\t    <td width=\\"100%\\" colspan=\\"2\\"><hr \\/><\\/td>\\n  \\t    <tr>\\n  \\t\\t    <td width=\\"20%\\"><u><strong>J!German-Website:<\\/strong><\\/u><\\/td>\\n  \\t\\t    <td width=\\"80%\\"><a href=\\"http:\\/\\/www.jgerman.de\\" target=\\"_blank\\">http:\\/\\/www.jgerman.de<\\/a><\\/td>\\n  \\t    <\\/tr>\\n  \\t    <tr>\\n  \\t\\t    <td width=\\"100%\\" colspan=\\"2\\">\\n  \\t\\t      <strong><font color=\\"#008000\\">Bitte \\u00fcberpr\\u00fcfen Sie regelm\\u00e4\\u00dfig unsere Projektseite, ob Sie noch die aktuelle \\u00dcbersetzungsversion einsetzen.<\\/font><\\/strong>\\n          <\\/td>\\n  \\t    <\\/tr>\\n      <\\/table>\\n    <\\/div>","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10016, 'site_de-DE', 'package', 'pkg_site_de-DE', '', 0, 1, 1, 0, '{"legacy":false,"name":"German Site Language Pack","type":"package","creationDate":"Unknown","author":"Unknown","copyright":"","authorEmail":"","authorUrl":"","version":"1.7.0v1","description":"\\n    <div align=\\"center\\">\\n      <table border=\\"0\\" width=\\"90%\\">\\n  \\t    <tr>\\n  \\t\\t    <td width=\\"100%\\" colspan=\\"2\\">\\n  \\t\\t      <div align=\\"center\\">\\n  \\t\\t        <h3>Deutsche \\u00dcbersetzung f\\u00fcr Joomla! 1.7 von J!German<\\/h3>\\n  \\t\\t      <\\/div>\\n  \\t\\t      <hr \\/>\\n  \\t\\t    <\\/td>\\n  \\t    <\\/tr>\\n  \\t    <tr>\\n  \\t\\t    <td width=\\"20%\\"><u><strong>Bereich:<\\/strong><\\/u><\\/td>\\n  \\t\\t    <td width=\\"80%\\">Website (Frontend)<\\/td>\\n  \\t    <\\/tr>\\n  \\t    <tr>\\n  \\t\\t    <td width=\\"20%\\"><u><strong>Joomla!-Version:<\\/strong><\\/u><\\/td>\\n  \\t\\t    <td width=\\"80%\\">1.7.0<\\/td>\\n  \\t    <\\/tr>\\n  \\t    <tr>\\n  \\t\\t    <td width=\\"20%\\"><u><strong>&Uuml;bersetzungsversion:<\\/strong><\\/u><\\/td>\\n  \\t\\t    <td width=\\"80%\\">1.7.0v1<\\/td>\\n  \\t    <\\/tr>\\n  \\t    <td width=\\"100%\\" colspan=\\"2\\"><hr \\/><\\/td>\\n  \\t    <tr>\\n  \\t\\t    <td width=\\"20%\\"><u><strong>J!German-Website:<\\/strong><\\/u><\\/td>\\n  \\t\\t    <td width=\\"80%\\"><a href=\\"http:\\/\\/www.jgerman.de\\" target=\\"_blank\\">http:\\/\\/www.jgerman.de<\\/a><\\/td>\\n  \\t    <\\/tr>\\n  \\t    <tr>\\n  \\t\\t    <td width=\\"100%\\" colspan=\\"2\\">\\n  \\t\\t      <strong><font color=\\"#008000\\">Bitte \\u00fcberpr\\u00fcfen Sie regelm\\u00e4\\u00dfig unsere Projektseite, ob Sie noch die aktuelle \\u00dcbersetzungsversion einsetzen.<\\/font><\\/strong>\\n          <\\/td>\\n  \\t    <\\/tr>\\n      <\\/table>\\n    <\\/div>","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10020, 'IceAccordion Module', 'module', 'mod_ice_accordion', '', 0, 1, 0, 0, '{"legacy":false,"name":"IceAccordion Module","type":"module","creationDate":"November 2010","author":"IceTheme","copyright":"GNU \\/ GPL","authorEmail":"info@icetheme.com","authorUrl":"http:\\/\\/www.icetheme.com","version":"1.6.1","description":"\\n\\t\\n\\t <a target=\\"_blank\\" href=\\"icetheme.com\\"><b>IceAccordion  Module<\\/b><\\/a> <\\/br><br>IceAccordion Module can display a set of articles in a small area on your website in an accordion way. This Module is released under the GPL license.<br><br><ul><li><a href=\\"http:\\/\\/icetheme.com\\/Joomla-Extensions\\/iceaccordion.html\\">IceAccordion Page<\\/a><\\/li><li><a target=\\"_blank\\" href=\\"http:\\/\\/icetheme.com\\/Forums\\">Discussion<\\/a><\\/li><\\/ul><\\/li><\\/ul> <script type=\\"text\\/javascript\\" src=\\"..\\/modules\\/mod_ice_accordion\\/assets\\/form.js\\"><\\/script> <style>.lof-group{ padding:2px;color:#666;background:#CCC;cursor:hand; font-weight:bold; cursor:pointer}<\\/style>\\n\\t\\n\\t","group":""}', '{"theme":"","auto_renderthumb":"1","image_quanlity":"100","main_width":"160","main_height":"120","":"","data_source":"content","source":"content_category","article_ids":"","content_category":"","content_featured_items_show":"1","ordering":"ordering","order_direction":"ASC","default_item":"0","source_from":"cat_ids","filtering_type":"1","sort_product":"","preview_width":"200","preview_height":"200","show_preview":"1","show_product_image":"1","show_image_label":"1","show_rating":"1","show_description":"1","show_old_price":"1","show_price":"1","limit_items":"5","number_page":"0","title_max_chars":"100","description_max_chars":"100","show_readmore":"1","moduleclass_sfx":"","enable_cache":"0","cache_time":"15"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10021, 'System - Ice Speed', 'plugin', 'ice_speed', 'system', 0, 0, 1, 0, '{"legacy":true,"name":"System - Ice Speed","type":"plugin","creationDate":"May 2010","author":"IceTheme","copyright":"Copyright (C) 2010 IceTheme","authorEmail":"info@icetheme.com","authorUrl":"http:\\/\\/www.icetheme.com","version":"1.0.0","description":"\\n\\t\\n\\t\\tIceSpeed Plugin decrease the loading time of your website by compressing, optimizing, merging CSS and JavaScript on your website.\\n\\t\\n","group":""}', '{"optimize_engine":"minify","optimize_html":"0","optimize_css":"compress_merge","optimize_js":"compress_merge","order_jsfiles":"","enable_gzip":"1","lazy_load":"0","enable_cache":"0","cachetime":"15","menu":[""],"button_clearcache":"allow_admin","token":"ice"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10028, 'Jshopping Search', 'module', 'mod_ice_jshopping_search', '', 0, 1, 1, 0, '{"legacy":false,"name":"Jshopping Search","type":"module","creationDate":"18.04.2011","author":"IceTheme","copyright":"","authorEmail":"info@icetheme.com","authorUrl":"http:\\/\\/www.icetheme.com","version":"1.7.0","description":"Modified JoomShopping Search module by adding the possibility to search within categories","group":""}', '{"advanced_search":"1","category_id":"","enable_categories":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10033, 'Ice Jshopping Cart', 'module', 'mod_ice_jshopping_cart', '', 0, 1, 1, 0, '{"legacy":false,"name":"Ice Jshopping Cart","type":"module","creationDate":"01 August 2011","author":"IceTheme","copyright":"","authorEmail":"info@icetheme.com","authorUrl":"http:\\/\\/www.icetheme.com","version":"1.7.0","description":"Enhanced JoomShooping Cart Module by IceTheme. Now you can use Ajax technology to add your products to the cart and as well view your added products with a nice dropdown.","group":""}', '{"ajax":"1","dropdown":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10032, 'mod_ice_accordion - Copy', 'module', 'mod_ice_accordion - Copy', '', 0, 1, 1, 0, 'false', '', '', '', 0, '0000-00-00 00:00:00', 0, -1),
(10034, 'Ice Jshopping Categories', 'module', 'mod_ice_jshopping_categories', '', 0, 1, 1, 0, '{"legacy":false,"name":"Ice Jshopping Categories","type":"module","creationDate":"01 August 2011","author":"IceTheme","copyright":"","authorEmail":"info@icetheme.com","authorUrl":"http:\\/\\/www.icetheme.com","version":"1.7.0","description":"Enhanced JoomShooping Categories Module with dropdown. As well you can show small icons of your shop categories.","group":""}', '{"show_image":"0","image_width":"20","image_heigth":"20","sort":"id","ordering":"asc","showcounter":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10036, 'mod_languages__', 'module', 'mod_languages__', '', 0, 1, 1, 0, 'false', '', '', '', 0, '0000-00-00 00:00:00', 0, -1),
(10037, 'IceCarousel Module', 'module', 'mod_ice_carousel', '', 0, 1, 0, 0, '{"legacy":false,"name":"IceCarousel Module","type":"module","creationDate":"August 2011","author":"IceTheme","copyright":"GNU \\/ GPL","authorEmail":"info@icetheme.com","authorUrl":"http:\\/\\/www.icetheme.com","version":"1.7.0","description":"\\n\\t\\n\\t <a target=\\"_blank\\" href=\\"icetheme.com\\"><b>IceCarousel Module<\\/b><\\/a> <\\/br><br>IceCarousel is a very powerful Joomla module with a large set of useful parameters to filter and order your Joomla Articles.<br><br>Also the module support JoomShopping Extensions to display the products<br><br>\\n\\t <ul><li><a href=\\"http:\\/\\/icetheme.com\\/Joomla-Extensions\\/icecarousel.html\\">IceCarousel Page<\\/a><\\/li><li><a target=\\"_blank\\" href=\\"http:\\/\\/icetheme.com\\/Forums\\">Discussion<\\/a><\\/li><\\/ul><\\/li><\\/ul> <script type=\\"text\\/javascript\\" src=\\"..\\/modules\\/mod_ice_carousel\\/assets\\/form.js\\"><\\/script> <style>.lof-group{ padding:2px;color:#666;background:#CCC;cursor:hand; font-weight:bold; cursor:pointer}<\\/style>\\n\\t\\n\\t","group":""}', '{"theme":"","":"","module_width":"725","module_height":"360","main_width":"160","main_height":"100","auto_renderthumb":"1","image_quanlity":"75","data_source":"content","show_front":"show","category_filtering_type":"1","show_child_category_articles":"0","levels":"1","author_filtering_type":"1","author_alias_filtering_type":"1","date_filtering":"off","date_field":"a.created","relative_date":"30","article_ordering":"a.title","article_ordering_direction":"ASC","item_heading":"3","link_titles":"1","show_date":"1","show_date_field":"created","show_date_format":"Y-m-d H:i:s","show_category":"1","show_hits":"1","show_author":"1","show_introtext":"1","show_readmore":"1","show_readmore_title":"0","readmore_limit":"15","source_from":"cat_ids","filtering_type":"1","sort_product":"","preview_width":"200","preview_height":"200","show_preview":"1","show_product_image":"1","show_image_label":"1","show_rating":"1","show_description":"1","show_old_price":"1","show_price":"1","limit_items":"12","max_items_per_page":"4","interval":"5000","duration":"500","transition":"Fx.Transitions.Quad.easeInOut","navigator_pos":"bottom","auto_start":"0","title_max_chars":"40","description_max_chars":"80","moduleclass_sfx":"","enable_ajax":"1","enable_cache":"0","cache_time":"15"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10038, 'Iyosis Facebook Module', 'module', 'mod_iyosis_facebook', '', 0, 1, 0, 0, '{"legacy":true,"name":"Iyosis Facebook Module","type":"module","creationDate":"2 February 2011","author":"Remzi Degirmencioglu","copyright":"Iyosis.com","authorEmail":"remzi@degirmencioglu.eu","authorUrl":"http:\\/\\/www.iyosis.com","version":"1.1","description":"Iyosis Facebook Module. Module that displays Facebook Like Button, Like Box, Activity Feed or Recommendations on your Joomla site.","group":""}', '{"moduleclass_sfx":"","plugin":"LikeBox","URLLikeButton":"http:\\/\\/www.facebook.com\\/joomla","codeTypeLikeButton":"iframe","widthLikeButton":"180","heightLikeButton":"30","colorSchemeLikeButton":"light","showFacesLikeButton":"1","layoutLikeButton":"1","URLLikeBox":"http:\\/\\/www.facebook.com\\/joomla","codeTypeLikeBox":"iframe","widthLikeBox":"250","heightLikeBox":"600","colorSchemeLikeBox":"light","showFacesLikeBox":"1","showStreamLikeBox":"1","showHeaderLikeBox":"1","domainActivityFeed":"joomla.org","codeTypeActivityFeed":"iframe","widthActivityFeed":"250","heightActivityFeed":"600","colorSchemeActivityFeed":"light","showHeaderActivityFeed":"1","domainRecommendations":"joomla.org","codeTypeRecommendations":"iframe","widthRecommendations":"250","heightRecommendations":"600","colorSchemeRecommendations":"light","showHeaderRecommendations":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10039, 'Jshopping Filters', 'module', 'mod_jshopping_filters', '', 0, 1, 0, 0, '{"legacy":false,"name":"Jshopping Filters","type":"module","creationDate":"25.01.2011","author":"MAXXmarketing GmbH","copyright":"","authorEmail":"marketing@maxx-marketing.net","authorUrl":"http:\\/\\/www.webdesigner-profi.de","version":"3.0.1","description":"Displays filters of shop.","group":""}', '{"show_manufacturers":"1","show_categorys":"1","show_prices":"1","show_characteristics":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10040, 'GermanDE-CH-AT', 'language', 'de-DE', '', 0, 1, 0, 0, '{"legacy":false,"name":"German (DE-CH-AT)","type":"language","creationDate":"19.07.2011","author":"J!German","copyright":"Copyright (C) 2008 - 2011 J!German. All rights reserved.","authorEmail":"team@jgerman.de","authorUrl":"www.jgerman.de","version":"1.7.0v1","description":"\\n    <div align=\\"center\\">\\n      <table border=\\"0\\" width=\\"90%\\">\\n  \\t    <tr>\\n  \\t\\t    <td width=\\"100%\\" colspan=\\"2\\">\\n  \\t\\t      <div align=\\"center\\">\\n  \\t\\t        <h3>Deutsche \\u00dcbersetzung f\\u00fcr Joomla! 1.7 von J!German<\\/h3>\\n  \\t\\t      <\\/div>\\n  \\t\\t      <hr \\/>\\n  \\t\\t    <\\/td>\\n  \\t    <\\/tr>\\n  \\t    <tr>\\n  \\t\\t    <td width=\\"20%\\"><u><strong>Bereich:<\\/strong><\\/u><\\/td>\\n  \\t\\t    <td width=\\"80%\\">Website (Frontend)<\\/td>\\n  \\t    <\\/tr>\\n  \\t    <tr>\\n  \\t\\t    <td width=\\"20%\\"><u><strong>Joomla!-Version:<\\/strong><\\/u><\\/td>\\n  \\t\\t    <td width=\\"80%\\">1.7.0<\\/td>\\n  \\t    <\\/tr>\\n  \\t    <tr>\\n  \\t\\t    <td width=\\"20%\\"><u><strong>&Uuml;bersetzungsversion:<\\/strong><\\/u><\\/td>\\n  \\t\\t    <td width=\\"80%\\">1.7.0v1<\\/td>\\n  \\t    <\\/tr>\\n  \\t    <td width=\\"100%\\" colspan=\\"2\\"><hr \\/><\\/td>\\n  \\t    <tr>\\n  \\t\\t    <td width=\\"20%\\"><u><strong>J!German-Website:<\\/strong><\\/u><\\/td>\\n  \\t\\t    <td width=\\"80%\\"><a href=\\"http:\\/\\/www.jgerman.de\\" target=\\"_blank\\">http:\\/\\/www.jgerman.de<\\/a><\\/td>\\n  \\t    <\\/tr>\\n  \\t    <tr>\\n  \\t\\t    <td width=\\"100%\\" colspan=\\"2\\">\\n  \\t\\t      <strong><font color=\\"#008000\\">Bitte \\u00fcberpr\\u00fcfen Sie regelm\\u00e4\\u00dfig unsere Projektseite, ob Sie noch die aktuelle \\u00dcbersetzungsversion einsetzen.<\\/font><\\/strong>\\n          <\\/td>\\n  \\t    <\\/tr>\\n      <\\/table>\\n    <\\/div>","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10041, 'NederlandsNL', 'language', 'nl-NL', '', 0, 1, 0, 0, '{"legacy":false,"name":"Nederlands (NL)","type":"language","creationDate":"2011-07-18","author":"Dutch Translation Team","copyright":"Copyright (C) 2005 - 2011 Dutch Translation Team en Open Source Matters. All rights reserved.","authorEmail":"taal@joomlacommunity.eu","authorUrl":"http:\\/\\/joomlacode.org\\/gf\\/project\\/nederlands\\/","version":"1.7.0","description":"Nederlands taalbestand Joomla! 1.7.0 (site)","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10042, 'NederlandsNL', 'language', 'nl-NL', '', 1, 1, 0, 0, '{"legacy":false,"name":"Nederlands (NL)","type":"language","creationDate":"2011-07-18","author":"Dutch Translation Team","copyright":"Copyright (C) 2005 - 2011 Dutch Translation Team en Open Source Matters. All rights reserved.","authorEmail":"taal@joomlacommunity.eu","authorUrl":"http:\\/\\/joomlacode.org\\/gf\\/project\\/nederlands\\/","version":"1.7.0","description":"Nederlands taalbestand Joomla! 1.7.0 (beheergedeelte)","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10043, 'SvenskaSE', 'language', 'sv-SE', '', 0, 1, 0, 0, '{"legacy":false,"name":"Svenska (SE)","type":"language","creationDate":"2011-07-13","author":"Swedish Translation Team - SvenskJoomla!","copyright":"Copyright (C) 2005 - 2011 SvenskJoomla! och Open Source Matters. All rights reserved.","authorEmail":"info@svenskjoomla.se","authorUrl":"www.svenskjoomla.se","version":"1.7.0","description":"Svensk \\u00f6vers\\u00e4ttning f\\u00f6r Joomla! 1.7.0 Site<br \\/>\\u00d6versatt av SvenskJoomla<br \\/><br \\/>Du hittar fler svenska \\u00f6vers\\u00e4ttningar p\\u00e5 <a target=\\"_blank\\" href=\\"http:\\/\\/www.svenskjoomla.se\\">http:\\/\\/www.svenskjoomla.se<\\/a>","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10044, 'SvenskaSE', 'language', 'sv-SE', '', 1, 1, 0, 0, '{"legacy":false,"name":"Svenska (SE)","type":"language","creationDate":"2011-07-13","author":"Swedish Translation Team - SvenskJoomla!","copyright":"Copyright (C) 2005 - 2011 SvenskJoomla! och Open Source Matters. All rights reserved.","authorEmail":"info@svenskjoomla.se","authorUrl":"www.svenskjoomla.se","version":"1.7.0","description":"Svensk \\u00f6vers\\u00e4ttning f\\u00f6r Joomla! 1.7.0 Admin<br \\/>\\u00d6versatt av SvenskJoomla<br \\/><br \\/>Du hittar fler svenska \\u00f6vers\\u00e4ttningar p\\u00e5 <a target=\\"_blank\\" href=\\"http:\\/\\/www.svenskjoomla.se\\">http:\\/\\/www.svenskjoomla.se<\\/a>","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_addons`
--

DROP TABLE IF EXISTS `#__jshopping_addons`;
CREATE TABLE IF NOT EXISTS `#__jshopping_addons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) NOT NULL,
  `key` text NOT NULL,
  `version` varchar(255) NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__jshopping_addons`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_attr`
--

DROP TABLE IF EXISTS `#__jshopping_attr`;
CREATE TABLE IF NOT EXISTS `#__jshopping_attr` (
  `attr_id` int(11) NOT NULL AUTO_INCREMENT,
  `attr_ordering` int(11) NOT NULL DEFAULT '0',
  `attr_type` tinyint(1) NOT NULL,
  `independent` tinyint(1) NOT NULL,
  `name_en-GB` varchar(255) NOT NULL,
  `name_de-DE` varchar(255) NOT NULL,
  `name_nl-NL` varchar(255) NOT NULL,
  `name_ru-RU` varchar(255) NOT NULL,
  `name_sv-SE` varchar(255) NOT NULL,
  PRIMARY KEY (`attr_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `#__jshopping_attr`
--

INSERT INTO `#__jshopping_attr` (`attr_id`, `attr_ordering`, `attr_type`, `independent`, `name_en-GB`, `name_de-DE`, `name_nl-NL`, `name_ru-RU`, `name_sv-SE`) VALUES
(1, 1, 2, 0, 'Color', '', '', '', ''),
(2, 2, 1, 0, 'Memory', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_attr_values`
--

DROP TABLE IF EXISTS `#__jshopping_attr_values`;
CREATE TABLE IF NOT EXISTS `#__jshopping_attr_values` (
  `value_id` int(11) NOT NULL AUTO_INCREMENT,
  `attr_id` int(11) NOT NULL,
  `value_ordering` int(11) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL,
  `name_en-GB` varchar(255) NOT NULL,
  `name_de-DE` varchar(255) NOT NULL,
  `name_nl-NL` varchar(255) NOT NULL,
  `name_ru-RU` varchar(255) NOT NULL,
  `name_sv-SE` varchar(255) NOT NULL,
  PRIMARY KEY (`value_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `#__jshopping_attr_values`
--

INSERT INTO `#__jshopping_attr_values` (`value_id`, `attr_id`, `value_ordering`, `image`, `name_en-GB`, `name_de-DE`, `name_nl-NL`, `name_ru-RU`, `name_sv-SE`) VALUES
(1, 1, 1, '', 'Black', '', '', '', ''),
(2, 1, 2, '', 'White', '', '', '', ''),
(4, 2, 1, '', '16 GB', '', '', '', ''),
(5, 2, 2, '', '32GB', '', '', '', ''),
(6, 2, 3, '', '64 GB', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_cart_temp`
--

DROP TABLE IF EXISTS `#__jshopping_cart_temp`;
CREATE TABLE IF NOT EXISTS `#__jshopping_cart_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cookie` varchar(255) NOT NULL,
  `cart` text NOT NULL,
  `type_cart` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `#__jshopping_cart_temp`
--

INSERT INTO `#__jshopping_cart_temp` (`id`, `id_cookie`, `cart`, `type_cart`) VALUES
(1, 'jcq69997onhne0u23nle3q8vm1', 'a:0:{}', 'wishlist'),
(3, 'j8m3uhu99f37727qpirkunqqr4', 'a:0:{}', 'wishlist'),
(6, 'oqhghla7q2qtf7a8e916uesh65', 'a:0:{}', 'wishlist'),
(11, '4p4sun7fj6gstcsu98ejqp12m3', 'a:0:{}', 'wishlist'),
(12, 'ml830akihru29f78pnlg9sb1h5', 'a:1:{i:0;a:17:{s:8:"quantity";i:1;s:10:"product_id";i:6;s:11:"category_id";s:1:"1";s:5:"price";d:1100;s:3:"tax";s:5:"19.00";s:6:"tax_id";s:1:"1";s:11:"description";s:116:"Lorem ipsum dolor sit amet, consectet adipiscing elit. Vestibulum quis sapien leo, vel dictum dui pellentesque haban";s:12:"product_name";s:11:"Macbook Air";s:11:"thumb_image";s:42:"thumb_3dcb373a75c112b4b9c4098327f825fe.jpg";s:3:"ean";s:0:"";s:10:"attributes";s:6:"a:0:{}";s:16:"attributes_value";a:0:{}s:6:"weight";s:6:"0.0000";s:9:"vendor_id";s:1:"0";s:5:"files";s:6:"a:0:{}";s:14:"freeattributes";s:6:"a:0:{}";s:25:"dependent_attr_serrialize";s:6:"a:0:{}";}}', 'wishlist'),
(13, '9c30b60599f5cdf167e233de40b849c4', 'a:0:{}', 'wishlist');

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_categories`
--

DROP TABLE IF EXISTS `#__jshopping_categories`;
CREATE TABLE IF NOT EXISTS `#__jshopping_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_image` varchar(255) DEFAULT NULL,
  `category_parent_id` int(11) NOT NULL DEFAULT '0',
  `category_publish` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `category_ordertype` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `category_template` varchar(64) DEFAULT NULL,
  `ordering` int(3) NOT NULL,
  `category_add_date` datetime DEFAULT '0000-00-00 00:00:00',
  `products_page` int(8) NOT NULL DEFAULT '12',
  `products_row` int(3) NOT NULL DEFAULT '3',
  `name_en-GB` varchar(255) NOT NULL,
  `alias_en-GB` varchar(255) NOT NULL,
  `short_description_en-GB` text NOT NULL,
  `description_en-GB` text NOT NULL,
  `meta_title_en-GB` varchar(255) NOT NULL,
  `meta_description_en-GB` text NOT NULL,
  `meta_keyword_en-GB` text NOT NULL,
  `name_de-DE` varchar(255) NOT NULL,
  `alias_de-DE` varchar(255) NOT NULL,
  `short_description_de-DE` text NOT NULL,
  `description_de-DE` text NOT NULL,
  `meta_title_de-DE` varchar(255) NOT NULL,
  `meta_description_de-DE` text NOT NULL,
  `meta_keyword_de-DE` text NOT NULL,
  `name_nl-NL` varchar(255) NOT NULL,
  `alias_nl-NL` varchar(255) NOT NULL,
  `short_description_nl-NL` text NOT NULL,
  `description_nl-NL` text NOT NULL,
  `meta_title_nl-NL` varchar(255) NOT NULL,
  `meta_description_nl-NL` text NOT NULL,
  `meta_keyword_nl-NL` text NOT NULL,
  `name_ru-RU` varchar(255) NOT NULL,
  `alias_ru-RU` varchar(255) NOT NULL,
  `short_description_ru-RU` text NOT NULL,
  `description_ru-RU` text NOT NULL,
  `meta_title_ru-RU` varchar(255) NOT NULL,
  `meta_description_ru-RU` text NOT NULL,
  `meta_keyword_ru-RU` text NOT NULL,
  `name_sv-SE` varchar(255) NOT NULL,
  `alias_sv-SE` varchar(255) NOT NULL,
  `short_description_sv-SE` text NOT NULL,
  `description_sv-SE` text NOT NULL,
  `meta_title_sv-SE` varchar(255) NOT NULL,
  `meta_description_sv-SE` text NOT NULL,
  `meta_keyword_sv-SE` text NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `sort_add_date` (`category_add_date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `#__jshopping_categories`
--

INSERT INTO `#__jshopping_categories` (`category_id`, `category_image`, `category_parent_id`, `category_publish`, `category_ordertype`, `category_template`, `ordering`, `category_add_date`, `products_page`, `products_row`, `name_en-GB`, `alias_en-GB`, `short_description_en-GB`, `description_en-GB`, `meta_title_en-GB`, `meta_description_en-GB`, `meta_keyword_en-GB`, `name_de-DE`, `alias_de-DE`, `short_description_de-DE`, `description_de-DE`, `meta_title_de-DE`, `meta_description_de-DE`, `meta_keyword_de-DE`, `name_nl-NL`, `alias_nl-NL`, `short_description_nl-NL`, `description_nl-NL`, `meta_title_nl-NL`, `meta_description_nl-NL`, `meta_keyword_nl-NL`, `name_ru-RU`, `alias_ru-RU`, `short_description_ru-RU`, `description_ru-RU`, `meta_title_ru-RU`, `meta_description_ru-RU`, `meta_keyword_ru-RU`, `name_sv-SE`, `alias_sv-SE`, `short_description_sv-SE`, `description_sv-SE`, `meta_title_sv-SE`, `meta_description_sv-SE`, `meta_keyword_sv-SE`) VALUES
(1, '2ac55eae5b5154acd3efd3cb3c6519e1.jpg', 0, 1, 1, NULL, 2, '2011-08-02 12:33:58', 12, 3, 'Books', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur.</p>', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 'cff10ce9e7693fcf60c7ddb41b1c9e1a.jpg', 0, 1, 1, NULL, 3, '2011-08-02 12:36:41', 12, 3, 'Cameras & Photo', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '<p class="category_short_description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur.</p>', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 'a7edb9d68a5eb60cf6ace5f23cb2de56.jpg', 0, 1, 1, NULL, 4, '2011-08-02 12:38:46', 12, 3, 'Cell Phones & PDAs', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '<p class="category_short_description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur.</p>', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, '3f7f5cacddc35013476f49ed3f484100.jpg', 0, 1, 1, NULL, 5, '2011-08-02 17:33:08', 12, 3, 'Computers', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur.</p>', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, '44857a3bdbae9fe627200f4c2f39e69d.jpg', 4, 1, 1, NULL, 2, '2011-08-02 17:35:15', 12, 3, 'Apple Computers', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur.</p>', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(6, 'a09daa0844cc7de2fba0fc9fc65a0a85.jpg', 0, 1, 1, NULL, 6, '2011-08-09 09:21:49', 12, 3, 'Clothing', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur.</p>', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(7, 'f47278b48b8a21105f6041c1f1f83c80.jpg', 0, 1, 1, NULL, 7, '2011-08-09 09:23:27', 12, 3, 'Health & Beauty', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur.</p>', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(8, '84182d943826c31162434bbe0d02e7fb.jpg', 0, 1, 1, NULL, 8, '2011-08-09 09:24:32', 12, 3, 'Home & Garden', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(9, 'a8b035644eb7bafb7a2b5012005f368f.png', 0, 1, 1, NULL, 9, '2011-08-09 09:25:50', 12, 3, 'Jewelry & Watches', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(10, 'a4872f37b8010b3f286754f9d37c1317.jpg', 0, 1, 1, NULL, 10, '2011-08-09 09:27:41', 12, 3, 'Movies & Music', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(11, '09e3172e468f91d467c687665d78a6aa.png', 0, 1, 1, NULL, 11, '2011-08-09 09:29:11', 12, 3, 'Software', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(12, 'da4c310f5b78747e9fa2b291528fd6bc.jpg', 0, 1, 1, NULL, 12, '2011-08-09 09:30:04', 12, 3, 'Toys, Baby & Kids', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(13, '3546746d45819f5d4039e6d0c5e977a2.jpg', 0, 1, 1, NULL, 13, '2011-08-09 09:30:58', 12, 3, 'Video Games', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(14, 'ece63e53fb5ea3b53787b8337db39a40.jpg', 4, 1, 1, NULL, 1, '2011-08-09 09:33:39', 12, 3, 'Accessories', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(15, '89ca1ae6c90f114fdd1bd40903b60769.jpg', 4, 1, 1, NULL, 3, '2011-08-09 09:39:02', 12, 3, 'Desktop Computers', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(16, '44ec40636829a28fb59f9d41d957ba3d.jpg', 4, 1, 1, NULL, 4, '2011-08-09 09:39:17', 12, 3, 'Drives', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(17, 'fd9ff6aab701cbe5ce3413505561416b.jpg', 4, 1, 1, NULL, 5, '2011-08-09 09:39:34', 12, 3, 'LCD Display', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18, 'f1f9d99c04600f17d1b4fef9e1798bbc.jpg', 4, 1, 1, NULL, 6, '2011-08-09 09:40:22', 12, 3, 'Memory', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(19, 'c2de124fb94936f298f3cd0e8b5c020c.jpg', 4, 1, 1, NULL, 7, '2011-08-09 09:40:42', 12, 3, 'Printers & Supplies', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(20, '21e49faaae874fa8815752cf986691de.jpg', 9, 1, 1, NULL, 1, '2011-08-09 09:45:54', 12, 3, 'Pendants', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(21, 'c0bff1acc45de336ebea110785d86a14.jpg', 9, 1, 1, NULL, 3, '2011-08-09 09:46:04', 12, 3, 'Earrings', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(22, '54dd0362a4313c09b10252e19ed314f4.jpg', 9, 1, 1, NULL, 4, '2011-08-09 09:46:17', 12, 3, 'Bracelets', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(23, 'c2fdaeec8d046a1bdfe88968dcf6982a.jpg', 9, 1, 1, NULL, 5, '2011-08-09 09:46:28', 12, 3, 'Rings', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(24, '94228ed4d1445345da71b51071ffc07d.jpg', 9, 1, 1, NULL, 6, '2011-08-09 09:47:13', 12, 3, 'Men''s Watches', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(25, '946638a394086411022d160368c85800.jpg', 9, 1, 1, NULL, 7, '2011-08-09 09:47:22', 12, 3, 'Women''s Watches', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(26, 'b613ee13ee1d8379a1f2ed047623183a.jpg', 6, 1, 1, NULL, 1, '2011-08-09 09:54:55', 12, 3, 'Women''s Tops', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(27, '5d2b08014a676f1171a49a2b17262674.jpg', 6, 1, 1, NULL, 2, '2011-08-09 09:55:09', 12, 3, 'Men''s Tops', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(28, 'b4a966d33900157aa22c10fd800e38c9.jpg', 6, 1, 1, NULL, 3, '2011-08-09 09:55:23', 12, 3, 'Women''s Bottoms', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(29, 'a8fa1cd92955a8483e9a7048c811db0c.png', 6, 1, 1, NULL, 4, '2011-08-09 09:55:59', 12, 3, 'Men''s Bottoms', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(30, 'a105d66e9ecab895b704ad73d84e7ac5.jpg', 6, 1, 1, NULL, 5, '2011-08-09 09:56:10', 12, 3, 'Children', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(31, 'a1898071f64bb454a750ab64519bcdcf.jpg', 6, 1, 1, NULL, 6, '2011-08-09 09:56:22', 12, 3, 'Men''s Shoes', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(32, 'a49250f565a0d3d87656e4d957f0269d.jpg', 6, 1, 1, NULL, 7, '2011-08-09 09:56:40', 12, 3, 'Women''s Shoes', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(33, '3f84dded37c6eb12d230d0b3f93039f8.jpg', 14, 1, 1, NULL, 1, '2011-08-09 10:05:38', 12, 3, 'Mouse', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(34, '5c862595f4d880a79f59c876c5c1c8fb.jpg', 14, 1, 1, NULL, 2, '2011-08-09 10:06:05', 12, 3, 'Keyboards', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(35, '0340c7720788e51ec6f81e81347a01ad.jpg', 14, 1, 1, NULL, 3, '2011-08-09 10:06:15', 12, 3, 'Webcam Products', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(36, '8c2e52fc4b62d4404878fd5b76dbf27d.jpg', 14, 1, 1, NULL, 4, '2011-08-09 10:06:27', 12, 3, 'Computer Speakers', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(37, 'b19b16362c690d31a4405ed06c302083.jpg', 14, 1, 1, NULL, 5, '2011-08-09 10:06:38', 12, 3, 'Wireless USB', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(38, 'b6f5efd2462bfaa61d47a0e4f5a12c75.jpg', 14, 1, 1, NULL, 6, '2011-08-09 10:06:49', 12, 3, 'Laptop Cases', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id leo ac turpis aliquet malesua. Duis mollis vehicula urna. Morbi ultricies purus eget libero egestas viverra. Praesent in gravida felis. Fusce rhoncus odio ac purus rutrum eu euismod dui vehicula. Duis semper condimentum metus, id posuere ligula vestibulum non. Fusce viverra consequat diam quis placerat.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_config`
--

DROP TABLE IF EXISTS `#__jshopping_config`;
CREATE TABLE IF NOT EXISTS `#__jshopping_config` (
  `id` tinyint(1) NOT NULL DEFAULT '0',
  `count_products_to_page` int(4) NOT NULL DEFAULT '0',
  `count_products_to_row` int(2) NOT NULL DEFAULT '0',
  `count_category_to_row` int(2) NOT NULL DEFAULT '0',
  `image_category_width` int(4) NOT NULL DEFAULT '0',
  `image_category_height` int(4) NOT NULL DEFAULT '0',
  `image_product_width` int(4) NOT NULL DEFAULT '0',
  `image_product_height` int(4) NOT NULL DEFAULT '0',
  `image_product_full_width` int(4) NOT NULL DEFAULT '0',
  `image_product_full_height` int(4) NOT NULL DEFAULT '0',
  `video_product_width` int(4) NOT NULL DEFAULT '0',
  `video_product_height` int(4) NOT NULL DEFAULT '0',
  `adminLanguage` varchar(8) NOT NULL DEFAULT '',
  `defaultLanguage` varchar(8) NOT NULL DEFAULT '',
  `mainCurrency` int(4) NOT NULL,
  `decimal_count` tinyint(1) NOT NULL,
  `decimal_symbol` varchar(5) NOT NULL,
  `thousand_separator` varchar(5) NOT NULL,
  `currency_format` tinyint(1) NOT NULL,
  `use_rabatt_code` tinyint(1) NOT NULL,
  `enable_wishlist` tinyint(1) NOT NULL,
  `default_status_order` tinyint(1) NOT NULL,
  `order_number_type` varchar(50) NOT NULL,
  `store_name` varchar(64) NOT NULL,
  `store_company_name` varchar(64) NOT NULL,
  `store_url` varchar(255) NOT NULL,
  `store_address` varchar(64) NOT NULL,
  `store_city` varchar(64) NOT NULL,
  `store_country` int(8) NOT NULL,
  `store_state` varchar(64) NOT NULL,
  `store_zip` varchar(12) NOT NULL,
  `store_address_format` varchar(64) NOT NULL,
  `store_date_format` varchar(64) NOT NULL,
  `contact_firstname` varchar(64) NOT NULL,
  `contact_lastname` varchar(64) NOT NULL,
  `contact_middlename` varchar(64) NOT NULL,
  `contact_phone` varchar(64) NOT NULL,
  `contact_fax` varchar(64) NOT NULL,
  `contact_email` varchar(128) NOT NULL,
  `store_logo` varchar(128) NOT NULL,
  `store_email` varchar(128) NOT NULL,
  `benef_bank_name` varchar(64) NOT NULL,
  `benef_bank_info` varchar(64) NOT NULL,
  `benef_bic` varchar(64) NOT NULL,
  `benef_conto` varchar(64) NOT NULL,
  `benef_payee` varchar(64) NOT NULL,
  `benef_iban` varchar(64) NOT NULL,
  `benef_swift` varchar(64) NOT NULL,
  `interm_name` varchar(64) NOT NULL,
  `interm_swift` varchar(64) NOT NULL,
  `identification_number` varchar(32) NOT NULL,
  `tax_number` varchar(32) NOT NULL,
  `allow_reviews_prod` tinyint(1) NOT NULL,
  `allow_reviews_only_registered` tinyint(1) NOT NULL,
  `allow_reviews_manuf` tinyint(1) NOT NULL,
  `max_mark` int(11) NOT NULL,
  `summ_null_shipping` decimal(12,2) NOT NULL,
  `without_shipping` tinyint(1) NOT NULL,
  `without_payment` tinyint(1) NOT NULL,
  `shop_special_type` varchar(64) NOT NULL,
  `pdf_parameters` varchar(255) NOT NULL,
  `next_order_number` int(11) NOT NULL DEFAULT '1',
  `shop_user_guest` tinyint(1) NOT NULL,
  `hide_product_not_avaible_stock` tinyint(1) NOT NULL,
  `show_buy_in_category` tinyint(1) NOT NULL,
  `user_as_catalog` tinyint(1) NOT NULL,
  `show_tax_in_product` tinyint(1) NOT NULL,
  `show_tax_product_in_cart` tinyint(1) NOT NULL,
  `show_plus_shipping_in_product` tinyint(1) NOT NULL,
  `hide_buy_not_avaible_stock` tinyint(1) NOT NULL,
  `show_sort_product` tinyint(1) NOT NULL,
  `show_count_select_products` tinyint(1) NOT NULL,
  `order_send_pdf_client` tinyint(1) NOT NULL,
  `order_send_pdf_admin` tinyint(1) NOT NULL,
  `show_delivery_time` tinyint(1) NOT NULL,
  `securitykey` varchar(200) NOT NULL,
  `demo_type` tinyint(1) NOT NULL,
  `product_show_manufacturer_logo` tinyint(1) NOT NULL,
  `product_show_weight` tinyint(1) NOT NULL,
  `max_count_order_one_product` int(11) NOT NULL,
  `min_count_order_one_product` int(11) NOT NULL,
  `min_price_order` int(11) NOT NULL,
  `max_price_order` int(11) NOT NULL,
  `hide_tax` tinyint(1) NOT NULL,
  `licensekod` text NOT NULL,
  `product_attribut_first_value_empty` tinyint(1) NOT NULL,
  `show_hits` tinyint(1) NOT NULL,
  `show_registerform_in_logintemplate` tinyint(1) NOT NULL,
  `admin_show_product_basic_price` tinyint(1) NOT NULL,
  `admin_show_attributes` tinyint(1) NOT NULL,
  `admin_show_delivery_time` tinyint(1) NOT NULL,
  `admin_show_languages` tinyint(1) NOT NULL,
  `use_different_templates_cat_prod` tinyint(1) NOT NULL,
  `admin_show_product_video` tinyint(1) NOT NULL,
  `admin_show_product_related` tinyint(1) NOT NULL,
  `admin_show_product_files` tinyint(1) NOT NULL,
  `admin_show_product_bay_price` tinyint(1) NOT NULL,
  `admin_show_product_labels` tinyint(1) NOT NULL,
  `sorting_country_in_alphabet` tinyint(1) NOT NULL,
  `hide_text_product_not_available` tinyint(1) NOT NULL,
  `show_weight_order` tinyint(1) NOT NULL,
  `discount_use_full_sum` tinyint(1) NOT NULL,
  `show_cart_all_step_checkout` tinyint(1) NOT NULL,
  `use_plugin_content` tinyint(1) NOT NULL,
  `display_price_admin` tinyint(1) NOT NULL,
  `display_price_front` tinyint(1) NOT NULL,
  `product_list_show_weight` tinyint(1) NOT NULL,
  `product_list_show_manufacturer` tinyint(1) NOT NULL,
  `use_extend_tax_rule` tinyint(4) NOT NULL,
  `use_extend_display_price_rule` tinyint(4) NOT NULL,
  `fields_register` text NOT NULL,
  `template` varchar(255) NOT NULL,
  `show_product_code` tinyint(1) NOT NULL,
  `show_product_code_in_cart` tinyint(1) NOT NULL,
  `savelog` tinyint(1) NOT NULL,
  `savelogpaymentdata` tinyint(1) NOT NULL,
  `product_list_show_min_price` tinyint(1) NOT NULL,
  `product_count_related_in_row` tinyint(4) NOT NULL,
  `category_sorting` tinyint(1) NOT NULL DEFAULT '1',
  `product_sorting` tinyint(1) NOT NULL DEFAULT '1',
  `product_sorting_direction` tinyint(1) NOT NULL DEFAULT '0',
  `show_product_list_filters` tinyint(1) NOT NULL,
  `admin_show_product_extra_field` tinyint(1) NOT NULL,
  `product_list_display_extra_fields` text NOT NULL,
  `filter_display_extra_fields` text NOT NULL,
  `product_hide_extra_fields` text NOT NULL,
  `default_country` int(11) NOT NULL,
  `show_return_policy_in_email_order` tinyint(1) NOT NULL,
  `client_allow_cancel_order` tinyint(1) NOT NULL,
  `admin_show_vendors` tinyint(1) NOT NULL,
  `vendor_order_message_type` tinyint(1) NOT NULL,
  `admin_not_send_email_order_vendor_order` tinyint(1) NOT NULL,
  `not_redirect_in_cart_after_buy` tinyint(1) NOT NULL,
  `product_show_vendor` tinyint(1) NOT NULL,
  `product_show_vendor_detail` tinyint(1) NOT NULL,
  `product_list_show_vendor` tinyint(1) NOT NULL,
  `admin_show_freeattributes` tinyint(1) NOT NULL,
  `product_show_button_back` tinyint(1) NOT NULL,
  `calcule_tax_after_discount` tinyint(1) NOT NULL,
  `product_list_show_product_code` tinyint(1) NOT NULL,
  `radio_attr_value_vertical` tinyint(1) NOT NULL,
  `attr_display_addprice` tinyint(1) NOT NULL,
  `use_ssl` tinyint(1) NOT NULL,
  `product_list_show_price_description` tinyint(1) NOT NULL,
  `display_button_print` tinyint(1) NOT NULL,
  `hide_shipping_step` tinyint(1) NOT NULL,
  `hide_payment_step` tinyint(1) NOT NULL,
  `image_resize_type` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__jshopping_config`
--

INSERT INTO `#__jshopping_config` (`id`, `count_products_to_page`, `count_products_to_row`, `count_category_to_row`, `image_category_width`, `image_category_height`, `image_product_width`, `image_product_height`, `image_product_full_width`, `image_product_full_height`, `video_product_width`, `video_product_height`, `adminLanguage`, `defaultLanguage`, `mainCurrency`, `decimal_count`, `decimal_symbol`, `thousand_separator`, `currency_format`, `use_rabatt_code`, `enable_wishlist`, `default_status_order`, `order_number_type`, `store_name`, `store_company_name`, `store_url`, `store_address`, `store_city`, `store_country`, `store_state`, `store_zip`, `store_address_format`, `store_date_format`, `contact_firstname`, `contact_lastname`, `contact_middlename`, `contact_phone`, `contact_fax`, `contact_email`, `store_logo`, `store_email`, `benef_bank_name`, `benef_bank_info`, `benef_bic`, `benef_conto`, `benef_payee`, `benef_iban`, `benef_swift`, `interm_name`, `interm_swift`, `identification_number`, `tax_number`, `allow_reviews_prod`, `allow_reviews_only_registered`, `allow_reviews_manuf`, `max_mark`, `summ_null_shipping`, `without_shipping`, `without_payment`, `shop_special_type`, `pdf_parameters`, `next_order_number`, `shop_user_guest`, `hide_product_not_avaible_stock`, `show_buy_in_category`, `user_as_catalog`, `show_tax_in_product`, `show_tax_product_in_cart`, `show_plus_shipping_in_product`, `hide_buy_not_avaible_stock`, `show_sort_product`, `show_count_select_products`, `order_send_pdf_client`, `order_send_pdf_admin`, `show_delivery_time`, `securitykey`, `demo_type`, `product_show_manufacturer_logo`, `product_show_weight`, `max_count_order_one_product`, `min_count_order_one_product`, `min_price_order`, `max_price_order`, `hide_tax`, `licensekod`, `product_attribut_first_value_empty`, `show_hits`, `show_registerform_in_logintemplate`, `admin_show_product_basic_price`, `admin_show_attributes`, `admin_show_delivery_time`, `admin_show_languages`, `use_different_templates_cat_prod`, `admin_show_product_video`, `admin_show_product_related`, `admin_show_product_files`, `admin_show_product_bay_price`, `admin_show_product_labels`, `sorting_country_in_alphabet`, `hide_text_product_not_available`, `show_weight_order`, `discount_use_full_sum`, `show_cart_all_step_checkout`, `use_plugin_content`, `display_price_admin`, `display_price_front`, `product_list_show_weight`, `product_list_show_manufacturer`, `use_extend_tax_rule`, `use_extend_display_price_rule`, `fields_register`, `template`, `show_product_code`, `show_product_code_in_cart`, `savelog`, `savelogpaymentdata`, `product_list_show_min_price`, `product_count_related_in_row`, `category_sorting`, `product_sorting`, `product_sorting_direction`, `show_product_list_filters`, `admin_show_product_extra_field`, `product_list_display_extra_fields`, `filter_display_extra_fields`, `product_hide_extra_fields`, `default_country`, `show_return_policy_in_email_order`, `client_allow_cancel_order`, `admin_show_vendors`, `vendor_order_message_type`, `admin_not_send_email_order_vendor_order`, `not_redirect_in_cart_after_buy`, `product_show_vendor`, `product_show_vendor_detail`, `product_list_show_vendor`, `admin_show_freeattributes`, `product_show_button_back`, `calcule_tax_after_discount`, `product_list_show_product_code`, `radio_attr_value_vertical`, `attr_display_addprice`, `use_ssl`, `product_list_show_price_description`, `display_button_print`, `hide_shipping_step`, `hide_payment_step`, `image_resize_type`) VALUES
(1, 12, 3, 1, 120, 0, 100, 0, 200, 0, 320, 240, 'en-GB', 'en-GB', 1, 2, '.', '', 2, 1, 1, 1, '1', 'test_store_name', 'test_company_name', 'http://test_url.com', 'test_address', 'test_city', 0, 'test_state', '111111', '%storename %address %city %zip', '%d.%m.%Y', 'firstname', 'lastname', 'middlename', '111-111-111', '111-111-111', 'info@icetheme.com', '', '', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', '', '', 1, 1, 0, 10, '-1.00', 0, 0, '', '208:65:208:30', 4, 0, 0, 1, 0, 0, 0, 0, 1, 1, 1, 1, 0, 0, '970ba9d3ee3ad48c3e0f1a0d4ce2ed60', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 1, 1, 1, 0, 1, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'a:3:{s:8:"register";a:15:{s:5:"title";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:6:"l_name";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:10:"firma_name";a:1:{s:7:"display";s:1:"1";}s:6:"street";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:3:"zip";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:4:"city";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:5:"state";a:1:{s:7:"display";s:1:"1";}s:7:"country";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:5:"phone";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:3:"fax";a:1:{s:7:"display";s:1:"1";}s:6:"f_name";a:2:{s:7:"require";i:1;s:7:"display";i:1;}s:5:"email";a:2:{s:7:"require";i:1;s:7:"display";i:1;}s:6:"u_name";a:2:{s:7:"require";i:1;s:7:"display";i:1;}s:8:"password";a:2:{s:7:"require";i:1;s:7:"display";i:1;}s:10:"password_2";a:2:{s:7:"require";i:1;s:7:"display";i:1;}}s:7:"address";a:22:{s:5:"title";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:6:"l_name";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:10:"firma_name";a:1:{s:7:"display";s:1:"1";}s:6:"street";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:3:"zip";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:4:"city";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:5:"state";a:1:{s:7:"display";s:1:"1";}s:7:"country";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:5:"phone";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:3:"fax";a:1:{s:7:"display";s:1:"1";}s:7:"d_title";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:8:"d_f_name";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:8:"d_l_name";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:12:"d_firma_name";a:1:{s:7:"display";s:1:"1";}s:8:"d_street";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:5:"d_zip";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:6:"d_city";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:7:"d_state";a:1:{s:7:"display";s:1:"1";}s:9:"d_country";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:7:"d_phone";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:6:"f_name";a:2:{s:7:"require";i:1;s:7:"display";i:1;}s:5:"email";a:2:{s:7:"require";i:1;s:7:"display";i:1;}}s:11:"editaccount";a:22:{s:5:"title";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:6:"l_name";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:10:"firma_name";a:1:{s:7:"display";s:1:"1";}s:6:"street";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:3:"zip";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:4:"city";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:5:"state";a:1:{s:7:"display";s:1:"1";}s:7:"country";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:5:"phone";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:3:"fax";a:1:{s:7:"display";s:1:"1";}s:7:"d_title";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:8:"d_f_name";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:8:"d_l_name";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:12:"d_firma_name";a:1:{s:7:"display";s:1:"1";}s:8:"d_street";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:5:"d_zip";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:6:"d_city";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:7:"d_state";a:1:{s:7:"display";s:1:"1";}s:9:"d_country";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:7:"d_phone";a:2:{s:7:"display";s:1:"1";s:7:"require";s:1:"1";}s:6:"f_name";a:2:{s:7:"require";i:1;s:7:"display";i:1;}s:5:"email";a:2:{s:7:"require";i:1;s:7:"display";i:1;}}}', 'icetheme', 1, 0, 0, 0, 0, 3, 1, 1, 0, 0, 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_config_display_prices`
--

DROP TABLE IF EXISTS `#__jshopping_config_display_prices`;
CREATE TABLE IF NOT EXISTS `#__jshopping_config_display_prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zones` text NOT NULL,
  `display_price` tinyint(1) NOT NULL,
  `display_price_firma` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__jshopping_config_display_prices`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_config_seo`
--

DROP TABLE IF EXISTS `#__jshopping_config_seo`;
CREATE TABLE IF NOT EXISTS `#__jshopping_config_seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(64) NOT NULL,
  `ordering` int(11) NOT NULL,
  `title_en-GB` varchar(255) NOT NULL,
  `keyword_en-GB` text NOT NULL,
  `description_en-GB` text NOT NULL,
  `title_de-DE` varchar(255) NOT NULL,
  `keyword_de-DE` text NOT NULL,
  `description_de-DE` text NOT NULL,
  `title_nl-NL` varchar(255) NOT NULL,
  `keyword_nl-NL` text NOT NULL,
  `description_nl-NL` text NOT NULL,
  `title_ru-RU` varchar(255) NOT NULL,
  `keyword_ru-RU` text NOT NULL,
  `description_ru-RU` text NOT NULL,
  `title_sv-SE` varchar(255) NOT NULL,
  `keyword_sv-SE` text NOT NULL,
  `description_sv-SE` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `#__jshopping_config_seo`
--

INSERT INTO `#__jshopping_config_seo` (`id`, `alias`, `ordering`, `title_en-GB`, `keyword_en-GB`, `description_en-GB`, `title_de-DE`, `keyword_de-DE`, `description_de-DE`, `title_nl-NL`, `keyword_nl-NL`, `description_nl-NL`, `title_ru-RU`, `keyword_ru-RU`, `description_ru-RU`, `title_sv-SE`, `keyword_sv-SE`, `description_sv-SE`) VALUES
(1, 'category', 10, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 'manufacturers', 20, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 'cart', 30, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, 'wishlist', 40, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 'login', 50, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(6, 'register', 60, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(7, 'editaccount', 70, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(8, 'myorders', 80, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(9, 'myaccount', 90, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(10, 'search', 100, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(11, 'search-result', 110, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(12, 'myorder-detail', 120, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(13, 'vendors', 130, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(14, 'content-agb', 140, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(15, 'content-return_policy', 150, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(16, 'content-shipping', 160, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(17, 'checkout-address', 170, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18, 'checkout-payment', 180, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(19, 'checkout-shipping', 190, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(20, 'checkout-preview', 200, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(21, 'lastproducts', 210, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(22, 'randomproducts', 220, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(23, 'bestsellerproducts', 230, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(24, 'labelproducts', 240, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(25, 'topratingproducts', 250, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(26, 'tophitsproducts', 260, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(27, 'all-products', 270, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_config_statictext`
--

DROP TABLE IF EXISTS `#__jshopping_config_statictext`;
CREATE TABLE IF NOT EXISTS `#__jshopping_config_statictext` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(64) NOT NULL,
  `text_en-GB` text NOT NULL,
  `text_de-DE` text NOT NULL,
  `text_nl-NL` text NOT NULL,
  `text_ru-RU` text NOT NULL,
  `text_sv-SE` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `#__jshopping_config_statictext`
--

INSERT INTO `#__jshopping_config_statictext` (`id`, `alias`, `text_en-GB`, `text_de-DE`, `text_nl-NL`, `text_ru-RU`, `text_sv-SE`) VALUES
(1, 'home', '', '', '', '', ''),
(2, 'manufacturer', '', '', '', '', ''),
(3, 'agb', '', '', '', '', ''),
(4, 'return_policy', '', '', '', '', ''),
(5, 'order_email_descr', '', '', '', '', ''),
(6, 'order_finish_descr', '', '', '', '', ''),
(7, 'shipping', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_countries`
--

DROP TABLE IF EXISTS `#__jshopping_countries`;
CREATE TABLE IF NOT EXISTS `#__jshopping_countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_publish` tinyint(4) NOT NULL,
  `ordering` smallint(6) NOT NULL,
  `country_code` varchar(5) NOT NULL,
  `country_code_2` varchar(5) NOT NULL,
  `name_en-GB` varchar(255) NOT NULL,
  `name_de-DE` varchar(255) NOT NULL,
  `name_nl-NL` varchar(255) NOT NULL,
  `name_ru-RU` varchar(255) NOT NULL,
  `name_sv-SE` varchar(255) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=240 ;

--
-- Dumping data for table `#__jshopping_countries`
--

INSERT INTO `#__jshopping_countries` (`country_id`, `country_publish`, `ordering`, `country_code`, `country_code_2`, `name_en-GB`, `name_de-DE`, `name_nl-NL`, `name_ru-RU`, `name_sv-SE`) VALUES
(1, 1, 1, 'AFG', 'AF', 'Afghanistan', 'Afghanistan', 'Afghanistan', 'Afghanistan', 'Afghanistan'),
(2, 1, 2, 'ALB', 'AL', 'Albania', 'Albanien', 'Albania', 'Albania', 'Albania'),
(3, 1, 3, 'DZA', 'DZ', 'Algeria', 'Algerien', 'Algeria', 'Algeria', 'Algeria'),
(4, 1, 4, 'ASM', 'AS', 'American Samoa', 'Amerikanisch-Samoa', 'American Samoa', 'American Samoa', 'American Samoa'),
(5, 1, 5, 'AND', 'AD', 'Andorra', 'Andorra', 'Andorra', 'Andorra', 'Andorra'),
(6, 1, 6, 'AGO', 'AO', 'Angola', 'Angola', 'Angola', 'Angola', 'Angola'),
(7, 1, 7, 'AIA', 'AI', 'Anguilla', 'Anguilla', 'Anguilla', 'Anguilla', 'Anguilla'),
(8, 1, 8, 'ATA', 'AQ', 'Antarctica', 'Antarktis', 'Antarctica', 'Antarctica', 'Antarctica'),
(9, 1, 9, 'ATG', 'AG', 'Antigua and Barbuda', 'Antigua und Barbuda', 'Antigua and Barbuda', 'Antigua and Barbuda', 'Antigua and Barbuda'),
(10, 1, 10, 'ARG', 'AR', 'Argentina', 'Argentinien', 'Argentina', 'Argentina', 'Argentina'),
(11, 1, 11, 'ARM', 'AM', 'Armenia', 'Armenien', 'Armenia', 'Armenia', 'Armenia'),
(12, 1, 12, 'ABW', 'AW', 'Aruba', 'Aruba', 'Aruba', 'Aruba', 'Aruba'),
(13, 1, 13, 'AUS', 'AU', 'Australia', 'Australien', 'Australia', 'Australia', 'Australia'),
(14, 1, 14, 'AUT', 'AT', 'Austria', 'Österreich', 'Austria', 'Austria', 'Austria'),
(15, 1, 15, 'AZE', 'AZ', 'Azerbaijan', 'Aserbaidschan', 'Azerbaijan', 'Azerbaijan', 'Azerbaijan'),
(16, 1, 16, 'BHS', 'BS', 'Bahamas', 'Bahamas', 'Bahamas', 'Bahamas', 'Bahamas'),
(17, 1, 17, 'BHR', 'BH', 'Bahrain', 'Bahrain', 'Bahrain', 'Bahrain', 'Bahrain'),
(18, 1, 18, 'BGD', 'BD', 'Bangladesh', 'Bangladesch', 'Bangladesh', 'Bangladesh', 'Bangladesh'),
(19, 1, 19, 'BRB', 'BB', 'Barbados', 'Barbados', 'Barbados', 'Barbados', 'Barbados'),
(20, 1, 20, 'BLR', 'BY', 'Belarus', 'Weissrussland', 'Belarus', 'Belarus', 'Belarus'),
(21, 1, 21, 'BEL', 'BE', 'Belgium', 'Belgien', 'Belgium', 'Belgium', 'Belgium'),
(22, 1, 22, 'BLZ', 'BZ', 'Belize', 'Belize', 'Belize', 'Belize', 'Belize'),
(23, 1, 23, 'BEN', 'BJ', 'Benin', 'Benin', 'Benin', 'Benin', 'Benin'),
(24, 1, 24, 'BMU', 'BM', 'Bermuda', 'Bermuda', 'Bermuda', 'Bermuda', 'Bermuda'),
(25, 1, 25, 'BTN', 'BT', 'Bhutan', 'Bhutan', 'Bhutan', 'Bhutan', 'Bhutan'),
(26, 1, 26, 'BOL', 'BO', 'Bolivia', 'Bolivien', 'Bolivia', 'Bolivia', 'Bolivia'),
(27, 1, 27, 'BIH', 'BA', 'Bosnia and Herzegowina', 'Bosnien und Herzegowina', 'Bosnia and Herzegowina', 'Bosnia and Herzegowina', 'Bosnia and Herzegowina'),
(28, 1, 28, 'BWA', 'BW', 'Botswana', 'Botsuana', 'Botswana', 'Botswana', 'Botswana'),
(29, 1, 29, 'BVT', 'BV', 'Bouvet Island', 'Bouvetinsel', 'Bouvet Island', 'Bouvet Island', 'Bouvet Island'),
(30, 1, 30, 'BRA', 'BR', 'Brazil', 'Brasilien', 'Brazil', 'Brazil', 'Brazil'),
(31, 1, 31, 'IOT', 'IO', 'British Indian Ocean Territory', 'Britisches Territorium im Indischen Ozean', 'British Indian Ocean Territory', 'British Indian Ocean Territory', 'British Indian Ocean Territory'),
(32, 1, 32, 'BRN', 'BN', 'Brunei Darussalam', 'Brunei', 'Brunei Darussalam', 'Brunei Darussalam', 'Brunei Darussalam'),
(33, 1, 33, 'BGR', 'BG', 'Bulgaria', 'Bulgarien', 'Bulgaria', 'Bulgaria', 'Bulgaria'),
(34, 1, 34, 'BFA', 'BF', 'Burkina Faso', 'Burkina Faso', 'Burkina Faso', 'Burkina Faso', 'Burkina Faso'),
(35, 1, 35, 'BDI', 'BI', 'Burundi', 'Burundi', 'Burundi', 'Burundi', 'Burundi'),
(36, 1, 36, 'KHM', 'KH', 'Cambodia', 'Kambodscha', 'Cambodia', 'Cambodia', 'Cambodia'),
(37, 1, 37, 'CMR', 'CM', 'Cameroon', 'Kamerun', 'Cameroon', 'Cameroon', 'Cameroon'),
(38, 1, 38, 'CAN', 'CA', 'Canada', 'Kanada', 'Canada', 'Canada', 'Canada'),
(39, 1, 39, 'CPV', 'CV', 'Cape Verde', 'Kap Verde', 'Cape Verde', 'Cape Verde', 'Cape Verde'),
(40, 1, 40, 'CYM', 'KY', 'Cayman Islands', 'Cayman-Inseln', 'Cayman Islands', 'Cayman Islands', 'Cayman Islands'),
(41, 1, 41, 'CAF', 'CF', 'Central African Republic', 'Zentralafrikanische Republik', 'Central African Republic', 'Central African Republic', 'Central African Republic'),
(42, 1, 42, 'TCD', 'TD', 'Chad', 'Tschad', 'Chad', 'Chad', 'Chad'),
(43, 1, 43, 'CHL', 'CL', 'Chile', 'Chile', 'Chile', 'Chile', 'Chile'),
(44, 1, 44, 'CHN', 'CN', 'China', 'China', 'China', 'China', 'China'),
(45, 1, 45, 'CXR', 'CX', 'Christmas Island', 'Christmas Island', 'Christmas Island', 'Christmas Island', 'Christmas Island'),
(46, 1, 46, 'CCK', 'CC', 'Cocos (Keeling) Islands', 'Kokosinseln (Keeling)', 'Cocos (Keeling) Islands', 'Cocos (Keeling) Islands', 'Cocos (Keeling) Islands'),
(47, 1, 47, 'COL', 'CO', 'Colombia', 'Kolumbien', 'Colombia', 'Colombia', 'Colombia'),
(48, 1, 48, 'COM', 'KM', 'Comoros', 'Komoren', 'Comoros', 'Comoros', 'Comoros'),
(49, 1, 49, 'COG', 'CG', 'Congo', 'Kongo, Republik', 'Congo', 'Congo', 'Congo'),
(50, 1, 50, 'COK', 'CK', 'Cook Islands', 'Cookinseln', 'Cook Islands', 'Cook Islands', 'Cook Islands'),
(51, 1, 51, 'CRI', 'CR', 'Costa Rica', 'Costa Rica', 'Costa Rica', 'Costa Rica', 'Costa Rica'),
(52, 1, 52, 'CIV', 'CI', 'Cote D''Ivoire', 'Elfenbeinküste', 'Cote D''Ivoire', 'Cote D''Ivoire', 'Cote D''Ivoire'),
(53, 1, 53, 'HRV', 'HR', 'Croatia', 'Kroatien', 'Croatia', 'Croatia', 'Croatia'),
(54, 1, 54, 'CUB', 'CU', 'Cuba', 'Kuba', 'Cuba', 'Cuba', 'Cuba'),
(55, 1, 55, 'CYP', 'CY', 'Cyprus', 'Zypern', 'Cyprus', 'Cyprus', 'Cyprus'),
(56, 1, 56, 'CZE', 'CZ', 'Czech Republic', 'Tschechien', 'Czech Republic', 'Czech Republic', 'Czech Republic'),
(57, 1, 57, 'DNK', 'DK', 'Denmark', 'Dänemark', 'Denmark', 'Denmark', 'Denmark'),
(58, 1, 58, 'DJI', 'DJ', 'Djibouti', 'Dschibuti', 'Djibouti', 'Djibouti', 'Djibouti'),
(59, 1, 59, 'DMA', 'DM', 'Dominica', 'Dominica', 'Dominica', 'Dominica', 'Dominica'),
(60, 1, 60, 'DOM', 'DO', 'Dominican Republic', 'Dominikanische Republik', 'Dominican Republic', 'Dominican Republic', 'Dominican Republic'),
(61, 1, 61, 'TMP', 'TL', 'East Timor', 'Osttimor', 'East Timor', 'East Timor', 'East Timor'),
(62, 1, 62, 'ECU', 'EC', 'Ecuador', 'Ecuador', 'Ecuador', 'Ecuador', 'Ecuador'),
(63, 1, 63, 'EGY', 'EG', 'Egypt', 'Ägypten', 'Egypt', 'Egypt', 'Egypt'),
(64, 1, 64, 'SLV', 'SV', 'El Salvador', 'El Salvador', 'El Salvador', 'El Salvador', 'El Salvador'),
(65, 1, 65, 'GNQ', 'GQ', 'Equatorial Guinea', 'Äquatorial-Guinea', 'Equatorial Guinea', 'Equatorial Guinea', 'Equatorial Guinea'),
(66, 1, 66, 'ERI', 'ER', 'Eritrea', 'Eritrea', 'Eritrea', 'Eritrea', 'Eritrea'),
(67, 1, 67, 'EST', 'EE', 'Estonia', 'Estland', 'Estonia', 'Estonia', 'Estonia'),
(68, 1, 68, 'ETH', 'ET', 'Ethiopia', 'Äthiopien', 'Ethiopia', 'Ethiopia', 'Ethiopia'),
(69, 1, 69, 'FLK', 'FK', 'Falkland Islands (Malvinas)', 'Falklandinseln', 'Falkland Islands (Malvinas)', 'Falkland Islands (Malvinas)', 'Falkland Islands (Malvinas)'),
(70, 1, 70, 'FRO', 'FO', 'Faroe Islands', 'Färöer', 'Faroe Islands', 'Faroe Islands', 'Faroe Islands'),
(71, 1, 71, 'FJI', 'FJ', 'Fiji', 'Fidschi', 'Fiji', 'Fiji', 'Fiji'),
(72, 1, 72, 'FIN', 'FI', 'Finland', 'Finnland', 'Finland', 'Finland', 'Finland'),
(73, 1, 73, 'FRA', 'FR', 'France', 'Frankreich', 'France', 'France', 'France'),
(74, 1, 74, 'FXX', 'FX', 'France Metropolitan', 'Frankreich, Metropolitan', 'France Metropolitan', 'France Metropolitan', 'France Metropolitan'),
(75, 1, 75, 'GUF', 'GF', 'French Guiana', 'Französisch-Guyana', 'French Guiana', 'French Guiana', 'French Guiana'),
(76, 1, 76, 'PYF', 'PF', 'French Polynesia', 'Franz. Polynesien', 'French Polynesia', 'French Polynesia', 'French Polynesia'),
(77, 1, 77, 'ATF', 'TF', 'French Southern Territories', 'Französiche Süd- und Antarktisgebiete', 'French Southern Territories', 'French Southern Territories', 'French Southern Territories'),
(78, 1, 78, 'GAB', 'GA', 'Gabon', 'Gabun', 'Gabon', 'Gabon', 'Gabon'),
(79, 1, 79, 'GMB', 'GM', 'Gambia', 'Gambia', 'Gambia', 'Gambia', 'Gambia'),
(80, 1, 80, 'GEO', 'GE', 'Georgia', 'Georgien', 'Georgia', 'Georgia', 'Georgia'),
(81, 1, 81, 'DEU', 'DE', 'Germany', 'Deutschland', 'Germany', 'Germany', 'Germany'),
(82, 1, 82, 'GHA', 'GH', 'Ghana', 'Ghana', 'Ghana', 'Ghana', 'Ghana'),
(83, 1, 83, 'GIB', 'GI', 'Gibraltar', 'Gibraltar', 'Gibraltar', 'Gibraltar', 'Gibraltar'),
(84, 1, 84, 'GRC', 'GR', 'Greece', 'Griechenland', 'Greece', 'Greece', 'Greece'),
(85, 1, 85, 'GRL', 'GL', 'Greenland', 'Grönland', 'Greenland', 'Greenland', 'Greenland'),
(86, 1, 86, 'GRD', 'GD', 'Grenada', 'Grenada', 'Grenada', 'Grenada', 'Grenada'),
(87, 1, 87, 'GLP', 'GP', 'Guadeloupe', 'Guadeloupe', 'Guadeloupe', 'Guadeloupe', 'Guadeloupe'),
(88, 1, 88, 'GUM', 'GU', 'Guam', 'Guam', 'Guam', 'Guam', 'Guam'),
(89, 1, 89, 'GTM', 'GT', 'Guatemala', 'Guatemala', 'Guatemala', 'Guatemala', 'Guatemala'),
(90, 1, 90, 'GIN', 'GN', 'Guinea', 'Guinea', 'Guinea', 'Guinea', 'Guinea'),
(91, 1, 91, 'GNB', 'GW', 'Guinea-bissau', 'Guinea-Bissau', 'Guinea-bissau', 'Guinea-bissau', 'Guinea-bissau'),
(92, 1, 92, 'GUY', 'GY', 'Guyana', 'Guyana', 'Guyana', 'Guyana', 'Guyana'),
(93, 1, 93, 'HTI', 'HT', 'Haiti', 'Haiti', 'Haiti', 'Haiti', 'Haiti'),
(94, 1, 94, 'HMD', 'HM', 'Heard and Mc Donald Islands', 'Heard und McDonaldinseln', 'Heard and Mc Donald Islands', 'Heard and Mc Donald Islands', 'Heard and Mc Donald Islands'),
(95, 1, 95, 'HND', 'HN', 'Honduras', 'Honduras', 'Honduras', 'Honduras', 'Honduras'),
(96, 1, 96, 'HKG', 'HK', 'Hong Kong', 'Hong Kong', 'Hong Kong', 'Hong Kong', 'Hong Kong'),
(97, 1, 97, 'HUN', 'HU', 'Hungary', 'Ungarn', 'Hungary', 'Hungary', 'Hungary'),
(98, 1, 98, 'ISL', 'IS', 'Iceland', 'Island', 'Iceland', 'Iceland', 'Iceland'),
(99, 1, 99, 'IND', 'IN', 'India', 'Indien', 'India', 'India', 'India'),
(100, 1, 100, 'IDN', 'ID', 'Indonesia', 'Indonesien', 'Indonesia', 'Indonesia', 'Indonesia'),
(101, 1, 101, 'IRN', 'IR', 'Iran (Islamic Republic of)', 'Iran', 'Iran (Islamic Republic of)', 'Iran (Islamic Republic of)', 'Iran (Islamic Republic of)'),
(102, 1, 102, 'IRQ', 'IQ', 'Iraq', 'Irak', 'Iraq', 'Iraq', 'Iraq'),
(103, 1, 103, 'IRL', 'IE', 'Ireland', 'Irland', 'Ireland', 'Ireland', 'Ireland'),
(104, 1, 104, 'ISR', 'IL', 'Israel', 'Israel', 'Israel', 'Israel', 'Israel'),
(105, 1, 105, 'ITA', 'IT', 'Italy', 'Italien', 'Italy', 'Italy', 'Italy'),
(106, 1, 106, 'JAM', 'JM', 'Jamaica', 'Jamaika', 'Jamaica', 'Jamaica', 'Jamaica'),
(107, 1, 107, 'JPN', 'JP', 'Japan', 'Japan', 'Japan', 'Japan', 'Japan'),
(108, 1, 108, 'JOR', 'JO', 'Jordan', 'Jordanien', 'Jordan', 'Jordan', 'Jordan'),
(109, 1, 109, 'KAZ', 'KZ', 'Kazakhstan', 'Kasachstan', 'Kazakhstan', 'Kazakhstan', 'Kazakhstan'),
(110, 1, 110, 'KEN', 'KE', 'Kenya', 'Kenia', 'Kenya', 'Kenya', 'Kenya'),
(111, 1, 111, 'KIR', 'KI', 'Kiribati', 'Kiribati', 'Kiribati', 'Kiribati', 'Kiribati'),
(112, 1, 112, 'PRK', 'KP', 'Korea Democratic People''s Republic of', 'Korea Demokratische Volksrepublik', 'Korea Democratic People''s Republic of', 'Korea Democratic People''s Republic of', 'Korea Democratic People''s Republic of'),
(113, 1, 113, 'KOR', 'KR', 'Korea Republic of', 'Korea', 'Korea Republic of', 'Korea Republic of', 'Korea Republic of'),
(114, 1, 114, 'KWT', 'KW', 'Kuwait', 'Kuwait', 'Kuwait', 'Kuwait', 'Kuwait'),
(115, 1, 115, 'KGZ', 'KG', 'Kyrgyzstan', 'Kirgistan', 'Kyrgyzstan', 'Kyrgyzstan', 'Kyrgyzstan'),
(116, 1, 116, 'LAO', 'LA', 'Lao People''s Democratic Republic', 'Laos', 'Lao People''s Democratic Republic', 'Lao People''s Democratic Republic', 'Lao People''s Democratic Republic'),
(117, 1, 117, 'LVA', 'LV', 'Latvia', 'Lettland', 'Latvia', 'Latvia', 'Latvia'),
(118, 1, 118, 'LBN', 'LB', 'Lebanon', 'Libanon', 'Lebanon', 'Lebanon', 'Lebanon'),
(119, 1, 119, 'LSO', 'LS', 'Lesotho', 'Lesotho', 'Lesotho', 'Lesotho', 'Lesotho'),
(120, 1, 120, 'LBR', 'LR', 'Liberia', 'Liberia', 'Liberia', 'Liberia', 'Liberia'),
(121, 1, 121, 'LBY', 'LY', 'Libyan Arab Jamahiriya', 'Libyen', 'Libyan Arab Jamahiriya', 'Libyan Arab Jamahiriya', 'Libyan Arab Jamahiriya'),
(122, 1, 122, 'LIE', 'LI', 'Liechtenstein', 'Liechtenstein', 'Liechtenstein', 'Liechtenstein', 'Liechtenstein'),
(123, 1, 123, 'LTU', 'LT', 'Lithuania', 'Litauen', 'Lithuania', 'Lithuania', 'Lithuania'),
(124, 1, 124, 'LUX', 'LU', 'Luxembourg', 'Luxemburg', 'Luxembourg', 'Luxembourg', 'Luxembourg'),
(125, 1, 125, 'MAC', 'MO', 'Macau', 'Makao', 'Macau', 'Macau', 'Macau'),
(126, 1, 126, 'MKD', 'MK', 'Macedonia The Former Yugoslav Republic of', 'Mazedonien', 'Macedonia The Former Yugoslav Republic of', 'Macedonia The Former Yugoslav Republic of', 'Macedonia The Former Yugoslav Republic of'),
(127, 1, 127, 'MDG', 'MG', 'Madagascar', 'Madagaskar', 'Madagascar', 'Madagascar', 'Madagascar'),
(128, 1, 128, 'MWI', 'MW', 'Malawi', 'Malawi', 'Malawi', 'Malawi', 'Malawi'),
(129, 1, 129, 'MYS', 'MY', 'Malaysia', 'Malaysia', 'Malaysia', 'Malaysia', 'Malaysia'),
(130, 1, 130, 'MDV', 'MV', 'Maldives', 'Malediven', 'Maldives', 'Maldives', 'Maldives'),
(131, 1, 131, 'MLI', 'ML', 'Mali', 'Mali', 'Mali', 'Mali', 'Mali'),
(132, 1, 132, 'MLT', 'MT', 'Malta', 'Malta', 'Malta', 'Malta', 'Malta'),
(133, 1, 133, 'MHL', 'MH', 'Marshall Islands', 'Marshallinseln', 'Marshall Islands', 'Marshall Islands', 'Marshall Islands'),
(134, 1, 134, 'MTQ', 'MQ', 'Martinique', 'Martinique', 'Martinique', 'Martinique', 'Martinique'),
(135, 1, 135, 'MRT', 'MR', 'Mauritania', 'Mauretanien', 'Mauritania', 'Mauritania', 'Mauritania'),
(136, 1, 136, 'MUS', 'MU', 'Mauritius', 'Mauritius', 'Mauritius', 'Mauritius', 'Mauritius'),
(137, 1, 137, 'MYT', 'YT', 'Mayotte', 'Mayott', 'Mayotte', 'Mayotte', 'Mayotte'),
(138, 1, 138, 'MEX', 'MX', 'Mexico', 'Mexiko', 'Mexico', 'Mexico', 'Mexico'),
(139, 1, 139, 'FSM', 'FM', 'Micronesia Federated States of', 'Mikronesien', 'Micronesia Federated States of', 'Micronesia Federated States of', 'Micronesia Federated States of'),
(140, 1, 140, 'MDA', 'MD', 'Moldova Republic of', 'Moldawien', 'Moldova Republic of', 'Moldova Republic of', 'Moldova Republic of'),
(141, 1, 141, 'MCO', 'MC', 'Monaco', 'Monaco', 'Monaco', 'Monaco', 'Monaco'),
(142, 1, 142, 'MNG', 'MN', 'Mongolia', 'Mongolei', 'Mongolia', 'Mongolia', 'Mongolia'),
(143, 1, 143, 'MSR', 'MS', 'Montserrat', 'Montserrat', 'Montserrat', 'Montserrat', 'Montserrat'),
(144, 1, 144, 'MAR', 'MA', 'Morocco', 'Marokko', 'Morocco', 'Morocco', 'Morocco'),
(145, 1, 145, 'MOZ', 'MZ', 'Mozambique', 'Mosambik', 'Mozambique', 'Mozambique', 'Mozambique'),
(146, 1, 146, 'MMR', 'MM', 'Myanmar', 'Myanmar', 'Myanmar', 'Myanmar', 'Myanmar'),
(147, 1, 147, 'NAM', 'NA', 'Namibia', 'Namibia', 'Namibia', 'Namibia', 'Namibia'),
(148, 1, 148, 'NRU', 'NR', 'Nauru', 'Nauru', 'Nauru', 'Nauru', 'Nauru'),
(149, 1, 149, 'NPL', 'NP', 'Nepal', 'Nepal', 'Nepal', 'Nepal', 'Nepal'),
(150, 1, 150, 'NLD', 'NL', 'Netherlands', 'Niederlande', 'Netherlands', 'Netherlands', 'Netherlands'),
(151, 1, 151, 'ANT', 'AN', 'Netherlands Antilles', 'Niederländisch-Antillen', 'Netherlands Antilles', 'Netherlands Antilles', 'Netherlands Antilles'),
(152, 1, 152, 'NCL', 'NC', 'New Caledonia', 'Neukaledonien', 'New Caledonia', 'New Caledonia', 'New Caledonia'),
(153, 1, 153, 'NZL', 'NZ', 'New Zealand', 'Neuseeland', 'New Zealand', 'New Zealand', 'New Zealand'),
(154, 1, 154, 'NIC', 'NI', 'Nicaragua', 'Nicaragua', 'Nicaragua', 'Nicaragua', 'Nicaragua'),
(155, 1, 155, 'NER', 'NE', 'Niger', 'Niger', 'Niger', 'Niger', 'Niger'),
(156, 1, 156, 'NGA', 'NG', 'Nigeria', 'Nigeria', 'Nigeria', 'Nigeria', 'Nigeria'),
(157, 1, 157, 'NIU', 'NU', 'Niue', 'Niue', 'Niue', 'Niue', 'Niue'),
(158, 1, 158, 'NFK', 'NF', 'Norfolk Island', 'Norfolkinsel', 'Norfolk Island', 'Norfolk Island', 'Norfolk Island'),
(159, 1, 159, 'MNP', 'MP', 'Northern Mariana Islands', 'Nördliche Marianen', 'Northern Mariana Islands', 'Northern Mariana Islands', 'Northern Mariana Islands'),
(160, 1, 160, 'NOR', 'NO', 'Norway', 'Norwegen', 'Norway', 'Norway', 'Norway'),
(161, 1, 161, 'OMN', 'OM', 'Oman', 'Oman', 'Oman', 'Oman', 'Oman'),
(162, 1, 162, 'PAK', 'PK', 'Pakistan', 'Pakistan', 'Pakistan', 'Pakistan', 'Pakistan'),
(163, 1, 163, 'PLW', 'PW', 'Palau', 'Palau', 'Palau', 'Palau', 'Palau'),
(164, 1, 164, 'PAN', 'PA', 'Panama', 'Panama', 'Panama', 'Panama', 'Panama'),
(165, 1, 165, 'PNG', 'PG', 'Papua New Guinea', 'Papua-Neuguinea', 'Papua New Guinea', 'Papua New Guinea', 'Papua New Guinea'),
(166, 1, 166, 'PRY', 'PY', 'Paraguay', 'Paraguay', 'Paraguay', 'Paraguay', 'Paraguay'),
(167, 1, 167, 'PER', 'PE', 'Peru', 'Peru', 'Peru', 'Peru', 'Peru'),
(168, 1, 168, 'PHL', 'PH', 'Philippines', 'Philippinen', 'Philippines', 'Philippines', 'Philippines'),
(169, 1, 169, 'PCN', 'PN', 'Pitcairn', 'Pitcairn', 'Pitcairn', 'Pitcairn', 'Pitcairn'),
(170, 1, 170, 'POL', 'PL', 'Poland', 'Polen', 'Poland', 'Poland', 'Poland'),
(171, 1, 171, 'PRT', 'PT', 'Portugal', 'Portugal', 'Portugal', 'Portugal', 'Portugal'),
(172, 1, 172, 'PRI', 'PR', 'Puerto Rico', 'Puerto Rico', 'Puerto Rico', 'Puerto Rico', 'Puerto Rico'),
(173, 1, 173, 'QAT', 'QA', 'Qatar', 'Katar', 'Qatar', 'Qatar', 'Qatar'),
(174, 1, 174, 'REU', 'RE', 'Reunion', 'Reunion', 'Reunion', 'Reunion', 'Reunion'),
(175, 1, 175, 'ROM', 'RO', 'Romania', 'Rumänien', 'Romania', 'Romania', 'Romania'),
(176, 1, 176, 'RUS', 'RU', 'Russian Federation', 'Russische Föderation', 'Russian Federation', 'Russian Federation', 'Russian Federation'),
(177, 1, 177, 'RWA', 'RW', 'Rwanda', 'Ruanda', 'Rwanda', 'Rwanda', 'Rwanda'),
(178, 1, 178, 'KNA', 'KN', 'Saint Kitts and Nevis', 'St. Kitts und Nevis', 'Saint Kitts and Nevis', 'Saint Kitts and Nevis', 'Saint Kitts and Nevis'),
(179, 1, 179, 'LCA', 'LC', 'Saint Lucia', 'St. Lucia', 'Saint Lucia', 'Saint Lucia', 'Saint Lucia'),
(180, 1, 180, 'VCT', 'VC', 'Saint Vincent and the Grenadines', 'St. Vincent und die Grenadinen', 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines'),
(181, 1, 181, 'WSM', 'WS', 'Samoa', 'Samoa', 'Samoa', 'Samoa', 'Samoa'),
(182, 1, 182, 'SMR', 'SM', 'San Marino', 'San Marino', 'San Marino', 'San Marino', 'San Marino'),
(183, 1, 183, 'STP', 'ST', 'Sao Tome and Principe', 'Sao Tomé und Príncipe', 'Sao Tome and Principe', 'Sao Tome and Principe', 'Sao Tome and Principe'),
(184, 1, 184, 'SAU', 'SA', 'Saudi Arabia', 'Saudi-Arabien', 'Saudi Arabia', 'Saudi Arabia', 'Saudi Arabia'),
(185, 1, 185, 'SEN', 'SN', 'Senegal', 'Senegal', 'Senegal', 'Senegal', 'Senegal'),
(186, 1, 186, 'SYC', 'SC', 'Seychelles', 'Seychellen', 'Seychelles', 'Seychelles', 'Seychelles'),
(187, 1, 187, 'SLE', 'SL', 'Sierra Leone', 'Sierra Leone', 'Sierra Leone', 'Sierra Leone', 'Sierra Leone'),
(188, 1, 188, 'SGP', 'SG', 'Singapore', 'Singapur', 'Singapore', 'Singapore', 'Singapore'),
(189, 1, 189, 'SVK', 'SK', 'Slovakia (Slovak Republic)', 'Slowakei', 'Slovakia (Slovak Republic)', 'Slovakia (Slovak Republic)', 'Slovakia (Slovak Republic)'),
(190, 1, 190, 'SVN', 'SI', 'Slovenia', 'Slowenien', 'Slovenia', 'Slovenia', 'Slovenia'),
(191, 1, 191, 'SLB', 'SB', 'Solomon Islands', 'Salomonen', 'Solomon Islands', 'Solomon Islands', 'Solomon Islands'),
(192, 1, 192, 'SOM', 'SO', 'Somalia', 'Somalia', 'Somalia', 'Somalia', 'Somalia'),
(193, 1, 193, 'ZAF', 'ZA', 'South Africa', 'Republik Südafrika', 'South Africa', 'South Africa', 'South Africa'),
(194, 1, 194, 'SGS', 'GS', 'South Georgia and the South Sandwich Islands', 'Südgeorgien und die Südlichen Sandwichinseln', 'South Georgia and the South Sandwich Islands', 'South Georgia and the South Sandwich Islands', 'South Georgia and the South Sandwich Islands'),
(195, 1, 195, 'ESP', 'ES', 'Spain', 'Spanien', 'Spain', 'Spain', 'Spain'),
(196, 1, 196, 'LKA', 'LK', 'Sri Lanka', 'Sri Lanka', 'Sri Lanka', 'Sri Lanka', 'Sri Lanka'),
(197, 1, 197, 'SHN', 'SH', 'St. Helena', 'St. Helena', 'St. Helena', 'St. Helena', 'St. Helena'),
(198, 1, 198, 'SPM', 'PM', 'St. Pierre and Miquelon', 'St. Pierre und Miquelon', 'St. Pierre and Miquelon', 'St. Pierre and Miquelon', 'St. Pierre and Miquelon'),
(199, 1, 199, 'SDN', 'SD', 'Sudan', 'Sudan', 'Sudan', 'Sudan', 'Sudan'),
(200, 1, 200, 'SUR', 'SR', 'Suriname', 'Suriname', 'Suriname', 'Suriname', 'Suriname'),
(201, 1, 201, 'SJM', 'SJ', 'Svalbard and Jan Mayen Islands', 'Svalbard und Jan Mayen', 'Svalbard and Jan Mayen Islands', 'Svalbard and Jan Mayen Islands', 'Svalbard and Jan Mayen Islands'),
(202, 1, 202, 'SWZ', 'SZ', 'Swaziland', 'Swasiland', 'Swaziland', 'Swaziland', 'Swaziland'),
(203, 1, 203, 'SWE', 'SE', 'Sweden', 'Schweden', 'Sweden', 'Sweden', 'Sweden'),
(204, 1, 204, 'CHE', 'CH', 'Switzerland', 'Schweiz', 'Switzerland', 'Switzerland', 'Switzerland'),
(205, 1, 205, 'SYR', 'SY', 'Syrian Arab Republic', 'Syrien', 'Syrian Arab Republic', 'Syrian Arab Republic', 'Syrian Arab Republic'),
(206, 1, 206, 'TWN', 'TW', 'Taiwan', 'Taiwan', 'Taiwan', 'Taiwan', 'Taiwan'),
(207, 1, 207, 'TJK', 'TJ', 'Tajikistan', 'Tadschikistan', 'Tajikistan', 'Tajikistan', 'Tajikistan'),
(208, 1, 208, 'TZA', 'TZ', 'Tanzania United Republic of', 'Tansania', 'Tanzania United Republic of', 'Tanzania United Republic of', 'Tanzania United Republic of'),
(209, 1, 209, 'THA', 'TH', 'Thailand', 'Thailand', 'Thailand', 'Thailand', 'Thailand'),
(210, 1, 210, 'TGO', 'TG', 'Togo', 'Togo', 'Togo', 'Togo', 'Togo'),
(211, 1, 211, 'TKL', 'TK', 'Tokelau', 'Tokelau', 'Tokelau', 'Tokelau', 'Tokelau'),
(212, 1, 212, 'TON', 'TO', 'Tonga', 'Tonga', 'Tonga', 'Tonga', 'Tonga'),
(213, 1, 213, 'TTO', 'TT', 'Trinidad and Tobago', 'Trinidad und Tobago', 'Trinidad and Tobago', 'Trinidad and Tobago', 'Trinidad and Tobago'),
(214, 1, 214, 'TUN', 'TN', 'Tunisia', 'Tunesien', 'Tunisia', 'Tunisia', 'Tunisia'),
(215, 1, 215, 'TUR', 'TR', 'Turkey', 'Türkei', 'Turkey', 'Turkey', 'Turkey'),
(216, 1, 216, 'TKM', 'TM', 'Turkmenistan', 'Turkmenistan', 'Turkmenistan', 'Turkmenistan', 'Turkmenistan'),
(217, 1, 217, 'TCA', 'TC', 'Turks and Caicos Islands', 'Turks- und Caicosinseln', 'Turks and Caicos Islands', 'Turks and Caicos Islands', 'Turks and Caicos Islands'),
(218, 1, 218, 'TUV', 'TV', 'Tuvalu', 'Tuvalu', 'Tuvalu', 'Tuvalu', 'Tuvalu'),
(219, 1, 219, 'UGA', 'UG', 'Uganda', 'Uganda', 'Uganda', 'Uganda', 'Uganda'),
(220, 1, 220, 'UKR', 'UA', 'Ukraine', 'Ukraine', 'Ukraine', 'Ukraine', 'Ukraine'),
(221, 1, 221, 'ARE', 'AE', 'United Arab Emirates', 'Vereinigte Arabische Emirate', 'United Arab Emirates', 'United Arab Emirates', 'United Arab Emirates'),
(222, 1, 222, 'GBR', 'GB', 'United Kingdom', 'Vereinigtes Königreich', 'United Kingdom', 'United Kingdom', 'United Kingdom'),
(223, 1, 223, 'USA', 'US', 'United States', 'USA', 'United States', 'United States', 'United States'),
(224, 1, 224, 'UMI', 'UM', 'United States Minor Outlying Islands', 'United States Minor Outlying Islands', 'United States Minor Outlying Islands', 'United States Minor Outlying Islands', 'United States Minor Outlying Islands'),
(225, 1, 225, 'URY', 'UY', 'Uruguay', 'Uruguay', 'Uruguay', 'Uruguay', 'Uruguay'),
(226, 1, 226, 'UZB', 'UZ', 'Uzbekistan', 'Usbekistan', 'Uzbekistan', 'Uzbekistan', 'Uzbekistan'),
(227, 1, 227, 'VUT', 'VU', 'Vanuatu', 'Vanuatu', 'Vanuatu', 'Vanuatu', 'Vanuatu'),
(228, 1, 228, 'VAT', 'VA', 'Vatican City State (Holy See)', 'Vatikanstadt', 'Vatican City State (Holy See)', 'Vatican City State (Holy See)', 'Vatican City State (Holy See)'),
(229, 1, 229, 'VEN', 'VE', 'Venezuela', 'Venezuela', 'Venezuela', 'Venezuela', 'Venezuela'),
(230, 1, 230, 'VNM', 'VN', 'Viet Nam', 'Vietnam', 'Viet Nam', 'Viet Nam', 'Viet Nam'),
(231, 1, 231, 'VGB', 'VG', 'Virgin Islands (British)', 'Britische Jungferninseln', 'Virgin Islands (British)', 'Virgin Islands (British)', 'Virgin Islands (British)'),
(232, 1, 232, 'VIR', 'VI', 'Virgin Islands (U.S.)', 'Vereinigte Staaten von Amerika', 'Virgin Islands (U.S.)', 'Virgin Islands (U.S.)', 'Virgin Islands (U.S.)'),
(233, 1, 233, 'WLF', 'WF', 'Wallis and Futuna Islands', 'Wallis und Futuna', 'Wallis and Futuna Islands', 'Wallis and Futuna Islands', 'Wallis and Futuna Islands'),
(234, 1, 234, 'ESH', 'EH', 'Western Sahara', 'Westsahara', 'Western Sahara', 'Western Sahara', 'Western Sahara'),
(235, 1, 235, 'YEM', 'YE', 'Yemen', 'Jemen', 'Yemen', 'Yemen', 'Yemen'),
(236, 1, 236, 'YUG', 'YU', 'Yugoslavia', 'Yugoslavia', 'Yugoslavia', 'Yugoslavia', 'Yugoslavia'),
(237, 1, 237, 'ZAR', 'ZR', 'Zaire', 'Zaire', 'Zaire', 'Zaire', 'Zaire'),
(238, 1, 238, 'ZMB', 'ZM', 'Zambia', 'Sambia', 'Zambia', 'Zambia', 'Zambia'),
(239, 1, 239, 'ZWE', 'ZW', 'Zimbabwe', 'Simbabwe', 'Zimbabwe', 'Zimbabwe', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_coupons`
--

DROP TABLE IF EXISTS `#__jshopping_coupons`;
CREATE TABLE IF NOT EXISTS `#__jshopping_coupons` (
  `coupon_id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'value_or_percent',
  `coupon_code` varchar(100) NOT NULL DEFAULT '',
  `coupon_value` decimal(12,2) NOT NULL DEFAULT '0.00',
  `tax_id` int(11) NOT NULL,
  `used` int(11) NOT NULL,
  `for_user_id` int(11) NOT NULL,
  `coupon_start_date` date NOT NULL DEFAULT '0000-00-00',
  `coupon_expire_date` date NOT NULL DEFAULT '0000-00-00',
  `finished_after_used` int(11) NOT NULL,
  `coupon_publish` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`coupon_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__jshopping_coupons`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_currencies`
--

DROP TABLE IF EXISTS `#__jshopping_currencies`;
CREATE TABLE IF NOT EXISTS `#__jshopping_currencies` (
  `currency_id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(64) NOT NULL DEFAULT '',
  `currency_code` varchar(20) NOT NULL DEFAULT '',
  `currency_code_iso` varchar(3) NOT NULL DEFAULT '',
  `currency_ordering` int(11) NOT NULL DEFAULT '0',
  `currency_value` decimal(14,6) NOT NULL DEFAULT '0.000000',
  `currency_publish` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`currency_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `#__jshopping_currencies`
--

INSERT INTO `#__jshopping_currencies` (`currency_id`, `currency_name`, `currency_code`, `currency_code_iso`, `currency_ordering`, `currency_value`, `currency_publish`) VALUES
(1, 'Euro', 'EUR', 'EUR', 1, '1.000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_delivery_times`
--

DROP TABLE IF EXISTS `#__jshopping_delivery_times`;
CREATE TABLE IF NOT EXISTS `#__jshopping_delivery_times` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en-GB` varchar(255) NOT NULL,
  `name_de-DE` varchar(255) NOT NULL,
  `name_nl-NL` varchar(255) NOT NULL,
  `name_ru-RU` varchar(255) NOT NULL,
  `name_sv-SE` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__jshopping_delivery_times`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_free_attr`
--

DROP TABLE IF EXISTS `#__jshopping_free_attr`;
CREATE TABLE IF NOT EXISTS `#__jshopping_free_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ordering` int(11) NOT NULL,
  `required` tinyint(1) NOT NULL,
  `name_en-GB` varchar(255) NOT NULL,
  `name_de-DE` varchar(255) NOT NULL,
  `name_nl-NL` varchar(255) NOT NULL,
  `name_ru-RU` varchar(255) NOT NULL,
  `name_sv-SE` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__jshopping_free_attr`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_import_export`
--

DROP TABLE IF EXISTS `#__jshopping_import_export`;
CREATE TABLE IF NOT EXISTS `#__jshopping_import_export` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `params` text NOT NULL,
  `endstart` int(11) NOT NULL,
  `steptime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `#__jshopping_import_export`
--

INSERT INTO `#__jshopping_import_export` (`id`, `name`, `alias`, `description`, `params`, `endstart`, `steptime`) VALUES
(1, 'Simple Export', 'simpleexport', 'Simple Export in CSV iso-8859-1', 'filename=export', 0, 1),
(2, 'Simple Import', 'simpleimport', 'Simple Import in CSV iso-8859-1', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_languages`
--

DROP TABLE IF EXISTS `#__jshopping_languages`;
CREATE TABLE IF NOT EXISTS `#__jshopping_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(32) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `publish` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `#__jshopping_languages`
--

INSERT INTO `#__jshopping_languages` (`id`, `language`, `name`, `publish`, `ordering`) VALUES
(1, 'en-GB', 'English', 1, 0),
(2, 'de-DE', 'German', 1, 0),
(3, 'nl-NL', 'Dutch', 1, 0),
(4, 'ru-RU', 'Russian', 1, 0),
(5, 'sv-SE', 'Svenska', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_manufacturers`
--

DROP TABLE IF EXISTS `#__jshopping_manufacturers`;
CREATE TABLE IF NOT EXISTS `#__jshopping_manufacturers` (
  `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_url` varchar(255) NOT NULL,
  `manufacturer_logo` varchar(255) NOT NULL,
  `manufacturer_publish` tinyint(1) NOT NULL,
  `products_page` int(11) NOT NULL,
  `products_row` int(11) NOT NULL,
  `ordering` int(6) NOT NULL,
  `name_en-GB` varchar(255) NOT NULL,
  `alias_en-GB` varchar(255) NOT NULL,
  `short_description_en-GB` text NOT NULL,
  `description_en-GB` text NOT NULL,
  `meta_title_en-GB` varchar(255) NOT NULL,
  `meta_description_en-GB` text NOT NULL,
  `meta_keyword_en-GB` text NOT NULL,
  `name_de-DE` varchar(255) NOT NULL,
  `alias_de-DE` varchar(255) NOT NULL,
  `short_description_de-DE` text NOT NULL,
  `description_de-DE` text NOT NULL,
  `meta_title_de-DE` varchar(255) NOT NULL,
  `meta_description_de-DE` text NOT NULL,
  `meta_keyword_de-DE` text NOT NULL,
  `name_nl-NL` varchar(255) NOT NULL,
  `alias_nl-NL` varchar(255) NOT NULL,
  `short_description_nl-NL` text NOT NULL,
  `description_nl-NL` text NOT NULL,
  `meta_title_nl-NL` varchar(255) NOT NULL,
  `meta_description_nl-NL` text NOT NULL,
  `meta_keyword_nl-NL` text NOT NULL,
  `name_ru-RU` varchar(255) NOT NULL,
  `alias_ru-RU` varchar(255) NOT NULL,
  `short_description_ru-RU` text NOT NULL,
  `description_ru-RU` text NOT NULL,
  `meta_title_ru-RU` varchar(255) NOT NULL,
  `meta_description_ru-RU` text NOT NULL,
  `meta_keyword_ru-RU` text NOT NULL,
  `name_sv-SE` varchar(255) NOT NULL,
  `alias_sv-SE` varchar(255) NOT NULL,
  `short_description_sv-SE` text NOT NULL,
  `description_sv-SE` text NOT NULL,
  `meta_title_sv-SE` varchar(255) NOT NULL,
  `meta_description_sv-SE` text NOT NULL,
  `meta_keyword_sv-SE` text NOT NULL,
  PRIMARY KEY (`manufacturer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `#__jshopping_manufacturers`
--

INSERT INTO `#__jshopping_manufacturers` (`manufacturer_id`, `manufacturer_url`, `manufacturer_logo`, `manufacturer_publish`, `products_page`, `products_row`, `ordering`, `name_en-GB`, `alias_en-GB`, `short_description_en-GB`, `description_en-GB`, `meta_title_en-GB`, `meta_description_en-GB`, `meta_keyword_en-GB`, `name_de-DE`, `alias_de-DE`, `short_description_de-DE`, `description_de-DE`, `meta_title_de-DE`, `meta_description_de-DE`, `meta_keyword_de-DE`, `name_nl-NL`, `alias_nl-NL`, `short_description_nl-NL`, `description_nl-NL`, `meta_title_nl-NL`, `meta_description_nl-NL`, `meta_keyword_nl-NL`, `name_ru-RU`, `alias_ru-RU`, `short_description_ru-RU`, `description_ru-RU`, `meta_title_ru-RU`, `meta_description_ru-RU`, `meta_keyword_ru-RU`, `name_sv-SE`, `alias_sv-SE`, `short_description_sv-SE`, `description_sv-SE`, `meta_title_sv-SE`, `meta_description_sv-SE`, `meta_keyword_sv-SE`) VALUES
(1, 'www.domain.com', '', 1, 12, 3, 1, 'Manufactor 1', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tristique, ligula ut pellentesque pretium, tellus dui semper nunc.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tristique, ligula ut pellentesque pretium, tellus dui semper nunc.</p>', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_orders`
--

DROP TABLE IF EXISTS `#__jshopping_orders`;
CREATE TABLE IF NOT EXISTS `#__jshopping_orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_number` varchar(50) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `order_total` decimal(12,2) NOT NULL DEFAULT '0.00',
  `order_subtotal` decimal(12,2) NOT NULL DEFAULT '0.00',
  `order_tax` decimal(12,2) NOT NULL DEFAULT '0.00',
  `order_tax_ext` text NOT NULL,
  `order_shipping` decimal(12,2) NOT NULL DEFAULT '0.00',
  `order_payment` decimal(12,2) NOT NULL DEFAULT '0.00',
  `order_discount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `currency_code` varchar(20) NOT NULL DEFAULT '',
  `currency_code_iso` varchar(3) NOT NULL DEFAULT '',
  `currency_exchange` decimal(14,6) NOT NULL DEFAULT '0.000000',
  `order_status` varchar(1) NOT NULL DEFAULT '',
  `order_created` tinyint(1) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `order_m_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `shipping_method_id` int(11) NOT NULL DEFAULT '0',
  `payment_method_id` int(11) NOT NULL DEFAULT '0',
  `payment_params` text NOT NULL,
  `payment_params_data` text NOT NULL,
  `ip_address` varchar(15) NOT NULL DEFAULT '',
  `order_add_info` text NOT NULL,
  `title` tinyint(1) NOT NULL DEFAULT '0',
  `f_name` varchar(255) NOT NULL DEFAULT '',
  `l_name` varchar(255) NOT NULL DEFAULT '',
  `firma_name` varchar(255) NOT NULL DEFAULT '',
  `client_type` tinyint(1) NOT NULL,
  `client_type_name` varchar(100) NOT NULL,
  `firma_code` varchar(100) NOT NULL,
  `tax_number` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `street` varchar(100) NOT NULL DEFAULT '',
  `zip` varchar(20) NOT NULL DEFAULT '',
  `city` varchar(100) NOT NULL DEFAULT '',
  `state` varchar(100) NOT NULL DEFAULT '',
  `country` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL DEFAULT '',
  `mobil_phone` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL DEFAULT '',
  `ext_field_1` varchar(255) NOT NULL,
  `ext_field_2` varchar(255) NOT NULL,
  `ext_field_3` varchar(255) NOT NULL,
  `d_title` tinyint(1) NOT NULL DEFAULT '0',
  `d_f_name` varchar(255) NOT NULL DEFAULT '',
  `d_l_name` varchar(255) NOT NULL DEFAULT '',
  `d_firma_name` varchar(255) NOT NULL DEFAULT '',
  `d_email` varchar(255) NOT NULL DEFAULT '',
  `d_street` varchar(100) NOT NULL DEFAULT '',
  `d_zip` varchar(20) NOT NULL DEFAULT '',
  `d_city` varchar(100) NOT NULL DEFAULT '',
  `d_state` varchar(100) NOT NULL DEFAULT '',
  `d_country` int(11) NOT NULL,
  `d_phone` varchar(30) NOT NULL DEFAULT '',
  `d_mobil_phone` varchar(20) NOT NULL,
  `d_fax` varchar(20) NOT NULL DEFAULT '',
  `d_ext_field_1` varchar(255) NOT NULL,
  `d_ext_field_2` varchar(255) NOT NULL,
  `d_ext_field_3` varchar(255) NOT NULL,
  `pdf_file` varchar(50) NOT NULL,
  `order_hash` varchar(32) NOT NULL DEFAULT '',
  `file_hash` varchar(64) NOT NULL DEFAULT '',
  `file_stat_downloads` text NOT NULL,
  `order_custom_info` text NOT NULL,
  `display_price` tinyint(1) NOT NULL,
  `vendor_type` tinyint(1) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `lang` varchar(16) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `#__jshopping_orders`
--

INSERT INTO `#__jshopping_orders` (`order_id`, `order_number`, `user_id`, `order_total`, `order_subtotal`, `order_tax`, `order_tax_ext`, `order_shipping`, `order_payment`, `order_discount`, `currency_code`, `currency_code_iso`, `currency_exchange`, `order_status`, `order_created`, `order_date`, `order_m_date`, `shipping_method_id`, `payment_method_id`, `payment_params`, `payment_params_data`, `ip_address`, `order_add_info`, `title`, `f_name`, `l_name`, `firma_name`, `client_type`, `client_type_name`, `firma_code`, `tax_number`, `email`, `street`, `zip`, `city`, `state`, `country`, `phone`, `mobil_phone`, `fax`, `ext_field_1`, `ext_field_2`, `ext_field_3`, `d_title`, `d_f_name`, `d_l_name`, `d_firma_name`, `d_email`, `d_street`, `d_zip`, `d_city`, `d_state`, `d_country`, `d_phone`, `d_mobil_phone`, `d_fax`, `d_ext_field_1`, `d_ext_field_2`, `d_ext_field_3`, `pdf_file`, `order_hash`, `file_hash`, `file_stat_downloads`, `order_custom_info`, `display_price`, `vendor_type`, `vendor_id`, `lang`) VALUES
(1, '00000001', 42, '8194.00', '8180.00', '1308.29', 'a:1:{s:5:"19.00";d:1308.28571428571422075037844479084014892578125;}', '10.00', '4.00', '0.00', 'EUR', 'EUR', '1.000000', '1', 1, '2011-08-06 10:35:24', '2011-08-06 10:35:24', 1, 1, '', '', '127.0.0.1', '', 1, 'Alvin', 'Konda', '', 0, '', '', '', 'info@icetheme.com', 'Test', 'test', 'Tirane', '', 2, '00355692022000', '', '', '', '', '', 1, 'Alvin', 'Konda', '', 'info@icetheme.com', 'Test', 'test', 'Tirane', '', 2, '00355692022000', '', '', '', '', '', '1_3d08a6359f61bf07c0c21a84a75dc438.pdf', '927a1042708ef5f39bbf1aedbbd9e48a', '541c74f49a13564789821f8fd4cbb781', '', '', 0, 0, 0, 'en-GB'),
(2, '00000002', 43, '1349.00', '1320.00', '215.39', 'a:1:{s:5:"19.00";d:215.386554621848773649617214687168598175048828125;}', '25.00', '4.00', '0.00', 'EUR', 'EUR', '1.000000', '1', 1, '2011-08-12 09:28:52', '2011-08-12 09:28:52', 2, 1, '', '', '127.0.0.1', '', 1, 'Alvin', 'Konda', 'IceTheme', 0, '', '', '', 'alvin.konda@icetheme.com', 'Test', '00355', 'Tirana', '', 2, '00355692022008', '', '', '', '', '', 1, 'Alvin', 'Konda', 'IceTheme', 'alvin.konda@icetheme.com', 'Test', '00355', 'Tirana', '', 2, '00355692022008', '', '', '', '', '', '2_fea582287a60da95f351e9e1fed7cc7d.pdf', '0a4ec735710302ff2f839d4e5e8f3b0c', 'f294c6582853fc9e64fd198a1e166466', '', '', 0, 0, 0, 'en-GB'),
(3, '00000003', 43, '1585.00', '1560.00', '253.07', 'a:1:{s:5:"19.00";d:253.067226890756302282170508988201618194580078125;}', '25.00', '0.00', '0.00', 'EUR', 'EUR', '1.000000', '1', 0, '2011-08-12 13:18:11', '2011-08-12 13:18:11', 2, 3, '', '', '127.0.0.1', 'Testing', 1, 'Alvin', 'Konda', 'IceTheme', 0, '', '', '', 'alvin.konda@icetheme.com', 'Test', '00355', 'Tirana', '', 2, '00355692022008', '', '', '', '', '', 1, 'Alvin', 'Konda', 'IceTheme', 'alvin.konda@icetheme.com', 'Test', '00355', 'Tirana', '', 2, '00355692022008', '', '', '', '', '', '', '4fe97e940a722e78219e1f34c03c0c07', '456f859e39a4fc427b06eec28cb85eac', '', '', 0, 0, 0, 'en-GB');

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_order_history`
--

DROP TABLE IF EXISTS `#__jshopping_order_history`;
CREATE TABLE IF NOT EXISTS `#__jshopping_order_history` (
  `order_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `order_status_id` tinyint(1) NOT NULL DEFAULT '0',
  `status_date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `customer_notify` int(1) DEFAULT '0',
  `comments` text,
  PRIMARY KEY (`order_history_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `#__jshopping_order_history`
--

INSERT INTO `#__jshopping_order_history` (`order_history_id`, `order_id`, `order_status_id`, `status_date_added`, `customer_notify`, `comments`) VALUES
(1, 1, 1, '2011-08-06 10:35:24', 1, NULL),
(2, 2, 1, '2011-08-12 09:28:52', 1, NULL),
(3, 3, 1, '2011-08-12 13:18:11', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_order_item`
--

DROP TABLE IF EXISTS `#__jshopping_order_item`;
CREATE TABLE IF NOT EXISTS `#__jshopping_order_item` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `product_ean` varchar(50) NOT NULL DEFAULT '',
  `product_name` varchar(100) NOT NULL DEFAULT '',
  `product_quantity` int(11) NOT NULL DEFAULT '0',
  `product_item_price` decimal(12,2) NOT NULL,
  `product_tax` decimal(12,2) NOT NULL DEFAULT '0.00',
  `product_attributes` text NOT NULL,
  `product_freeattributes` text NOT NULL,
  `attributes` text NOT NULL,
  `freeattributes` text NOT NULL,
  `files` text NOT NULL,
  `weight` float(8,4) NOT NULL DEFAULT '0.0000',
  `vendor_id` int(11) NOT NULL,
  PRIMARY KEY (`order_item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `#__jshopping_order_item`
--

INSERT INTO `#__jshopping_order_item` (`order_item_id`, `order_id`, `product_id`, `product_ean`, `product_name`, `product_quantity`, `product_item_price`, `product_tax`, `product_attributes`, `product_freeattributes`, `attributes`, `freeattributes`, `files`, `weight`, `vendor_id`) VALUES
(1, 1, 3, '', 'Apple TV', 1, '260.00', '19.00', '', '', 'a:0:{}', 'a:0:{}', 'a:0:{}', 0.0000, 0),
(2, 1, 1, '', 'iPad 2', 11, '720.00', '19.00', '', '', 'a:0:{}', 'a:0:{}', 'a:0:{}', 1.0000, 0),
(3, 2, 1, '', 'iPad 2', 1, '720.00', '19.00', 'Color: Black\n', '', 'a:1:{i:1;i:1;}', 'a:0:{}', 'a:0:{}', 1.0000, 0),
(4, 2, 5, '', 'iPod', 1, '340.00', '19.00', '', '', 'a:0:{}', 'a:0:{}', 'a:0:{}', 0.0000, 0),
(5, 2, 3, '', 'Apple TV', 1, '260.00', '19.00', '', '', 'a:0:{}', 'a:0:{}', 'a:0:{}', 0.0000, 0),
(6, 3, 3, '', 'Apple TV', 6, '260.00', '19.00', '', '', 'a:0:{}', 'a:0:{}', 'a:0:{}', 0.0000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_order_status`
--

DROP TABLE IF EXISTS `#__jshopping_order_status`;
CREATE TABLE IF NOT EXISTS `#__jshopping_order_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_code` char(1) NOT NULL DEFAULT '',
  `name_en-GB` varchar(100) NOT NULL DEFAULT '',
  `name_de-DE` varchar(100) NOT NULL DEFAULT '',
  `name_nl-NL` varchar(100) NOT NULL,
  `name_ru-RU` varchar(100) NOT NULL,
  `name_sv-SE` varchar(100) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `#__jshopping_order_status`
--

INSERT INTO `#__jshopping_order_status` (`status_id`, `status_code`, `name_en-GB`, `name_de-DE`, `name_nl-NL`, `name_ru-RU`, `name_sv-SE`) VALUES
(1, 'P', 'Pending', 'Offen', 'Pending', 'Pending', 'Pending'),
(2, 'C', 'Confirmed', 'Bestätigt', 'Confirmed', 'Confirmed', 'Confirmed'),
(3, 'X', 'Cancelled', 'Abgebrochen', 'Cancelled', 'Cancelled', 'Cancelled'),
(4, 'R', 'Refunded', 'Gutschrift', 'Refunded', 'Refunded', 'Refunded'),
(5, 'S', 'Shipped', 'Gesendet', 'Shipped', 'Shipped', 'Shipped'),
(6, 'O', 'Paid', 'Bezahlt', 'Paid', 'Paid', 'Paid'),
(7, 'F', 'Complete', 'Abgeschlossen', 'Complete', 'Complete', 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_payment_method`
--

DROP TABLE IF EXISTS `#__jshopping_payment_method`;
CREATE TABLE IF NOT EXISTS `#__jshopping_payment_method` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en-GB` varchar(100) NOT NULL,
  `description_en-GB` text NOT NULL,
  `name_de-DE` varchar(100) NOT NULL,
  `description_de-DE` text NOT NULL,
  `payment_code` varchar(32) NOT NULL,
  `payment_class` varchar(100) NOT NULL,
  `payment_publish` tinyint(1) NOT NULL,
  `payment_ordering` int(11) NOT NULL,
  `payment_params` text NOT NULL,
  `payment_type` tinyint(4) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `price_type` tinyint(1) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `show_descr_in_email` tinyint(1) NOT NULL,
  `name_nl-NL` varchar(100) NOT NULL,
  `description_nl-NL` text NOT NULL,
  `name_ru-RU` varchar(100) NOT NULL,
  `description_ru-RU` text NOT NULL,
  `name_sv-SE` varchar(100) NOT NULL,
  `description_sv-SE` text NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `#__jshopping_payment_method`
--

INSERT INTO `#__jshopping_payment_method` (`payment_id`, `name_en-GB`, `description_en-GB`, `name_de-DE`, `description_de-DE`, `payment_code`, `payment_class`, `payment_publish`, `payment_ordering`, `payment_params`, `payment_type`, `price`, `price_type`, `tax_id`, `show_descr_in_email`, `name_nl-NL`, `description_nl-NL`, `name_ru-RU`, `description_ru-RU`, `name_sv-SE`, `description_sv-SE`) VALUES
(1, 'Cash on delivery', '', 'Nachnahme', '', 'bank', 'pm_bank', 1, 1, '', 1, '4.00', 0, 1, 0, 'Cash on delivery', '', 'Cash on delivery', '', 'Cash on delivery', ''),
(2, 'Advance payment', '', 'Vorauskasse', '', 'PO', 'pm_purchase_order', 1, 2, '', 1, '0.00', 0, 1, 1, 'Advance payment', '', 'Advance payment', '', 'Advance payment', ''),
(3, 'Paypal', '', 'Paypal', '', 'paypal', 'pm_paypal', 1, 3, 'testmode=1\n email_received=test@testing.com\n transaction_end_status=6\n transaction_pending_status=1\n transaction_failed_status=3\n checkdatareturn=0', 2, '0.00', 0, 1, 0, 'Paypal', '', 'Paypal', '', 'Paypal', ''),
(4, 'Debit', 'Please insert your bankdata.', 'Lastschrift', 'Bitte tragen Sie hier Ihre Bankdaten für den Abbuchungsauftrag ein.', 'debit', 'pm_debit', 1, 4, '', 1, '0.00', 0, 1, 0, 'Debit', 'Please insert your bankdata.', 'Debit', 'Please insert your bankdata.', 'Debit', 'Please insert your bankdata.'),
(5, 'Sofortueberweisung', '', 'Sofortueberweisung', '', 'ST', 'pm_sofortueberweisung', 0, 5, 'user_id=00000\nproject_id=00000\nproject_password=00000\ntransaction_end_status=6\ntransaction_pending_status=1\ntransaction_failed_status=3\n', 2, '0.00', 0, 1, 0, 'Sofortueberweisung', '', 'Sofortueberweisung', '', 'Sofortueberweisung', '');

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_products`
--

DROP TABLE IF EXISTS `#__jshopping_products`;
CREATE TABLE IF NOT EXISTS `#__jshopping_products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_ean` varchar(32) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `unlimited` tinyint(1) NOT NULL,
  `product_availability` varchar(128) NOT NULL,
  `product_date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modify` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `product_publish` tinyint(1) NOT NULL DEFAULT '0',
  `product_tax_id` int(11) NOT NULL DEFAULT '0',
  `product_template` varchar(64) NOT NULL DEFAULT 'default',
  `product_url` varchar(255) NOT NULL DEFAULT '',
  `product_old_price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `product_buy_price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `product_price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `min_price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `different_prices` tinyint(1) NOT NULL DEFAULT '0',
  `product_weight` float(8,4) NOT NULL DEFAULT '0.0000',
  `product_thumb_image` varchar(255) NOT NULL,
  `product_name_image` varchar(255) NOT NULL,
  `product_full_image` varchar(255) NOT NULL,
  `product_manufacturer_id` int(11) NOT NULL DEFAULT '0',
  `product_is_add_price` tinyint(1) NOT NULL DEFAULT '0',
  `average_rating` float(4,2) NOT NULL DEFAULT '0.00',
  `reviews_count` int(11) NOT NULL DEFAULT '0',
  `delivery_times_id` int(11) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0',
  `weight_volume_units` decimal(12,2) NOT NULL DEFAULT '0.00',
  `basic_price_unit_id` int(11) NOT NULL DEFAULT '0',
  `label_id` int(11) NOT NULL DEFAULT '0',
  `vendor_id` int(11) NOT NULL DEFAULT '0',
  `name_en-GB` varchar(255) NOT NULL,
  `alias_en-GB` varchar(255) NOT NULL,
  `short_description_en-GB` text NOT NULL,
  `description_en-GB` text NOT NULL,
  `meta_title_en-GB` varchar(255) NOT NULL,
  `meta_description_en-GB` text NOT NULL,
  `meta_keyword_en-GB` text NOT NULL,
  `name_de-DE` varchar(255) NOT NULL,
  `alias_de-DE` varchar(255) NOT NULL,
  `short_description_de-DE` text NOT NULL,
  `description_de-DE` text NOT NULL,
  `meta_title_de-DE` varchar(255) NOT NULL,
  `meta_description_de-DE` text NOT NULL,
  `meta_keyword_de-DE` text NOT NULL,
  `name_nl-NL` varchar(255) NOT NULL,
  `alias_nl-NL` varchar(255) NOT NULL,
  `short_description_nl-NL` text NOT NULL,
  `description_nl-NL` text NOT NULL,
  `meta_title_nl-NL` varchar(255) NOT NULL,
  `meta_description_nl-NL` text NOT NULL,
  `meta_keyword_nl-NL` text NOT NULL,
  `name_ru-RU` varchar(255) NOT NULL,
  `alias_ru-RU` varchar(255) NOT NULL,
  `short_description_ru-RU` text NOT NULL,
  `description_ru-RU` text NOT NULL,
  `meta_title_ru-RU` varchar(255) NOT NULL,
  `meta_description_ru-RU` text NOT NULL,
  `meta_keyword_ru-RU` text NOT NULL,
  `name_sv-SE` varchar(255) NOT NULL,
  `alias_sv-SE` varchar(255) NOT NULL,
  `short_description_sv-SE` text NOT NULL,
  `description_sv-SE` text NOT NULL,
  `meta_title_sv-SE` varchar(255) NOT NULL,
  `meta_description_sv-SE` text NOT NULL,
  `meta_keyword_sv-SE` text NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `product_manufacturer_id` (`product_manufacturer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `#__jshopping_products`
--

INSERT INTO `#__jshopping_products` (`product_id`, `product_ean`, `product_quantity`, `unlimited`, `product_availability`, `product_date_added`, `date_modify`, `product_publish`, `product_tax_id`, `product_template`, `product_url`, `product_old_price`, `product_buy_price`, `product_price`, `min_price`, `different_prices`, `product_weight`, `product_thumb_image`, `product_name_image`, `product_full_image`, `product_manufacturer_id`, `product_is_add_price`, `average_rating`, `reviews_count`, `delivery_times_id`, `hits`, `weight_volume_units`, `basic_price_unit_id`, `label_id`, `vendor_id`, `name_en-GB`, `alias_en-GB`, `short_description_en-GB`, `description_en-GB`, `meta_title_en-GB`, `meta_description_en-GB`, `meta_keyword_en-GB`, `name_de-DE`, `alias_de-DE`, `short_description_de-DE`, `description_de-DE`, `meta_title_de-DE`, `meta_description_de-DE`, `meta_keyword_de-DE`, `name_nl-NL`, `alias_nl-NL`, `short_description_nl-NL`, `description_nl-NL`, `meta_title_nl-NL`, `meta_description_nl-NL`, `meta_keyword_nl-NL`, `name_ru-RU`, `alias_ru-RU`, `short_description_ru-RU`, `description_ru-RU`, `meta_title_ru-RU`, `meta_description_ru-RU`, `meta_keyword_ru-RU`, `name_sv-SE`, `alias_sv-SE`, `short_description_sv-SE`, `description_sv-SE`, `meta_title_sv-SE`, `meta_description_sv-SE`, `meta_keyword_sv-SE`) VALUES
(1, 'Ab11550', 1, 1, '', '2011-08-02 12:54:03', '2011-08-12 09:56:16', 1, 1, 'default', 'http://www.apple.com/ipad/', '810.00', '0.00', '720.00', '720.00', 1, 1.0000, 'thumb_e65c55dc80362bca3f389f7b712f6e3a.jpg', 'e65c55dc80362bca3f389f7b712f6e3a.jpg', 'full_e65c55dc80362bca3f389f7b712f6e3a.jpg', 0, 0, 8.77, 13, 0, 297, '0.00', 0, 1, 0, 'iPad 2', '', 'Lorem ipsum dolor sit amet, consectet adipiscing elit. Vestibulum quis sapien leo, vel dictum dui pellentesque haban', '<p class="category_short_description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur.</p>\r\n<p class="category_short_description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur.</p>\r\n<p class="category_short_description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur.</p>', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, '', 1, 1, '', '2011-08-03 12:32:52', '2011-08-12 10:04:08', 1, 1, 'default', '', '1720.00', '0.00', '1600.00', '1600.00', 0, 0.0000, 'thumb_b8117edcaf73210e16f45ec87c6fa827.jpg', 'b8117edcaf73210e16f45ec87c6fa827.jpg', 'full_b8117edcaf73210e16f45ec87c6fa827.jpg', 0, 0, 0.00, 0, 0, 10, '0.00', 0, 2, 0, 'iMac', '', 'Lorem ipsum dolor sit amet, consectet adipiscing elit. Vestibulum quis sapien leo, vel dictum dui pellentesque haban', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur.</p>', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, '', 1, 1, '', '2011-08-03 12:34:32', '2011-08-12 10:05:45', 1, 1, 'default', '', '295.00', '0.00', '260.00', '260.00', 0, 0.0000, 'thumb_ab239707d5166dcb377fa1127c93b432.jpg', 'ab239707d5166dcb377fa1127c93b432.jpg', 'full_ab239707d5166dcb377fa1127c93b432.jpg', 0, 0, 0.00, 0, 0, 41, '0.00', 0, 0, 0, 'Apple TV', '', 'Lorem ipsum dolor sit amet, consectet adipiscing elit. Vestibulum quis sapien leo, vel dictum dui pellentesque haban', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur.</p>', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, '', 1, 1, '', '2011-08-03 12:38:29', '2011-08-12 10:06:27', 1, 1, 'default', '', '700.00', '0.00', '620.00', '620.00', 0, 0.0000, 'thumb_22ef0a2ceff221a80c32ea2508d84d7e.jpg', '22ef0a2ceff221a80c32ea2508d84d7e.jpg', 'full_22ef0a2ceff221a80c32ea2508d84d7e.jpg', 0, 0, 7.50, 2, 0, 51, '0.00', 0, 0, 0, 'iPhone 4', '', 'Lorem ipsum dolor sit amet, consectet adipiscing elit. Vestibulum quis sapien leo, vel dictum dui pellentesque haban', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur.</p>', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, '', 1, 1, '', '2011-08-04 09:28:25', '2011-08-12 10:07:15', 1, 1, 'default', '', '410.00', '0.00', '340.00', '340.00', 0, 0.0000, 'thumb_0476b7c25fbfde3b07ea5b0a75ae6c84.jpg', '0476b7c25fbfde3b07ea5b0a75ae6c84.jpg', 'full_0476b7c25fbfde3b07ea5b0a75ae6c84.jpg', 0, 0, 0.00, 0, 0, 69, '0.00', 0, 0, 0, 'iPod', '', 'Lorem ipsum dolor sit amet, consectet adipiscing elit. Vestibulum quis sapien leo, vel dictum dui pellentesque haban', '<p class="category_short_description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur.</p>', '', '', '', '', '110804092825', '', '', '', '', '', '', '110804092825', '', '', '', '', '', '', '110804092825', '', '', '', '', '', '', '110804092825', '', '', '', '', ''),
(6, '', 1, 1, '', '2011-08-04 09:28:26', '2011-08-12 10:08:04', 1, 1, 'default', '', '1180.00', '0.00', '1100.00', '1100.00', 0, 0.0000, 'thumb_3dcb373a75c112b4b9c4098327f825fe.jpg', '3dcb373a75c112b4b9c4098327f825fe.jpg', 'full_3dcb373a75c112b4b9c4098327f825fe.jpg', 0, 0, 0.00, 0, 0, 19, '0.00', 0, 0, 0, 'Macbook Air', '', 'Lorem ipsum dolor sit amet, consectet adipiscing elit. Vestibulum quis sapien leo, vel dictum dui pellentesque haban', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur.</p>', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(7, '', 1, 1, '', '2011-08-04 09:28:26', '2011-08-12 10:11:41', 1, 1, 'default', '', '590.00', '0.00', '560.00', '560.00', 0, 0.0000, 'thumb_17ec6f53b639f91c40a4a39fcf520f85.jpg', '17ec6f53b639f91c40a4a39fcf520f85.jpg', 'full_17ec6f53b639f91c40a4a39fcf520f85.jpg', 0, 0, 0.00, 0, 0, 2, '0.00', 0, 0, 0, 'Time Capsule', '', 'Lorem ipsum dolor sit amet, consectet adipiscing elit. Vestibulum quis sapien leo, vel dictum dui pellentesque haban', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur.</p>', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(9, '', 1, 1, '', '2011-08-04 10:23:07', '2011-08-12 10:15:06', 1, 1, 'default', '', '640.00', '0.00', '599.00', '599.00', 0, 0.0000, 'thumb_dc13739004c50b749ab2b1e7efb3c6f5.jpg', 'dc13739004c50b749ab2b1e7efb3c6f5.jpg', 'full_dc13739004c50b749ab2b1e7efb3c6f5.jpg', 0, 0, 0.00, 0, 0, 11, '0.00', 0, 1, 0, 'Mac Mini', '', 'Lorem ipsum dolor sit amet, consectet adipiscing elit. Vestibulum quis sapien leo, vel dictum dui pellentesque haban', '<div class="jshop_prod_description">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur.</p>\r\n</div>', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(8, '', 1, 1, '', '2011-08-04 09:28:26', '2011-08-12 10:14:15', 1, 1, 'default', '', '2940.00', '0.00', '2600.00', '2600.00', 0, 0.0000, 'thumb_36a3edae47b25c4ec9899e72e1b3250e.jpg', '36a3edae47b25c4ec9899e72e1b3250e.jpg', 'full_36a3edae47b25c4ec9899e72e1b3250e.jpg', 0, 0, 0.00, 0, 0, 0, '0.00', 0, 2, 0, 'Mac Pro', '', 'Lorem ipsum dolor sit amet, consectet adipiscing elit. Vestibulum quis sapien leo, vel dictum dui pellentesque haban', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur.</p>', '', '', '', '', '110804092826', '', '', '', '', '', '', '110804092826', '', '', '', '', '', '', '110804092826', '', '', '', '', '', '', '110804092826', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_products_attr`
--

DROP TABLE IF EXISTS `#__jshopping_products_attr`;
CREATE TABLE IF NOT EXISTS `#__jshopping_products_attr` (
  `product_attr_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `buy_price` decimal(12,2) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `count` int(11) NOT NULL,
  `ean` varchar(100) NOT NULL,
  `weight` decimal(12,4) NOT NULL,
  `weight_volume_units` decimal(12,2) NOT NULL,
  `attr_1` int(11) NOT NULL,
  `attr_2` int(11) NOT NULL,
  PRIMARY KEY (`product_attr_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `#__jshopping_products_attr`
--

INSERT INTO `#__jshopping_products_attr` (`product_attr_id`, `product_id`, `buy_price`, `price`, `count`, `ean`, `weight`, `weight_volume_units`, `attr_1`, `attr_2`) VALUES
(30, 1, '0.00', '780.00', 10, '', '1.0000', '0.00', 2, 0),
(29, 1, '0.00', '720.00', 10, '', '1.0000', '0.00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_products_attr2`
--

DROP TABLE IF EXISTS `#__jshopping_products_attr2`;
CREATE TABLE IF NOT EXISTS `#__jshopping_products_attr2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `attr_id` int(11) NOT NULL,
  `attr_value_id` int(11) NOT NULL,
  `price_mod` char(1) NOT NULL,
  `addprice` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__jshopping_products_attr2`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_products_extra_fields`
--

DROP TABLE IF EXISTS `#__jshopping_products_extra_fields`;
CREATE TABLE IF NOT EXISTS `#__jshopping_products_extra_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `allcats` tinyint(1) NOT NULL,
  `cats` text NOT NULL,
  `ordering` int(6) NOT NULL,
  `name_en-GB` varchar(255) NOT NULL,
  `name_de-DE` varchar(255) NOT NULL,
  `name_nl-NL` varchar(255) NOT NULL,
  `name_ru-RU` varchar(255) NOT NULL,
  `name_sv-SE` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__jshopping_products_extra_fields`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_products_extra_field_values`
--

DROP TABLE IF EXISTS `#__jshopping_products_extra_field_values`;
CREATE TABLE IF NOT EXISTS `#__jshopping_products_extra_field_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `ordering` int(6) NOT NULL,
  `name_en-GB` varchar(255) NOT NULL,
  `name_de-DE` varchar(255) NOT NULL,
  `name_nl-NL` varchar(255) NOT NULL,
  `name_ru-RU` varchar(255) NOT NULL,
  `name_sv-SE` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__jshopping_products_extra_field_values`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_products_files`
--

DROP TABLE IF EXISTS `#__jshopping_products_files`;
CREATE TABLE IF NOT EXISTS `#__jshopping_products_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `demo` varchar(255) NOT NULL,
  `demo_descr` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `file_descr` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__jshopping_products_files`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_products_free_attr`
--

DROP TABLE IF EXISTS `#__jshopping_products_free_attr`;
CREATE TABLE IF NOT EXISTS `#__jshopping_products_free_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `attr_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `attr_id` (`attr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__jshopping_products_free_attr`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_products_images`
--

DROP TABLE IF EXISTS `#__jshopping_products_images`;
CREATE TABLE IF NOT EXISTS `#__jshopping_products_images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `image_thumb` varchar(255) NOT NULL DEFAULT '',
  `image_name` varchar(255) NOT NULL DEFAULT '',
  `image_full` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `#__jshopping_products_images`
--

INSERT INTO `#__jshopping_products_images` (`image_id`, `product_id`, `image_thumb`, `image_name`, `image_full`) VALUES
(6, 1, 'thumb_e65c55dc80362bca3f389f7b712f6e3a.jpg', 'e65c55dc80362bca3f389f7b712f6e3a.jpg', 'full_e65c55dc80362bca3f389f7b712f6e3a.jpg'),
(2, 2, 'thumb_b8117edcaf73210e16f45ec87c6fa827.jpg', 'b8117edcaf73210e16f45ec87c6fa827.jpg', 'full_b8117edcaf73210e16f45ec87c6fa827.jpg'),
(3, 3, 'thumb_ab239707d5166dcb377fa1127c93b432.jpg', 'ab239707d5166dcb377fa1127c93b432.jpg', 'full_ab239707d5166dcb377fa1127c93b432.jpg'),
(4, 4, 'thumb_22ef0a2ceff221a80c32ea2508d84d7e.jpg', '22ef0a2ceff221a80c32ea2508d84d7e.jpg', 'full_22ef0a2ceff221a80c32ea2508d84d7e.jpg'),
(11, 5, 'thumb_0476b7c25fbfde3b07ea5b0a75ae6c84.jpg', '0476b7c25fbfde3b07ea5b0a75ae6c84.jpg', 'full_0476b7c25fbfde3b07ea5b0a75ae6c84.jpg'),
(12, 6, 'thumb_3dcb373a75c112b4b9c4098327f825fe.jpg', '3dcb373a75c112b4b9c4098327f825fe.jpg', 'full_3dcb373a75c112b4b9c4098327f825fe.jpg'),
(13, 7, 'thumb_17ec6f53b639f91c40a4a39fcf520f85.jpg', '17ec6f53b639f91c40a4a39fcf520f85.jpg', 'full_17ec6f53b639f91c40a4a39fcf520f85.jpg'),
(14, 8, 'thumb_36a3edae47b25c4ec9899e72e1b3250e.jpg', '36a3edae47b25c4ec9899e72e1b3250e.jpg', 'full_36a3edae47b25c4ec9899e72e1b3250e.jpg'),
(16, 9, 'thumb_dc13739004c50b749ab2b1e7efb3c6f5.jpg', 'dc13739004c50b749ab2b1e7efb3c6f5.jpg', 'full_dc13739004c50b749ab2b1e7efb3c6f5.jpg'),
(17, 1, 'thumb_ffbc62f021bc4ee94593f3da89377900.jpg', 'ffbc62f021bc4ee94593f3da89377900.jpg', 'full_ffbc62f021bc4ee94593f3da89377900.jpg'),
(19, 1, 'thumb_47de6649eaf38314875f99b838681cb4.jpg', '47de6649eaf38314875f99b838681cb4.jpg', 'full_47de6649eaf38314875f99b838681cb4.jpg'),
(20, 2, 'thumb_bffd0ad0c19f76d3c85fd3de2dc56ffb.jpg', 'bffd0ad0c19f76d3c85fd3de2dc56ffb.jpg', 'full_bffd0ad0c19f76d3c85fd3de2dc56ffb.jpg'),
(21, 2, 'thumb_45a9d50863b8e62053e8876a71691457.jpg', '45a9d50863b8e62053e8876a71691457.jpg', 'full_45a9d50863b8e62053e8876a71691457.jpg'),
(23, 3, 'thumb_78a12357997852e6be2df4ad6dc407fa.jpg', '78a12357997852e6be2df4ad6dc407fa.jpg', 'full_78a12357997852e6be2df4ad6dc407fa.jpg'),
(24, 3, 'thumb_739c1845dc5f800850e85dfdd76b4db4.jpg', '739c1845dc5f800850e85dfdd76b4db4.jpg', 'full_739c1845dc5f800850e85dfdd76b4db4.jpg'),
(25, 4, 'thumb_9efbc28da905298e666a62a0d833b9ce.jpg', '9efbc28da905298e666a62a0d833b9ce.jpg', 'full_9efbc28da905298e666a62a0d833b9ce.jpg'),
(26, 4, 'thumb_971612ffd029d13ac0bfe5f79ca3a011.jpg', '971612ffd029d13ac0bfe5f79ca3a011.jpg', 'full_971612ffd029d13ac0bfe5f79ca3a011.jpg'),
(27, 5, 'thumb_1d6925b5d39c6bb7169923601ffae7d8.jpg', '1d6925b5d39c6bb7169923601ffae7d8.jpg', 'full_1d6925b5d39c6bb7169923601ffae7d8.jpg'),
(28, 5, 'thumb_91af95a089bce8c7ba2cb264c0d5d0ee.jpg', '91af95a089bce8c7ba2cb264c0d5d0ee.jpg', 'full_91af95a089bce8c7ba2cb264c0d5d0ee.jpg'),
(29, 6, 'thumb_c88e6321d1df8790a4f9a50c843a68dd.jpg', 'c88e6321d1df8790a4f9a50c843a68dd.jpg', 'full_c88e6321d1df8790a4f9a50c843a68dd.jpg'),
(30, 6, 'thumb_8a118f1808c6441117eaf1a87261bfaa.jpg', '8a118f1808c6441117eaf1a87261bfaa.jpg', 'full_8a118f1808c6441117eaf1a87261bfaa.jpg'),
(31, 7, 'thumb_34c2be8a0d919217517948122c3f6cb0.jpg', '34c2be8a0d919217517948122c3f6cb0.jpg', 'full_34c2be8a0d919217517948122c3f6cb0.jpg'),
(32, 7, 'thumb_97465df1ae5286a21fd46626dfe004b6.jpg', '97465df1ae5286a21fd46626dfe004b6.jpg', 'full_97465df1ae5286a21fd46626dfe004b6.jpg'),
(33, 8, 'thumb_a5a4166649d5ea3497fda69422a7a729.jpg', 'a5a4166649d5ea3497fda69422a7a729.jpg', 'full_a5a4166649d5ea3497fda69422a7a729.jpg'),
(34, 8, 'thumb_1bf1d776cbfb981d8cc8bbca8aa62243.png', '1bf1d776cbfb981d8cc8bbca8aa62243.png', 'full_1bf1d776cbfb981d8cc8bbca8aa62243.png'),
(35, 9, 'thumb_a37ac28fac4b7d115633f1d99a2f81f0.jpg', 'a37ac28fac4b7d115633f1d99a2f81f0.jpg', 'full_a37ac28fac4b7d115633f1d99a2f81f0.jpg'),
(36, 9, 'thumb_17d14415ade5d9c5f2da797390ccb07d.jpg', '17d14415ade5d9c5f2da797390ccb07d.jpg', 'full_17d14415ade5d9c5f2da797390ccb07d.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_products_prices`
--

DROP TABLE IF EXISTS `#__jshopping_products_prices`;
CREATE TABLE IF NOT EXISTS `#__jshopping_products_prices` (
  `price_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `discount` decimal(16,6) NOT NULL,
  `product_quantity_start` int(11) NOT NULL,
  `product_quantity_finish` int(11) NOT NULL,
  PRIMARY KEY (`price_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__jshopping_products_prices`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_products_relations`
--

DROP TABLE IF EXISTS `#__jshopping_products_relations`;
CREATE TABLE IF NOT EXISTS `#__jshopping_products_relations` (
  `product_id` int(11) NOT NULL DEFAULT '0',
  `product_related_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__jshopping_products_relations`
--

INSERT INTO `#__jshopping_products_relations` (`product_id`, `product_related_id`) VALUES
(2, 9),
(1, 3),
(1, 2),
(1, 4),
(2, 7),
(2, 4),
(3, 8),
(3, 5),
(3, 4),
(4, 6),
(4, 1),
(4, 2),
(5, 6),
(5, 9),
(5, 3),
(6, 8),
(6, 4),
(6, 3),
(7, 4),
(7, 2),
(7, 1),
(8, 7),
(8, 9),
(8, 6),
(9, 3),
(9, 1),
(9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_products_reviews`
--

DROP TABLE IF EXISTS `#__jshopping_products_reviews`;
CREATE TABLE IF NOT EXISTS `#__jshopping_products_reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `time` date NOT NULL,
  `review` text NOT NULL,
  `mark` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `#__jshopping_products_reviews`
--

INSERT INTO `#__jshopping_products_reviews` (`review_id`, `product_id`, `user_id`, `user_name`, `user_email`, `time`, `review`, `mark`, `publish`, `ip`) VALUES
(1, 1, 42, 'admin', 'info@icetheme.com', '2011-08-04', 'Just a test comment', 10, 1, '127.0.0.1'),
(2, 4, 42, 'admin', 'info@icetheme.com', '2011-08-04', 'testing comments', 8, 1, '127.0.0.1'),
(3, 4, 42, 'admin', 'info@icetheme.com', '2011-08-04', 'testing comment', 7, 1, '127.0.0.1'),
(4, 1, 42, 'admin', 'info@icetheme.com', '2011-08-07', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur.\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur.\r\n', 8, 1, '127.0.0.1'),
(5, 1, 42, 'admin', 'info@icetheme.com', '2011-08-07', 'netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fame', 9, 1, '127.0.0.1'),
(6, 1, 42, 'admin', 'info@icetheme.com', '2011-08-07', 'Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi ', 10, 1, '127.0.0.1'),
(7, 1, 42, 'admin', 'info@icetheme.com', '2011-08-07', 'Testig Again', 1, 1, '127.0.0.1'),
(8, 1, 42, 'admin', 'info@icetheme.com', '2011-08-07', 'netus et malesuada fames ac t', 10, 1, '127.0.0.1'),
(9, 1, 42, 'admin', 'info@icetheme.com', '2011-08-07', 'psum dolor sit amet, conse', 10, 1, '127.0.0.1'),
(10, 1, 42, 'admin', 'info@icetheme.com', '2011-08-07', 'nsectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Intege', 9, 1, '127.0.0.1'),
(11, 1, 42, 'admin', 'info@icetheme.com', '2011-08-07', 'nsectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Intege', 10, 1, '127.0.0.1'),
(12, 1, 42, 'admin', 'info@icetheme.com', '2011-08-07', 'nsectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Intege', 8, 1, '127.0.0.1'),
(13, 1, 42, 'admin', 'info@icetheme.com', '2011-08-07', 'nsectetur adipiscing elit. Vestibulum quis sapien leo, vel dictum dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer ut nisi convallis sapien tincidunt consectetur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ', 10, 1, '127.0.0.1'),
(14, 1, 42, 'admin', 'info@icetheme.com', '2011-08-07', 'rem ipsum dolor sit amet, consect', 10, 1, '127.0.0.1'),
(15, 1, 42, 'admin', 'info@icetheme.com', '2011-08-07', 'rem ipsum dolor sit amet, consect', 9, 1, '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_products_to_categories`
--

DROP TABLE IF EXISTS `#__jshopping_products_to_categories`;
CREATE TABLE IF NOT EXISTS `#__jshopping_products_to_categories` (
  `product_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `product_ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`,`category_id`),
  KEY `category_id` (`category_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__jshopping_products_to_categories`
--

INSERT INTO `#__jshopping_products_to_categories` (`product_id`, `category_id`, `product_ordering`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(2, 1, 2),
(2, 2, 2),
(2, 3, 2),
(2, 4, 1),
(2, 5, 1),
(3, 1, 3),
(3, 2, 3),
(3, 3, 3),
(3, 4, 2),
(3, 5, 2),
(4, 1, 4),
(4, 2, 4),
(4, 3, 4),
(4, 4, 3),
(4, 5, 3),
(5, 1, 5),
(5, 2, 5),
(5, 3, 5),
(6, 1, 6),
(6, 2, 6),
(6, 3, 6),
(6, 4, 4),
(6, 5, 4),
(7, 1, 7),
(7, 2, 7),
(7, 3, 7),
(7, 4, 5),
(7, 5, 5),
(8, 1, 8),
(8, 2, 8),
(8, 3, 8),
(8, 4, 6),
(8, 5, 6),
(5, 4, 7),
(5, 5, 7),
(9, 1, 9),
(9, 2, 9),
(9, 3, 9),
(9, 4, 8),
(9, 5, 8),
(1, 4, 9),
(1, 5, 9),
(1, 14, 1),
(1, 33, 1),
(1, 34, 1),
(1, 35, 1),
(1, 36, 1),
(1, 37, 1),
(1, 38, 1),
(1, 15, 1),
(1, 16, 1),
(1, 17, 1),
(1, 18, 1),
(1, 19, 1),
(1, 6, 1),
(1, 26, 1),
(1, 27, 1),
(1, 28, 1),
(1, 29, 1),
(1, 30, 1),
(1, 31, 1),
(1, 32, 1),
(1, 7, 1),
(1, 8, 1),
(1, 9, 1),
(1, 20, 1),
(1, 21, 1),
(1, 22, 1),
(1, 23, 1),
(1, 24, 1),
(1, 25, 1),
(1, 10, 1),
(1, 11, 1),
(1, 12, 1),
(1, 13, 1),
(2, 14, 2),
(2, 33, 2),
(2, 34, 2),
(2, 35, 2),
(2, 36, 2),
(2, 37, 2),
(2, 38, 2),
(2, 15, 2),
(2, 16, 2),
(2, 17, 2),
(2, 18, 2),
(2, 19, 2),
(2, 6, 2),
(2, 26, 2),
(2, 27, 2),
(2, 28, 2),
(2, 29, 2),
(2, 30, 2),
(2, 31, 2),
(2, 32, 2),
(2, 7, 2),
(2, 8, 2),
(2, 9, 2),
(2, 20, 2),
(2, 21, 2),
(2, 22, 2),
(2, 23, 2),
(2, 24, 2),
(2, 25, 2),
(2, 10, 2),
(2, 11, 2),
(2, 12, 2),
(2, 13, 2),
(3, 14, 3),
(3, 33, 3),
(3, 34, 3),
(3, 35, 3),
(3, 36, 3),
(3, 37, 3),
(3, 38, 3),
(3, 15, 3),
(3, 16, 3),
(3, 17, 3),
(3, 18, 3),
(3, 19, 3),
(3, 6, 3),
(3, 26, 3),
(3, 27, 3),
(3, 28, 3),
(3, 29, 3),
(3, 30, 3),
(3, 31, 3),
(3, 32, 3),
(3, 7, 3),
(3, 8, 3),
(3, 9, 3),
(3, 20, 3),
(3, 21, 3),
(3, 22, 3),
(3, 23, 3),
(3, 24, 3),
(3, 25, 3),
(3, 10, 3),
(3, 11, 3),
(3, 12, 3),
(3, 13, 3),
(4, 14, 4),
(4, 33, 4),
(4, 34, 4),
(4, 35, 4),
(4, 36, 4),
(4, 37, 4),
(4, 38, 4),
(4, 15, 4),
(4, 16, 4),
(4, 17, 4),
(4, 18, 4),
(4, 19, 4),
(4, 6, 4),
(4, 26, 4),
(4, 27, 4),
(4, 28, 4),
(4, 29, 4),
(4, 30, 4),
(4, 31, 4),
(4, 32, 4),
(4, 7, 4),
(4, 8, 4),
(4, 9, 4),
(4, 20, 4),
(4, 21, 4),
(4, 22, 4),
(4, 23, 4),
(4, 24, 4),
(4, 25, 4),
(4, 10, 4),
(4, 11, 4),
(4, 12, 4),
(4, 13, 4),
(5, 14, 5),
(5, 33, 5),
(5, 34, 5),
(5, 35, 5),
(5, 36, 5),
(5, 37, 5),
(5, 38, 5),
(5, 15, 5),
(5, 16, 5),
(5, 17, 5),
(5, 18, 5),
(5, 19, 5),
(5, 6, 5),
(5, 26, 5),
(5, 27, 5),
(5, 28, 5),
(5, 29, 5),
(5, 30, 5),
(5, 31, 5),
(5, 32, 5),
(5, 7, 5),
(5, 8, 5),
(5, 9, 5),
(5, 20, 5),
(5, 21, 5),
(5, 22, 5),
(5, 23, 5),
(5, 24, 5),
(5, 25, 5),
(5, 10, 5),
(5, 11, 5),
(5, 12, 5),
(5, 13, 5),
(6, 14, 6),
(6, 33, 6),
(6, 34, 6),
(6, 35, 6),
(6, 36, 6),
(6, 37, 6),
(6, 38, 6),
(6, 15, 6),
(6, 16, 6),
(6, 17, 6),
(6, 18, 6),
(6, 19, 6),
(6, 6, 6),
(6, 26, 6),
(6, 27, 6),
(6, 28, 6),
(6, 29, 6),
(6, 30, 6),
(6, 31, 6),
(6, 32, 6),
(6, 7, 6),
(6, 8, 6),
(6, 9, 6),
(6, 20, 6),
(6, 21, 6),
(6, 22, 6),
(6, 23, 6),
(6, 24, 6),
(6, 25, 6),
(6, 10, 6),
(6, 11, 6),
(6, 12, 6),
(6, 13, 6),
(7, 14, 7),
(7, 33, 7),
(7, 34, 7),
(7, 35, 7),
(7, 36, 7),
(7, 37, 7),
(7, 38, 7),
(7, 15, 7),
(7, 16, 7),
(7, 17, 7),
(7, 18, 7),
(7, 19, 7),
(7, 6, 7),
(7, 26, 7),
(7, 27, 7),
(7, 28, 7),
(7, 29, 7),
(7, 30, 7),
(7, 31, 7),
(7, 32, 7),
(7, 7, 7),
(7, 8, 7),
(7, 9, 7),
(7, 20, 7),
(7, 21, 7),
(7, 22, 7),
(7, 23, 7),
(7, 24, 7),
(7, 25, 7),
(7, 10, 7),
(7, 11, 7),
(7, 12, 7),
(7, 13, 7),
(8, 14, 8),
(8, 33, 8),
(8, 34, 8),
(8, 35, 8),
(8, 36, 8),
(8, 37, 8),
(8, 38, 8),
(8, 15, 8),
(8, 16, 8),
(8, 17, 8),
(8, 18, 8),
(8, 19, 8),
(8, 6, 8),
(8, 26, 8),
(8, 27, 8),
(8, 28, 8),
(8, 29, 8),
(8, 30, 8),
(8, 31, 8),
(8, 32, 8),
(8, 7, 8),
(8, 8, 8),
(8, 9, 8),
(8, 20, 8),
(8, 21, 8),
(8, 22, 8),
(8, 23, 8),
(8, 24, 8),
(8, 25, 8),
(8, 10, 8),
(8, 11, 8),
(8, 12, 8),
(8, 13, 8),
(9, 14, 9),
(9, 33, 9),
(9, 34, 9),
(9, 35, 9),
(9, 36, 9),
(9, 37, 9),
(9, 38, 9),
(9, 15, 9),
(9, 16, 9),
(9, 17, 9),
(9, 18, 9),
(9, 19, 9),
(9, 6, 9),
(9, 26, 9),
(9, 27, 9),
(9, 28, 9),
(9, 29, 9),
(9, 30, 9),
(9, 31, 9),
(9, 32, 9),
(9, 7, 9),
(9, 8, 9),
(9, 9, 9),
(9, 20, 9),
(9, 21, 9),
(9, 22, 9),
(9, 23, 9),
(9, 24, 9),
(9, 25, 9),
(9, 10, 9),
(9, 11, 9),
(9, 12, 9),
(9, 13, 9);

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_products_videos`
--

DROP TABLE IF EXISTS `#__jshopping_products_videos`;
CREATE TABLE IF NOT EXISTS `#__jshopping_products_videos` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `video_name` varchar(255) NOT NULL DEFAULT '',
  `video_preview` varchar(255) NOT NULL,
  PRIMARY KEY (`video_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `#__jshopping_products_videos`
--

INSERT INTO `#__jshopping_products_videos` (`video_id`, `product_id`, `video_name`, `video_preview`) VALUES
(1, 1, '4f42939a6e8a8e8a4447b5f93ed2df86.flv', '');

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_product_labels`
--

DROP TABLE IF EXISTS `#__jshopping_product_labels`;
CREATE TABLE IF NOT EXISTS `#__jshopping_product_labels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `#__jshopping_product_labels`
--

INSERT INTO `#__jshopping_product_labels` (`id`, `name`, `image`) VALUES
(1, 'New', 'new.png'),
(2, 'Sale', 'sale.png');

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_shipping_method`
--

DROP TABLE IF EXISTS `#__jshopping_shipping_method`;
CREATE TABLE IF NOT EXISTS `#__jshopping_shipping_method` (
  `shipping_id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en-GB` varchar(100) NOT NULL DEFAULT '',
  `description_en-GB` text NOT NULL,
  `name_de-DE` varchar(100) NOT NULL DEFAULT '',
  `description_de-DE` text NOT NULL,
  `shipping_publish` tinyint(1) NOT NULL DEFAULT '0',
  `shipping_ordering` int(11) NOT NULL DEFAULT '0',
  `name_nl-NL` varchar(100) NOT NULL,
  `description_nl-NL` text NOT NULL,
  `name_ru-RU` varchar(100) NOT NULL,
  `description_ru-RU` text NOT NULL,
  `name_sv-SE` varchar(100) NOT NULL,
  `description_sv-SE` text NOT NULL,
  PRIMARY KEY (`shipping_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `#__jshopping_shipping_method`
--

INSERT INTO `#__jshopping_shipping_method` (`shipping_id`, `name_en-GB`, `description_en-GB`, `name_de-DE`, `description_de-DE`, `shipping_publish`, `shipping_ordering`, `name_nl-NL`, `description_nl-NL`, `name_ru-RU`, `description_ru-RU`, `name_sv-SE`, `description_sv-SE`) VALUES
(1, 'Standard', '', 'Standardversand', '', 1, 1, 'Standard', '', 'Standard', '', 'Standard', ''),
(2, 'Express', '', 'Express', '', 1, 1, 'Express', '', 'Express', '', 'Express', '');

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_shipping_method_price`
--

DROP TABLE IF EXISTS `#__jshopping_shipping_method_price`;
CREATE TABLE IF NOT EXISTS `#__jshopping_shipping_method_price` (
  `sh_pr_method_id` int(11) NOT NULL AUTO_INCREMENT,
  `shipping_method_id` int(11) NOT NULL,
  `shipping_tax_id` int(11) NOT NULL DEFAULT '0',
  `shipping_stand_price` decimal(12,2) NOT NULL,
  PRIMARY KEY (`sh_pr_method_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `#__jshopping_shipping_method_price`
--

INSERT INTO `#__jshopping_shipping_method_price` (`sh_pr_method_id`, `shipping_method_id`, `shipping_tax_id`, `shipping_stand_price`) VALUES
(1, 1, 1, '10.00'),
(2, 2, 1, '25.00');

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_shipping_method_price_countries`
--

DROP TABLE IF EXISTS `#__jshopping_shipping_method_price_countries`;
CREATE TABLE IF NOT EXISTS `#__jshopping_shipping_method_price_countries` (
  `sh_method_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `sh_pr_method_id` int(11) NOT NULL,
  PRIMARY KEY (`sh_method_country_id`),
  KEY `country_id` (`country_id`),
  KEY `sh_pr_method_id` (`sh_pr_method_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=479 ;

--
-- Dumping data for table `#__jshopping_shipping_method_price_countries`
--

INSERT INTO `#__jshopping_shipping_method_price_countries` (`sh_method_country_id`, `country_id`, `sh_pr_method_id`) VALUES
(1, 239, 1),
(2, 238, 1),
(3, 237, 1),
(4, 236, 1),
(5, 235, 1),
(6, 234, 1),
(7, 233, 1),
(8, 232, 1),
(9, 231, 1),
(10, 230, 1),
(11, 229, 1),
(12, 228, 1),
(13, 227, 1),
(14, 226, 1),
(15, 225, 1),
(16, 224, 1),
(17, 223, 1),
(18, 222, 1),
(19, 221, 1),
(20, 220, 1),
(21, 219, 1),
(22, 218, 1),
(23, 217, 1),
(24, 216, 1),
(25, 215, 1),
(26, 214, 1),
(27, 213, 1),
(28, 212, 1),
(29, 211, 1),
(30, 210, 1),
(31, 209, 1),
(32, 208, 1),
(33, 207, 1),
(34, 206, 1),
(35, 205, 1),
(36, 204, 1),
(37, 203, 1),
(38, 202, 1),
(39, 201, 1),
(40, 200, 1),
(41, 199, 1),
(42, 198, 1),
(43, 197, 1),
(44, 196, 1),
(45, 195, 1),
(46, 194, 1),
(47, 193, 1),
(48, 192, 1),
(49, 191, 1),
(50, 190, 1),
(51, 189, 1),
(52, 188, 1),
(53, 187, 1),
(54, 186, 1),
(55, 185, 1),
(56, 184, 1),
(57, 183, 1),
(58, 182, 1),
(59, 181, 1),
(60, 180, 1),
(61, 179, 1),
(62, 178, 1),
(63, 177, 1),
(64, 176, 1),
(65, 175, 1),
(66, 174, 1),
(67, 173, 1),
(68, 172, 1),
(69, 171, 1),
(70, 170, 1),
(71, 169, 1),
(72, 168, 1),
(73, 167, 1),
(74, 166, 1),
(75, 165, 1),
(76, 164, 1),
(77, 163, 1),
(78, 162, 1),
(79, 161, 1),
(80, 160, 1),
(81, 159, 1),
(82, 158, 1),
(83, 157, 1),
(84, 156, 1),
(85, 155, 1),
(86, 154, 1),
(87, 153, 1),
(88, 152, 1),
(89, 151, 1),
(90, 150, 1),
(91, 149, 1),
(92, 148, 1),
(93, 147, 1),
(94, 146, 1),
(95, 145, 1),
(96, 144, 1),
(97, 143, 1),
(98, 142, 1),
(99, 141, 1),
(100, 140, 1),
(101, 139, 1),
(102, 138, 1),
(103, 137, 1),
(104, 136, 1),
(105, 135, 1),
(106, 134, 1),
(107, 133, 1),
(108, 132, 1),
(109, 131, 1),
(110, 130, 1),
(111, 129, 1),
(112, 128, 1),
(113, 127, 1),
(114, 126, 1),
(115, 125, 1),
(116, 124, 1),
(117, 123, 1),
(118, 122, 1),
(119, 121, 1),
(120, 120, 1),
(121, 119, 1),
(122, 118, 1),
(123, 117, 1),
(124, 116, 1),
(125, 115, 1),
(126, 114, 1),
(127, 113, 1),
(128, 112, 1),
(129, 111, 1),
(130, 110, 1),
(131, 109, 1),
(132, 108, 1),
(133, 107, 1),
(134, 106, 1),
(135, 105, 1),
(136, 104, 1),
(137, 103, 1),
(138, 102, 1),
(139, 101, 1),
(140, 100, 1),
(141, 99, 1),
(142, 98, 1),
(143, 97, 1),
(144, 96, 1),
(145, 95, 1),
(146, 94, 1),
(147, 93, 1),
(148, 92, 1),
(149, 91, 1),
(150, 90, 1),
(151, 89, 1),
(152, 88, 1),
(153, 87, 1),
(154, 86, 1),
(155, 85, 1),
(156, 84, 1),
(157, 83, 1),
(158, 82, 1),
(159, 81, 1),
(160, 80, 1),
(161, 79, 1),
(162, 78, 1),
(163, 77, 1),
(164, 76, 1),
(165, 75, 1),
(166, 74, 1),
(167, 73, 1),
(168, 72, 1),
(169, 71, 1),
(170, 70, 1),
(171, 69, 1),
(172, 68, 1),
(173, 67, 1),
(174, 66, 1),
(175, 65, 1),
(176, 64, 1),
(177, 63, 1),
(178, 62, 1),
(179, 61, 1),
(180, 60, 1),
(181, 59, 1),
(182, 58, 1),
(183, 57, 1),
(184, 56, 1),
(185, 55, 1),
(186, 54, 1),
(187, 53, 1),
(188, 52, 1),
(189, 51, 1),
(190, 50, 1),
(191, 49, 1),
(192, 48, 1),
(193, 47, 1),
(194, 46, 1),
(195, 45, 1),
(196, 44, 1),
(197, 43, 1),
(198, 42, 1),
(199, 41, 1),
(200, 40, 1),
(201, 39, 1),
(202, 38, 1),
(203, 37, 1),
(204, 36, 1),
(205, 35, 1),
(206, 34, 1),
(207, 33, 1),
(208, 32, 1),
(209, 31, 1),
(210, 30, 1),
(211, 29, 1),
(212, 28, 1),
(213, 27, 1),
(214, 26, 1),
(215, 25, 1),
(216, 24, 1),
(217, 23, 1),
(218, 22, 1),
(219, 21, 1),
(220, 20, 1),
(221, 19, 1),
(222, 18, 1),
(223, 17, 1),
(224, 16, 1),
(225, 15, 1),
(226, 14, 1),
(227, 13, 1),
(228, 12, 1),
(229, 11, 1),
(230, 10, 1),
(231, 9, 1),
(232, 8, 1),
(233, 7, 1),
(234, 6, 1),
(235, 5, 1),
(236, 4, 1),
(237, 3, 1),
(238, 2, 1),
(239, 1, 1),
(240, 239, 2),
(241, 238, 2),
(242, 237, 2),
(243, 236, 2),
(244, 235, 2),
(245, 234, 2),
(246, 233, 2),
(247, 232, 2),
(248, 231, 2),
(249, 230, 2),
(250, 229, 2),
(251, 228, 2),
(252, 227, 2),
(253, 226, 2),
(254, 225, 2),
(255, 224, 2),
(256, 223, 2),
(257, 222, 2),
(258, 221, 2),
(259, 220, 2),
(260, 219, 2),
(261, 218, 2),
(262, 217, 2),
(263, 216, 2),
(264, 215, 2),
(265, 214, 2),
(266, 213, 2),
(267, 212, 2),
(268, 211, 2),
(269, 210, 2),
(270, 209, 2),
(271, 208, 2),
(272, 207, 2),
(273, 206, 2),
(274, 205, 2),
(275, 204, 2),
(276, 203, 2),
(277, 202, 2),
(278, 201, 2),
(279, 200, 2),
(280, 199, 2),
(281, 198, 2),
(282, 197, 2),
(283, 196, 2),
(284, 195, 2),
(285, 194, 2),
(286, 193, 2),
(287, 192, 2),
(288, 191, 2),
(289, 190, 2),
(290, 189, 2),
(291, 188, 2),
(292, 187, 2),
(293, 186, 2),
(294, 185, 2),
(295, 184, 2),
(296, 183, 2),
(297, 182, 2),
(298, 181, 2),
(299, 180, 2),
(300, 179, 2),
(301, 178, 2),
(302, 177, 2),
(303, 176, 2),
(304, 175, 2),
(305, 174, 2),
(306, 173, 2),
(307, 172, 2),
(308, 171, 2),
(309, 170, 2),
(310, 169, 2),
(311, 168, 2),
(312, 167, 2),
(313, 166, 2),
(314, 165, 2),
(315, 164, 2),
(316, 163, 2),
(317, 162, 2),
(318, 161, 2),
(319, 160, 2),
(320, 159, 2),
(321, 158, 2),
(322, 157, 2),
(323, 156, 2),
(324, 155, 2),
(325, 154, 2),
(326, 153, 2),
(327, 152, 2),
(328, 151, 2),
(329, 150, 2),
(330, 149, 2),
(331, 148, 2),
(332, 147, 2),
(333, 146, 2),
(334, 145, 2),
(335, 144, 2),
(336, 143, 2),
(337, 142, 2),
(338, 141, 2),
(339, 140, 2),
(340, 139, 2),
(341, 138, 2),
(342, 137, 2),
(343, 136, 2),
(344, 135, 2),
(345, 134, 2),
(346, 133, 2),
(347, 132, 2),
(348, 131, 2),
(349, 130, 2),
(350, 129, 2),
(351, 128, 2),
(352, 127, 2),
(353, 126, 2),
(354, 125, 2),
(355, 124, 2),
(356, 123, 2),
(357, 122, 2),
(358, 121, 2),
(359, 120, 2),
(360, 119, 2),
(361, 118, 2),
(362, 117, 2),
(363, 116, 2),
(364, 115, 2),
(365, 114, 2),
(366, 113, 2),
(367, 112, 2),
(368, 111, 2),
(369, 110, 2),
(370, 109, 2),
(371, 108, 2),
(372, 107, 2),
(373, 106, 2),
(374, 105, 2),
(375, 104, 2),
(376, 103, 2),
(377, 102, 2),
(378, 101, 2),
(379, 100, 2),
(380, 99, 2),
(381, 98, 2),
(382, 97, 2),
(383, 96, 2),
(384, 95, 2),
(385, 94, 2),
(386, 93, 2),
(387, 92, 2),
(388, 91, 2),
(389, 90, 2),
(390, 89, 2),
(391, 88, 2),
(392, 87, 2),
(393, 86, 2),
(394, 85, 2),
(395, 84, 2),
(396, 83, 2),
(397, 82, 2),
(398, 81, 2),
(399, 80, 2),
(400, 79, 2),
(401, 78, 2),
(402, 77, 2),
(403, 76, 2),
(404, 75, 2),
(405, 74, 2),
(406, 73, 2),
(407, 72, 2),
(408, 71, 2),
(409, 70, 2),
(410, 69, 2),
(411, 68, 2),
(412, 67, 2),
(413, 66, 2),
(414, 65, 2),
(415, 64, 2),
(416, 63, 2),
(417, 62, 2),
(418, 61, 2),
(419, 60, 2),
(420, 59, 2),
(421, 58, 2),
(422, 57, 2),
(423, 56, 2),
(424, 55, 2),
(425, 54, 2),
(426, 53, 2),
(427, 52, 2),
(428, 51, 2),
(429, 50, 2),
(430, 49, 2),
(431, 48, 2),
(432, 47, 2),
(433, 46, 2),
(434, 45, 2),
(435, 44, 2),
(436, 43, 2),
(437, 42, 2),
(438, 41, 2),
(439, 40, 2),
(440, 39, 2),
(441, 38, 2),
(442, 37, 2),
(443, 36, 2),
(444, 35, 2),
(445, 34, 2),
(446, 33, 2),
(447, 32, 2),
(448, 31, 2),
(449, 30, 2),
(450, 29, 2),
(451, 28, 2),
(452, 27, 2),
(453, 26, 2),
(454, 25, 2),
(455, 24, 2),
(456, 23, 2),
(457, 22, 2),
(458, 21, 2),
(459, 20, 2),
(460, 19, 2),
(461, 18, 2),
(462, 17, 2),
(463, 16, 2),
(464, 15, 2),
(465, 14, 2),
(466, 13, 2),
(467, 12, 2),
(468, 11, 2),
(469, 10, 2),
(470, 9, 2),
(471, 8, 2),
(472, 7, 2),
(473, 6, 2),
(474, 5, 2),
(475, 4, 2),
(476, 3, 2),
(477, 2, 2),
(478, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_shipping_method_price_weight`
--

DROP TABLE IF EXISTS `#__jshopping_shipping_method_price_weight`;
CREATE TABLE IF NOT EXISTS `#__jshopping_shipping_method_price_weight` (
  `sh_pr_weight_id` int(11) NOT NULL AUTO_INCREMENT,
  `sh_pr_method_id` int(11) NOT NULL,
  `shipping_price` decimal(12,2) NOT NULL,
  `shipping_weight_from` decimal(12,2) NOT NULL,
  `shipping_weight_to` decimal(12,2) NOT NULL,
  `shipping_package_price` decimal(12,2) NOT NULL,
  PRIMARY KEY (`sh_pr_weight_id`),
  KEY `sh_pr_method_id` (`sh_pr_method_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__jshopping_shipping_method_price_weight`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_taxes`
--

DROP TABLE IF EXISTS `#__jshopping_taxes`;
CREATE TABLE IF NOT EXISTS `#__jshopping_taxes` (
  `tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_name` varchar(50) NOT NULL DEFAULT '',
  `tax_value` decimal(12,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`tax_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `#__jshopping_taxes`
--

INSERT INTO `#__jshopping_taxes` (`tax_id`, `tax_name`, `tax_value`) VALUES
(1, 'Normal', '19.00');

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_taxes_ext`
--

DROP TABLE IF EXISTS `#__jshopping_taxes_ext`;
CREATE TABLE IF NOT EXISTS `#__jshopping_taxes_ext` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_id` int(11) NOT NULL,
  `zones` text NOT NULL,
  `tax` decimal(12,2) NOT NULL,
  `firma_tax` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__jshopping_taxes_ext`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_unit`
--

DROP TABLE IF EXISTS `#__jshopping_unit`;
CREATE TABLE IF NOT EXISTS `#__jshopping_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qty` int(11) NOT NULL DEFAULT '1',
  `name_de-DE` varchar(255) NOT NULL,
  `name_en-GB` varchar(255) NOT NULL,
  `name_nl-NL` varchar(255) NOT NULL,
  `name_ru-RU` varchar(255) NOT NULL,
  `name_sv-SE` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `#__jshopping_unit`
--

INSERT INTO `#__jshopping_unit` (`id`, `qty`, `name_de-DE`, `name_en-GB`, `name_nl-NL`, `name_ru-RU`, `name_sv-SE`) VALUES
(1, 1, 'Liter', 'Liter', 'Liter', 'Liter', 'Liter');

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_usergroups`
--

DROP TABLE IF EXISTS `#__jshopping_usergroups`;
CREATE TABLE IF NOT EXISTS `#__jshopping_usergroups` (
  `usergroup_id` int(11) NOT NULL AUTO_INCREMENT,
  `usergroup_name` varchar(64) NOT NULL,
  `usergroup_discount` decimal(12,2) NOT NULL,
  `usergroup_description` text NOT NULL,
  `usergroup_is_default` tinyint(1) NOT NULL,
  PRIMARY KEY (`usergroup_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `#__jshopping_usergroups`
--

INSERT INTO `#__jshopping_usergroups` (`usergroup_id`, `usergroup_name`, `usergroup_discount`, `usergroup_description`, `usergroup_is_default`) VALUES
(1, 'Default', '0.00', 'Default', 1);

-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_users`
--

DROP TABLE IF EXISTS `#__jshopping_users`;
CREATE TABLE IF NOT EXISTS `#__jshopping_users` (
  `user_id` int(11) NOT NULL,
  `usergroup_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `u_name` varchar(150) NOT NULL,
  `title` tinyint(1) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `firma_name` varchar(100) NOT NULL,
  `client_type` tinyint(1) NOT NULL,
  `firma_code` varchar(100) NOT NULL,
  `tax_number` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` int(11) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `mobil_phone` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `ext_field_1` varchar(255) NOT NULL,
  `ext_field_2` varchar(255) NOT NULL,
  `ext_field_3` varchar(255) NOT NULL,
  `delivery_adress` tinyint(1) NOT NULL,
  `d_title` tinyint(1) NOT NULL,
  `d_f_name` varchar(255) NOT NULL,
  `d_l_name` varchar(255) NOT NULL,
  `d_firma_name` varchar(100) NOT NULL,
  `d_email` varchar(255) NOT NULL,
  `d_street` varchar(255) NOT NULL,
  `d_zip` varchar(20) NOT NULL,
  `d_city` varchar(100) NOT NULL,
  `d_state` varchar(100) NOT NULL,
  `d_country` int(11) NOT NULL,
  `d_phone` varchar(20) NOT NULL,
  `d_mobil_phone` varchar(20) NOT NULL,
  `d_fax` varchar(20) NOT NULL,
  `d_ext_field_1` varchar(255) NOT NULL,
  `d_ext_field_2` varchar(255) NOT NULL,
  `d_ext_field_3` varchar(255) NOT NULL,
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__jshopping_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__jshopping_vendors`
--

DROP TABLE IF EXISTS `#__jshopping_vendors`;
CREATE TABLE IF NOT EXISTS `#__jshopping_vendors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__jshopping_vendors`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__languages`
--

DROP TABLE IF EXISTS `#__languages`;
CREATE TABLE IF NOT EXISTS `#__languages` (
  `lang_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lang_code` char(7) NOT NULL,
  `title` varchar(50) NOT NULL,
  `title_native` varchar(50) NOT NULL,
  `sef` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `description` varchar(512) NOT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `published` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lang_id`),
  UNIQUE KEY `idx_sef` (`sef`),
  KEY `idx_ordering` (`ordering`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `#__languages`
--

INSERT INTO `#__languages` (`lang_id`, `lang_code`, `title`, `title_native`, `sef`, `image`, `description`, `metakey`, `metadesc`, `published`, `ordering`) VALUES
(1, 'en-GB', 'English (UK)', 'English (UK)', 'en', 'en', '', '', '', 1, 1),
(2, 'de-DE', 'German', 'German', 'de', 'de', '', '', '', 1, 2),
(3, 'nl-NL', 'Dutch', 'Dutch', 'nl', 'nl', '', '', '', 1, 3),
(4, 'sv-SE', 'Suedish', 'Suedish', 'sv', 'sv', '', '', '', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `#__menu`
--

DROP TABLE IF EXISTS `#__menu`;
CREATE TABLE IF NOT EXISTS `#__menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype` varchar(24) NOT NULL COMMENT 'The type of menu this item belongs to. FK to #__menu_types.menutype',
  `title` varchar(255) NOT NULL COMMENT 'The display title of the menu item.',
  `alias` varchar(255) NOT NULL COMMENT 'The SEF alias of the menu item.',
  `note` varchar(255) NOT NULL DEFAULT '',
  `path` varchar(1024) NOT NULL COMMENT 'The computed path of the menu item based on the alias field.',
  `link` varchar(1024) NOT NULL COMMENT 'The actually link the menu item refers to.',
  `type` varchar(16) NOT NULL COMMENT 'The type of link: Component, URL, Alias, Separator',
  `published` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The published state of the menu link.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'The parent menu item in the menu tree.',
  `level` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The relative level in the tree.',
  `component_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__extensions.id',
  `ordering` int(11) NOT NULL DEFAULT '0' COMMENT 'The relative ordering of the menu item in the tree.',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__users.id',
  `checked_out_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'The time the menu item was checked out.',
  `browserNav` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The click behaviour of the link.',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'The access level required to view the menu item.',
  `img` varchar(255) NOT NULL COMMENT 'The image of the menu item.',
  `template_style_id` int(10) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL COMMENT 'JSON encoded data for the menu item.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `home` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Indicates if this menu item is the home or default page.',
  `language` char(7) NOT NULL DEFAULT '',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_client_id_parent_id_alias` (`client_id`,`parent_id`,`alias`),
  KEY `idx_componentid` (`component_id`,`menutype`,`published`,`access`),
  KEY `idx_menutype` (`menutype`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_path` (`path`(333)),
  KEY `idx_language` (`language`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=543 ;

--
-- Dumping data for table `#__menu`
--

INSERT INTO `#__menu` (`id`, `menutype`, `title`, `alias`, `note`, `path`, `link`, `type`, `published`, `parent_id`, `level`, `component_id`, `ordering`, `checked_out`, `checked_out_time`, `browserNav`, `access`, `img`, `template_style_id`, `params`, `lft`, `rgt`, `home`, `language`, `client_id`) VALUES
(1, '', 'Menu_Item_Root', 'root', '', '', '', '', 1, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 0, '', 0, '', 0, 195, 0, '*', 0),
(2, 'menu', 'com_banners', 'Banners', '', 'Banners', 'index.php?option=com_banners', 'component', 0, 1, 1, 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners', 0, '', 77, 86, 0, '*', 1),
(3, 'menu', 'com_banners', 'Banners', '', 'Banners/Banners', 'index.php?option=com_banners', 'component', 0, 2, 2, 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners', 0, '', 78, 79, 0, '*', 1),
(4, 'menu', 'com_banners_categories', 'Categories', '', 'Banners/Categories', 'index.php?option=com_categories&extension=com_banners', 'component', 0, 2, 2, 6, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-cat', 0, '', 80, 81, 0, '*', 1),
(5, 'menu', 'com_banners_clients', 'Clients', '', 'Banners/Clients', 'index.php?option=com_banners&view=clients', 'component', 0, 2, 2, 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-clients', 0, '', 82, 83, 0, '*', 1),
(6, 'menu', 'com_banners_tracks', 'Tracks', '', 'Banners/Tracks', 'index.php?option=com_banners&view=tracks', 'component', 0, 2, 2, 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-tracks', 0, '', 84, 85, 0, '*', 1),
(7, 'menu', 'com_contact', 'Contacts', '', 'Contacts', 'index.php?option=com_contact', 'component', 0, 1, 1, 8, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact', 0, '', 87, 92, 0, '*', 1),
(8, 'menu', 'com_contact', 'Contacts', '', 'Contacts/Contacts', 'index.php?option=com_contact', 'component', 0, 7, 2, 8, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact', 0, '', 88, 89, 0, '*', 1),
(9, 'menu', 'com_contact_categories', 'Categories', '', 'Contacts/Categories', 'index.php?option=com_categories&extension=com_contact', 'component', 0, 7, 2, 6, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact-cat', 0, '', 90, 91, 0, '*', 1),
(10, 'menu', 'com_messages', 'Messaging', '', 'Messaging', 'index.php?option=com_messages', 'component', 0, 1, 1, 15, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages', 0, '', 93, 98, 0, '*', 1),
(11, 'menu', 'com_messages_add', 'New Private Message', '', 'Messaging/New Private Message', 'index.php?option=com_messages&task=message.add', 'component', 0, 10, 2, 15, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages-add', 0, '', 94, 95, 0, '*', 1),
(12, 'menu', 'com_messages_read', 'Read Private Message', '', 'Messaging/Read Private Message', 'index.php?option=com_messages', 'component', 0, 10, 2, 15, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages-read', 0, '', 96, 97, 0, '*', 1),
(13, 'menu', 'com_newsfeeds', 'News Feeds', '', 'News Feeds', 'index.php?option=com_newsfeeds', 'component', 0, 1, 1, 17, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds', 0, '', 99, 104, 0, '*', 1),
(14, 'menu', 'com_newsfeeds_feeds', 'Feeds', '', 'News Feeds/Feeds', 'index.php?option=com_newsfeeds', 'component', 0, 13, 2, 17, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds', 0, '', 100, 101, 0, '*', 1),
(15, 'menu', 'com_newsfeeds_categories', 'Categories', '', 'News Feeds/Categories', 'index.php?option=com_categories&extension=com_newsfeeds', 'component', 0, 13, 2, 6, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds-cat', 0, '', 102, 103, 0, '*', 1),
(16, 'menu', 'com_redirect', 'Redirect', '', 'Redirect', 'index.php?option=com_redirect', 'component', 0, 1, 1, 24, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:redirect', 0, '', 113, 114, 0, '*', 1),
(17, 'menu', 'com_search', 'Search', '', 'Search', 'index.php?option=com_search', 'component', 0, 1, 1, 19, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:search', 0, '', 105, 106, 0, '*', 1),
(18, 'menu', 'com_weblinks', 'Weblinks', '', 'Weblinks', 'index.php?option=com_weblinks', 'component', 0, 1, 1, 21, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:weblinks', 0, '', 107, 112, 0, '*', 1),
(19, 'menu', 'com_weblinks_links', 'Links', '', 'Weblinks/Links', 'index.php?option=com_weblinks', 'component', 0, 18, 2, 21, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:weblinks', 0, '', 108, 109, 0, '*', 1),
(20, 'menu', 'com_weblinks_categories', 'Categories', '', 'Weblinks/Categories', 'index.php?option=com_categories&extension=com_weblinks', 'component', 0, 18, 2, 6, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:weblinks-cat', 0, '', 110, 111, 0, '*', 1),
(201, 'usermenu', 'Your Profile', 'your-profile', '', 'your-profile', 'index.php?option=com_users&view=profile', 'component', 1, 1, 1, 25, 0, 0, '0000-00-00 00:00:00', 0, 2, '', 115, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 115, 116, 0, '*', 0),
(294, 'mainmenu', 'Features', 'features', '', 'features', 'index.php?option=com_content&view=category&id=79', 'component', 1, 1, 1, 22, -4, 0, '0000-00-00 00:00:00', 0, 1, '', 115, '{"show_category_title":"","show_description":"","show_description_image":"","maxLevel":"","show_empty_categories":"","show_no_articles":"","show_subcat_desc":"","show_cat_num_articles":"","page_subheading":"","show_pagination_limit":"","filter_field":"","show_headings":"","list_show_date":"","date_format":"","list_show_hits":"","list_show_author":"","orderby_pri":"","orderby_sec":"","order_date":"","show_pagination":"","show_pagination_results":"","display_num":"10","show_title":"","link_titles":"","show_intro":"","show_category":"0","link_category":"","show_parent_category":"0","link_parent_category":"","show_author":"0","link_author":"","show_create_date":"0","show_modify_date":"0","show_publish_date":"0","show_item_navigation":"0","show_vote":"","show_readmore":"","show_readmore_title":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"0","show_noauth":"","show_feed_link":"","feed_summary":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"icemega_subtitle":"Hot!","icemega_cols":"3","icemega_width":"560","icemega_colwidth":"240,320","icemega_cols_items":"6,1","icemega_subtype":"menu"}', 3, 22, 0, '*', 0),
(472, 'main', 'products', 'products', '', 'joomshopping/products', 'index.php?option=com_jshopping&controller=products&category_id=0', 'component', 0, 470, 2, 10004, 0, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jshopping/images/jshop_products_s.png', 0, '', 124, 125, 0, '', 1),
(473, 'main', 'orders', 'orders', '', 'joomshopping/orders', 'index.php?option=com_jshopping&controller=orders', 'component', 0, 470, 2, 10004, 0, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jshopping/images/jshop_orders_s.png', 0, '', 126, 127, 0, '', 1),
(474, 'main', 'clients', 'clients', '', 'joomshopping/clients', 'index.php?option=com_jshopping&controller=users', 'component', 0, 470, 2, 10004, 0, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jshopping/images/jshop_users_s.png', 0, '', 128, 129, 0, '', 1),
(475, 'main', 'options', 'options', '', 'joomshopping/options', 'index.php?option=com_jshopping&controller=other', 'component', 0, 470, 2, 10004, 0, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jshopping/images/jshop_options_s.png', 0, '', 130, 131, 0, '', 1),
(476, 'main', 'configuration', 'configuration', '', 'joomshopping/configuration', 'index.php?option=com_jshopping&controller=config', 'component', 0, 470, 2, 10004, 0, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jshopping/images/jshop_configuration_s.png', 0, '', 132, 133, 0, '', 1),
(477, 'main', 'install-and-update', 'install-and-update', '', 'joomshopping/install-and-update', 'index.php?option=com_jshopping&controller=update', 'component', 0, 470, 2, 10004, 0, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jshopping/images/jshop_update_s.png', 0, '', 134, 135, 0, '', 1),
(478, 'main', 'about-as', 'about-as', '', 'joomshopping/about-as', 'index.php?option=com_jshopping&controller=info', 'component', 0, 470, 2, 10004, 0, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jshopping/images/jshop_info_s.png', 0, '', 136, 137, 0, '', 1),
(481, 'mainmenu', 'IceTabs', 'icetabs', '', 'extensions/icetabs', 'index.php?option=com_content&view=article&id=78', 'component', 1, 480, 2, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 24, 25, 0, '*', 0),
(482, 'mainmenu', 'IceAccordion', 'iceaccordion', '', 'extensions/iceaccordion', 'index.php?option=com_content&view=article&id=73', 'component', 1, 480, 2, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 26, 27, 0, '*', 0),
(483, 'mainmenu', 'IceCarousel', 'icecarousel', '', 'extensions/icecarousel', 'index.php?option=com_content&view=article&id=74', 'component', 1, 480, 2, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 28, 29, 0, '*', 0),
(484, 'mainmenu', 'IceShare', 'iceshare', '', 'extensions/iceshare', 'index.php?option=com_content&view=article&id=76', 'component', 0, 480, 2, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 30, 31, 0, '*', 0),
(485, 'mainmenu', 'IceSpeed', 'icespeed', '', 'extensions/icespeed', 'index.php?option=com_content&view=article&id=77', 'component', 1, 480, 2, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 32, 33, 0, '*', 0),
(486, 'mainmenu', 'IceMegaMenu', 'icemegamenu', '', 'extensions/icemegamenu', 'index.php?option=com_content&view=article&id=75', 'component', 1, 480, 2, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 34, 35, 0, '*', 0),
(487, 'mainmenu', 'Joomla', 'joomla', '', 'joomla', '', 'separator', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu_image":"","menu_text":1}', 43, 74, 0, '*', 0),
(488, 'mainmenu', 'Joomla Content', 'joomla-content', '', 'joomla/joomla-content', '', 'separator', 1, 487, 2, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu_image":"","menu_text":1}', 44, 55, 0, '*', 0),
(489, 'mainmenu', 'Archived Articles', 'archived-articles', '', 'joomla/joomla-content/archived-articles', 'index.php?option=com_content&view=archive', 'component', 1, 488, 3, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"orderby_sec":"alpha","order_date":"created","display_num":"5","filter_field":"hide","introtext_limit":"100","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","link_titles":"","show_intro":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_hits":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 45, 46, 0, '*', 0),
(490, 'mainmenu', 'List All Categories', 'list-all-categories', '', 'joomla/joomla-content/list-all-categories', 'index.php?option=com_content&view=categories&id=0', 'component', 1, 488, 3, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_base_description":"","categories_description":"","maxLevelcat":"","show_empty_categories_cat":"","show_subcat_desc_cat":"","show_cat_num_articles_cat":"","show_category_title":"","show_description":"","show_description_image":"","maxLevel":"","show_empty_categories":"","show_no_articles":"","show_subcat_desc":"","show_cat_num_articles":"","num_leading_articles":"1","num_intro_articles":"4","num_columns":"2","num_links":"4","multi_column_order":"","show_subcategory_content":"","orderby_pri":"","orderby_sec":"","order_date":"","show_pagination":"","show_pagination_results":"","show_pagination_limit":"","filter_field":"","show_headings":"","list_show_date":"","date_format":"","list_show_hits":"","list_show_author":"","display_num":"10","show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_readmore":"","show_readmore_title":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","show_feed_link":"","feed_summary":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 47, 48, 0, '*', 0),
(491, 'mainmenu', 'Category Blog', 'category-blog', '', 'joomla/joomla-content/category-blog', 'index.php?option=com_content&view=category&layout=blog&id=80', 'component', 1, 488, 3, 22, 0, 42, '2011-08-17 12:27:20', 0, 1, '', 0, '{"layout_type":"blog","show_category_title":"","show_description":"","show_description_image":"","maxLevel":"","show_empty_categories":"","show_no_articles":"","show_subcat_desc":"","show_cat_num_articles":"","page_subheading":"","num_leading_articles":"","num_intro_articles":"","num_columns":"","num_links":"","multi_column_order":"","show_subcategory_content":"","orderby_pri":"","orderby_sec":"","order_date":"","show_pagination":"","show_pagination_results":"","show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_readmore":"","show_readmore_title":"0","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","show_feed_link":"","feed_summary":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 49, 50, 0, '*', 0),
(492, 'mainmenu', 'Category List', 'category-list', '', 'joomla/joomla-content/category-list', 'index.php?option=com_content&view=category&id=80', 'component', 1, 488, 3, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_category_title":"","show_description":"","show_description_image":"","maxLevel":"","show_empty_categories":"","show_no_articles":"","show_subcat_desc":"","show_cat_num_articles":"","page_subheading":"","show_pagination_limit":"","filter_field":"","show_headings":"","list_show_date":"","date_format":"","list_show_hits":"","list_show_author":"","orderby_pri":"","orderby_sec":"","order_date":"","show_pagination":"","show_pagination_results":"","display_num":"10","show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_readmore":"","show_readmore_title":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","show_feed_link":"","feed_summary":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 51, 52, 0, '*', 0),
(493, 'mainmenu', 'Featured Articles', 'featured-articles', '', 'joomla/joomla-content/featured-articles', 'index.php?option=com_content&view=featured', 'component', 1, 488, 3, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"featured_categories":[""],"layout_type":"blog","num_leading_articles":"","num_intro_articles":"","num_columns":"","num_links":"","multi_column_order":"","orderby_pri":"","orderby_sec":"","order_date":"","show_pagination":"","show_pagination_results":"","show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_readmore":"","show_readmore_title":"0","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","show_feed_link":"","feed_summary":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 53, 54, 0, '*', 0),
(494, 'mainmenu', 'Joomla Components', 'joomla-components', '', 'joomla/joomla-components', '', 'separator', 1, 487, 2, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu_image":"","menu_text":1}', 56, 73, 0, '*', 0),
(495, 'mainmenu', 'List Contacts', 'list-contacts', '', 'joomla/joomla-components/list-contacts', 'index.php?option=com_contact&view=category&id=16', 'component', 1, 494, 3, 8, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_category_title":"","show_description":"","show_description_image":"","maxLevel":"","show_empty_categories":"","show_subcat_desc":"","show_cat_items":"","show_pagination_limit":"","show_headings":"","show_position_headings":"","show_email_headings":"","show_telephone_headings":"","show_mobile_headings":"","show_fax_headings":"","show_suburb_headings":"","show_state_headings":"","show_country_headings":"","show_pagination":"","show_pagination_results":"","presentation_style":"","show_contact_category":"","show_contact_list":"","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_links":"","linka_name":"","linkb_name":"","linkc_name":"","linkd_name":"","linke_name":"","show_email_form":"","show_email_copy":"","banned_email":"","banned_subject":"","banned_text":"","validate_session":"","custom_reply":"","redirect":"","show_feed_link":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 57, 58, 0, '*', 0),
(496, 'mainmenu', 'Contact Us', 'contact-us', '', 'joomla/joomla-components/contact-us', 'index.php?option=com_contact&view=contact&id=6', 'component', 1, 494, 3, 8, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"presentation_style":"","show_contact_category":"","show_contact_list":"","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_links":"","linka_name":"","linkb_name":"","linkc_name":"","linkd_name":"","linke_name":"","show_email_form":"","show_email_copy":"","banned_email":"","banned_subject":"","banned_text":"","validate_session":"","custom_reply":"","redirect":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 59, 60, 0, '*', 0),
(497, 'mainmenu', 'List News Feeds', 'list-news-feeds', '', 'joomla/joomla-components/list-news-feeds', 'index.php?option=com_newsfeeds&view=category&id=17', 'component', 1, 494, 3, 17, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_category_title":"","show_description":"","show_description_image":"","maxLevel":"","show_empty_categories":"","show_subcat_desc":"","show_cat_items":"","show_pagination_limit":"","show_headings":"","show_articles":"","show_link":"","show_pagination":"","show_pagination_results":"","show_feed_image":"","show_feed_description":"","show_item_description":"","feed_character_count":"0","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 61, 62, 0, '*', 0),
(498, 'mainmenu', 'News Feeds', 'news-feeds', '', 'joomla/joomla-components/news-feeds', 'index.php?option=com_newsfeeds&view=newsfeed&id=1', 'component', 1, 494, 3, 17, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_feed_image":"","show_feed_description":"","show_item_description":"","feed_character_count":"0","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 63, 64, 0, '*', 0),
(499, 'mainmenu', 'Web Links', 'web-links', '', 'joomla/joomla-components/web-links', 'index.php?option=com_weblinks&view=category&id=18', 'component', 1, 494, 3, 21, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_category_title":"","show_description":"","show_description_image":"","maxLevel":"","show_empty_categories":"","show_subcat_desc":"","show_cat_num_links":"","show_pagination_limit":"","show_headings":"","show_link_description":"","show_link_hits":"","show_pagination":"","show_pagination_results":"","show_feed_link":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 65, 66, 0, '*', 0),
(500, 'mainmenu', 'Wrapper', 'wrapper', '', 'joomla/joomla-components/wrapper', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 494, 3, 2, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"url":"www.google.com","scrolling":"auto","width":"100%","height":"500","height_auto":"0","add_scheme":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 67, 68, 0, '*', 0),
(501, 'mainmenu', 'Login Form', 'login-form', '', 'joomla/joomla-components/login-form', 'index.php?option=com_users&view=login', 'component', 1, 494, 3, 25, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"login_redirect_url":"","logindescription_show":"1","login_description":"","login_image":"","logout_redirect_url":"","logoutdescription_show":"1","logout_description":"","logout_image":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 69, 70, 0, '*', 0),
(502, 'mainmenu', 'Registration Form', 'registration-form', '', 'joomla/joomla-components/registration-form', 'index.php?option=com_users&view=registration', 'component', 1, 494, 3, 25, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 71, 72, 0, '*', 0),
(503, 'mainmenu', 'JoomShopping', 'joomshopping', '', 'joomshopping', 'index.php?option=com_jshopping&controller=category', 'component', 1, 1, 1, 10004, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"icemega_subtitle":"e-commerce ready","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 75, 76, 0, '*', 0),
(506, 'topmenu', 'Contact Us', 'contact-us', '', 'contact-us', 'index.php?option=com_contact&view=contact&id=6', 'component', 1, 1, 1, 8, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"presentation_style":"","show_contact_category":"","show_contact_list":"","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_links":"","linka_name":"","linkb_name":"","linkc_name":"","linkd_name":"","linke_name":"","show_email_form":"","show_email_copy":"","banned_email":"","banned_subject":"","banned_text":"","validate_session":"","custom_reply":"","redirect":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 141, 142, 0, '*', 0),
(505, 'topmenu', 'My Account', 'my-account', '', 'my-account', 'index.php?option=com_jshopping&controller=user', 'component', 1, 1, 1, 10004, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 139, 140, 0, '*', 0),
(510, 'menu-german', 'Home (German)', 'home-german', '', 'home-german', 'index.php?option=com_content&view=featured', 'component', 1, 1, 1, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"featured_categories":["9"],"layout_type":"blog","num_leading_articles":"","num_intro_articles":"","num_columns":"","num_links":"","multi_column_order":"","orderby_pri":"","orderby_sec":"","order_date":"","show_pagination":"","show_pagination_results":"","show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_readmore":"","show_readmore_title":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","show_feed_link":"","feed_summary":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 145, 146, 1, 'de-DE', 0),
(511, 'menu-suedish', 'Home (Suedish)', 'home-suedish', '', 'home-suedish', 'index.php?option=com_content&view=featured', 'component', 1, 1, 1, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"featured_categories":["9"],"layout_type":"blog","num_leading_articles":"","num_intro_articles":"","num_columns":"","num_links":"","multi_column_order":"","orderby_pri":"","orderby_sec":"","order_date":"","show_pagination":"","show_pagination_results":"","show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_readmore":"","show_readmore_title":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","show_feed_link":"","feed_summary":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 147, 148, 1, 'sv-SE', 0),
(512, 'menu-english', 'Home (English)', 'home-english', '', 'home-english', 'index.php?option=com_content&view=featured', 'component', 1, 1, 1, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"featured_categories":["9"],"layout_type":"blog","num_leading_articles":"","num_intro_articles":"","num_columns":"","num_links":"","multi_column_order":"","orderby_pri":"","orderby_sec":"","order_date":"","show_pagination":"","show_pagination_results":"","show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_readmore":"","show_readmore_title":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","show_feed_link":"","feed_summary":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 149, 150, 1, 'en-GB', 0),
(513, 'order-support', 'Order Status', '2011-08-08-14-17-09', '', '2011-08-08-14-17-09', '#1', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 151, 152, 0, '*', 0),
(514, 'order-support', 'Store Pickup', '2011-08-08-14-17-30', '', '2011-08-08-14-17-30', '#2', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 153, 154, 0, '*', 0),
(515, 'order-support', 'Store Pickup', '2011-08-08-14-17-47', '', '2011-08-08-14-17-47', '#3', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 155, 156, 0, '*', 0),
(516, 'order-support', 'Returns & Refunds', '2011-08-08-14-18-00', '', '2011-08-08-14-18-00', '#4', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 157, 158, 0, '*', 0),
(517, 'order-support', 'Customer Service', '2011-08-08-14-18-31', '', '2011-08-08-14-18-31', '#5', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 159, 160, 0, '*', 0),
(518, 'product-support', 'Installation & Delivery', '2011-08-08-14-19-16', '', '2011-08-08-14-19-16', '#11', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 161, 162, 0, '*', 0),
(519, 'product-support', 'Product Recalls', '2011-08-08-14-19-34', '', '2011-08-08-14-19-34', '#12', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 163, 164, 0, '*', 0),
(520, 'product-support', 'Buy Back Program', '2011-08-08-14-19-48', '', '2011-08-08-14-19-48', '#13', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 165, 166, 0, '*', 0),
(521, 'product-support', 'Trade-in Center', '2011-08-08-14-20-01', '', '2011-08-08-14-20-01', '#14', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 167, 168, 0, '*', 0),
(522, 'product-support', 'Recycling', '2011-08-08-14-20-13', '', '2011-08-08-14-20-13', '#15', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 169, 170, 0, '*', 0),
(523, 'corporate-info', 'About TheShop', '2011-08-08-14-22-08', '', '2011-08-08-14-22-08', '#21', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 171, 172, 0, '*', 0),
(524, 'corporate-info', 'Careers', '2011-08-08-14-22-25', '', '2011-08-08-14-22-25', '#22', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 173, 174, 0, '*', 0),
(525, 'corporate-info', 'Sustainability', '2011-08-08-14-22-36', '', '2011-08-08-14-22-36', '#23', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 175, 176, 0, '*', 0),
(526, 'corporate-info', 'Affiliate Program', '2011-08-08-14-22-55', '', '2011-08-08-14-22-55', '#24', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 177, 178, 0, '*', 0),
(527, 'corporate-info', 'Contact Us', '2011-08-08-14-23-06', '', '2011-08-08-14-23-06', '#25', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 179, 180, 0, '*', 0),
(528, 'get-connected', 'Facebook Page', '2011-08-08-14-24-23', '', '2011-08-08-14-24-23', '#41', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"images\\/sampledata\\/icetheme\\/icon_facebook.png","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 181, 182, 0, '*', 0),
(529, 'get-connected', 'Twitter Page', '2011-08-08-14-24-49', '', '2011-08-08-14-24-49', '#42', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"images\\/sampledata\\/icetheme\\/icon_twitter.png","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 183, 184, 0, '*', 0),
(530, 'get-connected', 'YouTube Channel', '2011-08-08-14-25-29', '', '2011-08-08-14-25-29', '#43', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"images\\/sampledata\\/icetheme\\/icon_youtube.png","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 185, 186, 0, '*', 0),
(531, 'get-connected', 'RSS Feeds', '2011-08-08-14-32-59', '', '2011-08-08-14-32-59', '#44', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"images\\/sampledata\\/icetheme\\/icon_rss.png","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 187, 188, 0, '*', 0),
(532, 'copyright', 'Terms of Use', '2011-08-09-08-39-55', '', '2011-08-09-08-39-55', '#', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 189, 190, 0, '*', 0),
(533, 'copyright', 'Copyright', '2011-08-09-08-40-14', '', '2011-08-09-08-40-14', '#', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 191, 192, 0, '*', 0),
(534, 'copyright', 'Privacy & Policy', '2011-08-09-08-40-30', '', '2011-08-09-08-40-30', '#', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 193, 194, 0, '*', 0),
(538, 'mainmenu', 'Modified Pages', 'modified-pages', '', 'features/modified-pages', '', 'separator', 1, 294, 2, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 14, 19, 0, '*', 0),
(539, 'mainmenu', 'Offline Page', '2011-08-15-09-30-34', '', 'features/modified-pages/2011-08-15-09-30-34', '?tmpl=offline', 'url', 1, 538, 3, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 15, 16, 0, '*', 0),
(540, 'mainmenu', 'Error Page', '2011-08-15-09-31-17', '', 'features/modified-pages/2011-08-15-09-31-17', 'index.php/404', 'url', 1, 538, 3, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 17, 18, 0, '*', 0),
(541, 'mainmenu', 'Features Module', 'features-module', '', 'features/features-module', '', 'separator', 1, 294, 2, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"mod","icemega_modules":["130"]}', 20, 21, 0, '*', 0),
(542, 'mainmenu', 'Free Joomla Extensions', 'free-joomla-extensions', '', 'extensions/free-joomla-extensions', '', 'separator', 1, 480, 2, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"mod","icemega_modules":["131"]}', 36, 37, 0, '*', 0),
(469, 'mainmenu', 'Clone Installer', 'clone-installer', '', 'features/clone-installer', 'index.php?option=com_content&view=article&id=68', 'component', 1, 294, 2, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 12, 13, 0, '*', 0),
(468, 'mainmenu', 'Template Styles', 'template-styles', '', 'features/template-styles', 'index.php?option=com_content&view=article&id=71', 'component', 1, 294, 2, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 10, 11, 0, '*', 0),
(435, 'mainmenu', 'Home', 'homepage', '', 'homepage', 'index.php?option=com_content&view=featured', 'component', 1, 1, 1, 22, -5, 0, '0000-00-00 00:00:00', 0, 1, '', 115, '{"featured_categories":["9"],"layout_type":"blog","num_leading_articles":"1","num_intro_articles":"3","num_columns":"3","num_links":"0","multi_column_order":"1","orderby_pri":"","orderby_sec":"front","order_date":"","show_pagination":"2","show_pagination_results":"","show_title":"1","link_titles":"","show_intro":"","show_category":"0","link_category":"0","show_parent_category":"0","link_parent_category":"0","show_author":"0","link_author":"0","show_create_date":"0","show_modify_date":"0","show_publish_date":"0","show_item_navigation":"0","show_vote":"","show_readmore":"1","show_readmore_title":"","show_icons":"0","show_print_icon":"0","show_email_icon":"0","show_hits":"0","show_noauth":"","show_feed_link":"1","feed_summary":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 1, 2, 1, '*', 0),
(536, 'mainmenu', 'Template Styles', 'template-styles', '', 'template-styles', '', 'separator', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu_image":"","menu_text":1,"icemega_subtitle":"6 styles","icemega_cols":"1","icemega_width":"575","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 39, 42, 0, '*', 0),
(537, 'mainmenu', 'Template Styles', '2011-08-15-08-55-41', '', 'template-styles/2011-08-15-08-55-41', '', 'url', 1, 536, 2, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"mod","icemega_modules":["129"]}', 40, 41, 0, '*', 0),
(509, 'menu-dutch', 'Home (Dutch)', 'dumm-item-dutch', '', 'dumm-item-dutch', 'index.php?option=com_content&view=featured', 'component', 1, 1, 1, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"featured_categories":["9"],"layout_type":"blog","num_leading_articles":"","num_intro_articles":"","num_columns":"","num_links":"","multi_column_order":"","orderby_pri":"","orderby_sec":"","order_date":"","show_pagination":"","show_pagination_results":"","show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_readmore":"","show_readmore_title":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","show_feed_link":"","feed_summary":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"icemega_subtitle":"","icemega_cols":"1","icemega_width":"","icemega_colwidth":"","icemega_cols_items":"","icemega_subtype":"menu"}', 143, 144, 1, 'nl-NL', 0),
(471, 'main', 'categories', 'categories', '', 'joomshopping/categories', 'index.php?option=com_jshopping&controller=categories&catid=0', 'component', 0, 470, 2, 10004, 0, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jshopping/images/jshop_categories_s.png', 0, '', 122, 123, 0, '', 1),
(449, 'usermenu', 'Submit an Article', 'submit-an-article', '', 'submit-an-article', 'index.php?option=com_content&view=form&layout=edit', 'component', 1, 1, 1, 22, 0, 0, '0000-00-00 00:00:00', 0, 3, '', 115, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 117, 118, 0, '*', 0);
INSERT INTO `#__menu` (`id`, `menutype`, `title`, `alias`, `note`, `path`, `link`, `type`, `published`, `parent_id`, `level`, `component_id`, `ordering`, `checked_out`, `checked_out_time`, `browserNav`, `access`, `img`, `template_style_id`, `params`, `lft`, `rgt`, `home`, `language`, `client_id`) VALUES
(450, 'usermenu', 'Submit a Web Link', 'submit-a-web-link', '', 'submit-a-web-link', 'index.php?option=com_weblinks&view=form&layout=edit', 'component', 1, 1, 1, 21, 0, 0, '0000-00-00 00:00:00', 0, 3, '', 115, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 119, 120, 0, '*', 0),
(467, 'mainmenu', 'Typography', 'typography', '', 'features/typography', 'index.php?option=com_content&view=article&id=72', 'component', 1, 294, 2, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 8, 9, 0, '*', 0),
(466, 'mainmenu', 'Module Positions', 'module-positions', '', 'features/module-positions', 'index.php?option=com_content&view=article&id=69', 'component', 1, 294, 2, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 6, 7, 0, '*', 0),
(480, 'mainmenu', 'Extensions', 'extensions', '', 'extensions', 'index.php?option=com_content&view=category&id=81', 'component', 1, 1, 1, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_category_title":"","show_description":"","show_description_image":"","maxLevel":"","show_empty_categories":"","show_no_articles":"","show_subcat_desc":"","show_cat_num_articles":"","page_subheading":"","show_pagination_limit":"","filter_field":"","show_headings":"","list_show_date":"","date_format":"","list_show_hits":"","list_show_author":"","orderby_pri":"","orderby_sec":"","order_date":"","show_pagination":"","show_pagination_results":"","display_num":"10","show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_readmore":"","show_readmore_title":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","show_feed_link":"","feed_summary":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"icemega_subtitle":"Free","icemega_cols":"2","icemega_width":"560","icemega_colwidth":"240,320","icemega_cols_items":"5,1","icemega_subtype":"menu"}', 23, 38, 0, '*', 0),
(465, 'mainmenu', 'Module Variations', 'module-variations', '', 'features/module-variations', 'index.php?option=com_content&view=article&id=70', 'component', 1, 294, 2, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 4, 5, 0, '*', 0),
(470, 'main', 'JoomShopping', 'joomshopping', '', 'joomshopping', 'index.php?option=com_jshopping', 'component', 0, 1, 1, 10004, 0, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jshopping/images/jshop_logo_s.png', 0, '', 121, 138, 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `#__menu_types`
--

DROP TABLE IF EXISTS `#__menu_types`;
CREATE TABLE IF NOT EXISTS `#__menu_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menutype` varchar(24) NOT NULL,
  `title` varchar(48) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_menutype` (`menutype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `#__menu_types`
--

INSERT INTO `#__menu_types` (`id`, `menutype`, `title`, `description`) VALUES
(2, 'usermenu', 'User Menu', 'A Menu for logged in Users'),
(12, 'menu-english', 'Menu (English)', ''),
(11, 'menu-suedish', 'Menu (Suedish)', ''),
(9, 'menu-dutch', 'Menu (Dutch)', ''),
(10, 'menu-german', 'Menu (German)', ''),
(6, 'mainmenu', 'Main Menu', 'Simple Home Menu'),
(8, 'topmenu', 'TopMenu', ''),
(13, 'order-support', 'Order Support', ''),
(14, 'product-support', 'Product Support', ''),
(15, 'corporate-info', 'Corporate Info', ''),
(16, 'get-connected', 'Get Connected', ''),
(17, 'copyright', 'Copyright', '');

-- --------------------------------------------------------

--
-- Table structure for table `#__messages`
--

DROP TABLE IF EXISTS `#__messages`;
CREATE TABLE IF NOT EXISTS `#__messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_from` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id_to` int(10) unsigned NOT NULL DEFAULT '0',
  `folder_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `useridto_state` (`user_id_to`,`state`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `#__messages`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__messages_cfg`
--

DROP TABLE IF EXISTS `#__messages_cfg`;
CREATE TABLE IF NOT EXISTS `#__messages_cfg` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cfg_name` varchar(100) NOT NULL DEFAULT '',
  `cfg_value` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__messages_cfg`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__modules`
--

DROP TABLE IF EXISTS `#__modules`;
CREATE TABLE IF NOT EXISTS `#__modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(50) DEFAULT NULL,
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) DEFAULT NULL,
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `showtitle` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`),
  KEY `idx_language` (`language`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=138 ;

--
-- Dumping data for table `#__modules`
--

INSERT INTO `#__modules` (`id`, `title`, `note`, `content`, `ordering`, `position`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `published`, `module`, `access`, `showtitle`, `params`, `client_id`, `language`) VALUES
(2, 'Login', '', '', 1, 'login', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_login', 1, 1, '', 1, '*'),
(3, 'Popular Articles', '', '', 3, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_popular', 3, 1, '{"count":"5","catid":"","user_id":"0","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*'),
(4, 'Recently Added Articles', '', '', 4, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_latest', 3, 1, '{"count":"5","ordering":"c_dsc","catid":"","user_id":"0","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*'),
(8, 'Toolbar', '', '', 1, 'toolbar', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_toolbar', 3, 1, '', 1, '*'),
(9, 'Quick Icons', '', '', 1, 'icon', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_quickicon', 3, 1, '', 1, '*'),
(10, 'Logged-in Users', '', '', 2, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_logged', 3, 1, '{"count":"5","name":"1","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*'),
(12, 'Admin Menu', '', '', 1, 'menu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 3, 1, '{"layout":"","moduleclass_sfx":"","shownew":"1","showhelp":"1","cache":"0"}', 1, '*'),
(13, 'Admin Submenu', '', '', 1, 'submenu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_submenu', 3, 1, '', 1, '*'),
(14, 'User Status', '', '', 1, 'status', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_status', 3, 1, '', 1, '*'),
(15, 'Title', '', '', 1, 'title', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_title', 3, 1, '', 1, '*'),
(17, 'Breadcrumbs', '', '', 1, 'breadcrumbs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_breadcrumbs', 1, 1, '{"showHere":"1","showHome":"1","homeText":"Home","showLast":"1","separator":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(83, 'Mod Left (-style1) | sample subtitle goes here', '', '<p>This is the <strong>left</strong> module position, which is using <strong>-style1</strong> any module class suffix.</p>\r\n<p>To create a subtitle, separate the title input text in the module manager with an "|" character then enter your subtitle text.</p>', 11, 'left', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"-style1","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(84, 'Mod Left (-style2) | sample subtitle goes here (copy)', '', '<p>This is the <strong>left</strong> module position, which is using <strong>-style2</strong> any module class suffix.</p>\r\n<p>To create a subtitle, separate the title input text in the module manager with an "|" character then enter your subtitle text.</p>', 12, 'left', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"-style2","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(39, 'Who''s Online', '', '', 15, 'left', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_whosonline', 1, 1, '{"showmode":"2","linknames":"0","layout":"_:default","moduleclass_sfx":"","cache":"0"}', 0, '*'),
(41, 'Footer', '', '', 1, 'footer', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_footer', 1, 1, '{"layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(82, 'Mod Left  | sample subtitle goes here', '', '<p>This is the <strong>left</strong> module position, which is not using any module suffix.</p>\r\n<p>To create a subtitle, separate the title input text in the module manager with an "|" character then enter your subtitle text.</p>', 9, 'left', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(63, 'Search', '', '', 1, 'search', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_search', 1, 1, '{"label":"","width":"20","text":"","button":"1","button_pos":"right","imagebutton":"1","button_text":"Go!","opensearch":"1","opensearch_title":"","set_itemid":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(64, 'Language Switcher', '', '', 1, 'language', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_languages', 1, 1, '{"header_text":"","footer_text":"","dropdown":"0","image":"1","inline":"1","show_active":"1","full_name":"1","layout":"_:default","moduleclass_sfx":"","owncache":"1","cache_time":"900"}', 0, '*'),
(79, 'IceMegaMenu Module', '', '', 1, 'mainmenu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_icemegamenu', 1, 1, '{"theme_style":"","menutype":"mainmenu","startLevel":"1","endLevel":"0","showAllChildren":"1","class_sfx":"","window_open":"","tag_id":"","js_effect":"slide & fade","js_physics":"Fx.Transitions.Pow.easeOut","js_duration":"600","js_hideDelay":"1000","js_opacity":"95","use_js":"1","moduleclass_sfx":"","cache":"1","cache_time":"30","menu_images":"0","menu_images_align":"0","menu_images_link":"0","expand_menu":"0","activate_parent":"0","full_active_id":"0","indent_image":"0","indent_image1":"","indent_image2":"","indent_image3":"","indent_image4":"","indent_image5":"","indent_image6":"","spacer":"","end_spacer":""}', 0, '*'),
(80, 'IceTabs Module', '', '', 1, 'icetabs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_icetabs', 1, 1, '{"theme":"candy","module_width":"auto","module_height":"auto","main_width":"685","main_height":"240","imagemain_width":"360","imagemain_height":"220","limit_items":"5","display_button":"1","show_readmore":"0","auto_strip_tags":"0","description_max_chars":"10000","group":"content","source":"content_category","article_ids":"","content_category":["78"],"ordering":"rand_","image_folder":"images\\/sampledata\\/fruitshop","image_category":"","image_ordering":"","k2_source":"k2_category","k2_items_ids":"","featured_items_show":"1","k2_ordering":"created_asc","banner_category":[""],"banner_ordering":"ordering_desc","vm_source":"vm_category","vm_items_ids":"","vm_ordering":"cdate_asc","navigator_pos":"bottom","navitem_width":"228.3","navitem_height":"80","max_items_display":"3","auto_renderthumb":"1","image_quanlity":"80","thumbnail_width":"80","thumbnail_height":"60","title_max_chars":"55","layout_style":"hrleft","interval":"4200","duration":"500","effect":"Fx.Transitions.Quad.easeIn","auto_start":"1","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(85, 'Mod Right | sample subtitle goes here', '', '<p>This is the <strong>right</strong> module position, which is not using any module suffix.</p>\r\n<p>To create a subtitle, separate the title input text in the module manager with an "|" character then enter your subtitle text.</p>', 1, 'right', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(86, 'Mod Right (-style1) | sample subtitle goes here', '', '<p>This is the <strong>right</strong> module position, which is using <strong>-style1</strong> any module class suffix.</p>\r\n<p>To create a subtitle, separate the title input text in the module manager with an "|" character then enter your subtitle text.</p>', 2, 'right', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"-style1","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(87, 'Mod Right (-style2) | sample subtitle goes here', '', '<p>This is the <strong>right</strong> module position, which is using <strong>-style2</strong> any module class suffix.</p>\r\n<p>To create a subtitle, separate the title input text in the module manager with an "|" character then enter your subtitle text.</p>', 3, 'right', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"-style2","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(88, 'Mod Promo | sample subtitle goes here', '', '<p>This is the <strong>promo1</strong> module position, which is not using any module suffix.</p>\r\n<p>To create a subtitle, separate the title input text in the module manager with an "|" character then enter your subtitle text.</p>', 1, 'promo1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(89, 'Mod Promo2 (-style1) | sample subtitle goes here', '', '<p>This is the <strong>promo2</strong> module position, which is using <strong>-style1</strong> any module class suffix.</p>\r\n<p>To create a subtitle, separate the title input text in the module manager with an "|" character then enter your subtitle text.</p>', 1, 'promo2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(90, 'Mod Promo3 (-style2) | sample subtitle goes here', '', '<p>This is the <strong>promo3</strong> module position, which is using <strong>-style2</strong> any module class suffix.</p>\r\n<p>To create a subtitle, separate the title input text in the module manager with an "|" character then enter your subtitle text.</p>', 3, 'promo3', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(91, 'Mod Bottom1 | sample subtitle goes here', '', '<p>This is the <strong>bottom1</strong> module position, which is not using any module suffix.</p>\r\n<p>To create a subtitle, separate the title input text in the module manager with an "|" character then enter your subtitle text.</p>', 1, 'bottom1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(94, 'Mod Footer1 | sample subtitle goes here', '', '<p>This is the <strong>footer1</strong> module position, which is not using any module suffix.</p>\r\n<p>To create a subtitle, separate the title input text in the module manager with an "|" character then enter your subtitle text.</p>', 1, 'footer1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(92, 'Mod Bottom2 (-style1) | sample subtitle goes here', '', '<p>This is the <strong>bottom2</strong> module position, which is using <strong>-style1</strong> any module class suffix.</p>\r\n<p>To create a subtitle, separate the title input text in the module manager with an "|" character then enter your subtitle text.</p>', 1, 'bottom2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(93, 'Mod Bottom3 (-style2) | sample subtitle goes here', '', '<p>This is the <strong>bottom3</strong> module position, which is using <strong>-style2</strong> any module class suffix.</p>\r\n<p>To create a subtitle, separate the title input text in the module manager with an "|" character then enter your subtitle text.</p>', 1, 'bottom3', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(95, 'Mod Footer2 (-style1) | sample subtitle goes here', '', '<p>This is the <strong>footer2</strong> module position, which is using <strong>-style1</strong> any module class suffix.</p>\r\n<p>To create a subtitle, separate the title input text in the module manager with an "|" character then enter your subtitle text.</p>', 1, 'footer2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"-style1","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(96, 'Mod Footer3 (-style2) | sample subtitle goes here', '', '<p>This is the <strong>footer3</strong> module position, which is using <strong>-style2</strong> any module class suffix.</p>\r\n<p>To create a subtitle, separate the title input text in the module manager with an "|" character then enter your subtitle text.</p>', 1, 'footer3', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"-style2","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(97, 'Mod Footer4 | sample subtitle goes here', '', '<p>This is the <strong>footer4</strong> module position, which is not using any module suffix.</p>\r\n<p>To create a subtitle, separate the title input text in the module manager with an "|" character then enter your subtitle text.</p>', 1, 'footer4', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(98, 'Contact Number', '', '<p>Contact Sales: 1-800-The-Shop</p>', 1, 'contact', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(119, 'Ice Jshopping Search', '', '', 1, 'search', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_ice_jshopping_search', 1, 1, '{"advanced_search":"1","category_id":"","enable_categories":"1","moduleclass_sfx":""}', 0, '*'),
(103, 'TopMenu', '', '', 0, 'topmenu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 1, 1, '{"menutype":"topmenu","startLevel":"1","endLevel":"0","showAllChildren":"0","tag_id":"","class_sfx":"","window_open":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(104, 'Most Sold Products', '', '', 7, 'left', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_ice_accordion', 1, 1, '{"theme":"","auto_renderthumb":"1","image_quanlity":"80","main_width":"120","main_height":"75","data_source":"joomshopping","source":"content_category","article_ids":"","content_category":[""],"content_featured_items_show":"1","ordering":"ordering","order_direction":"ASC","source_from":"cat_ids","jproduct_ids":"","jcat_ids":[""],"jmanufactures":[""],"filtering_type":"1","sort_product":"most_sold","preview_width":"320","preview_height":"200","show_preview":"1","show_product_image":"1","show_image_label":"1","show_rating":"1","show_description":"1","show_old_price":"1","show_price":"1","limit_items":"12","number_page":"2","title_max_chars":"100","description_max_chars":"100","default_item":"1","show_readmore":"1","moduleclass_sfx":"-style1","enable_cache":"0","cache_time":"15"}', 0, '*'),
(111, 'Order Support', '', '', 1, 'footer1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 1, 1, '{"menutype":"order-support","startLevel":"1","endLevel":"0","showAllChildren":"0","tag_id":"","class_sfx":"","window_open":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(112, 'Product Support', '', '', 1, 'footer2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 1, 1, '{"menutype":"product-support","startLevel":"1","endLevel":"0","showAllChildren":"0","tag_id":"","class_sfx":"","window_open":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(113, 'Corporate Info', '', '', 1, 'footer3', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 1, 1, '{"menutype":"corporate-info","startLevel":"1","endLevel":"0","showAllChildren":"0","tag_id":"","class_sfx":"","window_open":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(114, 'Get Connected', '', '', 1, 'footer4', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 1, 1, '{"menutype":"get-connected","startLevel":"1","endLevel":"0","showAllChildren":"0","tag_id":"connect","class_sfx":"","window_open":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(115, 'Joomla 1.7 Template', '', '<p><img src="images/sampledata/icetheme/image1.jpg" border="0" alt="Image" width="80" height="80" /> Stay updated with the latest technology! IT TheShop is the first released Joomla 1.7 Template by IceTheme Club.</p>', 1, 'bottom1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(116, 'New IceCarosuel Mod', '', '<p><img src="images/sampledata/icetheme/image2.jpg" border="0" alt="Image" width="80" height="80" /> Maximum flexibility has never been easier for your website. The new IceCarosuel module will give your content another meaning!</p>', 1, 'bottom2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(117, 'JoomShopping Ready!', '', '<p><img src="images/sampledata/icetheme/image3.jpg" border="0" alt="Image" width="80" height="80" /> Put your next E-commerce website online within the next 15 minutes. Everything''s made ready with JoomShopping extension.</p>', 1, 'bottom3', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(118, 'Copyright Menu', '', '', 0, 'copyright', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 1, 1, '{"menutype":"copyright","startLevel":"1","endLevel":"0","showAllChildren":"0","tag_id":"","class_sfx":"","window_open":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(120, 'Ice Jshopping Cart', '', '', 1, 'cart', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_ice_jshopping_cart', 1, 1, '{"ajax":"1","dropdown":"1","moduleclass_sfx":""}', 0, '*'),
(121, 'Browse by Category', '', '', 5, 'left', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_ice_jshopping_categories', 1, 1, '{"show_image":"1","image_width":"20","image_heigth":"20","sort":"order","ordering":"asc","showcounter":"1","moduleclass_sfx":""}', 0, '*'),
(122, 'Features Menu', '', '', 4, 'left', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 1, 1, '{"menutype":"mainmenu","startLevel":"2","endLevel":"0","showAllChildren":"1","tag_id":"","class_sfx":"","window_open":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(123, 'Recommended Products', '', '', 1, 'icecarousel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_ice_carousel', 1, 1, '{"theme":"","module_width":"940","module_height":"345","main_width":"120","main_height":"75","auto_renderthumb":"1","image_quanlity":"80","data_source":"joomshopping","show_front":"show","category_filtering_type":"1","catid":[""],"show_child_category_articles":"0","levels":"1","author_filtering_type":"1","created_by":[""],"author_alias_filtering_type":"1","created_by_alias":[""],"excluded_articles":"","date_filtering":"off","date_field":"a.created","start_date_range":"","end_date_range":"","relative_date":"30","article_ordering":"a.title","article_ordering_direction":"ASC","item_heading":"3","link_titles":"1","show_date":"1","show_date_field":"created","show_date_format":"Y-m-d H:i:s","show_category":"1","show_hits":"1","show_author":"1","show_introtext":"1","show_readmore":"1","show_readmore_title":"0","readmore_limit":"15","source_from":"cat_ids","jproduct_ids":"","jcat_ids":[""],"jmanufactures":[""],"filtering_type":"1","sort_product":"random","preview_width":"320","preview_height":"200","show_preview":"1","show_product_image":"1","show_image_label":"1","show_rating":"1","show_description":"1","show_old_price":"1","show_price":"1","limit_items":"12","max_items_per_page":"4","interval":"5000","duration":"500","transition":"Fx.Transitions.Quad.easeInOut","navigator_pos":"bottom","auto_start":"0","title_max_chars":"40","description_max_chars":"110","moduleclass_sfx":"","enable_ajax":"1","enable_cache":"0","cache_time":"15"}', 0, '*'),
(124, 'Just Added Products', '', '', 1, 'jshopping1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_ice_carousel', 1, 1, '{"theme":"","module_width":"685","module_height":"335","main_width":"120","main_height":"75","auto_renderthumb":"1","image_quanlity":"80","data_source":"joomshopping","show_front":"show","category_filtering_type":"1","catid":[""],"show_child_category_articles":"0","levels":"1","author_filtering_type":"1","created_by":[""],"author_alias_filtering_type":"1","created_by_alias":[""],"excluded_articles":"","date_filtering":"off","date_field":"a.created","start_date_range":"","end_date_range":"","relative_date":"30","article_ordering":"a.title","article_ordering_direction":"ASC","item_heading":"3","link_titles":"1","show_date":"1","show_date_field":"created","show_date_format":"Y-m-d H:i:s","show_category":"1","show_hits":"1","show_author":"1","show_introtext":"1","show_readmore":"1","show_readmore_title":"0","readmore_limit":"15","source_from":"cat_ids","jproduct_ids":"","jcat_ids":[""],"jmanufactures":[""],"filtering_type":"1","sort_product":"date__desc","preview_width":"320","preview_height":"200","show_preview":"1","show_product_image":"1","show_image_label":"1","show_rating":"1","show_description":"1","show_old_price":"1","show_price":"1","limit_items":"9","max_items_per_page":"3","interval":"5000","duration":"500","transition":"Fx.Transitions.Quad.easeInOut","navigator_pos":"bottom","auto_start":"0","title_max_chars":"40","description_max_chars":"100","moduleclass_sfx":"","enable_ajax":"1","enable_cache":"0","cache_time":"15"}', 0, '*'),
(125, 'Highest Rated Products', '', '', 1, 'jshopping2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_ice_carousel', 1, 1, '{"theme":"","module_width":"685","module_height":"335","main_width":"120","main_height":"75","auto_renderthumb":"1","image_quanlity":"80","data_source":"joomshopping","show_front":"show","category_filtering_type":"1","catid":[""],"show_child_category_articles":"0","levels":"1","author_filtering_type":"1","created_by":[""],"author_alias_filtering_type":"1","created_by_alias":[""],"excluded_articles":"","date_filtering":"off","date_field":"a.created","start_date_range":"","end_date_range":"","relative_date":"30","article_ordering":"a.title","article_ordering_direction":"ASC","item_heading":"3","link_titles":"1","show_date":"1","show_date_field":"created","show_date_format":"Y-m-d H:i:s","show_category":"1","show_hits":"1","show_author":"1","show_introtext":"1","show_readmore":"1","show_readmore_title":"0","readmore_limit":"15","source_from":"cat_ids","jproduct_ids":"","jcat_ids":[""],"jmanufactures":[""],"filtering_type":"1","sort_product":"most_rate","preview_width":"320","preview_height":"200","show_preview":"1","show_product_image":"1","show_image_label":"1","show_rating":"1","show_description":"1","show_old_price":"1","show_price":"1","limit_items":"9","max_items_per_page":"3","interval":"5000","duration":"500","transition":"Fx.Transitions.Quad.easeInOut","navigator_pos":"bottom","auto_start":"0","title_max_chars":"40","description_max_chars":"100","moduleclass_sfx":"","enable_ajax":"1","enable_cache":"0","cache_time":"15"}', 0, '*'),
(126, 'Most Commented Products', '', '', 1, 'jshopping3', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_ice_carousel', 1, 1, '{"theme":"","module_width":"685","module_height":"335","main_width":"120","main_height":"75","auto_renderthumb":"1","image_quanlity":"80","data_source":"joomshopping","show_front":"show","category_filtering_type":"1","catid":[""],"show_child_category_articles":"0","levels":"1","author_filtering_type":"1","created_by":[""],"author_alias_filtering_type":"1","created_by_alias":[""],"excluded_articles":"","date_filtering":"off","date_field":"a.created","start_date_range":"","end_date_range":"","relative_date":"30","article_ordering":"a.title","article_ordering_direction":"ASC","item_heading":"3","link_titles":"1","show_date":"1","show_date_field":"created","show_date_format":"Y-m-d H:i:s","show_category":"1","show_hits":"1","show_author":"1","show_introtext":"1","show_readmore":"1","show_readmore_title":"0","readmore_limit":"15","source_from":"cat_ids","jproduct_ids":"","jcat_ids":[""],"jmanufactures":[""],"filtering_type":"1","sort_product":"most_comment","preview_width":"320","preview_height":"200","show_preview":"1","show_product_image":"1","show_image_label":"1","show_rating":"1","show_description":"1","show_old_price":"1","show_price":"1","limit_items":"9","max_items_per_page":"3","interval":"5000","duration":"500","transition":"Fx.Transitions.Quad.easeInOut","navigator_pos":"bottom","auto_start":"0","title_max_chars":"40","description_max_chars":"100","moduleclass_sfx":"","enable_ajax":"1","enable_cache":"0","cache_time":"15"}', 0, '*'),
(127, 'Extensions Menu', '', '', 3, 'left', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 1, 1, '{"menutype":"mainmenu","startLevel":"2","endLevel":"0","showAllChildren":"1","tag_id":"","class_sfx":"","window_open":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(128, 'Joomla Menu', '', '', 2, 'left', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 1, 1, '{"menutype":"mainmenu","startLevel":"2","endLevel":"0","showAllChildren":"1","tag_id":"","class_sfx":"","window_open":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(129, 'Template Styles', '', '<p>This Joomla template is built-in with an amazing set of 6 different stylish color variations. You can easily change the template style on the Template Manager in J! Administrator. Also your users can have a option to change the style on the fly through our template style-changer.</p>\r\n<ul class="ice-template-style">\r\n<li><span>Style1</span> <a href="index.php?&amp;TemplateStyle=style1"> <img src="images/sampledata/icetheme/features/styles/style_1.jpg" border="0" alt="Template Style 1" width="158" height="100" /></a></li>\r\n<li><span>Style2</span> <a href="index.php?&amp;TemplateStyle=style2"> <img src="images/sampledata/icetheme/features/styles/style_2.jpg" border="0" alt="Template Style 2" width="158" height="100" /></a></li>\r\n<li><span>Style3</span> <a href="index.php?&amp;TemplateStyle=style3"> <img src="images/sampledata/icetheme/features/styles/style_3.jpg" border="0" alt="Template Style 3" width="158" height="100" /></a></li>\r\n<li class="ice-style4"><span>Style4</span> <a href="index.php?&amp;TemplateStyle=style4"> <img src="images/sampledata/icetheme/features/styles/style_4.jpg" border="0" alt="Template Style 4" width="158" height="100" /></a></li>\r\n<li class="ice-style5"><span>Style5</span> <a href="index.php?&amp;TemplateStyle=style5"> <img src="images/sampledata/icetheme/features/styles/style_5.jpg" border="0" alt="Template Style 5" width="158" height="100" /></a></li>\r\n<li><span>Style6</span> <a href="index.php?&amp;TemplateStyle=style6"> <img src="images/sampledata/icetheme/features/styles/style_6.jpg" border="0" alt="Template Style 6" width="158" height="100" /></a></li>\r\n</ul>', 0, 'no-position', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(130, 'Designed With Love By IceTheme!', '', '<p><img src="images/sampledata/icetheme/designed_with_love.png" border="0" alt="Designed with Love" width="65" height="65" /> When you get an IceTheme Premium Joomla Template, you will save yourself many hours of hard work because we have thought for every feature that your next project might need. Take your time to carefully browse this template and you will be amazed how every single detail is in its place.</p>', 1, 'no-position', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(131, 'Free Joomla Extensions', '', '<p><img src="images/sampledata/icetheme/free-joomla-extensions.png" border="0" alt="Free Joomla Extensions" width="65" height="65" />All Joomla Extensions that are listed on the left are released for FREE by IceTheme under the GPL-2 license. Please visit our <a href="http://www.icetheme.com/Joomla-Extensions.html">Joomla Extensions</a> page for more information about our Free Joomla Extensions and how to download them</p>', 1, 'no-position', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(132, 'Payment Methods', '', '<p>We accept all major credit cards as well as PayPal payments</p>\r\n<p style="text-align: center;"><img src="images/sampledata/icetheme/cards.jpg" border="0" alt="Credit Cards" width="160" /></p>', 14, 'left', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(133, 'Login Form', '', '', 1, 'left', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_login', 1, 1, '{"pretext":"","posttext":"","login":"","logout":"","greeting":"1","name":"0","usesecure":"0","layout":"_:default","moduleclass_sfx":"","cache":"0"}', 0, '*'),
(134, 'Notice Message', '', '<p>Order 10 Products or more and You Get 1 FREE. <a href="#learn">Learn More »</a></p>', 1, 'notice', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(135, 'FaceBook Like Box (left)', '', '', 13, 'left', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_iyosis_facebook', 1, 0, '{"moduleclass_sfx":"","plugin":"LikeBox","URLLikeButton":"http:\\/\\/www.facebook.com\\/icetheme","codeTypeLikeButton":"XFBML","widthLikeButton":"180","heightLikeButton":"30","colorSchemeLikeButton":"light","showFacesLikeButton":"1","URLLikeBox":"http:\\/\\/www.facebook.com\\/icetheme","codeTypeLikeBox":"iframe","widthLikeBox":"220","heightLikeBox":"395","colorSchemeLikeBox":"light","showFacesLikeBox":"1","showStreamLikeBox":"0","showHeaderLikeBox":"1","domainActivityFeed":"joomla.org","codeTypeActivityFeed":"iframe","widthActivityFeed":"250","heightActivityFeed":"600","colorSchemeActivityFeed":"light","showHeaderActivityFeed":"1","domainRecommendations":"joomla.org","codeTypeRecommendations":"iframe","widthRecommendations":"250","heightRecommendations":"600","colorSchemeRecommendations":"light","showHeaderRecommendations":"1"}', 0, '*'),
(136, 'FaceBook Like Button (footer)', '', '', 1, 'fb-like', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_iyosis_facebook', 1, 0, '{"moduleclass_sfx":"","plugin":"LikeButton","URLLikeButton":"http:\\/\\/www.facebook.com\\/icetheme","codeTypeLikeButton":"iframe","widthLikeButton":"960","heightLikeButton":"30","colorSchemeLikeButton":"light","showFacesLikeButton":"0","URLLikeBox":"http:\\/\\/www.facebook.com\\/joomla","codeTypeLikeBox":"iframe","widthLikeBox":"250","heightLikeBox":"600","colorSchemeLikeBox":"light","showFacesLikeBox":"1","showStreamLikeBox":"1","showHeaderLikeBox":"1","domainActivityFeed":"joomla.org","codeTypeActivityFeed":"iframe","widthActivityFeed":"250","heightActivityFeed":"600","colorSchemeActivityFeed":"light","showHeaderActivityFeed":"1","domainRecommendations":"joomla.org","codeTypeRecommendations":"iframe","widthRecommendations":"250","heightRecommendations":"600","colorSchemeRecommendations":"light","showHeaderRecommendations":"1"}', 0, '*'),
(137, 'Filter Products', '', '', 6, 'left', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_jshopping_filters', 1, 1, '{"show_manufacturers":"1","show_categorys":"1","show_prices":"1","show_characteristics":"1","moduleclass_sfx":""}', 0, '*');

-- --------------------------------------------------------

--
-- Table structure for table `#__modules_menu`
--

DROP TABLE IF EXISTS `#__modules_menu`;
CREATE TABLE IF NOT EXISTS `#__modules_menu` (
  `moduleid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`moduleid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__modules_menu`
--

INSERT INTO `#__modules_menu` (`moduleid`, `menuid`) VALUES
(2, 0),
(3, 0),
(4, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0),
(12, 0),
(13, 0),
(14, 0),
(15, 0),
(17, -512),
(17, -511),
(17, -510),
(17, -509),
(17, -435),
(20, 0),
(22, 231),
(22, 234),
(22, 238),
(22, 242),
(22, 243),
(22, 244),
(22, 296),
(22, 399),
(22, 400),
(23, -463),
(23, -462),
(23, -433),
(23, -432),
(23, -431),
(23, -430),
(23, -429),
(23, -427),
(23, -400),
(23, -399),
(23, -296),
(23, -244),
(23, -243),
(23, -242),
(23, -238),
(23, -234),
(39, 0),
(41, 0),
(57, 238),
(57, 427),
(57, 429),
(57, 430),
(57, 431),
(57, 432),
(57, 433),
(57, 462),
(57, 463),
(63, 0),
(64, 0),
(71, 285),
(71, 316),
(79, 0),
(80, 435),
(80, 509),
(80, 510),
(80, 511),
(80, 512),
(82, 465),
(83, 465),
(84, 465),
(85, 465),
(86, 465),
(87, 465),
(88, 465),
(89, 465),
(90, 465),
(91, 465),
(92, 465),
(93, 465),
(94, 465),
(95, 465),
(96, 465),
(97, 465),
(98, 0),
(103, 0),
(104, 435),
(104, 509),
(104, 510),
(104, 511),
(104, 512),
(111, -465),
(112, -465),
(113, -465),
(114, -465),
(115, -503),
(115, -465),
(116, -503),
(116, -465),
(117, -503),
(117, -465),
(118, 0),
(119, 0),
(120, 0),
(121, -502),
(121, -501),
(121, -500),
(121, -499),
(121, -498),
(121, -497),
(121, -496),
(121, -495),
(121, -494),
(121, -493),
(121, -492),
(121, -491),
(121, -490),
(121, -489),
(121, -488),
(121, -487),
(121, -486),
(121, -485),
(121, -484),
(121, -483),
(121, -482),
(121, -481),
(121, -480),
(121, -469),
(121, -468),
(121, -467),
(121, -466),
(121, -465),
(121, -294),
(122, 294),
(122, 466),
(122, 467),
(122, 468),
(122, 469),
(123, 503),
(124, 435),
(124, 509),
(124, 510),
(124, 511),
(124, 512),
(125, 435),
(125, 509),
(125, 510),
(125, 511),
(125, 512),
(126, 435),
(126, 509),
(126, 510),
(126, 511),
(126, 512),
(127, 480),
(127, 481),
(127, 482),
(127, 483),
(127, 484),
(127, 485),
(127, 486),
(128, 487),
(128, 488),
(128, 489),
(128, 490),
(128, 491),
(128, 492),
(128, 493),
(128, 494),
(128, 495),
(128, 496),
(128, 497),
(128, 498),
(128, 499),
(128, 500),
(128, 501),
(128, 502),
(129, 0),
(130, 0),
(131, 0),
(132, 435),
(132, 503),
(132, 509),
(132, 510),
(132, 511),
(132, 512),
(133, 0),
(134, 435),
(134, 509),
(134, 510),
(134, 511),
(134, 512),
(135, 435),
(135, 509),
(135, 510),
(135, 511),
(135, 512),
(136, 0),
(137, 0);

-- --------------------------------------------------------

--
-- Table structure for table `#__newsfeeds`
--

DROP TABLE IF EXISTS `#__newsfeeds`;
CREATE TABLE IF NOT EXISTS `#__newsfeeds` (
  `catid` int(11) NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `alias` varchar(100) NOT NULL DEFAULT '',
  `link` varchar(200) NOT NULL DEFAULT '',
  `filename` varchar(200) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `numarticles` int(10) unsigned NOT NULL DEFAULT '1',
  `cache_time` int(10) unsigned NOT NULL DEFAULT '3600',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `#__newsfeeds`
--

INSERT INTO `#__newsfeeds` (`catid`, `id`, `name`, `alias`, `link`, `filename`, `published`, `numarticles`, `cache_time`, `checked_out`, `checked_out_time`, `ordering`, `rtl`, `access`, `language`, `params`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `metakey`, `metadesc`, `metadata`, `xreference`, `publish_up`, `publish_down`) VALUES
(17, 1, 'Joomla! Announcements', 'joomla-announcements', 'http://www.joomla.org/announcements.feed?type=rss', NULL, 1, 5, 3600, 0, '0000-00-00 00:00:00', 1, 0, 1, 'en-GB', '{"show_feed_image":"","show_feed_description":"","show_item_description":"","feed_character_count":"0"}', '2011-01-01 00:00:01', 0, '', '2011-01-01 00:00:01', 42, '', '', '{"robots":"","author":"","rights":""}', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 2, 'New Joomla! Extensions', 'new-joomla-extensions', 'http://feeds.joomla.org/JoomlaExtensions', NULL, 1, 5, 3600, 0, '0000-00-00 00:00:00', 4, 0, 1, 'en-GB', '{"show_feed_image":"","show_feed_description":"","show_item_description":"","feed_character_count":"0"}', '2011-01-01 00:00:01', 0, '', '2011-01-01 00:00:01', 42, '', '', '{"robots":"","author":"","rights":""}', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 3, 'Joomla! Security News', 'joomla-security-news', 'http://feeds.joomla.org/JoomlaSecurityNews', NULL, 1, 5, 3600, 0, '0000-00-00 00:00:00', 2, 0, 1, 'en-GB', '{"show_feed_image":"","show_feed_description":"","show_item_description":"","feed_character_count":"0"}', '2011-01-01 00:00:01', 0, '', '2011-01-01 00:00:01', 42, '', '', '{"robots":"","author":"","rights":""}', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 4, 'Joomla! Connect', 'joomla-connect', 'http://feeds.joomla.org/JoomlaConnect', NULL, 1, 5, 3600, 0, '0000-00-00 00:00:00', 3, 0, 1, 'en-GB', '{"show_feed_image":"","show_feed_description":"","show_item_description":"","feed_character_count":"0"}', '2011-01-01 00:00:01', 0, '', '2011-01-01 00:00:01', 42, '', '', '{"robots":"","author":"","rights":""}', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `#__redirect_links`
--

DROP TABLE IF EXISTS `#__redirect_links`;
CREATE TABLE IF NOT EXISTS `#__redirect_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `old_url` varchar(150) NOT NULL,
  `new_url` varchar(150) NOT NULL,
  `referer` varchar(150) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_link_old` (`old_url`),
  KEY `idx_link_modifed` (`modified_date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `#__redirect_links`
--

INSERT INTO `#__redirect_links` (`id`, `old_url`, `new_url`, `referer`, `comment`, `published`, `created_date`, `modified_date`) VALUES
(1, 'http://localhost/2011/theshop/index.php/using-joomla/extensions/components', '', 'http://localhost/2011/theshop/', '', 0, '2011-08-01 12:21:18', '0000-00-00 00:00:00'),
(2, 'http://localhost/2011/theshop/index.php/sample-sites', '', 'http://localhost/2011/theshop/', '', 0, '2011-08-01 12:21:25', '0000-00-00 00:00:00'),
(3, 'http://localhost/2011/theshop/index.php/features/weblinks', '', 'http://localhost/2011/theshop/index.php/features/articles', '', 0, '2011-08-01 12:22:21', '0000-00-00 00:00:00'),
(4, 'http://localhost/2011/theshop/index.php/en/ ', '', 'http://localhost/2011/theshop/index.php/en/', '', 0, '2011-08-03 10:36:50', '0000-00-00 00:00:00'),
(5, 'http://localhost/2011/theshop/index.php/en/joomshopping/category/view/[object HTMLImageElement]', '', 'http://localhost/2011/theshop/index.php/en/joomshopping/category/view/1', '', 0, '2011-08-04 09:07:38', '0000-00-00 00:00:00'),
(6, 'http://localhost/2011/theshop/index.php/en/[object HTMLImageElement]', '', 'http://localhost/2011/theshop/index.php/en/joomshopping', '', 0, '2011-08-04 09:57:28', '0000-00-00 00:00:00'),
(7, 'http://localhost/2011/theshop/index.php/en/joomshopping/product/view/1/images/lightbox-blank.gif', '', 'http://localhost/2011/theshop/index.php/en/joomshopping/product/view/1/1', '', 0, '2011-08-06 10:08:16', '0000-00-00 00:00:00'),
(8, 'http://localhost/2011/theshop/index.php/en/joomshopping/product/view/1/[object HTMLImageElement]', '', 'http://localhost/2011/theshop/index.php/en/joomshopping/product/view/1/1', '', 0, '2011-08-07 11:22:52', '0000-00-00 00:00:00'),
(9, 'http://localhost/2011/theshop/index.php/en/en/joomshopping/product/view/1/1', '', 'http://localhost/2011/theshop/index.php/en/joomshopping/product/view/1/5', '', 0, '2011-08-08 08:02:38', '0000-00-00 00:00:00'),
(10, 'http://localhost/2011/theshop/index.php/en/joomshopping/product/view/33/images/lightbox-blank.gif', '', 'http://localhost/2011/theshop/index.php/en/joomshopping/product/view/33/2', '', 0, '2011-08-12 10:04:46', '0000-00-00 00:00:00'),
(11, 'http://localhost/2011/theshop/index.php/en/en/joomshopping/product/view/1/7', '', 'http://localhost/2011/theshop/index.php/en/joomshopping/product/view/33/2', '', 0, '2011-08-12 10:11:49', '0000-00-00 00:00:00'),
(12, 'http://localhost/2011/theshop/index.php/en/en/joomshopping/product/view/1/9', '', 'http://localhost/2011/theshop/index.php/en/joomshopping/product/view/1/7', '', 0, '2011-08-12 10:15:16', '0000-00-00 00:00:00'),
(13, 'http://localhost/2011/theshop/index.php/en/extensions/icecaption', '', 'http://localhost/2011/theshop/index.php/en/extensions/iceaccordion', '', 0, '2011-08-16 09:50:55', '0000-00-00 00:00:00'),
(14, 'http://localhost/2011/theshop/index.php/en/en/joomshopping/product/view/1/8', '', 'http://localhost/2011/theshop/index.php/en/', '', 0, '2011-08-17 12:54:49', '0000-00-00 00:00:00'),
(15, 'http://localhost/2011/theshop/index.php/en/features/module-variations2', '', '', '', 0, '2011-08-18 12:55:02', '0000-00-00 00:00:00'),
(16, 'http://localhost/clone/theshop/index.php/en/components/com_jshopping/files/img_products/full_dc13739004c50b749ab2b1e7efb3c6f5.jpg', '', 'http://localhost/clone/theshop/index.php/en/', '', 0, '2011-08-18 14:03:28', '0000-00-00 00:00:00'),
(17, 'http://localhost/clone/theshop/index.php/en/components/com_jshopping/files/img_products/full_3dcb373a75c112b4b9c4098327f825fe.jpg', '', 'http://localhost/clone/theshop/index.php/en/', '', 0, '2011-08-18 14:03:28', '0000-00-00 00:00:00'),
(18, 'http://localhost/clone/theshop/index.php/en/components/com_jshopping/files/img_products/full_17ec6f53b639f91c40a4a39fcf520f85.jpg', '', 'http://localhost/clone/theshop/index.php/en/', '', 0, '2011-08-18 14:03:28', '0000-00-00 00:00:00'),
(19, 'http://localhost/clone/theshop/index.php/en/components/com_jshopping/files/img_products/full_22ef0a2ceff221a80c32ea2508d84d7e.jpg', '', 'http://localhost/clone/theshop/index.php/en/', '', 0, '2011-08-18 14:03:29', '0000-00-00 00:00:00'),
(20, 'http://localhost/clone/theshop/index.php/en/components/com_jshopping/files/img_products/full_e65c55dc80362bca3f389f7b712f6e3a.jpg', '', 'http://localhost/clone/theshop/index.php/en/', '', 0, '2011-08-18 14:03:30', '0000-00-00 00:00:00'),
(21, 'http://localhost/clone/theshop/index.php/en/components/com_jshopping/files/img_products/full_ab239707d5166dcb377fa1127c93b432.jpg', '', 'http://localhost/clone/theshop/index.php/en/', '', 0, '2011-08-18 14:03:30', '0000-00-00 00:00:00'),
(22, 'http://localhost/clone/theshop/index.php/en/components/com_jshopping/files/img_products/full_0476b7c25fbfde3b07ea5b0a75ae6c84.jpg', '', 'http://localhost/clone/theshop/index.php/en/', '', 0, '2011-08-18 14:03:30', '0000-00-00 00:00:00'),
(23, 'http://localhost/clone/theshop/index.php/en/components/com_jshopping/files/img_products/full_b8117edcaf73210e16f45ec87c6fa827.jpg', '', 'http://localhost/clone/theshop/index.php/en/', '', 0, '2011-08-18 14:03:30', '0000-00-00 00:00:00'),
(24, 'http://localhost/clone/theshop/index.php/en/components/com_jshopping/files/img_products/full_36a3edae47b25c4ec9899e72e1b3250e.jpg', '', 'http://localhost/clone/theshop/index.php/en/', '', 0, '2011-08-18 14:07:04', '0000-00-00 00:00:00'),
(25, 'http://localhost/clone/theshop/index.php/en/404', '', '', '', 0, '2011-08-18 14:36:03', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `#__schemas`
--

DROP TABLE IF EXISTS `#__schemas`;
CREATE TABLE IF NOT EXISTS `#__schemas` (
  `extension_id` int(11) NOT NULL,
  `version_id` varchar(20) NOT NULL,
  PRIMARY KEY (`extension_id`,`version_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__schemas`
--

INSERT INTO `#__schemas` (`extension_id`, `version_id`) VALUES
(700, '1.7.0-2011-06-06-2');

-- --------------------------------------------------------

--
-- Table structure for table `#__session`
--

DROP TABLE IF EXISTS `#__session`;
CREATE TABLE IF NOT EXISTS `#__session` (
  `session_id` varchar(32) NOT NULL DEFAULT '',
  `client_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `guest` tinyint(4) unsigned DEFAULT '1',
  `time` varchar(14) DEFAULT '',
  `data` varchar(20480) DEFAULT NULL,
  `userid` int(11) DEFAULT '0',
  `username` varchar(150) DEFAULT '',
  `usertype` varchar(50) DEFAULT '',
  PRIMARY KEY (`session_id`),
  KEY `whosonline` (`guest`,`usertype`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__session`
--

INSERT INTO `#__session` (`session_id`, `client_id`, `guest`, `time`, `data`, `userid`, `username`, `usertype`) VALUES
('hkvllvu02lq3iut3n4bi6sb0r1', 0, 1, '1313830943', '__default|a:15:{s:15:"session.counter";i:55;s:19:"session.timer.start";i:1313827718;s:18:"session.timer.last";i:1313830942;s:17:"session.timer.now";i:1313830942;s:22:"session.client.browser";s:70:"Mozilla/5.0 (Windows NT 6.1; WOW64; rv:6.0) Gecko/20100101 Firefox/6.0";s:8:"registry";O:9:"JRegistry":1:{s:7:"\0*\0data";O:8:"stdClass":0:{}}s:4:"user";O:5:"JUser":23:{s:9:"\0*\0isRoot";b:0;s:2:"id";i:0;s:4:"name";N;s:8:"username";N;s:5:"email";N;s:8:"password";N;s:14:"password_clear";s:0:"";s:8:"usertype";N;s:5:"block";N;s:9:"sendEmail";i:0;s:12:"registerDate";N;s:13:"lastvisitDate";N;s:10:"activation";N;s:6:"params";N;s:6:"groups";a:0:{}s:5:"guest";i:1;s:10:"\0*\0_params";O:9:"JRegistry":1:{s:7:"\0*\0data";O:8:"stdClass":0:{}}s:14:"\0*\0_authGroups";a:1:{i:0;i:1;}s:14:"\0*\0_authLevels";a:2:{i:0;i:1;i:1;i:1;}s:15:"\0*\0_authActions";N;s:12:"\0*\0_errorMsg";N;s:10:"\0*\0_errors";a:0:{}s:3:"aid";i:0;}s:19:"js_id_currency_orig";s:1:"1";s:14:"js_id_currency";s:1:"1";s:17:"js_currency_value";s:8:"1.000000";s:16:"js_currency_code";s:3:"EUR";s:20:"js_currency_code_iso";s:3:"EUR";s:19:"js_get_mysqlversion";s:6:"5.1.36";s:21:"shop_main_page_itemid";s:3:"503";s:16:"com_mailto.links";a:2:{s:40:"d12ed1fd4a8f16c5c7f9edfbcf4186ad436b3134";O:8:"stdClass":2:{s:4:"link";s:70:"http://localhost/clone/theshop/index.php/en/features/module-variations";s:6:"expiry";i:1313829370;}s:40:"1ad1aa39fe02f8c765ab47c45507d5c15bd425dd";O:8:"stdClass":2:{s:4:"link";s:62:"http://localhost/clone/theshop/index.php/en/extensions/icetabs";s:6:"expiry";i:1313829367;}}}', 0, '', ''),
('24f80d015095f8ee5713bf0fc7e2d013', 1, 0, '1313831006', '__default|a:8:{s:22:"session.client.browser";s:70:"Mozilla/5.0 (Windows NT 6.1; WOW64; rv:6.0) Gecko/20100101 Firefox/6.0";s:15:"session.counter";i:43;s:8:"registry";O:9:"JRegistry":1:{s:7:"\0*\0data";O:8:"stdClass":4:{s:11:"application";O:8:"stdClass":1:{s:4:"lang";s:0:"";}s:13:"com_templates";O:8:"stdClass":2:{s:6:"styles";O:8:"stdClass":1:{s:10:"limitstart";i:0;}s:4:"edit";O:8:"stdClass":1:{s:5:"style";O:8:"stdClass":2:{s:2:"id";a:0:{}s:4:"data";N;}}}s:11:"com_modules";O:8:"stdClass":3:{s:7:"modules";O:8:"stdClass":4:{s:6:"filter";O:8:"stdClass":8:{s:18:"client_id_previous";i:0;s:6:"search";s:0:"";s:6:"access";i:0;s:5:"state";s:0:"";s:8:"position";s:0:"";s:6:"module";s:0:"";s:9:"client_id";i:0;s:8:"language";s:0:"";}s:10:"limitstart";s:1:"0";s:8:"ordercol";s:8:"position";s:9:"orderdirn";s:3:"asc";}s:4:"edit";O:8:"stdClass":1:{s:6:"module";O:8:"stdClass":2:{s:2:"id";a:0:{}s:4:"data";N;}}s:3:"add";O:8:"stdClass":1:{s:6:"module";O:8:"stdClass":1:{s:12:"extension_id";N;}}}s:6:"global";O:8:"stdClass":1:{s:4:"list";O:8:"stdClass":1:{s:5:"limit";s:1:"0";}}}}s:4:"user";O:5:"JUser":23:{s:9:"\0*\0isRoot";b:1;s:2:"id";s:2:"42";s:4:"name";s:5:"Alvin";s:8:"username";s:5:"admin";s:5:"email";s:14:"info@test2.com";s:8:"password";s:65:"fb87e71d8e74643449c8fb68766c0565:l7H6EEpa2vJwrbZaw9Qa7CQtIfN5i8aT";s:14:"password_clear";s:0:"";s:8:"usertype";s:10:"deprecated";s:5:"block";s:1:"0";s:9:"sendEmail";s:1:"1";s:12:"registerDate";s:19:"2011-08-01 12:02:44";s:13:"lastvisitDate";s:19:"2011-08-20 08:12:29";s:10:"activation";s:0:"";s:6:"params";s:2:"{}";s:6:"groups";a:1:{s:11:"Super Users";s:1:"8";}s:5:"guest";i:0;s:10:"\0*\0_params";O:9:"JRegistry":1:{s:7:"\0*\0data";O:8:"stdClass":0:{}}s:14:"\0*\0_authGroups";a:2:{i:0;i:1;i:1;i:8;}s:14:"\0*\0_authLevels";a:4:{i:0;i:1;i:1;i:1;i:2;i:2;i:3;i:3;}s:15:"\0*\0_authActions";N;s:12:"\0*\0_errorMsg";N;s:10:"\0*\0_errors";a:0:{}s:3:"aid";i:0;}s:13:"session.token";s:32:"dd90b640d2bd374f447a58da45974d9c";s:19:"session.timer.start";i:1313828901;s:18:"session.timer.last";i:1313831006;s:17:"session.timer.now";i:1313831006;}', 42, 'admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `#__template_styles`
--

DROP TABLE IF EXISTS `#__template_styles`;
CREATE TABLE IF NOT EXISTS `#__template_styles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `template` varchar(50) NOT NULL DEFAULT '',
  `client_id` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `home` char(7) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_template` (`template`),
  KEY `idx_home` (`home`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=116 ;

--
-- Dumping data for table `#__template_styles`
--

INSERT INTO `#__template_styles` (`id`, `template`, `client_id`, `home`, `title`, `params`) VALUES
(2, 'bluestork', 1, '1', 'Bluestork - Default', '{"useRoundedCorners":"1","showSiteName":"0"}'),
(3, 'atomic', 0, '0', 'Atomic - Default', '{}'),
(4, 'beez_20', 0, '0', 'Beez2 - Default', '{"wrapperSmall":"53","wrapperLarge":"72","logo":"images\\/joomla_black.gif","sitetitle":"Joomla!","sitedescription":"Open Source Content Management","navposition":"left","templatecolor":"personal","html5":"0"}'),
(5, 'hathor', 1, '0', 'Hathor - Default', '{"showSiteName":"0","colourChoice":"","boldText":"0"}'),
(6, 'beez5', 0, '0', 'Beez5 - Default-Fruit Shop', '{"wrapperSmall":"53","wrapperLarge":"72","logo":"images\\/sampledata\\/fruitshop\\/fruits.gif","sitetitle":"Matuna Market ","sitedescription":"Fruit Shop Sample Site","navposition":"left","html5":"0"}'),
(114, 'beez_20', 0, '0', 'Beez2 - Parks Site', '{"wrapperSmall":"53","wrapperLarge":"72","logo":"","sitetitle":"Australian Parks","sitedescription":"Parks Sample Site","navposition":"center","templatecolor":"nature"}'),
(115, 'it_theshop', 0, '1', 'it_theshop - Default', '{"license":"","cdate":"","TemplateStyle":"style1","layout_leftcol_width":240,"layout_rightcol_width":240,"logo":"images\\/sampledata\\/icetheme\\/logo.png","go2top":1,"fixcols":1,"icelogo":1}');

-- --------------------------------------------------------

--
-- Table structure for table `#__updates`
--

DROP TABLE IF EXISTS `#__updates`;
CREATE TABLE IF NOT EXISTS `#__updates` (
  `update_id` int(11) NOT NULL AUTO_INCREMENT,
  `update_site_id` int(11) DEFAULT '0',
  `extension_id` int(11) DEFAULT '0',
  `categoryid` int(11) DEFAULT '0',
  `name` varchar(100) DEFAULT '',
  `description` text NOT NULL,
  `element` varchar(100) DEFAULT '',
  `type` varchar(20) DEFAULT '',
  `folder` varchar(20) DEFAULT '',
  `client_id` tinyint(3) DEFAULT '0',
  `version` varchar(10) DEFAULT '',
  `data` text NOT NULL,
  `detailsurl` text NOT NULL,
  PRIMARY KEY (`update_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Available Updates' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__updates`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__update_categories`
--

DROP TABLE IF EXISTS `#__update_categories`;
CREATE TABLE IF NOT EXISTS `#__update_categories` (
  `categoryid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT '',
  `description` text NOT NULL,
  `parent` int(11) DEFAULT '0',
  `updatesite` int(11) DEFAULT '0',
  PRIMARY KEY (`categoryid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Update Categories' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__update_categories`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__update_sites`
--

DROP TABLE IF EXISTS `#__update_sites`;
CREATE TABLE IF NOT EXISTS `#__update_sites` (
  `update_site_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '',
  `type` varchar(20) DEFAULT '',
  `location` text NOT NULL,
  `enabled` int(11) DEFAULT '0',
  PRIMARY KEY (`update_site_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Update Sites' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `#__update_sites`
--

INSERT INTO `#__update_sites` (`update_site_id`, `name`, `type`, `location`, `enabled`) VALUES
(1, 'Joomla Core', 'collection', 'http://update.joomla.org/core/list.xml', 1),
(2, 'Joomla Extension Directory', 'collection', 'http://update.joomla.org/jed/list.xml', 1);

-- --------------------------------------------------------

--
-- Table structure for table `#__update_sites_extensions`
--

DROP TABLE IF EXISTS `#__update_sites_extensions`;
CREATE TABLE IF NOT EXISTS `#__update_sites_extensions` (
  `update_site_id` int(11) NOT NULL DEFAULT '0',
  `extension_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`update_site_id`,`extension_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Links extensions to update sites';

--
-- Dumping data for table `#__update_sites_extensions`
--

INSERT INTO `#__update_sites_extensions` (`update_site_id`, `extension_id`) VALUES
(1, 700),
(2, 700);

-- --------------------------------------------------------

--
-- Table structure for table `#__usergroups`
--
DELETE FROM `#__usergroups`;
--
-- Dumping data for table `#__usergroups`
--

INSERT INTO `#__usergroups` (`id`, `parent_id`, `lft`, `rgt`, `title`) VALUES
(1, 0, 1, 20, 'Public'),
(2, 1, 6, 17, 'Registered'),
(3, 2, 7, 14, 'Author'),
(4, 3, 8, 11, 'Editor'),
(5, 4, 9, 10, 'Publisher'),
(6, 1, 2, 5, 'Manager'),
(7, 6, 3, 4, 'Administrator'),
(8, 1, 18, 19, 'Super Users'),
(12, 2, 15, 16, 'Customer Group (Example)'),
(10, 3, 12, 13, 'Shop Suppliers (Example)');

-- --------------------------------------------------------

--
-- Table structure for table `#__users`
--

DROP TABLE IF EXISTS `#__users`;
CREATE TABLE IF NOT EXISTS `#__users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `usertype` varchar(25) NOT NULL DEFAULT '',
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `sendEmail` tinyint(4) DEFAULT '0',
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usertype` (`usertype`),
  KEY `idx_name` (`name`),
  KEY `idx_block` (`block`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `#__users`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__user_profiles`
--

DROP TABLE IF EXISTS `#__user_profiles`;
CREATE TABLE IF NOT EXISTS `#__user_profiles` (
  `user_id` int(11) NOT NULL,
  `profile_key` varchar(100) NOT NULL,
  `profile_value` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `idx_user_id_profile_key` (`user_id`,`profile_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Simple user profile storage table';

--
-- Dumping data for table `#__user_profiles`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__user_usergroup_map`
--

DROP TABLE IF EXISTS `#__user_usergroup_map`;
CREATE TABLE IF NOT EXISTS `#__user_usergroup_map` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Foreign Key to #__users.id',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Foreign Key to #__usergroups.id',
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__user_usergroup_map`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__viewlevels`
--

DROP TABLE IF EXISTS `#__viewlevels`;
CREATE TABLE IF NOT EXISTS `#__viewlevels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `title` varchar(100) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_assetgroup_title_lookup` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `#__viewlevels`
--

INSERT INTO `#__viewlevels` (`id`, `title`, `ordering`, `rules`) VALUES
(1, 'Public', 0, '[1]'),
(2, 'Registered', 1, '[6,2,8]'),
(3, 'Special', 2, '[6,3,8]'),
(4, 'Customer Access Level (Example)', 3, '[6,3,12]');

-- --------------------------------------------------------

--
-- Table structure for table `#__weblinks`
--

DROP TABLE IF EXISTS `#__weblinks`;
CREATE TABLE IF NOT EXISTS `#__weblinks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `access` int(11) NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `language` char(7) NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if link is featured.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `#__weblinks`
--

INSERT INTO `#__weblinks` (`id`, `catid`, `sid`, `title`, `alias`, `url`, `description`, `date`, `hits`, `state`, `checked_out`, `checked_out_time`, `ordering`, `archived`, `approved`, `access`, `params`, `language`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `metakey`, `metadesc`, `metadata`, `featured`, `xreference`, `publish_up`, `publish_down`) VALUES
(1, 32, 0, 'Joomla!', 'joomla', 'http://www.joomla.org', '<p>Home of Joomla!</p>', '0000-00-00 00:00:00', 3, 1, 0, '0000-00-00 00:00:00', 1, 0, 1, 1, '{"target":"0","count_clicks":""}', 'en-GB', '2011-01-01 00:00:01', 0, '', '2011-01-01 00:00:01', 42, '', '', '{"robots":"","author":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 33, 0, 'php.net', 'php', 'http://www.php.net', '<p>The language that Joomla! is developed in</p>', '0000-00-00 00:00:00', 6, 1, 0, '0000-00-00 00:00:00', 1, 0, 1, 1, '{"target":"","count_clicks":""}', 'en-GB', '2011-01-01 00:00:01', 0, '', '2011-01-01 00:00:01', 42, '', '', '{"robots":"","author":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 33, 0, 'MySQL', 'mysql', 'http://www.mysql.com', '<p>The database that Joomla! uses</p>', '0000-00-00 00:00:00', 1, 1, 0, '0000-00-00 00:00:00', 2, 0, 1, 1, '{"target":"","count_clicks":""}', 'en-GB', '2011-01-01 00:00:01', 0, '', '2011-01-01 00:00:01', 42, '', '', '{"robots":"","author":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 32, 0, 'OpenSourceMatters', 'opensourcematters', 'http://www.opensourcematters.org', '<p>Home of OSM</p>', '0000-00-00 00:00:00', 11, 1, 0, '0000-00-00 00:00:00', 3, 0, 1, 1, '{"target":"0","count_clicks":""}', 'en-GB', '2011-01-01 00:00:01', 0, '', '2011-01-01 00:00:01', 42, '', '', '{"robots":"","author":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 32, 0, 'Joomla! - Forums', 'joomla-forums', 'http://forum.joomla.org', '<p>Joomla! Forums</p>', '0000-00-00 00:00:00', 4, 1, 0, '0000-00-00 00:00:00', 2, 0, 1, 1, '{"target":"0","count_clicks":""}', 'en-GB', '2011-01-01 00:00:01', 0, '', '2011-01-01 00:00:01', 42, '', '', '{"robots":"","author":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 33, 0, 'Ohloh Tracking of Joomla!', 'ohloh-tracking-of-joomla', 'http://www.ohloh.net/projects/20', '<p>Objective reports from Ohloh about Joomla''s development activity. Joomla! has some star developers with serious kudos.</p>', '0000-00-00 00:00:00', 1, 1, 0, '0000-00-00 00:00:00', 3, 0, 1, 1, '{"target":"0","count_clicks":""}', 'en-GB', '2011-01-01 00:00:01', 0, '', '2011-01-01 00:00:01', 42, '', '', '{"robots":"","author":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 31, 0, 'Baw Baw National Park', 'baw-baw-national-park', 'http://www.parkweb.vic.gov.au/1park_display.cfm?park=44', '<p>Park of the Austalian Alps National Parks system, Baw Baw  features sub alpine vegetation, beautiful views, and opportunities for hiking, skiing and other outdoor activities.</p>', '0000-00-00 00:00:00', 0, 1, 0, '0000-00-00 00:00:00', 1, 0, 1, 1, '{"target":"0","count_clicks":""}', 'en-GB', '2011-01-01 00:00:01', 0, '', '2011-01-01 00:00:01', 42, '', '', '{"robots":"","author":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 31, 0, 'Kakadu', 'kakadu', 'http://www.environment.gov.au/parks/kakadu/index.html', '<p>Kakadu is known for both its cultural heritage and its natural features. It is one of a small number of places listed as World Heritage Places for both reasons. Extensive rock art is found there.</p>', '0000-00-00 00:00:00', 0, 1, 0, '0000-00-00 00:00:00', 2, 0, 1, 1, '{"target":"0","count_clicks":""}', 'en-GB', '2011-01-01 00:00:01', 0, '', '2011-01-01 00:00:01', 42, '', '', '{"robots":"","author":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 31, 0, 'Pulu Keeling', 'pulu-keeling', 'http://www.environment.gov.au/parks/cocos/index.html', '<p>Located on an atoll 2000 kilometers north of Perth, Pulu Keeling is Australia''s smallest national park.</p>', '0000-00-00 00:00:00', 0, 1, 0, '0000-00-00 00:00:00', 3, 0, 1, 1, '{"target":"0","count_clicks":""}', 'en-GB', '2011-01-01 00:00:01', 0, '', '2011-01-01 00:00:01', 42, '', '', '{"robots":"","author":"","rights":""}', 0, '', '2010-07-10 23:44:03', '0000-00-00 00:00:00');
