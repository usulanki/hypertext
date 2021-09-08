ALTER TABLE `users` CHANGE `email` `email_id` VARCHAR(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, CHANGE `password` `password` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

ALTER TABLE `users` ADD `user_type` ENUM('SUPER_ADMIN','COMPANY_ADMIN','COMPANY_EMPLOYEE','') NOT NULL AFTER `password`;

ALTER TABLE `users` CHANGE `user_type` `user_type` ENUM('SUPER_ADMIN','COMPANY_ADMIN','COMPANY_EMPLOYEE') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'COMPANY_EMPLOYEE';

CREATE TABLE `hack`.`companies` ( `company_id` INT(11) NOT NULL AUTO_INCREMENT , `company_name` TEXT NOT NULL , `company_admin_user_id` INT(11) NOT NULL , `company_created_by_user_id` INT(11) NOT NULL , `company_status` ENUM('ACTIVE','IN_ACTIVE','DELETED','BLOCKED') NOT NULL DEFAULT 'ACTIVE' , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL , PRIMARY KEY (`company_id`)) ENGINE = InnoDB;

ALTER TABLE `companies` ADD FOREIGN KEY (`company_admin_user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `companies` ADD `company_validity_start_date` DATE NULL DEFAULT NULL AFTER `company_status`, ADD `company_validity_end_date` DATE NULL DEFAULT NULL AFTER `company_validity_start_date`;