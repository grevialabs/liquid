CREATE TABLE tr_transaction (
transaction_id varchar(100)	NOT NULL,
site_id	varchar(4) NOT NULL,
user_id	varchar(4) NOT NULL,
article	varchar(100) NULL DEFAULT NULL,
customer_article varchar(100) NULL DEFAULT NULL,
description	varchar(200) NULL DEFAULT NULL,
qty	int NULL DEFAULT NULL,
`value` int NULL DEFAULT NULL,
status_in_out varchar(10) NULL DEFAULT NULL COMMENT 'in or out',
reason_id int NULL DEFAULT NULL,
wo_wbs varchar(100) NULL DEFAULT NULL,
remark varchar(200) NULL DEFAULT NULL,
chamber_sync_flag tinyint NULL DEFAULT 0,
field_sync tinyint NULL DEFAULT 0,
status tinyint NULL DEFAULT 1,
created_at datetime NULL DEFAULT NULL,
created_by varchar(25) NULL DEFAULT NULL,
created_ip varchar(25) NULL DEFAULT NULL,
updated_at datetime NULL DEFAULT NULL,
updated_by varchar(25) NULL DEFAULT NULL,
updated_ip varchar(25) NULL DEFAULT NULL,
PRIMARY KEY(transaction_id)
) COLLATE='utf8mb4_general_ci' 
ENGINE=InnoDB
AUTO_INCREMENT=1;

CREATE TABLE tr_movement_article (
movement_article_id int	NOT NULL AUTO_INCREMENT,
receiving_site_id varchar(4) NULL,
article varchar(100) NULL,
description varchar(200) NULL,
qty int NULL,
movement_type varchar(10) NULL,
status tinyint NULL DEFAULT 1,
created_at datetime NULL DEFAULT NULL,
created_by varchar(25) NULL DEFAULT NULL,
created_ip varchar(25) NULL DEFAULT NULL,
updated_at datetime NULL DEFAULT NULL,
updated_by varchar(25) NULL DEFAULT NULL,
updated_ip varchar(25) NULL DEFAULT NULL,
PRIMARY KEY(transaction_id)
) COLLATE='utf8mb4_general_ci' 
ENGINE=InnoDB
AUTO_INCREMENT=1;

CREATE TABLE tr_movement_quota_level (
movement_quota_id int NOT NULL AUTO_INCREMENT,
user_id int	NOT NULL AUTO_INCREMENT,
site_id varchar(4) NULL ,
transaction_id varchar(100) NULL,
transaction_code varchar(100) NULL,
qty int NULL,
`value` int NULL,
balance_qty int NULL,
balance_value int NULL,
status tinyint NULL DEFAULT 1,
created_at datetime NULL DEFAULT NULL,
created_by varchar(25) NULL DEFAULT NULL,
created_ip varchar(25) NULL DEFAULT NULL,
updated_at datetime NULL DEFAULT NULL,
updated_by varchar(25) NULL DEFAULT NULL,
updated_ip varchar(25) NULL DEFAULT NULL,
PRIMARY KEY(transaction_id)
) COLLATE='utf8mb4_general_ci' 
ENGINE=InnoDB
AUTO_INCREMENT=1;

CREATE TABLE ms_reason_type(
reason_type_id int NOT NULL AUTO_INCREMENT,
attribute_id INT NOT NULL,
attribute_value varchar(100) NULL DEFAULT NULL,
site_id varchar(10) NULL DEFAULT NULL,
chamber_sync_flag tinyint NULL DEFAULT 0,
field_sync tinyint NULL DEFAULT 0,
status tinyint NULL DEFAULT 1,
created_at datetime NULL DEFAULT NULL,
created_by varchar(25) NULL DEFAULT NULL,
created_ip varchar(25) NULL DEFAULT NULL,
updated_at datetime NULL DEFAULT NULL,
updated_by varchar(25) NULL DEFAULT NULL,
updated_ip varchar(25) NULL DEFAULT NULL,
PRIMARY KEY(reason_id)
) COLLATE='utf8mb4_general_ci' 
ENGINE=InnoDB
AUTO_INCREMENT=1;

CREATE TABLE ms_reason_type_mapping(
reason_type_mapping_id int NOT NULL AUTO_INCREMENT,
reason_type_id int NOT NULL,
reason_id INT NOT NULL,
chamber_sync_flag tinyint NULL DEFAULT 0,
field_sync tinyint NULL DEFAULT 0,
status tinyint NULL DEFAULT 1,
created_at datetime NULL DEFAULT NULL,
created_by varchar(25) NULL DEFAULT NULL,
created_ip varchar(25) NULL DEFAULT NULL,
updated_at datetime NULL DEFAULT NULL,
updated_by varchar(25) NULL DEFAULT NULL,
updated_ip varchar(25) NULL DEFAULT NULL,
PRIMARY KEY(reason_id)
) COLLATE='utf8mb4_general_ci' 
ENGINE=InnoDB
AUTO_INCREMENT=1;

--------

CREATE TABLE tr_article_logistic_site(
article_logistic_site_id int NOT NULL AUTO_INCREMENT,
site_id varchar(4) NOT NULL,
outbound_delivery_no varchar(15) NOT NULL,
status tinyint NULL DEFAULT 1,
created_at datetime NULL DEFAULT NULL,
created_by varchar(25) NULL DEFAULT NULL,
created_ip varchar(25) NULL DEFAULT NULL,
updated_at datetime NULL DEFAULT NULL,
updated_by varchar(25) NULL DEFAULT NULL,
updated_ip varchar(25) NULL DEFAULT NULL,
PRIMARY KEY(article_logistic_site_id,site_id)
) COLLATE='utf8mb4_general_ci' 
ENGINE=InnoDB
AUTO_INCREMENT=1;


CREATE TABLE tr_article_logistic_site_detail(
article_logistic_site_detail_id int NOT NULL AUTO_INCREMENT,
outbound_delivery_no int NOT NULL,
article varchar(100) NOT NULL,
customer_article varchar(100) NOT NULL,
description varchar(200) NULL DEFAULT NULL,
qty_issue int NULL DEFAULT NULL,
conv_uom varchar(10) NULL DEFAULT NULL,
qty_receive_actual int NULL DEFAULT NULL,
qty_receive int NULL DEFAULT NULL,
disc_minus int NULL DEFAULT NULL,
disc_plus int NULL DEFAULT NULL,
conversion_diff int NULL DEFAULT NULL COMMENT 'selisih conversion',
dashboard_received_date datetime NULL DEFAULT NULL,
qty_chamber varchar(100) NULL DEFAULT NULL,
chamber_disc_minus int NULL DEFAULT NULL,
chamber_disc_plus int NULL DEFAULT NULL,
chamber_sync_flag tinyint NULL DEFAULT 0,
field_sync tinyint NULL DEFAULT 0,

status tinyint NULL DEFAULT 1,
created_at datetime NULL DEFAULT NULL,
created_by varchar(25) NULL DEFAULT NULL,
created_ip varchar(25) NULL DEFAULT NULL,
updated_at datetime NULL DEFAULT NULL,
updated_by varchar(25) NULL DEFAULT NULL,
updated_ip varchar(25) NULL DEFAULT NULL,
PRIMARY KEY(outbound_delivery_no,article)
) COLLATE='utf8mb4_general_ci' 
ENGINE=InnoDB
AUTO_INCREMENT=1;

CREATE TABLE ms_article_stock(
site_id varchar(4) NOT NULL,
article varchar(100) NOT NULL,
customer_article varchar(100) NULL DEFAULT NULL,
description varchar(200) NULL DEFAULT NULL,
stock_qty int NULL,
status tinyint NULL DEFAULT 1,
created_at datetime NULL DEFAULT NULL,
created_by varchar(25) NULL DEFAULT NULL,
created_ip varchar(25) NULL DEFAULT NULL,
updated_at datetime NULL DEFAULT NULL,
updated_by varchar(25) NULL DEFAULT NULL,
updated_ip varchar(25) NULL DEFAULT NULL,
PRIMARY KEY(site_id,article)
) COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1;

CREATE TABLE ms_article(
article_id int NOT NULL AUTO_INCREMENT,
site_id varchar(4) NOT NULL,
article varchar(100) NULL DEFAULT NULL,
customer_article varchar(100) NULL DEFAULT NULL COMMENT '',
description varchar(200) NULL DEFAULT NULL,
uom varchar(100) NULL DEFAULT NULL,
conversion_value int NULL DEFAULT NULL,
safety_stock int NULL DEFAULT NULL,
`column` varchar(100) NULL DEFAULT NULL,
rack varchar(100) NULL DEFAULT NULL,
`row` varchar(100) NULL DEFAULT NULL,
price int NULL DEFAULT NULL,
chamber_sync_flag tinyint NULL DEFAULT 0,
field_sync tinyint NULL DEFAULT 0,
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


CREATE TABLE ms_article_attribute(
article_attribute_id int NOT NULL AUTO_INCREMENT,
attribute_name int NOT NULL ,
chamber_sync_flag tinyint NULL DEFAULT 0,
field_sync tinyint NULL DEFAULT 0,
status tinyint NULL DEFAULT 1,
created_at datetime NULL DEFAULT NULL,
created_by varchar(25) NULL DEFAULT NULL,
created_ip varchar(25) NULL DEFAULT NULL,
updated_at datetime NULL DEFAULT NULL,
updated_by varchar(25) NULL DEFAULT NULL,
updated_ip varchar(25) NULL DEFAULT NULL,
PRIMARY KEY(article_attribute_id)
) COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1;

CREATE TABLE ms_article_attribute_value(
article_attribute_value_id int NOT NULL AUTO_INCREMENT,
article_id int NOT NULL,
article_attribute_id int NOT NULL ,
`value` varchar(100) NULL DEFAULT NULL,
chamber_sync_flag tinyint NULL DEFAULT 0,
field_sync tinyint NULL DEFAULT 0,
status tinyint NULL DEFAULT 1,
created_at datetime NULL DEFAULT NULL,
created_by varchar(25) NULL DEFAULT NULL,
created_ip varchar(25) NULL DEFAULT NULL,
updated_at datetime NULL DEFAULT NULL,
updated_by varchar(25) NULL DEFAULT NULL,
updated_ip varchar(25) NULL DEFAULT NULL,
PRIMARY KEY(article_attribute_value_id)
) COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1;

--------
- NOTES BUDI
- tr_movement_article
created_on dihapus
add new PK movement_article_id

- tr_article_logistic_site
rename table from tr_article_logistic_site_header to tr_article_logistic_site
rename column outbound_delivery int to outbound_delivery_no varchar(15) due to value 0000022151 will be saved 22151 when integer
created_on not used same as created_at