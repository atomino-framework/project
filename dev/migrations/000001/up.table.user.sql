CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attachments` json DEFAULT NULL,
  `guid` varchar(36) DEFAULT '',
  `created` datetime DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  `name` varchar(16) DEFAULT '',
  `email` varchar(255) DEFAULT NULL,
  `bossId` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8;