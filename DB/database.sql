create database api;

use api;

CREATE TABLE `client` (
  `id` int(11) NOT NULL auto_increment,
  `analytics` varchar(100) NOT NULL,
  `positive` int(11) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
);

INSERT INTO `client` (`id`, `analytics`, `positive`, `facebook` ) VALUES
(1, '1267', 34,'126657'),
(2, '678',56,'467'),
(3, '678',79,'1267'),
(4, '562',45,'13467'),
(5, '464',56,'8940');