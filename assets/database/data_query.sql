create database if not exists companify;
use companify;

drop table if exists `companify`.`reviews`;
drop table if exists `companify`.`products`;
drop table if exists `companify`.`companies`;
drop table if exists `companify`.`users`;

create table `companify`.`users` (
  	`use_id` int UNSIGNED not null AUTO_INCREMENT,
	`use_email` varchar(200) not null,
	`use_name` varchar(20) not null,
	`use_lastname` varchar(200) null,
	`use_password` varchar(200) not null,
	`use_description` varchar(200) null,
	`use_picture` varchar(200) null,
	`use_token` varchar(200) null,
	PRIMARY KEY (`use_id`)
) ENGINE = InnoDB;

create table `companify`.`companies` (
	`com_id` int UNSIGNED not null AUTO_INCREMENT,
	`com_name` varchar(200) not null,
	`com_description` varchar(200) null,
	`com_picture` varchar(200) null,
	`use_id` int UNSIGNED not null,
	PRIMARY KEY (`com_id`),
	INDEX `fk_companies_users_idx` (`use_id` ASC),
	CONSTRAINT `fk_companies_users`
		FOREIGN KEY (`use_id`)
		REFERENCES `companify`.`users` (`use_id`)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
) ENGINE = InnoDB;

create table `companify`.`products` (
	`pro_id` int UNSIGNED not null AUTO_INCREMENT,
	`pro_name` varchar(200) not null,
	`pro_price` decimal not null,
	`pro_discount` int not null,
	`pro_description` varchar(200) null,
	`pro_picture` varchar(200) null,
	`com_id` int UNSIGNED not null,
	PRIMARY KEY (`pro_id`),
	INDEX `fk_products_companies1_idx` (`com_id` ASC),
	CONSTRAINT `fk_products_companies1`
		FOREIGN KEY (`com_id`)
		REFERENCES `companify`.`companies` (`com_id`)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
) ENGINE = InnoDB;

create table `companify`.`reviews` (
	`rev_id` int UNSIGNED not null AUTO_INCREMENT,
	`rev_rating` INT not null,
	`rev_review` varchar(200) not null,
	`use_id` int UNSIGNED not null,
	`com_id` int UNSIGNED not null,
	PRIMARY KEY (`rev_id`),
	INDEX `fk_reviews_users1_idx` (`use_id` ASC),
	INDEX `fk_reviews_companies1_idx` (`com_id` ASC),
	CONSTRAINT `fk_reviews_users1`
		FOREIGN KEY (`use_id`)
		REFERENCES `companify`.`users` (`use_id`)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION,
	CONSTRAINT `fk_reviews_companies1`
		FOREIGN KEY (`com_id`)
		REFERENCES `companify`.`companies` (`com_id`)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
) ENGINE = InnoDB;