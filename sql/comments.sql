-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 16, 2011 at 05:20 PM
-- Server version: 5.1.56
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `himymtv_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `send_user` varchar(50) NOT NULL,
  `subject` varchar(25) NOT NULL,
  `message` varchar(250) NOT NULL,
  `date` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `send_user`, `subject`, `message`, `date`) VALUES
(1, 'admin', 'בדיקה', 'בדיקה :)', '04/09/2011, 19:09:33'),
(2, 'test', ':)', ':)', '06/09/2011, 10:56:02'),
(3, 'xatylll', 'היי', 'xd  ', '06/09/2011, 14:40:46'),
(5, '111111', 'היי', ':blush:  אתר טוב (*)-(*)\r\n\\''&gt;&lt;\\&quot;', '06/09/2011, 17:46:06'),
(6, 'LotemKing', 'בדיקה', 'בדיקה', '07/09/2011, 13:10:10'),
(9, 'Ron12', 'הנה זה הקישור', '&lt;a href=http://himymtv.tk/UserCP.php?page=ShowUsers&gt;url&lt;/a&gt;', '07/09/2011, 17:42:32'),
(8, 'Ron12', 'שאלה', 'בשביל מה צריך את זה? \r\nhttp://himymtv.tk/UserCP.php?page=ShowUsers', '07/09/2011, 17:33:33'),
(10, 'admin', 'תשובה', 'סתם אם אתה רוצים לראות את המשתמשים', '07/09/2011, 18:20:07'),
(11, 'Ron12', 'בעיה', 'יש לי בעייה פתאום בדף\r\nhttp://himymtv.tk/UserCP.php?page=ShowUsers \r\nאני לא רואה כלום פתאום...\r\nכנס ותתקן את זה', '07/09/2011, 19:12:05');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
