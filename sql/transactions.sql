CREATE TABLE `vetromedia`.`transactions` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `original_price` DECIMAL(10,2) NULL,
  `converted_price` DECIMAL(10,2) NULL,
  `surge` DECIMAL(10,2) NULL,
  `surge_amount` DECIMAL(10,2) NULL,
  `currency_to_exchangerate` DECIMAL(10,2) NULL,
  `currency_from` INT(11) UNSIGNED NOT NULL DEFAULT 1,
  `currency_to` INT(11) UNSIGNED NOT NULL DEFAULT 1,
  `user_id` INT(11) UNSIGNED NOT NULL DEFAULT 1,
  `created` DATETIME NULL,
  `modified` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `editedby` VARCHAR(100) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_transactions_users_idx` (`user_id` ASC),
  INDEX `fk_transactions_currencyfrom_idx` (`currency_from` ASC),
  INDEX `fk_transactions_currencyto_idx` (`currency_to` ASC),
  CONSTRAINT `fk_transactions_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `vetromedia`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_transactions_currencyfrom`
    FOREIGN KEY (`currency_from`)
    REFERENCES `vetromedia`.`countries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_transactions_currencyto`
    FOREIGN KEY (`currency_to`)
    REFERENCES `vetromedia`.`countries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
