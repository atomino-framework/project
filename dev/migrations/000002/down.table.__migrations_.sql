CREATE TABLE `__migrations_` (
  `structure` text NOT NULL,
  `rollback` text,
  `version` int(11) unsigned NOT NULL,
  `integrity` varchar(255) DEFAULT '',
  UNIQUE KEY `version` (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;