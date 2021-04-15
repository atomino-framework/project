ALTER TABLE `user`
  CHANGE COLUMN `guid` `guid` char(36) DEFAULT '' AFTER `id`,
  ADD COLUMN `password` char(128) DEFAULT NULL AFTER `updated`,
  CHANGE COLUMN `name` `name` varchar(16) DEFAULT '' AFTER `password`,
  CHANGE COLUMN `email` `email` varchar(255) DEFAULT NULL AFTER `name`,
  CHANGE COLUMN `bossId` `bossId` int(11) unsigned DEFAULT NULL AFTER `email`,
  ADD COLUMN `group` enum('admin','moderator','visitor') DEFAULT NULL AFTER `bossId`;