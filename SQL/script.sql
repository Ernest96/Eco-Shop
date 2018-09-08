CREATE TABLE `product` ( 
	`id` int(11) NOT NULL AUTO_INCREMENT, 
	`name` varchar(22) NOT NULL, 
	`price` decimal(5,2) DEFAULT '0.00', 
	`img_link` varchar(320) DEFAULT NULL, 
	`description` varchar(1024) DEFAULT NULL, 
	`contact` varchar(50) DEFAULT NULL, 
	`distributor` varchar(50) DEFAULT 'Uknown', 
PRIMARY KEY (`id`) ) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

CREATE TABLE `user` (
  `username` varchar(32) CHARACTER SET ascii NOT NULL,
  `email` varchar(254) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `email_2` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
