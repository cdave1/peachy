-- phpMyAdmin SQL Dump
-- version 2.11.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2009 at 02:41 PM
-- Server version: 4.0.27
-- PHP Version: 4.4.9


--
-- Database: `peachyws`
--
CREATE DATABASE `peachyws`;
USE peachyws;

-- --------------------------------------------------------

--
-- Table structure for table `itemCategory`
--

CREATE TABLE IF NOT EXISTS `itemCategory` (
  `title` varchar(255) NOT NULL default '',
  `parentBrowseNode` int(16) NOT NULL default '0',
  `browseNode` int(16) NOT NULL default '0',
  `area` varchar(50) NOT NULL default '',
  `id` int(16) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

--
-- Dumping data for table `itemCategory`
--


-- --------------------------------------------------------

--
-- Table structure for table `siteNewsItem`
--

CREATE TABLE IF NOT EXISTS `siteNewsItem` (
  `id` int(16) NOT NULL auto_increment,
  `authorID` int(16) NOT NULL default '0',
  `txtTitle` varchar(255) NOT NULL default '',
  `dtTime` int(16) NOT NULL default '0',
  `txtMain` text NOT NULL,
  `txtTags` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

--
-- Dumping data for table `siteNewsItem`
--


-- --------------------------------------------------------

--
-- Table structure for table `usrBasic`
--

CREATE TABLE IF NOT EXISTS `usrBasic` (
  `id` int(16) NOT NULL auto_increment,
  `email` varchar(255) NOT NULL default '',
  `ipaddress` varchar(255) NOT NULL default '',
  `creationdate` int(16) NOT NULL default '0',
  `checksum1` varchar(255) NOT NULL default '',
  `usrScreenName` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

--
-- Dumping data for table `usrBasic`
--

INSERT INTO `usrBasic` (`id`, `email`, `ipaddress`, `creationdate`, `checksum1`, `usrScreenName`) VALUES
(1, 'david@peachy.co.nz', '210.54.6.17', 1119142043, '5ba3dfa614805674c0b2565a335f9e265347003e', 'david'),
(3, 'peter@nycity.com', '210.86.17.131', 1124932953, 'b0ca0b83252ae26f32b3ad306bc5a62f320fe143', 'Peter'),
(2, 'david@peachyblog.com', '222.152.172.211', 1120450462, '698ebd0d2ebc61dc611a4265e800d3e70ddcccda', 'peachy'),
(4, 'david@modivio.co.nz', '203.79.79.56', 1132824688, 'e1e252e520a1e1882ff32574deb0c217e5f4ed67', 'creator'),
(5, 'davidppp@gmail.com', '203.79.79.56', 1137838307, '563a240eacf995a58b00230597984846bd45f7c1', 'sfdg');

-- --------------------------------------------------------

--
-- Table structure for table `usrComment`
--

CREATE TABLE IF NOT EXISTS `usrComment` (
  `ixComment` int(32) NOT NULL auto_increment,
  `usrID` int(16) NOT NULL default '0',
  `usrScreenName` varchar(255) NOT NULL default '',
  `dtTime` int(16) NOT NULL default '0',
  `txtComment` text NOT NULL,
  `asinID` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`ixComment`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

--
-- Dumping data for table `usrComment`
--


-- --------------------------------------------------------

--
-- Table structure for table `usrMessage`
--

CREATE TABLE IF NOT EXISTS `usrMessage` (
  `ixMessage` int(16) NOT NULL auto_increment,
  `usrID` int(16) NOT NULL default '0',
  `txtSender` varchar(255) NOT NULL default '',
  `txtSubject` varchar(255) NOT NULL default '',
  `dtTime` int(16) NOT NULL default '0',
  `txtMessage` text NOT NULL,
  `nStatus` int(16) NOT NULL default '0',
  PRIMARY KEY  (`ixMessage`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

--
-- Dumping data for table `usrMessage`
--


-- --------------------------------------------------------

--
-- Table structure for table `usrSecurity`
--

CREATE TABLE IF NOT EXISTS `usrSecurity` (
  `id` int(16) NOT NULL auto_increment,
  `checksum1` varchar(255) NOT NULL default '',
  `checksum2` varchar(255) NOT NULL default '',
  `checksum3` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

--
-- Dumping data for table `usrSecurity`
--

INSERT INTO `usrSecurity` (`id`, `checksum1`, `checksum2`, `checksum3`) VALUES
(1, '5ba3dfa614805674c0b2565a335f9e265347003e', '5b5162812950616c', 'c60a5789b7a316c6dfc692ac3ab1cac77cdb71d9'),
(2, '698ebd0d2ebc61dc611a4265e800d3e70ddcccda', '91a0f15920e542ef', 'c60a5789b7a316c6dfc692ac3ab1cac77cdb71d9'),
(3, 'b0ca0b83252ae26f32b3ad306bc5a62f320fe143', 'b8f74e1ca96c2e6da8aa2560f4ea98b8', 'edde9b86132c1c50daa4aa5298db2852caeddd87'),
(4, 'e1e252e520a1e1882ff32574deb0c217e5f4ed67', '962350175f261c94', 'c60a5789b7a316c6dfc692ac3ab1cac77cdb71d9'),
(5, '563a240eacf995a58b00230597984846bd45f7c1', '471caa32296e8f59', 'c60a5789b7a316c6dfc692ac3ab1cac77cdb71d9');

-- --------------------------------------------------------

--
-- Table structure for table `wsCommand`
--

CREATE TABLE IF NOT EXISTS `wsCommand` (
  `ixCommand` int(32) unsigned NOT NULL auto_increment,
  `strixCommand` varchar(20) NOT NULL default '',
  `strDescription` text NOT NULL,
  `scnmCreator` varchar(255) NOT NULL default '',
  `scnmModifiedBy` varchar(255) NOT NULL default '',
  `dtCreated` int(16) NOT NULL default '0',
  `dtValidFrom` int(16) NOT NULL default '0',
  `dtValidTo` int(16) NOT NULL default '-1',
  `dtLastModified` int(16) NOT NULL default '0',
  `optVisibility` varchar(255) NOT NULL default '',
  `ixfOptionDefault` int(32) unsigned NOT NULL default '0',
  PRIMARY KEY  (`ixCommand`)
) TYPE=MyISAM AUTO_INCREMENT=28 ;

--
-- Dumping data for table `wsCommand`
--

INSERT INTO `wsCommand` (`ixCommand`, `strixCommand`, `strDescription`, `scnmCreator`, `scnmModifiedBy`, `dtCreated`, `dtValidFrom`, `dtValidTo`, `dtLastModified`, `optVisibility`, `ixfOptionDefault`) VALUES
(1, 'search', 'Universal internet search', 'david', 'david', 1120398719, 1120398719, 1120398742, 1120398719, '4', 0),
(2, 'search', 'Universal internet search', 'david', 'david', 1120398719, 1120398742, 1120398760, 1120398742, '4', 0),
(3, 'search', 'Universal internet search', 'david', 'david', 1120398719, 1120398760, 1120399112, 1120398760, '4', 0),
(4, 'search', 'Universal internet search', 'david', 'david', 1120398719, 1120399112, 1120399260, 1120399112, '4', 0),
(5, 's', 'Another universal search', 'david', 'david', 1120399150, 1120399150, 1120399190, 1120399150, '4', 0),
(6, 's', 'Another universal search', 'david', 'david', 1120399150, 1120399190, 1120399434, 1120399190, '4', 0),
(7, 'search', 'Universal internet search', 'david', 'david', 1120398719, 1120399260, 1120399278, 1120399260, '4', 0),
(8, 'search', 'Universal internet search', 'david', 'david', 1120398719, 1120399278, 1120399290, 1120399278, '4', 0),
(9, 'search', 'Universal internet search', 'david', 'david', 1120398719, 1120399290, 1120399364, 1120399290, '4', 0),
(10, 'search', 'Universal internet search', 'david', 'david', 1120398719, 1120399364, 1120399398, 1120399364, '4', 0),
(11, 'search', 'Universal internet search', 'david', 'david', 1120398719, 1120399398, 1120450531, 1120399398, '4', 0),
(12, 's', 'Another universal search', 'david', 'david', 1120399150, 1120399434, 1120399961, 1120399434, '4', 0),
(13, 'hotmail', 'Goes to hotmail.com', 'david', 'david', 1120399721, 1120399721, 1120399744, 1120399721, '4', 0),
(14, 'hotmail', 'Goes to hotmail.com', 'david', 'david', 1120399721, 1120399744, -1, 1120399744, '4', 0),
(15, 'gmail', 'Gmail.com', 'david', 'david', 1120399894, 1120399894, -1, 1120399894, '4', 0),
(16, 's', 'Another universal search', 'david', 'david', 1120399150, 1120399961, 1120652851, 1120399961, '4', 0),
(17, 'pws', 'Goes back to peachy.ws', 'david', 'david', 1120400014, 1120400014, -1, 1120400014, '4', 0),
(18, 'create', 'Opens this peachy command creation dialog', 'david', 'david', 1120400062, 1120400062, -1, 1120400062, '4', 0),
(19, 'search', 'Universal internet search', 'david', 'peachy', 1120398719, 1120450531, -1, 1120450531, '4', 0),
(20, 's', 'Another universal search', 'david', 'peachy', 1120399150, 1120652851, 1120652957, 1120652851, '4', 0),
(21, 's', 'Another universal search', 'david', 'peachy', 1120399150, 1120652957, 1120653087, 1120652957, '4', 0),
(22, 's', 'Another universal search', 'david', 'peachy', 1120399150, 1120653087, -1, 1120653087, '4', 0),
(23, 'd', 'Goes to a delicious tag', 'peachy', 'peachy', 1120653469, 1120653469, 1120653669, 1120653469, '4', 0),
(24, 'd', 'Goes to a delicious tag', 'peachy', 'peachy', 1120653469, 1120653669, -1, 1120653669, '4', 0),
(25, '', '', 'david', 'david', 1121063901, 1121063901, 1121140029, 1121063901, '4', 0),
(26, 'gs', 'google search', 'Peter', 'Peter', 1124933224, 1124933224, -1, 1124933224, '4', 0),
(27, 'wiki', 'Searches the wikipedia for a particular topic', 'creator', 'creator', 1132824791, 1132824791, -1, 1132824791, '4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wsOption`
--

CREATE TABLE IF NOT EXISTS `wsOption` (
  `ixOption` int(32) unsigned NOT NULL auto_increment,
  `ixfCommand` int(32) unsigned NOT NULL default '0',
  `strixOption` varchar(20) NOT NULL default '',
  `strixOptionAlias` varchar(20) NOT NULL default '',
  `urlDirective` varchar(255) NOT NULL default '',
  `strDescription` text NOT NULL,
  `scnmCreator` varchar(255) NOT NULL default '',
  `scnmModifiedBy` varchar(255) NOT NULL default '',
  `dtCreated` int(16) NOT NULL default '0',
  `dtValidFrom` int(16) NOT NULL default '0',
  `dtValidTo` int(16) NOT NULL default '-1',
  `dtLastModified` int(16) NOT NULL default '0',
  `optVisibility` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`ixOption`)
) TYPE=MyISAM AUTO_INCREMENT=53 ;

--
-- Dumping data for table `wsOption`
--

INSERT INTO `wsOption` (`ixOption`, `ixfCommand`, `strixOption`, `strixOptionAlias`, `urlDirective`, `strDescription`, `scnmCreator`, `scnmModifiedBy`, `dtCreated`, `dtValidFrom`, `dtValidTo`, `dtLastModified`, `optVisibility`) VALUES
(1, 1, 'g', 'g', 'http://www.google.com/search?q=*', 'Google search', 'david', 'david', 1120398719, 1120398719, 1120398742, 1120398719, '4'),
(2, 2, 'g', 'g', 'http://www.google.com/search?q=*', 'Google search', 'david', 'david', 1120398742, 1120398742, 1120398760, 1120398742, '4'),
(3, 2, 'y', 'y', 'http://search.yahoo.com/search?p=*', 'Yahoo search', 'david', 'david', 1120398742, 1120398742, 1120398760, 1120398742, '4'),
(4, 3, 'g', 'g', 'http://www.google.com/search?q=*', 'Google search', 'david', 'david', 1120398760, 1120398760, -1, 1120398760, '4'),
(5, 3, 'y', 'y', 'http://search.yahoo.com/search?p=*', 'Yahoo search', 'david', 'david', 1120398760, 1120398760, 1120653087, 1120398760, '4'),
(6, 3, 'm', 'm', 'http://search.msn.com/results.aspx?q=*', 'msn.com search', 'david', 'david', 1120398760, 1120398760, -1, 1120398760, '4'),
(7, 4, '-g', '-g', 'http://www.google.com/search?q=*', 'Google search', 'david', 'david', 1120399112, 1120399112, 1120399190, 1120399112, '4'),
(8, 4, '-y', '-y', 'http://search.yahoo.com/search?p=*', 'Yahoo search', 'david', 'david', 1120399112, 1120399112, 1120399190, 1120399112, '4'),
(9, 4, '-m', '-m', 'http://search.msn.com/results.aspx?q=*', 'msn.com search', 'david', 'david', 1120399112, 1120399112, 1120399190, 1120399112, '4'),
(10, 5, '-g', '-g', 'http://www.google.com/search?q=*', 'Google search', 'david', 'david', 1120399150, 1120399150, 1120399190, 1120399150, '4'),
(11, 6, '-g', '-g', 'http://www.google.com/search?q=*', 'Google search', 'david', 'david', 1120399190, 1120399190, 1120399278, 1120399190, '4'),
(12, 6, '-y', '-y', 'http://search.yahoo.com/search?p=*', 'Yahoo search', 'david', 'david', 1120399190, 1120399190, 1120399290, 1120399190, '4'),
(13, 6, '-m', '-m', 'http://search.msn.com/results.aspx?q=*', 'Msn.com search', 'david', 'david', 1120399190, 1120399190, 1120399364, 1120399190, '4'),
(14, 7, 'a', 'a', 'http://a', 'a', 'david', 'david', 1120399260, 1120399260, 1120399434, 1120399260, '4'),
(15, 8, '-g', '-g', 'http://www.google.com/search?q=*', 'Google search', 'david', 'david', 1120399278, 1120399278, 1120399290, 1120399278, '4'),
(16, 9, '-g', '-g', 'http://www.google.com/search?q=*', 'Google search', 'david', 'david', 1120399290, 1120399290, 1120399364, 1120399290, '4'),
(17, 9, '-y', '-y', 'http://search.yahoo.com/search?p=*', 'Yahoo search', 'david', 'david', 1120399290, 1120399290, 1120399364, 1120399290, '4'),
(18, 10, '-g', '-g', 'http://www.google.com/search?q=*', 'Google search', 'david', 'david', 1120399364, 1120399364, 1120399398, 1120399364, '4'),
(19, 10, '-y', '-y', 'http://search.yahoo.com/search?p=*', 'Yahoo search', 'david', 'david', 1120399364, 1120399364, 1120399398, 1120399364, '4'),
(20, 10, '-m', '-m', 'http://search.msn.com/results.aspx?q=*', 'msn.com search', 'david', 'david', 1120399364, 1120399364, 1120399398, 1120399364, '4'),
(21, 10, '-a', '-a', 'http://www.altavista.com/web/results?q=*', 'Alta vista search', 'david', 'david', 1120399364, 1120399364, 1120399398, 1120399364, '4'),
(22, 11, '-g', '-g', 'http://www.google.com/search?q=*', 'Google search', 'david', 'david', 1120399398, 1120399398, 1120450531, 1120399398, '4'),
(23, 11, '-y', '-y', 'http://search.yahoo.com/search?p=*', 'Yahoo search', 'david', 'david', 1120399398, 1120399398, 1120450531, 1120399398, '4'),
(24, 11, '-m', '-m', 'http://search.msn.com/results.aspx?q=*', 'msn.com search', 'david', 'david', 1120399398, 1120399398, 1120450531, 1120399398, '4'),
(25, 11, '-a', '-a', 'http://www.altavista.com/web/results?q=*', 'Alta vista search', 'david', 'david', 1120399398, 1120399398, 1120450531, 1120399398, '4'),
(26, 11, '-a9', '-a9', 'http://a9.com/*', 'a9.com search', 'david', 'david', 1120399398, 1120399398, 1120450531, 1120399398, '4'),
(27, 12, 'a', 'a', 'http://a', 'a', 'david', 'david', 1120399434, 1120399434, 1120399744, 1120399434, '4'),
(28, 13, 'a', 'a', 'http://www.hotmail.com', 'Goes to hotmail.com', 'david', 'david', 1120399721, 1120399721, 1120399744, 1120399721, '4'),
(29, 14, 'a', 'a', 'http://www.hotmail.com', 'Goes to hotmail.com', 'david', 'david', 1120399744, 1120399744, -1, 1120399744, '4'),
(30, 15, 'g', 'g', 'http://www.gmail.com', 'Goes to gmail.com', 'david', 'david', 1120399894, 1120399894, -1, 1120399894, '4'),
(31, 16, 'aa', 'aa', 'http://aa', 'aa', 'david', 'david', 1120399961, 1120399961, -1, 1120399961, '4'),
(32, 17, 'pws', 'pws', 'http://www.peachy.ws', 'Goes directly back to www.peachy.ws', 'david', 'david', 1120400014, 1120400014, -1, 1120400014, '4'),
(33, 18, 'create', 'create', 'http://www.peachy.ws/command/new', 'Opens this peachy command creation dialog', 'david', 'david', 1120400062, 1120400062, -1, 1120400062, '4'),
(34, 19, '-g', '-g', 'http://www.google.com/search?q=*', 'Google search', 'peachy', 'david', 1120450531, 1120450531, -1, 1120450531, '4'),
(35, 19, '-y', '-y', 'http://search.yahoo.com/search?p=*', 'Yahoo search', 'peachy', 'david', 1120450531, 1120450531, -1, 1120450531, '4'),
(36, 19, '-m', '-m', 'http://search.msn.com/results.aspx?q=*', 'msn.com search', 'peachy', 'david', 1120450531, 1120450531, -1, 1120450531, '4'),
(37, 19, '-a', '-a', 'http://www.altavista.com/web/results?q=*', 'Alta vista search', 'peachy', 'david', 1120450531, 1120450531, -1, 1120450531, '4'),
(38, 19, '-a9', '-a9', 'http://a9.com/*', 'a9.com search', 'peachy', 'david', 1120450531, 1120450531, -1, 1120450531, '4'),
(39, 19, '-images', '-images', 'http://images.google.co.nz/images?q=*', 'Searches google images', 'peachy', 'david', 1120450531, 1120450531, -1, 1120450531, '4'),
(40, 20, 'gg', 'gg', 'http://www.google.com/search?q=*', 'Search google', 'peachy', 'david', 1120652851, 1120652851, 1120652957, 1120652851, '4'),
(41, 21, 'gg', 'gg', 'http://www.google.com/search?q=*', 'Search google', 'peachy', 'david', 1120652957, 1120652957, 1120653087, 1120652957, '4'),
(42, 21, '-yh', '-yh', 'http://search.yahoo.com/search?p=*', 'Yahoo search', 'peachy', 'david', 1120652957, 1120652957, -1, 1120652957, '4'),
(43, 22, 'gg', 'gg', 'http://www.google.com/search?q=*', 'Search google', 'peachy', 'david', 1120653087, 1120653087, -1, 1120653087, '4'),
(44, 22, 'y', 'y', 'http://search.yahoo.com/search?p=*', 'Yahoo search', 'peachy', 'david', 1120653088, 1120653088, -1, 1120653088, '4'),
(45, 23, 'tag', 'tag', 'http://del.icio.us/tag/*', 'Goes to the tag at del.icio.us', 'peachy', 'peachy', 1120653469, 1120653469, 1120653669, 1120653469, '4'),
(46, 24, 'tag', 'tag', 'http://del.icio.us/tag/*', 'Goes to the tag at del.icio.us', 'peachy', 'peachy', 1120653669, 1120653669, -1, 1120653669, '4'),
(47, 24, '-rss', '-rss', 'http://del.icio.us/rss/tag/*', 'Get the tag back as rss', 'peachy', 'peachy', 1120653669, 1120653669, -1, 1120653669, '4'),
(48, 25, '', '', 'http://slashdot.org/search.pl?query=*', '', 'david', 'david', 1121063901, 1121063901, 1121140029, 1121063901, '4'),
(49, 0, 'default', 'default', 'http://www.google.com/search?q=*', 'easy search google', 'david', '', 1121140029, 1121140029, -1, 1121140029, '4'),
(50, 0, '-i', '-i', 'http://images.google.co.nz/images?q=*', 'google image search', 'david', '', 1121140029, 1121140029, -1, 1121140029, '4'),
(51, 26, 'q', 'q', 'http://www.google.com/search?q=*', '', 'Peter', 'Peter', 1124933224, 1124933224, -1, 1124933224, '4'),
(52, 27, '-sub', '-sub', 'http://en.wikipedia.org/wiki/*', 'Searches the wikipedia for a particular topic', 'creator', 'creator', 1132824791, 1132824791, -1, 1132824791, '4');
