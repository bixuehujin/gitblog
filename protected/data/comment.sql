/**
 * comment table schema.
 *
 * author: Jin Hu <bixuehujin@gmail.com>
 */

CREATE TABLE `comment` (
  `cid`        int(11)  unsigned NOT NULL AUTO_INCREMENT,
  `creator`    int(11)  unsigned NOT NULL DEFAULT '0',
  `owner_type` varchar(24)       NOT NULL DEFAULT '',
  `owner`      int(11)  unsigned NOT NULL DEFAULT '0',
  `parent`     int(11)  unsigned NOT NULL DEFAULT '0',
  `subject`    varchar(255)      NOT NULL DEFAULT '',
  `content`    text              NOT NULL ,
  `state`      text              NOT NULL ,
  `created`    int(11)           NOT NULL DEFAULT '0',
  `deleted`    tinyint(1)        NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`),
  INDEX `owner_type`(`owner`, `owner_type`),
  INDEX `creator_type`(`creator`, `owner_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
