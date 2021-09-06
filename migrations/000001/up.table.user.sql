CREATE TABLE `user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `attachments` json DEFAULT NULL,
  `guid` char(36) DEFAULT '',
  `created` datetime DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  `password` char(128) DEFAULT NULL,
  `name` varchar(16) DEFAULT '',
  `email` varchar(255) DEFAULT NULL,
  `group` enum('admin', 'visitor') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
