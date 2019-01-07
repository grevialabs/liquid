CREATE DATABASE klbox;
USE klbox;

CREATE TABLE ms_user(
user_id int NOT NULL AUTO_INCREMENT,
name varchar(100) NULL DEFAULT NULL,
thepassword varchar(120) NULL DEFAULT NULL,
status tinyint NULL DEFAULT 1,
created_at datetime NULL DEFAULT NULL,
created_by varchar(25) NULL DEFAULT NULL,
created_ip varchar(25) NULL DEFAULT NULL,
updated_at datetime NULL DEFAULT NULL,
updated_by varchar(25) NULL DEFAULT NULL,
updated_ip varchar(25) NULL DEFAULT NULL,
PRIMARY KEY(user_id)
) COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1;

CREATE TABLE ms_article(
article_id int NOT NULL AUTO_INCREMENT,
name varchar(100) NULL DEFAULT NULL,
slug varchar(100) NULL DEFAULT NULL,
description text NULL DEFAULT NULL,
notes text NULL DEFAULT NULL,
status tinyint NULL DEFAULT 1,
created_at datetime NULL DEFAULT NULL,
created_by varchar(25) NULL DEFAULT NULL,
created_ip varchar(25) NULL DEFAULT NULL,
updated_at datetime NULL DEFAULT NULL,
updated_by varchar(25) NULL DEFAULT NULL,
updated_ip varchar(25) NULL DEFAULT NULL,
PRIMARY KEY(article_id)
) COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1;

CREATE TABLE ms_company(
company_id INT NOT NULL AUTO_INCREMENT,
name varchar(255) NULL DEFAULT NULL,
address varchar(255) NULL DEFAULT NULL,
phone varchar(255) NULL DEFAULT NULL,
status tinyint NULL DEFAULT 1,
created_at datetime NULL DEFAULT NULL,
created_by varchar(25) NULL DEFAULT NULL,
created_ip varchar(25) NULL DEFAULT NULL,
updated_at datetime NULL DEFAULT NULL,
updated_by varchar(25) NULL DEFAULT NULL,
updated_ip varchar(25) NULL DEFAULT NULL,
PRIMARY KEY(company_id)
) COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1;

CREATE TABLE tr_log (
log_id int not null auto_increment,
name varchar(100) NULL,
data text NULL,
primary key(log_id)
)COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1;

INSERT INTO `klbox`.`ms_article` (`name`, `slug`, `description`, `notes`, `created_at`, `created_by`) VALUES ('lorem ipsum', 'lorem-ipsum-dolor', 'Ini adalah artikel pertama untuk produk klbox', 'yaya', '2018-12-31 18:14:39', '1');
INSERT INTO `klbox`.`ms_article` (`name`, `slug`, `description`, `created_at`) VALUES ('Bebas mantap jiwa', 'bebas-mantap', 'Masih deskripsi dan lembur', '2018-12-31 18:15:05');


CREATE TABLE `ms_token` (
	`token_id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100) NULL DEFAULT NULL,
	`token` VARCHAR(100) NULL DEFAULT NULL,
	`expired_at` DATETIME NULL DEFAULT NULL,
    status tinyint NULL DEFAULT 1,
    created_at datetime NULL DEFAULT NULL,
    created_by varchar(25) NULL DEFAULT NULL,
    created_ip varchar(25) NULL DEFAULT NULL,
    updated_at datetime NULL DEFAULT NULL,
    updated_by varchar(25) NULL DEFAULT NULL,
    updated_ip varchar(25) NULL DEFAULT NULL,
	PRIMARY KEY (`token_id`)
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1
;
INSERT INTO `klbox`.`ms_token` (`name`, `token`) VALUES ('key', 'macbook');

