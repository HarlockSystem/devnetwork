SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `devnetwork_dev`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devnetwork_dev`.`User` (
  `id` INT NOT NULL,
  `login` VARCHAR(65) NOT NULL COMMENT 'pseudo',
  `password` VARCHAR(60) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `firstname` VARCHAR(65) NULL,
  `lastname` VARCHAR(65) NULL,
  `skill` VARCHAR(1000) NULL COMMENT 'user skill',
  `bio` VARCHAR(1000) NULL,
  `jobStatus` INT(11) NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `settings` VARCHAR(1000) NULL COMMENT 'profile display',
  `img` VARCHAR(45) NULL,
  `role` TINYINT NOT NULL,
  `statusUser` TINYINT NOT NULL COMMENT 'active\ndelete\n',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nick_UNIQUE` (`login` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devnetwork_dev`.`Post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devnetwork_dev`.`Post` (
  `id` INT NOT NULL,
  `UserId` INT NOT NULL,
  `title` VARCHAR(60) NOT NULL,
  `contentType` TINYINT NOT NULL COMMENT 'snippet\ncomment\n',
  `content` VARCHAR(1000) NOT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statusPost` TINYINT NOT NULL COMMENT 'active\npending \ndelete',
  PRIMARY KEY (`id`, `UserId`),
  INDEX `fk_Post_User_idx` (`UserId` ASC),
  CONSTRAINT `fk_Post_User`
    FOREIGN KEY (`UserId`)
    REFERENCES `devnetwork_dev`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devnetwork_dev`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devnetwork_dev`.`User` (
  `id` INT NOT NULL,
  `login` VARCHAR(65) NOT NULL COMMENT 'pseudo',
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `firstname` VARCHAR(65) NULL,
  `lastname` VARCHAR(65) NULL,
  `skill` VARCHAR(1000) NULL COMMENT 'user skill',
  `bio` VARCHAR(1000) NULL,
  `jobStatus` INT(11) NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `settings` VARCHAR(1000) NULL COMMENT 'profile display',
  `img` VARCHAR(45) NULL,
  `role` TINYINT NOT NULL,
  `statusUser` TINYINT NOT NULL COMMENT 'active\ndelete\n',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nick_UNIQUE` (`login` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devnetwork_dev`.`Post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devnetwork_dev`.`Post` (
  `id` INT NOT NULL,
  `UserId` INT NOT NULL,
  `title` VARCHAR(60) NOT NULL,
  `contentType` TINYINT NOT NULL COMMENT 'snippet\ncomment\n',
  `content` VARCHAR(1000) NOT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statusPost` TINYINT NOT NULL COMMENT 'active\npending \ndelete',
  PRIMARY KEY (`id`, `UserId`),
  INDEX `fk_Post_User_idx` (`UserId` ASC),
  CONSTRAINT `fk_Post_User`
    FOREIGN KEY (`UserId`)
    REFERENCES `devnetwork_dev`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devnetwork_dev`.`FavoriteUserPost`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devnetwork_dev`.`FavoriteUserPost` (
  `UserId` INT NOT NULL,
  `PostId` INT NOT NULL,
  PRIMARY KEY (`UserId`, `PostId`),
  INDEX `fk_User_has_Post_Post1_idx` (`PostId` ASC),
  INDEX `fk_User_has_Post_User1_idx` (`UserId` ASC),
  CONSTRAINT `fk_User_has_Post_User1`
    FOREIGN KEY (`UserId`)
    REFERENCES `devnetwork_dev`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Post_Post1`
    FOREIGN KEY (`PostId`)
    REFERENCES `devnetwork_dev`.`Post` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devnetwork_dev`.`LikeUserPost`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devnetwork_dev`.`LikeUserPost` (
  `UserId` INT NOT NULL,
  `PostId` INT NOT NULL,
  PRIMARY KEY (`UserId`, `PostId`),
  INDEX `fk_User_has_Post_Post2_idx` (`PostId` ASC),
  INDEX `fk_User_has_Post_User2_idx` (`UserId` ASC),
  CONSTRAINT `fk_User_has_Post_User2`
    FOREIGN KEY (`UserId`)
    REFERENCES `devnetwork_dev`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Post_Post2`
    FOREIGN KEY (`PostId`)
    REFERENCES `devnetwork_dev`.`Post` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devnetwork_dev`.`Tag`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devnetwork_dev`.`Tag` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `category` TINYINT NULL COMMENT 'program language\ngeneral',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devnetwork_dev`.`PostTag`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devnetwork_dev`.`PostTag` (
  `PostId` INT NOT NULL,
  `TagId` INT NOT NULL,
  PRIMARY KEY (`PostId`, `TagId`),
  INDEX `fk_Post_has_Tag_Tag1_idx` (`TagId` ASC),
  INDEX `fk_Post_has_Tag_Post1_idx` (`PostId` ASC),
  CONSTRAINT `fk_Post_has_Tag_Post1`
    FOREIGN KEY (`PostId`)
    REFERENCES `devnetwork_dev`.`Post` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Post_has_Tag_Tag1`
    FOREIGN KEY (`TagId`)
    REFERENCES `devnetwork_dev`.`Tag` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devnetwork_dev`.`UserTag`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devnetwork_dev`.`UserTag` (
  `UserId` INT NOT NULL,
  `TagId` INT NOT NULL,
  PRIMARY KEY (`UserId`, `TagId`),
  INDEX `fk_User_has_Tag_Tag1_idx` (`TagId` ASC),
  INDEX `fk_User_has_Tag_User1_idx` (`UserId` ASC),
  CONSTRAINT `fk_User_has_Tag_User1`
    FOREIGN KEY (`UserId`)
    REFERENCES `devnetwork_dev`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Tag_Tag1`
    FOREIGN KEY (`TagId`)
    REFERENCES `devnetwork_dev`.`Tag` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devnetwork_dev`.`Comment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devnetwork_dev`.`Comment` (
  `id` INT NOT NULL,
  `PostId` INT NOT NULL,
  `UserId` INT NOT NULL,
  `content` VARCHAR(1000) NOT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`, `PostId`, `UserId`),
  INDEX `fk_Comment_Post1_idx` (`PostId` ASC),
  INDEX `fk_Comment_User1_idx` (`UserId` ASC),
  CONSTRAINT `fk_Comment_Post1`
    FOREIGN KEY (`PostId`)
    REFERENCES `devnetwork_dev`.`Post` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Comment_User1`
    FOREIGN KEY (`UserId`)
    REFERENCES `devnetwork_dev`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devnetwork_dev`.`UserFavorite`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devnetwork_dev`.`UserFavorite` (
  `UserId` INT NOT NULL,
  `FavoriteId` INT NOT NULL,
  PRIMARY KEY (`UserId`, `FavoriteId`),
  INDEX `fk_User_has_User_User2_idx` (`FavoriteId` ASC),
  INDEX `fk_User_has_User_User1_idx` (`UserId` ASC),
  CONSTRAINT `fk_User_has_User_User1`
    FOREIGN KEY (`UserId`)
    REFERENCES `devnetwork_dev`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_User_User2`
    FOREIGN KEY (`FavoriteId`)
    REFERENCES `devnetwork_dev`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
