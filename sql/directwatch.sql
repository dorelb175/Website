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
-- Table structure for table `directwatch`
--

CREATE TABLE IF NOT EXISTS `directwatch` (
  `ep_num` int(11) NOT NULL,
  `season1` varchar(250) NOT NULL,
  `season2` varchar(250) NOT NULL,
  `season3` varchar(250) NOT NULL,
  `season4` varchar(250) NOT NULL,
  `season5` varchar(250) NOT NULL,
  `season6` varchar(250) NOT NULL,
  `season7` varchar(250) NOT NULL,
  PRIMARY KEY (`ep_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `directwatch`
--

INSERT INTO `directwatch` (`ep_num`, `season1`, `season2`, `season3`, `season4`, `season5`, `season6`, `season7`) VALUES
(1, 'http://www.megavideo.com/?d=B2JRA7AA	', 'http://www.megavideo.com/?d=HVDE3FGV	', 'http://www.megavideo.com/?d=D1J9V7ZV	', 'http://www.megavideo.com/?d=BJABBH62	', 'http://www.megavideo.com/?d=9ABYRO0J	', 'http://www.megavideo.com/?v=D8GMJ4S5 ', 'http://www.videobb.com/watch_video.php?v=Cj8U4jEc3UPT'),
(2, 'http://www.megavideo.com/?d=2X0YH4O5	', 'http://www.megavideo.com/?d=FCCQAEUJ	', 'http://www.megavideo.com/?d=C5ILGONT	', 'http://www.megavideo.com/?d=O1BK8W60	', 'http://www.megavideo.com/?d=ESXF1S5Y	', 'http://www.megavideo.com/?v=QWOR97WG ', 'http://www.videobb.com/watch_video.php?v=TUwy504U4XM9'),
(3, 'http://www.megavideo.com/?d=EA4JESTS	', 'http://www.megavideo.com/?d=GSECIYT5	', 'http://www.megavideo.com/?d=3A8UU18K	', 'http://www.megavideo.com/?d=4PAO207S	', 'http://www.megavideo.com/?d=FG24IPR6	', 'http://www.megavideo.com/?v=X2M8QKV1 ', 'http://www.videobb.com/watch_video.php?v=kNraHct1WA1l'),
(4, 'http://www.megavideo.com/?d=496BCQPY    ', 'http://www.megavideo.com/?d=H4ZR8EZH    ', 'http://www.megavideo.com/?d=BNGU1MTG    ', 'http://www.megavideo.com/?d=HKLKMBGZ    ', 'http://www.megavideo.com/?d=2NUMUSP9    ', 'http://www.megavideo.com/?v=L5PCE71J ', 'http://www.videobb.com/watch_video.php?v=rdgrtDIG04tO'),
(5, 'http://www.megavideo.com/?d=6J0KHHDN    ', 'http://www.megavideo.com/?d=IG2CHVRT    ', 'http://www.megavideo.com/?d=YP6C2UWL    ', 'http://www.megavideo.com/?d=KKZV1OE1    ', 'http://www.megavideo.com/?d=GL1IO2UN    ', 'http://www.megavideo.com/?v=ZWLPMALJ', 'http://www.videobb.com/watch_video.php?v=Ca28g8dk8fyS'),
(6, 'http://www.megavideo.com/?d=68750IQR', 'http://www.megavideo.com/?d=4F4IV860', 'http://www.megavideo.com/?d=791O7AJD', 'http://www.megavideo.com/?d=SMN2U7B0', 'http://www.megavideo.com/?d=KMA4V840', 'http://www.megavideo.com/?v=ZB5G9A7E', ''),
(7, 'http://www.megavideo.com/?d=BFDZW2LR', 'http://www.megavideo.com/?d=E32PAHIJ', 'http://www.megavideo.com/?d=4CJKFQEP', 'http://www.megavideo.com/?d=4BN7H5PK', 'http://www.megavideo.com/?d=Y26NU0DP', 'http://www.megavideo.com/?v=DKXU8KFF', ''),
(8, 'http://www.megavideo.com/?d=VZYSU7A1', 'http://www.megavideo.com/?d=6QNZJV30', 'http://www.megavideo.com/?d=VXMLBZ8N', 'http://www.megavideo.com/?d=B9ZYODPF', 'http://www.megavideo.com/?d=MZBNJHN5', 'http://www.megavideo.com/?v=ZYWCX5RV', ''),
(9, 'http://www.megavideo.com/?d=19VH04LG', 'http://www.megavideo.com/?d=GGMJHB8J', 'http://videobb.com/watch_video.php?v=pwV7ccFa4FK8', 'http://www.megavideo.com/?d=9X4O5QMI', 'http://www.megavideo.com/?d=0TT9SO2M', 'http://www.megavideo.com/?v=ZB5G9A7E', ''),
(10, 'http://www.megavideo.com/?d=C6VPZAOO', 'http://www.megavideo.com/?d=HIGCB3ST', 'http://www.megavideo.com/?v=U9KMI1AK', 'http://www.megavideo.com/?d=CSXXUF5T', 'http://www.megavideo.com/?d=A77YHPKI', 'http://www.megavideo.com/?v=701B1SID', ''),
(11, 'http://www.megavideo.com/?d=52BCY9B3', 'http://www.megavideo.com/?d=P9GB393J', 'http://www.megavideo.com/?d=3TKGIJAW', 'http://www.megavideo.com/?d=F09PLTEA', 'http://www.megavideo.com/?d=OM9ZGASH', 'http://www.megavideo.com/?d=92KZJHHO', ''),
(12, 'http://www.megavideo.com/?d=6PUTHRWA', 'http://www.megavideo.com/?d=57YRRSGR', 'http://www.megavideo.com/?d=N1V5WX20', 'http://www.megavideo.com/?d=LJKBQD1R', 'http://www.megavideo.com/?d=MIDCIJ23', 'http://www.megavideo.com/?d=EULDFH2B', ''),
(13, 'http://www.megavideo.com/?d=DJ0MVVU9', 'http://www.megavideo.com/?d=DUCMGMOQ', 'http://www.megavideo.com/?d=56UAABH1', 'http://www.megavideo.com/?d=UY0WSFYY', 'http://www.megavideo.com/?d=66GMJ542', 'http://www.megavideo.com/?d=O8P0CGIO', ''),
(14, 'http://www.megavideo.com/?d=NJSQ1N6V', 'http://www.megavideo.com/?d=6CHNN34I', 'http://www.megavideo.com/?d=LGJN54J9', 'http://www.megavideo.com/?d=HJE0MBAP', 'http://www.megavideo.com/?d=HNFBSVGW', 'http://www.megavideo.com/?d=BL80A1ZJ', ''),
(15, 'http://www.megavideo.com/?d=F5M29XBM', 'http://www.megavideo.com/?d=05HJNBWV', 'http://www.megavideo.com/?d=0F2CEJNM', 'http://www.megavideo.com/?d=MYY42MZ4', 'http://www.megavideo.com/?d=XZCEKAC9', 'http://www.megavideo.com/?v=U6ZD2X15', ''),
(16, 'http://www.megavideo.com/?d=GCFYZGO2', 'http://www.megavideo.com/?d=D7206VMN', 'http://www.megavideo.com/?d=ZEMDIMHS', 'http://www.megavideo.com/?d=HJE0MBAP', 'http://www.megavideo.com/?d=RGEIVX03', 'http://www.megavideo.com/?v=1I2D50AO', ''),
(17, 'http://www.megavideo.com/?d=MXWV0V6H', 'http://www.megavideo.com/?d=5JWI1336', 'http://www.megavideo.com/?d=UVBMQBMN', 'http://www.megavideo.com/?d=ZP339W3X', 'http://www.megavideo.com/?d=AVFXUXZ2', 'http://www.megavideo.com/?v=1I2D50AO', ''),
(18, 'http://www.megavideo.com/?d=UTWQQYG1', 'http://www.megavideo.com/?d=PKN3MKOK', 'http://www.megavideo.com/?d=U3Q6AO91', 'http://www.megavideo.com/?d=4TZNN3P3', 'http://www.megavideo.com/?d=1ZT3UA6X', 'http://www.megavideo.com/?d=LGB5QQBH', ''),
(19, 'http://www.megavideo.com/?d=WZTNT8K8', 'http://www.megavideo.com/?d=HUYXHW0F', 'http://www.megavideo.com/?d=B8BUYSVO', 'http://www.megavideo.com/?v=ZZEA2M7H', 'http://www.megavideo.com/?d=FLRMEFX4', 'http://www.megavideo.com/?v=66OHI3SC', ''),
(20, 'http://www.megavideo.com/?d=N04FSI2G', 'http://www.megavideo.com/?d=FP66OIV0', 'http://www.megavideo.com/?d=URWZWLTY', 'http://www.megavideo.com/?d=B504VCI1', 'http://www.megavideo.com/?d=HLUM757K', 'http://www.megavideo.com/?v=W9HKJ4AA', ''),
(21, 'http://www.megavideo.com/?d=FEEFRX12', 'http://www.megavideo.com/?d=OP9RT728', 'index.php?page=WrongPage', 'http://www.megavideo.com/?d=1D9BC8FY', 'http://www.megavideo.com/?d=ACHCX0H9', 'http://www.megavideo.com/?v=L06DG5H0', ''),
(22, 'http://www.megavideo.com/?d=NC7KWBM3', 'http://www.megavideo.com/?d=TVKR4ZTO', 'index.php?page=WrongPage', 'http://www.megavideo.com/?d=ULAXXKEL', 'http://www.megavideo.com/?d=L2XDGQSU', 'http://www.megavideo.com/?v=Z2EBCYYT', ''),
(23, 'index.php?page=WrongPage', 'index.php?page=WrongPage', 'index.php?page=WrongPage', 'http://www.megavideo.com/?d=O93I7KK7', 'http://www.megavideo.com/?d=6GD9SGBT', 'http://www.megavideo.com/?v=6XLV7Y1M', ''),
(24, 'index.php?page=WrongPage', 'index.php?page=WrongPage', 'index.php?page=WrongPage', 'http://www.megavideo.com/?d=UGCNHCTW', 'http://www.megavideo.com/?d=07IQ5XEO', 'http://www.megavideo.com/?d=1N0ASB4X', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
