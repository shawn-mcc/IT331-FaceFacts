CREATE TABLE IF NOT EXISTS `UserAccountTypes`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_id` int NOT NULL,
    `account_type_id` int NOT NULL,
    `password` VARCHAR(80) NOT NULL,
    `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP DEFAULT 0,
    `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `Users`(`id`),
    FOREIGN KEY (`account_type_id`) REFERENCES `AccountType`(`id`)
)