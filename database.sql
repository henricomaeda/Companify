create database if not exists commercify;
use commercify;

drop table if exists `commercify`.`products`;
drop table if exists `commercify`.`trades`;
drop table if exists `commercify`.`users`;

create table `commercify`.`users` (
	`use_email` varchar(200) not null,
	`use_name` varchar(200) not null,
	`use_password` varchar(200) not null,
	`use_description` varchar(200) null,
	`use_picture` varchar(200) null,
	PRIMARY KEY (`use_email`)
) ENGINE = InnoDB;

create table `commercify`.`trades` (
	`tra_id` int not null AUTO_INCREMENT,
	`tra_name` varchar(200) not null,
	`tra_description` varchar(200) null,
	`tra_picture` varchar(200) null,
	`use_email` varchar(200) not null,
	PRIMARY KEY (`tra_id`),
	INDEX `fk_trades_users_idx` (`use_email` ASC),
	CONSTRAINT `fk_trades_users`
		FOREIGN KEY (`use_email`)
		REFERENCES `commercify`.`users` (`use_email`)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
) ENGINE = InnoDB;

create table `commercify`.`products` (
	`pro_id` int not null AUTO_INCREMENT,
	`pro_name` varchar(200) not null,
	`pro_price` DECIMAL not null,
	`pro_discount` int not null,
	`pro_description` varchar(200) null,
	`pro_picture` varchar(200) null,
	`tra_id` int not null,
	PRIMARY KEY (`pro_id`),
	INDEX `fk_products_trades1_idx` (`tra_id` ASC),
	CONSTRAINT `fk_products_trades1`
		FOREIGN KEY (`tra_id`)
		REFERENCES `commercify`.`trades` (`tra_id`)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
) ENGINE = InnoDB;