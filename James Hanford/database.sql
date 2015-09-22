-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2015 at 03:36 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `media-db`
--
CREATE DATABASE `media-db` DEFAULT CHARACTER SET utf16 COLLATE utf16_general_ci;
USE `media-db`;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `countryID` int(10) NOT NULL AUTO_INCREMENT,
  `country` varchar(50) NOT NULL,
  PRIMARY KEY (`countryID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`countryID`, `country`) VALUES
(1, 'Australia'),
(2, 'Germany'),
(3, 'Russia'),
(4, 'United Kingdom'),
(5, 'United States ');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `mediaID` int(10) NOT NULL AUTO_INCREMENT,
  `mediaTitle` varchar(100) NOT NULL,
  `memberID` int(10) NOT NULL,
  `mediaFileName` varchar(100) DEFAULT NULL,
  `mediaTypeID` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`mediaID`),
  KEY `memberID` (`memberID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`mediaID`, `mediaTitle`, `memberID`, `mediaFileName`, `mediaTypeID`) VALUES
(2, 'cab201.png', 27, '1442769320_cab201.png', 1),
(4, 'albert.jpg', 27, '1442846161_albert.jpg', 1),
(6, 'plant.jpg', 27, '1442846186_plant.jpg', 1),
(7, 'kanyevideo.mp4', 27, '1442846628_kanyevideo.mp4', 2),
(8, 'plant.jpg', 28, '1442859971_plant.jpg', 1),
(9, 'zombie.jpg', 28, '1442859971_zombie.jpg', 1),
(10, 'albert.jpg', 28, '1442859989_albert.jpg', 1),
(11, 'cab201.png', 28, '1442859989_cab201.png', 1),
(12, 'Shark Ops.png', 28, '1442899554_shark ops.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mediatype`
--

CREATE TABLE IF NOT EXISTS `mediatype` (
  `mediaTypeID` tinyint(2) NOT NULL AUTO_INCREMENT,
  `mediatype` varchar(20) NOT NULL,
  PRIMARY KEY (`mediaTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mediatype`
--

INSERT INTO `mediatype` (`mediaTypeID`, `mediatype`) VALUES
(1, 'Image'),
(2, 'Video'),
(3, 'Audio');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `memberID` int(10) NOT NULL AUTO_INCREMENT,
  `memberUsername` varchar(20) NOT NULL,
  `memberPassword` varchar(64) NOT NULL,
  `memberSalt` varchar(32) NOT NULL,
  `memberFirstName` varchar(45) NOT NULL,
  `memberLastName` varchar(45) NOT NULL,
  `memberStreetNumber` varchar(10) DEFAULT NULL,
  `memberStreetName` varchar(100) DEFAULT NULL,
  `memberSuburb` varchar(100) DEFAULT NULL,
  `memberPostCode` varchar(4) NOT NULL,
  `countryID` int(10) NOT NULL,
  `memberPhone` varchar(42) DEFAULT NULL,
  `memberMobile` varchar(42) DEFAULT NULL,
  `memberEmail` varchar(255) NOT NULL,
  `memberGender` char(1) NOT NULL,
  `memberJoinDate` datetime NOT NULL,
  `memberImage` varchar(100) DEFAULT NULL,
  `typeID` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`memberID`),
  KEY `countryID` (`countryID`),
  KEY `typeID` (`typeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`memberID`, `memberUsername`, `memberPassword`, `memberSalt`, `memberFirstName`, `memberLastName`, `memberStreetNumber`, `memberStreetName`, `memberSuburb`, `memberPostCode`, `countryID`, `memberPhone`, `memberMobile`, `memberEmail`, `memberGender`, `memberJoinDate`, `memberImage`, `typeID`) VALUES
(27, 'Sample', '5c3ce17e8abb45b450d8e14dd2a9aa4841ac8cdb0c682e6f61c9212085dfe3a0', 'f69b19ddf99ac367cb5dfb4ce10aae0e', 'Sample', 'User', NULL, NULL, NULL, '4011', 1, NULL, NULL, 'sample@Sample.com', 'M', '2014-10-13 15:23:11', 'notbad.jpg', 1),
(26, 'Mila', '440568f9191be326af908dbcac98ac1db3e8aa9b96594b5e04c4c48ac1209df6', 'b1bdd921dd0b03b51c173582620eb48e', 'Mila', 'Kunis', NULL, NULL, NULL, '1111', 5, NULL, NULL, 'Mila@Kunis.com', 'F', '2014-10-13 14:20:13', '26/5346_mila.jpg', 1),
(21, 'Beyonce', '98dc7313e19cdd07bb7cfa26dfec2bea6a5d8f6c35bc6acb7e92d2a7767a4e1f', '03d54442bd8863225229b7061ee4d215', 'Beyonce', 'Knowles', NULL, NULL, NULL, '1234', 5, NULL, NULL, 'Knowles@gmail.com', 'F', '2014-10-13 13:41:16', '21/8616_beyonce.jpg', 1),
(19, 'JayZ', 'a5765366a294dd6631e71ec3ae3d214adcfa462bbc766c8fd4c9c75845f51832', 'b8a8b744ace825dc7ebfa29d2a5e50c1', 'Jay', 'Z', NULL, NULL, NULL, '1337', 5, NULL, NULL, 'Jayz@jayz.com', 'M', '2014-10-13 10:24:20', '19/3704_jay-z.jpg', 1),
(20, 'Kanye', '335106dd1b001c3658076445307a29c693afb2c05d81e6f2e85397ff3afafb35', '17d573090ea992b8601c19510d82822d', 'Kanye', 'Pest', NULL, NULL, NULL, '1337', 5, NULL, NULL, 'Kanye@pest.com', 'M', '2014-10-13 11:27:39', '20/1326_kanye-west.jpeg', 1),
(25, 'Emma', 'd78d4d07b1ea3fe1d11d7e7a5dcd7e124f11e1a16151699fe5f2835daef3ba12', '0bd22f845caab32135df5eb1c64d17bc', 'Emma', 'Stone', NULL, NULL, NULL, '4111', 5, NULL, NULL, 'Emma@Stone.com', 'F', '2014-10-13 14:12:29', '25/7856_emma.jpeg', 1),
(24, 'Drake', 'ff32b5419a862aed18fb281c81aea618d8597c1ad4c6906fb565c18cb77424df', '175256aa645027616af611e434407785', 'Drake', 'Graham', NULL, NULL, NULL, '4001', 5, NULL, NULL, 'drake@drake', 'M', '2014-10-13 14:02:11', '24/5892_drake.jpg', 1),
(28, 'Demo', 'f8c88c459603979f78fdafb03f97251b9a678759a02e817e7b097a919d238402', '10758c9d2204f521c86bb14ec994c1e4', 'James', 'Test', NULL, NULL, NULL, '4012', 1, NULL, NULL, 'james.rabbit96@gmail.com', 'M', '2015-09-22 04:20:15', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `typeID` tinyint(2) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`typeID`),
  KEY `typeID` (`typeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`typeID`, `type`) VALUES
(0, 'admin'),
(1, 'member');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
