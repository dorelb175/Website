-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 16, 2011 at 05:19 PM
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
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fname` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `lname` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pass` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `DateOfBirth` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `gender` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `favchar` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fname`, `lname`, `pass`, `email`, `DateOfBirth`, `gender`, `favchar`) VALUES
(1, 'admin', 'dor', 'elbaz', 'e2f77ffc91bb745ee3bbc3fd9793d18e', 'dor_elbaz7@walla.co.il', '23/9/1995', 'Male', 'Barney'),
(2, 'snufkin', 'nave', 'shiff', '7a08078b57719cd9836d2984b19c1371', 'naveshiff@gmail.com', '10/11/1997', 'Male', 'Robin'),
(3, 'naturekiller', 'sjdssds', 'dsddsds', 'f9ad8c89d285dfdf3ed8344171e28c59', 'josef3776@gmail.com', '2/2/1994', 'Male', 'Barney'),
(4, 'diln29', 'lolo', 'ben', 'a688a47ac73fb58ce3828bcb184cb157', 'diln29@walla.com', '29/3/1989', 'Male', 'Barney'),
(5, 'eyalyyy', 'eyal', 'yemini', '96e79218965eb72c92a549dd5a330112', 'eyal9013@gmail.com', '4/7/1997', 'Male', 'Lily'),
(6, 'chelseafc', 'chelsea', 'chelsa', 'cdbdeb1fcf8eaadf9d8bb35e6cdd4769', 'kobenunu@gmail.com', '11/5/1991', 'Male', 'Barney'),
(7, 'KOBIS', 'KOBI', 'MAS', 'e10adc3949ba59abbe56e057f20f883e', 'kobimasah@hotmail.com', '2/1/1989', 'Male', 'Ted'),
(8, 'Kobiko', 'sssss', 'sssssss', 'e10adc3949ba59abbe56e057f20f883e', 'fffff@hkhkh.com', '18/5/1989', 'Male', 'Ted'),
(9, 'idoitach', 'ido', 'itach', '3fde6bb0541387e4ebdadf7c2ff31123', 'idoitach@walla.com', '21/1/1997', 'Male', 'Barney'),
(10, 'drumr', 'roee', 'kleiner', '31259e93c547d82a45586ef56895fb96', 'roeekleiner@gmail.com', '23/6/1998', 'Male', 'Barney'),
(11, 'LUIGLIU', 'guy', 'glik', '3d186804534370c3c817db0563f0e461', 'aaam4@walla.com', '21/8/1990', 'Male', 'Barney'),
(12, 'LesPaul', 'Omer', 'Ariel', '9d962b8164d7b6a3c78e64ebfaea5fc2', 'omerariel97@gmail.com', '24/5/1997', 'Male', 'Barney'),
(13, 'Tzachi', 'Tzachi', 'Bentzki', 'c499a157f236220c2a63362ce0ee882a', 'zachibanzki@gmail.com', '23/12/1992', 'Male', 'Marshall'),
(20, 'urili', 'xsfsfe', 'ghdfgth', '279dc7e888212a4024c58660e89c49ab', 'dfhdfgt@gmail.com', '18/3/1948', 'Male', 'Lily'),
(21, 'xatylll', 'RON', 'kantorovich', '5a93a4b17524a5528d7180de90fa4b36', 'ronkantorovich@gmail.com', '10/3/1999', 'Male', 'Marshall'),
(22, 'dandaniel97', 'daniel', 'beilin', '2cf525f38fe2482d5b559ba22a3adec8', 'dandaniel97@gmail.com', '28/11/1991', 'Male', ''),
(29, 'batreile', 'Daniel', 'carasente', '89fe7c129ed9cc69ede6436e66acff2a', 'batreile@nana.co.il', '9/2/1990', 'Male', 'Barney'),
(55, 'asaf129', 'asaf', 'hasoy', 'e10adc3949ba59abbe56e057f20f883e', 'asaf129@gmail.com', '13/4/1994', 'Male', ''),
(60, 'aaaaa', 'aaaaaa', 'aaaaaaa', 'cffbad68bb97a6c3f943538f119c992c', 'rafi504@walla.com', '1/2/1954', 'Male', 'Ted'),
(38, 'selaman', 'sela', 'yonki', 'd552ddc74a8688cc6dfde53ba2861a41', 'selamakeface@gamil.com', '30/3/1977', 'Male', 'Ted'),
(39, 'yuval', 'yuval', 'hasid', 'a8cab1e4dcfd3dbb3b5ddb7307c60c25', 'aknyh@walla.com', '17/2/1990', 'Male', ''),
(58, 'peppercut', 'gush', 'thegush', '4297f44b13955235245b2497399d7a93', 'rtho1@walla.com', '20/9/1990', 'Male', 'Barney'),
(65, 'bnbn979', 'aviad', 'levi', 'f034414e2ad06d41d45682ac350f7ee2', 'leviaviad1@gmail.com', '15/10/1997', 'Male', 'Ted'),
(62, 'barakoo1', 'barak', 'kaki', '81025efa8d63c6379ed138a35c1fbcdd', 'barakoo1@walla.com', '2/1/1996', 'Male', 'Barney'),
(63, 'gaslik', 'gak', 'berez', '520783fffa010e3879bc51b61dfd79aa', 'darklostsoul@walla.com', '10/7/1994', 'Male', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
