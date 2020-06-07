-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- מארח: localhost
-- זמן ייצור: אוקטובר 20, 2011 at 08:40 PM
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
-- מבנה טבלה עבור טבלה `chatlogin`
--

CREATE TABLE IF NOT EXISTS `chatlogin` (
  `username` varchar(50) NOT NULL,
  `isLogin` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- הוצאת מידע עבור טבלה `chatlogin`
--

INSERT INTO `chatlogin` (`username`, `isLogin`) VALUES
('admin', 1),
('someone', 1);
