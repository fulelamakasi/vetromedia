CREATE TABLE `vetromedia`.`users` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NOT NULL,
  `firstname` VARCHAR(100) NOT NULL,
  `lastname` VARCHAR(100) NOT NULL,
  `emailaddress` VARCHAR(100) NOT NULL,
  `phonenumber` VARCHAR(100) NULL,
  `is_emailverified` TINYINT(1) NULL DEFAULT 0,
  `country_id` INT(11) UNSIGNED NOT NULL,
  `created` DATETIME NULL,
  `modified` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `editedby` VARCHAR(100) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `userdetails` (`firstname` ASC, `lastname` ASC, `emailaddress` ASC),
  UNIQUE INDEX `emailaddress_UNIQUE` (`emailaddress` ASC),
  INDEX `fk_users_countries_idx` (`country_id` ASC),
  CONSTRAINT `fk_users_countries`
    FOREIGN KEY (`country_id`)
    REFERENCES `vetromedia`.`countries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
