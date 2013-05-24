CREATE TABLE `post` (
  `pid`       int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author`    int(11) unsigned NOT NULL DEFAULT '0',
  `committer` int(11) unsigned NOT NULL DEFAULT '0',
  `oid`       char(40)         NOT NULL DEFAULT '',
  `cid`       int(11) unsigned NOT NULL DEFAULT '0',
  `type`      tinyint          NOT NULL DEFAULT '0',
  `path`      varchar(255)     NOT NULL DEFAULT '',
  `title`     varchar(255)     NOT NULL DEFAULT '',
  `comments`  int(11)          NOT NULL DEFAULT '0',
  `created`   int(11)          NOT NULL DEFAULT '0',
  `modified`  int(11)          NOT NULL DEFAULT '0',
  `rid`       int(11)          NOT NULL DEFAULT '0',
  `visitors`  int(11)          NOT NULL DEFAULT '0',
  `status`    tinyint(4)       NOT NULL DEFAULT '0',
  PRIMARY KEY (`pid`),
  INDEX `author`(`author`),
  INDEX `cid`(`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
