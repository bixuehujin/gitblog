/**
 * user.sql
 *
 * author: Jin Hu <bixuehujin@gmail.com>
 * created: 2013-04-19
 */
 
CREATE TABLE IF NOT EXISTS `user` (
  `uid`      int(11)            unsigned   NOT NULL AUTO_INCREMENT,
  `username` varchar(255)                  NOT NULL DEFAULT '',
  `truename` varchar(255)                  NOT NULL DEFAULT '',
  `gender`   enum('m','f','u')             NOT NULL DEFAULT 'm',
  `avatar`   int(11)            unsigned   NOT NULL DEFAULT 0  COMMENT 'The file_managed.fid used as avatar.',
  `password` char(32)                      NOT NULL DEFAULT '',
  `email`    varchar(255)                  NOT NULL DEFAULT '',
  `github`   varchar(255)                  NOT NULL DEFAULT '',
  `weibo`    varchar(255)                  NOT NULL DEFAULT '',
  `created`  int(11)                       NOT NULL DEFAULT 0,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `name` (`username`),
  UNIQUE KEY `name` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
