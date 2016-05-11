CREATE TABLE `RealNames` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `fullpath` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

CREATE TABLE `versions` (
  `realid` int(11) DEFAULT NULL,
  `version` int(11) DEFAULT NULL,
  `filenr` varchar(200) DEFAULT NULL,
  `crdat` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;











