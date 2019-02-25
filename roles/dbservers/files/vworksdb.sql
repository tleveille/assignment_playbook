--
-- Table structure for table `records`
--

DROP TABLE IF EXISTS `records`;
CREATE TABLE `records` (
  `srvname` varchar(64) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `srcaddress` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
