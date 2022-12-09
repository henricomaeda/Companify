create database if not exists companify;
use companify;

drop table if exists `companify`.`products`;
drop table if exists `companify`.`companies`;
drop table if exists `companify`.`users`;

create table `companify`.`users` (
	`use_email` varchar(200) not null,
	`use_name` varchar(20) not null,
	`use_lastname` varchar(200) null,
	`use_password` varchar(200) not null,
	`use_description` varchar(200) null,
	`use_picture` varchar(200) null,
	`use_token` varchar(200) null,
	PRIMARY KEY (`use_email`)
) ENGINE = InnoDB;

create table `companify`.`companies` (
	`com_id` int not null AUTO_INCREMENT,
	`tra_name` varchar(200) not null,
	`tra_description` varchar(200) null,
	`tra_picture` varchar(200) null,
	`use_email` varchar(200) not null,
	PRIMARY KEY (`com_id`),
	INDEX `fk_companies_users_idx` (`use_email` ASC),
	CONSTRAINT `fk_companies_users`
		FOREIGN KEY (`use_email`)
		REFERENCES `companify`.`users` (`use_email`)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
) ENGINE = InnoDB;

create table `companify`.`products` (
	`pro_id` int not null AUTO_INCREMENT,
	`pro_name` varchar(200) not null,
	`pro_price` DECIMAL not null,
	`pro_discount` int not null,
	`pro_description` varchar(200) null,
	`pro_picture` varchar(200) null,
	`com_id` int not null,
	PRIMARY KEY (`pro_id`),
	INDEX `fk_products_companies1_idx` (`com_id` ASC),
	CONSTRAINT `fk_products_companies1`
		FOREIGN KEY (`com_id`)
		REFERENCES `companify`.`companies` (`com_id`)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
) ENGINE = InnoDB;