ALTER TABLE `user`
  DROP COLUMN `password`,
  DROP COLUMN `group`;
ALTER TABLE `user`
  CHANGE COLUMN `guid` `guid` varchar(36) DEFAULT '' AFTER `id`,
  CHANGE COLUMN `name` `name` varchar(16) DEFAULT '' AFTER `updated`,
  CHANGE COLUMN `email` `email` varchar(255) DEFAULT NULL AFTER `name`,
  CHANGE COLUMN `bossId` `bossId` int(11) unsigned DEFAULT NULL AFTER `email`;