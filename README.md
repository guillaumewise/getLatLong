getLatLong
==========

This script allows you to get the Latitude + Longitude from a list of addresses using Google Geocoding API (PHP / SQL).

Don't abuse of this as Google could block you. Addresses are sent every 4 seconds. You can change it in ajax.php

#1 Copy the files on your rep

#2 Set up the database

CREATE TABLE `my_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` text NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


#3 Upload your addresses 

Example : 

INSERT INTO `my_addresses` (address) VALUES('8 rue de Ponthieu, 75008 Paris, France');

#4 Configure your DB settings in "config.php"

#5 Launch Index.php and click on "Start"
