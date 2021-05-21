CREATE TABLE `article_comment` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `hostId` int unsigned DEFAULT NULL,
  `userId` int unsigned DEFAULT NULL,
  `text` text,
  `replyId` int unsigned DEFAULT NULL,
  `asId` int unsigned DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;