CREATE TABLE `test`.`feedbacks` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(45) NOT NULL , `email` VARCHAR(254) NOT NULL , `phone` CHAR(13), `message` VARCHAR(500) , PRIMARY KEY (`id`)) ENGINE = InnoDB;