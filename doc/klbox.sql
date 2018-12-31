CREATE DATABASE klbox;
USE klbox;

CREATE TABLE ms_user(
user_id int NOT NULL AUTO_INCREMENT,
name varchar(100) NULL DEFAULT NULL,
thepassword varchar(120) NULL DEFAULT NULL,
PRIMARY KEY(user_id)
);

CREATE TABLE ms_article(
article_id int NOT NULL AUTO_INCREMENT,
name varchar(100) NULL DEFAULT NULL,
slug varchar(100) NULL DEFAULT NULL,
description text NULL DEFAULT NULL,
notes text NULL DEFAULT NULL,
status tinyint NULL DEFAULT 1,
created_at datetime NULL DEFAULT NULL,
created_by varchar(15) NULL DEFAULT NULL,
updated_at datetime NULL DEFAULT NULL,
updated_by varchar(15) NULL DEFAULT NULL,
PRIMARY KEY(article_id)
);

INSERT INTO `klbox`.`ms_article` (`name`, `slug`, `description`, `notes`, `created_at`, `created_by`) VALUES ('lorem ipsum', 'lorem-ipsum-dolor', 'Ini adalah artikel pertama untuk produk klbox', 'yaya', '2018-12-31 18:14:39', '1');
INSERT INTO `klbox`.`ms_article` (`name`, `slug`, `description`, `created_at`) VALUES ('Bebas mantap jiwa', 'bebas-mantap', 'Masih deskripsi dan lembur', '2018-12-31 18:15:05');


CREATE TABLE `ms_token` (
	`token_id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100) NULL DEFAULT NULL,
	`token` VARCHAR(100) NULL DEFAULT NULL,
	`expired_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`token_id`)
)
COLLATE='latin1_swedish_ci'
ENGINE=MyISAM
AUTO_INCREMENT=2
;
INSERT INTO `klbox`.`ms_token` (`name`, `token`) VALUES ('key', 'macbook');