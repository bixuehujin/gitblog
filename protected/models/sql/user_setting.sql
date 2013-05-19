/**
 * user_setting.sql
 *
 * author: Jin Hu <bixuehujin@gmail.com>
 * created: 2013-05-11
 */
 
CREATE TABLE IF NOT EXISTS `user_setting` (
  `uid`   int(11)     unsigned   NOT NULL DEFAULT 0,
  `name`  varchar(30)            NOT NULL DEFAULT '',
  `value` text                   NOT NULL,
  PRIMARY KEY (`uid`, `name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
