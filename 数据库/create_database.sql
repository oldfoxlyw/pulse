SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `pulse_db_web` ;
CREATE SCHEMA IF NOT EXISTS `pulse_db_web` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `pulse_db_web` ;

-- -----------------------------------------------------
-- Table `pulse_db_web`.`pulse_products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pulse_db_web`.`pulse_products` ;

CREATE  TABLE IF NOT EXISTS `pulse_db_web`.`pulse_products` (
  `product_id` INT NOT NULL AUTO_INCREMENT ,
  `product_name` CHAR(16) NOT NULL COMMENT '游戏名称' ,
  `product_category` CHAR(16) NOT NULL COMMENT '游戏类型' ,
  `product_comment` TEXT NOT NULL COMMENT '游戏描述' ,
  `product_url_website` CHAR(128) NOT NULL COMMENT '游戏官网链接' ,
  `product_url_entry` CHAR(128) NOT NULL COMMENT '游戏入口链接' ,
  `product_status` ENUM('PUBLIC','BETA','HOT') NOT NULL DEFAULT 'PUBLIC' ,
  `product_recommand` TINYINT NOT NULL DEFAULT 1 ,
  `product_sort` INT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`product_id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1001;


-- -----------------------------------------------------
-- Table `pulse_db_web`.`pulse_serverlist`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pulse_db_web`.`pulse_serverlist` ;

CREATE  TABLE IF NOT EXISTS `pulse_db_web`.`pulse_serverlist` (
  `product_id` INT NOT NULL ,
  `server_id` INT NOT NULL ,
  `server_name` CHAR(32) NOT NULL ,
  `server_time_start` INT NOT NULL ,
  `server_status` ENUM('NORMAL','HOT','CLOSE') NOT NULL DEFAULT 'NORMAL' ,
  `server_game_ip` CHAR(16) NOT NULL ,
  `server_game_port` CHAR(16) NOT NULL ,
  PRIMARY KEY (`product_id`, `server_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pulse_db_web`.`pulse_news`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pulse_db_web`.`pulse_news` ;

CREATE  TABLE IF NOT EXISTS `pulse_db_web`.`pulse_news` (
  `news_id` INT NOT NULL AUTO_INCREMENT ,
  `news_title` CHAR(64) NOT NULL ,
  `product_id` INT NOT NULL ,
  `news_category` CHAR(16) NOT NULL ,
  `news_content` MEDIUMTEXT NOT NULL ,
  `news_posttime` INT NOT NULL ,
  PRIMARY KEY (`news_id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1000;


-- -----------------------------------------------------
-- Table `pulse_db_web`.`pulse_account`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pulse_db_web`.`pulse_account` ;

CREATE  TABLE IF NOT EXISTS `pulse_db_web`.`pulse_account` (
  `account_id` BIGINT NOT NULL AUTO_INCREMENT ,
  `account_name` CHAR(32) NOT NULL ,
  `account_pass` CHAR(64) NOT NULL ,
  `account_email` CHAR(64) NOT NULL ,
  `account_mobile` CHAR(32) NOT NULL ,
  `account_nickname` CHAR(16) NOT NULL ,
  `account_sex` TINYINT NOT NULL DEFAULT 1 ,
  `account_birthday` INT NOT NULL DEFAULT 0 ,
  `account_country` CHAR(32) NOT NULL ,
  `account_city` CHAR(32) NOT NULL ,
  `account_job` CHAR(32) NOT NULL ,
  PRIMARY KEY (`account_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pulse_db_web`.`pulse_activity`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pulse_db_web`.`pulse_activity` ;

CREATE  TABLE IF NOT EXISTS `pulse_db_web`.`pulse_activity` (
  `activity_id` INT NOT NULL AUTO_INCREMENT ,
  `activity_name` CHAR(32) NOT NULL ,
  `activity_url` CHAR(128) NOT NULL ,
  `activity_loop` TINYINT NOT NULL DEFAULT 1 ,
  `activity_looptype` INT NOT NULL DEFAULT 1 COMMENT 'activity_looptype\n0=不重复\n1=每天\n2=每周\n3=每月' ,
  `activity_time_start` INT NOT NULL ,
  `activity_time_end` INT NOT NULL ,
  `product_id` INT NOT NULL ,
  PRIMARY KEY (`activity_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pulse_db_web`.`pulse_log`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pulse_db_web`.`pulse_log` ;

CREATE  TABLE IF NOT EXISTS `pulse_db_web`.`pulse_log` (
  `log_id` BIGINT NOT NULL AUTO_INCREMENT ,
  `log_type` CHAR(32) NOT NULL ,
  `log_account_name` CHAR(32) NOT NULL ,
  `log_uri` CHAR(128) NOT NULL ,
  `log_method` CHAR(8) NOT NULL ,
  `log_parameter` TEXT NOT NULL ,
  `log_time_local` DATETIME NOT NULL ,
  PRIMARY KEY (`log_id`) )
ENGINE = InnoDB;

USE `pulse_db_web` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
