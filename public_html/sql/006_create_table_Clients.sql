CREATE TABLE IF NOT EXISTS `Clients`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(80) NOT NULL,
    `address` VARCHAR(80) NOT NULL,
    `subscription_tier` VARCHAR(80) NOT NULL,
    `total_campaigns` INT NOT NULL DEFAULT 0,
    `total_views` INT NOT NULL DEFAULT 0,
    `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP DEFAULT 0,
    `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
)