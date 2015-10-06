-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2015 at 04:22 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `media`
--
CREATE DATABASE IF NOT EXISTS `media` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `media`;

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `administratorID` int(10) NOT NULL AUTO_INCREMENT,
  `administratorUsername` text NOT NULL,
  `administratorPassword` varchar(64) NOT NULL,
  `administratorSalt` varchar(32) NOT NULL,
  `accountType` enum('1','0') NOT NULL,
  `administratorFirstName` varchar(45) NOT NULL,
  `administratorLastName` varchar(45) NOT NULL,
  `administratorEmail` varchar(100) NOT NULL,
  `administratorJoinDate` date NOT NULL,
  PRIMARY KEY (`administratorID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`administratorID`, `administratorUsername`, `administratorPassword`, `administratorSalt`, `accountType`, `administratorFirstName`, `administratorLastName`, `administratorEmail`, `administratorJoinDate`) VALUES
(1, 'admin', '9d26a3c61c0e2ce5c980ad8c7fff13c08cf898b6f3786930c73b68e3b88ad779', '002640cb549ba08ee90cd79aee89cce7', '0', 'Connor', 'Markula', 'cmarkula55@gmail.com', '2014-01-13'),
(2, 'adminkt', '19612ae3ed04b7c224ba12db07be5ce0915eed3de351ccbf60508f948b476e5a', '15cec5205c9e34355287acbb4d096a08', '0', 'Kristi', 'Turman', 'kristi@gmail.com', '2014-01-01'),
(3, 'adminst', '0fec1e61a67e7a0fd3623e0d9d656fc765462557c2a5f5933ee37b63d9864d80', 'a1dca222c170e3d2b5dd2557d5a57090', '0', 'Scott', 'Turman', 'turman@telstra.com.au', '2014-01-20'),
(4, 'adminrw', '8a35fd6de1e692dfa8277c405f93bba34926176285c85a13634e54e051b576f3', '09d1fe391935b75f798053f866ee5052', '0', 'Richard', 'Weathers', 'richo@gmail.com', '2014-01-20'),
(5, 'adminnc', 'd54dc8e24b12ba4805777d6b6eac977094b73962a15e04f227ec40eb6ec56432', '4d069acd30e4b0c6eb5e5f36c01d1482', '0', 'Nicholas', 'Cutter', 'nicholas.cutter@gmail.com', '2014-01-22'),
(7, '12', '3ac02948a93f01f99b864e2db2eed8968e3111121984c71080a6ba50f31d176c', '5e3e560105f8437b804a193b2217acbf', '0', '', '', 'sada@sdgd.com', '2014-09-30'),
(8, '1', 'c37094441a05a44ce5e7a05bf5d5daa46614e275e61667ea2c9303b69723cd15', 'ed8755f552c7a11f226c1308335b8bfe', '0', '', '', 'popnet360@hotmail.com', '2014-10-19');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `categoryID` int(10) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(30) NOT NULL,
  `categoryDescription` text NOT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`, `categoryDescription`) VALUES
(1, 'Xbox 360', 'Games designed to play on the Xbox 360 platform.'),
(2, 'PlayStation 3', 'Games designed to play on the PlayStation 3 platform.'),
(3, 'PC', 'Games designed to play on the personal computer platform.'),
(4, 'iPhone', 'Games designed to play on the iPhone platform.');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `commentID` int(10) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `memberID` int(11) NOT NULL,
  `commentDateTime` datetime NOT NULL,
  `reviewID` int(11) NOT NULL,
  PRIMARY KEY (`commentID`),
  KEY `fk_Comment_Member1_idx` (`memberID`),
  KEY `fk_Comment_Review1_idx` (`reviewID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentID`, `comment`, `memberID`, `commentDateTime`, `reviewID`) VALUES
(1, 'I love Minecraft! ', 3, '2014-01-20 09:00:00', 1),
(2, 'Best Minecraft version yet. Thanks for the review.', 12, '2014-04-02 02:30:00', 1),
(3, 'I play this way too much?', 13, '2014-01-13 16:00:00', 4),
(4, 'I love this game!!!', 13, '2014-01-13 16:23:00', 4),
(5, '<p>ten/ten would play again ign 2015</p>', 1, '2015-01-28 16:53:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `current`
--

CREATE TABLE IF NOT EXISTS `current` (
  `themeID` int(11) NOT NULL,
  PRIMARY KEY (`themeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `current`
--

INSERT INTO `current` (`themeID`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `memberID` int(10) NOT NULL AUTO_INCREMENT,
  `memberUsername` varchar(45) NOT NULL,
  `memberPassword` varchar(64) NOT NULL,
  `memberSalt` varchar(32) NOT NULL,
  `accountType` enum('1','0') NOT NULL,
  `memberFirstName` varchar(45) NOT NULL,
  `memberLastName` varchar(45) NOT NULL,
  `memberStreet` varchar(45) DEFAULT NULL,
  `memberSuburb` varchar(45) DEFAULT NULL,
  `memberPostcode` char(4) DEFAULT NULL,
  `memberCountry` varchar(45) NOT NULL,
  `memberPhoneNumber` varchar(11) DEFAULT NULL,
  `memberMobileNumber` varchar(11) DEFAULT NULL,
  `memberEmail` varchar(100) NOT NULL,
  `memberGender` enum('Male','Female') NOT NULL,
  `memberJoinDate` date NOT NULL,
  `memberSubscription` enum('Yes','No') NOT NULL,
  `memberImage` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`memberID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`memberID`, `memberUsername`, `memberPassword`, `memberSalt`, `accountType`, `memberFirstName`, `memberLastName`, `memberStreet`, `memberSuburb`, `memberPostcode`, `memberCountry`, `memberPhoneNumber`, `memberMobileNumber`, `memberEmail`, `memberGender`, `memberJoinDate`, `memberSubscription`, `memberImage`) VALUES
(1, 'natalie', '99484689f5114d56aa59173dc1cca502ff3f52dd6ee9a2595042d37da589f8a1', '1e9d45ebbecc02236d951ff1e3d8fc81', '1', 'Natalie', 'Goddard', '18 Edward St', 'Brisbane', '4001', 'Australia', '0738109022', '0401209638', 'ngoddard@gmail.com', 'Male', '2014-01-16', 'Yes', 'natalie.jpg'),
(2, 'yvette', '19612ae3ed04b7c224ba12db07be5ce0915eed3de351ccbf60508f948b476e5a', '15cec5205c9e34355287acbb4d096a08', '1', 'Yvette', 'Lyons', '24 Avoca St', 'Yeronga', '4104', 'Australia', NULL, '413652378', 'yvette_lyon@hotmail.com', 'Female', '2014-01-16', 'Yes', ''),
(3, 'kathryn', '0fec1e61a67e7a0fd3623e0d9d656fc765462557c2a5f5933ee37b63d9864d80', 'a1dca222c170e3d2b5dd2557d5a57090', '1', 'Kathryn', 'Jenkinns', '43101 Dexter St', 'Tennyson', '4105', 'Australia', '431096952', NULL, 'katjenkinns@iinet.net', 'Female', '2014-01-20', 'Yes', ''),
(4, 'jenny', '8a35fd6de1e692dfa8277c405f93bba34926176285c85a13634e54e051b576f3', '09d1fe391935b75f798053f866ee5052', '1', 'Jennifer', 'Louise', '103 Davis Lane', 'Brendale', '4500', 'Australia', '753201738', '489459921', 'jen.L@talktalk.net', 'Female', '2014-01-23', 'Yes', ''),
(5, 'michelle', 'd54dc8e24b12ba4805777d6b6eac977094b73962a15e04f227ec40eb6ec56432', '4d069acd30e4b0c6eb5e5f36c01d1482', '1', 'Michelle', 'Turner', '29 Cascade Drive', 'Underwood', '4119', 'Australia', '770731334', '447789653', 'MTurner@optusnet.com.au', 'Female', '2014-04-30', 'Yes', 'jenniferlouise.jpg'),
(6, 'bennie', '9d26a3c61c0e2ce5c980ad8c7fff13c08cf898b6f3786930c73b68e3b88ad779', '002640cb549ba08ee90cd79aee89cce7', '1', 'Ben', 'Hogan', '  ', '', '4510', 'Australia', NULL, NULL, 'ben1972@gmail.com', 'Male', '2014-02-02', 'Yes', ''),
(7, 'natasha', '19612ae3ed04b7c224ba12db07be5ce0915eed3de351ccbf60508f948b476e5a', '15cec5205c9e34355287acbb4d096a08', '1', 'Natasha', 'Smith', '56 Ascot Court', 'Bundall', '4217', 'Australia', '792811317', '415475042', 'NSmithy@tpg.com.au', 'Female', '2014-02-18', 'Yes', ''),
(8, 'court', '0fec1e61a67e7a0fd3623e0d9d656fc765462557c2a5f5933ee37b63d9864d80', 'a1dca222c170e3d2b5dd2557d5a57090', '1', 'Courtney', 'Gonsalves', '24/145 Snipe St', 'Miami', '4220', 'Australia', '755490087', '454657581', 'gonsalves@iinet.net', 'Female', '2014-02-12', 'Yes', ''),
(9, 'jason', '8a35fd6de1e692dfa8277c405f93bba34926176285c85a13634e54e051b576f3', '09d1fe391935b75f798053f866ee5052', '1', 'Jason', 'House', '2 Carberry St', 'Grange', '4051', 'Australia', '443881263', NULL, 'man_in_the_house@talktalk.net', 'Male', '2014-03-17', 'Yes', ''),
(10, 'tony', 'd54dc8e24b12ba4805777d6b6eac977094b73962a15e04f227ec40eb6ec56432', '4d069acd30e4b0c6eb5e5f36c01d1482', '1', 'Tony', 'House', '  ', '', '4509', 'Australia', '417286753', NULL, 'tmat@gmail.com', 'Male', '2014-03-20', 'Yes', 'jasonhouse.jpg'),
(11, 'chrissie', '9d26a3c61c0e2ce5c980ad8c7fff13c08cf898b6f3786930c73b68e3b88ad779', '002640cb549ba08ee90cd79aee89cce7', '1', 'Christine', 'Howard', '128 Grandview Rd', 'Pullenvale', '4069', 'Australia', NULL, '412368799', 'christy043@hotmail.com', 'Female', '2014-04-01', 'No', ''),
(12, 'julia', '19612ae3ed04b7c224ba12db07be5ce0915eed3de351ccbf60508f948b476e5a', '15cec5205c9e34355287acbb4d096a08', '1', 'Julia', 'Hammar', '76 Ontario Crescent', 'Parkinson', '4115', 'Australia', '739772748', '402324857', 'julia.hammar@bigpond.com', 'Female', '2014-04-02', 'Yes', ''),
(13, 'james', '0fec1e61a67e7a0fd3623e0d9d656fc765462557c2a5f5933ee37b63d9864d80', 'a1dca222c170e3d2b5dd2557d5a57090', '1', 'James', 'Menon', '34 Taylor St', 'Windsor', '4030', 'Australia', '739217545', '402952335', 'jamie.menon@gmail.com', 'Male', '2014-01-13', 'Yes', ''),
(14, 'connor', '7670261c791a350e0e780532660d7eba78144e9c3fdb073ff9cff489ab6e280a', '1319f53f523cc0053062a5ae09c4b889', '1', 'asd', 'asd', '', '', '1234', 'sad', '', '', 'ca@asfd.com', 'Male', '2014-09-09', '', '4333_8480_favicon.jpg'),
(15, 's', '06426e76b81478b2f515f6055f258feae2baa68bc7a5d8e406ec6098b113b595', '83ffb2ff958ac88311fb725cfb02a2d9', '1', 'a', 'a', '', '', '1234', '1', '', '', 'popnet360@hotmail.com', 'Male', '2014-10-20', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `themeID` int(11) NOT NULL AUTO_INCREMENT,
  `themeName` varchar(40) NOT NULL,
  `themeDescription` text NOT NULL,
  `themeFileName` varchar(45) NOT NULL,
  `themeImage` varchar(30) NOT NULL,
  PRIMARY KEY (`themeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`themeID`, `themeName`, `themeDescription`, `themeFileName`, `themeImage`) VALUES
(1, 'Gamer', 'a retro gamer theme', 'main.css', 'theme1.png'),
(2, 'simple', 'a simple theme', 'simple.css', 'theme2.png');

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE IF NOT EXISTS `upload` (
  `uploadID` int(10) NOT NULL AUTO_INCREMENT,
  `uploadTitle` varchar(50) NOT NULL,
  `uploadContent` text NOT NULL,
  `categoryID` int(11) NOT NULL,
  `administratorID` int(11) NOT NULL,
  `uploadDateTime` datetime NOT NULL,
  `uploadRating` int(1) NOT NULL,
  `uploadImage` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`uploadID`),
  KEY `fk_Review_Administrator_idx` (`administratorID`),
  KEY `fk_Review_Category1_idx` (`categoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`uploadID`, `uploadTitle`, `uploadContent`, `categoryID`, `administratorID`, `uploadDateTime`, `uploadRating`, `uploadImage`) VALUES
(1, 'Minecraft', 'Minecraft Though it may look primitive at a glance, your options in Minecraft are limited only by your imagination. Cobbling together a first home out of dirt and stone feels great; building a castle with a moat, a dining hall, and a working underground rail system feels even greater. That sense of creative progression, coupled with the inherent danger of mining underground caverns full of monsters, makes Minecraft exciting, rewarding, and tense. Its one of gaming''s most expressive creative outlets.', 2, 2, '2014-01-01 09:00:00', 5, 'minecraft.jpg'),
(2, 'Assassin''s Creed Liberation HD', 'Assassin''s Creed Liberation HD For a multitude of reasons, Aveline is the kind of character I''d like to see more of in gaming, and watching her flounder through this game all over again hurt. I wanted to see her tale succeed, but Assassin''s Creed Liberation HD is just too lacking in too many areas to make it happen. There''s no one thing to point to as overtly broken; it simply dies by a thousand tiny cuts. Its craft is sloppy, its design remains shackled by ill-conceived new ideas, as well as the limitations of the platform it hails from. Its the definitive version of a game that had very little going for it in the first place.', 1, 5, '2014-01-22 13:00:00', 2, 'assassinscreed.jpg'),
(3, 'Ravensword: Shadowlands', 'Ravensword: Shadowlands The best-case scenario for Ravensword: Shadowlands might be to consider it as a budget RPG suitable primarily for people who cannot play better RPGs, because of  I don''t know, allergies? A really really old computer? But even there it falls short. While combat itself works on a moment-to-moment level most of the time, it falls apart too often because the progression system is too haphazard. There are huge random difficulty spikes, in large part because all the components that make up progression feel randomly added, like they''re there just because they''re supposed to be there, as opposed to actually making things more fun or complex or interesting.', 3, 4, '2014-01-20 16:30:00', 1, 'ravensword.png'),
(4, 'Grand Theft Auto: San Andreas', 'Grand Theft Auto: San Andreas Rockstar has gone to great lengths to ensure that GTA: San Andreas supports updated textures, draw distances, and lighting that live up to the potential of Retina displays, but many elements such as character models and mission structures can''t help but show their age. Still, this mobile port''s every bit as fun as playing the original if you have the gamepad to support it, but the touchscreen control, while competent are not the best way to play. At seven bucks for some of the most memorable gaming content of the last decade, though, it''s probably a risk worth taking.', 4, 2, '2014-01-13 14:00:00', 4, 'grandtheftauto.jpg'),
(5, '', '', 1, 1, '2014-10-27 17:25:25', 0, '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_Comment_Member1` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Comment_Review1` FOREIGN KEY (`reviewID`) REFERENCES `upload` (`uploadID`) ON UPDATE CASCADE;

--
-- Constraints for table `current`
--
ALTER TABLE `current`
  ADD CONSTRAINT `current_ibfk_1` FOREIGN KEY (`themeID`) REFERENCES `theme` (`themeID`) ON UPDATE CASCADE;

--
-- Constraints for table `upload`
--
ALTER TABLE `upload`
  ADD CONSTRAINT `fk_Review_Administrator` FOREIGN KEY (`administratorID`) REFERENCES `administrator` (`administratorID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Review_Category1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
