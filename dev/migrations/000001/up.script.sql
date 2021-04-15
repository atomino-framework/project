SET FOREIGN_KEY_CHECKS = 0;
--run up.table.*.sql
--run up.view.*.sql
INSERT INTO `user` (`id`, `attachments`, `guid`, `created`, `updated`, `name`, `email`, `bossId`)
VALUES
	(1, '{\"files\": {\"hades.jpg\": {\"size\": 283524, \"title\": \"\", \"mimetype\": \"image/jpeg\", \"properties\": []}}, \"collections\": {\"avatar\": [\"hades.jpg\"]}}', 'f2fe3d36-445a-11eb-9f4d-b79ef2e5a27b', '2021-01-05 08:10:58', '2021-01-05 08:10:58', 'Elvis Presley', 'elvis@elvis.hu', NULL);

SET FOREIGN_KEY_CHECKS = 1;
