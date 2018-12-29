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