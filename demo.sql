/*
SQLyog Ultimate v12.09 (32 bit)
MySQL - 10.1.13-MariaDB : Database - yii1blog
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `booking` */

DROP TABLE IF EXISTS `booking`;

CREATE TABLE `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yatrik_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pincode` char(7) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `arrival_date` date NOT NULL,
  `departure_date` date NOT NULL,
  `receipt_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deposit_amount` decimal(10,2) NOT NULL,
  `actual_amount` decimal(10,2) NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `booking` */

insert  into `booking`(`id`,`yatrik_name`,`address`,`city`,`pincode`,`mobile_no`,`email`,`arrival_date`,`departure_date`,`receipt_no`,`deposit_amount`,`actual_amount`,`notes`,`created_date`,`created_by`,`updated_date`,`updated_by`) values (1,'Deval Shah','10-Trimurti apprtment','Ahmedabad','380005','7874734209','devalshah21@gmail.com','2017-03-29','2017-03-31','526452','450.00','800.00','FFDSF','2017-04-03 22:23:48',0,'2017-03-29 22:43:02',1),(2,'Dipan Shah','10-Trimurti apprtment','Ahmedabad','380005','7874734209','devalshah21@gmail.com','2017-03-29','2017-03-31','526452','450.00','800.00','FFDSF','2017-04-03 22:23:47',0,'2017-03-29 22:43:02',1),(3,'Hiral Shah','Girivihar','Ahmedabad','380002','8747342097','devalshah21@gmail.com','2017-04-03','2017-04-05','6958','800.00','800.00','Did booking','2017-04-03 00:00:00',1,'2017-04-03 00:00:00',1);

/*Table structure for table `booking_details` */

DROP TABLE IF EXISTS `booking_details`;

CREATE TABLE `booking_details` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `number_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `booking_details` */

insert  into `booking_details`(`id`,`booking_id`,`room_id`,`number_count`) values (1,1,1,7),(2,1,2,2),(3,2,1,2),(4,3,1,1);

/*Table structure for table `rooms` */

DROP TABLE IF EXISTS `rooms`;

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `room_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `room_info` text COLLATE utf8_unicode_ci,
  `room_capacity` int(11) NOT NULL DEFAULT '0',
  `room_count` int(11) NOT NULL DEFAULT '1',
  `room_status` tinyint(1) DEFAULT '1',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `rooms` */

insert  into `rooms`(`id`,`room_name`,`room_price`,`room_info`,`room_capacity`,`room_count`,`room_status`,`created_date`,`updated_date`) values (1,'AC room','400.00','AC rooms',4,20,1,'2017-03-27 22:39:55','2017-03-27 22:39:55'),(2,'Non AC room','300.00','AC rooms',4,20,1,'2017-03-27 22:39:55','2017-03-27 22:39:55'),(3,'Pravachan Hall','300.00','AC rooms',50,1,1,'2017-03-27 22:39:55','2017-03-27 22:39:55'),(4,'Bhojanshala','100.00','AC rooms',50,1,1,'2017-03-27 22:39:55','2017-03-27 22:39:55'),(5,'General hall','200.00','AC rooms',150,1,1,'2017-03-27 22:39:55','2017-03-27 22:39:55');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`first_name`,`last_name`,`email`,`location`,`mobile_no`,`create_at`,`lastvisit_at`,`status`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3','Deval','Shah','devalshah21@gmail.com','Ahmedabad','7874734209','2017-03-28 22:53:36','0000-00-00 00:00:00',1),(4,'demo','fe01ce2a7fbac8fafaed7c982a04e229','Admin','Shah','demo@example.com','Delhi','9274305014','2017-03-28 22:53:59','0000-00-00 00:00:00',0);

/*Table structure for table `users_old` */

DROP TABLE IF EXISTS `users_old`;

CREATE TABLE `users_old` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `users_old` */

insert  into `users_old`(`id`,`username`,`password`,`email`,`location`,`mobile_no`,`create_at`,`lastvisit_at`,`status`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3','devalshah21@gmail.com',NULL,NULL,'2017-03-22 23:19:36','2017-03-22 20:01:31',1),(2,'demo','fe01ce2a7fbac8fafaed7c982a04e229','demo@example.com',NULL,NULL,'2017-03-22 23:19:36','2017-03-22 20:00:48',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

ALTER TABLE `yii1blog`.`booking_details` ADD COLUMN `room_price` DECIMAL(10,2) DEFAULT 0.00 NULL AFTER `number_count`;
UPDATE `booking_details` bd INNER JOIN rooms r ON r.`id` = bd.`room_id` SET bd.`room_price` = r.`room_price`;