SET FOREIGN_KEY_CHECKS = 0;
--run up.table.*.sql
delete user where id=123;
--run up.view.*.sql
SET FOREIGN_KEY_CHECKS = 1;
