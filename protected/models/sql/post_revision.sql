CREATE TABLE `post_revision` (
  `rid`       int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id`   int(11) unsigned NOT NULL DEFAULT '0',
  `oid`       char(40)         NOT NULL DEFAULT '',
  `creator`   int(11) unsigned NOT NULL DEFAULT '0',
  `path`      varcahr(255)     NOT NULL DEFAULT '',
  `title`     varcahr(255)     NOT NULL DEFAULT '',
  `summary`   text             NOT NULL,
  `content`   longtext         NOT NULL,
  `commit`    text             NOT NULL,
  `created`   int(11)          NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
