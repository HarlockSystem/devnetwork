SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `devnetwork_dev` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `devnetwork_dev` ;

-- -----------------------------------------------------
-- Table `devnetwork_dev`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devnetwork_dev`.`User` (
  `id` INT NOT NULL,
  `nick` VARCHAR(65) NOT NULL COMMENT 'pseudo',
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(60) NULL,
  `firstname` VARCHAR(65) NULL,
  `lastname` VARCHAR(65) NULL,
  `skill` VARCHAR(1000) NULL COMMENT 'user skill',
  `bio` VARCHAR(1000) NULL,
  `jobStatus` INT(11) NULL,
  `createdAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `settings` VARCHAR(1000) NULL COMMENT 'profile display',
  `img` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nick_UNIQUE` (`nick` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devnetwork_dev`.`Post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devnetwork_dev`.`Post` (
  `id` INT NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `contentType` TINYTEXT NOT NULL,
  `content` VARCHAR(1000) NOT NULL,
  `createdAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `User_id` INT NOT NULL,
  PRIMARY KEY (`id`, `User_id`),
  INDEX `fk_Post_User_idx` (`User_id` ASC),
  CONSTRAINT `fk_Post_User`
    FOREIGN KEY (`User_id`)
    REFERENCES `devnetwork_dev`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devnetwork_dev`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devnetwork_dev`.`User` (
  `id` INT NOT NULL,
  `nick` VARCHAR(65) NOT NULL COMMENT 'pseudo',
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(60) NULL,
  `firstname` VARCHAR(65) NULL,
  `lastname` VARCHAR(65) NULL,
  `skill` VARCHAR(1000) NULL COMMENT 'user skill',
  `bio` VARCHAR(1000) NULL,
  `jobStatus` INT(11) NULL,
  `createdAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `settings` VARCHAR(1000) NULL COMMENT 'profile display',
  `img` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nick_UNIQUE` (`nick` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devnetwork_dev`.`Post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devnetwork_dev`.`Post` (
  `id` INT NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `contentType` TINYTEXT NOT NULL,
  `content` VARCHAR(1000) NOT NULL,
  `createdAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `User_id` INT NOT NULL,
  PRIMARY KEY (`id`, `User_id`),
  INDEX `fk_Post_User_idx` (`User_id` ASC),
  CONSTRAINT `fk_Post_User`
    FOREIGN KEY (`User_id`)
    REFERENCES `devnetwork_dev`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devnetwork_dev`.`FavoriteUserPost`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devnetwork_dev`.`FavoriteUserPost` (
  `User_id` INT NOT NULL,
  `Post_id` INT NOT NULL,
  PRIMARY KEY (`User_id`, `Post_id`),
  INDEX `fk_User_has_Post_Post1_idx` (`Post_id` ASC),
  INDEX `fk_User_has_Post_User1_idx` (`User_id` ASC),
  CONSTRAINT `fk_User_has_Post_User1`
    FOREIGN KEY (`User_id`)
    REFERENCES `devnetwork_dev`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Post_Post1`
    FOREIGN KEY (`Post_id`)
    REFERENCES `devnetwork_dev`.`Post` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
