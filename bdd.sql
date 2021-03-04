/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.11-MariaDB : Database - testphp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `testphp`;

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(80) DEFAULT NULL,
  `customer_email` varchar(120) DEFAULT NULL,
  `customer_mobile` varchar(40) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `reference` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `orders` */

insert  into `orders`(`id`,`customer_name`,`customer_email`,`customer_mobile`,`status`,`created_at`,`updated_at`,`reference`) values 
(1,'','','','REJECTED','2021-03-04 15:21:33','2021-03-04 15:21:33','TEST_1614889234'),
(2,'','','','REJECTED','2021-03-04 15:24:07','2021-03-04 15:24:07','TEST_1614889234');

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `imagen` text NOT NULL,
  `precio` double(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_producto` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `producto` */

insert  into `producto`(`id`,`nombre`,`codigo`,`imagen`,`precio`) values 
(1,'FinePix Pro2 3D Camera','3DcAM01','product-images/camera.jpg',1.00),
(2,'EXP Portable Hard Drive','USB02','product-images/external-hard-drive.jpg',1.00),
(3,'Luxury Ultra thin Wrist Watch','wristWear03','product-images/watch.jpg',1.00),
(4,'XP 1155 Intel Core Laptop','LPN45','product-images/laptop.jpg',1.00);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
