CREATE TABLE `post_revision` (
  `rid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `path` varcahr(255) NOT NULL DEFAULT '',
  `summary` text NOT NULL,
  `body` longtext NOT NULL,
  `commit` text NOT NULL,
  `meta` text NOT NULL,
  `comments` int(11) NOT NULL DEFAULT '0',
  `created` int(11) NOT NULL DEFAULT '0',
  `sha` char(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`rid`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
