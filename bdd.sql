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
(1,'FinePix Pro2 3D Camera','3DcAM01','product-images/camera.jpg',1500.00),
(2,'EXP Portable Hard Drive','USB02','product-images/external-hard-drive.jpg',800.00),
(3,'Luxury Ultra thin Wrist Watch','wristWear03','product-images/watch.jpg',300.00),
(4,'XP 1155 Intel Core Laptop','LPN45','product-images/laptop.jpg',800.00);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
