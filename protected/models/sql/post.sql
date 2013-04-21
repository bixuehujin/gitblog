CREATE TABLE `post` (
  `pid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `type` varchar(24) NOT NULL  DEFAULT '',
  `path` varchar(255) NOT NULL  DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `comments` int(11) NOT NULL DEFAULT '0',
  `created` int(11) NOT NULL DEFAULT '0',
  `modified` int(11) NOT NULL DEFAULT '0',
  `rid` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pid`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
