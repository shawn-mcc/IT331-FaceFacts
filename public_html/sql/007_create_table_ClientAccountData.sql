CREATE TABLE IF NOT EXISTS `ClientAccountData`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(80) NOT NULL,
    `username` VARCHAR(80) NOT NULL,
    `client_id` INT NOT NULL,
    `is_ppoc` TINYINT NOT NULL,
    `last_name` VARCHAR(80) NOT NULL,
    `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP DEFAULT 0,
    `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`email`) REFERENCES `Users`(`email`),
    FOREIGN KEY (`username`) REFERENCES `Users`(`username`),
    FOREIGN KEY (`client_id`) REFERENCES `Clients`(`id`)
)