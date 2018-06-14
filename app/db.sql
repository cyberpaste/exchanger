CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50),
  `refid` INT(20) DEFAULT '1',
  `email` VARCHAR(50) UNIQUE,
  `password` VARCHAR(50),
  `salt` VARCHAR(50),
  `registered` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `lastlogin` TIMESTAMP DEFAULT NULL,
  `balance` FLOAT(50),
  `role` VARCHAR(50),
  `restore_salt` VARCHAR(50),
  `restore_time` TIMESTAMP
);


CREATE TABLE IF NOT EXISTS `fields` (
  `id` INT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50),
  `message` VARCHAR(250), 
  `checktype` VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` INT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50),
  `message` VARCHAR(250), 
  `time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `currency` (
  `id` INT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50),
  `message` VARCHAR(250), 
  `checktype` VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS `exchange` (
  `id` INT NULL AUTO_INCREMENT PRIMARY KEY,
  `fromcurrency` INT(20),
  `tocurrency` INT(20),
  `rate` FLOAT(50),
  `message` VARCHAR(500),
  `info` VARCHAR(2500),
  `fields` VARCHAR(500)
);