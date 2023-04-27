CREATE TABLE IF NOT EXISTS `ViewerPrizes`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `viewer_id` INT NOT NULL,
    `prizes_id` INT NOT NULL,
    `ship_addr` VARCHAR(80),
    `gc_code` VARCHAR(80),
    `balance_change` INT,
    `tokens_paid` INT,
    `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP DEFAULT 0,
    `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`viewer_id`) REFERENCES `ViewerAccountData`(`id`),
    FOREIGN KEY (`prizes_id`) REFERENCES `Prizes`(`id`)
)