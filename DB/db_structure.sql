SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `admins` (
  `username` varchar(10) NOT NULL DEFAULT '',
  `room_id` int(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`username`,`room_id`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `complaints` (
  `complaint_id` int(10) NOT NULL AUTO_INCREMENT,
  `reserve_id` int(10) DEFAULT NULL,
  `complaint` text NOT NULL,
  `made_by` varchar(10) DEFAULT NULL,
  `reviewed` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`complaint_id`),
  KEY `reserve_id` (`reserve_id`),
  KEY `made_by` (`made_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cookies` (
  `username` varchar(10) DEFAULT NULL,
  `cookhash` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`cookhash`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `departments` (
  `dept_name` varchar(100) NOT NULL DEFAULT '',
  `faculty_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`dept_name`),
  KEY `faculty_name` (`faculty_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `faculties` (
  `faculty_name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`faculty_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `halls` (
  `hall_id` int(6) NOT NULL AUTO_INCREMENT,
  `hall_name` varchar(100) NOT NULL,
  `dept_name` varchar(100) DEFAULT NULL,
  `capacity` int(5) DEFAULT NULL,
  `aircondition` tinyint(1) DEFAULT NULL,
  `com_lab` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`hall_id`),
  KEY `dept_name` (`dept_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `requests` (
  `request_id` int(10) NOT NULL AUTO_INCREMENT,
  `room_id` int(6) NOT NULL,
  `username` varchar(10) NOT NULL,
  `request_date` date NOT NULL,
  `begin_time` time NOT NULL,
  `end_time` time NOT NULL,
  `reason` text NOT NULL,
  `req_items` text,
  PRIMARY KEY (`request_id`),
  KEY `room_id` (`room_id`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `reservations` (
  `reserve_id` int(10) NOT NULL AUTO_INCREMENT,
  `hall_id` int(6) NOT NULL,
  `username` varchar(10) NOT NULL,
  `reserve_date` date NOT NULL,
  `begin_time` time NOT NULL,
  `end_time` time NOT NULL,
  `reason` text NOT NULL,
  `req_items` text,
  `auth_by` varchar(10) NOT NULL,
  `feedback` int(2) DEFAULT NULL,
  PRIMARY KEY (`reserve_id`),
  KEY `room_id` (`hall_id`),
  KEY `username` (`username`),
  KEY `auth_by` (`auth_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `staff` (
  `username` varchar(10) NOT NULL DEFAULT '',
  `room_id` int(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`username`,`room_id`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(10) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `level` int(10) NOT NULL,
  `reputation` int(5) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
