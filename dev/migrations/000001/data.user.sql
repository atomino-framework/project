# ************************************************************
# Sequel Ace SQL dump
# Version 3028
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 8.0.23)
# Database: atomino
# Generation Time: 2021-04-15 15:44:28 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table user
# ------------------------------------------------------------

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `attachments`, `guid`, `created`, `updated`, `password`, `name`, `email`, `group`)
VALUES
	(1,'{\"files\": {\"staff.jpg\": {\"size\": 73746, \"focus\": \"08w050\", \"title\": \"\", \"width\": 640, \"height\": 360, \"mimetype\": \"image/jpeg\", \"safezone\": \"00a00a09u09g\", \"properties\": []}}, \"collections\": {\"avatar\": [\"staff.jpg\"]}}','f2fe3d36-445a-11eb-9f4d-b79ef2e5a27b','2021-01-05 08:10:58','2021-01-05 08:10:58','$2y$10$y.n2vuAUh/SN6ULdRv9/aOG04jlItqGDDQ1VFP8Cx4f0JxTHyM2ni','ELVIS PRESLEY','elvis@elvis.hu','admin');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
