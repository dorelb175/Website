-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- מארח: localhost
-- זמן ייצור: אוקטובר 20, 2011 at 08:26 PM
-- גרסת שרת: 5.5.8
-- גרסת PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- מאגר נתונים: `database`
--

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `age` int(3) NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- הוצאת מידע עבור טבלה `members`
--

INSERT INTO `members` (`member_id`, `username`, `password`, `fullname`, `age`) VALUES
(1, 'admin', 'mypass', 'shimon', 16),
(2, 'someone', 'somepass', 'moti', 13),
(3, 'josef123', 'jopass', 'josef', 16);
