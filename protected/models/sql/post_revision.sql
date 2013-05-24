CREATE TABLE `post_revision` (
  `rid`       int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id`   int(11) unsigned NOT NULL DEFAULT '0',
  `oid`       char(40)         NOT NULL DEFAULT '',
  `creator`   int(11) unsigned NOT NULL DEFAULT '0',
  `path`      varchar(255)     NOT NULL DEFAULT '',
  `title`     varchar(255)     NOT NULL DEFAULT '',
  `summary`   text             NOT NULL,
  `meta`      text             NOT NULL,
  `content`   longtext         NOT NULL,
  `commit`    text             NOT NULL,
  `created`   int(11)          NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`),
  INDEX `post_id`(`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
