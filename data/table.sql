-- MySQL Script generated by MySQL Workbench
-- Fri 11 Mar 2016 09:32:07 PM MSK
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mydb` ;

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`tbl_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tbl_user` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_user` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `username` VARCHAR(100) NOT NULL COMMENT '',
  `name` VARCHAR(45) NOT NULL COMMENT '',
  `surname` VARCHAR(45) NOT NULL COMMENT '',
  `password` VARCHAR(255) NOT NULL COMMENT '',
  `salt` VARCHAR(255) NOT NULL COMMENT '',
  `access_token` VARCHAR(255) NULL DEFAULT NULL COMMENT '',
  `create_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `username_UNIQUE` (`username` ASC)  COMMENT '',
  UNIQUE INDEX `access_token_UNIQUE` (`access_token` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tbl_calendar`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tbl_calendar` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_calendar` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `text` TEXT NOT NULL COMMENT '',
  `creator` INT NOT NULL COMMENT '',
  `date_event` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_tbl_calendar_1_idx` (`creator` ASC)  COMMENT '',
  CONSTRAINT `fk_tbl_calendar_1`
    FOREIGN KEY (`creator`)
    REFERENCES `mydb`.`tbl_user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tbl_access`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tbl_access` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tbl_access` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `note_id` INT NOT NULL COMMENT '',
  `user_owner` INT NOT NULL COMMENT '',
  `user_guest` INT NOT NULL COMMENT '',
  `date` DATE NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_tbl_access_1_idx` (`user_owner` ASC)  COMMENT '',
  INDEX `fk_tbl_access_3_idx` (`note_id` ASC)  COMMENT '',
  INDEX `fk_tbl_access_2_idx` (`user_guest` ASC)  COMMENT '',
  CONSTRAINT `fk_tbl_access_1`
    FOREIGN KEY (`user_owner`)
    REFERENCES `mydb`.`tbl_user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_access_3`
    FOREIGN KEY (`note_id`)
    REFERENCES `mydb`.`tbl_calendar` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_access_2`
    FOREIGN KEY (`user_guest`)
    REFERENCES `mydb`.`tbl_user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
