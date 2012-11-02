-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 23, 2012 at 11:58 AM
-- Server version: 5.5.21
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jharvard_project1`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `creator_id` int(11) unsigned DEFAULT NULL,
  `email_sent` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `code`, `start_time`, `end_time`, `creator_id`, `email_sent`) VALUES
(1, 'first chance dance', 'firstchance', '2012-03-06 01:12:15', '2012-03-20 01:12:15', 1, 1),
(2, 'cool story bro', 'bro', '2012-03-20 06:00:00', '2012-03-21 23:43:00', NULL, 1),
(3, 'cool story bro', 'bro', '2012-03-20 06:00:00', '2012-03-21 23:43:00', NULL, 0),
(4, 'test', 'test', '2012-03-23 23:00:00', '2012-03-23 23:34:00', NULL, 0),
(5, 'eventtest', '1', '2012-03-22 03:00:00', '2012-03-23 03:00:01', 1506675373, 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `votes` int(11) NOT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `event_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `text`, `votes`, `user_id`, `event_id`) VALUES
(1, 'blah', 9, 1, 1),
(2, 'sadafd', 8, 1, 1),
(3, 'blah', 2, 1, 1),
(4, 'ahsdlfa', 2, 1, 1),
(5, 'how do magnets work?', 8, 1, 1),
(6, 'lolz', 0, 1, 1),
(7, 'lolzwtf', -1, 1, 1),
(8, 'wut', -1, 1, 1),
(9, '0', -1, 1, 1),
(10, '02', -1, 1, 1),
(11, '0', -2, 1, 1),
(12, '0', 3, 1, 1),
(13, 'test', 1, 1, 1),
(14, 'blah', 0, 1506675373, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`) VALUES
(1, 'Merrill', 'mlutsky1231@gmail.com'),
(2, 'Merrill account 2', 'mlutsky1231@gmail.com'),
(1506675373, 'Merrill Lutsky', 'mlutsky1231@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `direction` tinyint(1) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
