CREATE DATABASE chamber_sz24 ;
USE chamber_sz24;
CREATE TABLE `ms_level` (
	`level_id` INT(11) NOT NULL AUTO_INCREMENT,
	`level_hierarchy` INT(11) NULL DEFAULT '1',
	`level_name` VARCHAR(100) NULL DEFAULT NULL,
	`chamber_sync_flag` TINYINT(4) NULL DEFAULT '0',
	`field_sync` TINYINT(4) NULL DEFAULT '0',
	`status` TINYINT(4) NULL DEFAULT '1',
	`created_at` DATETIME NULL DEFAULT NULL,
	`created_by` VARCHAR(25) NULL DEFAULT NULL,
	`created_ip` VARCHAR(25) NULL DEFAULT NULL,
	`updated_at` DATETIME NULL DEFAULT NULL,
	`updated_by` VARCHAR(25) NULL DEFAULT NULL,
	`updated_ip` VARCHAR(25) NULL DEFAULT NULL,
	PRIMARY KEY (`level_id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=3
;
