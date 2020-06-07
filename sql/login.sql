CREATE TABLE IF NOT EXISTS `login` 
(
  
`id` int(11) NOT NULL AUTO_INCREMENT,
  
`user` varchar(50) NOT NULL,
 
`ip` varchar(15) NOT NULL,
  
`time` varchar(50) NOT NULL,
  
PRIMARY KEY (`id`)

) ENGINE=MYISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;