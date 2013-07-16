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
  `product_exchange_rate` INT NOT NULL COMMENT '1元人民币能兑换多少游戏币' ,
  `product_currency_name` CHAR(8) NOT NULL ,
  `product_server_role` CHAR(64) NOT NULL COMMENT '获取角色列表的接口' ,
  `product_server_recharge` CHAR(64) NOT NULL COMMENT '充值的接口' ,
  `product_key` CHAR(32) NOT NULL ,
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
  `server_web_url` CHAR(64) NOT NULL ,
  `server_game_ip` CHAR(16) NOT NULL ,
  `server_game_port` CHAR(10) NOT NULL ,
  `server_service_url` CHAR(64) NOT NULL ,
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
  `account_regtime` INT NOT NULL ,
  `account_lastlogin` INT NOT NULL ,
  `ucenter_uid` INT NOT NULL DEFAULT 0 ,
  `account_cash` INT NOT NULL DEFAULT 0 COMMENT '剩余平台币' ,
  `account_recharge` INT NOT NULL DEFAULT 0 COMMENT '累计充值' ,
  `account_fromwhere` INT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`account_id`) ,
  INDEX `account_name` (`account_name` ASC, `account_pass` ASC) ,
  INDEX `ucenter_uid` (`ucenter_uid` ASC) )
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


-- -----------------------------------------------------
-- Table `pulse_db_web`.`pulse_feed`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pulse_db_web`.`pulse_feed` ;

CREATE  TABLE IF NOT EXISTS `pulse_db_web`.`pulse_feed` (
  `feed_id` BIGINT NOT NULL AUTO_INCREMENT ,
  `account_id` BIGINT NOT NULL ,
  `product_id` INT NOT NULL ,
  `server_id` INT NOT NULL ,
  `feed_time` INT NOT NULL ,
  PRIMARY KEY (`feed_id`) ,
  INDEX `account_id` (`account_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pulse_db_web`.`pulse_mail_template`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pulse_db_web`.`pulse_mail_template` ;

CREATE  TABLE IF NOT EXISTS `pulse_db_web`.`pulse_mail_template` (
  `template_id` INT NOT NULL AUTO_INCREMENT ,
  `template_name` CHAR(64) NOT NULL ,
  `template_subject` CHAR(64) NOT NULL ,
  `template_content` TEXT NOT NULL ,
  `smtp_host` CHAR(16) NOT NULL ,
  `smtp_user` CHAR(32) NOT NULL ,
  `smtp_pass` CHAR(32) NOT NULL ,
  `smtp_from` VARCHAR(64) NOT NULL ,
  `smtp_fromName` VARCHAR(64) NOT NULL ,
  PRIMARY KEY (`template_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pulse_db_web`.`pulse_mail_bind`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pulse_db_web`.`pulse_mail_bind` ;

CREATE  TABLE IF NOT EXISTS `pulse_db_web`.`pulse_mail_bind` (
  `code` CHAR(32) NOT NULL ,
  `account_id` BIGINT NOT NULL ,
  `account_email` CHAR(64) NOT NULL ,
  `expire_time` INT NOT NULL ,
  `bind_validate` TINYINT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`code`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pulse_db_web`.`pulse_coupon`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pulse_db_web`.`pulse_coupon` ;

CREATE  TABLE IF NOT EXISTS `pulse_db_web`.`pulse_coupon` (
  `coupon_content` CHAR(32) NOT NULL ,
  `product_id` INT NOT NULL COMMENT '适用于哪个游戏' ,
  `coupon_type` TINYINT NOT NULL DEFAULT 0 COMMENT '礼券类型\n0=现金礼券\n1=道具礼券' ,
  `coupon_detail` CHAR(128) NOT NULL COMMENT 'JSON格式\n如果coupon_type=0\ncoupon_detail={value:10}\n\n如果coupon_type=1\ncoupon_detail={[{id:1002, value:1}, {id:1003, value:2}]}' ,
  `coupon_expire_time` INT NOT NULL ,
  `coupon_inuse` TINYINT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`coupon_content`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pulse_db_web`.`pulse_account_coupon`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pulse_db_web`.`pulse_account_coupon` ;

CREATE  TABLE IF NOT EXISTS `pulse_db_web`.`pulse_account_coupon` (
  `account_id` BIGINT NOT NULL ,
  `coupon_content` CHAR(32) NOT NULL ,
  `post_time` INT NOT NULL ,
  `expire_time` INT NOT NULL ,
  PRIMARY KEY (`account_id`, `coupon_content`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pulse_db_web`.`pulse_appeal`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pulse_db_web`.`pulse_appeal` ;

CREATE  TABLE IF NOT EXISTS `pulse_db_web`.`pulse_appeal` (
  `appeal_id` BIGINT NOT NULL AUTO_INCREMENT ,
  `appeal_category` CHAR(16) NOT NULL ,
  `account_id` BIGINT NOT NULL COMMENT '发布者ID' ,
  `account_name` CHAR(32) NOT NULL COMMENT '申诉的帐号' ,
  `appeal_content` TEXT NOT NULL ,
  `appeal_posttime` INT NOT NULL ,
  `appeal_reply` TEXT NOT NULL ,
  `appeal_reply_posttime` INT NOT NULL ,
  PRIMARY KEY (`appeal_id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 10020153001;


-- -----------------------------------------------------
-- Table `pulse_db_web`.`pulse_server_log`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pulse_db_web`.`pulse_server_log` ;

CREATE  TABLE IF NOT EXISTS `pulse_db_web`.`pulse_server_log` (
  `product_id` INT NOT NULL ,
  `account_id` BIGINT NOT NULL ,
  `server_id` INT NOT NULL ,
  `updatetime` INT NOT NULL ,
  PRIMARY KEY (`product_id`, `account_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pulse_db_web`.`pulse_role_count`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pulse_db_web`.`pulse_role_count` ;

CREATE  TABLE IF NOT EXISTS `pulse_db_web`.`pulse_role_count` (
  `product_id` INT NOT NULL ,
  `account_id` BIGINT NOT NULL ,
  `server_id` INT NOT NULL ,
  `count` INT NOT NULL ,
  PRIMARY KEY (`product_id`, `account_id`, `server_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pulse_db_web`.`pulse_order`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pulse_db_web`.`pulse_order` ;

CREATE  TABLE IF NOT EXISTS `pulse_db_web`.`pulse_order` (
  `order_id` BIGINT NOT NULL AUTO_INCREMENT ,
  `account_id` BIGINT NOT NULL ,
  `order_cash` INT NOT NULL COMMENT '以分为单位' ,
  `account_cash` INT NOT NULL COMMENT '累计充值金额' ,
  `account_fromwhere` INT NOT NULL ,
  `order_type` INT NOT NULL DEFAULT 1 COMMENT '充值渠道：1=paypal' ,
  `order_time` INT NOT NULL ,
  PRIMARY KEY (`order_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pulse_db_web`.`pulse_order_game`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pulse_db_web`.`pulse_order_game` ;

CREATE  TABLE IF NOT EXISTS `pulse_db_web`.`pulse_order_game` (
  `order_id` BIGINT NOT NULL AUTO_INCREMENT ,
  `account_id` BIGINT NOT NULL ,
  `product_id` INT NOT NULL ,
  `order_cash` INT NOT NULL ,
  `account_cash` INT NOT NULL COMMENT '剩余平台币' ,
  `order_time` INT NOT NULL ,
  PRIMARY KEY (`order_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pulse_db_web`.`pulse_screenshot`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pulse_db_web`.`pulse_screenshot` ;

CREATE  TABLE IF NOT EXISTS `pulse_db_web`.`pulse_screenshot` (
  `screenshot_id` INT NOT NULL AUTO_INCREMENT ,
  `product_id` INT NOT NULL ,
  `screenshot_title` CHAR(64) NOT NULL ,
  `screenshot_content` TEXT NOT NULL ,
  `screenshot_posttime` INT NOT NULL ,
  PRIMARY KEY (`screenshot_id`) )
ENGINE = InnoDB;

USE `pulse_db_web` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
