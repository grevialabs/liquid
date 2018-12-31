CREATE DATABASE scrape;

USE scrape;

CREATE TABLE scr_group
(
group_id INT NOT NULL AUTO_INCREMENT,
name varchar(120) NULL DEFAULT NULL,
keyword_list varchar(220) NULL DEFAULT NULL,
total_keyword varchar(5) NULL DEFAULT NULL,
PRIMARY KEY(group_id)
)
COLLATE='utf8mb4_general_ci';

CREATE TABLE scr_username
(
username_id INT NOT NULL AUTO_INCREMENT,
username varchar(150) NULL DEFAULT NULL,
fullname text NULL DEFAULT NULL,
follower varchar(15) NULL DEFAULT NULL,
following varchar(15) NULL DEFAULT NULL,
biodata text NULL DEFAULT NULL,
location text NULL DEFAULT NULL,
join_date datetime NULL DEFAULT NULL,
profilepic varchar(220) NULL DEFAULT NULL,
sumlikes varchar(15) NULL DEFAULT NULL,
sumtweets varchar(15) NULL DEFAULT NULL,
url varchar(150) NULL DEFAULT NULL,
is_scrape tinyint NULL DEFAULT 0,
creator_date datetime NULL DEFAULT NULL,
editor_date datetime NULL DEFAULT NULL,
PRIMARY KEY(username_id)
) 
COLLATE='utf8mb4_general_ci'
ENGINE=MyISAM;

CREATE TABLE scr_scrape
(
scrape_id BIGINT NOT NULL AUTO_INCREMENT,
username varchar(150) NULL DEFAULT NULL, 
post_content varchar(240) NULL DEFAULT NULL, 
post_gallery varchar(240) NULL DEFAULT NULL, 
post_date varchar(140) NULL DEFAULT NULL, 
post_link varchar(140) NULL DEFAULT NULL, 
post_tag varchar(140) NULL DEFAULT NULL, 
post_user varchar(140) NULL DEFAULT NULL,
is_scrape tinyint NULL DEFAULT 0,
creator_date datetime NULL DEFAULT NULL,
editor_date datetime NULL DEFAULT NULL,
PRIMARY KEY(scrape_id)
) COLLATE='utf8mb4_general_ci';

CREATE TABLE scr_post_twitter
(
`post_twitter_id` BIGINT(20) NOT NULL AUTO_INCREMENT,
`url` VARCHAR(130) NULL DEFAULT NULL,
`content` TEXT NULL,
`is_scrape` TINYINT(4) NULL DEFAULT '0',
`matched_keyword` VARCHAR(100) NULL DEFAULT NULL,
`status` TINYINT(4) NULL DEFAULT '0',
`creator_date` DATETIME NULL DEFAULT NULL,
`editor_date` DATETIME NULL DEFAULT NULL,
PRIMARY KEY (`post_twitter_id`)
) COLLATE='utf8mb4_general_ci';



CREATE TABLE scr_log (
log_id int not null auto_increment,
name varchar(100) NULL,
data text NULL,
primary key(log_id)

);

CREATE TABLE scr_token (
token_id int not null auto_increment,
name varchar(100) NULL,
token varchar(100) NULL,
expired_at datetime NULL,
primary key(token_id)

)