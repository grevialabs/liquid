-- Monday 25 Feb 2019

-- USE : for fase 3
-- CREATED	: selasa 14 agustus 2018 by Rusdi
-- DEV		: 
-- QA		: 
-- PROD 	: 25 sept 2018 by Rusdi


--Monday 25 Feb 2019 (Ali)

CREATE TABLE `klbox`.`tr_prepack_bundling_header`
CREATE TABLE `klbox`.`tr_prepack_bundling_detail`
CREATE TABLE `klbox`.`tr_article_logistic_site`
CREATE TABLE `klbox`.`tr_article_logistic_site_detail`

--Tuesday 26 Feb 2019 (Ali)
ALTER TABLE `tr_prepack_bundling_detail` CHANGE COLUMN `prepack_bundling_detail` `prepack_bundling_detail_id` INT(11) NOT NULL AUTO_INCREMENT FIRST;